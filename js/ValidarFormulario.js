;$(document).ready ( function(){
		
		var form = new Form();
		//var form = new Form1();
		//var form = new Form2();

	form.init();
});
function Form(){
	this.init = function(){

		$('#log').blur(function(){

			if($('#log').val() == ""){
				//alert("vacio el nombre");

				$('#mensaje_log').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></font></p>').hide().fadeIn(1000);
				$('#log').css('border', '1px solid red');
			}else{
				$('#mensaje_log').html('<p>Campo vacio</font></p>').hide().fadeOut(1000);
				$('#log').css('border', '1px solid green');
			}		 
		});

		$('#clav').blur(function(){

			if($('#clav').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_clav').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></font></p>').hide().fadeIn(1000);
				$('#clav').css('border', '1px solid red');
			}else{
				$('#mensaje_clav').html('<p><font size=1 face="Arial" color="#9f1313">Campo clave esta vacio</font></font></p>').hide().fadeOut(1000);
				$('#clav').css('border', '1px solid green');
			}		 
		});

		$('#ci').blur(function(){

			if($('#ci').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_ci').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></font></p>').hide().fadeIn(1000);
				$('#ci').css('border', '1px solid red');
			}else{
				$('#mensaje_ci').html('<p><font size=1 face="Arial" color="#9f1313">Campo ci esta vacio</font></font></font></p>').hide().fadeOut(1000);
				$('#ci').css('border', '1px solid green');
				
			}			 
		});

		$('#nombres').blur(function(){

			if($('#nombres').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_nombres').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#nombres').css('border', '1px solid red');
			}else{
				$('#mensaje_nombres').html('<p><font size=1 face="Arial" color="#9f1313">Campo de nombres esta vacio</font></p>').hide().fadeOut(1000);
				$('#nombres').css('border', '1px solid green');
			}		 
		});

		$('#ap_pater').blur(function(){

			if($('#ap_pater').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_ap_pater').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#ap_pater').css('border', '1px solid red');
			}else{
				$('#mensaje_ap_pater').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#ap_pater').css('border', '1px solid green');
			}		 
		});

		$('#ap_mater').blur(function(){

			if($('#ap_mater').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_ap_mater').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#ap_mater').css('border', '1px solid red');
			}else{
				$('#mensaje_ap_mater').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#ap_mater').css('border', '1px solid green');
			}		 
		});
		$('#ap_espos').blur(function(){

			if($('#ap_espos').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_ap_espos').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#ap_espos').css('border', '1px solid red');
			}else{
				$('#mensaje_ap_espos').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#ap_espos').css('border', '1px solid green');
			}		 
		});

		$('#lu_nac').blur(function(){

			if($('#lu_nac').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_lu_nac').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#lu_nac').css('border', '1px solid red');
			}else{
				$('#mensaje_lu_nac').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#lu_nac').css('border', '1px solid green');
			}		 
		});

		$('#direc').blur(function(){

			if($('#direc').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_direc').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
	
				$('#direc').css('border', '1px solid red');
			}else{
				$('#mensaje_direc').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#direc').css('border', '1px solid green');
			}		 
		});

		$('#zona').blur(function(){

			if($('#zona').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_zona').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#zona').css('border', '1px solid red');
			}else{
				$('#mensaje_zona').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#zona').css('border', '1px solid green');
			}		 
		});

		$('#fono').blur(function(){

			if($('#fono').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_fono').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#fono').css('border', '1px solid red');
			}else{
				$('#mensaje_fono').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#fono').css('border', '1px solid green');
			}		 
		});

		$('#celu').blur(function(){

			if($('#celu').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_celu').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#celu').css('border', '1px solid red');
			}else{
				$('#mensaje_celu').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#celu').css('border', '1px solid green');
			}		 
		});

		$('#email').blur(function(){

			if($('#email').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_email').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#email').css('border', '1px solid red');
			}else{
				$('#mensaje_email').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#email').css('border', '1px solid green');
			}		 
		});

		$('#a_eco_uno').blur(function(){

			if($('#a_eco_uno').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_a_eco_uno').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#a_eco_uno').css('border', '1px solid red');
			}else{
				$('#mensaje_a_eco_uno').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#a_eco_uno').css('border', '1px solid green');
			}		 
		});

		$('#a_eco_dos').blur(function(){

			if($('#a_eco_dos').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_a_eco_dos').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#a_eco_dos').css('border', '1px solid red');
			}else{
				$('#mensaje_a_eco_dos').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#a_eco_dos').css('border', '1px solid green');
			}		 
		});


		$('#ant_tr').blur(function(){

			if($('#ant_tr').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_ant_tr').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#ant_tr').css('border', '1px solid red');
			}else{
				$('#mensaje_ant_tr').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#ant_tr').css('border', '1px solid green');
			}		 
		});

			$('#dir_tr').blur(function(){

			if($('#dir_tr').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_dir_tr').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#dir_tr').css('border', '1px solid red');
			}else{
				$('#mensaje_dir_tr').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#dir_tr').css('border', '1px solid green');
			}		 
		});

			$('#zon_tr').blur(function(){

			if($('#zon_tr').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_zon_tr').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#zon_tr').css('border', '1px solid red');
			}else{
				$('#mensaje_zon_tr').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#zon_tr').css('border', '1px solid green');
			}		 
		});

			$('#fon_t').blur(function(){

			if($('#fon_t').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_fon_t').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#fon_t').css('border', '1px solid red');
			}else{
				$('#mensaje_fon_t').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#fon_t').css('border', '1px solid green');
			}		 
		});

			$('#nom_ref').blur(function(){

			if($('#nom_ref').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_nom_ref').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#nom_ref').css('border', '1px solid red');
			}else{
				$('#mensaje_nom_ref').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#nom_ref').css('border', '1px solid green');
			}		 
		});

			$('#dir_ref').blur(function(){

			if($('#dir_ref').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_dir_ref').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#dir_ref').css('border', '1px solid red');
			}else{
				$('#mensaje_dir_ref').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#dir_ref').css('border', '1px solid green');
			}		 
		});
			
			$('#fon_ref').blur(function(){

			if($('#fon_ref').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_fon_ref').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#fon_ref').css('border', '1px solid red');
			}else{
				$('#mensaje_fon_ref').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#fon_ref').css('border', '1px solid green');
			}		 
		});

			$('#nom_con').blur(function(){

			if($('#nom_con').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_nom_con').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#nom_con').css('border', '1px solid red');
			}else{
				$('#mensaje_nom_con').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#nom_con').css('border', '1px solid green');
			}		 
		});

			$('#ci_con').blur(function(){

			if($('#ci_con').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_ci_con').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#ci_con').css('border', '1px solid red');
			}else{
				$('#mensaje_ci_con').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#ci_con').css('border', '1px solid green');
			}		 
		});
			
			$('#ocu_con').blur(function(){

			if($('#ocu_con').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_ocu_con').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#ocu_con').css('border', '1px solid red');
			}else{
				$('#mensaje_ocu_con').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#ocu_con').css('border', '1px solid green');
			}		 
		});

			$('#nom_grup').blur(function(){

			if($('#nom_grup').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_nom_grup').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#nom_grup').css('border', '1px solid red');
			}else{
				$('#mensaje_nom_grup').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#nom_grup').css('border', '1px solid green');
			}		 
		});

			$('#imp_sol').blur(function(){

			if($('#imp_sol').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_imp_sol').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#imp_sol').css('border', '1px solid red');
			}else{
				$('#mensaje_imp_sol').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#imp_sol').css('border', '1px solid green');
			}		 
		});

			$('#tas_int').blur(function(){

			if($('#tas_int').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_tas_int').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#tas_int').css('border', '1px solid red');
			}else{
				$('#mensaje_tas_int').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#tas_int').css('border', '1px solid green');
			}		 
		});

			$('#plz_mes').blur(function(){

			if($('#plz_mes').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_plz_mes').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#plz_mes').css('border', '1px solid red');
			}else{
				$('#mensaje_plz_mes').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#plz_mes').css('border', '1px solid green');
			}		 
		});

			$('#nro_cta').blur(function(){

			if($('#nro_cta').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_nro_cta').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#nro_cta').css('border', '1px solid red');
			}else{
				$('#mensaje_nro_cta').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#nro_cta').css('border', '1px solid green');
			}		 
		});

			$('#aho_ini').blur(function(){

			if($('#aho_ini').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_aho_ini').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#aho_ini').css('border', '1px solid red');
			}else{
				$('#mensaje_aho_ini').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#aho_ini').css('border', '1px solid green');
			}		 
		});

			$('#aho_dur').blur(function(){

			if($('#aho_dur').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_aho_dur').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#aho_dur').css('border', '1px solid red');
			}else{
				$('#mensaje_aho_dur').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#aho_dur').css('border', '1px solid green');
			}		 
		});

			$('#hra_reu').blur(function(){

			if($('#hra_reu').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_hra_reu').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#hra_reu').css('border', '1px solid red');
			}else{
				$('#mensaje_hra_reu').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#hra_reu').css('border', '1px solid green');
			}		 
		});

			$('#dir_reu').blur(function(){

			if($('#dir_reu').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_dir_reu').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#dir_reu').css('border', '1px solid red');
			}else{
				$('#mensaje_dir_reu').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#dir_reu').css('border', '1px solid green');
			}		 
		});
				$('#cod_ext').blur(function(){

			if($('#cod_ext').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_cod_ext').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#cod_ext').css('border', '1px solid red');
			}else{
				$('#mensaje_cod_ext').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#cod_ext').css('border', '1px solid green');
			}		 
		});
				$('#cod_int').blur(function(){

			if($('#cod_int').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_cod_int').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#cod_int').css('border', '1px solid red');
			}else{
				$('#mensaje_cod_int').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#cod_int').css('border', '1px solid green');
			}		 
		});

				$('#mon').blur(function(){

			if($('#mon').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_mon').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#mon').css('border', '1px solid red');
			}else{
				$('#mensaje_mon').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#mon').css('border', '1px solid green');
			}		 
		});

					$('#continente').blur(function(){

			if($('#continente').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_continente').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#continente').css('border', '1px solid red');
			}else{
				$('#mensaje_continente').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#continente').css('border', '1px solid green');
			}		 
		});
					$('#pais').blur(function(){

			if($('#pais').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_pais').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#pais').css('border', '1px solid red');
			}else{
				$('#mensaje_pais').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#pais').css('border', '1px solid green');
			}		 
		});

					$('#ciudad').blur(function(){

			if($('#ciudad').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_ciudad').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#ciudad').css('border', '1px solid red');
			}else{
				$('#mensaje_ciudad').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#ciudad').css('border', '1px solid green');
			}		 
		});

					$('#fax').blur(function(){

			if($('#fax').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_fax').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#fax').css('border', '1px solid red');
			}else{
				$('#mensaje_fax').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#fax').css('border', '1px solid green');
			}		 
		});
			
			$('#contacto').blur(function(){

			if($('#contacto').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_contacto').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#contacto').css('border', '1px solid red');
			}else{
				$('#mensaje_contacto').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#contacto').css('border', '1px solid green');
			}		 
		});

			$('#email_cont').blur(function(){

			if($('#email_cont').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_email_cont').html('<p id="mensaje_error"><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeIn(1000);
				$('#email_cont').css('border', '1px solid red');
			}else{
				$('#mensaje_email_cont').html('<p><font size=1 face="Arial" color="#9f1313">Campo vacio</font></p>').hide().fadeOut(1000);
				$('#email_cont').css('border', '1px solid green');
			}		 
		});
	}
}
/* email_cont
function Form1(){
	this.init = function(){
		$('#Campo').blur(function(){

			if($('#Campo').val() == ""){
				//alert("vacio el nombre");
				$('#mensaje_campo').html('<p id="mensaje_error">El campo numerico esta vacio</font></p>').hide().fadeIn(1000);
				$('#Campo').css('border', '1px solid red');
			}else{
				$('#mensaje_campo').html('<p>El campo numerico esta vacio</font></p>').hide().fadeOut(1000);
				$('#Campo').css('border', '1px solid green');
			}		 
		});
	}
}
*/
