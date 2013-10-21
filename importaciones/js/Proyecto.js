/**
 * @description Esta clase es la que gestiona los eventos y acciones de proyecto
 * @author Daniel Fernandez
 * @date  16/05/2013
 */
function Proyecto(){
	/**
	 * Metodo q ejecuta el formulario de nuevo proyecto
	 */
	this.formularioNuevoProyecto = function(){
		//alert("asdasd");
		$("#fec_ini").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#fec_fin").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#nombre_proyecto").val('');
		$("#fec_ini").val('');
		$("#fec_fin").val('');
		$("#descripcion_proyecto").val('');
		$("#formulario_nuevo_proyecto").dialog({
			height: 400,
			width: 540,
			modal: true,
			resizable: false,
			draggable: false,
			closeText: 'hide'
		});
	}
	/**
	 * Este metodo graba los datos del formulario
	 */
	this.grabarNuevoProyecto = function(){
		
		//alert("asdasdasd");
	var util = new Utilitarios();
		if($('#nombre_proyecto').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Nombre del proyecto es obligatorio', 'Mensaje Proyecto');
		}else if($('#fec_ini').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha Inicio es obligatorio', 'Mensaje Proyecto');
		}else if ($('#descripcion_proyecto').val()==""){
			util.mostrarMensajeAlerta(0, 'El campo Descripci&oacute;n es obligatorio', 'Mensaje Proyecto');
		}else {
			$.ajax({
				url:'router/ProyectoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'grabarNuevoProyecto',
					nombre_proyecto:$('#nombre_proyecto').val(),
					tipo_proyecto :$('#tipo_proyecto').val(),
					fec_ini : $('#fec_ini').val(),
					fec_fin : $('#fec_fin').val(),
					descripcion_proyecto : $('#descripcion_proyecto').val()
				},
				beforeSend : function(){
				},
				success: function(resultado){
					if(resultado.completo == true){
						//$('#formulario_nuevo_proyecto').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Proyecto');
						//new Proyecto().listarProyectos();
						$(location).attr('href', 'imp_gest_imp.php');
					}else if(resultado.completo == false){

					}
					
				},
				error: function(resultado){
				}
			});	
		}
		
	}
	/**
	 *  Este metodo lista todos los proyectos
	 */
	 this.listarProyectos = function(){
		 $('#tabla_datos_proyectos').empty();
  		 $('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
		 $.ajax({
			    url:'router/ProyectoRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					accion : 'listarProyectos'
				},
				beforeSend : function(){
				},
				success: function(resultado){
					//console.log(resultado);
					var estado= resultado[0].alm_proy_cod_estado;
					//alert(estado);
					$('#tabla_datos_proyectos').empty();
					var tabla_datos = '<table   class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NOMBRE</th>';
						tabla_datos = tabla_datos+'<th align="center">COD. PROY.</th>';
						tabla_datos = tabla_datos+'<th align="center">TIPO</th>';
						tabla_datos = tabla_datos+'<th align="center">FECHA INICIO</th>';
						tabla_datos = tabla_datos+'<th align="center">FECHA FIN</th>';
						tabla_datos = tabla_datos+'<th align="center">ESTADO</th>';
						tabla_datos = tabla_datos+'<th align="center">CONTINUAR</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td>'+value.alm_proy_nom+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_proy_cod+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_proy_tipo+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_proy_fecha_inicio+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_proy_fecha_fin+'</td>';
							tabla_datos = tabla_datos+'<td>'+value.alm_proy_estado+'</td>';
						if (value.alm_proy_cod_estado==1) {
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioContrato('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/documents_32x32.png" align="absmiddle"><br> Contrato/Pedido</a></div></td>';
						}else if(value.alm_proy_cod_estado==2){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioListaOrdenCompra(\''+value.alm_proy_cod+'\');" > <img src="../img/orden_compra_32x32.png" align="absmiddle"><br> Ordenes</a></div></td>';
						}else if (value.alm_proy_cod_estado==4){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioTransferenciaBancaria('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/transferenciaBancaria_32x32.png" align="absmiddle"><br> Transferencia Bancaria</a></div></td>';
						}else if (value.alm_proy_cod_estado==5){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/confirmacion_banco_32x32.png" align="absmiddle"><br> Confirmacion Bancaria</a></div> </td>';
						}else if (value.alm_proy_cod_estado==6){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioCertificacionTransferenciaBancaria('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/certification_bancaria_32x32.png" align="absmiddle"><br> certificacion bancaria</a></div> </td>';
						}else if (value.alm_proy_cod_estado==7){
							tabla_datos = tabla_datos+'<td align="center"> <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioGuiaEmbarque('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/guia_32x32.png" align="absmiddle"><br> Guia de Embarque</a></div></td>';
						}else if (value.alm_proy_cod_estado==8){
							var guia =new GuiaEmbarque();
							var dato=guia.listaGuiasCert(''+value.alm_proy_cod+'');
							//var cert1 = cert[0].alm_form_cert_otros;
							//alert("EsteSS"+value.alm_proy_cod);
							//alert("Este"+dato);
							//console.log(dato); //FALTA CON O SIN CERTIFICADO

							tabla_datos = tabla_datos+'<td align="center">PRUEBA</td>';
						}else if (value.alm_proy_cod_estado==9){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDesaduanizacion('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/aduana_32x32.png" align="absmiddle"><br>Desaduanizacion</a></div></td>';
						}else if (value.alm_proy_cod_estado==10){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioAgenciaDespachante('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/agencia_form_32x32.png" align="absmiddle"><br>Planilla Aduanera</a></div></td>';
						}else if (value.alm_proy_cod_estado==11){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDetalleLiquidacion('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/costo_desaduanizacion_32x32.png" align="absmiddle"><br>Detalle Liquidacion</a></div></td>';
						}else if (value.alm_proy_cod_estado==12){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDetalleLiquidacion('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/hoja_costo2_32x32.png" align="absmiddle"><br>Hoja de Costo</a></div></td>';
						}	
						if(value.alm_proy_cod_estado==4){
							tabla_datos = tabla_datos+'<td></td>';
						}else{
							tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().bajaProyecto(\''+value.alm_proy_cod+'\');"><img src="../img/proyecto_baja_32x32.png"><br> Cancelar</a></div> </td>';
						}
							
					});
					tabla_datos = tabla_datos+'</tr></table>';
					$('#tabla_datos_proyectos').append(tabla_datos);
				},
				error: function(resultado){
				} 
		 });
	 }
	 /**
	  * Metodo que permite buscar por la palabra ingresada en el campo  y presionado por el boton buscar
	  */
	this.buscarProyectoBtn = function(palabra_buscar){
		//alert(palabra_buscar);
		var datos = palabra_buscar.split(" ");
		//console.log(datos);
	 	$.ajax({
			url:'router/ProyectoRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'buscarXPalabraConBtn',
				codigo_proyecto : datos[0]	
			},
			beforeSend : function(){
				$('#tabla_datos_proyectos').empty();
			    $('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(resultado){	
				var estado= resultado[0].alm_proy_cod_estado;
					//alert(estado);
					$('#tabla_datos_proyectos').empty();
					var tabla_datos = '<table   class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NOMBRE</th>';
						tabla_datos = tabla_datos+'<th align="center">COD. PROY.</th>';
						tabla_datos = tabla_datos+'<th align="center">TIPO</th>';
						tabla_datos = tabla_datos+'<th align="center">FECHA INICIO</th>';
						tabla_datos = tabla_datos+'<th align="center">FECHA FIN</th>';
						tabla_datos = tabla_datos+'<th align="center">ESTADO</th>';
						tabla_datos = tabla_datos+'<th align="center">CONTINUAR</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td>'+value.alm_proy_nom+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_proy_cod+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_proy_tipo+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_proy_fecha_inicio+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_proy_fecha_fin+'</td>';
						tabla_datos = tabla_datos+'<td>'+value.alm_proy_estado+'</td>';
						if (value.alm_proy_cod_estado==1) {
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioContrato('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/documents_32x32.png" align="absmiddle"><br> Contrato/Pedido</a></div></td>';
						}else if(value.alm_proy_cod_estado==2){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioListaOrdenCompra(\''+value.alm_proy_cod+'\');" > <img src="../img/orden_compra_32x32.png" align="absmiddle"><br> Ordenes</a></div></td>';
						}else if (value.alm_proy_cod_estado==4){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioTransferenciaBancaria('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/transferenciaBancaria_32x32.png" align="absmiddle"><br> Transferencia Bancaria</a></div></td>';
						}else if (value.alm_proy_cod_estado==5){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/confirmacion_banco_32x32.png" align="absmiddle"><br> Confirmacion Bancaria</a></div> </td>';
						}else if (value.alm_proy_cod_estado==6){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioCertificacionTransferenciaBancaria('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/certification_bancaria_32x32.png" align="absmiddle"><br> certificacion bancaria</a></div> </td>';
						}else if (value.alm_proy_cod_estado==7){
							tabla_datos = tabla_datos+'<td align="center"> <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioGuiaEmbarque('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/guia_32x32.png" align="absmiddle"><br> Guia de Embarque</a></div></td>';
						}else if (value.alm_proy_cod_estado==8){
							var guia =new GuiaEmbarque();
							var dato=guia.listaGuiasCert(''+value.alm_proy_cod+'');
							//var cert1 = cert[0].alm_form_cert_otros;
							//alert("EsteSS"+value.alm_proy_cod);
							//alert("Este"+dato);
						//	console.log(dato); //FALTA CON O SIN CERTIFICADO

							tabla_datos = tabla_datos+'<td align="center">PRUEBA</td>';
						}else if (value.alm_proy_cod_estado==9){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDesaduanizacion('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/aduana_32x32.png" align="absmiddle"><br>Desaduanizacion</a></div></td>';
						}else if (value.alm_proy_cod_estado==10){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioAgenciaDespachante('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/agencia_form_32x32.png" align="absmiddle"><br>Planilla Aduanera</a></div></td>';
						}else if (value.alm_proy_cod_estado==11){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDetalleLiquidacion('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/costo_desaduanizacion_32x32.png" align="absmiddle"><br>Detalle Liquidacion</a></div></td>';
						}else if (value.alm_proy_cod_estado==12){
							tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDetalleLiquidacion('+value.alm_proy_id+',\''+value.alm_proy_cod+'\');" > <img src="../img/hoja_costo2_32x32.png" align="absmiddle"><br>Hoja de Costo</a></div></td>';
						}	
						if(value.alm_proy_cod_estado==4){
							tabla_datos = tabla_datos+'<td></td>';
						}else{
							tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().bajaProyecto(\''+value.alm_proy_cod+'\');"><img src="../img/proyecto_baja_32x32.png"><br> Cancelar</a></div> </td>';
						}
					});
					tabla_datos = tabla_datos+'</tr></table>';
					$('#tabla_datos_proyectos').append(tabla_datos);
			},
			error: function(resultado){
			}
		});
	}
	 /**
	 *  Este metodo lista todos los proyectos buscados
	 */
	 this.buscarProyecto = function(palabra_buscar){ 
		$.ajax({
			url:'router/ProyectoRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'buscarProyectos',
				proyecto_buscar: palabra_buscar
			},
			beforeSend : function(){
			},
			success: function(resultado){
				$("#proyecto_buscar").autocomplete({
		        	source: resultado, /* este es el script que realiza la busqueda */
		        	minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
		        	select: new Proyecto().proyectoSeleccionado, /* esta es la rutina que extrae la informacion del producto seleccionado */
		        	focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
		    	});
			},
			error: function(resultado){
			}
		});		

	 }
	/**
	 * Metodo que nos muestra el producto seleccionado
	 */
	 this.proyectoSeleccionado = function(evt, ui){
	 	var valor = ui.item.value;
	 	var datos = valor.split(" ");
	 	$.ajax({
			url:'router/ProyectoRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'proyectoSeleccionado',
				id_proyecto : ui.item.id,
				codigo_proyecto : datos[0]	
			},
			beforeSend : function(){
			},
			success: function(resultado){
				$('#tabla_datos_proyectos').empty();
			    $('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			    $('#tabla_datos_proyectos').empty();
				var tabla_datos = '<table   class="table_usuario"><tr>';
				    tabla_datos = tabla_datos+'<th align="center">NOMBRE</th>';
					tabla_datos = tabla_datos+'<th align="center">COD. PROY.</th>';
					tabla_datos = tabla_datos+'<th align="center">TIPO</th>';
					tabla_datos = tabla_datos+'<th align="center">FECHA INICIO</th>';
					tabla_datos = tabla_datos+'<th align="center">FECHA FIN</th>';
					tabla_datos = tabla_datos+'<th align="center">ESTADO</th>';
					tabla_datos = tabla_datos+'<th align="center">CONTINUAR</th>';
					tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					tabla_datos = tabla_datos+'<tr><td>'+resultado.alm_proy_nom+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_cod+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_tipo+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_fecha_inicio+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_fecha_fin+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_estado+'</td>';
					
					if (resultado.estado_proyeto==1) {
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioContrato(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/documents_32x32.png" align="absmiddle"><br> Contrato/Pedido</a></div></td>';
					}else if(resultado.estado_proyeto==2){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioListaOrdenCompra(\''+resultado.alm_proy_cod+'\');" > <img src="../img/orden_compra_32x32.png" align="absmiddle"><br> Ordenes</a></div></td>';
					}else if (resultado.estado_proyeto==4){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioTransferenciaBancaria(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/transferenciaBancaria_32x32.png" align="absmiddle"><br> Transferencia Bancaria</a></div></td>';
					}else if (resultado.estado_proyeto==5){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/confirmacion_banco_32x32.png" align="absmiddle"><br> Confirmacion Bancaria</a></div> </td>';
					}else if (resultado.estado_proyeto==6){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioCertificacionTransferenciaBancaria(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/certification_bancaria_32x32.png" align="absmiddle"><br> certificacion bancaria</a></div> </td>';
					}else if (resultado.estado_proyeto==7){
						tabla_datos = tabla_datos+'<td align="center"> <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioGuiaEmbarque(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/guia_32x32.png" align="absmiddle"><br> Guia de Embarque</a></div></td>';
					}else if (resultado.estado_proyeto==8){
						var guia =new GuiaEmbarque();
						var dato=guia.listaGuiasCert(''+resultado.alm_proy_cod+'');
						tabla_datos = tabla_datos+'<td align="center">PRUEBA</td>';
					}else if (resultado.estado_proyeto==9){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDesaduanizacion(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/aduana_32x32.png" align="absmiddle"><br>Desaduanizacion</a></div></td>';
					}else if (resultado.estado_proyeto==10){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioAgenciaDespachante(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/agencia_form_32x32.png" align="absmiddle"><br>Planilla Aduanera</a></div></td>';
					}else if (resultado.estado_proyeto==11){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDetalleLiquidacion(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/costo_desaduanizacion_32x32.png" align="absmiddle"><br>Detalle Liquidacion</a></div></td>';
					}else if (resultado.estado_proyeto==12){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDetalleLiquidacion(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/hoja_costo2_32x32.png" align="absmiddle"><br>Hoja de Costo</a></div></td>';
					}	
					
					if(resultado.estado_proyeto>4){
						tabla_datos = tabla_datos+'<td></td>';
					}else{
						tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().bajaProyecto(\''+value.alm_proy_cod+'\');"><img src="../img/proyecto_baja_32x32.png"><br> Cancelar</a></div> </td>';
					}
				    tabla_datos = tabla_datos+'</tr></table>';
					$('#tabla_datos_proyectos').append(tabla_datos);	

			},
			error: function(resultado){
			}
		});

	 }
	/**
	 * Metodo que nos permite efocar el proyecto
	 */
	 this.proyectoEnfocado = function(evt, ui){
		 //alert("seleccionado");
	 	var valor = ui.item.value;
	 	var datos = valor.split(" ");
	 	$.ajax({
			url:'router/ProyectoRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'proyectoSeleccionado',
				id_proyecto : ui.item.id,
				codigo_proyecto : datos[0]	
			},
			beforeSend : function(){
			},
			success: function(resultado){
				//console.log(resultado);
				//console.log(resultado.estado_proyeto);
				//$('#tabla_datos_proyectos').empty();
			    $('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			    $('#tabla_datos_proyectos').empty();
				var tabla_datos = '<table   class="table_usuario"><tr>';
				    tabla_datos = tabla_datos+'<th align="center">NOMBRE</th>';
					tabla_datos = tabla_datos+'<th align="center">COD. PROY.</th>';
					tabla_datos = tabla_datos+'<th align="center">TIPO</th>';
					tabla_datos = tabla_datos+'<th align="center">FECHA INICIO</th>';
					tabla_datos = tabla_datos+'<th align="center">FECHA FIN</th>';
					tabla_datos = tabla_datos+'<th align="center">ESTADO</th>';
					tabla_datos = tabla_datos+'<th align="center">CONTINUAR</th>';
					tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					tabla_datos = tabla_datos+'<tr><td>'+resultado.alm_proy_nom+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_cod+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_tipo+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_fecha_inicio+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_fecha_fin+'</td>';
					tabla_datos = tabla_datos+'<td>'+resultado.alm_proy_estado+'</td>';
					
						if (resultado.estado_proyeto==1) {
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioContrato(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/documents_32x32.png" align="absmiddle"><br> Contrato/Pedido</a></div></td>';
					}else if(resultado.estado_proyeto==2){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioListaOrdenCompra(\''+resultado.alm_proy_cod+'\');" > <img src="../img/orden_compra_32x32.png" align="absmiddle"><br> Ordenes</a></div></td>';
					}else if (resultado.estado_proyeto==4){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioTransferenciaBancaria(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/transferenciaBancaria_32x32.png" align="absmiddle"><br> Transferencia Bancaria</a></div></td>';
					}else if (resultado.estado_proyeto==5){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioConfirmacionTransferenciaBancaria(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/confirmacion_banco_32x32.png" align="absmiddle"><br> Confirmacion Bancaria</a></div> </td>';
					}else if (resultado.estado_proyeto==6){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioCertificacionTransferenciaBancaria(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/certification_bancaria_32x32.png" align="absmiddle"><br> certificacion bancaria</a></div> </td>';
					}else if (resultado.estado_proyeto==7){
						tabla_datos = tabla_datos+'<td align="center"> <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioGuiaEmbarque(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/guia_32x32.png" align="absmiddle"><br> Guia de Embarque</a></div></td>';
					}else if (resultado.estado_proyeto==8){
						var guia =new GuiaEmbarque();
						var dato=guia.listaGuiasCert(''+resultado.alm_proy_cod+'');
						tabla_datos = tabla_datos+'<td align="center">PRUEBA</td>';
					}else if (resultado.estado_proyeto==9){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDesaduanizacion(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/aduana_32x32.png" align="absmiddle"><br>Desaduanizacion</a></div></td>';
					}else if (resultado.estado_proyeto==10){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioAgenciaDespachante(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/agencia_form_32x32.png" align="absmiddle"><br>Planilla Aduanera</a></div></td>';
					}else if (resultado.estado_proyeto==11){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDetalleLiquidacion(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/costo_desaduanizacion_32x32.png" align="absmiddle"><br>Detalle Liquidacion</a></div></td>';
					}else if (resultado.estado_proyeto==12){
						tabla_datos = tabla_datos+'<td align="center"><div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDetalleLiquidacion(1,\''+resultado.alm_proy_cod+'\');" > <img src="../img/hoja_costo2_32x32.png" align="absmiddle"><br>Hoja de Costo</a></div></td>';
					}	
					
					if(resultado.estado_proyeto>4){
						tabla_datos = tabla_datos+'<td></td>';
					}else{
						tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().bajaProyecto(\''+value.alm_proy_cod+'\');"><img src="../img/proyecto_baja_32x32.png"><br> Cancelar</a></div> </td>';
					}
				    tabla_datos = tabla_datos+'</tr></table>';
					$('#tabla_datos_proyectos').append(tabla_datos);	
					
					//new Proyecto().accionesPaContinuar(resultado.alm_proy_cod);

			},
			error: function(resultado){
			}
		});
	 }
	 
	  /**
	 * Este metodo actualiza los datos del estado del proyecto
	 */
	/*this.accionesPaContinuar = function(cod_proy){
		//console.log(cod_proy);
		
		$.ajax({
			url:'router/ProyectoRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'listarProyectos',
				//codigo_proyecto : cod_proy	
			},
			beforeSend : function(){
			},
			success: function(resultado){
				console.log(resultado);
				
			}
		});
	}*/
	
	 /**
	 * Este metodo actualiza los datos del estado del proyecto
	 */
	this.updateProyecto = function(cod_proy,estado){
			var util = new Utilitarios();
			$.ajax({
				url:'router/ProyectoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'actualizaEstadoProyecto',
					codigo_proyecto:cod_proy,
					estado_proyecto:estado
				},
				success: function(result){
					if(result.completo == true){
						//util.mostrarMensajeAlerta(1, 'Los datos se han guardado correctamente', 'Confirmacion Proyecto');	
						$(location).attr('href', 'imp_gest_imp.php');
					}
				}
			});
	}
	
	 /**
	 * Este metodo actualiza los datos del estado del proyecto y recarga la pagina de los proyectos
	 */
	this.dosAccionesProyecto = function(cod_proy,estado){
		
		$("#formulario_orden_transferencia_bancaria").dialog("close");
		//console.log(cod_proy+'---'+estado);
		new Proyecto().updateProyecto(cod_proy,estado);
		//$(location).attr('href', 'imp_gest_imp.php');
		//new Proyecto().listarProyectos();
	
	}
	
	/**
	* metodo que da de baja el contrato y el proyecto
	* cod_proy variable del codigo del proyecto
	*/
	this.darBajaProyecto = function(valor){
		///console.log("baja--"+valor);
		
		$.ajax({
				url:'router/ProyectoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'darBajaProyecto',
					codigo_proyecto:valor
					
				},
				beforeSend: function(){
				
				},
				success: function(result){
					console.log(result);
					if (result.completo==true){
						$("#dialog-confirm").dialog("close");
						new Proyecto().listarProyectos();
					}
					
				}
			});
	}
	
	/**
     * Metodo que permite desabilitar la orden de compra
     */
    this.desabilitarProyecto = function(codigo_proyecto){
		//console.log(codigo_proyecto);
		
    	$("#dialog-confirm" ).attr('title', 'Confirmacion');
		$("#dialog-confirm").empty();
		$("#dialog-confirm").append('<p><img src="../img/checkmark_48x48.png" align="absmiddle">Realmente quiere eliminar el Proyecto ?</p>');
		$("#dialog-confirm").dialog({
			resizable: false,
			height:200,
			width:400,
			modal: true,
			buttons: {
				"Aceptar": function() {
					//alert('Eliminado el proyecto '+codigo_proyecto);
					new Proyecto().darBajaProyecto(codigo_proyecto);
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});
		
    }
}