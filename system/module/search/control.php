<?php
/**
 * The control file of search of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     search
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class search extends control
{
    /**
     * index 
     * 
     * @param  int    $words 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function index($words = '', $pageID = 1)
    {
        if(empty($words)) $words = $this->get->words;
        $words = strip_tags(strtolower($words));

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal = 0, $this->config->search->recPerPage, $pageID);

        $this->session->set('serachIngWord', $words);

        $begin = time();
        $this->view->results = $this->search->getList($words, $pager);

        $this->view->consumed = time() - $begin;
        $this->view->title    = $this->lang->search->index; 
        $this->view->pager    = $pager;
        $this->view->words    = $words;

        $this->display();
    }

    /**
     * Build All index. 
     * 
     * @access public
     * @return void
     */
    public function buildIndex($type = 'article', $lastID = '')
    {
        if(helper::isAjaxRequest())
        {
            $result = $this->search->buildAllIndex($type, $lastID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            if(isset($result['finished']) and $result['finished'])
            {
                $this->send(array('result' => 'finished', 'message' => $this->lang->search->buildSuccessfully));
            }
            else
            {
                $this->send(array('result' => 'unfinished', 'message' => sprintf($this->lang->search->buildResult, $result['count']),'next' => inlink('buildIndex', "type={$result['type']}&lastID={$result['lastID']}") ));
            }
        }

        $this->view->title = $this->lang->search->buildIndex;
        $this->display();
    }
}
