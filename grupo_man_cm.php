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
<strong>Modificacion Nombre Grupo</strong><br>
</div>
<div id="AtrasBoton">
 	<a href="grupo_mante.php?modulo=<?php echo $_SESSION['modulo'];?>">
	<img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<br>
<center>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
$datos = $_SESSION['form_buffer'];
$quecom = $_POST['cod_grupo'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_g = $quecom[$i];
 }
}
$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = '$cod_g' and CRED_GRP_USR_BAJA is null";
$res_grp = mysql_query($con_grp);
while ($linea = mysql_fetch_array($res_grp)){
 //agencia
	  $agen = $linea['CRED_GRP_AGENCIA'];
	  $con_age  = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $agen and GRAL_AGENCIA_USR_BAJA is null ";
      $res_age = mysql_query($con_age);
	  while ($lin_age= mysql_fetch_array($res_age)) {
	  $d_age = $lin_age['GRAL_AGENCIA_NOMBRE'];
	  }
$cod_agen = $linea['CRED_GRP_AGENCIA'];
$datos['cod'] = $linea['CRED_GRP_CODIGO'];
$datos['nom_g'] = $linea['CRED_GRP_NOMBRE']; 
$_SESSION['cod_g'] = $datos['cod'];
}
$con_age = "Select * From gral_agencia where  GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age);
 ?>
<form name="form2" method="post" action="grab_retro_grpm.php" style="border:groove" target="_self" >
      <table align="center">
	  <tr>   
		<td><strong>Codigo</strong></td>
        <td><?php echo encadenar(3).$datos['cod'];?></td>
	  </tr>
      <tr>   
		<td><strong>Agencia</strong></td>
        <td><font color= color="#FF0000">
            <?php echo encadenar(3).$d_age;?> </font color></td>
		<td><select name="cod_agencia" size="1">
		 	<?php while ($linea = mysql_fetch_array($res_age)) { ?>
            <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
	        <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
	        <?php } ?> </select></td>
      </tr>
      <tr> 
      <tr></tr>
	  <tr>
         <td><strong>  Nombre Grupo   </strong></td>
         <td><?php echo encadenar(3);?>
		     <input type= type="text" name="nom_g" value="<?=$datos['nom_g'];?>"></td>
	  <tr></tr>
      <tr></tr>
	  <tr>
	      <td></td>
          <td><input type="submit" name="accion" value="Grabar"></td>
		  <td><?php echo encadenar(3);?>
              <input type="submit" name="accion" value="Salir"></td>
	  </tr>	  
    </table>	
</form>
</div>
<div id="FooterTable"> 
<BR><B><FONT SIZE=+2><MARQUEE>Modifique el Nombre del Grupo Solidario/ Banca </MARQUEE></FONT></B>
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