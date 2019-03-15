<?php

class eApp_Controller_Action_BackOffice
    extends eApp_Controller_Action_Default
{
    public function init()
    {
        parent::init();
        $this->checkIdentity();
        $this->initLayout();
    }

    public function initView()
    {
        parent::initView();

        $this->view->headTitle("eVias Kernel | Admin");
    }

    public function initController()
    {
        parent::initController();
    }

    public function initLayout()
    {
        $this->view->layout()->setLayout("back_office");

        if ($this->getRequest()->isXmlHttpRequest())
            $this->view->layout()->disableLayout(true);
    }

    public function checkIdentity()
    {
        if (! Zend_Auth::getInstance()->hasIdentity()
            && $this->getRequest()->getControllerName() != "auth")
            $this->_redirect("/back-office/auth/login");
    }

    public function getIdentity()
    {
        $this->checkIdentity();
        return Zend_Auth::getInstance()->getIdentity();
    }
}
