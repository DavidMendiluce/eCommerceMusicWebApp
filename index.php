<?php
    session_start();


    if(isset($_SESSION['sesion'])) {
      if($_SESSION['role'] == "admin") {
        header('Location: Admin/');
      } else if($_SESSION['role'] == "user") {
        require 'inc/navUser.php';
      }
    } else {
        require 'inc/nav.php';
    }
 ?>


  <?php
  if(isset($_SESSION['sesion'])) {
    $username = $_SESSION['sesion'];
    $role =$_SESSION['role'];
    echo '<h1>Bienvenido ,'.$username.' </h1>';
    echo 'role: '.$role;
    echo '<a href="logout.php">logout</a>';

  } else {
    echo 'guest';
  }

    ?>





 <div ng-app="myApp" ng-controller="playListController" class="containerMain row d-flex flex-column">
    <img class="border currentImg" src="img/{{currentImage}}"/>
    <div class="container align-self-end" id="playListRow" ng-init="loadProduct()">
      <div class="searchBox">
      </div>
      <!--tags to order the songs by title, genre, date, length, speed and key-->
      <div class="orderItems d-flex flex-row">
        <div id="orderList" class="d-flex flex-row border-bottom border-top">
          <h5 class="align-self-center songInfo stitle" >Title
            <img class="tab-arrow" id="orderTitle" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" />
          </h5>
          <h5 class="align-self-center songInfo">Genre<img class="tab-arrow" id="orderGenre" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
          <h5 class="align-self-center songInfo">Date<img class="tab-arrow" id="orderDate" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
          <h5 class="align-self-center songInfo">Length<img class="tab-arrow" id="orderLength" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
          <h5 class="align-self-center songInfo">BPM<img  id="orderBPM" class="tab-arrow" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
          <h5 class="align-self-center songInfo">Key<img class="tab-arrow" id="orderKey" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
      </div>
    </div>
    <!--  -->
      <div class="row d-flex flex-column">
        <div class="col-3 md-3 d-flex flex-row" ng-repeat="song in songs | orderBy:[orderName]" ng-class="{'faded': song.songKey === selected}" >
          <div id="playListSongs" ng-click="getCurrentElement(song)"  class="imgContainer d-flex flex-row border-bottom">
            <img ng-src="img/{{ song.image }}" class="border img-responsive" width="80vh" height="80vh"/><br />
            <div class="align-self-center songInfo stitle">
            <h4 class="text">{{ song.title }}</h4>
            </div>
            <div class="align-self-center songInfo sgenre">
            <h4 class="text">{{song.genre}}</h4>
            </div>
            <div class="align-self-center songInfo sdate">
            <h4 class="text">{{song.date | timestampToISO | date}}</h4>
            </div>
            <div class="align-self-center songInfo slength">
            <h4 style="padding-left: 2vh" class="text">{{song.length}}</h4>
            </div>
            <div class="align-self-center songInfo sbpm">
            <h4 style="padding-left: 1vh">{{ song.bpm }} </h4>
            </div>
            <div class="align-self-center songInfo skey">
            <h4 class="text">{{song.songKey}}</h4>
            </div>
           </div>
        </div>
      </div>
  </div>

  </div>



<?php require 'inc/footer.php'; ?>
