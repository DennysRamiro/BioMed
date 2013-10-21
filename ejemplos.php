<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {

	require('configuracion.php');
    require('funciones.php');
?>
<html>
<head>
<title>Confirmar Cobro detalle</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="cuerpoModulo">
    	<?php
				include("header.php");
			?>
           <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
	<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 
	</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                      Confirma cobro
			</div>
            <div id="AtrasBoton">
           		<a href="cobro_pag_det.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0"  alt="Regresar" align="absmiddle">Atras</a>
            </div>
<font size="+1">
<?php
//datos cobro
if(isset($_SESSION['nom_cli'])){
   $nom_cli = $_SESSION['nom_cli'];
   echo $nom_cli;   
   }
$monto_nro = 0;
$nro = 0;
foreach($_POST as $nombre_campo => $constante_var){

//aquí se opera con las variables enviadas, asignandolas a variables PHP. En cada pasada del bucle, el nombre de la variable (en el caso anterior: nombreVarPost) es asignado a $post_campo y el valor de dicha variable, a $post_valor

//ej: asignar nombres y variables a un nuevo array en PHP:

$campo[$i] = $nombre_campo;
$valor[$i] = $constante_var;
$i++;
echo $campo[$i], $valor[$i];
}
/***VARIABLES POR POST ***/
$numero2 = count($_POST);
$tags2 = array_keys($_POST);
// obtiene los nombres de las varibles
$valores2 = array_values($_POST);
// obtiene los valores de las varibles
// crea las variables y les asigna el valor
for($i=0;$i<$numero2;$i++){$$tags2[$i]=$valores2[$i];
}
}/*

	require 'cobro_prep.php';
	
?>	   
<?php
    ob_end_flush();
 ?>
 
 foreach($_POST['variable'] as $valor){ 
echo'<option value="'.$valor.'>'.$valor</option>; 
}; 

 <?
for($i = 0; $i < sizeof($_POST["s1"]); $i++)
  echo $i.' - '.$_POST["s1"][$i].'<br>';
?> 
=======================================================================
<?php
if(isset($_POST['ok'])){
 
for ($i=1;$i<=$_POST["var_cont"];$i++)
 {
echo "Numero de Fila: " ; echo $i; echo "<br>";
echo " Codigo: "; echo $_POST["code_$i"];
echo " Nombre: "; echo $_POST["name_$i"];
echo " Cantidad: "; echo $_POST["cant_$i"];echo "<br>";
 
 }
 
}
?>
<html>
<head>
<title>PRUEBA AGREGAR FILAS</title>
</head>
 
<body>
<form id="form" name="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="asigna()">
 
<br>
 
<table border="1" id="tabla" bordercolor="#FFCC33" cellspacing="1">
<tr colspan="13" align="left">
<td align="center"><font color="1166FF" size="3"><b>EJEMPLO !!!</b></font></td>
</tr>
<tr align="center">
<td valign="top"><input type="button" name="b1" value="[+]" onClick="addRowX()">
<input type="button" name="b2" value="[-]" onClick="borrar()"></td>
<td><font color="blue" size="1">COD</font></td>
<td><font color="blue" size="1">NOMBRE</font></td>
<td><font color="blue" size="1">CANTIDAD</font></td>
</tr>
 
<tr>
 
<td>&nbsp;</td>
<td><input type="text" size="4" name="code_1" /></td>
<td><input type="text" size="25" name="name_1"/></td>
<td><input type="text" size="8" name="cant_1"/></td>
<input type="hidden" name="var_cont">
</tr>
</table>
 
 
<table border="1" id="tabla_f2" bordercolor="#6B238E" align="center">
<tr>
<td><input type="submit" name="ok" id="ok" value="GUARDAR" /></td>
</tr>
</table>
</form>
 
// aca pongo el javascript !!!!
 
</body>
</html>
<script language='JavaScript'>
var cont=1;
function addRowX()  //Esta la funcion que agrega las filas :
{
 
cont++;
var indiceFila=1;
myNewRow = document.getElementById('tabla').insertRow(-1);
myNewRow.id=indiceFila;
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="4" name="code_'+cont+'" /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<input type="text" size="25" name="name_'+cont+'"/>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<input type="text" size="8" name="cant_'+cont+'"/>';
indiceFila++;
 
}
//////////////Borrar() ///////////
function borrar() {
var table = document.getElementById('tabla');
if(table.rows.length > 3)
    {
    table.deleteRow(table.rows.length -1);
cont--;
    }
}
 
////////////FUNCION ASIGNA VALOR DE CONT PARA EL FOR DE MOSTRAR DATOS ////////
function asigna()
{
valor=document.form.var_cont.value=cont;
//alert('funcion asigna, valor cont:'+valor)
}
</script>

