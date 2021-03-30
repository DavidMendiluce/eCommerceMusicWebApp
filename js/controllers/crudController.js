app.controller('crudController', function($scope, $http, $timeout, $interval, $window) {

  $scope.sucess = false;

  $scope.error = false;

  //adding data through pop-up window
  $scope.openModal = function() {
    var modal_popup = angular.element('#crudmodal');
    modal_popup.modal('show');
  };

  $scope.closeModal = function() {
    var modal_popup = angular.element('#crudmodal');
    modal_popup.modal('hide');
  };


  /*sets the title of the modal and the text of the submit button
  the text of the submit button will be stored as the action variable
  the action variable will be used in the insert.php file to select the query to execute,
  either insert(to add a song) or update(to edit the song)*/
  $scope.addData = function() {
    $scope.modalTitle = 'Add Song';
    $scope.submit_button = 'Insert';
    $scope.openModal();
  };

  $scope.reload = function() {
    window.location.reload();
    console.log("reloading");
  }

  //Open modal template which can be the form to add a song or to edit song depending on the value of action
  $scope.submitForm = function(){
   $http({
    method:"POST",
    url:"insert.php",
    data: $scope.dataModal = {'title' :$scope.dataModal.title, 'bpm' :$scope.dataModal.bpm, 'image' :$scope.dataModal.image,
    'genre' :$scope.dataModal.genre, 'length' :$scope.dataModal.length, 'date' :$scope.dataModal.date,
    'songKey' :$scope.dataModal.songKey, 'price' :$scope.dataModal.price, 'type' :$scope.dataModal.type,
    'mp3' : $scope.dataModal.mp3, 'error': '', 'action':$scope.submit_button, 'id':$scope.dataModal.id}
  }).then(function(data){
    console.log($scope.dataModal);
    console.log(data);
    if(!data.data.error)
    {
      $scope.success = true;
      $scope.error = false;
      $scope.successMessage = data.data.message;
      $scope.form_data = {};
      $scope.closeModal();
      $scope.loadSongs();
      $scope.slideSuccess();
      window.location.reload();

    }
    else
    {
     $scope.success = false;
     $scope.error = true;
     $scope.errorMessage = data.data.error;
     $scope.slideError();
    }
   });
  };

  //Fetch data of the song to be edited
  $scope.edit = function(songID){
    $http({
      method: "POST",
      url: "insert.php",
      data:{'id':songID, 'action':'fetch_single_data'}
    }).then(function(data){
      $scope.submit_button = "Edit";
      console.log(data);
      $scope.dataModal = {'title' :data.data.title, 'bpm' :data.data.bpm, 'image' :data.data.image,
      'genre' :data.data.genre, 'length' :data.data.length, 'date' :data.data.date,
      'songKey' :data.data.songKey, 'price' :data.data.price, 'type' :data.data.type,
      'mp3' : data.data.mp3, 'error': '', 'action':'', 'id':songID};
      $scope.hidden_id= data.config.data.id;
      $scope.modalTitle = 'Edit Song';
      $scope.openModal();
    });
  }

  $scope.deleteConfirmaton = false;
  $scope.deleteId = "";
  $scope.deleteForm = function(songID) {
    var modal_popup = angular.element('#deletemodal');
    modal_popup.modal('show');
    $scope.deleteId = songID;
  }

  $scope.confirmDelete = function() {
    $scope.deleteData($scope.deleteId);
  }

  //Deletes a song
  $scope.deleteData = function(songID){
   $http({
    method:"POST",
    url:"delete.php",
    data:{'id':songID}
  }).then(function(data){
    $scope.success = true;
    $scope.error = false;
    $scope.successMessage = data.data.message;
    var modal_popup = angular.element('#deletemodal');
    modal_popup.modal('hide');
    window.location.reload();
   });
 };

  //Slider error and success messages
  $scope.slideSuccess = function(){
  $('#successMessage').slideDown('slow');
  $("#successMessage").css("visibility", "visible");
  setTimeout(function() {
    $('#successMessage').slideUp('slow');
  },3000);
}

$scope.closeSuccess = function(){
$("#successMessage").css("visibility", "hidden");
}
  $scope.slideError = function(){
  $('#errorMessage').slideDown('slow');
  $("#errorMessage").css("visibility", "visible");
  setTimeout(function() {
    $('#errorMessage').slideUp('slow');
  },3000);
}

  //loadingSongs
  $scope.loadSongs = function(){
    $http({
      method: 'GET',
      url: '../fetchPlaylist.php'
    }).then(function(data) {
      console.log(data, 'res');
        $scope.songs = data.data;
    }, function(error) {
      console.log(error, 'cant get data.');
    });
  };

  //order table
  $scope.initDataTable = function() {
    $timeout(function() {
    $('#adminTable').DataTable({
        "order": [[ 3, "desc" ]]
      });
    }, 200)
  };

  //order table
  $scope.initUsersTable = function() {
    $timeout(function() {
    $('#usersAdminTable').DataTable({
        "order": [[ 0, "desc" ]]
      });
    }, 200)
  };

$scope.messageCountAdmin = 0;

$scope.getVisibility = function() {
  if(window.location.href.indexOf("toUser") > -1) {
    return "visible";
  } else {
    console.log("hidden");
    return "hidden";
  }
}

$scope.sendMessage = function(id) {
  $scope.fromUser = $("#fromUser").val();
  $scope.toUser = id;
  $scope.message = $("textarea#message").val();
  console.log(id);
  $http({
    method: 'POST',
    url: '../insertMessage.php',
    data: $scope.messageData = {
      "fromUser": $scope.fromUser,
      "toUser": $scope.toUser,
      "message": $scope.message
    },
    dataType: "text"
  }).then(function(data) {
      $("#message").val("");
  }, function(error) {
    console.log(error, 'cant get data.');
  });
}


$scope.fetchIdMessageAdmin = function(id) {
  $scope.currentIdMessageAdmin = id;
  $interval(setInterval, 1000);
  setInterval();

};

//This will be fetching the messages from the database each second
var setInterval = function() {
  $scope.fromUser = $("#fromUser").val();
  $scope.toUser = $scope.currentIdMessageAdmin;
  $http({
    method: 'POST',
    url: '../realTimeChat.php',
    data: $scope.messageDataUpdate = {
      "fromUser": $scope.fromUser,
      "toUser": $scope.toUser
    },
    dataType: "text"
  }).then(function(data) {
      $("#msgBody").html(data.data);
  }, function(error) {
    console.log(error, 'cant get data.');
  });

}



//Check for new messages from useres
$scope.checkNewMessages = function() {
  $scope.fromUser = $("#fromUser").val();
    $http({
      method: 'GET',
      url: 'fetchUsers.php'
    }).then(function(data) {
        for(var i = 0;i<data.data.length; i++) {
          $scope.toUser = data.data[i].id;
          $http({
            method: 'POST',
            url: 'checkNewMessages.php',
            data:  $scope.messageDataUpdate = {
              "fromUser": $scope.fromUser,
              "toUser": $scope.toUser
            },
          }).then(function(data) {
          }, function(error) {
            console.log(error, 'cant get data.');
          });
        }
    }, function(error) {
      console.log(error, 'cant get data.');
    });
  }

  $scope.readMessage = function() {
    $scope.fromUser = $("#fromUser").val();
    $scope.toUser = $scope.currentIdMessageAdmin;
    $http({
      method: 'POST',
      url: '../setReaded.php',
      data:  $scope.messageDataCount = {
        "fromUser": $scope.fromUser,
        "toUser": $scope.toUser
      },
    }).then(function(data) {
        console.log(data.data);
    }, function(error) {
      console.log(error, 'cant get data.');
    });

  }


});
