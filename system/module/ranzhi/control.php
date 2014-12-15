<?php
/**
 * The control file of ranzhi module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ranzhi
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class ranzhi extends control
{
    /**
     * Set ranzhi config.
     * 
     * @access public
     * @return void
     */
    public function saveConfig()
    {
        if($_POST)
        {
            $ranzhi = fixer::input('post')->get();
            $result = $this->loadModel('setting')->setItems('system.common.ranzhi', $ranzhi);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
        }
    }

    /**
     * Login from ranzhi.
     * 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function login($type = 'notify')
    {
        $config = $this->config->ranzhi;

        if($this->loadModel('user')->isLogon()) $this->locate($this->createLink('admin'));

        if($type != 'return')
        {
            $code   = $this->config->ranzhi->code;
            $token  = $this->get->token;
            $userIP = $this->server->remote_addr;
            $key    = $this->config->ranzhi->key;
            $auth   = md5($code . $token . $key);

            $callback = urlencode(getWebRoot(true) . ltrim(inlink('login', "type=return"), '/'));
            if($config->requestType == 'get')       $ranzhiURL = rtrim($config->ranzhiURL, '/') . "/index.php?m=sso&f=check&token=$token&auth=$auth&userIP=$userIP&callback=$callback";
            if($config->requestType == 'path_info') $ranzhiURL = rtrim($config->ranzhiURL, '/') . "/sys/sso-check.html?token=$token&auth=$auth&userIP=$userIP&callback=$callback";
            $this->locate($ranzhiURL);
        }

        if($this->get->status == 'success' and md5($this->get->data) == $this->get->md5)
        {
            $ranzhiUser = json_decode(base64_decode($this->get->data));
            $user       = $this->loadModel('user')->getByOpenID($ranzhiUser->account, 'ranzhi');

            if(!empty($user))
            {
                $this->session->set('user', $user);
                $this->app->user = $user;
                if($user->admin == 'super') $this->locate($this->createLink('admin', 'index'));
                $this->locate($this->config->webRoot);
            }
            
            $this->session->set('ranzhiUser', $ranzhiUser);
            $this->view->ranzhiUser = $ranzhiUser;
            exit($this->display());
        }

        $this->locate($this->createLink('user', 'login'));
    }

    /**
     * Register a user when using ranzhi login.
     * 
     * @access public
     * @return void
     */
    public function register()
    {
        if($_POST)
        {
            $this->loadModel('user')->registerRanzhiAccount('ranzhi', $this->session->ranzhiUser->account);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $user = $this->user->getUserByOpenID('ranzhi', $this->session->ranzhiUser->account);
            $this->send(array('result' => 'success', 'info' => sprintf($this->lang->ranzhi->registerSuccess, $user->account), 'locate' => $this->config->webRoot));
        }
    }

    /**
     * Bind an ranzhi account to an account of chanzhi system.
     * 
     * @access public
     * @return void
     */
    public function bind()
    {
        if($this->loadModel('user')->login($this->post->account, $this->post->password))
        {
            if($this->user->bindOAuthAccount($this->post->account, 'ranzhi', $this->session->ranzhiUser->account))
            {
                $locate = $this->app->user->admin == 'super' ? $this->createLink('admin', 'index') : $this->config->webRoot; 
                $this->send(array('result'=>'success', 'locate'=> $locate));
            }
            else
            {
                $this->send(array('result' => 'fail', 'message' => $this->lang->user->oauth->lblBindFailed));
            }
        }

        $this->send(array('result' => 'fail', 'message' => $this->lang->user->loginFailed));
    }


    /**
     * Logout chanzhi from ranzhi sso.
     * 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function logout($type = 'notify')
    {
        if($type != 'return')
        {
            $code   = $this->config->ranzhi->code;
            $token  = $this->get->token;
            $userIP = $this->server->remote_addr;
            $key    = $this->config->ranzhi->key;
            $auth   = md5($code . $token . $key);

            $callback = urlencode(getWebRoot(true) . ltrim(inlink('logout', "type=return"), '/'));
            $this->locate("http://www.ranzhi.net/sys/sso-check.html?token=$token&auth=$auth&userIP=$userIP&callback=$callback");
        }

        if($this->get->status == 'success')
        {
            session_destroy();
            $this->locate($this->createLink('user', 'login'));
        }
        $this->locate($this->createLink('user', 'logout'));
    }

    public function block()
    {
        $lang = $this->get->lang;
        $this->app->setClientLang($lang);
        $this->app->loadLang('common');
        $this->app->loadLang('block');

        $mode = strtolower($this->get->mode);
        if($mode == 'getblocklist')
        {   
            echo $this->ranzhi->getAvailableBlocks();
            exit;
        }
        elseif($mode == 'getblockform')
        {   
            $code = strtolower($this->get->blockid);
            $func = 'get' . ucfirst($code) . 'Params';
            echo $this->ranzhi->$func();
        }   
        elseif($mode == 'getblockdata')
        {   
            $code = strtolower($this->get->blockid);
            $func = 'print' . ucfirst($code) . 'Block';
            $this->$func();
        }
    }

    public function printFeedbackBlock()
    {
        $ranzhiConfig = $this->config->ranzhi;
        
        if($this->get->hash != $ranzhiConfig->key) die();

        $user = $this->loadModel('user')->getByOpenID($this->get->user, 'ranzhi');
        if(empty($user)) die();

        $this->view->code = 'feedback';
        $this->view->messages       = $this->loadModel('message')->computeWating('message');
        $this->view->comments       = $this->message->computeWating('comment');
        $this->view->messageReplies = $this->message->computeWating('reply');
        
        $this->view->threads      = $this->loadModel('thread')->computeNew($user->last);
        $this->view->forumReplies = $this->loadModel('reply')->computeNew($user->last);

        $this->display();
    }
}
