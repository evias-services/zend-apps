<?php

class backOffice_AuthController
    extends eApp_Controller_Action_BackOffice
{
    public function loginAction()
    {
    	if ($this->getRequest()->isPost()) :
    		$uname = $this->_getParam("b5bf93e700d8bd890e9a145f2c66392881d1d701");
    		$pass  = $this->_getParam("9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684");

    		if (empty($uname) || empty($pass)
                || ! (bool) preg_match("/[A-Za-z][A-Za-z0-9\-_]+/", $uname)
                || ! (bool) preg_match("/[A-Za-z0-9\-_\?\+#'\"]+/", $pass)) :
    			$this->addError($this->view->translate("error_wrong_credentials"));
    			$this->_redirect("/back-office/auth/login");
    		endif;

            $salt  = eApp_Model_User::getList(array(
                "conditions" => array("login = :uname"),
                "parameters" => array("uname" => $uname),
                "limit"      => 1));
            $salt  = $salt[0];
            $salt  = $salt->salt;

    		$users = eApp_Model_User::getList(array(
    			"conditions" => array("login = :uname AND password = :pass"),
    			"parameters" => array(
					'uname' => $uname,
					'pass'  => sha1($salt . $pass . $salt)),
    			"limit"      => 1));

    		if (empty($users)):
                $this->addError($this->view->translate("error_wrong_credentials"));
    			$this->_redirect("/back-office/auth/login");
    		endif;

    		$identity = new stdClass;
    		$identity->user_name = $uname;

    		Zend_Auth::getInstance()->getStorage()->write($identity);
            $this->addMessage($this->view->translate("message_auth_welcome"));
    		$this->_redirect("/back-office");
    	endif;
    }

    public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();

    	$this->_redirect("/back-office/auth/login");
    }
}
