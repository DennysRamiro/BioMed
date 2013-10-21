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
	$('#menu_modulo_fecha_cambio').click(function(){
		$(location).attr('href', 'gral_man_usr.php');
	});
	$('#menu_modulo_mantUsuarios_alta').click(function(){
		$(location).attr('href', 'gral_man_usr.php');
	});


/*$("#fec_nac").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});

$("#bus").autocomplete({
      source:"gral_man_usr.php", 
      minLength:'4'
   });
*/
//alert(getUrlVars()['msg']);
	var msg = getUrlVars()['msg'];
	mostrarMensajeAlerta(msg);

	$('#usuario_buscar').keyup(autoLlenado);

});



function mostrarMensajeAlerta(msg){
	
	if(msg == 3){
		$( "#dialog-confirm" ).attr('title', 'Mensaje');
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
		});
	}
	if(msg == 0){
		$( "#dialog-confirm" ).attr('title', 'Advertencia');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="img/checkmark_48x48.png" align="absmiddle">No se pudo realizar</p>');
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
		});
	}
	if(msg == 2){
		$( "#dialog-confirm" ).attr('title', 'Advertencia');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="img/checkmark_48x48.png" align="absmiddle">La modificacion se realizo exitosamente</p>');
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
		});
	}
	if(msg == 4){
		$( "#dialog-confirm" ).attr('title', 'Advertencia');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="img/checkmark_48x48.png" align="absmiddle">El Alta del nuevo usuario se realizo exitosamente</p>');
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
		});
	}

	 
}


function buscarUsuario(){
	//alert('que estas buscando...'+$('#producto_buscar').val());
	//console.log('selecciondo');
	//console.log(ui);
	$.ajax({
		url:'usr_buscar.php?accion=list&usuario='+$('#usuario_buscar').val(),
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_usuario').empty();
			$('#tabla_datos_usuario').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			//console.log(res);

			$('#tabla_datos_usuario').empty();
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>CI</th><th>LOGIN</th><th>NOMBRES</th><th>APELLIDO PATERNO</th><th>APELLIDO MATERNO</th><th>DIRECCION</th><th>TELEFONO</th><th>CELULAR</th><th>EMAIL</th><th>CARGO</th><th>ACCIONES</th></tr>';
			$.each(res, function(index, value){
				tabla_datos = tabla_datos+'<tr><td>'+res.GRAL_USR_CI+'</td><td>'+res.GRAL_USR_LOGIN+'</td><td>'+res.GRAL_USR_NOMBRES+'</td><td>'+res.GRAL_USR_AP_PATERNO+'</td><td>'+res.GRAL_USR_AP_MATERNO+'</td><td>'+res.GRAL_USR_DIRECCION+'</td><td>'+res.GRAL_USR_TELEFONO+'</td><td>'+res.GRAL_USR_CELULAR+'</td><td>'+res.GRAL_USR_EMAIL+'</td><td>'+res.GRAL_PAR_PRO_DESC+'</td>';
				tabla_datos = tabla_datos +'<td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:3px;"><a href="gral_man_usr_cm.php?ci='+res.GRAL_USR_CI+'" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Modificar</a></div><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px; cursor:pointer;"><a onclick="mostrarDialogo('+res.GRAL_USR_CI+')" ><img src="img/delete user_32x32.png" align="absmiddle"><br> Dar de Baja</a></div><td></tr>';
			});
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_usuario').append(tabla_datos);																																																																		//<td><a href="alm_detallar_proveedor.php?id_proveedor=<?php echo $linea['alm_prov_id'];?>" ><img src="img/notepad_48x48.png" align="absmiddle"><br> Detallar</a> </td>																															
		}
	});
}

/**
 Este es la funcion que gestiona los eventos de teclado
 */

function autoLlenado(){
	$.ajax({
		url:'usr_buscar.php?accion=buscar&usuario='+$('#usuario_buscar').val(),
		dataType:'json',
		type:'GET',
		beforeSend:function(){
		},
		success:function(res){

			$('#usuario_buscar').autocomplete({
				source: res,
				select:usuarioSeleccionado
				
			});
																																																																//<td><a href="alm_detallar_proveedor.php?id_proveedor=<?php echo $linea['alm_prov_id'];?>" ><img src="img/notepad_48x48.png" align="absmiddle"><br> Detallar</a> </td>																															
		}
	});
}

function usuarioSeleccionado(evt, ui){
	console.log('selecciondo');
	console.log(ui);
	$.ajax({
		url:'usr_buscar.php?accion=seleccionado&ci='+ui.item.id,
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_usuario').empty();
			$('#tabla_datos_usuario').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success: function(res){
			//console.log(res.GRAL_USR_CI);
			
			$('#tabla_datos_usuario').empty();
			var tabla_datos = '<table class="table_usuario">';
			     tabla_datos = tabla_datos+'<tr><th>CI</th><th>LOGIN</th><th>NOMBRES</th><th>APELLIDO PATERNO</th><th>APELLIDO MATERNO</th><th>DIRECCION</th><th>TELEFONO</th><th>CELULAR</th><th>EMAIL</th><th>CARGO</th><th>ACCIONES</th></tr>';
			//$.each(res, function(index, value){
				tabla_datos = tabla_datos+'<tr><td>'+res.GRAL_USR_CI+'</td><td>'+res.GRAL_USR_LOGIN+'</td><td>'+res.GRAL_USR_NOMBRES+'</td><td>'+res.GRAL_USR_AP_PATERNO+'</td><td>'+res.GRAL_USR_AP_MATERNO+'</td><td>'+res.GRAL_USR_DIRECCION+'</td><td>'+res.GRAL_USR_TELEFONO+'</td><td>'+res.GRAL_USR_CELULAR+'</td><td>'+res.GRAL_USR_EMAIL+'</td><td>'+res.GRAL_PAR_PRO_DESC+'</td>';

				tabla_datos = tabla_datos +'<td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:3px;"><a href="gral_man_usr_cm.php?ci='+res.GRAL_USR_CI+'" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Modificar</a></div><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px; cursor:pointer;"><a onclick="mostrarDialogo(\''+res.GRAL_USR_CI+'\')" ><img src="img/delete user_32x32.png" align="absmiddle"><br> Dar de Baja</a></div></td></tr>';

			//});
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_usuario').append(tabla_datos);	

		}

	});
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

function mostrarDialogo(ci){
	


	$( "#dialog-confirm" ).attr('title', 'Mensaje');
	$("#dialog-confirm").empty();
	$("#dialog-confirm").append('<p>Esta quiriendo dar de baja al Usuario con este CI: '+ci+'?</p>');
	$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:250,
			width:400,
			modal: true,
			buttons: {
				"Confirmar": function() {	
					//$( this ).dialog( "close" );
					$.ajax({
						url:"usr_eliminar.php?tu=eliminaUser&ci="+ci,
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