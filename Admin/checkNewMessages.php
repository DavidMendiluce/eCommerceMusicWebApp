<?php

require '../config/connection.php';

$messageDataCount = json_decode(file_get_contents("php://input"));

$fromUser = $messageDataCount->fromUser;
$toUser = $messageDataCount->toUser;
$output = "";

$mysqliPDO = new PDO("mysql:host=localhost; dbname=ecommerce_music", "root", "");


//0 no readed, 1 readed;
$newMessages = $mysqliPDO->query("SELECT COUNT(*) FROM messages WHERE fromUser='$toUser' AND toUser='$fromUser' AND readed=0")->fetchColumn();

$mysqli = new mysqli('localhost', 'root', '', 'ecommerce_music');
$sql = "UPDATE users SET adminCounter = '$newMessages' WHERE id=$toUser";
$result = mysqli_query($mysqli, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($mysqli), E_USER_ERROR);




//Need to add JSON_NUMERIC_CHECK to avoid number being treated as strings
echo json_encode($result,JSON_NUMERIC_CHECK);

?>
