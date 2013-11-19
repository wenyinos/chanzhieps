<?php
/**
 * The model file of cache module of ZenTaoCMS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
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
        $this->cacheRoot = $this->app->getTmpRoot() . 'cache/';
        if(!is_dir($this->cacheRoot))mkdir($this->cacheRoot, 0755, true);
    }

    /**
     * Create config cache.
     * 
     * @access public
     * @return void
     */
    public function createConfigCache()
    {
        $cacheFile   = $this->cacheRoot . 'config.php';
        $siteConfigs = $this->loadModel('setting')->getItems('owner=system&module=common&section=site&key=lang,theme');
        $configCache = "<?php\n";
        foreach($siteConfigs as $config)
        {
            $configCache .= "\$config->default->{$config->key} = '$config->value';\n";
        }

        file_put_contents($cacheFile, $configCache);
    }
}

