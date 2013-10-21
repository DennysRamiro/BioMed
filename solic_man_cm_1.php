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
<title>Mantenimiento Solicitudes</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
</head> 
    <?php
      include("header.php");
  ?>
  <div id="pagina_sistema">
<ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_creditos_consultar">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/edit_32x32.png" border="0" alt="Modulo" align="absmiddle">CONSULTAR
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">

<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 

<?php
if(isset($_SESSION['form_buffer'])){
   $datos = $_SESSION['form_buffer'];
}
$cod_es = $_GET['accion'];
$_SESSION['c_estado'] = $cod_es;
switch( $_GET['accion'] ) {
       case "1":
     }
$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 801 and GRAL_PAR_PRO_COD = $cod_es ";
$res_est = mysql_query($con_est);
while ($linea = mysql_fetch_array($res_est)){
?>
<!--strong>Solicitud en Estado </strong-->
<?php
   echo $linea['GRAL_PAR_PRO_DESC'];
   }
  ?> 

</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
         Elija la Solicitud  para Consultar
        </div>

	

 <?php
$con_sol = "Select * From cred_solicitud where CRED_SOL_ESTADO = $cod_es and CRED_SOL_OF_RESP='$logi' and  CRED_SOL_USR_BAJA is null ";
$res_sol = mysql_query($con_sol);
//echo $cod_es;
?>
<form name="form2" method="post" action="grab_retro_clim.php" >
<select name="cod_sol[]" size="12" multiple>
<?php
while ($linea = mysql_fetch_array($res_sol)){
if ($cod_es == 1) {  
   $linea['CLIENTE_AP_PATERNO'] = "SOLICITUD ";
   $linea['CLIENTE_AP_MATERNO'] = "SIN ";
   $linea['CLIENTE_NOMBRES'] = "CLIENTES ";
   }
if ($cod_es == 2) { 
   $cod_grp = 0;
   if ($linea['CRED_SOL_TIPO_OPER'] == 3){
      $linea['CLIENTE_AP_PATERNO'] = "Individual";
   } 
   if ($linea['CRED_SOL_TIPO_OPER'] < 3){
      $cod_grp = $linea['CRED_SOL_COD_GRUPO'];
	  $con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $cod_grp and CRED_GRP_USR_BAJA is null ";
      $res_grp= mysql_query($con_grp);
      while ($lin_grp = mysql_fetch_array($res_grp)){
             $linea['CLIENTE_AP_PATERNO'] = "Grupo ";
             $linea['CLIENTE_AP_MATERNO'] = $lin_grp['CRED_GRP_CODIGO'];
             $linea['CLIENTE_NOMBRES'] = $lin_grp['CRED_GRP_NOMBRE'];
	  }
     } 
    } 
  if ($cod_es > 2) {
     $cod_cre = $linea['CRED_SOL_CODIGO'];
	 if ($linea['CRED_SOL_TIPO_OPER'] == 3){
        $con_deu = "Select CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES From cred_deudor, cliente_general        where cred_deudor.CRED_SOL_CODIGO = $cod_cre and  CRED_DEU_RELACION = 'C' and CLIENTE_COD = CRED_DEU_INTERNO        and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
        $res_deu= mysql_query($con_deu);
   	    while ($lin_deu = mysql_fetch_array($res_deu)){
  	          $linea['CLIENTE_AP_PATERNO'] = $lin_deu['CLIENTE_AP_PATERNO'] ;
              $linea['CLIENTE_AP_MATERNO'] = $lin_deu['CLIENTE_AP_MATERNO'];
              $linea['CLIENTE_NOMBRES'] = $lin_deu['CLIENTE_NOMBRES'];
        }
    }   
if ($linea['CRED_SOL_TIPO_OPER'] < 3){
   $con_deu = "Select CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES From cred_deudor, cliente_general where   cred_deudor.CRED_SOL_CODIGO = $cod_cre and  CRED_DEU_RELACION = 'C' and CLIENTE_COD = CRED_DEU_INTERNO and   CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
   $res_deu= mysql_query($con_deu);
   while ($lin_deu = mysql_fetch_array($res_deu)){
         $linea['CLIENTE_AP_PATERNO'] = $lin_deu['CLIENTE_AP_PATERNO'] ;
         $linea['CLIENTE_AP_MATERNO'] = $lin_deu['CLIENTE_AP_MATERNO'];
         $linea['CLIENTE_NOMBRES'] = $lin_deu['CLIENTE_NOMBRES'];
    } 
   } 
  }
?>
<option value=<?php echo $linea['CRED_SOL_CODIGO']; ?>>
	          <?php echo $linea['CRED_SOL_CODIGO']; ?> 
			  <?php  if(isset( $linea['CLIENTE_AP_PATERNO'])){?> 
		      <?php echo $linea['CLIENTE_AP_PATERNO']; ?> 
			  <?php } ?>
			  <?php  if(isset( $linea['CLIENTE_AP_MATERNO'])){?> 
			  <?php echo $linea['CLIENTE_AP_MATERNO']; ?> 
			  <?php } ?>
			  <?php  if(isset( $linea['CLIENTE_NOMBRES'])){?> 
			  <?php echo $linea['CLIENTE_NOMBRES']; ?> 
			  <?php } ?>
<?php 
}
?>
</select><br><br>
  <input class="btn_form" type="submit" name="accion" value="Continuar">
  <input class="btn_form" type="submit" name="accion" value="Salir">
  </form>
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