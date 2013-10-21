var banderColapsable = 0;
var numeroTotal = 0 ;
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
	$('#menu_modulo_cajas_salfin').click(function(){
		$(location).attr('href', 'caja_fin_saldo.php');
	});

    var util = new Utilitarios();
//	util.validarCampo('nro_fac_des','error_nro_fac_des', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
	util.validarCampo('des', 'error_des', 'El campo <b>Hace la Transacci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('monto','error_monto', 'El campo <b>Monto</b> no puede estar vacio.');
	util.validarCampo('egr_monto', 'error_egr_monto', 'El campo <b></b> no puede estar vacio.');
	//console.log(util);


});
function establecerNumero(numero){
	numeroTotal = numero;
	//alert(numeroTotal);
	//alert(numeroTotal);
	/*for (var i=0 ; i < numeroTotal; i++) {
		$('#B_'+i).change(function(){
			//$('#C'+i).val($('#A'+i).val()*$('#B'+i).val());
			alert($('#A_'+i).val()+" "+i);
		});
	};*/
}
/**
 * Esta es la funsion que calcula el total por fila
 */
function calcularCantidad(cantidad, num){
	var cantidadCalcular = parseInt(cantidad.value);
	var monto  = parseFloat($('#A'+num).val());
	var total = (monto*cantidadCalcular);
    $('#C'+num).val(total);
	var suma_total_filas = 0;
	var cantidad_total_filas = 0;
	for (var i = 0 ; i < numeroTotal; i++) {
		suma_total_filas = parseFloat(suma_total_filas) + parseFloat($('#C'+i).val());
		cantidad_total_filas = parseInt(cantidad_total_filas) + parseInt($('#B'+i).val());
	};
	var saldo_efectivo = parseFloat($('#saldo_efectivo_oculto').val());
    if((saldo_efectivo-suma_total_filas) <= 0) {
    	$( "#dialog-message" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
    	$('#B'+num).val(0);
    	$('#C'+num).val(0);
    }else{
    	var suma_total_filas = 0;
		var cantidad_total_filas = 0;
		for (var i = 0 ; i < numeroTotal; i++) {
			suma_total_filas = parseFloat(suma_total_filas) + parseFloat($('#C'+i).val());
			cantidad_total_filas = parseInt(cantidad_total_filas) + parseInt($('#B'+i).val());
		};
    	$('#suma_total').val(suma_total_filas);
		$('#suma_total_cantidad').val(cantidad_total_filas);
		$('#saldo_efectivo').val(parseFloat(saldo_efectivo-suma_total_filas));	
    }
}

