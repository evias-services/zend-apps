<?php
interface Zend_Serializer_Adapter_AdapterInterface 
{
    public function __construct($opts = array());

    public function setOptions($opts);

    public function setOption($name, $value);

    public function getOptions();

    public function getOption($name);

    public function serialize($value, array $options = array());

    public function unserialize($serialized, array $options = array());
}
