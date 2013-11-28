<?php
$config->help->imgMaxWidth = 950;

$config->help->create = new stdclass();
$config->help->create->requiredFields = 'title';

$config->help->edit = new stdclass();
$config->help->edit->requiredFields = 'title';

$config->help->editor = new stdclass();
$config->help->editor->create = array('id' => 'content', 'tools' => 'simpleTools');
$config->help->editor->edit   = array('id' => 'content', 'tools' => 'simpleTools');
