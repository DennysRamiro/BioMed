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
	$('#menu_modulo_contabilidad').click(function(){
		$(location).attr('href', 'modulo.php?modulo=8000');
	});

	$('#menu_modulo_cont_mant_plan').click(function(){
		$(location).attr('href', 'con_mant_plan.php');
	});
	$('#menu_modulo_cont_mant_plan_modif').click(function(){
		$(location).attr('href', 'con_retro.php?accion=12');
	});
	$('#menu_modulo_cont_mant_plan_modif_grab').click(function(){
		$(location).attr('href', 'con_retro.php?accion=12');
	});
	
});



