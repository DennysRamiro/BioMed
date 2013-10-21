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
    require('header_2.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login'];
 
 ?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
        <?php if($_GET["menu"] == 34){?> 
	    <a href=' cont_rep_op.php?accion=13'>Salir</a>
	    <?php } elseif($_GET["menu"] == 42){?> 
	    <a href=' cont_rep_op.php?accion=25'>Salir</a>
	     <!--a href='cont_reportes.php'>Salir</a-->
	   <?php }?>
  </div>

<br><br>
<?php
$fec_pro = $_POST['fec_nac'] ;
$f_pro = cambiaf_a_mysql($fec_pro);
$anio_pro = substr($fec_pro,6,4);
$tc_ctble = leer_tipo_cam_2($f_pro);
/* if (isset( $_SESSION['anio'])){
     if ($anio_pro <> $_SESSION['anio']){
        header('Location: tipo_rep_cont.php');
	 }
 } */
 
?> 
 <font size="+1"  style="" >
 <?/*php
echo encadenar(4)."PRO-DESARRROLLO MICROEMPRESARIAL S.R.L.";
?>
<br>
<?php
echo encadenar(4)."PRODEMIC S.R.L.";
?>
<br>
<?php
echo encadenar(4)."NIT:146804028";
?>
<br>
<?php
echo encadenar(4)."Quillacollo - Cochabamba - Bolivia";
?>
<br><br>
<?php
echo encadenar(58)."BALANCE  GENERAL";
?>
<br>
<?php
echo encadenar(63)."AL".encadenar(2).$fec_pro;
?>
<br>
<?php
echo encadenar(50)."(Expresado en Bolivianos y D&oacutelares)";
*/?>
<br>



<?php
$_SESSION["tipo2"] = 2;
  //  
//}
//if ($_SESSION["tipo2"] == 2){
 //   echo encadenar(50)."(Expresado en Bolivianos y Eqv. Dolares)";
