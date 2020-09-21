<?php
require_once 'Zend/Translate/Adapter/Array.php';

/**
 * поддержка 1251 битрикс
 */
class Core_Translate_Adapter_Array extends Zend_Translate_Adapter_Array
{
    private $_bitrix;
    private $_win1251 = false;
    const LOCALE_TEST = 'LOCALE_TEST';

    public function __construct($options = array())
    {
        parent::__construct($options);

        if (is_array($options)) {
            if (strtoupper(LANG_CHARSET) == strtoupper('windows-1251')) {
                $this->_win1251 = true;

                global $APPLICATION;
                $this->_bitrix = $APPLICATION;
            }
        }

        $this->validateLoadedTranslations($options);
    }

    protected function validateLoadedTranslations($options) {
        $locale = $this->_options['locale'];

        $filePath = $options['content'];

        $str = $this->_translate[$locale][self::LOCALE_TEST];

        if (function_exists("mb_strlen")) {
            if (mb_strlen($str, 'windows-1251') == mb_strlen($str, 'UTF-8')) {
                // Некорректно считались строки
                $this->_translate[$locale] = $this->manualLoadTranslations($filePath);
            }
        } else {
            $res = preg_match('%(?:[\xC2-\xDF][\x80-\xBF]|\xE0[\xA0-\xBF][\x80-\xBF]|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}|\xED[\x80-\x9F][\x80-\xBF]|\xF0[\x90-\xBF][\x80-\xBF]{2}|[\xF1-\xF3][\x80-\xBF]{3}|\xF4[\x80-\x8F][\x80-\xBF]{2})+%xs', $str);
            if (!$res) {
                $this->_translate[$locale] = $this->manualLoadTranslations($filePath);
            }
        }
    }

    /**
     * Ручная загрузка переводов
     * @param $filePath
     * @return array
     */
    public function manualLoadTranslations($filePath) {
        $rawData = file($filePath);
        $rawData = array_slice($rawData, 3, count($rawData) - 4);
        $goodData = array();
        foreach ($rawData as $line) {
            if (strlen($line) < 3) continue;
            $parts = explode("=>", $line);
            $key = trim($parts[0]);
            $key = str_replace(array("'", '"'), "", $key);
            $value = trim($parts[1], " ,");
            $value = trim($value, "'\"");
            $value = str_replace(array("',", "'"), "", $value);
            $goodData[$key] = $value;
        }

        return $goodData;
    }

    public function translate($messageId, $locale = null)
    {
        if (!$this->_win1251) {
            return parent::translate($messageId, $locale);
        }

        $message = parent::translate($messageId, $locale);
        return $this->_bitrix->ConvertCharset($message, "UTF-8", "windows-1251");
    }

    public function getMessages($locale = null)
    {
        if (!$this->_win1251) {
            return parent::getMessages($locale);
        }

        $messages = parent::getMessages($locale);
        foreach ($messages as $messageId => $message) {
            $messages[$messageId] = $this->_bitrix->ConvertCharset($message, "UTF-8", "windows-1251");;
        }

        return $messages;
    }

    public function charsetIsWin1251(){
        return (strtoupper(LANG_CHARSET) == strtoupper('windows-1251'));
    }

    public function charsetIsUtf8() {
        return (strtoupper(LANG_CHARSET) == strtoupper('utf-8'));
    }

    public function strlen($str) {
        if ($this->charsetIsWin1251()) {
            return strlen($str);
        }

        return mb_strlen($str);
    }

    public function substr($str, $from, $len) {
        if ($this->charsetIsWin1251()) {
            return substr($str, $from, $len);
        }

        return mb_substr($str, $from, $len);
    }
}
