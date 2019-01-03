$( document ).ready(function() {
  console.log( "ready!" );

    $('#click').on('click', function() {
      console.log('me clickearon');

      $.ajax({
        method: 'POST',
        url: "http://localhost/invitation_manager/index.php/Main_controller/insert_guest",
        data: {name:'chuchin'},
      }).done(function(data) {
        console.log(jQuery.parseJSON(data).name);
        $('.prueba-dos').animate({
          html: jQuery.parseJSON(data).name,
        }, 500, 'linear', function(){
          $('.prueba-dos').html(jQuery.parseJSON(data).name);
        });

      });
      /*$.ajax({
        method: 'GET',
        url: "http://localhost/invitation_manager/index.php/Main_controller/get_guest",
      }).done(function(data) {
        console.log(data);
      });*/
    });
});
