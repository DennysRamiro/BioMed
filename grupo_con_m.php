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
<title>Mantenimiento Grupos</title>
</head>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
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
<center>
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
<strong>Modificacion datos Grupo</strong><br>
</div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<br>
<center>
<?php
//echo "entra a grabar";
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
$cod_gru =$_POST["cod"];
//$log_usr = strtolower($log_usr);
if (empty($cod_gru)) {
    $consul = $consul + 1;
	} else {
	 $consulta  = "Select * From cred_grupo where CRED_GRP_CODIGO = '$cod_gru' and CRED_GRP_USR_BAJA is null";
}
$nom_g = $_POST["nomb_g"]; 
if (empty($nom_g)) {
     $consul = $consul + 1;
	} else {
	 $nom_g = strtoupper($nom_g);
	 $nom_g=  "%".$nom_g."%";
	 $consulta  = "Select * From cred_grupo where CRED_GRP_NOMBRE like '$nom_g' and CRED_GRP_USR_BAJA is null"; 
}
if ($consul == 2) {
   //echo "Consultara todos";
   $consulta  = "Select * From cred_grupo where CRED_GRP_USR_BAJA is null order by 3";
 }
?>  
 <?php  
   $resultado = mysql_query($consulta);
 ?>
<form name="form2" method="post" action="grab_retro_grpm.php" >
<select name="cod_grupo[]" size="12" multiple>
  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CRED_GRP_CODIGO']; ?>>
	    <?php echo $linea['CRED_GRP_CODIGO']; ?>
		<?php echo $linea['CRED_GRP_NOMBRE']; ?>
	 <?php
   }
 ?>
  </select><br><br>
  <input type="submit" name="accion" value="Modificar">
  <input type="submit" name="accion" value="Salir">
  </form>
  </div>
<div id="FooterTable"> 
<BR><B><FONT SIZE=+2><MARQUEE>Elija el Grupo para modificar </MARQUEE></FONT></B>
<center>
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