<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
    include("header_2.php");
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 $fec = $_SESSION['fec_proc'];  //leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='rep_param_cja.php?menu=1'>Salir</a>
  </div>

<?php
$f_des = "";
$f_has = "";
$mone = " ";

if ($_SESSION['detalle'] <> 3) {	
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
 } 
  if ($_SESSION['detalle'] == 3) {	
    // echo "Llega",$_SESSION['f_des'],"*",$_SESSION['f_has'];
     if(isset($_POST['log_caj'])){
      $caje = $_POST['log_caj'];
      $_SESSION['caje'] = $caje;
	  $f_des = $_SESSION['f_des'];
	   $f_des2 = cambiaf_a_mysql($f_des);
	  $f_has = $_SESSION['f_has'];
	  $f_has2 = cambiaf_a_mysql($f_has);
      }  
	  $con_tpa = "Select * From caja_transac where
	            (CAJA_TRAN_FECHA between '$f_des2' and '$f_has2') 
				 and CAJA_TRAN_DESCRIP <> 'SALDO FINAL'
				 and CAJA_TRAN_USR_ALTA = '$caje'
	           	 and CAJA_TRAN_USR_BAJA is null 
				 order by  CAJA_TRAN_FECHA,CAJA_TRAN_TIPO_OPE,CAJA_TRAN_NRO_CAR "; 
 
 
 
 
 
 } 
 // if(isset($_POST['cod_mon'])){
 //     $mone = $_POST['cod_mon'];
 //     $_SESSION['mone'] = $mone;
  //}  
