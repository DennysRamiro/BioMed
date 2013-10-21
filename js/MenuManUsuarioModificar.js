var banderColapsable = 0;
$(document).on('ready', function(){
	$('#btn_colapsable').click(function(){
		if(banderColapsable == 0){
			banderColapsable = 1;
			$(this).animate({
				"height":"-50px"
			}, 500);
			$('#btn_colapsable').animate({
				"margin-left":"180px"

			});
		}else{
			banderColapsable = 0;
			$(this).animate({
				"height":"50px"
			}, 500);
			$('#btn_colapsable').animate({
				"margin-left":"-5px",
				"padding-left":"5px",
				"height":"32px",
				"color":"#000"
			});
		}
		
	});

    $('#menu_modulo').click(function(){
		$(location).attr('href','menu_s.php');
	});
	$('#menu_modulo_general').click(function(){
		$(location).attr('href', 'modulo.php?modulo=1000');
	});
	$('#menu_mant_usuario').click(function(){
		$(location).attr('href', 'gral_man_usr.php');
	});

		//var util = new Utilitarios();
//	util.validarCampo('nro_fac_des','error_nro_fac_des', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
//	util.validarCampo('nro_fac_has','error_nro_fac_has', 'El campo <b>N&uacute;mero Factura Hasta</b> no puede estar vacio.');
	//util.validarCampo('log', 'error_log', 'El campo <b>Login</b> no puede estar vacio.');
	//util.validarCampo('ci','error_ci', 'El campo <b>Documento Identidad</b> no puede estar vacio.');
	//util.validarCampo('nombres', 'error_nombres', 'El campo <b>Nombres</b> no puede estar vacio.');
	//util.validarCampo('ap_pater','error_ap_pater', 'El campo <b>Apellido Paterno</b> no puede estar vacio.');
	//util.validarCampo('ap_mater','error_ap_mater', 'El campo <b>Apellido Materno</b> no puede estar vacio.');

    var msg = getUrlVars()['msg'];
    //alert('alam');
	mostrarMensajeAlerta(msg);

});


function mostrarDialogo(){
	//alert("producto");
	 $( "#dialog-confirm" ).dialog({
			resizable: false,
			height:250,
			width:400,
			modal: true,
			buttons: {
				"Confirmar": function() {	
					//$( this ).dialog( "close" );
					$.ajax({
						url:'usr_eliminar.php?tu=eliminaUser&ci='+$('#ci').val(),
						dataType:'json',
						type:'GET',
						success:function(res){
							if(res.completo == true){
								$(location).attr('href', 'gral_man_usr_c.php?msg=3');
							}
						}
					});
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
	});
}

function mostrarMensajeAlerta(msg){
	
	if(msg == 3){
		
		/*$( "#dialog-confirm" ).attr('title', 'Mensaje');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="img/checkmark_48x48.png" align="absmiddle">Se dio de baja al usuario correctamente</p>');
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:250,
			width:400,
			modal: true,
			buttons: {
				"Aceptar": function() {
					$( this ).dialog( "close" );
				}
			}
		});*/
		alert('estas');
	}

	 
}
/**
 * Metodo que permite leer los datos desde url
 */
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
