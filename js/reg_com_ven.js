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
	$('#menu_modulo_divisas').click(function(){
		$(location).attr('href', 'cja_com_ven.php');
	});

	$('#menu_modulo_divisas_com_dol').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=5');
	});

	$('#menu_modulo_divisas_ven_dol').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=6');
	});
	
	
	var util = new Utilitarios();
	util.validarCampo('tc_esp','error_tc_esp', 'El campo <b>Tipo de Cambio Especial</b> no puede estar vacio.');
	util.validarCampo('des', 'error_des', 'El campo <b>Descripci&oacute;</b> no puede estar vacio.');
	util.validarCampo('monto','error_monto', 'El campo <b>Monto en Dolares</b> no puede estar vacio.');
console.log(util);
});