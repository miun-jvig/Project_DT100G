
<?php
/*
** Created by: Joel Viggesjöö (jovi1802@student.miun.se)
** Assignment: Projekt in course DT100G, Mittuniversitetet
** Date: 2022-03-20
    
** Opens a database-connection and echo's which raid-ID and date of creation.
*/
if(isset($_GET['raid'])){
    $db = new mysqli('DB', 'USERNAME', 'PASSWORD', 'USERNAME'); // open connection

    $ID = $_REQUEST['raid'];
    $sql = "SELECT * FROM raid WHERE ID=$ID";

    if(!$result = $db->query($sql)){
        die('Error with SQL-query [' . $db->error . ']');
    }

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "Raid: " . $row["Raid"]. "<br />" . "Created: " . $row["PostDate"]. "<br>";
        }
    }

    $db->close(); // close connection
}
?>