var banderColapsable = 0;
$(document).on('ready', function(){
	
	var saldo = $('#saldo').val();
	
	$('#monto').change(function(){
       var egr_monto = $('#monto').val(); 									             
		
		var resta = saldo - egr_monto;
		if (resta < 0){
			$("#alertasaldoinsuficiente").dialog({
                  modal: true,
                  buttons: {
                        Ok: function() {
                                $( this ).dialog( "close" );
								$('#monto').val(0);
                        }
                  }
        		});
			
			//alert("Saldo de Caja Chica Insuficiente !!!");
		}
		
		
		
	});
	
	
	//
	
	
	$('#btn_colapsable').click(function(){
		if(banderColapsable == 0){
			banderColapsable = 1;
			$(this).animate({
				"height":"-60px"
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
	
	//Validar si recibo fue utilizado
	$('#recibo').change(function(){
	//   var cod_bco = $('#cod_bco').val();
	   var recibo = $('#recibo').val(); 
     //  var chequera = $('#chequera').val(); 
	//  alert($('#recibo').val());
	//Verifica si fue usado el nro de recibo
	
	var url = 'verificar_recibo.php';
	  $.ajax({
        type: "POST",
        url: url,
        data: { 'recibo' : recibo },
        dataType: 'json',
        success: function(response) {
			console.log(response.REC_DET_NRO);
			var resultado = response.REC_DET_NRO;
			if (resultado > 0){
			$('#recibo2').val(resultado);
			$("#alertareciboutilizado").dialog({
                  modal: true,
                  buttons: {
                        Ok: function() {
                                $( this ).dialog( "close" );
								$('#recibo').val(0);
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
//});	
//Verifica si el RECIBO esta en el rango de recibos asignados
	var url = 'verificar_nro_recibo.php';
	  $.ajax({
        type: "POST",
        url: url,
        data: {'recibo' : recibo },
        dataType: 'json',
        success: function(response) {
			console.log(response.REC_CTRL_NRO);
			var resultado = response.REC_CTRL_NRO;
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
	
	
	
	
	
	$('#menu_modulo').click(function(){
		$(location).attr('href','menu_s.php');
	});
	$('#menu_modulo_cajachica').click(function(){
		$(location).attr('href', 'modulo.php?modulo=10100');
	});

	$('#menu_modulo_cajachica_parametros').click(function(){
		$(location).attr('href', 'alt_caja_chica.php');
	});
    $('#menu_modulo_cajachica_reportes').click(function(){
		$(location).attr('href', 'cjach_reportes.php');
	});
	$('#menu_modulo_cajachica_reversion').click(function(){
		$(location).attr('href', 'cja_rev_chica.php');
	});
    $('#menu_modulo_cajachica_gastos_cjach').click(function(){
		$(location).attr('href', 'con_retro_cjach.php?accion=2');
	});
	
	$('#menu_modulo_cajachica_liquidacion').click(function(){
		$(location).attr('href', 'con_retro_cjach.php?accion=3');
	});
$('#menu_modulo_cajachica_liquidacion').click(function(){
		$(location).attr('href', 'con_retro_cjach.php?accion=3');
	});

	$('#menu_modulo_cajachica_asientocontable_adicionar_modif').click(function(){
		$(location).attr('href', 'con_retro.php?accion=1');
	});
	
	$('#menu_modulo_cajachica_facturacion').click(function(){
		$(location).attr('href', 'con_mant_fac.php');
	});
	$('#menu_modulo_cajachica_facturacion_reportes').click(function(){
		$(location).attr('href', 'fac_reportes.php');
	});
	$('#menu_modulo_cajachica_facturacion_recibos').click(function(){
		$(location).attr('href', 'con_mant_rec.php');
	});
	

	$('#menu_modulo_cajachica_recibos_reportes').click(function(){
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

//Confirmacion



//mantenimiento de ufvs
	$('#menu_modulo_cajachica_ufv').click(function(){
		$(location).attr('href', 'con_mant_ufv.php');
	});
//reportes factura
	$('#menu_modulo_reporte').click(function(){
		$(location).attr('href', 'fac_reportes.php');
	});
//reportes factura Venta
	$('#menu_modulo_cajachica_facturacion_reportes_venta').click(function(){
		$(location).attr('href', 'fac_reportes_venta.php');
	});
//reportes factura Venta
	$('#menu_modulo_cajachica_facturacion_reportes_compra').click(function(){
		$(location).attr('href', 'fac_reportes_compra.php');
	});



$('#cuenta_busca_datos').keyup(function(){
	//console.log('teclado');
	$.ajax({
		url:'busca_cuenta.php?tp=buscar&busca='+$('#cuenta_busca_datos').val(),
		dataType:'json',
		type:'GET',
		beforeSend:function(){
		},
		success:function(resultados){
			$('#cuenta_busca_datos').autocomplete({
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

//Metodo para dialog confirmacion
function mostrarDialogoConfirmacion(){
	$('#dialog-confirm-001').dialog('open');
	return false;
}


function cuentaSeleccionado(evt, ui){


	var resul=ui.item.id;

	console.log("llega");
	console.log(resul);

$('#cue_egr').val(ui.item.id);
//$('#con_cuen_new').val(ui.item.id);

}

function cuentaFocus(evt,ui){
	console.log(ui);
}


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




