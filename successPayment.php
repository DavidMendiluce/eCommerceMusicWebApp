<?php
session_start();

require 'inc/navUser.php';

if(isset($_SESSION["success"])) {
  $orderId = $_SESSION["orderId"];
} else {
    header('Location: index.php');
};


 ?>



<div ng-init="loadBuySongsOnSuccess('<?php echo $orderId ?>');" id="pageSuccess" class="d-flex align-items-center flex-column">
<div id="successContainer" class="d-flex align-items-center flex-column">
  <div id="headerSuccess"><h1>Download your songs below</h1></div>
  <div id="listSuccess">
    <div id="successBox" ng-repeat="song in successBuySongs" class="d-flex align-items-center flex-column">
     <img class="border currentImg" src="img/{{song.image}}"/>
     <h2>{{song.title}}</h2>
     <button ng-click="downloadBuySong(song)" class="d-flex align-items-center flex-column">Download</button>
   </div>
    </div>
  </div>
</div>

<?php require "inc/footer.php" ?>
