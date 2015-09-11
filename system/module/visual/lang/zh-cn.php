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

$lang->visual->info              = "编辑模式";
$lang->visual->preview           = "预览";
$lang->visual->exit              = "退出";
$lang->visual->exitVisualEdit    = "关闭编辑模式";
$lang->visual->admin             = "后台";
$lang->visual->reload            = '刷新';

$lang->visual->jsLang = new stdclass();
$lang->visual->jsLang->saved       = $lang->saveSuccess;
$lang->visual->jsLang->deleted     = $lang->deleteSuccess;
$lang->visual->jsLang->preview     = '预览';
$lang->visual->jsLang->exitPreview = '取消预览';
$lang->visual->jsLang->removeBlock = '移除区块';
$lang->visual->jsLang->invisible   = '不可见';
$lang->visual->jsLang->carousel    = '幻灯片';
$lang->visual->jsLang->operateFail = '操作失败！';
$lang->visual->jsLang->addBlock    = '新增区块';
$lang->visual->jsLang->actions     = array('edit' => '编辑', 'delete' => '删除', 'move' => '移动', 'add' => '添加');

$lang->visual->config           = new stdclass();
$lang->visual->config->logo     = array('name' => "Logo/名称", 'width' => 900);
$lang->visual->config->slogan   = array('name' => "口号", 'width' => 700);
$lang->visual->config->powerby  = array('name' => "蝉知标识", 'title' => '移除蝉知标识', 'width' => 600, 'actions' => array('edit' => array('icon' => 'info-sign', 'text' => '移除蝉知标识')));
$lang->visual->config->navbar   = array('name' => "导航", 'width' => 1200, 'params' => 'type={type}', 'module' => 'nav', 'actions' => array('edit' => array('method' => 'admin')));
$lang->visual->config->block    = array('name' => "区块", 'width' => 1200, 'params' => 'blockID={id}',
    'actions' => array(
          'delete' => array('confirm' => '确定从布局中移除 【{title}】？', 'success' => '【{title}】已被移除。', 'params' => 'region={region}&blockID={id}'),
          'move' => array('success' => '排序已保存', 'params' => 'region={region}'),
          'layout' => array('width' => 600, 'text' => '更改布局', 'icon' => 'columns', 'success' => '布局已保存', 'params' => 'region={region}&blockID={id}'),
          'add' => array('params' => 'region={region}', 'hidden' => true, 'width' => 1000)
));
$lang->visual->config->article  = array('params' => 'articleID={id}', 'module' => 'article', 'name' => '文章',
    'actions' => array('delete' => array('method' => 'delete'), 'edit' => array('method' => 'edit', 'params' => 'articleID={id}&type=article')));
$lang->visual->config->articles = array('name' => '文章列表', 'module' => 'article', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => '发布新文章', 'icon' => 'plus', 'method' => 'create', "params" => 'type=article')));
$lang->visual->config->blog     = array('params' => 'articleID={id}', 'module' => 'article', 'name' => '博客',
    'actions' => array('delete' => array('method' => 'delete'), 'edit' => array('method' => 'edit', 'params' => 'articleID={id}&type=blog')));
$lang->visual->config->blogList = array('name' => '博客列表', 'module' => 'article', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => '发布新博客', 'icon' => 'plus', 'method' => 'create', "params" => 'type=blog')));


$lang->visual->editpowerbycontent = "<p>蝉知企业门户系统是开源免费的，但根据我们的<a href='http://www.chanzhi.org/book/chanzhieps/58_license.html' target='_blank'>授权协议</a>，去除蝉知的标识需要购买我们的商业授权。</p><p>蝉知标识并不会影响网站功能，我们建议您保留。</p><hr><div class='text-center'><a class='btn btn-success' href='http://www.chanzhi.org/vip/25_vip-support.html' target='_blank'>了解蝉知系统商业服务列表和授权 <i class='icon-arrow-right'></i></a></div>";
