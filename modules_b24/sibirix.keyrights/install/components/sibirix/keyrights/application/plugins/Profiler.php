<?php
class Plugin_Profiler extends Zend_Controller_Plugin_Abstract {

    private $_startTime;
    private $_point;

    private $_logger;

    private $_prev;

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        $this->_startTime = microtime();
    }

    private function _getLastTime($set = false){
        if ($set) {
            $this->_point = microtime();
            return $this->_point;
        }

        if (!$this->_point) {
            if ($this->_startTime) {
                $this->_point = $this->_startTime;
            } else {
                $this->_point = microtime();
            }
        }

        return $this->_point;
    }

    public function check($label = '') {
        $start = $this->_getLastTime();
        $end = $this->_getLastTime(true);

        list($uStart, $sStart) = explode(' ', $start);
        list($uEnd, $sEnd) = explode(' ', $end);

        $uDiff = ((float) $uEnd) - (float) $uStart;
        $sDiff = ((float) $sEnd) - (float) $sStart;
        $diff = $uDiff + $sDiff;

        $this->getLogger()->log("{$label} [{$diff}]", 1);
//        echo $label . ' ['. $diff . ']<br/>';
    }

    public function check2($label = null) {
        if (!$this->_prev) {
            $this->_prev = TIME_START_ZF;
        }

        $end = microtime(true);

        if ($label) {
            $this->getLogger()->log(sprintf("%s [%s]", $label, $end - $this->_prev), 1);
        } else {
            $this->getLogger()->log("{".($end - $this->_prev)."}", 1);
        }

        $this->_prev = $end;
    }

    public function postDispatch(Zend_Controller_Request_Abstract $request) {

        $endTime = microtime();

        // calculate difference without loss of precision :)
        list($uStart, $sStart) = explode(' ', $this->_startTime);
        list($uEnd, $sEnd) = explode(' ', $endTime);

        $uDiff = ((float) $uEnd) - (float) $uStart;
        $sDiff = ((float) $sEnd) - (float) $sStart;
        $diff = $uDiff + $sDiff;

        Core_Log_Profiler::log($diff);
    }

    private function getLogger() {
        if (!$this->_logger) {
            $this->_logger = Zend_Registry::get('logger');
        }
        return $this->_logger;
    }
}
