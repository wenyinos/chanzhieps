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
$lang->visual->customTheme       = "自定义主题";
$lang->visual->admin             = "后台";
$lang->visual->reload            = '刷新';
$lang->visual->createBlock       = '创建区块';
$lang->visual->manageBlock       = '区块管理';
$lang->visual->openInNewWindow   = '在新窗口中打开当前编辑页面';

$lang->visual->jsLang = new stdclass();
$lang->visual->jsLang->saved              = $lang->saveSuccess;
$lang->visual->jsLang->deleted            = $lang->deleteSuccess;
$lang->visual->jsLang->preview            = '预览';
$lang->visual->jsLang->exitPreview        = '取消预览';
$lang->visual->jsLang->removeBlock        = '移除区块';
$lang->visual->jsLang->invisible          = '不可见';
$lang->visual->jsLang->carousel           = '幻灯片';
$lang->visual->jsLang->operateFail        = '操作失败！';
$lang->visual->jsLang->addBlock           = '添加区块';
$lang->visual->jsLang->addSubRegion       = '添加布局区块';
$lang->visual->jsLang->addSubBlock        = '添加子区块';
$lang->visual->jsLang->subRegion          = '布局区块';
$lang->visual->jsLang->alreadyLastSlide   = '已是最后一张';
$lang->visual->jsLang->alreadyFirstSlide  = '已是第一张';
$lang->visual->jsLang->slideOrder         = '当前播放顺序';
$lang->visual->jsLang->gridWidth          = '栅格宽度';
$lang->visual->jsLang->actions            = array('edit' => '编辑', 'delete' => '删除', 'move' => '移动', 'add' => '添加');

$lang->visual->config           = new stdclass();
$lang->visual->config->logo     = array('name' => "Logo/名称", 'width' => 900, 'module' => 'visual', 'method' => 'editlogo');
$lang->visual->config->slogan   = array('name' => "口号", 'width' => 700, 'module' => 'visual', 'method' => 'editslogan');
$lang->visual->config->powerby  = array('name' => "蝉知标识", 'title' => '移除蝉知标识', 'width' => 600, 'actions' => array('edit' => array('icon' => 'info-sign', 'text' => '移除蝉知标识', 'module' => 'visual', 'method' => 'editpowerby')));
$lang->visual->config->company  = array('name' => "公司介绍", 'width' => 900, 'actions' => array('edit' => array('text' => '编辑公司介绍', 'method' => 'setbasic', 'params' => 'display=content')));
$lang->visual->config->companyName  = array('name' => "公司名称", 'width' => 900, 'actions' => array('edit' => array('module' => 'company', 'method' => 'setbasic', 'params' => 'display=name')));
$lang->visual->config->companyDesc  = array('name' => "公司简介", 'width' => 900, 'actions' => array('edit' => array('module' => 'company', 'method' => 'setbasic', 'params' => 'display=desc')));
$lang->visual->config->companyContact = array('name' => "联系方式", 'width' => 900, 'actions' => array('edit' => array('module' => 'company', 'method' => 'setcontact')));
$lang->visual->config->links = array('name' => "友情链接", 'width' => 900, 'actions' => array('edit' => array('module' => 'links', 'method' => 'admin')));
$lang->visual->config->navbar   = array('name' => "导航", 'width' => 1200, 'params' => 'type={type}', 'module' => 'nav', 'actions' => array('edit' => array('method' => 'admin')));
$lang->visual->config->carousel = array('hidden' => 'true', 'module' => 'slide', 'actions' => array('edit' => false),
    'groupActions' => array('add' => array('icon' => 'plus', 'text' => '添加一张幻灯片', 'method' => 'create', 'params' => 'groupID={id}')),
    'itemActions' => array(
        'edit'   => array('icon' => 'pencil', 'text' => '编辑', 'title' => '编辑幻灯片', 'method' => 'edit', 'params' => 'id={id}'),
        'delete' => array('icon' => 'remove', 'text' => '删除', 'method' => 'delete', 'params' => 'id={id}', 'confirm' => '是否删除此幻灯片？'),
        'up'     => array('icon' => 'arrow-left', 'text' => '播放顺序提前为 {0}', 'method' => 'sort'),
        'down'   => array('icon' => 'arrow-right', 'text' => '播放顺序延后为 {0}', 'method' => 'sort')
    ));
