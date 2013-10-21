/**
 * @description Esta clase es la que gestiona los eventos y acciones de Detalle de Liquidacion de Poliza
 * @author Ramiro Gutierrez
 * @date  24/05/2013
 */
function DetalleLiquidacion(){

/*seleccionar consolidado o lista*/
	this.listaDetOpciones=function(codigo_proyecto){
	//alert(codigo_proyecto);
	var estado_proyecto=12;
	        $('#formulario_deta_seleccionar').empty();
        var tabla_datos = '<table id="tabla_desa_seleccionar" align="left" class="table_usuario"><label><strong>CODIGO PROYECTO:</strong> </label>';
			tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label><br><br>';
			tabla_datos = tabla_datos+'<strong>SELECCIONE UNA DE LAS SIGUIENTES OPCIONES :</strong>';
			tabla_datos = tabla_datos+'<th align="center">NRO.</th>';
			tabla_datos = tabla_datos+'<th align="center">TIPO DE GUIA</th>';
			tabla_datos = tabla_datos+'<th align="center">ACCIONES</th>';
		    tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>1</strong>&nbsp;&nbsp;</td><td><label><strong>Detalle Liquidacion Consolidado</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"><a  onclick="new GestionImportacion().formularioDetalleLiquidacionCons(\''+codigo_proyecto+'\');"><img src="../img/consolidado_48x48.png"><br></a></div></td></tr>';
			tabla_datos = tabla_datos+'<tr><td>&nbsp;&nbsp;<strong>2</strong>&nbsp;&nbsp;</td><td><label><strong>Detalle Liquidacion por Proveedor</strong></label></td><br>';
			tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioListaDetalleLiquidacion(\''+codigo_proyecto+'\');"><img src="../img/listado_48x48.png"><br></a></div></td></tr></table><br>';
			tabla_datos = tabla_datos+'<br><td></td><div align="center"><br><tr><td><br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarLiquidacion(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr></div>';
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
        /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.formularioListaDetalleLiquidacion = function(codigo_proyecto){
		//alert(codigo_proyecto);
		var util=new Utilitarios();
			$.ajax({
				url:'router/DetalleLiquidacionRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarLiquidacion',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					$('#tabla_datos_liquidacion').empty();
	  		        $('#tabla_datos_liquidacion').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	
					//alert("GRABO BIEN...");
				
					//var id_proyecto=resultado[0].alm_proy_id;
					var codigo_proyecto=resultado[0].codigo_proyecto;
					var estado_proyecto=resultado[0].estado_proyecto;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_datos_liquidacion').empty();

					var tabla_datos = '<label><strong>CODIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<br><br><table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">PLANILLA NRO.</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">MERCADERIA</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_age_adu_tra_nro_fac+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_age_adu_tra_merc+'</td>';
						
						tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetalleLiquidacion('+value.alm_age_adu_tra_id+',\''+value.alm_age_adu_tra_cod_proy+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Mostrar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarLiquidacion(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr>';
					$('#tabla_datos_liquidacion').append(tabla_datos);
					$("#formulario_lista_liquidacion").dialog({
							height: 405, 
							width: 800,
							modal: true,
							resizable: true,
							draggable: false,
							closeText: "hide"
						});			
				},
				error: function(resultado){
					util.mostrarMensajeAlerta(0, 'No existe Datos Por Proveedor', 'Alerta Detalle de Liquidacion');
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	

		
	}

     /*
	 * Metodo q ejecuta el formulario de Detale de liquidacion de poliza
	 */
	this.formularioDetalleLiquidacion = function(id_liquidacion,codigo_proyecto){
		//alert('Liquidacion'+codigo_proyecto+id_liquidacion);
		//$("#fec_doc_cont").datepicker();
		//$("#label_codigo_proyecto").empty();
		//$("#label_codigo_proyecto").append(codigo_proyecto);consolidado
		$("#tabla_detalle_liquidacion").empty();
		$("#tabla_poliza_costos").empty();
		$("#cod_proy_hidden").val(codigo_proyecto);
		
		$.ajax({
			url:'router/DetalleLiquidacionRouter.php',
			dataType:'json',
			type:'POST',
			data:{ accion: 'Cabecera',
					cod_proyecto: codigo_proyecto,
					id_liquidacion: id_liquidacion
			},
			beforeSend: function(){

		},
		success: function(res){
			//console.log(res.cod_adu);
			var cabecera = '<br><center><strong><label id="">DETALLE DE LIQUIDACION DE POLIZA</label><br><label id="">(Expresado en Bolivianos)</label><BR><label id="">COD PROY:'+codigo_proyecto+'</label></center></strong><br><br><table align="center" class="table_usuario" id="">';
			cabecera = cabecera+'<tr><td>SIDUNEA</td><td align="center">'+res.sidunea+'</td><td >AGENCIA</td><td align="center">'+res.agencia+'</td></tr>';
			cabecera = cabecera+'<tr><td >MERCADERIA</td><td align="center">'+res.mercaderia+'</td><td >BULTO</td><td align="center">'+res.bultos+' '+res.medidas+'</td></tr>';
			cabecera = cabecera+'<tr><td >PESO</td><td align="center">'+res.peso+' '+res.pesos+'</td><td >FACTURA COMERCIAL</td><td align="center">'+res.factura+'</td></tr>';
			cabecera = cabecera+'<tr><td >VALOR CIF BS</td><td align="center">'+res.cif+'</td><td>PEDIDO Nro</td><td align="center">'+res.prov+'</td></tr>';
			cabecera = cabecera+'</table><br><br>';
			$('#tabla_detalle_liquidacion').append(cabecera);
			
		$.ajax({
				url:'router/DetalleLiquidacionRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'ListaPoliza',
					cod_proyecto:res.cod_adu
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
	
					var tabla_poliza = '<table align="center" class="table_usuario" id="tabla_poliza_costos"><tr>';
					tabla_poliza = tabla_poliza+'<th align="center">DETALLE</th>';
					tabla_poliza = tabla_poliza+'<th align="center">TOTAL</th>';
					tabla_poliza = tabla_poliza+'<th align="center">CF-IVA</th>';
					tabla_poliza = tabla_poliza+'<th align="center">NETO</th></tr></table>';
					$('#tabla_detalle_liquidacion').append(tabla_poliza);
			
					$.each(resultado, function(index, lista){
						tabla_poliza = '<tr><td>'+lista.detalle+'</td>';
						tabla_poliza = tabla_poliza+'<td>'+lista.total+'</td>';
						tabla_poliza = tabla_poliza+'<td>'+lista.iva+'</td>';
						tabla_poliza = tabla_poliza+'<td>'+lista.neto+'</td></tr>';
						$('#tabla_poliza_costos').append(tabla_poliza);
					});
					
					$.ajax({
						url:'router/DetalleLiquidacionRouter.php',
						dataType: 'json',
						type: 'POST',
						data : { 
							accion : 'ListaSumatoria',
							cod_proyecto:res.cod_adu
							
						},
						beforeSend : function(){
							
						},
						success: function(resultado){			
							tabla_poliza = '<tr><th>'+resultado.total+'</th>';
							tabla_poliza = tabla_poliza+'<td>'+resultado.totales+'</td>';
							tabla_poliza = tabla_poliza+'<td>'+resultado.totaliva+'</td>';
							tabla_poliza = tabla_poliza+'<td>'+resultado.totalneto+'</td></tr>';
							$('#tabla_poliza_costos').append(tabla_poliza);
						},
						error: function(resultado){
							
						}
					});

					/*tabla_poliza = tabla_poliza+'</table>';
					$('#tabla_detalle_liquidacion').append(tabla_poliza);*/

					$("#form_detalle_liquidacion").dialog({
						height: 450,
						width: 750,
						modal: true,
						resizable: true,
						draggable: true,
						closeText: "hide"
					});	
		
				},
				error: function(resultado){
					
				}
			});	
		},
		error: function(resultado){
		}
		
		});
		
		

		
	}

	  /*
	 * Metodo q ejecuta el formulario de Detale de liquidacion de poliza
	 */
	this.formularioDetalleLiquidacionCons = function(codigo_proyecto){
		//alert('Liquidacion'+codigo_proyecto);
		//$("#fec_doc_cont").datepicker();
		//$("#label_codigo_proyecto").empty();
		//$("#label_codigo_proyecto").append(codigo_proyecto);
		var util=new Utilitarios();
		$("#tabla_detalle_liquidacion_cons").empty();
		$("#tabla_poliza_costos_cons").empty();
		$("#cod_proy_hidden_cons").val(codigo_proyecto);
		
		$.ajax({
			url:'router/DetalleLiquidacionRouter.php',
			dataType:'json',
			type:'POST',
			data:{ accion: 'Cabecera1',
					cod_proyecto: codigo_proyecto
				
			},
			beforeSend: function(){

		},
		success: function(res){
			console.log(res.cod_adu);
			var cabecera = '<br><center><strong><label id="">DETALLE DE LIQUIDACION DE POLIZA</label><br><label id="">(Expresado en Bolivianos)</label><BR><label id="">COD PROY:'+codigo_proyecto+'</label></center></strong><br><br><table align="center" class="table_usuario" id="">';
			cabecera = cabecera+'<tr><td>SIDUNEA</td><td align="center">'+res.sidunea+'</td><td >AGENCIA</td><td align="center">'+res.agencia+'</td></tr>';
			cabecera = cabecera+'<tr><td >MERCADERIA</td><td align="center">'+res.mercaderia+'</td><td >BULTO</td><td align="center">'+res.bultos+' '+res.medidas+'</td></tr>';
			cabecera = cabecera+'<tr><td >PESO</td><td align="center">'+res.peso+' '+res.pesos+'</td><td >FACTURA COMERCIAL</td><td align="center">'+res.factura+'</td></tr>';
			cabecera = cabecera+'<tr><td >VALOR CIF BS</td><td align="center">'+res.cif+'</td><td>PEDIDO Nro</td><td align="center">'+res.prov+'</td></tr>';
			cabecera = cabecera+'</table><br><br>';
			$('#tabla_detalle_liquidacion_cons').append(cabecera);
			
		$.ajax({
				url:'router/DetalleLiquidacionRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'ListaPoliza',
					cod_proyecto:res.cod_adu
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
	
					var tabla_poliza = '<table align="center" class="table_usuario" id="tabla_poliza_costos_cons"><tr>';
					tabla_poliza = tabla_poliza+'<th align="center">DETALLE</th>';
					tabla_poliza = tabla_poliza+'<th align="center">TOTAL</th>';
					tabla_poliza = tabla_poliza+'<th align="center">CF-IVA</th>';
					tabla_poliza = tabla_poliza+'<th align="center">NETO</th></tr></table>';
					$('#tabla_detalle_liquidacion_cons').append(tabla_poliza);
			
					$.each(resultado, function(index, lista){
						tabla_poliza = '<tr><td>'+lista.detalle+'</td>';
						tabla_poliza = tabla_poliza+'<td>'+lista.total+'</td>';
						tabla_poliza = tabla_poliza+'<td>'+lista.iva+'</td>';
						tabla_poliza = tabla_poliza+'<td>'+lista.neto+'</td></tr>';
						$('#tabla_poliza_costos_cons').append(tabla_poliza);
					});
					
					$.ajax({
						url:'router/DetalleLiquidacionRouter.php',
						dataType: 'json',
						type: 'POST',
						data : { 
							accion : 'ListaSumatoria',
							cod_proyecto:res.cod_adu
							
						},
						beforeSend : function(){
							
						},
						success: function(resultado){			
							tabla_poliza = '<tr><th>'+resultado.total+'</th>';
							tabla_poliza = tabla_poliza+'<td>'+resultado.totales+'</td>';
							tabla_poliza = tabla_poliza+'<td>'+resultado.totaliva+'</td>';
							tabla_poliza = tabla_poliza+'<td>'+resultado.totalneto+'</td></tr>';
							$('#tabla_poliza_costos_cons').append(tabla_poliza);
						},
						error: function(resultado){
							
						}
					});

					/*tabla_poliza = tabla_poliza+'</table>';
					$('#tabla_detalle_liquidacion').append(tabla_poliza);*/

					$("#form_detalle_liquidacion_cons").dialog({
						height: 450,
						width: 750,
						modal: true,
						resizable: true,
						draggable: true,
						closeText: "hide"
					});	
		
				},
				error: function(resultado){
					
				}
			});	
		},
		error: function(resultado){
		util.mostrarMensajeAlerta(0, 'No existe Datos en el Consolidado', 'Alerta Detalle de Liquidacion');
		}
		
		});	
	}
			 /**
	 * Metodo q procesa el formulario de Certificados para cambiar de estado
	 */
	this.procesarLiquidacion=function(codigo_proyecto,estado_proyecto){
		//console.log(codigo_proyecto+estado_proyecto)
		var util = new Utilitarios();
		$.ajax({
				url:'router/DetalleLiquidacionRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'procesarLiquidacion',
					estado_proyecto :estado_proyecto,
					codigo_proyecto :codigo_proyecto
					
				},
				beforeSend : function(){
					
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

				if(resultado.completo== true){
						//alert("GRABO BIEN...");
						//$('#formulario_lista_liquidacion').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Se proceso correctamente los Detalles de Liquidacion', 'Confirmacion Detalle de Liquidacion');
						$(location).attr('href', 'imp_gest_imp.php');
						//$('#tabla_datos_liquidacion').empty();
						//$('#tabla_datos_liquidacion').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
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