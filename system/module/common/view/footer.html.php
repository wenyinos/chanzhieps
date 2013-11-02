<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
  <hr/>
  <footer>
    <?php 
    echo "&copy; {$config->company->name} {$config->site->copyright}-" . date('Y') . '&nbsp;&nbsp;';
    echo $config->site->icp;
    printf($lang->poweredBy, $config->version, $config->version);
    if($this->app->getModuleName() != 'sitemap') echo html::a($this->createLink('sitemap', 'index'), $lang->sitemap->common);
    if($this->app->getModuleName() == 'sitemap') echo html::a($this->createLink('sitemap', 'index', '', '', 'xml'), $lang->sitemap->common);
    if(empty($this->config->links->index) && !empty($this->config->links->all)) echo "&nbsp;" . html::a($this->createLink('links', 'index'), $lang->link);
    ?>
  </footer>
   
<?php
if($config->debug) js::import($jsRoot . 'jquery/form/min.js');
if(isset($pageJS)) js::execute($pageJS);

/* Load hook files for current page. */
$extPath      = dirname(dirname(dirname(__FILE__))) . '/common/ext/view/';
$extHookRule  = $extPath . 'footer.front.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;

/* Load hook file for site.*/
$siteExtPath  = dirname(dirname(dirname(__FILE__))) . "/common/ext/_{$config->siteCode}/view/";
$extHookRule  = $siteExtPath . 'footer.front.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;
?>
</div>
</body>
</html>
