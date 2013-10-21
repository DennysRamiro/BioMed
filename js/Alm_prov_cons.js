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
// Este es el autocomplete
	$("#proveedor_buscar").keyup(function(){
		//alert("ingresa");
		//console.log('letra' + $("#producto_buscar").val());
		$.ajax({
			url:"alm_buscar_prov.php?accion=buscar&buscar="+$('#proveedor_buscar').val(),
			dataType:'json',
			type:'GET',
			beforeSend:function(){

			},
			success:function(response){
		           $("#proveedor_buscar").autocomplete({
		        	source: response, /* este es el script que realiza la busqueda */
		        //	minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
		        	select: proveedorSeleccionado /* esta es la rutina que extrae la informacion del producto seleccionado */
		        	//focus: proveedorFoco /* esta es la rutina que muestra del producto marcado */
		    	});
				//console.log(response);

			}
		});
		
	});
	

});
 	function proveedorSeleccionado(evt,ui){
 		//alert("sELECCIONAR");
	$('#proveedor_buscar').val(ui.item.value);
	$.ajax({
		url:'alm_buscar_prov.php?accion=selected&prov='+ui.item.value+'&id='+ui.item.id,
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_proveedores').empty();
			$('#tabla_datos_proveedores').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			$('#tabla_datos_proveedores').empty();
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>Nombre</th><th>Tipo</th><th>Codigo Externo</th><th>Codigo Interno</th><th>Pa&iacute;s</th><th>Ciudad</th><th>Direcci&oacute;n</th><th>T&eacute;lefono Fijo</th><th>Tel&eacute;fono Celular</th><th>Estado</th><th>Acciones</th></tr>';
			tabla_datos = tabla_datos+'<tr><td>'+res.alm_prov_nombre+'</td><td>'+res.alm_prov_tipo+'<input type="hidden" value="'+res.alm_prov_id_tipo+'" id="id_tipo_proveedor">'+'</td><td>'+res.alm_prov_codigo_ext+'<input type="hidden" value="'+res.alm_prov_continente+'" id="id_continente_proveedor">'+'</td><td>'+res.alm_prov_codigo_int+'</td><td>'+res.alm_prov_pais+'</td><td>'+res.alm_prov_ciudad+'</td><td>'+res.alm_prov_direccion+'</td><td>'+res.alm_prov_telefono+'<input type="hidden" value="'+res.alm_prov_moneda+'" id="id_moneda_proveedor">'+'</td><td>'+res.alm_prov_celular+'</td><td>'+res.alm_prov_estado+'<input type="hidden" value="'+res.alm_prov_id_estado+'" id="id_estado_proveedor">'+'</td><td><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px;"><a href="alm_detallar_proveedor.php?id_proveedor='+res.alm_prov_id+'" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo('+res.alm_prov_id+')"><img src="img/provider_baja_32x32.png"><br> Dar de Baja</a></div> </td></tr>';
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_proveedores').append(tabla_datos);																																												
		}
	});

	 evt.preventDefault();	 
}

	function buscarProveedor(){
	//alert('que estas buscando...'+$('#producto_buscar').val());
	$.ajax({
		url:'alm_buscar_prov.php?accion=list&prov='+$('#proveedor_buscar').val(),
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_proveedores').empty();
			$('#tabla_datos_proveedores').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			$('#tabla_datos_proveedores').empty();
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>Nombre</th><th>Tipo</th><th>Codigo Externo</th><th>Codigo Interno</th><th>Pa&iacute;s</th><th>Ciudad</th><th>Direcci&oacute;n</th><th>T&eacute;lefono Fijo</th><th>Tel&eacute;fono Celular</th><th>Estado</th><th>Acciones</th></tr>';
			$.each(res, function(index, value){
				tabla_datos = tabla_datos+'<tr><td>'+value.alm_prov_nombre+'</td><td>'+value.alm_prov_tipo+'<input type="hidden" value="'+value.alm_prov_id_tipo+'" id="id_tipo_proveedor">'+'</td><td>'+value.alm_prov_codigo_ext+'<input type="hidden" value="'+value.alm_prov_continente+'" id="id_continente_proveedor">'+'</td><td>'+value.alm_prov_codigo_int+'</td><td>'+value.alm_prov_pais+'</td><td>'+value.alm_prov_ciudad+'</td><td>'+value.alm_prov_direccion+'</td><td>'+value.alm_prov_telefono+'<input type="hidden" value="'+value.alm_prov_moneda+'" id="id_moneda_proveedor">'+'</td><td>'+value.alm_prov_celular+'</td><td>'+value.alm_prov_estado+'<input type="hidden" value="'+value.alm_prov_id_estado+'" id="id_estado_proveedor">'+'</td><td><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px;"><a href="alm_detallar_proveedor.php?id_proveedor='+value.alm_prov_id+'"><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo('+value.alm_prov_id+')"><img src="img/provider_baja_32x32.png"><br> Dar de Baja</a></div> </td></tr>';
			});
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_proveedores').append(tabla_datos);																																																																		//<td><a href="alm_detallar_proveedor.php?id_proveedor=<?php echo $linea['alm_prov_id'];?>" ><img src="img/notepad_48x48.png" align="absmiddle"><br> Detallar</a> </td>																															
		}
	});
}


function mostrarDialogo(idProveedor){
	$("#dialog-confirm").attr('title', 'Advertencia');
	$("#dialog-confirm").empty();
	$("#dialog-confirm").append('<p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja el proveedor?</p>');
	$("#dialog-confirm" ).dialog({
			resizable: false,
			height:250,
			width:400,
			modal: true,
			buttons: {
				"Confirmar": function() {
					$.ajax({
						url:'alm_eliminar_prov.php?accion=eliminarProv&idProveedor='+idProveedor,
						dataType:'json',
						type:'GET',
						success:function(res){
							if(res.completo == true){
								$(location).attr('href', 'alm_proveedor_mod_cons.php?menu=1&msg=3');
							}
						}
					});
					$( this ).dialog( "close" );
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
	});
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
