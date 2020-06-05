<!--
Wordt als eerste geladen. We voorzien dus een include in de header
die verwijst naar init.php die op zijn beurt verwijst naar config.php met de database connectie
-->

<?php require_once ("init.php")?>
<?php //Header.php is het eerste gedeelte die wordt geladen en per definitie de beste plaats is om te testen of er een sessie actief is!


/*
     *  !session = het omgekeerde van een sessie m.a.w. wanneer we geen user vinden die een sessie heeft.
     * In dit geval voeren we de methode is_signed_in uit.
     * Deze user heeft dus geen toegang en wordt geredirect naar login.php.
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
