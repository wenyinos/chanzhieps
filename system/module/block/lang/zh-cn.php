<?php
/**
 * The block module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->block->common          = '区块维护';
$lang->block->id              = '编号';
$lang->block->title           = '名称';
$lang->block->limit           = '数量';
$lang->block->type            = '类型';
$lang->block->code            = '代码';
$lang->block->phpcode         = 'php代码';
$lang->block->content         = '内容';
$lang->block->moreLink        = '更多链接';
$lang->block->page            = '页面';
$lang->block->regionList      = '区域列表';
$lang->block->select          = '请选择区块';
$lang->block->categories      = '分类';
$lang->block->showImage       = '显示图片';
$lang->block->showTime        = '显示时间';
$lang->block->product         = '产品';
$lang->block->titleless       = '隐藏标题';
$lang->block->borderless      = '隐藏边框';
$lang->block->icon            = '图标';
$lang->block->grid            = '宽度';
$lang->block->more            = '更多';
$lang->block->color           = '颜色';
$lang->block->titleColor      = '名称颜色';
$lang->block->titleBackground = '名称背景';
$lang->block->backgroundColor = '背景颜色';
$lang->block->textColor       = '文字颜色';
$lang->block->borderColor     = '边框颜色';
$lang->block->linkColor       = '链接颜色';
$lang->block->iconColor       = '图标颜色';

$lang->block->add          = "添加";
$lang->block->template     = "模板";
$lang->block->create       = '添加区块';
$lang->block->browseBlocks = '区块列表';
$lang->block->browseRegion = '布局设置';
$lang->block->edit         = '编辑区块';
$lang->block->view         = '查看区块';
$lang->block->setPage      = '配置页面';

$lang->block->placeholder = new stdclass();
$lang->block->placeholder->moreText = '区块右上角文字';
$lang->block->placeholder->moreUrl  = '区块右上角链接地址';

$lang->block->noPhpTag = '不需要&lt;?php ?&gt;';

$lang->block->setOkFile = <<<EOT
<div class='alert'>
<h5>请按照下面的步骤操作以确认您的管理员身份。</h5>
<p>创建 <input value='%s' readonly class='autoSelect red'/> 文件。如果存在该文件，使用编辑软件打开，重新保存一遍。</p>
</div>
EOT;

$lang->block->gridOptions[0]  = '自动';
$lang->block->gridOptions[6]  = '1/2';
$lang->block->gridOptions[4]  = '1/3';
$lang->block->gridOptions[8]  = '2/3';
$lang->block->gridOptions[3]  = '1/4';
$lang->block->gridOptions[9]  = '3/4';
$lang->block->gridOptions[12] = '100%';

$lang->block->colorTip    = '十六进制颜色值';
$lang->block->colorPlates = '333333|000000|CA1407|45872B|148D00|F25D03|2286D2|D92958|A63268|04BFAD|D1270A|FF9400|299182|63731A|3D4DBE|7382D9|754FB9|F2E205|B1C502|364245|C05036|8A342A|E0DDA2|B3D465|EEEEEE|FFD0E5|D0FFFD|FFFF84|F4E6AE|E5E5E5|F1F1F1|FFFFFF';

$lang->block->default = new stdclass();
$lang->block->default->typeList['html']    = '自定义区块';
$lang->block->default->typeList['code']    = '源代码';
$lang->block->default->typeList['phpcode'] = 'php源代码';

$lang->block->default->typeList['latestArticle']   = '最新文章';
$lang->block->default->typeList['hotArticle']      = '热门文章';

$lang->block->default->typeList['latestProduct']   = '最新产品';
$lang->block->default->typeList['featuredProduct'] = '首页推荐产品';
$lang->block->default->typeList['hotProduct']      = '热门产品';

$lang->block->default->typeList['articleTree']     = '文章分类';
$lang->block->default->typeList['productTree']     = '产品分类';
$lang->block->default->typeList['blogTree']        = '博客分类';

$lang->block->default->typeList['contact']         = '联系我们';
$lang->block->default->typeList['about']           = '公司简介';
$lang->block->default->typeList['links']           = '友情链接';
$lang->block->default->typeList['slide']           = '幻灯片';
$lang->block->default->typeList['header']          = '网站头部';

$lang->block->default->typeGroups = array();
$lang->block->default->typeGroups['html']    = 'input';
$lang->block->default->typeGroups['code']    = 'input';
$lang->block->default->typeGroups['phpcode'] = 'input';

$lang->block->default->typeGroups['latestArticle'] = 'article';
$lang->block->default->typeGroups['hotArticle']    = 'article';

$lang->block->default->typeGroups['latestProduct']   = 'product';
$lang->block->default->typeGroups['featuredProduct'] = 'product';
$lang->block->default->typeGroups['hotProduct']      = 'product';

$lang->block->default->typeGroups['articleTree'] = 'category';
$lang->block->default->typeGroups['productTree'] = 'category';
$lang->block->default->typeGroups['blogTree']    = 'category';

$lang->block->default->typeGroups['contact'] = 'system';
$lang->block->default->typeGroups['about']   = 'system';
$lang->block->default->typeGroups['links']   = 'system';
$lang->block->default->typeGroups['slide']   = 'system';
$lang->block->default->typeGroups['header']  = 'system';

$lang->block->category = new stdclass();
$lang->block->category->showChildren = '显示子分类';

$lang->block->category->showChildrenList[1] = '是';
$lang->block->category->showChildrenList[0] = '否';

$lang->block->default->pages['all']            = '全部页面';
$lang->block->default->pages['index_index']    = '首页';

$lang->block->default->pages['article_browse'] = '文章列表页面';
$lang->block->default->pages['article_view']   = '文章详情页面';

$lang->block->default->pages['product_browse'] = '产品列表页面';
$lang->block->default->pages['product_view']   = '产品详情页面';

$lang->block->default->pages['blog_index']     = '博客列表页面';
$lang->block->default->pages['blog_view']      = '博客详情页面';

$lang->block->default->pages['forum_index']    = '论坛首页';
$lang->block->default->pages['forum_board']    = '帖子列表页面';
$lang->block->default->pages['thread_view']    = '帖子查看页面';
$lang->block->default->pages['search_list']    = '搜索结果页';

$lang->block->default->pages['book_index']     = '手册中心';
$lang->block->default->pages['book_browse']    = '手册首页';
$lang->block->default->pages['book_read']      = '手册章节';

$lang->block->default->pages['message_index']  = '留言';

$lang->block->default->pages['page_view']      = '单页';

/* page layout list. */
$lang->block->default->regions = new stdclass();
$lang->block->default->regions->all['header'] = 'Header(不可见)';
$lang->block->default->regions->all['top']    = '页头';
$lang->block->default->regions->all['bottom'] = '页尾';
$lang->block->default->regions->all['footer'] = 'Footer(不可见)';

$lang->block->default->regions->index_index['top']     = '上部';
$lang->block->default->regions->index_index['middle']  = '中部';
$lang->block->default->regions->index_index['bottom']  = '底部';

$lang->block->default->regions->article_browse['side'] = '侧边';
$lang->block->default->regions->article_view['side']   = '侧边';

$lang->block->default->regions->product_browse['side'] = '侧边';
$lang->block->default->regions->product_view['side']   = '侧边';

$lang->block->default->regions->blog_index['side']     = '侧边';
$lang->block->default->regions->blog_view['side']      = '侧边';

$lang->block->default->regions->forum_index['top']     = '上部';
$lang->block->default->regions->forum_index['bottom']  = '底部';
$lang->block->default->regions->forum_board['top']     = '上部';
$lang->block->default->regions->forum_board['bottom']  = '底部';
$lang->block->default->regions->thread_view['top']     = '上部';
$lang->block->default->regions->thread_view['bottom']  = '底部';

$lang->block->default->regions->book_browse['side']    = '侧边';
$lang->block->default->regions->book_read['top']       = '上部';
$lang->block->default->regions->book_read['bottom']    = '底部';

$lang->block->default->regions->message_index['side']  = '侧边';

$lang->block->default->regions->page_view['side']      = '侧边';
