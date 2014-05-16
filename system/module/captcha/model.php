<?php
/**
 * The model file of captcha module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     captcha
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class captchaModel extends model
{
    /**
     * Check something is evil or not.
     * 
     * @param  string $content 
     * @access public
     * @return bool
     */
    public function isEvil($content = '')
    {
        $isEvil = false;
        if(strpos($content, 'http://') !== false) return true;

        $lineCount = preg_match_all('/(?<=href=)([^\>]*)(?=\>)/ ', $content, $out);
        if($lineCount > 1) $isEvil = true;

        if($lineCount > 5) die();
        if(preg_match('/\[url=.*\].*\[\/url\]/U', $content)) die();

        return false;
    }

    /**
     * Create captcha for comment.
     * 
     * @access public
     * @return string
     */
    public function create4Comment()
    {
        $captcha = $this->create();     
        return <<<EOT
<label for='captcha' class='col-sm-1 control-label'>{$this->lang->captcha->common}</label>
<div class='col-sm-11'>
  <div class='captcha'>
      <div class='row'>
        <div class='col-sm-3 col-xs-6 text-right'>
          <span class='text-lg'><span class='label label-danger'>{$captcha->first} {$captcha->operator} {$captcha->second}</span> &nbsp; {$this->lang->captcha->equal} </span>
        </div>
        <div class='col-sm-4 col-xs-6'>
          <input type='text' name='captcha' id='captcha' class='form-control text-center' placeholder='{$this->lang->captcha->placeholder}'/>
        </div>
      </div>
  </div>
</div>
EOT;
    }

        /**
     * Create captcha for comment.
     * 
     * @access public
     * @return string
     */
    public function create4Reply()
    {
        $captcha = $this->create();     
        return <<<EOT
<div class='captcha'>
  <div class='row'>
    <div class='col-sm-2 col-xs-3'><label for='captcha'>{$this->lang->captcha->common}</label></div>
    <div class='col-sm-3 col-xs-5 text-right'>
      <span class='text-lg'><span class='label label-danger'>{$captcha->first} {$captcha->operator} {$captcha->second}</span> &nbsp; {$this->lang->captcha->equal} </span>
    </div>
    <div class='col-sm-4 col-xs-4'>
      <input type='text' name='captcha' id='captcha' class='form-control text-center' placeholder='{$this->lang->captcha->placeholder}'/>
    </div>
  </div>
</div>
EOT;
    }

    /**
     * Create captcha for thread.
     * 
     * @access public
     * @return string
     */
    public function create4Thread()
    {
        $captcha = $this->create();
        return <<<EOT
<label for='captcha' class='col-md-1 col-sm-2 control-label'>{$this->lang->captcha->common}</label>
<div class='col-md-7 col-sm-8 col-xs-11 required'>
  <div class='captcha'>
      <div class='row'>
        <div class='col-sm-5 col-xs-6 text-right'>
          <span class='text-lg'><span class='label label-danger'>{$captcha->first} {$captcha->operator} {$captcha->second}</span> &nbsp; {$this->lang->captcha->equal} </span>
        </div>
        <div class='col-sm-5 col-xs-6'>
          <input type='text' name='captcha' id='captcha' class='form-control text-center' placeholder='{$this->lang->captcha->placeholder}'/>
        </div>
      </div>
  </div>
</div>
EOT;
    }

    /**
     * Create captcha.
     * 
     * @access public
     * @return object.
     */
    public function create()
    {
        /* Get random two numbers and random operator. */
        $operators      = array_keys($this->lang->captcha->operators);
        $firstRand      = mt_rand(0, 10);
        $secondRand     = mt_rand(0, 10);
        $randomOperator = $operators[array_rand($operators)];

        /* Compute the result and save it to session. */
        $expression = "\$captcha = $firstRand $randomOperator $secondRand;";
        eval($expression);
        $this->session->set('captcha', $captcha);

        /* Return the captcha data. */
        $captcha = new stdclass();
        $captcha->first    = $this->lang->captcha->numbers[$firstRand];
        $captcha->second   = $this->lang->captcha->numbers[$secondRand];
        $captcha->operator = $this->lang->captcha->operators[$randomOperator];

        return $captcha;
    }
}
