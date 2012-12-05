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
        $this->_requiredFiles();

        DB::connect("localhost", "raweb", "raweb", "test", "mysql");

        $lqqy = "SELECT * FROM test WHERE id>:id";
        $ladata['id'] = '{"value":"1", "type":"int", "length":"11"}';
        DB::query($lqqy, $ladata);

        echo "<br> Start <hr>";
        echo "<pre>";
        print_r(DB::fetchAll());
        echo "</pre>";

        return $this;
    }


    private function _requiredFiles()
    {
        $lstrRootPath = Config::getConfig('root_path');
        require_once $lstrRootPath.'layer/database/DB.class.php';
    }

}
