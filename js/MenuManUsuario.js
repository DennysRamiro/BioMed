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
	$('#menu_modulo_general').click(function(){
		$(location).attr('href', 'modulo.php?modulo=1000');
	});
	//modulo mantenimiento de usuarios
	$('#menu_modulo_mante_usuarios').click(function(){
		$(location).attr('href', 'gral_man_usr.php');
	});
	$('#menu_modulo_mante_usuarios_alta').click(function(){
		$(location).attr('href', 'gral_man_usr_a.php');
	});
	//modulo verifica debe haber
	$('#menu_modulo_ver_debe_haber').click(function(){
		$(location).attr('href', 'verif_debhab.php');
	});
});