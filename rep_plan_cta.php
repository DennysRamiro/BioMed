<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
    include('header_2.php');
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
	    <a href='con_mant_plan.php'>Salir</a>
  </div>

<br><br>
<?php
$f_des = "";
$f_has = "";
$mone = " ";
/*if(isset($_POST['fec_des'])){
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
  }*/  
?> <center>
<font size="+1"  style="" >
<?php
//if ($mone == 1){
    echo encadenar(0)."LISTADO DE PLAN DE CUENTAS ";
  //}
 //if ($mone == 2){
    //echo encadenar(45)."LISTADO DE DESEMBOLSOS DE CARTERA EN ".encadenar(2). "DOLARES";
  //} 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
//echo encadenar(70)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>

<br><br>
<font size="0"  style="" >
	 <table border="1" width="800">
	
	<tr>
	    <th align="center"><font size="-1">CUENTA </th> 
	    <th align="center"><font size="-1">DESCRIPCION</th> 
	   	<th align="center"><font size="-1">NIVEL</th>  
	   	<th align="center"><font size="-1">MONEDA</th> 
		<th align="center"><font size="-1">CTA.REV.</th>
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
	$t_tot  = 0;				
	$con_tpa = "Select *
	            From contab_cuenta ";
    $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_det_tran 1')  ;
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $cta = $lin_tpa['CONTA_CTA_NRO'];
			$des = $lin_tpa['CONTA_CTA_DESC'];
			$niv = $lin_tpa['CONTA_CTA_NIVEL'];
			$mon = $lin_tpa['CONTA_CTA_MONE'];
			$ctar = $lin_tpa['CONTA_CTA_AITB'];
	//Consulta Cart_maestro
			       
				
	//	}	
			
		//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
			$p_cap = 0;
			$p_int = 0;
		    $p_iven = 0;
		    $p_aho = 0; 
		    $p_otro = 0;
		    $p_pen = 0;
			$p_com = 0;
		    $p_tot  = 0;
			
			
		?>
	
		
	<tr>
	    <td align="left" ><?php echo $cta; ?></td>
	    <td align="left" ><?php echo $des; ?></td>
	   	<td align="center" ><?php echo $niv; ?></td>	
		<td align="center" ><?php echo $mon; ?></td>	
		<td align="left"  ><?php echo $ctar; ?></td>							
	    	
	</tr>	
	
	<?php					 
				    	
		
	//$nro = $nro + 1;
	             
	 
				 
			//}	 
				 
	           } // 1b
		
			   			
	?>
		
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

