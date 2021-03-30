<?php require 'header.php';

$mypage = 'index.php';
if (!isset($_SESSION['refresher']))    {
    $_SESSION['refresher'] = 0;
}
elseif ($_SESSION['refresher'] >= 10)    {
    $_SESSION['refresher'] = 0;
}
else {
$_SESSION['refresher'] = 1;
}
?>



<div id="playlistPage" ng-app="myApp" ng-controller="playListController" ng-init="loadSongs(); fetchCart(); loadFirst('<?php echo $_SESSION["refresher"] ?>'); checkSession(); messageCounter();">
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <div class="container-fluid" >
    <a class="navbar-brand" href="./index.php"><img id="logo" src="img/goldenLogoWiden.png"/></a>
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
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="orders.php">Orders</a></li>
            <li><a class="dropdown-item" href="logout.php">logout</a></li>
          </ul>
        </li>
        <li class="nav-item" id="cartLi">
          <a class="nav-link" aria-current="page" href="./cartView.php">
            <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"><p>{{setQuantity()}}</p></i>Cart</a>
        </li>
        <li class="nav-item" id="messageLi">
          <a class="nav-link" ng-click="initDropChat()" data-toggle="collapse" data-target="#dropChat" aria-current="page" href="#">
            <i class="fa fa-comment fa-lg" aria-hidden="true"><p>{{newMesages}}</p></i>
            Messages</a>
            <!-- Chat Window -->
            <input type="text" id="fromUser" value=<?php echo $_SESSION["id"]; ?> hidden>
                        <ul class="dropdown-menu pb-chat-dropdown" id="dropChat">
                            <li>
                                <div class="panel panel-info pb-chat-panel">
                                    <div id="messagesTitle" class="panel panel-heading pb-chat-panel-heading">
                                        <h2>
                                          Messages
                                        </h2>
                                    </div>
                                    <div class="panel-body">
                                      <div id="msgBody" class="messagesContainer">
                                        <?php
                                        require 'config/connection.php';
                                        $adminId = "9";
                                        $chats = mysqli_query($mysqli, "SELECT * FROM messages WHERE (fromUser = '".$_SESSION["id"]."' AND
                                        toUser = '".$adminId."') OR (fromUser = '".$adminId."' AND toUser = '".$_SESSION["id"]."')")
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
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="chatTextContainer">
                                                <textarea id="message" class="form-control pb-chat-textarea" placeholder="Type your message here..."></textarea>
                                                <button id="btnChat" ng-click="sendMessage()" class="btn btn-primary"><span></span>Send</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

        </li>
      </ul>
    </div>
  </div>
</nav>
