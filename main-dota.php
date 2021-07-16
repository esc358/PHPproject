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

include_once 'sharedmy/top.php';

?>

<img src="img/dota2.jpg" class="img-fluid" alt="this is a hero from dota 2">

<?php

include_once 'sharedmy/footer.php';

?>
