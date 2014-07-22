<?php
/**
 * The settheme view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php $templateRoot = $webRoot . 'template/' . $config->site->template . '/';?>
<div class='panel'>
  <div class='panel-heading'><strong><?php echo $lang->ui->setTemplate;?></strong></div>
  <div class='panel-body'>
    <table class='table table-bordered table-hover'>
      <?php foreach($templates as $template):?>
      <tr>
        <td>
          <table class='table table-templateinfo'>
            <tr>
              <th class='w-60px text-center'><?php echo $lang->ui->template->name;?></th>
              <td>
                <?php echo $template['name']?>
                <?php if($config->site->template != $template['code']) echo html::a(inlink('setTemplate', "template={$template['code']}"), $lang->ui->template->enable, "class='btn btn-primary pull-right'");?>
              </td>
            </tr>
            <tr><th class='text-center'><?php echo $lang->ui->template->author;?></th><td><?php echo $template['author']?></td></tr>
            <tr><th class='text-center'><?php echo $lang->ui->template->desc;?></th><td><?php echo $template['desc']?></td></tr>
            <tr>
              <th class='w-80px text-center'><?php echo $lang->ui->template->theme;?></th>
              <td>
                <?php foreach($template['themes'] as $theme => $name):?>
                <?php
                $url = inlink('settheme', "template={$template['code']}&theme={$theme}");
                $previewImage = html::image($templateRoot . 'theme/' . $theme . '/preview.png');
                $currentClass = ($config->site->theme == $theme) ? 'btn-success' : '';
                echo html::a($url, $previewImage, "class='theme-preview btn btn-lg {$currentClass}' title='{$name}'") 
                ?>
                <?php endforeach;?>
              </td>
            </tr>
          </table>
        </td>
        <td class='w-p30 text-center'> <?php echo html::image($templateRoot . 'theme/' . $this->config->site->theme . '/preview.png', "class='w-p100'");?> </td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
