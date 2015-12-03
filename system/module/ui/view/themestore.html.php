<?php
/**
 * The obtain view file of theme module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @theme     theme
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<div class='row'>
  <div class='col-md-2'>
    <div class='panel panel-sm'>
      <div class='panel-heading'><?php echo $lang->package->byIndustry;?></div>
      <div class='panel-body'>
        <?php $industryTree ? print($industryTree) : print($lang->theme->errorGetModules);?>
      </div>
    </div>
    <div class='panel panel-sm'>
      <div class='panel-heading'><?php echo $lang->package->byColor;?></div>
      <div class='panel-body'>
        <dl class='color-list' style='padding:0 10px;'>
          <?php foreach($lang->ui->themeColors as $color):?>
          <?php $url = inlink('themestore', "type=bycolor&param={$color}");?>
          <a href='<?php echo $url?>'><dd class='colorbox' style='background:#<?php echo $color?>'>&nbsp;</dd></a>
          <?php endforeach;?>
        </dl>
      </div>
    </div>
  </div>
  <div class='col-md-10'>
    <?php if($themes):?>
    <div class='cards pd-0 mg-0'>
    <?php foreach($themes as $theme):?>
      <?php 
      $currentRelease = $theme->currentRelease;
      $latestRelease  = isset($theme->latestRelease) ? $theme->latestRelease : '';
      ?>
      <div class='card'>
      <?php if(isset($theme->image)):?><div class='col-md-2'> <?php echo html::image("http://www.chanzhi.com/data/upload/" . $theme->image);?> </div><?php endif;?>
        <div class='col-md-10'>
        <div class='card-heading'>
          <small class='pull-right text-important'>
            <?php 
            if($latestRelease and $latestRelease->releaseVersion != $currentRelease->releaseVersion) 
            {
                printf($lang->theme->latest, $latestRelease->viewLink, $latestRelease->releaseVersion, $latestRelease->zentaoCompatible);
            }?>
          </small>
          <h5 class='mg-0'><?php echo $theme->name . "($currentRelease->releaseVersion)";?></h5>
        </div>
        <div class='card-content text-muted'>
          <?php echo $theme->abstract;?>
        </div>
        <div class='card-actions'>
          <div style='margin-bottom: 10px'>
            <?php
            echo "{$lang->package->author}:     {$theme->author} ";
            echo "{$lang->package->downloads}:  {$theme->downloads} ";
            echo "{$lang->package->compatible}: {$lang->package->compatibleList[$currentRelease->compatible]} ";
            
            echo " {$lang->package->depends}: ";
            if(!empty($currentRelease->depends))
            {
                foreach(json_decode($currentRelease->depends) as $code => $limit)
                {
                    echo $code;
                    if($limit != 'all')
                    {
                        echo '(';
                        if(!empty($limit['min'])) echo '>= v' . $limit['min'];
                        if(!empty($limit['max'])) echo '<= v' . $limit['min'];
                        echo ')';
                    }
                    echo ' ';
                }
            }
            ?>
          </div>
          <?php echo "{$lang->package->grade}: ",   html::printStars($theme->stars); ?>
          <div class='pull-right' style='margin-top: -15px'>
            <div class='btn-group'>
            <?php
            echo html::a($theme->viewLink, $lang->package->view, 'class="btn theme" target="_blank"');
            if($currentRelease->public)
            {
                if($theme->type != 'computer' and $theme->type != 'mobile')
                {
                    if(isset($installeds[$theme->code]))
                    {
                        if($installeds[$theme->code]->version != $theme->latestRelease->releaseVersion and $this->theme->checkVersion($theme->latestRelease->chanzhiCompatible))
                        {
                            commonModel::printLink('theme', 'upgrade', "theme=$theme->code&downLink=" . helper::safe64Encode($currentRelease->downLink) . "&md5=$currentRelease->md5&type=$theme->type", $lang->theme->upgrade, "class='btn' data-toggle='modal'");
                        }
                        else
                        {
                            echo html::a('javascript:;', $lang->theme->installed, "class='btn disabled'");
                        }
                    }
                    else
                    {
                        $label = $currentRelease->compatible ? $lang->package->installAuto : $lang->package->installForce;
                        commonModel::printLink('package', 'install',  "theme=$theme->code&downLink=" . helper::safe64Encode($currentRelease->downLink) . "&md5={$currentRelease->md5}&type=$theme->type&overridePackage=no&ignoreCompitable=yes", $label, "data-toggle='modal' class='btn'");
                    }
                }
            }
            echo html::a($currentRelease->downLink, $lang->package->downloadAB, 'class="manual btn"');
            echo html::a($theme->site, $lang->package->site, "class='btn' target='_blank'");
            ?>
            </div>
          </div>
        </div>
        </div>
      </div>
    <?php endforeach;?>
    </div>
    <?php if($pager):?>
    <div class='clearfix'>
      <?php $pager->show()?>
    </div>
    <?php endif; ?>
    <?php else:?>
    <div class='alert alert-default'>
      <i class='icon icon-remove-sign'></i>
      <div class='content'>
        <h4><?php echo $lang->package->errorOccurs;?></h4>
        <div><?php echo $lang->package->errorGetPackages;?></div>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>
<script>
$('#<?php echo $type;?>').addClass('active')
$('#module<?php echo $moduleID;?>').addClass('active')
</script>
<?php include '../../common/view/footer.admin.html.php';?>
