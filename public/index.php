<?php
error_reporting(-1);
ini_set('display_errors',1);

date_default_timezone_set('America/Los_Angeles') ;

defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));



define('GLITCH_PUBLIC_PATH', dirname(__FILE__));
define('GLITCH_LIB_PATH', dirname(GLITCH_PUBLIC_PATH) . '/library');
define('GLITCH_APP_PATH', dirname(GLITCH_PUBLIC_PATH) . '/application');
define('GLITCH_DATA_PATH', dirname(GLITCH_PUBLIC_PATH) . '/data');
define('GLITCH_MODULES_PATH', GLITCH_APP_PATH . '/modules');
define('GLITCH_CACHES_PATH', GLITCH_DATA_PATH . '/caches');
define('GLITCH_CONFIGS_PATH', GLITCH_APP_PATH . '/configs');
define('GLITCH_LOGS_PATH', GLITCH_DATA_PATH . '/logs');
define('GLITCH_PIDS_PATH', GLITCH_DATA_PATH . '/pids');
define('GLITCH_LANGUAGES_PATH', GLITCH_DATA_PATH . '/locales');
/**#@-*/

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

// Performance: keep this path as short as possible
set_include_path(GLITCH_LIB_PATH . PATH_SEPARATOR . GLITCH_MODULES_PATH);

define('GLITCH_APP_ENV', 'development');

// Performance: utilize autoloading, omit require_once() calls
require_once GLITCH_LIB_PATH . '/Glitch/Loader/Autoloader.php';
new Glitch_Loader_Autoloader();

Glitch_Controller_Front::getInstance();

include_once "../application/Bootstrap.php";


Zend_Controller_Front::getInstance()->throwExceptions(true);
Zend_Controller_Front::getInstance()->setParam('useDefaultControllerAlways', true);

// Initialize the application
$application = new Zend_Application(GLITCH_APP_ENV, Glitch_Config_Ini::getConfig());

// Bootstrap all resource methods and plugins
$application->bootstrap();

$application->run();
