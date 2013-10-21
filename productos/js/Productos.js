/**
 * @description Esta clase es la que gestiona los eventos y acciones de contrato
 * @author Dennys Ramiro
 * @date  05/07/2013
 */

function Productos(){

   /**
    * Metodo que permite gestionar el el form on su metodo submit
    */
   this.init = function (){
   		new Productos().formularioDetalleProductos_tpl();
   		new Productos().formularioDetalleModifProductos_tpl();
   		new Productos().formularioIngresoProductos_tpl();
		$('#producto_buscar').keyup(function(e) {
            new Productos().buscarProyecto($('#producto_buscar').val());
        });
        var util = new Utilitarios();
        util.iniPreloaderStart();
   }


 /**
 *  Este metodo lista todos los productos buscados
 */
 this.buscarProyecto = function(palabra_buscar){ 
	$.ajax({
		url:'router/ProductosRouter.php',
		dataType: 'json',
		type: 'GET',
		data : { 
			accion : 'buscarProductos',
			proyecto_buscar: palabra_buscar
		},
		beforeSend : function(){
		},
		success: function(resultado){
			$("#producto_buscar").autocomplete({
	        	source: resultado, 
	        	minLength: 1, 
	        	select: new Productos().productoSeleccionado, 
	        	focus: new Productos().productoEnfocado 
	    	});
		},
		error: function(resultado){
		}
	});		

 }
/**
 * Metodo que nos muestra el producto seleccionado
 */
this.productoSeleccionado = function(evt, ui){


 	var valor = ui.item.value;
 	var datos = valor.split(" ");
 	//alert(valor+"--"+datos);
 	$.ajax({
		url:'router/ProductosRouter.php',
		dataType: 'json',
		type: 'GET',
		data : { 
			accion : 'productoSeleccionados',
			id_pro: ui.item.id,
			cod_proy : datos[0]	
		},
		beforeSend : function(){
			$('#tabla_datos_produstos').empty();
			$('#tabla_datos_produstos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			//$('#tabla_cab_productos').empty();
		},
		success: function(resultado){
			 //console.log(resultado);
		    $('#tabla_datos_produstos').empty();
		    var tabla_principal = ' <table class="table_usuario" id="tb_produstos"> <tr>';
		    tabla_principal = tabla_principal + '<th align="center">CODIGO</th> <th align="center">NOMBRE</th><th align="center">TIPO</th>';
		    tabla_principal = tabla_principal + '<th align="center">CANTIDAD</th><th align="center">SUCURSAL ORIGEN</th><th align="center">ESTADO</th>';
		    tabla_principal = tabla_principal + '<th align="center">FECHA PROCESO</th><th align="center">EDITAR</th><th align="center">ELIMINAR</th>';             
		    tabla_principal = tabla_principal + '</tr></table>';
            $('#tabla_datos_produstos').append(tabla_principal);
			
            $.each(resultado, function(index, value){
            	//console.log(value);
				 tabla_principal = ' <tr> ';
				 tabla_principal = tabla_principal + ' <td align="center">'+value.alm_prod_cab_codigo+'</td>';
				 tabla_principal = tabla_principal + '<td align="left">'+value.alm_prod_cab_nombre+'</td>';
				 tabla_principal = tabla_principal + '<td align="center">'+value.tipo+'</td>';
				 tabla_principal = tabla_principal + '<td align="center">'+value.cantidad+'</td>';
				 tabla_principal = tabla_principal + '<td align="center">'+value.AGE_ORIG+'</td>';
				 tabla_principal = tabla_principal + '<td align="center">'+value.ESTADO+'</td>';
				 //tabla_principal = tabla_principal + '<td align="center">'+value.AGE_ORIG+'</td>';
				// tabla_principal = tabla_principal + '<td align="center">'+value.ESTADO+'</td>';
				 tabla_principal = tabla_principal +'<td align="center">'+value.alm_prod_cab_fecha_proceso+'</td>';
				 tabla_principal = tabla_principal + '<td align="center"> <div style="cursor:pointer"><a onClick="new Productos().modificarCabeceraProducto(\''+value.codigo_unico_producto+'\', \''+value.alm_prod_cab_nombre+'\')" > <img src="../img/notepad_32x32.png" align="absmiddle"><br>Modificar</a></div></td><td><div style="cursor:pointer"><a  onClick="new GestionProductos().EliminarProducto(\''+value.codigo_unico_producto+'\', \''+value.alm_prod_cab_nombre+'\');" > <img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></div></td></tr>';
			  
			 	$('#tb_produstos').append(tabla_principal);
					
			});
		}
	});
 }
/**
 * Metodo que nos permite efocar el proyecto
 */
 this.productoEnfocado = function(evt, ui){
 	var valor = ui.item.value;
 	var datos = valor.split(" ");
 	$.ajax({
		url:'router/ProductosRouter.php',
		dataType: 'json',
		type: 'GET',
		data : { 
			accion : 'productoEnfocadoListaAutocomplete',
			id_producto : ui.item.id,
			codigo_producto : datos[0]	
		},
		beforeSend : function(){
			$('#tabla_datos_produstos').empty();
			$('#tabla_datos_produstos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
		},
		success: function(resultado){
		   $('#tabla_datos_produstos').empty();
			var tabla_principal = ' <table   class="table_usuario"  id="tb_produstos"> <tr>';
			tabla_principal = tabla_principal + '<th align="center">CODIGO</th> <th align="center">NOMBRE</th><th align="center">TIPO</th>';
			tabla_principal = tabla_principal + '<th align="center">CANTIDAD</th> <th align="center">SUCURSAL ORIGEN</th><th align="center">ESTADO</th>';
			tabla_principal = tabla_principal + '<th align="center">FECHA PROCESO</th><th align="center">EDITAR</th><th align="center">ELIMINAR</th></tr>';
			tabla_principal = tabla_principal + '</table>';
			$('#tabla_datos_produstos').append(tabla_principal);
			$.each(resultado, function(index, value){
				//console.log(value);
				 tabla_principal = '<tr class="tr_usuario">';
				 tabla_principal = tabla_principal +'<td align="center">'+value.alm_prod_cab_codigo+'</td>';
				 tabla_principal = tabla_principal +'<td align="left">'+value.alm_prod_cab_nombre+'</td>';
				 tabla_principal = tabla_principal +'<td align="center">'+value.tipo+'</td>';
				 tabla_principal = tabla_principal +'<td align="center">'+value.cantidad+'</td>';
				 //tabla_principal = tabla_principal +'<td align="center">'+value.alm_prod_det_prec_compra+'</td>';
				 //tabla_principal = tabla_principal +'<td align="center">'+value.alm_prod_det_prec_venta+'</td>';
				 tabla_principal = tabla_principal +'<td align="center">'+value.AGE_ORIG+'</td>';
				 tabla_principal = tabla_principal +'<td align="center">'+value.ESTADO+'</td>';
				 tabla_principal = tabla_principal +'<td align="center">'+value.alm_prod_cab_fecha_proceso+'</td>';
				 tabla_principal = tabla_principal + '<td align="center"> <div style="cursor:pointer"><a onClick="new Productos().modificarCabeceraProducto(\''+value.codigo_unico_producto+'\', \''+value.alm_prod_cab_nombre+'\')" > <img src="../img/notepad_32x32.png" align="absmiddle"><br>Modificar</a></div></td><td><div style="cursor:pointer"><a  onClick="new GestionProductos().EliminarProducto(\''+value.codigo_unico_producto+'\', \''+value.alm_prod_cab_nombre+'\');" > <img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></div></td></tr>';
				$('#tb_produstos').append(tabla_principal);
			});
		},
		error: function(resultado){
		}
	});
 }


/**
	  * Metodo que permite buscar por la palabra ingresada en el campo  y presionado por el boton buscar
	  */
	this.buscarProductoBtn = function(palabra_buscar){

		//var valor = palabra_buscar.item.value;
		var datos = palabra_buscar.split(" ");
	 	//alert(datos);
	 	$.ajax({
			url:'router/ProductosRouter.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				accion : 'buscarXPalabraConBtn',
				palabra : datos[0]	
			},
			beforeSend : function(){
				$('#tabla_datos_produstos').empty();
				$('#tabla_datos_produstos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(resultado){
				$('#tabla_datos_produstos').empty();	
				var tabla_principal = ' <table   class="table_usuario" id="tb_produstos"> <tr>';
				tabla_principal = tabla_principal + '<th align="center">CODIGO</th> <th align="center">NOMBRE</th><th align="center">TIPO</th>';
				tabla_principal = tabla_principal + '<th align="center">CANTIDAD</th> <th align="center">SUCURSAL ORIGEN</th><th align="center">ESTADO</th>';
				tabla_principal = tabla_principal + '<th align="center">FECHA PROCESO</th><th align="center">EDITAR</th><th align="center">EDITAR</th></tr></table>';
				tabla_principal = tabla_principal + '</tr></table>';
				$('#tabla_datos_produstos').append(tabla_principal);
				$.each(resultado, function(index, value){
					//console.log(value);
					tabla_principal ='<tr>';
					tabla_principal = tabla_principal + ' <td align="center">'+value.alm_prod_cab_codigo+'</td>';
					tabla_principal = tabla_principal + '<td align="left">'+value.alm_prod_cab_nombre+'</td>';
					tabla_principal = tabla_principal + '<td align="center">'+value.tipo+'</td>';
					tabla_principal = tabla_principal + '<td align="center">'+value.cantidad+'</td>';
					//tabla_principal = tabla_principal + '<td align="center">'+value.alm_prod_det_prec_compra+'</td>';
					//tabla_principal = tabla_principal + '<td align="center">'+value.alm_prod_det_prec_venta+'</td>';
					tabla_principal = tabla_principal + '<td align="center">'+value.AGE_ORIG+'</td>';
					tabla_principal = tabla_principal + '<td align="center">'+value.ESTADO+'</td>';
					tabla_principal = tabla_principal + '<td align="center">'+value.alm_prod_cab_fecha_proceso+'</td>';
					tabla_principal = tabla_principal + '<td align="center"> <div style="cursor:pointer"><a onClick="new Productos().modificarCabeceraProducto(\''+value.codigo_unico_producto+'\', \''+value.alm_prod_cab_nombre+'\')" > <img src="../img/notepad_32x32.png" align="absmiddle"><br>Modificar</a></div></td><td><div style="cursor:pointer"><a  onClick="new GestionProductos().EliminarProducto(\''+value.codigo_unico_producto+'\', \''+value.alm_prod_cab_nombre+'\');" > <img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></div></td></tr>';
					$('#tb_produstos').append(tabla_principal);	
				});
    			
				
			},
			error: function(resultado){
			}
		});
	}



   /**
	*  Metodo el cual crea el formulario tpl para insertar los productos
	*/
	
	this.formularioIngresoProductos_tpl = function(){
		var formu = '<div id="formulario_insertar_productos" title="Alta Producto" style="display:none; width: 300px;" >';
			formu = formu + '<h3><img src="../img/stuff_48x48.png" align="absmiddle">Alta de Producto</h3>';
  			formu = formu + '<hr style="border:1px dashed;">';
			formu = formu + '<div id="tabla_cab_productos" >';  //div que recibe los datos del formulario de alta de producto cabecera
			formu = formu + '</div>';
			formu = formu + '<div id="tabla_det_productos" >';
			formu = formu + '</div>';
			formu = formu + '<div id="tabla_total_det_productos" >';
			formu = formu + '</div>';
			formu = formu + '<div id="btn_cancelar_cab_det_prod" >';
			formu = formu + '</div>';
			formu = formu + '</div>';
		$('body').append(formu);
		

		/******************************* */

		
			
	}
	/**
	*  Metodo el cual crea el formulario tpl para insertar el detalle de los productos
	*/
	
	this.formularioDetalleProductos_tpl = function(){
		var formu = '<div id="formulario_detalle_productos" title="Alta Detalle Productos" style="display:none; width: 300px;" >';
			formu = formu + '<div id="tabla_detalle_productos">';
			formu = formu + '</div>';
			formu = formu + '</div>';
		$('body').append(formu);
			
	}

		/**
	*  Metodo el cual crea el formulario tpl para insertar el detalle de los productos
	*/
	
	this.formularioDetalleModifProductos_tpl = function(){
		var formu = '<div id="formulario_nuevo_item_detalle" title="Alta Detalle Productos" style="display:none; width: 300px;" >';
			formu = formu + '<div id="tabla_detalle_modif_productos">';
			formu = formu + '</div>';
			formu = formu + '</div>';
		$('body').append(formu);
			
	}
	
	
	 /**
	 * Metodo q ejecuta el formulario de nuevo ingreso cabecera
	 */
	this.ingresoCabeceraProductos = function(){	
		var util = new Utilitarios();				
		$('#formulario_insertar_productos #tabla_cab_productos').empty();
		$('#formulario_insertar_productos #tabla_det_productos').empty();
		$('#formulario_insertar_productos #tabla_total_det_productos').empty();
		var cab = '<form id="cabecera_gest_prod"><table border="0" align="center">';
		cab = cab + '<tr><td><label for="textfield"><strong>Codigo Referencia:</strong></label></td><td><input type="text" class="txt_campo" name="cod_ref_cab" id="cod_ref_cab"></td><td>&nbsp;</td><td><strong>Fecha Proceso:</strong></td><td><input type="text" class="txt_campo" name="fec_proc_prod" id="fec_proc_prod"> <div id="error_fec_proce"></div></td></tr>';
		cab = cab + '<tr><td><label for="textfield"><strong>Tipo Producto:</strong></label></td><td><select name="tipo_producto" id="tipo_producto" size="1" size="10"></select></td>';
		cab = cab + '<td>&nbsp;</td>';
		cab = cab + '<td><label for="textfield"><strong>Unidad Medida:</strong></label></td><td><select name="unidad_producto" id="unidad_producto" size="1"  ></select></td></tr>';
		cab = cab + '';
		cab = cab + '<tr><td><label for="textfield"><strong>Proveedor:</strong></label></td><td><select name="provedor_producto" id="provedor_producto" size="1" size="10"></select ></td>';
		cab = cab + '<td>&nbsp;</td>';
		cab = cab + '<td><label for="textfield"><strong>Moneda:</strong></label></td><td><select name="moneda_producto" id="moneda_producto" size="1" ></select></td></tr>';
		cab = cab + '<tr><td><label for="textfield"><strong>Nombre:</strong></label></td><td><input type="text" class="txt_campo" name="nom_prod" id="nom_prod"> <div id="error_nombre"></div></td>';
		cab = cab + '<td>&nbsp;</td>';
		cab = cab + ' <td><label for="textfield"><strong>Presentaci&oacuten:</strong></label></td><td><input type="text" class="txt_campo" name="prest_prod" id="prest_prod"> <div id="error_prest"></div></td></tr>';
		cab = cab + '';
		cab = cab + '<tr><td><label for="textfield"><strong>Descripci&oacuten:</strong></label></td><td><textarea  class="txt_campo" name="desc_prod" id="desc_prod" cols="50" rows="2"></textarea> <div id="error_desc"></div></td>';
		cab = cab + '<td>&nbsp;</td>';
		cab = cab + '<td><label for="textfield"><strong>Sucursal Origen:</strong></label></td><td><select name="sucursal_origen" id="sucursal_origen" size="1"></select></td></tr>';
		cab = cab + '<tr><td><label for="textfield"><strong>Marca :</strong></label></td></td>';
        cab = cab + '<td><input type="text" class="txt_campo" name="marka" id="marka"></td>';	
		cab = cab + '<tr><td></td><td valign="left"></td><td>&nbsp;</td>';
		cab = cab + '<td><label for="textfield"><strong>Imagen:</strong></label></td><td><input type="file" class="txt_campo" name="img_produc" id="img_produc"></td></tr>';
		cab = cab + '<tr><td></td><td valign="left"></td><td>&nbsp;</td>';
		cab = cab + '<td><label for="textfield"><strong>Datos Tecnicos:</strong></label></td><td><input type="file" class="txt_campo" name="dat_tec" id="dat_tec"></td></tr>';
		cab = cab + '<td colspan="5">&nbsp;</td>';
		cab = cab + '<td colspan="5">&nbsp;</td>';
		cab = cab + '<td colspan="5">&nbsp;</td>';
		cab = cab + '<tr><td colspan="2" align="center"><input type="submit" name="save_cab" id="save_cab" class="btn_form" value="Grabar" ><input type="hidden" name="accion" id="accion" value="insertarCabecera"></td>';
		cab = cab + '<td>&nbsp;</td>';
		cab = cab + '<td colspan="2" align="center"><input type="button" name="del_cab" id="del_cab" class="btn_form" value="Cancelar" onclick="new Productos().TerminarDetProducto();"></td>';
		cab = cab + '</tr></table><br><br>';
		$('#tabla_cab_productos').append(cab);
		$("#fec_proc_prod").datepicker({
			dateFormat: "dd/mm/yy"
		});
		//uno
		$.ajax({
				url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {
					accion:'cargarTipo'
				},
				beforeSend : function(){
					
				},
				success: function(resu){
					//console.log(resu);
					var tipo;
					$.each(resu, function(index, value){
						tipo=tipo+'<option select value="'+value.codigo+'">'+value.nombre+'</option>';
					
					});
					$('#tipo_producto').append(tipo);
				}
		});	
		//dos
		$.ajax({
				url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {
					accion:'cargarProveedor'
				},
				beforeSend : function(){
					
				},
				success: function(resu){
					//console.log(resu);
					var prove;
					$.each(resu, function(index,values){
						prove = prove +'<option select value="'+values.cod_int+'">'+values.nom_prov+'</option>';
					});
					$('#provedor_producto').append(prove);
				}
		});
		//tres
		$.ajax({
				url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {
					accion:'cargarMedida'
				},
				beforeSend : function(){
				},
				success: function(resul){
					//console.log(resul);
					var med;
					$.each(resul, function(index,medida){
						med = med +'<option select value="'+medida.cod_medida+'">'+medida.nom_medida+'</option>';
					});
					$('#unidad_producto').append(med);
				}
		});
		//cuatro
		$.ajax({
				url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {
					accion:'cargarMoneda'
				},
				beforeSend : function(){
				},
				success: function(result){
					//console.log(result);
					var mon;
					$.each(result, function(index,moneda){
						mon = mon +'<option select value="'+moneda.cod_moneda+'">'+moneda.nom_moneda+'</option>';
					});
					$('#moneda_producto').append(mon);
					
				}
		});
		//cinco
		$.ajax({
				url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {
					accion:'cargarSucursalOrigen'
				},
				beforeSend : function(){
				},
				success: function(result){
					var age;
					$.each(result, function(index,agencia){
						age = age +'<option select value="'+agencia.cod_agencia+'">'+agencia.nom_agencia+'</option>';
					});
					$('#sucursal_origen').append(age);
				}
		});
		util.validarCampo('nom_prod', 'error_nombre', 'El campo Nombre no puede estar vacio');
        util.validarCampo('desc_prod', 'error_desc', 'El campo Descripci&oacute;n no puede estar vacio');
        util.validarCampo('prest_prod', 'error_prest', 'El campo Presentaci&oacute;n no puede estar vacio');	
		new Productos().enviarDatosNuevoProducto();
		$("#formulario_insertar_productos").dialog({  //dialogo el cual carga el ingreso de datos para la cabecera
						height: 650,
						width: 1050,
						modal: true,
						resizable: true,
						draggable: true,
						closeText: "hide"
		});
	}
	/** Este es el metodo que envia el formulario de nuevo producto **/
	this.enviarDatosNuevoProducto = function(){
		var util = new Utilitarios();
		$('#cabecera_gest_prod').submit(function(evt){
		    
			if($('#nom_prod').val() == ""){
				util.mostrarMensajeAlerta(0, 'El campo Nombre del producto es obligatorio', 'Mensaje Alta Productos');
			}else if ($('#desc_prod').val() == ""){
				util.mostrarMensajeAlerta(0, 'El campo Descripcion es obligatorio', 'Mensaje Alta Productos');
			}else if ($('#fec_proc_prod').val() == ""){
				util.mostrarMensajeAlerta(0, 'El campo Fecha de Proceso es obligatorio', 'Mensaje Alta Productos');
			}else if ($('#prest_prod').val() == ""){
				util.mostrarMensajeAlerta(0, 'El campo Presentacion es obligatorio', 'Mensaje Alta Productos');
			}else{
				util.startPreloader();
				var formData = new FormData();
				formData.append('img_produc', $('#img_produc')[0].files[0]);
				formData.append('dat_tec', $('#dat_tec')[0].files[0]);
				formData.append('accion', 'insertarCabecera');
				formData.append('cod_ref', $('#cod_ref_cab').val());
				formData.append('tipo', $('#tipo_producto').val());
				formData.append('prov',$('#provedor_producto').val());
				formData.append('nom',$('#nom_prod').val());
				formData.append('desc',$('#desc_prod').val());
				formData.append('cantidad',$('#cant_prod').val());
				formData.append('fech_proce',$('#fec_proc_prod').val());
				formData.append('unidad',$('#unidad_producto').val());
				formData.append('moneda',$('#moneda_producto').val());
				formData.append('prest',$('#prest_prod').val());
				formData.append('suc_org',$('#sucursal_origen').val());
				formData.append('marca',$('#marka').val());
				$.ajax({
					url:'router/ProductosRouter.php',
					type:'POST',
					data: formData,
					processData:false,
					contentType:false,
					cache: false,
					beforeSend:function(data){
						if(data && data.overrideMimeType) {
							data.overrideMimeType("application/json;charset=UTF-8");
						}

					},
					success: function(data){
						if(data.completo){
							new Productos().listarCabeceraProductosexistentes(data.alm_prod_cab_id_unico_prod); ////////////////////////////////
							new Productos().listaGeneralProductos();
						}
					},
					error: function(data){
					}
			    });
		   }
		   evt.preventDefault();
		});
	}

	/** Metodo que lista las cabeceras existentes **/
	this.listaGeneralProductos = function(){
		$.getJSON('router/ProductosRouter.php?accion=listarProductosGeneral', function(result){
			$('#tabla_datos_produstos').empty();
		    var tabla_principal = ' <table class="table_usuario" id="tb_produstos"> <tr>';
		    tabla_principal = tabla_principal + '<th align="center">CODIGO</th> <th align="center">NOMBRE</th><th align="center">TIPO</th>';
		    tabla_principal = tabla_principal + '<th align="center">CANTIDAD</th> <th align="center">PRECIO DE COMPRA</th><th align="center">PRECIO DE VENTA</th>';
		    tabla_principal = tabla_principal + '<th align="center">SUCURSAL ORIGEN</th><th align="center">ESTADO</th><th align="center">EDITAR</th><th align="center">ELIMINAR</th>';             
		    tabla_principal = tabla_principal + '</tr></table>';
            $('#tabla_datos_produstos').append(tabla_principal);
            $.each(result, function(index, value){
				tabla_principal = ' <tr> ';
				tabla_principal = tabla_principal + ' <td align="center">'+value.alm_prod_cab_codigo+'</td>';
				tabla_principal = tabla_principal + '<td align="left">'+value.alm_prod_cab_nombre+'</td>';
				tabla_principal = tabla_principal + '<td align="center">'+value.tipo+'</td>';
				tabla_principal = tabla_principal + '<td align="center">'+value.cantidad+'</td>';
				tabla_principal = tabla_principal + '<td align="center">'+value.alm_prod_det_prec_compra+'</td>';
				tabla_principal = tabla_principal + '<td align="center">'+value.alm_prod_det_prec_venta+'</td>';
				tabla_principal = tabla_principal + '<td align="center">'+value.AGE_ORIG+'</td>';
				tabla_principal = tabla_principal + '<td align="center">'+value.ESTADO+'</td>';
				tabla_principal = tabla_principal + '<td align="center"> <div style="cursor:pointer"><a onClick="new Productos().modificarCabeceraProducto(\''+value.codigo_unico_producto+'\', \''+value.alm_prod_cab_nombre+'\')" > <img src="../img/notepad_32x32.png" align="absmiddle"><br>Modificar</a></div></td><td><div style="cursor:pointer"><a  onClick="new GestionProductos().EliminarProducto(\''+value.codigo_unico_producto+'\', \''+value.alm_prod_cab_nombre+'\');" > <img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></div></td></tr>';
			 	$('#tb_produstos').append(tabla_principal);
					
			});
		});
	}

	/**
	*	Metodo que elimina el producto de la cabecera
	*/
    this.desabilitarProducto = function(codigo,nombre){
    	console.log(codigo);
    	$("#dialog-confirm-producto" ).attr('title', 'Confirmacion');
		$("#dialog-confirm-producto").empty();
		$("#dialog-confirm-producto").append('<p><img src="../img/alert_48x48.png" align="absmiddle">Realmente quiere eliminar el Producto ?</p>');
		$("#dialog-confirm-producto").dialog({
			resizable: false,
			height:200,
			width:400,
			modal: true,
			buttons: {
				"Aceptar": function() {
					$( this ).dialog( "close" );
					new Productos().eliminarCabeceraProducto(codigo,nombre);
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});
    }




	/**
	*	Metodo que elimina el producto de la cabecera
	*/
	this.eliminarCabeceraProducto = function(codigo_unico,nombre){
		//alert(codigo+"-"+nombre);
		$.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'eliminarCabecera',
					cod:codigo_unico,
					nom:nombre
				},
				beforesend : function (){
						//$("#dialog-confirm").dialog( "close" );
						$('#tabla_datos_produstos').empty();
						$('#tabla_datos_produstos').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
				},
				success: function(res){
					if (res.completo){
						$(location).attr('href', 'prod_gest.php');
					}
				}
		});
	}


	/**
	* Metodo que graba ka cabecera de losproductos
	*/
	this.grabarCabeceraProductos = function(){
	//mod Nela
	//alert($('#fec_proc_prod').val());

	//alert("inicio grabaro js");
	    $.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'insertarCabecera',
					cod_ref:$('#cod_ref_cab').val(),
					tipo:$('#tipo_producto').val(),
					prov:$('#provedor_producto').val(),
					nom:$('#nom_prod').val(),
					desc:$('#desc_prod').val(),
					cantidad:$('#cant_prod').val(),
					fech_proce:$('#fec_proc_prod').val(),
					unidad:$('#unidad_producto').val(),
					moneda:$('#moneda_producto').val(),
					prest:$('#prest_prod').val(),
					suc_org:$('#sucursal_origen').val(),
					imag:$('#img_produc').val(),
					dat_tec:$('#dat_tec').val(),
					marca:$('#marka').val()
					/**/
				},
				success: function(res){
					//alert(res);
					//console.log(res.alm_prod_cab_id_unico_orden_compra);
					if (res.completo==true){
						console.log("gravo");
						//$("#formulario_detallar_productos").dialog("close");
						
						//new Productos().ingresarDetalleProductos(res.alm_prod_cab_id_unico_prod);
						//$("#formulario_insertar_productos").dialog("close");
						new Productos().listarCabeceraProductosexistentes(res.alm_prod_cab_id_unico_prod);
						
					}else{
						console.log("no gravo");
						
					}
				}
		});
	}
	
	
	
	
	  /**
	 * Metodo q ejecuta el formulario de los productos cabecera y detalle
	 */
	 
	 this.formularioListarCabDetProductos_tpl = function(){
		 //alert("tpl");
		 $("#formulario_cab_det_productos").dialog("close");
		var formu = '<div id="formulario_cab_det_productos" title="Listando Productos" style="display:none; width: 300px;" >';
			formu = formu + '<div id="tabla_carga_cab_productos" >';
			formu = formu + '</div>';
			formu = formu + '<div id="tabla_carga_det_productos" ></div></div>';
			formu = formu + '</div>';
			formu = formu + '</div>';
		$('body').append(formu);	

		$("#formulario_cab_det_productos").dialog({
								height: 650,
								width: 1500,
								modal: true,
								resizable: true,
								draggable: true,
								closeText: "hide"
		});
		/**/
		
	}
	
	 /**
	 * Metodo q ejecuta el formulario de los productos cabecera y detalle
	 */
	 
	 this.formularioListarCabeceraDetalleProductos_tpl = function(){		 
		var formu = '<div id="formulario_cab_det_productos" title="Listando Productos" style="display:none; width: 300px;" >';
			formu = formu + '<div id="tabla_carga_cab_productos" >';
			formu = formu + '</div>';
			formu = formu + '<div id="tabla_carga_det_productos" ></div></div>';
			formu = formu + '</div>';
			formu = formu + '</div>';
		$('body').append(formu);	

		$("#formulario_cab_det_productos").dialog({
								height: 650,
								width: 850, //1500,
								modal: true,
								resizable: true,
								draggable: true,
								closeText: "hide"
		});
		/**/
		
	}
	 /************************************************************************************************************
		 * Metodo q ejecuta el formulario  para el ingreso de los items de detalle de producto
		 */
	this.listarCabeceraProductosexistentes = function(codigo){
		//alert(codigo);
		$.ajax({			
					url:'router/ProductosRouter.php',
					dataType: 'json',
					type: 'POST',
					data : { 
						accion : 'listaCabecera',
						codigo : codigo
					},
					beforeSend: function(){
						$('#tabla_cab_productos').empty();
					},
					success: function(res){	
						//console.log(res);
						//new Productos().formularioListarCabDetProductos_tpl();
						
						/***********CABECERA*****************/
						
						var cab1 = '<table border="0" align="center"><tr><td colspan="7" align="center"><h1>PRODUCTO INGRESADO '+res[0].alm_prod_cab_codigo+' <input type="hidden" name="codigo_producto_cab_hidden" id="codigo_producto_cab_hidden" value="'+res[0].alm_prod_cab_codigo+'"></h1></td></tr>';
						//cab1 = cab1 + '<tr><td colspan="2"></td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td></tr><tr><td colspan="2"></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
					
						cab1 = cab1 + '<tr><td ><label for="textfield"><strong>Codigo Referencia:</strong></label></td>';
						cab1 = cab1 + '<td ><input type="text" class="txt_campo" name="cod_ref_m" id="cod_ref_m" value="'+res[0].alm_prod_cab_cod_ref+'" readonly><input type="hidden" class="txt_campo" name="cod_prod_m" id="cod_prod_m" value="'+res[0].alm_prod_cab_codigo+'" readonly></td>';
						cab1 = cab1 + '<td><strong>Fecha Proceso:</strong></td><td><input type="text" class="txt_campo" name="fec_proc_m" id="fec_proc_m" readonly value="'+res[0].alm_prod_cab_fecha_proceso+'" /></td><td valign="bottom"><strong>Imagen:</strong></td>';
						cab1 = cab1+ '<td valign="bottom"><strong>Documento:</strong></td></tr>';
						cab1 = cab1 + '<tr><td><label for="textfield"><strong>Tipo Producto:</strong></label></td>';
						cab1 = cab1 + ' <td><input type="text" class="txt_campo" name="tipo_m" id="tipo_m" value="'+res[0].tipo+'" readonly></td>';
						cab1 = cab1 + '<td><strong>Unidad Medida:</strong></td><td><input type="text" class="txt_campo" name="unidad_m" id="unidad_m" value="'+res[0].unidad+'" readonly /></td><td rowspan="3" valign="top"><a href=".//'+res[0].alm_prod_cab_img+'" target="_blanc"><img style="border: solid 1px #ccc;" width="100" height="100" src=".//'+res[0].alm_prod_cab_img+'"></a></td>';
						cab1 = cab1 + '<td rowspan="3" valign="top"><a href="clases/pdf.php?valor=.//'+res[0].alm_prod_cab_pdf_descp+'" target="_blanc"><img style="border: solid 1px #ccc;" width="100" height="100" src=".//../../images/producto/dt/pdf.png"></a></td>';		
						cab1 = cab1 + '</tr><tr><td><label for="textfield"><strong>Proveedor:</strong></label></td>';
						cab1 = cab1 + '<td><input type="text" class="txt_campo" name="nom_prov_m" id="nom_prov_m"  value="'+res[0].proveedor+'" readonly></td>';
						cab1 = cab1 + ' <td><strong>Moneda</strong></td><td><input type="text" class="txt_campo" name="moneda_m" id="moneda_m" value="'+res[0].moneda+'" readonly /></td>';
						cab1 = cab1 + '</tr><tr><td><label for="textfield"><strong>Nombre</strong></label></td>';
						cab1 = cab1 + '<td><input type="text" class="txt_campo" name="nom_m" id="nom_m" value="'+res[0].alm_prod_cab_nombre+'" readonly></td>';
						cab1 = cab1 + '<td><strong>Presentacion</strong></td><td><input type="text" class="txt_campo" name="prest_m" id="prest_m" value="'+res[0].alm_prod_cab_presentacion+'" readonly /></td>';
						cab1 = cab1 + '</tr><tr><td><label for="textfield"><strong>Descripcion</strong></label></td>';
						cab1 = cab1 + '<td><input type="text" class="txt_campo" name="desc_m" id="desc_m" value="'+res[0].alm_prod_cab_descripcion+'" readonly></td>';
					//	cab1 = cab1 + '</tr><tr><td><label for="textfield">Marca:</label></td>';
						cab1 = cab1 + '<td><!--label for="textfield">Imagen</label--><strong>Sucursal Origen</strong></td><td><!--input type="text" class="txt_campo" name="img_m" id="img_m" value="'+res[0].alm_prod_cab_img+'" readonly --><input type="text" class="txt_campo" name="ag_or_m" id="ag_or_m" value="'+res[0].age_orig+'" readonly /></td>';
						cab1 = cab1 + '</tr>';
						cab1 = cab1 + '<tr><td><label for="textfield"><strong>Cantidad :</strong></label></td>';
						cab1 = cab1 + '<td><input type="text" class="txt_campo" name="cant_m_01" id="cant_m_01" readonly></td>';
						cab1 = cab1 + '<td><strong>Marca</strong></td><td><input type="text" class="txt_campo" name="marca_m" id="marca_m" value="'+res[0].alm_prod_cab_marca+'" readonly /></td>';
						cab1 = cab1 + '</tr>';
						cab1 = cab1 + '<td><!--label for="textfield">Datos Tecnicos</label--></td><td><!--input type="text" class="txt_campo" name="dat_tec_ins" id="dat_tec_ins" value="'+res[0].alm_prod_cab_pdf_descp+'" readonly--></td>';
						cab1 = cab1 + '</tr>';
						cab1 = cab1 + '<tr><td colspan="2" align="center"></td>';
						cab1 = cab1 + '<td colspan="4" align="center"></td>';
						cab1 = cab1 + '</tr></table><input type="button" name="btn_prod" id="btn_prod" class="btn_form" value="Nuevo Item" onclick="new Productos().ingresarDetalleProductos(\''+codigo+'\',\''+res[0].proveedor+'\');"><input type="button" name="btn_prod_procesar" id="btn_prod_procesar" class="btn_form" value="Procesar Producto" onclick="new Productos().procesarProducto();"><input type="button" name="btn_prod_cancelar" id="btn_prod_cancelar" class="btn_form" value="Cancelar" onclick="new Productos().cancelarProducto();">';

						//$('#formulario_modificar_productos').append(cab1);			
						$('#tabla_cab_productos').append(cab1);
				

						var btn_cab = 

						new Productos().listarDetalleProductos(codigo);	

						new Productos().totalesDetalleProducto(codigo);		
						var util = new Utilitarios();
						util.stopPreloader();								
						//var cab2 = '</tr></table><input type="button" name="btn_prod" id="btn_prod" class="btn_form" value="Nuevo Item" onclick="new Productos().ingresarDetalleProductos(\''+codigo+'\',\''+res[0].proveedor+'\');"><input type="button" name="btn_prod_procesar" id="btn_prod_procesar" class="btn_form" value="Procesar Producto" onclick="new Productos().procesarProducto();"><input type="button" name="btn_prod_cancelar" id="btn_prod_cancelar" class="btn_form" value="Cancelar" onclick="new Productos().cancelarProducto();">';

						}	
				});
	}
   /**
	 * Metodo q ejecuta el formulario que cierra el dialogo del producto
	 */
	this.cancelarProducto = function(codigo){
			
		$('#formulario_insertar_productos').dialog("close");

	}


    /**
	 * Metodo q ejecuta el formulario de los nuevosproductos
	 */
	this.procesarProducto = function(codigo){
		$(location).attr('href', 'prod_gest.php');
	}

	
   /**
	 * Metodo q ejecuta el formulario de los nuevosproductos
	 */
	this.listarDetalleProductos = function(codigo){
		$.ajax({
				url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {
					accion:'cargardetalleProducto',
					codigo:codigo
				},
				beforeSend : function(){

					$('#tabla_det_productos').empty();
				},
				success: function(resulta){
					//console.log(resulta);
					var det = '<table border="0" class="table_usuario" id="tabla_detalle" >';
					det = det + '<tr class="tr_usuario"><th>N</th><th>FECHA INGR</th><th>SERIE</th><th>CANT.</th><th>PU COMPRA</th><th>PU VENTA</th><th>PU VENTA MAX</th>';
					det = det + '<th>PU VENTA MIN</th><th>ESTADO</th><th>FECHA VENC.</th><th>LOTE</th><th>PART NUMBER</th><th>TC</th><th>MODIFICAR</th><th>ELIMINAR</th></tr>';		
					det = det + '</table>';
					$('#tabla_det_productos').append(det);
					cont=1;
					$.each(resulta, function(index,deta){
							console.log(deta);
							if (deta.tipo==0) {
								
							}else{
								var det =  '<tr><td>'+cont+'</td><td>'+deta.alm_prod_cab_fec_ing+'</td><td>'+deta.alm_prod_det_serie+'</td><td>'+deta.alm_prod_det_cantidad+'</td>';
							det = det + '<td>'+deta.alm_prod_det_prec_compra+'</td><td>'+deta.alm_prod_det_prec_venta+'</td><td>'+deta.alm_prod_det_prec_max_venta+'</td><td>'+deta.alm_prod_det_prec_min_venta+'</td>';
							
							if(deta.alm_prod_det_estado == 1){
								det = det + '<td><img src="../img/checkmark_32x32.png" align="absmiddle"></td>'
							}else if(deta.alm_prod_det_estado == 2){
								det = det + '<td><img src="../img/close_32x32.png" align="absmiddle"></td>'
							}else if(deta.alm_prod_det_estado == 3){
								det = det + '<td><img src="../img/block_32x32.png" align="absmiddle"></td>'
							}else if(deta.alm_prod_det_estado == 4){
								det = det + '<td><img src="../img/down_32x32.png" align="absmiddle"></td>'
							} 
							
							det = det + '<td>'+deta.alm_prod_det_fecha_venc+'</td><td>'+deta.alm_prod_det_lote+'</td><td>'+deta.alm_prod_det_part_number+'</td>';
							det = det + '<td>'+deta.alm_prod_det_tc+'</td><td><div style="cursor:pointer"><a  onClick="new Productos().modificarDetalleProductos(\''+codigo+'\',\''+deta.alm_prod_det_id_unico+'\',\''+deta.alm_prod_det_id+'\');" > <img src="../img/notepad_32x32.png" align="absmiddle"><br>Modificar</a></div></td>';
							det = det + '<td><div style="cursor:pointer"><a  onClick="new Productos().eliminarDetProducto(\''+codigo+'\',\''+deta.alm_prod_det_id_unico+'\',\''+deta.alm_prod_det_id+'\');" > <img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></div></td></tr>';
							cont++;
							}

					

							

							/*var det =  '<tr><td>'+cont+'</td><td>'+deta.alm_prod_cab_fec_ing+'</td><td>'+deta.alm_prod_det_serie+'</td><td>'+deta.alm_prod_det_cantidad+'</td>';
							det = det + '<td>'+deta.alm_prod_det_prec_compra+'</td><td>'+deta.alm_prod_det_prec_venta+'</td><td>'+deta.alm_prod_det_prec_max_venta+'</td><td>'+deta.alm_prod_det_prec_min_venta+'</td>';
							if(deta.alm_prod_det_estado == 1){
								det = det + '<td><img src="../img/checkmark_32x32.png" align="absmiddle"></td>'
							}else{
								//det = det + '<td><img src="../img/close_32x32.png" align="absmiddle"></td>'
							}
							det = det + '<td>'+deta.alm_prod_det_fecha_venc+'</td><td>'+deta.alm_prod_det_lote+'</td><td>'+deta.alm_prod_det_part_number+'</td>';
							det = det + '<td>'+deta.alm_prod_det_tc+'</td><td><div style="cursor:pointer"><a  onClick="new Productos().modificarDetalleProductos(\''+codigo+'\',\''+deta.alm_prod_det_id_unico+'\',\''+deta.alm_prod_det_id+'\');" > <img src="../img/notepad_32x32.png" align="absmiddle"><br>Modificar</a></div></td>';
							det = det + '<td><div style="cursor:pointer"><a  onClick="new Productos().eliminarDetProducto(\''+codigo+'\',\''+deta.alm_prod_det_id_unico+'\',\''+deta.alm_prod_det_id+'\');" > <img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></div></td></tr>';
							cont++;
							//$('#tabla_carga_det_productos').append(det);
							*/
							$('#tabla_detalle').append(det);
	
					});
					
					//new Productos().totalesDetalleProducto(codigo);	
	
				}
		});

		
	}

	 /**
	 * Metodo q ejecuta el total del detalle de las cantidades
	 */
	this.totalesDetalleProducto = function(codigo){
		//alert(codigo);
		$.ajax({
				url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {
					accion:'cantidadTotalItem',
					codigo:codigo
				},
				beforeSend : function(){

					$('#tabla_total_det_productos').empty();
				},
				success: function(resulta){

					//alert("cargando tabla total");
					//console.log(resulta.total);
					

                    var total = '<table class="table_usuario">';
					if (resulta.total!=null) {
						total = total + '<tr><td><strong>Cantidad Total :</strong></td><td>'+resulta.total+'</td></tr>';
						$('#cant_m_01').val(resulta.total);
						new Productos().updateCantidadCabProducto(resulta.total,codigo);
					}else{
						total = total + '<tr><td><strong>Cantidad Total :</strong></td><td>0</td></tr>';
						$('#cant_m_01').val(0);
						new Productos().updateCantidadCabProducto(0,codigo);
				    }

				    total = total + '</table>';
				    $('#tabla_total_det_productos').append(total);

				}
			});

	}

		/***
		*	Metodo que actualiza la cantidad de la cabecera del producto
		*
		*/
		this.updateCantidadCabProducto = function(cantidad, codigo){
			//alert(cantidad+"--"+codigo+"-- antes de is al controller");
			
			$.ajax({
				url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {
					accion:'updateCantidadCabecera',
					codigo:codigo,
					cantidad: cantidad
				},
				beforeSend : function(){

					
				},
				success: function(resulta){
				}
			});

		}



		this.totalesDetalleModifProducto = function(codigo){
			//alert(codigo);
		    $.ajax({
				url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : {
					accion:'cantidadTotalItem',
					codigo:codigo
				},
				beforeSend : function(){

					$('#tabla_total_det_modif_productos').empty();
				},
				success: function(resulta){

					//alert("cargando tabla total");
					//console.log(resulta.total);
                    var total = '<table class="table_usuario">';
					if (resulta.total!=null) {
						total = total + '<tr><td><strong>Cantidad Total :</strong></td><td>'+resulta.total+'</td></tr>';
					}else{
						total = total + '<tr><td><strong>Cantidad Total :</strong></td><td>0</td></tr>';
				    }
				    total = total + '</table>';
				    $('#tabla_total_det_modif_productos').append(total);

				}
			});

	}

		

	/**
     * Metodo que permite desabilitar la orden de compra
     */
    this.eliminarDetProducto = function(codigoCab,codigo,id){
    	//alert("eliminar");
    	//alert(codigoCab+"--"+codigo+"--"+id);
    	$("#dialog-confirm-detalle" ).attr('title', 'Confirmacion');
		$("#dialog-confirm-detalle").empty();
		$("#dialog-confirm-detalle").append('<p><img src="../img/alert_48x48.png" align="absmiddle">Realmente quiere eliminar el Producto ?</p>');
		$("#dialog-confirm-detalle").dialog({
			resizable: false,
			height:200,
			width:400,
			modal: true,
			buttons: {
				"Aceptar": function() {
					//alert("entra aceptar");
					
					new Productos().eliminaDetalleProductos(codigoCab,codigo,id);
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});
    }

	/**
	* Metodo que elimina los items del producto
	*
	*/
	this.eliminaDetalleProductos = function(codigoCab,codigo,id){
		$.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'eliminarDetalle',
					cod:codigo,
					id:id
				},beforesend : function (){
						//$("#dialog-confirm").dialog( "close" );
					
				},
				success: function(res){
					//alert(codigoCab);
					//console.log(res.alm_prod_cab_id_unico_orden_compra);
					if (res.completo==true){
						//console.log("gravo");
						$("#dialog-confirm-detalle").dialog( "close" );
						new Productos().listarDetalleProductos(codigoCab);
						new Productos().totalesDetalleProducto(codigoCab);		
						//new Productos().listarCabeceraProductosexistentes(codigoCab);
						
					}else{
						console.log("no gravo");
						
					}
				}
		});
	}

	/**
     * Metodo que permite desabilitar la orden de compra desde el modificar
     */
    this.eliminarDetModifProducto = function(codigoCab,codigo,id){
    	//alert("eliminar");
    	//alert(codigoCab+"--"+codigo+"--"+id);
    	$("#dialog-confirm-detalle" ).attr('title', 'Confirmacion');
		$("#dialog-confirm-detalle").empty();
		$("#dialog-confirm-detalle").append('<p><img src="../img/alert_48x48.png" align="absmiddle">Realmente quiere eliminar el Producto ?</p>');
		$("#dialog-confirm-detalle").dialog({
			resizable: false,
			height:200,
			width:400,
			modal: true,
			buttons: {
				"Aceptar": function() {
					//alert("entra aceptar");
					
					new Productos().eliminaDetalleModifProductos(codigoCab,codigo,id);
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});
    }

	/**
	* Metodo que elimina los items del producto desde el modificar
	*
	*/
	this.eliminaDetalleModifProductos = function(codigoCab,codigo,id){
		$.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'eliminarDetalle',
					cod:codigo,
					id:id
				},beforesend : function (){
						//$("#dialog-confirm").dialog( "close" );
					
				},
				success: function(res){
					//alert(codigoCab);
					//console.log(res.alm_prod_cab_id_unico_orden_compra);
					if (res.completo==true){
						//console.log("gravo");
						$("#dialog-confirm-detalle").dialog( "close" );
						new Productos().detalleModificarProducto(codigoCab);
						//new Productos().listarCabeceraProductosexistentes(codigoCab);
						
					}else{
						console.log("no grabo");
						
					}
				}
		});
	}


	   /**
		 * Metodo q ejecuta el formulario  para el ingreso de los items de detalle de producto
		 */
	this.ingresarDetalleProductos = function(codigo){
		
		 var util = new Utilitarios();	
		$('#tabla_detalle_productos').empty();
		 var detalle = '<input type="hidden" class="txt_campo"  name="cod_cab_detalle" id="cod_cab_detalle" value="'+codigo+'">';
		 detalle = detalle +'<label for="textfield"><center><H1>INGRESO DETALLE PRODUCTO</H1></center></label>';
		 detalle = detalle +'<table align="center">';
		 detalle = detalle +'<tr><td ><strong>Nombre del Producto: '+$("#nom_m").val();+'</strong></td><td>Fecha Proceso:'+$("#fec_proc_m").val();+'</td></tr>';
		 detalle = detalle +'<tr><td><strong>Codigo del producto: '+$("#cod_prod_m").val();+'</strong></td><td>&nbsp;</td></tr></table><br><br>';
     	 detalle = detalle + '<br><table border="0">';
		 detalle = detalle + '<tr><td>&nbsp;</td><td width="144">&nbsp;</td><td width="10">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
		 //pantalla de ingreso Mod Nela
		 detalle = detalle + '<tr><td><strong>Serie :</strong></td><td><input type="text" class="txt_campo" name="serie" id="serie"><div id="error_serie"></div></td>';
		 detalle = detalle + '<td>&nbsp;</td>';
		 detalle = detalle + '<td><label for="textfield"><strong>Part Number :</strong></label></td>';
		 detalle = detalle + '<td><input type="number" class="txt_campo" name="part_number" id="part_number"><div id="error_part_number"></div></td></tr>';
		 
		 detalle = detalle + '<tr><td><strong>Fecha Ingreso :</strong></td><td><input type="text"class="txt_campo"  name="fech_ingreso" id="fech_ingreso"><div id="error_fec_ingreso"></div></td>';
		 detalle = detalle + '<td>&nbsp;</td>';
		 detalle = detalle + '<td><label for="textfield"><strong>Tipo Cambio :</strong></label></td>';
		 detalle = detalle + '<td><input type="text" class="txt_campo" name="t_c" id="t_c"><div id="error_t_c"></div></td></tr>';
		 
		 detalle = detalle + '<tr><td><label for="textfield">Cantidad :</label></td><td><input type="number" class="txt_campo" name="cant_prod_deta" id="cant_prod_deta"><div id="error_cantidad"></div></td>';
		 detalle = detalle + '<td>&nbsp;</td>';
		 detalle = detalle + '<td><label for="textfield"><strong>Estado :</strong></label></td>';
		 detalle = detalle + '<td><select name="estado_producto" id="estado_producto" size="1" size="10"></select></td></tr>';
		 detalle = detalle + '<tr><td><label for="textfield"><strong>Precio Compra :</strong></label></td>';
		 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_c" id="p_c"><div id="error_p_c"></div></td>';
		 detalle = detalle + ' <td>&nbsp;</td>';
		 detalle = detalle + '<td><label for="textfield"><strong> Precio Venta:</strong></label></td>';
		 detalle = detalle + '<td><input type="text" class="txt_campo" name="p_v" id="p_v" onchange="new Productos().calculaPorcentaje();"><div id="error_p_v"></div></td></tr>';
		// detalle = detalle + ' <td>&nbsp;</td>';
		 detalle = detalle + '<tr><td><label for="textfield"><strong>Fecha Vencimiento :</strong></label></td>';
		 detalle = detalle + '<td><input type="text" class="txt_campo" name="fech_venc" id="fech_venc"></td>';
		 detalle = detalle + '<td>&nbsp;</td>';
		 detalle = detalle + '<td><label for="textfield"><strong>Precio Min Venta :</strong></label></td>';
		 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_min_v" id="p_min_v" readonly><div id="error_p_min_v"></div></td></tr>';
		// detalle = detalle + '<td>&nbsp;</td>';
		 detalle = detalle + '<tr> <td><label for="textfield"><strong>Lote :</strong></label></td>';
		 detalle = detalle + '<td><input type="text" class="txt_campo" name="lot" id="lot"></td>';
		 detalle = detalle + ' <td>&nbsp;</td>';
		 detalle = detalle + ' <td><label for="textfield"><strong>Precio Max Venta</strong></label></td>';
		 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_max_v" id="p_max_v" readonly><div id="error_p_max_v"></td></div></tr>';	 
		 detalle = detalle + '<tr><td></td>';
		 detalle = detalle + '<td></td>';
		 detalle = detalle + '<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
		 detalle = detalle + '<tr><td>&nbsp;</td><td align="right"><input type="button" name="det_insert" id="det_insert" class="btn_form" value="Grabar" onclick="new Productos().grabarDetalleProductos(\''+codigo+'\');"></td><td>&nbsp;</td><td><input type="button" name="can_det" id="can_det" class="btn_form" value="Cancelar" onclick="new Productos().cancelarDetProducto();"></td><td>&nbsp;</td></tr>';
		 detalle = detalle + '</table>';

		$('#tabla_detalle_productos').append(detalle);
				$.ajax({
						url:'router/ProductosRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion:'cargarEstado'
						},
						beforeSend : function(){
							//$("#formulario_cab_det_productos").dialog("close");
						},
						success: function(resulta){
							var est;
							$.each(resulta, function(index,estado){
								est = est +'<option select value="'+estado.cod_estado+'">'+estado.nom_estado+'</option>';
							});
							$('#estado_producto').append(est);
							
						}
				});
		$('#cant_prod_deta').numeric();
		$('#p_c').numeric('.');
		$('#p_v').numeric('.');
		$('#t_c').numeric('.');
		/*****************************/
		$("#fech_ingreso").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#fech_venc").datepicker({
			dateFormat: "dd/mm/yy"
		});
		util.validarCampo('cant_prod_deta', 'error_cantidad', 'El campo Cantidad no puede estar vacio');
		util.validarCampo('p_c', 'error_p_c', 'El campo Precio Compra no puede estar vacio');
		util.validarCampo('part_number', 'error_part_number', 'El campo Part Number no puede estar vacio');
		util.validarCampo('t_c', 'error_t_c', 'El campo Tipo Cambio no puede estar vacio');
		util.validarCampo('p_v', 'error_p_v', 'El campo Precio Venta no puede estar vacio');
		//util.validarCampo('p_min_v', 'error_p_min_v', 'El campo Precio Min Venta no puede estar vacio');
		//util.validarCampo('p_max_v', 'error_p_max_v', 'El campo Precio Max Venta no puede estar vacio');
		
		$("#formulario_detalle_productos").dialog({
						height: 500,
						width: 850,
						modal: true,
						resizable: true,
						draggable: true,
						closeText: "hide"
		});
		
	}

		   /**
		 * Metodo q ejecuta el formulario  para el ingreso de los items de detalle de producto
		 */
	this.ingresarDetalleModifProductos = function(codigo){
		 //alert(codigo);
		 var codigo=codigo; 
		 var util = new Utilitarios();	
		$('#tabla_detalle_modif_productos').empty();
		 var detalle = '<input type="hidden" class="txt_campo"  name="cod_cab_detalle2" id="cod_cab_detalle2" value="'+codigo+'">';
		 detalle = detalle + '<label for="textfield"><center><H1>INGRESO DETALLE PRODUCTO</H1></center></label>';
     	 detalle = detalle + '<br><table border="0">';
		 detalle = detalle + '<tr><td><strong>Serie :</strong></td><td><input type="text" class="txt_campo" name="serieDet" id="serieDet"><div id="error_serieDet"></div></td>';
		 detalle = detalle + '<td><label for="textfield"><strong>Part Number :</strong></label></td>';
		 detalle = detalle + '<td><input type="number" class="txt_campo" name="part_numberDet" id="part_numberDet"><div id="error_part_numberDet"></div></td></tr>';	 
		 detalle = detalle + '<tr><td><strong>Fecha Ingreso :</strong></td><td><input type="text"class="txt_campo"  name="fech_ingresoDet" id="fech_ingresoDet"><div id="error_fec_ingresoDet"></div></td>';
		 detalle = detalle + '<td><label for="textfield"><strong>Tipo Cambio :</strong></label></td>';
		 detalle = detalle + '<td><input type="text" class="txt_campo" name="t_c_Det" id="t_c_Det"><div id="error_t_c_Det"></div></td></tr>'; 
		 detalle = detalle + '<tr><td><label for="textfield"><strong>Cantidad :</strong></label></td><td><input type="number" class="txt_campo" name="cant_prod_detaDet" id="cant_prod_detaDet"><div id="error_cant_prod_detaDet"></div></td>';
		 detalle = detalle + '<td><label for="textfield"><strong>Estado :</strong></label></td>';
		 detalle = detalle + '<td><select name="estado_producto" id="estado_producto_Det" size="1" size="10"></select></td></tr>';
		 detalle = detalle + '<tr><td><label for="textfield"><strong>Precio Compra :</strong></label></td>';
		 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_c_Det" id="p_c_Det"><div id="error_p_c_Det"></div></td>';
		 detalle = detalle + '<td><label for="textfield"><strong> Precio Venta:</strong></label></td>';
		 detalle = detalle + '<td><input type="text" class="txt_campo" name="p_v_Det" id="p_v_Det" onchange="new Productos().calculaPorcentaje();"><div id="error_p_v_Det"></div></td></tr>';
		 detalle = detalle + '<tr><td><label for="textfield"><strong>Fecha Vencimiento :</strong></label></td>';
		 detalle = detalle + '<td><input type="text" class="txt_campo" name="fech_venc_Det" id="fech_venc_Det"></td>';
		 detalle = detalle + '<td><label for="textfield"><strong>Precio Min Venta :</strong></label></td>';
		 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_min_v_Det" id="p_min_v_Det" readonly><div id="error_p_min_v_Det"></div></td></tr>';
		 detalle = detalle + '<tr> <td><label for="textfield"><strong>Lote :</strong></label></td>';
		 detalle = detalle + '<td><input type="text" class="txt_campo" name="lotDet" id="lotDet"></td>';
		 detalle = detalle + ' <td><label for="textfield"><strong>Precio Max Venta</strong></label></td>';
		 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_max_v_Det" id="p_max_v_Det" readonly><div id="error_p_max_v_Det"></td></div></tr>';	 
		 detalle = detalle + '</table>';
		 detalle = detalle + '<br><div><center><input type="button" name="det_insert1" id="det_insert1" class="btn_form" value="Grabar" onclick="new Productos().grabarDetalleModifProductos(\''+codigo+'\');"></td><td>&nbsp;</td><td><input type="button" name="canc_det" id="canc_det" class="btn_form" value="Cancelar" onclick="new Productos().cancelarDetModifProducto();"></center></div>';
		 

		$('#tabla_detalle_modif_productos').append(detalle);
				$.ajax({
						url:'router/ProductosRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion:'cargarEstado'
						},
						beforeSend : function(){
							//$("#formulario_cab_det_productos").dialog("close");
						},
						success: function(resulta){
							var est;
							$.each(resulta, function(index,estado){
								est = est +'<option select value="'+estado.cod_estado+'">'+estado.nom_estado+'</option>';
							});
							$('#estado_producto_Det').append(est);
							
						}
				});
		$('#cant_prod_detaDet').numeric();
		$('#p_c_Det').numeric('.');
		$('#p_v_Det').numeric('.');
		$('#t_c_Det').numeric('.');
		/*****************************/
		$("#fech_ingresoDet").datepicker({
			dateFormat: "dd/mm/yy"
		});
		$("#fech_venc_Det").datepicker({
			dateFormat: "dd/mm/yy"
		});
		util.validarCampo('cant_prod_detaDet', 'error_cant_prod_detaDet', 'El campo Cantidad no puede estar vacio');
		util.validarCampo('p_c_Det', 'error_p_c_Det', 'El campo Precio Compra no puede estar vacio');
		util.validarCampo('part_numberDet', 'error_part_numberDet', 'El campo Part Number no puede estar vacio');
		util.validarCampo('t_c_Det', 'error_t_c_Det', 'El campo Tipo Cambio no puede estar vacio');
		util.validarCampo('p_v_Det', 'error_p_v_Det', 'El campo Precio Venta no puede estar vacio');
		//util.validarCampo('p_min_v', 'error_p_min_v', 'El campo Precio Min Venta no puede estar vacio');
		//util.validarCampo('p_max_v', 'error_p_max_v', 'El campo Precio Max Venta no puede estar vacio');
		
		$("#formulario_nuevo_item_detalle").dialog({
						height: 500,
						width: 850,
						modal: true,
						resizable: true,
						draggable: true,
						closeText: "hide"
		});
		
	}
	
	
		/**
		 * Metodo q ejecuta el formulario  para el calculo de los porcentajes de precio de venta
		 */
	this.calculaPorcentaje = function(){
		//alert("porcentaje");
		var x = ($("#p_v").val()*0.10);
		$("#p_min_v").val((parseFloat($("#p_v").val())-parseFloat(x)).toFixed(2));
		$("#p_max_v").val((parseFloat($("#p_v").val())+parseFloat(x)).toFixed(2));
		var z = ($("#p_v_me").val()*0.10);
		$("#p_min_v_me").val((parseFloat($("#p_v_me").val())-parseFloat(x)).toFixed(2));
		$("#p_max_v_me").val((parseFloat($("#p_v_me").val())+parseFloat(x)).toFixed(2));
		var y = ($("#p_v_Det").val()*0.10);
		$("#p_min_v_Det").val((parseFloat($("#p_v_Det").val())-parseFloat(y)).toFixed(2));
		$("#p_max_v_Det").val((parseFloat($("#p_v_Det").val())+parseFloat(y)).toFixed(2));
		var z = ($("#p_v_me").val()*0.10);
		$("#p_min_v_me").val((parseFloat($("#p_v_me").val())-parseFloat(z)).toFixed(2));
		$("#p_max_v_me").val((parseFloat($("#p_v_me").val())+parseFloat(z)).toFixed(2));
	}
	
	

	
	   /**
		 * Metodo q ejecuta el formulario  para el grabado de los items de detalle de producto
		 */
	this.grabarDetalleProductos = function(codigo){
		
		//alert($('#cod_cab_detalle').val());
		var util = new Utilitarios();	
		if ($('#fech_ingreso').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha de Proceso es obligatorio', 'Mensaje Detalle Productos');	
		}else if ($('#cant_prod_deta').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Cantidad es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#p_c').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Precio Compra es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#part_number').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Part Number es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#t_c').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Tasa Cambio es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#p_v').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Precio Venta es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#p_min_v').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Precio Min Venta es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#p_max_v').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Precio Max Venta es obligatorio', 'Mensaje Detalle Productos');
		}else{
			$.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				
				type: 'POST',
				data : { 
					accion : 'insertarDetalle',
					
					serie:$('#serie').val(),
					cantidad:$('#cant_prod_deta').val(),
					p_c:$('#p_c').val(),
					p_v:$('#p_v').val(),
					p_min_v:$('#p_min_v').val(),
					p_max_v:$('#p_max_v').val(),
					fech_venc:$('#fech_venc').val(),
					part_number:$('#part_number').val(),
					t_c:$('#t_c').val(),
					lote:$('#lot').val(),
					//marca:$('#marka').val(),
					estado:$('#estado_producto').val(),
					fech_ingreso:$('#fech_ingreso').val(),
					cod_cab_det:$('#cod_cab_detalle').val()
			
				},beforesend: function(){
					//$("#formulario_detalle_productos").empty();
					//$("#formulario_detalle_productos").dialog("close");
					//$('#formulario_detalle_productos').dialog("close");
					//alert("limpia despues del close");
				},
				success: function(res){
					//console.log(res);
					if (res.completo==true){
						//$('#formulario_detalle_productos').dialog('destroy').empty();
						$('#formulario_detalle_productos').dialog("close");

							new Productos().listarDetalleProductos(codigo);	
							new Productos().totalesDetalleProducto(codigo);	
						
					}else{
						console.log("no gravo");
					}
				}
			});
		}
		
	}
	
	   /**
		 * Metodo q ejecuta el formulario  para el grabado de los items de detalle de producto
		 */
	this.grabarDetalleModifProductos = function(codigo){
		
		//alert($('#cod_cab_detalle').val());
		var util = new Utilitarios();	
		if ($('#fech_ingresoDet').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Fecha de Proceso es obligatorio', 'Mensaje Detalle Productos');	
		}else if ($('#cant_prod_detaDet').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Cantidad es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#p_c_Det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Precio Compra es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#part_numberDet').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Part Number es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#t_c_Det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Tasa Cambio es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#p_v_Det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Precio Venta es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#p_min_v_Det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Precio Min Venta es obligatorio', 'Mensaje Detalle Productos');
		}else if ($('#p_max_v_Det').val() == ""){
			util.mostrarMensajeAlerta(0, 'El campo Precio Max Venta es obligatorio', 'Mensaje Detalle Productos');
		}else{
			$.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				
				type: 'POST',
				data : { 
					accion : 'insertarDetalle',
					
					serie:$('#serieDet').val(),
					cantidad:$('#cant_prod_detaDet').val(),
					p_c:$('#p_c_Det').val(),
					p_v:$('#p_v_Det').val(),
					p_min_v:$('#p_min_v_Det').val(),
					p_max_v:$('#p_max_v_Det').val(),
					fech_venc:$('#fech_venc_Det').val(),
					part_number:$('#part_numberDet').val(),
					t_c:$('#t_c_Det').val(),
					lote:$('#lotDet').val(),
					//marca:$('#marka').val(),
					estado:$('#estado_producto_Det').val(),
					fech_ingreso:$('#fech_ingresoDet').val(),
					cod_cab_det:$('#cod_cab_detalle2').val()
			
				},beforesend: function(){
					//$("#formulario_detalle_productos").empty();
					//$("#formulario_detalle_productos").dialog("close");
					//$('#formulario_detalle_productos').dialog("close");
					//alert("limpia despues del close");
				},
				success: function(res){
					//console.log(res);
					if (res.completo==true){
						//$('#formulario_detalle_productos').dialog('destroy').empty();
						$('#formulario_nuevo_item_detalle').dialog("close");

							new Productos().detalleModificarProducto(codigo);	
							//new Productos().totalesDetalleProducto(codigo);	
						
					}else{
						console.log("no gravo");
					}
				}
			});
		}
		
	}
	
	 /**
	 * Metodo q ejecuta el formulario PARA PODER MODIFICAR LOS PRODUCTOS
	 */
	this.modificarCabeceraProducto = function(codigo,nombre){
		
		var codigo=codigo;
		$.ajax({		
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					//accion : 'listarModificarCabecera',
					accion : 'detalleCabeceraModif',
					codigo:codigo,
					nombre:nombre
				},
				success: function(res){
					
					var p=res[0].alm_prod_cab_suc_origen;
					//console.log(p);
			/***********CABECERA*****************/
					$('#tabla_cab_modif_productos').empty();

					var tabla_cab='<table border="0">';
					    tabla_cab=tabla_cab+'<center><h2>MODIFICACION CABECERA PRODUCTO</h2></center>';
					    tabla_cab=tabla_cab+'<tr><td colspan="5"><strong>Nombre del Producto: '+res[0].alm_prod_cab_nombre;'</strong></td></tr>';
						tabla_cab=tabla_cab+'<tr><td colspan="5"><strong>Codigo del producto: '+res[0].alm_prod_cab_codigo;'</strong></td></tr><br><br>';
						tabla_cab=tabla_cab+'<tr><td><label for="textfield"><strong>Codigo Referencia:</strong></label></td><td><input type="text" class="txt_campo" name="cod_ref_cab_1" id="cod_ref_cab_1" value="'+res[0].alm_prod_cab_cod_ref+'"></td><td><label for="textfield"><strong>Fecha Proceso:</strong></label></td><td><input type="text" class="txt_campo" name="fec_proc_prod_1" id="fec_proc_prod_1" value="'+res[0].alm_prod_cab_fecha_proceso+'"><input type="hidden" class="txt_campo" name="codigo_1" id="codigo_1" value="'+res[0].alm_prod_cab_codigo+'"><input type="hidden" class="txt_campo" name="unico_1" id="unico_1" value="'+res[0].alm_prod_cab_id_unico_prod+'"></td><td valign="bottom"><strong>Imagen:</strong></td><td valign="bottom"><strong>Documento:</strong></td></tr>';
						tabla_cab=tabla_cab+'<tr><td><label for="textfield"><strong>Tipo Producto:</strong></label></td><td><input type="text" class="txt_campo" name="tipo_mod" id="tipo_mod" value="'+res[0].tipo+'"readonly><input type="hidden" class="txt_campo" name="tipo_mod_1" id="tipo_mod_1" value="'+res[0].alm_prod_cab_tipo+'"></td>';
						tabla_cab=tabla_cab+'<td><label for="textfield"><strong>Unidad Medida:</strong></label></td><td><select name="unidad_producto_1" id="unidad_producto_1" size="1"  ></select><input type="hidden" class="txt_campo" name="unid_mod_1" id="unid_mod_1" value=""></td><td rowspan="3" valign="top"><a href=".//'+res[0].alm_prod_cab_img+'" target="_blanc"><img id="id_img_modif_cab_prod" style="border: solid 1px #ccc;" width="100" height="100" src=".//'+res[0].alm_prod_cab_img+'"></a></td><td rowspan="3"  valign="top"><a href="clases/pdf.php?valor=.//'+res[0].alm_prod_cab_pdf_descp+'" target="_blanc"><img id="id_det_modif_cab_prod" style="border: solid 1px #ccc;" width="100" height="100" src=".//../../images/producto/dt/pdf.png"></a></td></tr>';
						tabla_cab=tabla_cab+'<tr><td><label for="textfield"><strong>Proveedor:</strong></label></td><td><input type="text" class="txt_campo" name="prov_mod" id="prov_mod" value="'+res[0].proveedor+'"readonly><input type="hidden" class="txt_campo" name="tipo_mod" id="prov_mod_1" value="'+res[0].alm_prod_cab_prov+'"></td>';
						tabla_cab=tabla_cab+'<td><label for="textfield"><strong>Moneda:<strong></label></td><td><select name="moneda_producto_1" id="moneda_producto_1" size="1" ></select><input type="hidden" class="txt_campo" name="mon_mod_1" id="mon_mod_1" value=""><input type="hidden" class="txt_campo" name="numerico" id="numerico" value="'+res[0].alm_prod_cab_numerico+'"></td></tr>';
						tabla_cab=tabla_cab+'<tr><td><label for="textfield"><strong>Nombre:</strong></label></td><td><input type="text" class="txt_campo" name="nom_prod_1" id="nom_prod_1" value="'+res[0].alm_prod_cab_nombre+'"></td>';
						tabla_cab=tabla_cab+'<td><label for="textfield"><strong>Presentacion:</strong></label></td><td><input type="text" class="txt_campo" name="prest_prod_1" id="prest_prod_1" value="'+res[0].alm_prod_cab_presentacion+'"></td></tr>';
						tabla_cab=tabla_cab+'<tr><td><label for="textfield"><strong>Descripcion:</strong></label></td><td><input type="text" class="txt_campo" name="desc_prod_1" id="desc_prod_1" value="'+res[0].alm_prod_cab_descripcion+'"></td>';
						tabla_cab=tabla_cab+'<td><label for="textfield"><strong>Sucursal Origen:</strong></label></td><td><select name="sucursal_origen_1" id="sucursal_origen_1" size="1"></select><input type="hidden" class="txt_campo" name="tipo_mod" id="suc_mod_1" value=""></td><td><label for="textfield"><strong>Imagen:</strong></label></td><td><input type="file" class="txt_campo" name="img_1" id="img_1" value="'+res[0].alm_prod_cab_img+'"></td></tr>';
						tabla_cab=tabla_cab+'<tr><td><label for="textfield"><strong>Marca:</strong></label></td><td><input type="text" class="txt_campo" name="marca_prod_1" id="marca_prod_1" value="'+ res[0].marca+'"></td><td><label for="textfield"><strong>Cantidad:</strong></labe></td><td><input type="text" class="txt_campo" name="cant_prod_1" id="cant_prod_1" value="'+res[0].alm_prod_cab_cantidad_stock+'" readonly></td><td><label for="textfield"><strong>Datos Tecnicos:</strong></label></td><td><input type="file" class="txt_campo" name="dat_tec_1" id="dat_tec_1" value="'+res[0].alm_prod_cab_pdf_descp+'"></td></tr>';
						//tabla_cab=tabla_cab+'<tr><td><label for="textfield"></labe></td><td><input type="hidden" class="txt_campo" name="cant_prod_1" id="cant_prod_1" value="0" ></td>';
						tabla_cab=tabla_cab+'</tr></table><br><br>';
					$('#tabla_cab_modif_productos').append(tabla_cab);
					
					$("#fec_proc_prod_1").datepicker({
						dateFormat: "dd/mm/yy"
					});
			/*****************************/ 
			/************se cargan los combobox*******************/
			
			//uno
					$.ajax({
							url:'router/ProductosRouter.php',
							dataType: 'json',
							type: 'POST',
							data : {
								accion:'cargarTipo'
							},
							beforeSend : function(){
								
							},
							success: function(resu){
								//console.log(resu);
								var tipo;
								$.each(resu, function(index, value){
									tipo=tipo+'<option select value="'+value.codigo+'">'+value.nombre+'</option>';
								
								});
								$('#tipo_producto_1').append(tipo);
							}
					});
					
					
					//dos
					$.ajax({
							url:'router/ProductosRouter.php',
							dataType: 'json',
							type: 'POST',
							data : {
								accion:'cargarProveedor'
							},
							beforeSend : function(){
								
							},
							success: function(resu){
								//console.log(resu);
								var prove;
								$.each(resu, function(index,values){
									prove = prove +'<option select value="'+values.cod_int+'">'+values.nom_prov+'</option>';
								});
								$('#provedor_producto_1').append(prove);
							}
					});
					
					//tres
					$.ajax({
							url:'router/ProductosRouter.php',
							dataType: 'json',
							type: 'POST',
							data : {
								accion:'cargarMedida'
							},
							beforeSend : function(){
							},
							success: function(resul){
								//console.log(resul);
								var med;
								$.each(resul, function(index,medida){
									med = med +'<option select value="'+medida.cod_medida+'">'+medida.nom_medida+'</option>';
								});
								$('#unidad_producto_1').append(med);
								$("#unidad_producto_1 option[value=" +res[0].alm_prod_cab_unidad+"]").attr("selected","selected") ;
							}
					});
					
					//cuatro
					$.ajax({
							url:'router/ProductosRouter.php',
							dataType: 'json',
							type: 'POST',
							data : {
								accion:'cargarMoneda'
							},
							beforeSend : function(){
							},
							success: function(result){
								//console.log(result);
								var mon;
								$.each(result, function(index,moneda){
									mon = mon +'<option select value="'+moneda.cod_moneda+'">'+moneda.nom_moneda+'</option>';
								});
								$('#moneda_producto_1').append(mon);
								$("#moneda_producto_1 option[value=" +res[0].alm_prod_cab_moneda+"]").attr("selected","selected") ;
								
							}
					});
					
					//cinco
					$.ajax({
							url:'router/ProductosRouter.php',
							dataType: 'json',
							type: 'POST',
							data : {
								accion:'cargarSucursalOrigen'
							},
							beforeSend : function(){
							},
							success: function(result){
								var age;
								$.each(result, function(index,agencia){
									age = age +'<option select value="'+agencia.cod_agencia+'">'+agencia.nom_agencia+'</option>';
								});
								$('#sucursal_origen_1').append(age);
								$("#sucursal_origen_1 option[value=" +res[0].alm_prod_cab_suc_origen+"]").attr("selected","selected") ;
							}
					});
	
				/****************DETALLE*************** */
					new Productos().detalleModificarProducto(codigo);
					//new.Productos().totalesDetalleModifProducto(codigo);
					
				}	
	   });
    }


	/**
	* Metodo Detalle modificar Producto
	*/

	this.detalleModificarProducto = function(codigo){
		//alert(codigo);
		$.ajax({
			url:'router/ProductosRouter.php',
			dataType: 'json',
			type: 'POST',
			data : {
				accion:'cargardetalleProducto',
				codigo:codigo
			},
			beforeSend : function(){
				//$('#formulario_detalle_productos').dialog("close");
				//$('#tabla_detalle').emtpy();
				//alert("antes de cagar");
				$('#tabla_det_modif_productos').empty();
			},
			success: function(resulta){
				//console.log(resulta);
				var det = '<table border="0" class="table_usuario" id="tabla_modif_detalle" >';
				    det = det + '<center><h2>MODIFICACION DETALLE PRODUCTO</h2></center>';
				    det = det + '<input type="button" name="btn_prod" id="btn_prod" class="btn_form" value="Nuevo Item" onclick="new Productos().ingresarDetalleModifProductos(\''+codigo+'\');">';
					det = det + '<tr class="tr_usuario"><th>N</th><th>FECHA INGR</th><th>SERIE</th><th>CANT</th><th>PU COMPRA</th><th>PU VENTA</th><th>PU MAX VENTA</th>';
					det = det + '<th>PU MIN VENTA</th><th>ESTADO</th><th>FECHA VENC.</th><th>LOTE</th><th>PART NUMBER</th><th>TC</th><th>MODIFICAR</th><th>ELIMINAR</th></tr>';		
				var num=0;
				$.each(resulta, function(index,deta){
						//console.log(deta);
						if (deta.tipo==1) {

							num++;
							det = det + '<tr><td>'+num+'</td><td>'+deta.alm_prod_cab_fec_ing+'</td><td>'+deta.alm_prod_det_serie+'</td><td>'+deta.alm_prod_det_cantidad+'</td>';
							det = det + '<td>'+deta.alm_prod_det_prec_compra+'</td><td>'+deta.alm_prod_det_prec_venta+'</td><td>'+deta.alm_prod_det_prec_max_venta+'</td><td>'+deta.alm_prod_det_prec_min_venta+'</td>';
							if (deta.alm_prod_det_estado==1) {
								det = det + '<td align="center"><img src="../img/checkmark_32x32.png" align="absmiddle"></td>';
							}else if (deta.alm_prod_det_estado==2) {
								det = det + '<td align="center"><img src="../img/close_32x32.png" align="absmiddle"></td>';
							}else if (deta.alm_prod_det_estado==3) {
								det = det + '<td align="center"><img src="../img/block_32x32.png" align="absmiddle"></td>';
							}else if (deta.alm_prod_det_estado==9) {
								det = det + '<td align="center"><img src="../img/down_32x32.png" align="absmiddle"></td>';
							}
							//det = det + '<td>'+deta.alm_prod_det_estado+'</td>';
							det = det + '<td>'+deta.alm_prod_det_fecha_venc+'</td><td>'+deta.alm_prod_det_lote+'</td><td>'+deta.alm_prod_det_part_number+'</td>';
							det = det + '<td>'+deta.alm_prod_det_tc+'</td><td align="center"><div style="cursor:pointer"><a  onClick="new Productos().modificarDetalleModifProductos(\''+codigo+'\',\''+deta.alm_prod_det_id_unico+'\',\''+deta.alm_prod_det_id+'\');" > <img src="../img/notepad_32x32.png" align="absmiddle"><br>Modificar</a></div></td>';
							det = det + '</td><td align="center"><div style="cursor:pointer"><a  onClick="new Productos().eliminarDetModifProducto(\''+codigo+'\',\''+deta.alm_prod_det_id_unico+'\',\''+deta.alm_prod_det_id+'\');" > <img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></div></td></tr>';
						}else if (deta.tipo==0) {
							num++;
							det = det + '<tr><td></td><td>'+deta.alm_prod_cab_fec_ing+'</td><td>'+deta.alm_prod_det_serie+'</td><td>'+deta.alm_prod_det_cantidad+'</td>';
							det = det + '<td>'+deta.alm_prod_det_prec_compra+'</td><td>'+deta.alm_prod_det_prec_venta+'</td><td>'+deta.alm_prod_det_prec_max_venta+'</td><td>'+deta.alm_prod_det_prec_min_venta+'</td>';
							det = det + '<td></td>';
							det = det + '<td>'+deta.alm_prod_det_fecha_venc+'</td><td>'+deta.alm_prod_det_lote+'</td><td>'+deta.alm_prod_det_part_number+'</td>';
							det = det + '<td>'+deta.alm_prod_det_tc+'</td><td align="center"><div style="cursor:pointer"></div></td>';
							det = det + '</td><td align="center"><div style="cursor:pointer"></div></td></tr>';

						}
						
				});
						det = det + '</table>';
						//det = det+'<br><div><center><input type="button" name="save_cab_mod" id="save_cab_mod" class="btn_form" value="Registrar Cambios" onclick="new Productos().grabarModificacionCabProdModif();">';
						//det = det+'<input type="button" name="delete_cab" id="delete_cab" class="btn_form" value="Cancelar" onclick="new Productos().cancelarmodifProducto();"></center></div>';
						//$('#tabla_carga_det_productos').append(det);
						$('#tabla_det_modif_productos').append(det);

						$.ajax({
							url:'router/ProductosRouter.php',
							dataType: 'json',
							type: 'POST',
							data : {
								accion:'cantidadTotalItem',
								codigo:codigo
							},
							beforeSend : function(){

								$('#tabla_total_det_modif_productos').empty();
							},
							success: function(resulta){

								//alert("cargando tabla total");
								//console.log(resulta.total);
			                    var total = '<table class="table_usuario">';
								if (resulta.total!=null) {
									total = total + '<tr><td><strong>Cantidad Total :</strong></td><td>'+resulta.total+'</td></tr>';
								}else{
									total = total + '<tr><td><strong>Cantidad Total :</strong></td><td>0</td></tr>';
							    }
							     
							    total = total + '</table><br>';
							    total = total+'<center><input type="button" name="save_cab_mod" id="save_cab_mod" class="btn_form" value="Registrar Cambios" onclick="new Productos().grabarModificacionCabProdModif();"><input type="button" name="delete_cab" id="delete_cab" class="btn_form" value="Cancelar" onclick="new Productos().cancelarmodifProducto();"></center>';
						        //total = total+'';
							   
							    //cab1 = cab1 + '</tr></table><br> <input type="button" name="btn_prod" id="btn_prod" class="btn_form" value="Nuevo Item" onclick="new Productos().ingresarDetalleProductos(\''+codigo+'\',\''+res[0].proveedor+'\');">';
							    $('#tabla_total_det_modif_productos').append(total);
							    $('#cant_prod_1').val(resulta.total);

							}
						});
			}
	    });

	    $("#formulario_modificar_productos").dialog({
				height: 750,
				width: 1024,
				modal: true,
				resizable: true,
				draggable: true,
				closeText: "hide"
	    });


	}

	/**
	* Metodo que graba ka cabecera de losproductos
	*/
	this.grabarModificacionCabeceraProductos = function(){
		//alert("modf");
		//alert($('#img_1').val());
	$.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'modificarCabecera',
					cod_ref:$('#cod_ref_cab_1').val(),
					tipo:$('#tipo_mod_1').val(),
					prov:$('#prov_mod_1').val(),
					nom:$('#nom_prod_1').val(),
					desc:$('#desc_prod_1').val(),
					cantidad:$('#cant_prod_1').val(),
					fech_proce:$('#fec_proc_prod_1').val(),
					unidad:$('#unid_mod_1').val(),
					moneda:$('#mon_mod_1').val(),
					prest:$('#prest_prod_1').val(),
					suc_org:$('#suc_mod_1').val(),
					imag:$('#img_1').val(),
					dat_tec:$('#dat_tec_1').val(),
					codigo:$('#codigo_1').val(),
					numerico:$('#numerico').val(),
					unico:$('#unico_1').val(),
					marca:$('#marca_prod_1').val()
					/**/
				},
				success: function(res){
				//	como esta en alta
				// otro
				//console.log(res);
				if (res.completo==true){
						//console.log("gravo");
					//console.log(res.alm_prod_cab_id_unico_prod);
						new Productos().listarCabeceraProductosexistentes(res.alm_prod_cab_id_unico_prod);
						
					}else{
					//	console.log("no gravo mod");
						//new Productos().listarCabeceraProductosexistentes(res.alm_prod_cab_id_unico_prod);
					}
				}
		});
	}

		/**
	* Metodo que graba ka cabecera de losproductos
	*/
	this.grabarModificacionCabProdModif = function(){
		var util = new Utilitarios();
		if($('#img_1').val()!=""){
			if($('#dat_tec_1').val()!=""){
				// Esta parte es para cuando se envia las dos imagenes a guardar para modificar
				var formData = new FormData();
				formData.append('img_produc', $('#img_1')[0].files[0]);
				formData.append('dat_tec', $('#dat_tec_1')[0].files[0]);
				formData.append('codigo', $('#codigo_1').val());
				formData.append('cod_ref', $('#cod_ref_cab_1').val());
				formData.append('unico', $('#unico_1').val());
				formData.append('tipo', $('#tipo_mod').val());
				formData.append('prov',$('#prov_mod_1').val());
				formData.append('nom',$('#nom_prod_1').val());
				formData.append('desc',$('#desc_prod_1').val());
				formData.append('cantidad',$('#cant_prod_1').val());
				formData.append('fech_proce',$('#fec_proc_prod_1').val());
				formData.append('unidad',$('#unidad_producto_1').val());
				formData.append('moneda',$('#moneda_producto_1').val());
				formData.append('prest',$('#prest_prod_1').val());
				formData.append('suc_org',$('#sucursal_origen_1').val());
				formData.append('marca',$('#marca_prod_1').val());
				formData.append('num',$('#numerico').val());
				formData.append('accion', 'modificarProductoWithImgDet');
				$.ajax({
					url:'router/ProductosRouter.php',
					type:'POST',
					data: formData,
					processData:false,
					contentType:false,
					cache: false,
					beforeSend:function(data){
						if(data && data.overrideMimeType) {
							data.overrideMimeType("application/json;charset=UTF-8");
						}
					},
					success: function(data){
						if(data.completo){
							//console.log(data);
							new Productos().listarCabeceraProductosexistentes(data.alm_prod_cab_id_unico_prod); ////////////////////////////////
							$('#formulario_modificar_productos').dialog('close'); 
							util.mostrarMensajeAlerta(3, 'Se modifico correctamente el Producto', 'Confirmacion Producto');
							//new Productos().listaGeneralProductos();
						}
					}
			    });
			}else{
				// aqui es cuando la imagen no esta vacio y el detalle si
				var formData = new FormData();
				formData.append('img_produc', $('#img_1')[0].files[0]);
				formData.append('dat_tec', $('#dat_tec_1')[0].files[0]);
				formData.append('codigo', $('#codigo_1').val());
				formData.append('cod_ref', $('#cod_ref_cab_1').val());
				formData.append('unico', $('#unico_1').val());
				formData.append('tipo', $('#tipo_mod').val());
				formData.append('prov',$('#prov_mod_1').val());
				formData.append('nom',$('#nom_prod_1').val());
				formData.append('desc',$('#desc_prod_1').val());
				formData.append('cantidad',$('#cant_prod_1').val());
				formData.append('fech_proce',$('#fec_proc_prod_1').val());
				formData.append('unidad',$('#unidad_producto_1').val());
				formData.append('moneda',$('#moneda_producto_1').val());
				formData.append('prest',$('#prest_prod_1').val());
				formData.append('suc_org',$('#sucursal_origen_1').val());
				formData.append('marca',$('#marca_prod_1').val());
				formData.append('num',$('#numerico').val());
				formData.append('accion', 'modificarProductoWithImgDet');
				$.ajax({
					url:'router/ProductosRouter.php',
					type:'POST',
					data: formData,
					processData:false,
					contentType:false,
					cache: false,
					beforeSend:function(data){
						if(data && data.overrideMimeType) {
							data.overrideMimeType("application/json;charset=UTF-8");
						}
					},
					success: function(data){
						if(data.completo){
							//console.log(data);
							new Productos().listarCabeceraProductosexistentes(data.alm_prod_cab_id_unico_prod); ////////////////////////////////
							$('#formulario_modificar_productos').dialog('close'); 
							util.mostrarMensajeAlerta(3, 'Se modifico correctamente el Producto', 'Confirmacion Producto');
							//new Productos().listaGeneralProductos();
						}
					}
			    });
			}
		}else{
			//alert($('#img_1').val());
			if($('#dat_tec_1').val()!=""){
				// esta parte es cuando la imagen esta vacio  pero el detalle no
				var formData = new FormData();
				formData.append('img_produc', $('#img_1')[0].files[0]);
				formData.append('dat_tec', $('#dat_tec_1')[0].files[0]);
				formData.append('codigo', $('#codigo_1').val());
				formData.append('cod_ref', $('#cod_ref_cab_1').val());
				formData.append('unico', $('#unico_1').val());
				formData.append('tipo', $('#tipo_mod').val());
				formData.append('prov',$('#prov_mod_1').val());
				formData.append('nom',$('#nom_prod_1').val());
				formData.append('desc',$('#desc_prod_1').val());
				formData.append('cantidad',$('#cant_prod_1').val());
				formData.append('fech_proce',$('#fec_proc_prod_1').val());
				formData.append('unidad',$('#unidad_producto_1').val());
				formData.append('moneda',$('#moneda_producto_1').val());
				formData.append('prest',$('#prest_prod_1').val());
				formData.append('suc_org',$('#sucursal_origen_1').val());
				formData.append('marca',$('#marca_prod_1').val());
				formData.append('num',$('#numerico').val());
				formData.append('accion', 'modificarProductoWithImgDet');
				$.ajax({
					url:'router/ProductosRouter.php',
					type:'POST',
					data: formData,
					processData:false,
					contentType:false,
					cache: false,
					beforeSend:function(data){
						if(data && data.overrideMimeType) {
							data.overrideMimeType("application/json;charset=UTF-8");
						}
					},
					success: function(data){
						if(data.completo){
							//console.log(data);
							new Productos().listarCabeceraProductosexistentes(data.alm_prod_cab_id_unico_prod); ////////////////////////////////
							$('#formulario_modificar_productos').dialog('close'); 
							util.mostrarMensajeAlerta(3, 'Se modifico correctamente el Producto', 'Confirmacion Producto');
							//new Productos().listaGeneralProductos();
						}
					}
			    }); 
			}else{
				// Esto es cuando los dos estan vacios
				$.ajax({			
				    url:'router/ProductosRouter.php',
					dataType: 'json',
					type: 'POST',
					data : { 
						accion : 'modificarCabeceraModif',
						cod_ref:$('#cod_ref_cab_1').val(),
						tipo:$('#tipo_mod_1').val(),
						prov:$('#prov_mod_1').val(),
						nom:$('#nom_prod_1').val(),
						desc:$('#desc_prod_1').val(),
						cantidad:$('#cant_prod_1').val(),
						fech_proce:$('#fec_proc_prod_1').val(),
						unidad:$('#unidad_producto_1').val(),
						moneda:$('#moneda_producto_1').val(),
						prest:$('#prest_prod_1').val(),
						suc_org:$('#sucursal_origen_1').val(),
						codigo:$('#codigo_1').val(),
						numerico:$('#numerico').val(),
						unico:$('#unico_1').val(),
						marca:$('#marca_prod_1').val()
					},
					success: function(res){
						if (res.completo==true){
							$('#formulario_modificar_productos').dialog('close'); 
							util.mostrarMensajeAlerta(3, 'Se modifico correctamente el Producto', 'Confirmacion Producto');
							new Productos().listaGeneralProductos();
						}
					}
				});
			}
		}
	}
	/**
	*  Metodo el cual crea el formulario tpl para modificar y eliminar el detalle de los productos
	*/
	
	this.formularioModificarEliminarDetalleProductos_tpl = function(){
		//$("#formulario_detalle_upd_del_productos").empty();	

		var formu = '<div id="formulario_detalle_upd_del_productos" title="Alta Detalle Productos" style="display:none; width: 300px;" >';
			formu = formu + '<div id="tabla_upd_del_detalle_productos" >';
			formu = formu + '</div>';
			formu = formu + '</div>';
		$('body').append(formu);
			
	}

