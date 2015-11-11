<?php
$config->guarder = new stdclass();

$config->guarder->limits = new stdclass();

$config->guarder->limits->account = new stdclass;
$config->guarder->limits->account->interval = new stdclass;
$config->guarder->limits->account->day    = new stdclass;

$config->guarder->limits->ip = new stdclass;
$config->guarder->limits->ip->interval = new stdclass;
$config->guarder->limits->ip->day      = new stdclass;

$config->guarder->limits->ip->interval->register        = 10;
$config->guarder->limits->ip->interval->resetPassword   = 10;
$config->guarder->limits->ip->interval->resetPWDFailure = 10;
$config->guarder->limits->ip->interval->logonFailure    = 10;
$config->guarder->limits->ip->interval->post            = 10;
$config->guarder->limits->ip->interval->postThread      = 3;
$config->guarder->limits->ip->interval->postReply       = 5;
$config->guarder->limits->ip->interval->postComment     = 3;
$config->guarder->limits->ip->interval->error404        = 10;
$config->guarder->limits->ip->interval->search          = 10;
$config->guarder->limits->ip->interval->captchaFail     = 5;

$config->guarder->limits->ip->day->register        = 30;
$config->guarder->limits->ip->day->resetPassword   = 30;
$config->guarder->limits->ip->day->resetPWDFailure = 30;
$config->guarder->limits->ip->day->logonFailure    = 30;
$config->guarder->limits->ip->day->post            = 30;
$config->guarder->limits->ip->day->postThread      = 5;
$config->guarder->limits->ip->day->postReply       = 10;
$config->guarder->limits->ip->day->postComment     = 5;
$config->guarder->limits->ip->day->error404        = 100;
$config->guarder->limits->ip->day->search          = 100;
$config->guarder->limits->ip->day->captchaFail     = 20;

$config->guarder->limits->account = $config->guarder->limits->ip;

$config->guarder->interval = new stdclass();
$config->guarder->interval->ip      = new stdclass;
$config->guarder->interval->account = new stdclass;

$config->guarder->interval->ip->register        = 3;
$config->guarder->interval->ip->resetPassword   = 3;
$config->guarder->interval->ip->resetPWDFailure = 3;
$config->guarder->interval->ip->logonFailure    = 3;
$config->guarder->interval->ip->post            = 10;
$config->guarder->interval->ip->postThread      = 10;
$config->guarder->interval->ip->postComment     = 10;
$config->guarder->interval->ip->postReply       = 10;
$config->guarder->interval->ip->error404        = 1;
$config->guarder->interval->ip->search          = 1;
$config->guarder->interval->ip->captchaFail     = 1;

$config->guarder->interval->account = $config->guarder->interval->ip;


$config->guarder->punishment = new stdclass();

$config->guarder->punishment->account = new stdclass;
$config->guarder->punishment->account->minute = new stdclass;
$config->guarder->punishment->account->day    = new stdclass;

$config->guarder->punishment->ip = new stdclass;
$config->guarder->punishment->ip->interval = new stdclass;
$config->guarder->punishment->ip->day      = new stdclass;

$config->guarder->punishment->ip->interval->register        = 0.25;
$config->guarder->punishment->ip->interval->resetPassword   = 0.25;
$config->guarder->punishment->ip->interval->resetPWDFailure = 0.25;
$config->guarder->punishment->ip->interval->logonFailure    = 0.25;
$config->guarder->punishment->ip->interval->post            = 1;
$config->guarder->punishment->ip->interval->postThread      = 1;
$config->guarder->punishment->ip->interval->postReply       = 1;
$config->guarder->punishment->ip->interval->postComment     = 1;
$config->guarder->punishment->ip->interval->error404        = 0.25;
$config->guarder->punishment->ip->interval->search          = 0.25;
$config->guarder->punishment->ip->interval->captchaFail     = 0.5;

$config->guarder->punishment->ip->day->register        = 0.25;
$config->guarder->punishment->ip->day->resetPassword   = 0.25;
$config->guarder->punishment->ip->day->resetPWDFailure = 0.25;
$config->guarder->punishment->ip->day->logonFailure    = 0.25;
$config->guarder->punishment->ip->day->post            = 1;
$config->guarder->punishment->ip->day->postThread      = 1;
$config->guarder->punishment->ip->day->postReply       = 1;
$config->guarder->punishment->ip->day->postComment     = 1;
$config->guarder->punishment->ip->day->error404        = 0.25;
$config->guarder->punishment->ip->day->search          = 0.25;
$config->guarder->punishment->ip->day->captchaFail     = 0.5;

$config->guarder->punishment->account = $config->guarder->punishment->ip;
