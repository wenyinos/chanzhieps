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
     * @param  object    $pager 
     * @access public
     * @return void
     */
    public function getList($pager)
    {
        $blocks = $this->dao->select('*')->from(TABLE_BLOCK)->orderBy('id_desc')->page($pager)->fetchAll('id');
        return $blocks;
    }

    /**
     * Create form entry of one block backend.
     * 
     * @param  object  $block 
     * @access public
     * @return void
     */
    public function createEntry($block = null )
    {
        $blockOptions[''] = $this->lang->block->select;
        $blockOptions += $this->getPairs();
        $entry = "<tr class='v-middle'>";
        $entry .= '<td>' . html::select('blocks[]', $blockOptions, isset($block->id) ? $block->id : '') . '</td>';
        $entry .= '<td>';
        $entry .= html::a('javascript:;', $this->lang->block->add, "class='plus'");
        $entry .= html::a('javascript:;', $this->lang->delete, "class='delete'");
        $entry .= html::a(inlink('edit', "type={$block->type}&id={$block->id}"), $this->lang->edit, "class='delete'");
        $entry .= "<i class='icon-arrow-up'></i> <i class='icon-arrow-down'></i>";
        $entry .= '</td></tr>';
        return $entry;
    }

    /**
     * Get block list of one region.
     * 
     * @access public
     * @return array    the block lists.
     */
    public function getRegionBlocks($page, $region)
    {
        $blockIdList = $this->dao->select('*')->from(TABLE_LAYOUT)->where('page')->eq($page)->andWhere('region')->eq($region)->fetch('blocks');
        $blocks = $this->dao->select('*')->from(TABLE_BLOCK)->where('id')->in($blockIdList)->fetchAll('id');

        $blockIdList = explode(',', $blockIdList);

        $sortedBlocks = array();
        foreach($blockIdList as $id) 
        {
            if(isset($blocks[$id])) $sortedBlocks[$id] = $blocks[$id];
        }
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
        return $this->dao->select('id, title')->from(TABLE_BLOCK)->fetchPairs();
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

        $this->dao->insert(TABLE_BLOCK)->data($block, 'params,uid')->autoCheck()->exec();
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

    /**
     * Delete one block.
     * 
     * @param  int    $blockID 
     * @param  null    $table 
     * @access public
     * @return void
     */
    public function delete($blockID, $table = null)
    {
        $this->dao->delete()->from(TABLE_BLOCK)->where('id')->eq($blockID)->exec();
        return !dao::isError();
    }

    /**
     * Set block of one region.
     * 
     * @param string $page 
     * @param string $region 
     * @access public
     * @return void
     */
    public function setRegion($page, $region)
    {
        $layout = new stdclass();
        $layout->page   = $page;
        $layout->region = $region;
        $layout->blocks = join($_POST['blocks'], ',');

        $count = $this->dao->select('count(*) as count')->from(TABLE_LAYOUT)->where('page')->eq($page)->andWhere('region')->eq($region)->fetch('count');

        if($count)  $this->dao->update(TABLE_LAYOUT)->data($layout)->where('page')->eq($page)->andWhere('region')->eq($region)->exec();
        if(!$count) $this->dao->insert(TABLE_LAYOUT)->data($layout)->exec();

        return !dao::isError();
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
