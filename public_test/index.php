<?php
/**
 * User:        Raffael Wyss
 * Date:        30.11.12
 * Time:        06:45
 * Description: Index for the UNITTEST
 */

/**
 * Define Documtent AND Project Document Root
 */
define("TEST_DOCUMENT_ROOT", __DIR__);
define('racore\PROJECT_DOCUMENT_ROOT',
                        str_replace("public_test", "public_html", __DIR__));

$lstrDocRoot = $_SERVER['DOCUMENT_ROOT'];
$lstrProject = str_replace($lstrDocRoot, '', str_replace('\\', '/', __DIR__));
$lstrProtocol = "https://";
if(!isset($_SERVER['HTTPS']) OR $_SERVER['HTTPS'] == 'off') {
    $lstrProtocol = "http://";
}
$lstrhttphost = str_replace("test", "", $_SERVER['HTTP_HOST']);
define('PROJECT_HTTP_ROOT', $lstrProtocol.$lstrhttphost.$lstrProject);
define('TEST_HTTP_ROOT', $lstrProtocol.$_SERVER['HTTP_HOST'].$lstrProject);

/**
 * Main-Requirements
 */
require_once racore\PROJECT_DOCUMENT_ROOT.'/layer/core/Config.class.php';
\racore\layer\core\Config::setConfig("root_path", "../public_html/");

// Set new include path to PEAR
$path = '/usr/share/php5/PEAR';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

// Include all needed files
require_once 'PHPUnit/Autoload.php';
require_once TEST_DOCUMENT_ROOT.'/layer/database/DBTest.class.php';
require_once TEST_DOCUMENT_ROOT.'/layer/core/MainTest.class.php';
require_once TEST_DOCUMENT_ROOT.'/layer/core/ConfigTest.class.php';

// Create test suite
$suite = new PHPUnit_Framework_TestSuite('PHPUnit');
$suite->addTestSuite('DBTest');
$suite->addTestSuite('MainTest');
$suite->addTestSuite('ConfigTest');
$result = PHPUnit_TextUI_TestRunner::run($suite);

// Return test suite results
$resultObj = new PHPUnit_TextUI_ResultPrinter();
echo "<pre>";
echo $resultObj->printResult($result);
echo "</pre>";