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
<title>Reversion Compra - Venta Divisas</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/cajas_rev_cv_div_det.js"></script>  
<script type="text/javascript" src="js/cajas_reim_cv_div_det.js"></script>  
</head>
<body>
<?php
        include("header.php");
      ?>	
<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <?php
                      if($_SESSION['menu']==3){?> 
                 <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_rev_det">
                    
                     <img src="img/add box_24x24.png" border="0" alt="Modulo" align="absmiddle"> COM. VENTA DIVISAS 
                    
                 </li>
                  <li id="menu_modulo_cajas_rev_det_rev">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. COM. VEN. DIVISAS 
                    
                 </li>

              <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> TRANS. REV. C/V DIVISAS
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
                 <!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">TRANSACCION REVERTIDA DE COMPRAS/VENTAS DIVISAS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                    La transaccion fue revertida exitosamente
                     </div> 
                   <?php }elseif ($_SESSION['menu']==4) { ?>
                      <li id="menu_modulo_cajas_reim">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_det">
                    
                     <img src="img/add box_24x24.png" border="0" alt="Modulo" align="absmiddle"> COM. VENTA DIVISAS 
                    
                 </li>
                   <li id="menu_modulo_cajas_reim_det_rev">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. COM/VEN DIV.
                    
                 </li>

              <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> TRANS. REV. C/V DIVISAS
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
                 <!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">TRANSACCION REVERTIDA DE COMPRAS/VENTAS DIVISAS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                    La transaccion fue revertida exitosamente
                     </div>   
                     <?php } ?> 
	 <!--div id="GeneralManUsuarioM"-->
	
            <div id="UserData">
                 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				<?php
         $fec = $_SESSION['fec_proc']; //leer_param_gral();
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			</div>
 <center>

<?php
 $_SESSION['continuar'] = 0;
/* */
/*
 */
//$cod_es = 7;
/* */
  ?> 
 <?php
/*
	*/
	   
?>
 <center>
 <div id="TableModulo2" >
<form name="form2" method="post" action="grab_retro_cja.php" >
<strong><font size="-1">
<?php
 //  echo "Trans.".encadenar(1)."Operacion".encadenar(22)."Cliente / Grupo";
 ?>
 </strong></font>
<?php
//$_SESSION['f_tra'] = $fec_pag;
//$_SESSION['nro_tran'] = $nro_tran;
//			$_SESSION['tipo'] = $tipo;
if (isset($_SESSION['tipo'])){
   $tipo = $_SESSION['tipo'];
}
if (isset($_SESSION['f_tra'])){
   $f_tran = $_SESSION['f_tra'];
}
if (isset($_SESSION['nro_tran'])){
   $nro_tran = $_SESSION['nro_tran'];
}
$hoy = date("Y-m-d H:i:s");
//echo $tipo, $f_tran,$nro_tran;
//reversion caja_transac?>
<br><strong> 
<?Php
echo "Trans.".encadenar(1).$nro_tran.encadenar(1)."Revertida";
?></strong> <?php

$act_tabla  = "update caja_com_ven set caja_comven_usr_baja = '$logi',
                                        caja_comven_fch_hra_baja = '$hoy'
               where (caja_comven_fecha between '$f_tran' and '$f_tran') and
				 caja_comven_tipo = $tipo and
				 caja_comven_corr = $nro_tran  and
	             caja_comven_usr_baja is null ";
$res_tabla = mysql_query($act_tabla) ;

$act_tabla  = "update caja_transac set CAJA_TRAN_USR_BAJA = '$logi',
                                       CAJA_TRAN_FCH_HR_BAJA = '$hoy'
               where CAJA_TRAN_APL_ORG = $tipo and CAJA_TRAN_FECHA = '$f_tran'
			   and CAJA_TRAN_TIPO_OPE = 14 and CAJA_TRAN_NRO_CAR = $nro_tran";
$res_tabla = mysql_query($act_tabla);


			 
//reversion cart_maestro
/*$act_tabla  = "update cart_maestro set CART_MAE_USR_BAJA = '$logi',
                                       CART_MAE_FCH_HR_BAJA = '$hoy'
               where CART_NRO_CRED = $ncre";
$res_tabla = mysql_query($act_tabla) ;
	*/		 
//reversion cart_deudor
/*$act_tabla  = "update cart_deudor set CART_DEU_USR_BAJA = '$logi',
                                      CART_DEU_FCH_HR_BAJA = '$hoy'
               where CART_DEU_NCRED = $ncre";
$res_tabla = mysql_query($act_tabla) ;	
			 */
//reversion cart_plandp
/*
$act_tabla  = "update cart_plandp set CART_PLD_USR_BAJA = '$logi',
                                      CART_PLD_FCH_HR_BAJA = '$hoy'
               where CART_PLD_NCRE = $ncre";
$res_tabla = mysql_query($act_tabla);			 
			 */
//reversion fond_maestro
 
	/*		 
$act_tabla  = "update fond_maestro set FOND_MAE_USR_BAJA = '$logi',
                                       FOND_MAE_FCH_HR_BAJA = '$hoy'
               where FOND_NRO_CRED = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar fond_maestro : ' . mysql_error());			 
*/

			 
			 			 
//Actualizacion de cred_solicitud
  /* $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=7  where
    CRED_SOL_NRO_CRED = $ncre and CRED_SOL_USR_BAJA is null";
   $res_act_s = mysql_query($act_cred_solic) or die('No pudo actualizar cred_solicitud : ' . mysql_error());
*/









 	
	
?>

</select><br><br>
<center>
   
   <!--input type="submit" name="accion" value="Salir"-->
  </form>



</div>
<?php
//}
      include("footer_in.php");
     ?>
</body>
</html>
<?php
}
    ob_end_flush();
 ?>