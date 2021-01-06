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
            //order by bpm
            $('#orderKey').on('click', function(){
              if(counterKey == 0) {
                var order = '-bpm';
                counterKey = 1;
              }
              else if(counterKey == 1) {
                var order = 'bpm';
                counterKey = 0;
              }
              $scope.orderName= order;
              $scope.$apply();
              });



              //get the current element and it's parameteres
              var counter = 0;
              var clicked = false;
              var songIndex = 1;
              var counterClick = 0;
              var currentTitle = '';
              var currentGenre = '';
              var currentPath = '';
              var currentImg = '';
              var currentLength = '';
              var currentKey = '';
              var currentPrice = '';
              var playerSong = {};
              var select = '';
              var type = '';
              $scope.getCurrentElement = getCurrentElement;

              function getCurrentElement(song, $index) {

                if($index >=0) {
                counter = 0;
                counterClick = 1;
                $scope.j = $index - 1;
                $scope.i = $index + 1;
                $scope.z = $index;
                clicked = true;
                songIndex = $index;
                $scope.indexSong = songIndex;
                playerSong = song;
                currentTitle = song.title;
                $scope.currentTitle = currentTitle;
                currentGenre = song.genre;
                $scope.currentGenre = currentGenre;
                currentPath = song.mp3;
                $scope.mp3 = currentPath;
                //changes the image thumbnail on the left to the current selected item
                var currentImg = song.image;
                $scope.currentImage = currentImg;
                //changes the opacity of the selected element
                var select = song.id;
                $scope.selected = select;
                //sets download or buy on the item
                var type = song.type;
                var cPrice = song.price;
                $scope.purchaseType = type;
                $scope.correctPrice = cPrice;
              } else {
                $scope.i = 1;
                $scope.j = 1;
                $scope.z = $index;
                counterClick = 0;
                currentTitle = song.title;
                $scope.currentTitle = currentTitle;
                currentGenre = song.genre;
                $scope.currentGenre = currentGenre;
                currentPath = song.mp3;
                //changes the image thumbnail on the left to the current selected item
                var currentImg = song.image;
                $scope.currentImage = currentImg;
                //changes the opacity of the selected element
                var select = song.id;
                $scope.selected = select;
                //sets download or buy on the item
                var type = song.type;
                var cPrice = song.price;
                $scope.purchaseType = type;
                $scope.correctPrice = cPrice;
              }
              }


              /*var counter = 0;
              var currentIndexNumber = 0;
              $scope.counter = counter;
              $scope.currentIndex = 0;
              //toggle next song
              $scope.nextPlayer = function(){
                $scope.getCurrentElement = getCurrentElement(playerSong, songIndex);
                counter = songIndex + 1;
                select = $('#idSongPlus').text();
                $scope.selected = parseInt(select);
                $scope.counter = counter;
                $scope.currentIndex = select;
                $scope.$apply();

              };
              var e = new jQuery.Event("click");
              e.pageX = 685;
              e.pageY = 554;
              $(".containerMain").trigger(e);
              */



              //music player functions
              var nextIndex = 0;
              var prevIndex = 0;
              var nextActive = false;
              var prevActive = false;


              //get next item
              $scope.itemNext = function (song) {
                if(prevActive == true) {

                }
                nextActive = true;
                prevActive = false;
                  if(clicked == true) {
                    counterClick++;
                  }
                  counter++;
                  $scope.i = songIndex + counter;
                  $scope.z = songIndex + counter - 1;
                  console.log(song);

                  currentTitle = song.title;
                  $scope.currentTitle = currentTitle;
                  currentGenre = song.genre;
                  $scope.currentGenre = currentGenre;
                  currentPath = song.mp3;
                  //changes the image thumbnail on the left to the current selected item
                  var currentImg = song.image;
                  $scope.currentImage = currentImg;
                  //changes the opacity of the selected element
                  var select = song.id;
                  $scope.selected = select;
                  //sets download or buy on the item
                  var type = song.type;
                  var cPrice = song.price;
                  $scope.purchaseType = type;
                  $scope.correctPrice = cPrice;
                  clicked = false;
                  if(counterClick >=2) {
                    $scope.i = songIndex + counter + 1;
                    counter++;
                    counterClick = 0;
                  }
                  nextIndex = songIndex;
              };

              //get prev item
              $scope.itemPrev = function (song) {
                counter--;
                if(nextActive == true) {
                  $scope.j = songIndex + counter;
                  $scope.z = songIndex + counter - 1;
                } else {
                  $scope.j = songIndex + counter;
                  $scope.z = songIndex + counter - 1;
                }

                prevActive = true;
                nextActive = false;
                if(clicked == true) {
                  counterClick++;
                }


                    console.log(song);

                    currentTitle = song.title;
                    $scope.currentTitle = currentTitle;
                    currentGenre = song.genre;
                    $scope.currentGenre = currentGenre;
                    currentPath = song.mp3;
                    //changes the image thumbnail on the left to the current selected item
                    var currentImg = song.image;
                    $scope.currentImage = currentImg;
                    //changes the opacity of the selected element
                    var select = song.id;
                    $scope.selected = select;
                    //sets download or buy on the item
                    var type = song.type;
                    var cPrice = song.price;
                    $scope.purchaseType = type;
                    $scope.correctPrice = cPrice;
                    clicked = false;
                    if(counterClick >=2) {
                      $scope.j = songIndex + counter - 1;
                      counter--;
                      counterClick = 0;
                    }
                  }

              function changeHtmlPrev(songIndex, counter) {
                $scope.i = songIndex + counter;
              }






              var audio = new Audio();

              //play button functionallity
              $scope.itemPlayer = function(song) {

                $scope.mp3 = song.mp3;
                if(playing_song==false) {
                  playMusic(song.mp3);
                  play.innerHTML = '<i class="fa fa-pause fa-lg"></i>';
                  playing_song = true;
                  $('.fa-pause').css("color", "black");
                } else if(playing_song==true) {
                  pauseMusic();
                  play.innerHTML = '<i class="fa fa-play fa-lg"></i>'
                  playing_song = false;
                  $('.fa-play').css("color", "black");
                }
              }

              //onClick song playMusic functionallity
              $scope.clickItemPlayer = function(song) {
                $scope.mp3 = song.mp3;

                  playMusic(song.mp3);
                  play.innerHTML = '<i class="fa fa-pause fa-lg"></i>';
                  playing_song = true;
                  $('.fa-pause').css("color", "black");
              }

              function playMusic(path) {
                audio.src = 'songs/'+path;
                audio.play();
              }

              function pauseMusic() {
                audio.pause();
              }

              //slider style
              $('input[type="range"]').on('change mousemove', function () {
                var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));

                $(this).css('background-image',
                '-webkit-gradient(linear, left top, right top, '
                + 'color-stop(' + val + ', #dbb118), '
                + 'color-stop(' + val + ', #e3e3e3)'
                + ')'
                );
              });



              //change volume
              let volume = document.querySelector("#volume_change");
              volume.addEventListener("change", function(e) {
                audio.volume = e.currentTarget.value / 100;
              });

              //duration slider functionality
              $("#duration_slider").on("input",function(e){
                audio.currentTime = duration_slider.value * audio.duration;
              });

              function showDuration(){
                $(audio).bind('timeupdate', function(){
                  //Get hours and minutes
                  var sMin = parseInt(audio.currentTime % 60);
                  var mMin = parseInt((audio.currentTime / 60) % 60);
                  var sMax = parseInt(audio.duration % 60);
                  var mMax = parseInt((audio.duration / 60) % 60);
                  //Add 0 if seconds less than 10
                  if (sMin < 10) {
                    sMin = '0' + sMin;
                    }
                  if (sMax < 10) {
                    sMax = '0' + sMax;
                    }
                    $('#minDuration').html(mMin + '.' + sMin);
                    $('#maxDuration').html(mMax + '.' + sMax);
                    console.log(mMin);
                    console.log(mMax);
                    var valueSlider = 0;
                    if (audio.currentTime > 0) {
                      valueSlider = (audio.currentTime/audio.duration);
                    }
                    $('#duration_slider').val(valueSlider);
                    $scope.min = audio.currentTime;
                    $scope.max = audio.duration;
                  });
                }
                showDuration();



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
