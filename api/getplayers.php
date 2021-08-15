<?php
header("Access-Control-Allow-Origin: *");
//connect to db
require_once '../database-dota.php';
$conn = db_connect();

$sql = "SELECT * FROM dota ORDER BY player";

$cmd = $conn -> prepare($sql);
$cmd -> execute();
$games = $cmd -> fetchAll(PDO::FETCH_ASSOC);

function insert_img_url($obejct)
{
  if(isset($obejct['photo']))
  {
      $object['photo'] = "http:" . $obejct['photo'];
  }  
  else
  {
      $object['photo'] = null;
  }
}

$games2 = array_map('insert_img_url', $games);

echo json_encode($games);