<a href='###' class='dropdown-toggle' data-toggle='dropdown' title='<?php echo $lang->setLang;?>'><i class='icon-globe icon-large'></i> &nbsp;<?php echo $config->langs[$this->cookie->lang]?><span class='caret'></span></a>
<ul class='dropdown-menu'>
  <?php
  $langs = $config->langs;
  unset($langs[$this->cookie->lang]);
  foreach($langs as $key => $currentLang) echo "<li><a rel='nofollow' href='javascript:selectLang(\"$key\")'>$currentLang</a></li>";
  ?>
</ul>