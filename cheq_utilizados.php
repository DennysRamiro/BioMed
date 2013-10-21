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
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 include("header_2.php");
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='chec_reportes.php'>Salir</a>
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
  if(isset($_POST['cod_mon'])){
      $mone = $_POST['cod_mon'];
      $_SESSION['mone'] = $mone;
  } 
   if (isset($_POST['cod_bco'])){	 
	   $cta_bco = $_POST['cod_bco'];
       $_SESSION['cta_bco'] =$cta_bco;
	}	
 $consulta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_CTA_CTE = '$cta_bco' and
	                  GRAL_CTA_BAN_USR_BAJA is null ";
        $resultado = mysql_query($consulta);
	    while ($linea = mysql_fetch_array($resultado)) {
	           $cta_banco = $linea['GRAL_CTA_BAN_CTBL'];
		       $_SESSION['cod_bco'] =  $linea['GRAL_CTA_BAN_CTA_CTE']; 
	           $_SESSION['cta_bco'] =  $linea['GRAL_CTA_BAN_CTA_CTE']; 
	           $_SESSION['nom_cta'] =  $linea['GRAL_CTA_BAN_DESC']; 
		}	 
?> 
<font size="+1"  style="" >
<?php
    echo encadenar(35)."LISTADO DE CHEQUES UTILIZADOS ".encadenar(2).$_SESSION['nom_cta'];
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(55)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="900">
	
	<tr>
	    <th align="center"><font size="-1">FECHA TRANSAC.</font></th>
	    <th align="center"><font size="-1">USUARIO</th> 
		<th align="center"><font size="-1">CHEQUERA </th>
	    <th align="center"><font size="-1">NRO. CHEQUE</th> 
		<th align="center"><font size="-1">NRO. TRANS.BANCO</th> 
		<th align="center"><font size="-1">DESCRIPCION</th>
		<th align="center"><font size="-1">MONTO</th>
	</tr>		

<?php 
  
   	$t_cap = 0;
	$t_int = 0;
	$t_ifa = 0;
	$t_iven = 0;
	$t_aho = 0; 
	$t_otro = 0;
	$t_pen = 0;
	$t_ifa = 0;
	$t_tot  = 0;	
	$nro_rec  = 0;				
    $nro_tran = 0;


		$con_reci = "Select * From contab_cheques where CONTA_CHEQ_CTA = '$cta_bco' AND
		             CONTA_CHEQ_FECHA >= '$f_des2' and CONTA_CHEQ_FECHA  <='$f_has2'
		             and CONTA_CHEQ_USR_BAJA is null order by CONTA_CHEQ_NRO";
            $res_reci = mysql_query($con_reci);
	                    while ($lin_reci = mysql_fetch_array($res_reci)) {
						      $nro_tran = $lin_reci['CONTA_CHEQ_DOC'];
	                          $nro_rec =  $lin_reci['CONTA_CHEQ_NRO'];
	                    	  $nro_talon = $lin_reci['CONTA_CHEQ_TALON'];
                              $fec_rec = $lin_reci['CONTA_CHEQ_FECHA'];
							  
 
//echo $nro_rec,$nro_tran;

/*	
				
		*/		
				
			//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
			$p_imp = 0;
						
			$con_tra = "Select * From caja_deposito where
	            (CAJA_DEP_FECHA between '$f_des2' and '$f_has2') and 
				 CAJA_DEP_NRO = $nro_tran
	             and substr(CAJA_DEP_CTA_CTB,1,3) = '111' 
				 and CAJA_DEP_CTA_BCO = '$cta_bco'
				 and CAJA_DEP_USR_BAJA is null";
            $res_tra = mysql_query($con_tra) ;
			while ($lin_tra = mysql_fetch_array($res_tra)) { // 2 a
			      $p_imp = $lin_tra['CAJA_DEP_IMPO'];
				  $caje = substr($lin_tra['CAJA_DEP_USR_ALTA'],0,8);
		          $desc = $lin_tra['CAJA_DEP_QUIEN'];
				
			$t_tot = $t_tot + $p_imp;
			$f_pag = cambiaf_a_normal($fec_rec);		
		?>
	<tr>
	    <td align="center" ><?php echo $f_pag; ?></td>
	    <td align="left" style="font-size:10px"><?php echo $caje; ?></td>	
		<td align="right" ><?php echo number_format($nro_talon, 0, '.',''); ?></td>
	    <td align="right" ><?php echo number_format($nro_rec, 0, '.',''); ?></td>
		 <td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="left" style="font-size:10px" ><?php echo $desc; ?></td>	
		<td align="right" ><?php echo number_format($p_imp, 2, '.',','); ?></td>
		
		
		
	</tr>	
	
	<?php					 
	 } // 1b
	}
			
	?>
	<tr>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>	
		<th align="right" ><?php echo number_format($t_tot, 2, '.',','); ?></th>
		
	</tr>	
	
	
	
	</table>		
<?php	
 	include("footer_in.php");
 ?>

</div>
</body>
</html>



<?php
ob_end_flush();
 ?>

