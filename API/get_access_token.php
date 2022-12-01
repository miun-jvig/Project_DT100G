<?php

/*
** Created by: Joel Viggesjöö (jovi1802@student.miun.se)
** Assignment: Projekt in course DT100G, Mittuniversitetet
** Date: 2022-03-20
 
** Based of Justin Stolpe's Youtube-video https://www.youtube.com/watch?v=ABmyXZoq_9Y.

** get_access_token.php opens a SQL-connection and sends the access-token to a json.
*/
include 'functions.php';
$accessToken = generateAccessToken();
// print_r($accessToken);
// die();

$db = new mysqli('db', 'USERNAME', 'PASSWORD', 'USERNAME'); // open connection
$sql = "SELECT value FROM wow_game_data_api";

if(!$result = $db->query($sql)){
    die('Error with SQL-query [' . $db->error . ']');
}
/*
** Add all information from SQL into $row and insert into $array[].
*/
while($row = $result->fetch_assoc()){
    $array[] = $row;
}
/*
** As long as array is not empty, parse the $array into json
*/
if(!empty($array)){
    echo json_encode($array);
}
?>