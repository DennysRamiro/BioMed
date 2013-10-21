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
	$('#menu_modulo_creditos').click(function(){
		$(location).attr('href', 'modulo.php?modulo=4000');
	});

	//alta
	$('#menu_modulo_creditos_alta').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//modificar
	$('#menu_modulo_creditos_modificar').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//consultar
	$('#menu_modulo_creditos_consultar').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//plan de pagos
	$('#menu_modulo_creditos_pagos').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//boleta de cobro
	$('#menu_modulo_creditos_boleta').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//reversion solicitud
	$('#menu_modulo_creditos_reversionsolicitud').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//reversion estado
	$('#menu_modulo_creditos_reversionestado').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});

	
});