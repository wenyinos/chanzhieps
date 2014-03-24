<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
  <?php if(RUN_MODE == 'front') $this->loadModel('block')->printRegion($layouts, 'all', 'footer');?>
  </div></div><?php /* end div.page-content then div.page-wrapper in header.html.php */?>
  <footer id='footer' class='clearfix'>
    <div class='wrapper'>
      <div id='footNav'>
        <?php
        echo html::a($this->createLink('sitemap', 'index'), "<i class='icon-sitemap'></i> " . $lang->sitemap->common, "class='text-link'");

        if(empty($this->config->links->index) && !empty($this->config->links->all)) echo '&nbsp;' . html::a($this->createLink('links', 'index'), "<i class='icon-link'></i> " . $this->lang->link);
        ?>
      </div>
      <span id='copyright'>
        <?php
        $copyright = empty($config->site->copyright) ? '' : $config->site->copyright . '-';
        echo "&copy; {$copyright}" . date('Y') . ' ' . $config->company->name . '&nbsp;&nbsp;';
        ?>
      </span>
      <span id='icpInfo'><?php echo $config->site->icp; ?></span>
      <div id='powerby'>
        <?php printf($lang->poweredBy, $config->version, k(), $config->version); ?>
      </div>
    </div>
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
$siteExtPath  = dirname(dirname(dirname(__FILE__))) . "/common/ext/_{$config->site->code}/view/";
$extHookRule  = $siteExtPath . 'footer.front.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;
$publicList = $this->loadModel('wechat')->getList();
?>
<a href='#' id='go2top' class='icon-arrow-up' data-toggle='tooltip' title='<?php echo $lang->back2Top; ?>'></a>
</div><?php /* end "div.page-container" in "header.html.php" */ ?>
<div id='rightDocker' class='hidden-xs'>
  <?php if(!empty($public) or extension_loaded('gd')):?>
  <button id='rightDockerBtn' class='btn' data-toggle="popover" data-placement="left" data-target='$next'><i class='icon-qrcode'></i></button>
  <?php endif;?>
  <div class='popover fade'>
    <div class='arrow'></div>
    <div class='popover-content docker-right'>
      <table class='table table-borderless'>
        <tr>
          <?php foreach($publicList as $public):?>
          <td>
            <div class='heading'><i class='icon-weixin'>&nbsp;</i> <?php echo $public->name;?></div>
            <?php echo html::image($public->qrcode);?>
          </td>
          <?php endforeach;?>
          <?php if(extension_loaded('gd')):?>
          <td>
            <div class='heading'><i class='icon-mobile-phone'></i> <?php echo $lang->qrcodeTip;?></div>
            <?php echo html::image($this->createLink('misc', 'qrcode'));?>
          </td>
          <?php endif;?>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php if(RUN_MODE == 'front') $this->loadModel('block')->printRegion($layouts, 'all', 'end');?>
</body>
</html>
