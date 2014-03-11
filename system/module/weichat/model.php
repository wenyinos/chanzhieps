<?php
/**
 * The model file of weichat module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@cxirangit.com>
 * @package     weichat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class weichatModel extends model
{
    /** 
     * Get public list.
     * 
     * @access public
     * @return array
     */
    public function getList()
    {
        return $this->dao->select('*')->from(TABLE_WX_PUBLIC)->orderBy('addedDate_desc')->fetchAll('id');
    }

    /**
     * Create a public.
     * 
     * @access public
     * @return int|bool
     */
    public function create()
    {
        $public = fixer::input('post')->add('addedDate', helper::now())->get();

        $this->dao->insert(TABLE_WX_PUBLIC)->data($public)->autoCheck()->exec();

        return !dao::isError();
    }
}
