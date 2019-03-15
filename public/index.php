<?php
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

defined('GALLERIES_PATH')
    || define('GALLERIES_PATH', realpath(dirname(__FILE__) . '/images/galleries'));

defined('FLYERS_PATH')
    || define('FLYERS_PATH', realpath(dirname(__FILE__) . '/images/flyers'));

defined('APPLICATION_ENV')
	|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(
	implode(PATH_SEPARATOR, array(
		realpath(APPLICATION_PATH . '/../library'),
	    get_include_path(),)
	)
);

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/config/application.ini'
);

try {
    $application->bootstrap()
                ->run();
}
catch (Exception $e) {
    echo $e->getTraceAsString(), "<br />";
    die('INDEX: ' . $e->getMessage());
}