/**
	* Metodo que graba ka cabecera de losproductos
	*/
	this.modificarDetalleProductos = function(codCab,codigo,id){
			//$("#formulario_detalle_upd_del_productos").empty();
					
			$.ajax({
						url:'router/ProductosRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion:'cargarDetallePaModificar',
							codigo:codigo,
							id:id,
							codCab:codCab
						},
						beforeSend : function(){
							//$("#formulario_detalle_upd_del_productos").dialog("close");
							//$("#formulario_detalle_upd_del_productos").empty();	
						},
						success: function(resul){
								//console.log(resul.todo[0].todo);
								//console.log(resul.todo[0].alm_prod_cab_fec_ing);
								//console.log(resul[0].alm_prod_det_prec_compra);	

								 new Productos().formularioModificarEliminarDetalleProductos_tpl();
								//$('#tpl_alm_form_nuevo_egreso h3').empty();
								$('#tabla_upd_del_detalle_productos').empty();
		                     var detalle = '<center><h2><strong>MODIFICAR DATOS ITEM</strong></H2></center>';
		                     	 detalle = detalle + '<center><strong><h2><label for="textfield">Codigo Producto :</label><label for="textfield">'+resul.todo[0].todo+'</label></h2></strong></center>';
								 detalle = detalle +'<input type="hidden" class="txt_campo"  name="cod_cab_detalle" id="cod_cab_detalle" value="'+codigo+'">';
								 detalle = detalle +'<table  border="0" align="center">';
								 detalle = detalle + '<tr><td><label for="textfield">Serie :</label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="serie_me" id="serie_me" value="'+resul.todo[0].alm_prod_det_serie+'"></td>';
								 detalle = detalle + '<td><label for="textfield">Fecha Ingreso :</label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="fech_ingreso_me" id="fech_ingreso_me" value="'+resul.todo[0].alm_prod_cab_fec_ing+'"></td></tr>';
								 detalle = detalle + '<tr><td><label for="textfield">Cantidad :</label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="cant_prod_deta_me" id="cant_prod_deta_me" value="'+resul.todo[0].alm_prod_det_cantidad+'"></td>';
								 detalle = detalle + '<td><label for="textfield">Estado :</label></td>';
								 detalle = detalle + '<td><select name="estado_producto_me" id="estado_producto_me" size="1" size="10">value="'+resul.todo[0].alm_prod_det_estado+'"</select></td></tr>';
								 detalle = detalle + '<tr><td><label for="textfield">Precio Compra :</label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_c_me" id="p_c_me" value="'+resul.todo[0].alm_prod_det_prec_compra+'"></td>';
								 detalle = detalle + '<td><label for="textfield"> Precio Venta:</label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="p_v_me" id="p_v_me" onchange="new Productos().calculaPorcentaje();" value="'+resul.todo[0].alm_prod_det_prec_venta+'"></td></tr>';
								 detalle = detalle + '<tr><td><label for="textfield">Precio Min Venta :</label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_min_v_me" id="p_min_v_me" value="'+resul.todo[0].alm_prod_det_prec_min_venta+'" readonly></td>';
								 detalle = detalle + ' <td><label for="textfield">Precio Max Venta</label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_max_v_me" id="p_max_v_me" value="'+resul.todo[0].alm_prod_det_prec_max_venta+'" readonly></td></tr>';
								 detalle = detalle + '<tr><td><label for="textfield">Fecha Vencimiento :</label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="fech_venc_me" id="fech_venc_me" value="'+resul.todo[0].alm_prod_det_fecha_venc+'"></td>';
								 detalle = detalle + '<td><label for="textfield">Part Number :</label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="part_number_me" id="part_number_me" value="'+resul.todo[0].alm_prod_det_part_number+'"></td></tr>';
								 detalle = detalle + '<tr><td><label for="textfield">Tipo Cambio :</label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="t_c_me" id="t_c_me" value="'+resul.todo[0].alm_prod_det_tc+'"></td>';
								 detalle = detalle + ' <td><label for="textfield">Lote :</label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="lot_me" id="lot_me" value="'+resul.todo[0].alm_prod_det_lote+'"></td></tr>';
								 detalle = detalle + '</table>';
								 detalle = detalle + '<br><div><center><input type="button" name="det_mod" id="det_mod" class="btn_form" value="Modificar" onclick="new Productos().updateDetalleProductos(\''+codCab+'\',\''+codigo+'\',\''+resul.todo[0].alm_prod_det_id+'\');"><input type="button" name="det_cancel" id="det_cancel" class="btn_form" value="Cancelar" onclick="new Productos().cancelarItemDetProducto();"></center></div>';
								
								$('#tabla_upd_del_detalle_productos').append(detalle);
								
								//seis
										$.ajax({
												url:'router/ProductosRouter.php',
												dataType: 'json',
												type: 'POST',
												data : {
													accion:'cargarEstado'
												},
												beforeSend : function(){
													//$("#formulario_cab_det_productos").dialog("close");
												},
												success: function(resulta){
													var est;
													$.each(resulta, function(index,estado){
														est = est +'<option select value="'+estado.cod_estado+'">'+estado.nom_estado+'</option>';
													});
													$('#estado_producto_me').append(est);
													
												}
										});
										
								/*****************************/
								$("#fech_ingreso_me").datepicker({
									dateFormat: "dd/mm/yy"
								});
								$("#fech_venc_me").datepicker({
									dateFormat: "dd/mm/yy"
								});
								
								$("#formulario_detalle_upd_del_productos").dialog({
												height: 450,
												width: 850,
												modal: true,
												resizable: true,
												draggable: true,
												closeText: "hide"
											});
								/**/
						}
			});
			
											
			
       
	}

	/**
	* Metodo que graba ka cabecera de losproductos desde modificar
	*/
	this.modificarDetalleModifProductos = function(codCab,codigo,id){

		//alert(codCab+"--"+codigo+"--"+id);
		//$("#formulario_detalle_upd_del_productos").empty();
					
			$.ajax({
						url:'router/ProductosRouter.php',
						dataType: 'json',
						type: 'POST',
						data : {
							accion:'cargarDetallePaModificar2',
							codigo:codigo,
							id:id
						},
						beforeSend : function(){
							//$("#formulario_detalle_upd_del_productos").dialog("close");
							//$("#formulario_detalle_upd_del_productos").empty();	
						},
						success: function(resul){
								//console.log(resul);							
								 new Productos().formularioModificarEliminarDetalleProductos_tpl();
								//$('#tpl_alm_form_nuevo_egreso h3').empty();
								$('#tabla_upd_del_detalle_productos').empty();
		                     var detalle = '<center><h2><strong>MODIFICAR DATOS ITEM</strong></H2><h2><strong>'+resul[0].codigo_producto+'</strong></h2></center>';
								 detalle = detalle +'<input type="hidden" class="txt_campo"  name="cod_cab_detalle" id="cod_cab_detalle" value="'+codigo+'">';
								 detalle = detalle +'<table  border="0" align="center">';
								 detalle = detalle + '<tr><td><label for="textfield"><strong>Serie :</strong></label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="serie_me" id="serie_me" value="'+resul[0].alm_prod_det_serie+'"></td>';
								 detalle = detalle + '<td><label for="textfield"><strong>Part Number :</strong></label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="part_number_me" id="part_number_me" value="'+resul[0].alm_prod_det_part_number+'"></td></tr>';
								 detalle = detalle + '<tr><td><label for="textfield"><strong>Fecha Ingreso :</strong></label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="fech_ingreso_me" id="fech_ingreso_me" value="'+resul[0].alm_prod_cab_fec_ing+'"></td>';
								 detalle = detalle + '<td><label for="textfield"><strong>Tipo Cambio :</strong></label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="t_c_me" id="t_c_me" value="'+resul[0].alm_prod_det_tc+'"></td></tr>';
								 detalle = detalle + '<tr><td><label for="textfield"><strong>Cantidad :</strong></label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="cant_prod_deta_me" id="cant_prod_deta_me" value="'+resul[0].alm_prod_det_cantidad+'"></td>';
								 detalle = detalle + '<td><label for="textfield"><strong>Estado :</strong></label></td>';
								 detalle = detalle + '<td><select name="estado_producto_me" id="estado_producto_me" size="1" size="10">value="'+resul[0].alm_prod_det_estado+'"</select></td></tr>';	 
								 detalle = detalle + '<tr><td><label for="textfield"><strong>Precio Compra :</strong></label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_c_me" id="p_c_me" value="'+resul[0].alm_prod_det_prec_compra+'"></td>';
								 detalle = detalle + '<td><label for="textfield"><strong>Precio Venta:</strong></label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="p_v_me" id="p_v_me" onchange="new Productos().calculaPorcentaje();" value="'+resul[0].alm_prod_det_prec_venta+'"></td></tr>';	 
								 detalle = detalle + '<tr><td><label for="textfield"><strong>Fecha Vencimiento :</strong></label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="fech_venc_me" id="fech_venc_me" value="'+resul[0].alm_prod_det_fecha_venc+'"></td>';
								 detalle = detalle + '<td><label for="textfield"><strong>Precio Min Venta :</strong></label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_min_v_me" id="p_min_v_me" value="'+resul[0].alm_prod_det_prec_min_venta+'" readonly></td></tr>';	 
								 detalle = detalle + '<tr><td><label for="textfield"><strong>Lote :</strong></label></td>';
								 detalle = detalle + '<td><input type="text" class="txt_campo" name="lot_me" id="lot_me" value="'+resul[0].alm_prod_det_lote+'"></td>';
								 detalle = detalle + '<td><label for="textfield"><strong>Precio Max Venta</strong></label></td>';
								 detalle = detalle + '<td><input type="number" class="txt_campo" name="p_max_v_me" id="p_max_v_me" value="'+resul[0].alm_prod_det_prec_max_venta+'" readonly></td></tr>';
								 detalle = detalle + '</table>';
								 detalle = detalle + '<br><div><center><input type="button" name="det_mod" id="det_mod" class="btn_form" value="Modificar" onclick="new Productos().updateDetalleModifProductos(\''+codCab+'\',\''+codigo+'\',\''+resul[0].alm_prod_det_id+'\');"><input type="button" name="det_cancel" id="det_cancel" class="btn_form" value="Cancelar" onclick="new Productos().cancelarItemDetProducto();"></center></div>';
								 
								$('#tabla_upd_del_detalle_productos').append(detalle);
								
								//seis
										$.ajax({
												url:'router/ProductosRouter.php',
												dataType: 'json',
												type: 'POST',
												data : {
													accion:'cargarEstado'
												},
												beforeSend : function(){
													//$("#formulario_cab_det_productos").dialog("close");
												},
												success: function(resulta){
													var est;
													$.each(resulta, function(index,estado){
														est = est +'<option select value="'+estado.cod_estado+'">'+estado.nom_estado+'</option>';

													});
													$('#estado_producto_me').append(est);
													$("#estado_producto_me option[value=" +resul[0].alm_prod_det_estado+"]").attr("selected","selected") ;
													
												}
										});
										
								/*****************************/
								$("#fech_ingreso_me").datepicker({
									dateFormat: "dd/mm/yy"
								});
								$("#fech_venc_me").datepicker({
									dateFormat: "dd/mm/yy"
								});
								
								$("#formulario_detalle_upd_del_productos").dialog({
												height: 450,
												width: 850,
												modal: true,
												resizable: true,
												draggable: true,
												closeText: "hide"
											});
								/**/
						}
			});
			
											
			
       
	}
	
