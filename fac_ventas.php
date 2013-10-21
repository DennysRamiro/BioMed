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
include('header_2.php');
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
<?php if($_GET["menu"]==1){?>
	   <a href='tipo_rep_3.php?menu=8'>Salir</a>
 <?php } elseif($_GET["menu"]==2){?>
 	   <a href='con_factura.php?menu=1'>Salir</a>
<?php } ?>

  </div>

<br><br>
<?php
$f_des = "";
$f_has = "";
$mone = " ";
//echo $_SESSION["tip_rep"];
if(isset($_POST['fec_nac'])){
      $f_des = $_POST['fec_nac'];
	  $mes = substr($f_des,3,2);
	  $anio = substr($f_des,6,4);
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
	//  echo $mes."---".$anio;
	  
  }
  if(isset($_POST['fec_des'])){
      $f_des = $_POST['fec_des'];
	  $mes = substr($f_des,3,2);
	  $anio = substr($f_des,6,4);
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
	  
  }
   if(isset($_POST['fec_has'])){
      $f_has = $_POST['fec_has'];
	  $mes = substr($f_has,3,2);
	  $anio = substr($f_has,6,4);
      $_SESSION['f_has'] = $f_has;
	  $f_has2 = cambiaf_a_mysql($f_has);
	  
  }
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
				$emp_nit = $lin_emp['GRAL_EMP_NIT'];
				$emp_fon = $lin_emp['GRAL_EMP_DIRECTOR'];
				$_SESSION['emp_nom'] = $emp_nom;
				$_SESSION['emp_dir'] = $emp_dir;
				$_SESSION['emp_fon'] = $emp_fon;
				$_SESSION['emp_nit'] = $emp_nit;
				
		  }
		  $consulta  = "SELECT * FROM factura_cntrl  
                 ORDER BY FAC_CTRL_AGEN 
		   	     DESC LIMIT 0,1";
	//$nombre = $_SESSION['nom_cli'];			 
    $resultado = mysql_query($consulta);
    $linea = mysql_fetch_array($resultado);
    $orden = $linea['FAC_CTRL_ORDEN'];
    $llave = trim($linea['FAC_CTRL_LLAVE']);
?> 
<font size="+1"  style="" >
<?php
	if ($_SESSION["tip_rep"] == 23) {	
    echo encadenar(4)."LIBRO DE VENTAS IVA".encadenar(10). "PERIODO FISCAL "
	.encadenar(2).$mes."/".$anio;
	}
	if ($_SESSION["tip_rep"] == 24) {	
    echo encadenar(4)."LIBRO DE VENTAS IVA DE ".encadenar(2).$f_des  ."AL "
	.encadenar(2).$f_has;
	}
?>
<br>
<?php
    echo encadenar(4)."Facturas";
?>


 <table border="0" width="900">
	
	<tr>
	    <th align="left"><font size="-1"><?php echo encadenar(5); ?></th> 
	    <td align="left"><font size="-1">NOMBRE O RAZON SOCIAL:</th> 
	    <th align="left"><font size="-1"><?php echo $_SESSION['emp_nom']; ?></th> 
		 <th align="left"><font size="-1"><?php echo encadenar(120); ?></th> 
	   	<td align="left"><font size="-1">NIT:</th>  
	   	<th align="left"><font size="-1"><?php echo $_SESSION['emp_nit']; ?></th> 
    </tr>	
	<tr>
	     <th align="left"><font size="-1"><?php echo encadenar(5); ?></th> 
	    <td align="left"><font size="-1">N&deg; SUCURSAL:</th> 
	    <th align="left"><font size="-1"> 0   CENTRAL</th> 
		 <th align="left"><font size="-1"><?php echo encadenar(120); ?></th> 
	   	<td align="left"><font size="-1">DIRECCION:</th>  
	   	<th align="left"><font size="-1"><?php echo $_SESSION['emp_dir']; ?></th> 
    </tr>
	
</table>		
	





</font>
<br>
<font size="+1"  style="" >
<?php
//echo encadenar(70)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>


