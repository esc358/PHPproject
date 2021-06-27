<?php
//connect to db
require_once 'database-dota.php';
$conn = db_connect();


//IF this page is fetched via a GET
// then display record with confirmation button

if($_SERVER['REQUEST_METHOD']== 'GET'){
    $id = filter_var($_GET['dota_id'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM dota WHERE dota_id=" .$id;
    $dota = db_queryOne($sql, $conn);

    $player = $dota['player'];
    $level = $dota['level'];
    $ability = $dota['ability'];
    $comments = $dota['comments'];

    include_once 'sharedmy/top.php';

?>


<h1 class="text-center mt-5 display-1 text-warning"><i class="bi bi-x-circle"></i></h1>
<h1 class="text-center mt-5">ARE YOU SURE YOU WANT TO DELETE THIS?</h1>
<div class="row mt-5 justify-content-center">
    <form class="col-6" method="POST">
        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="player">Player</label>
            <div class="col-10">
                <input readonly class="form-control form-control-lg" type="text" name="player"
                    value="<?php echo $player; ?>">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="level">Lever</label>
            <div class="col-10">
                <input readonly class="form-control form-control-lg" type="text" name="level"
                    value="<?php echo $level; ?>">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="ability">Ability</label>
            <div class="col-10">
                <input readonly class="form-control form-control-lg" type="text" name="ability"
                    value="<?php echo $ability; ?>">
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-2 col-form-label fs-4" for="comments">Comments</label>
            <div class="col-10">
                <input readonly class="form-control form-control-lg" type="text" name="comments" value="<?php echo $comments; ?>">
            </div>
        </div>

        <div class="d-grid">
            <input readonly class="form-control form-control-lg" type="hidden" name="dota_id"
                value="<?php echo $id; ?>">
            <button class="btn btn-danger btn-lg">Delete Forever</button>
        </div>
    </form>
</div>
<?php
}else if ($_SERVER['REQUEST_METHOD']== 'POST'){
    try{
        $id = filter_var($_GET['dota_id'], FILTER_SANITIZE_NUMBER_INT);

        $sql = "DELETE FROM dotaa WHERE dota_id=" . $id;

        $cmd = $conn->prepare($sql);
        $cmd -> execute();

        header("location: players.php");
    }catch (Exception $e) {
        header("location: error.php");
    }
}

?>