<?php
/**
 * The admin browse view file of slide module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('sortTip', $lang->slide->sortTip) ?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-picture'></i> <?php echo $lang->slide->admin;?></strong>
    <div class='panel-actions'>
      <?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i> ' . $lang->slide->create, "class='btn btn-primary'");?>
    </div>
  </div>
  <form id='sortForm' action='<?php echo inLink('sort')?>' method='post'>
    <table class='table table-hover table-bordered'>
      <tbody>
        <?php foreach($slides as  $key => $slide):?>
        <?php if($slide->backgroundType == 'color') $slide->height = $slide->height ? $slide->height : 180; ?>
        <tr class='text-middle'>
          <td>
            <?php echo html::hidden("order[{$slide->id}]", $key);?> 
            <div class='carousel slide mg-0'>
              <div class='carousel-inner'>
                <?php if ($slide->backgroundType == 'image'): ?>
                <div class='item active'>
                  <?php print(html::image($slide->image));?>
                <?php else: ?>
                <div class='item active' style='<?php echo 'background-color: ' . $slide->backgroundColor . '; height: ' . $slide->height . 'px';?>'>
                <?php endif ?>
                  <div class='actions clearfix'>
                    <div class='pull-left'>
                      <button type='button' class='btn btn-pure icon-arrow-up'></button>
                      <button type='button' class='btn btn-pure icon-arrow-down'></button>
                    </div>
                    <div class='pull-right'>
                      <?php if ($slide->height): ?>
                      <span class='label'><?php echo $lang->slide->height . ': ' . $slide->height;?>px</span> &nbsp; &nbsp; 
                      <?php endif ?>
                      <button type='button' class='btn btn-pure btn-resize'><i class='icon-resize-full'></i></button>
                      <?php if ($slide->mainLink): ?>
                        <?php echo html::a($slide->mainLink, "<i class='icon-external-link'></i>", "class='btn btn-pure' title='{$lang->slide->mainLink}' target='_blank'") ?>
                      <?php endif ?>
                      <?php
                      echo html::a($this->createLink('slide', 'edit', "id=$slide->id"), "<i class='icon-pencil'></i>", "class='btn btn-pure' title='{$lang->edit}'");
                      echo html::a($this->createLink('slide', 'delete', "id=$slide->id"), "<i class='icon-remove'></i>", "class='deleter btn btn-pure' title='{$lang->delete}'");
                      ?>
                    </div>
                  </div>
                  <div class='carousel-caption'>
                    <h2 style='color:<?php echo $slide->titleColor;?>'><?php echo $slide->title;?></h2>
                    <div><?php echo $slide->summary;?></div>
                    <?php
                    foreach($slide->label as $key => $label):
                    if(trim($label) != '') echo html::a($slide->buttonUrl[$key], $label, "class='btn btn-lg btn-" . $slide->buttonClass[$key] . "'");
                    endforeach;
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
      <tfoot>
      <tr><td colspan='6'>&nbsp;<?php echo html::submitButton($this->lang->slide->saveSort);?></td></tr> 
      </tfoot>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
