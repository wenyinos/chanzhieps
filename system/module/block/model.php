<?php
/**
 * The model file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     block
 * @version     $ID$
 * @link        http://www.chanzhi.org
 */
class blockModel extends model
{
    /**
     * Get block by id.
     * 
     * @param string $blockID 
     * @access public
     * @return object   the block.
     */
    public function getByID($blockID)
    {
        $block = $this->dao->findByID($blockID)->from(TABLE_BLOCK)->fetch();
        if($block->type != 'html') $block->content = json_decode($block->content);
        return $block;
    }

    /**
     * Get block list of one site.
     * 
     * @access public
     * @return array    the block lists.
     */
    public function getList($pager)
    {
        $blocks = $this->dao->select('*')->from(TABLE_BLOCK)->orderBy('id_desc')->page($pager)->fetchAll('id');
        return $blocks;
    }

    /**
     * Get block list of one site.
     * 
     * @access public
     * @return array    the block lists.
     */
    public function getPageBlocks($page, $region)
    {
        $blockIdList = $this->dao->select('*')->from(TABLE_LAYOUT)->where('page')->eq($page)->andWhere('region')->eq($region)->fetch('blocks');
        $blockIdList = explode($blocks, ',');

        $blocks = $this->dao->select('*')->from(TABLE_BLOCK)->where('id')->in($blocks)->fetchAll('id');

        $sortedBlocks = array();
        foreach($blocks as $id) $sortedBlocks[$id] = $blockList->$id;

        return $sortedBlocks;
    }

    /**
     * Get block id => title pairs.
     * 
     * @access public
     * @return void
     */
    public function getPairs()
    {
        return $this->dao->select('id, title')->from(TABLE_BLOCK)->orderBy('id')->fetchPairs();
    }

    /**
     * Create a block.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        $block = fixer::input('post')->get();

        if(isset($block->params))
        {
            foreach($block->params as $field => $value)
            {
                if(is_array($value)) $block->params[$field] = join($value, ',');
            }
            $block->content = json_encode($block->params);
        }

        $this->dao->insert(TABLE_BLOCK)->data($block, 'uid, params')->autoCheck()->exec();
        return true;
    }

    /**
     * Update  block.
     * 
     * @param string $blockID 
     * @access public
     * @return void
     */
    public function update($blockID)
    {
        $block = fixer::input('post')->get();

        if(isset($block->params))
        {
            foreach($block->params as $field => $value)
            {
                if(is_array($value)) $block->params[$field] = join($value, ',');
            }
            $block->content = json_encode($block->params);
        }

        $this->dao->update(TABLE_BLOCK)->data($block, 'params,uid,blockID')->autoCheck()->where('id')->eq($this->post->blockID)->exec();
        return true;
    }

    public function delete($blockID)
    {
        $this->dao->delete()->from(TABLE_BLOCK)->where('id')->eq($blockID)->exec();
        return !dao::isError();
    }

    /**
     * Set one page's layout.
     * 
     * @param string $page 
     * @param string $region 
     * @access public
     * @return void
     */
    public function setPage($page, $region)
    {
    }

    /**
     * Print the blocks of one region.
     * 
     * @param string $blocks        the blocks
     * @param string $region        the region 
     * @param string $showBoard     where print the order or not
     * @access public
     * @return void
     */
    public function printBlock($blocks, $region, $showBoard = true)
    {
        if(!isset($blocks[$region])) return;
        $blocks = $blocks[$region];
        foreach($blocks as $block)
        {
            if($showBoard)
            {
                echo "<div class='box-title'>$block->title</div>";
                echo '<div class="box-content">';
                $this->parseBlockContent($block);
                echo '</div>';
            }
            else
            {
                echo "<div>" . $this->parseBlockContent($block) . "</div>";
            }
        }
    }

    /**
     * Parse the content of one block.
     * 
     * @param string $block 
     * @access private
     * @return void
     */
    private function parseBlockContent($block)
    {
        if($block->type == 'html' )
        {
            echo $block->content;
        }
        elseif($block->type == 'php')
        {
            eval($block->content);
        }
        /* If the type is system, every line will be the param, first is module, second is method, last are params of the method. */
        elseif($block->type == 'system')
        {
            $params = explode("\n", trim($block->content));
            if(count($params) < 2) return;
            $module = trim($params[0]);
            $method = trim($params[1]);
            unset($params[0]);
            unset($params[1]);
            echo $this->app->control->fetch($module, $method, $params);
        }
    }
}
