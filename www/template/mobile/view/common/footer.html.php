<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<div class='block-region region-all-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'all', 'bottom');?></div>
<div class='appinfo'>
  <div class='copyright'>
    <?php
      $copyright = empty($config->site->copyright) ? '' : $config->site->copyright . '-';
      $contact   = json_decode($config->company->contact); 
      $company   = (empty($contact->site) or $contact->site == $this->server->http_host) ? $config->company->name : html::a('http://' . $contact->site, $config->company->name, "target='_blank'");
      echo "&copy; {$copyright}" . date('Y') . ' ' . $company . '&nbsp;&nbsp;';
      ?>
  </div>
  <div class='icpinfo'>
    <?php if(!empty($config->site->icpLink) and !empty($config->site->icpSN)) echo html::a(strpos($config->site->icpLink, 'http://') !== false ? $config->site->icpLink : 'http://' . $config->site->icpLink, $config->site->icpSN, "target='_blank'");?>
    <?php if(empty($config->site->icpLink) and !empty($config->site->icpSN))  echo $config->site->icpSN;?>
  </div>
  <div class='powerby'>
    <?php printf($lang->poweredBy, $config->version, k(), "<object data='{$templateCommonRoot}img/chanzhi.xml' type='image/svg+xml'>{$lang->chanzhiEPSx}</object> <span class='name hide'>" . $lang->chanzhiEPSx . '</span>' . $config->version); ?>
  </div>
</div>

<footer  class="appbar fix-bottom">
  <ul class="nav">
    <li><?php echo html::a($this->createLink('company', 'contact'), "<i class='icon icon-comments-alt'></i> {$lang->company->contactUs}", "class='text-primary' data-toggle='modal'");?></li>
    <li><?php echo html::a($this->createLink('company', 'index'), "<i class='icon icon-group'></i> {$lang->aboutUs}", "class='text-important' data-toggle='modal'");?></li>
  </ul>
</footer>
<?php
if(isset($pageJS)) js::execute($pageJS);

/* Load hook files for current page. */
$extPath      = dirname(__FILE__) . '/ext/';
$extHookRule  = $extPath . 'footer.front.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;

/* Load hook file for site.*/
$siteExtPath  = dirname(__FILE__) . DS . "ext/_{$config->site->code}/";
$extHookRule  = $siteExtPath . 'footer.front.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;
?>
<div class='block-region region-footer hidden'><?php $this->loadModel('block')->printRegion($layouts, 'all', 'footer');?></div>
</body>
</html>
