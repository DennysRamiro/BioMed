
$(document).ready(function(){
	
	$('#error_nombre_producto').hide();
	

	var util = new Utilitarios();
	util.validarCampo('cod_cta', 'error_cod_cta', 'El campo <b>Codigo de Cuenta</b> no puede estar vacio.');
	util.validarCampo('niv_cta', 'error_niv_cta', 'El campo <b>Nivel de la Cuenta </b> no puede estar vacio.');
	util.validarCampo('descrip','error_descrip', 'El campo <b>Descripcion de la cçCuenta</b> no puede estar vacio.');
	util.validarCampo('cod_cta_r','error_cod_cta_r', 'El campo <b>Cuenta Revalorizacion</b> no puede estar vacio.');
	
});