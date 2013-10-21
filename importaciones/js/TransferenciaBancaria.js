/**
 * @description Esta clase es la que gestiona los eventos y acciones de contrato
 * @author Ramiro Gutierrez
 * @date  17/05/2013
 */
function TransferenciaBancaria(){
	
	/**
	*  Metodo el cual crea el formulario trl para cargar las ordenes
	*/
	
	/*this.formularioListaOrdenes_tpl = function(){
		var formu = '<div id="formulario_orden_transferencia_bancaria" title="Lista de Ordenes Para la Transferencia Bancaria" style="display:none; width: 300px;" >';
			formu = formu + '<div id="tabla_orden_compara" title="Transferencia Bancaria" >';
			formu = formu + '</div>';
			formu = formu + '</div>';
		$('body').append(formu);
			
	}*/
	
	/**
	*  Metodo el cual verifica si ya se realizo la transaccion
	*/
	/*var unico=0;
	this.busca_unico = function(valor,cod_proy){
		//console.log(valor+"--"+cod_proy);
		$.ajax({
			url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'BuscaOrden',
					orden_unico:valor,
					cod_proy:cod_proy
				},
				success: function(res){
					//console.log(res);
					
					unico=res.valor;
					//console.log(unico);
				}
			
		});
			
	}*/
	
	
	
	/**
	 * Metodo q ejecuta el formulario de nuevotransferencia Bancaria
	 */
	this.formularioNuevaTransferenciaBancaria = function(id_proyecto, codigo_proyecto,cod_prov){
		
		//console.log(id_proyecto, codigo_proyecto);
		//console.log(cod_prov);
		
		$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'ListarOrdenTransferencia',
					cod_proy:codigo_proyecto
				},
				beforeSend : function(){
					$('#formulario_orden_transferencia_bancaria').empty(); //vaciamos el div de mi tpl
				},
				success: function(resultado){
					//var orden = new TransferenciaBancaria();
					//orden.formularioListaOrdenes_tpl();
					//console.log(resultado);
					
					var tabla_datos_cabcera = '<center><br><h3><label>Proyecto:</label><label>'+resultado[0].alm_proy_nom+'</label><br><br><label>C&oacute;digo Proyecto:</label><label>'+resultado[0].alm_proy_cod+'</label><h3></center>';
					
					$('#formulario_orden_transferencia_bancaria').append(tabla_datos_cabcera);//aderimos la cabecera al div de mi tpl
					
					 var tabla_datos = '<center><table class="table_usuario" id="tabla_datos_orden_compras"><tr>';
					tabla_datos = tabla_datos+'<th align="center">NRO. ORDEN REFERENCIA</th>';
					tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th> ';
					tabla_datos = tabla_datos+'<th align="center">ACCIONES</th>';
					tabla_datos = tabla_datos+'</tr></table></center>';
					$('#formulario_orden_transferencia_bancaria').append(tabla_datos);//aderimos la cabecera al div de mi tpl
					 tabla_datos='';
					$.each(resultado, function(index, value){
						//console.log(value);
						tabla_datos = '<tr>';
						tabla_datos = tabla_datos+'<td>'+value.alm_nro_referencia_orden+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_prov_nombre+'<input type="hidden" value="'+value.alm_prov_codigo+'" id="codigos_ordenes_hidden" /></td>';
						//console.log(cod_proy+"---"+value.alm_prov_codigo);
						if(value.doc==0){
							//console.log(cod_prov+"---"+value.alm_prov_codigo);
								tabla_datos = tabla_datos+'<td><a href="#" onClick="new GestionImportacion().formularioListarTransferenciaBancaria('+value.alm_prov_cod_cta+',\''+value.alm_prov_codigo+'\', \''+value.alm_prov_nombre+'\', \''+codigo_proyecto+'\', \''+value.alm_prov_codigo+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><BR>Realizar</a></td>';
						}else{
							//console.log(3);
								tabla_datos = tabla_datos+'<td></td>';
								//tabla_datos = tabla_datos+'<td><a href="#" onClick="new GestionImportacion().formularioListarTransferenciaBancaria('+value.alm_prov_cod_cta+',\''+value.alm_prov_codigo+'\', \''+value.alm_prov_nombre+'\', \''+codigo_proyecto+'\', \''+value.alm_prov_codigo+'\');">Realizar</a></td>';
						}
						//tabla_datos = tabla_datos+'<td><a href="#" onClick="new GestionImportacion().formularioListarTransferenciaBancaria('+value.alm_prov_cod_cta+',\''+value.alm_prov_codigo+'\', \''+value.alm_prov_nombre+'\', \''+codigo_proyecto+'\', \''+value.alm_prov_codigo+'\');">Realizar</a></td>';
						tabla_datos = tabla_datos+'</tr>';
					$('#tabla_datos_orden_compras').append(tabla_datos);	
					});
						
					//new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
					var boton ='<div align="center"><br><br><input class="btn_form" type="button" name="accion" value="Procesar" onClick="new Proyecto().dosAccionesProyecto(\''+codigo_proyecto+'\',5);"><br><br></div>';
					$('#formulario_orden_transferencia_bancaria').append(boton);
					$("#formulario_orden_transferencia_bancaria").dialog({
						height: 500,
						width: 850,
						modal: true,
						resizable: true,
						draggable: true,
						closeText: "hide"
					});
				}
		});
		
		
	}

		/**
	 * Metodo q ejecuta el formulario de nuevotransferencia Bancaria
	 */
	this.actualizarNuevaTransferenciaBancaria = function(id_proyecto, codigo_proyecto,cod_prov){
		
		//console.log(id_proyecto, codigo_proyecto);
		//console.log(cod_prov);
		
				$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'ListarOrdenTransferencia',
					cod_proy:codigo_proyecto
				},
				beforeSend : function(){
					$('#formulario_orden_transferencia_bancaria').empty(); //vaciamos el div de mi tpl
				},
				success: function(resultado){
					//var orden = new TransferenciaBancaria();
					//orden.formularioListaOrdenes_tpl();
					//console.log(resultado);
					
					var tabla_datos_cabcera = '<center><br><h3><label>Proyecto:</label><label>'+resultado[0].alm_proy_nom+'</label><br><br><label>Codigo Proyecto:</label><label>'+resultado[0].alm_proy_cod+'</label><h3></center>';
					
					$('#formulario_orden_transferencia_bancaria').append(tabla_datos_cabcera);//aderimos la cabecera al div de mi tpl
					
					 var tabla_datos = '<center><table class="table_usuario" id="tabla_datos_orden_compras"><tr>';
					tabla_datos = tabla_datos+'<th align="center">NRO. ORDEN REFERENCIA</th>';
					tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th> ';
					tabla_datos = tabla_datos+'<th align="center">ACCIONES</th>';
					tabla_datos = tabla_datos+'</tr></table></center>';
					$('#formulario_orden_transferencia_bancaria').append(tabla_datos);//aderimos la cabecera al div de mi tpl
					 tabla_datos='';
					$.each(resultado, function(index, value){
						//console.log(value);
						tabla_datos = '<tr>';
						tabla_datos = tabla_datos+'<td>'+value.alm_nro_referencia_orden+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_prov_nombre+'<input type="hidden" value="'+value.alm_prov_codigo+'" id="codigos_ordenes_hidden" /></td>';
						//console.log(cod_proy+"---"+value.alm_prov_codigo);
						if(value.doc==0){
							//console.log(cod_prov+"---"+value.alm_prov_codigo);
								tabla_datos = tabla_datos+'<td><a href="#" onClick="new GestionImportacion().formularioListarTransferenciaBancaria('+value.alm_prov_cod_cta+',\''+value.alm_prov_codigo+'\', \''+value.alm_prov_nombre+'\', \''+codigo_proyecto+'\', \''+value.alm_prov_codigo+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><BR>Realizar</a></td>';
						}else{
							//console.log(3);
								tabla_datos = tabla_datos+'<td></td>';
								//tabla_datos = tabla_datos+'<td><a href="#" onClick="new GestionImportacion().formularioListarTransferenciaBancaria('+value.alm_prov_cod_cta+',\''+value.alm_prov_codigo+'\', \''+value.alm_prov_nombre+'\', \''+codigo_proyecto+'\', \''+value.alm_prov_codigo+'\');">Realizar</a></td>';
						}
						//tabla_datos = tabla_datos+'<td><a href="#" onClick="new GestionImportacion().formularioListarTransferenciaBancaria('+value.alm_prov_cod_cta+',\''+value.alm_prov_codigo+'\', \''+value.alm_prov_nombre+'\', \''+codigo_proyecto+'\', \''+value.alm_prov_codigo+'\');">Realizar</a></td>';
						tabla_datos = tabla_datos+'</tr>';
					$('#tabla_datos_orden_compras').append(tabla_datos);	
					});
						
					//new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
					var boton ='<div align="center"><br><br><input class="btn_form" type="button" name="accion" value="Procesar" onClick="new Proyecto().dosAccionesProyecto(\''+codigo_proyecto+'\',5);"><br><br></div>';
					$('#formulario_orden_transferencia_bancaria').append(boton);
				}
		});
		
		
	}
		
		
   /**
	 * Metodo q ejecuta el formulario de nuevotransferencia Bancaria
	 */
	this.formularioGrabarNuevaTransferenciaBancaria = function(cod_cta,cod_prov,nom_prov,cod_proy,cod_prov){
		
		
		//console.log(numero_unico);
		//var orden = new TransferenciaBancaria();
					//orden.formularioListaOrdenes_tpl();
		
		//este es el formulario de la cuenta de banco para la transferencia
		var util = new Utilitarios();
		util.validarCampo('monto_trans_banc', 'error_monto_trans_banc', 'El campo Monto Transf. no puede estar vacio');
		util.validarCampo('comis_trans_banc', 'error_comis_trans_banc', 'El campo Comisi&oacute;n Transf. no puede estar vacio');
		util.validarCampo('numero_doc_trans_banc', 'error_numero_doc_trans_banc', 'El campo Nro. Documento no puede estar vacio');
		$('#monto_trans_banc').numeric(".");
		$('#comis_trans_banc').numeric(".");
		$("#fec_trans_banc").datepicker({
   				dateFormat: "dd/mm/yy"
  		});

			
			 $("#cta_bnco").val('');
			$("#numero_doc_trans_banc").val('');
			$("#fec_trans_banc").val('');
			$("#monto_trans_banc").val('');
			$("#comis_trans_banc").val('');
			$("#obs_trans_banc").val('');
			//$("#formulario_nuevo_transferencia_bancaria").empty();
			$("#label_codigos_proyectos_trans").empty();
			$("#label_codigos_proyectos_trans").append(cod_proy);
			$("#codigos_proyectos_hidden").val(cod_proy);
			$("#label_codigos_Orden_trans").empty();
			$("#label_codigos_Orden_trans").append(nom_prov);
			$("#codigos_ordenes_hidden").val(nom_prov);
			$("#numero_unico_Orden").empty();
			$("#numero_unico_Orden").val(cod_prov);
			$("#cta_bnco").val(cod_cta);
			$("#formulario_nuevo_transferencia_bancaria").dialog({
				height: 450,
				width: 560,
				modal: true,
				resizable: false,
				draggable: false,
				closeText: "hide"
			});
	}
	
   /**
	 * Metodo q ejecuta el formulario de confirmacion de transferencia Bancaria
	 */
	this.formularioNuevaConfirmacionTransferenciaBancaria = function(codigo_proyecto,cod_proy){

		var util = new Utilitarios();
		util.validarCampo('cod_conf_trans_banc', 'error_cod_conf_trans_banc', 'El campo Nro. Documento no puede estar vacio');
		$("#fec_conf_trans_banc").datepicker({
   				dateFormat: "dd/mm/yy"
  		});
				$("#cod_conf_trans_banc").val('');
				$("#fec_conf_trans_banc").val('');
				$("#obs_conf_trans_banc").val('');
				$("#label_codigos_proyectos_conf").empty();
				$("#label_codigos_proyectos_conf").append(codigo_proyecto);
				$("#label_codigos_proveedor_conf").empty();
				$("#label_codigos_proveedor_conf").append(cod_proy);
				$("#codigos_proyectos_hidden_conf").val(codigo_proyecto);
				$("#codigos_proveedor_hidden_conf").val(cod_proy);
				$("#formulario_confirmacion_transferencia_bancaria").dialog({
					height: 380,
					width: 560,
					modal: true,
					resizable: false,
					draggable: false,
					closeText: "hide"
				});
	}
	
	
	/**
	 * Este metodo graba los datos del formulario de transferencia bancaria numero_doc_trans_banc
	 */
	this.grabarNuevaTransferenciaBancaria = function(){
		var util = new Utilitarios();
		var cod_prov = $('#codigos_ordenes_hidden').val();
		if($('#numero_doc_trans_banc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Transferencia Bancaria');
		}else if($('#monto_trans_banc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Monto Transferencia es obligatorio', 'Mensaje Transferencia Bancaria');
		}else if($('#comis_trans_banc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Comisi&oacute;n Transferencia es obligatorio', 'Mensaje Transferencia Bancaria');
		}else if($('#fec_trans_banc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Transferencia Bancaria');
		}else  {
			$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'grabarTransferenciaBancaria',
					
					codigos_proyectos:$('#codigos_proyectos_hidden').val(),
					cta_bco:$('#codigos_ordenes_hidden').val(),
					fec_trans_bco:$('#fec_trans_banc').val(),
					nro_doc_trans_bco:$('#numero_doc_trans_banc').val(),
					obs_trans_bco:$('#obs_trans_banc').val(),
					monto_trans_bco:$('#monto_trans_banc').val(),
					comision_trans_bco:$('#comis_trans_banc').val(),
					numero_unico_orden:$('#numero_unico_Orden').val()
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
								
					
					if(resultado.completo == true){
						
						var estado_proyecto = resultado.estado_proyecto;
						var codigo_proyecto = resultado.codigo_proyecto;
						//new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
						$('#formulario_nuevo_transferencia_bancaria').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Contrato');
						new TransferenciaBancaria().actualizarNuevaTransferenciaBancaria(estado_proyecto, codigo_proyecto,cod_prov)
						//$('#formulario_orden_transferencia_bancaria').empty();
						
						/*$.ajax({
									url:'router/TransferenciaBancariaRouter.php',
									dataType: 'json',
									type: 'POST',
									data : { 
										accion : 'buscartransferencia',
										cod:codigo_proyecto,
										cod_prov:cod_prov
										
									},
									beforeSend : function(){
										
									},
									success: function(resultado){
										
										//console.log(resultado);
										new TransferenciaBancaria().actualizarNuevaTransferenciaBancaria(estado_proyecto,codigo_proyecto,resultado.valor);
									}
						});*/
						
						
						//new TransferenciaBancaria().formularioNuevaTransferenciaBancaria(estado_proyecto,codigo_proyecto);
					
					}else if(resultado.completo == false){

					}
							
				},
				error: function(resultado){
				}
			});	
		}
		
	}
	
	
		/**
	 * Este metodo graba los datos del formulario de confirmacion de transferencia bancaria
	 */
	this.grabarNuevaConfirmacionTransferenciaBancaria = function(){
		var util = new Utilitarios();
		
		if($('#cod_conf_trans_banc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Confirmacion Transferencia Bancaria');
		}else if($('#fec_conf_trans_banc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Confirmacion Transferencia Bancaria');
		}else {
			$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'grabarConfirmacionTransferenciaBancaria',
					
					codigos_proyectos:$('#codigos_proyectos_hidden_conf').val(),
					codigos_proveedores:$('#codigos_proveedor_hidden_conf').val(),
					fec_conf_trans_bco:$('#fec_conf_trans_banc').val(),
					obs_conf_trans_bco:$('#obs_conf_trans_banc').val(),
					cod_conf_trans_bco:$('#cod_conf_trans_banc').val()
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	

					if(resultado.completo == true){
						
						var estado_proyecto = resultado.estado_proyecto;
						var codigo_proyecto = resultado.codigo_proyecto;
						//new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
						$('#formulario_confirmacion_transferencia_bancaria').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Transferencia Bancaria');
						$('#tabla_datos_confirmacion_ban').empty();
						$('#tabla_datos_confirmacion_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new TransferenciaBancaria().actualizarListaConfirmacionTransferenciaBancaria(codigo_proyecto);	
					}else if(resultado.completo == false){

					}	
				},
				error: function(resultado){
				}
			});	
		}
		
	}
	
	
	
   /**
	 * Metodo q ejecuta el formulario de confirmacion de transferencia Bancaria
	 */
	this.formularioNuevaCertificacionTransferenciaBancaria = function(codigo_proyecto,cod_prov){
		//alert(cod_prov);
		var util = new Utilitarios();
		util.validarCampo('cod_cert_trans_banc', 'error_cod_cert_trans_banc', 'El campo Nro. Documento no puede estar vacio');
		util.validarCampo('comis_cert_banc', 'error_comis_cert_banc', 'El campo Comisi&oacute;n Certificado no puede estar vacio');
		$('#comis_cert_banc').numeric('.');
		//$('#comis_cert_banc').numeric();
		$("#fec_cert_trans_banc").datepicker({
   				dateFormat: "dd/mm/yy"
  		});
  		$("#cod_cert_trans_banc").val('');
		$("#fec_cert_trans_banc").val('');
		$("#comis_cert_banc").val('');
		$("#obs_cert_trans_banc").val('');
		$("#label_codigos_proyectos_cert").empty();
		$("#label_codigos_proyectos_cert").append(codigo_proyecto);
		$("#label_codigos_proveedor_cert").empty();
		$("#label_codigos_proveedor_cert").append(cod_prov);
		$("#codigos_proyectos_hidden_cert").val(codigo_proyecto);
		$("#codigos_proveedor_hidden_cert").val(cod_prov);
		$("#formulario_certificacion_transferencia_bancaria").dialog({
			height: 350,
			width: 560,
			modal: true,
			resizable: false,
			draggable: false,
			closeText: "hide"
		});
	}
	
	
		/**
	 * Este metodo graba los datos del formulario de confirmacion de transferencia bancaria
	 */
	this.grabarNuevaCertificacionTransferenciaBancaria = function(){
		var util = new Utilitarios();
		
		if($('#cod_cert_trans_banc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Certificacion Transferencia Bancaria');
		}else if($('#comis_cert_banc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Comisi&oacute;n Certificado es obligatorio', 'Mensaje Certificacion Transferencia Bancaria');
		}else if($('#fec_cert_trans_banc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Certificacion Transferencia Bancaria');
		}else {
			$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'grabarCertificacionTransferenciaBancaria',
					
					codigos_proyectos:$('#codigos_proyectos_hidden_cert').val(),
					codigos_proveedores:$('#codigos_proveedor_hidden_cert').val(),
					fec_cert_trans_bco:$('#fec_cert_trans_banc').val(),
					obs_cert_trans_bco:$('#obs_cert_trans_banc').val(),
					cod_cert_trans_bco:$('#cod_cert_trans_banc').val(),
					comis_cert_banc:$('#comis_cert_banc').val()
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
					if(resultado.completo == true){
						
						var estado_proyecto = resultado.estado_proyecto;
						var codigo_proyecto = resultado.codigo_proyecto;
						//new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Certificado');
						$('#formulario_certificacion_transferencia_bancaria').dialog('close'); // hace que se cierre el dialog
						$('#tabla_datos_certificado_ban').empty();
						$('#tabla_datos_certificado_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new TransferenciaBancaria().actualizarListaCertificadoBancario(codigo_proyecto);	
					}else if(resultado.completo == false){

					}
							
				},
				error: function(resultado){
				}
			});	
		}
		
	}

	   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.formularioListaCertificadoBancario = function(codigo_proyecto){
		//alert(codigo_proyecto);
			$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarCertificadosBancarios',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_certificado_ban').empty();
	  		        $('#tabla_datos_certificado_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					var codigo_proveedor=resultado[0].alm_prov_id;
					console.log(codigo_proyecto+estado_proyecto+codigo_proveedor);
					
					$('#tabla_datos_certificado_ban').empty();
					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO. TRANF.</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">FECHA CERTIFICADO</th>';
						tabla_datos = tabla_datos+'<th align="center">MONTO TRANSFERENCIA</th>';
						tabla_datos = tabla_datos+'<th align="center">OBSERVACIONES</th>';
						tabla_datos = tabla_datos+'<th align="center" colspan="2">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_form_nro_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_fecha_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_monto_transf+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_observaciones+'</td>';
						
						if (value.alm_form_monto_transf>5000) {
							if (value.doc==0) {
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioCertificacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div></td></tr>';

							}else{
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificadoBancario('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div> </td></tr>';

							}
						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioCertificacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div></td><td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificadoBancario('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div> </td></tr>';
						
						}else {
						tabla_datos = tabla_datos+'<td></td></tr>';
					    }
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarCertificadoBancario(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_certificado_ban').append(tabla_datos);
					$("#formulario_lista_certificado_ban").dialog({
							height: 480, 
							width: 1010,
							modal: true,
							resizable: true,
							draggable: false,
							closeText: "hide"
						});					
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}


	   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.formularioListaConfirmacionTransferenciaBancaria = function(codigo_proyecto){
		//alert(codigo_proyecto);
			$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarConfirmaciones',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_confirmacion_ban').empty();
	  		        $('#tabla_datos_confirmacion_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_datos_confirmacion_ban').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO. TRANF.</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">MONTO TRANSFERENCIA</th>';
						tabla_datos = tabla_datos+'<th align="center">OBSERVACIONES</th>';
						tabla_datos = tabla_datos+'<th align="center" colspan="2">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_form_nro_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_monto_transf+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_observaciones+'</td>';
							if (value.doc==0) {
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nueva Conf.</a></div></td></tr>';
							}else{
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarConfirmacionBancaria('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
						    }
						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nueva Conf.</a></div></td><td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarConfirmacionBancaria('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarConfirmacionBancaria(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_confirmacion_ban').append(tabla_datos);
					$("#formulario_lista_confirmacion_ban").dialog({
							height: 480, 
							width: 1010,
							modal: true,
							resizable: true,
							draggable: false,
							closeText: "hide"
						});					
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}


	   /**
	 * Metodo q ejecuta actualiza de las lista de certificados
	 */
	this.actualizarListaConfirmacionTransferenciaBancaria = function(codigo_proyecto){
		//alert(codigo_proyecto);
			$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarConfirmaciones',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_confirmacion_ban').empty();
	  		        $('#tabla_datos_confirmacion_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_datos_confirmacion_ban').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO. TRANF.</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">MONTO TRANSFERENCIA</th>';
						tabla_datos = tabla_datos+'<th align="center">OBSERVACIONES</th>';
						tabla_datos = tabla_datos+'<th align="center" colspan="2">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_form_nro_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_monto_transf+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_observaciones+'</td>';
							if (value.doc==0) {
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nueva Conf.</a></div></td></tr>';
							}else{
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarConfirmacionBancaria('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
						    }
						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nueva Conf.</a></div></td><td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarConfirmacionBancaria('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarConfirmacionBancaria(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_confirmacion_ban').append(tabla_datos);		
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}

	   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.actualizarListaCertificadoBancario = function(codigo_proyecto){
		//alert(codigo_proyecto);
			$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarCertificadosBancarios',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_certificado_ban').empty();
	  		        $('#tabla_datos_certificado_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					var codigo_proveedor=resultado[0].alm_prov_id;
					console.log(codigo_proyecto+estado_proyecto+codigo_proveedor);
					
					$('#tabla_datos_certificado_ban').empty();
					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO. TRANF.</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">FECHA CERTIFICADO</th>';
						tabla_datos = tabla_datos+'<th align="center">MONTO TRANSFERENCIA</th>';
						tabla_datos = tabla_datos+'<th align="center">OBSERVACIONES</th>';
						tabla_datos = tabla_datos+'<th align="center" colspan="2">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_form_nro_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_fecha_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_monto_transf+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_observaciones+'</td>';
						
						if (value.alm_form_monto_transf>5000) {
								if (value.doc==0) {
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioCertificacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div></td></tr>';

							}else{
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificadoBancario('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div> </td></tr>';

							}

						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioCertificacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div></td><td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificadoBancario('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div> </td></tr>';
						}else {
						tabla_datos = tabla_datos+'<td></td></tr>';
					    }
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarCertificadoBancario(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_certificado_ban').append(tabla_datos);	
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}
/**
	 * Metodo q ejecuta el detalle del certificado
	 */
	this.formularioDetallarConfirmacionBancaria = function(id_confirmacion, codigo_proyecto,cod_prov){
	//alert("Detallar Certificado JS"+id_confirmacion+codigo_proyecto);
	var util = new Utilitarios();
		$('#codigo_proyecto_detallesconf_div').empty();
		$('#codigo_proyecto_detallesconf_div').append(codigo_proyecto);
		$('#id_confirmacion_detalles_hidden').val(id_confirmacion);
		$('#codigos_proyecto_confirmacion_hidden').val(""+codigo_proyecto);

		$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DetallesConfirmacionBancaria',
					codigo_proyecto :codigo_proyecto,
					id_confirmacion:id_confirmacion,
					cod_prov:cod_prov
						
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
				//alert(id_certificado);
				
				var id_confirmacion=resultado[0].alm_form_id;
				var codigo_proyecto=resultado[0].alm_proy_cod;
				var codigo_proveedor=resultado[0].alm_prov_id;
				var estado_proyecto=resultado[0].alm_form_tipo;
				var nro_proyecto=resultado[0].alm_form_nro_doc;
				var fecha_proyecto=resultado[0].alm_form_fecha_doc;
				var obs_proyecto=resultado[0].alm_form_observaciones;
				var com_cert=resultado[0].alm_form_comision_cert;

					$('#tabla_datos_confirmacion_detalle_ban').empty();
					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label><span id="codigo_proyectos_detalles_div"></span>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br><br>';
						tabla_datos = tabla_datos+'<label><strong>C&Oacute;DIGO PROVEEDOR:</strong> </label><span id="codigo_proveedores_detalles_div"></span>';
						tabla_datos = tabla_datos+'<label>'+codigo_proveedor+'</label>';
						tabla_datos = tabla_datos+'<table><tr>';
					    tabla_datos = tabla_datos+'<td ><strong>Nro. de Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input type="text" class="txt_campo" name="nro_doc_conf_det_ban" id="nro_doc_conf_det_ban" value="'+nro_proyecto+'"><div id="error_nro_doc_conf_det_ban"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td ><strong>Fecha Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="fec_doc_conf_det_ban" maxlength="60"id="fec_doc_conf_det_ban" value="'+fecha_proyecto+'"><div id="error_fec_doc_conf_det_ban"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td ><strong>Observaciones :</strong></td>';
					    tabla_datos = tabla_datos+'<td><textarea  name="obs_conf_det_ban" id="obs_conf_det_ban" cols="50" rows="2">'+obs_proyecto+'</textarea><div id="error_obs_conf_det_ban"></div></td></tr>';
						tabla_datos = tabla_datos+'</table>';
						tabla_datos = tabla_datos+'<tr align="center">';
						tabla_datos = tabla_datos+'<td> <br><input class="btn_form" type="button" name="accion" value="Modificar" onClick="new GestionImportacion().modificarDetalleConfirmacionBancaria('+id_confirmacion+',\''+codigo_proyecto+'\',\''+codigo_proveedor+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Dar de baja" onClick="new GestionImportacion().darBajaConfirmacionBancaria('+id_confirmacion+',\''+codigo_proyecto+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Cancelar" onClick="new GestionImportacion().cancelarConfirmacionBancaria();"></td>';
						tabla_datos = tabla_datos+'</tr></div></div>';
					$('#tabla_datos_confirmacion_detalle_ban').append(tabla_datos);
					util.validarCampo('nro_doc_conf_det_ban', 'error_nro_doc_conf_det_ban', 'El campo Nro. Certificado no puede estar vacio');
					$("#fec_doc_conf_det_ban").datepicker({
			          dateFormat: "dd/mm/yy"
		            });

					$("#formulario_detallar_confirmacion_ban").dialog({
							
							height: 350,
							width: 600,
							modal: true,
							resizable: false,
							draggable: false,
							closeText: "hide"
						});	
				},
				error: function(resultado){
				//alert("NO GRABO BIEN...");
				util.mostrarMensajeAlerta(0, 'No existe datos en la confirmacion para detallar', 'Alerta Confirmacion');
				//console.log(resultado);
				}
			});	
	}
   /**
	 * Metodo q ejecuta el detalle del certificado
	 */
	this.formularioDetallarCertificadoBancario = function(id_certificado, codigo_proyecto, cod_prov){
	//alert("Detallar Certificado JS"+id_certificado+codigo_proyecto+cod_prov);
	var util = new Utilitarios();
		$('#codigo_proyecto_detalles_div').empty();
		$('#codigo_proyecto_detalles_div').append(codigo_proyecto);
		$('#id_certificado_detalles_hidden').val(id_certificado);
		$('#codigos_proyecto_detalles_hidden').val(""+codigo_proyecto);

		$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DetallesCertificadosBancarios',
					codigo_proyecto :codigo_proyecto,
					id_certificado:id_certificado,
					cod_prov:cod_prov
						
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
				//alert(id_certificado);
				
				var id_certificado=resultado[0].alm_form_id;
				var codigo_proyecto=resultado[0].alm_proy_cod;
				var codigo_proveedor=resultado[0].alm_prov_id;
				var estado_proyecto=resultado[0].alm_form_tipo;
				var nro_proyecto=resultado[0].alm_form_nro_doc;
				var fecha_proyecto=resultado[0].alm_form_fecha_doc;
				var obs_proyecto=resultado[0].alm_form_observaciones;
				var com_cert=resultado[0].alm_form_comision_cert;

					$('#tabla_datos_certificado_detalle_ban').empty();
					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label><span id="codigo_proyecto_detalles_div"></span>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br>';
						tabla_datos = tabla_datos+'<label><strong>C&Oacute;DIGO PROVEEDOR:</strong> </label><span id="codigo_proveedor_detalles_div"></span>';
						tabla_datos = tabla_datos+'<label>'+codigo_proveedor+'</label>';
						tabla_datos = tabla_datos+'<input type="hidden" value="" id="id_certificado_detalles_hidden"/>';
						tabla_datos = tabla_datos+'<input type="hidden" id="codigos_proyecto_detalles_hidden" value=""/><br>';
						tabla_datos = tabla_datos+'<table><tr>';
					    tabla_datos = tabla_datos+'<td ><strong>Nro. de Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input type="text" class="txt_campo" name="nro_doc_cert_det_ban" id="nro_doc_cert_det_ban" value="'+nro_proyecto+'"><div id="error_nro_doc_cert_det_ban"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td ><strong>Fecha Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="fec_doc_cert_det_ban" maxlength="60"id="fec_doc_cert_det_ban" value="'+fecha_proyecto+'"><div id="error_fec_doc_cert_det_ban"></div></td></tr>';
					    tabla_datos = tabla_datos+'<td ><strong>Comisi&oacute;n Certificado :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input type="number" class="txt_campo" name="comis_cert_otros_det_ban" id="comis_cert_otros_det_ban" value="'+com_cert+'"><div id="error_comis_cert_otros_det_ban"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td ><strong>Observaciones :</strong></td>';
					    tabla_datos = tabla_datos+'<td><textarea  name="obs_cert_det_ban" id="obs_cert_det_ban" cols="50" rows="2">'+obs_proyecto+'</textarea><div id="error_obs_cert_det_ban"></div></td></tr>';
						tabla_datos = tabla_datos+'</table>';
						tabla_datos = tabla_datos+'<tr align="center">';
						tabla_datos = tabla_datos+'<td> <br><input class="btn_form" type="button" name="accion" value="Modificar" onClick="new GestionImportacion().modificarDetalleCertificadoBancario('+id_certificado+',\''+codigo_proyecto+'\',\''+codigo_proveedor+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Dar de baja" onClick="new GestionImportacion().darBajaCertificadoBancario('+id_certificado+',\''+codigo_proyecto+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Cancelar" onClick="new GestionImportacion().cancelarCertificadoBancario();"></td>';
						tabla_datos = tabla_datos+'</tr></div></div>';
					$('#tabla_datos_certificado_detalle_ban').append(tabla_datos);
					util.validarCampo('nro_doc_cert_det_ban', 'error_nro_doc_cert_det_ban', 'El campo Nro. Certificado no puede estar vacio');
					$("#comis_cert_otros_det_ban").datepicker({
			          dateFormat: "dd/mm/yy"
		            });
		            $('#comis_cert_banc').numeric('.');
					$("#formulario_detallar_certificado_ban").dialog({
							
							height: 350,
							width: 600,
							modal: true,
							resizable: false,
							draggable: false,
							closeText: "hide"
						});	
				},
				error: function(resultado){
				//alert("NO GRABO BIEN...");
				util.mostrarMensajeAlerta(0, 'No existe datos en el certificado para detallar', 'Alerta Certificado Bancario');
				//console.log(resultado);
				}
			});	
	}

	 /**
	 * Metodo q graba lo modificado  formulario de Confirmaciones
	 */
	this.modificarDetalleConfirmacionBancaria=function(id_confirmacion, codigo_proyecto,cod_prov){
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		//alert("GUIA GRABAR NRO"+$('#nro_doc_cert_det').val());
		//alert("GUIA GRABAR FECHA"+$('#fec_doc_cert_det').val());
		//alert("GUIA GRABAR OBS"+$('#obs_cert_det').val());
		//alert("GUIA GRABAR JS"+id_confirmacion+codigo_proyecto);
		//alert("jjjjj");
		var util = new Utilitarios();

		if ($('#nro_doc_conf_det_ban').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Confirmacion Bancaria');

		}else if ($('#fec_doc_conf_det_ban').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento  es obligatorio', 'Mensaje Confirmacion Bancaria');

		}else {
			console.log("Registrando...");
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'ModificarConfirmacionBancaria',
					id_confirmacion :id_confirmacion,
					numero_documento :$('#nro_doc_conf_det_ban').val(),
					codigo_proyecto :codigo_proyecto,
					fec_doc : $('#fec_doc_conf_det_ban').val(),
					descripcion_cert : $('#obs_conf_det_ban').val(),
					cod_prov:cod_prov
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

				if(resultado.completo == true){
						//alert("GRABO BIEN...");
						
						var estado=resultado.tipo_formulario;
						var codigo=resultado.codigo_proyecto;
						//alert(estado+codigo);
						//var estado=resultado[0].tipo_formulario;
						//var codigo=resultado[0].codigo_proyecto;
						//new Proyecto().updateProyecto(estado, codigo);
						$('#formulario_detallar_confirmacion_ban').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Confirmacion Bancaria');
						$('#tabla_datos_confirmacion_ban').empty();
						$('#tabla_datos_confirmacion_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new TransferenciaBancaria().actualizarListaConfirmacionTransferenciaBancaria(codigo);	
					}else if(resultado.completo == false){

					}
							
				},
				error: function(resultado){
					 alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		}
	}


	  /**
	 * Metodo q da de baja al confirmacion dentro del detalle
	 */
	this.darBajaConfirmacionBancaria = function(id_confirmacion, codigo_proyecto){
	//alert("JS"+id_certificado+codigo_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaConfirmacionesBancarias',
					codigo_proyecto :codigo_proyecto,
					id_confirmacion:id_confirmacion 
						
				},
				beforeSend : function(){
			    	$('#formulario_detallar_confirmacion_ban').dialog('close'); // hace que se cierre el dialog
				},
				success: function(resultado){	
				if(resultado.completo == true){
				var estado=resultado.tipo_formulario;
				var codigo=resultado.codigo_proyecto;
				//alert("GRABO BIEN..."+estado+codigo);
				
				util.mostrarMensajeAlerta(3, 'Se dio de baja correctamente a la Confirmacion Bancaria', 'Confirmacion Confirmacion Bancaria');
				new TransferenciaBancaria().actualizarListaConfirmacionTransferenciaBancaria(codigo);	
				}else if(resultado.completo == false){
				//alert("FALSO...");
					}

				},
				error: function(resultado){
				alert("NO GRABO BIEN...");
				//console.log(resultado);
				}
			});	
    }

          /**
	 * Metodo q da de baja al certificado dentro de la lista de certificados
	 */
	this.darBajaConfirmacionBancariaLista = function(id_confirmacion, codigo_proyecto){
	//alert("JS"+id_certificado+codigo_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaConfirmacionesBancarias',
					codigo_proyecto :codigo_proyecto,
					id_confirmacion:id_confirmacion 
						
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
				if(resultado.completo == true){
				var estado=resultado.tipo_formulario;
				var codigo=resultado.codigo_proyecto;
				//alert("GRABO BIEN..."+estado+codigo);
				util.mostrarMensajeAlerta(1,'Se dio de baja correctamente a la Confirmacion Bancaria', 'Confirmacion Confirmacion Bancaria');
				new TransferenciaBancaria().actualizarListaConfirmacionTransferenciaBancaria(codigo);	
				}else if(resultado.completo == false){
				alert("FALSO...");
					}

				},
				error: function(resultado){
				alert("NO GRABO BIEN...");
				//console.log(resultado);
				}
			});	
    }

	 /**
	 * Metodo q graba lo modificado  formulario de Certificados
	 */
	this.modificarDetalleCertificadoBancario=function(id_certificado, codigo_proyecto,cod_prov){
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		//alert("GUIA GRABAR NRO"+$('#nro_doc_cert_det').val());
		//alert("GUIA GRABAR FECHA"+$('#fec_doc_cert_det').val());
		//alert("GUIA GRABAR OBS"+$('#obs_cert_det').val());
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		//alert("jjjjj");
		var util = new Utilitarios();

		if ($('#nro_doc_cert_det_ban').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Certificado');

		}else if ($('#comis_cert_otros_det_ban').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Comisi&oacute;n Certificado es obligatorio', 'Mensaje Certificado');

		}else if($('#fec_doc_cert_det_ban').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Certificado');
		}else {
			console.log("Registrando...");
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'ModificarCertificadoBancario',
					id_certificado :id_certificado,
					numero_documento :$('#nro_doc_cert_det_ban').val(),
					codigo_proyecto :codigo_proyecto,
					fec_doc : $('#fec_doc_cert_det_ban').val(),
					descripcion_cert : $('#obs_cert_det_ban').val(),
					comis_cert_otros_det : $('#comis_cert_otros_det_ban').val(),
					cod_prov:cod_prov
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

				if(resultado.completo == true){
						//alert("GRABO BIEN...");
						
						var estado=resultado.tipo_formulario;
						var codigo=resultado.codigo_proyecto;
						//alert(estado+codigo);

						
						//var estado=resultado[0].tipo_formulario;
						//var codigo=resultado[0].codigo_proyecto;
						//new Proyecto().updateProyecto(estado, codigo);
						$('#formulario_detallar_certificado_ban').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Certificado Bancario');
						$('#tabla_datos_certificado_detalle_ban').empty();
						$('#tabla_datos_certificado_detalle_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new TransferenciaBancaria().actualizarListaCertificadoBancario(codigo);	
					}else if(resultado.completo == false){

					}
							
				},
				error: function(resultado){
					 alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		}
	}


	  /**
	 * Metodo q da de baja al certificado dentro del detalle
	 */
	this.darBajaCertificadoBancario = function(id_certificado, codigo_proyecto){
	//alert("JS"+id_certificado+codigo_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaCertificadosBancarios',
					codigo_proyecto :codigo_proyecto,
					id_certificado:id_certificado 
						
				},
				beforeSend : function(){
			    	$('#formulario_detallar_certificado_ban').dialog('close'); // hace que se cierre el dialog
				},
				success: function(resultado){	
				if(resultado.completo == true){
				var estado=resultado.tipo_formulario;
				var codigo=resultado.codigo_proyecto;
				//alert("GRABO BIEN..."+estado+codigo);
				
				util.mostrarMensajeAlerta(3, 'Se dio de baja correctamente al certificado', 'Confirmacion Certificado Bancario');
				new TransferenciaBancaria().actualizarListaCertificadoBancario(codigo);	
				}else if(resultado.completo == false){
				//alert("FALSO...");
					}

				},
				error: function(resultado){
				alert("NO GRABO BIEN...");
				//console.log(resultado);
				}
			});	
    }

          /**
	 * Metodo q da de baja al certificado dentro de la lista de certificados
	 */
	this.darBajaCertificadoBancarioLista = function(id_certificado, codigo_proyecto){
	//alert("JS"+id_certificado+codigo_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaCertificadosBancarios',
					codigo_proyecto :codigo_proyecto,
					id_certificado:id_certificado 
						
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
				if(resultado.completo == true){
				var estado=resultado.tipo_formulario;
				var codigo=resultado.codigo_proyecto;
				//alert("GRABO BIEN..."+estado+codigo);
				util.mostrarMensajeAlerta(1, 'Se dio de baja correctamente al certificado', 'Confirmacion Certificado');
				new TransferenciaBancaria().actualizarListaCertificadoBancario(codigo);	
				}else if(resultado.completo == false){
				alert("FALSO...");
					}

				},
				error: function(resultado){
				alert("NO GRABO BIEN...");
				//console.log(resultado);
				}
			});	
    }

        		 /**
	 * Metodo q cancela lo modificado  formulario de Confirmaciones
	 */
	this.cancelarConfirmacionBancaria=function(){
		//alert("CANCELAR...");
		$('#formulario_detallar_confirmacion_ban').dialog('close'); // hace que se cierre el dialog
	}
    		 /**
	 * Metodo q cancela lo modificado  formulario de Certificados
	 */
	this.cancelarCertificadoBancario=function(){
		//alert("CANCELAR...");
		$('#formulario_detallar_certificado_ban').dialog('close'); // hace que se cierre el dialog
	}

			 /**
	 * Metodo q procesa el formulario de Certificados para cambiar de estado
	 */
	this.procesarCertificadoBancario=function(codigo_proyecto,estado_proyecto){
		//console.log(codigo_proyecto+estado_proyecto)
		var util = new Utilitarios();
		$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'procesarCertificadoBancario',
					estado_proyecto :estado_proyecto,
					codigo_proyecto :codigo_proyecto
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

				if(resultado.completo== true){
						//alert("GRABO BIEN...");
						//$('#formulario_lista_certificado_ban').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(2, 'Se proceso correctamente los certificados Bancarios', 'Confirmacion Certificado Bancario');
						$(location).attr('href', 'imp_gest_imp.php');
						//$('#tabla_datos_proyectos').empty();
						//$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						//new Proyecto().listarProyectos();
					}else if(resultado.completo== false){
						//alert("NO ELSE...");
					}
							
				},
				error: function(resultado){
					 alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});
	}
	
			 /**
	 * Metodo q procesa el formulario de Certificados para cambiar de estado
	 */
	this.procesarConfirmacionBancaria=function(codigo_proyecto,estado_proyecto){
		//console.log(codigo_proyecto+estado_proyecto)
		var util = new Utilitarios();
		$.ajax({
				url:'router/TransferenciaBancariaRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'procesarConfirmacionBancaria',
					estado_proyecto :estado_proyecto,
					codigo_proyecto :codigo_proyecto
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

				if(resultado.completo== true){
						//alert("GRABO BIEN...");
						//$('#formulario_lista_confirmacion_ban').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(2, 'Se proceso correctamente las Confirmaciones Bancarias', 'Confirmacion Confirmacion Bancaria');
						$(location).attr('href', 'imp_gest_imp.php');
						//$('#tabla_datos_proyectos').empty();
						//$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						//new Proyecto().listarProyectos();
					}else if(resultado.completo== false){
						//alert("NO ELSE...");
					}
							
				},
				error: function(resultado){
					 alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});
	}
	
	
}