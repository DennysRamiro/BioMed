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
		$(location).attr('href', 'modulo.php?modulo=30000');
	});
	$('#menu_modulo_agencia_aduanera').click(function(){
		$(location).attr('href', 'alm_agencia.php');
	});

	$('#pais').change(function(){
		//alert($('#pais').val());
		$.ajax({
			url:'verificar_combo.php?codigo='+$('#pais').val(),
			dataType:'json',
			type:'GET',
			success:function(res){
				//console.log(res);
				$('#ciudad').empty();
				$.each(res, function(index, value){
 				        console.log(value.ID);
 				        console.log(value.Name);                                                                                                                                                                                    			     
        	  			$('#ciudad').append('<option value="'+value.ID+'">'+value.Name+'</option>');
        	    });
				//$('#ciudad option[value="'+res.ID+'"]').attr("selected","selected");
			}
		});
	});

	$('#error_nombre_producto').hide();
	//$.getScript('js/Utilitarios.js');
	var util = new Utilitarios();
	// Esta es la accion que verifica que datos de la agencia aduanera no estee vacio
	util.validarCampo('cod', 'error_cod', 'El campo <b>C&oacute;digo</b> no puede estar vacio.');
	util.validarCampo('nombre', 'error_nombre', 'El campo <b>Nombre </b> no puede estar vacio.');
	util.validarCampo('nit','error_nit', 'El campo <b>Nit</b> no puede estar vacio.');
	util.validarCampo('dir','error_dir', 'El campo <b>Direcci&oacute;n</b> no puede estar vacio.');
	util.validarCampo('tel','error_tel', 'El campo <b>Tel&eacute;fono</b> no puede estar vacio.');
	
});