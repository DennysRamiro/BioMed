$(document).on("ready",function(){
								
//$(document).ready(function (){
$.getScript("js/xp_progress.js");

});
// JavaScript Document
 // http://www.terra.es/personal3/davidhdezsanz/  
 // Validacion de distintos tipos de campos de formulario:  
   // Texto no nulo  
 //- Direccion de correo electronico (e-mail): alfanum@alfanum.alfanum[.alfanum], donde alfanum son caracteres alfanumericos u otros (pasados como parametro)  
  // 7. // - Direccion en Internet (URL)  
  // 8. // Para ello no se utilizan expresiones regulares.  
  // 9. //  
//  10. //Este script y otros muchos pueden  
//  11. //descarse on-line de forma gratuita  
//  12. //en El Código: www.elcodigo.com  
//  13.   
//  14. /* dice si cadena es texto no vacio o no  */

  // Lista Multiples
  /* function check(form) {
if(document.form2["nro_doc[]"].value == ""){

//alert('Please choose a widget for Question #2!');
 $("#dialog-confirm").dialog({
        resizable: false,
          height:260,
          modal: true,
          buttons: {
          
          Cerrar: function() {
            $( this ).dialog( "close" );
          }
          }             
      });


return false; 
}



return true;
}*/

 function vacio(cadena)  
   {                                   // DECLARACION DE CONSTANTES  
     var blanco = " \n\t" + String.fromCharCode(13); // blancos  
                                        // DECLARACION DE VARIABLES  
     var i;                             // indice en cadena  
     var es_vacio;                      // cadena es vacio o no  
     for(i = 0, es_vacio = true; (i < cadena.length) && es_vacio; i++) // INICIO  
         es_vacio = blanco.indexOf(cadena.charAt(i)) != - 1;  
       return(es_vacio);  
  }  
  
  
 // 27. /* dice si cadena es un email (alfanum@alfanum.alfanum[.alfanum]) o no, don- */  
 // 28. /* de alfanum son caracteres alfanumericos u otros                           */  
 function email(cadena, otros)  
   {                                    // DECLARACION-INICIALIZACION VARIABLES  
       var i, j;                          // indice en cadena  
       var es_email = 0 < cadena.length;  // cadena es email o no  
      i = salta_alfanumerico(cadena, 0, otros); // INICIO  
       if(es_email = 0 < i)               // lee "alfanum*"  
         if(es_email = (i < cadena.length))  
           if(es_email = cadena.charAt(i) == '@') // lee "alfanum@*"  
             {  
               i++;  
               j = salta_alfanumerico(cadena, i, otros);  
               if(es_email = i < j)       // lee "alfanum@alfanum*"  
                 if(es_email = j < cadena.length)  
                   if(es_email = cadena.charAt(j) == '\.')  
                     {                    // lee "alfanum@alfanum.*"  
                       j++;  
                       i = salta_alfanumerico(cadena, j, otros);  
                       if(es_email = j < i) // lee "alfanum@alfanum.alfanum*"  
                         while(es_email && (i < cadena.length))  
                           if(es_email = cadena.charAt(i) == '\.')  
                             {  
                               i++;  
                               j = salta_alfanumerico(cadena, i, otros);  
                               if(es_email = i < j) // lee "alfanum@alfanum.alfanum[.alfanum]*"  
                                 i = j;  
                             }  
                     }  
             }  
       return(es_email);  
     }  
    
     
  //61. /* dice si cadena es url (http://... ) o no                                     */  
   function url(cadena)  
     {                                    // DECLARACION DE CONSTANTES  
       var http = "http://";              // protocolo HTTP  
                                          // DECLARACION DE VARIABLES  
       var es_url;                        // cadena es url o no  
       if(cadena.length <= 7)             // INICIO  
         es_url = false;                  // no cabe "http://*"  
       else  
         es_url = http.indexOf(cadena.substring(0, 7)) != - 1; // lee "http://*"  
       return(es_url);  
     }  
  
  //75. /* salta caracteres alfanumericos y otros a partir de  cadena[i]  y  da  si- */  
  //76. /* guiente posicion                                                          */  
   function salta_alfanumerico(cadena, i, otros)  
     {                                    // DECLARACION DE VARIABLES  
       var j;                             // indice en cadena  
       var car;                           // caracter de cadena  
       var alfanum;                       // cadena[j] es alfanumerico u otros  
       for(j = i, alfanum = true; (j < cadena.length) && alfanum; j++) // INICIO  
         {  
           car = cadena.charAt(j);  
           alfanum = alfanumerico(car) || (otros.indexOf(car) != -1);  
         }  
       if(!alfanum)                       // lee "alfanumX"  
         j--;  
       return(j);  
     }  
       
  //92. /* dice si car es alfanumerico                                               */  
   function alfanumerico(car)  
     {  
       return(alfabetico(car) || numerico(car));  
     }  
     
  // /* dice si car es alfabetico                                                 */  
 function alfabetico(car)               // DECLARACION DE CONSTANTES  
    {                                    // caracteres alfabeticos  
      var alfa = "ABCDEFGHIJKLMNOPQRSTUWXYZabcdefghijklmnopqrstuvxyz";  
      return(alfa.indexOf(car) != - 1);  // INICIO  
    }  
 
 //107. /* dice si car es numerico                                                   */  
 function numerico(car)  
   {                                    // DECLARACION DE CONSTANTES  
      var num = "0123456789";            // caracteres numericos  
      return(num.indexOf(car) != - 1);   // INICIO  
   }  
   function isNum(q) {

		for ( i = 0; i < q.length; i++ ) {
		//con el for y la sentencia if( q.charAt(i) = " " ){... ..ya me queda lista para validar los espacios en blanco, de lo contrario:
			valor = parseInt(q.charAt(i)); // me permite convertir letra por letra en numero y si no es un numero entonces no regresa nada
			if (isNaN(valor)) {
				return true
			}
		}
		return false
   }
   
   
 
 //115. // ejemplo validacion formulario  
  function ValidaCampos(form)  
    { 
	 if(vacio(form.log.value) && vacio(form.nombres.value) && vacio(form.ap_pater.value) && vacio(form.ci.value) && vacio(form.fec_nac.value) && vacio(form.direc.value) && vacio(form.fono.value) && vacio(form.cel.value) && vacio(form.email.value)){
		  	ventana=confirm("Realmente quieres consultar con los Campos vacios");
			 if (ventana) {
			 //En ésta parte incluiremos las sentencias que
			 //queremos que se ejecuten al pulsar sobre
			 //el botón Aceptar
				 alert("Has pinchado sobre Aceptar");
			 }
			 else {
			 //En ésta parte incluiremos las sentencias que
			 //queremos que se ejecuten al pulsar sobre
			 //el botón Cancelar
				  alert("Has pinchado sobre Cancelar");
			 }
	  }
	
      else if(vacio(form.log.value))  
        alert("Login esta vacio.");
	  else if(vacio(form.ci.value))
	  	alert("El campo Documento de Identidad esta vacio.");
	
	  else if(vacio(form.nombres.value))
	  	alert("El campo Nombres esta vacio.");
	  else if(vacio(form.ap_pater.value))
	  	alert("El campo Apellido Paterno esta vacio.");
	  else if(vacio(form.ap_mater.value))
	  	alert("El campo Apellido Materno esta vacio.");
	  else if(vacio(form.fec_nac.value))
	  	alert("El campo Fec. Nacimiento esta vacio.");
	  else if(vacio(form.direc.value))
	  	alert("El campo Direccion esta vacio.");
	  else if(vacio(form.fono.value))
	    alert("El campo Telefono Fijo esta vacio.");
	  else if(isNum(form.fono.value)==true)
	  	alert("El campo Telefono Fijo tiene que ser numerico.");
	  else if(vacio(form.cel.value))
	  	alert("El campo Celular no tiene que estar vacio.");
	  else if(vacio(form.email.value))
	  	alert("El campo Email esta vacio.");
	 	else if(vacio(form.fec_nac.value))
	  	alert("El campo fecha nacimiento esta vacio.");
      else if(!email(form.email.value, "-_"))  
        alert("Dirección de correo electrónico incorrecta.");
	  else if(vacio(form.clav.value))
	  	alert("El campo Clave no tiene que estar vacio.")  
      else if(!url(form.url.value))  
        alert("Dirección del sitio incorrecta.");
	    	
      else  
// 125.       //sustituir esta linea por return(true) para hacer el submit de un formulario real  
        alert("Los datos son correctos");  
      return(false);  
   }
  function ValidarCamposUsuario(formulario){
	  	if(vacio(formulario.ci.value))
			alert("El campo Documento de Identificion esta vacio.");
		else if(vacio(formulario.fec_exp.value))
			alert("El campo Fecha de Expiracion es vacio.");
		else if(vacio(formulario.fec_nac.value))
			alert("El campo Fecha de Nacimiento esta vacio.");
		else if(vacio(formulario.nombres.value))
		    alert("El campo Nombres esta vacio.");
		else if(vacio(formulario.ap_pater.value))
			alert("El campo Apellido Paterno esta vacio.");
		else if(vacio(formulario.ap_mater.value))
			alert("El campo Apellido Materno esta vacio.");
		else if(vacio(formulario.direc.value))
			alert("El campo Direccion esta vacio.");
		else if(vacio(formulario.zona.value))
			alert("El campo Zona esta vacio.");
		else{
			
			return(true);
		}
		return(false);
  }
  
  function ValidaCamposClientes(formu){
	  	if(vacio(formu.ci.value))
			alert("El campo Documento de Identificion esta vacio.");
		else if(isNum(formu.ci.value)==true)
		  	alert("El campo Documento de Identificion tiene que ser numerico.");	
		else if(vacio(formu.nombres.value))
		    alert("El campo Nombres esta vacio.");
		else if(vacio(formu.ap_pater.value))
			alert("El campo Apellido Paterno esta vacio.");
		else if(vacio(formu.fec_nac.value))
			alert("El campo Fecha Nacimiento esta vacio.");
		else if(vacio(formu.lu_nac.value))
			alert("El campo Lugar Nacimiento esta vacio.");	
		else if(vacio(formu.direc.value))
			alert("El campo Direccion esta vacio.");		
		else if(vacio(formu.zona.value))
			alert("El campo Zona esta vacio.");	
		else if(vacio(formu.a_eco_uno.value))
			alert("El campo Actividad Economica Principal esta vacio.");
		else if(vacio(formu.ant_tr.value))
			alert("El campo Antiguedad Actividad Economica esta vacio.");	
	    else if(isNum(formu.ant_tr.value)==true)
		  	alert("El campo Antiguedad Actividad tiene que ser numerico.");
		else if(vacio(formu.dir_tr.value))
			alert("El campo Direccion Trabajo Negocio esta vacio.");
		else if(vacio(formu.zon_tr.value))
			alert("El campo Zona de Trabajo Negocio esta vacio.");	
		else if(vacio(formu.nom_ref.value))
			alert("El campo Nombre Referencia Personal esta vacio.");		
		else if(vacio(formu.dir_ref.value))
			alert("El campo Direccion Referencia Personal esta vacio.");		
		else{
			
			return(true);
		}
		return(false);
  }
  function ValidarCamposAdicional(formulario){
	  	if(vacio(formulario.ci.value))
			alert("El campo Documento de Identificion esta vacio.");
		else if(vacio(formulario.fec_des.value))
			alert("El campo Fecha Desembolso esta vacio.");
		else if(vacio(formulario.fec_nac.value))
			alert("El campo Fecha de Nacimiento esta vacio.");
		else if(vacio(formulario.nro_cta.value))
		    alert("El campo Numero de cuotas esta vacio.");
		else if(vacio(formulario.plz_mes.value))
			alert("El campo Plazo en meses esta vacio.");
		else if(vacio(formulario.imp_sol.value))
			alert("El campo Importe Solicitado esta vacio.");
		else if(vacio(formulario.direc.value))
			alert("El campo Direccion esta vacio.");
		else if(vacio(formulario.zona.value))
			alert("El campo Zona esta vacio.");
		else{
			
			return(true);
		}
		return(false);
  }
   function ValidarCamposSolicitud(formulario){
	  	 if(vacio(formulario.imp_sol.value))
			alert("El campo Importe Solicitado esta vacio.");
		else if(vacio(formulario.tas_int.value))
			alert("El campo Tasa interes anual esta vacio.");
		else if(formulario.tas_int.value < 0)
			alert("El campo Tasa interes anual menos del 20%");	
		else if(formulario.tas_int.value > 100)
			alert("El campo Tasa interes anual mas del 50%");
		else if(vacio(formulario.plz_mes.value))
			alert("El campo Plazo en meses esta vacio.");
		else if(vacio(formulario.nro_cta.value))
		    alert("El campo Numero de cuotas esta vacio.");	
		
		else if(formulario.aho_ini.value > 100)
			alert("El campo Fondo de Garantía Inicio mas del 50%");	
		else if(formulario.aho_dur.value > 100)
			alert("El campo Fondo de Garantía Durante Ciclo mas del 50%");		
			
		else if(vacio(formulario.fec_des.value))
			alert("El campo Fecha Desembolso esta vacio.");
		
		else if(vacio(formulario.fec_uno.value))
			alert("El campo Fecha Primer Pago esta vacio.");
		else if(formulario.fec_des.value > formulario.fec_uno.value)
			alert("El campo Fecha Primer Pago no puede ser menor a Fecha Desembolso.");	
		else if(formulario.cod_ope.value < 3)
			
			if(vacio(formulario.hra_reu.value))
			alert("El Tipo Opera Solidario Hora de reunion debe registrarse")
			if(vacio(formulario.dir_reu.value))
			alert("El Tipo Opera Solidario Lugar de reunion debe registrarse");
					
				
		else{
			
			return(true);
		}
		return(false);
  }
  
   function ValidarCamposGrupo(formu){
	  	if(vacio(formu.nom_grup.value))
			alert("El campo Nombre de Grupo esta vacio.");
			else{
			return(true);
		}
		return(false);
  }
  function ValidaCamposClientesMod(formu){
	  	if(vacio(formu.nombres.value))
		    alert("El campo Nombres esta vacio.");
		else if(vacio(formu.ap_pater.value))
			alert("El campo Apellido Paterno esta vacio.");
		else if(vacio(formu.fec_nac.value))
			alert("El campo Fecha Nacimiento esta vacio.");
		else if(vacio(formu.lu_nac.value))
			alert("El campo Lugar Nacimiento esta vacio.");	
		else if(vacio(formu.direc.value))
			alert("El campo Direccion esta vacio.");		
		else if(vacio(formu.zona.value))
			alert("El campo Zona esta vacio.");	
		else if(vacio(formu.a_eco_uno.value))
			alert("El campo Actividad Economica Principal esta vacio.");
		else if(vacio(formu.ant_tr.value))
			alert("El campo Antiguedad Actividad Economica esta vacio.");	
	    else if(isNum(formu.ant_tr.value)==true)
		  	alert("El campo Antiguedad Actividad tiene que ser numerico.");
		else if(vacio(formu.dir_tr.value))
			alert("El campo Direccion Trabajo Negocio esta vacio.");
		else if(vacio(formu.zon_tr.value))
			alert("El campo Zona de Trabajo Negocio esta vacio.");	
		else if(vacio(formu.nom_ref.value))
			alert("El campo Nombre Referencia Personal esta vacio.");		
		else if(vacio(formu.dir_ref.value))
			alert("El campo Direccion Referencia Personal esta vacio.");		
		else{
			
			return(true);
		}
		return(false);
  }
  
  function ValidarRangoFechass(formulario){
	  	if(vacio(formulario.fec_des.value))
		   alert("El campo Fecha Desde esta vacio.");
		 else if(vacio(formulario.fec_has.value))
		   alert("El campo Fecha Hasta esta vacio.");
		 else{
			
			return(true);
		}
		return(false);
  }
  
  // fechass
  function ValidarRangoFechas(formu){
	  	fec1=(formu.fec_des.value).split('/');
		fecc1= fec1[1]+'/'+fec1[0]+'/'+fec1[2]; // convierte al formto mm/dd/aa para la funsion Date()
		
		fec2=(formu.fec_has.value).split('/');
		fecc2= fec2[1]+'/'+fec2[0]+'/'+fec2[2];
	
		  var fec_dess= new Date(fecc1);
		  var fec_hass= new Date(fecc2);
		  var fec_actual= new Date( ); 

	  	$('#progressbar').show(100);	// permite mostrar la barra de progreso de los asiento de Mantenimiento UFVs
		
		if(vacio(formu.fec_des.value)){

			$("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.fec_has.value)){
			$("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(fec_dess > fec_hass){
			$("#dialog-confirm3").dialog({
				height: 140,
             modal: true					
			});
			
		}else if((fec_dess > fec_actual) ){
			$("#dialog-confirm4").dialog({
				height: 140,
             modal: true					
			});
			
		}else if((fec_hass > fec_actual)){
			$("#dialog-confirm5").dialog({
				height: 140,
             modal: true					
			});
			
		}else {
			return(true);
		}
		return(false);
 
  }
  
   function ValidarBarraProgreso(formu){

	  	$('#progressbar').show(100);	// permite mostrar la barra de progreso de los asiento de Mantenimiento UFVs

  }
  
  // validar solo campo fechaHasta

  function ValidarRangoFecha_Hasta(formu){
		fec2=(formu.fec_has.value).split('/');
		fecc2= fec2[1]+'/'+fec2[0]+'/'+fec2[2];
		  var fec_hass= new Date(fecc2);
		  var fec_actual= new Date( ); 
		  
	  	 if(vacio(formu.fec_has.value))
		   $("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
		
	else if((fec_hass > fec_actual)){
			$("#dialog-confirm5").dialog({
				height: 140,
             modal: true					
			});
			
		}else {
			return(true);
		}
		return(false);

    }
  //campo fechA
  function ValidarCampoFecha(formu){
	  fec2=(formu.fec_nac.value).split('/');
		fecc2= fec2[1]+'/'+fec2[0]+'/'+fec2[2];
		  var fec_hass= new Date(fecc2);
		  var fec_actual= new Date( ); 
	  
	  	 if(vacio(formu.fec_nac.value)){
		   $("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
		 }
		else if(fec_hass > fec_actual){
		   $("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
		 }
		else{
			return(true);
		}
		return(false);

    }
	
	// vlidar fecha Desde que no sea mayor  la fecha Hasta
	
    // validar campo de lista
  function ValidarCampoLista(formu){
	  	 if(vacio(formu.nro_tra.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm").dialog({
			height: 140,
             modal: true					
			});
		
		else{
			return(true);
		}
		return(false);

    }
	   // validar campo de lista
  function ValidarCampoListaCta(formu){
	  	 if((formu.cod_cta.value)=NULL)
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
		
		else{
			return(true);
		}
		return(false);s

    }

	
  // vlid camposss
   function ValidaCamposEgresos(formu){
	  	if(vacio(formu.glosa_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(!vacio(formu.debe_1.value) && !vacio(formu.haber_1.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm12").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(!vacio(formu.debe_1.value) && !vacio(formu.debe_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm14").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(!vacio(formu.haber_1.value) && !vacio(formu.haber_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm15").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(!vacio(formu.debe_1.value) && !vacio(formu.haber_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm16").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(!vacio(formu.debe_2.value) && !vacio(formu.haber_1.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm17").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(!vacio(formu.debe_2.value) && !vacio(formu.haber_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm13").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.descrip.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
		else  {
			return(true);
		}
		return(false);
  }

  // valida campos moneda BS y descripcion BANCOSS
   function ValidaCamposBanco_Dep_Bs(formu){
   
	  	if(vacio(formu.egr_monto.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.descrip.value))
		 $("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
  }

  
   // valida campos moneda SUS y descripcion BANCOSS
   function ValidaCamposBanco_Dep_Sus(formu){
	  	if(vacio(formu.egr_monto.value)){
			$("#dialog-confirm3").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.descrip.value))
		   $("#dialog-confirm4").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
  }
  
    // valida campos moneda BS y descripcion DEPOSITOS INGRESOS
   function ValidaCamposBanco_Dep_Bs_Radio(formu){
        if(vacio(formu.deposito.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmDep").dialog({
				height: 140,
             modal: true					
			});
		}else if(vacio(formu.cod_bco.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-cod_bco").dialog({
				height: 140,
             modal: true					
			});	
		}else if(vacio(formu.cod_cta.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-cod_cta").dialog({
				height: 140,
             modal: true					
			});			
	  	}else if(vacio(formu.egr_monto.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmBs1").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.descrip.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmBs2").dialog({
				height: 140,
             modal: true					
			});
		
		
		
		}else if($("input[name='myradio']:checked").length < 1)
			 $("#dialog-confirmBs3").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
  }

  
    // valida campos moneda BS y descripcion RETIRO EGRESOS 
   function ValidaCamposBanco_Ret_Bs_Radio(formu){
      //  if(vacio(formu.deposito.value)){
			//alert("El campo Monto no puede estar vacio.");
		//	$("#dialog-confirmDep").dialog({
			//	height: 140,
          //   modal: true					
		//	});
		 if(vacio(formu.cod_bco.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-cod_bco").dialog({
				height: 140,
             modal: true					
			});	
		}else if(vacio(formu.cod_cta.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-cod_cta").dialog({
				height: 140,
             modal: true					
			});			
	  	}else if(vacio(formu.egr_monto.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmBs1").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.descrip.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmBs2").dialog({
				height: 140,
             modal: true					
			});
		
		
		
		}else if($("input[name='myradio']:checked").length < 1)
			 $("#dialog-confirmBs3").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
  }

   // valida campos moneda SUS y descripcion DEPOSITOS/RETIRO INGRESOS/EGRESOS 
   function ValidaCamposBanco_Dep_Sus_Radio(formu){
	   if(vacio(formu.deposito.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmDep").dialog({
				height: 140,
             modal: true					
			});
		}else if(vacio(formu.cod_bco.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-cod_bco").dialog({
				height: 140,
             modal: true					
			});	
		}else if(vacio(formu.cod_cta.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-cod_cta").dialog({
				height: 140,
             modal: true					
			});			
	    }else if(vacio(formu.egr_monto.value)){
			$("#dialog-confirmSus1").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.descrip.value)){
			$("#dialog-confirmSus2").dialog({
				height: 140,
             modal: true					
			});
			
		}else if($("input[name='myradio']:checked").length < 1)
		   $("#dialog-confirmSus3").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
  }
 
  // valid campos fctura
     function ValidaCamposFactura(formu){
	 fec1=(formu.fec_fac.value).split('/');
	 fecc1= fec1[1]+'/'+fec1[0]+'/'+fec1[2];
		var fec_facc= new Date(fecc1);
		var fec_actual= new Date();
	  	if(vacio(formu.nit.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac1").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.nro_fac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac2").dialog({
				height: 140,
             modal: true					
			});
		}else if(vacio(formu.cod_ban.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-cod_ban_Fac2").dialog({
				height: 140,
             modal: true					
			});	
		}else if(vacio(formu.con_cuen.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-con_cuen_Fac2").dialog({
				height: 140,
             modal: true					
			});		
			
		}else if(vacio(formu.nro_auto.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac3").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.razon_social.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac4").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.fec_fac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac5").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(fec_facc > fec_actual){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac6").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.imp_tot.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac7").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.tot_neto.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac8").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.cred_fisc_iva.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac9").dialog({
				height: 140,
             modal: true					
			});
			
		}//else  if(vacio(formu.cod_control.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   /*$("#dialog-confirm_Fac10").dialog({
			height: 140,
             modal: true					
			});*/
		else{
			return(true);
		}
		return(false);
  }
  // valid campos Retiro factura
     function ValidaCampos_Retiro_Factura(formu){
	 fec1=(formu.fec_fac_ret.value).split('/');
	 fecc1= fec1[1]+'/'+fec1[0]+'/'+fec1[2];
		var fec_facc= new Date(fecc1);
		var fec_actual= new Date();
	  	if(vacio(formu.nit_ret.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac1").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.nro_fac_ret.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac2").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.nro_auto_ret.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac3").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.razon_social_ret.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac4").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.fec_fac_ret.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac5").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(fec_facc > fec_actual){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac6").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.imp_tot_ret.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac7").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.tot_neto_ret.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac8").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.cred_fisc_iva_ret.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm_Fac9").dialog({
				height: 140,
             modal: true					
			});
			
		}/*else  if(vacio(formu.cod_control_ret.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm_Fac10").dialog({
			height: 140,
             modal: true					
			});*/
		else{
			return(true);
		}
		return(false);
  } 
  // validar 
   function Verificar(formu)
    {
		  if(vacio(formu.nomb_g.value) )
		   
		   $("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);

    }
  
  //otro
  function ValidaCamposDosificacion(formu){
	
		fec1=(formu.fec_des.value).split('/');
		fecc1= fec1[1]+'/'+fec1[0]+'/'+fec1[2];
		
		fec2=(formu.fec_has.value).split('/');
		fecc2= fec2[1]+'/'+fec2[0]+'/'+fec2[2];
	
		  var fec_dess= new Date(fecc1);
		  var fec_hass= new Date(fecc2);
		  
		  var fec_actual= new Date();
	
	  	if(vacio(formu.cod_ord.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				height: 140,
                modal: true					
			});
			
		}else 	if(vacio(formu.nro_fac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				height: 140,
                modal: true					
			});
			
		}else 	if(vacio(formu.fec_des.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
				height: 140,
                modal: true					
			});
			
		}else 	if(vacio(formu.fec_has.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm3").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.llave.value)){
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm4").dialog({
				height: 140,
             modal: true					
			});
		
		}else if(fec_dess > fec_hass){
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm5").dialog({
				height: 140,
             modal: true					
			});
		}else if((fec_dess > fec_actual)){
			$("#dialog-confirm6").dialog({
				height: 140,
             modal: true					
			});
			
		}else if((fec_hass> fec_actual)){
			$("#dialog-confirm7").dialog({
				height: 140,
             modal: true					
			});
			
		}else{
			return(true);
		}
		return(false);
 
  }
