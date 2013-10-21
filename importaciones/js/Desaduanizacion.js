/**
 * @description Esta clase es la que gestiona los eventos y acciones de desaduanizacion
 * @author Ramiro Gutierrez
 * @date  17/05/2013
 */
function Desaduanizacion(){

	/*seleccionar consolidado o lista*/
	this.listaDesOpciones=function(id_codigo,codigo_proyecto){
	//alert(codigo_proyecto);
	
	        $('#formulario_desa_seleccionar').empty();
        var tabla_datos = '<table id="tabla_desa_seleccionar" align="left" class="table_usuario"><label><strong>CODIGO PROYECTO:</strong> </label>';
			tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br><br>';
			tabla_datos = tabla_datos+'<strong>SELECCIONE UNA DE LAS SIGUIENTES OPCIONES :</strong>';
			tabla_datos = tabla_datos+'<th align="center">NRO.</th>';
			tabla_datos = tabla_datos+'<th align="center">TIPO DE GUIA</th>';
			tabla_datos = tabla_datos+'<th align="center">ACCIONES</th>';
		    tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>1</strong>&nbsp;&nbsp;</td><td><label><strong>Desaduanizacion Consolidado</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"><a  onclick="new GestionImportacion().formularioDesaduanizacion('+id_codigo+',\''+codigo_proyecto+'\');"><img src="../img/consolidado_48x48.png"><br></a></div></td></tr>';
			tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>2</strong>&nbsp;&nbsp;</td><td><label><strong>Desaduanizacion por Proveedor</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioListaDesaProv(\''+codigo_proyecto+'\');"><img src="../img/listado_48x48.png"><br></a></div></td></tr></table>';
			$('#formulario_desa_seleccionar').append(tabla_datos);
	        $("#formulario_desa_seleccionar").dialog({
					height: 380, 
					width: 500,
					modal: true,
					resizable: true,
					draggable: false,
					closeText: "hide"
				});	
	}
	


	/**
	 * Metodo q ejecuta el formulario de desaduanizacion
	 */
	this.formularioDesaduanizacion = function(id_proyecto, codigo_proyecto){
		var util = new Utilitarios();
		$.ajax({
				url:'router/DesaduanizacionRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'consolidadoGuia',
					codigo_proyecto :codigo_proyecto
			
				},
				beforeSend : function(){
					
				},
				success: function(resultado){
				if (resultado.nro_prov>1) {

					//var util = new Utilitarios();
					util.validarCampo('numero_doc_dui', 'error_numero_doc_dui', 'El campo Nro. Documento no puede estar vacio');
					$("#fec_doc_dui").datepicker({
						dateFormat: "dd/mm/yy"
					});
					$("#label_codigos_proyectos_dui").empty();
					$("#label_codigos_proyectos_dui").append(codigo_proyecto);
					$("#codigos_proyectos_hidden_dui").val(codigo_proyecto);
					$("#formulario_desaduanizacion").dialog({
						height: 330,
						width: 560,
						modal: true,
						resizable: false,
						draggable: false,
						closeText: "hide"
					});

				}else{

				util.mostrarMensajeAlerta(0, 'No existen datos para Consolidado', 'Mensaje 	Desaduanizacion');


				}

				},
				error: function(resultado){
					 alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
				});
	}

		/**
	 * Metodo q ejecuta el formulario de desaduanizacion
	 */
	this.formularioDesaduanizacionProv = function(codigo_proyecto,cod_prov){
		//alert(codigo_proyecto+cod_prov);
		var util = new Utilitarios();
		util.validarCampo('numero_doc_desa', 'error_numero_doc_desa', 'El campo Nro. Documento no puede estar vacio');
		$("#fec_doc_desa").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#numero_doc_desa").val('');
		$("#fec_doc_desa").val('');
		$("#obs_desa").val('');
		$("#label_codigos_proyectos_desa").empty();
		$("#label_codigos_proveedor_desa").empty();
		$("#label_codigos_proyectos_desa").append(codigo_proyecto);
		$("#label_codigos_proveedor_desa").append(cod_prov);
		$("#codigos_proyectos_hidden_desa").val(codigo_proyecto);
		$("#codigos_proveedor_hidden_desa").val(cod_prov);
		$("#formulario_desaduanizacion_prov").dialog({
			height: 330,
			width: 560,
			modal: true,
			resizable: false,
			draggable: false,
			closeText: "hide"
		});
	}

		   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.formularioListaDesaProv = function(codigo_proyecto){
		//alert(codigo_proyecto);
		var util = new Utilitarios();
			$.ajax({
				url:'router/DesaduanizacionRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarDesaProveedor',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_desa_prov').empty();
	  		        $('#tabla_datos_desa_prov').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_datos_desa_prov').empty();

					var tabla_datos = '<label><strong>CODIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						//tabla_datos = tabla_datos+'<br><input type="button" value="Nuevo Certificado" class="btn_form" onClick="new GestionImportacion().formularioNuevoCertificado(\''+codigo_proyecto+'\');">';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO. GUIA EMBARQUE</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">FECHA GUIA EMBARQUE</th>';
						tabla_datos = tabla_datos+'<th align="center">OBSERVACIONES</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_form_nro_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_fecha_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_observaciones+'</td>';
						if (value.doc==0) {
						tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioDesaduanizacionProv(\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/add_32x32.png"><br>Nuevo Desa.</a></div></td></tr>';
							}else{
						tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarDesa('+value.id_desa+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
						    }

						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().darBajaCertificadoLista('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificado('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarDesa(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_desa_prov').append(tabla_datos);
					$("#formulario_lista_desa_prov").dialog({
							height: 405, 
							width: 800,
							modal: true,
							resizable: true,
							draggable: false,
							closeText: "hide"
						});				
				},
				error: function(resultado){
					util.mostrarMensajeAlerta(0, 'No existen Datos por Proveedor', 'Confirmacion Desaduanizacion');
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}


			   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.actualizarListaDesaProv = function(codigo_proyecto){
		//alert(codigo_proyecto);
			$.ajax({
				url:'router/DesaduanizacionRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarDesaProveedor',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_desa_prov').empty();
	  		        $('#tabla_datos_desa_prov').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_datos_desa_prov').empty();

					var tabla_datos = '<label><strong>CODIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						//tabla_datos = tabla_datos+'<br><input type="button" value="Nuevo Certificado" class="btn_form" onClick="new GestionImportacion().formularioNuevoCertificado(\''+codigo_proyecto+'\');">';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO. GUIA EMBARQUE</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">FECHA GUIA EMBARQUE</th>';
						tabla_datos = tabla_datos+'<th align="center">OBSERVACIONES</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_form_nro_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_fecha_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_observaciones+'</td>';
						if (value.doc==0) {
						tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioDesaduanizacionProv(\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/add_32x32.png"><br>Nuevo Desa.</a></div></td></tr>';
							}else{
						tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarDesa('+value.id_desa+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
						    }

						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().darBajaCertificadoLista('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificado('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarDesa(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_desa_prov').append(tabla_datos);
						
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}


	
	
	/**
	 * Este metodo graba los datos del formulario de desaduanizacion
	 */
	this.grabarNuevaDesaduanizacion = function(){
		var util = new Utilitarios();
		
		if($('#numero_doc_dui').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Desaduanizacion');
		}else if($('#fec_doc_dui').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Desaduanizacion');
		}else {
			//console.log("Registrando..");
			$.ajax({
				url:'router/DesaduanizacionRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'grabarDesaduanizacion',
					codigo_proyecto:$('#codigos_proyectos_hidden_dui').val(),
					codigos_dui:$('#numero_doc_dui').val(),
					fec_doc_dui:$('#fec_doc_dui').val(),			
					obs_dui:$('#obs_dui').val()

				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
								
					
					if(resultado.completo == true){
						
						var estado_proyecto = resultado.estado_proyecto;
						var codigo_proyecto = resultado.codigo_proyecto;
						
						//new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
						//$('#formulario_desaduanizacion').dialog('close'); // hace que se cierre el dialog
						//util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Desaduanizacion');
						//new Proyecto().listarProyectos();
						$.ajax({
									url:'router/DesaduanizacionRouter.php',
									dataType: 'json',
									type: 'POST',
									data : { 
										
										accion : 'procesarDesaduanizacion',
										estado_proyecto :estado_proyecto,
										codigo_proyecto :codigo_proyecto
										
									},
									beforeSend : function(){
							
									},
									success: function(res){					
										//alert("GRABO BIEN...");

									if(res.completo== true){
											//alert("GRABO BIEN...");
											//$('#formulario_lista_certificado_ban').dialog('close'); // hace que se cierre el dialog
											util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Desaduanizacion');
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
					//console.log(resultado);
				}
			});	
		}
		
	}

	   /**
	 * Metodo q ejecuta el detalle del certificado
	 */
	this.formularioDetallarDesa= function(id_desa, codigo_proyecto,cod_prov){
	//alert("Detallar Certificado JS");
	var util = new Utilitarios();
		$.ajax({
				url:'router/DesaduanizacionRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DetallesDesa',
					codigo_proyecto :codigo_proyecto,
					id_desa:id_desa,
					cod_prov:cod_prov 
						
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
				//alert(id_certificado);
				
				var id_desa=resultado[0].alm_form_id;
				var codigo_proyecto=resultado[0].alm_proy_cod;
				var codigo_proveedor=resultado[0].alm_prov_id;
				var estado_proyecto=resultado[0].alm_form_tipo;
				var nro_proyecto=resultado[0].alm_form_nro_doc;
				var fecha_proyecto=resultado[0].alm_form_fecha_doc;
				var obs_proyecto=resultado[0].alm_form_observaciones;
				

					$('#tabla_datos_desa_detalle').empty();
					var tabla_datos = '<label><strong>CODIGO PROYECTO:</strong> </label><span id="codigo_proyecto_detalle_div"></span>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br>';
						tabla_datos = tabla_datos+'<label><strong>CODIGO PROVEEDOR:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proveedor+'</label>';
						tabla_datos = tabla_datos+'<table><tr>';      
					    tabla_datos = tabla_datos+'<tr><td ><strong>Nro. de Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input type="text" class="txt_campo" name="nro_doc_desa_det" id="nro_doc_desa_det" value="'+nro_proyecto+'"><div id="error_nro_doc_desa_det"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td ><strong>Fecha Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="fec_doc_desa_det" maxlength="60"id="fec_doc_desa_det" value="'+fecha_proyecto+'"><div id="error_fec_doc_desa_det"></div></td></tr>';			    
					    tabla_datos = tabla_datos+'<tr><td ><strong>Observaciones :</strong></td>';
					    tabla_datos = tabla_datos+'<td><textarea  name="obs_desa_det" id="obs_desa_det" cols="50" rows="2">'+obs_proyecto+'</textarea><div id="error_obs_desa_det"></div></td></tr>';
						tabla_datos = tabla_datos+'</table>';
						tabla_datos = tabla_datos+'<tr align="center">';
						tabla_datos = tabla_datos+'<td> <br><input class="btn_form" type="button" name="accion" value="Modificar" onClick="new GestionImportacion().modificarDetalleDesaProv('+id_desa+',\''+codigo_proyecto+'\',\''+codigo_proveedor+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Dar de baja" onClick="new GestionImportacion().darBajaDesa('+id_desa+',\''+codigo_proyecto+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Cancelar" onClick="new Desaduanizacion().cancelarDesa();"></td>';
						tabla_datos = tabla_datos+'</tr></div></div>';
					$('#tabla_datos_desa_detalle').append(tabla_datos);
					util.validarCampo('nro_doc_desa_det', 'error_nro_doc_desa_det', 'El campo Nro. Aduanizacion no puede estar vacio');
					$("#fec_doc_desa_det").datepicker({
			          dateFormat: "dd/mm/yy"
		            });
					$("#formulario_detallar_desa").dialog({				
							height: 350,
							width: 600,
							modal: true,
							resizable: false,
							draggable: false,
							closeText: "hide"
						});	
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
	this.modificarDetalleDesaProv=function(id_desa, codigo_proyecto,cod_prov){
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		//alert("GUIA GRABAR NRO"+$('#nro_doc_cert_det').val());
		//alert("GUIA GRABAR FECHA"+$('#fec_doc_cert_det').val());
		//alert("GUIA GRABAR OBS"+$('#obs_cert_det').val());
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		var util = new Utilitarios();

		if ($('#nro_doc_desa_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Aduanizacion');

		}else if($('#fec_doc_desa_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Aduanizacion');
		}else {
			console.log("Registrando...");
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/DesaduanizacionRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'ModificarDesaProv',
					id_desa :id_desa,
					numero_documento :$('#nro_doc_desa_det').val(),
					codigo_proyecto :codigo_proyecto,
					cod_prov :cod_prov,
					fec_doc : $('#fec_doc_desa_det').val(),
					descripcion_desa : $('#obs_desa_det').val()
					
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
						$('#formulario_detallar_desa').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Aduanizacion');
						$('#tabla_datos_desa_detalle').empty();
						$('#tabla_datos_desa_detalle').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new Desaduanizacion().actualizarListaDesaProv(codigo);	
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
	 * Este metodo graba los datos del formulario de desaduanizacion
	 */
	this.grabarNuevaDesaduanizacionProv = function(){
		var util = new Utilitarios();
		
		if($('#numero_doc_desa').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Desaduanizacion');
		}else if($('#fec_doc_desa').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Desaduanizacion');
		}else {
			//console.log("Registrando..");
			$.ajax({
				url:'router/DesaduanizacionRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'grabarDesaduanizacionProv',
					codigo_proyecto:$('#codigos_proyectos_hidden_desa').val(),
					codigo_proveedor:$('#codigos_proveedor_hidden_desa').val(),
					codigos_dui:$('#numero_doc_desa').val(),
					fec_doc_dui:$('#fec_doc_desa').val(),			
					obs_dui:$('#obs_desa').val()

				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
								
					
					if(resultado.completo == true){
						
						var estado_proyecto = resultado.estado_proyecto;
						var codigo_proyecto = resultado.codigo_proyecto;
						
						//new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
						$('#formulario_desaduanizacion_prov').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Desaduanizacion');
						new Desaduanizacion().actualizarListaDesaProv(codigo_proyecto);
						
					}else if(resultado.completo == false){

					}
							
				},
				error: function(resultado){
					//console.log(resultado);
				}
			});	
		}
		
	}
	  /**
	 * Metodo q da de baja al certificado dentro del detalle
	 */
	this.darBajaDesa = function(id_desa, codigo_proyecto){
	//alert("JS"+id_certificado+codigo_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/DesaduanizacionRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaDesa',
					codigo_proyecto :codigo_proyecto,
					id_desa:id_desa 
						
				},
				beforeSend : function(){
			    	$('#formulario_detallar_desa').dialog('close'); // hace que se cierre el dialog
				},
				success: function(resultado){	
				if(resultado.completo == true){
				var estado=resultado.tipo_formulario;
				var codigo=resultado.codigo_proyecto;
				//alert("GRABO BIEN..."+estado+codigo);
				
				util.mostrarMensajeAlerta(3, 'Se dio de baja correctamente a la Desaduanizacion', 'Confirmacion Desaduanizacion');
				new Desaduanizacion().actualizarListaDesaProv(codigo_proyecto);
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
	this.cancelarDesa=function(){
		//alert("CANCELAR...");
		$('#formulario_detallar_desa').dialog('close'); // hace que se cierre el dialog
	}

	 /**
	 * Metodo q procesa el formulario de Certificados para cambiar de estado
	 */
	this.procesarDesa=function(codigo_proyecto,estado_proyecto){
		//console.log(codigo_proyecto+estado_proyecto)
		var util = new Utilitarios();
		$.ajax({
			url:'router/DesaduanizacionRouter.php',
			dataType: 'json',
			type: 'POST',
			data : { 
				
				accion : 'procesarDesaduanizacion',
				estado_proyecto :estado_proyecto,
				codigo_proyecto :codigo_proyecto
				
			},
			beforeSend : function(){

			},
			success: function(res){					
				//alert("GRABO BIEN...");

			if(res.completo== true){
					//alert("GRABO BIEN...");
					//$('#formulario_lista_certificado_ban').dialog('close'); // hace que se cierre el dialog
					util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Desaduanizacion');
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


	
	}	

	

}