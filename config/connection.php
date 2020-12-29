<?php
  $mysqli = new mysqli('localhost', 'root', '', 'ecommerce_music');
  if($mysqli->connect_errno):
    echo "Error connecting with MySQL ".$mysqli->connect_error;

  endif;
 ?>
