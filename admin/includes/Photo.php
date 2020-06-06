<?php


class Photo extends Db_object
{
    /**Static variabelen**/
    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'description', 'filename', 'type', 'size');

    /**Properties**/
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    /**Upload Path en Properties**/
    //Locatie en properties van het op te laden bestand
    public $tmp_path;
    public $upload_directory = 'img';
    public $errors = array();
    public $upload_errors_array = array(
            UPLOAD_ERR_OK => "There is no error",
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload maximum filesize from php.ini",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds MAX_FILE_SIZE in php.ini for html form ",
            UPLOAD_ERR_NO_FILE => "No file uploaded",
            UPLOAD_ERR_PARTIAL => "The file was partially uploaded",
            UPLOAD_ERR_NO_TMP_DIR => "Missing temporary folder",
            UPLOAD_ERR_CANT_WRITE => "Failed to write to disk",
            UPLOAD_ERR_EXTENSION => "A php extension stopped your upload"
    );



}