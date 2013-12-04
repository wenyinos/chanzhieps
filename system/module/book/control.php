<?php
/**
 * The control file of book category of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class book extends control
{
    const NEW_CATALOGUE_COUNT = 5;

    public function index()
    {
        $book = $this->book->getFirstBook();
        if($book) $this->locate(inlink('browse', "bookID=$book->id", "book=$book->alias"));
        $this->locate(inlink('browse'));
    }

    /**
     * Browse books in admin.
     * 
     * @params int    $bookID
     * @access public
     * @return void
     */
    public function admin($bookID = '')
    {
        $books = $this->book->getBookList();

        $this->lang->book->menu = new stdclass();
        foreach($books as $book)
        {
            $id = $book->id;
            $this->lang->book->menu->$id = $book->title . '|book|admin|book=' . $id;
        }

        $this->lang->book->menu->createBook = $this->lang->book->createBook . '|book|create|'; 
        $this->lang->menuGroups->tree = 'book';

        if($bookID)
        {
            $book = $this->book->getByID($bookID);
        }
        else
        {
            $book = $this->book->getByID(array_shift($books)->id);
        } 

        $this->view->title     = $this->lang->book->common;
        $this->view->books     = $books;
        $this->view->book      = $book;
        $this->view->catalogue = $this->book->getAdminCatalogue($book->id);
        $this->display();
    }

    /**
     * Browse a book.
     * 
     * @param  int    $bookID 
     * @access public
     * @return void
     */
    public function browse($bookID)
    {
        $book     = $this->book->getByID($bookID);

        $this->view->title     = $book->title;
        $this->view->keywords  = trim($book->keywords . ' ' . $this->config->site->keywords);
        $this->view->book      = $book;
        $this->view->books     = $this->book->getBookList();
        $this->view->catalogue = $this->book->getFrontCatalogue($book->id);
        $this->display();
    }

    /**
     * Read an article.
     * 
     * @param  int    $articleID 
     * @access public
     * @return void
     */
    public function read($articleID)
    { 
        $article = $this->book->getByID($articleID);
        $parent  = $this->book->getByID($article->parent);
        
        $this->createContentNav($article->content);

        $this->view->title    = $article->title;
        $this->view->keywords = trim($article->keywords . ' ' . $parent->keyword . ' ' . $this->config->site->keywords);
        $this->view->desc     = trim($article->summary . ' ' . preg_replace('/<[a-z\/]+.*>/Ui', '', $parent->desc));

        $this->view->article     = $article;
        $this->view->prevAndNext = $this->book->getPrevAndNext($article->id, $parent->id);
        //$this->view->layouts   = $this->loadModel('block')->getLayouts('book.read');
        $this->view->parent      = $parent;

        $this->dao->update(TABLE_BOOK)->set('views = views + 1')->where('id')->eq($articleID)->exec(false);

        $this->display();
    }


    /**
     * Create a book.
     *
     * @params int    $parent
     * @access public 
     * @return void
     */
    public function create($parent = 0)
    {
        $books  = $this->book->getBookList();
        $parent = $this->book->getByID($parent);

        $this->lang->book->menu = new stdclass();
        foreach($books as $book)
        {
            $id = $book->id;
            $this->lang->book->menu->$id = $book->title . '|book|admin|book=' . $id;
        }

        $this->lang->book->menu->createBook = $this->lang->book->createBook . '|book|create|'; 
        $this->lang->menuGroups->tree = 'book';

        if($_POST)
        {
            $bookID = $this->book->create($parent);
            $origin = $this->book->getRoot($book->path);
            $locate = $this->inlink('admin', "bookID=$origin");
            if($parent == 0) $locate = $this->inlink('admin', "bookID=$bookID");
            if($bookID) $this->send(array('result' => 'success', 'message'=>$this->lang->saveSuccess, 'locate' => $locate));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->books      = $books;
        $this->view->parent     = $parent;
        $this->view->catalogues = $this->book->getChildren($parent);
        $this->display(); 
    }

    /**
     * Edit a book, a chapter or an article.
     *
     * @param int $bookID
     * @access public
     * @return void
     */
    public function edit($bookID)
    {
        $book   = $this->book->getByID($bookID);
        $parent = $this->book->getByID($book->parent);
        $origin = $this->book->getRoot($book->path);

        if($_POST)
        {
            $this->book->update($bookID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "bookID=$bookID")));
        }

        $this->view->title   = $this->lang->book->edit;
        $this->view->parents = $this->book->getOptionMenu($origin, $removeRoot = true);
        $this->view->book    = $book;
        $this->view->parent  = $parent;
        $this->display();
    }

    /**
     * Delete a book.
     *
     * @param int $id
     * @retturn void
     */
    public function delete($id)
    {
        if($this->book->delete($id)) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Create content navigation according the content. 
     * 
     * @param  int    $content 
     * @access public
     * @return string;
     */
    public function createContentNav($content)
    {
        $nav = "<div id='contentNav'>";
        $content = str_replace('<h3', '<h4', $content);
        $content = str_replace('h3>', 'h4>', $content);
        preg_match_all('|<h4.*>(.*)</h4>|isU', $content, $result);
        if(count($result[0]) >= 2)
        {
            foreach($result[0] as $id => $item)
            {
                $nav .= "<div><a href='#$id'>" . strip_tags($item) . "</a></div>";
                $replace = str_replace('<h4', "<h4 id=$id", $item);
                $content = str_replace($item, $replace, $content);
            }
            $nav .= "</div>";
            $content = $nav . $content;
        }
    }

    /**
     * sort up.
     * 
     * @param  int    $id 
     * @access public
     * @return string;
     */
    public function up($id)
    {
        $book = $this->book->getByID($id);
        $prev = $this->dao->select('id, `order`')
            ->from(TABLE_BOOK)
            ->where('parent')->eq($book->parent)
            ->andWhere('`order`')->lt($book->order)
            ->orderBy('`order` desc')
            ->limit(1)
            ->fetch();
        if(!$prev) return false;

        $order = $prev->order;

        $this->dao->update(TABLE_BOOK)->set('`order`')->eq($book->order)->where('id')->eq($prev->id)->exec();
        $this->dao->update(TABLE_BOOK)->set('`order`')->eq($order)->where('id')->eq($book->id)->exec();

        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success'));
    }

    /**
     * sort down.
     * 
     * @param  int    $id 
     * @access public
     * @return string;
     */
    public function down($id)
    {
        $book = $this->book->getByID($id);
        $next = $this->dao->select('id, `order`')
            ->from(TABLE_BOOK)
            ->where('parent')->eq($book->parent)
            ->andWhere('`order`')->gt($book->order)
            ->orderBy('`order`')
            ->limit(1)
            ->fetch();
        if(!$next) return false;

        $order = $next->order;

        $this->dao->update(TABLE_BOOK)->set('`order`')->eq($book->order)->where('id')->eq($next->id)->exec();
        $this->dao->update(TABLE_BOOK)->set('`order`')->eq($order)->where('id')->eq($book->id)->exec();

        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success'));
    }
}
