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
//reversion caja_transac
echo "Trans.".encadenar(1).$nro_tran.encadenar(1)."Revertida";

$act_tabla  = "update fond_cabecera set FOND_CAB_USR_BAJA = '$logi',
                                        FOND_CAB_FCH_HR_BAJA = '$hoy'
               where (FOND_CAB_FECHA between '$f_tran' and '$f_tran') and
				 FOND_CAB_TIP_TRAN = $tipo and
				 FOND_CAB_NRO_TRAN = $nro_tran  and
	             FOND_CAB_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla);

$act_tabla  = "update fond_det_tran set FOND_DTRA_USR_BAJA = '$logi',
                                        FOND_DTRA_FCH_HR_BAJA = '$hoy'
               where (FOND_DTRA_FECHA between '$f_tran' and '$f_tran') and
				 FOND_DTRA_TIP_TRAN = $tipo and
				 FOND_DTRA_NRO_TRAN = $nro_tran  and
	             FOND_DTRA_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla) ;
$act_tabla  = "update caja_transac set CAJA_TRAN_USR_BAJA = '$logi',
                                       CAJA_TRAN_FCH_HR_BAJA = '$hoy'
               where CAJA_TRAN_APL_ORG = $tipo and CAJA_TRAN_FECHA = '$f_tran'
			   and CAJA_TRAN_TIPO_OPE = 11 and CAJA_TRAN_NRO_CAR = $nro_tran";
$res_tabla = mysql_query($act_tabla) ;
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