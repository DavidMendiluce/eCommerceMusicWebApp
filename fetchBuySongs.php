<?php
require 'config/connection.php';

$userId = json_decode(file_get_contents("php://input"));

$mysqli = new PDO("mysql:host=localhost; dbname=ecommerce_music", "root", "");


$query = "SELECT * FROM songlist INNER JOIN product ON product.songId=songlist.id INNER JOIN order_has_products ON order_has_products.idProduct=product.productId WHERE order_has_products.idOrder=$userId";

$statement = $mysqli->prepare($query);

$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  $data[] = $row;
}

//Need to add JSON_NUMERIC_CHECK to avoid number being treated as strings
echo json_encode($data,JSON_NUMERIC_CHECK);
?>
