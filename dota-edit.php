<?php
//connect to db
require_once 'database-dota.php';
$conn = db_connect();

include_once 'sharedmy/top.php';

if($_SERVER['REQUEST_METHOD']== 'POST'){
    // - use same for fiels as before
    //save form inputs into variables
    $player = trim(filter_var($_POST['player'], FILTER_SANITIZE_STRING));
    $level = trim(filter_var($_POST['level'], FILTER_SANITIZE_NUMBER_INT));
    $ability = trim(filter_var($_POST['ability'], FILTER_SANITIZE_STRING));
    $comments = trim(filter_var($_POST['comments'], FILTER_SANITIZE_STRING));
    $id = trim(filter_var($_POST['dota_id'], FILTER_SANITIZE_URL));
    try{
        // - run update
        $sql = "UPDATE dota SET player=:player, ";
        $sql .= "level=:level, ability=:ability, comments=:comments ";
        $sql .= "WHERE dota_id=:id";

        //create a command object and fill the parameters with the form values
        $cmd = $conn->prepare($sql);
        $cmd -> bindParam(':player', $player, PDO::PARAM_STR, 50);
        $cmd -> bindParam(':level', $level, PDO::PARAM_INT);
        $cmd -> bindParam(':ability', $ability, PDO::PARAM_STR, 32);
        $cmd -> bindParam(':comments', $comments, PDO::PARAM_STR, 100);
        $cmd -> bindParam(':id', $id, PDO::PARAM_INT);

        //execute the command
        $cmd -> execute();
        // - redirect to games
        header("location: players.php");
    }catch (Exception $e) {
        header("Location: error.php");
    }

//if get

} else if($_SERVER['REQUEST_METHOD']== 'GET'){
    // -get ide from url
    $id = filter_var($_GET['dota_id'], FILTER_SANITIZE_NUMBER_INT);
    // query db for 1 record
    $sql = "SELECT * FROM dota WHERE dota_id=" .$id;
    $dota = db_queryOne($sql, $conn);

    $player = $dota['player'];
    $level = $dota['level'];
    $ability = $dota['ability'];
    $comments = $dota['comments'];
}

?>


<h1 class="text-center mt-5 display-1 text-warning"><i class="bi bi-x-circle"></i></h1>
<h1 class="text-center mt-5">EDIT PLAYER</h1>
<div class="row mt-5 justify-content-center">
    <form class="col-6" action="dota-edit.php" method="POST">
        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="player">Player</label>
            <div class="col-10">
                <input required class="form-control form-control-lg" type="text" name="player"
                    value="<?php echo $player; ?>">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="level">Lever</label>
            <div class="col-10">
                <input required inputmode="numeric" pattern="\b([1-9]|[1-9][0-9]|100)\b"
                    title="Please enter a Number between 1-100" class="form-control form-control-lg" type="text"
                    name="level" value="<?php echo $level; ?>">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="ability">Ability</label>
            <div class="col-10">
                <select name="ability" class="form-select form-select-lg">
                    <?php
                        $sql = "SELECT ability FROM abilities ORDER BY ability";
                        $abilities = db_queryAll($sql, $conn);
                        
                        foreach($abilities as $eachability){
                            echo "<option " . (($eachability["ability"] ==  strtolower($ability)) ? 'selected' : '') . " value". $eachability["ability"] . ">". ucfirst($eachability["ability"]) . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="comments">Comments</label>
            <div class="col-10">
                <input required class="form-control form-control-lg" type="text" name="comments"
                    value="<?php echo $comments; ?>">
            </div>
        </div>

        <div class="d-grid">
            <input readonly class="form-control form-control-lg" type="hidden" name="dota_id"
                value="<?php echo $id; ?>">
            <button class="btn btn-success btn-lg">Update Player</button>
        </div>
    </form>
</div>


<?php

include_once 'sharedmy/footer.php';

?>