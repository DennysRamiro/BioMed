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
	    <a href='rep_param_cja.php?menu=6'>Salir</a>
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
?> <center>
<font size="+1"  style="" >
<?php
if ($mone == 1){
    echo encadenar(0)."LISTADO DE MOVIMIENTOS VALES EN  ".encadenar(2). "BOLIVIANOS";
  }
 if ($mone == 2){
    echo encadenar(0)."LISTADO DE MOVIMIENTOS VALES EN ".encadenar(2). "DOLARES";
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
		<th align="center"><font size="-1">FUNCIONARIO</th>
		<th align="center"><font size="-1">IMPORTE</th>
		<th align="center"><font size="-1">DESCRIPCION</th>
		<th align="center"><font size="-3">CAJERO</th>
	</tr>		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
  // 	$t_cap = 0;
//	$t_int = 0;
//	$t_iven = 0;
//	$t_aho = 0; 
//	$t_otro = 0;
//	$t_pen = 0;
//	$t_com = 0;
	$t_impo  = 0;				
	$con_tpa = "Select * From caja_vale where
	            (CAJA_VAL_FECHA between '$f_des2' and '$f_has2') and 
	             CAJA_VAL_MON = $mone 
				 and CAJA_VAL_USR_BAJA is null
				 ORDER BY  CAJA_VAL_FECHA";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $fec_pag = $lin_tpa['CAJA_VAL_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CAJA_VAL_NRO'];
			$func = $lin_tpa['CAJA_VAL_FUNC'];
			$mon = $lin_tpa['CAJA_VAL_MON'];
			$impo = $lin_tpa['CAJA_VAL_IMPO'];
			$desc =  $lin_tpa['CAJA_VAL_DESCRIP'];
			$caje = $lin_tpa['CAJA_VAL_USR_ALTA'];
		//	echo $cod_cre;
	//Consulta Cart_maestro
	       // if ($impo2 < 0){
		    $t_impo = $t_impo + $impo;
		//	}
	    //    if ($impo < 0){
		//	    $impo = $impo * -1;
	//		}
			
	//		if ($mon == 2){
	//		    $impo = $impo2;
	//		}
			
			
			
//			if ($tip == 1){
//			    $tip_dr = "D";
//			}
//			if ($tip == 2){
//			    $tip_dr = "R";
//			}
			$con_car  = "Select * From gral_usuario
            where GRAL_USR_LOGIN = '$func' and GRAL_USR_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        
                    $nom_f = $lin_car['GRAL_USR_NOMBRES'].encadenar(1).
					         $lin_car['GRAL_USR_AP_PATERNO'].encadenar(1).
							  $lin_car['GRAL_USR_AP_MATERNO'];  
			}	
			
		//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
			
		    $p_tot  = 0;
			
			
			$t_tot = $t_tot + $p_tot;
		?>
	
		
	<tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
	    <td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="left" ><?php echo $nom_f; ?></td>	
		<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
	 	<td align="left" style="font-size:10px" ><?php echo $desc; ?></td>
		<td align="left" style="font-size:10px" ><?php echo $caje; ?></td>
		
	</tr>	
	
	<?php					 
				    	
		
	//$nro = $nro + 1;
	             
	 
				 
			//}	 
				 
	           } // 1b
		
			   			
	?>
	<tr>
	    <th align="center" ><?php echo "Total"; ?></td>	
	    <th align="left" ><?php echo encadenar(2); ?></td>
	    <td align="right" ><?php echo encadenar(2); ?></td>
		<td align="right" ><?php echo number_format($t_impo, 2, '.',','); ?></td>
	 	<td align="left" style="font-size:10px" ><?php echo encadenar(2); ?></td>
		<th align="left" style="font-size:10px" ><?php echo encadenar(2); ?></td>
		
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

