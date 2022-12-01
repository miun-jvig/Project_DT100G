<!-- 
    Created by: Joel Viggesjöö (jovi1802@student.miun.se)
    Assignment: Projekt in course DT100G, Mittuniversitetet
    Date: 2022-03-19
-->

<?php
ini_set('display_errors', 1);
// Activate autoload to speed up registering of classes needed
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});
include("includes/config.php");
$page_title = "Create";

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    /*
    @param 'raid': message taken from select "raid".
    @param 'raidID': name from GET

    Checks if raid/raidID exists, then creates a new Raid $raid. Will also run the class-function
    saveToSQL() to save the raid to the SQL-database.
    */
    if (isset($_POST['raid'])) {
        $raid = new Raid($_POST['raid']);
        $raid->saveToSQL();
        header("location:index.php?raid=".$raid->getID());
    } 
    else if (isset($_POST['raidID'])) {
        $raidID = $_POST['raidID'];
        
        header("location:index.php?raid=".$raidID);
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
    <head>
        <title><?= $site_title . $divider . $page_title; ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> <!-- for jQuery usage -->
    </head>
    <body>
        <div id="createIDWrap">
            <h2 class="createTitle">Create a new ID.</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div id="raidDiv">
                        <select name="raid" id="raid">
                            <option value="">--- Choose a raid ---</option>
                            <option value="Black Temple">Black Temple</option>
                            <option value="Serpentshrine Cavern">Serpentshrine Cavern</option>
                            <option value="Tempest Keep">Tempest Keep</option>
                            <option value="Magtheridons Lair">Magtheridon's Lair</option>
                            <option value="Gruuls Lair">Gruul's Lair</option>
                            <option value="Karazhan">Karazhan</option>
                        </select>
                    </div>
                <button id="selectRaid" type="submit">Create</button>
            </form>
            <h2 class="createTitle">Already have a raid-ID?</h2>
            <form class="createIDForm" method="post">
                <div id="raidIDDiv">
                    <input id="raidID" name="raidID" placeholder="Enter ID" type="text">
                </div>
            <button id="raidIDButton" type="submit">Continue</button>
            </form>
        </div>
    </body>
</html>