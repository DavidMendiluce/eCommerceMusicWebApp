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


<!--<h1 id="duration">E</h1>-->
 <!-- song container-->
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
          <h5 id="genreOrder" class="align-self-center songInfo">Genre<img class="tab-arrow" id="orderGenre" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
          <h5 id="dateOrder" class="align-self-center songInfo">Date<img class="tab-arrow" id="orderDate" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
          <h5 id="lengthOrder" class="align-self-center songInfo">Length<img class="tab-arrow" id="orderLength" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
          <h5 id="keyOrder" class="align-self-center songInfo">Key<img class="tab-arrow" id="orderKey" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
          <h5 id="keyOrder" class="align-self-center songInfo">Precio<img class="tab-arrow" id="orderKey" src="img/arrowWhiteDown.png" style="margin-left: 1vh" width="10vh" height="10vh" /></h5>
      </div>
    </div>
    <!--  -->
      <div class="row d-flex flex-column">
        <div class="col-3 md-3 d-flex flex-row" ng-init=" ($first) ? getCurrentElement(song) : ''" ng-repeat="song in (filteredItems = (songs | orderBy:[orderName])) as orderedItems " ng-class="{'faded': song.id === selected}" >
          <div id="playListSongs" ng-click="getCurrentElement(song, $index); clickItemPlayer(song)"  class="imgContainer d-flex flex-row border-bottom">
            <img ng-src="img/{{ song.image }}" class="border img-responsive" width="80vh" height="80vh"/><br />
            <div id = "title" class="align-self-center songInfo stitle pointer">
            <h4 id="currentTitle" class="text">{{ song.title}}</h4>
            </div>
            <div class="align-self-center songInfo sgenre pointer">
            <h4 id="currentGenre" class="text">{{song.genre}}</h4>
            </div>
            <div class="align-self-center songInfo sdate pointer">
            <h4 class="text">{{song.date | timestampToISO | date}}</h4>
            </div>
            <div class="align-self-center songInfo slength pointer">
            <h4 style="padding-left: 2vh" class="text">{{song.length}}</h4>
            </div>
            <div class="align-self-center songInfo skey pointer">
            <h4 class="text">{{song.songKey}} / {{ song.bpm }}</h4>
            </div>
           </div>
        </div>
      </div>

  <div class="col-3 md-3 d-flex flex-row" ng-repeat="song in songs | orderBy:[orderName]" >
    <div id="purchaseSong" ng-click="getCurrentElement(song)" class="align-self-center songInfo">
        <div id="songPrice">
          <h3 class="price text">{{song.price | currency}}</h3>
        </div>
      <img id="buyItem" ng-src="img/buy.png" class="border img-responsive" width="30vh" height="30vh"/>
      <img id="downloadItem" ng-src="img/download.png" class="border img-responsive" width="30vh" height="30vh"/>
    </div>
  </div>
  </div>

  <!-- music player-->
  <div class="player d-flex flex-column">
    <p id="logoPlayer">
      <i class="fa fa-music" aria-hidden="true"></i></p>

      <!-- right part -->
      <div class="pRight align-self-end">
        <img id="track_image">
        <p id="volume_show">90</p>

        <i class="fa fa-volume-up" aria-hidden="true" id="volume_icon" onclick="mute_sound()"></i>
        <input type="range" min="0" max="100" value="90" id="volume_change">
</div>
      <!-- left part -->
      <div class="pLeft align-self-start">
        <div class="show_song_no">
          <img src="img/{{currentImage}}" class="border img-responsive" width="80vh" height="80vh" />
        </div>
        <!-- song title -->
        <p id="pTitle">{{currentTitle}}</p>
        <p id="pGenre">{{currentGenre}}</p>
      </div>
        <!-- middle part -->
        <div class="pMiddle align-self-center">
          <button ng-click="itemPrev(filteredItems[j]); clickItemPlayer(filteredItems[z])" id="pre">
            <i class="fa fa-step-backward fa-lg" aria-hidden="true"></i></button>
            <button ng-click="itemPlayer(filteredItems[z])" id="play"><i class="fa fa-play fa-lg" aria-hidden="true"></i>
</button>
            <button ng-click="itemNext(filteredItems[i]); clickItemPlayer(filteredItems[z])" id="next"><i class="fa fa-step-forward fa-lg" aria-hidden="true"></i>
            </button>
        </div>

      <!-- song duration part -->
      <div class="songDuration align-self-center">
        <input type="range" min="0" max="1" value="0" id="duration_slider" step='.001'>
        <h5 id="minDuration"></h5>
        <h5 id="maxDuration"><h5>
      </div>
      </div>
  </div>






<?php require 'inc/footer.php'; ?>
