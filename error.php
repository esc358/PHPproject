<?php
//connect to db
require_once 'database-dota.php';
$conn = db_connect();

include_once 'sharedmy/top.php';

?>

<main class="container">  
    <div class="row">
        <div class="col">
            <h1 class="mt-5 pt-5">UHPS!</h1>
            <p>Something went wrong! Our support team has been notified and will get right on it.</p>
            <a href="main-dota.php" class="btn btn-outline-secondary">Back to Home Page</a>
        </div>
        <div class="col">
            <img src="img/error.png" alt="unexpected error" style="width: 800px">
        </div>
    </div>



<?php

include_once 'sharedmy/footer.php';

?>