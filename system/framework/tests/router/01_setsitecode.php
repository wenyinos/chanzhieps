#!/usr/bin/php
<?php
<<<TC
title: testing the logic for site code.
expect:|
    xirang
    xirang
    xirang
    xirang
    xirang
    xirang
    192.168.1.1
    xirang
    xirang
TC;
/* Include router and helper.class.php. */
include '../../router.class.php';
include '../../helper.class.php';
/* Create the router object. */
$router = router::createApp('test', '../../../');

/* Set the severname as www.xirang.com. */
echo  helper::getSiteCode('www.xirang.com') . "\n";

/* Set the severname as xirang.com. */
echo  helper::getSiteCode('xirang.com') . "\n";

/* Set the severname as xirang.com.cn */
echo  helper::getSiteCode('xirang.com.cn') . "\n";

/* Set the severname as www.xirang.cn */
echo  helper::getSiteCode('www.xirang.cn') . "\n";

/* Set the severname as xirang */
echo  helper::getSiteCode('xirang') . "\n";

/* Set the severname as 192.168.1.1 */
echo  helper::getSiteCode('192.168.1.1') . "\n";

/* Set the severname as www.xirang.com.cn */
echo  helper::getSiteCode('www.xirang.com.cn') . "\n";

/* Set the severname as www.xirang.cn */
echo  helper::getSiteCode('xirang.n1.chanzhi.net') . "\n";
