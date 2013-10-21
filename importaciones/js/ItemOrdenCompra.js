/**
 * @description Esta clase es la que gestiona los eventos y acciones de contrato
 * @author Daniel Fernandez
 * @date  20/05/2013
 */

function ItemOrdenCompra(){
	/**
	 * Metodo que permite realizar el tpl para mostrar el formulario de nuevo item
	 */
	this.nuevoItemOrdenCompra = function(){
		var util = new Utilitarios();
		$('#part_number_nuevo_item').val("");
		$('#description_nuevo_item').val("");
		$('#qty_nuevo_item').val("");
		$('#unit_price_item_compra').val("");
		$('#serial_number').attr('checked', false);
		util.validarCampo('part_number_nuevo_item', 'error_part_number_nuevo_item', 'El campo PART NUMBER no puede estar vacio!!');
		util.validarCampo('description_nuevo_item', 'error_description_nuevo_item', 'El campo DESCRIPTION de Item no puede estar vacio!!');
		util.validarCampo('qty_nuevo_item', 'error_qty_nuevo_item', 'El campo QTY no puede estar vacio!!');
		util.validarCampo('unit_price_item_compra', 'error_unit_price_item_compra', 'el campo UNIT PRICE no puede estar vacio!!');
		//$('#part_number_nuevo_item').numeric();
		$('#qty_nuevo_item').numeric();
		$('#unit_price_item_compra').numeric(".");
		$('#formulario_nuevo_item_orden_nueva').dialog({
			height: 450,
			width: 600,
			modal: true,
			resizable: false,
			draggable: true,
			closeText: "hide",
			position: 'top'
		})
	}
	/**
	 * Metodo que permite registrar el nuevo item
	 */
	this.grabarNuevoItemComprado = function(){
		var util = new Utilitarios();
		if($('#part_number_nuevo_item').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo PART NUMBER es obligatorio', 'Mensaje Item');
		}else if($.trim($('#description_nuevo_item').val()) == ""){
			util.mostrarMensajeAlerta(0, 'El campo DESCRIPTION es obligatorio', 'Mensaje Item');
		}else if($('#qty_nuevo_item').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo QTY es obligatorio', 'Mensaje Item');
		}else if($('#unit_price_item_compra').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo UNIT PRICE es obligatorio', 'Mensaje Item');
		}else{
			var serial_number = 0;
			if($('#serial_number').is(':checked')){
				serial_number = 1;
			}
			$.ajax({
				url:'router/ItemCompraRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'grabarNuevoItemOrdenCompra',
					nro_referencia : $('#nro_referencia').val(),
					codigo_unico_proyecto : $('#codigo_unico_proyecto_hidden').val(),
					codigo_proyecto_item : $('#codigo_proyecto_item').val(),
					codigo_proforma : $('#codigo_proforma').val(),
					part_number_item : $('#part_number_nuevo_item').val(),
					description_item : $('#description_nuevo_item').val(),
					qty_nuevo_item : $('#qty_nuevo_item').val(),
					unidad_tipo_item : $('#unidad_tipo_item').val(),
					precio_unitario : $('#unit_price_item_compra').val(),
					tipo_item_prod_nuevo : $('#tipo_item_prod_nuevo').val(),
					serial_number_val : serial_number
				},
				beforeSend: function(){
					$('#lista_items_orden_compra').empty();
					$('#lista_items_orden_compra').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);;
				},
				success : function(resultado){
					if(resultado.completo == true){
						new ItemOrdenCompra().listarItemsOrdenCompra($('#nro_referencia').val(),$('#codigo_proyecto_item').val(),$('#codigo_proforma').val(),$('#codigo_unico_proyecto_hidden').val());
						$('#formulario_nuevo_item_orden_nueva').dialog('close');
						util.mostrarMensajeAlerta(1, 'Los datos del item han sido guardados correctamente', 'Confirmacion Item Orden Compra');
					}
				}
			});
		}
		
	}
	/**
	 * Metodo que permite listar la lista de los items
	 */
	this.listarItemsOrdenCompra = function(nro_referencia, codigo_proyecto, codigo_proforma, codigo_unico_proyecto){
		//alert(codigo_unico_proyecto);
		$.ajax({
			url:'router/ItemCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'listaItemsOrdenCompra',
				nro_ref : nro_referencia,
				codigo_proyecto : codigo_proyecto,
				codigo_proforma : codigo_proforma,
				codigo_unico_proy : codigo_unico_proyecto
			},
			beforeSend: function(){
				$('#lista_items_orden_compra00001').empty();
				$('#lista_items_orden_compra00001').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);;
			},
			success : function(resultado){
				//console.log(resultado);
				var util = new Utilitarios();
				$('#lista_items_orden_compra00001').empty();
				var tabla_items = '<table  class="table_usuario" id="lista_items_orden_compra_tabla_datos_item"><tr><th valign="top"><strong>ITEM </strong></th>';
				tabla_items = tabla_items+'<th valign="top"><strong>PART NUMBER </strong></th>';
				tabla_items = tabla_items+'<th valign="top"><strong>SERIAL NUMBER </strong></th>';
				tabla_items = tabla_items+'<th valign="top"><strong>DESCRIPTION </strong></th>';
				tabla_items = tabla_items+'<th valign="top"><strong>QTY </strong></th>';
				tabla_items = tabla_items+'<th valign="top"><strong>UM </strong></th>';
				tabla_items = tabla_items+'<th valign="top"><strong>UNIT PRICE</strong></th>';
				tabla_items = tabla_items+'<th valign="top"><strong>TOTAL</strong></th>';
				tabla_items = tabla_items+'<th valign="top"><strong>ELIMINAR</strong></th></tr></tabla>';
				$('#lista_items_orden_compra00001').append(tabla_items);

				var cont = 1;
				var total_totales = 0;
				if(resultado[0].codigo_unico_item  != 0){
					$.each(resultado, function(index, item){
						tabla_items = '<tr><td>'+cont+'</td>';
						tabla_items = tabla_items+'<td>'+item.parte_ord_compra+'</td>';
						var band = 'NO';
						if(item.serial_number == 1){
							band='YES';
						}else{
							band = 'NO';
						}
						tabla_items = tabla_items+'<td>'+band+'</td>';
						tabla_items = tabla_items+'<td>'+item.description_item+'</td>';
						tabla_items = tabla_items+'<td>'+item.cantidad_item+'</td>';
						tabla_items = tabla_items+'<td>'+item.unidad_item+'</td>';
						tabla_items = tabla_items+'<td>'+item.moneda_item+' '+item.precio_unitario+'</td>';
						var total =util.redondeo2decimales(util.redondeo2decimales(item.cantidad_item)*util.redondeo2decimales(item.precio_unitario));
						total_totales = util.redondeo2decimales(total_totales+total);
						tabla_items = tabla_items+'<td>'+item.moneda_item+' '+total+'</td>';
						tabla_items = tabla_items+'<td><a href="#" onclick="new ItemOrdenCompra().desabilitarItemOrdenCompra(\''+item.codigo_unico_item+'\')"><img src="../img/delete_32x32.png" align="absmiddle"> Eliminar</a></td></tr>';
						$('#lista_items_orden_compra_tabla_datos_item').append(tabla_items);
						cont++;
					});
					$('#total_orden_compra').val(total_totales);
				}
				new ItemOrdenCompra().establecerTotales(total_totales, codigo_unico_proyecto);
				//$('#formulario_nuevo_item_orden_nueva').dialog('close');
			}
		});
	}
	/** 
	 * Metodo que establece los totales de la lista de items
	 */
	this.establecerTotales = function(total_totales, codigo_unico_orden){
		//alert(total_totales+"-"+codigo_unico_orden);
		var util = new Utilitarios();
		$.ajax({
			url:'router/ItemCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'optenerTotalesOrdenCompra',
				cod_unico_orden_compra : codigo_unico_orden
			},
			beforeSend: function(){
			},
			success : function(resultado){
				$('#discount_orden_compra').val(resultado.alm_tot_descuento);
				$('#insurance_orden_compra').val(resultado.alm_tot_asegurado);
				$('#airfreight_orden_compra').val(resultado.alm_tot_transporte);
				//console.log(total_totales);
				var total_totales_final = util.redondeo2decimales(util.redondeo2decimales(total_totales)-util.redondeo2decimales(resultado.alm_tot_descuento)+util.redondeo2decimales(resultado.alm_tot_asegurado)+util.redondeo2decimales(resultado.alm_tot_transporte));
				new OrdenCompra().actualizarTotalOrdenCompra(total_totales_final, codigo_unico_orden);
				$('#total_orden_compra').val(total_totales_final);
				$('#otros_descuentos_orden_compra').val(resultado.alm_tot_otros);
			}
		});
	}

	/**
	 * Metodo que permite desabilitar el item de orden de compra
	 */
	this.desabilitarItemOrdenCompra = function (codigo_unico_item){
		$("#dialog-confirm" ).attr('title', 'Confirmacion');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="../img/checkmark_48x48.png" align="absmiddle">Realmente quiere eliminar el Item de la Orden de Compra?</p>');
		$("#dialog-confirm").dialog({
			resizable: false,
			height:200,
			width:400,
			modal: true,
			buttons: {
				"Aceptar": function() {
					new ItemOrdenCompra().eliminarItemOrdenCompra(codigo_unico_item);
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});

	}
	/**
	 * Este es el metodo que elimina en la base de datos el item de la orden de compra
	 */
	this.eliminarItemOrdenCompra = function(codigo_unico_item){
		$.ajax({
    		url:'router/ItemCompraRouter.php',
			dataType: 'json',
			type: 'POST',
			data : { 
				accion : 'eliminarItemOrdenCompra',
				codigo_unico_item : codigo_unico_item
			},
			success : function(res){
				if(res.completo){
					$("#dialog-confirm").dialog( "close" );
					new ItemOrdenCompra().listarItemsOrdenCompra($('#nro_orden_compra').val(), $('#codigo_proyecto').val(), $('#nro_proforma_orden_compra').val(), $('#codigo_unico_proyecto_hidden').val());
				}
						

			}
    	});
	}
}