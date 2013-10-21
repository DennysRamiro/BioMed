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

<script type="text/javascript" src="js/Utilitarios.js"></script> 

</head>
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
<center>


<br><br>
<?php
$f_des = "";
$f_has = "";
$mone = " ";
if(isset($_POST['fec_nac'])){
      $f_des = $_POST['fec_nac'];
	  $mes = substr($f_des,3,2);
	  $anio = substr($f_des,6,4);
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
	  
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
	
	$arch = "D:/xampp/htdocs/trebol/ArchivoTXT/"."bancompras_".$mes.$anio."_".$emp_nit.".txt";
	
?> 
	<br>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="center">
       <a href="javascript:print();">Imprimir</a>
	    <a href='tipo_rep_3.php?menu=6'>Salir</a>
		<!--a href="javascript:cerrar();">Salir</a-->
	
  </div>


  <br><br>

<?php 
	echo  "Archivo Generado con el nombre de:".encadenar(2).$arch;
	
	
	?>
	</center>
	<?php
    $fp = fopen($arch,"a");
   	$monto = 0;
	$t_monto = 0;
	$t_neto = 0;
	$t_debito = 0; 
	
	if ($_SESSION["tip_rep"] == 43) {				
	$con_tpa = "Select * From fac_bancari where month(FAC_BAN_FECHA) = '$mes' and year(FAC_BAN_FECHA) = '$anio' and FAC_BAN_TIPO = 1
	            order by FAC_BAN_FECHA,FAC_BAN_NRO";
	}
	if ($_SESSION["tip_rep"] == 24) {				
	$con_tpa = "Select * From factura where FACTURA_FECHA between '$f_des2' and '$f_has2'
	            order by FACTURA_FECHA,FACTURA_NUMERICO ";
	}			
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $fec_pag = $lin_tpa['FAC_BAN_FECHA'];
			$nit = $lin_tpa['FAC_BAN_NIT'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nombre = $lin_tpa['FAC_BAN_NOMBRE'];
			$factura = $lin_tpa['FAC_BAN_NUMERICO'];
			$cod_ctrl = "";
			$monto = $lin_tpa['FAC_BAN_MONTO'];
			$orden = $lin_tpa['FAC_BAN_AUTORIZA'];
			$nom_grp = "";
			$t_monto = $t_monto + $monto;
			$t_debito = $t_debito + round(($monto * 0.13),2);
	$linea = $nit."|".$nombre."|".$factura."|".$orden."|".$f_pag."|".$monto."|0.00|0.00|".$monto."|".chr(13).chr(10);
	fwrite($fp, "$linea");
//	fwrite($handle , chr(13).chr(10));

	//echo $linea;
		?>

	<br>
		
	
	<?php					 
				    	
		
	//$nro = $nro + 1;
	             
	 
				 
			//}	 
				 
	           } // 1b
		
	fclose($fp); 		   			
	?>
	
	<?php
  } //else
ob_end_flush();
 ?>	
<?php	
 //	include("footer_in.php");
?>

</div>
</body>
</html>





