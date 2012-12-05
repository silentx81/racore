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

error_reporting(E_ALL);

/**
 * Main-Requirements
 */
require_once 'layer/core/Config.class.php';
Config::setConfig("root_path", "../public_html/");

/**
 * Requirements
 */
require_once 'layer/core/Main.class.php';

/**
 * Start the Main-Process
 */
$Main = new Main();