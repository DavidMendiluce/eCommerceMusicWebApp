<?php

session_start();

$current_cart = json_decode(file_get_contents("php://input"));


  $_SESSION["shopping_cart"]= $current_cart;

  echo "archivo php activado";
  echo '<pre>' ; print_r($current_cart); echo '</pre>';

 ?>
