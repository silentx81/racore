<?php
/**
 * User:        Raffael Wyss
 * Date:        30.11.12
 * Time:        06:47
 * Description: Testclass for de DB-Class
 */
use \racore\layer\core\Config AS Config;

require_once \racore\PROJECT_DOCUMENT_ROOT."/layer/core/Config.class.php";

class ConfigTest extends PHPUnit_Framework_TestCase
{
    /**
     * getConfig-Method to test
     */
    public function test_getConfig()
    {
        $this->assertEquals("", \racore\layer\core\Config::getConfig("abcd"));
    }
}

