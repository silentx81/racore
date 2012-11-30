<?php
/**
 * User:        Raffael Wyss
 * Date:        30.11.12
 * Time:        06:45
 * Description: Index for the UNITTEST
 */

// Set new include path to PEAR
$path = '/usr/share/php5/PEAR';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

// Include all needed files
require_once 'PHPUnit/Autoload.php';
require_once 'layer/database/DBTest.class.php';
require_once 'layer/core/MainTest.class.php';

// Create test suite
$suite = new PHPUnit_Framework_TestSuite('PHPUnit');
$suite->addTestSuite('DBTest');
$suite->addTestSuite('MainTest');
$result = PHPUnit_TextUI_TestRunner::run($suite);

// Return test suite results
$resultObj = new PHPUnit_TextUI_ResultPrinter();
echo "<pre>";
echo $resultObj->printResult($result);
echo "</pre>";