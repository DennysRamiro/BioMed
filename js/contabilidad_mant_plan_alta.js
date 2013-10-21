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
	//$('#menu_modulo_cont_reportes').click(function(){
	//	$(location).attr('href', 'cont_reportes.php');
	//});
	$('#menu_modulo_contabilidad_facturacion_reportes').click(function(){
		$(location).attr('href', 'fac_reportes.php');
	});
	$('#menu_modulo_contabilidad_facturacion_recibos').click(function(){
		$(location).attr('href', 'con_mant_rec.php');
	});
	$('#menu_modulo_contabilidad_recibos_reportes').click(function(){
		$(location).attr('href', 'con_mant_rec.php');
	});



var util = new Utilitarios();
	util.validarCampo('cod_cta', 'error_cod_cta', 'El campo <b>Cuenta Contable</b> no puede estar vacio.');
	util.validarCampo('niv_cta','error_niv_cta', 'El campo <b>Nivel</b> no puede estar vacio.');
	util.validarCampo('descrip', 'error_descrip', 'El campo <b>Descripci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('cod_cta_r','error_cod_cta_r', 'El campo <b>Cuenta Revalorizci&oacute;n</b> no puede estar vacio.');	



rec_reportes.php
});



