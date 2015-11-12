<?php
/**
 * The control file of guarder module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Qiaqia LI<liqiaqia@cnezsoft.cn>
 * @package     guarder 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class guarder extends control
{
    /**
     * Manage blacklist. 
     * 
     * @access public
     * @return void
     */
    public function blacklist($mode='keywords', $pageID = 1)
    {
        $this->lang->guarder->menu = $this->lang->security->menu;
        $this->lang->menuGroups->site = 'security';

        /* Load the pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal=0, $recPerPage=30, $pageID);

        $blacklist = $this->dao->select('*')->from(TABLE_BLACKLIST)->where('type')->eq($mode)->page($pager)->fetchAll();
        
        $this->view->title = $this->lang->site->setBlacklist;
        $this->view->blacklist = $blacklist;
        $this->view->pager = $pager;
        $this->view->mode  = $mode;
        $this->display();
    }

    /**
     * Manage whitelist. 
     * 
     * @access public
     * @return void
     */
    public function setWhitelist()
    {
        $this->lang->guarder->menu = $this->lang->security->menu;
        $this->lang->menuGroups->site = 'security';

        if($_POST)
        {
            $user = $this->loadModel('user')->identify($this->app->user->account, $this->post->password);
            if(!$user) $this->send(array( 'result' => 'fail', 'message' => $this->lang->user->identifyFailed ) );

            $setting = fixer::input('post')->get();

            /* check IP. */
            $ips = explode(',', $setting->ip);
            foreach($ips as $ip)
            {
                if(!empty($ip) and !helper::checkIP($ip))
                {
                    $this->send(array('result' => 'fail', 'message' => $this->lang->guarder->whitelist->wrongIP));
                }
            }
            $setting = array('whitelist' => helper::jsonEncode($setting));

            $result = $this->loadModel('setting')->setItems('system.common.guarder', $setting, 'all');
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setWhitelist')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title = $this->lang->guarder->setWhitelist;
        $this->display();
    }

    /**
     * Add a blacklist item. 
     * 
     * @access public
     * @return void
     */
    public function addBlacklist()
    {
        $typeList = $this->lang->guarder->blacklistModes;
        if($_POST)
        {
            $item = $this->post->identity;

            $type = 'keywords';
            if(validater::checkIP($item))    $type = 'ip';
            if(validater::checkEmail($item)) $type = 'email';
            if(validater::checkAccount($item))
            {
                $user = $this->loadModel('user')->getByAccount($item);
                if(!empty($user)) $type = 'account';
            }
            
            $result = $this->guarder->punish($type, $item, $this->post->reason, $this->post->expired);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('blacklist', "mode=$type")));
            $this->send(array('result' => 'fail', 'message' => dao::geterror()));
        }

        $this->view->title       = $this->lang->addBlacklist;
        $this->view->typeList    = $typeList;
        $this->view->currentType = $type;
        $this->display();
    }

    /**
     * select object's items, add them to blacklist.
     *
     * @param  int    $id
     * @access public
     * @return void
     */
    public function addToBlacklist($objectType, $id)
    {
        if($_POST)
        {
            $post = fixer::input('post')->get();
            //save keywords items.
            $keywords = explode(',', $post->keywords);
            foreach($keywords as $keyword)
            {
                if(empty($keyword)) continue;
                $this->guarder->punish('keywords', $keyword, 'thread');
                if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            }

            foreach($this->post->item as $type => $item)
            {
                $this->guarder->punish($type, current($item), '', $this->post->hour[$type]);
            }
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => $this->server->http_referer));
        }

        $object = $this->loadModel($objectType)->getByID($id);
        if($objectType == 'message') $object->author = $object->account;

        $this->view->object     = $object;
        $this->view->objectType = $objectType;
        $this->view->title      = $this->lang->addToBlacklist;
        $this->display();
    }
    /**
     * Delete a blacklist object. 
     * 
     * @param  int    $objectID 
     * @access public
     * @return void
     */
    public function delete($type, $identity)
    {
        $result = $this->dao->delete()->from(TABLE_BLACKLIST)->where('identity')->eq($identity)->andWhere('type')->eq($type)->exec();
        if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setBlacklist', "mode=$type")));
        $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

        $this->view->title = $this->lang->site->setBlacklist;
        $this->display();
    }
}
