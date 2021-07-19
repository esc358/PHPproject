<?php
//start session
session_start(); // is a way to make the data available across various pages of a web application

require_once 'validations.php'; //used to embed PHP code from another file

require_login();

//connect to db
require_once 'database-dota.php';
$conn = db_connect();
?>


<?php

include_once 'sharedmy/top.php';

?>

<img src="img/dota2.jpg" class="img-fluid" alt="this is a hero from dota 2">

<?php

include_once 'sharedmy/footer.php';

?>
