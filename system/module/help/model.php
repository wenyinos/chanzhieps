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
     * @param  string    $book 
     * @param  int       $chapter 
     * @access public
     * @return void
     */
    public function getBookCatalogue($book, $chapter = 0)
    {
        $code = str_replace('book_', '', $book);
        if(!isset($this->catalogue)) $this->catalogue = '';
        
        $chapter = $this->loadModel('tree')->getByID($chapter);
        if(!empty($chapter))
        {
            /* Add self to tree. */
            $order = $this->getChapterNumber($chapter->path);
            $this->lastChapter = $order;
            $this->catalogue .= "<dt><strong>" . html::a(helper::createLink('help', 'book', "type=$code&categoryID=$chapter->id", "category={$chapter->alias}"), $order .  $chapter->name) . '</strong></dt>';
        }
        $children = $this->tree->getChildren(isset($chapter->id) ? $chapter->id : 0, $book);

        if(!empty($children)) 
        {
            if($chapter) $this->catalogue .= '<dl>';
            foreach($children as $child)
            {
                $this->getBookCatalogue($book, $child->id);
            }
            if($chapter) $this->catalogue .= '</dl>';
        }
        if($chapter) 
        {
            $articleCatalogue = $this->getArticleCatalogue($book, $chapter, $this->lastChapter);
            if($articleCatalogue != '')  $this->catalogue .= "<dl>{$articleCatalogue}</dl>";
        }
        return $this->catalogue;
    }

    /**
     * Get article catalogue. 
     * 
     * @param  string    $book 
     * @param  object    $currentChapter
     * @param  int       $preChapter 
     * @access public
     * @return void
     */
    public function getArticleCatalogue($book, $currentChapter, $preChapter)
    {
        if(empty($currentChapter)) return '';

        $catalogue = '';
        $book = str_replace('book_', '', $book);

        $articles = $this->dao->select('t1.id, t1.order, title, t2.category')->from(TABLE_ARTICLE)
            ->alias('t1')->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
            ->where('category')->eq($currentChapter->id)
            ->orderBy('t1.order')
            ->fetchAll('id');

        $i = 1;
        if($preChapter !== $this->getChapterNumber($currentChapter->path))
        {
            $path = explode('.', $preChapter);
            $i    = end($path) + 1;
            unset($path[count($path)-1]);
            $preChapter = join('.', $path);
        }

        foreach($articles as $article)
        {   
            $url  = helper::createLink('help', 'read', "article=$article->id&book={$book}", "category={$currentChapter->alias}&name=$article->alias");
            $link = html::a($url, $preChapter . '.' . $i . $article->title); 
            $catalogue .= "<dd class='f-14px'>" . $link . '</dd>';
            $i++;
        }
        return $catalogue;
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
        $preFix  = '';
        foreach($origins as $origin)
        {
            if(!$origin) continue;
            $category = $this->loadModel('tree')->getByID($origin);
            $category->sort = $this->countChapterOrder(str_replace('book_', '', $category->type), $category->id, $category->parent);
            $sort .= $category->sort . ".";
        }
        return trim($sort, '.');
    }

    /**
     * Get chapter's order in its brother queue.
     * 
     * @param  string    $book 
     * @param  string    $categoryID 
     * @param  int       $parentID 
     * @access public
     * @return void
     */
    public function countChapterOrder($code, $categoryID, $parentID = '')
    {
        $categories = $this->dao->select('*')->from(TABLE_CATEGORY)
            ->where('type')->eq('book_' . $code)
            ->beginIF($parentID !='')->andWhere('parent')->eq($parentID)->fi()
            ->orderBy('`order`')->fetchAll('id');

        $order = array_search($categoryID, array_keys($categories));
        return $order + 1;
    }

    /**
     * Get category Box of backend.
     * 
     * @param  string    $type 
     * @access public
     * @return void
     */
    public function getCategoryBox($type)
    {
        $book = $this->getBookByCode(str_replace('book_', '', $type));
        $treeMenu    = $this->loadModel('tree')->getTreeMenu($type, 0, array('treeModel', 'createBookLink'));
        $backButton  =  html::a(helper::createLink('help', 'admin', "type={$type}"), $this->lang->help->backtobooks, "class='btn btn-default btn-sm'");

        $categoryBox = <<<Eof
            <div class='col-md-2'>
              <table class='table'>
                <caption>
                  {$book->name}
                </caption>
               <tr>
                 <td><div id='treeMenuBox'>{$treeMenu} {$backButton}</div></td>
               </tr>
             </table>
           </div>
Eof;
        return $categoryBox;
    }

    /**
     * Create a book.
     *
     * @access public
     * @return bool
     */
    public function createBook()
    {
        $book = fixer::input('post')->get();

        $setting = new stdclass();
        $setting->owner   = 'system';
        $setting->module  = 'common';
        $setting->section = 'book';
        $setting->key     = $book->code;
        unset($book->code);
        $setting->value   = helper::jsonEncode($book);
        
        $books = $this->dao->select('*')->from(TABLE_CONFIG)
            ->where('owner')->eq('system')
            ->andWhere('module')->eq('common')
            ->andWhere('section')->eq('book')
            ->andWhere('`key`')->eq($setting->key)
            ->fetchAll();

        $errors = array();

        if(count($books) > 1)
        {
            $errors['code'] = $this->lang->help->codeunique;
        }
        elseif(count($books) == 1)
        {
            $errors['code'] = $this->lang->help->codeunique;
        }
        
        if(!ctype_alnum($setting->key)) $errors['code'] = $this->lang->help->codealnum;

        if(!$book->name) $errors['name'] = $this->lang->help->namenotempty;
        if(!$setting->key) $errors['code'] = $this->lang->help->codenotempty;

        if(!empty($errors)) return $errors;

        $this->dao->insert(TABLE_CONFIG)->data($setting)->exec();

        return !dao::isError();
    }

    /**
     * Get a book by code.
     *
     * @param string $code
     * @access public
     * @return array
     */
    public function getBookByCode($code)
    {
        $book = $this->dao->select('*')->from(TABLE_CONFIG)->where('`key`')->eq($code)->fetch();
        if(!$book) return false;

        $id   = $book->id;
        $key  = $book->key;    
        $book = json_decode($book->value);

        $book->id  = $id;
        $book->key = $key;

        return $book;
    }

    /**
     * Get a book by id.
     *
     * @param int $id
     * @access public
     * @return array
     */
    public function getBookByID($id)
    {
        $book = $this->dao->select('*')->from(TABLE_CONFIG)->where('id')->eq($id)->fetch();
        if(!$book) return false;

        $id   = $book->id;
        $key  = $book->key;    
        $book = json_decode($book->value);

        $book->id  = $id;
        $book->key = $key;

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
        $book = $this->dao->select('*')->from(TABLE_CONFIG)
            ->where('owner')->eq('system')
            ->andWhere('module')->eq('common')
            ->andWhere('section')->eq('book')
            ->orderBy('id_desc')
            ->limit(1)
            ->fetch();

        if(!$book) return false;

        $id   = $book->id;
        $key  = $book->key;    
        $book = json_decode($book->value);

        $book->id  = $id;
        $book->key = $key;

        return $book;
    }

    /**
     * Get book list.
     *
     * @access public
     * @return array
     */
    public function getBookList($pager = null)
    {
        $books = $this->dao->select('*')->from(TABLE_CONFIG)
            ->where('owner')->eq('system')
            ->andWhere('module')->eq('common')
            ->andWhere('section')->eq('book')
            ->orderBy('id_desc')
            ->page($pager)
            ->fetchAll('id');

        foreach($books as $bookID => $book)
        {
            $id  = $book->id;
            $key = $book->key;
            $books[$bookID]      = json_decode($book->value);
            $books[$bookID]->key = $key;
            $books[$bookID]->id  = $id; 
        }

        return $books;
    }

    /**
     * Update a book.
     *
     * @param int $id
     * @access public
     * @return bool
     */
    public function updateBook($id)
    {
        $book = fixer::input('post')->get();
        $setting->key  = $book->code;
        unset($book->code);
        $setting->value = helper::jsonEncode($book);
        
        $books = $this->dao->select('*')->from(TABLE_CONFIG)
            ->where('owner')->eq('system')
            ->andWhere('module')->eq('common')
            ->andWhere('section')->eq('book')
            ->andWhere('`key`')->eq($setting->key)
            ->fetchAll();

        $errors = array();

        if(count($books) > 1)
        {
            $errors['code'] = $this->lang->help->codeunique;
        }
        elseif(count($books) == 1 && $books[0]->id != $id)
        {
            $errors['code'] = $this->lang->help->codeunique;
        }

        if(!ctype_alnum($setting->key)) $errors['code'] = $this->lang->help->codealnum;

        if(!$book->name) $errors['name'] = $this->lang->help->namenotempty;
        if(!$setting->key) $errors['code'] = $this->lang->help->codenotempty;
        
        if(!empty($errors)) return $errors;

        $this->dao->update(TABLE_CONFIG)->data($setting)->where('id')->eq($id)->exec();

        return !dao::isError();
    }

    /**
     * Delete a book.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBook($id)
    {
        $book = $this->getBookByID($id);
        if(!$book) return false;
        
        $this->dao->delete()->from(TABLE_CONFIG)->where('id')->eq($id)->exec();
        $this->dao->delete()->from(TABLE_CATEGORY)->where('type')->eq($book->key)->exec();
        $this->dao->delete()->from(TABLE_RELATION)->where('type')->eq($book->key)->exec();

        return !dao::isError();
    }
}
