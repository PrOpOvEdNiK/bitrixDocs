<?

class Resource_Backend
    extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $this->_patchDb();
        return $this;
    }

    private function _patchDb(){
        global $DB;
        $DB->DoConnect();

        $bootstrap = $this->getBootstrap();

        if ($DB->db_Conn instanceof mysqli) {
            $bootstrap->unregisterPluginResource('db');
            $bootstrap->registerPluginResource('db', array(
                'adapter' => 'Krmysqli',
                'params' => array(
                    'host' => 'localhost',
                    'username' => 'root',
                    'password' => '',
                    'dbname' => '',
                    'charset' => 'utf8'
                ),
                'isDefaultTableAdapter' => true,
            ));
        }

        $zdb = $bootstrap->getPluginResource('db')->getDbAdapter();
        $zdb->setConnectionResource($DB->db_Conn);

        $t = $bootstrap->getPluginResource('translate')->getTranslate();
        if ($t->charsetIsUtf8()) {
            $zdb->query("SET NAMES 'utf8'");
            $zdb->query('SET collation_connection = "utf8_unicode_ci"');
        } else {
            $zdb->query("SET NAMES 'cp1251'");
        }

        if ($bootstrap->cache) {
            $cache = clone($bootstrap->cache);
            $cache->setOption('automatic_serialization', true);

            Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);
        }

        Zend_Registry::set('db', $zdb);

        return $this;
    }
}
