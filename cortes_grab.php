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
	require('funciones2.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<?php
				include("header.php");
			?>
            

				<?php
					 $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>

<br><br>
            
<center>
<BR>
<font  size="+2">


<br><br>
<?php
echo "Arqueo Efectivo".encadenar(2);
if ($_SESSION['grab_def_prov'] == 2){

//echo "cod_mone".$_SESSION['caja_bs_sus'];
$efec = round($_SESSION['efectivo'],2);
$consulta  = "Select sum(temp_haber_1) From temp_ctable";
$resultado = mysql_query($consulta);
while ($linea = mysql_fetch_array($resultado)) {
     $saldo =  round($linea['sum(temp_haber_1)'],2);
//	 echo $saldo." ". $_SESSION['efectivo'];
	 if ($saldo <> $efec){ 
	 
	    $_SESSION['grab_def_prov'] = 1;
		$_SESSION['detalle'] = 0;
		//$_SESSION['continuar'] = 1;
	    //$_SESSION['caja_bs_sus'] = $_SESSION['caja_bs_sus'];
		//$_SESSION['msje'] = "No igualan los saldos ".$saldo." ". $_SESSION['efectivo'];
		//echo $_SESSION['msje'];
	 }
}
}

	
if ($_SESSION['grab_def_prov'] == 1){
   $estado = 1;
  //  header('Location:menu_s.php');
}
if ($_SESSION['grab_def_prov'] == 2){
   $estado = 2;
}
if ($_SESSION['caja_bs_sus'] == 1){
   echo "Bolivianos";
  $cod_mone = $_SESSION['caja_bs_sus']; 
   $grup = 110;
   $imp =  $_SESSION['saldo'];
   $eqv = $_SESSION['saldo'];
   }
 if ($_SESSION['caja_bs_sus'] == 2){
   echo "Dolares Americanos";
   $cod_mone = $_SESSION['caja_bs_sus'];
   $grup = 130;
   $imp =  $_SESSION['saldo'] * $_SESSION['TC_CONTAB'];
   $eqv = $_SESSION['saldo'];
   }  
 if(isset($efec)){  
 if ($saldo == $efec){   
?>
<br><br>
</font>

<table width="40%"  align="center" border="1">
    
     <tr>
	    <th align="left">Saldo Transacciones :</th>
		<?php if (isset ($_SESSION['saldo'])){?>
		<th align="right"><?php echo number_format($_SESSION['saldo'], 2, '.',','); ?> </td>
		<?php } ?> 
	  </tr>
	  <tr>
	    <th align="left">Saldo Vales :</th>
		<?php if (isset ($_SESSION['vales'])){?>
		<th align="right"><?php echo number_format($_SESSION['vales'], 2, '.',','); ?> </td>
		<?php } ?> 
	  </tr>
	  <tr>
	    <th align="left">Saldo Bancos :</th>
		<?php if (isset ($_SESSION['bancos'])){?>
		<th align="right"><?php echo number_format($_SESSION['bancos'], 2, '.',','); ?> </td>
		<?php }else{
		    $_SESSION['bancos'] = 0; ?>
		<th align="right"><?php echo number_format(0, 2, '.',','); ?> </td>
		 <?php } ?> 
	  </tr>
	   <tr>
	    <th align="left">Saldo Efectivo :</th>
		<?php if (isset ($_SESSION['bancos'])){?>
		<th align="right"><?php echo number_format($_SESSION['saldo'] - $_SESSION['vales'] - $_SESSION['bancos'] 
		                              , 2, '.',','); ?> </td>
		<?php $_SESSION['efectivo'] = $_SESSION['saldo'] - $_SESSION['vales'] - $_SESSION['bancos']; 
		 }
		    
	   //1b?>
	 </table>

 <?php
   $descrip = "Compra de Divisas";
   $nro_tr_con = leer_nro_co_con();
   echo encadenar(112). "Nro. Tran. ".encadenar(2).$nro_tr_con;
   ?>
<br><br>
<table width="80%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CORTE</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Cantidad Cortes</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Monto</th>
	 </tr>
 <?php
 $consulta  = "Select * From temp_ctable";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 0, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    </tr>
	
     <?php }?>
	     <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo encadenar(3); ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		 </tr>
     </table>
		
<br><br>
<table width="80%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Monto</th>
	 </tr>
<?php
 $consulta  = "Select * From caja_vale where CAJA_VAL_FECHA = '$fec1' and CAJA_VAL_MON = $cod_mone and CAJA_VAL_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	
    $tot_vales = 0;
    
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_vales = $tot_vales + $linea['CAJA_VAL_IMPO'];
		  $func = $linea['CAJA_VAL_FUNC'];
		  $concep = $linea['CAJA_VAL_DESCRIP'];
		  $con_usr  = "Select GRAL_USR_NOMBRES,GRAL_USR_AP_PATERNO  From gral_usuario
                        where GRAL_USR_LOGIN = '$func'";
		  $res_usr = mysql_query($con_usr)or die('No pudo seleccionarse tabla aqui');
          $lin_usr = mysql_fetch_array($res_usr);
		  if (isset($linea['GRAL_USR_AP_PATERNO'])){
		      }else{
			  $linea['GRAL_USR_AP_PATERNO'] = " ";
			  }
          $nomusr = $lin_usr['GRAL_USR_NOMBRES'].encadenar(1).$linea['GRAL_USR_AP_PATERNO'];
 
		  $desc = $nomusr." - ". $concep ;
	       ?>
	      <tr>
	 	      <td align="left"><?php echo $desc; ?></td>
		      <td align="right"><?php echo number_format($linea['CAJA_VAL_IMPO'], 2, '.',','); ?></td>
		    </tr>
	
     <?php }?>
	     <tr>
	       	 <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_vales, 2, '.',','); ?></th>
		 </tr>



