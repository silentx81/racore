<?php
/**
 * User:        Raffael Wyss
 * Date:        30.11.12
 * Time:        06:47
 * Description: Testclass for de DB-Class
 */
use \racore\layer\database\DB AS DB;

require_once "../public_html/layer/database/DB.class.php";

class DBTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test connect from the Database
     */
    public function test_connect()
    {
        $this->assertEquals(false, DB::connect("Server", "Database", "User", "Password", "Typ"));
        $this->assertEquals(false, DB::connect("Server", "Database", "User", "Password"));
    }

    public function test_query()
    {

    }




}

