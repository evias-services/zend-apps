<?php

class eApp_View_Helper_Translate
    extends Zend_View_Helper_Abstract
{
    /**
     * @param $tr_key string  translation key for message
     *
     * @return string
     */
    public function translate($tr_key)
    {
        return eApp_Translator::getTranslator()->_($tr_key);
    }
}