//}
 ?>  
  
     
 <?php  if ($_SESSION["tipo2"] == 2){ ?>


<center>
	 <table border="0" width="600">
	<tr>
	    <th align="center"><?php echo encadenar(70); ?></th>  
	   <th align="center"><?php echo encadenar(20); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>
		
	</tr>	
	
	<tr>
	    <th align="center"><?php echo encadenar(50); ?></th>  
	    <th align="center"><?php echo encadenar(20); ?></th>
	    <th align="center" style="border-bottom-style:double">BS.</th> 
		<th align="center" style="border-rigth-style:double"><?php echo encadenar(20); ?></th> 
	   	<th align="center" style="border-bottom-style:double">
		<?php echo "SUS. T.C.".encadenar(2).number_format($tc_ctble, 2, '.',','); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>          
    </tr>
	<tr>
	   
	   	<th align="left" style="border-bottom:inherit"><?php echo "ACTIVO"; ?></th>
		 <th align="center"><?php echo encadenar(20); ?></th>   
		<th align="right"><?php echo encadenar(20); ?></th>
		
		  <th align="center"><?php echo encadenar(20); ?></th> 
	</tr>
	<tr>
	   
	   	<th align="left" style="border-bottom:inherit"><?php echo encadenar(20); ?></th>
		 <th align="center"><?php echo encadenar(20); ?></th>   
		<th align="right"><?php echo encadenar(20); ?></th>
		
		  <th align="center"><?php echo encadenar(20); ?></th> 
	</tr>
	<?php
	 $cmay = '111';
			$cmay1 = '144';
			$_SESSION['circu'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['circu'] = $saldo; ?>	
	
	
	
	
	<tr>
	   	<th align="left" style="border-bottom:inherit"><?php echo "ACTIVO CIRCULANTE"; ?></th>
		 <th align="center"><?php echo encadenar(20); ?></th>   
		<th align="right"><?php echo number_format($_SESSION['circu'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['circu']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	 <?php  } ?>
 
	 
<?php
// Leer temp_trasp	
$mone = 0;
$d_mone = "";
$nro = 0;
$niv ="1";
$est1 = '4';
$est2 = 'A';
if(isset($_POST['niv_2'])){  
	 $est1 = '1';
	 $est2 = '2';
      }
if(isset($_POST['niv_3'])){  
	 $est1 = '1';
	 $est2 = '3';
      }
if(isset($_POST['niv_4'])){  
	 $est1 = '1';
	 $est2 = '4';
      }
if(isset($_POST['niv_5'])){  
	 $est1 = '1';
	 $est2 = '5';
      }
if(isset($_POST['niv_A'])){  
	 $est1 = 'A';
	 $est2 = 'A';
      }	  
//$con_cta = "Select * From contab_cuenta order by CONTA_CTA_NRO";
//$res_cta = mysql_query($con_cta)or die('No pudo seleccionarse tabla contab_trans')  ;
//if ($_POST['niv_2'] == 'S'){

		//Disponible				
		    $cmay = '11';
			$_SESSION['dispo'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['dispo'] = $saldo;
				
	        
	
	
	
	
	
			?>
		<tr>
	   
	   	<th align="left" style="border-bottom:inherit"><?php echo encadenar(20); ?></th>
		 <th align="center"><?php echo encadenar(20); ?></th>   
		<th align="right"><?php echo encadenar(20); ?></th>
		
		  <th align="center"><?php echo encadenar(20); ?></th> 
	</tr>	
	
	<tr>
	   
	   	<th align="left"><?php echo "DISPONIBLE"; ?></th>
		 <th align="center"><?php echo encadenar(20); ?></th>   
		<th align="right"><?php echo number_format($_SESSION['dispo'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['dispo']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	<?php
	    $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,2)= '$cmay'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
		$des = leer_cta_des($cuenta);			  
		if ($saldo > 0){			  
		?>			  
				
	<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>							    
	<?php }
	    }
		
		//Cartera				
		    $cmay = '131';
			$cmay1 = '134';
			$_SESSION['carte'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['carte'] = $saldo; ?>
		<tr>
	    <th align="center"><?php echo encadenar(85); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>			  						   
		<tr>
		
	   
	   	<th align="left" style="border-bottom:inherit"><?php echo "EXIGIBLE"; ?></th>
		 <th align="center"><?php echo encadenar(20); ?></th>   
		<th align="right"><?php echo encadenar(20); ?></th>
		
		  <th align="center"><?php echo encadenar(20); ?></th> 
	</tr>
	
	<tr>
	   
	   	<th align="left"><?php echo "CARTERA"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td>
		<th align="right"><?php echo number_format($_SESSION['carte'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['carte']/
		                       $tc_ctble, 2, '.',',');?></td>   
	</tr>
	
	<?php
	//Cartera Vigente				
		    $cmay = '131';
			$cmay1 = '131';
			$_SESSION['carte_vig'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['carte_vig'] = $saldo;
	?>
	<tr>
	   
	   	<th align="left"><?php echo "CARTERA VIGENTE"; ?></th>
		 <td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['carte_vig'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['carte_vig']/
		                       $tc_ctble, 2, '.',',');?></td>  
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '131'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
		$des = leer_cta_des($cuenta);			  
		if ($saldo > 0){	 ?>
	<tr>
	   	<td align="left"><?php echo utf8_encode($cuenta.encadenar(4).$des); ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>							   
	<?php }
	    }
		?>
 <?php
	//Cartera Vencida			
		    $cmay = '133';
			$cmay1 = '133';
			$_SESSION['carte_ven'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['carte_ven'] = $saldo;
	?>		
	<tr>
	   	<th align="left"><?php echo "CARTERA VENCIDA"; ?></th> 
		 <td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['carte_ven'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['carte_ven']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '133'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
		<tr>
	   	<td align="left"><?php echo utf8_encode($cuenta.encadenar(4).$des); ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>		
		<?php }
	    }
		
	//Cartera Ejecucion
		    $cmay = '134';
			$cmay1 = '134';
			$_SESSION['carte_eje'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['carte_eje'] = $saldo;	
		
?>		
	<tr>
	
	   	<th align="left"><?php echo "CARTERA EJECUCION"; ?></th> 
		 <td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['carte_eje'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['carte_eje']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '134'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
		<tr>
	   	<td align="left"><?php echo utf8_encode($cuenta.encadenar(4).$des); ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>		
		<?php }
	    } 
		//Incobrabilidad
		    $cmay = '139';
			$cmay1 = '139';
			$_SESSION['incobra'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['incobra'] = $saldo;	
		
?>	
<tr>
	    <th align="center"><?php echo encadenar(70); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>		
	<tr>
	    
	   	<th align="left"><?php echo "PREVISION POR INCOBRABILIDAD"; ?></th> 
		 <td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['incobra'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['incobra']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '139'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
		<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>	
		<?php }
	    } 
//Diversas
		    $cmay = '143';
			$cmay1 = '143';
			$_SESSION['diversa'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['diversa'] = $saldo;	
		
?>	
<tr>
	    <th align="center"><?php echo encadenar(70); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>			
	<tr>
	   	<th align="left"><?php echo "DIVERSAS"; ?></th> 
		 <td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['diversa'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['diversa']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '143'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
		<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>	
		<?php }
	    } 
	
	
	
	?>
	<tr>
	    <th align="center"><?php echo encadenar(70); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>		
	
	<tr>
	    
	   	<th align="left"><?php echo "FIJO"; ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>  
	</tr>
	<?php
	$cmay = '173';
			$cmay1 = '175';
			$_SESSION['fijo'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and substr(CONTA_TRS_CTA,5,1) = '1'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and substr(CONTA_TRS_CTA,5,1) = '1'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['fijo'] = $saldo;	
		
?>	
	<tr>
	     
	   	<th align="left"><?php echo "ACTIVOS FIJOS"; ?></th> 
		 <td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['fijo'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['fijo']/
		                       $tc_ctble, 2, '.',',');?></td>  
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where (substr(CONTA_CTA_NRO,1,3)>= '173' 
							          and substr(CONTA_CTA_NRO,1,3) <= '175')
									  and  substr(CONTA_CTA_NRO,5,1) <= '1'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
		<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>	
		<?php }
	    } 
		
	        $cmay = '173';
			$cmay1 = '175';
			$_SESSION['depre'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and substr(CONTA_TRS_CTA,5,1) = '2'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and substr(CONTA_TRS_CTA,5,1) = '2'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['depre'] = $saldo;	
		
?>	
	<tr>
	   	<th align="left"><?php echo "-(Depreciación de Activos Fijos)"; ?></th> 
		 <td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['depre'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['depre']/
		                       $tc_ctble, 2, '.',',');?></td>   
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where (substr(CONTA_CTA_NRO,1,3)>= '173' 
							          and substr(CONTA_CTA_NRO,1,3) <= '175')
									  and  substr(CONTA_CTA_NRO,5,1) = '2'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
		<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
		?>
		<?php  
		
	        $cmay = '111';
			$cmay1 = '180';
			$_SESSION['activo'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						      and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						      and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['activo'] = $saldo;	
		
?>	
		
		
		
		 <tr>
	    <th align="center"><?php echo encadenar(70); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
		<tr>
	   	<tH align="left"><?php echo"TOTAL ACTIVO"; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<tH align="right"><?php echo number_format($_SESSION['activo'], 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['activo']/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
   <tr>
	    <th align="center"><?php echo encadenar(70); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
   <?php 
	//Diversas
		    $cmay = '210';
			$cmay1 = '266';
			$_SESSION['pasivo'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['obli_p'] = $saldo;	
		
?>	
	<tr>
	    <th align="left"><?php echo "PASIVO"; ?></th> 
	    <td align="left"><?php echo encadenar(4); ?></td> 
		<tH align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>  
	</tr>
	<?php 
	//Diversas
		    $cmay = '212';
			$cmay1 = '212';
			$_SESSION['obli_p'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['obli_p'] = $saldo;	
		
?>	
	
	
	
	<tr>
	   
	   	<th align="left"><?php echo "OBLIGACIONES CON EL PUBLICO"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['obli_p'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['obli_p']/
		                       $tc_ctble, 2, '.',',');?></td>  
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '212'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
	<?php
	$cmay = '237';
			$cmay1 = '237';
			$_SESSION['fin_ex1'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and substr(CONTA_TRS_CTA,6,1) = '1'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and substr(CONTA_TRS_CTA,6,1) = '1'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['fin_ex1'] = $saldo;
		if ($saldo <> 0){	 	
		
?>
	
	<tr>
	    
	   	<th align="left"><?php echo "OTROS FINANCIAMIENTOS EXTERNOS MN"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['fin_ex1'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['fin_ex1']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '237'
							   and substr(CONTA_CTA_NRO,6,1)= '1'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
<?php } ?>	
	<?php
	$cmay = '237';
			$cmay1 = '237';
			$_SESSION['fin_ex2'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and substr(CONTA_TRS_CTA,6,1) = '2'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and substr(CONTA_TRS_CTA,6,1) = '2'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['fin_ex2'] = $saldo;
		if ($saldo <> 0){	 	
		
?>
	
	<tr>
	    
	   	<th align="left"><?php echo "OTROS FINANCIAMIENTOS EXTERNOS ME"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['fin_ex2'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['fin_ex2']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '237'
							   and substr(CONTA_CTA_NRO,6,1)= '2'
                               and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
<?php } ?>
<?php
	$cmay = '242';
			$cmay1 = '242';
			$_SESSION['cta_ppag'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['cta_ppag'] = $saldo;
		 	
		
?>
	<tr>
	     
	   	<th align="left"><?php echo "OTRAS CUENTAS POR PAGAR"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['cta_ppag'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['cta_ppag']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '242'
							   and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
	<?php
	$cmay = '243';
			$cmay1 = '243';
			$_SESSION['provi'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['provi'] = $saldo;
		 	
		
?>
	<tr>
	    
	   	<th align="left"><?php echo "PROVISIONES"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['provi'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['provi']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '243'
							   and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
	<?php
	$cmay = '244';
			$cmay1 = '244';
			$_SESSION['p_impu'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['p_impu'] = $saldo;
		 	
		
?>
	<tr>
	   
	   	<th align="left"><?php echo "PARTIDAS PENDIENTES DE IMPUTACION"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['p_impu'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['p_impu']/
		                       $tc_ctble, 2, '.',',');?></td>  
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '244'
							   and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
	<?php
	$cmay = '257';
			$cmay1 = '257';
			$_SESSION['previ'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['previ'] = $saldo;
		 	
		
?>
	<tr>
	     
	   	<th align="left"><?php echo "PREVISIONES"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['previ'], 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['previ']/
		                       $tc_ctble, 2, '.',',');?></td> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '257'
							   and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
	<?php
	$cmay = '311';
			$cmay1 = '311';
			$_SESSION['cap_soc'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['cap_soc'] = $saldo;
		$cmay = '341';
			$cmay1 = '342';
			$_SESSION['reser'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['reser'] = $saldo;	
			$cmay = '351';
			$cmay1 = '351';
			$_SESSION['util'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						       and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['util'] = $saldo;			  		  
		 	
	
?>	
	<tr>
	    <th align="center"><?php echo encadenar(70); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	
	
	
	<tr>
	   
	   	<th align="left"><?php echo "PATRIMONIO"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td>  
		<th align="right"><?php echo number_format($_SESSION['cap_soc'] + $_SESSION['reser'] +
		                                           $_SESSION['util']
		                                           , 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>  										   
	<th align="right"><?php echo number_format(($_SESSION['cap_soc'] + $_SESSION['reser'] +
		                                           $_SESSION['util'])/$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	
	<tr>
	   
	   	<th align="left"><?php echo "CAPITAL SOCIAL"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['cap_soc'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format($_SESSION['cap_soc'] /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3)= '311'
							   and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
   
	<tr>
	   	<th align="left"><?php echo "RESERVAS"; ?></th> 
		<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['reser'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format($_SESSION['reser'] /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3) >= '341' and substr(CONTA_CTA_NRO,1,3) <= '342'
							   and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADOS ACUMULADOS"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['util'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format($_SESSION['util'] /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php $cta_tran = "Select CONTA_CTA_NRO From contab_cuenta 
				               where substr(CONTA_CTA_NRO,1,3) >= '351' and substr(CONTA_CTA_NRO,1,3) <= '351'
							   and CONTA_CTA_NIVEL = 'A'";
				  $res_cta = mysql_query($cta_tran);
				  while ($lin_cta = mysql_fetch_array($res_cta)) {
	                      $cuenta = $lin_cta['CONTA_CTA_NRO'];
	
	
	
	  $sum_tran = "Select  sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA= '$cuenta'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h- $monto_d;
		$des = leer_cta_des($cuenta);			  
		if ($saldo <> 0){	 ?>
			<tr>
	   	<td align="left"><?php echo $cuenta.encadenar(4).$des; ?></td> 
	   	<td align="left"><?php echo encadenar(4); ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td> 
		<td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td>
   </tr>
		<?php }
	    } 
	?>
		<tr>
	    <th align="center"><?php echo encadenar(70); ?></th>  
	   	<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<?php 
	      $mes = substr($f_pro,5,2);
		  $anio = substr($f_pro,0,4);
	//echo $anio;
	$_SESSION['i_ene'] = 0;
	$_SESSION['i_feb'] = 0;
	$_SESSION['i_mar'] = 0;
	$_SESSION['i_abr'] = 0;
	$_SESSION['i_may'] = 0;
	$_SESSION['i_jun'] = 0;
	$_SESSION['i_jul'] = 0;
	$_SESSION['i_ago'] = 0;
	$_SESSION['i_sep'] = 0;
	$_SESSION['i_oct'] = 0;
	$_SESSION['i_nov'] = 0;
	$_SESSION['i_dic'] = 0;
	$_SESSION['e_ene'] = 0;
	$_SESSION['e_feb'] = 0;
	$_SESSION['e_mar'] = 0;
	$_SESSION['e_abr'] = 0;
	$_SESSION['e_may'] = 0;
	$_SESSION['e_jun'] = 0;
	$_SESSION['e_jul'] = 0;
	$_SESSION['e_ago'] = 0;
	$_SESSION['e_sep'] = 0;
	$_SESSION['e_oct'] = 0;
	$_SESSION['e_nov'] = 0;
	$_SESSION['e_dic'] = 0;
	for ($x=1; $x < $mes+1; $x = $x + 1 ) {
	      $saldo = 0;
		  $monto_d =0;
		  $monto_h = 0;
	//echo $mes . " mes". $x. "x";
	 $cmay = '500';
			$cmay1 = '599';
			
			
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				           where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						   and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
						   and month(CONTA_TRS_FEC_VAL)= '$x'
						   and year(CONTA_TRS_FEC_VAL) = '$anio'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
							   and month(CONTA_TRS_FEC_VAL)='$x'
						   and year(CONTA_TRS_FEC_VAL) = '$anio'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_h - $monto_d;
					  if ($x == 1){
					      $_SESSION['i_ene'] = $saldo;
						  }
					   if ($x == 2){
					      $_SESSION['i_feb'] = $saldo;
						  }
					    if ($x == 3){
					      $_SESSION['i_mar'] = $saldo;
						  }
					   if ($x == 4){
					      $_SESSION['i_abr'] = $saldo;
						  }	 
					    if ($x == 5){
					      $_SESSION['i_may'] = $saldo;
						  }	
						 if ($x == 6){
					      $_SESSION['i_jun'] = $saldo;
						  } 
						 if ($x == 7){
					      $_SESSION['i_jul'] = $saldo;
						  }  
					    if ($x == 8){
					      $_SESSION['i_ago'] = $saldo;
						  }	
						  if ($x == 9){
					      $_SESSION['i_sep'] = $saldo;
						  } 
						   if ($x == 10){
					      $_SESSION['i_oct'] = $saldo;
						  } 
						  if ($x == 11){
					      $_SESSION['i_nov'] = $saldo;
						  }
						    if ($x == 12){
					      $_SESSION['i_dic'] = $saldo;
						  }     
	
	$cmay = '400';
			$cmay1 = '499';
			$_SESSION['cta_ppag'] = 0;
		      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				          where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
							  and month(CONTA_TRS_FEC_VAL)= '$x'
						   and year(CONTA_TRS_FEC_VAL) = '$anio'
						       and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
				
	        			}
	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
                              where (substr(CONTA_TRS_CTA,1,3) >= '$cmay' 
						      and substr(CONTA_TRS_CTA,1,3) <= '$cmay1')
							  and month(CONTA_TRS_FEC_VAL)= '$x'
						   and year(CONTA_TRS_FEC_VAL) = '$anio'
						       and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				
				      $saldo = $monto_d - $monto_h;
					   if ($x == 1){
					      $_SESSION['e_ene'] = $saldo;
						  }
					   if ($x == 2){
					      $_SESSION['e_feb'] = $saldo;
						  }
					    if ($x == 3){
					      $_SESSION['e_mar'] = $saldo;
						  }
					   if ($x == 4){
					      $_SESSION['e_abr'] = $saldo;
						  }	 
					    if ($x == 5){
					      $_SESSION['e_may'] = $saldo;
						  }	
						 if ($x == 6){
					      $_SESSION['e_jun'] = $saldo;
						  } 
						 if ($x == 7){
					      $_SESSION['e_jul'] = $saldo;
						  }  
					    if ($x == 8){
					      $_SESSION['e_ago'] = $saldo;
						  }	
						  if ($x == 9){
					      $_SESSION['e_sep'] = $saldo;
						  } 
						   if ($x == 10){
					      $_SESSION['e_oct'] = $saldo;
						  } 
						  if ($x == 11){
					      $_SESSION['e_nov'] = $saldo;
						  }
						    if ($x == 12){
					      $_SESSION['e_dic'] = $saldo;
						  }     
		} 
		$_SESSION['util_g'] = ($_SESSION['i_ene'] - $_SESSION['e_ene']) +
		                    ($_SESSION['i_feb'] - $_SESSION['e_feb']) +
							($_SESSION['i_mar'] - $_SESSION['e_mar']) +
							($_SESSION['i_abr'] - $_SESSION['e_abr']) +
							($_SESSION['i_may'] - $_SESSION['e_may']) +
							($_SESSION['i_jun'] - $_SESSION['e_jun']) +
							($_SESSION['i_jul'] - $_SESSION['e_jul']) +
							($_SESSION['i_ago'] - $_SESSION['e_ago']) +
							($_SESSION['i_sep'] - $_SESSION['e_sep']) +
							($_SESSION['i_oct'] - $_SESSION['e_oct']) +
							($_SESSION['i_nov'] - $_SESSION['e_nov']) +
							($_SESSION['i_dic'] - $_SESSION['e_dic']);
	?> 
	
	
	
	
	
	
	
	
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADOS DE LA GESTION 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['util_g'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format($_SESSION['util_g'] /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	 <?php 
	   if ($_SESSION['i_ene'] - $_SESSION['e_ene'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO ENERO 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_ene'] - $_SESSION['e_ene'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		<th align="right"><?php echo number_format(($_SESSION['i_ene'] - $_SESSION['e_ene']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
	 <?php 
	   if ($_SESSION['i_feb'] - $_SESSION['e_feb'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO FEBRERO 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_feb'] - $_SESSION['e_feb'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_feb'] -$_SESSION['e_feb']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_mar'] - $_SESSION['e_mar'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO MARZO 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_mar'] - $_SESSION['e_mar'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_mar'] -$_SESSION['e_mar']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_abr'] - $_SESSION['e_abr'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO ABRIL 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_abr'] - $_SESSION['e_abr'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_abr'] -$_SESSION['e_abr']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_may'] - $_SESSION['e_may'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO MAYO 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_may'] - $_SESSION['e_may'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_may'] -$_SESSION['e_may']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_jun'] - $_SESSION['e_jun'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO JUNIO 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_jun'] - $_SESSION['e_jun'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_jun'] -$_SESSION['e_jun']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_jul'] - $_SESSION['e_jul'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO JULIO 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_jul'] - $_SESSION['e_jul'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_jul'] -$_SESSION['e_jul']) /$tc_ctble
		                                           , 2, '.',','); ?></th>  
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_ago'] - $_SESSION['e_ago'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO AGOSTO 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_ago'] - $_SESSION['e_ago'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_ago'] -$_SESSION['e_ago']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_sep'] - $_SESSION['e_sep'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO SEPTIEMBRE 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_sep'] - $_SESSION['e_sep'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_sep'] -$_SESSION['e_sep']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_oct'] - $_SESSION['e_oct'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO OCTUBRE 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_oct'] - $_SESSION['e_oct'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_oct'] -$_SESSION['e_oct']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_nov'] - $_SESSION['e_nov'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO NOVIEMBRE 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_nov'] - $_SESSION['e_nov'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_nov'] - $_SESSION['e_nov']) /$tc_ctble
		                                           , 2, '.',','); ?></th>  
	</tr>
	<?php } ?>
	<?php 
	   if ($_SESSION['i_dic'] - $_SESSION['e_dic'] <> 0){
	    ?>
	<tr>
	    
	   	<th align="left"><?php echo "RESULTADO DICIEMBRE 2011"; ?></th> 
			<td align="left"><?php echo encadenar(4); ?></td> 
		<th align="right"><?php echo number_format($_SESSION['i_dic'] - $_SESSION['e_dic'], 2, '.',','); ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>  
		 <th align="right"><?php echo number_format(($_SESSION['i_dic'] - $_SESSION['e_dic']) /$tc_ctble
		                                           , 2, '.',','); ?></th> 
	</tr>
	<?php } ?>
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