//otro
  function ValidaCamposDosificacionManual(formu){
  	// nro autorizacion
	fec1=(formu.fec_des.value).split('/');
	fecc1= fec1[1]+'/'+fec1[0]+'/'+fec1[2];
	
	var fec_dess= new Date(fecc1);
	var fec_actual= new Date();
	  	if(vacio(formu.cod_orden.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				height: 140,
             modal: true					
			});
			
		}else 	if(vacio(formu.nro_fac_des.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
			
		}else 	if(vacio(formu.nro_fac_has.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm3").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if( (formu.nro_fac_des.value) > (formu.nro_fac_has.value)){
			$("#dialog-confirm4").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(fec_dess > fec_actual){
			$("#dialog-confirm6").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.cantidad.value))
		   $("#dialog-confirm5").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  }
 // libro de ventas
   function ValidarCamposLibroVentas(formu)
    {
		  if(vacio(formu.fec_nac.value) )
		   
		   $("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);

    }
  // libro de compras
   function ValidarCamposLibroCompras(formu)
    {
		  if(vacio(formu.fec_nac.value) )
		   
		   $("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);

    }
 // Ventas Texto
   function ValidarCamposVentasTexto(formu)
    {
		  if(vacio(formu.fec_nac.value) )
		   
		   $("#dialog-confirm").dialog({
			height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);

    }
 // Compra Texto
   function ValidarCamposComprasTexto(formu)
    {
		  if(vacio(formu.fec_nac.value) )
		   
		   $("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);

    }
//otro
  function ValidaCamposVerificaCodigo(formu){
	fec1=(formu.fec_des.value).split('/');
	fecc1= fec1[1]+'/'+fec1[0]+'/'+fec1[2];
	
	var fec_dess= new Date(fecc1);
	var fec_actual= new Date();
	  
	  	if(vacio(formu.cod_ord.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.nro_fac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.fec_des.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(fec_dess > fec_actual){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm6").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.nro_nit.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm3").dialog({
				height: 140,
             modal: true					
			});
			
		}else 	if(vacio(formu.llave.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm4").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.monto.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm5").dialog({
				height: 140,
             modal: true					
			});
			
		}
		else{
			return(true);
		}
		return(false);
 
  }
 //Control Entrega
  function ValidaCamposControlEntrega(formu){
	  	if(vacio(formu.nro_rec1.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				 height: 140,
                 modal: true					
			});
			
		}else if((formu.nro_rec1.value)> (formu.nro_rec2.value) ){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm3").dialog({
			 height: 140,
             modal: true					
			});
			
		}else  if(vacio(formu.nro_rec2.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm2").dialog({
				 height: 140,
                 modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  }
 // Ventas Texto
   function ValidarCamposActUfv(formu)
    {
		  if(vacio(formu.fec_nac.value) )
		   
		   $("#dialog-confirm").dialog({
				height: 140,
                modal: true					
			});
		else{
			return(true);
		}
		return(false);

    }
	
 // Campo glosa
   function ValidarCampoGlosa(formu)
    {
	 	if(!vacio(formu.debe_1.value) && !vacio(formu.haber_1.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm12").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(!vacio(formu.debe_1.value) && !vacio(formu.debe_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm14").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(!vacio(formu.haber_1.value) && !vacio(formu.haber_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm15").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(!vacio(formu.debe_1.value) && !vacio(formu.haber_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm16").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(!vacio(formu.debe_2.value) && !vacio(formu.haber_1.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm17").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(!vacio(formu.debe_2.value) && !vacio(formu.haber_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm13").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.debe_1.value) && vacio(formu.haber_1.value) && vacio(formu.debe_2.value) && vacio(formu.haber_2.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm18").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.glosa.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				height: 140,
                modal: true					
			});
			
		}else  {
			return(true);
		}
		return(false);
 
  }
//consulta asiento
  function ValidaCamposConsultaAsiento(formu){
	  	 if(vacio(formu.fec_nac.value) && vacio(formu.nro_doc.value) )
		   
		   $("#dialog-confirm3").dialog({
				height: 140,
                modal: true					
			});
		else{
			return(true);
		}
		return(false);

    }

	  	/*if(vacio(formu.fec_nac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.nro_doc.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
				height: 140,
                modal: true					
			});
			
		}else {
			return(true);
		}
		return(false);

  }*/
  //consulta asiento
  function ValidaCamposConsultaAsientoReservas(formu){
	  	if(vacio(formu.fec_nac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.nro_doc.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(formu.nro_doc.value>10)
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm3").dialog({
				height: 140,
                modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  }
//asiento de revalorizacion
  function ValidaCamposAsientoRevalorizacion(formu){
	  	if(vacio(formu.tc_contab.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
			
		}else 	if(vacio(formu.tc_compra.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if(vacio(formu.tc_venta.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  }

//alta de cuentas
  function ValidaCamposAltaCuentas(formu){
	  	if(vacio(formu.cod_cta.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
			
		}else 	if(vacio(formu.niv_cta.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.descrip.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if(vacio(formu.cod_cta_r.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm3").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  }
//Estado Situacion bs
  function ValidaCamposEstadoBs(formu){
	  
	  fec1=(formu.fec_nac.value).split('/');
	fecc1= fec1[1]+'/'+fec1[0]+'/'+fec1[2];
	
	var fec_dess= new Date(fecc1);
	var fec_actual= new Date();
	  
	  	if(vacio(formu.fec_nac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(fec_dess>fec_actual)
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  }
 //Valida reservados
 function check() {
if(document.form2["nro_doc[]"].value == ""){

//alert('Please choose a widget for Question #2!');
 $("#dialog-confirm").dialog({
        height: 140,
             modal: true					
			});


return false; 
}



return true;
}
// Valida campo lista ctas 
function checkCtas() {
if(document.form2["cod_cta[]"].value == ""){

//alert('Please choose a widget for Question #2!');
 $("#dialog-confirm").dialog({
        height: 140,
             modal: true					
			});
	return false; 
	}
	return true;
}
  // validar campo de lista de Recibos Utilizados
 function checkRec() {
if((document.form2.nro_tal.value).length < 1){
	
 $("#dialog-confirm").dialog({
        height: 140,
             modal: true					
			});
	return false; 
	}
	return true;
}
 
 // validar reversion
  function Reversion() {
	
 $("#dialog-confirm-reversion").dialog({
        height: 140,
             modal: true					
			});
	return false; 
	
	
}


//Estado Situacion bs
  function ValidaCamposDepositoFactura(formu){
	  	if(vacio(formu.nit.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm5").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.nro_fac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm6").dialog({
				height: 140,
             modal: true					
			});
			
		}else 	if(vacio(formu.nro_auto.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm7").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.razon_social.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm8").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.fec_fac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm9").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.imp_tot.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm10").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if(vacio(formu.tot_neto.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm11").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.cred_fisc_iva.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm12").dialog({
				height: 140,
             modal: true					
			});
			
		}/*else if(vacio(formu.cod_control.value))
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm13").dialog({
				height: 140,
             modal: true					
			});*/
		else{
			return(true);
		}
		return(false);
 
  }
	
	//Alta Usuario
  function ValidaCamposAltaUsuario(formu){
	  	if(vacio(formu.log.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.ci.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.clav.value)){
			//else 	if(vacio(formu.password.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm3").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.nombres.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm4").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.ap_pater.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm5").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.ap_mater.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm6").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.direc.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm7").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.fono.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm8").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.celu.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm9").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if(vacio(formu.email.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm10").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  }	
//modificar alata
  function ValidaCamposModificarAlta(formu){
	  	 if(vacio(formu.ci.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				height: 140,
             modal: true					
			});
			
		}else 	if(vacio(formu.nombres.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if(vacio(formu.ap_pater.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm3").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if(vacio(formu.ap_mater.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm4").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.clav.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm5").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  } 
   //alta almacen 
  function ValidaCamposAltaAlmacen(formu){
	  	if(vacio(formu.nombres.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.cod_ext.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.direc.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm4").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.fono.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm5").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.celu.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm6").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.email.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm7").dialog({
				height: 140,
                modal: true					
			});
			
		}else if(vacio(formu.contacto.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm8").dialog({
				height: 140,
                modal: true					
			});
			
		}else  if(formu.email_cont.value>10)
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm9").dialog({
				height: 140,
                modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  } 
//otro
  function ValidaCamposCortes(formu){
	  	if(vacio(formu.egr_monto.value))
			alert("El campo Cantidad cortes no puede estar vacio.");
		   else{
			return(true);
		}
		return(false);
  }

//Valida Campos  alta Agencia Aduanera
  function ValidaCampos_Alta_Aduanera(formu){
	  	 if(vacio(formu.nombre.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmAltaAduanera1").dialog({
				height: 140,
             modal: true					
			});
			
		}else 	if(vacio(formu.nit.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmAltaAduanera2").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if(vacio(formu.dir.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmAltaAduanera3").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if(vacio(formu.tel.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirmAltaAduanera4").dialog({
				height: 140,
             modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  } 

//Valida Campos  alta Agencia Aduanera Formulario
  function ValidaCampos_Alta_Adu_Formulario(formu){
	fec1=(formu.fec.value).split('/');
	fecc1= fec1[1]+'/'+fec1[0]+'/'+fec1[2];
	
	var fec= new Date(fecc1);
	var fec_actual= new Date();
		
		
		 if(vacio(formu.nro_fac.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmAltaAduaForm1").dialog({
				height: 140,
             modal: true					
			});
			
		}else 	if(vacio(formu.fec.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmAltaAduaForm2").dialog({
				height: 140,
             modal: true					
			});
			
		}else  if(fec > fec_actual){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmAltaAduaForm3").dialog({
				height: 140,
             modal: true					
			});
			
		}else if(vacio(formu.nro_sid.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirmAltaAduaForm4").dialog({
				height: 140,
             modal: true					
			});
			
		}else {
			return(true);
		}
		return(false);
 
  } 
   //Control Alta proyecto
  function ValidaCamposAltaProyecto(formu){
	  	if(vacio(formu.nombres.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm1").dialog({
				 height: 140,
                 modal: true					
			});
			
		}else if(vacio(formu.cod_proy.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm2").dialog({
			 height: 140,
             modal: true					
			});
			
		}else if((formu.fec_ini.value)>(formu.fec_fin.value)){
			//alert("El campo Monto no puede estar vacio.");
			$("#dialog-confirm4").dialog({
			 height: 140,
             modal: true					
			});
			
		}else   if(vacio(formu.fec_ini.value))
		   // alert("El campo Descripcion esta vacio.");
		   //$("#dialog").dialog(); dialogo sin botonnnnn 
		   
		   $("#dialog-confirm3").dialog({
				 height: 140,
                 modal: true					
			});
		else{
			return(true);
		}
		return(false);
 
  }


//confirmacion de cerre
function confirmar_cierre()
{
	if(confirm('Esta seguro de realizar el Cierre Diario?'))
		return true;
	else
		return false;
}

function confirmar_eliminar_usuario()
{
	if(confirm('Esta seguro de realizar el Cierre Diario?'))
		return true;
	else
		return false;
}
//confirmar Reposicion Caja Chica
function confirmar_rep_cajachica()
{
	if(confirm('Esta seguro de Solicitar Reposicion?'))
		return true;
	else
		return false;
}
//confirmar Reponer Caja Chica
function confirmar_reponer_cajachica()
{
	if(confirm('Esta seguro de Procesar Reposicion?'))
		return true;
	else
		return false;
}

//barra de proceso
function progreso()
{

$( "#progressbar" ).progressbar({
value: 37
});

}
