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
	$('#menu_modulo_cartera').click(function(){
		$(location).attr('href', 'modulo.php?modulo=6000');
	});

	$('#menu_modulo_cartera_cancelados').click(function(){
		$(location).attr('href', 'cred_cobros_3.php');
	});
	$('#menu_modulo_cartera_procesofindemes').click(function(){
		$(location).attr('href', 'cart_fin_mes.php');
	});
	$('#menu_modulo_cartera_resumenCartera').click(function(){
		$(location).attr('href', 'cart_reportes.php');
	});
	
});