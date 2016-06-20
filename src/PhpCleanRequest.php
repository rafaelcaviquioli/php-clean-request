<?php

/**
 * Created by PhpStorm.
 * User: rafaelcaviquioli
 * E-mal rafaelcitj@gmail.com
 *
 * @todo The purpose of this class is to clear all the
 * input parameters in an HTTP request by avoiding
 * the passage of SQL Injection made by bad intentioned people.
 */
namespace RafaelCaviquioli;

class PhpCleanRequest
{
    /*
     * boolean registerExecution default false
     * Records the first run to avoid a second run duplicate.
     */
    static $registerExecution = false;

    /*
     * Execute the clean in $_POST, $_GET, $_REQUEST
     */
    static function clean()
    {
        if (!self::$registerExecution) {

            self::$registerExecution = true;

            /*
             * If magic_quotes_gpc is not exists
             * (This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.)
             */
            if (!get_magic_quotes_gpc()) {
                $_POST = array_map("addslashes", $_POST);
                $_GET = array_map("addslashes", $_GET);
                $_REQUEST = array_map("addslashes", $_REQUEST);
            }

            $_POST = array_map("PhpCleanRequest::cleanSqlCommands", $_POST);
            $_GET = array_map("PhpCleanRequest::cleanSqlCommands", $_GET);
            $_REQUEST = array_map("PhpCleanRequest::cleanSqlCommands", $_REQUEST);
        }
    }

    /*
     * Anti injection sql commands
     */
    static function cleanSqlCommands($string)
    {
        $string = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $string);
        $string = strip_tags($string);
        $string = (get_magic_quotes_gpc()) ? $string : addslashes($string);

        return $string;
    }
}