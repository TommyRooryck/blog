<?php
/**DIT IS DE PARENT/BASE CLASS**/

class Db_object
{
    /**Find_all**/
    /*
        public static function find_all_users()
        {
            return self::find_this_query("SELECT * FROM users");
        }
    */
    /**Abstracte versie**/
    public static function find_all()
    {
        return static::find_this_query("SELECT * FROM " . static::$db_table . " ");
    }

    /**find_by_id()**/
    /*
        public static function find_user_by_id($id)
        {
            global $database;
            $result = $database->query("SELECT * FROM users WHERE id = $id");
            $user_found = mysqli_fetch_array($result);
            return $user_found;
        }
    */

    /*
        public static function find_user_by_id($id)
        {
            $result = self::find_this_query("SELECT * FROM users WHERE id = $id");
            $user_found = mysqli_fetch_array($result);
            return $user_found;
        }
    */

    /*
        public static function find_user_by_id($user_id)
        {
            $result = self::find_this_query("SELECT * FROM users WHERE id= $user_id");
            return !empty($result) ? array_shift($result) : false;
            //array_shift(): zorgt ervoor dat het eerste item uitgelezen wordt
        }
    */
    /**Abstracte versie**/

    public static function find_by_id($id)
    {
        global $database;
        $the_result_array = static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE id= $id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array): false;
        //array_shift(): zorgt ervoor dat het eerste item uitgelezen wordt
    }


    /**Functie die elke query kan uitvoeren: find_this_query()**/
    public static function find_this_query($sql)
    {
        /*
             global $database;
             $result = $database->query($sql);
             return $result;
         /*
             * In de voorgaande queries zag je nog de object variabele $database met de methode query() van de class database die werd aangeroepen ($database->query()).
             * Wanneer we dit gedeelte in een aparte methode gieten (find_this_query()) in de class User zelf dan kunnen we find_this_query() binnen de andere methodes van de klasse
             * aanspreken in combinatie met het SELF keyword.
             * We passen deze methode aan zodat we door het resultaat kunnen loopen.
         */

        global $database;
        $result = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result)) //Zolang er resultaten uit de query komen, plaatsen we die in de variabele $row
        {
            $the_object_array[] = static::instantie($row);
        }
        return $the_object_array;
        /*
             * We maken van de array $row een object d.m.v. de method instantie(). De bekomen objecten met alle properties plaatsen we in een array.
             * Elk object neemt een plaats in de array.
             * Zo verkrijgen we een array van objecten.
             * Dit zorgt ervoor dat we een array kunnen maken van objecten.
             * Aangezien instantie() een static method is, kunnen we hier meteen het keyword SELF gebruiken.
         */
    }

    /**Array resultaten omzetten in objecten via een method**/
    public static function instantie($result)
    {
        /*
            $the_object = new self();
            $the_object->id = $result['id'];
            $the_object->username = $result['username'];
            $the_object->password = $result['password'];
            $the_object->first_name = $result['first_name'];
            $the_object->last_name = $result['last_name'];
            return $the_object;
        */
        $calling_class = get_called_class(); //Late static binding -> maakt een object van de classe waarin deze methode wordt opgeroepen
        $the_object = new $calling_class;
        foreach ($result as $the_attribute => $value)
        {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }
    //Info instantie() en has_the_attribute()
    /*
         * We benaderen $result die als parameter is binnengekomen in de functie find_this_query() als een associatieve array. D.w.z. dat we zowel de sleutel (veld) en waarde lussen.
         * In de foreach van instantie() zie je een nieuwe methode has_the_attribute() staan die we eerst van naderbij bekijken.
         * Deze methode ontvangt uiteindelijk een parameter uit onze foreach loop. Deze parameter is $the_attribute.
         * Het doel van de has_the_attribute methode is om na te kijken of er wel degelijk attributen in de tabel aanwezig zijn. Het attribuut is uiteindelijk de sleutel van een associatieve array.
           In ons voorbeeld: (result as $the_attribute => value)
         * De variabele $object_properties wordt gevult met alle variabelen van de User class die we bovenaan onze user class hebben gedeclareerd.
           Hiervoor gebruiken we de handige built-in functie van php, nl. get_object_vars($this).
           De parameter $this verwijst dus naar de classnaam waar hij zich in bevindt, met name User.
         * De uiteindelijke return van de functie halen we op met de built-in functie array_key_exists met 2 parameters, nl. $the_attribute en $object_properties.
         * Deze functie geeft een returnwaarde van true of false terug. We controleren of $the_attribute parameter aanwezig is in de array variabele $object_properties.
         * Wanneer dit true is dan wordt de waarde toegekend aan het attribuut van het object ($the_object->$the_attribute = $value).
     */

    /**Alle properties van de class inlezen**/
    /*
        protected function properties()
        {
            return get_object_vars($this);
        }
    */
    public function properties()
    {
        $properties = array();
        foreach(static::$db_table_fields as $db_field){
            if (property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }
    /*
         * We doorlopen de array variabele $db_table_fields veld per veld
         * Met de property_exists controleren we of de 2 parameters bestaan. De eerste is de class zelf, nl. $this(User). De tweede is de property van de class.
         * Indien beide aanwezig zijn in de class dan creëeren we een dynamische variabele $properties[$db_field] die de veldnaam (key) bevat.
    */

    protected function clean_properties()
    {
        global $database;
        $clean_properties = array();
        foreach ($this->properties() as $key => $value){
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }
    /*
     * We nemen de vorige methode: $this->properties en doorlopen zowel de key als de value.
     * De value gaan we opschonen met escape_string(value) en steken we telkens in de array $clean_properties
    */

    /**CRUD:Create method**/

    /*
    public function create()
    {
        global $database;

        $sql = "INSERT INTO ". self::$db_table ." (username, password, first_name, last_name)";
        $sql .= " VALUES ('";
        $sql .= $database->escape_string($this->username) . "', '";
        $sql .= $database->escape_string($this->password) . "', '";
        $sql .= $database->escape_string($this->first_name) . "', '";
        $sql .= $database->escape_string($this->last_name) . "')";


                * Voor dit werkt dienen we voor we dit uitvoeren een value aan de property toe te kennen. Daarna via de escape string vreemde karakters verwijderen en wordt deze geplaats binnen de query.
                * We kunnen dit bekijken met een praktisch voorbeeld:
                * Stel dat we het object $user creëeren ($user = new User();) kunnen we elke property een waarde geven.
                * Stel dat we username een waarde geven ($user->username = Bruce) wordt de query ingevuld als:
                  INSERT INTO users VALUES 'Bruce','','','';


        if ($database->query($sql)){
            $this->id = $database->the_insert_id();
            return true;
        } else{
            return false;
        }

        $database->query($sql);
    }
    */

    /**Abstracte versie**/
    public function create()
    {
        global $database;
        $properties = $this->clean_properties();
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ")";
        $sql .= " VALUES ('" . implode("','", array_values($properties)) . "')";


        if ($database->query($sql)){
            $this->id = $database->the_insert_id();
            return true;
        } else{
            return false;
        }

        $database->query($sql);
    }


    /**CRUD: Update method**/
    /*
        public function update()
        {
            global $database;
            $sql = "UPDATE ". self::$db_table . " SET ";
            $sql .= "username= '" . $database->escape_string($this->username) . "', ";
            $sql .= "password= '" . $database->escape_string($this->password) . "', ";
            $sql .= "first_name= '" . $database->escape_string($this->first_name) . "', ";
            $sql .= "last_name= '" . $database->escape_string($this->last_name) . "' ";
            $sql .= " WHERE id= " . $database->escape_string($this->id);

            /*
                 * Voor dit werkt dienen we, voor we dit uitvoeren, een value aan de property toe te kennen. Daarna via de escape string vreemde karakters verwijderen en wordt deze geplaats binnen de query.
                 * We kunnen dit bekijken met een praktisch voorbeeld:
                 * Stel dat we de user willen aanpassen met id = 1, gebruiken we een reeds geschreven methode van de Database klasse namelijk find_user_by_id(1), zoals je ziet dienen we parameter 1 mee te geven.
                 * Deze methode zoekt naar de user met id = 1 en neemt alle informatie en vormt deze om in een object met alle properties via de geïntegreerde method instantie().
                 * We kunnen daarna de properties aanpassen, stel dat we de username willen aanpassen naar "Bruce" ($user->username = "Bruce") wordt de query als volgt ingevuld:
                   UPDATE users SET username = 'BRUCE', password = '', first_name = '', last_name = '' WHERE id=1;
                 * Het voorbeeld is te vinden in de content.php pagina

              */
    /*
            $database->query($sql);
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
            // Mysqli_affected_rows: Geeft het aantal rijen terug die door de query zullen aangepast worden
        }
    */
    /**Abstracte versie**/

    public function update()
    {
        global $database;
        $properties = $this->clean_properties();
        $properties_assoc = array();

        foreach ($properties as $key=> $value){
            $properties_assoc[] = "{$key}= '{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_assoc);
        $sql .= " WHERE id= " . $database->escape_string($this->id);

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    /*
         * Alle properties van de class in een associatieve array plaatsen, nl. $properties_assoc.
         * Deze array wordt gevuld met het veld en en de  value zoals de schrijfwijze van het sql statement dit verwacht, nl. "{key} = '{$value}'"
    */

    /**CRUD: Delete method**/

    public function delete()
    {
        global $database;

        $sql = "DELETE FROM " . static::$db_table ;
        $sql .= " WHERE id= " . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    /**CRUD: Abstractie**/
    //Detecteert of er een user is, wanneer deze er IS dan gaan we deze wijzigen, wanneer deze er NIET is dan gaan we de user aanmaken
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    /**Samenvatting class User()**/
    //De bedoeling van de code op deze manier te schrijven is het creeëren van je eigen API om universele code te schrijven.

    /**User::find_all()**/
    /*
         * Hiermee gaan we naar de find_all() methode.
         * Find_all() retourneert find_by_query() resultaten.
         * Find_by_query():
            * Maakt de query
            * Haalt de data van de tabel op met een while loop en retourneert $row
            * Het resultaat van $row wordt overgedragen naar instantiation methode
            * Retourneert het object in de $the_object_array variabele
    */

    /**Instantation()**/
    /*
         * Grijpt de class name die wordt opgeroepen
         * Creëert een instantie van de class
         * Er wordt door de $the_record variabelen gelust die alle records bevat
         * Het kijkt na of er properties bestaan binnen het object met de methode has_the_property() of has_the_attribute()
         * Wanneer de properties / attributes (keys) worden gevonden dan wordt de waarde toegekend.
         * De return is het volledige object
     */

    /**Errors voor de volledige site**/
    //Locatie en properties van het op te laden bestand
    public $errors = array();
    public $upload_errors_array = array( //Toon de volgende strings bij de bepaalde errors
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