/**
 * @description Esta clase es la que gestiona los eventos y acciones de contrato
 * @author Daniel Fernandez
 * @date  20/05/2013
 */

function OrdenCompra(){
	/**
	 * Este es el formulario de nueva orden con descuento
	 */
	this.formularioNuevaOrdenCompraTpl = function(codigo_proyecto){
		var util = new Utilitarios();
		$("#camp_01_orden_referencia_orden_compra").val("");
		$("#camp_02_nro_doc_proforma_orden_compra").val("");
		$("#camp_03_fec_doc_proforma_orden_compra").val("");
		$("#camp_04_fec_orden_cabecera_orden_compra").val("");
		$("#camp_05_fec_entrega_orden_compra").val("");
		$("#broker_orden").val("");
		$("#metodo_envio_orden_compra").val("");
		$("#obs_orden_compra").val("");
		$('input[name=check_costos_adicionales_orden_compra]').attr('checked', false);
		$('#descuentos_adicionales_orden_compra_000001').empty();
		util.validarCampo('camp_01_orden_referencia_orden_compra', 'err_01_error_orden_ref', 'N orden de ref  no puede estar vacio');
		util.validarCampo('camp_02_nro_doc_proforma_orden_compra', 'camp_02_error_nro_doc_proforma', 'El codigo de la Proforma no puede estar vacio');
		$("#camp_03_fec_doc_proforma_orden_compra").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#camp_04_fec_orden_cabecera_orden_compra").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#camp_05_fec_entrega_orden_compra").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#check_costos_adicionales_orden_compra').change(function () {
			if($(this).is(':checked')){
				$('#descuentos_adicionales_orden_compra_000001').empty();
				var table_desc = '<table><tr><td><strong>Descuento :</strong></td>';
				table_desc = table_desc+'<td><input class="txt_campo" type="number"  id="camp_0004_descuento_envio_orden_compra"></td></tr>';
				table_desc = table_desc+'<tr><td><strong>Seguro :</strong></td>';
				table_desc = table_desc+'<td><input class="txt_campo" type="number"  id="camp_0005_seguro_envio_orden_compra"></td></tr>';
				table_desc = table_desc+'<tr><td><strong>Flete Aereo :</strong></td>';
				table_desc = table_desc+'<td><input class="txt_campo" type="number"  id="flete_aereo_orden_compra"></td></tr></table>';
				$('#descuentos_adicionales_orden_compra_000001').append(table_desc);
				$('#camp_0004_descuento_envio_orden_compra').numeric(".");
				$('#camp_0005_seguro_envio_orden_compra').numeric(".");
				$('#flete_aereo_orden_compra').numeric(".");
			}else{
				$('#descuentos_adicionales_orden_compra_000001').empty();
			}
		
		});
		$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'armarOrdenCompraFormulario'
			},
			beforeSend : function(){
				//$('#formulario_nueva_orden_compra_tpl_00001').empty();
			    //$('#formulario_nueva_orden_compra_tpl_00001').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(resultado){
				if(resultado.completo){
					
				}
			}
		});
	/*	var orden_compra = new OrdenCompra();
			orden_compra.listaProveedores();
			orden_compra.listaTerminosPago();
			orden_compra.listaTerminosOrden();
			orden_compra.listaMonedaOrdenCompra();*/
		$('#form_02_nueva_orden_compra_form_0002').dialog({
					height: 600,
					width: 1024,
					modal: true,
					resizable: false,
					draggable: true,
					
		});

	}

   /**
	 * Metodo q ejecuta el formulario de nueva proforma
	 */
	this.formularioNuevaOrdenCompra = function(codigo_proyecto){
		new OrdenCompra().formularioNuevaOrdenCompraTpl(codigo_proyecto);
		

	}
	/**
	 * Metodo que cancela el formulario de nueva orden
	 */
	this.cancelarNuevaOrden = function (codigo_proyecto){
		$('#form_02_nueva_orden_compra_form').empty();
		$('#form_02_nueva_orden_compra_form').append('<input type="button" value="Nueva Orden Compra" class="btn_form" onClick="new GestionImportacion().formularioNuevaOrdenCompra(\''+codigo_proyecto+'\');">');
	}
    /**
	 * Metodo q ejecuta la lista de proformas
	 */
	this.formularioListaOrdenCompra = function(codigo_proyecto){
		$('#codigo_proyecto_div').empty();
		$('#codigo_proyecto_div').append('<label><strong>C&oacute;digo Proyecto:</strong> </label><input type="text" class="txt_campo" id="codigos_proyecto_hidden_orden_compra0001" value="'+codigo_proyecto+'" readonly /></br>');
		$('#codigo_proyecto_div').append('<br><input type="button" value="Nueva Orden Compra" class="btn_form" onClick="new GestionImportacion().formularioNuevaOrdenCompra(\''+codigo_proyecto+'\');" >');
		new OrdenCompra().actualizarListaOdenCompra(codigo_proyecto);
		//alert(codigo_proyecto);
	}

	/**
	 * Este es el metodo que actualiza el orden de compra
	 */
	this.actualizarListaOdenCompra = function(codigo_proyecto){
		$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'listarOrdenesCompraInicial',
				codigo_proyecto : codigo_proyecto	
			},
			beforeSend : function(){
				$('#tabla_datos_orden_compra_001_001').empty();
			    $('#tabla_datos_orden_compra_001_001').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(resultado){
			    $('#tabla_datos_orden_compra_001_001').empty();
				var tabla_datos = '<table class="table_usuario" id="tabla_lista_orden_compra_item"><tr>';
				tabla_datos = tabla_datos+'<th align="center" width="50">NRO. REF.</th>';
				tabla_datos = tabla_datos+'<th align="center">FECHA DE COMPRA</th>';
				tabla_datos = tabla_datos+'<th align="center">NRO. PROFORMA.</th>';
				tabla_datos = tabla_datos+'<th align="center">FECHA PROFORMA</th>';
				tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th> ';
				tabla_datos = tabla_datos+'<th align="center">DETALLAR</th><th align="center">ELIMINAR</th></tr></table>';
				$('#tabla_datos_orden_compra_001_001').append(tabla_datos);
				$('#codigos_proyecto_hidden_orden_compra').val(codigo_proyecto);
				tabla_datos = '';
				//console.log();
				if(resultado[0].id_orden_compra != 0){
					$.each(resultado, function(index, orden){
						tabla_datos = tabla_datos+'<tr><td>'+orden.nro_ref_orden+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.fecha_orden_registro+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.nro_proforma+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.fecha_proforma+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.nombre_proveedor+'</td>';
						tabla_datos = tabla_datos+'<td><a href="#" onClick="new GestionImportacion().detallarOrdenCompra('+orden.id_orden_compra+', '+orden.nro_ref_orden+', \''+codigo_proyecto+'\',\''+orden.id_unico_orden_compra+'\')"><img src="../img/notepad_32x32.png" align="absmiddle">Detallar</a></td><td><a href="#" onClick="new OrdenCompra().desabilitarOrden(\''+orden.id_unico_orden_compra+'\', \''+codigo_proyecto+'\')"><img src="../img/delete_32x32.png" align="absmiddle">Eliminar</a></td></tr>';
						//console.log(tabla_datos);
					});
				}
				
				$('#tabla_lista_orden_compra_item').append(tabla_datos);
				//$("#formulario_lista_orden_compra_0001").dialog('close');
				$("#formulario_lista_orden_compra_0001").dialog({
					height: 450,
					width: 1000,
					modal: true,
					resizable: false,
					draggable: true,
					
				});
			},
			error: function(resultado){
			}
		});
	}

	/**
	 * Este es el metodo que actualiza el orden de compra
	 */
	this.actualizarListaOdenCompra2 = function(codigo_proyecto){
		var util = new Utilitarios();
		$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'listarOrdenesCompra',
				codigo_proyecto : codigo_proyecto	
			},
			beforeSend : function(){
				$('#tabla_datos_orden_compra_001_001').empty();
			    $('#tabla_datos_orden_compra_001_001').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(resultado){
				
			    $('#formulario_lista_orden_compra_0001 #tabla_datos_orden_compra_001_001').empty();
				var tabla_datos = '<table class="table_usuario" id="tabla_lista_orden_compra_item"><tr>';
				tabla_datos = tabla_datos+'<th align="center">NRO. REF</th>';
				tabla_datos = tabla_datos+'<th align="center">FECHA COMPRA</th>';
				tabla_datos = tabla_datos+'<th align="center">NRO. PROFORMA.</th>';
				tabla_datos = tabla_datos+'<th align="center">FECHA PROFORMA</th>';
				tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th> ';
				tabla_datos = tabla_datos+'<th align="center">DETALLAR</th><th align="center">ELIMINAR</th></tr></table>';
				$('#formulario_lista_orden_compra_0001 #tabla_datos_orden_compra_001_001').append(tabla_datos);
				$('#codigos_proyecto_hidden_orden_compra').val(codigo_proyecto);
				var tabla_datos;
				if(resultado[0].id_orden_compra != 0){
					$.each(resultado, function(index, orden){
						tabla_datos = '<tr><td>'+orden.nro_ref_orden+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.fecha_orden_registro+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.nro_proforma+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.fecha_proforma+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.nombre_proveedor+'</td>';
						tabla_datos = tabla_datos+'<td><a href="#" onClick="new GestionImportacion().detallarOrdenCompra('+orden.id_orden_compra+', '+orden.nro_ref_orden+', \''+codigo_proyecto+'\',\''+orden.id_unico_orden_compra+'\')"><img src="../img/notepad_32x32.png" align="absmiddle"> Detallar</a></td><td><a href="#" onClick="new OrdenCompra().desabilitarOrden(\''+orden.id_unico_orden_compra+'\', \''+codigo_proyecto+'\')"><img src="../img/delete_32x32.png" align="absmiddle"> Eliminar</a></td></tr>';
						$('#formulario_lista_orden_compra_0001 #tabla_lista_orden_compra_item').append(tabla_datos);
					});
				}
				
				util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Orden Compra');
				//new OrdenCompra().cancelarNuevaOrden(codigo_proyecto);*/
				//$("#form_02_nueva_orden_compra_form_0002").dialog('open');
				$("#form_02_nueva_orden_compra_form_0002").dialog('close');
			},
			error: function(resultado){
			}
		});
	}
	this.actualizarListaOdenCompra3= function(codigo_proyecto){
		var util = new Utilitarios();
		$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'listarOrdenesCompra',
				codigo_proyecto : codigo_proyecto	
			},
			beforeSend : function(){
				$('#tabla_datos_orden_compra_001_001').empty();
			    $('#tabla_datos_orden_compra_001_001').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(resultado){
			    $('#formulario_lista_orden_compra_0001 #tabla_datos_orden_compra_001_001').empty();
				var tabla_datos = '<table class="table_usuario" id="tabla_lista_orden_compra_item"><tr>';
				tabla_datos = tabla_datos+'<th align="center">NRO. REF</th>';
				tabla_datos = tabla_datos+'<th align="center">FECHA COMPRA</th>';
				tabla_datos = tabla_datos+'<th align="center">NRO. PROFORMA.</th>';
				tabla_datos = tabla_datos+'<th align="center">FECHA PROFORMA</th>';
				tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th> ';
				tabla_datos = tabla_datos+'<th align="center">DETALLAR</th><th align="center">ELIMINAR</th></tr></table>';
				$('#formulario_lista_orden_compra_0001 #tabla_datos_orden_compra_001_001').append(tabla_datos);
				$('#codigos_proyecto_hidden_orden_compra').val(codigo_proyecto);
				var tabla_datos;
				if(resultado[0].id_orden_compra != 0){
					$.each(resultado, function(index, orden){
						tabla_datos = '<tr><td>'+orden.nro_ref_orden+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.fecha_orden_registro+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.nro_proforma+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.fecha_proforma+'</td>';
						tabla_datos = tabla_datos+'<td>'+orden.nombre_proveedor+'</td>';
						tabla_datos = tabla_datos+'<td><a href="#" onClick="new GestionImportacion().detallarOrdenCompra('+orden.id_orden_compra+', '+orden.nro_ref_orden+', \''+codigo_proyecto+'\',\''+orden.id_unico_orden_compra+'\')"><img src="../img/notepad_32x32.png">Detallar</a> </td><td><a href="#" onClick="new OrdenCompra().desabilitarOrden(\''+orden.id_unico_orden_compra+'\', \''+codigo_proyecto+'\')"><img src="../img/delete_32x32.png">Eliminar</a></td></tr>';
						$('#formulario_lista_orden_compra_0001 #tabla_lista_orden_compra_item').append(tabla_datos);
					});
				}
				
				util.mostrarMensajeAlerta(1, 'Las ordenes actualizadas correctamente', 'Confirmacion Orden Compra');
				//new OrdenCompra().cancelarNuevaOrden(codigo_proyecto);*/
				
			},
			error: function(resultado){
			}
		});
	}
	
	/**
	 * Este metodo graba los datos del formulario de la proforma
	 */
	this.grabarNuevaOrdenCompra = function(){
		var util = new Utilitarios();
		if($('#camp_01_orden_referencia_orden_compra').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Orden de Ref. no puede estar vacio', 'Mensaje Orden Compra');
		}else if($('#camp_02_nro_doc_proforma_orden_compra').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Codigo de Proforma no puede estar vacio', 'Mensaje Orden Compra');
		}else if($('#camp_03_fec_doc_proforma_orden_compra').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha de Proforma no puede estar vacio', 'Mensaje Orden Compra');
		}else if($('#camp_04_fec_orden_cabecera_orden_compra').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha de Orden no puede estar vacio', 'Mensaje Orden Compra');
		}else if($('#check_costos_adicionales_orden_compra').is(':checked')){
			if($('#camp_0004_descuento_envio_orden_compra').val() == "" || $('#camp_0005_seguro_envio_orden_compra').val() == "" || $('#flete_aereo_orden_compra').val() == "" ){
				util.mostrarMensajeAlerta(0, 'Los descuento adicionales no pueden estar vacio ', 'Mensaje Orden Compra');
			}else{
				$.ajax({
					url:'router/OrdenCompraRouter.php',
					dataType: 'json',
					type: 'POST',
					data : { 
						accion : 'grabarNuevaCabeceraOrdenCompraDescuento',
						codigo_proyecto : $('#codigos_proyecto_hidden_orden_compra0001').val(),
						num_orden_compra_ref : $('#camp_01_orden_referencia_orden_compra').val(),
						codigo_proveedor : $('#camp_002_codigo_proveedor').val(),
						nro_doc_proforma : $('#camp_02_nro_doc_proforma_orden_compra').val(),
						fec_doc_proforma : $('#camp_03_fec_doc_proforma_orden_compra').val(),
						fec_orden_cabecera : $('#camp_04_fec_orden_cabecera_orden_compra').val(),
						fecha_entrega_orden_compra : $('#camp_05_fec_entrega_orden_compra').val(),
						formas_pago : $('#camp_003_codigo_termino_pago').val(),
						metodo_envio_orden_compra : $('#metodo_envio_orden_compra').val(),
						broker_orden : $('#broker_orden').val(),
						terminos_orden : $('#camp_004_codigo_terminos_pago').val(),
						obs_orden_compra : $('#obs_orden_compra').val(),
						moneda_orden_compra : $('#moneda_orden_compra_001').val(),
						descuento_orden_compra : util.redondeo2decimales($('#camp_0004_descuento_envio_orden_compra').val()),
						seguro_orden_compra : util.redondeo2decimales($('#camp_0005_seguro_envio_orden_compra').val()),
						flete_aereo_orden_compra : util.redondeo2decimales($('#flete_aereo_orden_compra').val())
						//otro_gastos_orden_compra : $('#otros_orden_compra').val()
					},
					beforeSend : function(){
					},
					success: function(resultado){
						if(resultado.completo == true){
							var orden_comp = new OrdenCompra();
							orden_comp.actualizarListaOdenCompra2(resultado.codigo_proyecto);
						}				
					},
					error: function(resultado){
					}
				});	
			}
		}else{
			$.ajax({
				url:'router/OrdenCompraRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'grabarNuevaCabeceraOrdenCompra',
					codigo_proyecto : $('#codigos_proyecto_hidden_orden_compra0001').val(),
					num_orden_compra_ref : $('#camp_01_orden_referencia_orden_compra').val(),
					codigo_proveedor : $('#camp_002_codigo_proveedor').val(),
					nro_doc_proforma : $('#camp_02_nro_doc_proforma_orden_compra').val(),
					fec_doc_proforma : $('#camp_03_fec_doc_proforma_orden_compra').val(),
					fec_orden_cabecera : $('#camp_04_fec_orden_cabecera_orden_compra').val(),
					fecha_entrega_orden_compra : $('#camp_05_fec_entrega_orden_compra').val(),
					formas_pago : $('#camp_003_codigo_termino_pago').val(),
					metodo_envio_orden_compra : $('#metodo_envio_orden_compra').val(),
					broker_orden : $('#broker_orden').val(),
					terminos_orden : $('#camp_004_codigo_terminos_pago').val(),
					obs_orden_compra : $('#obs_orden_compra').val(),
					moneda_orden_compra : $('#moneda_orden_compra_001').val()
				},
				beforeSend : function(){
				},
				success: function(resultado){
					if(resultado.completo == true){
							var orden_comp = new OrdenCompra();
							orden_comp.actualizarListaOdenCompra2(resultado.codigo_proyecto);
					}				
				},
				error: function(resultado){
				}
			});	
		}
		
	}
	
	
	/**
	 * Este es el metod que permite detallar la orden de compra
	 */
	this.detallarOrdenCompra=function(id_orden, nro_referencia, codigo_proyecto, codigo_unico_proyecto){
		//alert(codigo_unico_proyecto);
		$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'obtenerCabceraOrdenDetalle',
				id_orden : id_orden	
			},
			beforeSend : function(){
				$('#tabla_datos_orden_compra').empty();
			    $('#tabla_datos_orden_compra').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(resultado){
				//console.log(resultado);
				$('#codigo_proyecto').val(resultado.codigo_proy);
				$('#codigo_unico_proyecto_hidden').val(codigo_unico_proyecto);
				$('#nro_orden_compra').val(resultado.nro_orden_ref);
				$('#fecha_orden').val(resultado.fecha_orden);
				$('#fecha_entrega_orden').val(resultado.fecha_orden_entrega);
				$('#terminos_pago').val(resultado.term_pago);
				$('#metodo_envio').val(resultado.ship_via);
				$('#nombre_broker').val(resultado.broker_imp);	
				$('#terminos_envio').val(resultado.termino_envio);
				new OrdenCompra().seleccionarContactos();
				$('#nro_proforma_orden_compra').val(resultado.nro_proforma);
				$('#fecha_proforma_orden_compra').val(resultado.fecha_proforma);
				$('#nombre_proveedor_orden_compra').val(resultado.nombre_proveedor);
				$('#codigo_proyecto_item').val(resultado.codigo_proy);
				$('#nro_referencia').val(resultado.nro_orden_ref);
				$('#codigo_proforma').val(resultado.nro_proforma);
				new ItemOrdenCompra().listarItemsOrdenCompra(resultado.nro_orden_ref, resultado.codigo_proy, resultado.nro_proforma, codigo_unico_proyecto, codigo_unico_proyecto);
				//new OrdenCompra().seleccionarProveedorProforma(resultado.codigo_proy, resultado.nro_orden_ref);	
			}
		});
		$("#formulario_nuevo_orden_detalle0001").dialog({
			height: 800,
			width: 1000,
			modal: true,
			resizable: false,
			draggable: true,
			
		});
	}
	/**
	 * Metodo que se encarga de seleccionar los contactos
	 */
	this.seleccionarContactos = function(){
		$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'seleccionarContactos',
			},
			success: function(resultado){
				$.each(resultado, function(index, contacto){
					if(contacto.ref_tipo == 1){
						$('#ref_name_tipo1').empty();
						$('#ref_name_tipo11').empty();
						$('#ref_direccion_tipo1').empty();
						$('#ref_direccion_tipo11').empty();
						$('#ref_telefono_tipo1').empty();
						$('#ref_telefono_tipo11').empty();
						$('#ref_fax_tipo1').empty();
						$('#ref_fax_tipo11').empty();
						$('#ref_ciudad_tipo1').empty();
						$('#ref_ciudad_tipo11').empty();
						$('#ref_name_tipo1').append(contacto.ref_nombre);
						$('#ref_name_tipo11').append(contacto.ref_nombre);
						$('#ref_direccion_tipo1').append(contacto.ref_direccion);
						$('#ref_direccion_tipo11').append(contacto.ref_direccion);
						$('#ref_telefono_tipo1').append(contacto.ref_telefono);
						$('#ref_telefono_tipo11').append(contacto.ref_telefono);
						$('#ref_fax_tipo1').append(contacto.ref_fax);
						$('#ref_fax_tipo11').append(contacto.ref_fax);
						$('#ref_ciudad_tipo1').append(contacto.ref_ciudad+' - '+contacto.ref_pais);
						$('#ref_ciudad_tipo11').append(contacto.ref_ciudad+' - '+contacto.ref_pais);
					}else if(contacto.ref_tipo == 2){
						$('#ref_nombre_tipo2').empty();
						$('#ref_telefono_tipo2').empty();
						$('#ref_fax_numero_tipo2').empty();
						$('#ref_ciudad_tipo2').empty();
						$('#ref_email_tipo2').empty();
						$('#ref_nombre_tipo2').append(contacto.ref_nombre);
						$('#ref_telefono_tipo2').append(contacto.ref_telefono);
						$('#ref_fax_numero_tipo2').append(contacto.ref_telefono);
						$('#ref_ciudad_tipo2').append(contacto.ref_ciudad+' - '+contacto.ref_pais);
						$('#ref_email_tipo2').append(contacto.ref_email);
					
					}
				});
			}
		});
		
	}
   /**
	* Metodo que permite listar a los proveedores
	*/
	this.listaProveedores = function(){
		$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'listaProveedoresOrdenCompra',
			},
			success : function(res){
				$.each(res, function(index, proveedor){
					$('#camp_002_codigo_proveedor').append('<option value="'+proveedor.codigo_proveedor+'">'+proveedor.nombre_proveedor+'</option>');
				});
			}
		});
	}
   /**
    * Metodo que permile lista los terminos de pago
    */ 
    this.listaTerminosPago =function(){
    	$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'listaTerminosPagoOrdenCompra',
			},
			success : function(res){
				$.each(res, function(index, termino){
					$('#camp_003_codigo_termino_pago').append('<option value="'+termino.codigo_termino_pago+'">'+termino.desc_termino_pago+'</option>');
				});
			}
		});
    }
   /**
    * Metodo que permite listar las ordenes de pago
    */
    this.listaTerminosOrden = function(){
    	$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'listaTerminosOrdenOrdenCompra',
			},
			success : function(res){
				$.each(res, function(index, termino){
					$('#camp_004_codigo_terminos_pago').append('<option value="'+termino.codigo_termino_orden+'">'+termino.desc_termino_orden+'</option>');
				});
			}
		});	
    }
    /**
     * Metodo que permite 
     */
    this.listaMonedaOrdenCompra = function(){
    	$.ajax({
			url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'listaMonedasOrdenCompra',
			},
			success : function(res){
				$.each(res, function(index, moneda){
					$('#moneda_orden_compra_001').append('<option value="'+moneda.codigo_moneda_orden_compra+'">'+moneda.descripcion_moneda_orden_compra+'</option>');
				});
			}
		});	
    }
    /**
     * Metodo que permite desabilitar la orden de compra
     */
    this.desabilitarOrden = function(codigo_unico_proyecto, codigo_proyecto){
    	$("#dialog-confirm" ).attr('title', 'Confirmacion');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="../img/checkmark_48x48.png" align="absmiddle">Realmente quiere eliminar la Orden de Compra ?</p>');
		$("#dialog-confirm").dialog({
			resizable: false,
			height:200,
			width:400,
			modal: true,
			buttons: {
				"Aceptar": function() {
					//alert('Eliminado el proyecto '+codigo_unico_proyecto)
					new OrdenCompra().eliminarOrdenCompra(codigo_unico_proyecto, codigo_proyecto);
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});
    }
    /**
     * Metodo que permite eliminar la orden de compra
     */
    this.eliminarOrdenCompra = function(codigo_unico_proyecto, codigo_proyecto){
    	//alert(codigo_unico_proyecto);
    	//var util = new Utilitarios();
    	$.ajax({
    		url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'POST',
			data : { 
				accion : 'eliminarOrdenCompra',
				codigo_unico_proy : codigo_unico_proyecto
			},
			success : function(res){
				if(res.completo){
					//alert('prueba prueba');
					//$("#dialog-confirm").dialog( "close" );
					//util.mostrarMensajeAlerta(1, 'La orden de compra ha sido eliminado con exito', 'Mensaje Orden Compra');
					new OrdenCompra().actualizarListaOdenCompra3(codigo_proyecto);
				}
						

			}
    	});

    }
    /**
     * Metodo que cierra 
     **/
    this.cerrarVentanaOrdenComrpa = function(){
    	$('#formulario_nuevo_orden_detalle0001').dialog("close");
    }
    /** 
     * Metodo que permite procesar la orden de comrpa
     */
    this.procesarOrdenCompra = function(){
    	var util = new Utilitarios();
    	$.ajax({
    		url:'router/OrdenCompraRouter.php',
			dataType: 'json',
			type: 'POST',
			data : { 
				accion : 'procesarOrdenCompra',
				codigo_unico_proy : $('#codigos_proyecto_hidden_orden_compra0001').val()
			},
			success : function(res){
				if(res.completo){
					$(location).attr('href', 'imp_gest_imp.php');
				}else{
					$("#dialog-confirm" ).attr('title', 'Confirmacion');
					$("#dialog-confirm").empty();
					$("#dialog-confirm").append('<p><img src="../img/alert_48x48.png" align="absmiddle">No se puede procesar por que no tiene ordenes</p>');
					$("#dialog-confirm").dialog({
						resizable: false,
						height:200,
						width:400,
						modal: true,
						buttons: {
							"Aceptar": function() {
								//new OrdenCompra().eliminarOrdenCompra(codigo_unico_proyecto, codigo_proyecto);
								$( this ).dialog( "close" );
							}
						}
					});	
				}
			}
    	});
    }
	
	/**
     * Metodo da de baja a las ordenes tanto de cabecera como del detalle 
     **/
    this.bajaOrdenes = function(cod_proy){
		//alert("asd "+cod_proy);
		$("#dialog-confirm" ).attr('title', 'Confirmacion');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="../img/checkmark_48x48.png" align="absmiddle">Realmente quiere eliminar la Orden de Compra?</p>');
		$("#dialog-confirm").dialog({
			resizable: false,
			height:200,
			width:400,
			modal: true,
			buttons: {
				"Aceptar": function() {
					//alert('Eliminado el proyecto '+codigo_proyecto);
					new OrdenCompra().darBajaDetalleOrden(cod_proy);
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});
	}
	
	
		/**
     * Metodo da de baja a las ordenes de la cabecera 
     **/
    this.darBajaDetalleOrden = function(cod_proy){
	//console.log(cod_proy);
	
		$.ajax({
	    		url:'router/OrdenCompraRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'bajaDetalleOrden',
					codigo_proy : cod_proy
				},
				success : function(res){
					if(res.completo){
						
					}
				}
    	});
	    	
	
	}
	/**
	 * Metodo que permite actualizar el total de totales en la cabecera de la orden
	 */
	this.actualizarTotalOrdenCompra = function(total_totales_final, id_orden_compra){
		//alert(total_totales_final);
		$.ajax({
			url:'router/OrdenCompraRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'actualizarOrdenTotalFinal',
					total_final : total_totales_final,
					orden_unico_compra : id_orden_compra
				},
				success : function(res){
					if(res.completo){
						
					}
				}
		});
	}
	
	
	
} //fin del metodo principal