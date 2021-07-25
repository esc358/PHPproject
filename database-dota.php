<?php
require_once 'db_cred.php';

//create function for DRY
function db_queryAll($sql, $conn) {
    try{
        // run query and store results
        $cmd = $conn->prepare($sql);
        $cmd -> execute();
        $run = $cmd->fetchAll();
        return $run;
    }catch (Exception $e) {
        //mail('emilio.condeludena@mygeorgian.ca', 'PDO Error', $e); this line will send and email if an error is found
        header("Location: error.php");
    }
}

//create function query one
function db_queryOne($sql, $conn) {
    try{
        // run query and store results
        $cmd = $conn->prepare($sql);
        $cmd -> execute();
        $games = $cmd->fetch();
        return $games;
    }catch (Exception $e) {
        header("Location: error.php");
    }
}

//connection to database
function db_connect(){
    $conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_USER , DB_NAME, DB_PASSWORD);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

//disconect to database
function db_disconnect($conn){
    if(isset($conn)){
        //disconnect
        $conn = null;
    }
}

?>
