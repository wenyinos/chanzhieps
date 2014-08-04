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
$lang->block->common          = 'Block';
$lang->block->id              = 'ID';
$lang->block->title           = 'Title';
$lang->block->limit           = 'Limit';
$lang->block->type            = 'Type';
$lang->block->code            = 'Codes';
$lang->block->phpcode         = 'php codes';
$lang->block->content         = 'Content';
$lang->block->moreLink        = 'More Button';
$lang->block->page            = 'Page';
$lang->block->regionList      = 'Regions List';
$lang->block->select          = 'Please select a block';
$lang->block->categories      = 'Categories';
$lang->block->showImage       = 'Show image';
$lang->block->showTime        = 'Show time';
$lang->block->product         = 'Product';
$lang->block->titleless       = 'Hide Title';
$lang->block->borderless      = 'Hide Border';
$lang->block->icon            = 'Icon';
$lang->block->grid            = 'Width';
$lang->block->more            = 'More';
$lang->block->color           = 'Color';
$lang->block->titleColor      = 'Title Color';
$lang->block->titleBackground = 'Title Background';
$lang->block->backgroundColor = 'Background';
$lang->block->textColor       = 'Text Color';
$lang->block->borderColor     = 'Border Color';
$lang->block->linkColor       = 'Link Color';
$lang->block->iconColor       = 'Icon Color';

$lang->block->add          = "Add";
$lang->block->template     = "Template";
$lang->block->create       = 'Create Block';
$lang->block->browseBlocks = 'Browse Blocks';
$lang->block->browseRegion = 'Browse Regions';
$lang->block->edit         = 'Edit';
$lang->block->view         = 'view';
$lang->block->setPage      = 'Set page blocks';

$lang->block->placeholder = new stdclass();
$lang->block->placeholder->moreText = 'Text for button of more';
$lang->block->placeholder->moreUrl  = 'Url for button of more';

$lang->block->noPhpTag = 'No need &lt;?php ?&gt;';

$lang->upgrade->setOkFile = <<<EOT
<div class='alert'>
<h5>For security reason, please do these steps. </h5>
<p>Create "<input value='%s' class='autoSelect' readoly />" file. If this file exists already, reopen it and save again.</p>
</div>
EOT;

$lang->block->gridOptions[0]  = 'Auto';
$lang->block->gridOptions[6]  = '1/2';
$lang->block->gridOptions[4]  = '1/3';
$lang->block->gridOptions[8]  = '2/3';
$lang->block->gridOptions[3]  = '1/4';
$lang->block->gridOptions[9]  = '3/4';
$lang->block->gridOptions[12] = '100%';

$lang->block->colorTip    = 'HEX color';
$lang->block->colorPlates = '333333|000000|CA1407|45872B|148D00|F25D03|2286D2|D92958|A63268|04BFAD|D1270A|FF9400|299182|63731A|3D4DBE|7382D9|754FB9|F2E205|B1C502|364245|C05036|8A342A|E0DDA2|B3D465|EEEEEE|FFD0E5|D0FFFD|FFFF84|F4E6AE|E5E5E5|F1F1F1|FFFFFF';

$lang->block->default = new stdclass();
$lang->block->default->typeList['html']    = 'Html block';
$lang->block->default->typeList['code']    = 'Codes';
$lang->block->default->typeList['phpcode'] = 'php codes';

$lang->block->default->typeList['latestArticle'] = 'Latest Articles';
$lang->block->default->typeList['hotArticle']    = 'Hot Articles';

$lang->block->default->typeList['latestProduct']   = 'Latest Products';
$lang->block->default->typeList['featuredProduct'] = 'Featured Products';
$lang->block->default->typeList['hotProduct']      = 'Hot Products';

$lang->block->default->typeList['articleTree'] = 'Article Categories';
$lang->block->default->typeList['productTree'] = 'Product Categories';
$lang->block->default->typeList['blogTree']    = 'Blog Categories';

$lang->block->default->typeList['contact'] = 'Contact Us';
$lang->block->default->typeList['about']   = 'About Us';
$lang->block->default->typeList['links']   = 'Links';
$lang->block->default->typeList['slide']   = 'Slide';
$lang->block->default->typeList['header']  = 'Header';

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
$lang->block->category->showChildren = 'Show Children';

$lang->block->category->showChildrenList[1] = 'Yes';
$lang->block->category->showChildrenList[0] = 'No';

$lang->block->default->pages['all']            = 'All';
$lang->block->default->pages['index_index']    = 'Home';

$lang->block->default->pages['article_browse'] = 'Browse article page';
$lang->block->default->pages['article_view']   = 'View article page';

$lang->block->default->pages['product_browse'] = 'Browse product page';
$lang->block->default->pages['product_view']   = 'View product page';

$lang->block->default->pages['blog_index']     = 'Browse blog page';
$lang->block->default->pages['blog_view']      = 'View blog page';

$lang->block->default->pages['forum_index']    = 'Forum home';
$lang->block->default->pages['forum_board']    = 'Forum board';
$lang->block->default->pages['thread_view']    = 'View thread';
$lang->block->default->pages['search_list']    = 'Search';

$lang->block->default->pages['book_index']     = 'Book';
$lang->block->default->pages['book_browse']    = 'Book catalogue';
$lang->block->default->pages['book_read']      = 'Book content';

$lang->block->default->pages['message_index']  = 'Inquire';

$lang->block->default->pages['page_view']      = 'Page';

/* page layou>default-> list. */
$lang->block->default->regions = new stdclass();
$lang->block->default->regions->all['header'] = 'Header(invisible)';
$lang->block->default->regions->all['top']    = 'Top';
$lang->block->default->regions->all['bottom'] = 'Bottom';
$lang->block->default->regions->all['footer'] = 'Footer(invisible)';

$lang->block->default->regions->index_index['top']     = 'Top';
$lang->block->default->regions->index_index['middle']  = 'Middle';
$lang->block->default->regions->index_index['Bottom']  = 'Bottom';

$lang->block->default->regions->article_browse['side'] = 'Side';
$lang->block->default->regions->article_view['side']   = 'Side';

$lang->block->default->regions->product_browse['side'] = 'Side';
$lang->block->default->regions->product_view['side']   = 'Side';

$lang->block->default->regions->blog_index['side']     = 'Side';
$lang->block->default->regions->blog_view['side']      = 'Side';

$lang->block->default->regions->forum_index['top']     = 'Top';
$lang->block->default->regions->forum_index['bottom']  = 'Bottom';
$lang->block->default->regions->forum_board['top']     = 'Top';
$lang->block->default->regions->forum_board['bottom']  = 'Bottom';
$lang->block->default->regions->thread_view['top']     = 'Top';
$lang->block->default->regions->thread_view['bottom']  = 'Bottom';

$lang->block->default->regions->book_browse['side']    = 'Side';
$lang->block->default->regions->book_read['top']       = 'Top';
$lang->block->default->regions->book_read['bottom']    = 'Bottom';

$lang->block->default->regions->message_index['side']  = 'Side';

$lang->block->default->regions->page_view['side']      = 'Side';
