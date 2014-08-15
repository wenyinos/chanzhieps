<?php
/**
 * The edit view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php
js::set('type', $type);
js::set('cancreatephp', isset($canCreatePHP) ? $canCreatePHP : '');
js::set('setOkFile', isset($okFile) ? sprintf($lang->block->setOkFile, $okFile) : '');

$colorPlates = '';
foreach (explode('|', $lang->block->colorPlates) as $value)
{
    $colorPlates .= "<div class='color color-tile' data='#" . $value . "'><i class='icon-ok'></i></div>";
}
?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->block->edit;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm'>
      <table align='center' class='table table-form'>
        <tr>
          <th class='w-80px'><?php echo $lang->block->type;?></th>
          <td><?php echo $this->block->createTypeSelector($template, $type, $block->id);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->block->title;?></th>
          <td>
            <?php if(strpos(',htmlcode, phpcode, featuredProduct, slide, header', $type) !== false and $type != 'html'):?>
            <?php echo html::input('title', $block->title, "class='form-control'");?>
            <?php else:?>
            <div class='row'>
              <div class='col-sm-6'><?php echo html::input('title', $block->title, "class='form-control'");?></div>
              <div class='col-sm-6'>
                <div class='colorplate clearfix'>
                  <div class='input-group color active' data="<?php echo isset($block->content->titleColor) ? $block->content->titleColor : ''?>">
                    <?php echo html::input('params[titleColor]', isset($block->content->titleColor) ? $block->content->titleColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->color;?><span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                  </div>
                </div>
                <div class='colorplate clearfix'>
                  <div class='input-group color active' data="<?php echo isset($block->content->titleBackground) ? $block->content->titleBackground : ''?>">
                    <?php echo html::input('params[titleBackground]', isset($block->content->titleBackground) ? $block->content->titleBackground : '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->backgroundColor;?><span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <?php endif;?>
          </td>
        </tr>
        <?php if(isset($config->block->defaultIcons[$type])):?>
        <?php if(!isset($block->content->icon)) $block->content->icon = $config->block->defaultIcons[$type];?>
        <tr>
          <th><?php echo $lang->block->icon;?></th>
          <td>
            <div class='row'>
              <div class='col-sm-6'><?php echo html::select('params[icon]', '', '', "class='chosen-icons' data-value='{$block->content->icon}'");?></div>
              <div class='col-sm-6'>
                <div class='colorplate clearfix'>
                  <div class='input-group color active' data="<?php echo isset($block->content->iconColor) ? $block->content->iconColor : ''?>">
                    <?php echo html::input('params[iconColor]', isset($block->content->iconColor) ? $block->content->iconColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->iconColor;?><span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <?php endif;?>
        <?php if(strpos(',htmlcode, phpcode, slide, header, wechat', $type) == false or $type == 'html'):?>
        <tr>
          <th><?php echo $lang->block->color;?></th>
          <td>
            <div class='colorplate clearfix'>
              <div class='input-group color active' data="<?php echo isset($block->content->backgroundColor) ? $block->content->backgroundColor : ''?>">
                <?php echo html::input('params[backgroundColor]', isset($block->content->backgroundColor) ? $block->content->backgroundColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                <span class='input-group-btn'>
                  <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                    <?php echo $lang->block->backgroundColor;?><span class='caret'></span>
                  </button>
                  <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                </span>
              </div>
            </div>
            <div class='colorplate clearfix'>
              <div class='input-group color active' data="<?php echo isset($block->content->textColor) ? $block->content->textColor : ''?>">
                <?php echo html::input('params[textColor]', isset($block->content->textColor) ? $block->content->textColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                <span class='input-group-btn'>
                  <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                    <?php echo $lang->block->textColor;?><span class='caret'></span>
                  </button>
                  <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                </span>
              </div>
            </div>
            <div class='colorplate clearfix'>
              <div class='input-group color active' data="<?php echo isset($block->content->borderColor) ? $block->content->borderColor : ''?>">
                <?php echo html::input('params[borderColor]', isset($block->content->borderColor) ? $block->content->borderColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                <span class='input-group-btn'>
                  <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                    <?php echo $lang->block->borderColor;?><span class='caret'></span>
                  </button>
                  <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                </span>
              </div>
            </div>
            <div class='colorplate clearfix'>
              <div class='input-group color active' data="<?php echo isset($block->content->linkColor) ? $block->content->linkColor : ''?>">
                <?php echo html::input('params[linkColor]', isset($block->content->linkColor) ? $block->content->linkColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                <span class='input-group-btn'>
                  <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                    <?php echo $lang->block->linkColor;?><span class='caret'></span>
                  </button>
                  <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                </span>
              </div>
            </div>
          </td>
        </tr>
        <?php endif;?>
        <?php echo $this->fetch('block', 'blockForm', 'type=' . $type . '&id=' . $block->id);?>
        <?php if(isset($config->block->defaultMoreUrl[$block->type])):?>
        <tr>
          <th><?php echo $lang->block->moreLink;?></th>
          <td>
            <div class='input-group'>
              <?php echo html::input('params[moreText]', $block->content->moreText, "class='form-control'  placeholder='{$lang->block->placeholder->moreText}'");?>
              <span class="input-group-addon fix-border"><i class="icon icon-link"></i></span>
              <?php echo html::input('params[moreUrl]', $block->content->moreUrl, "class='form-control' placeholder='{$lang->block->placeholder->moreUrl}'");?>
          </td>
        </tr>
        <?php endif;?>
        <tr>
          <td></td>
          <td>
            <div class='form-action'>
              <?php echo html::submitButton() . html::hidden('blockID', $block->id);?>
              <?php echo html::a($this->session->blockList, $this->lang->goback, "class='btn btn-default btn-cancel'");?>
            </div>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
