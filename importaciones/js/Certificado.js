
/**
 * @description Esta clase es la que gestiona los eventos y acciones de contrato
 * @author Ruth Palomino
 * @date  20/05/2013
 */

function Certificado(){
   /**
	 * Metodo q ejecuta el formulario de nuevo certificado
	 */
	this.formularioNuevoCertificado = function(codigo_proyecto){
		var util = new Utilitarios();
		util.validarCampo('nro_doc_cert', 'error_nro_doc_cert', 'El campo Nro. Documento no puede estar vacio');
		util.validarCampo('comis_cert_otros', 'error_comis_cert_otros', 'El campo Comisi&oacute;n Certificado no puede estar vacio');

		$("#fec_doc_cert").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#nro_doc_cert").val('');
		$('#fec_doc_cert').val('');
		$('#comis_cert_otros').val('');
		$('#obs_cert').val('');
		$("#label_codigo_cert_proyecto").empty();
		$("#label_codigo_cert_proyecto").append(codigo_proyecto);
		$("#codigo_proyecto_cert_hidden").val(codigo_proyecto);
		$('#comis_cert_otros').numeric('.');
		$("#formulario_nuevo_certificado").dialog({
			height: 350,
			width: 560,
			modal: true,
			resizable: false,
			draggable: false,
			closeText: "hide"
		});
	}

	/**
	 * Metodo q ejecuta el formulario de nuevo certificado
	 */
	this.formularioNuevoCertificadoProv = function(codigo_proyecto,cod_prov){
		//alert(codigo_proyecto);
		var util = new Utilitarios();
		util.validarCampo('nro_doc_certp', 'error_nro_doc_certp', 'El campo Nro. Documento no puede estar vacio');
		util.validarCampo('comis_certp_otros', 'error_comis_certp_otros', 'El campo Comisi&oacute;n Certificado no puede estar vacio');

		$("#fec_doc_certp").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#nro_doc_certp").val('');
		$('#fec_doc_certp').val('');
		$('#comis_certp_otros').val('');
		$('#obs_certp').val('');
		$("#label_codigos_proyectos_certp").empty();
		$("#label_codigos_proveedor_certp").empty();
		$("#label_codigos_proyectos_certp").append(codigo_proyecto);
		$("#label_codigos_proveedor_certp").append(cod_prov);
		$("#codigos_proyectos_hidden_certprov").val(codigo_proyecto);
		$("#codigos_proveedor_hidden_certp").val(cod_prov);
		$('#comis_certp_otros').numeric('.');
		$("#formulario_nuevo_certificado_prov").dialog({
			height: 350,
			width: 560,
			modal: true,
			resizable: false,
			draggable: false,
			closeText: "hide"
		});
	}

	this.listaCertOpciones=function(codigo_proyecto){
	//alert(codigo_proyecto);
	
	        $('#formulario_cert_seleccionar').empty();
        var tabla_datos = '<table id="tabla_cert_seleccionar" align="left" class="table_usuario"><label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
			tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br><br>';
			tabla_datos = tabla_datos+'<strong>SELECCIONE UNA DE LAS SIGUIENTES OPCIONES :</strong>';
			tabla_datos = tabla_datos+'<th align="center">NRO.</th>';
			tabla_datos = tabla_datos+'<th align="center">TIPO DE GUIA</th>';
			tabla_datos = tabla_datos+'<th align="center">ACCIONES</th>';
		    tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>1</strong>&nbsp;&nbsp;</td><td><label><strong>Certificado Consolidado</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"><a  onclick="new GestionImportacion().formularioListaCertificado(\''+codigo_proyecto+'\');"><img src="../img/consolidado_48x48.png"><br></a></div></td></tr>';
			tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>2</strong>&nbsp;&nbsp;</td><td><label><strong>Certificado por Proveedor</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioListaCertificadoProv(\''+codigo_proyecto+'\');"><img src="../img/listado_48x48.png"><br></a></div></td></tr></table>';
			$('#formulario_cert_seleccionar').append(tabla_datos);
	        $("#formulario_cert_seleccionar").dialog({
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
	this.formularioListaCertificadoProv = function(codigo_proyecto){
		//alert(codigo_proyecto);
		var util= new Utilitarios();
			$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarCertificadosProveedor',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_certificado_prov').empty();
	  		        $('#tabla_datos_certificado_prov').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_datos_certificado_prov').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
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
						if (value.alm_form_cert_otros==1) {
							if (value.doc==0) {
							tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioNuevoCertificadoProv(\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\',\''+value.alm_prov_id+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div></td></tr>';
								}else{
							tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificadoProv('+value.id_certificado+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
							    }
						}else if (value.alm_form_cert_otros==0){
							tabla_datos = tabla_datos+'<td></td></tr>';
						} 

						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().darBajaCertificadoLista('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificado('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarCertificadoProv(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_certificado_prov').append(tabla_datos);
					$("#formulario_lista_certificado_prov").dialog({
							height: 405, 
							width: 800,
							modal: true,
							resizable: true,
							draggable: false,
							closeText: "hide"
						});				
				},
				error: function(resultado){
					util.mostrarMensajeAlerta(0, 'No existen Datos por Proveedor', 'Confirmacion Certificado');
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}

		   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.actualizarListaCertificadoProv = function(codigo_proyecto){
		//alert(codigo_proyecto);
		var util= new Utilitarios();
			$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarCertificadosProveedor',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_certificado_prov').empty();
	  		        $('#tabla_datos_certificado_prov').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_datos_certificado_prov').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
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
						if (value.alm_form_cert_otros==1) {
							if (value.doc==0) {
							tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioNuevoCertificadoProv(\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\',\''+value.alm_prov_id+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div></td></tr>';
								}else{
							tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificadoProv('+value.id_certificado+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
							    }
						}else if (value.alm_form_cert_otros==0){
							tabla_datos = tabla_datos+'<td></td></tr>';
						} 

						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().darBajaCertificadoLista('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificado('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarCertificadoProv(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_certificado_prov').append(tabla_datos);
				},
				error: function(resultado){
					//util.mostrarMensajeAlerta(0, 'No existen Datos por Proveedor', 'Confirmacion Certificado');
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}
	
	   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.formularioListaCertificado = function(codigo_proyecto){
		//alert(codigo_proyecto);
		var util = new Utilitarios();
			$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarCertificados',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_certificado').empty();
	  		        $('#tabla_datos_certificado').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					var nro_prov=resultado[0].nro_prov;
					console.log(nro_prov);
					if (nro_prov>1) {
						$('#tabla_datos_certificado').empty();

						var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
							tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
							tabla_datos = tabla_datos+'<br><input type="button" value="Nuevo Certificado" class="btn_form" onClick="new GestionImportacion().formularioNuevoCertificado(\''+codigo_proyecto+'\');">';
							tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
						    tabla_datos = tabla_datos+'<th align="center">NRO. CERTIFICADO</th>';
							tabla_datos = tabla_datos+'<th align="center">FECHA CERTIFICADO</th>';
							tabla_datos = tabla_datos+'<th align="center">COMISI&Oacute;N CERTIFICADO</th>';
							tabla_datos = tabla_datos+'<th align="center">OBSERVACIONES</th>';
							tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
						$.each(resultado, function(index, value){
							tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_form_nro_doc+'</td>';
							tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_fecha_doc+'</td>';
							tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_comision_cert+'</td>';
							tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_observaciones+'</td>';
							   if (value.alm_form_nro_doc=='') {
							tabla_datos = tabla_datos+'<td></td></tr>';
						       } else{
							tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificado('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().darBajaCertificadoLista('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/certificado_delete_32x32.png"><br>Dar baja</a></div> </td></tr>';
						}

						});
						tabla_datos = tabla_datos+'</table>';
						tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarCertificado(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
						$('#tabla_datos_certificado').append(tabla_datos);
						$("#formulario_lista_certificado").dialog({
								height: 405, 
								width: 800,
								modal: true,
								resizable: true,
								draggable: false,
								closeText: "hide"
							});
					}else {

						util.mostrarMensajeAlerta(0, 'No existen datos para Consolidado', 'Mensaje Guia de Embarque');
					}				
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}

	   /**
	 * Metodo q actualiza la lista de certificados 
	 */
	this.actualizarListaCertificado = function(codigo_proyecto){
		//alert(codigo_proyecto);
			$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarCertificados',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_certificado').empty();
	  		        $('#tabla_datos_certificado').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

			//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].alm_proy_cod;
					var estado_proyecto=resultado[0].alm_form_tipo;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_datos_certificado').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<br><input type="button" value="Nuevo Certificado" class="btn_form" onClick="new GestionImportacion().formularioNuevoCertificado(\''+codigo_proyecto+'\');">';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO. CERTIFICADO</th>';
						tabla_datos = tabla_datos+'<th align="center">FECHA CERTIFICADO</th>';
						tabla_datos = tabla_datos+'<th align="center">COMISI&Oacute;N CERTIFICADO</th>';
						tabla_datos = tabla_datos+'<th align="center">OBSERVACIONES</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_form_nro_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_fecha_doc+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_comision_cert+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_form_observaciones+'</td>';
						   if (value.alm_form_nro_doc=='') {
						tabla_datos = tabla_datos+'<td></td></tr>';
					       } else{
						tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificado('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().darBajaCertificadoLista('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/certificado_delete_32x32.png"><br>Dar baja</a></div> </td></tr>';
					}

					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarCertificado(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_certificado').append(tabla_datos);		
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
	this.formularioDetallarCertificado = function(id_certificado, codigo_proyecto){
	//alert("Detallar Certificado JS");
	var util = new Utilitarios();
		$('#codigo_proyecto_detalle_div').empty();
		$('#codigo_proyecto_detalle_div').append(codigo_proyecto);
		$('#id_certificado_detalle_hidden').val(id_certificado);
		$('#codigos_proyecto_detalle_hidden').val(""+codigo_proyecto);

		$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DetallesCertificados',
					codigo_proyecto :codigo_proyecto,
					id_certificado:id_certificado 
						
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
				//alert(id_certificado);
				
				var id_certificado=resultado[0].alm_form_id;
				var codigo_proyecto=resultado[0].alm_proy_cod;
				var estado_proyecto=resultado[0].alm_form_tipo;
				var nro_proyecto=resultado[0].alm_form_nro_doc;
				var fecha_proyecto=resultado[0].alm_form_fecha_doc;
				var obs_proyecto=resultado[0].alm_form_observaciones;
				var com_cert=resultado[0].alm_form_comision_cert;

					$('#tabla_datos_certificado_detalle').empty();
					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label><span id="codigo_proyecto_detalle_div"></span>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<table><tr>';      
					    tabla_datos = tabla_datos+'<tr><td ><strong>Nro. de Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input type="text" class="txt_campo" name="nro_doc_certs_det" id="nro_doc_certs_det" value="'+nro_proyecto+'"><div id="error_nro_doc_certs_det"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td ><strong>Fecha Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="fec_doc_certs_det" maxlength="60"id="fec_doc_certs_det" value="'+fecha_proyecto+'"><div id="error_fec_doc_certs_det"></div></td></tr>';
					    tabla_datos = tabla_datos+'<td ><strong>Comisi&oacute;n Certificado :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input type="number" class="txt_campo" name="comis_cert_otros_det" id="comis_cert_otros_det" value="'+com_cert+'"><div id="error_comis_cert_otros_det"></div></td></tr>';				    
					    tabla_datos = tabla_datos+'<tr><td ><strong>Observaciones :</strong></td>';
					    tabla_datos = tabla_datos+'<td><textarea  name="obs_certs_det" id="obs_certs_det" cols="50" rows="2">'+obs_proyecto+'</textarea><div id="error_obs_certs_det"></div></td></tr>';
						tabla_datos = tabla_datos+'</table>';
						tabla_datos = tabla_datos+'<tr align="center">';
						tabla_datos = tabla_datos+'<td> <br><input class="btn_form" type="button" name="accion" value="Modificar" onClick="new GestionImportacion().modificarDetalleCertificado('+id_certificado+',\''+codigo_proyecto+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Dar de baja" onClick="new GestionImportacion().darBajaCertificado('+id_certificado+',\''+codigo_proyecto+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Cancelar" onClick="new GestionImportacion().cancelarCertificado();"></td>';
						tabla_datos = tabla_datos+'</tr></div></div>';
					$('#tabla_datos_certificado_detalle').append(tabla_datos);
					util.validarCampo('nro_doc_certs_det', 'error_nro_doc_certs_det', 'El campo Nro. Certificado no puede estar vacio');
					$("#fec_doc_certs_det").datepicker({
			          dateFormat: "dd/mm/yy"
		            });
		            $('#comis_cert_otros_det').numeric('.');
					$("#formulario_detallar_certificado").dialog({
							
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
	 * Metodo q ejecuta el detalle del certificado
	 */
	this.formularioDetallarCertificadoProv = function(id_certificado, codigo_proyecto,cod_prov){
	//alert("Detallar Certificado JS");
	var util = new Utilitarios();
		//$('#codigo_proyecto_detalle_div').empty();
		//$('#codigo_proyecto_detalle_div').append(codigo_proyecto);
		//$('#id_certificado_detalle_hidden').val(id_certificado);
		//$('#codigos_proyecto_detalle_hidden').val(""+codigo_proyecto);

		$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DetallesCertificadosProv',
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

					$('#tabla_datos_certificado_detalle_prov').empty();
					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br>';
						tabla_datos = tabla_datos+'<label><strong>C&Oacute;DIGO PROVEEDOR:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proveedor+'</label>';
						tabla_datos = tabla_datos+'<table><tr>';      
					    tabla_datos = tabla_datos+'<tr><td ><strong>Nro. de Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input type="text" class="txt_campo" name="nro_doc_certsp_det" id="nro_doc_certsp_det" value="'+nro_proyecto+'"><div id="error_nro_doc_certsp_det"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td ><strong>Fecha Documento :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="fec_doc_certsp_det" maxlength="60"id="fec_doc_certsp_det" value="'+fecha_proyecto+'"><div id="error_fec_doc_certsp_det"></div></td></tr>';
					    tabla_datos = tabla_datos+'<td ><strong>Comisi&oacute;n Certificado :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input type="number" class="txt_campo" name="comis_certp_otros_det" id="comis_certp_otros_det" value="'+com_cert+'"><div id="error_comis_certp_otros_det"></div></td></tr>';				    
					    tabla_datos = tabla_datos+'<tr><td ><strong>Observaciones :</strong></td>';
					    tabla_datos = tabla_datos+'<td><textarea  name="obs_certsp_det" id="obs_certsp_det" cols="50" rows="2">'+obs_proyecto+'</textarea><div id="error_obs_certsp_det"></div></td></tr>';
						tabla_datos = tabla_datos+'</table>';
						tabla_datos = tabla_datos+'<tr align="center">';
						tabla_datos = tabla_datos+'<td> <br><input class="btn_form" type="button" name="accion" value="Modificar" onClick="new GestionImportacion().modificarDetalleCertificadoProv('+id_certificado+',\''+codigo_proyecto+'\',\''+codigo_proveedor+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Dar de baja" onClick="new GestionImportacion().darBajaCertificadoProv('+id_certificado+',\''+codigo_proyecto+'\');"></td>';
						tabla_datos = tabla_datos+'<td><input class="btn_form" type="button" name="accion" value="Cancelar" onClick="new Certificado().cancelarCertificadoProv();"></td>';
						tabla_datos = tabla_datos+'</tr></div></div>';
					$('#tabla_datos_certificado_detalle_prov').append(tabla_datos);
					util.validarCampo('nro_doc_certsp_det', 'error_nro_doc_certsp_det', 'El campo Nro. Certificado no puede estar vacio');
					$("#fec_doc_certsp_det").datepicker({
			          dateFormat: "dd/mm/yy"
		            });
		            $('#comis_certp_otros_det').numeric('.');
					$("#formulario_detallar_certificado_prov").dialog({
							
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
	 * Metodo q da de baja al certificado dentro del detalle
	 */
	this.darBajaCertificado = function(id_certificado, codigo_proyecto){
	//alert("JS"+id_certificado+codigo_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaCertificados',
					codigo_proyecto :codigo_proyecto,
					id_certificado:id_certificado 
						
				},
				beforeSend : function(){
			    	$('#formulario_detallar_certificado').dialog('close'); // hace que se cierre el dialog
				},
				success: function(resultado){	
				if(resultado.completo == true){
				var estado=resultado.tipo_formulario;
				var codigo=resultado.codigo_proyecto;
				//alert("GRABO BIEN..."+estado+codigo);
				
				util.mostrarMensajeAlerta(3, 'Se dio de baja correctamente al certificado', 'Confirmacion Certificado');
				new Certificado().actualizarListaCertificado(codigo);
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
	 * Metodo q da de baja al certificado dentro del detalle
	 */
	this.darBajaCertificadoProv = function(id_certificado, codigo_proyecto){
	//alert("JS"+id_certificado+codigo_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaCertificados',
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
				$('#formulario_detallar_certificado_prov').dialog('close'); // hace que se cierre el dialog
				util.mostrarMensajeAlerta(3, 'Se dio de baja correctamente al certificado', 'Confirmacion Certificado');
				new Certificado().actualizarListaCertificadoProv(codigo);
				}else if(resultado.completo == false){
				//alert("FALSO...");
					}

				},
				error: function(resultado){
				//alert("NO GRABO BIEN...");
				//console.log(resultado);
				}
			});	
    }

          /**
	 * Metodo q da de baja al certificado dentro de la lista de certificados
	 */
	this.darBajaCertificadoLista = function(id_certificado, codigo_proyecto){
	//alert("JS"+id_certificado+codigo_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaCertificadosLista',
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
				new Certificado().actualizarListaCertificado(codigo);
				}else if(resultado.completo == false){
				//alert("FALSO...");
					}

				},
				error: function(resultado){
				//alert("NO GRABO BIEN...");
				//console.log(resultado);
				}
			});	
    }
		 /**
	 * Metodo q graba formulario de Certificados
	 */
	this.grabarformularioNuevoCertificado=function(){
		//alert("GUIA GRABAR JS");
		var util = new Utilitarios();

		if ($('#nro_doc_cert').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Certificado');

		}else if ($('#comis_cert_otros').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Comisi&oacute;n Certificado es obligatorio', 'Mensaje Certificado');

		}else if($('#fec_doc_cert').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Certificado');
		}else {
			console.log("Registrando...");
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'grabarNuevoCertificado',
					numero_documento:$('#nro_doc_cert').val(),
					codigo_proyecto :$('#codigo_proyecto_cert_hidden').val(),
					fec_doc : $('#fec_doc_cert').val(),
					descripcion_cert : $('#obs_cert').val(),
					comis_cert_otros : $('#comis_cert_otros').val(),
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");
					//FALTAA ACTUALIZAR LA LISTA DE CETIFICADOS

					if(resultado.completo == true){
						//alert("GRABO BIEN...");
						
						var estado=resultado.tipo_formulario;
						var codigo=resultado.codigo_proyecto;
						//var estado=resultado[0].tipo_formulario;
						//var codigo=resultado[0].codigo_proyecto;
						//new Proyecto().updateProyecto(estado, codigo);
						$('#formulario_nuevo_certificado').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Certificado');
						$('#tabla_datos_certificado').empty();
						$('#tabla_datos_certificado').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new Certificado().actualizarListaCertificado(codigo);						
					}else if(resultado.completo == false){

					}
							
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					console.log(resultado);
				}
			});	

		}
	}

	 /**
	 * Metodo q graba formulario de Certificados
	 */
	this.grabarformularioNuevoCertificadoProv=function(){
		//alert("GUIA GRABAR JS"+$('#codigos_proyectos_hidden_certp').val());
		var util = new Utilitarios();

		if ($('#nro_doc_certp').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Certificado');

		}else if ($('#comis_certp_otros').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Comisi&oacute;n Certificado es obligatorio', 'Mensaje Certificado');

		}else if($('#fec_doc_certp').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Certificado');
		}else {
			console.log("Registrando...");
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {  
					
					accion : 'grabarNuevoCertificadoProv',
					numero_documento:$('#nro_doc_certp').val(),
					codigo_proyecto :$('#codigos_proyectos_hidden_certprov').val(),
					codigo_proveedor :$('#codigos_proveedor_hidden_certp').val(),
					fec_doc : $('#fec_doc_certp').val(),
					descripcion_cert : $('#obs_certp').val(),
					comis_cert_otros : $('#comis_certp_otros').val()
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");
					//FALTAA ACTUALIZAR LA LISTA DE CETIFICADOS

					if(resultado.completo == true){
						//alert("GRABO BIEN..."+codigo);
						
						var estado=resultado.tipo_formulario;
						var codigo=resultado.codigo_proyecto;
						//alert("GRABO BIEN..."+codigo);
						//var estado=resultado[0].tipo_formulario;
						//var codigo=resultado[0].codigo_proyecto;
						//new Proyecto().updateProyecto(estado, codigo);
						$('#formulario_nuevo_certificado_prov').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Certificado');
						//$('#tabla_nuevo_certificado_prov').empty();
						//$('#tabla_nuevo_certificado_prov').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new Certificado().actualizarListaCertificadoProv(codigo);						
					}else if(resultado.completo == false){

					}
							
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		}
	}

		 /**
	 * Metodo q graba lo modificado  formulario de Certificados
	 */
	this.modificarDetalleCertificado=function(id_certificado, codigo_proyecto){
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		//alert("GUIA GRABAR NRO"+$('#nro_doc_cert_det').val());
		//alert("GUIA GRABAR FECHA"+$('#fec_doc_cert_det').val());
		//alert("GUIA GRABAR OBS"+$('#obs_cert_det').val());
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		var util = new Utilitarios();

		if ($('#nro_doc_certs_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Certificado');

		}else if ($('#comis_certs_otros_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Comisi&oacute;n Certificado es obligatorio', 'Mensaje Certificado');

		}else if($('#fec_doc_certs_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Certificado');
		}else {
			console.log("Registrando...");
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'ModificarCertificado',
					id_certificado :id_certificado,
					numero_documento :$('#nro_doc_certs_det').val(),
					codigo_proyecto :codigo_proyecto,
					fec_doc : $('#fec_doc_certs_det').val(),
					descripcion_cert : $('#obs_certs_det').val(),
					comis_cert_otros_det : $('#comis_cert_otros_det').val()
					
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
						$('#formulario_detallar_certificado').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Certificado');
						$('#tabla_datos_certificado_detalle').empty();
						$('#tabla_datos_certificado_detalle').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new Certificado().actualizarListaCertificado(codigo);	
					}else if(resultado.completo == false){

					}
							
				},
				error: function(resultado){
					 //alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		}
	}

			 /**
	 * Metodo q graba lo modificado  formulario de Certificados
	 */
	this.modificarDetalleCertificadoProv=function(id_certificado, codigo_proyecto,cod_prov){
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		//alert("GUIA GRABAR NRO"+$('#nro_doc_cert_det').val());
		//alert("GUIA GRABAR FECHA"+$('#fec_doc_cert_det').val());
		//alert("GUIA GRABAR OBS"+$('#obs_cert_det').val());
		//alert("GUIA GRABAR JS"+id_certificado+codigo_proyecto);
		var util = new Utilitarios();

		if ($('#nro_doc_certsp_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Certificado');

		}else if ($('#comis_certsp_otros_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Comisi&oacute;n Certificado es obligatorio', 'Mensaje Certificado');

		}else if($('#fec_doc_certsp_det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Certificado');
		}else {
			console.log("Registrando...");
			//alert($('input[name=cert_emb]:checked').val());
			$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'ModificarCertificadoProv',
					id_certificado :id_certificado,
					numero_documento :$('#nro_doc_certsp_det').val(),
					codigo_proyecto :codigo_proyecto,
					cod_prov :cod_prov,
					fec_doc : $('#fec_doc_certsp_det').val(),
					descripcion_cert : $('#obs_certsp_det').val(),
					comis_cert_otros_det : $('#comis_certp_otros_det').val()
					
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
						$('#formulario_detallar_certificado_prov').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Certificado');
						$('#tabla_datos_certificado_detalle_prov').empty();
						$('#tabla_datos_certificado_detalle_prov').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new Certificado().actualizarListaCertificadoProv(codigo);	
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
	 * Metodo q procesa el formulario de Certificados para cambiar de estado
	 */
	this.procesarCertificado=function(codigo_proyecto,estado_proyecto){
		//console.log(codigo_proyecto+estado_proyecto)
		var util = new Utilitarios();
		$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'procesarCertificado',
					estado_proyecto :estado_proyecto,
					codigo_proyecto :codigo_proyecto
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

				if(resultado.completo== true){
						//alert("GRABO BIEN...");
						//$('#formulario_lista_certificado').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Se proceso correctamente los certificados', 'Confirmacion Certificado');
						$(location).attr('href', 'imp_gest_imp.php');
						//$('#tabla_datos_proyectos').empty();
						//$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						//new Proyecto().listarProyectos();
					}else if(resultado.completo== false){
						util.mostrarMensajeAlerta(0, 'Debe ingresar al menos un certificado', 'Alerta Certificado');
						new Certificado().actualizarListaCertificado(codigo_proyecto);	
					}
							
				},
				error: function(resultado){
					 //alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});
	}

		 /**
	 * Metodo q procesa el formulario de Certificados para cambiar de estado
	 */
	this.procesarCertificadoProv=function(codigo_proyecto,estado_proyecto){
		//console.log(codigo_proyecto+estado_proyecto)
		var util = new Utilitarios();
		$.ajax({
				url:'router/CertificadoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'procesarCertificadoProv',
					estado_proyecto :estado_proyecto,
					codigo_proyecto :codigo_proyecto
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

				if(resultado.completo== true){
						//alert("GRABO BIEN...");
						//$('#formulario_lista_certificado').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Se proceso correctamente los certificados', 'Confirmacion Certificado');
						$(location).attr('href', 'imp_gest_imp.php');
						//$('#tabla_datos_proyectos').empty();
						//$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						//new Proyecto().listarProyectos();
					}else if(resultado.completo== false){
						//util.mostrarMensajeAlerta(0, 'Debe ingresar al menos un certificado', 'Alerta Certificado');
						//new Certificado().actualizarListaCertificado(codigo_proyecto);	
					}
							
				},
				error: function(resultado){
					 //alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});
	}

		 /**
	 * Metodo q cancela lo modificado  formulario de Certificados 
	 */
	this.cancelarCertificado=function(){
		//alert("CANCELAR...");
		$('#formulario_detallar_certificado').dialog('close'); // hace que se cierre el dialog
	}

	this.cancelarCertificadoProv=function(){
		//alert("CANCELAR...");
		$('#formulario_detallar_certificado_prov').dialog('close'); // hace que se cierre el dialog
	}
}


