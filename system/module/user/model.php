<?php
/**
 * The model file of user module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class userModel extends model
{
    /**
     * Get users List.
     *
     * @param object  $pager
     * @access public
     * @return object 
     */
    public function getList($pager = null, $user = '', $provider = '', $admin = '')
    {
        $users = $this->dao->setAutolang(false)
            ->select('u.*, o.provider as provider, openID as openID')->from(TABLE_USER)->alias('u')
            ->leftJoin(TABLE_OAUTH)->alias('o')->on('u.account = o.account')->where('1')
            ->beginIF($user)
            ->andWhere('u.account')->like("%{$user}%")
            ->orWhere('u.realname')->like("%{$user}%")
            ->orWhere('u.email')->like("%{$user}%")
            ->fi()
            ->beginIF($provider)->andWhere('o.provider')->like("%{$provider}%")->fi()
            ->beginIF($admin)->andWhere('u.admin')->ne('no')->fi()
            ->orderBy('id_asc')
            ->page($pager)
            ->fetchAll('id');

        foreach($users as $user)
        {
            $user->realname  = $this->computeRealname($user);
            $user->realnames = json_decode($user->realnames);
        }

        return $users;
    }

    /**
     * Get user by openID.
     * 
     * @param  int    $openID 
     * @param  int    $provider 
     * @access public
     * @return void
     */
    public function getByOpenID($openID, $provider)
    {
        return $this->dao->select('u.*, o.provider as provider, openID as openID')->from(TABLE_USER)->alias('u')
            ->leftJoin(TABLE_OAUTH)->alias('o')->on('u.account = o.account')
            ->setAutolang(false)
            ->where('o.provider')->eq($provider)
            ->andWhere('o.openID')->eq($openID)
            ->fetch();
    }

    /**
     * Get the account=>relaname pairs.
     * 
     * @param  string $params  admin|noempty
     * @access public
     * @return array
     */
    public function getPairs($params = '')
    {
        $users = $this->dao->select('account, realname, realnames')->from(TABLE_USER) 
            ->beginIF(strpos($params, 'admin') !== false)->where('admin')->ne('no')->fi()
            ->orderBy('id_asc')
            ->setAutolang(false)
            ->fetchAll('account');

        $userPairs = array();
        foreach($users as $account => $user)
        {
            if(!$account) continue;
            $userPairs[$account] = $this->computeRealname($user);
        }

        /* Append empty users. */
        if(strpos($params, 'noempty') === false) $userPairs = array('' => '') + $userPairs;

        return $userPairs;
    }

    /**
     * Get the basic info of some user.
     * 
     * @param mixed $users 
     * @access public
     * @return void
     */
    public function getBasicInfo($users)
    {
        $users = $this->dao->setAutolang(false)->select('account, admin, realnames, realname, `join`, last, visits')->from(TABLE_USER)->where('account')->in($users)->fetchAll('account');
        if(!$users) return array();

        foreach($users as $account => $user)
        {
            if(!$account) continue;
            $user->realname  = $this->computeRealname($user);
            $user->shortLast = substr($user->last, 5, -3);
            $user->shortJoin = substr($user->join, 5, -3);
        }

        return $users;
    }

    /**
     * Get user by his account.
     * 
     * @param mixed $account
     * @access public
     * @return object|bool
     */
    public function getByAccount($account)
    {
        $user = $this->dao->setAutolang(false)
            ->select('u.*, o.provider as provider, openID as openID')->from(TABLE_USER)->alias('u')
            ->leftJoin(TABLE_OAUTH)->alias('o')->on('u.account = o.account')
            ->beginIF(validater::checkEmail($account))->where('u.email')->eq($account)->fi()
            ->beginIF(!validater::checkEmail($account))->where('u.account')->eq($account)->fi()
            ->fetch();
        if(empty($user)) return false;

        if(!empty($user->realnames))
        {
            $user->realname  = $this->computeRealname($user);
            $user->realnames = json_decode($user->realnames);
        }
        else
        {
            $clientLang = isset($this->config->site->defaultLang) ? $this->config->site->defaultLang : $this->config->site->lang;
            $clientLang = strpos($clientLang, 'zh-') !== false ? str_replace('zh-', '', $clientLang) : $clientLang;

            $user->realnames = new stdclass();
            $user->realnames->$clientLang = $user->realname;
        }

         return $user;
    }

    /**
     * Get user list with email and real name.
     * 
     * @param  string|array $users 
     * @access public          
     * @return array           
     */
    public function getRealNameAndEmails($users)
    {
        $users = $this->dao->setAutolang(false)->select('account, email, realnames, realname')->from(TABLE_USER)->where('account')->in($users)->fetchAll('account');
        if(!$users) return array();     
        foreach($users as $account => $user)
        {
            if(!$account) continue;
            $user->realname = $this->computeRealname($user);
        }

        return $users;         
    }

    /**
     * Get user list with real name.
     * 
     * @param  string|array $users 
     * @access public          
     * @return array           
     */
    public function getRealNamePairs($users)
    {
        $userList = $this->dao->setAutolang(false)->select('account, realnames, realname')->from(TABLE_USER)->where('account')->in($users)->fetchAll('account');

        foreach($users as $account)
        {
            if(!isset($userList[$account])) $userList[$account] = $account;
        }

        if(!$userList) return array();     

        $userPairs = array();
        foreach($userList as $account => $user)
        {
            if(!$account) continue;
            $userPairs[$account] = $this->computeRealname($user);
        }

        return $userPairs;         
    }

    /**
     * Create a user.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        $this->checkPassword();

        $user = fixer::input('post')
            ->setForce('join', date('Y-m-d H:i:s'))
            ->setForce('last', helper::now())
            ->setForce('visits', 1)
            ->setIF($this->post->password1 == false, 'password', '')
            ->setIF($this->cookie->referer != '', 'referer', $this->cookie->referer)
            ->setIF($this->cookie->referer == '', 'referer', '')
            ->remove('admin, ip, fingerprint')
            ->get();
        $user->password = $this->createPassword($this->post->password1, $user->account); 

        $this->dao->insert(TABLE_USER)
            ->data($user, $skip = 'password1,password2')
            ->autoCheck()
            ->batchCheck($this->config->user->require->register, 'notempty')
            ->check('account', 'unique')
            ->check('account', 'account')
            ->check('email', 'email')
            ->check('email', 'unique')
            ->exec();
    }

    /**
     * create wechat user.
     * 
     * @param  object    $fan 
     * @param  string    $public 
     * @access public
     * @return object
     */
    public function createWechatUser($fan, $public)
    {
        if(!isset($fan->subscribe) or $fan->subscribe != 1) return false;
        $fan->openID = $fan->openid;

        $user = new stdclass();
        $user->public   = $public;
        $user->nickname = $fan->nickname;
        $user->realname = $fan->nickname;
        $user->address  = $fan->country . ' ' . $fan->province . ' ' . $fan->city;
        $user->join     = date('Y-m-d H:i:s', $fan->subscribe_time);

        if($fan->sex == 0) $user->gender = 'u';
        if($fan->sex == 1) $user->gender = 'm';
        if($fan->sex == 2) $user->gender = 'f';

        $pulledFan = $this->dao->setAutolang(false)->select('*')->from(TABLE_OAUTH)->where('provider')->eq('wechat')->andWhere('openID')->eq($fan->openID)->fetch();

        if(empty($pulledFan))
        {
            $oauth = new stdclass();
            $oauth->openID   = $fan->openID;
            $oauth->provider = 'wechat';
            $oauth->account  = uniqid('wx_');
            $this->dao->insert(TABLE_OAUTH)->data($oauth)->exec();

            $user->account = $oauth->account;
            $this->dao->insert(TABLE_USER)->data($user, $skip = 'openID,provider')->exec();
        }
        else
        {
            $userInfo = $this->dao->setAutolang(false)->select('*')->from(TABLE_USER)->where('account')->eq($pulledFan->account)->fetch();
            $user->account = $pulledFan->account;
            if(empty($userInfo))
            {
                $this->dao->insert(TABLE_USER)->data($user, $skip = 'openID,provider')->exec();
            }
            elseif(!$userInfo->nickname) 
            {
                $this->dao->update(TABLE_USER)->data($user, $skip = 'openID,provider')->where('account')->eq($pulledFan->account)->exec();
            }
        }

        return $user;
    }

    /**
     * Update an account.
     * 
     * @param  string $account 
     * @access public
     * @return void
     */
    public function update($account)
    {
        $oldUser = $this->getByAccount($account);

        /* If the user want to change his password. */
        if($this->post->password1 != false)
        {
            if(RUN_MODE == 'front') $this->checkOldPassword();
            $this->checkPassword();
            if(dao::isError()) return false;

            $password  = $this->createPassword($this->post->password1, $account);
            $this->post->set('password', $password);
        }

        $user = fixer::input('post')
            ->cleanInt('imobile, qq, zipcode')
            ->setDefault('admin', 'no')
            ->setIF(RUN_MODE == 'admin' and $this->post->admin != 'super', 'realnames', '')
            ->remove('ip, account, join, visits, fingerprint, token')
            ->removeIF(RUN_MODE != 'admin', 'admin')
            ->removeIF(RUN_MODE == 'admin', 'groups')
            ->removeIF(RUN_MODE == 'front', 'email')
            ->get();

        if(RUN_MODE == 'admin')
        {
            if($user->admin == 'common')
            {
                $this->dao->delete()->from(TABLE_USERGROUP)->where('account')->eq($account)->exec();

                if($this->post->groups)
                {
                    foreach($this->post->groups as $group)
                    {
                        $data          = new stdclass();
                        $data->account = $account;
                        $data->group   = $group;
                        $this->dao->insert(TABLE_USERGROUP)->data($data)->exec();
                    }
                }
            }

            if($user->admin == 'no') $this->dao->delete()->from(TABLE_USERGROUP)->where('account')->eq($account)->exec();
        }

        if(RUN_MODE == 'admin' and $user->email != $oldUser->email) $user->emailCertified = 0;

        if((isset($user->admin) and $user->admin == 'super') or !empty($user->realnames))
        {
            $user->realnames = helper::jsonEncode($user->realnames);
            $this->config->user->require->edit = 'realnames';
        }

        $this->dao->update(TABLE_USER)->setAutolang(false)
            ->data($user, $skip = 'token,oldPwd,password1,password2')
            ->autoCheck()
            ->batchCheck($this->config->user->require->edit, 'notempty')
            ->checkIF($this->post->gtalk != false, 'gtalk', 'email')

            ->beginIF(RUN_MODE == 'admin')
            ->check('email', 'email')
            ->check('email', 'unique', "account!='$account'")
            ->fi()

            ->where('account')->eq($account)
            ->exec();

        return !dao::isError();
    }

    /**
     * Update email. 
     * 
     * @param  string $account 
     * @access public
     * @return void
     */
    public function updateEmail($account)
    {
        $this->checkOldPassword();
        $data = fixer::input('post')->remove('oldPwd, captcha, token, fingerprint')->get();
        $data->emailCertified = 0;

        $this->dao->update(TABLE_USER)->setAutolang(false)
            ->data($data)
            ->check('email', 'notempty')
            ->check('email', 'email')
            ->check('email', 'unique', "account!='$account'")
            ->where('account')->eq($account)
            ->exec();

        return !dao::isError();
    }

    /**
     * Check the password is valid or not.
     * 
     * @access public
     * @return bool
     */
    public function checkPassword()
    {
        if($this->post->password1 != false)
        {
            if($this->post->password1 != $this->post->password2) dao::$errors['password1'][] = $this->lang->error->passwordsame;
            if(!validater::checkReg($this->post->password1, '|(.){6,}|')) dao::$errors['password1'][] = $this->lang->error->passwordrule;
        }
        else
        {
            dao::$errors['password1'][] = $this->lang->user->inputPassword;
        }

        return !dao::isError();
    }

    /**
     * Check old password.
     * 
     * @access public
     * @return bool
     */
    public function checkOldPassword()
    {
        if($this->post->oldPwd != false)
        {
            $hash = md5(md5($this->post->oldPwd) . $this->app->user->account);
            if($hash != $this->app->user->password) dao::$errors['oldPwd'][] = $this->lang->user->wrongPwd;
        }
        else
        {
            dao::$errors['oldPwd'][] = $this->lang->user->inputPassword;
        }
        return !dao::isError();
    }
    
    /**     
     * Update password 
     *          
     * @param  string $account 
     * @access public          
     * @return void
     */     
    public function updatePassword($account)
    { 
        $this->checkPassword();
        if(dao::isError()) return false;

        $user = fixer::input('post')
            ->setIF($this->post->password1 != false, 'password', $this->createPassword($this->post->password1, $account))
            ->remove('password1, password2, ip, account, admin, join, visits')
            ->get();

        $this->dao->setAutolang(false)->update(TABLE_USER)->data($user, 'token,fingerprint')->autoCheck()->where('account')->eq($account)->exec();
        return !dao::isError();
    }   

    /**
     * Try to login with an account and password.
     * 
     * @param  string    $account 
     * @param  string    $password 
     * @access public
     * @return bool
     */
    public function login($account, $password)
    {
        $user = $this->identify($account, $password);
        if(!$user) return false;

        $browser = helper::getBrowser() . ' ' . helper::getBrowserVersion();
        $os      = helper::getOS();
        $this->dao->update(TABLE_USER)->set('browser')->eq($browser)->set('os')->eq($os)->where('id')->eq($user->id)->exec();
        if(dao::isError()) return false;

        $user->rights      = $this->authorize($user);
        $user->loginIP     = helper::getRemoteIP();
        $user->fingerprint = $this->post->fingerprint ? $this->post->fingerprint : $this->session->fingerprint;
        $this->session->set('user', $user);
        $this->app->user = $this->session->user;

        return true;
    }

    /**
     * Identify a user.
     * 
     * @param   string $account     the account
     * @param   string $password    the password    the plain password or the md5 hash
     * @access  public
     * @return  object              if is valid user, return the user object.
     */
    public function identify($account, $password)
    {
        if(!$account or !$password) return false;

        /* First get the user from database by account or email. */
        $user = $this->dao->setAutolang(false)->select('*')->from(TABLE_USER)
            ->beginIF(validater::checkEmail($account))->where('email')->eq($account)->fi()
            ->beginIF(!validater::checkEmail($account))->where('account')->eq($account)->fi()
            ->fetch();

        /* Then check the password hash. */
        if(!$user) return false;

        /* Can not login before ten minutes when user is locked. */
        if($user->locked != '0000-00-00 00:00:00')
        {
            $dateDiff = (strtotime($user->locked) - time()) / 60;

            /* Check the type of lock and show it. */
            if($dateDiff > 0 && $dateDiff <= 3)
            {
                $this->lang->user->loginFailed = sprintf($this->lang->user->locked, '3' . $this->lang->date->minute);
                return false;
            }
            elseif($dateDiff > 3)
            {
                $dateDiff = ceil($dateDiff / 60 / 24);
                $this->lang->user->loginFailed = $dateDiff <= 30 ? sprintf($this->lang->user->locked, $dateDiff . $this->lang->date->day) : $this->lang->user->lockedForEver;
                return false;
            }
            else
            {
                $user->fails  = 0;
                $user->locked = '0000-00-00 00:00:00';
            }
        }

        /* The password can be the plain or the password after md5. */
        if(!$this->compareHashPassword($password, $user) and $user->password != $this->createPassword($password, $user->account))
        {
            /* Save login log if user is admin. */
            if($user->admin == 'super' or $user->admin == 'common') $this->saveLog($user->account, 'fail');

            $user->fails ++;
            if($user->fails > 2 * 4) $user->locked = date('Y-m-d H:i:s', time() + 3 * 60);
            $this->dao->setAutolang(false)->update(TABLE_USER)->data($user)->where('id')->eq($user->id)->exec();
            return false;
        }

        /* Update user data. */
        $user->ip     = $this->server->remote_addr;
        $user->last   = helper::now();
        $user->fails  = 0;
        $user->visits ++;

        /* Save login log if user is admin. */
        if($user->admin == 'super' or $user->admin == 'common') $this->saveLog($user->account, 'success');

        $this->dao->setAutolang(false)->update(TABLE_USER)->data($user)->where('account')->eq($account)->exec();

        $user->realname = $this->computeRealname($user);
        $user->shortLast = substr($user->last, 5, -3);
        $user->shortJoin = substr($user->join, 5, -3);
        unset($_SESSION['random']);

        return $user;
    }

    /**
     * Authorize a user.
     * 
     * @param   object    $user   the user object.
     * @access  public
     * @return  array
     */
    public function authorize($user)
    {
        $rights = array();
        if(RUN_MODE == 'front') $rights = $this->config->rights->guest;
        if($user->account == 'guest') return $rights;

        if(RUN_MODE == 'front')
        {
            foreach($this->config->rights->member as $moduleName => $moduleMethods)
            {
                foreach($moduleMethods as $method) $rights[$moduleName][$method] = $method;
            }
        }
        elseif(RUN_MODE == 'admin')
        {
            $stmt = $this->dao->select('module, method')->from(TABLE_USERGROUP)->alias('t1')
                ->leftJoin(TABLE_GROUPPRIV)->alias('t2')->on('t1.group = t2.group')
                ->where('t1.account')->eq($user->account)->query();

            if(!$stmt) return $rights;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) $rights[strtolower($row['module'])][strtolower($row['method'])] = true;
        }

        return $rights;
    }

    /**
     * Juage a user is logon or not.
     * 
     * @access public
     * @return bool
     */
    public function isLogon()
    {
        return (isset($_SESSION['user']) and !empty($_SESSION['user']) and $_SESSION['user']->account != 'guest');
    }

    /**
     * Forbid the user
     *
     * @param string $date
     * @param int $userID
     * @access public
     * @return void
     */
    public function forbid($userID, $date)
    {
        $intdate = strtotime("+$date day");

        $format = 'Y-m-d H:i:s';

        $date = date($format,$intdate);
        $this->dao->setAutolang(false)->update(TABLE_USER)->set('locked')->eq($date)->where('id')->eq($userID)->exec();

        return !dao::isError();
    }

    /**
     * Activate the user.
     *
     * @param  int    $userID
     * @access public
     * @return bool
     */
    public function activate($userID)
    {
        $this->dao->setAutolang(false)->update(TABLE_USER)->set('locked')->eq('')->where('id')->eq($userID)->exec();
        return !dao::isError();
    }

    /**
     * Delete user.
     * 
     * @param  string    $account 
     * @param  null      $id          add this param to avoid the warning of php.
     * @access public
     * @return bool
     */
    public function delete($account, $id = null) 
    {
        $user = $this->getByAccount($account);
        if(!$user) return false;

        $this->dao->setAutolang(false)->delete()->from(TABLE_USER)->where('account')->eq($account)->exec();

        return !dao::isError();
    }

    /**
     * update the reset.
     * 
     * @param  string   $account
     * @access public
     * @return void
     */
    public function reset($account, $reset)
    {
        $this->dao->setAutolang(false)->update(TABLE_USER)->set('reset')->eq($reset)->where('account')->eq($account)->exec();
    }

    /**
     * Check the reset.
     * 
     * @param  string   $reset
     * @access public
     * @return void
     */
    public function checkReset($reset)
    {
        $resetTime = substr($reset, -10);
        if((time() - $resetTime) > $this->config->user->resetExpired) return false;
        $user = $this->dao->setAutolang(false)
            ->select('*')->from(TABLE_USER)
            ->where('reset')->eq($reset)
            ->fetch();
        return !empty($user);
    }

    /**
     * Reset the forgotten password.
     * 
     * @param  string   $reset
     * @param  string   $password 
     * @access public
     * @return void
     */
    public function resetPassword($reset, $password)
    {
        $user = $this->dao->setAutolang(false)->select('*')->from(TABLE_USER)
                ->where('reset')->eq($reset)
                ->fetch();
        
        $this->dao->setAutolang(false)->update(TABLE_USER)
            ->set('password')->eq($this->createPassword($password, $user->account))
            ->set('reset')->eq('')
            ->where('reset')->eq($reset)
            ->exec();
        return !dao::isError();
    }

    /**
     * Create a strong password hash with md5.
     *
     * @param  string    $password 
     * @param  string    $account 
     * @param  string    $join   new password is not with join 
     * @access public
     * @return void
     */
    public function createPassword($password, $account, $join = '')
    {
        return md5(md5($password) . $account . $join);
    }

    /**
     * Compare hash password use random
     * 
     * @param  string    $password 
     * @param  object    $user 
     * @access public
     * @return void
     */
    public function compareHashPassword($password, $user)
    {
        return $password == md5($user->password . $this->session->random);
    }

    /**
     * Create the callback address for oauth.
     * 
     * @param  string    $provider 
     * @param  string    $referer 
     * @access public
     * @return string
     */
    public function createOAuthCallbackURL($provider)
    {
        if($this->config->requestType == 'GET' and $provider == 'qq') return commonModel::getSysURL() . '/index.php/user-oauthCallback-qq.html';
        return commonModel::getSysURL() . helper::createLink('user', 'oauthCallback', "provider=$provider");
    }

    /**
     * Register an account when using OAuth.
     * 
     * @param  string    $provider 
     * @param  string    $openID 
     * @access public
     * @return void
     */
    public function registerOauthAccount($provider, $openID)
    {
        if($this->post->password1) $this->checkPassword();

        $user = fixer::input('post')
            ->setForce('join', helper::now())
            ->setForce('last', helper::now())
            ->setForce('visits', 1)
            ->setIF($this->cookie->referer != '', 'referer', $this->cookie->referer)
            ->setIF($this->cookie->referer == '', 'referer', '')
            ->remove('admin, ip')
            ->get();

        $user->password = $this->createPassword(md5(mt_rand()), $openID);
        if($this->post->password1) $user->password = $this->createPassword($this->post->password1, $user->account); 
        if(!isset($user->password1)) $this->config->user->require->register = 'account';

        $oldUser = $this->getByOpenID($openID, $provider);
        if($oldUser)
        {
            $this->dao->update(TABLE_USER)->data($user, $skip = 'password1,password2')
                ->autoCheck()
                ->batchCheck($this->config->user->require->register, 'notempty')
                ->check('account', 'unique')
                ->check('account', 'account')
                ->checkIF(isset($user->email), 'email', 'unique')
                ->checkIF(isset($user->email), 'email', 'email')
                ->where('id')->eq($oldUser->id)
                ->exec();

           $this->dao->update(TABLE_MESSAGE)->set('account')->eq($user->account)->where('account')->eq($oldUser->account)->exec();
           $this->dao->update(TABLE_MESSAGE)->set('to')->eq($user->account)->where('account')->eq($oldUser->account)->exec();
           $this->dao->update(TABLE_THREAD)->set('author')->eq($user->account)->where('author')->eq($oldUser->account)->exec();
           $this->dao->update(TABLE_THREAD)->set('repliedBy')->eq($user->account)->where('repliedBy')->eq($oldUser->account)->exec();
           $this->dao->update(TABLE_REPLY)->set('author')->eq($user->account)->where('author')->eq($oldUser->account)->exec();
           $this->dao->update(TABLE_CATEGORY)->set('postedBy')->eq($user->account)->where('postedBy')->eq($oldUser->account)->exec();
           $this->dao->update(TABLE_ADDRESS)->set('account')->eq($user->account)->where('account')->eq($oldUser->account)->exec();
           $this->dao->update(TABLE_CART)->set('account')->eq($user->account)->where('account')->eq($oldUser->account)->exec();
           $this->dao->update(TABLE_ORDER)->set('account')->eq($user->account)->where('account')->eq($oldUser->account)->exec();
        }
        else
        { 
            $this->dao->insert(TABLE_USER)->data($user, $skip = 'password1,password2')
                ->autoCheck()
                ->batchCheck($this->config->user->require->register, 'notempty')
                ->check('account', 'unique')
                ->check('account', 'account')
                ->check('email', 'unique')
                ->check('email', 'email')
                ->exec();
        }

        if(dao::isError()) return false;
        return $this->bindOAuthAccount($this->post->account, $provider, $openID);
    }

    /**
     * Bind an OAuth account.
     * 
     * @param  string    $account    the chanzhi system account
     * @param  string    $provider   the OAuth provider
     * @param  string    $openID     the open id from provider
     * @access public
     * @return bool
     */
    public function bindOAuthAccount($account, $provider, $openID)
    {
        if(!$account or !$provider or !$openID) return false;

        $openUser = $this->dao->select('*')->from(TABLE_OAUTH)->where('provider')->eq($provider)->andWhere('openID')->eq($openID)->fetch();
          
        if(empty($openUser))
        {
            return $this->dao->replace(TABLE_OAUTH)
                ->set('account')->eq($account)
                ->set('provider')->eq($provider)
                ->set('openID')->eq($openID)
                ->set('lang')->eq('all')
                ->exec();
        }
        else
        {
            $user = $this->getByOpenID($openID, $provider);
            if($user)
            { 
                $this->dao->update(TABLE_MESSAGE)->set('account')->eq($account)->where('account')->eq($user->account)->exec();
                $this->dao->update(TABLE_MESSAGE)->set('to')->eq($account)->where('account')->eq($user->account)->exec();
                $this->dao->update(TABLE_THREAD)->set('author')->eq($account)->where('author')->eq($user->account)->exec();
                $this->dao->update(TABLE_THREAD)->set('repliedBy')->eq($account)->where('repliedBy')->eq($user->account)->exec();
                $this->dao->update(TABLE_REPLY)->set('author')->eq($account)->where('author')->eq($user->account)->exec();
                $this->dao->update(TABLE_CATEGORY)->set('postedBy')->eq($account)->where('postedBy')->eq($user->account)->exec();
                $this->dao->update(TABLE_ADDRESS)->set('account')->eq($account)->where('account')->eq($user->account)->exec();
                $this->dao->update(TABLE_CART)->set('account')->eq($account)->where('account')->eq($user->account)->exec();
                $this->dao->update(TABLE_ORDER)->set('account')->eq($account)->where('account')->eq($user->account)->exec();

                $this->dao->setAutolang(false)->delete()->from(TABLE_USER)->where('id')->eq($user->id)->exec();
                if(dao::isError()) return false;
            }

            $this->dao->setAutolang(false)->update(TABLE_OAUTH)
                ->set('account')->eq($account)
                ->set('provider')->eq($provider)
                ->where('openID')->eq($openID)
                ->exec();
            return !dao::isError();
        }
    }

    /**
     * Unbind an OAuth account.
     * 
     * @param  string    $account    the chanzhi system account
     * @param  string    $provider   the OAuth provider
     * @param  string    $openID     the open id from provider
     * @access public
     * @return bool
     */
    public function unbindOAuthAccount($account, $provider, $openID)
    {
        if(!$account or !$provider or !$openID) return false;

        $this->dao->setAutolang(false)->delete()->from(TABLE_OAUTH)
            ->where('account')->eq($account)
            ->andWhere('provider')->eq($provider)
            ->andWhere('openID')->eq($openID)
            ->exec();
        return !dao::isError();
    }

    /**
     * Get user by an open id.
     * 
     * @param  string    $provider 
     * @param  string    $openID 
     * @access public
     * @return object|bool
     */
    public function getUserByOpenID($provider, $openID)
    {
        $account = $this->dao->setAutolang(false)->select('account')->from(TABLE_OAUTH)
            ->where('provider')->eq($provider)
            ->andWhere('openID')->eq($openID)
            ->fetch('account');

        if(!$account) return false;
        return $this->getByAccount($account);
    }

    /**
     * Save admin login log. 
     * 
     * @param  string $account 
     * @access public
     * @return bool
     */
    public function saveLog($account, $result)
    {
        $this->app->loadClass('IP');
        $ip = helper::getRemoteIP();
        $location = IP::find($ip);

        $extData = new stdclass();
        $extData->userAgent = $this->server->http_user_agent;

        $data = new stdclass();
        $data->account     = $account;
        $data->date        = helper::now();
        $data->ip          = $ip;
        $data->location    = is_array($location) ? join(' ', $location) : $location;
        $data->browser     = helper::getBrowser() . ' ' . helper::getBrowserVersion();
        $data->type        = 'adminlogin';
        $data->desc        = $result;
        $data->lang        = 'all';
        $data->ext         = json_encode($extData);

        $this->dao->insert(TABLE_LOG)->data($data)->exec();
        return !dao::isError();
    }

    /**
     * Get admin login log list. 
     * 
     * @param  object $pager 
     * @param  string $account 
     * @param  string $ip 
     * @param  string $location 
     * @param  string $date 
     * @access public
     * @return array
     */
    public function getLogList($pager = null, $account = '', $ip = '', $location = '', $date = '')
    {
        $logs = $this->dao->select()->from(TABLE_LOG)->setAutolang(false)
            ->where('1=1')
            ->beginIf(!empty($account))->andWhere('account')->eq($account)->fi()
            ->beginIf(!empty($ip))->andWhere('ip')->eq($ip)->fi()
            ->beginIf(!empty($location))->andWhere('location')->like($location)->fi()
            ->beginIf(!empty($date))->andWhere('date')->eq($date)->fi()
            ->orderby('id_desc')
            ->page($pager)
            ->fetchAll('id');

        foreach($logs as $log)
        {
            if(!empty($log->ext))
            {
                $extData = json_decode($log->ext);
                foreach($extData as $key => $value)
                {
                    $log->$key = $value;
                }
            }
        }

        return $logs;
    }

    /*
     * compute realname of client lang.
     * 
     * @param  string    $realname 
     * @access public
     * @return string
     */
    public function computeRealname($user)
    {
        if(!$user->realnames)
        {
            $realname = $user->realname;
        }
        else
        {
            $realnames = json_decode($user->realnames);
            $clientLang = $this->app->getClientLang();
            if(strpos($clientLang, 'zh-') !== false) $clientLang = str_replace('zh-', '', $clientLang);
            $realname = isset($realnames->{$clientLang}) ? $realnames->{$clientLang} : '';
        }

        return $realname ? $realname : $user->account;
    }

    /**
     * check client IP is allowed. 
     * 
     * @access public
     * @return bool
     */
    public function checkIP()
    {
        if(isset($this->config->site->safeMode) and $this->config->site->safeMode == '1') return true;
        if(!isset($this->config->site->checkIP) or $this->config->site->checkIP == 'close') return true;
        if(!isset($this->config->site->allowedIP) or $this->config->site->allowedIP == '') return true;

        $ips = explode(',', $this->config->site->allowedIP);
        $clientIP = helper::getRemoteIp();
        foreach($ips as $ip)
        {
            if(helper::checkIpScope($clientIP, $ip)) return true;
        }
        return false;
    }

    /**
     * checkLocation 
     * 
     * @access public
     * @return bool
     */
    public function checkLocation()
    {
        if(isset($this->config->site->safeMode) and $this->config->site->safeMode == '1') return true;
        if(!isset($this->config->site->checkLocation) or $this->config->site->checkLocation == 'close') return true;
        if(!isset($this->config->site->allowedLocation) or $this->config->site->allowedLocation == '') return true;

        $allowedLocation = $this->config->site->allowedLocation;
        $location = $this->app->loadClass('IP')->find(helper::getRemoteIp());
        if(is_array($location))
        {
            $locations = $location;
            $location  = join(' ', $locations);
            if(count($location) > 3) $location = $locations[0] . ' ' . $locations[1] . ' ' . $locations[2];
        }
        return $allowedLocation == $location;
    }

    /**
     * Create a token.
     * 
     * @access public
     * @return void
     */
    public function getToken()
    {
        if(!empty($this->app->user->token) and $this->app->user->tokenExpired >= time())
        {
            $token = $this->app->user->token;
        }
        else
        {
            $this->app->user->tokenExpired = time() + 180;
            $this->app->user->token = uniqid(md5($this->app->user->fingerprint . $this->app->user->tokenExpired));
        }
        return $this->app->user->token;
    }

    /**
     * Check Token and fingerprint.
     * 
     * @param  string    $token 
     * @access public
     * @return void
     */
    public function checkToken($token, $fingerprint)
    {
       if($fingerprint != $this->app->user->fingerprint) return false;

       if($token != $this->getToken()) return false;

       if(strpos($token, md5($this->app->user->fingerprint . $this->app->user->tokenExpired)) === 0) return true;

       return false;
    }

    /**
     * Check email.
     * 
     * @param  int    $email 
     * @param  int    $account 
     * @access public
     * @return void
     */
    public function checkEmail($email)
    {
        $user = new stdclass();
        $user->email          = $email;
        $user->emailCertified = 1;

        $this->dao->update(TABLE_USER)
            ->data($user)
            ->check('email', 'notempty')
            ->where('account')->eq($this->app->user->account)
            ->exec();

        return !dao::isError();
    }
}
