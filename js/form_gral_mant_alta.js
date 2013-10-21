/** Esto ya es javascript*/
$(document).on("ready", function(){
	var Formulario = new Formulario();
	Formulario.init();
});
function Formulario(){
	this.init = function(){
		//$('#datos').hide();
		$('#Campo_Login').blur(function(){
			if($('#Campo_Login').val() == ""){
				//alert("vacio el Campo_Login");
				$('#mensaje').html('<p id="mensaje_error">El campo login esta vacio</p>').hide().fadeIn(1000);
				$('#Campo_Login').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo login esta vacio</p>').hide().fadeOut(1000);
				$('#Campo_Login').css('border', '1px solid green');
			}		 
		});

		$('#CI').blur(function(){
			if($('#CI').val() == ""){
				//alert("vacio el CI");
				$('#mensaje').html('<p id="mensaje_error">El CI esta vacio</p>').hide().fadeIn(1000);
				$('#CI').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo CI esta vacio</p>').hide().fadeOut(1000);
				$('#CI').css('border', '1px solid green');
			}		 
		});

		$('#Nombres').blur(function(){
			if($('#Nombres').val() == ""){
				//alert("vacio el Nombres");
				$('#mensaje').html('<p id="mensaje_error">El campo Nombres esta vacio</p>').hide().fadeIn(1000);
				$('#Nombres').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo Nombres esta vacio</p>').hide().fadeOut(1000);
				$('#Nombres').css('border', '1px solid green');
			}		 
		});

		$('#Apellido_Paterno').blur(function(){
			if($('#Apellido_Paterno').val() == ""){
				//alert("vacio el Apellido_Paterno");
				$('#mensaje').html('<p id="mensaje_error">El campo Apellido Paterno esta vacio</p>').hide().fadeIn(1000);
				$('#Apellido_Paterno').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo Apellido Paterno esta vacio</p>').hide().fadeOut(1000);
				$('#Apellido_Paterno').css('border', '1px solid green');
			}		 
		});

		$('#Apellido_Materno').blur(function(){
			if($('#Apellido_Materno').val() == ""){
				//alert("vacio el Apellido_Materno");
				$('#mensaje').html('<p id="mensaje_error">El campo Apellido Materno esta vacio</p>').hide().fadeIn(1000);
				$('#Apellido_Materno').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo Apellido Materno esta vacio</p>').hide().fadeOut(1000);
				$('#Apellido_Materno').css('border', '1px solid green');
			}		 
		});

		$('#Direccion').blur(function(){
			if($('#Direccion').val() == ""){
				//alert("vacio el Direccion");
				$('#mensaje').html('<p id="mensaje_error">El campo Direccion esta vacio</p>').hide().fadeIn(1000);
				$('#Direccion').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo Direccion esta vacio</p>').hide().fadeOut(1000);
				$('#Direccion').css('border', '1px solid green');
			}		 
		});

		$('#Telefono').blur(function(){
			if($('#Telefono').val() == ""){
				//alert("vacio el Telefono");
				$('#mensaje').html('<p id="mensaje_error">El campo Telefono esta vacio</p>').hide().fadeIn(1000);
				$('#Telefono').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo Telefono esta vacio</p>').hide().fadeOut(1000);
				$('#Telefono').css('border', '1px solid green');
			}		 
		});

		$('#Celular').blur(function(){
			if($('#Celular').val() == ""){
				//alert("vacio el Celular");
				$('#mensaje').html('<p id="mensaje_error">El campo Celular esta vacio</p>').hide().fadeIn(1000);
				$('#Celular').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo Celular esta vacio</p>').hide().fadeOut(1000);
				$('#Celular').css('border', '1px solid green');
			}		 
		});

		$('#Email').blur(function(){
			if($('#Email').val() == ""){
				//alert("vacio el Email");
				$('#mensaje').html('<p id="mensaje_error">El campo Email esta vacio</p>').hide().fadeIn(1000);
				$('#Email').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo Email esta vacio</p>').hide().fadeOut(1000);
				$('#Email').css('border', '1px solid green');
			}		 
		});


		$('#Clave_Ingreso').blur(function(){
			if($('#Clave_Ingreso').val() == ""){
				//alert("vacio el Clave_Ingreso");
				$('#mensaje').html('<p id="mensaje_error">El campo Clave Ingreso esta vacio</p>').hide().fadeIn(1000);
				$('#Clave_Ingreso').css('border', '1px solid red');
			}else{
				$('#mensaje').html('<p>El campo Clave Ingreso esta vacio</p>').hide().fadeOut(1000);
				$('#Clave_Ingreso').css('border', '1px solid green');
			}		 
		});

	}
}
		