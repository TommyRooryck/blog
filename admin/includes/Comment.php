<?php


class Comment extends Db_object
{
    /**Properties van objecten van de class**/
    public $id;
    public $photo_id;
    public $author;
    public $body;

    /**Abstractie van universele klasse: static property**/
    protected static $db_table = "comments";
    protected static $db_table_fields = array('id', 'photo_id', 'author', 'body');


    /**Methods van de class**/
    public static function create_comment($photo_id, $author = "Test", $body = "") //Zorgt ervoor dat we comments kunnen opslaan
    {
        if (!empty($photo_id) && !empty($author) && !empty($body)) { //Zorgt ervoor dat we ons comment-object enkel kunnen vullen wanneer deze 3 paramters NIET LEEG zijn.
            $comment = new Comment();
            $comment->photo_id = (int)$photo_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        } else {
            return false;
        }
    }

    public static function find_the_comments($photo_id) //Opzoeken van comments die geralteerd zijn aan een photo
    {
        global $database;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE photo_id = " . $database->escape_string($photo_id);
        $sql .= " ORDER BY photo_id ASC";

        return self::find_this_query($sql);
    }

    /*
         * Aan de hand van deze photo_id kunnen we uit de tabel comments als comments opzoeken gelinkt aan deze photo.
         * Merkt op dat we .self::$db_table gebruiken om de tabelnaam commets weer te geven.
         * Herinner je dat dit enkel kan wanneer je een functie als static beschouwd.
         * Self zorgt er dan voor dat je de naam van de class zelf als variabele kan gebruiken!
         * De query($sql) wordt dan uiteindelijk uitgevoerd door de methode find_by_query() uit de class Db_object.php die we kunnen bereieken dankzij de extends property toegevoegd aan de class comments
    */
}


