<?php
/**
 * The control file of sitemap of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     sitemap
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class sitemap extends control
{
    /**
     * Output the sitemap.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $this->loadModel('tree');
        $this->loadModel('article');
        $this->loadModel('product');
        $this->loadModel('thread');

        $this->app->loadClass('pager', $static = true);
        $pager = new pager(0, $this->config->sitemap->items, 1);

        $categories   = $this->dao->select('*')->from(TABLE_CATEGORY)->fetchAll('id');
        $bookArticles = $this->dao->select('*')->from(TABLE_ARTICLE)->where('type')->like("book_%")->fi()->fetchAll('id');
        $articles     = $this->article->getList('article', $this->tree->getFamily(0, 'article'), 'id_desc', $pager);
        $products     = $this->product->getList($this->tree->getFamily(0), 'id_desc', $pager);
        $threads      = $this->thread->getList($this->tree->getFamily(0), 'id_desc', $pager);

        $this->view->siteLink       = commonModel::getSysURL();
        $this->view->categories     = $categories;
        $this->view->bookArticles   = $bookArticles;
        $this->view->articles       = $articles;
        $this->view->products       = $products;
        $this->view->threads        = $threads;

        header("Content-type: text/xml");

        $this->display();
    }
}
