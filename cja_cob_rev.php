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
<title>Reversion Cobro</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
<body>	
	 <div id="GeneralManUsuarioM">
	<?php
				include("header.php");
			?>
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
				<?php
                 $fec = leer_param_gral();
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Reversion Cobro 
            </div>
<div id="AtrasBoton">
 	<a href="cja_reversion.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
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
   echo "Trans.".encadenar(4)."Operacion".encadenar(22)."Cliente / Grupo";
 ?>
 </strong></font>
<?php

if (isset($_SESSION['ncre'])){
   $ncre = $_SESSION['ncre'];
}
if (isset($_SESSION['f_tra'])){
   $f_tran = $_SESSION['f_tra'];
}
if (isset($_SESSION['nro_tran'])){
   $nro_tran = $_SESSION['nro_tran'];
}
$hoy = date("Y-m-d H:i:s");
echo $ncre, $f_tran,$nro_tran;
//reversion caja_transac
 $con_fon = "Select * From cart_det_tran where CART_DTRA_NCRE = $ncre and CART_DTRA_TIP_TRAN = 2
			   and CART_DTRA_FECHA = '$f_tran'
			   and CART_DTRA_NRO_TRAN = $nro_tran";
 $res_fon = mysql_query($con_fon);
	   while ($linea = mysql_fetch_array($res_fon)){
	        $n_cta= $linea['CART_DTRA_NRO_CTA'];
			 }
//Cabecera			 
$con_cab = "Select * From cart_cabecera where CART_CAB_NCRE = $ncre and CART_CAB_TIP_TRAN = 2
			   and CART_CAB_FECHA = '$f_tran'
			   and CART_CAB_NRO_TRAN = $nro_tran";
 $res_cab = mysql_query($con_cab);
	   while ($linea = mysql_fetch_array($res_cab)){
	        $esta = $linea['CART_CAB_EST_ANT'];
			if ($esta > 3) {
			    $est = "M";
				}else{
				$est = "P";
			}	
		 }			 
$act_tabla  = "update cart_plandp set CART_PLD_STAT = '$est'
                where CART_PLD_CTA = $n_cta and CART_PLD_NCRE = $ncre";
$res_tabla = mysql_query($act_tabla) ;



$act_tabla  = "update caja_transac set CAJA_TRAN_USR_BAJA = '$logi',
                                       CAJA_TRAN_FCH_HR_BAJA = '$hoy'
               where CAJA_TRAN_COD_SC = $ncre 
			   and CAJA_TRAN_NRO_CAR = $nro_tran
			   and CAJA_TRAN_FECHA = '$f_tran'";
$res_tabla = mysql_query($act_tabla);
//reversion cart_cabecera
$act_tabla  = "update cart_cabecera set CART_CAB_USR_BAJA = '$logi',
                                        CART_CAB_FCH_HR_BAJA = '$hoy'
               where CART_CAB_NCRE = $ncre and CART_CAB_TIP_TRAN = 2
			   and CART_CAB_FECHA = '$f_tran'
			   and CART_CAB_NRO_TRAN = $nro_tran";
$res_tabla = mysql_query($act_tabla) ;
//reversion cart_det_tran
$act_tabla  = "update cart_det_tran set CART_DTRA_USR_BAJA = '$logi',
                                        CART_DTRA_FCH_HR_BAJA = '$hoy'
               where CART_DTRA_NCRE = $ncre and CART_DTRA_TIP_TRAN = 2
			   and CART_DTRA_FECHA = '$f_tran'
			   and CART_DTRA_NRO_TRAN = $nro_tran";
$res_tabla = mysql_query($act_tabla) ;
//reversion recibo_deta
$act_tabla  = "update recibo_deta set REC_DET_USR_BAJA = '$logi',
                                        REC_DET_FCH_HR_BAJA = '$hoy'
               where REC_NRO_CRED = $ncre 
			   and REC_DET_FECHA = '$f_tran'
			   and REC_DET_NRO_CART = $nro_tran";
$res_tabla = mysql_query($act_tabla);
//reversion cred_plandp_pag
$act_tabla  = "delete from cred_plandp_pag
               where CRED_PLP_NRO_CRE = $ncre 
			   and CRED_PLP_FECHA = '$f_tran'
			   and CRED_PLP_NRO_CTA = $nro_tran";
$res_tabla = mysql_query($act_tabla);			 
//reversion cart_maestro estado
$act_tabla  = "update cart_maestro set CART_ESTADO = $esta
               where CART_NRO_CRED = $ncre";
$res_tabla = mysql_query($act_tabla);
		 
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
 $con_fon = "Select * From fond_maestro where FOND_NRO_CRED = $ncre";
 $res_fon = mysql_query($con_fon);
	   while ($linea = mysql_fetch_array($res_fon)){
	        $n_cta = $linea['FOND_NRO_CTA'];
			 }
	/*		 
$act_tabla  = "update fond_maestro set FOND_MAE_USR_BAJA = '$logi',
                                       FOND_MAE_FCH_HR_BAJA = '$hoy'
               where FOND_NRO_CRED = $ncre";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar fond_maestro : ' . mysql_error());			 
*/
$act_tabla  = "update fond_cabecera set FOND_CAB_USR_BAJA = '$logi',
                                        FOND_CAB_FCH_HR_BAJA = '$hoy'
               where FOND_CAB_NCTA = $n_cta 
			     and FOND_CAB_FECHA = '$f_tran'";
$res_tabla = mysql_query($act_tabla);
$act_tabla  = "update fond_det_tran set FOND_DTRA_USR_BAJA = '$logi',
                                        FOND_DTRA_FCH_HR_BAJA = '$hoy'
               where FOND_DTRA_NCTA = $n_cta
			   and FOND_DTRA_NCRE = $ncre
			   and FOND_DTRA_FECHA = '$f_tran'";
$res_tabla = mysql_query($act_tabla) ;
$act_tabla  = "update fond_cliente set FOND_CLI_USR_BAJA = '$logi',
                                        FOND_CLI_FCH_HR_BAJA = '$hoy' 
               where FOND_CLI_NCTA = $n_cta";
$res_tabla = mysql_query($act_tabla);			 
			 
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




			 			 
//Actualizacion de cred_solicitud
  /* $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=7  where
    CRED_SOL_NRO_CRED = $ncre and CRED_SOL_USR_BAJA is null";
   $res_act_s = mysql_query($act_cred_solic) or die('No pudo actualizar cred_solicitud : ' . mysql_error());
*/









 	
	
?>

</select><br><br>
<center>
   <input type="submit" name="accion" value="Detalle">
   <input type="submit" name="accion" value="Salir">
  </form>
<div id="FooterTable">
Elija la Transaccion 
</div>
<?php
//}
		 	include("footer_in.php");
		 ?>

</div>
</body>
</html>
<?php
}
    ob_end_flush();
 ?>