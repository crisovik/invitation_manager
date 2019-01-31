$( document ).ready(function() {

  $('#addCompanion').on('click', function() {
    $('#companions').append('<div class="row companionRow"><div class="col-md-1 offset-md-2"><p>Acompañante:</p></div><div class="col-md-4"><input type="text" id="companion" name="companion[]" class="name-text"></div><button type="button" class="btn btn-link" id="deleteCompanion"><i class="fas fa-minus-circle"></i></button></div>');
  });

  $(document).on('click', '#deleteCompanion', function() {
    $(this).parent().remove();
  });

  $('#submitNewPassword').on('click', function(e){
    e.preventDefault();
    $.ajax({
        method: 'POST',
        url: "http://localhost/invitation_manager/index.php/Main_controller/set_password",
        data: $('#setPasswordForm').serialize(),
      }).success(function(data) {
        console.log('chumi');
        location.reload();
      });
  });

  $('#loginButton').on('click', function(e){
    e.preventDefault();
    $.ajax({
        method: 'POST',
        //url: "http://localhost/invitation_manager/index.php/Main_controller/login_guest",
        url: base_url + "index.php/Main_controller/login_guest",
        data: $('#loginForm').serialize(),
      }).success(function(data) {
        if(data==1) {
          location.reload();
          window.location = base_url + 'invitacion/' + $('#link-guest').val();
        }
        else {
          $('#password-input').val('');
          $('.error-message').css('display', 'block');
        }
      });
  });

  $('#submitGuest').on('click', function(e) {
    e.preventDefault();
    $.ajax({
        method: 'POST',
        url: "http://localhost/invitation_manager/index.php/Main_controller/insert_guest",
        data: $('#guestForm').serialize(),
      }).success(function(data) {
        swal({
          text: "Se agregó el invitado",
          icon: "success",
          buttons: false,
          timer: 1500,
        });
      });
    $('#guest').val('');
    $('.companionRow').remove();
  });

  $('#select_all').change(function() {
    var total = $('#totalGuests').text();
    var status = this.checked;

    $('.checkbox').each(function() {
      this.checked = status;
    });

    var confirmed = $('.checkbox:checked').length;
    if(confirmed > 0){
      $('#submitConfirmation').val('Confirmar ' + confirmed + '/' + total);
    }else {
      $('#submitConfirmation').val('No podremos asistir');
    }
  });

  $('.checkbox').change(function() {
    var total = $('#totalGuests').text();
    var confirmed = $('.checkbox:checked').length;

    if(this.checked == false){
      $('#select_all')[0].checked = false;
    }

    if(confirmed == $('.checkbox').length){
      $('#select_all')[0].checked = true;
    }

    if(confirmed > 0){
      if(total > 1)
        $('#submitConfirmation').val('Confirmar ' + confirmed + '/' + total);
      else
        $('#submitConfirmation').val('Confirmar');
    }else {
      if(total > 1)
        $('#submitConfirmation').val('No podremos asistir');
      else
        $('#submitConfirmation').val('No podré asistir');
    }
  });

  $('#submitConfirmation').on('click', function(e) {

    e.preventDefault();
    var confirmations = new Array();

    $('.checkbox').each(function() {
      if(this.checked == true)
        confirmations.push([$(this).attr('name'), 1]);
      else
        confirmations.push([$(this).attr('name'), 0]);
    });

    $.ajax({
        method: 'POST',
        url: "http://localhost/invitation_manager/index.php/Main_controller/set_confirmations",
        data: {'confirmations': confirmations},
      }).success(function(data) {
        var text = "";
        var icon = "";
        if($('.checkbox:checked').length > 0){
          icon = "success";
          if($('.checkbox:checked').length == 1)
            text = "Te esperamos!";
          else
            text = "Los esperamos!";
        }
        else{
          if($('.checkbox').length == 1)
            text = 'Lamentamos que no puedas acompañarnos';
          else
            text = "Lamentamos que no puedan acompañarnos";
        }
        swal({
          text: text,
          icon: icon,
          buttons: false,
          timer: 1500,
        });
      });
  });


    /*$('#click').on('click', function() {
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
      $.ajax({
        method: 'GET',
        url: "http://localhost/invitation_manager/index.php/Main_controller/get_guest",
      }).done(function(data) {
        console.log(data);
      });
    });*/
});
