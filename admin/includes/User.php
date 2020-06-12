<?php


class User extends Db_object
{
    /**Properties van objecten van de class**/
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = 'img' . DS . 'users';
    public $image_placeholder = 'https://via.placeholder.com/100';
    public $tmp_path;

    /**Abstractie van universele klasse: static property**/
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name','user_image');




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

    /**Locatie van de afbeelding**/
    public function image_path_and_placeholder()
    {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }
    /*
         * Wanneer we geen image vinden dan geven we de standaard locatie als default terug, nl. image_placeholder die de link bevat naar http://place-holt.it
         * In Het andere geval wordt de echte image teruggegeven.
    */

    /**Methods uit Photo() class**/

        public function set_file($file) //Zie Photo() class
        {
            echo $file;

            if (empty($file) || !$file || !is_array($file)){
                $this->errors[] = "There was no file uploaded here";
                return false;
            } elseif ($file['error'] != 0){
                $this->errors[] = $this->upload_errors_array[$file['error']];
                return false;
            } else{
                $this->user_image = basename($file['name']);
                $this->tmp_path = $file['tmp_name'];
            }
        }



    public function save_user_and_image()
    {
        $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->user_image;

        if ($this->id){ //Als er een id opgevangen wordt:
            move_uploaded_file($this->tmp_path,$target_path);
            $this->update(); //voer method update() uit
            unset($this->tmp_path); //tmp_path wordt leeggemaakt
            return true; //return true
        }else{ //anders:
            if (!empty($this->errors)){ //als errors niet leeg zijn return false
                return false;
            }
            if (empty($this->user_image) || empty($this->tmp_path)){ //als er geen user_image is of geen tmp_path (file) aanwezig is:
                $this->errors[] = "File not available"; //Steek deze string in de errors[] array
                return false; //return false
            }
            if (move_uploaded_file($this->tmp_path, $target_path)){ //Indien de file successvol verplaats werd naar de target_path:
                if ($this->create()){ //indien de create() method wordt uigevoerd unset de tmp_path(file) en return true
                    unset($this->tmp_path);
                    return true;
                }
            } else{ //Anders steek de error in de array en return false
                $this->errors[] = "This folder has no write rights!";
                return false;
            }
        }
    }

    /*
         1 Deze methode zal controleren of de gebruiker bestaat en tegelijk deze update. Indien niet zal hij deze creëeren.
         2 Doe een zoek en vervang filename door user_image om de naamgeving gelijk te houden.
         3 Daarnaast zullen we ook de locatie van de map img/users meegeven aan de variabele $target_path
         4 De functie move_uploaded_file zal zorgen dat deze bewaard wordt op de locatie van $target_path
    */

}