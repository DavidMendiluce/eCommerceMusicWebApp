app.controller('playListController', function($scope, $http) {


  //ordering songs
  var order = 'title';
  var counterTitle = 0;
  var counterGenre = 0;
  var counterLength = 0;
  var counterDate = 0;
  var counterBPM = 0;
  var counterKey = 0;
  $scope.orderName= order;
  $scope.counterTry = counterTitle;
  //orderByTitle
  $('#orderTitle').on('click', function(){

    if(counterTitle == 0) {
      var order = '-title';
      counterTitle = 1;
    }
    else if(counterTitle == 1) {
      var order = 'title';
      counterTitle = 0;
    }
    $scope.orderName= order;
    $scope.$apply();

    });
    //orderByBpm
    $('#orderBPM').on('click', function(){
      if(counterBPM == 0) {
        var order = 'bpm';
        counterBPM = 1;
      }
      else if(counterBPM == 1) {
        var order = '-bpm';
        counterBPM = 0;
      }
      $scope.orderName= order;
      $scope.$apply();
      });
      //orderByGenre
      $('#orderGenre').on('click', function(){
        if(counterGenre == 0) {
          var order = '-genre';
          counterGenre = 1;
        }
        else if(counterGenre == 1) {
          var order = 'genre';
          counterGenre = 0;
        }
        $scope.orderName= order;
        $scope.$apply();
        });
        //orderByDate
        $('#orderDate').on('click', function(){
          if(counterDate == 0) {
            var order = 'date';
            counterDate = 1;
          }
          else if(counterDate == 1) {
            var order = '-date';
            counterDate = 0;
          }
          $scope.orderName= order;
          $scope.$apply();
          });
          //order by length
          $('#orderLength').on('click', function(){
            if(counterLength == 0) {
              var order = 'length';
              counterLength = 1;
            }
            else if(counterLength == 1) {
              var order = '-length';
              counterLength = 0;
            }
            $scope.orderName= order;
            $scope.$apply();
            });
            //order by key
            $('#orderKey').on('click', function(){
              if(counterKey == 0) {
                var order = '-songKey';
                counterKey = 1;
              }
              else if(counterKey == 1) {
                var order = 'songKey';
                counterKey = 0;
              }
              $scope.orderName= order;
              $scope.$apply();
              });





              //get the current element and it's parameteres

              var currentImg = 'rosalia.jpg';
              $scope.currentImage = currentImg;
              var select = '';
              $scope.selected = select;
              $scope.getCurrentElement = function(song) {
                //changes the image thumbnail on the left to the current selected item
                var currentImg = song.image;
                $scope.currentImage = currentImg;
                //changes the opacity of the selected element
                var select = song.songKey;
                $scope.selected = select;
                $scope.$apply();

              }



    //loadingSongs
    $scope.loadProduct = function(){
      $http({
        method: 'GET',
        url: 'fetchPlaylist.php'
      }).then(function(data) {
        console.log(data, 'res');
          $scope.songs = data.data;
      }, function(error) {
        console.log(error, 'cant get data.');
      });
    };

});
//format timestamp to date
app.filter('timestampToISO', function() {
    return function(input) {
        input = new Date(input).toISOString();
        return input;
    };
});
