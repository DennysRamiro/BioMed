var banderColapsable = 0;
$(document).ready(function(){
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
	$('#menu_modulo_general').click(function(){
		$(location).attr('href', 'modulo.php?modulo=1000');
	});
	//modulo reportes fondo
	$('#menu_modulo_general_usuarios').click(function(){
		$(location).attr('href', 'gral_man_usr.php');
	});
//});




	var util = new Utilitarios();
//	util.validarCampo('nro_fac_des','error_nro_fac_des', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
//	util.validarCampo('nro_fac_has','error_nro_fac_has', 'El campo <b>N&uacute;mero Factura Hasta</b> no puede estar vacio.');
	util.validarCampo('log', 'mensaje_log', 'El campo <b>Login</b> no puede estar vacio.');
	util.validarCampo('ci','mensaje_ci', 'El campo <b>Documento Identidad</b> no puede estar vacio.');
	util.validarCampo('clav','mensaje_clav', 'El campo <b>Clave Ingreso</b> no puede estar vacio.');
	util.validarCampo('nombres', 'mensaje_nombres', 'El campo <b>Nombres</b> no puede estar vacio.');
	util.validarCampo('ap_pater','mensaje_ap_pater', 'El campo <b>Apellido Paterno</b> no puede estar vacio.');
	//util.validarCampo('ap_mater','mensaje_ap_mater', 'El campo <b>Apellido Materno</b> no puede estar vacio.');
	util.validarCampo('direc', 'mensaje_direc', 'El campo <b>Direccion</b> no puede estar vacio.');
	//util.validarCampo('fono','mensaje_fono', 'El campo <b>Tel. Fijo</b> no puede estar vacio.');
	//util.validarCampo('celu','mensaje_celu', 'El campo <b>Tel. Celular</b> no puede estar vacio.');
	util.validarCampo('email','mensaje_email', 'El campo <b>E-mail</b> no puede estar vacio.');

});
function dialogo() {
   
$("#dialog").dialog({
    	show:"blind",
    	hide:"explode",
    	width:"500px",
    	color: "#D6D6D6",
    	modal: true
    });
}