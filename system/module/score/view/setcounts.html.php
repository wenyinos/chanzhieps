<?php
/**
 * The xxx view file of xxx module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     xxx
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<form method='post' action='<?php echo inlink('setCounts');?>' id='ajaxForm' class='form'>
<table class='table table-form borderless'>
  <tbody class="scoreCounts <?php if(isset($this->config->site->score) and $this->config->site->score == 'close') echo 'hide';?>">
    <tr>
      <th class='w-80px'><?php echo $lang->score->methods['register'];?></th> 
      <td><?php echo html::input('register', $this->config->score->counts->register, "class='form-control'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->score->methods['login'];?></th> 
      <td><?php echo html::input('login', $this->config->score->counts->login, "class='form-control'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->score->methods['maxlogin'];?></th> 
      <td><?php echo html::input('maxLogin', $this->config->score->counts->maxLogin, "class='form-control'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->score->methods['thread'];?></th> 
      <td><?php echo html::input('thread', $this->config->score->counts->thread, "class='form-control'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->score->methods['reply'];?></th> 
      <td><?php echo html::input('reply', $this->config->score->counts->reply, "class='form-control'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->score->methods['delthread'];?></th> 
      <td><?php echo html::input('delThread', $this->config->score->counts->delThread, "class='form-control'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->score->methods['delreply'];?></th> 
      <td><?php echo html::input('delReply', $this->config->score->counts->delReply, "class='form-control'");?></td><td></td>
    </tr>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </tbody>
</table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>