</table>

</center>
<?php
 ?>		
<br><br>
<br><br>
<br><br>
<center>
 <?php
  
  echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
  
 <?php
  
  echo encadenar(12)."CONTABILIDAD", encadenar(40),"     CAJERO";
  ?>	
  <br><br>
  <br><br>
  </center>
 <?php
 }
 }
 //Graba contab_trans, contab_mae_sal
//echo $fec1." ".$log_usr." ".$cod_mone;
 $consulta  = "Delete From caja_cortes where CAJA_COR_FECHA = '$fec1' and 
	              CAJA_COR_CAJERO = '$log_usr' and CAJA_COR_ESTADO = 1 and CAJA_COR_MON = $cod_mone";
 $resultado = mysql_query($consulta)or die('No pudo borrar  caja_cortes 1');
 
 
 
 
 
 $con_temp  = "Select * From temp_ctable";
 $res_temp = mysql_query($con_temp);
 $i_deb = 0;
 $i_hab = 0;
 $n_deb = 0;
 $n_hab = 0; 
 while ($lin_temp = mysql_fetch_array($res_temp)) {
        $cod = $lin_temp['temp_debe_2'];
		$monto = $lin_temp['temp_haber_1'];
		$cant = $lin_temp['temp_debe_1'];
        $consulta = "insert into caja_cortes (CAJA_COR_AGEN, 
                                              CAJA_COR_CAJERO,
											  CAJA_COR_INI_FIN,
									          CAJA_COR_FECHA,
									          CAJA_COR_NRO_DOC,
									          CAJA_COR_MON,
					                          CAJA_COR_TIPO,
					                          CAJA_COR_CODIGO,
   				                              CAJA_COR_CANTIDAD,
					                          CAJA_COR_MONTO, 
											  CAJA_COR_ESTADO, 
											  CAJA_COR_USR_ALTA,
									          CAJA_COR_FCH_HR_ALTA, 
									          CAJA_COR_USR_BAJA, 
									          CAJA_COR_FCH_HR_BAJA
											  
                                              ) values (30,
										                '$log_usr',
														2,
									                    '$fec1',
												         0,
												         $cod_mone,
												         $grup,
												         $cod,
												         $cant,
														 $monto,
														 $estado,
												         '$log_usr',
												         null,
												         null,
												        '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
}
if ($_SESSION['grab_def_prov'] == 2){
$_SESSION['efectivo'];
$nro_tra = leer_nro_co_cja(10000,$log_usr);
$t_cam = $_SESSION['TC_CONTAB'];
if (isset($imp)){
    }else{
	$imp = 0;
}
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tra,
									             30,
												 30,
												 null,
												 '$fec1',
												 '$log_usr',
												 10000,
												 2,
												 $nro_tra,
												 '$log_usr',
												 10000,
												 null,
												 null,
 											     null,
												 null,
												 null,
												 $imp,
												 $eqv,
												 $cod_mone,
												 $t_cam,
												 'SALDO FINAL',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());

if ($cod_mone == 1){
   $consulta = "update cajero set  CAJERO_FIN1 = 1 where CAJERO_LOGIN = '$log_usr' and
                CAJERO_FECHA = '$fec1'";
   $resultado = mysql_query($consulta)or die('No pudo actualizar cajero saldo final 1 : ' . mysql_error()); 
}
if ($cod_mone == 2){
   $consulta = "update cajero set CAJERO_FIN2 = 1 where CAJERO_LOGIN = '$log_usr' and
                CAJERO_FECHA = '$fec1'";
   $resultado = mysql_query($consulta)or die('No pudo actualizar cajero saldo final 2 : ' . mysql_error()); 
}



}
if ($_SESSION['grab_def_prov'] == 1){
   $estado = 1;
  //  header('Location:menu_s.php');
}
if (isset($efec)){
 if ($saldo <> $efec){ ?>
<form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
<?php	 
	    $_SESSION['grab_def_prov'] = 1;
		$_SESSION['detalle'] = 0;
		$_SESSION['continuar'] = 1;
	    //$_SESSION['caja_bs_sus'] = $_SESSION['caja_bs_sus'];
		//$_SESSION['msje'] = "No igualan los saldos ".$saldo." ". $_SESSION['efectivo']." ".$efec;
		echo "Saldos NO igualan ";
	?> 
	<br> 
	<table width="40%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th width="30%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />Monto</th>
	 </tr>
	 <tr>
	   <td align="left"><?php echo "Saldo Efectivo";?></td>
	   <td align="right"><?php echo number_format($_SESSION['efectivo'], 2, '.',','); ?></td>
	 </tr>
      <tr>
	   <td align="left"><?php echo "Suma de cortes Ingresado";?></td>
	   <td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
	 </tr>
	 <tr>
	   <th align="left"><?php echo "Diferencia";?></th>
	   <td align="right"><?php echo number_format($_SESSION['efectivo'] - $saldo, 2, '.',','); ?></td>
	 </tr>
     
	 </table>
	 <br> 
     <?php
	 
	 ?>
	 <br> 
 <input type="submit" name="accion" value="Corriga">

</form>
<strong>	
 <?php } 
 }?>
</div>
<br>
   <center>
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