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

	$('#menu_modulo_cjas_chequera').click(function(){
		$(location).attr('href', 'cja_mant_cheq.php');
	});

	$('#menu_modulo_cjas_depret_dep').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=10');
	});

	$('#menu_modulo_cjas_depret_depdol').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=11');
	});

	$('#menu_modulo_cjas_depret_ret').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=12');
	});

	$('#menu_modulo_cjas_depret_retdol').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=13');
	});


$('#cod_cta').keyup(function(){
	//console.log('teclado');
	$.ajax({
		url:'busca_cuenta.php?tp=buscar&busca='+$('#cod_cta').val(),
		dataType:'json',
		type:'GET',
		beforeSend:function(){
		},
		success:function(resultados){
			$('#cod_cta').autocomplete({
				minLength: 1,
				source: resultados,
				select:cuentaSeleccionado,
				focus: cuentaFocus 
				
			});
																																																																//<td><a href="alm_detallar_proveedor.php?id_proveedor=<?php echo $linea['alm_prov_id'];?>" ><img src="img/notepad_48x48.png" align="absmiddle"><br> Detallar</a> </td>																															
		}
	});

});


//Deposito


  $('#monto').change(function(){


     	//copiar();
     	$('#imp_tot').val($('#monto').val());
     	$('#cred_fisc_iva').val($('#imp_tot').val()*.13);
     	$('#tot_neto').val($('#monto').val());

     	$('#cod_ban').val($('#cod_bco').val());
     	$('#con_cuen').val($('#cod_cta').val());
     	//$('#con_cuen_new').val($('#cuenta_busca_datos').val());
     });

   $('#cod_bco').change(function(){
			
     	$('#cod_ban').val($('#cod_bco').val());
        //alert($('#cod_ban').val());	
   
    });
   $('#cod_cta').change(function(){

     	$('#con_cuen').val($('#cod_cta').val());

//console.log($('#con_cuen').val());
     });

$('#des').change(function(){

     	$('#trans').val($('#des').val());
     	//console.log($('#trans').val());
     });



//retiro
 $('#monto').change(function(){
     	//copiar();
     	$('#imp_tot_ret').val($('#monto').val());
     	$('#cred_fisc_iva_ret').val($('#imp_tot_ret').val()*.13);
     	$('#tot_neto_ret').val($('#monto').val());
     	
     	$('#cod_ban1').val($('#cod_bco').val());
     	$('#con_cuen1').val($('#cod_cta').val());


     });

    $('#cod_bco').change(function(){
			
     	$('#cod_ban1').val($('#cod_bco').val());
       // alert($('#cod_ban').val());	
   
    });
   $('#cod_cta').change(function(){

     	$('#con_cuen1').val($('#cod_cta').val());
//console.log($('#con_cuen').val());
     });

$('#des').change(function(){

     	$('#trans1').val($('#des').val());
     	//console.log($('#trans').val());
     });



	
	
	var util = new Utilitarios();
	util.validarCampo('des', 'error_des', 'El campo <b>Hace la Transacci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('descrip', 'error_descrip', 'El campo <b>Descripci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('monto','error_monto', 'El campo <b>Montoo</b> no puede estar vacio.');
   util.validarCampo('egr_monto','error_egr_monto', 'El campo <b>Monto en Dolares</b> no puede estar vacio.');
   
	util.validarCampo('nit','error_nit', 'El campo <b>Nit del Proveedor </b> no puede estar vacio.');
	util.validarCampo('nro_fac','error_nro_fac', 'El campo <b>Nro. de Factura</b> no puede estar vacio.');
	util.validarCampo('nro_auto','error_nro_auto', 'El campo <b>Nro. Autorizaci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('razon_social','error_razon_social', 'El campo <b>Nombre o Razon Social</b> no puede estar vacio.');
	util.validarCampo('fec_fac','error_fec_fac', 'El campo <b>Periodo</b> no puede estar vacio.');
	util.validarCampo('imp_tot','error_imp_tot', 'El campo <b>Importe Total</b> no puede estar vacio.');
	//util.validarCampo('imp_ice','error_imp_ice', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
	//util.validarCampo('imp_excento','error_imp_excento', 'El campo <b>N&uacute;mero Factura Hasta</b> no puede estar vacio.');
	util.validarCampo('tot_neto','error_tot_neto', 'El campo <b>Total Neto</b> no puede estar vacio.');
	util.validarCampo('cred_iva','error_cred_iva', 'El campo <b>Cr&egrave;dito Fiscal IVA</b> no puede estar vacio.');
	//util.validarCampo('cod_control','error_cod_control', 'El campo <b>C&oacute;digo de Control</b> no puede estar vacio.');
// validacion del formualrio Retiro de Factura
	util.validarCampo('nit_ret','error_nit_ret', 'El campo <b>Nit del Proveedor </b> no puede estar vacio.');
	util.validarCampo('nro_fac_ret','error_nro_fac_ret', 'El campo <b>Nro. de Factura</b> no puede estar vacio.');
	util.validarCampo('nro_auto_ret','error_nro_auto_ret', 'El campo <b>Nro. Autorizaci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('razon_social_ret','error_razon_social_ret', 'El campo <b>Nombre o Razon Social</b> no puede estar vacio.');
	util.validarCampo('fec_fac_ret','error_fec_fac_ret', 'El campo <b>Periodo</b> no puede estar vacio.');
	util.validarCampo('imp_tot_ret','error_imp_tot_ret', 'El campo <b>Importe Total</b> no puede estar vacio.');
	//util.validarCampo('imp_ice','error_imp_ice', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
	//util.validarCampo('imp_excento','error_imp_excento', 'El campo <b>N&uacute;mero Factura Hasta</b> no puede estar vacio.');
	util.validarCampo('tot_neto_ret','error_tot_neto_ret', 'El campo <b>Total Neto</b> no puede estar vacio.');
	util.validarCampo('cred_iva_ret','error_cred_iva_ret', 'El campo <b>Cr&egrave;dito Fiscal IVA</b> no puede estar vacio.');
	//util.validarCampo('cod_control_ret','error_cod_control_ret', 'El campo <b>C&oacute;digo de Control</b> no puede estar vacio.');
});

function dialogo() {
 
$("#dialog").dialog({
    	show:"blind",
    	hide:"explode",
    	width:"500px",
    	color: "#D6D6D6",
    	modal: true
    }); 
$('#dialog').dialog('widget').find(".ui-dialog-titlebar-close").hide();
}

function dialogoi() {

$("#dialogo").dialog({

    	show:"blind",
    	hide:"explode",
    	width:"500px",
    	color: "#D6D6D6",
    	modal: true
    });
$('#dialogo').dialog('widget').find(".ui-dialog-titlebar-close").hide();
}

/**
 Este es la funcion que gestiona los eventos de teclado
 */


function cuentaSeleccionado(evt, ui){


	//var resul=ui.item.id;

	//console.log("llega");
	//console.log(resul);

$('#con_cuen1').val(ui.item.id);
$('#con_cuen').val(ui.item.id);

}

function cuentaFocus(evt,ui){
	console.log(ui);
}