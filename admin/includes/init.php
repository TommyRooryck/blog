<!-- Bevat alle includes van het project -->



<?php
/**Constanten voor Siteroot**/
//Hier gaan we de constanten voor de siteroot bepalen, de locatie van de includes map en de locatie van de images map

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'C:' . DS . 'wamp64' . DS . 'www' . DS  . 'blog'); //path waar je project staat opgeslaan
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes'); //path naar de includes van je project
defined('IMAGES_PATH') ? null : define('IMAGES_PATH', SITE_ROOT . DS . 'admin' . DS . 'img'); //path naar de img map van je project

?>
<!-- Require_once zal ons een error geven. Include geeft ons enkel een warning. -->

<?php require_once ("Db_object.php");?>
<?php require_once ("functions.php"); ?>
<?php require_once ("config.php"); ?>
<?php require_once ("Database.php"); ?>
<?php require_once ("User.php"); ?>
<?php require_once ("Session.php"); ?>
<?php require_once(dirname(__FILE__) . DS . 'Photo.php'); ?>
<?php require_once ("Comment.php"); ?>



