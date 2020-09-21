<?

class SibirixKeyrightsBackend_Model_Abstract {

    static $_available_methods = array();

    /**
     * @param $methodName
     * @return bool
     */
    public function isMethodAvailable($methodName) {
        return (array_search(strtolower($methodName), array_keys(static::$_available_methods)) !== false);
    }

    /**
     * @param $methodName
     * @return bool|mixed
     */
    public function callMethod($methodName, $params) {
        if (!$this->isMethodAvailable($methodName)) {
            return false;
        }

        return call_user_func_array(array($this, static::$_available_methods[strtolower($methodName)]), array($params));
    }

}
