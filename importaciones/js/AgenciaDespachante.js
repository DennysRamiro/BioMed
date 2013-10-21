/**
 * @description Esta clase es la que gestiona los eventos y acciones de fromulario agencia
 * @author annahi gomez
 * @date  20/05/2013
 */
function AgenciaDespachante(){
	
/*seleccionar consolidado o lista*/
	this.listaAgeOpciones=function(id_codigo,codigo_proyecto){
	//alert(codigo_proyecto);
	
	        $('#formulario_age_seleccionar').empty();
        var tabla_datos = '<table id="tabla_age_seleccionar" align="left" class="table_usuario"><label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
			tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br><br>';
			tabla_datos = tabla_datos+'<strong>SELECCIONE UNA DE LAS SIGUIENTES OPCIONES :</strong>';
			tabla_datos = tabla_datos+'<th align="center">NRO.</th>';
			tabla_datos = tabla_datos+'<th align="center">TIPO DE GUIA</th>';
			tabla_datos = tabla_datos+'<th align="center">ACCIONES</th>';
		    tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>1</strong>&nbsp;&nbsp;</td><td><label><strong>Planilla Consolidado</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"><a  onclick="new GestionImportacion().formularioAgenciaDespachante('+id_codigo+',\''+codigo_proyecto+'\',\'Consolidado\',0);"><img src="../img/consolidado_48x48.png"><br></a></div></td></tr>';
			tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>2</strong>&nbsp;&nbsp;</td><td><label><strong>Planilla por Proveedor</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioListarAgenciaDespachante('+id_codigo+',\''+codigo_proyecto+'\');"><img src="../img/listado_48x48.png"><br></a></div></td></tr></table>';
			$('#formulario_age_seleccionar').append(tabla_datos);
	        $("#formulario_age_seleccionar").dialog({
					height: 380, 
					width: 500,
					modal: true,
					resizable: true,
					draggable: false,
					closeText: "hide"
				});	
	}
	/*
	* Metodo que agarra los datos del formulario Agencia Aduanera usando la funcion serializeArray()
	*/
	this.formularioListarAgenciaDespachante= function(id_proyecto, codigo_proyecto){
		//alert("AQUIIII...."+codigo_proyecto+id_proyecto);
	var util = new Utilitarios();
	$.ajax({
				url:'router/AgenciaDespachanteRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarPlanillas',
					codigo_proyecto :codigo_proyecto,
					id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_planillas').empty();
	  		        $('#tabla_datos_planillas').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				//console.log(resultado);
					var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].codigo_proyecto;
					var estado_proyecto=resultado[0].estado;
					var cod_aduana=resultado[0].estado;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto); alm_age_adu_tra_cod
					
					$('#tabla_datos_planillas').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<br><br><table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO. ORDEN REFERENCIA </th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_nro_referencia_orden+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
						if (value.doc==0) {
						tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioAgenciaDespachante('+value.id_proyecto+',\''+value.codigo_proyecto+'\',\''+value.alm_prov_nombre+'\',\''+value.alm_prov_codigo+'\');"><img src="../img/add_32x32.png"><br>Nueva Planilla</a></div></td></tr>';	
						}else{						
						tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new AgenciaDespachante().listarModificacionHojaCosto('+value.id_proyecto+',\''+value.codigo_proyecto+'\',\''+value.alm_prov_codigo+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
						}
						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioAgenciaDespachante('+value.id_proyecto+',\''+value.codigo_proyecto+'\',\''+value.alm_prov_nombre+'\',\''+value.alm_prov_codigo+'\');"><img src="../img/add_32x32.png"><br>Nueva Planilla</a></div><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new AgenciaDespachante().listarModificacionHojaCosto('+value.id_proyecto+',\''+value.codigo_proyecto+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarPlanilla(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_planillas').append(tabla_datos);
					$("#formulario_lista_planilla").dialog({
							height: 405, 
							width: 800,
							modal: true,
							resizable: true,
							draggable: false,
							closeText: "hide"
						});				
				},
				error: function(resultado){
					util.mostrarMensajeAlerta(0, 'No existen Datos por Proveedor', 'Confirmacion Planilla Aduanera');
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

	}
	
	/*
	* Metodo que agarra los datos del formulario Agencia Aduanera para poder listar la modificacion y la baja
	*/
	this.listarModificacionHojaCosto= function(id_proyecto, codigo_proyecto,cod_prov){
			/*</div><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioModificarAgenciaDespachante('+value.id_proyecto+',\''+value.codigo_proyecto+'\',\''+value.alm_age_adu_tra_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div>*/
			//alert(id_proyecto+codigo_proyecto+cod_prov);
			var util = new Utilitarios();
			$.ajax({
				url:'router/AgenciaDespachanteRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'listarOrdenesAgencia2',
					codigo_proyecto :codigo_proyecto,
					id_proyecto:id_proyecto,
					cod_prov:cod_prov 
						
				},
				beforeSend : function(){
					$('#tabla_datos_planillas').empty();
	  		        $('#tabla_datos_planillas').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	
				//console.log(resultado[0].alm_age_adu_tra_cod);
				new GestionImportacion().formularioModificarAgenciaDespachante(id_proyecto,codigo_proyecto,resultado[0].alm_age_adu_tra_cod);
				
				},
				error: function(resultado){
				//util.mostrarMensajeAlerta(0, 'No existe datos en la planilla para detallar', 'Alerta Planilla Aduanera');
				new GestionImportacion().formularioListarAgenciaDespachante(id_proyecto,codigo_proyecto);
				}	
			});
			
	}

	/*
	* Metodo que agarra los datos del formulario Agencia Aduanera para poder listar la modificacion y la baja
	*/
	this.listarModificacionHojaCostoCons= function(id_proyecto, codigo_proyecto){
			/*</div><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioModificarAgenciaDespachante('+value.id_proyecto+',\''+value.codigo_proyecto+'\',\''+value.alm_age_adu_tra_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div>*/
			var util = new Utilitarios();
			$.ajax({
				url:'router/AgenciaDespachanteRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'listarOrdenesAgencia',
					codigo_proyecto :codigo_proyecto,
					id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_planillas').empty();
	  		        $('#tabla_datos_planillas').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	
				//console.log(resultado[0].alm_age_adu_tra_cod);
				new GestionImportacion().formularioModificarAgenciaDespachante(id_proyecto,codigo_proyecto,resultado[0].alm_age_adu_tra_cod);
				
				},
				error: function(resultado){
				//util.mostrarMensajeAlerta(0, 'No existe datos en la planilla para detallar', 'Alerta Planilla Aduanera');
				new GestionImportacion().formularioListarAgenciaDespachante(id_proyecto,codigo_proyecto);
				}	
			});
			
	}
	

	/*
	* Metodo que agarra los datos del formulario Agencia Aduanera usando la funcion serializeArray()
	*/
	this.actualizarListarAgenciaDespachante= function(id_proyecto, codigo_proyecto){
		//alert("AQUIIII...."+codigo_proyecto+id_proyecto);
	
	$.ajax({
				url:'router/AgenciaDespachanteRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarPlanillas',
					codigo_proyecto :codigo_proyecto,
					id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_planillas').empty();
	  		        $('#tabla_datos_planillas').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	
					//alert("GRABO BIEN...");
				
					var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].codigo_proyecto;
					var estado_proyecto=resultado[0].estado;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					new AgenciaDespachante().formularioListarAgenciaDespachante(id_proyecto,codigo_proyecto);
					
					/*
					$('#tabla_datos_planillas').empty();

					var tabla_datos = '<label><strong>CODIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<br><input type="button" value="Nueva Planilla Aduanera" class="btn_form" onClick="new GestionImportacion().formularioAgenciaDespachante('+id_proyecto+',\''+codigo_proyecto+'\');">';
						tabla_datos = tabla_datos+'<br><br><table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">ANEXO PLANILLA</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_age_adu_tra_nro_fac+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
						
						tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioModificarAgenciaDespachante('+id_proyecto+',\''+value.codigo_proyecto+'\',\''+value.alm_age_adu_tra_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().darBajaAgenciaLista('+value.alm_age_adu_tra_id+',\''+value.codigo_proyecto+'\',\''+value.alm_age_adu_tra_cod+'\');"><img src="../img/agencia_form_delete_32x32.png"><br>Dar bajaaaa</a></div> </td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarCertificado(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_planillas').append(tabla_datos);	
					*/	
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
	this.darBajaAgenciaLista = function(id_agencia, codigo_proyecto,cod_agencia){
	//alert("id"+id_agencia+"cod"+codigo_proyecto+"cod2"+cod_agencia);
	var util = new Utilitarios();
	$.ajax({
				url:'router/AgenciaDespachanteRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaAgenciasLista',
					codigo_proyecto :codigo_proyecto,
					id_agencia:id_agencia,
					cod_agencia:cod_agencia
						
				},
				beforeSend : function(){
					
				},
				success: function(resultado){
				//alert("GRABO BIEN...");	
				if(resultado.completo == true){
				var estado_proyecto=resultado.tipo_formulario;
				var codigo_proyecto=resultado.codigo_proyecto;
				//alert("GRABO BIEN..."+estado+codigo);
				util.mostrarMensajeAlerta(1, 'Se dio de baja correctamente a la Planilla Aduanera', 'Confirmacion Planilla Aduanera');
				//new AgenciaDespachante().actualizarListarAgenciaDespachante(estado_proyecto,codigo_proyecto);	
				new AgenciaDespachante().formularioListarAgenciaDespachante(estado_proyecto,codigo_proyecto);	
				
				}else if(resultado.completo == false){
				alert("FALSO...");
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
	this.darBajaAgencia = function(id_agencia, codigo_proyecto,cod_agencia){
	//alert("id"+id_agencia+"cod"+codigo_proyecto+"cod2"+cod_agencia);
	var util = new Utilitarios();
	$.ajax({
				url:'router/AgenciaDespachanteRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'DarBajaAgencias',
					codigo_proyecto :codigo_proyecto,
					id_agencia:id_agencia,
					cod_agencia:cod_agencia
						
				},
				beforeSend : function(){
				},
				success: function(resultado){
				//alert("GRABO BIEN...");	
				if(resultado.completo == true){
				var estado_proyecto=resultado.tipo_formulario;
				var codigo_proyecto=resultado.codigo_proyecto;
				//alert("GRABO BIEN..."+estado_proyecto+codigo_proyecto);
				$('#formulario_modificacion_agencia_depach').dialog('close'); // hace que se cierre el dialog	
				util.mostrarMensajeAlerta(1, 'Se dio de baja correctamente a la Planilla Aduanera', 'Confirmacion Planilla Aduanera');
				//new AgenciaDespachante().actualizarListarAgenciaDespachante(estado_proyecto,codigo_proyecto);	
				new AgenciaDespachante().formularioListarAgenciaDespachante(estado_proyecto,codigo_proyecto);	
				
				/***************************************************************************************************************************/
				}else if(resultado.completo == false){
				alert("FALSO...");
					}

				},
				error: function(resultado){
				//alert("NO GRABO BIEN...");
				//console.log(resultado);
				}
			});
    }




	this.AgenciadespachanteInicio = function(id_proyecto, codigo_proyecto){

			$('#formAgeAdu').submit(function() {
				var valoresAgAdu = $(this).serializeArray();
				console.log($(this).serializeArray());
				var Cod=$('#id_prov').val();
			//  var accion= new Array();
				var util = new Utilitarios();
					 if($('#cod_age').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Agencia Aduanera es obligatorio', 'Advertencia');
					}else if($('#nro_fac_age').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Nro. Factura es obligatorio', 'Advertencia');
					}else if($('#fec_age').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Fecha es obligatorio', 'Advertencia');
					}else if($('#nro_sid_age').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Nro. Sidunea es obligatorio', 'Advertencia');
					}else if($('#merc').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Mercaderia es obligatorio', 'Advertencia');
					}else if($('#bulto').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Bulto es obligatorio', 'Advertencia');
					}else if($('#und_med_bulto').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Unidad Medida de Bulto es obligatorio', 'Advertencia');
					}else if($('#peso').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Peso es obligatorio', 'Advertencia');
					}else if($('#und_med_peso').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Unidad Medida de Peso es obligatorio', 'Advertencia');
					}else if($('#fac_comer').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Factura Comercial es obligatorio', 'Advertencia');
					}else if($('#val_cib').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Valor CIF es obligatorio', 'Advertencia');
					}else if($('#cod_prov').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Proveedor es obligatorio', 'Advertencia');
					}

				$.ajax({
					url:'router/AgenciaDespachanteRouter.php',
					dataType: 'json',
					type: 'POST',
					
					data : valoresAgAdu,
					//accion : 'grabarNuevoAgeDespach',// esto se pone en un div dentro del formulario para llamar a la aacion y ya no desde aqui
				
					success: function(data){
					},
					beforeSend : function(){
					},
					success: function(resultado){
						if(resultado.completo == true){
							var estado_proyecto = resultado.estado_proyecto;
							var codigo_proyecto = resultado.codigo_proyecto;
							//new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
							if (Cod==0) {
							//util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente444444444444', 'Confirmacion Planilla Aduanera');
							//$('#formulario_nuevo_agencia_depach').dialog('close');

									$.ajax({
										url:'router/AgenciaDespachanteRouter.php',
										dataType: 'json',
										type: 'POST',
										data : { 
											
											accion : 'procesarPlanilla',
											estado_proyecto :estado_proyecto,
											codigo_proyecto :codigo_proyecto
											
										},
										beforeSend : function(){
											
										},
										success: function(resultado){					
											//alert("GRABO BIEN...");

										if(resultado.completo== true){
												//alert("GRABO BIEN...");
												//$('#formulario_lista_planilla').dialog('close'); // hace que se cierre el dialog
												util.mostrarMensajeAlerta(1, 'Se guardo y proceso correctamente la planillas aduaneras consolidada', 'Confirmacion Planilla Aduanera');
												$(location).attr('href', 'imp_gest_imp.php');
												//$('#tabla_datos_planillas').empty();
												//$('#tabla_datos_planillas').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
												//new Proyecto().listarProyectos();
											}else if(resultado.completo== false){
												//alert("NO ELSE...");
											}
													
										},
										error: function(resultado){
											 //alert("NO GRABO BIEN...");
											//console.log(resultado);
										}
									});
							}else{
							
								util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Planilla Aduanera');
								$('#formulario_nuevo_agencia_depach').dialog('close'); // hace que se cierre el dialog
								//$('#formAgeAdu').empty();
     							//$('#formAgeAdu').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
							//new Proyecto().listarProyectos();
							//$("#formulario_nuevo_agencia_depach").remove();
							//new AgenciaDespachante().actualizarListarAgenciaDespachante(estado_proyecto,codigo_proyecto);
							new AgenciaDespachante().formularioListarAgenciaDespachante(estado_proyecto,codigo_proyecto);

							}
									
							/*****************************************************************************************************************/	
						}
						
					},//success
					error: function(resultado){
					}
				});	
			
				return false;
				
				
			});
			new AgenciaDespachante().ModificarAgenDespachante();
	}

	
	/**
	 * Metodo q ejecuta el formulario de nuevo form. agencia
	 */
	this.NuevoAgenciaDespachante = function(id_proyecto, codigo_proyecto,nom_prov,cod_prov){
		//alert(cod_prov);
		//$("#formulario_nuevo_agencia_depach").remove();
		var cod_prov=cod_prov;
		var util = new Utilitarios();
		$.ajax({
				url:'router/AgenciaDespachanteRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'consolidadoPlanilla',
					codigo_proyecto :codigo_proyecto
			
				},
				beforeSend : function(){
					
				},
				success: function(resultado){
				var id=resultado[0].id;
				console.log(id)
				if (id==0 && cod_prov==0) {
					util.mostrarMensajeAlerta(0, 'No existen datos para Consolidado', 'Mensaje Planilla Aduanera');

				}else if(id==0 && cod_prov!=0){
					$("#fec_age").val('');
					$("#nro_sid_age").val('');
					$("#nro_fac_age").val('');
					$("#merc").val('');
					$("#bulto").val('');
					$("#peso").val('');
					$("#fac_comer").val('');
					$("#val_cib").val('');
					$("#cod_age").val('-Seleccione Valor-');
					if (cod_prov!=0) {
						$("#cod_prov000001").val(nom_prov);
						$("#cod_prov000002").val(cod_prov);
					}else{
						$("#cod_prov000001").val(nom_prov);
						$("#cod_prov000002").val(nom_prov);
					}
					$("#id_prov").val(cod_prov);
					$("#und_med_bulto").val('-Seleccione Valor-');
					$("#und_med_peso").val('-Seleccione Valor-');
					$("#des_age").val('');
					$("#monto_age").val('');
					
					
					//$("#factura_age").val('');
					$("#fec_age").datepicker({
						dateFormat: "dd/mm/yy"
					});
					$("#codigo_proyectos").empty();
					$("#codigo_proyectos").append(codigo_proyecto);
					//$("#cod_prov").append(cod_prov);
					$("#codigo_proyecto_hidden_age").val(codigo_proyecto);
					$("#nro_fac_age").numeric();
					$("#bulto").numeric();
					$("#peso").numeric();
					$("#fac_comer").numeric();
					$("#val_cib").numeric();
					$("#monto_age").numeric();
					$("#formulario_nuevo_agencia_depach").dialog({
						height: 540,
						width: 740,
						modal: true,
						resizable: false,
						draggable: false,
						closeText: 'hide'
					});
				}else if(id==1 && cod_prov==0){
					$("#fec_age").val('');
					$("#nro_sid_age").val('');
					$("#nro_fac_age").val('');
					$("#merc").val('');
					$("#bulto").val('');
					$("#peso").val('');
					$("#fac_comer").val('');
					$("#val_cib").val('');
					$("#cod_age").val('-Seleccione Valor-');
					if (cod_prov!=0) {
						$("#cod_prov000001").val(nom_prov);
						$("#cod_prov000002").val(cod_prov);
					}else{
						$("#cod_prov000001").val(nom_prov);
						$("#cod_prov000002").val(nom_prov);
					}
					$("#id_prov").val(cod_prov);
					$("#und_med_bulto").val('-Seleccione Valor-');
					$("#und_med_peso").val('-Seleccione Valor-');
					$("#des_age").val('');
					$("#monto_age").val('');
					
					
					//$("#factura_age").val('');
					$("#fec_age").datepicker({
						dateFormat: "dd/mm/yy"
					});
					$("#codigo_proyectos").empty();
					$("#codigo_proyectos").append(codigo_proyecto);
					//$("#cod_prov").append(cod_prov);
					$("#codigo_proyecto_hidden_age").val(codigo_proyecto);
					$("#nro_fac_age").numeric();
					$("#bulto").numeric();
					$("#peso").numeric();
					$("#fac_comer").numeric();
					$("#val_cib").numeric();
					$("#monto_age").numeric();
					$("#formulario_nuevo_agencia_depach").dialog({
						height: 540,
						width: 740,
						modal: true,
						resizable: false,
						draggable: false,
						closeText: 'hide'
					});

				}
		},
				error: function(resultado){
					 alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
				});
	}

	/**
	 * Metodo q ejecuta el formulario de nuevo form. agencia
	 */
	this.NuevoAgenciaDespachanteCons = function(id_proyecto, codigo_proyecto,nom_prov,cod_prov){
		//alert(cod_prov);
		//$("#formulario_nuevo_agencia_depach").remove();

						$("#fec_age1").val('');
						$("#nro_sid_age1").val('');
						$("#nro_fac_age1").val('');
						$("#merc1").val('');
						$("#bulto1").val('');
						$("#peso1").val('');
						$("#fac_comer1").val('');
						$("#val_cib1").val('');
						$("#cod_age1").val('-Seleccione Valor-');
						//$("#cod_prov000001").val(nom_prov);
						//$("#cod_prov000002").val(cod_prov);
						$("#und_med_bulto1").val('-Seleccione Valor-');
						$("#und_med_peso1").val('-Seleccione Valor-');
					
						$("#des_age1").val('');
						$("#monto_age1").val('');
						
						//$("#factura_age").val('');
						$("#fec_age1").datepicker({
							dateFormat: "dd/mm/yy"
						});
						$("#codigo_proyectos1").empty();
						$("#codigo_proyectos1").append(codigo_proyecto);
						//$("#cod_prov").append(cod_prov);
						$("#codigo_proyecto_hidden_age1").val(codigo_proyecto);
						
						$("#formulario_nuevo_agencia_depach1").dialog({
							height: 540,
							width: 740,
							modal: true,
							resizable: false,
							draggable: false,
							closeText: 'hide'
						});

				
	}

	/**
	* Este metodo graba los datos modificados del formulario agencia despacahnte
	*/
	this.ModificarAgenDespachante = function(){

			$('#formAgeAduMod').submit(function() {
				var valoresAgAdu = $(this).serializeArray();
				//console.log($(this).serializeArray());
				var util = new Utilitarios();
					 if($('#codagencia').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Agencia Aduanera es obligatorio', 'Advertencia');
					}else if($('#nro_fac_age1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Nro. Factura es obligatorio', 'Advertencia');
					}else if($('#fec_age1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Fecha es obligatorio', 'Advertencia');
					}else if($('#nro_sid_age1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Nro. Sidunea es obligatorio', 'Advertencia');
					}else if($('#merc1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Mercaderia es obligatorio', 'Advertencia');
					}else if($('#bulto1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Bulto es obligatorio', 'Advertencia');
					}else if($('#und_med_bulto1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Unidad Medida de Bulto es obligatorio', 'Advertencia');
					}else if($('#peso1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Peso es obligatorio', 'Advertencia');
					}else if($('#und_med_peso1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Unidad Medida de Peso es obligatorio', 'Advertencia');
					}else if($('#fac_comer1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Factura Comercial es obligatorio', 'Advertencia');
					}else if($('#val_cib1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Valor CIF es obligatorio', 'Advertencia');
					}else if($('#cod_prov1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Proveedor es obligatorio', 'Advertencia');
					}

				$.ajax({
					url:'router/AgenciaDespachanteRouter.php',
					dataType: 'json',
					type: 'POST',
					
					data : valoresAgAdu,
					
					//accion : 'GrabarModificacionAgencia',// esto se pone en un div dentro del formulario para llamar a la aacion y ya no desde aqui
					success: function(data){
					},
					beforeSend : function(){
					},
					success: function(resultado){
						var codigo=resultado.codigo_proyecto;
						var estado=resultado.estado_proyecto;
						//alert(codigo);
						if(resultado.completo == true){
								$('#formulario_modificacion_agencia_depach').dialog('close'); // hace que se cierre el dialog
								 util.mostrarMensajeAlerta(1, 'Se modifico correctamente a la Planilla Aduanera', 'Confirmacion Planilla Aduanera');
								/*$('#tabla_datos_proyectos').empty();
     							$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);*/
				                //new AgenciaDespachante().actualizarListarAgenciaDespachante(estado,codigo);	
								new AgenciaDespachante().formularioListarAgenciaDespachante(id_proyecto,codigo_proy);
								
								
								/**************************************************************************************************/
						}
						
					},
					error: function(resultado){
					}
				});	
			
				return false;
				
				
			});
	}

	/**
	* Este metodo graba los datos modificados del formulario agencia despacahnte
	*/
	this.ModificarAgenDespachante = function(){

			$('#formAgeAduMod').submit(function() {
				var valoresAgAdu = $(this).serializeArray();
				//console.log($(this).serializeArray());
				var util = new Utilitarios();
					 if($('#codagencia').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Agencia Aduanera es obligatorio', 'Advertencia');
					}else if($('#nro_fac_age1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Nro. Factura es obligatorio', 'Advertencia');
					}else if($('#fec_age1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Fecha es obligatorio', 'Advertencia');
					}else if($('#nro_sid_age1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Nro. Sidunea es obligatorio', 'Advertencia');
					}else if($('#merc1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Mercaderia es obligatorio', 'Advertencia');
					}else if($('#bulto1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Bulto es obligatorio', 'Advertencia');
					}else if($('#und_med_bulto1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Unidad Medida de Bulto es obligatorio', 'Advertencia');
					}else if($('#peso1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Peso es obligatorio', 'Advertencia');
					}else if($('#und_med_peso1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Unidad Medida de Peso es obligatorio', 'Advertencia');
					}else if($('#fac_comer1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Factura Comercial es obligatorio', 'Advertencia');
					}else if($('#val_cib1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Valor CIF es obligatorio', 'Advertencia');
					}else if($('#cod_prov1').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Proveedor es obligatorio', 'Advertencia');
					}

				$.ajax({
					url:'router/AgenciaDespachanteRouter.php',
					dataType: 'json',
					type: 'POST',
					
					data : valoresAgAdu,
					
					//accion : 'GrabarModificacionAgencia',// esto se pone en un div dentro del formulario para llamar a la aacion y ya no desde aqui
					success: function(data){
					},
					beforeSend : function(){
					},
					success: function(resultado){
						var codigo=resultado.codigo_proyecto;
						var estado=resultado.estado_proyecto;
						//alert(codigo);
						if(resultado.completo == true){
							//alert("grabo bien");	
								$('#formulario_modificacion_agencia_depach').dialog('close'); // hace que se cierre el dialog
								 util.mostrarMensajeAlerta(1, 'Se modifico correctamente a la Planilla Aduanera', 'Confirmacion Planilla Aduanera');
								/*$('#tabla_datos_proyectos').empty();
     							$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);*/
				                //new AgenciaDespachante().actualizarListarAgenciaDespachante(estado,codigo);	
								new AgenciaDespachante().formularioListarAgenciaDespachante(estado,codigo);
								
								
								/**************************************************************************************************/
						}
						
					},
					error: function(resultado){
					//alert("no grabo bien");	
					}
				});	
			
				return false;
				
				
			});
	}


	/*
	*  Este metodo lista datos de la agencia aduanera a modificar
	*/
	/*this.ModificacionAgenciaDespachante2 = function(id_proyecto, codigo_proyecto,cod_aduana,cod_prov){
		//alert(cod_aduana);
		
		$("#formulario_lista_planilla").dialog("close");
		
		$("#codigo_proyectos1").empty();
		$("#codigo_proyectos1").append(codigo_proyecto);
		$("#codigo_proyecto_hidden_age1").val(codigo_proyecto);
				//alert('holaaaa');
				$.ajax({
					url:'router/AgenciaDespachanteRouter.php',
					dataType: 'json',
					type: 'POST',
					data : {
						accion : 'CodigoProyCabecera',
						codigo_proyectoo:codigo_proyecto,
						cod_aduana:cod_aduana
					},
					beforeSend : function(){
					},
					success: function(value){
					//console.log(value);
					var codigo_proy=value.alm_age_adu_tra_cod_proy;
					var id_aduana=value.alm_age_adu_tra_id;
					//console.log("aquii"+codigo_proy);
					//console.log("otroo"+id_aduana);
					$('#formAgeAduMod').empty();
					var tabla_datos = '<table><tr>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Proyectos:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left">'+value.alm_age_adu_tra_cod_proy+'<input type="hidden" value="'+value.alm_age_adu_tra_cod_proy+'" name="codigo_proyecto_age" id="codigo_proyecto_age" /><input type="hidden" value="'+value.alm_age_adu_tra_cod+'" name="codigo" id="codigo" /><input type="hidden" value="'+value.alm_age_adu_tra_num_corr+'" name="age_corr" id="age_corr" /></td>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Agencia Aduanera:</strong></td>';
						tabla_datos = tabla_datos+'<td><input type="hidden" name="codagencia" id="codagencia" value="'+value.alm_age_adu_tra_id_age+'"><select name="cod_age1" value="" size="1" size="10" id="cod_age1" style="width:160px;height:30px"></select></td>';
						tabla_datos = tabla_datos+'<td align="left"><strong>Nro. Factura:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="nro_fac_age1" id="nro_fac_age1" value="'+value.alm_age_adu_tra_nro_fac+'"/></td></tr>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Fecha:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="fec_age1" id="fec_age1" value="'+value.alm_age_adu_tra_fecha+'"/></td>';
						tabla_datos = tabla_datos+'<td align="left"><strong>Nro. Sidunea:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="nro_sid_age1" id="nro_sid_age1" value="'+value.alm_age_adu_tra_cod_sidu+'"/></td></tr>';
						
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Mercaderia:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="merc1" id="merc1" value="'+value.alm_age_adu_tra_merc+'"/></td>';
						tabla_datos = tabla_datos+'<td align="left"><strong>Bultos:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="bulto1" id="bulto1"  style="width:45px" onKeyPress="return soloNum(event)" value="'+value.alm_age_adu_tra_bulto+'"/><input type="hidden" name="medidabulto" id="medidabulto" value="'+value.alm_age_adu_tra_med_bulto+'"><select name="und_med_bulto1" value="" size="1" size="10" id="und_med_bulto1" style="width:110px;height:30px"></select></td></tr>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Peso:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="peso1" id="peso1" style="width:45px" onKeyPress="return soloNum(event)" value="'+value.alm_age_adu_tra_peso+'"/><input type="hidden" name="medidapeso" id="medidapeso" value="'+value.alm_age_adu_tra_med_peso+'"><select name="und_med_peso1" size="1" size="10" id="und_med_peso1" style="width:110px;height:30px"></select></td>';	
						tabla_datos = tabla_datos+'<td align="left"><strong>Factura Comercial:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="fac_comer1" id="fac_comer1" value="'+value.alm_age_adu_tra_fac_comer+'"/></td></tr>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Valor CIB Bs.:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="val_cib1" id="val_cib1" value="'+value.alm_age_adu_tra_val_cif+'"/></td>';	
						tabla_datos = tabla_datos+'<td align="left"><strong>Proveedor:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="hidden" name="proveedor" id="proveedor" value="'+value.alm_age_adu_tra_cod_prov+'"><select name="cod_prov1" value="" size="1" size="10" id="cod_prov1" style="width:110px;height:30px"></select></td></tr>';						

						tabla_datos = tabla_datos+'</table>';
						$('#formAgeAduMod').append(tabla_datos);				
						//asigno el calendario a mi fecha
								$("#fec_age1").datepicker({
									dateFormat: "dd/mm/yy"
								});
						// console.log(value1);

						$.ajax({
						url:'router/AgenciaDespachanteRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion : 'CodigoProyDetalle',
							codigo_proyectoo:codigo_proyecto,
							cod_aduana:cod_aduana

						},
						beforeSend : function(){
						},
						success: function(res){
						//console.log(res);
						var cod_detalle=res[0].alm_age_adu_tra_det_cod;
						//console.log("esteee"+cod_detalle);
						var tabla_datos_det = '<table class="table_usuario"><tr>'; 
						tabla_datos_det = tabla_datos_det+'<th align="center"><b>ITEM</b></th>';
						tabla_datos_det = tabla_datos_det+'<th align="center"> <b>DESCRIPCION</b></th>';
						tabla_datos_det = tabla_datos_det+'<th align="center"><b>MONTO</b></th>';
						tabla_datos_det = tabla_datos_det+'<th align="center"><b>FACTURA</b></th></tr>';
						
						$.each(res, function(index, value1){
						//$('#formulario_modificacion_agencia_depach').empty();
						tabla_datos_det = tabla_datos_det+'<tr><td align="left"><input type="hidden" name="item_age1[]"  id="item_age1" value="'+value1.alm_age_adu_tra_det_item+'"/><label>'+value1.alm_age_adu_tra_det_item_des+'</label></td>';
						tabla_datos_det = tabla_datos_det+'<td align="left"><input type="text" name="des_age1[]"  id="des_age1" value="'+value1.alm_age_adu_tra_det_descrip+'"/></td>';
						tabla_datos_det = tabla_datos_det+'<td align="left"><input type="text" name="monto_age1[]"  id="monto_age1" value="'+value1.alm_age_adu_tra_det_monto+'"/></td>';
						if(value1.alm_age_adu_tra_det_factura== 1){
						tabla_datos_det = tabla_datos_det+'<td align="left"><input type="checkbox" name="factura_age1[]"  id="factura_age1" value="'+value1.alm_age_adu_tra_det_item+'" checked /></td></tr>';
						}else{
						tabla_datos_det = tabla_datos_det+'<td align="left"><input type="checkbox" name="factura_age1[]"  id="factura_age1" value="'+value1.alm_age_adu_tra_det_item+'" /><input type="hidden" id="accion" name="accion" value="GrabarModificacionAgencia"></td></tr>';	
							}
					//'+value1.alm_age_adu_tra_det_factura+'
						});
						tabla_datos_det = tabla_datos_det+'</table>';
						tabla_datos_det = tabla_datos_det+'<table align="center"><tr><td><br><input class="btn_form" type="submit" name="accion" value="Grabar Form. Agencia"></td><td><br><input class="btn_form" type="button" name="accion" value="Dar de Baja" onClick="new GestionImportacion().darBajaAgencia('+id_aduana+',\''+codigo_proy+'\',\''+cod_detalle+'\');"></td><td><br><input class="btn_form" type="button"s name="accion" value="Cancelar" onClick="new GestionImportacion().cancelarPlanilla('+id_proyecto+',\''+codigo_proy+'\');"></td></tr></table>';
						                //new GestionImportacion().cancelarPlanilla()
										//new AgenciaDespachante().formularioListarAgenciaDespachante
						$('#formAgeAduMod').append(tabla_datos_det);

						// Lista de agencias
						$.ajax({
						url:'router/AgenciaDespachanteRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion : 'ListaAgencias',
						},
						beforeSend : function(){
						},
						success: function(res){
						var datoAgencia;
							$.each(res, function(index, value){
							//console.log($('#codagencia').val());
							var dato=value.alm_age_adu_cod;
							if($('#codagencia').val() == dato){
							//datoAgencia=datoAgencia+'<option select value="'+value.alm_age_adu_cod+'">'+value.alm_age_adu_nom+'</option>';
							datoAgencia= datoAgencia+'<option select value="'+value.alm_age_adu_cod+'">'+value.alm_age_adu_nom+'</option>';
							}else{
							//datoAgencia=datoAgencia+'<option value="'+value.alm_age_adu_cod+'">'+value.alm_age_adu_nom+'</option>';
							datoAgencia= datoAgencia+'<option value="'+value.alm_age_adu_cod+'">'+value.alm_age_adu_nom+'</option>';
							}
							});
							$('#cod_age1').append(datoAgencia);
							}	// Agencia
							});
						
						// Lista las Unidades de medida para Bulto
						$.ajax({
						url:'router/AgenciaDespachanteRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion : 'ListaUnidades',
						},
						beforeSend : function(){
						},
						success: function(res){
						var datoUniMedidaB;
						var datoUniMedidaP;
							$.each(res, function(index, value){
								//console.log($('#medidabulto').val());	
								//console.log(value);	
							var datos=value.GRAL_PAR_PRO_COD;
						
							if($('#medidabulto').val() == datos){
							datoUniMedidaB=datoUniMedidaB+'<option selected value="'+value.GRAL_PAR_PRO_COD+'">'+value.GRAL_PAR_PRO_DESC+'</option>';
							}else{
							datoUniMedidaB=datoUniMedidaB+'<option value="'+value.GRAL_PAR_PRO_COD+'">'+value.GRAL_PAR_PRO_DESC+'</option>';
							}
							
							//$("#ciudad_cliente option[value='"+data.ciudad_cliente+"']").attr("selected","selected");						
							if($('#medidapeso').val() == datos){
							datoUniMedidaP=datoUniMedidaP+'<option selected value="'+value.GRAL_PAR_PRO_COD+'">'+value.GRAL_PAR_PRO_DESC+'</option>';
							}else{
							datoUniMedidaP=datoUniMedidaP+'<option value="'+value.GRAL_PAR_PRO_COD+'">'+value.GRAL_PAR_PRO_DESC+'</option>';
							}
							});
							$('#und_med_bulto1').append(datoUniMedidaB);
							$('#und_med_peso1').append(datoUniMedidaP);
							}	//  Unidad Medida
							});
							
						// Lista Proveedores
						$.ajax({
						url:'router/AgenciaDespachanteRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion : 'ListaProveedor',
						},
						beforeSend : function(){
						},
						success: function(res){
						var datoProvee;
							$.each(res, function(index, value){
								//console.log(value);
							var datos = value.alm_prov_codigo_int;	
							if($('#proveedor').val() == datos){
							datoProvee=datoProvee+'<option selected value="'+value.alm_prov_codigo_int+'">'+value.alm_prov_nombre+'</option>';
							
							}else{
							datoProvee=datoProvee+'<option value="'+value.alm_prov_codigo_int+'">'+value.alm_prov_nombre+'</option>';
							
							}
							});
							$('#cod_prov1').append(datoProvee);
							
							}
							});// proveeedor	 
						}	
						});	//detalle
					}
					});	//cabecera	

		$("#formulario_modificacion_agencia_depach").dialog({
			height: 540,
			width: 740,
			modal: true,
			resizable: false,
			draggable: false,
			closeText: 'hide'
		});
				return false;
	}*/

	/*
	*  Este metodo lista datos de la agencia aduanera a modificar
	*/
	this.ModificacionAgenciaDespachante = function(id_proyecto, codigo_proyecto,cod_aduana){
		//alert(cod_aduana+codigo_proyecto+id_proyecto);
		
		$("#formulario_lista_planilla").dialog("close");
		
		$("#codigo_proyectos1").empty();
		$("#codigo_proyectos1").append(codigo_proyecto);
		$("#codigo_proyecto_hidden_age1").val(codigo_proyecto);
		$("#nro_fac_age1").numeric();
		$("#bulto1").numeric();
		$("#peso1").numeric();
		$("#fac_comer1").numeric();
		$("#val_cib1").numeric();
		$("#monto_age1").numeric();
				//alert('holaaaa');
				$.ajax({
					url:'router/AgenciaDespachanteRouter.php',
					dataType: 'json',
					type: 'POST',
					data : {
						accion : 'CodigoProyCabecera',
						codigo_proyectoo:codigo_proyecto,
						cod_aduana:cod_aduana
					},
					beforeSend : function(){
					},
					success: function(value){
					//console.log(value);
					var codigo_proy=value.alm_age_adu_tra_cod_proy;
					var id_aduana=value.alm_age_adu_tra_id;
					//console.log("aquii"+codigo_proy);
					//console.log("otroo"+id_aduana);
					$('#formAgeAduMod').empty();
					var tabla_datos = '<table><tr>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>C&oacute;digo Proyecto:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left">'+value.alm_age_adu_tra_cod_proy+'<input type="hidden" value="'+value.alm_age_adu_tra_cod_proy+'" name="codigo_proyecto_age" id="codigo_proyecto_age" /><input type="hidden" value="'+value.alm_age_adu_tra_cod+'" name="codigo" id="codigo" /><input type="hidden" value="'+value.alm_age_adu_tra_num_corr+'" name="age_corr" id="age_corr" /></td>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Agencia Aduanera:</strong></td>';
						tabla_datos = tabla_datos+'<td><input type="hidden" name="codagencia" id="codagencia" value="'+value.alm_age_adu_tra_id_age+'"><select name="cod_age1" value="" size="1" size="10" id="cod_age1" style="width:160px;height:30px"></select></td>';
						tabla_datos = tabla_datos+'<td align="left"><strong>Nro. Factura:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="number" name="nro_fac_age1" id="nro_fac_age1" value="'+value.alm_age_adu_tra_nro_fac+'"/></td></tr>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Fecha:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="fec_age1" id="fec_age1" value="'+value.alm_age_adu_tra_fecha+'"/></td>';
						tabla_datos = tabla_datos+'<td align="left"><strong>Nro. Sidunea:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="nro_sid_age1" id="nro_sid_age1" value="'+value.alm_age_adu_tra_cod_sidu+'"/></td></tr>';
						
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Mercaderia:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="merc1" id="merc1" value="'+value.alm_age_adu_tra_merc+'"/></td>';
						tabla_datos = tabla_datos+'<td align="left"><strong>Bultos:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="number" name="bulto1" id="bulto1"  style="width:45px" onKeyPress="return soloNum(event)" value="'+value.alm_age_adu_tra_bulto+'"/><input type="hidden" name="medidabulto" id="medidabulto" value="'+value.alm_age_adu_tra_med_bulto+'"><select name="und_med_bulto1" value="" size="1" size="10" id="und_med_bulto1" style="width:110px;height:30px"></select></td></tr>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Peso:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="number" name="peso1" id="peso1" style="width:45px" onKeyPress="return soloNum(event)" value="'+value.alm_age_adu_tra_peso+'"/><input type="hidden" name="medidapeso" id="medidapeso" value="'+value.alm_age_adu_tra_med_peso+'"><select name="und_med_peso1" size="1" size="10" id="und_med_peso1" style="width:110px;height:30px"></select></td>';	
						tabla_datos = tabla_datos+'<td align="left"><strong>Factura Comercial:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="text" name="fac_comer1" id="fac_comer1" value="'+value.alm_age_adu_tra_fac_comer+'"/></td></tr>';
						tabla_datos = tabla_datos+'<tr><td align="left"><strong>Valor CIB Bs.:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="number" name="val_cib1" id="val_cib1" value="'+value.alm_age_adu_tra_val_cif+'"/></td>';	
						tabla_datos = tabla_datos+'<td align="left"><strong>Proveedor:</strong></td>';
						tabla_datos = tabla_datos+'<td align="left"><input type="hidden" name="proveedor" id="proveedor" value="'+value.alm_age_adu_tra_cod_prov+'"><select name="cod_prov1" value="" size="1" size="10" id="cod_prov1" style="width:110px;height:30px"></select></td></tr>';						

						tabla_datos = tabla_datos+'</table>';
						$('#formAgeAduMod').append(tabla_datos);				
						//asigno el calendario a mi fecha
								$("#fec_age1").datepicker({
									dateFormat: "dd/mm/yy"
								});
						// console.log(value1);

						$.ajax({
						url:'router/AgenciaDespachanteRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion : 'CodigoProyDetalle',
							codigo_proyectoo:codigo_proyecto,
							cod_aduana:cod_aduana

						},
						beforeSend : function(){
						},
						success: function(res){
						//console.log(res);
						var cod_detalle=res[0].alm_age_adu_tra_det_cod;
						//console.log("esteee"+cod_detalle);
						var tabla_datos_det = '<table class="table_usuario"><tr>'; 
						tabla_datos_det = tabla_datos_det+'<th align="center"><b>ITEM</b></th>';
						tabla_datos_det = tabla_datos_det+'<th align="center"> <b>DESCRIPCION</b></th>';
						tabla_datos_det = tabla_datos_det+'<th align="center"><b>MONTO</b></th>';
						tabla_datos_det = tabla_datos_det+'<th align="center"><b>FACTURA</b></th></tr>';
						
						$.each(res, function(index, value1){
						//$('#formulario_modificacion_agencia_depach').empty();
						tabla_datos_det = tabla_datos_det+'<tr><td align="left"><input type="hidden" name="item_age1[]"  id="item_age1" value="'+value1.alm_age_adu_tra_det_item+'"/><label>'+value1.alm_age_adu_tra_det_item_des+'</label></td>';
						tabla_datos_det = tabla_datos_det+'<td align="left"><input type="text" name="des_age1[]"  id="des_age1" value="'+value1.alm_age_adu_tra_det_descrip+'"/></td>';
						tabla_datos_det = tabla_datos_det+'<td align="left"><input type="number" name="monto_age1[]"  id="monto_age1" value="'+value1.alm_age_adu_tra_det_monto+'"/></td>';
						if(value1.alm_age_adu_tra_det_factura== 1){
						tabla_datos_det = tabla_datos_det+'<td align="left"><input type="checkbox" name="factura_age1[]"  id="factura_age1" value="'+value1.alm_age_adu_tra_det_item+'" checked /></td></tr>';
						}else{
						tabla_datos_det = tabla_datos_det+'<td align="left"><input type="checkbox" name="factura_age1[]"  id="factura_age1" value="'+value1.alm_age_adu_tra_det_item+'" /><input type="hidden" id="accion" name="accion" value="GrabarModificacionAgencia"></td></tr>';	
							}
					//'+value1.alm_age_adu_tra_det_factura+'
						});
						tabla_datos_det = tabla_datos_det+'</table>';
						tabla_datos_det = tabla_datos_det+'<table align="center"><tr><td><br><input class="btn_form" type="submit" name="accion" value="Grabar Form. Agencia"></td><td><br><input class="btn_form" type="button"s name="accion" value="Cancelar" onClick="new GestionImportacion().cancelarPlanilla('+id_proyecto+',\''+codigo_proy+'\');"></td></tr></table>';
						                //new GestionImportacion().cancelarPlanilla()
										//new AgenciaDespachante().formularioListarAgenciaDespachante
						$('#formAgeAduMod').append(tabla_datos_det);

						// Lista de agencias
						$.ajax({
						url:'router/AgenciaDespachanteRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion : 'ListaAgencias',
						},
						beforeSend : function(){
						},
						success: function(res){
						var datoAgencia;
							$.each(res, function(index, value){
							//console.log($('#codagencia').val());
							var dato=value.alm_age_adu_cod;
							if($('#codagencia').val() == dato){
							//datoAgencia=datoAgencia+'<option select value="'+value.alm_age_adu_cod+'">'+value.alm_age_adu_nom+'</option>';
							datoAgencia= datoAgencia+'<option select value="'+value.alm_age_adu_cod+'">'+value.alm_age_adu_nom+'</option>';
							}else{
							//datoAgencia=datoAgencia+'<option value="'+value.alm_age_adu_cod+'">'+value.alm_age_adu_nom+'</option>';
							datoAgencia= datoAgencia+'<option value="'+value.alm_age_adu_cod+'">'+value.alm_age_adu_nom+'</option>';
							}
							});
							$('#cod_age1').append(datoAgencia);
							}	// Agencia
							});
						
						// Lista las Unidades de medida para Bulto
						$.ajax({
						url:'router/AgenciaDespachanteRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion : 'ListaUnidades',
						},
						beforeSend : function(){
						},
						success: function(res){
						var datoUniMedidaB;
						var datoUniMedidaP;
							$.each(res, function(index, value){
								//console.log($('#medidabulto').val());	
								//console.log(value);	
							var datos=value.GRAL_PAR_PRO_COD;
						
							if($('#medidabulto').val() == datos){
							datoUniMedidaB=datoUniMedidaB+'<option selected value="'+value.GRAL_PAR_PRO_COD+'">'+value.GRAL_PAR_PRO_DESC+'</option>';
							}else{
							datoUniMedidaB=datoUniMedidaB+'<option value="'+value.GRAL_PAR_PRO_COD+'">'+value.GRAL_PAR_PRO_DESC+'</option>';
							}
							
							//$("#ciudad_cliente option[value='"+data.ciudad_cliente+"']").attr("selected","selected");						
							if($('#medidapeso').val() == datos){
							datoUniMedidaP=datoUniMedidaP+'<option selected value="'+value.GRAL_PAR_PRO_COD+'">'+value.GRAL_PAR_PRO_DESC+'</option>';
							}else{
							datoUniMedidaP=datoUniMedidaP+'<option value="'+value.GRAL_PAR_PRO_COD+'">'+value.GRAL_PAR_PRO_DESC+'</option>';
							}
							});
							$('#und_med_bulto1').append(datoUniMedidaB);
							$('#und_med_peso1').append(datoUniMedidaP);
							}	//  Unidad Medida
							});
							
						// Lista Proveedores
						$.ajax({
						url:'router/AgenciaDespachanteRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion : 'ListaProveedor',
						},
						beforeSend : function(){
						},
						success: function(res){
						var datoProvee;
							$.each(res, function(index, value){
								//console.log(value);
							var datos = value.alm_prov_codigo_int;	
							if($('#proveedor').val() == datos){
							datoProvee=datoProvee+'<option selected value="'+value.alm_prov_codigo_int+'">'+value.alm_prov_nombre+'</option>';
							
							}else{
							datoProvee=datoProvee+'<option value="'+value.alm_prov_codigo_int+'">'+value.alm_prov_nombre+'</option>';
							
							}
							});
							$('#cod_prov1').append(datoProvee);
							
							}
							});// proveeedor	 
						}	
						});	//detalle
					}
					});	//cabecera	
					
		$("#formulario_modificacion_agencia_depach").dialog({
			height: 540,
			width: 740,
			modal: true,
			resizable: false,
			draggable: false,
			closeText: 'hide'
		});
				return false;
	}

		 /**
	 * Metodo q cancela lo modificado  formulario de planilla aduanera
	 */
	this.cancelarPlanilla=function(id_proyecto,codigo_proy){
		//alert("CANCELAR...");
		$('#formulario_modificacion_agencia_depach').dialog('close'); // hace que se cierre el dialog
		new AgenciaDespachante().formularioListarAgenciaDespachante(id_proyecto,codigo_proy);
	}

			 /**
	 * Metodo q procesa el formulario de Certificados para cambiar de estado
	 */
	this.procesarPlanilla=function(codigo_proyecto,estado_proyecto){
		//console.log(codigo_proyecto+estado_proyecto)
		var util = new Utilitarios();
		$.ajax({
				url:'router/AgenciaDespachanteRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'procesarPlanilla',
					estado_proyecto :estado_proyecto,
					codigo_proyecto :codigo_proyecto
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

				if(resultado.completo== true){
						//alert("GRABO BIEN...");
						//$('#formulario_lista_planilla').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Se proceso correctamente las planillas aduaneras', 'Confirmacion Planilla Aduanera');
						$(location).attr('href', 'imp_gest_imp.php');
						//$('#tabla_datos_planillas').empty();
						//$('#tabla_datos_planillas').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						//new Proyecto().listarProyectos();
					}else if(resultado.completo== false){
						//alert("NO ELSE...");
					}
							
				},
				error: function(resultado){
					// alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});
	}

}