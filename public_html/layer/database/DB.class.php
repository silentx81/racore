<?php
/**
 * User:        Raffael Wyss
 * Date:        29.11.12
 * Time:        22:47
 * Description: Database
 */
namespace racore\layer\database;
use \PDO AS PDO;

class DB
{
    /**
     * Private Vars
     */
    private static $_instance = false;
    private static $_reference = null;


    /**
     * Connect to the Database
     *
     * @param string $pstrServer
     * @param string $pstrDatabase
     * @param string $pstrUser
     * @param string $pstrPassword
     * @param string $pstrTyp
     *
     * @return bool
     */
    public static function connect (    $pstrServer,
                                        $pstrDatabase,
                                        $pstrUser,
                                        $pstrPassword,
                                        $pstrTyp = "mysql")
    {
        self::instance();
        $lbooReturn = true;
        if (array_search("pdo_".$pstrTyp, get_loaded_extensions()) === FALSE) {
            $lbooReturn = false;
        } else {
            $lstrConnection = $pstrTyp.":dbname=".$pstrDatabase;
            $lstrConnection .= ";host=".$pstrServer;
            try {
                self::$_reference = new PDO($lstrConnection,
                    $pstrUser,
                    $pstrPassword);
                $lbooReturn = true;
            } catch (\PDOException $lerr) {
                $lbooReturn = false;
            }
        }
        return $lbooReturn;

    }


    /**
     * Load the instance
     *
     * @return DB
     */
    public static function instance() {
        if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @return void
     */
    protected function __construct() {
    }
}
