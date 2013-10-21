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

	$('#menu_modulo_cjas_depret').click(function(){
		$(location).attr('href', 'cja_bancos.php');
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
       // alert($('#cod_bco').val());	
   
    });
    $('#deposito').change(function(){
			
     	$('#deposito').val($('#deposito').val());
     //  alert($('#deposito').val());	
   
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
        $('#cheqra').val($('#chequera').val());
        $('#chq').val($('#cheque').val());
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

//Para que busque el talonario de la cuenta bco. seleccionada

$('#cod_bco').change(function(){
		//alert($('#cod_bco').val());
		$.ajax({
			url:'verificar_chequera.php?codigo='+$('#cod_bco').val(),
			dataType:'json',
			type:'GET',
			success:function(res){
				//console.log(res);
				$('#chequera').empty();
				$.each(res, function(index, value){
						console.log(value.CONTA_CHRA_TALON);
 				        console.log(value.CONTA_CHRA_CTA);
						$('#chequera').append('<option value="'+value.CONTA_CHRA_TALON+'">'+value.CONTA_CHRA_TALON+'</option>');                                        			     
     		//	$('#chequera').append('<option value="'+value.CONTA_CHRA_TALON'">'+value.CONTA_CHRA_TALON+'</option>');
        	    });
				//$('#ciudad option[value="'+res.ID+'"]').attr("selected","selected");
			}
		});
	});

//Validar si cheque fue utilizado
	$('#cheque').change(function(){
	   var cod_bco = $('#cod_bco').val();
	   var cheque = $('#cheque').val(); 
       var chequera = $('#chequera').val(); 
	  
	//Verifica si fue usado el nro de cheque	
	var url = 'verificar_cheque.php';
	  $.ajax({
        type: "POST",
        url: url,
        data: { 'codigo' : cod_bco, 'chequera' : chequera,'cheque' : cheque },
        dataType: 'json',
        success: function(response) {
			console.log(response.CONTA_CHEQ_NRO);
			var resultado = response.CONTA_CHEQ_NRO;
			if (resultado > 0){
			$('#cheque2').val(resultado);
			$("#alertachequeutilizado").dialog({
                  modal: true,
                  buttons: {
                        Ok: function() {
                                $( this ).dialog( "close" );
								$('#cheque').val(0);
                        }
                  }
				  });
			}else{
							
			}
			
         if (response){
		
		 }
       },error: function(){
		   alert("987");
		  }
});


//Verifica si el cheque esta en el rango de la chequera	
	var url = 'verificar_nro_cheque.php';
	  $.ajax({
        type: "POST",
        url: url,
        data: { 'codigo' : cod_bco, 'chequera' : chequera,'cheque' : cheque },
        dataType: 'json',
        success: function(response) {
			console.log(response.CONTA_CHRA_TALON);
			var resultado = response.CONTA_CHRA_TALON;
			if (resultado > 0){
			$('#cheque2').val(resultado);
		//	alert("Cheque VALIDO");
			
			}else{
			$("#alertachequeramal").dialog({
                  modal: true,
                  buttons: {
                        Ok: function() {
                                $( this ).dialog( "close" );
								$('#cheque').val(0);
                            }
                          }
				    });
		    }
			
         if (response){
		
		 }
       },error: function(){
		   alert("xxxxx");
		  }
});
	  
	  
	  
	  
});

	var util = new Utilitarios();
	util.validarCampo('des', 'error_des', 'El campo <b>Descripci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('descrip', 'error_descrip', 'El campo <b>Descripci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('monto','error_monto', 'El campo <b>Monto</b> no puede estar vacio.');
	util.validarCampo('deposito','error_nro_dep', 'El campo <b>Nro Deposito</b> no puede estar vacio.');
   util.validarCampo('egr_monto','error_egr_monto', 'El campo <b>Monto en Dolares</b> no puede estar vacio.');
   
	util.validarCampo('nit','error_nit', 'El campo <b>Nit</b> no puede estar vacio.');
	util.validarCampo('nro_fac','error_nro_fac', 'El campo <b>Nro. de Factura</b> no puede estar vacio.');
	util.validarCampo('nro_auto','error_nro_auto', 'El campo <b>Nro. Autorizaci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('razon_social','error_razon_social', 'El campo <b>Nombre/R.Social</b> no puede estar vacio.');
	util.validarCampo('fec_fac','error_fec_fac', 'El campo <b>Periodo</b> no puede estar vacio.');
	util.validarCampo('imp_tot','error_imp_tot', 'El campo <b>Importe Total</b> no puede estar vacio.');
	//util.validarCampo('imp_ice','error_imp_ice', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
	//util.validarCampo('imp_excento','error_imp_excento', 'El campo <b>N&uacute;mero Factura Hasta</b> no puede estar vacio.');
	util.validarCampo('tot_neto','error_tot_neto', 'El campo <b>Total Neto</b> no puede estar vacio.');
	util.validarCampo('cred_iva','error_cred_iva', 'El campo <b>Cr&egrave;dito Fiscal IVA</b> no puede estar vacio.');
	//util.validarCampo('cod_control','error_cod_control', 'El campo <b>C&oacute;digo de Control</b> no puede estar vacio.');
// validacion del formualrio Retiro de Factura
	util.validarCampo('nit_ret','error_nit_ret', 'El campo <b>Nit del Cliente </b> no puede estar vacio.');
	util.validarCampo('nro_fac_ret','error_nro_fac_ret', 'El campo <b>Nro. de Factura</b> no puede estar vacio.');
	util.validarCampo('nro_auto_ret','error_nro_auto_ret', 'El campo <b>Nro. Autorizaci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('razon_social_ret','error_razon_social_ret', 'El campo <b>Nombre/R.Social</b> no puede estar vacio.');
	util.validarCampo('fec_fac_ret','error_fec_fac_ret', 'El campo <b>Periodo</b> no puede estar vacio.');
	util.validarCampo('imp_tot_ret','error_imp_tot_ret', 'El campo <b>Importe Total</b> no puede estar vacio.');
	util.validarCampo('cod_bco','error_ctabco', 'El campo <b>Cuenta Banco</b> no puede estar vacio.');
	util.validarCampo('cod_cta','error_ctacon', 'El campo <b>Contra Cuenta</b> no puede estar vacio.');
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