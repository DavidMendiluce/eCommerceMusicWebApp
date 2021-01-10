<?php

require '../config/connection.php';

$form_data = json_decode(file_get_contents("php://input"));

$sql = "DELETE FROM songlist WHERE id='".$form_data->id."'";
  $result = mysqli_query($mysqli, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($mysqli), E_USER_ERROR);
  echo $result;
  $message = 'Deleted song succesfully';
  ?>
