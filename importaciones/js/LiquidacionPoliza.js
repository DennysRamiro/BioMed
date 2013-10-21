/**
 * @description Esta clase es la que gestiona los eventos y acciones de fromulario agencia
 * @author annahi gomez
 * @date  20/05/2013
 */
function AgenciaDespachante(){
	
	/*
	* Metodo que agarra los datos del formulario Agencia Aduanera usando la funcion serializeArray()
	*/

	/*seleccionar consolidado o lista*/
	this.listaDetOpciones=function(codigo_proyecto){
	alert(codigo_proyecto);
	
	        $('#formulario_deta_seleccionar').empty();
        var tabla_datos = '<table id="tabla_desa_seleccionar" align="left" class="table_usuario"><label><strong>CODIGO PROYECTO:</strong> </label>';
			tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br><br>';
			tabla_datos = tabla_datos+'<strong>SELECCIONE UNA DE LAS SIGUIENTES OPCIONES :</strong>';
			tabla_datos = tabla_datos+'<th align="center">NRO.</th>';
			tabla_datos = tabla_datos+'<th align="center">TIPO DE GUIA</th>';
			tabla_datos = tabla_datos+'<th align="center">ACCIONES</th>';
		    tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>1</strong>&nbsp;&nbsp;</td><td><label><strong>Desaduanizacion Consolidado</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"><a  onclick="new GestionImportacion().formularioDesaduanizacion(\''+codigo_proyecto+'\');"><img src="../img/consolidado_48x48.png"><br></a></div></td></tr>';
			tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>2</strong>&nbsp;&nbsp;</td><td><label><strong>Desaduanizacion por Proveedor</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioListaDesaProv(\''+codigo_proyecto+'\');"><img src="../img/listado_48x48.png"><br></a></div></td></tr></table>';
			$('#formulario_deta_seleccionar').append(tabla_datos);
	        $("#formulario_deta_seleccionar").dialog({
					height: 380, 
					width: 500,
					modal: true,
					resizable: true,
					draggable: false,
					closeText: "hide"
				});	
	}
	this.AgenciadespachanteInicio = function(id_proyecto, codigo_proyecto){

			$('#formAgeAdu').submit(function() {
				var valoresAgAdu = $(this).serializeArray();
				console.log($(this).serializeArray());
				//var accion= new Array();
//				accion[0] = { "accion": "grabarNuevoAgeDespach" };
				
				var util = new Utilitarios();
					 if($('#cod_age').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Agencia Aduanera es obligatorio', 'Mensaje Proyecto');
					}else if($('#nro_fac_age').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Nro. Factura es obligatorio', 'Mensaje Proyecto');
					}else if($('#nro_sid_age').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Nro. Sidunea es obligatorio', 'Mensaje Proyecto');
					} 

				$.ajax({
					url:'router/AgenciaDespachanteRouter.php',
					dataType: 'json',
					type: 'POST',
					
					data : valoresAgAdu,
					//accion : 'grabarNuevoAgeDespach',
					success: function(data){
					},
					beforeSend : function(){
					},
					success: function(resultado){
						if(resultado.completo == true){
							var estado_proyecto = resultado.estado_proyecto;
							var codigo_proyecto = resultado.codigo_proyecto;
							new Proyecto().updateProyecto(estado_proyecto,codigo_proyecto);
								$('#formulario_nuevo_agencia_depach').dialog('close'); // hace que se cierre el dialog
								//util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Planilla Aduanera');
								/*$('#tabla_datos_proyectos').empty();
     							$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);*/
							new Proyecto().listarProyectos();
						}
						
					},
					error: function(resultado){
					}
				});	
			
				return false;
				
				
			});
	}
	

	/**
	 * Metodo q ejecuta el formulario de nuevo form. agencia
	 */
	this.NuevoAgenciaDespachante = function(id_proyecto, codigo_proyecto){
		$("#fec_age").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#codigo_proyectos").empty();
		$("#codigo_proyectos").append(codigo_proyecto);
		$("#codigo_proyecto_hidden_age").val(codigo_proyecto);
		
		$("#formulario_nuevo_agencia_depach").dialog({
			height: 540,
			width: 740,
			modal: true,
			resizable: false,
			draggable: false,
			closeText: 'hide'
		});
	}

	/**
	 * Este metodo graba los datos del formulario
	 */
	this.GrabarNuevoAgenciaDespach = function(){
		
		
	}


}