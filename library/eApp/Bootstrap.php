<?php

/**
 * Class eApp_Bootstrap
 *
 * Used for bootstrapping the iManage PHP applications.
 * After the execution of the _init* methods declared
 * in this class, Zend_Registry will have been populated
 * with following fields:
 *
 * - config (Zend_Config_Ini instance)
 * - db (Zend_Db_Adapter_(Pgsql|Mysql))
 *
 * Also, this class initializes the view renderer, the
 * view instance and the controller plugins.
 */
class eApp_Bootstrap
    extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initAutoloader()
    {
        $moduleAutoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => APPLICATION_PATH));

        // register namespace for eVias Framework
        $libAutoloader = Zend_Loader_Autoloader::getInstance();
        $libAutoloader->registerNamespace('eApp_');
        $libAutoloader->registerNamespace('eVias_');

        return $moduleAutoloader;
    }

    public function _initConfig()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . "/config/application.ini",
                                      APPLICATION_ENV);
        Zend_Registry::set("config", $config);
    }

    public function _initDatabaseConnection()
    {
        $host = $_SERVER['HTTP_HOST'];
        if (eApp_Environment::isDevelopment($host))
            return false;

        $config = new Zend_Config_Ini(
            APPLICATION_PATH . "/config/application.ini",
            APPLICATION_ENV);

        $db_conf = $config->db->toArray();
        switch ($config->db_type) {
            case "mysql":
                $adapter_class = "Zend_Db_Adapter_Pdo_Mysql";
                break;

            default :
            case "pgsql":
                $adapter_class = "Zend_Db_Adapter_Pdo_Pgsql";
                break;
        }

        $adapter = new $adapter_class($db_conf);
        eVias_ArrayObject_Db::setDefaultAdapter($adapter);
        Zend_Registry::set("db", $adapter);
    }

    public function _initViewHelpers()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $layout->setInflectorTarget(':script.:suffix');
        $layout->setViewSuffix('php');

        $view = new eVias_View(array("disable_translate" => true));
        $view->addHelperPath(dirname(__FILE__) . '/View/Helper/', 'eApp_View_Helper');

        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view)
                 ->setViewSuffix('php');

        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }

    public function _initPlugins()
    {
        Zend_Controller_Front::getInstance()
            ->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(array(
                "module" => "default",
                "controller" => "error",
                "action" => "error")));
    }

    public function _initTranslate()
    {
        $tr_path_base = APPLICATION_PATH . "/config/lang";

        $session  = new Zend_Session_Namespace(eApp_SessionKey::get());
        $lang     = "fr";
        if (isset($session->current_lang)
            && in_array($session->current_lang, array("fr", "de", "en", "nl")))
            $lang = $session->current_lang;

        if (! Zend_Auth::getInstance()->hasIdentity())
            $session->current_lang = $lang;

        eApp_Translator::setTranslator($lang);
    }
}
