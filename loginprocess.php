<?php
require 'config/connection.php';

//function that check if the user types username or password
function Is_email($user)
{
//If the username input string is an e-mail, return true
if(filter_var($user, FILTER_VALIDATE_EMAIL)) {
return true;
} else {
return false;
}
}

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
  require 'config/connection.php';
  sleep(2);
  session_start();

  $mysqli->set_charset('utf8');


  $email = $mysqli->real_escape_string($_POST['user_email']);
  $pas = $mysqli->real_escape_string($_POST['user_password']);

  $query_user_email = "";
  $check_email = Is_email($email);
  if($check_email){
    //if it's true the query will compare the input of the user with the EMAIL in the database
    $query_user_email = "SELECT name, role, password FROM users WHERE email = ?";
  } else {
    //if it's false the query will compare the input of the user with the NAME in the database
    $query_user_email = "SELECT name, role, password FROM users WHERE name = ?";
  }

  if($new_query = $mysqli->prepare($query_user_email)) {

      $new_query->bind_param('s', $email);

      $new_query->execute();

      $result = $new_query->get_result();

      if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        if(password_verify($pas, $data['password'])) {
          $_SESSION['sesion'] = $email;
          $_SESSION['role'] = $data['role'];
          echo json_encode(array('error'=> false, 'type' => $data['role']));
        } else {
          echo json_encode(array('error'=> true));
        }
      }else {
        echo json_encode(array('error'=> true));
      }
      $new_query->close();
  }
}

$mysqli->close();

?>
