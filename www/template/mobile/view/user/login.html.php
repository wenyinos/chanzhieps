<?php
if(RUN_MODE == 'front')
{
    if(isset($this->config->site->front) and $this->config->site->front == 'login')
    {
        include '../../common/view/header.admin.html.php';
    }
    else
    {
        include  TPL_ROOT . 'user/login.front.html.php';
    }
}
else
{
    include '../../common/view/header.admin.html.php';
}
