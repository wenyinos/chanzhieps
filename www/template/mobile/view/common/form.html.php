<?php 
if(!isset($templateCommonRoot))
{
    $thisModuleName     = $this->app->getModuleName();
    $thisMethodName     = $this->app->getMethodName();
    $templateCommonRoot = $config->webRoot . "template/" . $this->config->template->{$this->device}->name . "/theme/common/";
}
if($thisModuleName === 'user' and $thisMethodName === 'login')
{
    js::import($jsRoot . 'md5.js');
    js::import($jsRoot . 'fingerprint/fingerprint.js');
    js::set('random', $this->session->random);
}
js::import($templateCommonRoot . 'js/mzui.form.min.js');
?>
