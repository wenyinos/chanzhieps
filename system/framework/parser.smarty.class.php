<?php
class smartyParser
{
    static    $instance = NULL;
    protected $control;

    /**
     * Construct function load smarty lib and init smarty configures.
     * 
     * @param  object    $control 
     * @access public
     * @return void
     */
    public function __construct($control)
    {
        $this->control = $control;

        global $app, $config;
        $app->loadClass('smarty', true);
        $this->smarty = new Smartybc();
        $this->smarty->setTemplateDir(TPL_ROOT . 'view' . DS);
        $this->smarty->setCompileDir($app->getTmpRoot() . 'smarty_compile' . DS);
        $this->smarty->setConfigDir(TPL_ROOT . 'config' . DS);
        $this->smarty->setCacheDir($app->getTmpRoot() . 'smarty_cache' . DS);
        $this->smarty->debugging = $config->debug;

    }

    /**
     * Get instance of this parser.
     * 
     * @param  object    $control 
     * @static
     * @access public
     * @return object
     */
    static public function getInstance($control)
    {
        if(self::$instance == null)
        {
            self::$instance = new smartyParser($control);
        } 
        return self::$instance;
    }

    /**
     * Parse template.
     *
     * @param string $moduleName    module name
     * @param string $methodName    method name
     * @access private
     * @return string
     */
    public function parseDefault($moduleName, $methodName)
    {
        global $app, $config, $lang;
        $this->smarty->register_object('control', $this->control);
        $this->smarty->register_object('app', $app);
        $this->smarty->register_object('lang', $lang);
        $this->smarty->register_object('config', $config);

        $viewFile = $this->control->setViewFile($moduleName, $methodName);
        if(is_array($viewFile)) extract($viewFile);
        if(!isset($hookFiles)) $hookFiles = array();

        foreach($this->control->view as $item => $value)
        {
            $this->smarty->assign($item, $value);
        }
        
        $this->smarty->display($viewFile);
    }
}
