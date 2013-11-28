<?php
/**
 * The model file of help category of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     help
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class helpModel extends model
{
    /**
     * Show book catalogue.
     * 
     * @param  int    $bookID 
     * @access public
     * @return void
     */
    public function getBookCatalogue($bookID = 0)
    {
        if(!isset($this->catalogue)) $this->catalogue = '';
        $inAdmin = RUN_MODE == 'admin';
        
        $book = $this->getByID($bookID);
        if(!empty($book))
        {
            /* Add self to tree. */
            $order = $this->getChapterNumber($book->path);
            $this->lastChapter = $order;

            $linkOnTitle   = $inAdmin ? helper::createLink('help', 'admin', "bookID=$book->id") : helper::createLink('help', 'book', "bookID=$book->id", "book=$book->alias");
            $editButton    = $inAdmin ? html::a(helper::createLink('help', 'edit',   "bookID=$book->id"), $this->lang->edit, "data-toggle='modal' data-width='1000px'") : '';
            $deleteButton  = $inAdmin ? html::a(helper::createLink('help', 'delete', "bookID=$book->id"), $this->lang->delete, "class='deleter'") : '';
            $createChapter = $inAdmin ? html::a(helper::createLink('help', 'create', "type=chapter&bookID=$book->id"), $this->lang->book->createChapter, "data-toggle='modal' data-width='1000px'") : '';
            $createArticle = $inAdmin ? html::a(helper::createLink('help', 'create', "type=article&bookID=$book->id"), $this->lang->book->createArticle, "data-toggle='modal' data-width='1000px'") : '';

            if($book->type == 'book')
            {
                $this->catalogue .= "<dt class='book'><strong>" . $order . '&nbsp;' . html::a($linkOnTitle, $book->title) . "</strong>" . $editButton . $deleteButton . $createChapter . $createArticle . "</dt>";
            }
            elseif($book->type == 'chapter')
            {
                $this->catalogue .= "<dd><strong>" . $order . '&nbsp;' . html::a($linkOnTitle, $book->title) . "</strong>" . $editButton . $deleteButton . $createChapter . $createArticle . "</dd>";
            }
            else
            {
                $this->catalogue .= "<dd><strong>" . $order . '</strong>&nbsp;' . html::a($linkOnTitle, $book->title) . $editButton . $deleteButton . '</dd>';
            }
        }

        $children = $this->getChildren(isset($book->id) ? $book->id : 0);

        if(!empty($children)) 
        {
            if($book) $this->catalogue .= '<dl>';
            foreach($children as $child)
            {
                $this->getBookCatalogue($child->id);
            }
            if($book) $this->catalogue .= '</dl>';
        }
        return $this->catalogue;
    }

    /**
     * Get one chapter's full number.
     * 
     * @param  string    $path 
     * @access public
     * @return void
     */
    public function getChapterNumber($path)
    {
        $origins = explode(',', $path);
        unset($origins[1]);//remove book number from chapter number.

        $preFix  = '';
        foreach($origins as $origin)
        {
            if(!$origin) continue;
            $category = $this->getByID($origin);
            $category->sort = $this->countChapterOrder($category->id, $category->parent);
            $sort .= $category->sort . ".";
        }
        return trim($sort, '.');
    }

    /**
     * Get chapter's order in its brother queue.
     * 
     * @param  string    $categoryID 
     * @param  int       $parentID 
     * @access public
     * @return void
     */
    public function countChapterOrder($categoryID, $parentID = '')
    {
        $categories = $this->dao->select('*')->from(TABLE_HELP)
            ->beginIF($parentID !='')->where('parent')->eq($parentID)->fi()
            ->orderBy('`order`')->fetchAll('id');

        $order = array_search($categoryID, array_keys($categories));
        return $order + 1;
    }

    /**
     * Create a book, a chapter or an article.
     *
     * @param  string    $type 
     * @access public
     * @return bool
     */
    public function create($type)
    {
        /* Init the catalog object. */
        $now  = helper::now();
        $book = fixer::input('post')
            ->add('addedDate',  $now)
            ->add('editedDate', $now)
            ->get();

        $parent = 0;
        if($book->parent) $parent = $this->getByID($book->parent);

        $book->type     = $type;
        $book->parent   = $parent ? $parent->id : 0;
        $book->grade    = $parent ? $parent->grade + 1 : 1;
        $book->keywords = seo::unify($book->keywords, ',');
        $book->alias    = seo::unify($book->alias, '-');

        $this->dao->insert(TABLE_HELP)
            ->data($book)
            ->autoCheck()
            ->batchCheck($this->config->help->create->requiredFields, 'notempty')
            ->exec();

        /* After saving, update it's path. */
        $bookID   = $this->dao->lastInsertID();
        $bookPath = ",$bookID,";
        $bookPath = $parent ? $parent->path . $bookPath : $bookPath;
        $this->dao->update(TABLE_HELP)->set('path')->eq($bookPath)->where('id')->eq($bookID)->exec();

        return $bookID;
    }

    /**
     * Get a book by id or alias.
     *
     * @param  string $id
     * @access public
     * @return array
     */
    public function getByID($id)
    {
        $book = $this->dao->select('*')->from(TABLE_HELP)->where('alias')->eq($id)->fetch();
        if(!$book) $book = $this->dao->select('*')->from(TABLE_HELP)->where('id')->eq($id)->fetch();
        $book->pathNames = $this->dao->select('id, title')->from(TABLE_HELP)->where('id')->in($book->path)->orderBy('grade')->fetchPairs();
        return $book;
    }

    /**
     * Build the sql to execute.
     * 
     * @param  int    $startParent   the start parent id
     * @access public
     * @return string
     */
    public function buildQuery($startParent = 0)
    {
        /* Get the start parent path according the $startParent. */
        $startPath = '';
        if($startParent > 0)
        {
            $startParent = $this->getById($startParent);
            if($startParent) $startPath = $startParent->path . '%';
        }

        return $this->dao->select('*')->from(TABLE_HELP)
            ->where('type')->ne('article')
            ->beginIF($startPath)->andWhere('path')->like($startPath)->fi()
            ->orderBy('grade desc, `order`')
            ->get();
    }

    /**
     * Get children categories of one category.
     * 
     * @param  int    $bookID 
     * @access public
     * @return array
     */
    public function getChildren($bookID)
    {
        return $this->dao->select('*')->from(TABLE_HELP)
            ->where('parent')->eq((int)$bookID)
            ->andWhere('type')->ne('book')
            ->orderBy('`order`')
            ->fetchAll('id');
    }

    /**
     * Create a tree menu in <select> tag.
     * 
     * @param  int    $startParent 
     * @param  bool   $removeRoot 
     * @access public
     * @return string
     */
    public function getOptionMenu($startParent = 0, $removeRoot = false)
    {
        /* First, get all books. */
        $treeMenu   = array();
        $stmt       = $this->dbh->query($this->buildQuery($startParent));
        $books      = array();
        while($book = $stmt->fetch()) $books[$book->id] = $book;

        /* Cycle them, build the select control.  */
        foreach($books as $book)
        {
            $origins = explode(',', $book->path);
            $bookTitle = '/';
            foreach($origins as $origin)
            {
                if(empty($origin)) continue;
                $bookTitle .= $books[$origin]->title . '/';
            }
            $bookTitle = rtrim($bookTitle, '/');
            $bookTitle .= "|$book->id\n";

            if(isset($treeMenu[$book->id]) and !empty($treeMenu[$book->id]))
            {
                if(isset($treeMenu[$book->parent]))
                {
                    $treeMenu[$book->parent] .= $bookTitle;
                }
                else
                {
                    $treeMenu[$book->parent] = $bookTitle;;
                }
                $treeMenu[$book->parent] .= $treeMenu[$book->id];
            }
            else
            {
                if(isset($treeMenu[$book->parent]) and !empty($treeMenu[$book->parent]))
                {
                    $treeMenu[$book->parent] .= $bookTitle;
                }
                else
                {
                    $treeMenu[$book->parent] = $bookTitle;
                }    
            }
        }

        $topMenu = @array_pop($treeMenu);
        $topMenu = explode("\n", trim($topMenu));
        if(!$removeRoot) $lastMenu[] = '/';

        foreach($topMenu as $menu)
        {
            if(!strpos($menu, '|')) continue;

            $menu   = explode('|', $menu);
            $label  = array_shift($menu);
            $bookID = array_pop($menu);
           
            $lastMenu[$bookID] = $label;
        }

        return $lastMenu;
    }

    /**
     * Get the first book.
     * 
     * @access public
     * @return object|bool
     */
    public function getFirstBook()
    {
        $book = $this->dao->select('*')->from(TABLE_HELP)->where('type')->eq('book')->orderBy('id_desc')->limit(1)->fetch();
        if(!$book) return false;
        return $book;
    }

    /**
     * Get book list.
     *
     * @access public
     * @return array
     */
    public function getBookList()
    {
        $books = $this->dao->select('*')->from(TABLE_HELP)->where('type')->eq('book')->orderBy('id_desc')->fetchAll('id');

        return $books;
    }

    /**
     * Update a book.
     *
     * @param int $bookID
     * @access public
     * @return bool
     */
    public function update($bookID)
    {
        $book = fixer::input('post')
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->get();

        $book->keywords = seo::unify($book->keywords, ',');
        $book->alias    = seo::unify($book->alias, '-');
        
        $this->dao->update(TABLE_HELP)
            ->data($book, $skip = 'uid')
            ->autoCheck()
            ->batchCheck($this->config->help->edit->requiredFields, 'notempty')
            ->where('id')->eq($bookID)
            ->exec();

        if(dao::isError()) return false;

        $this->loadModel('tag')->save($book->keywords);

        return !dao::isError();
    }

    /**
     * Delete a book.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $book = $this->getByID($id);
        if(!$book) return false;

        $this->dao->delete()->from(TABLE_HELP)->where('id')->eq($id)->exec();
        return !dao::isError();
    }
}
