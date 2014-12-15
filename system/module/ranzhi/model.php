<?php
/**
 * The model file for ranzhi module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ranzhi
 * @version     $Id$
 * @link        http://www.chanzhi.org
  */
class ranzhiModel extends model
{
    /**
     * Get block list.
     * 
     * @access public
     * @return string
     */
    public function getAvailableBlocks()
    {
        return json_encode($this->lang->ranzhi->availableBlocks);
    }

    /**
     * Get order params.
     * 
     * @access public
     * @return string
     */
    public function getFeedbackParams()
    {
        $params = new stdclass();

        return json_encode($params);
    }
}
