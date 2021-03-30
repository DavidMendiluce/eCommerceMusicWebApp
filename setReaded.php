<?php
require 'config/connection.php';

$messageDataCount = json_decode(file_get_contents("php://input"));

$fromUser = $messageDataCount->fromUser;
$toUser = $messageDataCount->toUser;
$output = "";

$connectionString = mysqli_connect('localhost', 'root', '', 'ecommerce_music') or die($connectionString);


//set as readed all the new messages;
$sql = "UPDATE messages SET readed = 1 WHERE fromUser='$toUser' AND toUser='$fromUser'";
$result = mysqli_query($connectionString, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($mysqli), E_USER_ERROR);


echo json_encode($result,JSON_NUMERIC_CHECK);


?>
