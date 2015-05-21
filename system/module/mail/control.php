<?php
/**
 * The control file of forum mail of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     mail
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class mail extends control
{
    /**
     * The admin page, goto edit page or detect page.
     * 
     * @access public
     * @return void
     */
    public function admin()
    {
        if($this->config->mail->turnon) $this->locate(inlink('edit'));
        $this->locate(inlink('detect'));
    }

    /**
     * Detect email config auto.
     * 
     * @access public
     * @return void
     */
    public function detect()
    {
        if($_POST)
        {
            $error = '';
            if($this->post->fromAddress == false) $error = sprintf($this->lang->error->notempty, $this->lang->mail->fromAddress);
            if(!validater::checkEmail($this->post->fromAddress)) $error .= '\n' . sprintf($this->lang->error->email, $this->lang->mail->fromAddress);

            if($error) die(js::alert($error));

            $mailConfig = $this->mail->autoDetect($this->post->fromAddress);
            $mailConfig->fromAddress = $this->post->fromAddress;
            $this->session->set('mailConfig',  $mailConfig);

            die(js::locate(inlink('edit'), 'parent'));
        }

        $this->view->title      = $this->lang->mail->common . $this->lang->colon . $this->lang->mail->detect;
        $this->view->position[] = html::a(inlink('index'), $this->lang->mail->common);
        $this->view->position[] = $this->lang->mail->detect;

        $this->view->fromAddress = $this->session->mailConfig ? $this->session->mailConfig->fromAddress : '';

        $this->display();
    }

    /**
     * Edit the mail config.
     * 
     * @access public
     * @return void
     */
    public function edit()
    {
        if($this->config->mail->turnon)
        {
            $mailConfig = $this->config->mail->smtp;
            $mailConfig->fromAddress = $this->config->mail->fromAddress;
            $mailConfig->fromName    = $this->config->mail->fromName;
            $this->loadModel('setting')->setItems('system.mail', $mailConfig);
        }
        elseif($this->session->mailConfig)
        {
            $mailConfig = $this->session->mailConfig;
        }
        else
        {
            $this->locate(inlink('detect'));
        }

        $this->view->title      = $this->lang->mail->common . $this->lang->colon . $this->lang->mail->edit;
        $this->view->position[] = html::a(inlink('index'), $this->lang->mail->common);
        $this->view->position[] = $this->lang->mail->edit;

        $this->view->mailExist   = $this->mail->mailExist();
        $this->view->mailConfig  = $mailConfig;
        $this->display();
    }

    /**
     * Save the email config. 
     * 
     * @access public
     * @return void
     */
    public function save()
    {
        if(!empty($_POST))
        {
            $mailConfig = new stdclass();
            $mailConfig->smtp = new stdclass();

            $mailConfig->turnon         = $this->post->turnon;
            $mailConfig->mta            = 'smtp';
            $mailConfig->fromAddress    = $this->post->fromAddress; 
            $mailConfig->fromName       = $this->post->fromName;
            $mailConfig->smtp->host     = $this->post->host;
            $mailConfig->smtp->port     = $this->post->port;
            $mailConfig->smtp->auth     = $this->post->auth;
            $mailConfig->smtp->username = $this->post->username;
            $mailConfig->smtp->password = $this->post->password;
            $mailConfig->smtp->secure   = $this->post->secure;
            $mailConfig->smtp->debug    = $this->post->debug;

            $this->loadModel('setting')->setItems('system.mail', $mailConfig);
            if(dao::isError()) die(js::error(dao::getError()));

            $this->session->set('mailConfig', '');

            $this->view->title      = $this->lang->mail->common . $this->lang->colon . $this->lang->mail->save;
            $this->view->position[] = html::a(inlink('index'), $this->lang->mail->common);
            $this->view->position[] = $this->lang->mail->save;

            $this->display();
        }
    }

    /**
     * Send test email.
     * 
     * @access public
     * @return void
     */
    public function test()
    {
        if(!$this->config->mail->turnon)
        {
            die(js::alert($this->lang->mail->needConfigure) . js::locate('back'));
        }


        if($_POST)
        {
            $this->mail->send($this->post->to, $this->lang->mail->subject, $this->lang->mail->content, true);
            if($this->mail->isError())
            {
                $error = str_replace('\n', "<br />", join('', $this->mail->getError()));
                $this->send(array('result' => 'fail', 'message' => $error));
            }
            $this->send(array('result' => 'success', 'message' => $this->lang->mail->successSended));
        }

        $this->view->title      = $this->lang->mail->common . $this->lang->colon . $this->lang->mail->test;
        $this->view->position[] = html::a(inlink('index'), $this->lang->mail->common);
        $this->view->position[] = $this->lang->mail->test;
        $this->display();
    }

    /**
     * Reset the email config.
     * 
     * @access public
     * @return void
     */
    public function reset()
    {
        $this->dao->delete('*')->from(TABLE_CONFIG)->where('module')->eq('mail')->exec(); 
        $this->locate(inlink('detect'));
    }

    /**
     * Send E-mail.
     * 
     * @param  string $module 
     * @param  string $method 
     * @param  string $url 
     * @param  string $target 
     * @param  string $account 
     * @access public
     * @return void
     */
    public function captcha($module, $method, $url = '', $target = 'modal', $account = '')
    {
        if($url == '')     $url     = helper::safe64Encode('close');
        if($account == '') $account = $this->app->user->account;

        if($_POST)
        {
            $this->session->set('verifyCode', mt_rand());
            $this->app->loadlang($module);
            $action  = isset($this->lang->{$module}->{$method}->common) ? $this->lang->{$module}->{$method}->common : $this->lang->{$module}->{$method};
            $content = sprintf($this->lang->mail->sendContent, $account, $this->config->site->name, $this->server->http_host, $action, $this->session->verifyCode, $this->config->site->name);
            $this->loadModel('mail')->send($account, $this->lang->mail->captcha . ' ' . $this->config->site->name, $content, true); 

            if(!$this->mail->isError()) $this->send(array('result' => 'success', 'message' => $this->lang->mail->successSended, 'locate' => inlink('verify', "url=$url&target=$target")));

            $error = str_replace('\n', "<br />", join('', $this->mail->getError()));
            $this->send(array('result' => 'fail', 'message' => $error . $account));
        }

        $check  = $this->loadModel('mail')->checkEmailSetting($account);
        $okFile = $this->loadModel('common')->verfyAdmin();
        $pass   = $this->mail->checkVerify();

        $user = $this->loadModel('user')->getByAccount($account);
        $this->view->title   = $this->lang->mail->verify;
        $this->view->module  = $module;
        $this->view->method  = $method;
        $this->view->url     = $url;
        $this->view->target  = $target;
        $this->view->account = $account;
        $this->view->email   = $user->email;
        $this->view->check   = $check;
        $this->view->okFile  = $okFile;
        $this->view->pass    = $pass;
        $this->display();
    }

    /**
     * verify capycha.
     * 
     * @param  string $url 
     * @access public
     * @return void
     */
    public function verify($url, $target)
    {
        if($_POST)
        {
            if(trim($this->post->captcha) != $this->session->verifyCode) $this->send(array('result' => 'fail', 'message' => $this->lang->mail->verifyFail));
            $this->session->set('verify', 6);
            $this->send(array('result' => 'success', 'message' => $this->lang->mail->verifySuccess, 'locate' => helper::safe64Decode($url), 'target' => $target));
        }

        $this->session->set('verify', '');

        $this->view->title  = $this->lang->mail->verify;
        $this->view->url    = $url;
        $this->view->target = $target;
        $this->display();

    }

    /**
     * Send mail code. 
     * 
     * @access public
     * @return void
     */
    public function sendMailCode($module, $method)
    {
        $account = $this->app->user->account; 
        $email   = $this->post->email ? $this->post->email : $this->app->user->email;

        $lastSendVar  = "lastSendTo{$account}";
        $lastSendTime = $this->session->$lastSendVar;

        if((time() - $lastSendTime) < 180) $this->send(array('result' => 'fail', 'message' => $this->lang->mail->trySendlater));

        $this->session->set('verifyCode', mt_rand());
        if(!validater::checkEmail($email)) $this->send(array('result' => 'fail', 'message' => $this->lang->mail->error));

        $action  = isset($this->lang->{$module}->{$method}->common) ? $this->lang->{$module}->{$method}->common : $this->lang->{$module}->{$method};
        $content = sprintf($this->lang->mail->sendContent, $account, $this->config->site->name, $this->server->http_host, $action, $this->session->verifyCode, $this->config->site->name);
        $this->loadModel('mail')->send($email, $this->lang->mail->captcha, $content, true); 

        if(!$this->mail->isError())
        {
            $this->session->set('lastSendTo' . $account, time());
            $this->send(array('result' => 'success', 'message' => $this->lang->mail->sendSuccess));
        }

        $error = str_replace('\n', "<br />", join('', $this->mail->getError()));
        $this->send(array('result' => 'fail', 'message' => $error));
    }
}
