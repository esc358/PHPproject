<?php
//start session
session_start();

require_once 'validations.php';

require_login();

//connect to db
require_once 'database-dota.php';
$conn = db_connect();
?>

<?php

//save form inputs into variables
$player = trim(filter_var($_POST['player'], FILTER_SANITIZE_STRING));
$level = trim(filter_var($_POST['level'], FILTER_SANITIZE_NUMBER_INT));
$ability = trim(filter_var($_POST['ability'], FILTER_SANITIZE_STRING));
$comments = trim(filter_var($_POST['comments'], FILTER_SANITIZE_STRING));

$is_form_valid = true;
// check if all inputs are valid
if (empty($player)) {
    echo "Please enter a player";
    $is_form_valid = false;
} else if(strlen($player) > 50){
    echo "Player name only has 50 characters";
    $is_form_valid = false;
}

if (empty($comments)) {
    echo "Please enter a comment";
    $is_form_valid = false;
}

//level validation
$level_regex = "/([1-9]|[1-9][0-9]|100)/";

if ($level < 0 || $level > 100 || !preg_match($level_regex, $level))
{
    echo "Please enter a valid level between 1-100";
    $is_form_valid = false;
}

if($is_form_valid){
    try{
    //set up the SQL INSERT comman
    $sql = "INSERT INTO dotaA (player, level, ability, comments) VALUES (:player, :level, :ability, :comments)";
    
    //create a command object and fill the parameters with the form values
    $cmd = $conn->prepare($sql);

    $cmd -> bindParam(':player', $player, PDO::PARAM_STR, 50);
    $cmd -> bindParam(':level', $level, PDO::PARAM_INT);
    $cmd -> bindParam(':ability', $ability, PDO::PARAM_STR, 32);
    $cmd -> bindParam(':comments', $comments, PDO::PARAM_STR, 100);

    //execute the command
    $cmd -> execute();
    $conn = null;
    echo "IS SAVED?";
    }catch (Exception $e) {
        header("Location: error.php");
    }
    
   // echo "IS SAVED?";
    //disconnect from the db
   
    
}


?>