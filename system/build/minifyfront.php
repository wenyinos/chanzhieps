<?php
/**
* This file is used to compress css and js files.
*/

$baseDir = dirname(dirname(dirname(__FILE__)));

//--------------------------------- PROCESS JS FILES ------------------------------ //

/* Set jsRoot and jqueryRoot. */
$jsRoot     = $baseDir . '/www/js/';
$jqueryRoot = $jsRoot . 'jquery/';

/* Set js files to combined. */
$jsFiles[] = $jsRoot . 'jquery/min.js';
$jsFiles[] = $jsRoot . 'jquery/form/min.js';
$jsFiles[] = $jsRoot . 'jquery/treeview/min.js';
$jsFiles[] = $jsRoot . 'zui/min.js';
$jsFiles[] = $jsRoot . 'chanzhi.js';
$jsFiles[] = $jsRoot . 'my.js';

/* Combine these js files. */
$allJSFile  = $jsRoot . 'all.js';
$jsCode = '';
foreach($jsFiles as $jsFile) $jsCode .= "\n". file_get_contents($jsFile);
$result = file_put_contents($allJSFile, $jsCode);
if($result) echo "create all.js success\n";

$ie8Code = file_get_contents($jsRoot . 'html5shiv/min.js');
$ie8Code .= file_get_contents($jsRoot . 'respond/min.js');

$result = file_put_contents($jsRoot . 'all.ie8.js', $ie8Code);
if($result) echo "create all.ie8.js success\n";

$ie9Code = file_get_contents($jsRoot . 'jquery/placeholder/min.js');

$result = file_put_contents($jsRoot . 'all.ie9.js', $ie9Code);
if($result) echo "create all.ie9.js success\n";

/* Compress it. */
`java -jar ~/bin/yuicompressor/build/yuicompressor.jar --type js $allJSFile -o $allJSFile`;

//-------------------------------- PROCESS CSS FILES ------------------------------ //

/* Define the themeRoot. */
$themeRoot  = $baseDir . '/www/template/default/theme/';

/* Common css files. */
$cssCode  = str_replace('../fonts', '../../../../zui/fonts', file_get_contents($baseDir . '/www/zui/css/min.css'));
$cssCode .= file_get_contents($themeRoot . 'default/style.css');
$cssCode .= file_get_contents($jsRoot . 'jquery/treeview/min.css');

/* Combine them. */
$cssFile = $themeRoot . "default/all.css";
$result  = file_put_contents($cssFile, $cssCode);
if($result)
{
    echo "压缩CSS成功！\n";
}

/* Compress it. */
`java -jar ~/bin/yuicompressor/build/yuicompressor.jar --type css $cssFile -o $cssFile`;
