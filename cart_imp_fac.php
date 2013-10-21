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
	//require('c:\wamp\www\cc7\lib7\libreriaCC7.php');
?>
<html>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <a href='modulo.php'>Salir</a>
 </div>
	<?php
		//		include("header.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc'];
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
	/*	 */ 
if ($_SESSION['EMPRESA_TIPO'] == 2){
//echo "aquiiii";
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






if ($_SESSION['pag_int'] + $_SESSION['pag_pen'] > 0){

    $cod_id = rtrim($_SESSION['ci_cli']);
					$nro_char = strlen($cod_id);
					$nitci= substr($cod_id,0,$nro_char-2);
					$ext_ci = substr($cod_id,$nro_char-2,2);

    $nitci= $_SESSION['nitci'];
    $consulta  = "SELECT * FROM factura_cntrl  
                 ORDER BY FAC_CTRL_AGEN 
		   	     DESC LIMIT 0,1";
	$nombre = $_SESSION['nom_cli'];			 
    $resultado = mysql_query($consulta);
    $linea = mysql_fetch_array($resultado);
//    $orden = $linea['FAC_CTRL_ORDEN'];
 //   $llave = trim($linea['FAC_CTRL_LLAVE']);//'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS';    //					 
  //  $fecha =  $fec1;
  //  $fecha_h =  $linea['FAC_CTRL_FEC_H'];
$monto =  round($_SESSION['pag_int'] + $_SESSION['pag_pen']+$_SESSION['penal'] ,2);
//echo $monto;
//$nfactura = leer_nro_corre_fac($orden);					
//$cc7m = genCodContrl($orden, $nfactura, $nitci, $fecha, $monto, $llave);	
?>
	<br><br><br>
	<table border="0" width="1200">
	<tr>
	    <td align="left"><?php echo encadenar(70); ?> </th> 
		<th align="left"  ><?php echo "NIT:".encadenar(2).$_SESSION['emp_nit'].encadenar(115).
		 "NIT:".encadenar(2).$_SESSION['emp_nit'].encadenar(12); ?></th>  
	    
			
    </tr>
	</table>
	<table border="0" width="1200">
	 <td align="left"><?php echo encadenar(55); ?> </th> 
		<th align="left"  ><?php echo "Factura Nro:".encadenar(2).$_SESSION['nfactura'].
		encadenar(120). "Factura Nro:".encadenar(2).$_SESSION['nfactura'].encadenar(12); ?></th>  
	   	
			
    </tr>	
	</table>
	<table border="0" width="1600">
	<tr>
	    <td align="left"><?php echo encadenar(40); ?> </th> 
		<th align="left" ><?php echo "Autorización Nro:".encadenar(1).$_SESSION['orden'].
		encadenar(80)."Autorización Nro:".encadenar(1).$_SESSION['orden'].encadenar(35); ?></th>  
	  	
    </tr>	
		
	</table>
    <table border="0" width="1200">
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	</table>	
	 
	   <table border="0" width="1000">
	<tr>
	    <th align="left" ><?php echo "Fecha de Emision:".encadenar(2).$_SESSION['fec_proc']; ?> </th> 
		
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left" ><?php echo "Fecha de Emision:".encadenar(2).$_SESSION['fec_proc']; ?> </th> 
		
    </tr>
	</table>	
	
	  <table border="0" width="1000">
	<tr>
	    <th align="left" ><?php echo "Señor(es):".encadenar(2). $_SESSION['nom_cli'] ; ?> </th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left" ><?php echo "Señor(es):".encadenar(2). $_SESSION['nom_cli'] ; ?> </th> 
    </tr>
	</table>
	<table border="0" width="1000">
	<tr>
	    <th align="left" ><?php echo "Nit / CI:".encadenar(2). $_SESSION['nitci'].encadenar(35)."Nro.Tran".encadenar(2).$_SESSION['nro_tran_cart'].encadenar(62)."Nit / CI::".encadenar(2). $_SESSION['nitci'].encadenar(25)."Nro.Tran".encadenar(2).$_SESSION['nro_tran_cart']; ?> </th> 
		
	
    </tr>
	</table>		
	
	 <table border="0" width="1000">
	<tr>
	    <th align="left" style="border: groove" ><?php echo "Cantidad".encadenar(25)."Concepto".encadenar(15); ?> </th> 
		<th align="right" style="border: groove" ><?php echo "Importe"; ?> </th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		 <th align="left" style="border: groove" ><?php echo "Cantidad".encadenar(25)."Concepto".encadenar(15); ?> </th> 
		<th align="right" style="border: groove" ><?php echo "Importe"; ?> </th>  
    </tr>
	
	
 <?php
//if ($_SESSION['detalle'] == 3){
   $s_mon = "- ";
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
 //  $c_agen = $_SESSION['c_agen'];
//   $descrip = $_SESSION['descrip'];
 //  $importe = $_SESSION['monto_t'] * -1;
   $nro_tran_cart = $_SESSION['nro_tran_cart'];
  // $cta_ctbg = $_SESSION['cta_ctbg'];
  // $dec_ctag = leer_cta_des($cta_ctbg);
  // $cta_ctb = $_SESSION['cta_ctb'];
   $deb_hab = 1;	
   $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
  $nro_tr_ingegr = leer_nro_co_ingegr(1);  
   $tipo = 1;
 
/*  

*/
 if ($_SESSION['pag_int'] > 0){
 $descrip = 'INTERES CORRIENTE';
 

?>
<tr>
	 	<th align="left" style="font-size:12px"><?php echo encadenar(25). $descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['pag_int'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="left" style="font-size:12px"><?php echo encadenar(25).$descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['pag_int'], 2, '.',','); ?></th> 
	 </tr>
 
<?php }	
   if ($_SESSION['pag_pen'] > 0){
  $descrip = 'INTERES VENCIDO';
 
?>
<tr>
	 	<th align="left" style="font-size:12px"><?php echo encadenar(25). $descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['pag_pen'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="left" style="font-size:12px"><?php echo encadenar(25).$descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['pag_pen'], 2, '.',','); ?></th> 
	 </tr>
 
<?php }	?>
    <tr>
<?php 	
	  if ($_SESSION['penal'] > 0){
  $descrip = 'INTERES PENAL';
 
?>
<tr>
	 	<th align="left" style="font-size:12px"><?php echo encadenar(25). $descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="left" style="font-size:12px"><?php echo encadenar(25).$descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['penal'], 2, '.',','); ?></th> 
	 </tr>
 
<?php }	?>
    <tr>
	 <th align="center" style="border: groove"><?php echo "TOTAL"; ?> </th> 
		 <th align="right" style="border: groove"><?php echo number_format($_SESSION['pag_int'] +
		  $_SESSION['pag_pen']+ $_SESSION['penal'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="center" style="border: groove"><?php echo "TOTAL"; ?> </th> 
		 <th align="right" style="border: groove"><?php echo number_format($_SESSION['pag_int'] +
		  $_SESSION['pag_pen'] + $_SESSION['penal'], 2, '.',','); ?></th> 
	 </tr>
</table>	  
  
		

</center>
<?php
  //  if ($_SESSION['egre_bs_sus'] == 1){
	    $mon_des = f_literal($monto,1);
//		}else{
//		$mon_des = f_literal($_SESSION['monto_eq'],1);
//		}
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
	 ?>		
<table border="0" width="1000"> 
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	  <tr>
	    <th align="left" style="font-size:12px"><?php echo "Son:".encadenar(1).$mon_des.encadenar(3).
		                       "Bolivianos"; ?> </th> 
		<th align="left"><?php echo encadenar(48); ?> </th>  
		<th align="left"  style="font-size:12px"><?php echo "Son:".encadenar(1).$mon_des.encadenar(3).
		                       "Bolivianos"; ?> </th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
     <tr>
	    <th align="left"><?php echo "Codigo de Control:".encadenar(3).$_SESSION['cc7m']; ?> </th> 
		<th align="left"><?php echo encadenar(40); ?> </th>  
		 <th align="left"><?php echo "Codigo de Control:".encadenar(3).$_SESSION['cc7m']; ?> </th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	 <tr>
	    <th align="right"><?php echo "Fecha limite de emision:".encadenar(3).$_SESSION['fecha_h']; ?> </th> 
		<th align="left"><?php echo encadenar(40); ?> </th>  
		 <th align="right"><?php echo "Fecha limite de emision:".encadenar(3).$_SESSION['fecha_h']; ?> </th>
   </tr>
     <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
	
	 	</table>
	

	
<?php

  }
}
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>