$lang->visual->config->block    = array('name' => "区块", 'width' => 1200, 'params' => 'blockID={id}', 'module' => 'visual',
    'actions' => array(
          'edit'    => array('module' => 'block'),
          'delete'  => array('method' => 'removeBlock', 'confirm' => '确定从布局中移除 {title}？', 'success' => '{title} 已被移除。', 'params' => 'blockID={id}&page={page}&region={region}'),
          'move'    => array('method' => 'sortblocks','success' => '排序已保存', 'params' => 'page={page}&region={region}&pagent={parent}'),
          'layout'  => array('method' => 'fixblock', 'width' => 600, 'text' => '更改布局', 'icon' => 'columns', 'success' => '布局已保存', 'params' => 'page={page}&region={region}&blockID={id}'),
          'add'     => array('method' => 'appendBlock', 'params' => 'page={page}&region={region}&parent={parent}', 'hidden' => true, 'width' => 1000, 'title' => '添加区块 {title}'),
          'create'  => array('method' => 'create', 'params' => 'type=html', 'module' => 'block', 'title' => '创建并添加区块', 'width' => 1000, 'hidden' => true)
));
$lang->visual->config->article  = array('params' => 'articleID={id}', 'name' => '文章',
    'actions' => array('delete' => true, 'edit' => array('params' => 'articleID={id}&type=article')));
$lang->visual->config->articles = array('name' => '文章列表', 'module' => 'article', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => '发布新文章', 'icon' => 'plus', 'method' => 'create', "params" => 'type=article', 'onDismiss' => 'reload')));
$lang->visual->config->page  = array('params' => 'articleID={id}', 'module' => 'article', 'name' => '单页',
    'actions' => array('delete' => true, 'edit' => array('params' => 'pageID={id}&type=page')));
$lang->visual->config->pageList = array('name' => '单页列表', 'module' => 'page', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => '发布新单页', 'icon' => 'plus', 'method' => 'create', "params" => 'type=page')));
$lang->visual->config->blog     = array('params' => 'articleID={id}', 'module' => 'article', 'name' => '博客',
    'actions' => array('delete' => true, 'edit' => array('params' => 'articleID={id}&type=blog')));
$lang->visual->config->blogList = array('name' => '博客列表', 'module' => 'article', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => '发布新博客', 'icon' => 'plus', 'method' => 'create', "params" => 'type=blog')));
$lang->visual->config->product  = array('params' => 'productID={id}', 'name' => '产品',
    'actions' => array('delete' => true, 'edit' => 'true'));
$lang->visual->config->products = array('name' => '产品列表', 'module' => 'product', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => '发布新产品', 'icon' => 'plus', 'method' => 'create', "params" => 'category=0', 'onDismiss' => 'reload')));
$lang->visual->config->books    = array('name' => '手册列表', 'module' => 'book', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => '添加手册', 'icon' => 'plus', 'method' => 'create', 'onDismiss' => 'reload')));
$lang->visual->config->bookCatalog = array('name' => "手册目录", 'width' => 1200, 'params' => 'bookID={id}', 'module' => 'book',
    'actions' => array('edit' => array('method' => 'admin', 'onDismiss' => 'update')));
$lang->visual->config->book = array('name' => "手册", 'width' => 1200, 'params' => 'nodeID={id}',
    'actions' => array('edit' => true));
$lang->visual->config->boards = array('name' => '论坛板块', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => '板块管理', 'icon' => 'sitemap', 'module' => 'tree', 'method' => 'browse', 'params' => 'type=forum', 'onDismiss' => 'update')));
$lang->visual->config->thread = array('name' => '帖子', 'params' => 'treadID={id}',
    'actions' => array('edit' => array('width' => 600, 'text' => '转移', 'icon' => 'location-arrow',  'method' => 'transfer', 'onDismiss' => 'reload'), 'delete' => true));

$lang->visual->editpowerbycontent = "<p>蝉知企业门户系统是开源免费的，但根据我们的<a href='http://www.chanzhi.org/book/chanzhieps/58_license.html' target='_blank'>授权协议</a>，去除蝉知的标识需要购买我们的商业授权。</p><p>蝉知标识并不会影响网站功能，我们建议您保留。</p><hr><div class='text-center'><a class='btn btn-success' href='http://www.chanzhi.org/vip/25_vip-support.html' target='_blank'>了解蝉知系统商业服务列表和授权 <i class='icon-arrow-right'></i></a></div>";
