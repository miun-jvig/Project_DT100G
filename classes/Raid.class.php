
<?php
/*
** Created by: Joel Viggesjöö (jovi1802@student.miun.se)
** Assignment: Projekt in course DT100G, Mittuniversitetet
** Date: 2022-03-20
**
** class Raid which is ussed to store the raid in SQL.
*/

class Raid {
    // PRIVATE VARIABLES
    private $ID;
    private $postDate;
    private $raid;

    // PARAMETERIZED CONSTRUCTOR
    function __construct($raid) {
        $this->raid = $raid;
    }

    /*
    ** saveToSQL() will open a connection to the database and insert the private variables $ID, $postDate, $raid
    ** into the SQL-server. 
    */
    public function saveToSQL(){
        $db = new mysqli('DB', 'USERNAME', 'PASSWORD', 'USERNAME'); // open connection
        if($db->connect_errno > 0){
            die('Problems connecting [' . $db->connect_error . ']');
        }
        $this->postDate = date("Y-m-d H:i:s ");
        $sql = "INSERT INTO raid(Raid, PostDate)VALUES('$this->raid', '$this->postDate');";
        if(!$result = $db->query($sql)){
            die('Error with SQL-query [' . $db->error . ']');
        }
        $this->ID = mysqli_insert_id($db);
        $db->close(); // close connection
    }

    // returns ID 
    public function getID(){
        return $this->ID;
    }
}

?>