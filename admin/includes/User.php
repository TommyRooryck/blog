<?php


class User extends Db_object
{
    /**Properties van objecten van de class**/
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    /**Abstractie van universele klasse: static property**/
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');

    /**Methods van de class**/

    /**Method bij het inloggen**/
    /*
        public static function verify_user($username, $password)
        {
            global $database;
            $username = $database->escape_string(($username));
            $password = $database->escape_string($password);

            $sql = "SELECT * FROM users WHERE ";
            $sql .= "username = '{$username}' ";
            $sql .= "AND password = '{$password}' ";
            $sql .= "LIMIT 1";

            $the_result_array = self::find_this_query($sql);
            return !empty($the_result_array) ? array_shift($the_result_array) : false;
        }
    */
    /**Abstracte versie**/
    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string(($username));
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


}