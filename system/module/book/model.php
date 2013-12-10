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
     * Get a book or a catalogue by id or alias.
     *
     * @param  string $id
     * @param  bool   $replaceTag
     * @access public
     * @return array
     */
    public function getByID($id, $replaceTag = true)
    {
        $book = $this->dao->select('*')->from(TABLE_BOOK)->where('alias')->eq($id)->fetch();
        if(!$book) $book = $this->dao->select('*')->from(TABLE_BOOK)->where('id')->eq($id)->fetch();
        $book->pathNames = $this->dao->select('id, title')->from(TABLE_BOOK)->where('id')->in($book->path)->orderBy('grade')->fetchPairs();

        /* Add link to content if necessary. */
        if($replaceTag && !empty($book->content)) $book->content = $this->loadModel('tag')->addLink($book->content);
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
     * Get bookID of one catalogue.
     * 
     * @param  string    $path 
     * @access public
     * @return array
     */
    public function getBookID($path)
    {
        $origins = explode(',', $path);
        return $origins[1];
    }

    /**
     * Get book of one catalogue.
     * 
     * @param  string    $path 
     * @access public
     * @return array
     */
    public function getBook($path)
    {
       $origins = explode(',', $path);
       $origin  = $origins[1];
       return $this->dao->select('id, title, alias')->from(TABLE_BOOK)->where('id')->eq($origin)->andWhere('type')->eq('book')->fetch();
    }

    /**
     * Get children catalogues of one catalogue.
     * 
     * @param  int    $catalogueID 
     * @access public
     * @return array
     */
    public function getChildren($catalogueID)
    {
        return $this->dao->select('*')->from(TABLE_BOOK)
            ->where('parent')->eq((int)$catalogueID)
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
        /* First, get all catalogues. */
        $treeMenu   = array();
        $stmt       = $this->dbh->query($this->buildQuery($startParent));
        $catalogues = array();
        while($catalogue = $stmt->fetch()) $catalogues[$catalogue->id] = $catalogue;

        /* Cycle them, build the select control.  */
        foreach($catalogues as $catalogue)
        {
            $origins = explode(',', $catalogue->path);
            $catalogueTitle = '/';
            foreach($origins as $origin)
            {
                if(empty($origin)) continue;
                $catalogueTitle .= $catalogues[$origin]->title . '/';
            }
            $catalogueTitle = rtrim($catalogueTitle, '/');
            $catalogueTitle .= "|$catalogue->id\n";

            if(isset($treeMenu[$catalogue->id]) and !empty($treeMenu[$catalogue->id]))
            {
                if(isset($treeMenu[$catalogue->parent]))
                {
                    $treeMenu[$catalogue->parent] .= $catalogueTitle;
                }
                else
                {
                    $treeMenu[$catalogue->parent] = $catalogueTitle;;
                }

                $treeMenu[$catalogue->parent] .= $treeMenu[$catalogue->id];
            }
            else
            {
                if(isset($treeMenu[$catalogue->parent]) and !empty($treeMenu[$catalogue->parent]))
                {
                    $treeMenu[$catalogue->parent] .= $catalogueTitle;
                }
                else
                {
                    $treeMenu[$catalogue->parent] = $catalogueTitle;
                }    
            }
        }

        $topMenu = @array_pop($treeMenu);
        $topMenu = explode("\n", trim($topMenu));
        if(!$removeRoot) $lastMenu[] = '/';

        foreach($topMenu as $menu)
        {
            if(!strpos($menu, '|')) continue;

            $menu        = explode('|', $menu);
            $label       = array_shift($menu);
            $catalogueID = array_pop($menu);
           
            $lastMenu[$catalogueID] = $label;
        }

        return $lastMenu;
    }

    /**
     * Show book catalogue in browse.
     * 
     * @param  int    $catalogueID 
     * @access public
     * @return void
     */
    public function getFrontCatalogue($catalogueID = 0)
    {
        if(!isset($this->catalogue)) $this->catalogue = '';
        
        $catalogue = $this->getByID($catalogueID);
        $parent    = $this->getByID($catalogue->parent);
        $children  = $this->getChildren(isset($catalogue->id) ? $catalogue->id : 0);
        if(!empty($catalogue))
        {
            $book  = $this->getBook($catalogue->path);
            $order = $this->getChapterNumber($catalogue->path);
            $this->lastChapter = $order;

            $linkOnTitle = $catalogue->type == 'chapter' ? helper::createLink('book', 'browse', "bookID=$catalogue->id", "book=$book->alias&title=$catalogue->alias") : helper::createLink('book', 'read', "articleID=$catalogue->id", "book=$book->alias&article=$catalogue->alias");

            if($catalogue->type == 'chapter')
            {
                $this->catalogue .= "<dd class='catalogue chapter'><strong><span class='order'>" . $order . '</span>&nbsp;' . html::a($linkOnTitle, $catalogue->title) . "</strong>" . $editButton . $deleteButton . $create . $sort . '</dd>';
            }
            elseif($catalogue->type == 'article')
            {
                $this->catalogue .= "<dd class='catalogue article'><strong><span class='order'>" . $order . '</span></strong>&nbsp;' . html::a($linkOnTitle, $catalogue->title) . $editButton . $deleteButton . $sort . '</dd>';
            }
        }

        if(!empty($children)) 
        {
            if($catalogue) $this->catalogue .= '<dl>';
            foreach($children as $child)
            {
                $this->getFrontCatalogue($child->id);
            }
            if($catalogue) $this->catalogue .= '</dl>';
        }
        return $this->catalogue;
    }

    /**
     * Show book catalogue in admin.
     * 
     * @param  int    $catalogueID 
     * @access public
     * @return void
     */
    public function getAdminCatalogue($catalogueID = 0)
    {
        if(!isset($this->catalogue)) $this->catalogue = '';
        
        $catalogue = $this->getByID($catalogueID);
        $children = $this->getChildren(isset($catalogue->id) ? $catalogue->id : 0);
        if(!empty($catalogue))
        {
            /* Add self to tree. */
            $order = $this->getChapterNumber($catalogue->path);
            $this->lastChapter = $order;

            $title        = $catalogue->type == 'book' ? $catalogue->title : html::a(helper::createLink('book', 'admin', "bookID=$catalogue->id"), $catalogue->title);
            $editButton   = html::a(helper::createLink('book', 'edit', "bookID=$catalogue->id"), $this->lang->edit, "data-toggle='modal' data-width='1000px'");
            $deleteButton = empty($children) ? html::a(helper::createLink('book', 'delete', "bookID=$catalogue->id"), $this->lang->delete, "class='deleter'") : '';
            $create       = html::a(helper::createLink('book', 'create', "bookID=$catalogue->id"), $this->lang->book->create);
            $sortup       = html::a(helper::createLink('book', 'up', "bookID=$catalogue->id"), "<i class='icon-arrow-up'></i>", "class='sort'");
            $sortdown     = html::a(helper::createLink('book', 'down', "bookID=$catalogue->id"), "<i class='icon-arrow-down'></i>", "class='sort'");

            if($catalogue->type == 'book')
            {
                $this->catalogue .= "<dt class='book'><strong>" . $title . '</strong><span class="actions">' . $editButton . $deleteButton . $create . '</span></dt>';
            }
            elseif($catalogue->type == 'chapter')
            {
                $this->catalogue .= "<dd class='catalogue chapter'><strong><span class='order'>" . $order . '</span>&nbsp;' . $title . '</strong><span class="actions">' . $editButton . $deleteButton . $create . $sortup . $sortdown . '</span></dd>';
            }
            elseif($catalogue->type == 'article')
            {
                $this->catalogue .= "<dd class='catalogue article'><strong><span class='order'>" . $order . '</span>&nbsp;' . $catalogue->title . '</strong><span class="actions">' . $editButton . $deleteButton . $sortup . $sortdown . '</span></dd>';
            }
        }

        if(!empty($children)) 
        {
            if($catalogue) $this->catalogue .= '<dl>';
            foreach($children as $child)
            {
                $this->getAdminCatalogue($child->id);
            }
            if($catalogue) $this->catalogue .= '</dl>';
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
        if(!$parent)
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
            if(!$this->checkAlias($book)) return sprintf($this->lang->book->aliasRepeat, $book->alias);

            $this->dao->insert(TABLE_BOOK)
                ->data($book)
                ->autoCheck()
                ->batchCheck($this->config->book->createBook->requiredFields, 'notempty')
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
            $now = helper::now();
            $catalogue = new stdclass();
            $catalogue->parent     = $parent ? $parent->id : 0;
            $catalogue->grade      = $parent ? $parent->grade + 1 : 1;
            $catalogue->addedDate  = $now;
            $catalogue->editedDate = $now;

            $catalogues = $this->post->title;
            $i = 1;
            foreach($catalogues as $key => $catalogueTitle)
            {
                if(empty($catalogueTitle)) continue;

                /* First, save the child without path field. */
                $now = helper::now();
                $catalogue->title      = $catalogueTitle;
                $catalogue->type       = $this->post->type[$key];
                $catalogue->alias      = $this->post->alias[$key];
                $catalogue->keywords   = $this->post->keywords[$key];
                $catalogue->order      = $this->post->order[$key];
                $mode = $this->post->mode[$key];

                $catalogue->alias    = seo::unify($catalogue->alias, '-');
                $catalogue->keywords = seo::unify($catalogue->keywords, ',');

                /* Add id to check alias. */
                $catalogue->id = $mode == 'new' ?  0 : $key;
                if(!$this->checkAlias($catalogue)) return sprintf($this->lang->book->aliasRepeat, $catalogue->alias);

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
                    unset($catalogue->addedDate);
                    $catalogueID = $key;

                    $this->dao->update(TABLE_BOOK)
                        ->data($catalogue)
                        ->autoCheck()
                        ->where('id')->eq($catalogueID)
                        ->exec();
                }

                /* Save keywords. */
                $this->loadModel('tag')->save($catalogue->keywords);
            }


            return !dao::isError();
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
        $type = $this->dao->select('type')->from(TABLE_BOOK)->where('id')->eq($bookID)->fetch('type');

        $book = fixer::input('post')
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->stripTags('content', $this->config->allowedTags->admin)
            ->get();

        $book->keywords = seo::unify($book->keywords, ',');
        $book->alias    = seo::unify($book->alias, '-');

        /* Add id to check alias. */
        $book->id = $bookID; 
        if(!$this->checkAlias($book)) return sprintf($this->lang->book->aliasRepeat, $book->alias);
        
        $this->dao->update(TABLE_BOOK)
            ->data($book, $skip = 'uid')
            ->autoCheck()
            ->batchCheckIF($type == 'book', $this->config->book->editBook->requiredFields, 'notempty')
            ->batchCheck($this->config->book->edit->requiredFields, 'notempty')
            ->where('id')->eq($bookID)
            ->exec();

        $this->loadModel('file')->updateObjectID($this->post->uid, $bookID, 'book');
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

    /**
     * Get the prev and next ariticle.
     * 
     * @param  int    $current  the current article id.
     * @param  int    $parent   the parent id.
     * @access public
     * @return array
     */
    public function getPrevAndNext($current, $parent)
    {
       $article = $this->getByID($current);
       $prev = $this->dao->select('id, title, alias')->from(TABLE_BOOK)
           ->where('parent')->eq($parent)
           ->andWhere('type')->eq('article')
           ->andWhere('`order`')->lt($article->order)
           ->orderBy('`order` desc')
           ->limit(1)
           ->fetch();

       $next = $this->dao->select('id, title, alias')->from(TABLE_BOOK)
           ->where('parent')->eq($parent)
           ->andWhere('type')->eq('article')
           ->andWhere('`order`')->gt($article->order)
           ->orderBy('`order`')
           ->limit(1)
           ->fetch();

        return array('prev' => $prev, 'next' => $next);
    }

    /**
     * Check if alias available.
     *
     * @param  object    $book 
     * @access public
     * @return void
     */
    public function checkAlias($book)
    {
        if(empty($book)) return false;
        if($book->alias == '') return true;
        if(empty($book->id)) $book->id = 0;

        $count = $this->dao->select('count(*) as count')->from(TABLE_BOOK)
            ->where('`alias`')->eq($book->alias)
            ->andWhere('id')->ne($book->id)
            ->andWhere('parent')->eq($book->parent)
            ->andWhere('type')->eq($book->type)
            ->fetch('count');
        return $count < 1;
    }
}
