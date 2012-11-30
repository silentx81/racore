<?php
/**
 * User:        Raffael Wyss
 * Date:        29.11.12
 * Time:        21:57
 * Description:
 */
namespace racore\layer\core;
use \racore\layer\database\DB AS DB;

class Main
{
    public function __construct()
    {
        echo "hallo <hr>";
        $this->_requiredFiles();
        echo "DB-Connection: ".DB::connect("localhost", "raweb1", "raweb", "test")."<hr>";
        return $this;

    }


    private function _requiredFiles()
    {
        require_once 'layer/database/DB.class.php';
    }

}
