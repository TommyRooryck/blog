<?php


class Photos extends Db_object
{
    /**Static variabelen**/
    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'description', 'filename', 'type', 'size', 'caption', 'alternate_text');

    /**Properties**/
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $caption;
    public $alternate_text;

    /**Upload Path en Properties**/
    //Locatie en properties van het op te laden bestand
    public $tmp_path;
    public $upload_directory = 'img';


    /**Methods**/
    //Hier dragen we de super global variabele $_FILES ['uploaded_file'] over als een argument
    public function set_file($file){
        if (empty($file) || !$file || !is_array($file)){ //Indien de parameter $file leeg is, geen $file is of $file geen error is:
            $this->errors[] = "No file uploaded!"; //steek deze string in de error[] array
            return false; //return false
        }elseif ($file['error'] != 0){ //indien er een error aanwezig is:
            $this->errors[] = $this->upload_errors_array[$file['error']]; //stel de errors[] array gelijk aan de passende error uit de $upload_errors_array[]
            return false; // return false
        }else{ //in het positieve geval:
            $this->filename = basename($file['name']); //stel de property filename gelijk aan de naam van het te op te laden bestand
            $this->tmp_path = $file['tmp_name']; //idem
            $this->type = $file['type']; //idem
            $this->size = $file['size']; //idem
        }
    }

    public function save()
    {
        if ($this->id){ //indien het id bestaat voer update() method uit
            $this->update();
        }else{ //anders:
            if (!empty($this->errors)){ //Indien errors[] array niet leeg is: return false
                return false;
            }
            if (empty($this->filename) || empty($this->tmp_path)){ //Indien $filename en $tmp_path leeg zijn: toon error en return false -> gebeurt via set_file() method
                $this->errors[] = "File not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->filename; //Het pad waar het bestand naar toe moet

            if (file_exists($target_path)){ //indien de target_path al bestaat:
                $this->errors[] = "File {$this->filename} exists!"; //Toon error
                return false; //return false
            }
            if (move_uploaded_file($this->tmp_path, $target_path)){ //als de uploaded file verplaatst kan worden (tmp_path = file, target_path = destination)
                if ($this->create()){ //voer de create() method uit
                    unset($this->tmp_path); //unset de tmp_path
                    return true; //return true
                }
            }
            else{
                $this->errors[] = "This folder has no rights!"; //anders toon deze error
                return false; //return false
            }
        }
    }

    public function picture_path() //pad waar de foto's worden opgeslaan, via deze method kun je ze weergeven op de site
    {
        return $this->upload_directory . DS . $this->filename;
    }

    public function delete_photo()
    {
        if ($this->delete()){ //als de delete() method wordt gestart
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path(); //target_path instellen: SITE_ROOT (uit init.php)
            return unlink($target_path) ? true : false; //als de filename wordt gedelete return true anders false
        }else{ //bij het andere geval
            return false; //return false
        }
    }

}