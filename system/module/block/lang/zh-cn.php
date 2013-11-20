<?php
/**
 * The block module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->block->common     = '区块维护';
$lang->block->id         = '编号';
$lang->block->title      = '名称';
$lang->block->limit      = '数量';
$lang->block->type       = '类型';
$lang->block->content    = '内容';
$lang->block->page       = '页面';
$lang->block->area       = '区域';
$lang->block->categories = '分类';
$lang->block->showImage  = '是否显示图片';

$lang->block->create       = '添加区块';
$lang->block->browseBlocks = '区块列表';
$lang->block->browsePages  = '页面列表';
$lang->block->edit         = '编辑区块';
$lang->block->view         = '查看区块';
$lang->block->setPage      = '配置页面';

$lang->block->typeList['html']          = '自定义区块';
$lang->block->typeList['latestArticle'] = '最新文章';
$lang->block->typeList['hotArticle']    = '热门文章';
$lang->block->typeList['latestProduct'] = '最新产品';
$lang->block->typeList['hotProduct']    = '热门产品';
$lang->block->typeList['category']      = '分类导航';
$lang->block->typeList['contact']       = '联系我们';
$lang->block->typeList['about']         = '公司简介';

$lang->block->image['show'] = '显示图片';

$lang->block->category = new stdclass();
$lang->block->category->type    = '展示类型';
$lang->block->category->show    = '显示内容';
$lang->block->category->parent  = '选择父类';
$lang->block->category->content = '选择分类';

$lang->block->category->typeList['tree']     = '树状导航';
$lang->block->category->typeList['list']     = '列表导航';
$lang->block->category->showList['parent']   = '显示子分类';
$lang->block->category->showList['selected'] = '显示已选取';

$lang->block->contact = new stdclass();
$lang->block->contact->itemList[]           = '';
$lang->block->contact->itemList['phone']    = '电话';
$lang->block->contact->itemList['email']    = 'Email';
$lang->block->contact->itemList['qq']       = 'QQ';
$lang->block->contact->itemList['weibo']    = '微博';
$lang->block->contact->itemList['wangwang'] = '旺旺';
$lang->block->contact->itemList['addr']     = '地址';

$lang->block->pages['all']            = '全部页面';
$lang->block->pages['index_index']    = '首页';

$lang->block->pages['article_browse'] = '文章列表页面';
$lang->block->pages['article_view']   = '文章详情页面';

$lang->block->pages['product_browse'] = '产品列表页面';
$lang->block->pages['product_view']   = '产品详情页面';

$lang->block->pages['blog_index']     = '博客列表页面';
$lang->block->pages['blog_view']      = '博客详情页面';

$lang->block->pages['forum_index']    = '论坛首页';
$lang->block->pages['forum_board']    = '帖子列表页面';
$lang->block->pages['thread_view']    = '帖子察看页面';
$lang->block->pages['search_list']    = '搜索结果页';

$lang->block->pages['help_index']     = '帮助中心';
$lang->block->pages['help_book']      = '手册首页';
$lang->block->pages['help_read']      = '手册章节';

/* page layout list. */
$lang->block->regions = new stdclass();
$lang->block->regions->all['header'] = '头部';
$lang->block->regions->all['footer'] = '底部';
$lang->block->regions->all['end']    = '结束部分';

$lang->block->regions->index_index['header']  = '头部';
$lang->block->regions->index_index['middle1'] = '中部上';
$lang->block->regions->index_index['middle2'] = '中部下';

$lang->block->confirmDelete = "您确定删除该区块吗？";
