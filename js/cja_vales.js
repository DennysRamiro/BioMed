var banderColapsable = 0;
$(document).on('ready', function(){
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
				"color":"#000"
			});
		}
		
	});
	$('#menu_modulo').click(function(){
		$(location).attr('href','menu_s.php');
	});
		//modulo cajas
	$('#menu_modulo_general_cajas').click(function(){
		$(location).attr('href', 'modulo.php?modulo=10000');
	});
		//modulo compra vent divisasa
	$('#menu_modulo_vale_moneda').click(function(){
		$(location).attr('href', 'vale_mante.php');
	});
	var util = new Utilitarios();
	util.validarCampo('descrip','error_descrip', 'El campo <b>Descrici&oacute;n</b> no puede estar vacio.');
//	util.validarCampo('nro_nit', 'error_nro_nit', 'El campo <b>NIT Cliente</b> no puede estar vacio.');
	util.validarCampo('monto','error_monto', 'El campo <b>Monto</b> no puede estar vacio.');
console.log(util);
});