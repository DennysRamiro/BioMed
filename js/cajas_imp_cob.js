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
	
		//modulo fondo garantia
	$('#menu_modulo_general_cajas').click(function(){
		$(location).attr('href', 'modulo.php?modulo=10000');
	});
	//modulo reportes fondo
	$('#menu_modulo_cajas_imp').click(function(){
		$(location).attr('href', 'cja_reimpre.php');
	});
	//modulo reportes fondo
	$('#menu_modulo_cajas_imp_cob').click(function(){
		$(location).attr('href', 'cja_rimp_par.php?menu=10');
	});
	//modulo reportes fondo
	//$('#menu_modulo_cajas_imp_cob_sel').click(function(){
	//	$(location).attr('href', 'cja_des_rimp.php?menu=10');
	//});
});