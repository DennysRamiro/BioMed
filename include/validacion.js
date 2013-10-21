//funciones utilizadas por otra funcion para la conversion de mes y dia numerales a literales
function getmes(mes)
{
	var resultado;
	switch (mes)
	{
		case 1:
			resultado="Enero"; break;
		case 2:
			resultado="Febrero"; break;
		case 3:
			resultado="Marzo"; break;	
		case 4:
			resultado="Abril"; break;
		case 5:
			resultado="Mayo"; break;
		case 6:
			resultado="Junio"; break;
		case 7:
			resultado="Julio"; break;
		case 8:
			resultado="Agosto"; break;
		case 9:
			resultado="Septiembre"; break;
		case 10:
			resultado="Octubre"; break;
		case 11:
			resultado="Noviembre"; break;	
		case 12:
			resultado="Diciembre"; break;		
	}
	return resultado;
}


function vacio(campo,mensaje)
{
	if (campo=="")
	{
		alert("Error: Campo '"+ mensaje + "' esta vacio !!!");	
		return false;
	}
	else 
		return true;
}

function validarCadena(nombre,mensaje)
{
	var i=0;
	while (i<nombre.length)
	{
		if ((nombre.charAt(i)>='0') && (nombre.charAt(i)<='9'))
		{
			alert("Error: Debe ingresar letras en el el campo '" + mensaje +"'");
			return false;
		}
		else
	  	{
			i=i+1;
		}
	}
	return true;
}

function validarRango(fechaini, fechafin, mensaje)
{ 
	if (fechaini > fechafin)
	{
		alert("Error: Rango de Fechas incorrecto !!!");	
		return false;
	}
	else 
		return true;

}
//verifica que la extension sea xml para el envio de archivos
function verextension(campo,mensaje)
{
	var longitud;
	var exten;
	longitud=campo.length;
	exten=campo.substring((longitud-3),longitud).toUpperCase();
	//alert("la estension es "+exten);
	if(exten=="XLS")
	{
		return true;
	}
	else
	{
		alert("verifique la extension de su archivo debe ser .xls");
		return false;
	}
    
}

function validarEmail(email,mensaje)
{
	if (email=="")
		return true
	else
	{

	var primeraarroba, ultimaarroba;
	primeraarroba=(email.indexOf("@"));
	ultimaarroba=(email.lastIndexOf("@"));
	
	if ( (primeraarroba==-1) || (primeraarroba!=ultimaarroba) )
	{ 
		alert("El email no es correcto.");
		return false;
	}
	if (primeraarroba>=(email.lastIndexOf(".")))	
	{ 
		alert("La dirección del campo '"+mensaje+"' no es correcta.");
		return false;
	}
	return true;
	}
}

function validarNumero(campo,mensaje)
{
		var i=0;
		while (i<campo.length)
		{	
			if ((campo.charAt(i)>='0') && (campo.charAt(i)<='9'))
				i=i+1;
			else
			{
				alert("Hay letras en el campo '"+mensaje+"'");
				return false;
			}
		}
	return true;
}

function validarSeleccion(campo,mensaje)
{

		if(campo<=0)
		{
			alert("Debe de seleccionar en el campo '"+mensaje+"'");
			return false;
		}

	return true;
}

function validarTextArea(campo,mensaje)
{		numCaracteres =campo.value.length
		if(numCaracteres==0)
		{
			alert("No Puede quedar vacio '"+mensaje+"'");
			return false;
		}
		
	return true;
}

//VALIDACION DE FECHAS VERIFICA QUE LA FECHA INICIAL SEA MAYOR O IGUAL A LA FECHA ACTUAL Y ADEMAS LA FECHA FINAL SEA MAYOR A LA FECHA INICIAL
function validarRangoFechas(mesini,mesfin,diaini,diafin,meshoy,diahoy,indiceanioini,indiceaniofin)
{
	
	var band=1;
	var cambio=1;
	var aniosiguales=true;
	if(indiceanioini<=0)
	{
		cambio=0;
		if(indiceaniofin>0)
		{aniosiguales=false}
		
	}

	if(mesini>=meshoy)
	{
		if((diaini+1)<diahoy && (mesini==meshoy))	
		{ band=1;}
		else
		{
			band=0;
		}
	}
	if(band==1 && cambio==0)
	{
	    alert("Error: fecha de inicio debe ser mayor o igual a la fecha actual, la fecha actual es "+diahoy+" de "+getmes(meshoy));	
		return false;
	}

	if ((mesini > mesfin) && (aniosiguales))
	{
		alert("Error: Debe de seleccionar un mes de expiracion mayor al mes de inicio !!!");	
		return false;
	}
	else 
	{
		if(diaini>=diafin && mesini==mesfin)
		{
		 alert("Error: Seleccion de dias incoherente, por lo menos debe existir un rango de un dia");	
		 return false;
		}
			
	}
	return true;

}

// VALIDACION DE CHECKBOX (MAYOR A N)

