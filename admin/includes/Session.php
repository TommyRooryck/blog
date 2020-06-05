<!-- Met deze class willen we nagaan of een user is ingelogd of niet. -->
<!-- In het geval hij ingelogd is dan brengen we hem naar index.php in de admin map anders de publieke kant -->



<?php


class Session
{

    private $signed_in = false;
    public $user_id;

    /**Sessions methods**/
    function __construct()  //Automatisch starten van een sessie.
    {
        session_start();
        $this->check_the_login();
        $this->check_message();
    }

    private function check_the_login() //Checken of het user id wel degelijk werd geset door de sessie
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
        /*
             * We starten met de $signed_in = false als default. False = niet ingelogd.
             * Wanneer de public variabele $user_id als sessions variabele is geset, dan kennen we de session variabele toe aan het session object:
               $this->>user_id = $_SESSION['user_id']
               Tegelijk zetten we de object variabele $signed_in op true.
             * In het else-statement gedeelte gaan we de variabele gaan "ledigen" = unset, anneer er geen session variabele wordt gevonden.
               Logisch gezien zetten we dan de variabele $signed_in op false.
        */
    }

    /**Login methodes**/
    public function is_signed_in()
    {
        return $this->signed_in;
    }

    public function login($user)
    {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }
    /*
         *  Methode die een private variabele van de class kan lezen.
         *  Die gebruiken we om na te kijken of de user is ingelogd of niet.
         *  De methode login ($user) zal dus in de parameter $user een user ontvangen.
         * Indien dit waar (true) is dan zullen we het session id toekennnen aan een object variabele.
           $this->user_id = $_SESSION['user_id'];
           $this->signed_in = true;
         * De methode is_signed_in() zal enkel een boolean teruggeven nl. true of false.
         * Deze 2 methodes zullen we dus later nodig hebben bij het inloggen.
    */

    /**Logout methode**/
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }
    /*
         * Wanneer deze methode wordt aangesproken worden de variabele $_SESSION en de parameter user_id "geledigd" = unset
         * Daarnaast wordt de parameter signed_in ook op false gezet = uitgelogd
    */



    /**Message methods**/
    public function message($msg="")
    {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        }else {
            return $this->message;
        }
    }

    private function check_message()
    {
        if (isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else{
            $this->message = "";
        }
    }
    /*
         * De check_message methode bekijkt of er reeds een vorig bericht als sessie in het geheugen is geladen.
         * Indien dit het geval is gaan we die legen d.m.v. de unset functie.
         * De check_message functie dient dus eigenlijk geladen te worden telkens er een nieuwe sessie door de gebruiker wordt gestart!
         * Daarom plaatsen we deze in de __construct van de session class
    */
}

$session = new Session(); //Start een session id via deze nieuwe instantie