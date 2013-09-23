<?php
/**
 * The setbasic view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<form action='' method='post' id='ajaxForm'>
  <table class='table table-form'>
    <caption><?php echo $lang->site->setAppkey;?></caption> 
    <tr>
      <th class='w-100px'><?php echo "App Key";?></th> 
      <td><?php echo html::input('akey', $this->config->site->akey, "class='text-3'");?></td> 
    </tr>
    <tr>
      <th><?php echo "App Secret";?></th> 
      <td><?php echo html::input('skey', $this->config->site->skey, "class='text-3'");?></td> 
    </tr>
    <tr>
      <th><?php echo "Uid";?></th> 
      <td><?php echo html::input('Uid', $this->config->site->Uid, "class='text-3'");?></td> 
    </tr>
      <th></th>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
