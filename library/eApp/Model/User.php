<?php

class eApp_Model_User
	extends eApp_Model_Base
{
	protected $_tableName = "e_user";
    protected $_pk        = "id_user";
    protected $_sequence  = "";
    protected $_fields    = array(
        "login",
        "salt",
        "password",
        "date_created",
        "date_updated",
    );
}