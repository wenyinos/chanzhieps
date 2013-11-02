<?php
/**
 * The control file of sitemap of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
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
    public function index($onlyBody = 'no')
    {
       if($this->app->getviewType() == 'html') die($this->sitemapHTML($onlyBody));
       if($this->app->getviewType() == 'xml')  die($this->sitemapXML());
    }

    /**
     * Output the sitemap.html.
     * 
     * @access public
     * @return void
     */
    public function sitemapHTML($onlyBody)
    {
        $this->loadModel('tree');

        $this->view->articleTree = $this->tree->getTreeMenu('article', 0, array('treeModel', 'createBrowseLink'));
        $this->view->productTree = $this->tree->getTreeMenu('product', 0, array('treeModel', 'createProductBrowseLink'));
        $this->view->blogTree    = $this->tree->getTreeMenu('blog', 0, array('treeModel', 'createBlogBrowseLink'));
        $this->view->boards      = $this->loadModel('forum')->getBoards();
        $this->view->onlyBody    = $onlyBody;

        $this->display();
    }

    /**
     * Output sitemap.xml.
     * 
     * @access public
     * @return void
     */
    public function sitemapXML()
    {
        $this->loadModel('tree');
        $this->loadModel('article');
        $this->loadModel('product');
        $this->loadModel('forum');
        $this->loadModel('thread');

        $menus    = $this->dao->select('id, type, alias, editedDate, addedDate')->from(TABLE_ARTICLE)->where('type')->like("book_%")->fetchAll('id');
        $articles = $this->article->getList('article', $this->tree->getFamily(0, 'article'), 'id_desc');
        $blogs    = $this->article->getList('blog', $this->tree->getFamily(0, 'blog'), 'id_desc');
        $products = $this->product->getList($this->tree->getFamily(0), 'id_desc');
        $board    = $this->tree->getFamily(0);
        $threads  = $this->dao->select('id, editedDate')->from(TABLE_THREAD)->beginIf($board)->where('board')->in($board)->orderBy('id desc')->fetchPairs();

        $this->view->systemURL = commonModel::getSysURL();
        $this->view->menus     = $menus;
        $this->view->articles  = $articles;
        $this->view->blogs     = $blogs;
        $this->view->products  = $products;
        $this->view->threads   = $threads;

        $this->display();
    }
}
