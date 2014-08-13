<?php
/**
 * The create view file of block module of chanzhiEPS.
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
  <div class='panel-heading'>
    <strong><i class='icon-plus'></i> <?php echo $lang->block->create;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm'>
      <table align='center' class='table table-form'>
        <tr>
          <th class='w-80px'><?php echo $lang->block->type;?></th>
          <td><?php echo $this->block->createTypeSelector($template, $type);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->block->title;?></th>
          <td>
            <?php if(strpos(',htmlcode, phpcode, featuredProduct, slide, header', $type) !== false):?>
            <?php echo html::input('title', strpos(',html,htmlcode,featuredProduct,phpcode,', $type) == false ?  $lang->block->$template->typeList[$type] : '', "class='form-control'");?></div>
            <?php else:?>
            <div class='row'>
              <div class='col-sm-6'><?php echo html::input('title', strpos(',html,htmlcode,featuredProduct,', $type) == false ?  $lang->block->$template->typeList[$type] : '', "class='form-control'");?></div>
              <div class='col-sm-6'>
                <div class='colorplate clearfix'>
                  <div class='input-group color active'>
                    <?php echo html::input('params[titleColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->color;?><span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                  </div>
                </div>
                <div class='colorplate clearfix'>
                  <div class='input-group color active'>
                    <?php echo html::input('params[titleBackground]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
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
        <tr>
          <th><?php echo $lang->block->icon;?></th>
          <td>
            <div class='row'>
              <div class='col-sm-6'><?php echo html::select('params[icon]', '', '', "class='chosen-icons' data-value='{$config->block->defaultIcons[$type]}'");?></div>
              <div class='col-sm-6'>
                <div class='colorplate clearfix'>
                  <div class='input-group color active'>
                    <?php echo html::input('params[iconColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
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
        <?php if(strpos(',htmlcode, phpcode, slide, header', $type) == false):?>
        <tr>
          <th><?php echo $lang->block->color;?></th>
          <td>
            <div class='colorplate clearfix'>
              <div class='input-group color active'>
                <?php echo html::input('params[backgroundColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                <span class='input-group-btn'>
                  <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                    <?php echo $lang->block->backgroundColor;?><span class='caret'></span>
                  </button>
                  <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                </span>
              </div>
            </div>
            <div class='colorplate clearfix'>
              <div class='input-group color active'>
                <?php echo html::input('params[textColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                <span class='input-group-btn'>
                  <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                    <?php echo $lang->block->textColor;?><span class='caret'></span>
                  </button>
                  <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                </span>
              </div>
            </div>
            <div class='colorplate clearfix'>
              <div class='input-group color active'>
                <?php echo html::input('params[borderColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
                <span class='input-group-btn'>
                  <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                    <?php echo $lang->block->borderColor;?><span class='caret'></span>
                  </button>
                  <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                </span>
              </div>
            </div>
            <div class='colorplate clearfix'>
              <div class='input-group color active'>
                <?php echo html::input('params[linkColor]', '', "class='form-control input-color text-latin' placeholder='" . $lang->block->colorTip . "'");?>
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
        <?php echo $this->fetch('block', 'blockForm', 'type=' . $type);?>
        <?php if(isset($config->block->defaultMoreUrl[$type])):?>
        <tr>
          <th><?php echo $lang->block->moreLink;?></th>
          <td>
            <div class='input-group'>
              <?php echo html::input('params[moreText]', $lang->more, "class='form-control'  placeholder='{$lang->block->placeholder->moreText}'");?>
              <span class="input-group-addon fix-border"><i class="icon icon-link"></i></span>
              <?php echo html::input('params[moreUrl]', $config->block->defaultMoreUrl[$type], "class='form-control' placeholder='{$lang->block->placeholder->moreUrl}'");?>
          </td>
        </tr>
        <?php endif;?>
        <tbody id='blockForm'></tbody>
        <tr>
          <th></th>
          <td>
            <?php echo html::submitButton();?>
            <?php echo html::a($this->session->blockList, $this->lang->goback, "class='btn btn-default'");?>
            <?php if($type == 'phpcode'):?>
            <strong class='text-info'>&nbsp;&nbsp;<?php echo $lang->block->noPhpTag;?></strong>
            <?php endif;?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
