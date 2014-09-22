<?php
$config->ui = new stdclass();
$config->ui->groups = array('basic', 'nav', 'block', 'footer');

$config->ui->selectorOptions = array();

$config->ui->selectorOptions['basic']['color'] = array();
$config->ui->selectorOptions['basic']['color']['primaryColor'] = array('type' => 'color', 'default' => '#3280FC');
$config->ui->selectorOptions['basic']['color']['backcolor']    = array('type' => 'color', 'default' => '#FFF');
$config->ui->selectorOptions['basic']['color']['forecolor']    = array('type' => 'color', 'default' => '#333');

$config->ui->selectorOptions['basic']['pageBackground'] = array();
$config->ui->selectorOptions['basic']['pageBackground']['backcolor']       = array('type' => 'color', 'default' => 'transparent');
$config->ui->selectorOptions['basic']['pageBackground']['backgroundImage'] = array('type' => 'image', 'default' => 'none');
$config->ui->selectorOptions['basic']['pageBackground']['repeat']          = array('type' => 'repeat', 'default' => 'repeat');
$config->ui->selectorOptions['basic']['pageBackground']['position']        = array('type' => 'position', 'default' => '0,0');

$config->ui->selectorOptions['basic']['pageText'] = array();
$config->ui->selectorOptions['basic']['pageText']['color']      = array('type' => 'color', 'default' => '#333');
$config->ui->selectorOptions['basic']['pageText']['fontSize']   = array('type' => 'fontSize', 'default' => '13px');
$config->ui->selectorOptions['basic']['pageText']['fontFamily'] = array('type' => 'fontFamily', 'default' => '');
$config->ui->selectorOptions['basic']['pageText']['fontWeight'] = array('type' => 'fontWeight', 'default' => 'normal');

$config->ui->selectorOptions['basic']['aLink'] = array();
$config->ui->selectorOptions['basic']['aLink']['color']      = array('type' => 'color', 'default' => '#333');
$config->ui->selectorOptions['basic']['aLink']['fontWeight'] = array('type' => 'fontWeight', 'default' => 'normal');

$config->ui->selectorOptions['basic']['aVisited'] = array();
$config->ui->selectorOptions['basic']['aVisited']['color']      = array('type' => 'color', 'default' => '#333');
$config->ui->selectorOptions['basic']['aVisited']['fontWeight'] = array('type' => 'fontWeight', 'default' => 'normal');

$config->ui->selectorOptions['basic']['aHover'] = array();
$config->ui->selectorOptions['basic']['aHover']['color']      = array('type' => 'color', 'default' => '#333');
$config->ui->selectorOptions['basic']['aHover']['fontWeight'] = array('type' => 'fontWeight', 'default' => 'normal');

$config->ui->selectorOptions['navbar']['layout'] = array();
$config->ui->selectorOptions['navbar']['layout']['layout'] = array('type' => 'navLayout', 'default' => 'false');

$config->ui->selectorOptions['navbar']['navbar'] = array();
$config->ui->selectorOptions['navbar']['navbar']['backcolor']       = array('type' => 'color', 'default' => '#E5E5E5');
$config->ui->selectorOptions['navbar']['navbar']['backgroundImage'] = array('type' => 'image', 'default' => 'none');
$config->ui->selectorOptions['navbar']['navbar']['repeat']          = array('type' => 'repeat', 'default' => 'repeat');
$config->ui->selectorOptions['navbar']['navbar']['position']        = array('type' => 'position', 'default' => '0,0');
$config->ui->selectorOptions['navbar']['navbar']['border']          = array('type' => 'border', 'default' => 'solid');
$config->ui->selectorOptions['navbar']['navbar']['borderColor']     = array('type' => 'color', 'default' => '#DDD');
$config->ui->selectorOptions['navbar']['navbar']['borderWidth']     = array('type' => 'size', 'default' => '1px');
$config->ui->selectorOptions['navbar']['navbar']['radius']          = array('type' => 'size',  'default' => '3px');

$config->ui->selectorOptions['navbar']['panel'] = array();
$config->ui->selectorOptions['navbar']['panel']['backcolor']   = array('type' => 'color', 'default' => '#E5E5E5');
$config->ui->selectorOptions['navbar']['panel']['border']      = array('type' => 'border', 'default' => 'solid');
$config->ui->selectorOptions['navbar']['panel']['borderColor'] = array('type' => 'color', 'default' => '#DDD');
$config->ui->selectorOptions['navbar']['panel']['borderWidth'] = array('type' => 'size', 'default' => '1px');
$config->ui->selectorOptions['navbar']['panel']['radius']      = array('type' => 'size',  'default' => '3px');

$config->ui->selectorOptions['navbar']['menuNormal'] = array();
$config->ui->selectorOptions['navbar']['menuNormal']['color']      = array('type' => 'color',  'default' => '#151515');
$config->ui->selectorOptions['navbar']['menuNormal']['fontSize']   = array('type' => 'fontSize',  'default' => 'inherit');
$config->ui->selectorOptions['navbar']['menuNormal']['fontFamily'] = array('type' => 'fontFamily',  'default' => 'inherit');
$config->ui->selectorOptions['navbar']['menuNormal']['fontWeight'] = array('type' => 'fontWeight',  'default' => 'bord');

$config->ui->selectorOptions['navbar']['menuHover'] = array();
$config->ui->selectorOptions['navbar']['menuHover']['color'] = array('type' => 'color',  'default' => '#151515');
$config->ui->selectorOptions['navbar']['menuHover']['backcolor'] = array('type' => 'color',  'default' => '');

$config->ui->selectorOptions['navbar']['menuActive'] = array();
$config->ui->selectorOptions['navbar']['menuActive']['color']     = array('type' => 'color',  'default' => '#151515');
$config->ui->selectorOptions['navbar']['menuActive']['backcolor'] = array('type' => 'color',  'default' => '');

$config->ui->selectorOptions['navbar']['submenuNormal'] = array();
$config->ui->selectorOptions['navbar']['submenuNormal']['color']      = array('type' => 'color',  'default' => '#151515');
$config->ui->selectorOptions['navbar']['submenuNormal']['fontSize']   = array('type' => 'fontSize',  'default' => 'inherit');
$config->ui->selectorOptions['navbar']['submenuNormal']['fontFamily'] = array('type' => 'fontFamily',  'default' => 'inherit');
$config->ui->selectorOptions['navbar']['submenuNormal']['fontWeight'] = array('type' => 'fontWeight',  'default' => 'bord');

$config->ui->selectorOptions['navbar']['submenuHover'] = array();
$config->ui->selectorOptions['navbar']['submenuHover']['color'] = array('type' => 'color',  'default' => '#151515');
$config->ui->selectorOptions['navbar']['submenuHover']['backcolor'] = array('type' => 'color',  'default' => '');

$config->ui->selectorOptions['navbar']['submenuActive'] = array();
$config->ui->selectorOptions['navbar']['submenuActive']['color']     = array('type' => 'color',  'default' => '#151515');
$config->ui->selectorOptions['navbar']['submenuActive']['backcolor'] = array('type' => 'color',  'default' => '');
