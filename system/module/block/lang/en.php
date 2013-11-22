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
$lang->block->common     = 'Block';
$lang->block->id         = 'ID';
$lang->block->title      = 'Title';
$lang->block->limit      = 'Limit';
$lang->block->type       = 'Type';
$lang->block->content    = 'Content';
$lang->block->page       = 'Page';
$lang->block->regionList = 'Regions List';
$lang->block->select     = 'Please select a block';
$lang->block->categories = 'Categories';
$lang->block->showImage  = 'Show image';
$lang->block->product    = 'Product';

$lang->block->add          = "Add";
$lang->block->create       = 'Create Block';
$lang->block->browseBlocks = 'Browse Blocks';
$lang->block->browseRegion = 'Browse Regions';
$lang->block->edit         = 'Edit';
$lang->block->view         = 'view';
$lang->block->setPage      = 'Set page blocks';

$lang->block->typeList['html']            = 'Html block';
$lang->block->typeList['latestArticle']   = 'Latest Articles';
$lang->block->typeList['hotArticle']      = 'Hot Articles';
$lang->block->typeList['latestProduct']   = 'Latest Products';
$lang->block->typeList['featuredProduct'] = 'Featured Product';
$lang->block->typeList['hotProduct']      = 'Hot Products';
$lang->block->typeList['slide']           = 'Slide';
$lang->block->typeList['articleTree']     = 'Article Categories';
$lang->block->typeList['productTree']     = 'Product Categories';
$lang->block->typeList['blogTree']        = 'Blog Categories';
$lang->block->typeList['contact']         = 'Contact Us';
$lang->block->typeList['about']           = 'About Us';
$lang->block->typeList['links']           = 'Links';

$lang->block->image['show'] = 'Show Image';

$lang->block->category = new stdclass();
$lang->block->category->showChildren = 'Show Children';

$lang->block->category->showChildrenList[1] = 'Yes';
$lang->block->category->showChildrenList[0] = 'No';

$lang->block->pages['all']            = 'All';
$lang->block->pages['index_index']    = 'Home';

$lang->block->pages['article_browse'] = 'Browse article page';
$lang->block->pages['article_view']   = 'View article page';

$lang->block->pages['product_browse'] = 'Browse product page';
$lang->block->pages['product_view']   = 'View product page';

$lang->block->pages['blog_index']     = 'Browse blog page';
$lang->block->pages['blog_view']      = 'View blog page';

$lang->block->pages['forum_index']    = 'Forum home';
$lang->block->pages['forum_board']    = 'Forum board';
$lang->block->pages['thread_view']    = 'View thread';
$lang->block->pages['search_list']    = 'Search';

$lang->block->pages['help_index']     = 'Help';
$lang->block->pages['help_book']      = 'Book catalogue';
$lang->block->pages['help_read']      = 'Book content';

/* page layout list. */
$lang->block->regions = new stdclass();
$lang->block->regions->all['header'] = 'Header';
$lang->block->regions->all['footer'] = 'Footer';
$lang->block->regions->all['end']    = 'End';

$lang->block->regions->index_index['header']  = 'Header';
$lang->block->regions->index_index['bottom']  = 'Bottom';
$lang->block->regions->index_index['footer']  = 'Footer';

$lang->block->regions->article_browse['side'] = 'Side';

$lang->block->regions->article_view['side']   = 'Side';

$lang->block->regions->product_browse['side'] = 'Side';

$lang->block->regions->product_view['side']   = 'Side';
