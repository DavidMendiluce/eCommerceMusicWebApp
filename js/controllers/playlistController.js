app.controller('playListController', function($scope, $http, $window, $interval) {




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

    $scope.isSessionStarted = false;
    //check If a User Is Logged In
    $scope.checkSession = function() {
      $scope.isSessionStarted = true;
    }

    $scope.getClass = function(type) {
      if(type==="download") {
        return "fadeBuy";
      } else {
        return "showBuy";
      }
    }

    $scope.getDownloadClass = function(type) {
      if(type==="download") {
        return "showDownload";
      } else {
        return "fadeDownload";
      }
    }

    //Download songs that are free
    $scope.downloadSong = function(song) {
      if(song.type == 'download') {
        var filePath = "songs/" + song.mp3;
        window.location.href = filePath;
        console.log(filePath);
        var link = document.createElement('a');
      if (typeof link.download === 'string') {
          link.href = filePath;
          link.setAttribute('download', song.title);

          //simulate click
          link.click();
      }
    } else {
      console.log("If you want this song you have to buy it");
    }

    };
    //

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

                $scope.firstSong = song;
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


              var playing_song = false;



              var audio = new Audio();

              //play button functionallity
              $scope.itemPlayer = function(song) {
                if(song == null) {
                  song = $scope.firstSong;
                } else {
                  $scope.mp3 = song.mp3;
                }
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
                console.log(path);
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
              $scope.initPlayer = function() {
                let volume = document.querySelector("#volume_change");
                volume.addEventListener("change", function(e) {
                  audio.volume = e.currentTarget.value / 100;
                });
              }


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
    $scope.loadSongs = function(){
      $http({
        method: 'GET',
        url: 'fetchPlaylist.php'
      }).then(function(data) {
          $scope.songs = data.data;
      }, function(error) {
        console.log(error, 'cant get data.');
      });
    };

    //shoppingCart
    $scope.buySong = function(song) {
      if($scope.isSessionStarted == true) {
        $scope.addtoCart(song);
        $window.location.reload();
      }
      else {
        $window.location.href = './login.php';
      }
    }




    $scope.carts = [];

    $scope.cartQuantity = 1;

    $scope.fetchCart = function(){
      $http({
        method: 'GET',
        url: 'fetch_cart.php'
      }).then(function(data) {
            $scope.carts = data.data;

      }, function(error) {

      });
    };

    $scope.setQuantity = function() {
      var totalProductQuantity = 0;

      for(var count = 0; count < $scope.carts.length; count++)
      {
         var item = $scope.carts[count];
         totalProductQuantity = totalProductQuantity + (item.product_quantity);
      }
      return totalProductQuantity;
    };

    $scope.setTotals = function() {
        var total = 0;

        for(var count = 0; count < $scope.carts.length; count++)
        {
           var item = $scope.carts[count];
           total = total + (item.product_quantity * item.product_price);
        }
        return total;
    };


    $scope.product;
    $scope.prodQuantity;
    $scope.addtoCart = function(song){

        /*$http({
          method: "POST",
          url: "add_item.php",
          data: product
        }).then(function(data) {
          console.log(data);
            $scope.fetchCart();
        }, function(error) {
          console.log(error, "error");
        });*/
        if($scope.product) {

          for(var i = 0; $scope.carts.length; i++) {
            var item = $scope.carts[i];
            if(song.id = item.product_id) {
              $scope.prodQuantity = item.product_quantity + 1;
            }
          }
        } else {
        $scope.prodQuantity = 1;
      }
        $scope.productID = song.id;
        $scope.productTitle = song.title;
        $scope.productPrice = song.price;
        $scope.product = {'product_id' : $scope.productID,
                          'product_name': $scope.productTitle,
                          'product_price': $scope.productPrice,
                          'product_quantity': $scope.prodQuantity
        };
        $scope.carts.push($scope.product);
        $http({
          method: "POST",
          url: "updateCart.php",
          data: $scope.carts
        }).then(function(data) {
            $scope.fetchCart();
        }, function(error) {
          console.log(error, "error");
        });

      };



      $scope.loadFirst = function(counter) {
        if(counter == 0) {
          $scope.removeItem(0,0);
          $scope.fetchCart();
        }
        console.log(counter);
      };


      $scope.removeItem = function(index, id) {
        console.log(index);
        $scope.carts.splice(index, 1);
        console.log($scope.carts);

        $http({
          method: "POST",
          url: "updateCart.php",
          data: $scope.carts
        }).then(function(data) {
            $scope.fetchCart();
        }, function(error) {
          console.log(error, "error");
        });

    }

    $scope.isEmpty = false;

    $scope.submitCheckout = function(id, userName) {
      $scope.totalToPay = $scope.setTotals();
      $scope.idUserOrder = id;
      $scope.idUsernameOrder = userName;
      if($scope.carts.length>0) {
        $http({
          method: "POST",
          url: "checkoutCart.php",
          data: $scope.dataCheckout = {
            "products": $scope.carts,
            "userData": [{
              "id": $scope.idUserOrder,
              "userName": $scope.idUsernameOrder,
              "totalPayment": $scope.totalToPay
            }]
          }
        }).then(function(data) {
            $scope.carts = [];
            $http({
              method: "POST",
              url: "updateCart.php",
              data: $scope.carts
            }).then(function(data) {
                $scope.fetchCart();
                $window.location.href = "paymentPage.php";
            }, function(error) {
              console.log(error, "error");
            });

        }, function(error) {
          console.log(error, "error");
        });
      } else {
        $scope.isEmpty = true;
        $scope.slideError();
      }
    }

    $scope.orderProductsArray = [];


    $scope.getOrderDetails = function(orderId) {
      $scope.userIdOrder = orderId;
      $http({
        method: "POST",
        url: "orderDetails.php",
        data: $scope.userIdOrder
      }).then(function(data) {
          $scope.orderProductsArray = data.data;
      }, function(error) {
        console.log(error, "error");
      });
    }

    $scope.setOrderTotalPrice = function() {
        var total = 0;

        for(var count = 0; count < $scope.orderProductsArray.length; count++)
        {
           var item = $scope.orderProductsArray[count];
           total = total + (item.product_quantity * item.product_price);
        }
        return total;
    };

    $scope.slideError = function(){
    $('#emptyCart').slideDown('slow');
    $("#emptyCart").css("visibility", "visible");
    setTimeout(function() {
      $scope.isEmpty = false;
      $('#emptyCart').slideUp('slow');
    },3000);
    }



    //loadingOrders
    $scope.loadOrders = function(id){
      $scope.userId = id;
      $http({
        method: 'POST',
        url: 'fetchOrders.php',
        data: $scope.userId
      }).then(function(data) {
          $scope.orders = data.data;
      }, function(error) {
        console.log(error, 'cant get data.');
      });
    };

    $scope.getStyle = function(status) {
    if(status === "Pendent Payment") {
      return "#fff6a3";
    } else if(status === "Completed") {
      return "#a8ffa3";
    } else if(status === "Canceled") {
      return "#ffa3a3";
    } else if(status === "In Progress") {
      return "#d9d9d9";
    } else {
      return "white";
    }
  }


  $scope.getBtnOrderVisibility = function(status) {

  if(status == "Pendent Payment") {
    return "visible";
  } else if(status == "Completed") {
    return "hidden";
  } else if(status == "Canceled") {
    return "visible";
  } else if(status == "In Progress") {
    return "hidden";
  } else {
    return "hidden";
  }
}

$scope.setOrderBtnText = function(status) {
  if(status === "Pendent Payment") {
    return "Pay Now";
    console.log($scope.statusButtonText);
  } else if(status === "Canceled") {
    return "Repeat Order";
  }
}


//messages chat functionality

$scope.initDropChat = function() {
  $scope.dropChat();
  $scope.readMessage();
}

$scope.dropChat = function() {
  $('#dropChat').slideToggle('slow');
  $("#dropChat").css("visibility", "visible");
}

$scope.sendMessage = function() {
  $scope.fromUser = $("#fromUser").val();
  $scope.toUser = 9;
  $scope.message = $("textarea#message").val();
  $http({
    method: 'POST',
    url: 'insertMessage.php',
    data: $scope.messageData = {
      "fromUser": $scope.fromUser,
      "toUser": $scope.toUser,
      "message": $scope.message
    },
    dataType: "text"
  }).then(function(data) {
    console.log(data);
      $("#message").val("");
  }, function(error) {
    console.log(error, 'cant get data.');
  });
}

//This will be fetching the messages from the database each second
var setInterval = function() {
  $scope.fromUser = $("#fromUser").val();
  $scope.toUser = 9;
  $http({
    method: 'POST',
    url: 'realTimeChat.php',
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

  $interval(setInterval, 1000);
  setInterval();

  $scope.newMesages = 0;
  //Messages counter
  $scope.messageCounter = function() {
    $scope.fromUser = $("#fromUser").val();
    $scope.toUser = 9;
    $http({
      method: 'POST',
      url: 'messagesCounter.php',
      data:  $scope.messageDataCount = {
        "fromUser": $scope.fromUser,
        "toUser": $scope.toUser
      },
    }).then(function(data) {
        $scope.newMesages = data.data;
        //$scope.newMessages = data.data;
    }, function(error) {
      console.log(error, 'cant get data.');
    });
  }



$scope.readMessage = function() {
  $scope.fromUser = $("#fromUser").val();
  $scope.toUser = 9;
  $http({
    method: 'POST',
    url: 'setReaded.php',
    data:  $scope.messageDataCount = {
      "fromUser": $scope.fromUser,
      "toUser": $scope.toUser
    },
  }).then(function(data) {
      console.log(data.data);
      $scope.newMesages = 0;
  }, function(error) {
    console.log(error, 'cant get data.');
  });
}

//Paypal payment

paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: $scope.setOrderTotalPrice()
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        alert('Transaction completed by ' + details.payer.name.given_name);
        console.log(details);
        //create session key success to only allow the access to this page to users that have paid
        $scope.sessionSuccess();
        $window.location.href = "successPayment.php";
      });
    },
    onCancel:function(data) {
      alert('Transaction canceled,try again' + details.payer.name.given_name);
    }
  }).render('#paypal-button-container');

  $scope.sessionSuccess = function() {
    $scope.success = "paymentSuccesful";
    $http({
      method: 'POST',
      url: 'setKeySuccess.php',
      data: $scope.success
    }).then(function(data) {
        console.log(data);
    }, function(error) {
      console.log(error, 'cant get data.');
    });
  }


  //load the songs from the order in the success page

  $scope.successBuySongs = [];

  $scope.loadBuySongsOnSuccess = function(orderId) {
    $scope.userIdOrder = orderId;
    $http({
      method: "POST",
      url: "fetchBuySongs.php",
      data: $scope.userIdOrder
    }).then(function(data) {
        $scope.successBuySongs = data.data;
    }, function(error) {
      console.log(error, "error");
    });
  }

  $scope.downloadBuySong = function(song) {
      var filePath = "songs/" + song.mp3;
      window.location.href = filePath;
      console.log(filePath);
      var link = document.createElement('a');
    if (typeof link.download === 'string') {
        link.href = filePath;
        link.setAttribute('download', song.title);

        //simulate click
        link.click();
    }

  }

  $scope.toggleError = function() {
    $('.registerError').slideDown('slow');
    $(".registerError").css("visibility", "visible");
    setTimeout(function() {
      $('.registerError').slideUp('slow');
      $(".registerError").css("visibility", "hidden");
    },3000);
  }

  $scope.checkErrorMsg = function(msg) {
    if(msg === "user already exsist") {
      $scope.toggleError();
    } 
  }


});





//format timestamp to date
app.filter('timestampToISO', function() {
    return function(input) {
        input = new Date(input).toISOString();
        return input;
    };
});
