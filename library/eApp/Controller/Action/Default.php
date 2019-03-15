<?php

class eApp_Controller_Action_Default
    extends eVias_Controller_Action
{
    public function init()
    {
        parent::init();

        $this->injectMessaging();
        $this->initView();
        $this->initController();
        $this->initLanguageUpdate();
    }

    public function initView()
    {
        $this->view->headTitle()->setSeparator(' - ');
        $this->view->headTitle("eVias Kernel v1.3.29");

        $this->view->headMeta()
             ->appendHttpEquiv('Content-type', 'text/html;charset=utf-8')
             ->appendName("description", "eVias Kernel * eApp Kernel * Kernel for Zend web applications")
             ->appendName("keywords", "")
             ->appendName("author", "eVias.be (service@evias.be)")
             ->appendName("og:title", "eVias Kernel * eApp Kernel * Kernel for Zend web applications")
             ->appendName("og:description", "eVias Kernel * eApp Kernel * Kernel for Zend web applications")
             ->appendName("og:image", "/images/application-logo.png");

        $this->view->layout()->setLayout("public");
    }

    public function initController()
    {
        $layout = "public";
        if (eApp_Environment::isMobile())
            $layout = "mobile";

        $this->view->layout()->setLayout($layout);

        /* no layout for XHR with no-layout param! */
        if ($this->getRequest()->isXmlHttpRequest()
            && (true === (bool) ((int) $this->_getParam("no-layout", 0))))
            $this->view->layout()->disableLayout(true);
    }

    public function initLanguageUpdate()
    {
        $tr_path_base = APPLICATION_PATH . "/configs/lang";

        $session  = new Zend_Session_Namespace(eApp_SessionKey::get());
        $lang = "fr";
        if (isset($session->current_lang)
            && in_array($session->current_lang, array("fr", "de", "en","nl")))
            $lang = $session->current_lang;

        /* check for "language" parameter in request params. */
        $lang = $this->getRequest()->getParam("language", $lang);
        if (! in_array($lang, array("fr", "de", "en", "nl")))
            $lang = "fr";

        $session->current_lang = $lang;
        eApp_Translator::setTranslator($lang);
    }

    /**
     * get current request's referer URI parameter.
     * Can be empty in case no redirection was performed
     * by the platform.
     *
     * @return string
     */
    public function getRefererUri()
    {
        if (null !== $this->_getParam("referer", null))
            return urldecode($this->_getParam("referer"));

        return "/";
    }

    public function addMessage($msg)
    {
        $this->_helper
             ->getHelper("FlashMessenger")
             ->setNamespace("messages")
             ->addMessage($msg);
    }

    public function addWarning($msg)
    {
        $this->_helper
             ->getHelper("FlashMessenger")
             ->setNamespace("warnings")
             ->addMessage($msg);
    }

    public function addError($err)
    {
        $this->_helper
             ->getHelper("FlashMessenger")
             ->setNamespace("errors")
             ->addMessage($err);
    }

    private function injectMessaging()
    {
        /* Check for previous request' messages */
        $messages = $this->_helper
                         ->getHelper("FlashMessenger")
                         ->setNamespace("messages")
                         ->getMessages();
        $errors   = $this->_helper
                         ->getHelper("FlashMessenger")
                         ->setNamespace("errors")
                         ->getMessages();
        $warnings = $this->_helper
                         ->getHelper("FlashMessenger")
                         ->setNamespace("warnings")
                         ->getMessages();

        /* Inject */
        $this->view->messages = $messages;
        $this->view->errors   = $errors;
        $this->view->warnings = $warnings;
    }
}
