<?php
//connect to db
require_once 'database-dota.php';
$conn = db_connect();
?>


<?php
include_once 'sharedmy/top.php';


//build a sql query
$sql = "SELECT * FROM dota";
$players = db_queryAll($sql, $conn);
?>

<table class="table table-secondary table-striped table-bordered border-secondary fs-5 mt-4">
    <thead>
        <tr>
            <th scope="col">Player</th>
            <th scope="col">Level</th>
            <th scope="col">Ability</th>
            <th scope="col">Comments</th>
            <th scope="col" class="col-1">Edit</th>
            <th scope="col" class="col-1">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($players as $player) { ?>

        <tr>
            <th scope="row"><?php echo $player['player']; ?></th>
            <td><?php echo $player['level']; ?></td>
            <td><?php echo $player['ability']; ?></td>
            <td><?php echo $player['comments'];?></td>
            <td><a href="dota-edit.php?dota_id=<?php echo $player['dota_id']; ?>" class="btn btn-secondary">Edit <i
                        class="bi bi-pencil-square"></i></a></td>
            <td><a href="dota-delete.php?dota_id=<?php echo $player['dota_id']; ?>" class="btn btn-warning">Delete <i class="bi bi-trash"></i></a></td>
        </tr>
        <?php } ?>

    </tbody>
</table>


<?php
include_once 'sharedmy/footer.php';
?>