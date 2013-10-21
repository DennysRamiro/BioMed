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
// $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
        <?php
                      if($_GET["menu"]==1){?> 
	    <a href='rep_param_cja.php?menu=3'>Salir</a>

	    <?php }elseif ($_GET["menu"]==2) { ?>

	    <a href='rep_param_cja.php?menu=4'>Salir</a>

	    <?php } ?>
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
 if(isset($_POST['cod_cta'])){
      $cod_cta = $_POST['cod_cta'];
      $_SESSION['cod_cta'] = $cod_cta;
	  $mone = substr($cod_cta,5,1);
 } 
?> <center>
<font size="+1"  style="" >
<?php
if ($mone == 1){
    echo encadenar(0)."LISTADO DE MOVIMIENTOS INGRESOS/EGRESOS EN ".encadenar(2). "BOLIVIANOS";
 }
if ($mone == 2){
   echo encadenar(0)."LISTADO DE MOVIMIENTOS INGRESOS/EGRESOS EN ".encadenar(2). "DOLARES";
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
	 <table border="1" width="900">
	
<?php	if ($mone == 1){ ?>
	
	<tr>
	    <th align="center"<font size="-1"> FECHA TRANSAC.</th> 
		<th align="center" <font size="-1">A/M</th> 
		<th align="center" <font size="-1">TIPO</th> 
	   	<th align="center" <font size="-1">NRO. TRAN.</th>  
	   	<th align="center" <font size="-1">CTA CONTABLE</th> 
		<th align="center" <font size="-1">DESCRIPCION CTBLE</th>
		<th align="center" <font size="-1">DETALLES</th>
		<th align="center" <font size="-1">INGRESOS Bs.</th>     
		<th align="center" <font size="-1">EGRESOS Bs.</th>
		<th align="center"><font size="-3">CAJERO</th>
				
    </tr>		
<?php	} ?>
<?php	if ($mone == 2){ ?>
	
	<tr>
	   <th align="center"<font size="-1"> FECHA TRANSAC.</th> 
		<th align="center" <font size="-1">A/M</th> 
		<th align="center" <font size="-1">TIPO</th> 
	   	<th align="center" <font size="-1">NRO. TRAN.</th>  
	   	<th align="center" <font size="-1">CTA CONTABLE</th> 
		<th align="center" <font size="-1">DESCRIPCION CTBLE</th>
		<th align="center" <font size="-1"> DETALLES</th>
		<th align="center" <font size="-1">INGRESOS $us.</th>     
		<th align="center" <font size="-1">EGRESOS $us.</th>
		<th align="center"><font size="-3">CAJERO</th>
		
    </tr>		
<?php	} ?>
<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$t_ing1 = 0;
	$t_egr1 = 0;
	$t_ing2 = 0;
	$t_egr2 = 0;
	if (isset($_SESSION["tipo_rep"])){
	   if ($_SESSION["tipo_rep"] == 5){		
	 $con_tpa = "Select * From caja_ing_egre where
	            (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	             substr(caja_ingegr_cta,1,3)='111' and
				 substr(caja_ingegr_cta,6,1) = '$mone' and
				 caja_ingegr_usr_baja is null 
				 order by caja_ingegr_fecha,caja_ingegr_tipo,caja_ingegr_corr ";
		}
		if ($_SESSION["tipo_rep"] == 17){
		
		
				
	 $con_tpa = "Select * From caja_ing_egre where
	            (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	             caja_ingegr_cta = '$cod_cta' and
				  caja_ingegr_usr_baja is null 
				 order by caja_ingegr_fecha,caja_ingegr_tipo,caja_ingegr_corr ";
		}		 
	}			 
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $p_ing1 = 0;
			$p_egr1 = 0;
		    $p_ing2 = 0;
			$p_egr2 = 0;
			$p_eqvi = 0;
			$t_tran = "";
			$t_tran2 = "";
		    $tip_tran = $lin_tpa['caja_ingegr_tipo'];
			$tipo2 = $lin_tpa['caja_ingegr_tipo2'];
		    $fec_pag = $lin_tpa['caja_ingegr_fecha'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['caja_ingegr_corr'];
			$cta_ctble = $lin_tpa['caja_ingegr_cta'];
			$mon_t = substr($cta_ctble,5,1);
			$impo = $lin_tpa['caja_ingegr_impo'];
			$impo_e = $lin_tpa['caja_ingegr_impo_e'];
			$detalle = $lin_tpa['caja_ingegr_descrip'];
			$deb_hab = $lin_tpa['caja_ingegr_debhab'];
			$aut_man = $lin_tpa['caja_ingegr_contab'];
			$caje = $lin_tpa['caja_ingegr_usr_alta'];
			
			if ($_SESSION["tipo_rep"] == 17){
						  $con_efe = "Select * From caja_ing_egre where
	            (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	             substr(caja_ingegr_cta,1,3)='111' and
				 caja_ingegr_corr = $nro_tran and
				 caja_ingegr_usr_baja is null 
				 order by caja_ingegr_fecha,caja_ingegr_tipo,caja_ingegr_corr ";
			$res_efe = mysql_query($con_efe);
			     while ($lin_efe = mysql_fetch_array($res_efe)) {
			   		    $impo_efe = $lin_efe['caja_ingegr_impo'];
						$impo = $lin_efe['caja_ingegr_impo'];
			            $impo_e = $lin_efe['caja_ingegr_impo_e'];
						
			   }  
			}
			 if ($tipo2 == 0){ 
			      $t_tran2 = 'N'; 
			    }
			   if ($tipo2 == 2){ 
			      $t_tran2 = 'F';
			    }
			   if ($tipo2 == 3){ 
			      $t_tran2 = 'E';
			    }
			   if ($tipo2 == 4){ 
			      $t_tran2 = 'S'; 
			    }
			  if ($tipo2 == 5){ 
			      $t_tran2 = 'B';
			    }
			
		 if ($impo == $impo_e){
		    $mon_t = 1;
			if ($tip_tran == 1){
		if (isset($_SESSION["tipo_rep"])){
	        if ($_SESSION["tipo_rep"] == 5){	
			    $con_tpa1 = "Select * From caja_ing_egre where
	                        (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	                         substr(caja_ingegr_cta,1,3)<>'111' and
				             caja_ingegr_corr = $nro_tran and
							 caja_ingegr_tipo = $tip_tran and
				             caja_ingegr_usr_baja is null 
				             order by caja_ingegr_impo DESC LIMIT 0,1 ";
			}
			if ($_SESSION["tipo_rep"] == 17){
			     $con_tpa1 = "Select * From caja_ing_egre where
	                        (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	                         caja_ingegr_cta = '$cta_ctble' and 
				             caja_ingegr_corr = $nro_tran and
							 caja_ingegr_tipo = $tip_tran and
				             caja_ingegr_usr_baja is null 
				             order by caja_ingegr_impo DESC LIMIT 0,1 ";
			}
		}					 	
							 
               $res_tpa1 = mysql_query($con_tpa1);
			     while ($lin_tpa1 = mysql_fetch_array($res_tpa1)) {
			   		    $cta_ctble = $lin_tpa1['caja_ingegr_cta'];
			   }
			
				$t_tran = "I";
				$p_ing1 =  $impo;
				$p_ing2 =  0;
				$t_ing1 =  $t_ing1 + $p_ing1;
				}else{
		if (isset($_SESSION["tipo_rep"])){
	        if ($_SESSION["tipo_rep"] == 5){			
				 $con_tpa2 = "Select * From caja_ing_egre where
	                        (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	                          substr(caja_ingegr_cta,1,3)<>'111' and
				             caja_ingegr_corr = $nro_tran and
							 caja_ingegr_tipo = $tip_tran and
				             caja_ingegr_usr_baja is null 
				             order by caja_ingegr_impo DESC LIMIT 0,1 ";
			}
		 if ($_SESSION["tipo_rep"] == 17){			
				 $con_tpa2 = "Select * From caja_ing_egre where
	                        (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	                          caja_ingegr_cta = '$cta_ctble' and 
				             caja_ingegr_corr = $nro_tran and
							 caja_ingegr_tipo = $tip_tran and
				             caja_ingegr_usr_baja is null 
				             order by caja_ingegr_impo DESC LIMIT 0,1 ";
			}
		}		
							 
               $res_tpa2 = mysql_query($con_tpa2);
			     while ($lin_tpa2 = mysql_fetch_array($res_tpa2)) {
			   		    $cta_ctble = $lin_tpa2['caja_ingegr_cta'];
			   }
				$t_tran = "E";
				$p_egr1 =  $impo * -1;
				$p_egr2 =  0;
				$t_egr1 =  $t_egr1 + $p_egr1;
			}
		}	
			if ($impo <> $impo_e){
			  $mon_t = 2;
			  if ($tip_tran == 1){
			 if (isset($_SESSION["tipo_rep"])){
	        if ($_SESSION["tipo_rep"] == 5){	 
			    $con_tpa1 = "Select * From caja_ing_egre where
	                        (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	                         substr(caja_ingegr_cta,1,3)<>'111' and
				             caja_ingegr_corr = $nro_tran and
							 caja_ingegr_tipo = $tip_tran and
				             caja_ingegr_usr_baja is null 
				             order by caja_ingegr_impo DESC LIMIT 0,1 ";
				}		
			   if ($_SESSION["tipo_rep"] == 17){	 
			    $con_tpa1 = "Select * From caja_ing_egre where
	                        (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	                          caja_ingegr_cta = '$cta_ctble' and 
				             caja_ingegr_corr = $nro_tran and
							 caja_ingegr_tipo = $tip_tran and
				             caja_ingegr_usr_baja is null 
				             order by caja_ingegr_impo DESC LIMIT 0,1 ";
				}	
			}				 
               $res_tpa1 = mysql_query($con_tpa1);
			     while ($lin_tpa1 = mysql_fetch_array($res_tpa1)) {
			   		    $cta_ctble = $lin_tpa1['caja_ingegr_cta'];
			   }
			
				$t_tran = "I";
				$p_ing1 =  $impo;
				$p_ing2 =  0;
				$t_ing1 =  $t_ing1 + $p_ing1;
				}else{
			 if (isset($_SESSION["tipo_rep"])){
	        if ($_SESSION["tipo_rep"] == 5){		
				 $con_tpa2 = "Select * From caja_ing_egre where
	                        (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	                          substr(caja_ingegr_cta,1,3)<>'111' and
				             caja_ingegr_corr = $nro_tran and
							 caja_ingegr_tipo = $tip_tran and
				             caja_ingegr_usr_baja is null 
				             order by caja_ingegr_impo DESC LIMIT 0,1 ";
						}	
				 if ($_SESSION["tipo_rep"] == 17){		
				 $con_tpa2 = "Select * From caja_ing_egre where
	                        (caja_ingegr_fecha between '$f_des2' and '$f_has2') and 
	                          caja_ingegr_cta = '$cta_ctble' and 
				             caja_ingegr_corr = $nro_tran and
							 caja_ingegr_tipo = $tip_tran and
				             caja_ingegr_usr_baja is null 
				             order by caja_ingegr_impo DESC LIMIT 0,1 ";
						}	
				}				 
               $res_tpa2 = mysql_query($con_tpa2);
			     while ($lin_tpa2 = mysql_fetch_array($res_tpa2)) {
			   		    $cta_ctble = $lin_tpa2['caja_ingegr_cta'];
			   }
 
			   
			 }  

			  if ($tip_tran == 1){
			     $t_tran = "I";
			   	 $p_ing2 = $impo_e ;
				 $p_ing1 = 0;
				 $t_ing2 =  $t_ing2 + $p_ing2;
				}else{
				 $t_tran = "E";
				 $p_egr2 = $impo_e * -1 ;
				 $p_egr1 = 0;
				 $t_egr2 =  $t_egr2 + $p_egr2;
				 $p_egr1 = $p_egr1 * -1;
				}
			}	
			 if ($aut_man == 1){
			     $man_aut = "A";
			    }else{
			     $man_aut = "M";
			 }
		//	echo $cod_cre;
	//Consulta Cart_maestro
			
			$con_ctble  = "Select * From contab_cuenta
             where CONTA_CTA_NRO = '$cta_ctble' "; 
             $res_ctble = mysql_query($con_ctble);
 
             while ($lin_ctble = mysql_fetch_array($res_ctble)) {
			        $des_cta = $lin_ctble['CONTA_CTA_DESC'];
				}	
			
		?>
		<?php	if ($mone == 1){ ?>
		<tr>
		 <td align="left" ><?php echo $f_pag; ?></td>
		 <td align="center" ><?php echo $man_aut; ?></td>
		 <td align="center" ><?php echo $t_tran2; ?></td>
	     <td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		 <td align="center" ><?php echo $cta_ctble; ?></td>	
		 <td align="left" ><?php echo $des_cta; ?></td>	
		<td align="left" ><?php echo $detalle; ?></td>
		<td align="right" ><?php echo number_format($p_ing1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_egr1, 2, '.',','); ?></td>
		<td align="left" ><?php echo $caje; ?></td>
	 		
	</tr>
		<?php	} ?>
<?php	if ($mone == 2){ ?>
     <tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
	   	<td align="center" ><?php echo $man_aut; ?></td>
		<td align="center" ><?php echo $t_tran2; ?></td>
	   	<td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="center" ><?php echo $cta_ctble; ?></td>	
		<td align="left" ><?php echo $des_cta; ?></td>	
		<td align="left" ><?php echo $detalle; ?></td>
		<td align="right" ><?php echo number_format($p_ing2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_egr2, 2, '.',','); ?></td>
		<td align="left" ><?php echo $caje; ?></td>
		
	</tr>
		<?php	} ?>
	<?php   } 	?>
	
	<?php	if ($mone == 1){ ?>
	
	<tr>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>	
		<th align="left" ><?php echo encadenar(5); ?></th>	
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="right" ><?php echo number_format($t_ing1, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_egr1, 2, '.',','); ?></th>
	 	
		
	</tr>
	<?php	} ?>
<?php	if ($mone == 2){ ?>
<tr>
	    <th align="center" ><?php echo "Total"; ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>	
		<th align="left" ><?php echo encadenar(5); ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="right" ><?php echo number_format($t_ing2, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_egr2, 2, '.',','); ?></th>
		
	</tr>
	<?php	} ?>
	
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

