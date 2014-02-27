<?php
$config->block->allowedTags = $config->allowedTags->admin . '<script><style><object><param><embed><form><button>';

$config->block->editor = new stdclass();
$config->block->editor->create = array('id' => 'content', 'tools' => 'full');
$config->block->editor->edit   = array('id' => 'content', 'tools' => 'full');

$config->block->defaultIcons = array();
$config->block->defaultIcons['about']         = 'icon-group';
$config->block->defaultIcons['contact']       = 'icon-phone';
$config->block->defaultIcons['links']         = 'icon-link';

$config->block->defaultIcons['latestArticle'] = 'icon-list-ul';
$config->block->defaultIcons['hotArticle']    = 'icon-list-ul';

$config->block->defaultIcons['latestProduct'] = 'icon-th';
$config->block->defaultIcons['hotProduct']    = 'icon-th';

$config->block->defaultIcons['articleTree']   = 'icon-folder-close';
$config->block->defaultIcons['productTree']   = 'icon-folder-close';
$config->block->defaultIcons['blogTree']      = 'icon-folder-close';
