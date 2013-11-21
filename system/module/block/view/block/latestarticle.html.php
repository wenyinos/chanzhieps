<?php
/**
 * The latest article front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php $latestArticles = $this->loadModel('article')->getLatest($block->category, $block->limit);?>
<div class="panel panel-default">
  <div class="panel-heading"><h3><?php echo $lang->index->news;?></h3></div>
  <div class="panel-body"><ul class='mg-zero pd-zero'>
    <?php foreach($latestArticles as $article): ?>
    <?php 
    $category = array_shift($article->categories);
    $url = helper::createLink('article', 'view', "id={$article->id}", "category={$category->alias}&name={$article->alias}");
    ?>
    <li>
      <i class='icon-chevron-right'></i>
      <?php echo html::a($url, $article->title, "class='latest-news' title='{$article->title}'");?>
    </li>
    <?php endforeach;?>
  </ul></div>
</div>
