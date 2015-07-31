<?php 
if($thisModuleName === 'user' and $thisMethodName === 'login')
{
    js::import($jsRoot . 'md5.js');
    js::import($jsRoot . 'fingerprint/fingerprint.js');
    js::set('random', $this->session->random);
}
if(!isset($templateCommonRoot))
{
    $templateCommonRoot = $config->webRoot . "template/{$this->config->template->name}/theme/common/";
}
js::import($templateCommonRoot . 'js/mzui.form.min.js');
?>
