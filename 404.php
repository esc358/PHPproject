<?php
//start session
session_start();

require_once 'validations.php';

require_login();

//connect to db
require_once 'database-dota.php';
$conn = db_connect();

$title_tag = "404 Page";
include_once 'sharedmy/top.php';

?>

<main class="container">  
    <div class="row">
        <div class="col">
            <h1 class="mt-5 pt-5">It's EMPTY HERE</h1>
            <p>Looks like this page can't be found. Maybe it was moved or renamed</p>
            <a href="main-dota.php" class="btn btn-outline-secondary">Back to Home Page</a>
        </div>
        <div class="col">
            <img src="img/404.png" alt="404 error" style="width: 800px">
        </div>
    </div>


<?php

include_once 'sharedmy/footer.php';

?>