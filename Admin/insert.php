<?php
  require '../config/connection.php';

  $form_data = json_decode(file_get_contents("php://input"));

    function debug_to_console($data) {
      $output = $data;
      if (is_array($output))
          $output = implode(',', $output);

      echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
  };



  $error = '';
  $message = '';
  $validation_error = '';
  $title = '';
  $bpm = '';
  $image = '';
  $genre = '';
  $length = '';
  $songKey = '';
  $price = '';
  $type = '';
  $mp3 = '';
  $id = $form_data->id;

  if($form_data->action == 'fetch_single_data') {
    $query ="SELECT * FROM songlist WHERE id='".$form_data->id."'";
    $result = mysqli_query($mysqli,$query);
    while($row = mysqli_fetch_assoc($result)) {
      $output['title'] = $row['title'];
      $output['bpm'] = $row['bpm'];
      $output['genre'] = $row['genre'];
      $output['length'] = $row['length'];
      $output['image'] = $row['image'];
      $output['price'] = $row['price'];
      $output['songKey'] = $row['songKey'];
      $output['type'] = $row['type'];
      $output['mp3'] = $row['mp3'];
    }
  } else {
    //check empty fields
    if(empty($form_data->title)) {
      $error = 'Title Required';
      }
    else {
      $title = $form_data->title;
      }

    if(empty($form_data->bpm)) {
        $error = 'BPM Required';
        }
    else {
        $bpm = $form_data->bpm;
       }

    if(empty($form_data->genre)) {
         $error = 'Genre Required';
      }
    else {
         $genre = $form_data->genre;
      }

    if(empty($form_data->image)) {
         $error = 'Image Required';
      }
    else {
         $image = $form_data->image;
      }

    if(empty($form_data->price)) {
          $error = 'Price Required';
         }
    else {
          $price = $form_data->price;
         }

    if(empty($form_data->songKey)) {
          $error = 'Field Required';
         }
    else {
          $songKey = $form_data->songKey;
         }

    if(empty($form_data->mp3)) {
          $error = 'MP3 Required';
         }
    else {
          $mp3 = $form_data->mp3;
         }

    if(empty($form_data->type)) {
          $error = 'Type Required';
         }
    else {
          $type = $form_data->type;
         }

    if(empty($form_data->length)) {
          $error = 'Length Required';
         }
    else {
          $length = $form_data->length;
         }
    if(empty($error)) {
      echo "<h1>No errors</h1>";
      if($form_data->action == 'Insert'){
      $sql = "INSERT INTO songlist (title, bpm, image, genre, length, songKey, price, type, mp3) VALUES ('$title', $bpm, '$image', '$genre','$length','$songKey',$price,'$type','$mp3')";
      $result = mysqli_query($mysqli, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($mysqli), E_USER_ERROR);
      echo $result;
      $message = 'Added song succesfully';
    }
    if($form_data->action == 'Edit') {
      $sql = "UPDATE songlist SET title = '$title', bpm = $bpm, genre = '$genre', length = '$length', price = $price, image = '$image', songKey = '$songKey', type = '$type', mp3 = '$mp3' WHERE id=$id";
        $result = mysqli_query($mysqli, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($mysqli), E_USER_ERROR);
        echo $result;
        $message = 'Edited song succesfully';
    }

    } else {
      $validation_error = $error;
    }

    $output = array(
      'error'       =>  $validation_error,
      'message'     =>  $message
    );
  }


  echo json_encode($output,JSON_NUMERIC_CHECK);
 ?>
