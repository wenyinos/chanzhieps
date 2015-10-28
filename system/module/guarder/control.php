<?php
/**
 * The control file of guarder module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
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
    public function setBlacklist($mode='keywords', $pageID = 1)
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
    public function setWhitelist($type='account')
    {
        $this->lang->guarder->menu = $this->lang->security->menu;
        $this->lang->menuGroups->site = 'security';

        if(!empty($_POST))
        {
            $setting = fixer::input('post')
                ->setDefault('IPWhitelist', '')
                ->setDefault('ACWhitelist', '')
                ->get();

            /* check IP. */
            $ips = empty($_POST['IPWhitelist']) ? array() : explode(',', $this->post->IPWhitelist);
            foreach($ips as $ip)
            {
                if(!empty($ip) and !helper::checkIP($ip))
                {
                    dao::$errors['allowedIP'][] = $this->lang->guarder->wrongIP;
                    break;
                }
            }

            $result = $this->loadModel('setting')->setItems('system.common.guarder', $setting, 'all');

            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setWhitelist')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title = $this->lang->guarder->setWhitelist;
        $this->display();
    }

    /**
     * Add a blacklist object. 
     * 
     * @param string    $type 
     * @access public
     * @return void
     */
    public function add($type)
    {
        $typeList = $this->lang->guarder->blacklistModes;
        if($_POST)
        {
            $result = $this->guarder->punish($this->post->type, $this->post->identity, $this->post->reason, $this->post->expired);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setBlacklist', "mode=$type")));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail, 'locate' => inlink('setBlacklist')));
        }

        $this->view->title       = $this->lang->guarder->add;
        $this->view->typeList    = $typeList;
        $this->view->currentType = $type;
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
