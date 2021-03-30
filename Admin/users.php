<?php
    session_start();


 ?>
<html ng-app="myApp" ng-controller="crudController" ng-init="initUsersTable(); checkNewMessages(); getMessagesReload();">
<head>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
 <link rel="stylesheet" href="../css/bootstrap.css">
 <link rel="stylesheet" href="../css/bootstrap-twitter.css">
 <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="../css/dataTables.min.css">
 <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background: url('../img/blackGoldMarbel.jpg');">
  <?php
  if(isset($_SESSION['sesion'])) {
    $username = $_SESSION['sesion'];
    $role =$_SESSION['role'];
  } else {
    header('Location: ../index.php');
  }
    ?>

    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
      <div class="container-fluid" >
        <a class="navbar-brand" href="index.php"><img id="logo" src="../img/goldenLogoWiden.png"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="config" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i> Account
              </a>
              <ul class="dropdown-menu" id="configMenu">
                <li><a class="dropdown-item" href="users.php">Users</a></li>
                <li><a class="dropdown-item" href="../logout.php">logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br><br><br><br><br><br>
    <h2>{{dataReadMessage()}}</h2>

<div id="adminTableContainer" class="d-flex justify-content-start">
<table datatable="ng" dt-options="vm.dtOptions" class="table" id="usersAdminTable">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">New Messages</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require '../config/connection.php';
      $msgs = mysqli_query($mysqli, "SELECT * FROM users")
              or die("Failed to query database".mysql_error());
              while($msg = mysqli_fetch_assoc($msgs))
              {
                echo '<tr><td><a ng-click="readMessage()" href="?toUser='.$msg["id"].'">'.$msg["name"].'</a></td><td>'.$msg["adminCounter"].'</td></tr>';
              }
      ?>
  </tbody>
</table>
</div>
<input type="text" id="fromUser" value=<?php echo $_SESSION["id"]; ?> hidden>
<div ng-init="fetchIdMessageAdmin('<?php echo $_GET["toUser"] ?>');" id="adminChatModal" ng-style="{'visibility': getVisibility()} " class="cold-md-4">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>
              <?php
                if(isset($_GET["toUser"]))
                {
                  $userName = mysqli_query($mysqli,"SELECT * FROM users WHERE id = '".$_GET["toUser"]."'")
                  or die("Failed to query database".mysql_error());
                  $uName = mysqli_fetch_assoc($userName);
                  echo '<input type="text" value='.$_GET["toUser"].' id="toUser" hidden/>';
                  echo $uName["name"];
                }
                else
                {
                  $userName = mysqli_query($mysqli,"SELECT * FROM users")
                  or die("Failed to query database".mysql_error());
                  $uName = mysqli_fetch_assoc($userName);
                  $_SESSION["toUser"] = $uName["id"];
                  echo '<input type="text" value='.$_GET["toUser"].' id="toUser" hidden/>';
                  echo $uName["name"];
                }
               ?>
            </h4>
          </div>
        <div id="dropChatAdmin">
        <div class="modal-body messagesContainer" id="msgBody">
          <?php
          echo "<div><p>Something</p></div>";
          require '../config/connection.php';
          $adminId = "9";
          $chats = mysqli_query($mysqli, "SELECT * FROM messages WHERE (fromUser = '".$_GET["toUser"]."' AND
          toUser = '".$adminId."') OR (fromUser = '".$adminId."' AND toUser = '".$_GET["toUser"]."')")
          or die("Failed to query database".mysql_error());

          while($chat = mysqli_fetch_assoc($chats))
          {
            if($chat["fromUser"] == $_SESSION["id"]) {
              echo '<div id="msgBox" class="d-flex align-items-end flex-column">
              <div id="messageBodyRight" class="form-group">
                <span>'.$chat["message"].'</span>
              </div>
              </div>';
          } else {
            echo '<div id="msgBox" class="d-flex align-items-start flex-column">
            <div id="messageBody" class="form-group">
              <span>'.$chat["message"].'</span>
            </div>
            </div>';
          }
          }
           ?>
        </div>
      </div>
      <div class="modal-footer">
          <div class="row">
              <div class="chatTextContainerAdmin">
                  <textarea id="message" class="form-control pb-chat-textarea" placeholder="Type your message here..."></textarea>
                  <button id="btnChatAdmin" ng-click="sendMessage('<?php echo $_GET["toUser"] ?>')" class="btn btn-primary"><span></span>Send</button>
              </div>

          </div>
      </div>
    </div>
  </div>
</div>
</body>
<!-- JavaScripts -->

<!--JQuery -->
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/main.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>


<!-- bootstrap -->
<script src="../js/bootstrap/bootstrap.min.js" ></script>

<!-- angularjs scripts-->
<script src="../js/angular.min.js"></script>
<script src="../js/angular-route.min.js"></script>
<script src="../js/myapp.js"></script>
<script src="../js/controllers/playListController.js"></script>
<script src="../js/controllers/crudController.js"></script>
<script src="../js/angular-datatables.min"></script>
