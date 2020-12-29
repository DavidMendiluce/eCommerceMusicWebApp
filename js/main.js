jQuery(document).on('submit','#formlg', function(event) {
  event.preventDefault();

  jQuery.ajax({
    url: 'loginprocess.php',
    type: 'POST',
    dataType: 'json',
    data: $(this).serialize(),
    beforeSend: function(){
      $('#btnlg').val('Validating...');
    }
  })
  .done(function(response) {
    console.log(response);
    if(!response.error && response.type == 'admin'){

        location.href = 'Admin/';
      }else if(!response.error && response.type == 'user') {

        location.href = 'index.php';
      } else {
      $('.error').slideDown('slow');
      $(".error").css("visibility", "visible");
      setTimeout(function() {
        $('.error').slideUp('slow');
      },3000);
    }
  })
  .fail(function(resp) {
    console.log(resp.responseText);
  })
  .always(function() {
    console.log("complete");
  });
});


$(document).ready(function() {
$('#config').on('click', () => {
$("#configMenu").toggle(400);
});
});
//arrow animation
$( ".tab-arrow" ).click(function() {
    if (  $( this ).css( "transform" ) == 'none' ){
        $(this).css("transform","rotate(60deg)");
        order = 'mariano'
    } else {
        $(this).css("transform","" );
    }
});
