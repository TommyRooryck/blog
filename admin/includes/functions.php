<!-- Automatisch inladen van klassen -->
<?php
function classAutoLoader($class)
{
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";

    if (is_file($the_path) && !class_exists($class))
    {
        include ($the_path);
    } else
    {
        die("This file name {class}.php was not found!");
    }
}

spl_autoload_register('classAutoLoader');

/*
     * We controleren of er class bestanden op een bepaalde locatie (path) staan.
     * Deze functie zal de bestanden vinden.
     * Daarna zorgen we ervoor dat we het bestand gaan includen (of require_once).
     * Je kan meerdere classes van autoloaders maken indien je wenst.
     * De registratie van deze classes doet men met de built-in functie spl_autoload_register().
*/

function redirect($location)
{
    header("Location: {$location}");
}
?>
