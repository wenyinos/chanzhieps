<?php
$config->guarder = new stdclass();

$config->guarder->limits = new stdclass();

$config->guarder->limits->account = new stdclass;
$config->guarder->limits->account->minute = new stdclass;
$config->guarder->limits->account->day    = new stdclass;

$config->guarder->limits->ip = new stdclass;
$config->guarder->limits->ip->minute = new stdclass;

$config->guarder->limits->ip->minute->register      = 10;
$config->guarder->limits->ip->minute->resetPassword = 10;
$config->guarder->limits->ip->minute->logonFailure  = 10;
$config->guarder->limits->ip->minute->post          = 10;
$config->guarder->limits->ip->minute->postThread    = 10;
$config->guarder->limits->ip->minute->postReply     = 10;
$config->guarder->limits->ip->minute->postComment   = 10;
$config->guarder->limits->ip->minute->postReply     = 10;
$config->guarder->limits->ip->minute->threadFail    = 10;
$config->guarder->limits->ip->minute->commentFail   = 10;
$config->guarder->limits->ip->minute->error404      = 20;
$config->guarder->limits->ip->minute->search        = 10;
$config->guarder->limits->ip->minute->captchaFail   = 10;

$config->guarder->limits->ip->day = $config->guarder->limits->ip->minute;

$config->guarder->limits->account = $config->guarder->limits->ip;

$config->guarder->interval = new stdclass();
$config->guarder->interval->ip      = new stdclass;
$config->guarder->interval->account = new stdclass;

$config->guarder->interval->ip->register      = 5;
$config->guarder->interval->ip->resetPassword = 5;
$config->guarder->interval->ip->logonFailure  = 5;
$config->guarder->interval->ip->post          = 5;
$config->guarder->interval->ip->postThread    = 5;
$config->guarder->interval->ip->postComment   = 5;
$config->guarder->interval->ip->postReply     = 5;
$config->guarder->interval->ip->threadFail    = 5;
$config->guarder->interval->ip->commentFail   = 5;
$config->guarder->interval->ip->error404      = 5;
$config->guarder->interval->ip->search        = 5;
$config->guarder->interval->ip->captchaFail   = 5;

$config->guarder->interval->account = $config->guarder->interval->ip;


$config->guarder->punishment = new stdclass();

$config->guarder->punishment->account = new stdclass;
$config->guarder->punishment->account->minute = new stdclass;
$config->guarder->punishment->account->day    = new stdclass;

$config->guarder->punishment->ip = new stdclass;
$config->guarder->punishment->ip->minute = new stdclass;
$config->guarder->punishment->ip->day    = new stdclass;

$config->guarder->punishment->ip->minute->register      = 12;
$config->guarder->punishment->ip->minute->resetPassword = 12;
$config->guarder->punishment->ip->minute->logonFailure  = 12;
$config->guarder->punishment->ip->minute->post          = 12;
$config->guarder->punishment->ip->minute->postThread    = 12;
$config->guarder->punishment->ip->minute->postReply     = 12;
$config->guarder->punishment->ip->minute->postComment   = 12;
$config->guarder->punishment->ip->minute->threadFail    = 12;
$config->guarder->punishment->ip->minute->commentFail   = 12;
$config->guarder->punishment->ip->minute->error404      = 12;
$config->guarder->punishment->ip->minute->search        = 12;
$config->guarder->punishment->ip->minute->captchaFail   = 12;

$config->guarder->punishment->ip->day = $config->guarder->punishment->ip->minute;

$config->guarder->punishment->account = $config->guarder->punishment->ip;
