<?php
/**
 * The nav config file of chanzhiEPS. 
 * 
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan
 * @package     nav
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$config->nav->system = new stdclass();

$config->nav->system->home    = $config->homeRoot;
$config->nav->system->company = commonModel::createFrontLink('company', 'index');
$config->nav->system->contact = commonModel::createFrontLink('company', 'contact');
$config->nav->system->forum   = commonModel::createFrontLink('forum', 'index');
$config->nav->system->blog    = commonModel::createFrontLink('blog', 'index');
$config->nav->system->book    = commonModel::createFrontLink('book', 'index');
$config->nav->system->message = commonModel::createFrontLink('message', 'index');
