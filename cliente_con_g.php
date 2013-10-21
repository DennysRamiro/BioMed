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
<title>Mantenimiento Clientes</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
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
	               	<img src="images/24x24/001_35.png" border="0" alt="" />   
                                Consulta Clientes para Directiva Grupo
                </div>
<div id="AtrasBoton">
           		<a href="cliente_con_grup.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<?php
//echo "entra a grabar";
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
$cod_cli =$_POST["cod"];
//$cod_grp = $_SESSION["cod_g"];
//echo $cod_grp;
if(isset($_POST['cod_grupo'])){
   $quecom = $_POST['cod_grupo'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_g = $quecom[$i];
    }
   }
 }
$cod_g = $_SESSION["cod_g"];
$nom_g = $_SESSION["nombre_g"];
$consul = 0;
//$log_usr = strtolower($log_usr);
if (empty($cod_cli)) {
    $consul = $consul + 1;
	} else {
	 $consulta  = "Select * From cliente_general where CLIENTE_COD = $cod_cli and CLIENTE_USR_BAJA is null order by 9,10,11,8";
}
$c_i = $_POST["ci"];
if (empty($c_i)) {
   $consul = $consul + 1;
   } else {
   $c_i =  "%".$c_i."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_COD_ID like '$c_i' and CLIENTE_USR_BAJA is null order by 9,10,11,8";
}
$nom = $_POST["nombres"]; 
if (empty($nom)) {
     $consul = $consul + 1;
	} else {
	 $nom =  "%".strtoupper($nom)."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_NOMBRES like '$nom' and CLIENTE_USR_BAJA is null order by 9,10,11,8"; 
}
$a_pat = $_POST["ap_pater"];
if (empty($a_pat)) {
    $consul = $consul + 1;
    } else {
	$a_pat = "%".strtoupper($a_pat)."%";
	//echo $a_pat;
	$consulta  = "Select * From cliente_general where CLIENTE_AP_PATERNO like '$a_pat' and CLIENTE_USR_BAJA is nullorder by 9,10,11,8 "; 
} 
$a_mat = $_POST["ap_mater"]; 
if (empty($a_mat)) {
    $consul = $consul + 1; 
    } else {
	$a_mat = "%".strtoupper ($a_mat)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_MATERNO like '$a_mat' and CLIENTE_USR_BAJA is null order by 9,10,11,8";
} 
$a_esp = $_POST["ap_espos"]; 
if (empty($a_esp)) {
    $consul = $consul + 1; 
    } else {
	$a_esp = "%".strtoupper ($a_esp)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_ESPOSO like '$a_esp' and CLIENTE_USR_BAJA is null";
} 
if ($consul == 6) {
   //echo "Consultara todos";
   $consulta  = "Select * From cliente_general where CLIENTE_USR_BAJA is null order by 8";
 }
?> 
 <?php 
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
 ?>
 <div id="GeneralManUsuarioM">
<form name="form2" method="post" action="incorp_cli_grup.php" >
<select name="cod_cliente[]" size="12" multiple>
  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CLIENTE_COD']; ?>>
		<?php echo $linea['CLIENTE_AP_PATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_MATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_ESPOSO']; ?>
		<?php echo $linea['CLIENTE_NOMBRES']; ?></option>
<?php
   }
 ?>
  </select><br><br>
  <input type="submit" name="accion" value="Agregar-Cliente">
  <input type="submit" name="accion" value="Alta-Cliente">
  <input type="submit" name="accion" value="Salir">
  </form>
</div>
<?php
		 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>