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
	$('#menu_modulo_creditos_infocred').click(function(){
		$(location).attr('href', 'cred_infocre.php');
	});

	//validacion de nombres
	$('#menu_modulo_creditos_infocred_validacion').click(function(){
		$(location).attr('href', 'cred_infocre.php');
	});

	//datos infocred vig-ven.eje
	$('#menu_modulo_creditos_infocred_datos').click(function(){
		$(location).attr('href', 'cred_infocre.php');
	});
	//dato infocred castigados
	$('#menu_modulo_creditos_infocred_castigados').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	//exportar a excel
	$('#menu_modulo_creditos_infocred_export').click(function(){
		$(location).attr('href', 'solic_mante.php');
	});
	
});