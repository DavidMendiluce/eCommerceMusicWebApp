<?php


session_start();

$product_id = json_decode(file_get_contents("php://input"));

foreach($_SESSION["shopping_cart"] as $keys => $values)
{
  if($values["product_id"] == $product_id)
  {
    unset($_SESSION["shopping_cart"][$keys]);
  }
}
 ?>
