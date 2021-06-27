<?php

//save form inputs into variables
$player = $_POST['player'];
$level = $_POST['level'];
$ability = $_POST['ability'];
$comments = $_POST['comments'];

//connect to database
require 'db.php';

//set up the SQL INSERT comman
$sql = "INSERT INTO dota (player, level, ability, comments) VALUES (:player, :level, :ability, :comments)";

//create a command object and fill the parameters with the form values
$cmd = $conn->prepare($sql);
$cmd -> bindParam(':player', $player, PDO::PARAM_STR, 50);
$cmd -> bindParam(':level', $level, PDO::PARAM_INT);
$cmd -> bindParam(':ability', $ability, PDO::PARAM_STR, 32);
$cmd -> bindParam(':comments', $comments, PDO::PARAM_STR, 100);

//execute the command
$cmd -> execute();

//disconnect from the db
$conn = null;

//show message
echo "Game Dota Saved?";

?>