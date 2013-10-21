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

	$('#menu_modulo_contabilidad_asientocontable').click(function(){
		$(location).attr('href', 'con_mante.php');
	});
	$('#menu_modulo_contabilidad_asientocontable_util_res').click(function(){
		$(location).attr('href', 'con_retro.php?accion=9');
	});




        $("#cantidad").change(function(){
              val = $("#cantidad option:selected").val();
            $(".radio").each(function(i){
                i++;
                if( i == val )
                    $("#radio"+i).show("slow");
                else
                    $("#radio"+i).hide("slow");
            });
        });


	
	$('#cod_cta').change(function(){
			var a =$('#cod_cta').val();
			var aa =$('#cod_cta').val();
			//console.log(a);
			//console.log(aa);

			//alert(a.length);
			for (i=0;i<a.length;i++) {
				//console.log(a);
				if (i==5) {
					c = a[i];
					if (c==2) {
						//console.log("en dolares");
						$("#debe_1").prop('disabled', true);
						$("#haber_1").prop('disabled', true);
						$("#debe_2").prop('disabled', false);
						$("#haber_2").prop('disabled', false);

				};
					if (c==1) {
						//console.log("en Bolivianos");
						$("#debe_2").prop('disabled', true);
						$("#haber_2").prop('disabled', true);
						$("#debe_1").prop('disabled', false);
						$("#haber_1").prop('disabled', false);


					};
				
			};
		};
		
		/*for (i=0;i<aa.length;i++) {
							//console.log(i);
							if (i==0) {
								x = aa[i];
								//console.log(x);
									if (x==1 || x==2 || x==3) {
										//alert(c);
				                    	$("#factura_e").hide();	
				                    	$("#factura_i").hide();				
										//return c
									};
									if (x==4) {
										$("#factura_i").show("slow");	
										$("#factura_e").hide();	
									};
									if (x==5 || x==6) {
										$("#factura_e").show("slow");
										$("#factura_i").hide();	
									};
						};

		};*/
	});


  //formulario fctura
	var util = new Utilitarios();
	
	util.validarCampo('glosa','error_glosa', 'El campo <b>Glosa</b> no puede estar vacio.');

	
	//Formulrio Egresos
	util.validarCampo('nit_e','error_nit_e', 'El campo <b>Nit del Proveedor </b> no puede estar vacio.');
	util.validarCampo('nro_fac_e','error_nro_fac_e', 'El campo <b>Nro. de Factura</b> no puede estar vacio.');
	util.validarCampo('nro_auto_e','error_nro_auto_e', 'El campo <b>Nro. de Autorizaci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('razon_social_e','error_razon_social_e', 'El campo <b>Nombre o Razon Social</b> no puede estar vacio.');
	util.validarCampo('periodo_e','error_periodo_e', 'El campo <b>Periodo</b> no puede estar vacio.');
	util.validarCampo('imp_tot_e','error_imp_tot_e', 'El campo <b>Importe Total</b> no puede estar vacio.');
	//util.validarCampo('imp_ice','error_imp_ice', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
	//util.validarCampo('imp_excento','error_imp_excento', 'El campo <b>N&uacute;mero Factura Hasta</b> no puede estar vacio.');
	util.validarCampo('tot_neto_e','error_tot_neto_e', 'El campo <b>Total Neto</b> no puede estar vacio.');
	util.validarCampo('cred_iva_e','error_cred_iva_e', 'El campo <b>Cr&egrave;dito Fiscal IVA</b> no puede estar vacio.');
	util.validarCampo('cod_control_e','error_cod_control_e', 'El campo <b>C&oacute;digo de Control</b> no puede estar vacio.');
	// Formulario Ingresos
	util.validarCampo('nit_i','error_nit_i', 'El campo <b>Nit del Proveedor </b> no puede estar vacio.');
	util.validarCampo('nro_fac_i','error_nro_fac_i', 'El campo <b>Nro. de Factura</b> no puede estar vacio.');
	util.validarCampo('nro_auto_i','error_nro_auto_i', 'El campo <b>Nro. de Autorizaci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('razon_social_i','error_razon_social_i', 'El campo <b>Nombre o Razon Social</b> no puede estar vacio.');
	util.validarCampo('periodo_i','error_periodo_i', 'El campo <b>Periodo</b> no puede estar vacio.');
	util.validarCampo('imp_tot_i','error_imp_tot_i', 'El campo <b>Importe Total</b> no puede estar vacio.');
	//util.validarCampo('imp_ice','error_imp_ice', 'El campo <b>N&uacute;mero Factura Desde</b> no puede estar vacio.');
	//util.validarCampo('imp_excento','error_imp_excento', 'El campo <b>N&uacute;mero Factura Hasta</b> no puede estar vacio.');
	util.validarCampo('tot_neto_i','error_tot_neto_i', 'El campo <b>Total Neto</b> no puede estar vacio.');
	util.validarCampo('cred_iva_i','error_cred_iva_i', 'El campo <b>Cr&egrave;dito Fiscal IVA</b> no puede estar vacio.');
	util.validarCampo('cod_control_i','error_cod_control_i', 'El campo <b>C&oacute;digo de Control</b> no puede estar vacio.');



	

 $('#debe_1').change(function(){
     	//copiar();
     	$('#imp_tot').val($('#debe_1').val());
     	$('#cred_iva').val(($('#imp_tot').val()*.13).toFixed(2));
     	$('#debe1').val($('#debe_1').val());
     	//$('#cuen_cont').val($('#cod_cta').val());
     });
 $('#haber_1').change(function(){
     	//copiar();
     	$('#imp_tot').val($('#haber_1').val());
     	$('#cred_iva').val(($('#imp_tot').val()*.13).toFixed(2));
     	$('#haber1').val($('#haber_1').val());
     	//$('#cuen_cont').val($('#cod_cta').val());
     });
 $('#debe_2').change(function(){
     	//copiar();
     	$('#imp_tot').val($('#debe_2').val());
     	$('#cred_iva').val(($('#imp_tot').val()*.13).toFixed(2));
     	//$('#cuen_cont').val($('#cod_cta').val());
     	$('#debe2').val($('#debe_2').val());
     });
 $('#haber_2').change(function(){
     	//copiar();
     	$('#imp_tot').val($('#haber_2').val());
     	$('#cred_iva').val(($('#imp_tot').val()*.13).toFixed(2));
     	//$('#cuen_cont').val($('#cod_cta').val());
     	$('#haber2').val($('#haber_2').val());
     });

 $('#glosa').change(function(){
     	//copiar();
     	$('#glosas').val($('#glosa').val());

     });
  $('#cod_cta').change(function(){
     	//copiar();
     	$('#cuen_cont').val($('#cod_cta').val());

     });





 $('#debe_1').change(function(){
     	//copiar();
     	$('#imp_tot_i').val($('#debe_1').val());
     	$('#cred_iva_i').val(($('#imp_tot_i').val()*.13).toFixed(2));
     	$('#debe1_i').val($('#debe_1').val());
     	//$('#cuen_cont').val($('#cod_cta').val());
     });
 $('#haber_1').change(function(){
     	//copiar();
     	$('#imp_tot_i').val($('#haber_1').val());
     	$('#cred_iva_i').val(($('#imp_tot_i').val()*.13).toFixed(2));
     	$('#haber1_i').val($('#haber_1').val());
     	//$('#cuen_cont').val($('#cod_cta').val());
     });
 $('#debe_2').change(function(){
     	//copiar();
     	$('#imp_tot_i').val($('#debe_2').val());
     	$('#cred_iva_i').val(($('#imp_tot_i').val()*.13).toFixed(2));
     	//$('#cuen_cont').val($('#cod_cta').val());
     	$('#debe2_i').val($('#debe_2').val());
     });
 $('#haber_2').change(function(){
     	//copiar();
     	$('#imp_tot_i').val($('#haber_2').val());
     	$('#cred_iva_i').val(($('#imp_tot_i').val()*.13).toFixed(2));
     	//$('#cuen_cont').val($('#cod_cta').val());
     	$('#haber2_i').val($('#haber_2').val());
     });

 $('#glosa').change(function(){
     	//copiar();
     	$('#glosas_i').val($('#glosa').val());

     });
  $('#cod_cta').change(function(){
     	//copiar();
     	$('#cuen_cont_i').val($('#cod_cta').val());

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





  

//});
//busca cuenta 2
$('#cuenta_busca_datos2').keyup(function(){
	//console.log('teclado');
	$.ajax({
		url:'busca_cuenta.php?tp=buscar&busca='+$('#cuenta_busca_datos2').val(),
		dataType:'json',
		type:'GET',
		beforeSend:function(){
		},
		success:function(resultados){
			$('#cuenta_busca_datos2').autocomplete({
				minLength: 1,
				source: resultados,
				select:cuentaSeleccionado2,
				focus: cuentaFocus 
				
			});
																																																																//<td><a href="alm_detallar_proveedor.php?id_proveedor=<?php echo $linea['alm_prov_id'];?>" ><img src="img/notepad_48x48.png" align="absmiddle"><br> Detallar</a> </td>																															
		}
	});

});





  

});



function cuentaSeleccionado(evt, ui){

	$('#cod_cta').val(ui.item.id);
	
}
function cuentaSeleccionado2(evt, ui){
	
	$('#cod_cta2').val(ui.item.id);
}
function cuentaFocus(evt,ui){
	console.log(ui);
}

function dialog() {
	
	$("#dialog").dialog({
    	show:"blind",
    	hide:"explode",
    	width:"400px",
    	resizable:"false",
    	//color: "#D6D6D6",
    	modal: true
    });
}

function dialogo() {
	$("#dialogo").dialog({
    	show:"blind",
    	hide:"explode",
    	width:"400px",
    	resizable:"false",
    	//color: "#D6D6D6",
    	modal: true
    });
}


	