<?php
/**
 * The weichat class file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2014 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     lib
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class weichatapi
{
    /**
     * The token.
     * 
     * @var string   
     * @access public
     */
    public $token;

    /**
     * The application id.
     * 
     * @var string   
     * @access public
     */
    public $appID;

    /**
     * The application secret.
     * 
     * @var string   
     * @access public
     */
    public $secret;

    /**
     * The raw data posted by weichat server.
     * 
     * @var string   
     * @access public
     */
    public $rawData;

    /**
     * The message object.
     * 
     * @var object   
     * @access public
     */
    public $message;

    /**
     * The construct function.
     * 
     * @param  string    $token 
     * @param  string    $appID 
     * @param  string    $secret 
     * @access public
     * @return void
     */
    public function __construct($token, $appID, $secret)
    {
        $this->setToken($token);
        $this->setAppID($appID);
        $this->setSecret($secret);
        $this->checkSign();
    }

    /**
     * Set the application token.
     * 
     * @param  string    $token 
     * @access public
     * @return void
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Set the application id.
     * 
     * @param  string    $appID 
     * @access public
     * @return void
     */
    public function setAppID($appID)
    {
        $this->appID = $appID;
    }

    /**
     * Set the application secret.
     * 
     * @param  string    $secret 
     * @access public
     * @return void
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * Check the signature.
     * 
     * @access public
     * @return void
     */
    public function checkSign()
    {
        if(empty($_GET['signature']) or empty($_GET['timestamp']) or empty($_GET['nonce'])) die('evil request');

        $sign = $_GET['signature'];
        $time = $_GET['timestamp'];
        $rand = $_GET['nonce'];    

        if($sign != $this->computeSign($time, $rand)) die('signature error');
        if(isset($_GET['echostr'])) die($_GET['echostr']);
    }

    /**
     * Compute the signature.
     * 
     * @param  int    $time 
     * @param  string $rand 
     * @access public
     * @return void
     */
    public function computeSign($time, $rand)
    {
        $sign = array($this->token, $time, $rand);
        sort($sign);
        return sha1(join($sign));
    }

    /**
     * Get a message from weichat server.
     * 
     * @access public
     * @return void
     */
    public function getMessage()
    {
        $this->rawData = '';
        $this->message = new stdclass();
        if(isset($GLOBALS["HTTP_RAW_POST_DATA"]))
        {
            $this->rawData = $GLOBALS["HTTP_RAW_POST_DATA"];
            $this->message = new simpleXMLElement($this->rawData);
        }
    }

    /**
     * Response a message.
     * 
     * @access public
     * @return void
     */
    public function response()
    {
    }

    /**
     * Get access token.
     * 
     * @access public
     * @return void
     */
    public function getAccessToken()
    {
    }

    /** 
     * Make a http get request and fetch the contents.
     * 
     * @param  string    $url 
     * @access public
     * @return string
     */
    public function get($url)
    {   
        if(ini_get('allow_url_fopen') == '1') return file_get_contents($url);
        if(!function_exists('curl_init')) die('I can\'t fetch anything, please set allow_url_fopen to ture or install curl extension');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }   
}
