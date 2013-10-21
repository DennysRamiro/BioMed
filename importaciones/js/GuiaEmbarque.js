
/**
 * @description Esta clase es la que gestiona los eventos y acciones de Guia Embarque
 * @author Ruth Palomino
 * @date  21/05/2013
 */

function GuiaEmbarque(){
  	   
	   /**
	 * Metodo q ejecuta formulario de Guia de Embarque
	 */
	this.formularioGuiaEmbarque = function(id_proyecto, codigo_proyecto){
		console.log(id_proyecto);
		console.log(codigo_proyecto);
		var util = new Utilitarios();
		$.ajax({
				url:'router/GuiaEmbarqueRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'consolidadoGuia',
					codigo_proyecto :codigo_proyecto
			
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
				//alert(resultado.nro_prov);
				if (resultado.nro_prov>1) {
					util.validarCampo('nro_doc_guia', 'error_nro_doc_guia', 'El campo Nro. Documento no puede estar vacio');
					//alert("GUIA JS");
					$("#fec_doc_guia").datepicker({
						dateFormat: "dd/mm/yy"
					});
					$("#label_codigo_proyectos").empty();
					$("#label_codigo_proyectos").append(codigo_proyecto);
					$("#codigo_proyectos_hidden").val(codigo_proyecto);
					$("#formulario_nueva_guia_embarque").dialog({
						height: 350,
						width: 680,
						modal: true,
						resizable: true,
						draggable: false,
						closeText: "hide"
					});
				}else{

				util.mostrarMensajeAlerta(0, 'No existen datos para Consolidado', 'Mensaje Guia de Embarque');


				}

				},
				error: function(resultado){
					 alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
				});
		
	}

	   /**
	 * Metodo q ejecuta formulario de Guia de Embarque lista
	 */
	this.formularioGuiaEmbarqueLista = function(codigo_proyecto,cod_prov){
		//console.log(id_proyecto);
		//console.log(codigo_proyecto);
		//alert(codigo_proyecto+cod_prov);
		var util = new Utilitarios();
		util.validarCampo('cod_ge_doc', 'error_cod_ge_doc', 'El campo Nro. Documento no puede estar vacio');
		//alert("GUIA JS");
		$("#fec_ge_doc").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#cod_ge_doc").val('');
		$("#fec_ge_doc").val('');
		$("#obs_ge_doc").val('');
		$("#label_codigos_proyectos_ge").empty();
		$("#label_codigos_proveedor_ge").empty();
		$("#label_codigos_proyectos_ge").append(codigo_proyecto);
		$("#label_codigos_proveedor_ge").append(cod_prov);
		$("#codigos_proyectos_hidden_ge").val(codigo_proyecto);
		$("#codigos_proveedor_hidden_ge").val(cod_prov);
		$("#formulario_nueva_guia_embarque_lista").dialog({
			height: 400,
			width: 680,
			modal: true,
			resizable: true,
			draggable: false,
			closeText: "hide"
		});
		
	}

	 /**
	 * Metodo q graba formulario de Guia de Embarque
	 */
	this.grabarformularioGuiaEmbarque=function(){
		//alert("GUIA GRABAR JS");
		var util = new Utilitarios();

		if ($('#nro_doc_guia').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Guia de Embarque');

		}else if($('#fec_doc_guia').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Guia de Embarque');
		}else {
			//console.log($('#cert_emb').val());
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/GuiaEmbarqueRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'grabarNuevaGuiaEmbarque',
					numero_documento:$('#nro_doc_guia').val(),
					codigo_proyecto :$('#codigo_proyectos_hidden').val(),
					fec_doc : $('#fec_doc_guia').val(),
					descripcion_guia : $('#obs_guia').val(),
					cert : $('input[name=cert_emb]:checked').val()
					


					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

					if(resultado.completo == true){
						//alert("GRABO BIEN...");
						var estado=resultado.tipo_formulario;
						var codigo=resultado.codigo_proyecto;
						//new Proyecto().updateProyecto(codigo,estado);
						//$('#formulario_nueva_guia_embarque').dialog('close'); // hace que se cierre el dialog
						//util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Guia de Embarque');
						//$('#tabla_datos_proyectos').empty();
						//$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						//new Proyecto().listarProyectos();

						$.ajax({
									url:'router/GuiaEmbarqueRouter.php',
									dataType: 'json',
									type: 'POST',
									data : { 
										
										accion : 'procesarGuiaEmbarque',
										estado_proyecto :estado,
										codigo_proyecto :codigo
										
									},
									beforeSend : function(){
							
									},
									success: function(res){					
										//alert("GRABO BIEN...");

									if(res.completo== true){
											//alert("GRABO BIEN...");
											//$('#formulario_lista_certificado_ban').dialog('close'); // hace que se cierre el dialog
											util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Guia Embarque');
											$(location).attr('href', 'imp_gest_imp.php');
											//$('#tabla_datos_proyectos').empty();
											//$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
											//new Proyecto().listarProyectos();
										}else if(res.completo== false){
											//alert("NO ELSE...");
										}
												
									},
									error: function(resultado){
										 alert("NO GRABO BIEN...");
										//console.log(resultado);
									}
								});
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
	 * Metodo q graba formulario de Guia de Embarque
	 */
	this.grabarFormularioGuiaEmbarqueLista=function(){
		//alert("GUIA GRABAR JS");
		var util = new Utilitarios();

		if ($('#cod_ge_doc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Guia de Embarque');

		}else if($('#fec_ge_doc').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Guia de Embarque');
		}else {
			//console.log($('#cert_emb').val());
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/GuiaEmbarqueRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'grabarNuevaGuiaEmbarquelista',
					numero_documento:$('#cod_ge_doc').val(),
					codigo_proyecto :$('#codigos_proyectos_hidden_ge').val(),
					codigo_proveedor :$('#codigos_proveedor_hidden_ge').val(),
					fec_doc : $('#fec_ge_doc').val(),
					descripcion_guia : $('#obs_ge_doc').val(),
					cert : $('input[name=cert_emb_lis]:checked').val()
					


					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

					if(resultado.completo == true){
						//alert("GRABO BIEN...");
						var estado=resultado.tipo_formulario;
						var codigo=resultado.codigo_proyecto;
						//new Proyecto().updateProyecto(codigo,estado);
						$('#formulario_nueva_guia_embarque_lista').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Guia de Embarque');
						//$('#tabla_datos_proyectos').empty();
						//$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new GestionImportacion().actualizarListaGuiaEmbarque(codigo);


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
	 * Metodo q ejecuta el detalle del certificado
	 */
	this.formularioDetallarGuiaEmbarque = function(id_guia, codigo_proyecto,cod_prov){
	//alert("Detallar Certificado JS"+id_guia+codigo_proyecto);
	var util = new Utilitarios();
		//$('#codigo_proyecto_detallesconf_div').empty();
		//$('#codigo_proyecto_detallesconf_div').append(codigo_proyecto);
		//$('#id_confirmacion_detalles_hidden').val(id_confirmacion);
		//$('#codigos_proyecto_confirmacion_hidden').val(""+codigo_proyecto);

		$.ajax({
				url:'router/GuiaEmbarqueRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DetallesGuiaEmbarque',
					codigo_proyecto :codigo_proyecto,
					id_guia:id_guia,
					cod_prov:cod_prov
						
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
				//alert(id_certificado);
				
				var id_guia=resultado[0].alm_form_id;
				var codigo_proyecto=resultado[0].alm_proy_cod;
				var codigo_proveedor=resultado[0].alm_prov_id;
				var estado_proyecto=resultado[0].alm_form_tipo;
				var nro_proyecto=resultado[0].alm_form_nro_doc;
				var fecha_proyecto=resultado[0].alm_form_fecha_doc;
				var obs_proyecto=resultado[0].alm_form_observaciones;
				var com_cert=resultado[0].alm_form_comision_cert;
				var radio=resultado[0].alm_form_cert_otros;

					$('#tabla_datos_guia_embarque_detalle').empty();
					var tabla_datos = '<label><strong>C&oacute;digo Proyecto:</strong> </label><span id="codigo_proyectos_detalles_div"></span>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br>';
						tabla_datos = tabla_datos+'<label><strong>C&oacute;digo Proveedor:</strong> </label><span id="codigo_proveedores_detalles_div"></span>';
						tabla_datos = tabla_datos+'<label>'+codigo_proveedor+'</label>';
						tabla_datos = tabla_datos+'<table><tr>';
					    tabla_datos = tabla_datos+'<td ><strong>Nro. de Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input type="text" class="txt_campo" name="nro_doc_ge_det" id="nro_doc_ge_det" value="'+nro_proyecto+'"><div id="error_nro_doc_conf_det"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td ><strong>Fecha Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="fec_doc_ge_det" maxlength="60"id="fec_doc_ge_det" value="'+fecha_proyecto+'"><div id="error_fec_doc_ge_det"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td ><strong>Observaciones :</strong></td>';
					    tabla_datos = tabla_datos+'<td><textarea  name="obs_ge_det" id="obs_ge_det" cols="50" rows="2">'+obs_proyecto+'</textarea><div id="error_obs_ge_det"></div></td></tr>';
						if (radio==0) {
						tabla_datos = tabla_datos+'<form id="radio"><tr><th align="right">Con Certificado :</th><td><input type="radio" name="cert_emb_det"  value="1"></td></tr>';
						tabla_datos = tabla_datos+'<tr><th align="right">Sin Certificado :</th><td><input type="radio" name="cert_emb_det"  value="0" checked="checked"></td></tr></form>';
						}else if(radio==1) {
						tabla_datos = tabla_datos+'<form id="radio"><tr><th align="right">Con Certificado :</th><td><input type="radio" name="cert_emb_det"  value="1" checked="checked"></td></tr>';
						tabla_datos = tabla_datos+'<tr><th align="right">Sin Certificado :</th><td><input type="radio" name="cert_emb_det"  value="0"></td></tr></form>';
						}
						tabla_datos = tabla_datos+'</table>';
						tabla_datos = tabla_datos+'<tr align="center">';
						tabla_datos = tabla_datos+'<td> <br><input class="btn_form" type="button" name="accion" value="Modificar" onClick="new GestionImportacion().modificarDetallarGuiaEmbarque('+id_guia+',\''+codigo_proyecto+'\',\''+codigo_proveedor+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Dar de baja" onClick="new GestionImportacion().darBajaGuiaEmbarque('+id_guia+',\''+codigo_proyecto+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Cancelar" onClick="new GuiaEmbarque().cancelarGuiaEmbarque();"></td>';
						tabla_datos = tabla_datos+'</tr></div></div>';
					$('#tabla_datos_guia_embarque_detalle').append(tabla_datos);
					util.validarCampo('nro_doc_ge_det', 'error_nro_doc_ge_det', 'El campo Nro. Documento no puede estar vacio');
					$("#fec_doc_ge_det").datepicker({
			          dateFormat: "dd/mm/yy"
		            });
					$("#formulario_detallar_guia_embarque").dialog({
							
							height: 400,
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
	 * Metodo q graba lo modificado  formulario de Confirmaciones
	 */
	this.modificarDetallarGuiaEmbarque=function(id_guia, codigo_proyecto,cod_prov){
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		//alert("GUIA GRABAR NRO"+$('#nro_doc_cert_det').val());
		//alert("GUIA GRABAR FECHA"+$('#fec_doc_cert_det').val());
		//alert("GUIA GRABAR OBS"+$('#obs_cert_det').val());
		//alert("GUIA GRABAR JS"+id_confirmacion+codigo_proyecto);
		//alert("jjjjj");
		var util = new Utilitarios();

		if ($('#nro_doc_ge_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Confirmacion Bancaria');

		}else if ($('#fec_doc_ge_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento  es obligatorio', 'Mensaje Confirmacion Bancaria');

		}else {
			console.log("Registrando...");
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/GuiaEmbarqueRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'ModificarGuiaEmbarque',
					id_guia :id_guia,
					numero_documento :$('#nro_doc_ge_det').val(),
					codigo_proyecto :codigo_proyecto,
					fec_doc : $('#fec_doc_ge_det').val(),
					descripcion_guia : $('#obs_ge_det').val(),
					cod_prov:cod_prov,
					cert : $('input[name=cert_emb_det]:checked').val()
					
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
						$('#formulario_detallar_guia_embarque').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Guia Embarque');
						$('#tabla_datos_guia_embarque_detalle').empty();
						$('#tabla_datos_guia_embarque_detalle').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new GestionImportacion().actualizarListaGuiaEmbarque(codigo);	
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
	 * Metodo q graba formulario de Guia de Embarque
	 */
	this.listaGuiaOpciones=function(id_codigo,codigo_proyecto){
      //alert(codigo_proyecto);
      var codigo_proyecto=codigo_proyecto;
      var id_codigo=id_codigo;
            $('#formulario_guia_seleccionar').empty();
   

        var tabla_datos = '<table id="tabla_guia_seleccionar" align="left" class="table_usuario"><label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
			tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br><br>';
			tabla_datos = tabla_datos+'<strong>SELECCIONE UNA DE LAS SIGUIENTES OPCIONES :</strong>';
			tabla_datos = tabla_datos+'<th align="center">NRO.</th>';
			tabla_datos = tabla_datos+'<th align="center">TIPO DE GUIA</th>';
			tabla_datos = tabla_datos+'<th align="center">ACCIONES</th>';
		    tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>1</strong>&nbsp;&nbsp;</td><td><label><strong>Guia de Embarque Consolidado</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"><a  onclick="new GestionImportacion().formularioGuiaEmbarque('+id_codigo+',\''+codigo_proyecto+'\');"><img src="../img/consolidado_48x48.png"><br></a></div></td></tr>';
			tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>2</strong>&nbsp;&nbsp;</td><td><label><strong>Guia de Embarque por Proveedor</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioListaGuiaEmbarque(\''+codigo_proyecto+'\');"><img src="../img/listado_48x48.png"><br></a></div></td></tr></table>';
			$('#formulario_guia_seleccionar').append(tabla_datos);
			$("#formulario_guia_seleccionar").dialog({
					height: 380, 
					width: 500,
					modal: true,
					resizable: true,
					draggable: false,
					closeText: "hide"
				});			
		}

	  /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.formularioListaGuiaEmbarque = function(codigo_proyecto){
		//alert(codigo_proyecto);
			var util = new Utilitarios();
			$.ajax({
				url:'router/GuiaEmbarqueRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'listaGuiaEmbarque',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					//$('#tabla_datos_confirmacion_ban').empty();
	  		        //$('#tabla_datos_confirmacion_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].codigo_proyecto;
					var estado_proyecto=resultado[0].estado_proyecto;
					var nro=0;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_lista_embarque_lista').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO.</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center" colspan="2">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						nro++;
						tabla_datos = tabla_datos+'<tr><td align="center">'+nro+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
							if (value.doc==0) {
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioGuiaEmbarqueLista(\''+value.codigo_proyecto+'\',\''+value.alm_prov_codigo+'\');"><img src="../img/add_32x32.png"><br>Nueva Guia</a></div></td></tr>';
							}else{
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarGuiaEmbarque('+value.alm_form_id+',\''+value.codigo_proyecto+'\',\''+value.alm_prov_codigo+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
						    }
						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nueva Conf.</a></div></td><td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarConfirmacionBancaria('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarGuiaEmbarque(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_lista_embarque_lista').append(tabla_datos);
					$("#formulario_lista_embarque_lista").dialog({
							height: 380, 
							width: 490,
							modal: true,
							resizable: true,
							draggable: false,
							closeText: "hide"
						});					
				},
				error: function(resultado){
					util.mostrarMensajeAlerta(0, 'No existen Datos por Proveedor', 'Confirmacion Guia Embarque');
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}
	  /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.actualizarListaGuiaEmbarque = function(codigo_proyecto){
		//alert(codigo_proyecto);
			$.ajax({
				url:'router/GuiaEmbarqueRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'listaGuiaEmbarque',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					//$('#tabla_datos_confirmacion_ban').empty();
	  		        //$('#tabla_datos_confirmacion_ban').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].codigo_proyecto;
					var estado_proyecto=resultado[0].estado_proyecto;
					var nro=0;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_lista_embarque_lista').empty();

					var tabla_datos = '<label><strong>CODIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO.</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center" colspan="2">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						nro++;
						tabla_datos = tabla_datos+'<tr><td align="center">'+nro+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
							if (value.doc==0) {
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioGuiaEmbarqueLista(\''+value.codigo_proyecto+'\',\''+value.alm_prov_codigo+'\');"><img src="../img/add_32x32.png"><br>Nueva Guia</a></div></td></tr>';
							}else{
						tabla_datos = tabla_datos+'<td align="center"><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarGuiaEmbarque('+value.alm_form_id+',\''+value.codigo_proyecto+'\',\''+value.alm_prov_codigo+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
						    }
						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria(\''+value.alm_proy_cod+'\',\''+value.alm_prov_codigo_int+'\');"><img src="../img/add_32x32.png"><br>Nueva Conf.</a></div></td><td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarConfirmacionBancaria('+value.alm_form_id+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarGuiaEmbarque(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_lista_embarque_lista').append(tabla_datos);				
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}

		  /**
	 * Metodo q da de baja al certificado dentro del detalle
	 */
	this.darBajaGuiaEmbarque = function(id_guia, codigo_proyecto){
	//alert("JS"+id_certificado+codigo_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/GuiaEmbarqueRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaGuiaEmbarque',
					codigo_proyecto :codigo_proyecto,
					id_guia:id_guia 
						
				},
				beforeSend : function(){
			    	$('#formulario_detallar_guia_embarque').dialog('close'); // hace que se cierre el dialog
				},
				success: function(resultado){	
				if(resultado.completo == true){
				var estado=resultado.tipo_formulario;
				var codigo=resultado.codigo_proyecto;
				//alert("GRABO BIEN..."+estado+codigo);
				
				util.mostrarMensajeAlerta(3, 'Se dio de baja correctamente a la Guia de Embarque', 'Confirmacion Guia Embarque');
				new GestionImportacion().actualizarListaGuiaEmbarque(codigo);	
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
	 * Metodo q cancela lo modificado  formulario de Certificados
	 */
	this.cancelarGuiaEmbarque=function(){
		//alert("CANCELAR...");
		$('#formulario_detallar_guia_embarque').dialog('close'); // hace que se cierre el dialog
	}

	this.procesarGuiaEmbarque=function(codigo_proyecto,estado_proyecto){
	//alert("JS"+codigo_proyecto+estado_proyecto);
	var util = new Utilitarios();
		$.ajax({
						url:'router/GuiaEmbarqueRouter.php',
						dataType: 'json',
						type: 'POST',
						data : { 
							
							accion : 'procesarGuiaEmbarque',
							estado_proyecto :estado_proyecto,
							codigo_proyecto :codigo_proyecto
							
						},
						beforeSend : function(){
				
						},
						success: function(res){					
							//alert("GRABO BIEN...");

						if(res.completo== true){
								//alert("GRABO BIEN...");
								///$('#formulario_lista_certificado_ban').dialog('close'); // hace que se cierre el dialog
								util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Guia Embarque');
								$(location).attr('href', 'imp_gest_imp.php');
								//$('#tabla_datos_proyectos').empty();
								//$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
								//new Proyecto().listarProyectos();
							}else if(res.completo== false){
								//alert("NO ELSE...");
							}
									
						},
						error: function(resultado){
							 //alert("NO GRABO BIEN...");
							//console.log(resultado);
						}
					});
}
}