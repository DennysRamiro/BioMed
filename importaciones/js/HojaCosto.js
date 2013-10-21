
/**
 * @description Esta clase es la que gestiona los eventos y acciones de contrato
 * @author Ruth Palomino
 * @date  05/06/2013
 */

function HojaCosto(){


	   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.formularioListaHojaCosto = function(codigo_proyecto){
    //alert(codigo_proyecto);
			$.ajax({
				url:'router/HojaCostoRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarHojaCosto',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					//$('#tabla_datos_certificado').empty();
	  		        //$('#tabla_datos_certificado').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	
					//alert("GRABO BIEN...");
				    /*console.log(resultado);*/
					
					var codigo_proyecto=resultado[0].codigo_proyecto;
					var estado_proyecto=resultado[0].alm_form_tipo;
					//var total_bs=parseFloat(resultado[0].total_costo_trans_bs)+parseFloat(resultado[0].costo_bs_trans)+parseFloat(resultado[0].totalneto_pol)+parseFloat(resultado[0].suma_cert);
					//var total_sus=parseFloat(resultado[0].total_costo_trans_sus)+parseFloat(resultado[0].costo_sus_trans)+parseFloat(resultado[0].totalneto_pol_sus)+parseFloat(resultado[0].suma_cert_sus);
					//var total_bs=util.redondeo2decimales(total_bs);
					//var total_sus=util.redondeo2decimales(total_sus);
					//alert(alm_proy_cod);
					
					$('#tabla_datos_hoja_costo').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<br><br><table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<tr><th align="center">IMPORTACI&Oacute;N NRO.</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_nro_referencia_orden+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
					if (value.id==0) {
						tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a href="#" onclick="new GestionImportacion().generarCabeceraHoja(\''+value.codigo_proyecto+'\','+value.alm_nro_referencia_orden+',\''+value.alm_prov_codigo+'\','+value.alm_age_adu_tra_nro_fac+');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></tr>';
					}else if (value.id==1) {
						tabla_datos = tabla_datos+'<td><img src="../img/checkmark_32x32.png" align="absmiddle"><br> En Almacen</a></div></tr>';
					}
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<div align="center"><tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarHojaCosto(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr></div>';
					$('#tabla_datos_hoja_costo').append(tabla_datos);
					$("#formulario_lista_hoja").dialog({
							height: 380, 
							width: 500,
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
			});	//*/

	}

	   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.actualizarListaHojaCosto = function(codigo_proyecto){
  //alert(codigo_proyecto);
			$.ajax({
				url:'router/HojaCostoRouter.php',
				dataType: 'json',
				type: 'GET',
				data : { 
					
					accion : 'ListarHojaCosto',
					codigo_proyecto :codigo_proyecto
					//id_proyecto:id_proyecto 
						
				},
				beforeSend : function(){
					//$('#tabla_datos_certificado').empty();
	  		        //$('#tabla_datos_certificado').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	
					//alert("GRABO BIEN...");
				    /*console.log(resultado);*/
					
					var codigo_proyecto=resultado[0].codigo_proyecto;
					var estado_proyecto=resultado[0].alm_form_tipo;
					//var total_bs=parseFloat(resultado[0].total_costo_trans_bs)+parseFloat(resultado[0].costo_bs_trans)+parseFloat(resultado[0].totalneto_pol)+parseFloat(resultado[0].suma_cert);
					//var total_sus=parseFloat(resultado[0].total_costo_trans_sus)+parseFloat(resultado[0].costo_sus_trans)+parseFloat(resultado[0].totalneto_pol_sus)+parseFloat(resultado[0].suma_cert_sus);
					//var total_bs=util.redondeo2decimales(total_bs);
					//var total_sus=util.redondeo2decimales(total_sus);
					//alert(alm_proy_cod);
					
					$('#tabla_datos_hoja_costo').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<br><br><table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<tr><th align="center">IMPORTACI&Oacute;N NRO.</th>';
						tabla_datos = tabla_datos+'<th align="center">PROVEEDOR</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';
					$.each(resultado, function(index, value){
						tabla_datos = tabla_datos+'<tr><td align="center">'+value.alm_nro_referencia_orden+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_prov_nombre+'</td>';
					if (value.id==0) {
						tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a href="#" onclick="new GestionImportacion().generarCabeceraHoja(\''+value.codigo_proyecto+'\','+value.alm_nro_referencia_orden+',\''+value.alm_prov_codigo+'\','+value.alm_age_adu_tra_nro_fac+');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></tr>';
					}else if (value.id==1) {
						tabla_datos = tabla_datos+'<td><img src="../img/checkmark_32x32.png" align="absmiddle"><br> En Almacen</a></div></tr>';
					}
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<div align="center"><tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarHojaCosto(\''+codigo_proyecto+'\','+estado_proyecto+');"></td></tr></div>';
					$('#tabla_datos_hoja_costo').append(tabla_datos);
					/*$("#formulario_lista_hoja").dialog({
							height: 380, 
							width: 500,
							modal: true,
							resizable: true,
							draggable: false,
							closeText: "hide"
						});	*/			
				},
				error: function(resultado){
					//alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	//*/

	}

		   /**
	 * Metodo q ejecuta el formulario de las lista de certificados
	 */
	this.formularioListaItems = function(codigo_proyecto,cod_prov){
		//alert(codigo_proyecto);
		var nro=0;
		var codigo_proyecto=codigo_proyecto;
			$.ajax({
				url:'router/HojaCostoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'listarItems',
					codigo_proyecto :codigo_proyecto,
					cod_prov:cod_prov 
						
				},
				beforeSend : function(){
					$('#tabla_datos_items').empty();
	  		        $('#tabla_datos_items').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	

				
					//var id_proyecto=resultado[0].alm_proy_id;
					//var codigo_proyecto=resultado[0].codigo_proyecto;
					//var estado_proyecto=resultado[0].alm_form_tipo;
					//console.log(id_proyecto+codigo_proyecto+estado_proyecto);
					
					$('#tabla_datos_items').empty();

					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						//tabla_datos = tabla_datos+'<br><input type="button" value="Nuevo Certificado" class="btn_form" onClick="new GestionImportacion().formularioNuevoCertificado(\''+codigo_proyecto+'\');">';
						tabla_datos = tabla_datos+'<table  class="table_usuario"><tr>';
					    tabla_datos = tabla_datos+'<th align="center">NRO</th>';
					    tabla_datos = tabla_datos+'<th align="center">REFERENCIA</th>';
						tabla_datos = tabla_datos+'<th align="center">DESCRIPCION ITEM</th>';
						tabla_datos = tabla_datos+'<th align="center">CANTIDAD</th>';
						tabla_datos = tabla_datos+'<th align="center">P/U</th>';
						tabla_datos = tabla_datos+'<th align="center">UNIDAD</th>';
						tabla_datos = tabla_datos+'<th align="center">MONEDA</th>';
						tabla_datos = tabla_datos+'<th align="center">ACCIONES</th></tr>';

					$.each(resultado, function(index, value){
						nro++;
						tabla_datos = tabla_datos+'<tr><td align="center">'+nro+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_nro_orden_compra+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_descripcion+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_cantidad_ord+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.alm_precio_unitario+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.unidad+'</td>';
						tabla_datos = tabla_datos+'<td align="center">'+value.moneda+'</td>';
						//if (value.doc==0) {
						tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().formularioItemsAlmacen('+value.alm_id_ord_compra_det+',\''+value.codigo_proyecto+'\',\''+value.codigo_proveedor+'\');"><img src="../img/add_32x32.png"><br>Agregar Datos</a></div></td></tr>';
							//}else{
						//tabla_datos = tabla_datos+'<td><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificadoProv('+value.id_certificado+',\''+value.alm_proy_cod+'\',\''+value.alm_prov_id+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
						   // }

						//tabla_datos = tabla_datos+'<td><div style="float:left;width:40px; margin-right:10px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().darBajaCertificadoLista('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/add_32x32.png"><br>Nuevo Cert.</a></div><div style="float:left;width:42px; text-align:center;margin-right:5px; margin-left:0px;"><a onclick="new GestionImportacion().formularioDetallarCertificado('+value.alm_form_id+',\''+value.alm_proy_cod+'\');"><img src="../img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div></td></tr>';
					});
					tabla_datos = tabla_datos+'</table>';
					tabla_datos = tabla_datos+'<tr><td> <br><input type="button" value="Procesar" class="btn_form" onClick="new GestionImportacion().procesarCertificadoProv();"></td></tr>';
					$('#tabla_datos_items').append(tabla_datos);
					$("#formulario_lista_items_hoja").dialog({
							height: 405, 
							width: 880,
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
	this.formularioItemsAlmacen = function(id_item,codigo_proyecto,cod_prov){
		//alert(codigo_proyecto);
		//var nro=0;
		var codigo_proyecto=codigo_proyecto;
			$.ajax({
				url:'router/HojaCostoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'detalleItems',
					codigo_proyecto :codigo_proyecto,
					cod_prov:cod_prov,
					id_item:id_item
						
				},
				beforeSend : function(){
					
				},
				success: function(resultado){	

				
				var id_item=resultado[0].alm_id_ord_compra_det;
				var codigo_proyecto=resultado[0].codigo_proyecto;
				var codigo_proveedor=resultado[0].codigo_proveedor;
				var alm_descripcion=resultado[0].alm_descripcion;
				var alm_nro_orden_compra=resultado[0].alm_nro_orden_compra;
				var alm_cantidad_ord=resultado[0].alm_cantidad_ord;
				var alm_precio_unitario=resultado[0].alm_precio_unitario;
				var cod_unidad=resultado[0].alm_unidad_um;
				var cod_moneda=resultado[0].alm_precio_moneda;
				var unidad=resultado[0].unidad;
				var moneda=resultado[0].moneda;
				
					$('#tabla_datos_detalle_item').empty();
					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
						tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
						tabla_datos = tabla_datos+'<br><table align="center"><tr><td align="right"><strong>Codigo Proveedor :</strong></td>';
						tabla_datos = tabla_datos+'<td><input  class="txt_campo" name="cod_prov_it" id="cod_prov_it" cols="50" rows="2" value="'+codigo_proveedor+'" readonly><div id="error_cod_prov_it"></div></td></tr>';
						tabla_datos = tabla_datos+'<br><tr><td align="right"><strong>Nombre Item :</strong></td>';			
						tabla_datos = tabla_datos+'<td><input  class="txt_campo" name="nom_it" id="nom_it" cols="50" rows="2" value="'+alm_descripcion+'" readonly><div id="error_nom_it"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td align="right"><strong>Referencia :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="ref_it" maxlength="60"id="ref_it" value="'+alm_nro_orden_compra+'" readonly><div id="error_ref_it"></div></td></tr>';
					    tabla_datos = tabla_datos+'<tr><td align="right"><strong>Cantidad :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="cant_it" maxlength="60"id="cant_it" value="'+alm_cantidad_ord+'" readonly><div id="error_cant_it"></div></td></tr>';		    
					    tabla_datos = tabla_datos+'<tr><td align="right"><strong>Precio Unitario :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="pu_it" maxlength="60"id="pu_it" value="'+alm_precio_unitario+'" readonly><div id="error_pu_it"></div></td></tr>';    
					    tabla_datos = tabla_datos+'<tr><td align="right"><strong>Unidad :</strong></td>';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="uni_it" maxlength="60"id="uni_it" value="'+unidad+'" readonly><div id="error_uni_it"></div></td><input type="hidden" value="'+cod_unidad+'" id="cod_uni" /></tr>'; 	    
					    tabla_datos = tabla_datos+'<tr><td align="right"><strong>Moneda :</strong></td> ';
					    tabla_datos = tabla_datos+'<td><input class="txt_campo" type="text" name="mon_it" maxlength="60"id="mon_it" value="'+moneda+'" readonly><div id="error_mon_it"></div></td><input type="hidden" value="'+cod_moneda+'" id="cod_mon" /></tr>';
					    tabla_datos = tabla_datos+'<tr><td align="right"><strong>Tipo Producto :</strong></td> ';			
					    tabla_datos = tabla_datos+'<td><select name="cod_tipo_prod" size="1" size="10" id="cod_tipo_prod" ><option value="" selected="selected">-Seleccione Valor-</option></select></td></tr>';   			
					    tabla_datos = tabla_datos+'<form id="ck_item"><tr><th align="right">Con Serie :</th>';
					    tabla_datos = tabla_datos+'<td><input type="checkbox" name="conse"  value="1"></td> </tr></form>';
					    //tabla_datos = tabla_datos+'<td><input type="checkbox" name="conse"  value="1" onClick="new GestionImportacion().serieDialog('+id_item+',\''+alm_descripcion+'\','+alm_cantidad_ord+',\''+codigo_proyecto+'\');"></td> </tr></form>';
					    tabla_datos = tabla_datos+'</table>';
					    tabla_datos = tabla_datos+'<div align="center"> <tr><br><input type="button" value="Grabar Producto" class="btn_form" onClick="new GestionImportacion().grabarCabecera('+id_item+',\''+codigo_proyecto+'\',\''+codigo_proveedor+'\');"></td></tr></div>';

					$('#tabla_datos_detalle_item').append(tabla_datos);
					//util.validarCampo('nro_doc_certs_det', 'error_nro_doc_certs_det', 'El campo Nro. Certificado no puede estar vacio');
					
								$.ajax({
									url:'router/HojaCostoRouter.php',
									dataType: 'json',
									type: 'POST',
									data : { 									
										accion : 'listaProd'			
									},
									beforeSend : function(){
										
									},
									success: function(tipo){
								var tabla_tipo =0; 

								$.each(tipo, function(index, value2){
									//console.log(value2);	
					  	tabla_tipo  = tabla_tipo+' <option value="'+value2.cod+'" >'+value2.tipo+'</option>';
					    		}); 
					    			$('#cod_tipo_prod').append(tabla_tipo);
			    			},
							error: function(resultado){
								//alert("NO GRABO BIEN...");
								//console.log(resultado);
							}
							});	
					$("#formulario_nuevo_item").dialog({
							height: 500, 
							width: 550,
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

	this.grabarCabecera=function(id_item,codigo_proyecto,cod_prov){
	//alert(id_item+codigo_proyecto+cod_prov);
	//alert($('input[name=conse]:checked').val());
	var util= new Utilitarios(); 
	var nom_prod=$('#nom_it').val();
	var ref_prod=$('#ref_it').val();
	var cant_prod=$('#cant_it').val();
	var pu_prod=$('#pu_it').val();
	var uni_prod=$('#cod_uni').val();
	var mon_prod=$('#cod_mon').val();
	var tipo_prod=$('#cod_tipo_prod').val();
	var cant_serie=1;

	if ($('input[name=conse]:checked').val()==1) {
		//alert("Con serie");
		//var cant=cant_item;
		$.ajax({
				url:'router/HojaCostoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'grabarCabeceraProducto',
					codigo_proyecto :codigo_proyecto,
					cod_prov:cod_prov,
					id_item:id_item,
					nom_prod:$('#nom_it').val(),
					ref_prod:$('#ref_it').val(),
					cant_prod:$('#cant_it').val(),
					pu_prod:$('#pu_it').val(),
					uni_prod:$('#cod_uni').val(),
					mon_prod:$('#cod_mon').val(),
					tipo_prod:$('#cod_tipo_prod').val()	
				},
				beforeSend : function(){
					
				},
				success: function(resultado){
				alert("grabo bien");
				if(resultado.completo == true){
						var nro=0;
						var codigo_proy=resultado.codigo_proy;
						var codigo_unico=resultado.codigo_unico;
						var codigo_prod=resultado.codigo_prod;
						var codigo_prov=resultado.codigo_prov;
						var cantidad=resultado.cant_prod;

					$('#tabla_serie').empty();
					var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
					    tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
					    tabla_datos = tabla_datos+'<br><label><strong>NOMBRE PRODUCTO:</strong> </label>';
					    tabla_datos = tabla_datos+'<label>'+nom_prod+'</label><br><br>';
					    tabla_datos = tabla_datos+'<input type="hidden" value="'+nom_prod+'" id="nom_prod_oculto"/>';
					    tabla_datos = tabla_datos+'<input type="hidden" value="'+ref_prod+'" id="ref_prod_oculto"/>'; 
					    tabla_datos = tabla_datos+'<input type="hidden" value="'+cant_serie+'" id="cant_serie_oculto"/>'; 
					    tabla_datos = tabla_datos+'<input type="hidden" value="'+pu_prod+'" id="pu_prod_oculto"/>';      
			    		while(cant_prod>0){
			    		//console.log(cant);
			    		nro++;
			    		tabla_datos = tabla_datos+'<tr><td align="right"><strong>Serie Nro '+nro+':</strong></td>';
					    tabla_datos = tabla_datos+'<td><input  class="txt_campo" name="nro_doc_ser" id="nro_doc_ser" cols="50" rows="2"><div id="error_nro_doc_ser"></div></td>';
			    		var serie=$('#nro_doc_ser').val();
			    		tabla_datos = tabla_datos+'<td align="left"><input type="hidden" name="nro_ser[]" value="'+serie+'"></td></tr><br>';
			    		cant_prod--; 
			    		//tabla_datos6 = tabla_datos6+'<td><input type="hidden" name="id_prod[]" value="'+value3.alm_prod_id+'"><input type="text" name="costo_prod[]" value="'+costo_venta_uni+'" readonly><input type="hidden" id="accion" name="accion" value="grabarAlmacen"></td></tr>';
			    		}
			    		tabla_datos = tabla_datos+'<div align="center"><tr><td></td>';
			    		tabla_datos = tabla_datos+'<td><br><input class="btn_form" type="submit" name="accion" value="Grabar" onclick="new GestionImportacion().grabarDetalleSerie('+cantidad+',\''+codigo_unico+'\',\''+codigo_proy+'\',\''+codigo_prod+'\',\''+codigo_prov+'\')"></td></tr></div>';
			    	$('#tabla_serie').append(tabla_datos);
			    		 
			        $("#formulario_serie_dialog").dialog({
										height: 460, 
										width: 550,
										modal: true,
										resizable: true,
										draggable: false,
										closeText: "hide"
									});	
							//$('#formulario_hoja_costo').dialog('close'); // hace que se cierre el dialog
							//util.mostrarMensajeAlerta(1, 'Los datos se han ingresado a Almacen Correctamente', 'Confirmacion Producto');
							//new AgenciaDespachante().actualizarListarAgenciaDespachante(estado_proyecto,codigo_proyecto);	
					
						}	
				    
				},
				error: function(resultado){
					alert("NO GRABO BIEN...");
					//console.log(resultado);
				}
			});	
	}else{
		alert("Sin serie");
	}

	
	}

	this.grabarDetalleSerie=function(cant,cod_unico,cod_proy,cod_prod,cod_prov){
		alert(cant+'-'+cod_unico+'-'+cod_proy+'-'+cod_prod+'-'+cod_prov);
	   	/*var util= new Utilitarios(); 
		var nom_prod=$('#nom_prod_oculto').val();
		var ref_prod=$('#ref_prod_oculto').val();
		var cant_serie=$('#cant_serie_oculto').val();
		var pu_prod=$('#pu_prod_oculto').val();

			$.ajax({
				url:'router/HojaCostoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'grabarDetalleProductoSerie',
					codigo_proyecto :cod_proy,
					cod_prov:cod_prov,
					cod_unico:cod_unico,
					cod_prod:cod_prod,
				},
				beforeSend : function(){
					
				},
				success: function(resultado){
		
*/
	}

	this.serieDialog=function(id_item,nom_item,cant_item,codigo_proyecto){
	var cant=cant_item;
	var nro=0;
		$('#tabla_serie').empty();
		var tabla_datos = '<label><strong>C&Oacute;DIGO PROYECTO:</strong> </label>';
		    tabla_datos = tabla_datos+'<label>'+codigo_proyecto+'</label>';
		    tabla_datos = tabla_datos+'<br><label><strong>NOMBRE PRODUCTO:</strong> </label>';
		    tabla_datos = tabla_datos+'<label>'+nom_item+'</label><br><br>';
		          
    		while(cant>0){
    		//console.log(cant);
    		nro++;
    		tabla_datos = tabla_datos+'<tr><td align="right"><strong>Serie Nro '+nro+':</strong></td>';
		    tabla_datos = tabla_datos+'<td><input  class="txt_campo" name="nro_doc_cont" id="nro_doc_cont" cols="50" rows="2"><div id="error_nro_doc_cont"></div></td></tr><br>';
    		cant--;
    		}
    		tabla_datos = tabla_datos+'<tr><td></td>';
    		tabla_datos = tabla_datos+'<td><br><input class="btn_form" type="submit" name="accion" value="Grabar" onclick="new GestionImportacion().grabarFormularioContrato()"></td></tr>';
    	$('#tabla_serie').append(tabla_datos);
    		 
        $("#formulario_serie_dialog").dialog({
							height: 460, 
							width: 550,
							modal: true,
							resizable: true,
							draggable: false,
							closeText: "hide"
						});	
	}


	this.procesarFormDet=function(){
		//alert("PROCESAR FORMULARIO");
       var util= new Utilitarios();
       $("#formDetHoja").submit(function() {
       	//alert("formDetHoja");
       		var valoresDetHoja = $(this).serializeArray();
       		console.log($(this).serializeArray());
			    $( "#dialog-confirm-hoja" ).dialog({
			      resizable: false,
			      height: 190,
				  width: 350,
			      modal: true,
			      buttons: {
			        "Si": function() {
			          $( this ).dialog( "close" );
			      	if ($('#costo_venta_prod').val() ==0){
						util.mostrarMensajeAlerta(0, 'El campo Precio Venta Unitario es obligatorio', 'Advertencia');
					}else if($('#num_serie').val() == ""){
						util.mostrarMensajeAlerta(0, 'El campo Serie es obligatorio', 'Advertencia');
			      	}else{ 
			      		$.ajax({
						url:'router/HojaCostoRouter.php',
						dataType: 'json',
						type: 'POST',
					
						data : valoresDetHoja,
						//accion : 'grabarNuevoAgeDespach',// esto se pone en un div dentro del formulario para llamar a la aacion y ya no desde aqui
				
						success: function(data){
						},
						beforeSend : function(){
						},
						success: function(resultado){
						if(resultado.completo == true){
							var codigo_proyecto=resultado.codigo_proy;
							//alert("grabo bien"+codigo_proyecto);
								$('#formulario_hoja_costo').dialog('close'); // hace que se cierre el dialog
								util.mostrarMensajeAlerta(1, 'Los datos se han ingresado a Alamacen Correctamente', 'Confirmacion Ingreso Almacen');
								new HojaCosto().actualizarListaHojaCosto(codigo_proyecto);	
					
						}
						},//success
						error: function(resultado){
						util.mostrarMensajeAlerta(0, 'El Precio Unitario de Venta no puede ser cero', 'Alerta Ingreso Almacen');
						//alert("no grabo bien");
						}	
						});
					}    
			        },
			        Cancel: function() {
			          $( this ).dialog( "close" );
			        }
			      }
			    });
       		return false;
     });
	}

	/*Cabecera de la hoja de costo*/
 	this.generarCabeceraHoja = function(codigo_proyecto,nro_orden,cod_prov,cod_ref){
 		//alert(codigo_proyecto+nro_orden+cod_prov+cod_ref);
 		var util= new Utilitarios();
 		$("#por_apoyo").val(0);
 		$("#por_util").val(0);
 		$("#por_imp").val(0);
		$("#codigo_proyecto_hoja").empty();
		$("#codigo_proyecto_hoja").append(codigo_proyecto);
		$("#codigo_proyecto_hidden_hj").val(codigo_proyecto);
		$("#nro_orden_hidden_hj").val(nro_orden);
	    $("#cod_prov_hidden_hj").val(cod_prov);
	    $("#cod_ref_hidden_hj").val(cod_ref);

	    console.log()
	    
		$.ajax({
				url:'router/HojaCostoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'ListarCabecera',
					codigo_proyecto :codigo_proyecto,
					nro_orden:nro_orden,
					cod_prov:cod_prov,
					cod_ref:cod_ref 
						
				},
				beforeSend : function(){
					//$('#tabla_datos_certificado').empty();
	  		       // $('#tabla_datos_certificado').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
				},
				success: function(resultado){	
					 //alert("GRABO BIEN...");
				     //console.log(resultado);
					//var cod_proyecto=resultado.alm_proy_cod;

				var totales_bs=parseFloat(resultado[0].total_costo_trans_bs)+parseFloat(resultado[0].costo_bs_trans)+parseFloat(resultado[0].totalneto_pol)+parseFloat(resultado[0].suma_cert);
				var totales_sus=parseFloat(resultado[0].total_costo_trans_sus)+parseFloat(resultado[0].costo_sus_trans)+parseFloat(resultado[0].totalneto_pol_sus)+parseFloat(resultado[0].suma_cert_sus);
				totales_bs=util.redondeo2decimales(totales_bs);
				totales_sus=util.redondeo2decimales(totales_sus);
				$.ajax({
						url:'router/HojaCostoRouter.php',
						dataType: 'json',
						type: 'POST',
						data : { 
							
							accion : 'ListarCertificado',
							codigo_proyecto :codigo_proyecto,
							nro_orden:nro_orden,
							cod_prov:cod_prov 
								
	
						},
						beforeSend : function(){
							//$('#tabla_datos_certificado').empty();
			  		       // $('#tabla_datos_certificado').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
						},
						success: function(resultado2){
				    $.each(resultado, function(index, value){
					$('#encabezado').empty();

					var	tabla_datos1 = '<input type="hidden" value="'+totales_bs+'" name="totales_bs" id="totales_bs"/><br><table id="encabezado" align="left" border="1">';
						tabla_datos1 = tabla_datos1+'<tr><td rowspan="3"><img src="../img/logo.png" width="300" height="45"></td>';
						tabla_datos1 = tabla_datos1+'<td align="right"><strong>IMPORTACION No:</strong></td>';
						tabla_datos1 = tabla_datos1+'<td align="right"> '+value.alm_nro_referencia_orden+'</td></tr>';
						tabla_datos1 = tabla_datos1+'<tr><td align="right"><strong>PROVEEDOR:</strong></td>';
						tabla_datos1 = tabla_datos1+'<td align="right">'+value.alm_prov_nombre+'</td></tr>';
						tabla_datos1 = tabla_datos1+'<tr><td align="right"><strong>TIPO DE CAMBIO:</strong></td> ';
						tabla_datos1 = tabla_datos1+'<td align="right">'+value.tc+'</td></tr></table><br><br><br><br><br>';
					$('#encabezado').append(tabla_datos1);
					
					 $('#cabecera').empty();

					var	tabla_datos2 = '<table id="cabecera" border="1"  width="800" height="45">';
						tabla_datos2 = tabla_datos2+'<tr><td align="center" colspan="2"> <b>DESCRIPCION</b></td>';
						tabla_datos2 = tabla_datos2+'<td align="center"><b>BOLIVIANOS</b></td>';
						tabla_datos2 = tabla_datos2+'<td align="center"><b>RESPALDO DOCUMENTARIO</b></td> </tr>';
						tabla_datos2 = tabla_datos2+'<tr> <td align="left" colspan="2"> <b>A COSTO VALOR FOB (IMPORTE DE TRANFERENCIA)</b></td>';
						tabla_datos2 = tabla_datos2+'<td>'+value.total_costo_trans_bs+'</td></tr>'; //TOTAL
						tabla_datos2 = tabla_datos2+'<tr><td colspan="2">Tranferencia</td>';
						tabla_datos2 = tabla_datos2+'<td>'+value.costo_bs_fob+'</td>';
						tabla_datos2 = tabla_datos2+'<td>Nro. Orden Compra: '+value.alm_nro_referencia_orden+'</td></tr> ';
						tabla_datos2 = tabla_datos2+'<tr><td colspan="2">Comision Tranferencia</td>';
						tabla_datos2 = tabla_datos2+'<td>'+value.comision_trans_bs+'</td>';
						tabla_datos2 = tabla_datos2+'<td>Nro. Transferencia: '+value.nro_trans+'</td></tr> ';
						tabla_datos2 = tabla_datos2+'<tr><td colspan="2">Certificado Bancario</td>';
						tabla_datos2 = tabla_datos2+'<td>'+value.monto_cert_trans_bs+'</td>';
						if (value.monto_cert_trans_bs==0) {
						tabla_datos2 = tabla_datos2+'<td></td></tr> ';
						}else{
							tabla_datos2 = tabla_datos2+'<td>Nro. Certificado: '+value.nro_cert+'</td></tr> ';
							  }
						tabla_datos2 = tabla_datos2+'<tr> <td align="left" colspan="2"><b>B COSTO TRANSITO INTERNACIONAL</b></td>';
						tabla_datos2 = tabla_datos2+'<td>'+value.costo_bs_trans+'</td> </tr>'; //TOTAL
						tabla_datos2 = tabla_datos2+'<tr><td colspan="2">Transporte</td>';
						tabla_datos2 = tabla_datos2+' <td>'+value.costo_bs_trans+'</td>';
						tabla_datos2 = tabla_datos2+'<td>Nro. Orden Compra: '+value.alm_nro_referencia_orden+'</td></tr> ';
						tabla_datos2 = tabla_datos2+'<tr> <td align="left"  colspan="2"><b>C COSTO DESADUANIZACION</b></td>';
						tabla_datos2 = tabla_datos2+'<td>'+value.totalneto_pol+'</td></tr>';
						tabla_datos2 = tabla_datos2+'<tr><td colspan="2">Desaduanizaci&oacute;n</td>';
						tabla_datos2 = tabla_datos2+'<td>'+value.totalneto_pol+'</td>';
						tabla_datos2 = tabla_datos2+'<td>Anexo Planilla Nro.: '+value.nro_plan+'</td></tr>';
						tabla_datos2 = tabla_datos2+'<tr> <td align="left"  colspan="2"><b>D OTROS CERTIFICADOS</b></td>';
						tabla_datos2 = tabla_datos2+'<td>'+value.suma_cert+'</td></tr>';
					$.each(resultado2, function(index, cert){	
						
						tabla_datos2 = tabla_datos2+'<tr><td colspan="2">Certificado</td>';
						tabla_datos2 = tabla_datos2+'<td>'+cert.alm_form_comision_cert+'</td>';
							if (cert.alm_form_comision_cert==0) {
						tabla_datos2 = tabla_datos2+'<td></td></tr>'; 
						  	}else{
						tabla_datos2 = tabla_datos2+'<td>'+cert.alm_form_nro_doc_cert+'</td></tr>'; 
							}
						
					});	
						
						tabla_datos2 = tabla_datos2+'</table><br>';
						$('#cabecera').append(tabla_datos2); 

					
					$('#resumen_cabecera').empty();
					    
					var	tabla_datos3 = '<table id="resumen_cabecera"  border="1"  width="800" height="45"> ';
						tabla_datos3 = tabla_datos3+'<tr><td align="center" colspan="2"> <b>RESUMEN</b></td>';
						tabla_datos3 = tabla_datos3+'<td align="center"><b>BS</b></td>';
						tabla_datos3 = tabla_datos3+'<td align="center"><b>U$D</b></td></tr> ';
						tabla_datos3 = tabla_datos3+'<tr> <td align="left" colspan="2"> <b>A COSTO VALOR FOB (IMPORTE DE TRANFERENCIA)</b></td>';
						tabla_datos3 = tabla_datos3+'<td>'+value.total_costo_trans_bs+'</td>';
						tabla_datos3 = tabla_datos3+'<td>'+value.total_costo_trans_sus+'</tr>';
						tabla_datos3 = tabla_datos3+'<tr><td align="left" colspan="2"><b>B COSTO TRANSITO INTERNACIONAL</b></td>';
						tabla_datos3 = tabla_datos3+'<td>'+value.costo_bs_trans+'</td>';
						tabla_datos3 = tabla_datos3+'<td>'+value.costo_sus_trans+'</td></tr>';
						tabla_datos3 = tabla_datos3+'<tr><td align="left"  colspan="2"><b>C COSTO DESADUANIZACION</b></td>';
						tabla_datos3 = tabla_datos3+'<td>'+value.totalneto_pol+'</td>';
						tabla_datos3 = tabla_datos3+'<td>'+value.totalneto_pol_sus+'</td></tr>';
						tabla_datos3 = tabla_datos3+'<tr><td align="left"  colspan="2"><b>D OTROS CERTIFICADOS</b></td>';
						tabla_datos3 = tabla_datos3+'<td>'+value.suma_cert+'</td>';
						tabla_datos3 = tabla_datos3+'<td>'+value.suma_cert_sus+'</td></tr><br>'
						var total_bs=parseFloat(value.total_costo_trans_bs)+parseFloat(value.costo_bs_trans)+parseFloat(value.totalneto_pol)+parseFloat(value.suma_cert);
						var total_sus=parseFloat(value.total_costo_trans_sus)+parseFloat(value.costo_sus_trans)+parseFloat(value.totalneto_pol_sus)+parseFloat(value.suma_cert_sus);
						var total_bs=util.redondeo2decimales(total_bs);
						var total_sus=util.redondeo2decimales(total_sus);
						tabla_datos3 = tabla_datos3+'<tr><td align="center" colspan="2"><b>COSTO TOTAL DE LA IMPORTACION</b></td><td>'+total_bs+'</td><td>'+total_sus+'</td></tr></table><br></td>';;
						
						$('#resumen_cabecera').append(tabla_datos3); 
						 
					$('#titulo2').empty();
					var	tabla_datos4 = '<table  id="titulo2" align="center">';
						tabla_datos4 = tabla_datos4+'<th>DETERMINACI&Oacute;N DEL COSTO UNIT&Aacute;RIO</th></table> <br>';
						$('#titulo2').append(tabla_datos4);

					$('#encabezado2').empty();
					
                    var tabla_datos5 = '<br><table id="encabezado" align="left" border="1">';
						tabla_datos5 = tabla_datos5+'<tr><td rowspan="3"><img src="../img/logo.png" width="300" height="45"></td>';
						tabla_datos5 = tabla_datos5+'<td align="right"><strong>IMPORTACION No:</strong></td>';
						tabla_datos5 = tabla_datos5+'<td align="right"> '+value.alm_nro_referencia_orden+'</td></tr>';
						tabla_datos5 = tabla_datos5+'<tr><td align="right"><strong>PROVEEDOR:</strong></td>';
						tabla_datos5 = tabla_datos5+'<td align="right">'+value.alm_prov_nombre+'</td></tr>';
						tabla_datos5 = tabla_datos5+'<tr><td align="right"><strong>TIPO DE CAMBIO:</strong></td> ';
						tabla_datos5 = tabla_datos5+'<td align="right">'+value.tc+'</td></tr></table><br><br><br><br><br>';
					
					$('#encabezado2').append(tabla_datos5);

					$('#titulo2').empty();
					var	tabla_datos4 = '<table  id="titulo2" align="center">';
						tabla_datos4 = tabla_datos4+'<th>DETERMINACI&Oacute;N DEL COSTO UNIT&Aacute;RIO</th></table> <br>';
						$('#titulo2').append(tabla_datos4);

					$('#encabezado2').empty();
					
                    var tabla_datos5 = '<br><table id="encabezado" align="left" border="1">';
						tabla_datos5 = tabla_datos5+'<tr><td rowspan="3"><img src="../img/logo.png" width="300" height="45"></td>';
						tabla_datos5 = tabla_datos5+'<td align="right"><strong>IMPORTACION No:</strong></td>';
						tabla_datos5 = tabla_datos5+'<td align="right"> '+value.alm_nro_referencia_orden+'</td></tr>';
						tabla_datos5 = tabla_datos5+'<tr><td align="right"><strong>PROVEEDOR:</strong></td>';
						tabla_datos5 = tabla_datos5+'<td align="right">'+value.alm_prov_nombre+'</td></tr>';
						tabla_datos5 = tabla_datos5+'<tr><td align="right"><strong>TIPO DE CAMBIO:</strong></td> ';
						tabla_datos5 = tabla_datos5+'<td align="right">'+value.tc+'</td></tr></table><br><br><br><br><br>';
					
						$('#encabezado2').append(tabla_datos5);						
						});
					    new HojaCosto().generarDetalleHoja();  //generando el detalle de la hoja de costos
					},	
				        error: function(resultado){
								//alert("NO GRABO BIEN...");
								//console.log(resultado);
							}
						
						});	
							
							},	
				        error: function(resultado){
								//alert("NO GRABO BIEN...");
								//console.log(resultado);
							}
						});
			$('#por_apoyo').numeric('.');
			$('#por_util').numeric('.');
			$('#por_imp').numeric('.');

 	}
 	this.generarDetalleHoja = function(){
 			//alert($("#codigo_proyecto_hidden_hj").val()+$("#cod_prov_hidden_hj").val() );
		 	var cod_proy=$("#codigo_proyecto_hidden_hj").val();
		 	var cod_prov=$("#cod_prov_hidden_hj").val();
		 	var totales_bs= $("#totales_bs").val();
		 	var apoyo=$("#por_apoyo").val();
		 	var utilidad=$("#por_util").val();
		 	var impuestos=$("#por_imp").val();
		 	var util= new Utilitarios();
 	                    $.ajax({
						url:'router/HojaCostoRouter.php',
						dataType: 'json',
						type: 'POST',
						data : { 
							
							accion : 'ListarDetalleHoja2',
							codigo_proyecto :$("#codigo_proyecto_hidden_hj").val(),
							cod_prov:$("#cod_prov_hidden_hj").val() 
								
	
						},
						beforeSend : function(){
							//$('#tabla_datos_certificado').empty();
			  		       // $('#tabla_datos_certificado').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
						},
						success: function(resultado3){
						        // alert("DETALLE")
						        //console.log(resultado3)
						       /* $('#boton_item').empty();
						        var tabla_datos_items= '<br> <table id="boton_item"  border="1"  width="1150" height="45">';
						            tabla_datos_items= tabla_datos_items+'<input type="button" value="Nuevo Item" class="btn_form" onClick="new GestionImportacion().formularioListaItems(\''+cod_proy+'\', \''+cod_prov+'\');"> </table>';
						        $('#boton_item').append(tabla_datos_items);*/
						        var codigo_proveedor=resultado3[0].codigo_proveedor;
						        var codigo_proyecto=resultado3[0].codigo_proyecto;
         
      	
								$('#detalle_hoja').empty();
								var	tabla_datos6 = '<table id="detalle_costo"  border="1"  width="1150" height="45">';
									tabla_datos6 = tabla_datos6+'<tr><td align="center"><b>NRO</b></td> ';
									//tabla_datos6 = tabla_datos6+'<td align="center"><b>CODIGO INTERNO</b></td>  ';
									tabla_datos6 = tabla_datos6+'<td align="center" colspan="4"> <b>DETALLE DE ITEMS IMPORTADOS</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>REFERENCIA</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>SERIE</b></td>  ';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>CANT.</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>P/U FOB</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>TOT. FOB.</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>% Part</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>COSTO TOTAL</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>COSTO UNIT&Aacute;RIO</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>PRECIO DE VENTA UNIT&Aacute;RIO</b></td></tr>';
									$('#detalle_costo').append(tabla_datos6);
									//var gran_total_fob=0;
									var tot_part=0;	
									var tot_costo=0;
									var nro=0;

									$.each(resultado3, function(index, value3){
									//console.log(nro);
									
										/*tabla_datos6 = tabla_datos6+'<tr><td>'+nro+'</td>';
										tabla_datos6 = tabla_datos6+'<td colspan="4">'+value3.alm_descripcion+'</td>';
										tabla_datos6 = tabla_datos6+'<td>'+value3.alm_nro_orden_compra+'</td>';*/
										tabla_datos6 = tabla_datos6+'<tr><input type="hidden" name="cod_proy_cab[]" value="'+codigo_proyecto+'"><input type="hidden" name="cod_prov_cab[]" value="'+codigo_proveedor+'"><input type="hidden" name="uni_prod_cab[]" value="'+value3.alm_unidad_um+'"><input type="hidden" name="mon_prod_cab[]" value="'+value3.alm_precio_moneda+'"><input type="hidden" name="tipo_prod_cab[]" value="'+value3.alm_item_ord_tipo+'"><input type="hidden" name="nom_prod_cab[]" value="'+value3.alm_descripcion+'"><input type="hidden" name="ref_prod_cab[]" value="'+value3.alm_nro_parte_ord_compra+'"><input type="hidden" name="cant_prod_cab[]" value="'+value3.alm_cantidad_ord+'">';				    	
										//tabla_datos6 = tabla_datos6+'<td>'+nro+'</td>';
									if (value3.alm_item_ord_serial==0) {
										nro=nro+1;
										tabla_datos6 = tabla_datos6+'<td>'+nro+'</td>';
										tabla_datos6 = tabla_datos6+'<td colspan="4">'+value3.alm_descripcion+'</td>';
										tabla_datos6 = tabla_datos6+'<td>'+value3.alm_nro_parte_ord_compra+'</td>';
										tabla_datos6 = tabla_datos6+'<td><input  class="txt_campo1" name="num_serie[]" id="num_serie" cols="5" rows="1" value="0" readonly></td>'; 
											 //MODIFICAR DE ACUERDO A LA SERIE!!!
										    var total_fob=util.redondeo2decimales(value3.total_fob);
										tabla_datos6 = tabla_datos6+'<td>'+value3.alm_cantidad_ord+'</td>';	
										tabla_datos6 = tabla_datos6+'<td>'+value3.alm_precio_unitario+'</td>';		
										tabla_datos6 = tabla_datos6+'<td>'+total_fob+'</td>';
											var gran_total_fob=value3.gran_total_fob;
											var total_fob1=value3.total_fob;

											var part=util.redondeo2decimales(total_fob1/gran_total_fob);
											var part_sinred=(total_fob1/gran_total_fob);
											var part_porc=util.redondeo2decimales(part_sinred*100);
											var part_porc1=part_sinred*100;					
										tabla_datos6 = tabla_datos6+'<td>'+part_porc+'%'+'</td>';
										var part_sinred=parseFloat(part_sinred);
											var costo_tot=(part_sinred*totales_bs);
											var costo_tot2=util.redondeo2decimales(costo_tot);
											var cantidad=parseFloat(value3.alm_cantidad_ord);
											var costo_uni=costo_tot2/cantidad;
											var costo_uni=util.redondeo2decimales(costo_uni);	
											tot_part=tot_part+part_porc1;
											tot_costo=tot_costo+costo_tot;
										tabla_datos6 = tabla_datos6+'<td>'+costo_tot2+'</td>';
										tabla_datos6 = tabla_datos6+'<td>'+costo_uni+'</td>';
											if (apoyo==0 && utilidad==0 && impuestos==0) {
										tabla_datos6 = tabla_datos6+'<td><input type="text" name="costo_venta_prod[]" id="costo_venta_prod" value="0" readonly></td></tr>';		
											}else{
											var costo_venta_uni=costo_uni/(1-((apoyo/100)+(utilidad/100)+(impuestos/100)))
											costo_venta_uni=util.redondeo2decimales(costo_venta_uni);	
										tabla_datos6 = tabla_datos6+'<td><input type="hidden" name="uni_prod[]" value="'+value3.alm_unidad_um+'"><input type="hidden" name="mon_prod[]" value="'+value3.alm_precio_moneda+'"><input type="hidden" name="tipo_prod[]" value="'+value3.alm_item_ord_tipo+'"><input type="hidden" name="nom_prod[]" value="'+value3.alm_descripcion+'"><input type="hidden" name="ref_prod[]" value="'+value3.alm_nro_parte_ord_compra+'"><input type="hidden" name="cant_prod[]" value="'+value3.alm_cantidad_ord+'"><input type="hidden" name="pu_prod[]" value="'+value3.alm_precio_unitario+'"><input type="hidden" name="costo_compra_prod[]" value="'+value3.total_fob+'"><input type="text" name="costo_venta_prod[]" value="'+costo_venta_uni+'" readonly><input type="hidden" name="cod_prov" value="'+codigo_proveedor+'"><input type="hidden" id="accion" name="accion" value="grabarAlmacen"></td></tr>';						 		
											}
									}else{
										var cant=value3.alm_cantidad_ord;
										var cant_serie=1;
										while(cant>0){
											nro=nro+1;
											tabla_datos6 = tabla_datos6+'<tr><td>'+nro+'</td>';
											tabla_datos6 = tabla_datos6+'<td colspan="4">'+value3.alm_descripcion+'</td>';
											tabla_datos6 = tabla_datos6+'<td>'+value3.alm_nro_parte_ord_compra+'</td>';
											tabla_datos6 = tabla_datos6+'<td><input  class="txt_campo1" name="num_serie[]" id="num_serie" cols="5" rows="1" value=""></td>'; 	
											 //MODIFICAR DE ACUERDO A LA SERIE!!!
											    var total_fob=util.redondeo2decimales(value3.total_fob);
											tabla_datos6 = tabla_datos6+'<td>'+cant_serie+'</td>';	
											tabla_datos6 = tabla_datos6+'<td>'+value3.alm_precio_unitario+'</td>';		
											tabla_datos6 = tabla_datos6+'<td>'+total_fob+'</td>';
												var gran_total_fob=value3.gran_total_fob;
												var total_fob1=value3.total_fob;

												var part=util.redondeo2decimales(total_fob1/gran_total_fob);
												var part_sinred=(total_fob1/gran_total_fob);
												var part_porc=util.redondeo2decimales(part_sinred*100);
												var part_porc1=part_sinred*100;						
											tabla_datos6 = tabla_datos6+'<td>'+part_porc+'%'+'</td>';
											var part_sinred=parseFloat(part_sinred);
												var costo_tot=(part_sinred*totales_bs);
												var costo_tot2=util.redondeo2decimales(costo_tot);
												var cantidad=parseFloat(cant_serie);
												var costo_uni=costo_tot2/cantidad;
												var costo_uni=util.redondeo2decimales(costo_uni);	
												tot_part=tot_part+part_porc1;
												tot_costo=tot_costo+costo_tot;
											tabla_datos6 = tabla_datos6+'<td>'+costo_tot2+'</td>';
											tabla_datos6 = tabla_datos6+'<td>'+costo_uni+'</td>';
												if (apoyo==0 && utilidad==0 && impuestos==0) {
											tabla_datos6 = tabla_datos6+'<td><input type="text" name="costo_venta_prod[]" id="costo_venta_prod" value="0" readonly></td></tr>';	
												}else{
												var costo_venta_uni=costo_uni/(1-((apoyo/100)+(utilidad/100)+(impuestos/100)))
												costo_venta_uni=util.redondeo2decimales(costo_venta_uni);	
											tabla_datos6 = tabla_datos6+'<td><input type="hidden" name="uni_prod[]" value="'+value3.alm_unidad_um+'"><input type="hidden" name="mon_prod[]" value="'+value3.alm_precio_moneda+'"><input type="hidden" name="tipo_prod[]" value="'+value3.alm_item_ord_tipo+'"><input type="hidden" name="nom_prod[]" value="'+value3.alm_descripcion+'"><input type="hidden" name="ref_prod[]" value="'+value3.alm_nro_parte_ord_compra+'"><input type="hidden" name="cant_prod[]" value="'+value3.alm_cantidad_ord+'"><input type="hidden" name="pu_prod[]" value="'+value3.alm_precio_unitario+'"><input type="hidden" name="costo_compra_prod[]" value="'+value3.total_fob+'"><input type="text" name="costo_venta_prod[]" id="costo_venta_prod" value="'+costo_venta_uni+'" readonly><input type="hidden" name="cod_prov" value="'+codigo_proveedor+'"><input type="hidden" id="accion" name="accion" value="grabarAlmacen"></td></tr>';						 		
												}
										cant--;
										}
										
										
									}

											//tabla_datos6 = tabla_datos6+'<td><input type="hidden" name="nom_prod[]" value="'+value3.alm_descripcion+'"><input type="hidden" name="costo_prod[]" value="'+costo_venta_uni+'" readonly><input type="hidden" id="accion" name="accion" value="grabarAlmacen"></td></tr>';	
										    				    	
												
									});

			                        var gran_tot_part=util.redondeo2decimales(tot_part);
			                        var gran_tot_costo=util.redondeo2decimales(tot_costo);
			                        var total_gran_fob=resultado3[0].gran_total_fob;
									tabla_datos6 = tabla_datos6+'<tr><td align="center" colspan="9"><b>TOTAL</b></td>';
									tabla_datos6 = tabla_datos6+'<td>'+total_gran_fob+'</td>';
									tabla_datos6 = tabla_datos6+'<td>'+gran_tot_part+'</td>';
									tabla_datos6 = tabla_datos6+' <td>'+gran_tot_costo+'</td></tr></table><br><br>';
									$('#detalle_hoja').append(tabla_datos6);
									   $("#formulario_hoja_costo").dialog({
										height: 700,
										width: 1200,
										modal: true,
										resizable: false,
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

 	this.actualizarDetalleHoja = function(){
  			//alert($("#codigo_proyecto_hidden_hj").val()+$("#cod_prov_hidden_hj").val() );
		 	var cod_proy=$("#codigo_proyecto_hidden_hj").val();
		 	var cod_prov=$("#cod_prov_hidden_hj").val();
		 	var totales_bs= $("#totales_bs").val();
		 	var apoyo=$("#por_apoyo").val();
		 	var utilidad=$("#por_util").val();
		 	var impuestos=$("#por_imp").val();
		 	var util= new Utilitarios();
 	                    $.ajax({
						url:'router/HojaCostoRouter.php',
						dataType: 'json',
						type: 'POST',
						data : { 
							
							accion : 'ListarDetalleHoja2',
							codigo_proyecto :$("#codigo_proyecto_hidden_hj").val(),
							cod_prov:$("#cod_prov_hidden_hj").val() 
								
	
						},
						beforeSend : function(){
							//$('#tabla_datos_certificado').empty();
			  		       // $('#tabla_datos_certificado').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);		
						},
						success: function(resultado3){
						        // alert("DETALLE")
						        //console.log(resultado3)
						       /* $('#boton_item').empty();
						        var tabla_datos_items= '<br> <table id="boton_item"  border="1"  width="1150" height="45">';
						            tabla_datos_items= tabla_datos_items+'<input type="button" value="Nuevo Item" class="btn_form" onClick="new GestionImportacion().formularioListaItems(\''+cod_proy+'\', \''+cod_prov+'\');"> </table>';
						        $('#boton_item').append(tabla_datos_items);*/
						        var codigo_proveedor=resultado3[0].codigo_proveedor;
						        var codigo_proyecto=resultado3[0].codigo_proyecto;
         
      	
								$('#detalle_hoja').empty();
								var	tabla_datos6 = '<table id="detalle_costo"  border="1"  width="1150" height="45">';
									tabla_datos6 = tabla_datos6+'<tr><td align="center"><b>NRO</b></td> ';
									//tabla_datos6 = tabla_datos6+'<td align="center"><b>CODIGO INTERNO</b></td>  ';
									tabla_datos6 = tabla_datos6+'<td align="center" colspan="4"> <b>DETALLE DE ITEMS IMPORTADOS</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>REFERENCIA</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>SERIE</b></td>  ';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>CANT.</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>P/U FOB</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>TOT. FOB.</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>% Part</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>COSTO TOTAL</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>COSTO UNIT&Aacute;RIO</b></td>';
									tabla_datos6 = tabla_datos6+'<td align="center"><b>PRECIO DE VENTA UNIT&Aacute;RIO</b></td></tr>';
									$('#detalle_costo').append(tabla_datos6);
									//var gran_total_fob=0;
									var tot_part=0;	
									var tot_costo=0;
									var nro=0;

									$.each(resultado3, function(index, value3){
									//console.log(nro);
									
										/*tabla_datos6 = tabla_datos6+'<tr><td>'+nro+'</td>';
										tabla_datos6 = tabla_datos6+'<td colspan="4">'+value3.alm_descripcion+'</td>';
										tabla_datos6 = tabla_datos6+'<td>'+value3.alm_nro_orden_compra+'</td>';*/
										tabla_datos6 = tabla_datos6+'<tr><input type="hidden" name="cod_proy_cab[]" value="'+codigo_proyecto+'"><input type="hidden" name="cod_prov_cab[]" value="'+codigo_proveedor+'"><input type="hidden" name="uni_prod_cab[]" value="'+value3.alm_unidad_um+'"><input type="hidden" name="mon_prod_cab[]" value="'+value3.alm_precio_moneda+'"><input type="hidden" name="tipo_prod_cab[]" value="'+value3.alm_item_ord_tipo+'"><input type="hidden" name="nom_prod_cab[]" value="'+value3.alm_descripcion+'"><input type="hidden" name="ref_prod_cab[]" value="'+value3.alm_nro_parte_ord_compra+'"><input type="hidden" name="cant_prod_cab[]" value="'+value3.alm_cantidad_ord+'">';				    	
										//tabla_datos6 = tabla_datos6+'<td>'+nro+'</td>';
									if (value3.alm_item_ord_serial==0) {
										nro=nro+1;
										tabla_datos6 = tabla_datos6+'<td>'+nro+'</td>';
										tabla_datos6 = tabla_datos6+'<td colspan="4">'+value3.alm_descripcion+'</td>';
										tabla_datos6 = tabla_datos6+'<td>'+value3.alm_nro_parte_ord_compra+'</td>';
										tabla_datos6 = tabla_datos6+'<td><input  class="txt_campo1" name="num_serie[]" id="num_serie" cols="5" rows="1" value="0" readonly></td>'; 
											 //MODIFICAR DE ACUERDO A LA SERIE!!!
										    var total_fob=util.redondeo2decimales(value3.total_fob);
										tabla_datos6 = tabla_datos6+'<td>'+value3.alm_cantidad_ord+'</td>';	
										tabla_datos6 = tabla_datos6+'<td>'+value3.alm_precio_unitario+'</td>';		
										tabla_datos6 = tabla_datos6+'<td>'+total_fob+'</td>';
											var gran_total_fob=value3.gran_total_fob;
											var total_fob1=value3.total_fob;

											var part=util.redondeo2decimales(total_fob1/gran_total_fob);
											var part_sinred=(total_fob1/gran_total_fob);
											var part_porc=util.redondeo2decimales(part_sinred*100);
											var part_porc1=part_sinred*100;					
										tabla_datos6 = tabla_datos6+'<td>'+part_porc+'%'+'</td>';
										var part_sinred=parseFloat(part_sinred);
											var costo_tot=(part_sinred*totales_bs);
											var costo_tot2=util.redondeo2decimales(costo_tot);
											var cantidad=parseFloat(value3.alm_cantidad_ord);
											var costo_uni=costo_tot2/cantidad;
											var costo_uni=util.redondeo2decimales(costo_uni);	
											tot_part=tot_part+part_porc1;
											tot_costo=tot_costo+costo_tot;
										tabla_datos6 = tabla_datos6+'<td>'+costo_tot2+'</td>';
										tabla_datos6 = tabla_datos6+'<td>'+costo_uni+'</td>';
											if (apoyo==0 && utilidad==0 && impuestos==0) {
										tabla_datos6 = tabla_datos6+'<td><input type="text" name="costo_venta_prod[]" id="costo_venta_prod" value="0" readonly></td></tr>';		
											}else{
											var costo_venta_uni=costo_uni/(1-((apoyo/100)+(utilidad/100)+(impuestos/100)))
											costo_venta_uni=util.redondeo2decimales(costo_venta_uni);	
										tabla_datos6 = tabla_datos6+'<td><input type="hidden" name="uni_prod[]" value="'+value3.alm_unidad_um+'"><input type="hidden" name="mon_prod[]" value="'+value3.alm_precio_moneda+'"><input type="hidden" name="tipo_prod[]" value="'+value3.alm_item_ord_tipo+'"><input type="hidden" name="nom_prod[]" value="'+value3.alm_descripcion+'"><input type="hidden" name="ref_prod[]" value="'+value3.alm_nro_parte_ord_compra+'"><input type="hidden" name="cant_prod[]" value="'+value3.alm_cantidad_ord+'"><input type="hidden" name="pu_prod[]" value="'+value3.alm_precio_unitario+'"><input type="hidden" name="costo_compra_prod[]" value="'+value3.total_fob+'"><input type="text" name="costo_venta_prod[]" value="'+costo_venta_uni+'" readonly><input type="hidden" name="cod_prov" value="'+codigo_proveedor+'"><input type="hidden" id="accion" name="accion" value="grabarAlmacen"></td></tr>';						 		
											}
									}else{
										var cant=value3.alm_cantidad_ord;
										var cant_serie=1;
										while(cant>0){
											nro=nro+1;
											tabla_datos6 = tabla_datos6+'<tr><td>'+nro+'</td>';
											tabla_datos6 = tabla_datos6+'<td colspan="4">'+value3.alm_descripcion+'</td>';
											tabla_datos6 = tabla_datos6+'<td>'+value3.alm_nro_parte_ord_compra+'</td>';
											tabla_datos6 = tabla_datos6+'<td><input  class="txt_campo1" name="num_serie[]" id="num_serie" cols="5" rows="1" value=""></td>'; 	
											 //MODIFICAR DE ACUERDO A LA SERIE!!!
											    var total_fob=util.redondeo2decimales(value3.total_fob);
											tabla_datos6 = tabla_datos6+'<td>'+cant_serie+'</td>';	
											tabla_datos6 = tabla_datos6+'<td>'+value3.alm_precio_unitario+'</td>';		
											tabla_datos6 = tabla_datos6+'<td>'+total_fob+'</td>';
												var gran_total_fob=value3.gran_total_fob;
												var total_fob1=value3.total_fob;

												var part=util.redondeo2decimales(total_fob1/gran_total_fob);
												var part_sinred=(total_fob1/gran_total_fob);
												var part_porc=util.redondeo2decimales(part_sinred*100);
												var part_porc1=part_sinred*100;						
											tabla_datos6 = tabla_datos6+'<td>'+part_porc+'%'+'</td>';
											var part_sinred=parseFloat(part_sinred);
												var costo_tot=(part_sinred*totales_bs);
												var costo_tot2=util.redondeo2decimales(costo_tot);
												var cantidad=parseFloat(cant_serie);
												var costo_uni=costo_tot2/cantidad;
												var costo_uni=util.redondeo2decimales(costo_uni);	
												tot_part=tot_part+part_porc1;
												tot_costo=tot_costo+costo_tot;
											tabla_datos6 = tabla_datos6+'<td>'+costo_tot2+'</td>';
											tabla_datos6 = tabla_datos6+'<td>'+costo_uni+'</td>';
												if (apoyo==0 && utilidad==0 && impuestos==0) {
											tabla_datos6 = tabla_datos6+'<td><input type="text" name="costo_venta_prod[]" id="costo_venta_prod" value="0" readonly></td></tr>';	
												}else{
												var costo_venta_uni=costo_uni/(1-((apoyo/100)+(utilidad/100)+(impuestos/100)))
												costo_venta_uni=util.redondeo2decimales(costo_venta_uni);	
											tabla_datos6 = tabla_datos6+'<td><input type="hidden" name="uni_prod[]" value="'+value3.alm_unidad_um+'"><input type="hidden" name="mon_prod[]" value="'+value3.alm_precio_moneda+'"><input type="hidden" name="tipo_prod[]" value="'+value3.alm_item_ord_tipo+'"><input type="hidden" name="nom_prod[]" value="'+value3.alm_descripcion+'"><input type="hidden" name="ref_prod[]" value="'+value3.alm_nro_parte_ord_compra+'"><input type="hidden" name="cant_prod[]" value="'+value3.alm_cantidad_ord+'"><input type="hidden" name="pu_prod[]" value="'+value3.alm_precio_unitario+'"><input type="hidden" name="costo_compra_prod[]" value="'+value3.total_fob+'"><input type="text" name="costo_venta_prod[]" id="costo_venta_prod" value="'+costo_venta_uni+'" readonly><input type="hidden" name="cod_prov" value="'+codigo_proveedor+'"><input type="hidden" id="accion" name="accion" value="grabarAlmacen"></td></tr>';						 		
												}
										cant--;
										}
										
										
									}

											//tabla_datos6 = tabla_datos6+'<td><input type="hidden" name="nom_prod[]" value="'+value3.alm_descripcion+'"><input type="hidden" name="costo_prod[]" value="'+costo_venta_uni+'" readonly><input type="hidden" id="accion" name="accion" value="grabarAlmacen"></td></tr>';	
										    				    	
												
									});

			                        var gran_tot_part=util.redondeo2decimales(tot_part);
			                        var gran_tot_costo=util.redondeo2decimales(tot_costo);
			                        var total_gran_fob=resultado3[0].gran_total_fob;
									tabla_datos6 = tabla_datos6+'<tr><td align="center" colspan="9"><b>TOTAL</b></td>';
									tabla_datos6 = tabla_datos6+'<td>'+total_gran_fob+'</td>';
									tabla_datos6 = tabla_datos6+'<td>'+gran_tot_part+'</td>';
									tabla_datos6 = tabla_datos6+' <td>'+gran_tot_costo+'</td></tr></table><br><br>';
									$('#detalle_hoja').append(tabla_datos6);
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
	this.procesarHojaCosto=function(codigo_proyecto,estado_proyecto){
		//alert(codigo_proyecto+estado_proyecto);
		var util = new Utilitarios();
		$.ajax({
				url:'router/HojaCostoRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					
					accion : 'procesarHojaCosto',
					estado_proyecto :estado_proyecto,
					codigo_proyecto :codigo_proyecto
					
				},
				beforeSend : function(){
					//
				},
				success: function(resultado){					
					//alert("GRABO BIEN...");

				if(resultado.completo== true){
						//alert("GRABO BIEN...");
						//$('#formulario_lista_hoja').dialog('close'); // hace que se cierre el dialog
						util.mostrarMensajeAlerta(1, 'Se proceso correctamente el Proyecto', 'Confirmacion Hoja de Costo');
						$(location).attr('href', 'imp_gest_imp.php');
						/*$('#tabla_datos_proyectos').empty();
						$('#tabla_datos_proyectos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
						new Proyecto().listarProyectos();*/
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
	 * Metodo q cancela lo modificado  formulario de Certificados 
	 */
	this.cancelarHojaCosto=function(){
		//alert("CANCELAR...");
		$('#formulario_hoja_costo').dialog('close'); // hace que se cierre el dialog
	}
}
