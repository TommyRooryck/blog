<?php include ("includes/header.php"); ?>
<?php //Header.php is het eerste gedeelte die wordt geladen en per definitie de beste plaats is om te testen of er een sessie actief is!
    if (!$session->is_signed_in()){
        redirect('login.php');
    }

    //Aantallen in variabelen plaatsen om deze te kunnen aanspreken in de content.php

    $aantalUsers = User::find_all();
    $aantalPhotos = Photo::find_all();
    $aantalComments = Comment::find_all();


/*
     *  !session = het omgekeerde van een sessie m.a.w. wanneer we geen user vinden die een sessie heeft.
     * In dit geval voeren we de methode is_signed_in uit.
     * Deze user heeft dus geen toegang en wordt geredirect naar login.php.
*/
?>
<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content-top.php"); ?>
<?php include ("includes/content.php"); ?>
<?php include ("includes/footer.php"); ?>
