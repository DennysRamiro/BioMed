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
<title>Reversion Ingresos - Egresos</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/cajas_rev_ineg_det.js"></script> 
<script type="text/javascript" src="js/cajas_reim_ineg_det.js"></script>  
</head>
<body>	
  <?php
        include("header.php");
      ?>
	 <!--div id="GeneralManUsuarioM"-->
	
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
                      if($_SESSION['menu']==7){?>
                 <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_rev_ineg">
                    
                     <img src="img/basket_24x24.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS/EGRESOS
                    
                 </li>
                 <li id="menu_modulo_cajas_rev_ineg_rev">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. INGR./EGRE.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> TRANS. REV. INGR./EGRE.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
                 <!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">TRANSACCION REVERTIDA DE INGRESOS/EGRESOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                    La transaccion fue revertida exitosamente
                     </div> 
                     <?php }elseif ($_SESSION['menu']==8) { ?> 
                     <li id="menu_modulo_cajas_reim">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_ineg">
                    
                     <img src="img/basket_24x24.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS/EGRESOS
                    
                 </li>
                 <li id="menu_modulo_cajas_reim_ineg_rev">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. INGR./EGRE.
                    
                 </li>
              <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> TRANS. REV. INGR./EGRE.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
                 <!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">TRANSACCION REVERTIDA DE INGRESOS/EGRESOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                    La transaccion fue revertida exitosamente
                     </div> 
                     <?php } ?> 
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
$_SESSION['f_tra'] = $fec1;
$nro_tran = $_SESSION['nro_tran'];
		//	$_SESSION['tipo'] = $tipo;
if (isset($_SESSION['tipo'])){
   $tipo = $_SESSION['tipo'];
}
if (isset($_SESSION['f_tra'])){
   $f_tran = $_SESSION['f_tra'];
}
//if (isset($_SESSION['nro_tran'])){
 //  $nro_tran = $_SESSION['nro_tran'];
//}
$hoy = date("Y-m-d H:i:s");
//echo $tipo, $f_tran,$nro_tran;
//reversion caja_transac ?>
<br><strong>
<?php
echo "Trans.".encadenar(1).$nro_tran.encadenar(1)."Revertida";
?></strong> <?php
$act_tabla  = "update caja_ing_egre set caja_ingegr_usr_baja = '$logi',
                                        caja_ingegr_fch_hra_baja = '$hoy'
               where (caja_ingegr_fecha between '$f_tran' and '$f_tran') and
				 caja_ingegr_tipo = $tipo and
				 caja_ingegr_corr = $nro_tran  and
	             caja_ingegr_usr_baja is null ";
$res_tabla = mysql_query($act_tabla) ;

$act_tabla  = "update caja_transac set CAJA_TRAN_USR_BAJA = '$logi',
                                       CAJA_TRAN_FCH_HR_BAJA = '$hoy'
               where CAJA_TRAN_APL_ORG = $tipo and CAJA_TRAN_FECHA = '$f_tran'
			   and CAJA_TRAN_TIPO_OPE = 13 and CAJA_TRAN_NRO_CAR = $nro_tran";
$res_tabla = mysql_query($act_tabla) ;

if ($_SESSION['EMPRESA_TIPO'] == 2){
$nro_fac = 0;
$nro_tra = 0;
$con_trc = "SELECT FACTURA_NRO,FACTURA_NUMERICO FROM factura where FACTURA_NRO = $nro_tran
              and FACTURA_FECHA = '$f_tran'";
   $res_trc = mysql_query($con_trc);
   while ($lin_trc = mysql_fetch_array($res_trc)) {
         $nro_tra =  $lin_trc['FACTURA_NRO'];
		 $nro_fac =  $lin_trc['FACTURA_NUMERICO'];
      }

if ($nro_tra > 0){
$act_tabla  = "update factura set FACTURA_MONTO = 0,
                                  FACTURA_ESTADO = 9,
								  FACTURA_NOMBRE = 'ANULADA',
								  FACTURA_NIT = '0'
               where FACTURA_NRO = $nro_tran
			   and FACTURA_FECHA = '$f_tran'";
$res_tabla = mysql_query($act_tabla);

$act_tabla  = "update factura_deta set FAC_DET_ESTADO = 9
			   where FAC_DET_CORRELATIVO = $nro_fac
			   and FAC_DET_FECHA = '$f_tran'";
$res_tabla = mysql_query($act_tabla) ;


}
}			 
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