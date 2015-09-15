<?php
$config->score->counts = new stdclass();
$config->score->counts->register     = 50;
$config->score->counts->login        = 2;
$config->score->counts->maxLogin     = 10;

$config->score->counts->thread       = 5;
$config->score->counts->reply        = 3;
$config->score->counts->delThread    = 15;
$config->score->counts->delReply     = 9;

$config->score->buyScore = new stdclass(); 
$config->score->buyScore->perYuan   = 1 / 0.1; 
$config->score->buyScore->minAmount = 1; 

$config->score->ranking = new stdclass();
$config->score->ranking->limit = 20;
