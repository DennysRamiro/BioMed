var banderColapsable = 0;
$(document).on('ready', function(){
	
	$('#progressbar').hide();// permite ocultar el progress de los asientos  de mantenimiento UFVs
		
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

	$('#menu_modulo_contabilidad_asientocontable').click(function(){
		$(location).attr('href', 'con_mante.php');
	});

	$('#menu_modulo_contabilidad_asientocontable_reval').click(function(){
		$(location).attr('href', 'con_revalor.php?menu=1');
	});


	$('#menu_modulo_contabilidad_asientocontable_adicionar').click(function(){
		$(location).attr('href', 'con_retro.php?accion=1');
	});


	$('#menu_modulo_contabilidad_asientocontable_adicionar_modif').click(function(){
		$(location).attr('href', 'con_retro.php?accion=1');
	});
	
	$('#menu_modulo_contabilidad_facturacion').click(function(){
		$(location).attr('href', 'con_mant_fac.php');
	});
	$('#menu_modulo_contabilidad_facturacion_reportes').click(function(){
		$(location).attr('href', 'fac_reportes.php');
	});
	$('#menu_modulo_contabilidad_facturacion_recibos').click(function(){
		$(location).attr('href', 'con_mant_rec.php');
	});
	

	$('#menu_modulo_contabilidad_recibos_reportes').click(function(){
		$(location).attr('href', 'rec_reportes.php');
	});
	$('#menu_modulo_consulta').click(function(){
		$(location).attr('href', 'con_ufv.php');
	});
	$('#menu_modulo_fecha_fac').click(function(){
		$(location).attr('href', 'con_fac.php');
	});
	$('#menu_modulo_dosific').click(function(){
		$(location).attr('href', 'cont_menu_dos.php');
	});



//mantenimiento de ufvs
	$('#menu_modulo_contabilidad_ufv').click(function(){
		$(location).attr('href', 'con_mant_ufv.php');
	});
//reportes factura
	$('#menu_modulo_reporte').click(function(){
		$(location).attr('href', 'fac_reportes.php');
	});
//reportes factura Venta
	$('#menu_modulo_contabilidad_facturacion_reportes_venta').click(function(){
		$(location).attr('href', 'fac_reportes_venta.php');
	});
//reportes factura Venta
	$('#menu_modulo_contabilidad_facturacion_reportes_compra').click(function(){
		$(location).attr('href', 'fac_reportes_compra.php');
	});
//reportes factura Venta
	$('#menu_modulo_contabilidad_facturacion_reportes_venta_ban').click(function(){
		$(location).attr('href', 'fac_reportes_venta_ban.php');
	});
//reportes factura Venta
	$('#menu_modulo_contabilidad_facturacion_reportes_compra_ban').click(function(){
		$(location).attr('href', 'fac_reportes_compra_ban.php');
	});

//rec_reportes.php



	var util = new Utilitarios();
	util.validarCampo('cod_ord', 'error_cod_ord', 'El campo <b>N&uacute;mero de orden</b> no puede estar vacio.');
	util.validarCampo('nro_fac', 'error_nro_fac', 'El campo <b>N&uacute;mero de factura </b> no puede estar vacio.');
	util.validarCampo('llave','error_llave', 'El campo <b>Llave</b> no puede estar vacio.');
	util.validarCampo('cod_orden', 'error_cod_orden', 'El campo <b>N&uacute;mero Autorizaci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('nro_fac_des','error_nro_fac_des', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
	util.validarCampo('nro_fac_has','error_nro_fac_has', 'El campo <b>N&uacute;mero Factura Hasta</b> no puede estar vacio.');
	util.validarCampo('nro_nit', 'error_nro_nit', 'El campo <b>NIT Cliente</b> no puede estar vacio.');
	util.validarCampo('monto','error_monto', 'El campo <b>Monto</b> no puede estar vacio.');
	util.validarCampo('nro_rec1', 'error_nro_rec1', 'El campo <b>Nro. Recibo Desde</b> no puede estar vacio.');
	util.validarCampo('nro_rec2','error_nro_rec2', 'El campo <b>Nro. Recibo Hasta</b> no puede estar vacio.');
	util.validarCampo('cantidad','error_cantidad', 'El campo <b>Cantidad</b> no puede estar vacio.');
	/*//formulario fctura
	util.validarCampo('nit','error_nit', 'El campo <b>Nit del Proveedor </b> no puede estar vacio.');
	util.validarCampo('nro_fac','error_nro_fac', 'El campo <b>Nro. de Factura</b> no puede estar vacio.');
	util.validarCampo('nro_auto','error_nro_auto', 'El campo <b>Nro. de Autorizaci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('razon_social','error_razon_social', 'El campo <b>Nombre o Razon Social</b> no puede estar vacio.');
	util.validarCampo('periodo','error_periodo', 'El campo <b>Periodo</b> no puede estar vacio.');
	util.validarCampo('imp_tot','error_imp_tot', 'El campo <b>Importe Total</b> no puede estar vacio.');
	//util.validarCampo('imp_ice','error_imp_ice', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
	//util.validarCampo('imp_excento','error_imp_excento', 'El campo <b>N&uacute;mero Factura Hasta</b> no puede estar vacio.');
	util.validarCampo('tot_neto','error_tot_neto', 'El campo <b>Total Neto</b> no puede estar vacio.');
	util.validarCampo('cred_iva','error_cred_iva', 'El campo <b>Cr&egrave;dito Fiscal IVA</b> no puede estar vacio.');
	util.validarCampo('cod_control','error_cod_control', 'El campo <b>C&oacute;digo de Control</b> no puede estar vacio.');*/
	




});
function ValidaCamposEgresos(form) {
  var marcado = "no";
  with (document.form2){

        for ( var i = 0; i < nro_tal.length; i++ ) {
               if ( nro_tal[i].checked) {
                    return true;
                } 
          } 
  }     
    if ( marcado == "no" ){
        $("#dialog-message").dialog({
                  modal: true,
                  buttons: {
                        Ok: function() {
                                $( this ).dialog( "close" );
                        }
                  }
        });
        return false;  
    }
}




