<footer  class="appbar fix-bottom">
  <ul class="nav">
    <li><?php echo html::a(helper::createLink('rss', 'index', '?type=blog', '', 'xml'), "<i class='icon-rss text-warning'></i> " . $lang->blog->subscribe, "target='_blank' class='text-important'"); ?></li>
    <?php if(!isset($this->config->site->type) or $this->config->site->type != 'blog'):?>
    <li><?php echo html::a($config->webRoot, "<i class='icon icon-home'></i> {$lang->blog->siteHome}", "class='text-primary'");?></li>
    <?php endif; ?>
  </ul>
</footer>
<?php
if(isset($pageJS)) js::execute($pageJS);
?>
</body>
</html>
