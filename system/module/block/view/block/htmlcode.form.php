<?php
/**
 * The code block form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<tr>
  <th><?php echo $lang->block->htmlcode;?></th>
  <td><?php echo html::textarea('content', '', "rows=20 class='form-control codeeditor' data-height='350'");?></td>
</tr>