function checkbox_ok(formul)
{

// set var checkbox_choices to zero

var nrocheck = 0;

// Loop from zero to the one minus the number of checkbox button selections
for (i = 0; i < formul.elements.length; i++)
{
 if (formul.elements[i].type == "checkbox")
 {
  if(formul.elements[i].checked)
  { nrocheck=nrocheck+1; }
 }
}

if (nrocheck == 0)
{
//IGUAL QUE CERO
alert("Por favor haga por lo menos una seleccion. \n \""+ nrocheck +"\" opciones seleccionadas.")
return (false);
}

return (true);
}


function selectall(theBox)
{
 var xState=theBox.checked;
 var elm=theBox.form.elements;

 for(i=0;i<elm.length;i++)
  if(elm[i].type=="checkbox")
    elm[i].checked=xState;

}



function selradioR(Radio)
{
for(i=0;i<Radio.length;i++)
  if(Radio[i].checked == true)
  {
   var text = Radio[i].value;
   if(text == "nombre")
   {
   return ((vacio(Radio[i].form.nombre.value,"NOMBRE")) && (validarCadena(Radio[i].form.nombre.value,"NOMBRE")));
   }
   if(text == "codigo")
   {
   return ((vacio(Radio[i].form.codigo.value,"CODIGO"))  && (validarNumero(Radio[i].form.codigo.value,"CODIGO")));
   }
  }

 return (true);
}

function selradioT(Radio)
{
for(i=0;i<Radio.length;i++)
  if(Radio[i].checked == true)
  {
   var text = Radio[i].value;
   if(text == "nombre")
   {
   return ((vacio(Radio[i].form.nombre.value,"NOMBRE")) && (validarCadena(Radio[i].form.nombre.value,"NOMBRE")) );
   }
   if(text == "apellido")
   {
   return ((vacio(Radio[i].form.apellido.value,"APELLIDO")) && (validarCadena(Radio[i].form.apellido.value,"APELLIDO")) );
   }
   if(text == "codigo")
   {
   return ((vacio(Radio[i].form.codigo.value,"CODIGO"))  && (validarNumero(Radio[i].form.codigo.value,"CODIGO")));
   }

  }

 return (true);
}

function selradio(Radio)
{
for(i=0;i<Radio.length;i++)
  if(Radio[i].checked == true)
  {
   var text = Radio[i].value;
   if(text == "nombre")
   {
   return ((vacio(Radio[i].form.nombre.value,"NOMBRE")) && (validarCadena(Radio[i].form.nombre.value,"NOMBRE")));
   }
   if(text == "ci")
   {
   return ((vacio(Radio[i].form.ci.value,"CI"))  && (validarNumero(Radio[i].form.ci.value,"CI")));
   }
   if(text == "login")
   {
   return (vacio(Radio[i].form.login.value,"LOGIN"));
   }
  }

 return (true);
}


function vaciarText(Radio,nombre)
{
/*
for(i=0;i<Radio.length;i++)
  if(Radio[i].checked==true)
    var text = Radio[i].value
*/

 var elm=Radio.form.elements;
  for(j=0;j<elm.length;j++)
   { if(elm[j].type=="text")
     {
       if(elm[j].name == nombre)
       {
        elm[j].disabled = false;
       }
       else
       {
        elm[j].value="";
        elm[j].disabled = true;
       }
     }
   }
}

function passwdValido(Box)
{
 if((Box.actual.value.length < 8) || (Box.actual.value == ""))
 {
   alert("Password Actual esta vacio o es menor a 8 caracteres. \n Introdusca nuevamente.");
   return (false);
 }
 if((Box.nuevo.value.length < 8) || (Box.nuevo.value == ""))
 {
   alert("Password Nuevo esta vacio o es menor a 8 caracteres. \n Introdusca nuevamente.");
   return (false);
 }
 if((Box.renuevo.value.length < 8) || (Box.renuevo.value == ""))
 {
   alert("Password Confirmado esta vacio o es menor a 8 caracteres. \n Introdusca nuevamente.");
   return (false);
 }
 if(Box.nuevo.value !=  Box.renuevo.value)
 {
    alert("Los campos de password no son iguales. \n Introdusca nuevamente.");
    return (false);
 }

 return (true);
}


function Validopass(Box)
{
 if((Box.nuevo.value.length < 8) || (Box.nuevo.value == ""))
 {
   alert("Password Nuevo esta vacio o es menor a 8 caracteres. \n Introdusca nuevamente.");
   return (false);
 }
 if((Box.renuevo.value.length < 8) || (Box.renuevo.value == ""))
 {
   alert("Password Confirmado esta vacio o es menor a 8 caracteres. \n Introdusca nuevamente.");
   return (false);
 }
 if(Box.nuevo.value !=  Box.renuevo.value)
 {
    alert("Los campos de password no son iguales. \n Introdusca nuevamente.");
    return (false);
 }

 return (true);
}


