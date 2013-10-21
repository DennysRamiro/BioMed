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
<!--Titulo de la pestaña de la pagina-->
<title>Mantenimiento Solicitudes</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCreditosSolicitud.js"></script>
<meta charset="UTF-8">
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
                  <li id="menu_modulo_creditos_reversionsolicitud">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle">REVERSION SOLICITUD
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/refresh_64x64.png" border="0" alt="Modulo" align="absmiddle"><strong>REVERSION SOLICITUD </strong> </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Elija la Solicitud  para Revertir
        </div>
   	

<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login'];

?> 


<?php
if(isset($_SESSION['form_buffer'])){
   $datos = $_SESSION['form_buffer'];
}
 //echo $logi."Logi"; 
$cod_es = $_SESSION['c_estado'];
//switch( $_GET['accion'] ) {
//       case "1":
//	   }
//echo "Aquiii";
$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 801 and GRAL_PAR_PRO_COD = $cod_es ";
$res_est = mysql_query($con_est);
while ($linea = mysql_fetch_array($res_est)){
?>

<?php
   echo "Solicitudes sin Desembolso".$logi;
   }
  ?> 
 <?php
echo "Solicitudes sin Desembolso"; 
$con_sol = "Select * From cred_solicitud where CRED_SOL_ESTADO < 8 and
 CRED_SOL_OF_RESP='$logi'
 and  CRED_SOL_USR_BAJA is null ";
$res_sol = mysql_query($con_sol);
//echo $cod_es;
?>
<form name="form2" method="post" action="grab_retro_clim.php" >
<select name="cod_sol[]" size="12" style="width:400px; height:200px;" multiple>
<?php
while ($linea = mysql_fetch_array($res_sol)){
     $cod_es =  $linea['CRED_SOL_ESTADO'];
	 $cod_cre = $linea['CRED_SOL_CODIGO'];
	 echo $cod_es,$cod_cre; 
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
        $con_deu = "Select CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES From cred_deudor, cliente_general        where cred_deudor.CRED_SOL_CODIGO = $cod_cre and  CRED_DEU_RELACION = 'D' and CLIENTE_COD = CRED_DEU_INTERNO        and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
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
<option value=
   	          <?php echo $linea['CRED_SOL_CODIGO']; ?>>
	          <?php echo $linea['CRED_SOL_CODIGO'].encadenar(2); ?> 
			  <?php echo $linea['CRED_SOL_ESTADO'].encadenar(2); ?> 
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
  <input class="btn_form" type="submit" name="accion" value="Revertir-Solicitud">
  <input class="btn_form" type="submit" name="accion" value="Salir">
  </form>

</body>
</html>
 <?php
		 	include("footer_in.php");
	 ?> 
<?php
}
ob_end_flush();
 ?>