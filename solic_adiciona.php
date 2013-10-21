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
                  <li id="menu_modulo_creditos_alta">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ACOPLE
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/add user_64x64.png" border="0" alt="Modulo" align="absmiddle">ACOPLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Elija al Grupo al que Adicionara Clientes
        </div>
  

<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 

<?php
// Se realiza una consulta SQL a tabla gral_param_propios
if(isset($_SESSION['form_buffer'])) {
   $datos = $_SESSION['form_buffer'];
   }
//$tip_tran = $_GET['accion'];
//echo $tip_tran;
$cod_es = 3;
//$_SESSION['c_estado'] = $cod_es;
//switch( $_GET['accion'] ) {
//       case "1":
	    //    $_SESSION['continuar'] = 2 ;
		 //    require 'solic_consulta.php';
	       //header('Location: solic_mante_aa.php');
	     //  break;
		//   }
//$_SESSION['c_estado'] = $cod_es;
//$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $cod_es ";
//$res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla')  ;
//while ($linea = mysql_fetch_array($res_est)){
?>
<strong>Creditos </strong>
<?php
 //  echo $linea[GRAL_PAR_PRO_DESC];
 //  }
  ?> 
 <?php
$est_des = 3;
$est_has = 6; 
$con_car = "Select * From cart_maestro where (CART_ESTADO between $est_des and $est_has) and CART_OFIC_RESP ='$logi' and  CART_TIPO_OPER =1 and CART_MAE_USR_BAJA is null ";
$res_car = mysql_query($con_car);
//echo $cod_es;
?>
<form name="form2" method="post" action="grab_retro_clim.php" >
 
<select name="cod_cre[]" size="12" multiple>
<?php
while ($linea = mysql_fetch_array($res_car)){
      $cod_est = $linea['CART_ESTADO'];
      $cod_grp = $linea['CART_COD_GRUPO'];
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $cod_est  and GRAL_PAR_PRO_USR_BAJA is null order by 2";
      $res_est = mysql_query($con_est);
      while ($lin_est = mysql_fetch_array($res_est)){
             $est_sig = $lin_est['GRAL_PAR_PRO_SIGLA'];
             }
	  $con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $cod_grp and CRED_GRP_USR_BAJA is null ";
      $res_grp= mysql_query($con_grp);
      while ($lin_grp = mysql_fetch_array($res_grp)){
             $linea['CLIENTE_AP_PATERNO'] = "Grupo ";
             $linea['CLIENTE_AP_MATERNO'] = $lin_grp['CRED_GRP_CODIGO'];
             $linea['CLIENTE_NOMBRES'] = $lin_grp['CRED_GRP_NOMBRE'];
	  }
   //  } 
  //  } 
 // if ($cod_es > 2) {
 //    $cod_cre = $linea['CRED_SOL_CODIGO'];
 if(isset($linea['CRED_SOL_TIPO_OPER'])) {
	 if ($linea['CRED_SOL_TIPO_OPER'] == 3){
        $con_deu = "Select CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,CLIENTE_NOMBRES From cred_deudor, cliente_general where cred_deudor.CRED_SOL_CODIGO = $cod_cre and  CRED_DEU_RELACION = 'D' and CLIENTE_COD = CRED_DEU_INTERNO and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
        $res_deu= mysql_query($con_deu);
   	    while ($lin_deu = mysql_fetch_array($res_deu)){
  	          $linea['CLIENTE_AP_PATERNO'] = $lin_deu['CLIENTE_AP_PATERNO'] ;
              $linea['CLIENTE_AP_MATERNO'] = $lin_deu['CLIENTE_AP_MATERNO'];
              $linea['CLIENTE_NOMBRES'] = $lin_deu['CLIENTE_NOMBRES'];
        }
   // }   
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
 }
?>
<option value=<?php echo $linea['CART_NRO_CRED']; ?>>
	          <?php echo $linea['CART_NRO_CRED']; ?>
			  <?php echo $est_sig; ?>
		      <?php echo $linea['CLIENTE_AP_PATERNO']; ?> 
			  <?php echo $linea['CLIENTE_AP_MATERNO']; ?> 
			  <?php echo $linea['CLIENTE_NOMBRES']; ?> 
<?php 
}
?>
</select><br><br>
  <input class="btn_form" type="submit" name="accion" value="Acoplar">
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