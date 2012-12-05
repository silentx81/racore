<?php
/**
 * User:        Raffael Wyss
 * Date:        30.11.12
 * Time:        06:47
 * Description: Testclass for de DB-Class
 */

require_once "../public_html/layer/core/Main.class.php";

class MainTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test connect from the Database
     */
    public function test_construct() {
        $this->assertNotEquals(null, new \racore\layer\core\Main());
    }
}

