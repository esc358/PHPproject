<?php

//start session
session_start();

require_once 'validations.php';

require_login();

//connect to db
require_once 'database-dota.php';
$conn = db_connect();

$title_tag = "Add New Player";

include_once 'sharedmy/top.php';

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //GET FORM INPUTS
    $player = trim(filter_var($_POST['player'], FILTER_SANITIZE_STRING));
    $level = trim(filter_var($_POST['level'], FILTER_SANITIZE_NUMBER_INT));
    $ability = trim(filter_var($_POST['ability'], FILTER_SANITIZE_STRING));
    $comments = trim(filter_var($_POST['comments'], FILTER_SANITIZE_STRING));
    //CREATE ASSOCIATIVE ARRAY ON USER INPUT
    $new_game = [];
    $new_game['player'] = $player;
    $new_game['level'] = $level;
    $new_game['ability'] = $ability;
    $new_game['comments'] = $comments;
    //VALIDATE INPUTS
    $errors = validate_game($new_game);
    //IF NO ERRORS, INSERT INTO DB
    if(empty($errors)){  
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
            header("Location: players.php");
            exit;
        }catch (Exception $e) {
            header("Location: error.php");
        }
     }
}

?>


<h1 class="text-center mt-5">Add New Player <i class="bi bi-person"></i></h1>
<div class="row mt-5 justify-content-center">
    <form class="col-100" method="POST">
        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="player">Player</label>
            <div class="col-10">
                <input required class="<?= (isset($errors['player']) ? 'is-invalid' : ''); ?> form-control form-control-lg" type="text" name="player" value="<?= $player ?? ''; ?>">
                <p class="text-danger"><?= $errors['player'] ?? ''; ?></p>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="level">Level</label>
            <div class="col-10">
                <input required inputmode="numeric" pattern="\b([1-9]|[1-9][0-9]|100)\b" title="Please enter a Number between 1-100" class="<?= (isset($errors['level']) ? 'is-invalid' : ''); ?> form-control form-control-lg" type="text" name="level"  value="<?= $level ?? ''; ?>">
                <p class="text-danger"><?= $errors['level'] ?? ''; ?></p>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="ability">Ability</label>
            <div class="col-10">
                <select name="ability"  class="form-select form-select-lg">
                    <?php
                        $sql = "SELECT ability FROM abilities ORDER BY ability";
                        $abilities = db_queryAll($sql, $conn);
                        
                        foreach($abilities as $ability){
                            echo "<option value". $ability["ability"] . ">". ucfirst($ability["ability"]) . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="comments">Comments</label>
            <div class="col-10">
                <input required  class="<?= (isset($errors['comments']) ? 'is-invalid' : ''); ?> form-control form-control-lg" type="text" name="comments" value="<?= $comments ?? ''; ?>">
                <p class="text-danger"><?= $errors['comments'] ?? ''; ?></p>
            </div>
        </div>

        <div class="d-grid">
            <button class="btn btn-success btn-lg">Submit</button>
        </div>
    </form>
</div>

<?php

include_once 'sharedmy/footer.php';

?>


