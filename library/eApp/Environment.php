<?php

class eApp_Environment
{
	static public function getHost()
	{
		$host = Zend_Controller_Front::getInstance()->getRequest()->getServer("HTTP_HOST");
		
		return $host;	
	}

	static public function isDevelopment($host = null)
	{
		if ($host == null)
			$host = Zend_Controller_Front::getInstance()->getRequest()->getServer("HTTP_HOST");

		return (bool) preg_match("/(.*)?\.gregmac\.local$/", $host);
	}

	static public function isProduction()
	{
		return ! self::isDevelopment();
	}

	static public function isMobile()
	{
		$host = Zend_Controller_Front::getInstance()->getRequest()->getServer("HTTP_HOST");

		return (bool) preg_match("/^m\.(.*)?/", $host);
	}
}
