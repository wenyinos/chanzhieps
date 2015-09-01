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
$lang->visual->config->powerby  = array('name' => "蝉知标识", 'title' => '移除蝉知标识', 'icon' => 'info-sign', 'width' => 600, 'actions' => array('edit' => '...'));
$lang->visual->config->navbar   = array('name' => "导航", 'width' => '80%');
$lang->visual->config->carousel = array('name' => "幻灯片", 'width' => 700, 'actions' => array('delete' => true, 'move' => true));
$lang->visual->config->block    = array('name' => "区块", 'width' => 800, 'actions' => array('delete' => true, 'move' => true));

$lang->visual->editpowerbycontent = "<p>蝉知企业门户系统是开源免费的，但根据我们的<a href='http://www.chanzhi.org/book/chanzhieps/58_license.html' target='_blank'>授权协议</a>，去除蝉知的标识需要购买我们的商业授权。</p><p>蝉知标识并不会影响网站功能，我们建议您保留。</p><hr><div class='text-center'><a class='btn btn-success' href='http://www.chanzhi.org/vip/25_vip-support.html' target='_blank'>了解蝉知系统商业服务列表和授权 <i class='icon-arrow-right'></i></a></div>";
