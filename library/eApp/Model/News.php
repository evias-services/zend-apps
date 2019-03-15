<?php

class eApp_Model_News
	extends eApp_Model_Base
{
	protected $_tableName = "e_news";
    protected $_pk        = "id_news";
    protected $_sequence  = "";
    protected $_fields    = array(
        "title",
        "date_news",
        "date_created",
        "date_updated",
    );

    static public function getLastTen()
    {
        return self::getList(array(
            "order" => "date_news DESC",
            "limit" => 10));
    }
}
