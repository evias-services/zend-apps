<?php
#require_once 'Zend/Serializer/Adapter/AdapterInterface.php';

abstract class Zend_Serializer_Adapter_AdapterAbstract implements Zend_Serializer_Adapter_AdapterInterface
{
protected $_options = array();

	public function __construct($opts = array()) 
    {
        $this->setOptions($opts);
    }

    public function setOptions($opts) 
    {
        if ($opts instanceof Zend_Config) {
            $opts = $opts->toArray();
        } else {
            $opts = (array) $opts;
        }

        foreach ($opts as $k => $v) {
            $this->setOption($k, $v);
        }
        return $this;
    }

    public function setOption($name, $value) 
    {
        $this->_options[(string) $name] = $value;
        return $this;
    }

    public function getOptions() 
    {
        return $this->_options;
    }

    public function getOption($name) 
    {
        $name = (string) $name;
        if (!array_key_exists($name, $this->_options)) {
            #require_once 'Zend/Serializer/Exception.php';
            throw new Zend_Serializer_Exception('Unknown option name "'.$name.'"');
        }

        return $this->_options[$name];
    }
}
