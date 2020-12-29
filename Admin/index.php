<?php
    session_start();


 ?>



<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, intial-scale=1">
  <title>Admin Page</title>

  </style>
</head>
<body>
  <?php
  if(isset($_SESSION['sesion'])) {
    $username = $_SESSION['sesion'];
    $role =$_SESSION['role'];
    echo '<h1>Bienvenido ,'.$username.' </h1>';
    echo 'role: '.$role;
  } else {
    echo 'error';
  }
    ?>

    
  <a href="../logout.php">logout</a>
</body>
</html>
