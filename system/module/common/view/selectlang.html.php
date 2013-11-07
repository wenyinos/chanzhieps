<span><?php echo $lang->setLang;?></span>
<div class='btn-group dropup'>
  <button class='btn dropdown-toggle' data-toggle='dropdown'><?php echo $config->langs[$this->cookie->lang]?><span class='caret'></span></button>
  <ul class='dropdown-menu'>
    <?php
    $langs = $config->langs;
    unset($langs[$this->cookie->lang]);
    foreach($langs as $key => $currentLang) echo "<li><a rel='nofollow' href='javascript:selectLang(\"$key\")'>$currentLang</a></li>";
    ?>
  </ul>
</div>
