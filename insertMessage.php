<?php
session_start();
require 'config/connection.php';
$connectionString = mysqli_connect('localhost', 'root', '', 'ecommerce_music') or die($connectionString);

$messageData = json_decode(file_get_contents("php://input"));

$fromUser = $messageData->fromUser;
$toUser = $messageData->toUser;
$message = $messageData->message;

echo $fromUser;
echo $toUser;
echo $message;

$formatedMessage = mysqli_real_escape_string($connectionString, $message);

$output = "";

$sql = "INSERT INTO messages(fromUser, toUser, message) VALUES ('$fromUser','$toUser','$formatedMessage')";

if($mysqli-> query($sql)) {
  $output.="";
}
else {
  $output.="Error. Please Try Again." . $mysqli->error;
}
echo $output;
?>
