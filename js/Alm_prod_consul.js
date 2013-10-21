var banderColapsable = 0;
$(document).on('ready', function(){
	$( "#fecha_vencimiento" ).datepicker({
		changeMonth: true,
		changeYear: true
	});
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
				"color":"#FFF"
			});
		}
		
	});

	$('#menu_modulo').click(function(){
		$(location).attr('href','menu_s.php');
	});
	$('#menu_modulo_general_alamacen').click(function(){
		$(location).attr('href', 'modulo.php?modulo=20000')
	});
	$('#menu_modulo_mante_productos').click(function(){
		$(location).attr('href', 'alm_producto.php')
	});
	$('#menu_consul_prod').click(function(){
		$(location).attr('href', 'alm_consulta_prod.php')
	});
	

	// Este es el autocomplete
	$("#producto_buscar").keyup(function(){
		//alert($('#producto_buscar').val());
		$.ajax({
			url:"alm_buscar_prod.php?accion=buscar&buscar="+$('#producto_buscar').val(),
			dataType:'json',
			type:'GET',
			beforeSend:function(){

			},
			success:function(response){
				//alert(response);
				$("#producto_buscar").autocomplete({
		        	source: response, /* este es el script que realiza la busqueda */
		        //	minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
		        	select: productoSeleccionado, /* esta es la rutina que extrae la informacion del producto seleccionado */
		        	focus: productoFoco /* esta es la rutina que muestra del producto marcado */
		    	});
			}
		});
		
	});
	var msg = getUrlVars()['msg'];
	mostrarMensajeAlerta(msg);
	
});
/**
 * Metodo cuando el producto ya ha sido seleccionado
 */
function productoSeleccionado(evt,ui){
	$('#producto_buscar').val(ui.item.value);
	$.ajax({
		url:'alm_buscar_prod.php?accion=selected&prod='+ui.item.value+'&id='+ui.item.id,
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_productos').empty();
			$('#tabla_datos_productos').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			$('#tabla_datos_productos').empty();//borra el div de la tabla
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>SERIE</th><th>NOMBRE</th><th>TIPO</th><th>MARCA</th><th>CANTIDAD</th><th>PRECIO COMPRA</th><th>PRECIO VENTA</th><th>SUCURSAL ORG.</th><th>ESTADO</th><th>ACCIONES</th></tr>';
			tabla_datos = tabla_datos+'<tr><td>'+res.alm_prod_serie+'</td><td>'+res.alm_prod_nombre+'</td><td>'+res.alm_prod_tipo_nombre+'<input type="hidden" value="'+res.alm_prod_tipo_id+'" id="id_tipo_producto"></td><td>'+res.alm_prod_marca+'</td><td>'+res.alm_prod_cantidad+' ('+res.alm_prod_unidad_nom+')<input type="hidden" value="'+res.alm_prod_unidad_id+'" id="id_unidad_prod" ></td><td>'+res.alm_precio_compra+'</td><td>'+res.alm_precio_venta+'</td><td>'+res.alm_suc_org_nombre+'<input type="hidden" value="'+res.alm_suc_org_id+'" id="id_agencia_org"></td><td>'+res.estado_producto+'</td>';
		    tabla_datos = tabla_datos +'<td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:3px;"><a href="alm_detallar_prod.php?id_producto='+res.alm_prod_id+'" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo('+res.alm_prod_id+')"><img src="img/delete box_32x32.png"><br> Dar de Baja</a></div> </td></tr>';
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_productos').append(tabla_datos);
		}
	});
	 evt.preventDefault();
}
/**
 * Metodo que se encarga cuando el producto es marcado
 */
 function productoFoco(evt, ui){
 	//alert(ui);
 	//console.log(ui.item.id);
 	$.ajax({
		url:'alm_buscar_prod.php?accion=list&prod='+ui.item.value,
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_productos').empty();
			$('#tabla_datos_productos').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			$('#tabla_datos_productos').empty();
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>SERIE</th><th>NOMBRE</th><th>TIPO</th><th>MARCA</th><th>CANTIDAD</th><th>PRECIO COMPRA</th><th>PRECIO VENTA</th><th>SUCURSAL ORG.</th><th>ESTADO</th><th>ACCIONES</th></tr>';
			$.each(res, function(index, value){
				tabla_datos = tabla_datos+'<tr><td>'+value.alm_prod_serie+'</td><td>'+value.alm_prod_nombre+'</td><td>'+value.alm_prod_tipo_nombre+'<input type="hidden" value="'+value.alm_prod_tipo_id+'" id="id_tipo_producto"></td><td>'+value.alm_prod_marca+'</td><td>'+value.alm_prod_cantidad+' ('+value.alm_prod_unidad_nom+')<input type="hidden" value="'+value.alm_prod_unidad_id+'" id="id_unidad_prod" ></td><td>'+value.alm_precio_compra+'</td><td>'+value.alm_precio_venta+'</td><td>'+value.alm_suc_org_nombre+'<input type="hidden" value="'+value.alm_suc_org_id+'" id="id_agencia_org"></td><td>'+value.estado_producto+'</td>';
		    	tabla_datos = tabla_datos +'<td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:3px;"><a href="alm_detallar_prod.php?id_producto='+value.alm_prod_id+'" ><img src="img/notepad_32x32.png" align="absmiddle"> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo('+value.alm_prod_id+')"><img src="img/delete box_32x32.png"><br> Dar de Baja</a></div> </td></tr>';
			});
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_productos').append(tabla_datos);
		}
	});
 	evt.preventDefault();
 }
 /*
  * Metodo que permite buscar un producto con solo el nombre del producto
  */
