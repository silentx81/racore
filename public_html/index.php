<?php
/**
 * User:        Raffael Wyss
 * Date:        29.11.12
 * Time:        21:43
 * Description: Startdatei
 */
namespace racore;
use \racore\layer\core\Config AS Config;
use \racore\layer\core\Main AS Main;

/**
 * Define Documtent AND Project Document Root
 */
const PROJECT_DOCUMENT_ROOT = __DIR__;
$lstrDocRoot = $_SERVER['DOCUMENT_ROOT'];
$lstrProject = str_replace($lstrDocRoot, '', str_replace('\\', '/', __DIR__));
$lstrProtocol = "https://";
if(!isset($_SERVER['HTTPS']) OR $_SERVER['HTTPS'] == 'off') {
    $lstrProtocol = "http://";
}
define('PROJECT_HTTP_ROOT', $lstrProtocol.$_SERVER['HTTP_HOST'].$lstrProject);


error_reporting(E_ALL);

echo PROJECT_DOCUMENT_ROOT."<hr>";

/**
 * Main-Requirements
 */
require_once PROJECT_DOCUMENT_ROOT.'/layer/core/Config.class.php';

/**
 * Requirements
 */
require_once PROJECT_DOCUMENT_ROOT.'/layer/core/Main.class.php';

/**
 * Start the Main-Process
 */
$Main = new Main();