<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
  <hr/>
  <?php if(RUN_MODE == 'front' and isset($layouts['all']['footer'])) echo $this->loadModel('block')->printRegion($layouts['all']['footer']);?>
  <footer>
    <?php 
    echo "&copy; {$config->company->name} {$config->site->copyright}-" . date('Y') . '&nbsp;&nbsp;';
    echo $config->site->icp;
    echo html::a($this->createLink('sitemap', 'index'), $lang->sitemap->common);
    if(empty($this->config->links->index) && !empty($this->config->links->all)) echo "&nbsp;" . html::a($this->createLink('links', 'index'), $lang->link);
    printf($lang->poweredBy, $config->version, $config->version);
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
<?php if(RUN_MODE == 'front' and isset($layouts['all']['end'])) echo $this->loadModel('block')->printRegion($layouts['all']['end']);?>
</body>
</html>
