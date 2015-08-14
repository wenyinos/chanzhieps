<?php
$baseRoot    = dirname(dirname(dirname(__File__)));
$systemRoot = $baseRoot . "/system/";
$wwwRoot     = $baseRoot . "/www/";

$config = new stdclass();
$config->ui = new stdclass();
include $systemRoot . 'module/ui/config.php';

include $systemRoot . 'lib/lessc/lessc.class.php';
$lessc = new lessc();

$params = array();
foreach($config->ui->themes['default'] as $theme => $defaults)
{
    if(strpos(',default,tartan,wide,', $theme) === false) continue;
    foreach($defaults as $section => $selector)
    {
        foreach($selector as $attr => $settings)
        {
            foreach($settings as $setting) $params[$setting['name']] = $setting['default'];
        }
    }

    unset($params['background-image-position']);
    unset($params['navbar-background-image-position']);

    $lessc->setVariables($params);
    $cssFile      = $wwwRoot . 'data/css/default/' . $theme . '/style.css';
    $lessTemplate = $wwwRoot . 'template/default/theme/' . $theme . '/style.less';
    $lessc->compileFile($lessTemplate, $cssFile);
    print_r($cssFile . " Createed \n");
}
