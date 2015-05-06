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
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setRecPerPage;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->recPerPage->article;?></th> 
          <td class='col-xs-6'><?php echo html::input('articleRec', isset($this->config->site->articleRec) ? $this->config->site->articleRec : '', "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->recPerPage->product;?></th> 
          <td class='col-xs-6'><?php echo html::input('productRec', isset($this->config->site->productRec) ? $this->config->site->productRec : '', "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->recPerPage->blog;?></th> 
          <td class='col-xs-6'><?php echo html::input('blogRec', isset($this->config->site->blogRec) ? $this->config->site->blogRec : '', "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->recPerPage->message;?></th> 
          <td class='col-xs-6'><?php echo html::input('messageRec', isset($this->config->site->messageRec) ? $this->config->site->messageRec : '', "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->recPerPage->forum;?></th> 
          <td class='col-xs-6'><?php echo html::input('forumRec', isset($this->config->site->forumRec) ? $this->config->site->forumRec : '', "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->recPerPage->reply;?></th> 
          <td class='col-xs-6'><?php echo html::input('replyRec', isset($this->config->site->replyRec) ? $this->config->site->replyRec : '', "class='form-control'");?></td><td></td>
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
