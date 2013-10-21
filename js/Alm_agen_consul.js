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
	$('#menu_modulo_almacen').click(function(){
		$(location).attr('href', 'modulo.php?modulo=30000');
	});
	$('#menu_modulo_agencia_aduanera').click(function(){
		$(location).attr('href', 'alm_agencia.php');
	});
	$('#menu_consul_agencia').click(function(){
		$(location).attr('href', 'alm_consulta_agen.php')
	});
	// Este es el autocomplete
	$("#age_adu_buscar").keyup(function(){ //busca la letra introducida en el campo Consulta agencia aduanera
//		alert($('#age_adu_buscar').val());
		$.ajax({
			url:"alm_buscar_agen.php?tp=buscar&buscar="+$('#age_adu_buscar').val(),
			dataType:'json',
			type:'GET',
			beforeSend:function(){

			},
			success:function(response){
				//console.log(response);
				//alert(response);
				$("#age_adu_buscar").autocomplete({
		        	source: response, /* este es el script que realiza la busqueda */
		        //	minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
		        	select: agenciaSeleccionado, /* esta es la rutina que extrae la informacion del producto seleccionado */
		        	focus: agenciaFoco /* esta es la rutina que muestra del producto marcado, se actualiza la tabla al momento de paruearse con el mause */
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
function agenciaSeleccionado(evt,ui){
	$('#age_adu_buscar').val(ui.item.value);
	$.ajax({
		url:'alm_buscar_agen.php?tp=selected&agen='+ui.item.value+'&id='+ui.item.id,
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_agencia').empty();
			$('#tabla_datos_agencia').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			$('#tabla_datos_agencia').empty();//borra el div de la tabla
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>CODIGO</th><th>NOMBRE</th><th>DEPARTAMENTO</th><th>NIT</th><th>DIRECCION</th><th>TELEFONO</th><th>FAX</th><th>EMAIL</th><th>ACCIONES</th></tr>';
			tabla_datos = tabla_datos+'<tr><td>'+res.alm_age_adu_cod+'</td><td>'+res.alm_age_adu_nom+'</td><td>'+res.Name+'</td><td>'+res.alm_age_adu_nit+'</td><td>'+res.alm_age_adu_dir+'</td><td>'+res.alm_age_adu_telf+'</td><td>'+res.alm_age_adu_fax+'</td><td>'+res.alm_age_adu_email+'</td><td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:3px;"><a href="alm_modificar_agen.php?cod_age='+res.alm_age_adu_cod+'" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo(\''+res.alm_age_adu_cod+'\')"><img src="img/delete box_32x32.png"><br> Dar de Baja</a></div> </td></tr>';
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_agencia').append(tabla_datos);
		}
	});
	 evt.preventDefault();
}
/**
 * Metodo que se encarga cuando el producto es marcado
 */
 function agenciaFoco(evt, ui){
 	//alert(ui);
 	//console.log(ui.item.id);
 	$.ajax({
		url:'alm_buscar_agen.php?tp=list&age='+ui.item.value,
		dataType:'json',
		type:'GET',
		beforeSend:function(){
			$('#tabla_datos_agencia').empty();
			$('#tabla_datos_agencia').append('<center><img src="img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success:function(res){
			console.log(res);
			$('#tabla_datos_agencia').empty();
			var tabla_datos = '<table class="table_usuario">';
			tabla_datos = tabla_datos+'<tr><th>CODIGO</th><th>NOMBRE</th><th>DEPARTAMENTO</th><th>NIT</th><th>DIRECCION</th><th>TELEFONO</th><th>FAX</th><th>EMAIL</th><th>ACCIONES</th></tr>';
			
			$.each(res, function(index, value){
			tabla_datos = tabla_datos+'<tr><td>'+value.alm_age_adu_cod+'</td><td>'+value.alm_age_adu_nom+'</td><td>'+value.Name+'</td><td>'+value.alm_age_adu_nit+'</td><td>'+value.alm_age_adu_dir+'</td><td>'+value.alm_age_adu_telf+'</td><td>'+value.alm_age_adu_fax+'</td><td>'+value.alm_age_adu_email+'</td><td><div style="float:left;border:1px solid #999; width:45px; text-align:center; margin-left:0px; margin-right:3px;"><a href="alm_modificar_agen.php?cod_age='+value.alm_age_adu_cod+'" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:45px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo(\''+value.alm_age_adu_cod+'\')"><img src="img/delete box_32x32.png"><br> Dar de Baja</a></div> </td></tr>';
			});
			
		    tabla_datos = tabla_datos+'</table>';
		    $('#tabla_datos_agencia').append(tabla_datos);
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
		url:'alm_buscar_prod.php?tp=list&prod='+$('#producto_buscar').val(),
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

function mostrarDialogo(idAgencia){
	$("#dialog-confirm").attr('title', 'Advertencia');
	$("#dialog-confirm").empty();
	$("#dialog-confirm").append('<p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja a la agencia Aduanera?</p>');
	 $( "#dialog-confirm" ).dialog({
			resizable: false,
			height:250,
			width:400,
			modal: true,
			buttons: {
				"Confirmar": function() {
					$.ajax({
						url:'alm_acciones_agen.php?tp=baja&idAgen='+idAgencia,
						dataType:'json',
						type:'GET',
						success:function(res){
							if(res.completo == true){
								$(location).attr('href', 'alm_consulta_agen.php?msg=3');
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
