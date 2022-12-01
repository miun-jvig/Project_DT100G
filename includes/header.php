<!-- 
    Created by: Joel Viggesjöö (jovi1802@student.miun.se)
    Assignment: Project in course DT100G, Mittuniversitetet.
    Date: 2022-03-19
-->

<?php 
include("includes/config.php");
$page_title = "Startsida";

if(isset($_REQUEST['raid'])){
    $ID = $_REQUEST['raid'];
}
else{
    $ID = "";
}
?>

<!DOCTYPE html>
<html lang="sv">
    <head>
        <title><?= $site_title . $divider . "Raid-ID: " . $ID; ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- icons imported from https://fontawesome.com/ -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> <!-- for jQuery usage -->
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script> <!-- axios included for SQL/JS. Read more: https://axios-http.com/docs/intro -->
    </head>
    <body>
        <div id="bodyWrap">
            <div id="right">
                    <a class="btn" href="index.php"><i class="fa fa-home"></i></a>
                    <section id="top">
                        <h1 id="mainTitle">RAID-ID: <?= $ID; ?></h1>
                        <?php include("includes/create.php"); ?>