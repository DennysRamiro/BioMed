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
	require('funciones2.php');
	require('d:\wamp\www\cc7\lib7\libreriaCC7.php');
//	$fec = leer_param_gral();
	$tc_ctb  = $_SESSION['TC_CONTAB'];	
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <a href="cart_fac_des.php">Factura</a>
	    <a href='menu_s.php'>Salir</a>
  </div>



<?php	
	
	//Datos empresa		  
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
		  
?>
<strong> 
<?php
if(isset($_SESSION['fec_proc'])){ 
  $fec_p = $_SESSION['fec_proc'];
  $fec1 = cambiaf_a_mysql_2($fec_p);
  }
if(isset($_SESSION['login'])){   
   $log_usr = $_SESSION['login']; 
   }
if(isset($_POST["impo"])){  
   $impo = $_POST["impo"];
}
//$log_usr = $_SESSION['login'];
	
	?>
	<?php
	 $mon_des = f_literal($impo,1);
	 echo encadenar(8).$mon_des.encadenar(2).$impo;
	 
	 


}
ob_end_flush();
 ?>
 
                      