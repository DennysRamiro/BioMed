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
	//require_once('.cc7/lib7/libreriaCC7.php');
	//require('d:\wamp\www\cc7\lib7\libreriaCC7.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
       <a href='egre_mante.php'>Salir</a>
  </div>
	<?php
			//	include("header.php");
			?>
            

				<?php
					 //$fec = leer_param_gral();
					 //$fec1 = cambiaf_a_mysql_2($fec);
	/*			
	
  
 
  }
}		 	 
*/
	//header('Location: egre_mante.php');
	if ( $_SESSION['t_fac_fis'] == 2){	
	?>
	<br><br><br>
	<table  border="0" width="1200">
	<tr>
	       <td align="left"><?php echo encadenar(70); ?> </th> 
		<th align="left"  ><?php echo "NIT:".encadenar(2).$_SESSION['emp_nit'].encadenar(115).
		 "NIT:".encadenar(2).$_SESSION['emp_nit'].encadenar(12); ?></th>  
	    
	   
    </tr>
	</table>
	<table border="0" width="1200">
	<tr>
	    <td align="left"><?php echo encadenar(55); ?> </th> 
		<th align="left"  ><?php echo "Factura Nro:".encadenar(2).$_SESSION['nfactura'].
		encadenar(120). "Factura Nro:".encadenar(2).$_SESSION['nfactura'].encadenar(12); ?></th>  
	   	
	    
    </tr>
	</table>
	<table border="0" width="1700">
	<tr>
	 <td align="left"><?php echo encadenar(40); ?> </th> 
		<th align="left" ><?php echo "Autorización Nro:".encadenar(1).$_SESSION['orden'].
		encadenar(80)."Autorización Nro:".encadenar(1).$_SESSION['orden'].encadenar(35); ?></th>  
	  	
	
	   
    </tr>	
	</table>
    <table border="0" width="1200">
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(60); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(60); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(60); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	<tr>
	    <th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		 
		<th align="center"><?php echo encadenar(60); ?></th>
		<th align="center" style="font-size:24px"><?php echo encadenar(20); ?> </th> 
		     
			
    </tr>
	
	
	</table>	
	  <table border="0" width="1000">
	<tr>
	     <th align="left" ><?php echo "Fecha de Emision:".encadenar(2).$_SESSION['fec_proc']; ?> </th> 
		
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left" ><?php echo "Fecha de Emision:".encadenar(2).$_SESSION['fec_proc']; ?> </th> 
	</table>	
	
</table>	
	  <table border="0" width="1000">
	<tr>
	    <th align="left" ><?php echo "Señor(es):".encadenar(2). $_SESSION['nombre'] ; ?> </th> 
		<th align="center"><?php echo encadenar(35); ?></th>
		<th align="left" ><?php echo "Señor(es):".encadenar(2). $_SESSION['nombre'] ; ?> </th> 
    </tr>
	</table>	
	</table>
	 <table border="0" width="1000">
	<tr>
	    <th align="left" ><?php echo "Nit / CI:".encadenar(2). $_SESSION['nitci'].encadenar(35)."Nro.Tran".encadenar(2).$_SESSION['nro_tran'].encadenar(60)."Nit / CI::".encadenar(2). $_SESSION['nitci'].encadenar(25)."Nro.Tran".encadenar(2).$_SESSION['nro_tran']; ?> </th> 
		
	
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
   $c_agen = $_SESSION['c_agen'];
   $descrip = $_SESSION['descrip'];
   $importe = $_SESSION['monto_t'] * -1;
   
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $dec_ctag = leer_cta_des($cta_ctbg);
   $cta_ctb = $_SESSION['cta_ctb'];
   $deb_hab = 1;	
   //$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
  //$nro_tr_ingegr = leer_nro_co_ingegr(1);  
   $tipo = 1;
   if ($_SESSION['egre_bs_sus'] == 2){
    $impo_sus = $_SESSION['monto_eq'];
	$imp_or = $_SESSION['monto_t'] * -1;
	$mon= 2;
    }else{
	$imp_or = $_SESSION['monto_t'] * -1;		 
   	$impo_sus = $_SESSION['monto_t'] * -1;
	$mon= 1;
	} 

?>
 <tr>
	 	<th align="left" style="font-size:12px"><?php echo encadenar(25).$_SESSION['descrip']; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="left" style="font-size:12px"><?php echo encadenar(25). $_SESSION['descrip']; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',','); ?></th> 
	 </tr> 
	  <tr>
	 	<th align="center" style="border: groove"><?php echo "TOTAL"; ?> </th> 
		 <th align="right" style="border: groove"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="center" style="border: groove"><?php echo "TOTAL"; ?> </th> 
		 <th align="right" style="border: groove"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',','); ?></th> 
	 </tr>
</table>	  
  
		

</center>
<?php
   /* if ($_SESSION['egre_bs_sus'] == 1){
	    $mon_des = f_literal($imp_or,1);
		}else{
		$mon_des = f_literal($_SESSION['monto_eq'],1);
		} */
		
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
	$_SESSION['mon_des'] = f_literal($_SESSION['monto_t'] * -1,1);
	 ?>		
<table border="0" width="1000"> 
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	  <tr>
	    <th align="left" style="font-size:10px"><?php echo "Son:".encadenar(1).$_SESSION['mon_des'] .encadenar(3).
		                       "Bs."; ?> </th> 
		<th align="left"><?php echo encadenar(60); ?> </th>  
		<th align="left"  style="font-size:10px"><?php echo "Son:".encadenar(1).$_SESSION['mon_des'] .encadenar(3).
		                       "Bs."; ?> </th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	 
     <tr>
	    <th align="left"><?php echo "Codigo de Control:".encadenar(3).$_SESSION['cc7m']; ?> </th> 
		<th align="left"><?php echo encadenar(60); ?> </th>  
		 <th align="left"><?php echo "Codigo de Control:".encadenar(3).$_SESSION['cc7m']; ?> </th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(60); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	 <tr>
	    <th align="right"><?php echo "Fecha limite de emision:".encadenar(3).$_SESSION['fecha_h']; ?> </th> 
		<th align="left"><?php echo encadenar(60); ?> </th>  
		 <th align="right"><?php echo "Fecha limite de emision:".encadenar(3).$_SESSION['fecha_h']; ?> </th>
   </tr>
     <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(60); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(60); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	  
	 	</table>
	

	
<?php
}	
//header('Location: egre_mante.php');	
?>

  <?php //} ?>
	 
</div>
  <?php
	//	 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>