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

        //information for the image
        $name = $_FILES['pic']['name'];
        $tmp_name = $_FILES['pic']['tmp_name'];
        $type = mime_content_type($tmp_name);
        $size = $_FILES['pic']['size'];
        $errorsImage = validate_image($size, $type, $name);
    //CREATE ASSOCIATIVE ARRAY ON USER INPUT
    $new_game = [];
    $new_game['player'] = $player;
    $new_game['level'] = $level;
    $new_game['ability'] = $ability;
    $new_game['comments'] = $comments;
    //VALIDATE INPUTS
    $errors = validate_game($new_game);
    
    //IF NO ERRORS, INSERT INTO DB
    if(empty($errors) && empty($errorsImage)){  
        $photo = move_uploaded_file($tmp_name, "uploads/" . substr(session_id(), 3) . $name);
        try{
            //set up the SQL INSERT comman
            $sql = "INSERT INTO dota (player, level, ability, comments, photo) VALUES (:player, :level, :ability, :comments, :photo)";
            
            //create a command object and fill the parameters with the form values
            $cmd = $conn->prepare($sql);
        
            $cmd -> bindParam(':player', $player, PDO::PARAM_STR, 50);
            $cmd -> bindParam(':level', $level, PDO::PARAM_INT);
            $cmd -> bindParam(':ability', $ability, PDO::PARAM_STR, 32);
            $cmd -> bindParam(':comments', $comments, PDO::PARAM_STR, 100);
            $cmd -> bindParam(':photo', $photo, PDO::PARAM_STR, 100);
        
            //execute the command
            $cmd -> execute();
            header("Location: players.php?t=3&msg=Done");
            exit;
        }catch (Exception $e) {
            header("Location: error.php");
        }
     }
}

?>


<h1 class="text-center mt-5">Add New Player <i class="bi bi-person"></i></h1>
<div class="row mt-5 ms-1">
    <form novalidate class="col-100" method="POST" enctype="multipart/form-data">
        <div class="col-12 col-md-6">

            <div class="row mb-4">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input autofocus required
                            class="<?= (isset($errors['player']) ? 'is-invalid' : ''); ?> form-control form-control-lg"
                            type="text" name="player" value="<?= $player ?? ''; ?>">

                        <label class="col-2 col-form-label" for="player">Player</label>
                        <p class="text-danger"><?= $errors['player'] ?? ''; ?></p>

                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input required inputmode="numeric" pattern="\b([1-9]|[1-9][0-9]|100)\b"
                            title="Please enter a Number between 1-100"
                            class="<?= (isset($errors['level']) ? 'is-invalid' : ''); ?> form-control form-control-lg"
                            type="text" name="level" placeholder="000" value="<?= $level ?? ''; ?>">
                        <p class="text-danger"><?= $errors['level'] ?? ''; ?></p>
                        <label class="col-2 col-form-label" for="level">Level</label>

                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div class="form-floating">

                        <select name="ability" class="form-select form-select-lg">
                            <?php
                        $sql = "SELECT ability FROM abilities ORDER BY ability";
                        $abilities = db_queryAll($sql, $conn);
                        
                        foreach($abilities as $ability){
                            echo "<option value". $ability["ability"] . ">". ucfirst($ability["ability"]) . "</option>";
                        }
                    ?>
                        </select>
                        <label class="col-form-label" for="ability">Ability</label>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div class="form-floating mb-3">

                        <input required
                            class="<?= (isset($errors['comments']) ? 'is-invalid' : ''); ?> form-control form-control-lg"
                            type="text" name="comments" value="<?= $comments ?? ''; ?>">
                        <p class="text-danger"><?= $errors['comments'] ?? ''; ?></p>
                        <label class="col-2 col-form-label" for="comments">Comments</label>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 col-sm-3 mb-5">
            <div class="card">
                <img id="cover" src="https://dummyimage.com/300x225" class="card-img-top" alt="game cover">
                <div class="card-body">
                    <input id="choosefile" type="file" name="pic" class="form-control">
                </div>
                <p class="px-3 pb-2 text-danger"><?= $errorsImage['pic'] ?? ''; ?></p>
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