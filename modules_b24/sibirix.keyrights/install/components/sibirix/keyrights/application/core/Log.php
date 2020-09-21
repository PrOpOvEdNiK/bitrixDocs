<?php

class Core_Log {

    /**
     * Write info message to log file
     * @static
     * @param string $message
     * @return void
     */
    public static function info($message) {
        $logger = Zend_Registry::get('logger');
        
        $message = print_r($message, true);
        $logger->log($message, 1);

    }

    /**
     * Write error message to log file
     * @static
     * @param string $message
     * @return void
     */
    public static function error($message) {
        $logger = Zend_Registry::get('logger');
        $message = print_r($message, true);
        $logger->log($message, 3);

    }
}