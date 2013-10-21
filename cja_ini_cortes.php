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
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js"></script> 
</head>
<body>	
<div id="cuerpoModulo">
 <?php
	   include("header.php");
 	 ?>
<div id="UserData">
     <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />		
<?php
 $fec = leer_param_gral();
 $_SESSION['fec_p'] = $fec;
 $logi = $_SESSION['login']; 
 $ag_usr = $_SESSION['COD_AGENCIA'];
 ?> 
<center>
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
<strong>Saldo Inicial Caja</strong><br>
</div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<br>
<center>
<?php
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta);
$con_sal  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 500 and GRAL_PAR_PRO_COD <> 0 ";
$res_sal = mysql_query($con_sal);
$con_trc = "SELECT CAJA_TRAN_FECHA FROM caja_transac where CAJA_TRAN_AGE_ORG = $ag_usr and CAJA_TRAN_TIPO_OPE = 1
 ORDER BY CAJA_TRAN_FECHA DESC LIMIT 0,1";
 $res_trc = mysql_query($con_trc);
 $lin_trc = mysql_fetch_array($res_trc);
 $fch_ini = $lin_trc['CAJA_TRAN_FECHA'];
 //echo $fch_ini;
 $con_trc = "SELECT CAJA_TRAN_FECHA FROM caja_transac where CAJA_TRAN_AGE_ORG = $ag_usr and CAJA_TRAN_TIPO_OPE = 2
 ORDER BY CAJA_TRAN_FECHA DESC LIMIT 0,1";
 $res_trc = mysql_query($con_trc);
 $lin_trc = mysql_fetch_array($res_trc);
 $fch_fin = $lin_trc['CAJA_TRAN_FECHA'];
 //echo $fch_fin;
 ?> 
<form name="form2" method="post" action="grab_retro_cja.php">
<?php
//Verifica si ya hizo el inicio esa fecha
$nro_tr = verif_saldo_ini_cja($fec,$logi,$ag_usr);
//echo "entra ", $nro_tr;
if ($nro_tr == 2) {
   $fec_a = cambiaf_a_mysql_2($fec);
   //echo $fec_a;
  $con_trc = "SELECT * FROM caja_transac where CAJA_TRAN_AGE_ORG = $ag_usr and CAJA_TRAN_TIPO_OPE = 1
  and CAJA_TRAN_FECHA = '$fec_a'";
  $res_trc = mysql_query($con_trc);
 // $nro_tra = 0;
  while ($lin_trc = mysql_fetch_array($res_trc)) {
     //   echo $lin_trc['CAJA_TRAN_MON'];
        if ($lin_trc['CAJA_TRAN_MON'] == 1) {
           $sal_bs = $lin_trc['CAJA_TRAN_IMPORTE'];
  		  }
	    if ($lin_trc ['CAJA_TRAN_MON'] == 2) {
           $sal_us = $lin_trc['CAJA_TRAN_IMPORTE'];
  		  }
       }
    ?>
 <strong>  LOS SALDOS INICIALES YA  <br><br>
    <?php echo "FUERON INGRESADOS PARA HOY  .... ",  $fec; ?> <br>
  </strong>
  <BR>
  <strong> Saldo Inicial Bolivianos .....  
    <?php echo $sal_bs;?>
	 </strong>  
	<br><br>
  <strong>    Saldo Inicial Dolares .........
   <?php echo $sal_us;?>
  </strong>	    
  <br>
  <br>
  <BR><BR><br>
 <center>
 <input type="submit" name="accion" value="Salir">
<?php }?>
<?php
//echo "nro_tr",$nro_tr,"fch_fin",$fch_fin;
 if ($nro_tr < 2) { 
// Verifica si la fecha anterior cerro
    $nro_t = verif_saldo_fin_cja($fch_fin,$ag_usr);
	if ($nro_t < 2) { 
        if ($nro_t == 0){
            echo "No se hizo el cierre del día anterior!!!!!!!" ;
        }
        if ($nro_t == 1){
            echo  $nro_t, "Hizo el cierre de una sola moneda del día anterior!!!!!!!" ;
        }
   ?>
  <BR><BR><br>
 <center>
 <input type="submit" name="accion" value="Salir">
<?php } 
  }
if(isset($nro_t)){  
 if ($nro_t == 2){
    $con_sal = "SELECT * FROM caja_transac where CAJA_TRAN_AGE_ORG =  $ag_usr and CAJA_TRAN_TIPO_OPE = 2
               and CAJA_TRAN_FECHA = '$fch_fin'";
    $res_sal = mysql_query($con_sal);
	$sal_bs = 0; 
	$sal_us = 0;
    while ($lin_sal = mysql_fetch_array($res_sal)) {
	$fec_cant = $lin_sal['CAJA_TRAN_FECHA'];
	$f_ultc = cambiaf_a_normal($fch_fin);
	      if ($lin_sal['CAJA_TRAN_MON'] == 1) {
             $sal_bs  = $lin_sal['CAJA_TRAN_IMPORTE'];
		  }
		 if ($lin_sal['CAJA_TRAN_MON'] == 2) {
             $sal_us  = $lin_sal['CAJA_TRAN_IMPORTE'];
		  } 
       }
 
//verif_cierre($fec);
 ?>
 <strong>  Fecha cierre anterior  </strong>
    <?php echo $f_ultc; ?> <br>
  <BR>
  <strong>
   <?php
//  echo  "Saldos iniciales al .......", $fec,$sal_bs,$sal_us ;
   ?>
    </strong>
  <BR>
  <strong> Saldo Bolivianos     </strong>
    <input type="text" name="sal_bs" maxlength="12" size="12" value="<?=$sal_bs;?>" > 
  <strong>    Saldo Dolares     </strong>
     <input type="text" name="sal_us" maxlength="12" size="12" value="<?=$sal_us;?>" >  <br>
 <br>
    <?php if ($nro_t == 2){?>
    <input type="submit" name="accion" value="Grabar">
	 <?php }else{?>
	<input type="submit" name="accion" value="Salir">
	<?php }?>
<?php }
   }?>
</form>
<BR><BR>
<BR><B><FONT SIZE=+2><MARQUEE>Atenci&oacute;n  registre los Saldos Iniciales </MARQUEE></FONT></B>
 <?php
		 	include("footer_in.php");
 ?>

</body>
</html>

<?php
}
ob_end_flush();
 ?>