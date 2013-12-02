<?php
/**
 * The model file of book category of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class bookModel extends model
{
    /**
     * Get a book by id or alias.
     *
     * @param  string $id
     * @access public
     * @return array
     */
    public function getByID($id)
    {
        $book = $this->dao->select('*')->from(TABLE_BOOK)->where('alias')->eq($id)->fetch();
        if(!$book) $book = $this->dao->select('*')->from(TABLE_BOOK)->where('id')->eq($id)->fetch();
        $book->pathNames = $this->dao->select('id, title')->from(TABLE_BOOK)->where('id')->in($book->path)->orderBy('grade')->fetchPairs();
        return $book;
    }

    /**
     * Get the first book.
     * 
     * @access public
     * @return object|bool
     */
    public function getFirstBook()
    {
        $book = $this->dao->select('*')->from(TABLE_BOOK)->where('type')->eq('book')->orderBy('id_desc')->limit(1)->fetch();
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
        $books = $this->dao->select('*')->from(TABLE_BOOK)->where('type')->eq('book')->orderBy('id_desc')->fetchAll('id');

        return $books;
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
        return $this->dao->select('*')->from(TABLE_BOOK)
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
        $children = $this->getChildren(isset($book->id) ? $book->id : 0);
        if(!empty($book))
        {
            /* Add self to tree. */
            $order = $this->getChapterNumber($book->path);
            $this->lastChapter = $order;

            $linkOnTitle  = $inAdmin ? helper::createLink('book', 'admin', "bookID=$book->id") : helper::createLink('book', 'browse', "bookID=$book->id", "book=$book->alias");
            $editButton   = $inAdmin ? html::a(helper::createLink('book', 'edit',   "bookID=$book->id"), $this->lang->edit, "data-toggle='modal' data-width='1000px'") : '';
            $deleteButton = ($inAdmin && empty($children)) ? html::a(helper::createLink('book', 'delete', "bookID=$book->id"), $this->lang->delete, "class='deleter'") : '';
            $create       = $inAdmin ? html::a(helper::createLink('book', 'create', "bookID=$book->id"), $this->lang->book->createCatalogue) : '';
            $sort         = $inAdmin ? "<i class='icon-arrow-up'></i><i class='icon-arrow-down'></i>" : '';

            if($book->type == 'book' && $inAdmin)
            {
                $this->catalogue .= "<dt class='book'><strong>" . html::a($linkOnTitle, $book->title) . "</strong>" . $editButton . $deleteButton . $create . "</dt>";
            }
            elseif($book->type == 'chapter')
            {
                $this->catalogue .= "<dd class='catalogue chapter'><strong>" . $order . '&nbsp;' . html::a($linkOnTitle, $book->title) . "</strong>" . $editButton . $deleteButton . $create . $sort . '</dd>';
            }
            elseif($book->type == 'article')
            {
                $this->catalogue .= "<dd class='catalogue article'><strong>" . $order . '</strong>&nbsp;' . html::a($linkOnTitle, $book->title) . $editButton . $deleteButton . $sort . '</dd>';
            }
        }

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
            $book       = $this->getByID($origin);
            $children   = $this->getChildren($book->parent);
            $book->sort = array_search($book->id, array_keys($children)) + 1;
            $sort      .= $book->sort . ".";
        }
        return trim($sort, '.');
    }

    /**
     * Create a book, a chapter or an article.
     *
     * @param  int    $parent 
     * @access public
     * @return bool
     */
    public function create($parent)
    {
        if($parent == 0)
        {
            $now = helper::now();
            $book = fixer::input('post')
                ->add('parent', 0)
                ->add('grade', 1)
                ->add('type', 'book')
                ->add('addedDate', $now)
                ->add('editedDate', $now)
                ->get();

            $book->alias = seo::unify($book->alias, '-');

            $this->dao->insert(TABLE_BOOK)
                ->data($book)
                ->autoCheck()
                ->batchCheck($this->config->book->create->requiredFields, 'notempty')
                ->exec();

            /* After saving, update it's path. */
            $bookID   = $this->dao->lastInsertID();
            $bookPath = ",$bookID,";
            $this->dao->update(TABLE_BOOK)->set('path')->eq($bookPath)->where('id')->eq($bookID)->exec();
            return $bookID;
        }
        else
        {
            $parent = $this->getByID($parent);

            /* Init the catalogue object. */
            $catalogue = new stdclass();
            $catalogue->parent   = $parent ? $parent->id : 0;
            $catalogue->grade    = $parent ? $parent->grade + 1 : 1;

            $catalogues = $this->post->title;
            $i = 1;
            foreach($catalogues as $key => $catalogueTitle)
            {
                if(empty($catalogueTitle)) continue;

                /* First, save the child without path field. */
                $catalogue->title = $catalogueTitle;
                $catalogue->type  = $this->post->type[$key];
                $catalogue->order = $this->post->order[$key];
                $mode = $this->post->mode[$key];

                /* Add id to check alias. */
                $catalogue->id = $mode == 'new' ?  0: $catalogue->id = $key;

                if($mode == 'new')
                {
                    unset($category->id);
                    $this->dao->insert(TABLE_BOOK)->data($catalogue)->exec();

                    /* After saving, update it's path. */
                    $catalogueID   = $this->dao->lastInsertID();
                    $cataloguePath = ",$catalogueID,";
                    $cataloguePath = $parent ? $parent->path . $cataloguePath : $cataloguePath;
                    $this->dao->update(TABLE_BOOK)
                        ->set('path')->eq($cataloguePath)
                        ->where('id')->eq($catalogueID)
                        ->exec();
                    $i ++;
                }
                else
                {
                    $catalogueID = $key;
                    $this->dao->update(TABLE_BOOK)
                        ->set('title')->eq($catalogueTitle)
                        ->set('type')->eq($this->post->type[$key])
                        ->set('order')->eq($this->post->order[$key])
                        ->where('id')->eq($catalogueID)
                        ->exec();
                }
            }

            return $catalogueID;
        }
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

        return $this->dao->select('*')->from(TABLE_BOOK)
            ->where('type')->ne('article')
            ->beginIF($startPath)->andWhere('path')->like($startPath)->fi()
            ->orderBy('grade desc, `order`')
            ->get();
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
        
        $this->dao->update(TABLE_BOOK)
            ->data($book, $skip = 'uid')
            ->autoCheck()
            ->batchCheck($this->config->book->edit->requiredFields, 'notempty')
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
    public function delete($id, $null = null)
    {
        $book = $this->getByID($id);
        if(!$book) return false;

        $this->dao->delete()->from(TABLE_BOOK)->where('id')->eq($id)->exec();
        return !dao::isError();
    }
}
