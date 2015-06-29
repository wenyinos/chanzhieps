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
          <th class='col-xs-2'><?php echo $lang->site->customizableList->article;?></th> 
          <td class='col-xs-6'><?php echo html::input('articleRec', !empty($this->config->site->articleRec) ? $this->config->site->articleRec : $this->config->article->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->customizableList->product;?></th> 
          <td class='col-xs-6'><?php echo html::input('productRec', !empty($this->config->site->productRec) ? $this->config->site->productRec : $this->config->product->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <?php if(strpos($this->config->site->modules, 'blog') !== false):?>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->customizableList->blog;?></th> 
          <td class='col-xs-6'><?php echo html::input('blogRec', !empty($this->config->site->blogRec) ? $this->config->site->blogRec : $this->config->blog->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <?php endif;?>
        <?php if(strpos($this->config->site->modules, 'message') !== false):?>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->customizableList->message;?></th> 
          <td class='col-xs-6'><?php echo html::input('messageRec', !empty($this->config->site->messageRec) ? $this->config->site->messageRec : $this->config->message->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->customizableList->comment;?></th> 
          <td class='col-xs-6'><?php echo html::input('commentRec', !empty($this->config->site->commentRec) ? $this->config->site->commentRec : $this->config->message->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <?php endif;?>
        <?php if(strpos($this->config->site->modules, 'forum') !== false):?>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->customizableList->forum;?></th> 
          <td class='col-xs-6'><?php echo html::input('forumRec', !empty($this->config->site->forumRec) ? $this->config->site->forumRec : $this->config->forum->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->customizableList->reply;?></th> 
          <td class='col-xs-6'><?php echo html::input('replyRec', !empty($this->config->site->replyRec) ? $this->config->site->replyRec : $this->config->reply->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <?php endif;?>
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
