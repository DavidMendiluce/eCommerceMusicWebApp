<?php
    session_start();


 ?>
<html ng-app="myApp" ng-controller="crudController" ng-init="loadSongs(); initDataTable()" id="adminPage">
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
  <a href="../logout.php">logout</a>
  <div id="successMessage" class="alert alert-success
  alert-dismissable" ng-show="success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{successMessage}}
  </div>
  <div align="right">
    <button type="button" name="add_button" ng-click="addData()" class="btn btn-success">Add song</button>
  </div>
    <div class="table-responsive" style="overflow-x: unset;">
      <table id="adminTable" datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Title</th>
            <th>BPM</th>
            <th>Image</th>
            <th>Genre</th>
            <th>Length</th>
            <th>Date</th>
            <th>Key</th>
            <th>Price</th>
            <th>Type(buy/download)</th>
            <th>Audio File</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
          <tbody>
            <tr ng-repeat="song in (filteredItems = (songs | orderBy:[orderName])) as orderedItems">
              <td>{{song.title}}</td>
              <td>{{song.bpm}}</td>
              <td>{{song.image}}</td>
              <td>{{song.genre}}</td>
              <td>{{song.length}}</td>
              <td>{{song.date}}</td>
              <td>{{song.songKey}}</td>
              <td>{{song.price}}</td>
              <td>{{song.type}}</td>
              <td>{{song.mp3}}</td>
              <td>
                <button type="button" name="edit_button" ng-click="edit(song.id)" class="btn btn-warning btn-xs">Edit</button>
              </td>
              <td>
                <button type="button" name="delete_button" ng-click="deleteForm(song.id)" class="btn btn-danger btn-xs">Delete</button>
              </td>
            </tr>
          </tbody>
        </thead>
      </table>
    </div>

    <!--Add and update song modal-->
    <div class="modal" tabindex="-1" role="dialog" id="crudmodal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form method="post" ng-submit="submitForm()">
          <div class="modal-header">
           <h4 class="modal-title">{{modalTitle}}</h4>
            <button type="button" ng-click="reload()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div id="errorMessage" class="alert alert-danger
            alert-dismissable" ng-show="error">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{errorMessage}}
            </div>
            <div class="form-group">
              <label>Title</label>
              <input type="text" value="paco" name="title" ng-model="dataModal.title" class="form-control"/>
            </div>
            <div class="form-group">
              <label>BPM</label>
              <input type="text" name="bpm" ng-model="dataModal.bpm" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="text" name="image" ng-model="dataModal.image" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Genre</label>
              <input type="text" name="genre" ng-model="dataModal.genre" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Length</label>
              <input type="text" name="length" ng-model="dataModal.length" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Key</label>
              <input type="text" name="songKey" ng-model="dataModal.songKey" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="text" name="price" ng-model="dataModal.price" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Type</label>
              <input type="text" name="type" ng-model="dataModal.type" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Audio File</label>
              <input type="text" name="mp3" ng-model="dataModal.mp3" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Song ID</label>
              <input type="text" name="mp3" ng-model="dataModal.id" class="form-control"/>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" name="submit" id="submit" class="btn btn-info" value="{{submit_button}}" />
            <button ng-click="reload()" type="button" class="btn btn-default" data-dismiss="modal">Close
            </button>
          </div>
         </form>
        </div>
      </div>
    </div>

<!--delete modal-->
<div id="deletemodal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete song</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this song?.</p>
      </div>
      <div class="modal-footer">
        <button type="button" ng-click="confirmDelete()" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


</html>
