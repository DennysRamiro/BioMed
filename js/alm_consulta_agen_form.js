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
	$('#menu_modulo_imp').click(function(){
		$(location).attr('href', 'modulo.php?modulo=30000');
	});
	$('#menu_modulo_importacion').click(function(){
		$(location).attr('href', 'alm_gest_imp.php');
	});
	$('#menu_alta_trans_adu').click(function(){
		$(location).attr('href', 'alm_gest_import.php');
	});


	//$.getScript('js/Utilitarios.js');
	var util = new Utilitarios();
	// Esta es la accion que verifica que datos de la agencia aduanera no estee vacio
	util.validarCampo('nro_fac', 'error_nro_fac', 'El campo <b>Nº Factura</b> no puede estar vacio.');
	util.validarCampo('fec', 'error_fec', 'El campo <b>Fecha</b> no puede estar vacio.');
	util.validarCampo('nro_sid','error_nro_sid', 'El campo <b>Nº Sidunea</b> no puede estar vacio.');
	
});