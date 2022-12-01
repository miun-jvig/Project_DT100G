<?php
/*
** Created by: Joel Viggesjöö (jovi1802@student.miun.se)
** Assignment: Projekt in course DT100G, Mittuniversitetet
** Date: 2022-03-20
**
** inserting the reserved items into the database.
*/

/*
** @param 'item1': Taken from user input in sidebar.php
** @param 'item2': Taken from user input in sidebar.php
** @param 'class': Taken from user input in sidebar.php
** @param 'name': Taken from user input in sidebar.php
**
**
** Opens a SQL-connection and inserts item1, item2, class and name to the database. 
*/
if(isset($_POST['item1']) && isset($_POST['item2']) && isset($_POST['class']) && isset($_POST['name'])){
    $item1 = $_POST['item1'];
    $item2 = $_POST['item2'];
    $class = $_POST['class'];
    $name = $_POST['name'];
    $ID = $_REQUEST['raid'];

    $db = new mysqli('DB', 'USERNAME', 'PASSWORD', 'USERNAME'); // open connection
    if($db->connect_errno > 0){
        die('Problems connecting [' . $db->connect_error . ']');
    }

    $sql = "INSERT INTO player(PlayerName, Class, Item1, Item2)VALUES('$name', '$class', '$item1', '$item2')";
    $query = "INSERT INTO raid_player(ID, PlayerName)VALUES('$ID', '$name')";

    if(!$result = $db->query($sql)){
        die('Error with SQL-query [' . $db->error . ']');
    }
    if(!$result = $db->query($query)){
        die('Error with SQL-query [' . $db->error . ']');
    }
    $db->close(); // close connection
}

?>