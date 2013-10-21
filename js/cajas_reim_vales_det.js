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
	$('#menu_modulo_cajas_reim').click(function(){
		$(location).attr('href', 'cja_reimpre.php');
	});
	//modulo reportes fondo
	$('#menu_modulo_cajas_reim_det').click(function(){
		$(location).attr('href', 'cja_rev_val.php?menu=6');
	});

	//modulo reportes fondo
	$('#menu_modulo_cajas_reim_det_rev').click(function(){
		$(location).attr('href', 'cja_rev_val.php?menu=6');
	});
});