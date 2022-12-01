
<?php
/*
** Created by: Joel Viggesjöö (jovi1802@student.miun.se)
** Assignment: Projekt in course DT100G, Mittuniversitetet
** Date: 2022-03-20
    
** Opens a database-connection and echo's all information from "player".
*/

    /*
    ** function utf8ize($array) is taken from https://stackoverflow.com/questions/19361282/why-would-json-encode-return-an-empty-string as I had issues
    **with json_encode returning an empty string.
    */
    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }

    $db = new mysqli('DB', 'USERNAME', 'PASSWORD', 'USERNAME'); // open connection
    $sql = "SELECT * FROM player"; // SELECT * which will be put into parsed json
    if(!$result = $db->query($sql)){
        die('Error with SQL-query [' . $db->error . ']');
    }
    /*
        Add all information from SQL into $row and insert into $array[].
    */
    while($row = $result->fetch_assoc()){
        $array[] = $row;
    }
    /*
        As long as array is not empty, parse the $array into json
    */
    if(!empty($array)){
        echo json_encode(utf8ize($array));
    }
    $db->close(); // close connection
?>