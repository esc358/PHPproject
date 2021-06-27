<?php
//connect to db
require_once 'database-dota.php';
$conn = db_connect();

include_once 'sharedmy/top.php';

?>


<h1 class="text-center mt-5">Add New Player <i class="bi bi-person"></i></h1>
<div class="row mt-5 justify-content-center">
    <form class="col-100" action="save-dota.php" method="POST">
        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="player">Player</label>
            <div class="col-10">
                <input required class="form-control form-control-lg" type="text" name="player">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="level">Level</label>
            <div class="col-10">
                <input required inputmode="numeric" pattern="\b([1-9]|[1-9][0-9]|100)\b" title="Please enter a Number between 1-100" class="form-control form-control-lg" type="text" name="level">
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
                <input required  class="form-control form-control-lg" type="text" name="comments">
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


