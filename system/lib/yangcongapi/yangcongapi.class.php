<?php
class yangcongapi
{
    protected $config;
    const API_QRCODE_FOR_BINDING = 'https://api.yangcong.com/v2/qrcode_for_binding';
    const API_EVENT_RESULT       = 'https://api.yangcong.com/v2/event_result';
    public function __construct($config)
    {
        $this->setConfig($config);
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function getQrcode()
    {
        $this->config->signature = md5("app_id=" . $this->config->appID . $this->config->key);
        $url = self::API_QRCODE_FOR_BINDING . "?app_id={$this->config->appID}&signature={$this->config->signature}";

        return $this->get($url);
    }

    public function getResultByEvent($eventID)
    {
        $this->config->signature = md5("app_id=" . $this->config->appID . "event_id=" . $eventID . $this->config->key);
        $url = self::API_EVENT_RESULT . "?app_id={$this->config->appID}&event_id={$eventID}&signature={$this->config->signature}";
        return $this->get($url);
    }


    public function get($url)
    {
        $response = file_get_contents($url);
        $response = json_decode($response);
        $this->log(var_export($response, true));
        return $response;
    }
    
    public  function log($response)
    {
        /* Set log file. */
        $logFile = dirname(dirname(dirname(__FILE__))) . '/tmp/log/yangcong.' . date('Ymd') . '.log.php';
        if(!is_writable(dirname($logFile))) return false;

        if(!file_exists($logFile)) file_put_contents($logFile, "<?php die();?> \n");
        file_put_contents($logFile, var_export($response, true));
    }
}
