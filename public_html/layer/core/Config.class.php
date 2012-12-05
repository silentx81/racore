<?php
/**
 * User:        Raffael Wyss
 * Date:        30.11.12
 * Time:        17:10
 * Description: Klasse wo die Konfiguration ausliest
 */
namespace racore\layer\core;

class Config
{
    /**
     * Private Vars
     */
    private static $_instance = false;
    private static $_arrConfig = array();

    /**
     * For Reading from the Config-Array
     *
     * @param $pstrName
     *
     * @return string
     */
    public static function getConfig($pstrName)
    {
        $lstrReturn = "";
        self::instance();
        if(isset(self::$_arrConfig)) {
            $lstrReturn = self::$_arrConfig[$pstrName];
        }
        return $lstrReturn;
    }

    /**
     * Load the instance
     *
     * @return Config
     */
    public static function instance()
    {
        if(!self::$_instance) {
            self::$_instance = new self();
            self::_readFile();
        }
        return self::$_instance;
    }

    /**
     * Set the Config
     *
     * @param $pstrName
     * @param $pstrValue
     */
    public static function setConfig($pstrName, $pstrValue)
    {
        self::$_arrConfig[$pstrName] = $pstrValue;
    }

    /*
     * Read the Config File
     *
     * @return boolean
     */
    private static function _readFile()
    {
        $lbooReturn = false;
        $lstrFile = "config/".$_SERVER['SERVER_NAME'].".php";

        if (file_exists($lstrFile)) {
            $lcfilecontent = file_get_contents($lstrFile);
            self::$_arrConfig = json_decode($lcfilecontent, true);
            if (count(self::$_arrConfig) > 0) {
                $lbooReturn = true;
            }
        }
        return $lbooReturn;
    }

    /**
     * Constructor
     *
     * @return void
     */
    protected function __construct() {
    }

}
