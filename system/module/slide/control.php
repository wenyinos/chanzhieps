<?php
/**
 * The control file of slide module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class slide extends control
{
    /**
     * Browse slides in admin.
     * 
     * @access public
     * @return void
     */
    public function admin($groupID = '')
    {
        if(!$groupID)
        {
            $firstGroup = $this->loadModel('tree')->getFirst('slide');
            $groupID = $firstGroup->id;
        }

        $this->view->title          = $this->lang->slide->admin;
        $this->view->group          = $groupID;
        $this->view->slides         = $this->slide->getList($groupID);
        $this->view->treeModuleMenu = $this->loadModel('tree')->getTreeMenu('slide', 0, array('treeModel', 'createSlideAdminLink'));
        $this->view->treeManageLink = html::a(helper::createLink('tree', 'browse', "type=slide"), $this->lang->slideGroup->manage);
        $this->display();
    }

    /**
     * Create a slide.
     *
     * @access public 
     * @return void
     */
    public function create($groupID)
    {
        if($_POST)
        {
            if($this->post->backgroundType == 'image')
            {   
                if(empty($_FILES) and empty($_POST['image'])) $this->send(array('result' => 'fail', 'message' => $this->lang->slide->noImageSelected));

                $image = empty($_POST['image']) ? $this->slide->uploadImage($groupID) : $this->post->image;
                if(!$image) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
            }
            else
            {
                $image = null;
            }

            if($this->slide->create($groupID, $image))
            {
                $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => $this->inlink('admin', "group={$groupID}")));
            }

            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->display(); 
    }

    /**
     * Edit a slide.
     *
     * @param int $id
     * @access public
     * @return void
     */
    public function edit($id)
    {
        $slide = $this->slide->getByID($id);

        if($_POST)
        {
            if($this->slide->update($id))
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>$this->inLink('admin', "groupID={$slide->group}")));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->id    = $id;
        $this->view->slide = $slide;
        $this->display();
    }

    /**
     * Delete a slide.
     *
     * @param int $id
     * @retturn void
     */
    public function delete($id)
    {
        if($this->slide->delete($id)) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Sort slides.
     *
     * @access public
     * @return void
     */
    public function sort()
    {
        if($this->slide->sort()) $this->send(array('result' => 'success', 'message' => $this->lang->slide->successSort));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }
}
