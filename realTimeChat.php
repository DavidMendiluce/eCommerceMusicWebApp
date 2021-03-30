<?php
 require 'config/connection.php';

$messageDataUpdate = json_decode(file_get_contents("php://input"));

 $fromUser = $messageDataUpdate->fromUser;
 $toUser = $messageDataUpdate->toUser;
 $output = "";

 $chats = mysqli_query($mysqli, "SELECT * FROM messages WHERE (fromUser = '".$fromUser."' AND
     toUser = '".$toUser."') OR (fromUser = '".$toUser."' AND toUser = '".$fromUser."')")
     or die("Failed to query database".mysql_error());

     while($chat = mysqli_fetch_assoc($chats))
     {
       if($chat["fromUser"] == $fromUser)
         $output.= '<div id="msgBox" class="d-flex align-items-end flex-column">
         <div id="messageBodyRight" class="form-group">
           <span>'.$chat["message"].'</span>
         </div>
         </div>';
      else
       $output.='<div id="msgBox" class="d-flex align-items-start flex-column">
       <div id="messageBody" class="form-group">
         <span>'.$chat["message"].'</span>
       </div>
       </div>';

  }
 echo $output;
?>
