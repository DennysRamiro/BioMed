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
<title>Reasignacion Asesor</title>
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
				 Reasignación Asesor
		    </div>
			
<div id="AtrasBoton">
 	<a href="con_mante.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
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

 <center>
 <div id="TableModulo2" >
<form name="form2" method="post" action="tipo_rep_5.php" >
<strong><font size="-1">
<?php
 //  echo "Trans.".encadenar(1)."Operacion".encadenar(22)."Cliente / Grupo";
 ?>
 </strong></font>
<?php
//$_SESSION['f_tra'] = $fec_pag;
//$_SESSION['nro_tran'] = $nro_tran;
//			$_SESSION['tipo'] = $tipo;
if (isset($_SESSION['t_cred'])){
   $t_cred = $_SESSION['t_cred'];
}
if (isset($_SESSION['nro_ope'])){
   $nro_ope = $_SESSION['nro_ope'];
}

$hoy = date("Y-m-d H:i:s");
$cod_ase = $_POST['cod_ase'];

   // $nro_doc = $_SESSION['nro_doc'];
 
//echo $tipo, $f_tran,$nro_tran;
//reversion caja_transac

echo "Nro. Operación".encadenar(1).$nro_ope.encadenar(1)."Reasignado".encadenar(2).$cod_ase;
if ($t_cred == 2){
      $act_tabla  = "update cart_maestro set CART_OFIC_RESP = '$cod_ase'
                  where CART_NRO_CRED = $nro_ope and
	                    CART_MAE_USR_BAJA is null ";
   $res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar contab%trans: ' . mysql_error()); 
}




if ($t_cred == 1){
   $consulta  = "Select GRAL_USR_LOGIN From gral_usuario
                where GRAL_USR_CODIGO = $cod_ase";
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla aqui');
   $linea = mysql_fetch_array($resultado);
    $logiin = $linea['GRAL_USR_LOGIN'];
   			
				
   $act_tabla  = "update cart_maestro set CART_OFIC_RESP = '$logiin'
                  where CART_NRO_CRED = $nro_ope and
	                    CART_MAE_USR_BAJA is null ";
   $res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar contab%trans: ' . mysql_error()); 
}

/* if ($_SESSION['con_baj'] == 2){


$act_tabla  = "update contab_trans set CONTA_TRS_USR_BAJA = '$logi',
                                        CONTA_TRS_FCH_HR_BAJA = '$hoy'
               where (CONTA_TRS_FEC_VAL between '$fec1' and '$fec1') and
				      CONTA_TRS_NRO = $nro_doc  and
	                  CONTA_TRS_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar contab%trans: ' . mysql_error());

$act_tabla  = "update contab_cabec set CONTA_CAB_USR_BAJA = '$logi',
                                        CONTA_CAB_FCH_HR_BAJA = '$hoy'
               where (CONTA_CAB_FEC_TRAN between '$fec1' and '$fec1') and
				      CONTA_CAB_NRO = $nro_doc  and
	                  CONTA_CAB_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar contab%trans: ' . mysql_error());

} */

/* if ($_SESSION['con_baj'] == 3){

if (valida_fecha($fec_nue)){
echo "Trans.".encadenar(1).$nro_doc.encadenar(1)."Nueva Fecha". encadenar(1).$fec_nue;
$fec_nue_1 = cambiaf_a_mysql($fec_nue);
$act_tabla  = "update contab_trans set CONTA_TRS_FEC_VAL = '$fec_nue_1'
               where  CONTA_TRS_NRO = $nro_doc  and
	                  CONTA_TRS_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar contab_trans: ' . mysql_error());

$act_tabla  = "update contab_cabec set CONTA_CAB_FEC_VAL = '$fec_nue_1',
                                       CONTA_CAB_FEC_TRAN = '$fec_nue_1'
               where  CONTA_CAB_NRO = $nro_doc  and
	                  CONTA_CAB_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar contab_cabec: ' . mysql_error());
		}	 

}
*/



//}


			 
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