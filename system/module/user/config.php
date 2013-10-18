<?php
$config->user->register = new stdclass();
$config->user->register->requiredFields = 'account,realname,email,password1';

$config->user->edit = new stdclass();
$config->user->edit->requiredFields = 'realname,email';

$config->user->default = new stdclass();
$config->user->default->module = RUN_MODE == 'front' ? 'user'    : 'admin';
$config->user->default->method = RUN_MODE == 'front' ? 'control' : 'index';

$config->oauth       = new stdclass();
$config->oauth->qq   = new stdclass();
$config->oauth->sina = new stdclass();

$config->oauth->qq->clientID     = '100541446';
$config->oauth->qq->clientSecret = 'd92ba3b693ace4faf40e036bd0383080';

$config->oauth->sina->clientID     = '708769934';
$config->oauth->sina->clientSecret = 'bcacf0c76b1e5a713ccdef1db9cbba39';
