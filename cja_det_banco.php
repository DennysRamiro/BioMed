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
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='rep_param_cja.php?menu=5'>Salir</a>
  </div>
<?php
		//include("header_2.php");
?>

<br>
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
  if(isset($_POST['cod_mon'])){
      $mone = $_POST['cod_mon'];
      $_SESSION['mone'] = $mone;
  } 
  if(isset($_POST['cod_bco'])){
      $cod_bco = $_POST['cod_bco'];
      $_SESSION['cod_bco'] = $cod_bco;
  }
//  echo $cod_bco;   
?> <center>
<font size="+1"  style="" >
<?php
if ($mone == 1){
    echo encadenar(0)."LISTADO DE MOVIMIENTOS BANCOS EN  ".encadenar(2). "BOLIVIANOS";
  }
 if ($mone == 2){
    echo encadenar(0)."LISTADO DE MOVIMIENTOS BANCOS EN ".encadenar(2). "DOLARES";
  } 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(0)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>

<br><br>
<font size="0"  style="" >
	 <table border="1" width="800">
	
	<tr>
	    <th align="center"><font size="-1">FECHA </th> 
	   	<th align="center"><font size="-1">NRO. TRAN.</th> 
		<th align="center"><font size="-1">NRO.CUENTA</th>
		<th align="center"><font size="-1">DESCRIPCION</th>
		<th align="center"><font size="-1">DEPOSITO</th>  
		<th align="center"><font size="-1">RETIRO</th>
		<th align="center"><font size="-1">DESCRIPCION</th>
		<th align="center"><font size="-3">CAJERO</th>
	</tr>		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	
	$t_dep = 0;
	$t_ret = 0; 
	$t_otro = 0;
	$t_pen = 0;
	$t_com = 0;
	$t_tot  = 0;	
	if ($cod_bco > 0){			
    	$con_tpa = "Select * From caja_deposito where
	            (CAJA_DEP_FECHA between '$f_des2' and '$f_has2') and 
	             CAJA_DEP_MON = $mone and substr(CAJA_DEP_CTA_CTB,1,3) = '111' 
				 and CAJA_DEP_CTA_BCO = '$cod_bco'
				 and CAJA_DEP_USR_BAJA is null
				 ORDER BY CAJA_DEP_FECHA,CAJA_DEP_NRO  ";
	}	
	if ($cod_bco == 0){			
    	$con_tpa = "Select * From caja_deposito where
	            (CAJA_DEP_FECHA between '$f_des2' and '$f_has2') and 
	             CAJA_DEP_MON = $mone and substr(CAJA_DEP_CTA_CTB,1,3) = '111' 
				 and CAJA_DEP_USR_BAJA is null
				 ORDER BY CAJA_DEP_FECHA,CAJA_DEP_NRO";
	}		 
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		       $dep = 0;
	           $ret = 0;
		    $fec_pag = $lin_tpa['CAJA_DEP_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CAJA_DEP_NRO'];
			$cod_cta = $lin_tpa['CAJA_DEP_CTA_CTB'];
			$mon = $lin_tpa['CAJA_DEP_MON'];
			$tip = $lin_tpa['CAJA_DEP_TIPO'];
			$impo = $lin_tpa['CAJA_DEP_IMPO'];
			$impo2 = $lin_tpa['CAJA_DEP_IMPO2'];
			$desc =  $lin_tpa['CAJA_DEP_QUIEN'];
			$caje = $lin_tpa['CAJA_DEP_USR_ALTA'];
			 $des_cta = leer_cta_des($cod_cta);
		//	echo $cod_cre;
	//Consulta Cart_maestro
	        if ($impo2 < 0){
			    $impo2 = $impo2 * -1;
			}
	        if ($impo < 0){
			    $impo = $impo * -1;
			}
			
			if ($mon == 2){
			    $impo = $impo2;
			}
			if ($tip == 1){
			    $dep =  $impo;
				$ret =  0;
				$t_dep = $t_dep + $dep;
			}
			if ($tip == 2){
			    $ret =  $impo;
				$dep =  0;
				$t_ret = $t_ret + $ret;
			}
			$con_cta = "Select * From caja_deposito where
	            (CAJA_DEP_FECHA between '$f_des2' and '$f_has2') and 
	             CAJA_DEP_NRO = $nro_tran and substr(CAJA_DEP_CTA_CTB,1,3) <> '111' 
				 and CAJA_DEP_USR_BAJA is null
				 ORDER BY CAJA_DEP_IMPO DESC LIMIT 0,1";
            $res_cta = mysql_query($con_cta);
             while ($lin_cta1 = mysql_fetch_array($res_cta)) {
			        $cod_cta1 = $lin_cta1['CAJA_DEP_CTA_CTB'];
                    $des_cta = leer_cta_des($cod_cta1);
			}	
			
		//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
			
		  //  $p_tot  = 0;
			
			
		//	$t_tot = $t_tot + $p_tot;
		?>
	
		
	<tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
	    <td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="right" ><?php echo $cod_cta1; ?></td>	
		<td align="left" style="font-size:10px" ><?php echo utf8_encode($des_cta); ?></td>
		<td align="right" ><?php echo number_format($dep, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($ret, 2, '.',','); ?></td>
	 	<td align="left" style="font-size:10px" ><?php echo utf8_encode($desc); ?></td>
		<td align="left" style="font-size:10px" ><?php echo $caje; ?></td>
		
	</tr>	
	
	<?php  } ?>
	<tr>
	    <th align="left" ><?php echo encadenar(2); ?></td>
	    <td align="right" ><?php echo  encadenar(2); ?></td>
		<th align="right" ><?php echo "TOTAL"; ?></td>	
		<td align="left" style="font-size:10px" ><?php echo  encadenar(2); ?></td>
		<th align="right" ><?php echo number_format($t_dep, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_ret, 2, '.',','); ?></td>
	 	<td align="left" style="font-size:10px" ><?php echo  encadenar(2); ?></td>
		<td align="left" style="font-size:10px" ><?php echo  encadenar(2); ?></td>
		
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

