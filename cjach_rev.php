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
<title>Reversion Gasto Caja Chica</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="js/ModulosCajaChica.js"></script> 
<script type="text/javascript" src="js/cajas_rev_bco_det.js"></script> 
<script type="text/javascript" src="js/cajas_reim_bco_det.js"></script> 
 

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
                 <li id="menu_modulo_cajachica">
                    
                     <img src="img/caja_chica_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CAJA CHICA
                    
                 </li>
                  <li id="menu_modulo_cajachica_reversion">
                    
                     <img src="img/add box_24x24.png" border="0" alt="Modulo" align="absmiddle"> CJA CHI REVERSIONES
                    
                 </li>
                
              </ul>  

                  <?php
                      if($_SESSION['menu'] == 1){?> 
           <!--        <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_rev_bco">
                    
                     <img src="img/officer_24x24.png" border="0" alt="Modulo" align="absmiddle"> BANCOS
                    
                 </li>
                  <li id="menu_modulo_cajas_rev_bco_rev">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DETALLE BANCOS
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> TRANS. REV. BANCOS
                    
                 </li>
              </ul> -->
     <div id="contenido_modulo">
<!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/add box_64x64.png" border="0" alt="Modulo" align="absmiddle">TRANSACCION REVERTIDA DE CAJA CHICA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                    La transaccion fue revertida exitosamente
                     </div> 

                  <?php }elseif ($_SESSION['menu'] == 2) {?>
                  
                  <li id="menu_modulo_cajas_reim">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_bco">
                    
                     <img src="img/officer_24x24.png" border="0" alt="Modulo" align="absmiddle"> BANCOS
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_bco_rev">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DETALLE BANCOS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> TRANS. REV. BANCOS
                    
                 </li>
              </ul> 
     <div id="contenido_modulo">
<!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">TRANSACCION REVERTIDA DE CAJA CHICA</h2>
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
                // $fec = leer_param_gral();
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			</div>
           
 <center>

<?php
 $_SESSION['continuar'] = 0;
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
if (isset($_SESSION['nro_fac'])){
   $nro_fac = $_SESSION['nro_fac'];
}
$hoy = date("Y-m-d H:i:s");
//echo  $f_tran,$nro_tran,$logi,$nro_fac;
//reversion caja_transac
?>
<br><strong> <table border=1><tr><td><font size="5"><?Php
echo "Trans.".encadenar(1).$nro_tran.encadenar(1)."Revertida";
?> </font>
</td></tr></table> </strong><?php
$act_tabla  = "update cjach_transac set CJCH_TRAN_USR_BAJA = '$logi',
                                        CJCH_TRAN_FCH_HR_BAJA = '$hoy'
               where (CJCH_TRAN_FECHA between '$f_tran' and '$f_tran') and
				 CJCH_TRAN_NRO_COR = $nro_tran  and
	             CJCH_TRAN_USR_BAJA is null";
$res_tabla = mysql_query($act_tabla);

$act_tabla  = "update factura set FACTURA_USR_BAJA = '$logi',
                                       FACTURA_FCH_HR_BAJA = '$hoy'
               where FACTURA_NRO = $nro_fac";
$res_tabla = mysql_query($act_tabla);

//header('location: js/Reversion.js');
			 
//reversion cart_maestro
/*$act_tabla  = "update cart_maestro set CART_MAE_USR_BAJA = '$logi',
                                       CART_MAE_FCH_HR_BAJA = '$hoy'
               where CART_NRO_CRED = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar cart_maestro : ' . mysql_error());
	*/		 
//reversion cart_deudor
/*$act_tabla  = "update cart_deudor set CART_DEU_USR_BAJA = '$logi',
                                      CART_DEU_FCH_HR_BAJA = '$hoy'
               where CART_DEU_NCRED = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar cart_deudor : ' . mysql_error());	
			 */
//reversion cart_plandp
/*
$act_tabla  = "update cart_plandp set CART_PLD_USR_BAJA = '$logi',
                                      CART_PLD_FCH_HR_BAJA = '$hoy'
               where CART_PLD_NCRE = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar cart_plandp : ' . mysql_error());			 
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