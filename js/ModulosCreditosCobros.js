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
	$('#menu_modulo_creditos_cobros').click(function(){
		$(location).attr('href', 'modulo.php?modulo=4000');
	});

	//hoja de cobro
	$('#menu_modulo_creditos_hojacobro').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//hoja de cobros existe mas submenues
			//por nombre de grupo
			$('#menu_modulo_creditos_hojacobro_grupo').click(function(){
				$(location).attr('href', 'cred_cobros_2.php?menu=2');
			});
			//por nombre de cliente
			$('#menu_modulo_creditos_hojacobro_cliente').click(function(){
				$(location).attr('href', 'solic_mante.php');
			});
			//por numero de operacion
			$('#menu_modulo_creditos_hojacobro_numero').click(function(){
				$(location).attr('href', 'solic_mante.php');
			});
	


	//proximos vencimientos
	$('#menu_modulo_creditos_proxven').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//vencimiento final
	$('#menu_modulo_creditos_venfinal').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//detalle mora
	$('#menu_modulo_creditos_detallemora').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//detalle mora por asesor
	$('#menu_modulo_creditos_detalleasesor').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});


	
});