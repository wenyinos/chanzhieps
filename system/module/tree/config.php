<?php
$config->tree->systemModules = ',admin,block,book,captcha,company,file,index,links,message,nav,product,rss,site,slide,thread,ui,user,article,blog,cache,common,error,forum,install,mail,misc,page,reply,setting,sitemap,tag,tree,upgrade,';

$config->tree->edit = new stdclass();
$config->tree->edit->requiredFields = 'name';

$config->tree->editor->edit = array('id' => 'desc', 'tools' => 'simpleTools');
