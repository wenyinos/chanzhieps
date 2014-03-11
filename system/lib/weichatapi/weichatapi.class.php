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
     * The signature computed.
     * 
     * @var int   
     * @access public
     */
    public $signature;

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
     * Debug or not.
     * 
     * @var bool   
     * @access public
     */
    public $debug;

    /**
     * The log file.
     * 
     * @var string   
     * @access public
     */
    public $logFile;

    /**
     * The construct function.
     * 
     * @param  string    $token 
     * @param  string    $appID 
     * @param  string    $secret 
     * @param  bool      $debug 
     * @access public
     * @return void
     */
    public function __construct($token, $appID, $secret, $debug = false)
    {
        $this->setToken($token);
        $this->setAppID($appID);
        $this->setSecret($secret);
        $this->setDebug($debug);
        $this->checkSign();
    }

    /**
     * Set debug.
     * 
     * @param  bool    $debug 
     * @access public
     * @return void
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
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
        if(empty($_GET['signature']) or empty($_GET['timestamp']) or empty($_GET['nonce'])) return false;

        $sign = $_GET['signature'];
        $time = $_GET['timestamp'];
        $rand = $_GET['nonce'];    

        $this->computeSign($time, $rand);
        if($sign != $this->signature) die('signature error');
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
        sort($sign, SORT_STRING);
        $this->signature = sha1(join($sign));
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
            $message = new simpleXMLElement($this->rawData);
            foreach($message as $key => $value)
            {
                $key = lcfirst($key);
                $this->message->$key = (string)$value;
            }
        }
    }

    /**
     * Response a message.
     * 
     * @access public
     * @return void
     */
    public function response($response)
    {
        $response->toUserName   = $this->message->fromUserName;
        $response->fromUserName = $this->message->toUserName;
        $response->createTime   = time();
        $this->response = $this->convertObject2XML($response);
        die($this->response);
    }

    /**
     * Convert a object to a xml message.
     * 
     * @param  object    $object 
     * @access public
     * @return string
     */
    public function convertObject2XML($object)
    {
        $xml = "<xml>\n";
        foreach($object as $key => $value)
        {
            $key = ucfirst($key);
            $xml .= "<$key><![CDATA[$value]]></$key>\n";
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     * Get qrcode for a public account.
     * 
     * @param  string    $file 
     * @access public
     * @return void
     */
    public function getQRCode($file)
    {
        /* The params to post. */
        $params['action_name'] = 'QR_LIMIT_SCENE';
        $params['action_info']['scene']['scene_id'] = 1;

        /* Get the ticket. */
        $token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$token";
        $data = json_decode($this->post($url, json_encode($params)));
        if(!isset($data->ticket)) return false;

        /* Get qrcode. */
        $url  = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . urlencode($data->ticket);
        $data = $this->get($url);
        file_put_contents($file, $data);
    }

    /**
     * Get access token.
     * 
     * @access public
     * @return string
     */
    public function getAccessToken()
    {
        if(isset($_SESSION['wxToken'][$this->appID]))
        {
            if(time() < $_SESSION['wxToken'][$this->appID]->expires) return $_SESSION['wxToken'][$this->appID]->token;
        }

        $time = time();

        /* Set params. */
        $param['grant_type'] = 'client_credential';
        $param['appid'] = $this->appID;
        $param['secret'] = $this->secret;

        /* Get the token. */
        $api = 'https://api.weixin.qq.com/cgi-bin/token?' . http_build_query($param);
        $data = $this->get($api);
        $data = json_decode($data);
        if(!$data) return false;

        /* Save it to session. */
        $token = new stdclass();
        $token->token   = $data->access_token;
        $token->expires = $time + $data->expires_in;
        $_SESSION['wxToken'][$this->appID] = $token;

        return $token->token;
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

    public function post($url, $data)
    {   
        if(!function_exists('curl_init')) die('I can\'t do post action without curl extension.');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }   

    /**
     * The destruct function, save log.
     * 
     * @access public
     * @return void
     */
    public function __destruct()
    {
        if(!$this->debug) return;
        if(!isset($_GET['signature'])) return false;

        $logFile = dirname(dirname(dirname(__FILE__))) . '/tmp/log/weichat.' . date('Ymd') . '.log';
        if(!is_writable(dirname($logFile))) return false;

        $log  = date('H:i:s: ') . $_SERVER['REQUEST_URI'] . "\n\n";
        $log .= "[Signature]\n" . $_GET['signature'] . " got\n" . $this->signature . " computed\n\n";
        $log .= "[Message]\n" . $this->rawData . "\n";
        $log .= print_r($this->message, true) . "\n";
        $log .= "[Response]\n" . print_r($this->response, true) . "\n";

        $fh = fopen($logFile, 'a+');
        fwrite($fh, $log);
    }
}
