<?php
/**
 * The control file of help category of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     help
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class help extends control
{
    const NEW_CATALOGUE_COUNT = 5;

    public function index()
    {
        $book = $this->help->getFirstBook();
        if($book) $this->locate(inlink('book', "type=$book->alias&book=$book->id"));
        $this->locate($this->createLink('index'));
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
        $books = $this->help->getBookList();

        $this->lang->help->menu = new stdclass();
        foreach($books as $book)
        {
            $id = $book->id;
            $this->lang->help->menu->$id = $book->title . '|help|admin|book=' . $id;
        }

        $this->lang->help->menu->createBook = $this->lang->book->createBook . '|help|create|'; 
        $this->lang->menuGroups->tree = 'help';

        if($bookID)
        {
            $book = $this->help->getByID($bookID);
        }
        else
        {
            $book = $this->help->getByID(array_shift($books)->id);
        } 

        $this->view->title = $this->lang->help->common;
        $this->view->books = $books;
        $this->view->book  = $book;
        $this->display();
    }

    /**
     * Browse the categories and print manage links.
     * 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function category($type)
    {
        $this->lang->help->menu = $this->help->createModuleMenu();

        $this->lang->category         = $this->lang->directory;
        $this->lang->tree->menu       = $this->lang->help->menu;
        $this->lang->menuGroups->tree = 'help';

        $this->view->categoryBox = $this->help->getCategoryBox($type);
        $this->view->title    = $this->lang->category->common;
        $this->view->type     = $type;
        $this->view->root     = $root;
        $this->view->children = $this->loadModel('tree')->getChildren(0, $type);

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
        $books = $this->help->getBookList();

        $this->lang->help->menu = new stdclass();
        foreach($books as $book)
        {
            $id = $book->id;
            $this->lang->help->menu->$id = $book->title . '|help|admin|book=' . $id;
        }

        $this->lang->help->menu->createBook = $this->lang->book->createBook . '|help|create|'; 
        $this->lang->menuGroups->tree = 'help';

        if($_POST)
        {
            $bookID = $this->help->create($parent);
            $locate = $this->inlink('admin', "bookID=$parent");
            if($parent == 0) $locate = $this->inlink('admin', "bookID=$bookID");
            if($bookID) $this->send(array('result' => 'success', 'message'=>$this->lang->saveSuccess, 'locate' => $locate));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->books      = $books;
        $this->view->parent     = $parent;
        $this->view->catalogues = $this->help->getChildren($parent);
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
        $book = $this->help->getByID($bookID);

        $parent = $this->help->getByID($book->parent);

        if($_POST)
        {
            $this->help->update($bookID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "bookID=$bookID")));
        }

        $this->view->title   = $this->lang->help->edit;
        $this->view->parents = $this->help->getOptionMenu(0, $removeRoot = false);
        $this->view->book    = $book;
        $this->view->parent  = $parent;
        $this->display();
    }

    /**
     * Read a book.
     * 
     * @param  int    $bookID 
     * @access public
     * @return void
     */
    public function book($bookID)
    {
        $book          = $this->help->getByID($bookID);
        $bookCatalogue = $this->help->getChildren($bookID);

        $this->view->title = $book->title;
        if($bookCatalogue)
        {
            $this->view->keywords = trim($bookCatalogue->keyword . ' ' . $this->config->site->keywords);
        }
        $this->view->books      = $this->help->getBookList();
        $this->view->book       = $book;
        $this->view->category   = $bookCatalogue;
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
        $article  = $this->loadModel('article')->getByID($articleID);
        
        /* fetch first category for display. */
        $category = array_slice($article->categories, 0, 1);
        $category = $category[0];
        $category = $this->loadModel('tree')->getById($category->id);

        $type = str_replace('book_', '', $this->dao->findById($category->id)->from(TABLE_CATEGORY)->fetch('type'));
        $book = $this->loadModel('setting')->getItem("owner=system&module=common&section=book&key=$type");
        $book = json_decode($book);
        
        $category->book = $book->name;
        $category->code = $type;

        $this->createContentNav($article->content);

        $this->view->title    = $article->title;
        $this->view->keywords = trim($article->keywords . ' ' . $category->keyword . ' ' . $this->config->site->keywords);
        $this->view->desc     = trim($article->summary . ' ' . preg_replace('/<[a-z\/]+.*>/Ui', '', $category->desc));

        $this->view->type        = $type;
        $this->view->article     = $article;
        $this->view->prevAndNext = $this->loadModel('article')->getPrevAndNext($article->id, $category->id);
        //$this->view->layouts   = $this->loadModel('block')->getLayouts('help.read');
        $this->view->category    = $category;

        $this->dao->update(TABLE_ARTICLE)->set('views = views + 1')->where('id')->eq($articleID)->exec(false);

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
        if($this->help->delete($id)) $this->send(array('result' => 'success'));
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
}
