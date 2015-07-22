<?php
/**
 * The model file of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class orderModel extends model
{
    /**
     * Get order by ID.
     * 
     * @param  int    $id 
     * @access public
     * @return object
     */
    public function getByID($id)
    {
        return $this->dao->select('*')->from(TABLE_ORDER)->where('id')->eq($id)->fetch();
    }

    /**
     * Get order list.
     * 
     * @param  string    $mode 
     * @param  mix       $value 
     * @param  string    $orderBy 
     * @param  object    $pager 
     * @access public
     * @return array
     */
    public function getList($mode, $value, $orderBy = 'id_desc', $pager = null)
    {
        $days = $this->config->shop->confirmLimit;

        if($days)
        {
            $deliveryDate = date('Y-m-d H:i:s', time() - 24 * 60 * 60 * $days);
            $this->dao->update(TABLE_ORDER)
                ->set('deliveryStatus')->eq('confirmed')
                ->where('deliveryStatus')->eq('send')
                ->andWhere('deliveriedDate')->le($deliveryDate)
                ->exec();
        }

        $orders = $this->dao->select('*')->from(TABLE_ORDER)
            ->beginIf($mode == 'account')->where('account')->eq($value)->fi()
            ->beginIf($mode == 'status')->where('status')->eq($value)->fi()
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('id');

        $products = $this->dao->select('*')->from(TABLE_ORDERPRODUCT)->where('orderID')->in(array_keys($orders))->fetchGroup('orderID');

        foreach($orders as $order) $order->products = isset($products[$order->id]) ? $products[$order->id] : array();

        return $orders;
    }

    /**
     * Create an order.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        $order = new stdclass();
        $order->account        = $this->app->user->account;
        $order->address        = $this->post->deliveryAddress;
        $order->payment        = $this->post->payment;
        $order->createdDate    = helper::now();
        $order->payStatus      = 'not_paid';
        $order->status         = 'normal';
        $order->deliveryStatus = 'not_send';

        if($this->post->createAddress)
        {
            $address = new stdclass();
            $this->loadModel('address');
            $address->account = $this->app->user->account;
            $address->address = $this->post->address;
            $address->contact = $this->post->contact;
            $address->phone   = $this->post->phone;
            $address->zipcode = $this->post->zipcode;

            $this->dao->insert(TABLE_ADDRESS)->data($address)->batchCheck($this->config->address->require->create, 'notempty')->exec();
            if(dao::isError()) return array('result' => 'fail', 'message' => dao::getError());
            $order->address = $address->contact . ' [' . $address->phone . '] ' . $address->address . ' ' . $address->zipcode;
        }

        $this->dao->insert(TABLE_ORDER)->data($order)->autocheck()->batchCheck($this->config->order->require->create, 'notempty')->exec();
        if(dao::isError()) return array('result' => 'fail', 'message' => dao::getError());

        $orderID = $this->dao->lastInsertID();

        $orderProduct = new stdclass();
        $orderProduct->orderID = $orderID;
        
        /* Save products of the order and compute order amount. */
        $amount = 0;
        foreach($this->post->product as $product)
        {
            $product = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->eq($product)->fetch();
            if(empty($product)) continue;
            $orderProduct->productID   = $product->id; 
            $orderProduct->productName = $product->name; 
            $orderProduct->count       = $this->post->count[$product->id];

            $orderProduct->price = $product->promotion > 0 ? $product->promotion : $product->price; 
            if(!$orderProduct->price) continue;

            $amount += $orderProduct->price * $orderProduct->count;

            $this->dao->insert(TABLE_ORDERPRODUCT)->data($orderProduct)->autoCheck()->exec();
        }
        /* Check valid products count. */
        $productCout = $this->dao->select("count(*) as count")->from(TABLE_ORDERPRODUCT)->where('orderID')->eq($orderID)->fetch('count');
        if(!$productCout)  return array('result' => 'fail', 'message' => $this->lang->order->noProducts);

        $this->dao->update(TABLE_ORDER)->set('amount')->eq($amount)->where('id')->eq($orderID)->exec();
        $this->dao->delete()->from(TABLE_CART)->where('account')->eq($this->app->user->account)->andWhere('product')->in($this->post->product)->exec();
        if(!dao::isError()) return $orderID;
    }

    /**
     * Create pay link of an order.
     * 
     * @param  int    $order 
     * @access public
     * @return void
     */
    public function createPayLink($order)
    {
        if($order->payment == 'alipay') return $this->createAlipayLink($order);
        return false;
    }

    /**
     * Get the human order id.
     * 
     * @param  int    $rawOrderID 
     * @access public
     * @return int
     */
    public function getHumanOrder($rawOrderID)
    {
        return  date('ym') . str_pad($rawOrderID, 7, '0', STR_PAD_LEFT) . mt_rand(10, 99);
    }

    /**
     * Get the raw order id.
     * 
     * @param  int    $humanOrder 
     * @access public
     * @return int
     */
    public function getRawOrder($humanOrder)
    {
        return (int)substr($humanOrder, 4, 7);
    }

    /**
     * Create a alipay link. 
     * 
     * @param  string    $orderNO 
     * @access public
     * @return string
     */
    public function createAlipayLink($order)
    {
        $this->app->loadClass('alipay', true);

        $this->config->alipay->notifyURL = getWebRoot(true) . ltrim(inlink('processorder', "type=alipay&mode=notify"), '/');
        $this->config->alipay->returnURL = getWebRoot(true) . ltrim(inlink('processorder', "type=alipay&mode=return"), '/');

        $alipay = new alipay($this->config->alipay);

        $subject = sprintf($this->lang->order->payInfo, $this->config->site->name, date('Y-m-d'));

        return $alipay->createPayLink($this->getHumanOrder($order->id),  $subject, $order->amount);
    }

    /**
     * Get order id from the alipay return.
     * 
     * @param  string $mode  return|notify
     * @access public
     * @return object
     */
    public function getOrderFromAlipay($mode = 'return')
    {
        $this->app->loadClass('alipay', true);
        $alipay = new alipay($this->config->alipay);

        $orderID = 0;
        if($mode == 'return')
        {
            if(1 or $alipay->checkNotify($_GET) and $this->get->trade_status == 'TRADE_FINISHED' || $this->get->trade_status == 'TRADE_SUCCESS')
            {
                $orderID = $this->get->out_trade_no;
                $sn      = $this->get->trade_no;
            }
        }
        elseif($mode == 'notify')
        {
            if($alipay->checkNotify($_POST) and $this->post->trade_status == 'TRADE_FINISHED' || $this->post->trade_status == 'TRADE_SUCCESS')
            {
                $orderID = $this->post->out_trade_no;
                $sn      = $this->post->trade_no;
            }
        }

        if($orderID) $orderID = $this->getRawOrder($orderID);
        $order = $this->getByID($orderID);

        $order->sn = $sn;
        return $order;
    }

    /**
     * Save the request date from alipay to log file.
     * 
     * @access public
     * @return void
     */
    public function saveAlipayLog()
    {
        $content = date('Y-m-d H:i:s') . "\n";
        foreach($_POST as $key => $val) $content .= "$key = $val\n";
        $content .= "----------------\n";
        $logFile = $this->app->getTmpRoot() . 'log/alipay.log';
        $handle = fopen($logFile, 'a');
        fwrite($handle, $content);
        fclose($handle);
    }

    /**
     * Process an order.
     * 
     * @param  object    $order 
     * @access public
     * @return bool
     */
    public function processOrder($order)
    {
        if($order->payStatus == 'Y') return true; 

        $this->dao->update(TABLE_ORDER)
            ->set('sn')->eq($order->sn)
            ->set('payStatus')->eq('paid')
            ->set('paidDate')->eq(helper::now())
            ->where('id')->eq($order->id)->exec();

        return !dao::isError();
    }

    /**
     * Process status of and order.
     * 
     * @param  int    $order 
     * @access public
     * @return void
     */
    public function processStatus($order)
    {
        if($order->status == 'finished') return $this->lang->order->statusList['finished'];
        if($order->status == 'canceled') return $this->lang->order->statusList['canceled'];
    
        if($order->payment == 'COD') return $this->lang->order->statusList[$order->deliveryStatus];

        if($order->payment != 'COD')
        {
            if($order->payStatus == 'paid') return $this->lang->order->statusList[$order->deliveryStatus];
            return $this->lang->order->statusList[$order->payStatus];
        }
    }

    /**
     * Finish an order.
     * 
     * @param  int    $orderID 
     * @access public
     * @return bool
     */
    public function finish($orderID)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('status')->eq('finished')
            ->set('finishedDate')->eq(helper::now())
            ->set('finishedBy')->eq($this->app->user->account)
            ->where('id')->eq($orderID)
            ->exec();
        return !dao::isError();
    }

    public function cancel($orderID)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('status')->eq('canceled')
            ->where('id')->eq($orderID)
            ->andWhere('account')->eq($this->app->user->account)
            ->exec();
        return !dao::isError();
    }

    public function pay($orderID)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('payStatus')->eq('paid')
            ->set('sn')->eq($this->post->sn)
            ->set('paidDate')->eq($this->post->paidDate)
            ->where('id')->eq($orderID)
            ->exec();
        return !dao::isError();
    }


    /**
     * Print actions of an order.
     * 
     * @param  string    $order 
     * @access public
     * @return string
     */
    public function printActions($order)
    {
        if(RUN_MODE == 'admin' and $order->status == 'normal')
        {
            /* Send link. */
            if($order->payment == 'COD' and $order->deliveryStatus == 'not_send') echo html::a(helper::createLink('order', 'delivery', "orderID=$order->id"), $this->lang->order->delivery, "data-toggle='modal'");
            if($order->payment != 'COD' and $order->payStatus == 'paid' and $order->deliveryStatus == 'not_send') echo html::a(helper::createLink('order', 'delivery', "orderID=$order->id"), $this->lang->order->delivery, "data-toggle='modal'");

            /* Pay link. */
            if($order->payment == 'COD' and $order->payStatus != 'paid' and $order->deliveryStatus == 'confirmed') echo html::a(helper::createLink('order', 'pay', "orderID=$order->id"), $this->lang->order->return, "data-toggle='modal'");

            /* Finish link. */
            if($order->payStatus == 'paid' and $order->deliveryStatus == 'confirmed' and $order->status != 'finished' and $order->status != 'canceled') echo html::a('javascript:;', $this->lang->order->finish, "data-rel='" . helper::createLink('order', 'finish', "orderID=$order->id") . "' class='finisher'");
            if($order->deliveryStatus != 'not_send') echo html::a(inlink('deliveryInfo', "orderID={$order->id}"), $this->lang->order->deliveryInfo, "data-toggle='modal'");
        }

        if(RUN_MODE == 'front' and $order->status == 'normal')
        {
            /* Pay link. */
            if($order->payment != 'COD' and $order->payStatus != 'paid') echo html::a($this->createPayLink($order), $this->lang->order->pay, "target='_blank'");

            /* Track link. */
            if($order->deliveryStatus != 'not_send') echo html::a(inlink('track', "orderID={$order->id}"), $this->lang->order->track, "data-rel='" . helper::createLink('order', 'confirmDelivery', "orderID=$order->id") . "' data-toggle='modal'") . '<br>';

            /* Confirm link. */
            if($order->deliveryStatus == 'send') echo html::a('javascript:;', $this->lang->order->confirmReceived, "data-rel='" . helper::createLink('order', 'confirmDelivery', "orderID=$order->id") . "' class='confirmDelivery'");

            /* Cancel link. */
            if($order->deliveryStatus == 'not_send' and $order->payStatus != 'paid' and $order->status == 'normal') echo html::a('javascript:;', $this->lang->order->cancel, "data-rel='" . helper::createLink('order', 'cancel', "orderID=$order->id") . "' class='cancelLink'");
        }
   }

    /**
     * Confirm delivery.
     * 
     * @param  int    $orderID 
     * @access public
     * @return void
     */
    public function confirmDelivery($orderID)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('deliveryStatus')->eq('confirmed')
            ->set('confirmedDate')->eq(helper::now())
            ->where('id')->eq($orderID)
            ->andWhere('account')->eq($this->app->user->account)
            ->exec();
        return !dao::isError();
    }


    /**
     * Get order by id 
     * 
     * @param  int    $rawOrder 
     * @access public
     * @return object
     */
    public function getOrderByRawID($rawOrder)
    {
        $order = $this->dao->select('*')->from(TABLE_ORDER)->where('id')->eq((int)$rawOrder)->fetch();
        if(!$order) return false;
        $order->humanOrder = $this->getHumanOrder($order->id);
        return $order;
    }

    /**
     * Get order by id 
     * 
     * @param  int    $humanOrder 
     * @access public
     * @return object
     */
    public function getOrderByHumanID($humanOrder)
    {
        $rawOrder = $this->getRawOrder($humanOrder);
        return $this->getOrderByRawID($rawOrder);
    }

    /**
     * Delivery products of an order.
     * 
     * @param  int    $orderID 
     * @access public
     * @return void
     */
    public function delivery($orderID)
    {
        $delivery = fixer::input('post')
            ->add('deliveriedBy', $this->app->user->account)
            ->add('deliveryStatus', 'send')
            ->get();
        $this->dao->update(TABLE_ORDER)->data($delivery)->where('id')->eq($orderID)->exec();
        return !dao::isError();
    }

    /**
     * Get product infomation posted to buy.
     * 
     * @param  string $prodcut 
     * @param  int    $count 
     * @access public
     * @return void
     */
    public function getPostedProducts($product, $count = 0)
    {
        $productIdList  = (array) $product;

        /* Get products(use groupBy to distinct products).  */
        $products = $this->dao->select('t1.*, t2.category')->from(TABLE_PRODUCT)->alias('t1')
            ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
            ->where('t1.id')->in($productIdList)
            ->andWhere('t2.type')->eq('product')
            ->beginIF(RUN_MODE == 'front')->andWhere('t1.status')->eq('normal')->fi()
            ->fetchAll('id');

        if(empty($products)) return array();

        /* Get categories for these products. */
        $categories = $this->dao->select('t2.id, t2.name, t2.alias, t1.id AS product')
            ->from(TABLE_RELATION)->alias('t1')
            ->leftJoin(TABLE_CATEGORY)->alias('t2')->on('t1.category = t2.id')
            ->where('t2.type')->eq('product')
            ->andWhere('t1.id')->in(array_keys($products))
            ->fetchGroup('product', 'id');

        /* Assign categories to it's product. */
        foreach($products as $product) $product->categories = !empty($categories[$product->id]) ? $categories[$product->id] : array();

        /* Get images for these products. */
        $images = $this->loadModel('file')->getByObject('product', array_keys($products), $isImage = true);
        
        /* Assign images to it's product. */
        foreach($products as $product)
        {
            if($_POST) $product->count = $this->post->count[$product->id];
            if(!$_POST) $product->count = $count;
            if(empty($images[$product->id])) continue;
            $product->image = new stdclass();
            if(isset($images[$product->id]))  $product->image->list = $images[$product->id];
            if(!empty($product->image->list)) $product->image->primary = $product->image->list[0];
        }
        
        return $products;
    }

    /**
     * Save settings. 
     * 
     * @access public
     * @return void
     */
    public function saveSetting()
    {
        $errors = '';
        if(!$this->post->payment) $errors['payment'] = array($this->lang->order->paymentRequired);
        if(!$this->post->confirmLimit) $errors['confirmLimit'] = array($this->lang->order->confirmLimitRequired);
        if(in_array('alipay', $this->post->payment) and strlen($this->post->pid) != 16) $errors['pid'] = array($this->lang->order->placeholder->pid);
        if(in_array('alipay', $this->post->payment) and strlen($this->post->key) != 32) $errors['key'] = array($this->lang->order->placeholder->key);
        if(in_array('alipay', $this->post->payment) and !validater::checkEmail($this->post->email)) $errors['email'] = array(sprintf($this->lang->error->email, $this->lang->order->alipayEmail)); 
        if(!empty($errors)) return array('result' => 'fail', 'message' => $errors);

        $shopSetting = array();
        $shopSetting['payment']      = join(',', $this->post->payment);
        $shopSetting['confirmLimit'] = $this->post->confirmLimit;
        $this->loadModel('setting')->setItems('system.common.shop', $shopSetting);

        $alipaySetting = array();
        $alipaySetting['pid']   = $this->post->pid;
        $alipaySetting['key']   = $this->post->key;
        $alipaySetting['email'] = $this->post->email;
        $result = $this->loadModel('setting')->setItems('system.common.alipay', $alipaySetting);

        return array('result' => 'success', 'message' => $this->lang->saveSuccess);
    }
}
