<?php
/**
 * The footer view file of blog category of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     blog
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
  </div><?php /* end .page-wrapper in header.html.php */ ?>
  <footer id='footer'>
    <div id='footNav'>
      <?php echo html::a(helper::createLink('rss', 'index', '', '', 'xml') . '?type=blog', '<i class="icon icon-rss-sign icon-large"></i>', "target='_blank'"); ?>
    </div>
    <span id='copyright'>
      <?php
      $copyright = empty($config->site->copyright) ? '' : $config->site->copyright . '-';
      echo "&copy; {$copyright}" . date('Y') . ' ' . $config->company->name . '&nbsp;&nbsp;';
      ?>
    </span>
    <span id='icpInfo'><?php echo $config->site->icp; ?></span>
    <div id='powerby'>
      <?php printf($lang->poweredBy, $config->version, commonModel::getSoftTitle(), $config->version);?>
    </div>
  </footer>
</div><?php /* end .page-container in header.html.php */ ?>
<?php
if($config->debug) js::import($jsRoot . 'jquery/form/min.js');
if(isset($pageJS)) js::execute($pageJS);
?>
</body>
</html>
