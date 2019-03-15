<?php

class eApp_Translator
{
    static public function setTranslator($lang)
    {
        Zend_Registry::set("translator", self::_getAdapter($lang));
        Zend_Registry::set("current_lang", $lang);
    }

    static public function getTranslator($lang = null)
    {
        if (null != $lang)
            self::setTranslator($lang);

        return Zend_Registry::get("translator");
    }

    static public function getLanguage($lang)
    {
        return self::_getAdapter($lang);
    }

    static public function getCurrentLanguage()
    {
        return Zend_Registry::get("current_lang");   
    }

    static private function _getAdapter($lang)
    {
        $tr_path_base = APPLICATION_PATH . "/config/lang";
        return new Zend_Translate("ini", $tr_path_base . "/{$lang}.ini", $lang);
    }
}