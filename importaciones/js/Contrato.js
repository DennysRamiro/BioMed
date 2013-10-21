/**
 * @description Esta clase es la que gestiona los eventos y acciones de contrato
 * @author Ramiro Gutierrez
 * @date  17/05/2013
 */
function Contrato(){
	/**
	 * Metodo q ejecuta el formulario de nuevo contrato
	 */
	this.formularioNuevoContrato = function(id_proyecto, codigo_proyecto){
		var util = new Utilitarios();
		
		$("#nro_doc_cont").val('');
		$("#fec_doc_cont").val('');
		$("#obs_cont").val('');
		
		
		
		util.validarCampo('nro_doc_cont', 'error_nro_doc_cont', 'El campo Nro. Documento no puede estar vacio');
		$("#fec_doc_cont").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#label_codigo_proyecto").empty();
		$("#label_codigo_proyecto").append(codigo_proyecto);
		$("#codigo_proyecto_hidden").val(codigo_proyecto);
		$("#formulario_nuevo_contrato").dialog({
			height: 330,
			width: 560,
			modal: true,
			resizable: false,
			draggable: false,
			closeText: "hide"
		});
	}
	
	/**
	 * Este metodo graba los datos del formulario
	 */
	this.grabarNuevoContrato = function(){
		var util = new Utilitarios();
		
		if($('#nro_doc_cont').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nro. Documento es obligatorio', 'Mensaje Contrato');
		}else if($('#fec_doc_cont').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Documento es obligatorio', 'Mensaje Contarto');
		}else {
			$.ajax({
				url:'router/ContratoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'grabarNuevoContrato',
					numero_documnento:$('#nro_doc_cont').val(),
					codigo_proyecto :$('#codigo_proyecto_hidden').val(),
					fec_doc : $('#fec_doc_cont').val(),
					descripcion_contrato : $('#obs_cont').val()
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					
					if(resultado.completo == true){

						var estado_proyecto = resultado.estado_proyecto;
						var codigo_proyecto = resultado.codigo_proyecto;
						//new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
						//$('#formulario_nuevo_contrato').dialog('close'); // hace que se cierre el dialog
						//util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Contrato');
						//$('#tabla_datos_proyectos').empty();
						//$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						//new Proyecto().listarProyectos();

								$.ajax({
									url:'router/ContratoRouter.php',
									dataType: 'json',
									type: 'POST',
									data : { 
										
										accion : 'procesarContrato',
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
											util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Contrato');
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
	
	
	this.modificarFormularioContrato = function(){
	
		var util = new Utilitarios();
		
		if($('#nro_doc_cont_mod').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Numero de Documento es obligatorio', 'Mensaje Contrato');
		}else if($('#fec_doc_cont_mod').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha documento es obligatorio', 'Mensaje Contarto');
		}else {
			$.ajax({
				url:'router/ContratoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'ActualizarContrato',
					cod_proy_con:$('#codigo_proyecto_hidden_con_mod').val(),
					id_proy_con:$('#id_proyecto_hidden_con_mod').val(),
					num_doc_con:$('#nro_doc_cont_mod').val(),
					fecha_doc_con:$('#fec_doc_cont_mod').val(),
					obs_con:$('#obs_cont_mod').val()
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){		
					if(resultado.completo == true){
						var estado_proyecto = resultado.estado_proyecto;
						var codigo_proyecto = resultado.codigo_proyecto;
						var id_proyecto = resultado.id_proyecto;
						new Proyecto().updateProyecto(codigo_proyecto,estado_proyecto);
						new Contrato().bajaContrato(codigo_proyecto,id_proyecto);
						$('#formulario_modificar_contrato').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Contrato');
						$('#tabla_datos_proyectos').empty();
						$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new Proyecto().listarProyectos();
						
					}else if(resultado.completo == false){

					}
				}
			});
		}
	
	}
	
	/**
	* metodo el cual se da de baja al contrato antes de modificarlo
	*/
	this.bajaContrato = function(codigo_proyecto,id_proyecto){
		$.ajax({
				url:'router/ContratoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'bajaContrato',
					codigo_proyecto:codigo_proyecto,
					id_proyecto:id_proyecto

				},
				beforeSend : function(){
					
				},
				success: function(resultado){	
				
				}
		});
	}
	
	
}