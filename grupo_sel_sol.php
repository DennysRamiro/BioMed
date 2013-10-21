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
<script language="javascript" src="script/validarForm.js"></script> 
</head>
<body>	
  <?php
     include("header.php");
   ?>
<div id="pagina_sistema">
    <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> M
                    
                 </li>
                  <li id="menu_modulo_creditos_modificar">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> S
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> M
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
 
    <h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle">M </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
         Este es el Grupo Elegido
        </div>
     
		
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 

<center>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios

$datos = $_SESSION['form_buffer'];
$quecom = $_POST['cod_grupo'];
if( isset($_SESSION['nro_sol']) ) {
  // echo $_SESSION['nro_sol'];
   $nrosol = $_SESSION['nro_sol'];
}
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_g = $quecom[$i];
 }
}
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nrosol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);
while ($lin_sol = mysql_fetch_array($res_sol)) {
      $dia_r = $lin_sol['CRED_SOL_HRA_REU'];
	  $hra_r = $lin_sol['CRED_SOL_DIA_REU'];
	  $dir_r = $lin_sol['CRED_SOL_DIR_REU'];

}
$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = '$cod_g' and CRED_GRP_USR_BAJA is null";
$res_grp = mysql_query($con_grp);
while ($linea = mysql_fetch_array($res_grp)){
$cod_agen = $linea['CRED_GRP_AGENCIA'];
$datos['cod'] = $linea['CRED_GRP_CODIGO'];
$_SESSION['cod_grupo'] = $linea['CRED_GRP_CODIGO'];
$cod_grup = $_SESSION['cod_grupo'];
$datos['nom_g'] = $linea['CRED_GRP_NOMBRE']; 
$_SESSION['nom_grp'] = $linea['CRED_GRP_NOMBRE'];   
$datos['hra_reu'] = $linea['CRED_GRP_HRA_REU']; 
$datos['dir_reu'] = $linea['CRED_GRP_DIR_REU']; 
//$f_crea = $linea['CRED_GRP_FECHA'];
$d_reu = $linea['CRED_GRP_DIA_REU'];
//$datos['fec_crea']= cambiaf_a_normal($f_crea);
//echo $cod_agen, $datos['cod'], $datos['nom_g'];
}
//$con_dia  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 900 and GRAL_PAR_PRO_COD = $d_reu ";
//$res_dia = mysql_query($con_dia)or die('No pudo seleccionarse tabla 2')  ;
$con_age = "Select * From gral_agencia where  GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age);
 ?>
<form name="form2" method="post" action="grab_retro_grpm.php" style="border:groove" target="_self" >
 <strong>Codigo Solicitud  </strong>
 <?php 
   echo $nrosol;?> 
   <BR><br> 
  <strong>Codigo   </strong>
 <?php 
   echo $datos['cod'].encadenar(6);
   $_SESSION["cod_grupo"] = $datos['cod'];?> 
 <strong>  Nombre Grupo   </strong>
  <?php 
   echo $datos['nom_g'];?> 
   <BR><br>
 <strong> Hora Reunión </strong>
   <?php
   if( isset($dia_r)) {
      echo encadenar(3).$dia_r.encadenar(13) ;
	  } ?>
	   <strong>Día Reunión   </strong>
   
  <?php 
    echo encadenar(3).$hra_r;?>
  <BR><br>
   <strong> Dirección Reunión </strong>
  <?php
   echo  $dir_r;?>
	<BR><BR><br>
  <?php
 //  $act_grupo = "update cred_solicitud set CRED_SOL_COD_GRUPO = $cod_grup, CRED_SOL_ESTADO = 2 where //CRED_SOL_CODIGO= $nrosol and  CRED_SOL_USR_BAJA is null";
//  $res_agrup = mysql_query($act_grupo)or die('No pudo actualizar codigo grupo : ' . mysql_error());
?>  
 <br><br>
    <input class="btn_form" type="submit" name="accion" value="Este Grupo">
    <input class="btn_form" type="submit" name="accion" value="Elegir Otro Grupo">
    <input class="btn_form" type="submit" name="accion" value="Salir">
</form>

</div>
   <?php
		 	include("footer_in.php");
		 ?> 
</body>
</html>
<?php
}
ob_end_flush();
 ?>