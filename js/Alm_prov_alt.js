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
	$('#menu_modulo_almacen').click(function(){
		$(location).attr('href', 'modulo.php?modulo=20000');
	});
	$('#menu_modulo_almacen_prov').click(function(){
		$(location).attr('href', 'alm_proveedor.php');
	});
	$('#menu_modulo_almacen_prov_cons').click(function(){
		$(location).attr('href', 'alm_proveedor_mod_cons.php?menu=1');
	});


	$('#pais').change(function(){
		//alert($('#pais').val());
		$.ajax({
			url:'verificar_combo.php?codigo='+$('#pais').val(),
			dataType:'json',
			type:'GET',
			success:function(res){
				//console.log(res);
				$('#ciudad').empty();
				$.each(res, function(index, value){
 				        console.log(value.ID);
 				        console.log(value.Name);                                                                                                                                                                                    			     
        	  			$('#ciudad').append('<option value="'+value.ID+'">'+value.Name+'</option>');
        	    });
				//$('#ciudad option[value="'+res.ID+'"]').attr("selected","selected");
			}
		});
	});

	//$('#error_nombre_producto').hide();
	//$.getScript('js/Utilitarios.js');
	var util = new Utilitarios();
	// Esta es la accion que verifica que nombre producto no estee vacio
	util.validarCampo('nombres', 'error_nombres', 'El campo <b>Nombre de proveedor</b> no puede estar vacio.');
	util.validarCampo('cod_ext', 'error_cod_ext', 'El campo <b>Codigo Externo de proveedor </b> no puede estar vacio.');
	util.validarCampo('cod_int','error_cod_int', 'El campo <b>Codigo Externo de proveedor</b> no puede estar vacio.');
	util.validarCampo('direc','error_direc', 'El campo <b>Direccion</b> no puede estar vacio.');
	util.validarCampo('fono','error_fono', 'El campo <b>Telefono Fijo</b> no puede estar vacio.');
	util.validarCampo('celu','error_celu', 'El campo <b>Celular</b> no puede estar vacio.');
	util.validarCampo('email','error_email', 'El campo <b>Email</b> no puede estar vacio.');
	util.validarCampo('contacto','error_contacto', 'El campo <b>Contacto</b> no puede estar vacio.');
	
});

function mostrarDialogo(){
	//alert('Estas aqui');
	 $( "#dialog-confirm" ).dialog({
			resizable: false,
			height:250,
			width:400,
			modal: true,
			buttons: {
				"Confirmar": function() {
					//$( this ).dialog( "close" );
					$.ajax({
						url:'alm_eliminar_prov.php?accion=eliminarProv&idProveedor='+$('#id_proveedor_almacen').val(),
						dataType:'json',
						type:'GET',
						success:function(res){
							if(res.completo == true){
								$(location).attr('href', 'alm_proveedor_mod_cons.php?menu=1&msg=2');
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

function regresarLista(){
	$(location).attr('href', 'alm_proveedor_mod_cons.php?menu=1');
}

/**
 * Esta es la funcion que permite mostrar el mensaje de error
 */
function mostrarMensajeAlerta(msg){
	if(msg == 0){
		$( "#dialog-confirm" ).attr('title', 'Advertencia');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="img/alert_48x48.png" align="absmiddle">No se pudo relizar la tarea</p>');
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
	}else if(msg == 1){
		$( "#dialog-confirm" ).attr('title', 'Mensaje');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="img/checkmark_48x48.png" align="absmiddle">Se inserto correctamente</p>');
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
	}else if(msg == 2){
		$( "#dialog-confirm" ).attr('title', 'Mensaje');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="img/checkmark_48x48.png" align="absmiddle">Se actualizo los datos correctamente</p>');
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
	}else if(msg == 3){
		$( "#dialog-confirm" ).attr('title', 'Mensaje');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="img/checkmark_48x48.png" align="absmiddle">Se dio de baja al producto correctamente</p>');
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
