<?php
/**
 * The comment module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     comment
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->guarder = new stdclass();

$lang->guarder->common      = '';
$lang->guarder->captcha     = '验证码';
$lang->guarder->numbers     = array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖', '拾');
$lang->guarder->operators   = array('*' => '乘', '-' => '减', '+' => '加');
$lang->guarder->equal       = '=';
$lang->guarder->placeholder = '数字';

$lang->guarder->blacklistModes['keywords'] = '关键词';
$lang->guarder->blacklistModes['ip']       = 'ip地址';
$lang->guarder->blacklistModes['guard']    = '网址';
$lang->guarder->blacklistModes['email']    = '邮箱地址';

$lang->guarder->type       = '类型';
$lang->guarder->content    = '内容';
$lang->guarder->reason     = '原因';
$lang->guarder->expiration = '过期时间';
$lang->guarder->action     = '操作';

$lang->guarder->add = '添加';

$lang->guarder->permanent = '永久';