<font size="0"  style="" >
	 <table border="0" width="1000">
	
	<tr>
	    <th align="center"><font size="-1"> </th>
	    <th align="center"><font size="-1" style="border-top:medium">FECHA </th> 
	    <th align="center"><font size="-1">N&deg; DE NIT/CI</th> 
	   	<th align="center"><font size="-1">NOMBRE O RAZON SOCIAL</th>  
	   	<th align="center"><font size="-1">N&deg; DE</th> 
		<th align="center"><font size="-1">N&deg; DE</th>
		<th align="center"><font size="-1"> </th>
		<th align="center"><font size="-1">CODIGO DE</th>
		<th align="center"><font size="-1">TOTAL</th>
		<th align="center"><font size="-1">TOTAL</th>
		<th align="center"><font size="-1">IMPORTES</th>
		<th align="center"><font size="-1">IMPORTE</th>
		<th align="center"><font size="-1">DEBITO</th>
		
	</tr>		
    <tr>
	    <th align="center"><font size="-1"> </th>
	    <th align="center"><font size="-1">(D/M/A) </th> 
	    <th align="center"><font size="-1">COMPRADOR</th> 
	   	<th align="center"><font size="-1">DEL COMPRADOR</th>  
	   	<th align="center"><font size="-1">FACTURA</th> 
		<th align="center"><font size="-1">AUTORIZACION</th>
		<th align="center"><font size="-1"> </th>
		<th align="center"><font size="-1">CONTROL</th>
		<th align="center"><font size="-1">FACTURA</th>
		<th align="center"><font size="-1">I.C.E</th>
		<th align="center"><font size="-1">EXCENTOS</th>
		<th align="center"><font size="-1">NETO</th>
		<th align="center"><font size="-1">FISCAL IVA</th>
		
	</tr>
	 <tr>
	    <th align="center"><font size="-1"> </th>
	    <th align="center"><font size="-1"> </th> 
	    <th align="center"><font size="-1"></th> 
	   	<th align="center"><font size="-1"></th>  
	   	<th align="center"><font size="-1"></th> 
		<th align="center"><font size="-1"></th>
		<th align="center"><font size="-1"> </th>
		<th align="center"><font size="-1"></th>
		<th align="center"><font size="-1">(A)</th>
		<th align="center"><font size="-1">(B)</th>
		<th align="center"><font size="-1">(C)</th>
		<th align="center"><font size="-1">(A-B-C)</th>
		<th align="center"><font size="-1"></th>
		
	</tr>
<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$monto = 0;
	$t_monto = 0;
	$t_neto = 0;
	$t_debito = 0; 
	if ($_SESSION["tip_rep"] == 23) {				
	$con_tpa = "Select * From factura where month(FACTURA_FECHA) = '$mes' and year(FACTURA_FECHA) = '$anio' and FACTURA_TIPO = 2
	            order by FACTURA_FECHA,FACTURA_NRO ";
	}
	if ($_SESSION["tip_rep"] == 24) {				
	$con_tpa = "Select * From factura where FACTURA_FECHA between '$f_des2' and '$f_has2' and FACTURA_TIPO = 2
	            order by FACTURA_FECHA,FACTURA_NRO ";
	}			
    $res_tpa = mysql_query($con_tpa) ;
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $fec_pag = $lin_tpa['FACTURA_FECHA'];
			$nit = $lin_tpa['FACTURA_NIT'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nombre = $lin_tpa['FACTURA_NOMBRE'];
			$factura = $lin_tpa['FACTURA_NRO'];
			$cod_ctrl = $lin_tpa['FACTURA_COD_CTRL'];
			$monto = $lin_tpa['FACTURA_MONTO'];
			$orden = $lin_tpa['FACTURA_ORDEN'];
			$nom_grp = "";
			$t_monto = $t_monto + $monto;
			$t_debito = $t_debito + round(($monto * 0.13),2);
			
	//Consulta Cart_maestro
		/*	
		
			*/
		?>
	
		
	<tr>
	    <th align="left"><?php echo encadenar(5); ?></th> 
	    <td align="left" ><?php echo $f_pag; ?></td>
	    <td align="left" ><?php echo $nit; ?></td>
		<td align="left" ><?php echo $nombre; ?></td>
	   	<td align="left" ><?php echo number_format($factura, 0, '.',''); ?></td>
		<td align="left" ><?php echo $orden; ?></td>	
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left"  ><?php echo $cod_ctrl; ?></td>
		<td align="right" ><?php echo number_format($monto, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($monto, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(round($monto * 0.13,2), 2, '.',','); ?></td>
		
	</tr>	
	
	<?php					 
				    	
		
	//$nro = $nro + 1;
	             
	 
				 
			//}	 
				 
	           } // 1b
		
			   			
	?>
	<tr>
	     <th align="left"><?php echo encadenar(5); ?></th> 
	    <th align="left" ><?php echo encadenar(5); ?></th>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>	
		<th align="left" ><?php echo encadenar(5); ?></th>					
	    <th align="right" ><?php echo number_format($t_monto, 2, '.',','); ?></th>
	 	<th align="right" ><?php echo number_format(0, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format(0, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_monto, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_debito, 2, '.',','); ?></th>
	</tr>	
</table>
<br><br>
	
<?php	
 	include("footer_in.php");
?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

