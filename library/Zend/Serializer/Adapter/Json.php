<?php
#require_once 'Zend/Serializer/Adapter/AdapterAbstract.php';

#require_once 'Zend/Json.php';

class Zend_Serializer_Adapter_Json extends Zend_Serializer_Adapter_AdapterAbstract
{
    protected $_options = array(
        'cycleCheck'           => false,
        'enableJsonExprFinder' => false,
        'objectDecodeType'     => Zend_Json::TYPE_ARRAY,
    );

    public function serialize($value, array $opts = array())
    {
        $opts = $opts + $this->_options;

        try  {
            return Zend_Json::encode($value, $opts['cycleCheck'], $opts);
        } catch (Exception $e) {
            #require_once 'Zend/Serializer/Exception.php';
            throw new Zend_Serializer_Exception('Serialization failed', 0, $e);
        }
    }

    public function unserialize($json, array $opts = array())
    {
        $opts = $opts + $this->_options;

        try {
            $ret = Zend_Json::decode($json, $opts['objectDecodeType']);
        } catch (Exception $e) {
            #require_once 'Zend/Serializer/Exception.php';
            throw new Zend_Serializer_Exception('Unserialization failed by previous error', 0, $e);
        }

        // json_decode returns null for invalid JSON
        if ($ret === null && $json !== 'null') {
            #require_once 'Zend/Serializer/Exception.php';
            throw new Zend_Serializer_Exception('Invalid json data');
        }

        return $ret;
    }
}
