<?php
/**
 * The model file of guarder module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     guarder
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class guarderModel extends model
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
     * Create guarder for comment.
     * 
     * @access public
     * @return string
     */
    public function create4Comment()
    {
        $guarder = $this->createCaptcha();     
        return <<<EOT
<label for='captcha' class='col-sm-1 control-label'>{$this->lang->guarder->captcha}</label>
<div class='col-sm-11 required'>
  <table class='captcha'>
      <tr class='text-middle'>
        <td class='text-lg w-110px'><span class='label label-danger'>{$guarder->first} {$guarder->operator} {$guarder->second}</span></td>
        <td class='text-lg text-center w-40px'> {$this->lang->guarder->equal} </td>
        <td><input type='text'  name='captcha' id='captcha' class='w-80px inline-block form-control text-center' placeholder='{$this->lang->guarder->placeholder}'/> &nbsp;</td>
      </tr>
  </table>
</div>
EOT;
    }

    /**
     * Create guarder for comment.
     * 
     * @access public
     * @return string
     */
    public function create4Reply()
    {
        $guarder = $this->createCaptcha();     
        return <<<EOT
<table class='captcha'>
  <tr class='text-middle'>
    <td class='w-80px text-center'><label for='captcha'>{$this->lang->guarder->captcha}</label></td>
    <td class='w-110px text-lg'><span class='label label-danger'>{$guarder->first} {$guarder->operator} {$guarder->second}</span></td>
    <td class='w-40px text-lg text-center'>{$this->lang->guarder->equal}</td>
    <td>
      <input type='text'  name='captcha' id='captcha' class='w-80px inline-block form-control text-center' placeholder='{$this->lang->guarder->placeholder}'/> &nbsp;
    </td>
  </tr>
</table>
EOT;
    }

    /**
     * Create guarder for thread.
     * 
     * @access public
     * @return string
     */
    public function create4Thread()
    {
        $guarder = $this->createCaptcha();
        return <<<EOT
<label for='captcha' class='col-md-1 col-sm-2 control-label'>{$this->lang->guarder->captcha}</label>
<div class='col-md-7 col-sm-8 col-xs-11 required'>
  <table class='captcha'>
      <tr class='text-middle'>
        <td class='text-lg w-110px'><span class='label label-danger'>{$guarder->first} {$guarder->operator} {$guarder->second}</span></td>
        <td class='text-lg text-center w-40px'> {$this->lang->guarder->equal} </td>
        <td><input type='text'  name='captcha' id='captcha' class='w-80px inline-block form-control text-center' placeholder='{$this->lang->guarder->placeholder}'/> &nbsp;</td>
      </tr>
  </table>
</div>
EOT;
    }

    /**
     * Create guarder for message reply.
     * 
     * @access public
     * @return string
     */
    public function create4MessageReply()
    {
        $guarder = $this->createCaptcha();
        return <<<EOT
<th>{$this->lang->guarder->captcha}</th>
<td>
  <table class='captcha'>
    <tr class='text-middle'>
      <td class='text-lg w-110px'><span class='label label-danger'>{$guarder->first} {$guarder->operator} {$guarder->second}</span></td>
      <td class='text-lg text-center w-40px'> {$this->lang->guarder->equal} </td>
      <td><input type='text'  name='captcha' id='captcha' class='w-80px inline-block form-control text-center' placeholder='{$this->lang->guarder->placeholder}'/> &nbsp;</td>
    </tr>
  </table>
</td>
EOT;
    }

    /**
     * Create guarder.
     * 
     * @access public
     * @return object.
     */
    public function createCaptcha()
    {
        /* Get random two numbers and random operator. */
        $operators      = array_keys($this->lang->guarder->operators);
        $firstRand      = mt_rand(0, 10);
        $secondRand     = mt_rand(0, 10);
        $randomOperator = $operators[array_rand($operators)];

        /* Compute the result and save it to session. */
        $expression = "\$captcha = $firstRand $randomOperator $secondRand;";
        eval($expression);
        $this->session->set('captcha', $captcha);

        /* Return the guarder data. */
        $captcha = new stdclass();
        $captcha->first    = $this->lang->guarder->numbers[$firstRand];
        $captcha->second   = $this->lang->guarder->numbers[$secondRand];
        $captcha->operator = $this->lang->guarder->operators[$randomOperator];

        return $captcha;
    }

    /**
     * check a request in blacklist.
     * 
     * @access public
     * @return void
     */
    public function isInBlackList()
    {
        $ip = $this->server->remote_addr;

        $blackList = $this->dao->select('*')->from(TABLE_BLACKLIST)
            ->where('identity')->eq($ip)
            ->andWhere('type')->eq('ip')
            ->andWhere('expiredDate')->ge(helper::now())
            ->fetch();

        if(!empty($blackList)) return true;

        if($this->app->user->account != 'guest')
        {
            $blackList = $this->dao->select('*')->from(TABLE_BLACKLIST)
                ->where('identity')->eq($this->app->user->account)
                ->andWhere('type')->eq('account')
                ->andWhere('expiredDate')->le(helper::now())
                ->fetch();
            if(!empty($blacklist)) return true;
        }

        return false;
    }

    /**
     * Save operation log.
     * 
     * @param  string    $type 
     * @param  string    $action 
     * @access public
     * @return void
     */
    public function logOperation($type = 'ip', $action)
    {
        if($type == 'ip')     $identity = $this->server->remote_addr;
        if($type == 'acount') $identity = $this->app->user->account;

        $this->dao->delete()->from(TABLE_OPERATIONLOG)
            ->where('type')->eq($type)
            ->andWhere('identity')->eq($identity)
            ->andWhere('operation')->eq($action)
            ->andWhere('createdTime')->lt(date('Y-m-d'))
            ->exec();

        $dayLimit = $this->config->guarder->limits->{$type}->day->$action;
        $dayCount = (int)$this->dao->select('sum(count) as count')->from(TABLE_OPERATIONLOG)
            ->where('type')->eq($type)
            ->andWhere('identity')->eq($identity)
            ->andWhere('operation')->eq($action)
            ->fetch('count');

        if(($dayCount + 1) >= $dayLimit)
        {
            $this->punish($type, $identity, $action, $this->config->guarder->punishment->$type->day->$action); 
            return true;
        }

        $interval = $this->config->guarder->interval->{$type}->$action;
        $limit    = $this->config->guarder->limits->{$type}->minute->$action;
        $last     = date('Y-m-d H:i:s', time() - (60 * $interval));

        $log = $this->dao->select('*')->from(TABLE_OPERATIONLOG)
            ->where('type')->eq($type)
            ->andWhere('identity')->eq($identity)
            ->andWhere('operation')->eq($action)
            ->andWhere('createdTime')->ge($last)
            ->fetch();

        if(!empty($log))
        {
            $log->count ++;
            if($log->count >= $limit)
            {
                $this->punish($type, $identity, $action, $this->config->guarder->punishment->{$type}->minute->$action);
            }
            $this->dao->replace(TABLE_OPERATIONLOG)->data($log)->exec();
        }
        else
        {
            $operation = new stdclass();
            $operation->type         = $type;
            $operation->count        = 1;
            $operation->operation    = $action;
            $operation->identity     = $identity;
            $operation->createdTime  = date('Y-m-d H:i:s');

            $this->dao->insert(TABLE_OPERATIONLOG)->data($operation)->exec();
        }
        return true;
    }

    /**
     * Punish a ip or account to blacklist.
     * 
     * @param  string    $type 
     * @param  string    $identity 
     * @param  string    $reason 
     * @param  string    $expired
     * @access public
     * @return void
     */
    public function punish($type, $identity, $reason, $expired)
    {
       $blacklist = new stdclass(); 
       $blacklist->type        = $type;
       $blacklist->identity    = $identity;
       $blacklist->reason      = $reason;
       $blacklist->expiredDate = date('Y-m-d H:i:s', $expired * 3600 + time());
       $blacklist->lang        = 'all';

       $this->dao->replace(TABLE_BLACKLIST)->data($blacklist)->exec();
    }
}