function buscarProducto(){
	//alert('que estas buscando...'+$('#producto_buscar').val());
	$.ajax({
		url:'alm_buscar_prod.php?accion=list&prod='+$('#producto_buscar').val(),
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_productos').empty();
			$('#tabla_datos_productos').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			$('#tabla_datos_productos').empty();
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>SERIE</th><th>NOMBRE</th><th>TIPO</th><th>MARCA</th><th>CANTIDAD</th><th>PRECIO COMPRA</th><th>PRECIO VENTA</th><th>SUCURSAR ORG.</th><th>ACCIONES</th></tr>';
			$.each(res, function(index, value){
				tabla_datos = tabla_datos+'<tr><td>'+value.alm_prod_serie+'</td><td>'+value.alm_prod_nombre+'</td><td>'+value.alm_prod_tipo_nombre+'<input type="hidden" value="'+value.alm_prod_tipo_id+'" id="id_tipo_producto"></td><td>'+value.alm_prod_marca+'</td><td>'+value.alm_prod_cantidad+' ('+value.alm_prod_unidad_nom+')<input type="hidden" value="'+value.alm_prod_unidad_id+'" id="id_unidad_prod" ></td><td>'+value.alm_precio_compra+'</td><td>'+value.alm_precio_venta+'</td><td>'+value.alm_suc_org_nombre+'<input type="hidden" value="'+value.alm_suc_org_id+'" id="id_agencia_org">';
		    	tabla_datos = tabla_datos +'<td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:3px;"><a href="alm_detallar_prod.php?id_producto='+value.alm_prod_id+'" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo('+value.alm_prod_id+')"><img src="img/delete box_32x32.png"><br> Dar de Baja</a></div> </td></tr>';
			});
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_productos').append(tabla_datos);
		}
	});
}

function mostrarDialogo(idProducto){
	$("#dialog-confirm").attr('title', 'Advertencia');
	$("#dialog-confirm").empty();
	$("#dialog-confirm").append('<p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja el producto?</p>');
	 $("#dialog-confirm" ).dialog({
			resizable: false,
			height:250,
			width:400,
			modal: true,
			buttons: {
				"Confirmar": function() {
					$.ajax({
						url:'alm_eliminar_prod.php?tp=eliminarProd&idPrducto='+idProducto,
						dataType:'json',
						type:'GET',
						success:function(res){
							if(res.completo == true){
								$(location).attr('href', 'alm_consulta_prod.php?msg=3');
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
