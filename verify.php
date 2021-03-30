<?php
require "inc/header.php";
require "config/connection.php";


if(isset($_GET['vkey'])) {
  $vKey = $_GET['vkey'];

  $resultSet = $mysqli->query("SELECT verified,vKey FROM users WHERE verified = 0 AND vKey='$vKey' LIMIT 1");
  if($resultSet->num_rows == 1) {
    $update = $mysqli->query("UPDATE users SET verified = 1 WHERE vKey = '$vKey' LIMIT 1");
    if($update){
      echo "Your account has been verified";
    } else {
      echo $mysqli->error;
    }
  }
} else {
  die("something went wrong");
}
?>

<body>
  <h1>Your account has been verified</h1>
  <form action="login.php">
  <button type="submit" value="go to Login" class="btn btn-primary">Go to Login</button>
  </form>
</body>
<? require "footer.php" ?>
