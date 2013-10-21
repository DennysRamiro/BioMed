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
	$('#menu_modulo_almacen').click(function(){
		$(location).attr('href', 'modulo.php?modulo=20000');
	});
	$('#menu_modulo_almacen_proy').click(function(){
		$(location).attr('href', 'alm_proyecto.php');
	});

	//$('#error_nombre_producto').hide();
	//$.getScript('js/Utilitarios.js');
	var util = new Utilitarios();
	// Esta es la accion que verifica que nombre producto no estee vacio
	util.validarCampo('nombres', 'error_nombres', 'El campo <b>Nombre del proyecto</b> no puede estar vacio.');
	util.validarCampo('cod_proy', 'error_cod_proy', 'El campo <b>Codigo del proyecto </b> no puede estar vacio.');
	//util.validarCampo('datepicker','error_fec_ini', 'El campo <b>Fecha Inicio</b> no puede estar vacio.');
	
});