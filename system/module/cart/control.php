<?php
/**
 * The control file of cart of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     cart 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class cart extends control
{
    /**
     * Add a product to cart.
     * 
     * @param  int    $product 
     * @access public
     * @return void
     */
    public function add($product, $count)
    {
        if($this->app->user->account == 'guest') $this->send(array('result' => 'fail', 'locate' => $this->createLink('user', 'login')));
        $result = $this->cart->add($product, $count);
        if($result) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Browse products in my cart.
     * 
     * @access public
     * @return void
     */
    public function browse()
    {
        $this->app->loadLang('product');
        $this->app->loadLang('order');
        $this->view->currencySymbol = $this->lang->product->currencySymbols[$this->config->product->currency];
        $this->view->title    = $this->lang->cart->browse;
        $this->view->products = $this->cart->getListByAccount($this->app->user->account);
        $this->display();
    }

    /**
     * Print cart msg in topbar.
     * 
     * @access public
     * @return void
     */
    public function printtopbar()
    {
        $count = $this->dao->select('count(*) as count')->from(TABLE_CART)->where('account')->eq($this->app->user->account)->fetch('count');
        echo html::a($this->createLink('cart', 'browse'), sprintf($this->lang->cart->topbarInfo, $count));
    }

    /**
     * Delete product fron cart.
     * 
     * @param  int    $product 
     * @access public
     * @return void
     */
    public function delete($product)
    {
        $this->dao->delete()->from(TABLE_CART)->where('product')->eq($product)->andWhere('account')->eq($this->app->user->account)->exec();
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success', 'message' => $this->lang->deleteSuccess, 'locate' => inlink('browse')));
    }
}
