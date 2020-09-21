<?

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    public function _initSession() {
        ini_set('session.hash_bits_per_character', 5);
        //Zend_Session::start();
    }

    /**
     * Defines constants
     */
    protected function _initDefines() {
        defined('DS') || define('DS', DIRECTORY_SEPARATOR);

        defined('KEYRIGHTS_PRODUCTION') || define('KEYRIGHTS_PRODUCTION', "production");
        defined('KEYRIGHTS_DEVELOPMENT') || define('KEYRIGHTS_DEVELOPMENT', "development");
        define('LANG_CHARSET', 'utf-8');

        defined('DEBUG') || define('DEBUG', (APPLICATION_ENV == KEYRIGHTS_DEVELOPMENT));

        defined('BX_PERSONAL_ROOT') || define('BX_PERSONAL_ROOT', '/bitrix');
    }

    /**
     * Init Config
     */
    public function _initConfiguration() {
        $config = new Zend_Config($this->getApplication()->getOptions(), true);
        Zend_Registry::set('config', $config);
        return $config;
    }

    /**
     * Init Autoload
     */
    protected function _initAutoload() {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            "namespace" => "",
            "basePath" => APPLICATION_PATH
        ));

        $autoloader->addResourceTypes($this->configuration->autoloader->toArray());

        return $autoloader;
    }

    /**
     * @return Zend_Cache_Frontend
     */
    protected function _initCache() {
        if (!file_exists($this->configuration->options->cache->backend->cache_dir)) {
            mkdir($this->configuration->options->cache->backend->cache_dir, 0755, true);
        }

        return Zend_Cache::factory(
            'Output',
            'File',
            $this->configuration->options->cache->frontend->toArray(),
            $this->configuration->options->cache->backend->toArray()
        );
    }

    /**
     * Init Routes
     */
    public function _initRouting() {
        if (!$serializedRouter = $this->cache->load('bootstrap_router')) {
            $routes = new Zend_Config(require_once APPLICATION_PATH . DS . 'configs' . DS . 'routes.inc');

            $router = new Zend_Controller_Router_Rewrite();
            $router->addConfig($routes, 'routes');

            $this->cache->save(serialize($router), 'bootstrap_router');
        } else {
            $router = unserialize($serializedRouter);
        }

        $front = Zend_Controller_Front::getInstance();
        $front->setRouter($router);

        return $router;
    }
}
