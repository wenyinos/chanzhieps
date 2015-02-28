<?php
/**
 * The setbasic view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setBasic;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->site->lang;?></th>
          <td colspan='2'><?php echo html::checkbox('lang', $config->langs, isset($this->config->site->lang) ? $this->config->site->lang : 'zh-cn');?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->defaultLang;?></th>
          <td class='w-p20'><?php echo html::select('defaultLang', $config->langs, isset($this->config->site->defaultLang) ? $this->config->site->defaultLang : 'zh-cn', "class='form-control'");?></td><td></td>
          <td></td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
