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
	$('#menu_modulo_almacen_proy').click(function(){
		$(location).attr('href', 'alm_proyecto.php');
	});
// Este es el autocomplete
	$("#proyecto_buscar").keyup(function(){
		//alert("ingresa");
		//console.log('letra' + $("#producto_buscar").val());
		$.ajax({
			url:"alm_buscar_proy.php?accion=buscar&buscar="+$('#proyecto_buscar').val(),
			dataType:'json',
			type:'GET',
			beforeSend:function(){

			},
			success:function(response){
		           $("#proyecto_buscar").autocomplete({
		        	source: response, /* este es el script que realiza la busqueda */
		        //	minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
		        	select: proyectoSeleccionado /* esta es la rutina que extrae la informacion del producto seleccionado */
		        	//focus: proveedorFoco /* esta es la rutina que muestra del producto marcado */
		    	});
				//console.log(response);

			}
		});
		
	});
	

});
 	function proyectoSeleccionado(evt,ui){
 		//alert("sELECCIONAR");
	$('#proyecto_buscar').val(ui.item.value);
	$.ajax({
		url:'alm_buscar_proy.php?accion=selected&proy='+ui.item.value+'&id='+ui.item.id,
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_proyectos').empty();
			$('#tabla_datos_proyectos').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			$('#tabla_datos_proyectos').empty();
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>Nombre Proyecto</th><th>C&oacute;digo Proyecto</th><th>Tipo</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Estado</th><th>Acciones</th></tr>';
			tabla_datos = tabla_datos+'<tr><td>'+res.alm_proy_nombre+'</td><td>'+res.alm_proy_cod+'</td><td>'+res.alm_proy_tipo+'<input type="hidden" value="'+res.alm_proy_id_tipo+'" id="id_tipo_proyecto">'+'</td><td>'+res.alm_proy_fecha_inicio+'</td><td>'+res.alm_proy_fecha_fin+'</td><td>'+res.alm_proy_estado+'</td><td><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px;"><a href="alm_detallar_proyecto.php?id_proyecto='+res.alm_proy_id+'" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo('+res.alm_proy_id+')"><img src="img/proyecto_baja_32x32.png"><br> Dar de Baja</a></div> </td></tr>';
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_proyectos').append(tabla_datos);																																												
		}
	});

	 evt.preventDefault();	 
}

	function buscarProyecto(){
	//alert('que estas buscando...'+$('#producto_buscar').val());
	$.ajax({
		url:'alm_buscar_proy.php?accion=list&proy='+$('#proyecto_buscar').val(),
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_proyectos').empty();
			$('#tabla_datos_proyectos').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			$('#tabla_datos_proyectos').empty();
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>Nombre Proyecto</th><th>C&oacute;digo Proyecto</th><th>Tipo</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Estado</th><th>Acciones</th></tr>';
			$.each(res, function(index, value){
				tabla_datos = tabla_datos+'<tr><td>'+value.alm_proy_nombre+'</td><td>'+value.alm_proy_cod+'</td><td>'+value.alm_proy_tipo+'<input type="hidden" value="'+value.alm_proy_id_tipo+'" id="id_tipo_proyecto">'+'</td><td>'+value.alm_proy_fecha_inicio+'</td><td>'+value.alm_proy_fecha_fin+'</td><td>'+value.alm_proy_estado+'</td><td><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px;"><a href="alm_detallar_proyecto.php?id_proyecto='+value.alm_proy_id+'"><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo('+value.alm_proy_id+')"><img src="img/proyecto_baja_32x32.png"><br> Dar de Baja</a></div> </td></tr>';
			});
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_proyectos').append(tabla_datos);																																																																		//<td><a href="alm_detallar_proveedor.php?id_proveedor=<?php echo $linea['alm_prov_id'];?>" ><img src="img/notepad_48x48.png" align="absmiddle"><br> Detallar</a> </td>																															
		}
	});
}


function mostrarDialogo(idProyecto){
	$("#dialog-confirm").attr('title', 'Advertencia');
	$("#dialog-confirm").empty();
	$("#dialog-confirm").append('<p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja el proyecto?</p>');
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
