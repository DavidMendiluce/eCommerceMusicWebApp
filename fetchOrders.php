<?php
require 'config/connection.php';

$userId = json_decode(file_get_contents("php://input"));

$mysqli = new PDO("mysql:host=localhost; dbname=ecommerce_music", "root", "");

$query = "SELECT * FROM orders where userId=$userId";

$statement = $mysqli->prepare($query);

$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  $data[] = $row;
}

//Need to add JSON_NUMERIC_CHECK to avoid number being treated as strings
echo json_encode($data,JSON_NUMERIC_CHECK);
 ?>
