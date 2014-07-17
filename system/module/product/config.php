<?php
$config->product->recPerPage = 15;

$config->product->require = new stdclass();
$config->product->require->create = 'categories, name, content';
$config->product->require->edit   = 'categories, name, content';

$config->product->editor = new stdclass();
$config->product->editor->create = array('id' => 'summary,content', 'tools' => 'full');
$config->product->editor->edit   = array('id' => 'summary,content', 'tools' => 'full');
