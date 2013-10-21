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
	    <a href='rep_param_cja.php?menu=7'>Salir</a>
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
  if(isset($_POST['tipo_tr'])){
      $t_tr = $_POST['tipo_tr'];
      $_SESSION['t_tr'] = $t_tr;
  }  
?> 
<font size="+1"  style="" >
<?php
//if ($t_tr == 1){
    echo encadenar(55)."LISTADO DE MOVIMIENTOS COMPRA / VENTA DE DIVISAS";
 // }
 //if ($t_tr == 2){
  //  echo encadenar(60)."LISTADO DE MOVIMIENTOS VENTA DE DIVISAS";
  //} 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(70)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="800">
	<tr>
	    <th align="center"><font size="-1">FECHA </th>
		<th align="center"><font size="-1">NRO. COMP.</th> 
		<th align="center"><font size="-1">DESCRIPCION</th> 
		<th align="center"><font size="-1">T.C. CONTAB</th>
		<th ></th>
		<th ></th> 
		<th align="center"><font size="-1">COMPRA</th> 
	   	<th ></th>  
		<th ></th>
		<th ></th>  
		<th align="center"><font size="-1">VENTA</th> 
		<th ></th> 
		<th ></th> 
		<th ></th> 
	</tr>
	<tr>
	    <th ></th>
		<th ></th>  
		<th ></th> 
		<th ></th>
		
		<th align="center"><font size="-1">T.C.</th>
		<th align="center"><font size="-1">US$ RECIBIDOS</th> 
		<th align="center"><font size="-1">Bs. ENTREGADOS</th>
	   	<th align="center"><font size="-1">DIF. COMPRA</th>
		<th align="center"><font size="-1">T.C.</th>
		<th align="center"><font size="-1">US$ ENTREGADOS</th>
		<th align="center"><font size="-1">Bs. RECIBIDOS</th> 
		<th align="center"><font size="-1">DIF. VENTA</th>
		<th align="center"><font size="-3">CAJERO</th>
	</tr>		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$t_cap = 0;
	$t_int = 0;
	$t_iven = 0;
	$t_aho = 0; 
	$t_otro = 0;
	$t_pen = 0;
	$t_com = 0;
	$t_tot11  = 0;	
	$t_tot12  = 0;	
	$t_tot21  = 0;	
	$t_tot22  = 0;
	$t_tot2  = 0;
	$t_per1  = 0;	
	$t_per2  = 0;			
	$con_tpa = "Select * From caja_com_ven where
	            (caja_comven_fecha between '$f_des2' and '$f_has2') and 
	             (substr(caja_comven_cta,9,1) = 2 and substr(caja_comven_cta,1,1) = 1)
				 and caja_comven_usr_baja is null
				 ORDER BY  caja_comven_tipo,caja_comven_fecha,caja_comven_corr ";
    $res_tpa = mysql_query($con_tpa);
	$per_gan = 0;
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $impo11 = 0;
			$impo21 = 0;
			$impo12 = 0;
			$impo22 = 0;
			$per_gan1= 0;
			$per_gan2= 0;
		    $fec_pag = $lin_tpa['caja_comven_fecha'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$tipo = $lin_tpa['caja_comven_tipo'];
			$nro_tran = $lin_tpa['caja_comven_corr'];
			$impo = $lin_tpa['caja_comven_impo_e'];
			$impo2 = $lin_tpa['caja_comven_impo'];
			$desc =  $lin_tpa['caja_comven_descrip'];
			$tc = $lin_tpa['caja_comven_tc'];
			$caje = $lin_tpa['caja_comven_usr_alta'];
			$p_g = substr($lin_tpa['caja_comven_cta'],0,1);
		//	echo $cod_cre;
	//Consulta Cart_maestro
	  			
		//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
			
		 //   $p_tot  = 0;
			
			
		//	$t_tot = $t_tot + $impo;
			$t_tot2 = round($impo * $tc,2);
			$t_tot3 = round($impo * $_SESSION['TC_CONTAB'],2);
			$per_gan = round(($t_tot2 - $t_tot3),2);
		if ($tipo == 1){
		    $impo11 = $impo;
			$impo21 = $t_tot2;
			$per_gan1 = $per_gan;
			$per_gan1 = $per_gan1 * -1;
			$t_tot11 = $t_tot11 + $impo11;
			$t_tot21 = $t_tot21 + $impo21;
			$t_per1 = $t_per1 + $per_gan1;
			$tip_d = "Compra";
			
			$impo12 = 0;
			$impo22 = 0;
			$per_gan2 = 0;
			
		    }	
		if ($tipo == 2){
		    $tip_d = "Venta";
			$impo12 = $impo;
			$impo22 = $t_tot2;
			$per_gan2 = $per_gan;
		   $t_tot12 = $t_tot12 + $impo12;
			$t_tot22 = $t_tot22 + $impo22;
			$t_per2 = $t_per2 + $per_gan2;
			$impo11 = 0;
			$impo21 = 0;
			$per_gan1 = 0;
		//    $tip_d = "Compra";
		//	$per_gan2 = 0;
			} 
			   
		if($p_g == 1){    			
		?>
	
		
	<tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
		 <td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		 <td align="left" style="font-size:10px" ><?php echo $desc; ?></td>
		 <td align="right" ><?php echo number_format($_SESSION['TC_CONTAB'], 2, '.',','); ?></td> 
	    <td align="right" ><?php echo number_format($tc, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($impo11, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($impo21, 2, '.',','); ?></td>
	 	<td align="right"  ><?php echo number_format($per_gan1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tc, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($impo12, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($impo22, 2, '.',','); ?></td>
	 	<td align="right"  ><?php echo number_format($per_gan2, 2, '.',','); ?></td>
		<td align="left" style="font-size:10px" ><?php echo $caje; ?></td>
		
	</tr>	
	
	<?php	}
	 	           } 
	?>
		<tr>
	    <th align="left" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo encadenar(2); ?></td>
		<th align="left" style="font-size:10px" ><?php echo "TOTAL"; ?></td>
	    <th align="right" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo number_format($t_tot11, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_tot21, 2, '.',','); ?></td>
	 	<th align="right"  ><?php echo number_format($t_per1, 2, '.',','); ?></td>
		<th align="right" ><?php echo encadenar(2); ?></td>
		<th align="right" ><?php echo number_format($t_tot12, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($t_tot22, 2, '.',','); ?></td>
	 	<th align="right"  ><?php echo number_format($t_per2, 2, '.',','); ?></td>
		<th align="left" style="font-size:10px" ><?php echo encadenar(2); ?></td>
		</tr>
	</table>
	<br>
	<table border="1" width="800">	   			
	    <tr>
	   	<th align="center" style="font-size:10px" ><?php echo "DIFERENCIA COMPRA"; ?></td>
	   	<th align="right"  ><?php echo number_format($t_per1, 2, '.',','); ?></td>
		<th align="center" style="font-size:10px" ><?php echo "DIFERENCIA VENTA"; ?></td>
		<th align="right"  ><?php echo number_format($t_per2, 2, '.',','); ?></td>
		<th align="center" style="font-size:10px" ><?php echo "GANANCIA/PERDIDA"; ?></td>
		<th align="right"  ><?php echo number_format($t_per2 - ($t_per1 * -1)  , 2, '.',','); ?></td>
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

