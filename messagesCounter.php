<?php

require 'config/connection.php';

$messageDataCount = json_decode(file_get_contents("php://input"));

$fromUser = $messageDataCount->fromUser;
$toUser = $messageDataCount->toUser;
$output = "";

$mysqli = new PDO("mysql:host=localhost; dbname=ecommerce_music", "root", "");


//0 no readed, 1 readed;
$newMesages = $mysqli->query("SELECT COUNT(*) FROM messages WHERE fromUser='$toUser' AND toUser='$fromUser' AND readed=0")->fetchColumn();




//Need to add JSON_NUMERIC_CHECK to avoid number being treated as strings
echo json_encode($newMesages,JSON_NUMERIC_CHECK);

?>
