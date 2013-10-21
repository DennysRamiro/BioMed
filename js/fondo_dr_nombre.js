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
	$('#menu_modulo_fondo').click(function(){
		$(location).attr('href', 'modulo.php?modulo=11000');
	});

	$('#menu_modulo_fondo_dep_ret').click(function(){
		$(location).attr('href', 'fgar_tran.php');
	});
	$('#menu_modulo_fondo_dep_ret_nomgroup').click(function(){
		$(location).attr('href', 'grupo_con_cob.php?menu=2');
	});
});



