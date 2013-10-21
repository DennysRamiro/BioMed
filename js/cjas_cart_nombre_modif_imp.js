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
	$('#menu_modulo_cjas').click(function(){
		$(location).attr('href', 'modulo.php?modulo=10000');
	});

	$('#menu_modulo_cjas_cart').click(function(){
		$(location).attr('href', 'cart_cobros.php');
	});
	$('#menu_modulo_cjas_cart_dir').click(function(){
		$(location).attr('href', 'cred_cobros_2.php?menu=3');
	});
	$('#menu_modulo_cjas_cart_dir_nomgroup').click(function(){
		$(location).attr('href', 'grupo_con_cob.php?menu=13');
	});
	$('#menu_modulo_cjas_cart_dir_nomgroup_sel').click(function(){
		$(location).attr('href', 'grupo_con_c.php?menu=13');
	});
	$('#menu_modulo_cjas_cart_dir_nomgroup_sel_modif').click(function(){
		$(location).attr('href', 'grupo_con_c.php?menu=13');
	});
});



