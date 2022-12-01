<?php
/*
** Created by: Joel Viggesjöö (jovi1802@student.miun.se)
** Assignment: Projekt in course DT100G, Mittuniversitetet
** Date: 2022-03-20
**
** index-file that makes sure that a raid-id exists, otherwise sends you back to createID.
** Also includes the other needed files. 
*/

ini_set('display_errors', 1);

if(!isset($_GET['raid'])){
    header("location:createID.php");
}

// Activate autoload to speed up registering of classes needed
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

include("includes/header.php");
include("includes/sidebar.php");
include("includes/footer.php");
?>