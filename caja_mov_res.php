<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
		include("header_2.php");
?>
<?php
// $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='rep_param_cja.php?menu=2'>Salir</a>
  </div>

<br><br>
<?php
$f_des = "";
$f_has = "";
$mone = " ";
if(isset($_POST['fec_des'])){
      $f_des = $_POST['fec_des'];
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
  }
 if(isset($_POST['fec_has'])){
      $f_has = $_POST['fec_has'];
      $_SESSION['f_has'] = $f_has;
	  $f_has2 = cambiaf_a_mysql($f_has);
  } 
 // if(isset($_POST['cod_mon'])){
 //     $mone = $_POST['cod_mon'];
 //     $_SESSION['mone'] = $mone;
  //}  
?> 
<font size="+1"  style="" >
<?php
//if ($mone == 1){
    echo encadenar(45)."RESUMEN DIARIO DE CAJAS";
 // }
 //if ($mone == 2){
 //   echo encadenar(45)."LISTADO DE MOVIMIENTOS CAJA EN ".encadenar(2). "DOLARES";
 // } 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(60)."AL".encadenar(3).$f_has;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="800">
	
	<tr>
	    <th align="center">DESCRIPCION</th> 
		<th align="center">INGRESOS Bs.</th>     
		<th align="center">EGRESOS Bs.</th>
		<th align="center">INGRESOS $us.</th>     
		<th align="center">EGRESOS $us.</th>
	</tr>		

<?php 
  //Datos del cart_det_tran	
   	$t_ing = 0;
	$t_egr = 0;
	$t_ing1 = 0;
	$t_egr1 = 0;
	$t_egr = 0;			
	$t_ing2 = 0;
	$t_egr2 = 0;
	$impo_sus = 0;
	$impo = 0;					
	$con_tpa = "Select CAJA_TRAN_FECHA,CAJA_TRAN_TIPO_OPE From caja_transac where
	            (CAJA_TRAN_FECHA between '$f_has2' and '$f_has2') 
				 and CAJA_TRAN_USR_BAJA is null 
				 group by CAJA_TRAN_FECHA,CAJA_TRAN_TIPO_OPE
				 order by  CAJA_TRAN_FECHA,CAJA_TRAN_TIPO_OPE ";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla caja_transac')  ;
	// and CAJA_TRAN_APL_DES <> 10000
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $fec_pag = $lin_tpa['CAJA_TRAN_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$tip_ope = $lin_tpa['CAJA_TRAN_TIPO_OPE'];
			
			$mov_bs_1 = 0;
			$mov_bs_2 = 0;
			$mov_su_1 = 0;
			$mov_su_2 = 0;
			      $sum_tran = "Select sum(CAJA_TRAN_IMPORTE) From caja_transac 
				               where CAJA_TRAN_FECHA= '$f_has2'
                               and CAJA_TRAN_IMPORTE = CAJA_TRAN_IMP_EQUIV
							   and CAJA_TRAN_IMPORTE > 0 and CAJA_TRAN_TIPO_OPE = $tip_ope";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $mov_bs_1 = $lin_tran['sum(CAJA_TRAN_IMPORTE)'];
	        			}
			       $sum_tran = "Select sum(CAJA_TRAN_IMPORTE) From caja_transac 
				               where CAJA_TRAN_FECHA= '$f_has2'
                               and CAJA_TRAN_IMPORTE = CAJA_TRAN_IMP_EQUIV
							   and CAJA_TRAN_IMPORTE < 0 and CAJA_TRAN_TIPO_OPE = $tip_ope";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $mov_bs_2 = $lin_tran['sum(CAJA_TRAN_IMPORTE)'];
	        			}
			      $sum_tran = "Select sum(CAJA_TRAN_IMP_EQUIV) From caja_transac 
				               where CAJA_TRAN_FECHA= '$f_has2'
                               and CAJA_TRAN_IMPORTE <> CAJA_TRAN_IMP_EQUIV
							   and CAJA_TRAN_IMPORTE > 0 and CAJA_TRAN_TIPO_OPE = $tip_ope";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $mov_su_1 = $lin_tran['sum(CAJA_TRAN_IMP_EQUIV)'];
	        			}
			      $sum_tran = "Select sum(CAJA_TRAN_IMP_EQUIV) From caja_transac 
				               where CAJA_TRAN_FECHA= '$f_has2'
                               and CAJA_TRAN_IMPORTE <> CAJA_TRAN_IMP_EQUIV
							   and CAJA_TRAN_IMPORTE < 0 and CAJA_TRAN_TIPO_OPE = $tip_ope";
				  $res_tran = mysql_query($sum_tran)or die('No pudo seleccionarse 
				              tabla contab_trans');
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $mov_su_2 = $lin_tran['sum(CAJA_TRAN_IMP_EQUIV)'];
	        			}
			
	if ($tip_ope == 1){
	    $detalle = "SALDOS INCIALES CAJA";		
		}	
		if ($tip_ope == 6){
		    if (($mov_bs_1 + $mov_su_1) > 0){
			    $detalle = "RECUPERACION DE CREDITOS";		
				}
		}		
						  
		
		
		?>
	
	
	<tr>
	    	
		<td align="left" ><?php echo $detalle; ?></td>	
	    <td align="right" ><?php echo number_format($mov_bs_1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mov_bs_2, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mov_su_1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mov_su_2, 2, '.',','); ?></td>
		
	</tr>
	<?php  } ?>
	<tr>
	  			
	    <th align="right" ><?php echo number_format($t_ing1, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_egr1, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_ing1 - $t_egr1, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($t_ing2, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_egr2, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_ing2 - $t_egr2, 2, '.',','); ?></td>
	</tr>	
</table>
<br><br>
</center>		
<?php	
 	include("footer_in.php");
?>

</div>
</body>
</html>



<?php
ob_end_flush();
 ?>

