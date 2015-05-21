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
$lang->mail->error          = '你的邮箱地址有误，请填写正确的邮箱地址。'; 
$lang->mail->trySendlater   = '三分钟内不能重复发送邮件。'; 

$lang->mail->verify        = '验证管理员身份';
$lang->mail->captcha       = '验证码';
$lang->mail->needVerify    = '需要验证管理员身份';
$lang->mail->verifyFail    = '请填写正确的验证码';
$lang->mail->verifySuccess = '验证通过，请继续操作';
$lang->mail->noConfigure   = " <span class='text-info'>无法找到发信配置信息，邮箱验证未启用。</span>";
$lang->mail->noEmail       = " <span class='text-info'>未填写个人邮箱，邮箱验证未启用。</span>";
$lang->mail->verfyReason   = " 为了网站安全，<strong>%s</strong> 操作需要进行管理员身份验证。</br>";
$lang->mail->okFileVerfy   = "<strong>文件方式</strong>：创建 %s 文件。如果存在该文件，使用编辑软件打开，重新保存一遍。%s</br>";
$lang->mail->emailVerfy    = "<strong>邮箱方式</strong>：验证码将发送至 %s。%s</br>";
$lang->mail->sendSuccess   = '验证码已发送到您的邮箱中';

$lang->mail->sendContent   = <<<EOT
%s 您好：
</br>&nbsp;&nbsp;&nbsp;&nbsp;您正在<strong>%s</strong>(%s)上进行<strong>%s</strong>操作，所需的验证码为：%s
</br>
</br><strong>%s</strong>由<a href='http://www.chanzhi.org' target='_blank'>蝉知企业门户系统</a>搭建。
</br><a href='http://www.cnezsoft.com' target='_blank'>易软天创</a>为天下企业提供专业的管理工具。
EOT;
