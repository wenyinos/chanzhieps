<?php include '../../common/view/header.modal.html.php';?>
<form method='post' action='<?php echo inlink('create')?>' id='ajaxForm' class='form form-inline'>
  <table class='table table-form'>
    <tr>
      <th><?php echo $lang->user->account;?></th>
      <td><?php echo html::input('account', '', "class='form-control'")?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->admin;?></th>
      <td><?php echo html::select('admin', $lang->user->adminList, '', "class='form-control'")?></td><td></td>
    </tr>  
    <tr>
      <th class='w-100px'><?php echo $lang->user->realname;?></th>
      <td class='w-p60'>
        <?php echo html::input("realname", '', "class='form-control'")?>
        <div class='multi'>
          <?php if(count(explode(',', $this->config->site->lang)) > 1):?>
          <div class='input-group'>
            <?php if(strpos($this->config->site->lang, 'zh-cn') !== false):?>
            <label class='input-group-addon'><?php echo $config->langs['zh-cn']?></label>
            <?php echo html::input("realnames[cn]", '', "class='form-control'");?>
            <?php endif;?>
            <?php if(strpos($this->config->site->lang, 'zh-tw') !== false):?>
            <label class='input-group-addon'><?php echo $config->langs['zh-tw'];?></label>
            <?php echo html::input("realnames[tw]", '', "class='form-control'");?>
            <?php endif;?>
            <?php if(strpos($this->config->site->lang, 'en') !== false):?>
            <label class='input-group-addon'><?php echo $config->langs['en']?></label>
            <?php echo html::input("realnames[en]", '', "class='form-control'");?>
            <?php endif;?>
          </div>
          <?php else:?>
          <?php $clientLang = $this->config->site->lang;?>
          <?php $clientLang = strpos($clientLang, 'zh-') !== false ? str_replace('zh-', '', $clientLang) : $clientLang;?>
          <?php echo html::input("realnames[{$clientLang}]", '', "class='form-control'")?>
          <?php endif;?>
        </div>
      </td>
      <td></td>
    </tr>
    <tr class="groups">
      <th><?php echo $lang->user->privilege;?></th>
      <td><?php echo html::checkbox('groups', $groups, '');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->email;?></th>
      <td><?php echo html::input('email', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->password;?></th>
      <td><?php echo html::password('password1', '', "class='form-control' autocomplete='off'")?></td><td><span class='text-info'><?php echo $lang->user->control->lblPassword; ?></span></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->password2;?></th>
      <td><?php echo html::password('password2', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->guarder->password;?></th>
      <td class='w-200px'>
        <?php echo html::password('password', '', "placeholder='{$lang->guarder->passwordHolder}' class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th></th>
      <td colspan="2"><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>        
<?php include '../../common/view/footer.modal.html.php';?>
