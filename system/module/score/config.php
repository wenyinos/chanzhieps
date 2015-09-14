<?php
$config->score->counts = new stdclass();
$config->score->counts->register     = 50;
$config->score->counts->bind         = 150;
$config->score->counts->login        = 2;
$config->score->counts->maxLogin     = 10;

$config->score->counts->thread       = 5;
$config->score->counts->reply        = 3;
$config->score->counts->delThread    = 15;
$config->score->counts->delReply     = 9;

$config->score->counts->answer       = 5;
$config->score->counts->setAsFAQ     = 50;
$config->score->counts->delQuestion  = 10;
$config->score->counts->delAnswer    = 10;

$config->score->counts->indexPage    = 50;
$config->score->counts->subPage      = 10;
$config->score->counts->clickLink    = 1;
$config->score->counts->totalScoreOfDomain = 200;

$config->score->counts->usercase      = 50;
$config->score->counts->classicalCase = 150;
$config->score->counts->showCase      = 1;
$config->score->counts->delCase       = 100;

$config->score->buyScore = new stdclass(); 
$config->score->buyScore->perYuan   = 1 / 0.1; 
$config->score->buyScore->minAmount = 1; 

$config->score->ranking = new stdclass();
$config->score->ranking->limit = 20;
