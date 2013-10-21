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
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login'];
 
 ?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cont_reportes.php'>Salir</a>
  </div>

<br><br>
<?php
$fec_pro = $_POST['fec_nac'] ;
$f_pro = cambiaf_a_mysql($fec_pro);
$tc_ctble = leer_tipo_cam_2($f_pro);
?> 
 <font size="+2"  style="" >
<?php
echo encadenar(40)."Estado de Situacion al ".encadenar(3).$fec_pro.encadenar(3)."T.C.".encadenar(3).$tc_ctble;
?>
<br>
<?php
if ($_SESSION["tipo2"] == 1){
    echo encadenar(50)."(Expresado en Bolivianos)";
}
if ($_SESSION["tipo2"] == 2){
    echo encadenar(50)."(Expresado en Bolivianos y Eqv. Dolares)";
}
 ?>  
  
     
 <?php  if ($_SESSION["tipo2"] == 1){ ?>


<center>
	 <table border="0" width="600">
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>	
	<tr>
	    <th align="center" style="border-bottom-style:double">Cuenta</th>  
	   	<th align="center" style="border-bottom-style:double">Descripcion</th> 
		<th align="center" style="border-bottom-style:double">Saldo</th>           
    </tr>
	 <?php  } ?>
 <?php  if ($_SESSION["tipo2"] == 2){ ?>


<center>
	 <table border="0" width="600">
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>	
	<tr>
	    <th align="center" style="border-bottom-style:double">Cuenta</th>  
	   	<th align="center" style="border-bottom-style:double">Descripcion</th> 
		<th align="center" style="border-bottom-style:double">Saldo Bs.</th>  
		<th align="center" style="border-bottom-style:double">Saldo $us.</th>          
    </tr>
	 <?php  } ?>	 
	 
	 
<?php
// Leer temp_trasp	
$mone = 0;
$d_mone = "";
$nro = 0;
$niv ="1";

$con_cta = "Select * From contab_cuenta order by CONTA_CTA_NRO";
$res_cta = mysql_query($con_cta)or die('No pudo seleccionarse tabla contab_trans')  ;
	
	    while ($lin_cta = mysql_fetch_array($res_cta)) {
		      $monto_d = 0;
			  $monto_h = 0;
			  $saldo = 0;
			  $tipo = "";
		      $cta = $lin_cta['CONTA_CTA_NRO'];
			  $mon = substr($cta,5,1); 
		      $niv = $lin_cta['CONTA_CTA_NIVEL'];
			  $des = $lin_cta['CONTA_CTA_DESC'];
			  
		      $nro = $nro + 1;
			  if ($niv == "1"){
			      $cmay = substr($cta,0,1);
				  $tipo = substr($cta,0,1);
				//  echo "cmay ".$cmay."tipo ".$tipo;
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,1)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
						// echo "Mon-DEB ".$monto_d;
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,1)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['activo'] = $saldo;
					//  echo $_SESSION['activo'], "Activo";
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['pasivo'] = $saldo;
				  }	
				  if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['patrimonio'] = $saldo;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['gastos'] = $saldo;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['ingresos'] = $saldo;
				  }	 	 						   
			 } 
			  if ($niv == "2"){
			      $tipo = substr($cta,0,1);
			      $des = encadenar(2).$des;
			      $cmay = substr($cta,0,2);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}	
				 if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_h - $monto_d;
				  }	  	
				 } 
			   if ($niv == "3"){
			      $tipo = substr($cta,0,1);
			      $des = encadenar(4).$des;
			      $cmay = substr($cta,0,3);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,3)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							  and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,3)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  	if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_h - $monto_d;
				  }	  			
				 }
			  if ($niv == "4"){
			      $tipo = substr($cta,0,1);
			      $des = encadenar(6).$des;
			      $cmay = substr($cta,0,5);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,5)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,5)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	 
				   if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_h - $monto_d;
				  }	 		
				 }
			  if ($niv == "5"){
			      $tipo = substr($cta,0,1);
			      $des = encadenar(8).$des;
			      $cmay = substr($cta,0,6);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,6)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,6)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null ";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				 if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }
				    if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_h - $monto_d;
				  }	 		
				 }
			   if ($niv == "A"){
			  // echo "aqui";
			      $tipo = substr($cta,0,1);
			      $des = encadenar(12).$des;
			      $cmay = $cta;
			      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA = '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null ";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA = '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				 if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	
				  if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_h - $monto_d;
				  }	   				
			      
				 }

    if ($saldo <> 0){
	    if ($niv <> "1"){
	?>
	<tr>
	    <td align="center"><?php echo $cta; ?></td>  
	   	<td align="left"><?php echo $des; ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		 <?php  if ($_SESSION["tipo2"] == 2){ 
		           if ($mon == 2){?>
		 <td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td> 
		<?php } 
		        } ?>
	</tr>		 
	<?php
	}
	if ($niv == "1"){
	?>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo $cta; ?></th>  
	   	<th align="left"><?php echo $des; ?></th> 
		<th align="right"><?php echo number_format($saldo, 2, '.',','); ?></th>
		
		
		
		
	</tr>	
	
	<?php
	}			 
	}
	}
			?>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
			   
	<tr>
	    <th align="center"><?php echo encadenar(3); ?></th>  
	   	<th align="center"><?php echo "RESULTADOS" ; ?></th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Activo"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['activo'], 2, '.',','); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Pasivo"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['pasivo'], 2, '.',','); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Patrimonio"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['patrimonio'], 2, '.',','); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Resultado de la Gestion"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['activo'] - 
		                        ($_SESSION['pasivo'] + $_SESSION['patrimonio']), 2, '.',','); ?></th>
	</tr>
<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "PASIVO + PATRIMONIO + RES.GESTION "; ?></td> 
		<th align="right"><?php echo number_format($_SESSION['pasivo'] + $_SESSION['patrimonio']
		                        + ($_SESSION['activo']-($_SESSION['pasivo'] +
								$_SESSION['patrimonio'])), 2, '.',','); ?></td>
	</tr>
	
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
		<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Ingresos"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['ingresos'], 2, '.',','); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Gastos"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['gastos'], 2, '.',','); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "TOTAL INGRESOS - TOTAL EGRESOS"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['ingresos'] - $_SESSION['gastos'], 2, '.',','); ?></th>
	</tr>
	
	
</table>
		  
<br>
</center>
</font>

<?php
		 	include("footer_in.php");
		 ?>

</div>




<?php
}
ob_end_flush();
 ?>

