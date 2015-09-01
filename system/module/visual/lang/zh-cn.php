<?php
/**
 * The site module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */

$lang->visual->common  = "可视化编辑";

$lang->visual->info    = "您正在编辑网站";
$lang->visual->preview = "预览";
$lang->visual->exit    = "退出";

$lang->visual->actionsName = array('edit' => '编辑', 'delete' => '删除', 'move' => '移动');

$lang->visual->config           = new stdclass();
$lang->visual->config->logo     = array('name' => "Logo/名称", 'width' => 900);
$lang->visual->config->slogan   = array('name' => "口号", 'width' => 700, 'actions' => array('delete' => true, 'move' => true));
$lang->visual->config->navbar   = array('name' => "导航", 'width' => '80%');
$lang->visual->config->carousel = array('name' => "幻灯片", 'width' => 700, 'actions' => array('delete' => true, 'move' => true));
$lang->visual->config->block    = array('name' => "区块", 'width' => 800, 'actions' => array('delete' => true, 'move' => true));
