<?php
/**
 * User:        Raffael Wyss
 * Date:        29.11.12
 * Time:        22:47
 * Description: Database
 */
namespace racore\layer\database;
use \PDO AS PDO;

/**
 * DB - Databaseclass
 *
 * Example for Using
 * -----------------
 * $lstrQuery       = "SELECT * FROM [table] WHERE [id]=:id";
 * $larrData['id']  = '{"value":"1", "type":"int", "length":"11"}';
 * DB::query($lstrQuery, $larrData);
 *
 * $larrResult = DB::fetchAll();
 */
final class DB
{
    /**
     * @var null|DB
     */
    private static $_instance = false;

    /**
     * @var null|\PDO
     */
    private static $_reference = null;

    /**
     * @var null|\PDOStatement
     */
    private static $_statement;


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
    public static function instance()
    {
        if(!self::$_instance) {
            self::$_instance = new self();

        }
        return self::$_instance;
    }

    /**
     * Give a single row-Array back
     *
     * @return array
     */
    public static function fetch() {
        self::instance();
        return self::$_statement->fetch();
    }

    /**
     * Give a complete Array back
     *
     * @return array
     */
    public static function fetchAll() {
        self::instance();
        return self::$_statement->fetchAll();
    }

    /**
     * Send the Query to the Database
     *
     * @param string    $pstrQuery
     * @param array     $parrVars
     *
     * @return boolean
     */
    public static function query($pstrQuery, $parrVars)
    {
        self::instance();
        $lbooReturn = false;
        self::$_statement = self::_prepare($pstrQuery);
        foreach($parrVars AS $lstrKey=>$lstrValue) {
            $lstrName = $lstrKey;
            $ladata = json_decode($lstrValue, true);
            $lstrContent = $ladata['value'];
            $lintType = \PDO::PARAM_STR;
            switch($ladata['type']) {
                case "int":
                    $lintType = \PDO::PARAM_INT;
                    break;
            }
            $lstrLength = $ladata['length'];
            self::$_statement->bindParam($lstrName, $lstrContent, $lintType, $lstrLength);
        }
        if(self::$_statement->execute()) {
            $lbooReturn = true;
        }
        return $lbooReturn;
    }

    /**
     * Count the Rows
     *
     * @return int
     */
    public static function rowCount() {
        self::instance();
        return self::$_statement->rowCount();
    }

    /**
     * @param $pstrQuery
     *
     * @return \PDOStatement
     */
    private function _prepare($pstrQuery)
    {
        return self::$_reference->prepare($pstrQuery);
    }

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

}