/**
		 * Metodo q redirecciona al formulario principal
		 */
	this.deleterDetalleProductos = function(codigo,id){
		//alert(codigo+'--'+id);
		
		$.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'deleteDetalleProductos',
					codigo:codigo,
					id:id
				},
				success: function(res){
					//console.log(res.alm_prod_cab_id_unico_orden_compra);
					if (res.completo==true){
						//console.log("gravo");
						
						
					}else{
						console.log("no gravo");
						
					}
				}
		});
	}
	
	/**
		 * Metodo q redirecciona al formulario principal
		 */
	this.updateDetalleProductos = function(codCab,codigo,id){
		
		//console.log($("#estado_producto_me").val());

		//console.log(codigo);
		$.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'updateDetalleProducto',
					codigo:codigo,
					id:id,
					fech_ingreso_me: $("#fech_ingreso_me").val(),
					serie_me: $("#serie_me").val(),
					//marka_me: $("#marka_me").val(),
					cant_prod_deta_me: $("#cant_prod_deta_me").val(),
					estado_producto_me: $("#estado_producto_me").val(),
					p_c_me: $("#p_c_me").val(),
					p_v_me: $("#p_v_me").val(),
					p_min_v_me: $("#p_min_v_me").val(),
					p_max_v_me: $("#p_max_v_me").val(),
					fech_venc_me: $("#fech_venc_me").val(),
					part_number_me: $("#part_number_me").val(),
					t_c_me: $("#t_c_me").val(),
					lot_me: $("#lot_me").val()
				},
				success: function(res){


					console.log(res);
					if (res.completo==true){
						console.log(codCab);
						$("#formulario_detalle_upd_del_productos").dialog("close");
						new Productos().listarDetalleProductos(codCab);
						new Productos().totalesDetalleProducto(codCab);	
						
						
					}else{
						console.log("no gravo");
						
					}
				}
		});
	}

		/**
		 * Metodo q redirecciona al formulario principal desde modificar producto
		 */
	this.updateDetalleModifProductos = function(codCab,codigo,id){
		console.log(codigo);
		$.ajax({			
			    url:'router/ProductosRouter.php',
				dataType: 'json',
				type: 'POST',
				data : { 
					accion : 'updateDetalleProducto',
					codigo:codigo,
					id:id,
					fech_ingreso_me: $("#fech_ingreso_me").val(),
					serie_me: $("#serie_me").val(),
					//marka_me: $("#marka_me").val(),
					cant_prod_deta_me: $("#cant_prod_deta_me").val(),
					estado_producto_me: $("#estado_producto_me").val(),
					p_c_me: $("#p_c_me").val(),
					p_v_me: $("#p_v_me").val(),
					p_min_v_me: $("#p_min_v_me").val(),
					p_max_v_me: $("#p_max_v_me").val(),
					fech_venc_me: $("#fech_venc_me").val(),
					part_number_me: $("#part_number_me").val(),
					t_c_me: $("#t_c_me").val(),
					lot_me: $("#lot_me").val()
				},
				success: function(res){
					///console.log(res.alm_prod_cab_id_unico_orden_compra);
					if (res.completo==true){
						//console.log(codCab);
						$("#formulario_detalle_upd_del_productos").dialog("close");
						new Productos().detalleModificarProducto(codCab);
						
						
					}else{
						console.log("no gravo");
						
					}
				}
		});
	}

		 /**
		 * Metodo q cierra el dialogo de alta cabecera
		 */
	this.TerminarDetProducto = function(){
		
		
		//alert("jajaja");
		//$(location).attr('href', 'prod_gest.php');
		//$("#formulario_detalle_upd_del_productos").dialog("close");
		//formulario_detalle_upd_del_productos
		//$("#formulario_detalle_upd_del_productos").empty();
		$('#formulario_insertar_productos').dialog('close'); // hace que se cierre el dialog
	}


	   /**
		 * Metodo q cierra el dialogo de alta cabecera
		 */
	this.TerminarDetProducto = function(){
		//this.cancelarItemDetProducto = function(){
		
		//alert("jajaja");
		//$(location).attr('href', 'prod_gest.php');
		//$("#formulario_detalle_upd_del_productos").dialog("close");
		//formulario_detalle_upd_del_productos
		//$("#formulario_detalle_upd_del_productos").empty();
		$('#formulario_insertar_productos').dialog('close'); // hace que se cierre el dialog
	}

	/**
	 * Metodo q cierra el dialogo de alta cabecera 
	 */
	this.cancelarDetProducto = function(){
		$('#formulario_detalle_productos').dialog('close'); // hace que se cierre el dialog
	}

   /**
	 * Metodo q cierra el dialogo de alta cabecera TerminarDetProducto
	 */
	this.cancelarmodifProducto = function(){
		$('#formulario_modificar_productos').dialog('close'); // hace que se cierre el dialog
	}

	/**
	 * Metodo q cierra el dialogo de alta cabecera TerminarDetProducto
	 */
	this.cancelarDetModifProducto = function(){
		$('#formulario_nuevo_item_detalle').dialog('close'); // hace que se cierre el dialog
	}
}