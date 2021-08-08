<?php
session_start();

require_once 'validations.php';

//connect to db
require_once 'database-dota.php';
$conn = db_connect();

$title_tag = "List Players";
include_once 'sharedmy/top.php';

//build a sql query
$sql = "SELECT * FROM dota";

$word_list = array();
if(!empty($keywords))
{
    $sql .= " WHERE ";

    //split multiple keywords using php explode
    $word_list = explode(" " , $keywords);

    //loop through word list array ad each word word clause
    foreach($word_list as $key => $word)
    {
        $word_list[$key] = "%" . $word . "%";

        if($key == 0)
        {
            $sql .= " player Like ?";
        }
        else
        {
            //omit word or
            $sql .= " OR player like ?";
        }
    }

}

$players = db_queryAll($sql, $conn, $word_list);
?>

<table class="sortable table table-secondary table-striped table-bordered border-secondary fs-5 mt-4">
    <thead>
        <tr>
            <th scope="col">Player</th>
            <th scope="col">Level</th>
            <th scope="col">Ability</th>
            <th scope="col" class="sorttable_nosort">Comments</th>
            <?php if (is_logged_in()) { ?>
                <th scope="col" class="col-1 sorttable_nosort">Edit</th>
                <th scope="col" class="col-1 sorttable_nosort">Delete</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($players as $player) { ?>

        <tr>
            <th scope="row"><?php echo $player['player']; ?></th>
            <td><?php echo $player['level']; ?></td>
            <td><?php echo $player['ability']; ?></td>
            <td><?php echo $player['comments'];?></td>
            <?php if (is_logged_in()) { ?>
                <td><a href="dota-edit.php?dota_id=<?php echo $player['dota_id']; ?>" class="btn btn-secondary">Edit <i
                            class="bi bi-pencil-square"></i></a></td>
                <td><a href="dota-delete.php?dota_id=<?php echo $player['dota_id']; ?>" class="btn btn-warning">Delete <i class="bi bi-trash"></i></a></td>
            <?php } ?>
        </tr>
        <?php } ?>

    </tbody>
</table>


<?php
include_once 'sharedmy/footer.php';
?>