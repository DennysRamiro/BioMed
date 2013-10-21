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
	$('#menu_modulo_mant_cuenta').click(function(){
		$(location).attr('href', 'fgar_cuentas.php');
	});


	$('#menu_modulo_cajas_IngEgre').click(function(){
		$(location).attr('href', 'egre_mante.php');
	});

	$('#menu_modulo_cajas_EgreBs').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=1');
	});

	$('#menu_modulo_cajas_EgreSus').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=2');
	});

	$('#menu_modulo_cajas_IngBs').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=7');
	});

	$('#menu_modulo_cajas_IngSus').click(function(){
		$(location).attr('href', 'egre_retro.php?accion=8');
	});



	var util = new Utilitarios();
	util.validarCampo('descrip', 'error_des', 'El campo <b>Hace la Transacci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('monto','error_monto', 'El campo <b>Monto</b> no puede estar vacio.');
   
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
	

     $('#monto').change(function(){
     	$('#imp_tot').val($('#monto').val());
     	$('#tot_neto').val($('#monto').val());
     	$('#cred_iva').val(($('#monto').val()*.13).toFixed(2));
     	
     	
        $('#cue_egr2').val($('#cod_cta2').val());
     	$('#cue_egr').val($('#cod_cta').val());
     	$('#moneda').val($('#monedas').val());
     	$('#ag').val($('#cod_agencia').val());
     	//$('#cue_egr_new').val($('#cuenta_busca_datos').val());
     });

      
   $('#cod_cta').change(function(){

     	$('#cue_egr').val($('#cod_cta').val());
     	$('#moneda').val($('#monedas').val());
//console.log($('#con_cuen').val());
     });
      $('#cod_cta2').change(function(){

     	$('#cue_egr2').val($('#cod_cta2').val());
     	$('#moneda').val($('#monedas').val());
//console.log($('#con_cuen').val());
     });
$('#cod_agencia').change(function(){

     	$('#ag').val($('#cod_agencia').val());
     	//console.log($('#trans').val());
     });
$('#descrip').change(function(){

     	$('#des').val($('#descrip').val());
     	//console.log($('#trans').val());
     });



  $('#monto_i').change(function(){
     	$('#imp_tot').val($('#monto_i').val());
     	$('#tot_neto').val($('#monto_i').val());
     	$('#cred_iva').val(($('#monto_i').val()*.13).toFixed(2));
        $('#cue_egr_i2').val($('#cod_cta2').val());
     	$('#cue_egr_i').val($('#cod_cta').val());
     	$('#moneda_i').val($('#monedas_i').val());
     	$('#ag_i').val($('#cod_agencia_i').val());

     	//$('#cue_egr_i_new').val($('#cuenta_busca_datos').val());
     });

      //ingresos
   $('#cod_cta_i').change(function(){

     	$('#cue_egr_i').val($('#cod_cta_i').val());
     	$('#moneda_i').val($('#monedas_i').val());
//console.log($('#con_cuen').val());
     });

$('#cod_agencia_i').change(function(){

     	$('#ag_i').val($('#cod_agencia_i').val());
     	//console.log($('#trans').val());
     });
$('#descrip_i').change(function(){

     	$('#des_i').val($('#descrip_i').val());
     	//console.log($('#trans').val());
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


//});
//Contra cuenta egreso
$('#cod_cta2').keyup(function(){
	//console.log('teclado');
	$.ajax({
		url:'busca_cuenta.php?tp=buscar&busca='+$('#cod_cta2').val(),
		dataType:'json',
		type:'GET',
		beforeSend:function(){
		},
		success:function(resultados){
			$('#cod_cta2').autocomplete({
				minLength: 1,
				source: resultados,
				select:cuentaSeleccionado,
				focus: cuentaFocus 
				
			});
																																																																//<td><a href="alm_detallar_proveedor.php?id_proveedor=<?php echo $linea['alm_prov_id'];?>" ><img src="img/notepad_48x48.png" align="absmiddle"><br> Detallar</a> </td>																															
		}
	});

});


});


function cuentaSeleccionado(evt, ui){

	$('#cue_egr_i').val(ui.item.id);
	$('#cue_egr').val(ui.item.id);
}

function cuentaFocus(evt,ui){
	console.log(ui);
}

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

function dialogo_ingresos() {
   
$("#dialog").dialog({
    	show:"blind",
    	hide:"explode",
    	width:"500px",
    	color: "#D6D6D6",
    	modal: true
    	
    });
$('#dialog').dialog('widget').find(".ui-dialog-titlebar-close").hide();
}