?> 
<font size="+1"  style="" >
<?php
//if ($mone == 1){
    echo encadenar(55)."LISTADO DE MOVIMIENTOS CAJA ";
 // }
 //if ($mone == 2){
 //   echo encadenar(45)."LISTADO DE MOVIMIENTOS CAJA EN ".encadenar(2). "DOLARES";
 // } 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(57)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="left">
    <tr>
      <td scope="col" style="font-size:10px" align="center"><border="0" alt="" align="absmiddle" />FECHA TRANSAC.</th>
	  <td width="5%" scope="col" style="font-size:10px" align="center"><border="0" alt="" align="absmiddle" />NRO.COMP.</th>
	  <td width="20%" scope="col" style="font-size:10px" align="center"><border="0" alt="" align="absmiddle" />TIP.TRANS.</th>
	  <td width="60%" scope="col" style="font-size:10px" align="center" ><border="0" alt="" align="absmiddle" />DETALLES</th>
	  <td width="20%" scope="col" style="font-size:10px" align="center"><border="0" alt="" align="absmiddle" />INGRESOS Bs.</th>
      <td width="20%" scope="col" style="font-size:10px" align="center"  ><border="0" alt="" align="absmiddle" />EGRESOS Bs.</th>
	  <td width="20%" scope="col" style="font-size:10px" align="center"><border="0" alt="" align="absmiddle" />SALDO Bs.</th>
	  <td width="20%" scope="col" style="font-size:10px" align="center"><border="0" alt="" align="absmiddle" />INGRESOS $us.</th>
      <td width="20%" scope="col" style="font-size:10px" align="center" ><border="0" alt="" align="absmiddle" />EGRESOS $us.</th>
	  <td width="20%" scope="col" style="font-size:10px" align="center"><border="0" alt="" align="absmiddle" />SALDO $us.</th>
	   <td width="10%" scope="col" style="font-size:10px" align="center"><border="0" alt="" align="absmiddle" />Cajero</th>
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
	
 if ($_SESSION['detalle'] == 2) {	
 			
	$con_tpa = "Select * From caja_transac where
	            (CAJA_TRAN_FECHA between '$f_des2' and '$f_has2') 
				 and CAJA_TRAN_DESCRIP <> 'SALDO FINAL'
				 and CAJA_TRAN_USR_ALTA = '$logi'
	           	 and CAJA_TRAN_USR_BAJA is null 
				 order by  CAJA_TRAN_FECHA,CAJA_TRAN_TIPO_OPE,CAJA_TRAN_NRO_CAR ";
}
 if ($_SESSION['detalle'] == 1) {	
   //if(isset($_POST['t'])){ 
   

   if(isset($_POST['miradio'])){ 

   	if ($_POST['miradio']=="ctot") {

		 $con_tpa = "Select * From caja_transac where
			            (CAJA_TRAN_FECHA between '$f_des2' and '$f_has2') 
						 and CAJA_TRAN_DESCRIP <> 'SALDO FINAL'
						 and CAJA_TRAN_USR_BAJA is null 
						 order by  CAJA_TRAN_FECHA,CAJA_TRAN_TIPO_OPE,CAJA_TRAN_NRO_CAR ";

   	
   	} 	if ($_POST['miradio']=="cvig") {  

   		header('Location: cja_cajero.php');

   	}
   }

 /*  if(isset($_POST['miradio'])){ 
	 
	 $con_tpa = "Select * From caja_transac where
	            (CAJA_TRAN_FECHA between '$f_des2' and '$f_has2') 
				 and CAJA_TRAN_DESCRIP <> 'SALDO FINAL'
				 and CAJA_TRAN_USR_BAJA is null 
				 order by  CAJA_TRAN_FECHA,CAJA_TRAN_TIPO_OPE,CAJA_TRAN_NRO_CAR ";
      }
  if(isset($_POST['miradio'])){ 
  	//if(isset($_POST['s'])){ 
       header('Location: cja_cajero.php');
  			  
  }	
*/

}


 
 
    $res_tpa = mysql_query($con_tpa);
	
	
	
	// and CAJA_TRAN_APL_DES <> 10000
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $fec_pag = $lin_tpa['CAJA_TRAN_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CAJA_TRAN_NRO_DOC'];
			$nro_tr_cart = $lin_tpa['CAJA_TRAN_NRO_CAR'];
			$cod_apl = $lin_tpa['CAJA_TRAN_APL_DES'];
			$mone = $lin_tpa['CAJA_TRAN_MON'];
			$impo = $lin_tpa['CAJA_TRAN_IMPORTE'];
			$impo_sus = $lin_tpa['CAJA_TRAN_IMP_EQUIV'];
			$detalle = $lin_tpa['CAJA_TRAN_DESCRIP'];
			$tip_ope = $lin_tpa['CAJA_TRAN_TIPO_OPE'];
			$caje = $lin_tpa['CAJA_TRAN_USR_ALTA'];
			$cod_ap = $lin_tpa['CAJA_TRAN_APL_ORG'];
			
			$des_apl = "-";
			$p_ing1 = 0;
			$p_ing2 = 0;
			$p_egr1 = 0;
		    $p_egr2 = 0;			  
	if ($tip_ope <> 14){
		if ($impo <> $impo_sus){	
			if ($impo_sus > 0){ 
			    $p_ing2 =  $impo_sus;
				$p_ing1 =  0;
				} 	
			 if ($impo_sus < 0){ 
			    $p_egr2 =  $impo_sus * -1;
			    $p_egr1 =  0;
				}	
			}else{
			  if ($impo > 0){ 
			     $p_ing1 =  $impo;
			     $p_ing2 =  0;
				} 
			  if ($impo < 0){ //4a
			     $p_egr1 =  $impo * -1;
			     $p_egr2 =  0;
			 	} 	 	
			}
		}
	if ($tip_ope == 14){
	//	if ($impo <> $impo_sus){	
			if ($impo_sus > 0){ 
			    $p_ing2 =  $impo_sus;
				$p_egr1 =  $impo * -1;
				} 	
			 if ($impo_sus < 0){ 
			    $p_egr2 =  $impo_sus * -1;
			    $p_ing1 =  $impo;
				}	
			//		}
		}			
		/*	 $con_ctble = "Select * From gral_param_propios
             where GRAL_PAR_PRO_GRP = 100 and GRAL_PAR_PRO_COD = $cod_apl "; 
             $res_ctble = mysql_query($con_ctble)or die('No pudo seleccionarse gral_param_propios');
 
             while ($lin_ctble = mysql_fetch_array($res_ctble)) {
			        $des_apl = $lin_ctble['GRAL_PAR_PRO_DESC'];
				}	
		*/
		if ($tip_ope == 6){
		   if ($cod_ap == 1){
		       $des_apl = "Cart. - Desembolso";
		   }
		   if ($cod_ap == 2){
		       $des_apl = "Cart. - Cobro";
		   }
		}
		if ($tip_ope == 11){
		   if ($cod_ap == 1){
		       $des_apl = "Fgar. - Deposito";
		   }
		   if ($cod_ap == 2){
		       $des_apl = "Fgar. - Retiro";
		   }
		}
		if ($tip_ope == 13){
		   if ($cod_ap == 1){
		       $des_apl = "I/E - Ingreso";
		   }
		   if ($cod_ap == 2){
		       $des_apl = "I/E - Egreso";
		   }
		}
		if ($tip_ope == 14){
		   if ($cod_ap == 1){
		       $des_apl = "C/V Div. - Compra";
		   }
		   if ($cod_ap == 2){
		       $des_apl = "C/V Div. - Venta";
		   }
		}
		if ($tip_ope == 15){
		   if ($cod_ap == 1){
		       $des_apl = "Mov Bco-Deposito";
		   }
		   if ($cod_ap == 2){
		       $des_apl = "Mov Bco - Retiro";
		   }
		}
		if ($nro_tran == 0){
		     $nro_tran = $nro_tr_cart;
			 }
		if ($des_apl == ""){
		    $des_apl = "-";
			}
		?>
	
	
	<tr>
	    <td align="left" style="font-size:11px" ><?php echo $f_pag; ?></td>
		<td align="right" style="font-size:11px"><?php echo number_format($nro_tr_cart, 0, '.',''); ?></td>
		<td align="left" style="font-size:12px"><?php echo $des_apl; ?></td>	
		<td align="left" style="font-size:11px"><?php echo utf8_encode($detalle); ?></td>	
	<?php $t_ing1 =  $t_ing1 + $p_ing1;
		  $t_egr1 =  $t_egr1 + $p_egr1;
		  $t_ing2 =  $t_ing2 + $p_ing2;	
	      $t_egr2 =  $t_egr2 + $p_egr2;  ?>							
	    <td align="right" ><?php echo number_format($p_ing1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_egr1, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($t_ing1 - $t_egr1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_ing2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_egr2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($t_ing2 - $t_egr2, 2, '.',','); ?></td>
		<td align="right" style="font-size:10px" ><?php echo $caje; ?></td>
	</tr>
	<?php  } ?>
	<tr>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>					
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

