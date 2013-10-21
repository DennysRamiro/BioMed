var banderColapsable = 0;
$(document).on('ready', function(){
	$( "#fecha_vencimiento" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});
	$('#btn_colapsable').click(function(){
		if(banderColapsable == 0){
			banderColapsable = 1;
			$(this).animate({
				"height":"-50px"
			}, 500);
			$('#btn_colapsable').animate({
				"margin-left":"180px"

			});
		}else{
			banderColapsable = 0;
			$(this).animate({
				"height":"50px"
			}, 500);
			$('#btn_colapsable').animate({
				"margin-left":"-5px",
				"padding-left":"5px",
				"height":"32px",
				"color":"#FFF"
			});
		}
		
	});
	$('#tipo_producto').change(function(){
		if($('#tipo_producto').val() == 135){
			$('#serie_color').attr('color','#000');
			$('#serie_cliente').removeAttr('required');
			$('#error_serie_cliente').remove();
			$('#fecha_vencimiento').attr('required', 'required');
			$('#color_fecha_ven').attr('color','#990033');
			util.validarCampo('fecha_vencimiento', 'error_fecha_vencimiento', 'El campo <b>Fecha de Vencimiento</b> no puede estar vacio.');
			$('#lote_producto').attr('required', 'required');
			$('#id_lote_color').attr('color','#990033');
			$('#campo_lote_td').append('<div id="error_lote_producto"></div>');
			util.validarCampo('lote_producto', 'error_lote_producto', 'El campo <b>Lote</b> no puede estar vacio.');
		}else{
			$('#serie_color').attr('color','#990033');
			$('#serie_cliente').attr('required', 'required');
			$('#id_serie_td').append('<div id="error_serie_cliente"></div>');
			$('#color_fecha_ven').attr('color','#000');
			$('#fecha_vencimiento').removeAttr('required');
			$('#error_fecha_vencimiento').remove();
			$('#id_lote_color').attr('color','#000');
			$('#lote_producto').removeAttr('required');
			$('#error_lote_producto').remove();
		}
	});
	$('#menu_modulo').click(function(){
		$(location).attr('href','menu_s.php');
	});
	$('#menu_modulo_general_alamacen').click(function(){
		$(location).attr('href', 'modulo.php?modulo=20000')
	});
	$('#menu_modulo_mante_productos').click(function(){
		$(location).attr('href', 'alm_producto.php')
	});
	$('#menu_alta_prod').click(function(){
		$(location).attr('href', 'alm_alta_prod.php')
	});
	$('#error_nombre_producto').hide();
	var util = new Utilitarios();
	util.validarCampo('nombre_producto', 'error_nombre_producto', 'El campo <b>Nombre de producto</b> no puede estar vacio.');
	util.validarCampo('descripcion_producto', 'error_descripcion_producto', 'El campo <b>Descripcion de producto </b> no puede estar vacio.');
	util.validarCampo('serie_cliente','error_serie_cliente', 'El campo <b>Serie</b> no puede estar vacio.');
	util.validarCampo('cantidad_stock','error_cantidad_stock', 'El campo <b>Cantidad Stock</b> no puede estar vacio.');
	util.validarCampo('presentacion_producto','error_presentacion', 'El campo <b>Presentaci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('precio_compra','error_precio_compra', 'El campo <b>Precio de Compra</b> no puede estar vacio.');
	util.validarCampo('tipo_cambio','error_tipo_cambio', 'El campo <b>Tipo de Cambio</b> no puede estar vacio.');
	util.validarCampo('valor_contable','error_valor_contable', 'El campo <b>Valor Contable</b> no puede estar vacio.');
	//util.validarCampo('lote_producto','error_lote_producto', 'El campo <b>Lote Producto</b> no puede estar vacio.');
	util.validarCampo('precio_venta','error_precio_venta', 'El campo <b>Precio Venta</b> no puede estar vacio.');
	util.validarCampo('tipo_cambio','error_tipo_cambio', 'El campo <b>Tipo de Cambio</b> no puede estar vacio.');

});
function mostrarDialogo(){
	//alert("producto");
	 $( "#dialog-confirm" ).dialog({
			resizable: false,
			height:250,
			width:400,
			modal: true,
			buttons: {
				"Confirmar": function() {
					//$( this ).dialog( "close" );
					$.ajax({
						url:'alm_eliminar_prod.php?tp=eliminarProd&idPrducto='+$('#id_producto_almacen').val(),
						dataType:'json',
						type:'GET',
						success:function(res){
							if(res.completo == true){
								$(location).attr('href', 'alm_consulta_prod.php?msg=3');
							}
						}
					});
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
	});
}

function regresarLista(){
	$(location).attr('href', 'alm_consulta_prod.php');
}
