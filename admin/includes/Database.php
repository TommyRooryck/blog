<?php

require_once ("config.php");

/*Include: probeert op de webserver het proces toch verder te verwerken ookal is he tbestand die het zoekt fysisch niet aanwezig op de webserver*/

/*Require: stopt her proces als het bestand niet beschikbaar zou zijn*/

/*Once: dit werkt zowel bij include als require. Hiermee vermijden we dat het bestand meer dan 1 keer kan opgevraagd worden*/
class Database
{
    public $connection;
    /*Public impliceert dat de variabele ook buiten de class aanspreekbaar is*/

    /**Methodes voor databaseconnectie**/
    function __construct()
    {
        $this->open_db_connection();
    }
    /*
        Voert automatisch alles van de code uit die hier staat, telkens de class wordt aangeroepen.
        We willen namelijk  een automatische opening van de connectie open_db_connection() die zorgt voor de connectie met onze database.
    */


    public function open_db_connection()
    {
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME); //constanten uit config.php
        if (mysqli_connect_errno()){
            die("Database connection failed" . mysqli_error());
        }
    }
    /*
        Mysqli_connect: een built-in functie die de variabelen bevat om een connectie te kunnen maken met de database
        $this slaat op de class Database ZELF.
        We testen met deze methode of er een error wordt gegeneerd door phpmyadmin en geven in dat geval een error terug op het scherm d.m.v. mysqli_error.
    */

    /**Methodes voor het uitvoeren van queries**/
    private function confirm_query($result)
    {
        if (!$result)
        {
            die("Query failed to execute" . $this->connection->error);
        }
    }

    public function query($sql)
    {
        $result = $this->connection->query ($sql);
        $this->confirm_query($result);
        return $result;
    }

    public function escape_string($string)
    {
        $escaped_string = $this->connection->real_escape_string ($string);
        return $escaped_string;
    }
    /*real_escape_string: Zorgt ervoor dat vreemde karakters uit sql queries worden verwijderd. Dit vermijd o.a. sql injection. */

    public function the_insert_id(){
        return mysqli_insert_id($this->connection); //Deze functie haalt de laatst uitgevoerde id op in een tabel die een primary key met autoincrement heeft. D.w.z. dat ze met deze functie weten wat het laatst toegevoegde recordnummer was
    }
}

$database = new Database();