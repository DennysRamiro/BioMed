$(document).on("ready", function (){
    // Se oculta el div del error de login para que pueda mostrarse con fadeIn
    $('#error_login2').hide();
    $('#erro_formulario_login').hide();
    $('#txt_login').blur(function(){
        verificarVacioLoginBlur();
    });
    // Se oculta el div error password para qeu se pueda mostrar con fadeIn despues
    $('#error_password').hide();
    $('#txt_password').blur(function(){
        verificarVacioPasswordBlur();
    });
    //Se utiliza el meto submit de jquery para poder gestionar los formaulario
    $('#formulario_login').submit(enviarFormaularioLogin);
});
function verificarVacioLoginBlur(){
  if($('#txt_login').val() ==''){
    $('#error_login2').empty();
    $('#error_login2').append('<p> <img src="img/alert_32x32.png" align="absmiddle">El campo <b>nombre</b> no puede estar vacio!</p>').hide().fadeIn(1000);
  }else{
    $('#error_login2').fadeOut(1000);
  }
}
function verificarVacioPasswordBlur(){
  if($('#txt_password').val() ==''){
    $('#error_password').empty();
    $('#error_password').append('<p> <img src="img/alert_32x32.png" align="absmiddle">El campo <b>clave</b> no puede estar vacio!</p>').hide().fadeIn(1000);
  }else{
    $('#error_password').fadeOut(1000);
  } 
}
function enviarFormaularioLogin(){
  $('#error_formulario_login').empty();
  if($('#txt_login').val() ==''){
    $('#error_login2').empty();
    $('#error_login2').append('<p> <img src="img/alert_32x32.png" align="absmiddle">El campo <b>nombre</b> no puede estar vacio!</p>').hide().fadeIn(1000);
  }else if($('#txt_password').val() ==''){
    $('#error_password').empty();
    $('#error_password').append('<p> <img src="img/alert_32x32.png" align="absmiddle">El campo <b>clave</b> no puede estar vacio!</p>').hide().fadeIn(1000);
  }else{
    //alert("valido los campos");
    var formData = new FormData();
    formData.append('txt_login', $('#txt_login').val());
    formData.append('txt_password', $('#txt_password').val());
    $.ajax({
      url:'valida_psw_tb.php',
      type:'POST',
      data: formData,
      processData:false,
      contentType:false,
      cache: false,
      beforeSend:function(data){
        if(data && data.overrideMimeType) {
                data.overrideMimeType("application/json;charset=UTF-8");
        }
        $('#error_formulario_login').empty();
        $('#error_formulario_login').html('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(1000);
      },
      success: function(data){
        if(data.completo==true){
          $('#error_formulario_login').empty();
          $('#error_formulario_login').html('<div id="error_login2"> <img src="img/checkmark_32x32.png" align="absmiddle">Su cuenta es correcta estamos redirigiendo a su pagina de inicio.</div>').hide().fadeIn(1000);
          $('#error_formulario_login').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(1000);  
          $(location).attr('href', 'menu_s.php');
        }else if(data.completo==false){
          $('#error_formulario_login').empty();
          $('#error_formulario_login').html('<div id="error_login2"> <img src="img/close_32x32.png" align="absmiddle">Su cuenta no existe en el sistema.</div>').hide().fadeIn(1000); 
        }
      },
      error: function(data){
        $('#error_formulario_login').empty();
        $('#error_formulario_login').html('<div id="error_login2"> <img src="img/alert_32x32.png" align="absmiddle">A ocurrido un error mientras se verificaba su cuenta por favor vuelva a intentarlo.</div>').hide().fadeIn(1000);
      }
    });
  }

  return false;
}