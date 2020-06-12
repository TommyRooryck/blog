<!--
Wordt als eerste geladen. We voorzien dus een include in de header
die verwijst naar init.php die op zijn beurt verwijst naar config.php met de database connectie
-->

<?php require_once ("init.php");
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

    <!-- Pie Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data =  google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Views', <?php echo $session->count; ?>], //Eerst komt de naam van de array (views) daarna de value via onze methodes
                ['Comments', <?php echo Comment::count_all(); ?>],
                ['Users', <?php echo User::count_all(); ?>],
                ['Photos', <?php echo Photo::count_all(); ?>]
            ]);

            // Set chart options->uiterlijk van de chart
            var options = {
                legend: 'none',
                pieSliceText: 'label',
                title: 'Statistics',
                backgroundColor: 'transparent'
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
