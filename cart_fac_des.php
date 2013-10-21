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
<link href="css/estilo.css" rel="stylesheet" type="text/css">
</head>
 
</head>
<body>
<?php
	   include("header.php");
 	 ?>
<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS 
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/down_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSO
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
                      <h2> <img src="img/down_64x64.png" border="0" alt="Modulo" align="absmiddle">DESEMBOLSO</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
	                     <img src="img/alert_32x32.png" align="absmiddle">
	                     Factura
                     </div>




<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <a href='menu_s.php'>Salir</a>
 </div>
	<?php
		//		include("header.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc'];
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 

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






if ($_SESSION['imp_int'] + $_SESSION['imp_com'] > 0){
    $monto = $_SESSION['monto']; 	
?>
	<br>
	<table border="1" width="900">
	
	<tr>
	    <!--td align="left"><?php //echo encadenar(70); ?> </td--> 
		<th align="left"  ><?php echo "NIT:".encadenar(2).$_SESSION['emp_nit'].encadenar(115).
		 "NIT:".encadenar(2).$_SESSION['emp_nit'].encadenar(12); ?></td>  
	    
			
    </tr>
	</table>
	<table border="1" width="900">
	<tr>
	    <!--td align="left"><?php //echo encadenar(55); ?> </th--> 
		<th align="left"  ><?php echo "Factura Nro:".encadenar(2).$_SESSION['nfactura'].
		encadenar(120). "Factura Nro:".encadenar(2).$_SESSION['nfactura'].encadenar(12); ?></th>  
	   	
			
    </tr>	
	</table>
	<table border="1" width="900">
	<tr>
	    <!--td align="left"><?php //echo encadenar(40); ?> </th--> 
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
	    <th align="left" ><?php echo "Nit / CI:".encadenar(2). $_SESSION['nitci'].encadenar(35)."Nro.Tran".encadenar(2).$_SESSION['nro_tr_ingegr'].encadenar(32)."Nit / CI::".encadenar(2). $_SESSION['nitci'].encadenar(25)."Nro.Tran".encadenar(2).$_SESSION['nro_tr_ingegr']; ?> </th> 
		
	
    </tr>
	</table>	
	 <table border="1" width="1000">
	<tr>
	    <th align="left" style="border: groove" ><?php echo "Cantidad".encadenar(25)."Concepto".encadenar(15); ?> </th> 
		<th align="right" style="border: groove" ><?php echo "Importe"; ?> </th> 
		<th align="center"></th>
		 <th align="left" style="border: groove" ><?php echo "Cantidad".encadenar(25)."Concepto".encadenar(15); ?> </th> 
		<th align="right" style="border: groove" ><?php echo "Importe"; ?> </th>  
    </tr>
	
	
	
	
 <?php
//if ($_SESSION['detalle'] == 3){
   $s_mon = "- ";
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $nro_tran_cart = $_SESSION['nro_tr_ingegr'];
   $deb_hab = 1;	
   $tipo = 1;

 if ($_SESSION['imp_int'] > 0){
 $descrip = 'INTERES CORRIENTE';
 ?>
  <tr>
	 	<th align="left" style="font-size:12px"><?php echo encadenar(25). $descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['imp_int'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="left" style="font-size:12px"><?php echo encadenar(25).$descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['imp_int'], 2, '.',','); ?></th> 
	 </tr>
<?php }	
   if ($_SESSION['imp_com'] > 0){
  $descrip = 'COMISION';

?>
 <tr>
	 	<th align="left" style="font-size:12px"><?php echo encadenar(25).$descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['imp_com'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="left" style="font-size:12px"><?php echo encadenar(25).$descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['imp_com'], 2, '.',',').encadenar(5); ?></th> 
	 </tr>
<?php }	?>
    <tr>
	 	<th align="center" style="border: groove"><?php echo "TOTAL"; ?> </th> 
		 <th align="right"style="border: groove" ><?php echo number_format($_SESSION['imp_int'] + $_SESSION['imp_com'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(70); ?> </th>
		<th align="center" style="border: groove"><?php echo "TOTAL"; ?> </th> 
		 <th align="right" style="border: groove"><?php echo number_format($_SESSION['imp_int'] + $_SESSION['imp_com'], 2, '.',','); ?></th> 
	 </tr>
</table>	  
  
		

</center>
<?php
 
	    $mon_des = f_literal($monto,1);

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
		
	 </tr>
	   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	 
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