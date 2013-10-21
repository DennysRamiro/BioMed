/**
 * @description Esta clase es la que gestiona los eventos y acciones de contrato
 * @author Ramiro Gutierrez
 * @date  17/05/2013
 */
function ListaModificaciones(){
	/**
	 * Metodo q ejecuta el formulario de nuevo contrato
	 */
	this.formularioListaModificaciones = function(id_proyecto, codigo_proyecto){
		//console.log(id_proyecto+ codigo_proyecto);
		$.ajax({
			url:'router/ListaModificacionesRouter.php',
			dataType:'json',
			type:"POST",
			data:{
					accion:'listarProyectosModificados',
					cod_proy: codigo_proyecto
				},
				beforeSend: function(){
					$("#formulario_lista_modificaciones").empty();
					
				},success: function(res){
					//console.log(res);
					
					var lista_modificacion_cab = '<br><center><strong><label id="">LISTA DE PROYECTOS PARA MODIFICAR</label></center><br><label id="">NOMBRE PROYECTO :</label><label id="">'+res[0].nom_proy+'</label><div align="right"><label id="">FECHA DE REGISTRO DEL PROYECTO :</label><label id="">'+res[0].fec_reg_proy+'</label></div><BR><label id="">CODIGO PROYECTO :</label><label id="">'+codigo_proyecto+'</label><BR></strong><br><br>';
							
			lista_modificacion_cab = lista_modificacion_cab+'<table align="center" class="table_usuario" id="">';
			lista_modificacion_cab = lista_modificacion_cab+'<tr><th>FECHA INICIO</th><th>ESTADO</th><th>OBSERVACIONES</th><th>ACCIONES</th></tr>';
			
			$.each(res, function(index, lista){
				//console.log(lista);
						lista_modificacion_cab = lista_modificacion_cab+'<tr><td>'+lista.fec_inicio_proy+'</td>';
						lista_modificacion_cab = lista_modificacion_cab+'<td>'+lista.tipo_nombre+'</td>';
						lista_modificacion_cab = lista_modificacion_cab+'<td>'+lista.obser_proy+'</td>';
						lista_modificacion_cab = lista_modificacion_cab+'<td><div style="float:left; width:20px; text-align:center; margin-left:0px; margin-right:5px; cursor:pointer;"><a onClick="new ListaModificaciones().formularioModificarContrato('+lista.id_proy+',\''+codigo_proyecto+'\');" > <img src="../img/edit_32x32.png" align="absmiddle">Modificar</a></div></td></tr>';
						//$('#formulario_lista_modificaciones').append(lista_modificacion_cab);
					});
			
					lista_modificacion_cab = lista_modificacion_cab+'</table><br><br>';
					$('#formulario_lista_modificaciones').append(lista_modificacion_cab);
				
				}, error: function(){
				
				}
		});
		
			//$("#formulario_lista_modificaciones").empty();
			$("#label_codigos_proyectos_trans_lm").append(codigo_proyecto);
			$("#codigos_proyectos_hidden_lm").val(codigo_proyecto);
			$("#formulario_lista_modificaciones").dialog({
				height: 330,
				width: 860,
				modal: true,
				resizable: false,
				draggable: false,
				closeText: "hide"
			});
	}
	
	
	/**
	*	Formulario que modifica el contrato
	*	id_proyecto, codigo_proyecto parametros que se necesitan para la modificacion
	*/
	this.formularioModificarContrato = function(id_proyecto, codigo_proyecto){
	//console.log("js");
		$.ajax({
			url:'router/ContratoRouter.php',
			dataType:'json',
			type:"POST",
			data:{
					accion:'modificarContrato',
					cod_proy: codigo_proyecto,
					id_proy:id_proyecto
				},
				beforeSend: function(){
						$('#formulario_modificar_contrato').empty();
					
				},success: function(res){
					//console.log(res);
				//console.log(res.alm_form_id);
					
					var contrato_form = ' <table align="center" BORDER="0"><tr><td><strong>Codigo Proyecto :</strong></td><td><label id="label_codigo_proyecto">'+res.alm_proy_cod+'</label><input type="hidden" value="'+res.alm_proy_cod+'" id="codigo_proyecto_hidden_con_mod" /><input type="hidden" value="'+res.alm_form_id+'" id="id_proyecto_hidden_con_mod" /></td></td></tr>';
					        
          		contrato_form = contrato_form+ '<tr><td ><strong>Numero de Documento :</strong></td><td><input  class="txt_campo" name="nro_doc_cont_mod" id="nro_doc_cont_mod" cols="50" rows="2" value="'+res.alm_form_nro_doc+'"><div id="error_desc"></div></td></tr>';
              
             contrato_form = contrato_form+'<tr><td ><strong>Fecha Documento :</strong></td><td><input class="txt_campo" type="text" name="fec_doc_cont_mod" maxlength="60"id="fec_doc_cont_mod" value="'+res.alm_form_fecha_doc+'"><div id="error_fec_ini"></div></td></tr>';
              
             contrato_form = contrato_form+' <tr><td ><strong>Observaciones :</strong></td><td><textarea  name="obs_cont_mod" id="obs_cont_mod" cols="50" rows="2">'+res.alm_form_observaciones+'</textarea><div id="error_desc"></div></td></tr>';

            contrato_form = contrato_form+'<tr><td></td><td> <br><input class="btn_form" type="submit" name="accion" value="Grabar" onclick="new GestionImportacion().modificarFormularioContrato('+res.alm_form_id+',\''+res.alm_proy_cod+'\')"></td></tr>';
             contrato_form = contrato_form+'</table>';
           
       				$('#formulario_modificar_contrato').append(contrato_form);
					
					//$("#formulario_nuevo_contrato").empty();
					
				},error:function(){
					
				}
				
		});
		//console.log("holas");
		$("#formulario_modificar_contrato").empty();
		$("#fec_doc_cont_mod").datepicker();
		$("#formulario_modificar_contrato").dialog({
						height: 330,
						width: 460,
						modal: true,
						resizable: false,
						draggable: false,
						closeText: "hide"
					});
	}
	
	
	
	
	
}