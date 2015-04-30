<?php
$lang->mail->common = '发信设置';
$lang->mail->index  = '首页';
$lang->mail->detect = '检测';
$lang->mail->edit   = '编辑配置';
$lang->mail->save   = '成功保存';
$lang->mail->test   = '测试发信';
$lang->mail->reset  = '重置';

$lang->mail->turnon      = '是否打开';
$lang->mail->fromAddress = '发信邮箱';
$lang->mail->fromName    = '发信人';
$lang->mail->mta         = '发信方式';
$lang->mail->host        = 'smtp服务器';
$lang->mail->port        = 'smtp端口号';
$lang->mail->auth        = '是否需要验证';
$lang->mail->username    = 'smtp帐号';
$lang->mail->password    = 'smtp密码';
$lang->mail->secure      = '是否加密';
$lang->mail->debug       = '调试级别';

$lang->mail->turnonList[1] = '打开';
$lang->mail->turnonList[0] = '关闭';

$lang->mail->debugList[0] = '关闭';
$lang->mail->debugList[1] = '一般';
$lang->mail->debugList[2] = '较高';

$lang->mail->authList[1] = '需要';
$lang->mail->authList[0] = '不需要';

$lang->mail->secureList['']    = '不加密';
$lang->mail->secureList['ssl'] = 'ssl';
$lang->mail->secureList['tls'] = 'tls';

$lang->mail->inputFromEmail = '请输入发信邮箱：';
$lang->mail->nextStep       = '下一步';
$lang->mail->successSaved   = '配置信息已经成功保存。';
$lang->mail->subject        = '测试邮件';
$lang->mail->content        = '邮箱设置成功';
$lang->mail->successSended  = '成功发送！';
$lang->mail->needConfigure  = '无法找到邮件配置信息，请先配置邮件发送参数。';

$lang->mail->captcha       = '邮箱验证码';
$lang->mail->verifyFail    = '验证码错误';
$lang->mail->verifySuccess = '验证码正确';
$lang->mail->sendNotice    = '为了网站安全，<strong>%s</strong> 操作需要进行邮箱验证。</br>验证码将发送至 %s ';
$lang->mail->noConfigure   = " <span class='text-info'>无法找到发信配置信息，邮箱验证未启用。</span>";
$lang->mail->noEmail       = " <span class='text-info'>未填写个人邮箱，邮箱验证未启用。</span>";
$lang->mail->sendContent   = <<<EOT
%s 您好：
</br>&nbsp;&nbsp;&nbsp;&nbsp;您正在<strong>%s</strong>(%s)上进行<strong>%s</strong>操作，所需的验证码为：%s
</br>
</br><strong>%s</strong>由<a href='http://www.chanzhi.org' target='_blank'>蝉知企业门户系统</a>搭建。
</br><a href='http://www.cnezsoft.com' target='_blank'>易软天创</a>为天下企业提供专业的管理工具。
EOT;
