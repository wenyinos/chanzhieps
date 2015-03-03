<?php
/**
 * The model file of cache module of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     cache
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class cacheModel extends model
{
    /**
     * Construct 
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->cacheRoot = $this->app->getTmpRoot() . 'cache';
        if(!is_dir($this->cacheRoot)) mkdir($this->cacheRoot, 0755, true);
    }

    /**
     * Create config cache.
     * 
     * @access public
     * @return bool
     */
    public function createConfigCache()
    {
        $cacheFile = $this->setConfigCacheFile();

        if(!is_writable($this->cacheRoot)) return false;
        if(is_file($cacheFile) and !is_writable($cacheFile)) return false;

        $siteConfigs = $this->loadModel('setting')->getItems('owner=system&module=common&section=site');

        $configCache = "<?php\n";
        foreach($siteConfigs as $config)
        {
            if($config->key == 'lang') 
            {
                $langs = explode(',', $config->value);
                $enabledLangs = array();
                foreach($langs as $lang) 
                {
                    if(!isset($this->config->langs[$lang])) return;
                    $enabledLangs[$lang] = $this->config->langs[$lang];
                }
                if(empty($enabledLangs)) return;
                $configCache .= "\$config->enabledLangs = array();\n";
                foreach($enabledLangs as $code => $name)
                {
                    $configCache .= "\$config->enabledLangs['{$code}'] = '$name';\n";
                }
            }

            if($config->key == 'defaultLang')
            {
                if(!isset($this->config->langs[$config->value])) return;
                $configCache .= "\$config->default->lang = '$config->value';\n";
            }
        }

        file_put_contents($cacheFile, $configCache);
        return true;
    }

    /**
     * Set configCache file.
     * 
     * @access public
     * @return string
     */
    public function setConfigCacheFile()
    {
        return $this->cacheRoot . DS . 'config.php';
    }
}
