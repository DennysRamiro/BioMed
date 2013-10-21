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
?>
<html>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>

	<?php
		//		include("header.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc'];
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					 if ($_SESSION['monto_ven'] > 0){
					    }else{
						$_SESSION['monto_ven'] = 0;
						}
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
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
<?php	   
if ($_SESSION['pag_int'] + $_SESSION['pag_pen'] + $_SESSION['penal'] > 0){
?>	   
	   <a href="cart_imp_fac.php" style="color:#FF0000">Factura</a>
	   
<?php	   
}
?>	   
	    <a href='cart_cobros.php'>Salir</a>
 </div>
           
</center>
<font  size="+2">
<form name="form2" method="post" action="cobro_retro_opd_2.php" style="" onSubmit="return" >
<?php
if ($_SESSION['EMPRESA_TIPO'] == 2){
echo encadenar(20)."BOLETA DE PAGO ".encadenar(50)."BOLETA DE PAGO "; 
?>	
</font>
<?php if (isset($_SESSION['monto_com'])){
         }else{
		 $_SESSION['monto_com'] = 0;
		 }
		if (isset($_SESSION['cta_fdo'])){
         }else{
		 $_SESSION['cta_fdo'] = 0;
		 } 
		 
		 
// echo  encadenar(10)."BOLETA DE PAGO EN".encadenar(2).$_SESSION['des_mon'] ; 


?>

 <table border="0" width="1000">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro.Compbte"; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$_SESSION['nro_tran_cart']; ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro.Compbte"; ?></th>  
		<th align="right"><?php echo encadenar(5).$_SESSION['nro_tran_cart']; ?></th>     
			
    </tr>	
	
 <tr>
	    <th align="left"><?php echo "Nro.Operacion".encadenar(2).$_SESSION['ncre']; ?> </th> 
		<th align="left"><?php echo encadenar(5); ?></th> 
		<th align="left"><?php echo "Total Cuotas"; ?></th> 
		<th align="right"><?php echo $_SESSION['cuotas']; ?></th>
		<th align="left"><?php echo encadenar(21); ?></th>  
		 <th align="left"><?php echo "Nro.Operacion".encadenar(2).$_SESSION['ncre']; ?> </th> 
		<th align="left"><?php echo encadenar(5); ?></th> 
		<th align="left"><?php echo "Total Cuotas"; ?></th> 
		<th align="right"><?php echo $_SESSION['cuotas']; ?></th>
			
    </tr>	
 	</table> 	
 <table border="0" width="1000">
	 <?php
	 if ($_SESSION['nom_grp'] <> ""){
	?> 
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th> 
		<th align="center"><?php echo encadenar(15); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th>     
   </tr>
   <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(15); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th>     
   </tr>
   	<?php }else{  ?> 
  <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
		<th align="left"><?php echo "Cliente"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th>     
   </tr>
   <?php }  ?> 
   	</table> 
      
<table border="0" width="1000">
<tr>
        <tr>
	    <th align="left"><?php echo "Moneda".encadenar(3).$_SESSION['des_mon']; ?> </th> 
		<th align="left"><?php echo encadenar(25); ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="left"><?php echo encadenar(30); ?></th>  
		 <th align="left"><?php echo "Moneda".encadenar(3).$_SESSION['des_mon']; ?> </th> 
		<th align="left"><?php echo encadenar(25); ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
			
   
</table>
<table border="0" width="1000">
<tr>
	    <th align="left"><?php echo "Vias de Pago"; ?> </th> 
		<td align="left"><?php echo encadenar(6); ?></th> 
		<td align="left"><?php echo encadenar(6); ?></th> 
		<td align="left"><?php echo encadenar(12); ?></th>
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "Vias de Pago"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th> 
		<td align="left"><?php echo encadenar(6); ?></th>  
		<td align="left"><?php echo encadenar(12); ?></th>
   </tr>	

<?php if ($_SESSION['des_mon'] == "BOLIVIANOS") { ?>
      <tr>
        <th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',','); ?></td>
		<th align="center"><?php echo encadenar(45); ?></th>
		<th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',',').
		encadenar(25); ?></td>
		</tr>
		<tr>
		
		<?php if ($_SESSION['via_us'] > 0) { ?>   
		<th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_COMPRA'], 2, '.',',').encadenar(1); ?></td>
		<td align="right"><?php echo number_format($_SESSION['monto_com'], 2, '.',',');?></td> 
		<th align="center"><?php echo encadenar(45); ?></th> 
		<th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_COMPRA'], 2, '.',',').encadenar(1); ?></td>
		<td align="right"><?php echo number_format($_SESSION['monto_com'], 2, '.',',').
		encadenar(25);?></td>  
		<?php }?>
		 
	</tr>
	<tr>
         <th align="left"><?php echo "Fondo Grtia :".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fdo']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',','); ?></td>
		 <th align="center"><?php echo encadenar(45); ?></th> 
		 <th align="left"><?php echo "Fondo Grtia :".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fdo']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',',').
		encadenar(25); ?></td>
		</tr>
	<tr>
		
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_bs']+$_SESSION['monto_com']+
		                                $_SESSION['via_ah'], 2, '.',','); ?></th>
		<th align="left"><?php echo encadenar(45); ?></th>
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_bs']+$_SESSION['monto_com']+
		                                $_SESSION['via_ah'], 2, '.',',').encadenar(25); ?></th>        
	</tr>
	 <?php }?>
	<?php if ($_SESSION['des_mon'] == "DOLARES") { ?>
      <tr>
	   <th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td>
		<th align="center"><?php echo encadenar(45); ?></th>
		<th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_us'], 2, '.',',').
		encadenar(25); ?></td>
      </tr> 
		<?php if ($_SESSION['via_bs'] > 0) { ?> 
		<th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['monto_ven'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_VENTA'], 2, '.',',').encadenar(1); ?></td>
	 	<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',',');?></td> 
		<th align="center"><?php echo encadenar(45); ?></th> 
		<th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['monto_ven'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_VENTA'], 2, '.',',').encadenar(1); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',',').
		encadenar(25);?></td>  
		<?php }?>
	</tr>
	<tr>
         <th align="left"><?php echo "Fondo Grtia :".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fdo']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',','); ?></td>
		 <th align="center"><?php echo encadenar(45); ?></th> 
		 <th align="left"><?php echo "Fondo Grtia :".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fdo']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',',').
		encadenar(25); ?></td>
		</tr>
	
	<tr>
        <tr>
		
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_us']+$_SESSION['via_bs']+
		                                $_SESSION['via_ah'], 2, '.',','); ?></th>
		<th align="left"><?php echo encadenar(45); ?></th>
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_us']+$_SESSION['via_bs']+
		                                $_SESSION['via_ah'], 2, '.',',').encadenar(25); ?></th>        
	</tr>
		 <?php }?> 
</table>	

</font>
 <table border="0" width="1000">
   
    <tr>
	    <th align="left"><?php echo "Detalle"; ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Capital"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_cap'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(38); ?></td>
		<th align="left"><?php echo "Detalle"; ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Capital"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_cap'], 2, '.',','); ?></td>
     </tr>
	 <?php if ($_SESSION['pag_dev'] > 0) { ?> 
    <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes F"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_dev'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes F"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_dev'], 2, '.',','); ?></td>
     </tr>
	  <?php }?> 
	 <?php if ($_SESSION['pag_int'] > 0) { ?> 
    <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_int'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_int'], 2, '.',','); ?></td>
     </tr>
	  <?php }?> 
		<?php if ($_SESSION['pag_pen'] > 0) { ?>  
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Vencido"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_pen'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Vencido"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_pen'], 2, '.',','); ?></td>
     </tr> 
	  <?php }?> 
	  <?php if ($_SESSION['penal'] > 0) { ?>  
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Penal"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['penal'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Penal"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['penal'], 2, '.',','); ?></td>
     </tr> 
	  <?php }?> 
	<tr>
	    <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Fondo Garantia"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['dep_aho'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Fondo Garantia"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['dep_aho'], 2, '.',','); ?></td>
     </tr> 
	 		<?php if ($_SESSION['itf'] > 0) { ?>  
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "ITF"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['itf'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "ITF"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['itf'], 2, '.',','); ?></td>
     </tr> 
	  <?php }?> 
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Total"; ?></th>
		<th align="right"><?php echo number_format( $_SESSION['pag_cap'] 
		                                          + $_SESSION['pag_int']
												  + $_SESSION['pag_dev']
												  + $_SESSION['pag_pen']
												  + $_SESSION['dep_aho']
												  + $_SESSION['penal']
												  + $_SESSION['itf'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		 <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Total"; ?></th>
		<th align="right"><?php echo number_format( $_SESSION['pag_cap'] 
		                                          + $_SESSION['pag_int']
												  + $_SESSION['pag_dev']
												   + $_SESSION['pag_pen']
												  + $_SESSION['dep_aho']
												  + $_SESSION['penal']
												  + $_SESSION['itf'], 2, '.',','); ?></td>										  
     </tr>
</table>
 
  <?php
     $imp_t = round($_SESSION['pag_cap'] + $_SESSION['pag_int'] + $_SESSION['dep_aho'] + 
	 $_SESSION['pag_pen']+$_SESSION['itf']+ $_SESSION['pag_dev']+$_SESSION['penal'],2);
	// echo $imp_t;
	 $mon_des = f_literal($imp_t,1);
 ?>
 <table border="0" width="1000">

 <tr>
	    <td align="left"><?php echo  "Son:".encadenar(2); ?></td>
        <td align="left"><?php echo $mon_des.encadenar(2).$_SESSION['des_mon']; ?></td>
		<th align="left"><?php echo  encadenar(28); ?></th>
		<td align="left"><?php echo  "Son:".encadenar(2); ?></td>
        <td align="left"><?php echo $mon_des.encadenar(2).$_SESSION['des_mon']; ?></td>
     </tr>

</table>
<table border="0" width="1000">	 
	<tr>
	   
        <th align="left" style="font-size:12px"><?php echo "Cta. Pagada".encadenar(2)
		.$_SESSION['cuota']; ?></th>
		<th align="left" style="font-size:12px"><?php echo "Est. Actual"; ?></th>
		<td align="left"><?php echo  $_SESSION['s_est']; ?></td>
		<th align="left"  style="font-size:12px"><?php echo "Prox.Vcto."
		.encadenar(1).cambiaf_a_normal($_SESSION['prox_ven']); ?></th>
		<td align="left"><?php echo  encadenar(50); ?></td>
		  <th align="left" style="font-size:12px"><?php echo "Cta. Pagada".encadenar(2)
		.$_SESSION['cuota']; ?></th>
		<th align="left" style="font-size:12px"><?php echo "Est. Actual"; ?></th>
		<td align="left"><?php echo  $_SESSION['s_est']; ?></td>
		<th align="left"  style="font-size:12px"><?php echo "Prox.Vcto."
		.encadenar(1).cambiaf_a_normal($_SESSION['prox_ven']); ?></th>
     </tr> 

    <tr>
	   <th align="left" style="font-size:10px"><?php echo "Saldo antes de Pago"; ?></th>
	   <td align="right"><?php echo  number_format($_SESSION['sal_ant'], 2, '.',','); ?></td>
	   <th align="left" style="font-size:10px"><?php echo "Saldo despues de Pago"; ?></th>
	  <?php if (($_SESSION['sal_ant']- $_SESSION['pag_cap']) > 0 ) { ?>   
	   <td align="right"><?php echo  number_format($_SESSION['sal_ant']- $_SESSION['pag_cap'] , 2, '.',','); ?></td>
	   <?php }else{?>
	   <td align="right"><?php echo  "CANCELADO"; ?></td>
	   <?php }?>
       <td align="left"><?php echo  encadenar(50); ?></td>
	  <th align="left" style="font-size:10px"><?php echo "Saldo antes de Pago"; ?></th>
	  <td align="right"><?php echo number_format($_SESSION['sal_ant'] , 2, '.',','); ?></td>
	  <th align="left" style="font-size:10px"><?php echo "Saldo despues de Pago"; ?></th>
	  <?php if (($_SESSION['sal_ant']- $_SESSION['pag_cap']) > 0 ) { ?>   
	   <td align="right"><?php echo  number_format($_SESSION['sal_ant']- $_SESSION['pag_cap'] , 2, '.',','); ?></td>
	   <?php }else{?>
	   <td align="right"><?php echo  "CANCELADO"; ?></td>
	   <?php }?>
     </tr>
</table>
<table border="0" width="1000">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "__________________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "__________________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px" ><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
    </table>
  <table border="0" width="1000">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo  "Nota: No valido como Credito Fiscal ".
		                                              encadenar(30)."Rec.".encadenar(2).$_SESSION['nro_rec']; ?> </th> 
		<th align="left"><?php echo encadenar(45); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal ".
		                                              encadenar(30)."Rec.".encadenar(2).$_SESSION['nro_rec'];?> </th> 
		
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(30).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(10); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(30).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
  <br>
  <?php 
  if (($_SESSION['cond_int'] + $_SESSION['cond_intm']) > 0){
   //echo ($_SESSION['cond_int'] + $_SESSION['cond_intm'])."suma" ?> 
  
 <table border="0" width="1000">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(24); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cte Cartera"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tran_cart']; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Cartera"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tran_cart']; ?></th>     
			
    </tr>	
	
	</table>
	</center>
	<strong>
	<?php
echo encadenar(25)."CONDONACION".encadenar(90)."CONDONACION";
?>	
<table border="0" width="900">
 <tr>
	    <th align="left"><?php echo "Nro.Operacion"; ?> </th> 
		<th align="right"><?php echo $_SESSION['ncre']; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo encadenar(6); ?></th> 
		<th align="right"><?php echo encadenar(6); ?></th>
		<th align="center"><?php echo encadenar(12); ?></th>     
		<th align="left"><?php echo "Nro.Operacion"; ?> </th> 
		<th align="right"><?php echo  $_SESSION['ncre']; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo encadenar(6); ?></th> 
		<th align="right"><?php echo encadenar(6); ?></th>  
			
    </tr>	

	</table>
 <table border="0" width="1100">
<tr>
	    <th align="left"><?php echo "Cajero"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_rec']; ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th>  
	   	<td align="left"><?php echo $_SESSION['asesor']; ?></th> 
		<th align="center"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo "Cajero"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_rec']; ?></th>     
		<th align="left"><?php echo "Asesor "; ?></th>  
		<td align="left"><?php echo $_SESSION['asesor']; ?></th>     
			
    </tr>	
</table>
 <table border="0" width="900">
	 <?php
	 if ($_SESSION['nom_grp'] <> ""){
	?> 
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th>     
   </tr>
   	<?php }  ?> 
  <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Cliente"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th>     
   </tr>
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $_SESSION['ci']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "C.I"; ?></th>
		<td align="left"><?php echo $_SESSION['ci']; ?></th>     
   </tr>	
    <tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "Moneda"; ?></th>
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th>     
   </tr>	
   	</table>
	<br><br>
 <table border="0" width="1000">
<?php  if ($_SESSION['cond_intm'] > 0){    ?>

 <tr>
	    <th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Mora"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_intm'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(15); ?></td>
		<th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Mora"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_intm'], 2, '.',','); ?></td>
     </tr>
<?php  }     ?>
<?php  if ($_SESSION['cond_int'] > 0){    ?>

 <tr>
	    <th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Corriente"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_int'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(15); ?></td>
		<th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Corriente"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_int'], 2, '.',','); ?></td>
     </tr>
<?php  }     ?>
</table>
 <?php
     $imp_t = $_SESSION['cond_intm'] + $_SESSION['cond_int'];
	 $mon_des = f_literal($imp_t,1);
 ?>
 <table border="0" width="1000">

 <tr>
	    <td align="left"><?php echo  "Son:"; ?></td>
        <td align="right"><?php echo $mon_des; ?></td>
		<th align="left"><?php echo  encadenar(15); ?></th>
		<td align="left"><?php echo  "Son:"; ?></td>
        <td align="right"><?php echo $mon_des; ?></td>
     </tr>

</table>
<table border="0" width="1000">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	  <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
    </table>
  <table border="0" width="1000">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(25).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(25).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>








<?php  }   }  
 
if ($_SESSION['EMPRESA_TIPO'] == 1){
echo encadenar(20)."BOLETA DE PAGO"; 
?>	
</center>
</font>
<?php if (isset($_SESSION['monto_com'])){
         }else{
		 $_SESSION['monto_com'] = 0;
		 }
// echo  encadenar(10)."BOLETA DE PAGO EN".encadenar(2).$_SESSION['des_mon'] ; 


?>

 <table border="0" width="500">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(30); ?></th>
		  
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro.Compbte"; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$_SESSION['nro_tran_cart']; ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
		    
			
    </tr>	
	
 <tr>
	    <th align="left"><?php echo "Nro.Operacion".encadenar(2).$_SESSION['ncre']; ?> </th> 
		<th align="left"><?php echo encadenar(5); ?></th> 
		<th align="left"><?php echo "Total Cuotas"; ?></th> 
		<th align="right"><?php echo $_SESSION['cuotas']; ?></th>
		<th align="left"><?php echo encadenar(21); ?></th>  
		
			
    </tr>	
 	</table> 	
 <table border="0" width="500">
	 <?php
	 if ($_SESSION['nom_grp'] <> ""){
	?> 
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th> 
		<th align="center"><?php echo encadenar(15); ?></th>
		     
   </tr>
   <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(15); ?></th>
		    
   </tr>
   	<?php }else{  ?> 
  <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
		   
   </tr>
   <?php }  ?> 
   	</table> 
      
<table border="0" width="500">
<tr>
        <tr>
	    <th align="left"><?php echo "Moneda".encadenar(3).$_SESSION['des_mon']; ?> </th> 
		<th align="left"><?php echo encadenar(25); ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="left"><?php echo encadenar(30); ?></th>  
		    
</table>
<table border="0" width="500">
<tr>
	    <th align="left"><?php echo "Vias de Pago"; ?> </th> 
		<td align="left"><?php echo encadenar(6); ?></th> 
		<td align="left"><?php echo encadenar(6); ?></th> 
		<td align="left"><?php echo encadenar(12); ?></th>
		<th align="center"><?php echo encadenar(25); ?></th>
  </tr>	

<?php if ($_SESSION['des_mon'] == "BOLIVIANOS") { ?>
      <tr>
        <th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',','); ?></td>
		<th align="center"><?php echo encadenar(25); ?></th>
		
		</tr>
		<tr>
		
		<?php if ($_SESSION['via_us'] > 0) { ?>   
		<th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_COMPRA'], 2, '.',',').encadenar(1); ?></td>
		<td align="right"><?php echo number_format($_SESSION['monto_com'], 2, '.',',');?></td> 
		<th align="center"><?php echo encadenar(25); ?></th> 
		 
		<?php }?>
		 
	</tr>
	<tr>
         <th align="left"><?php echo "Fondo Grtia :".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fdo']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',','); ?></td>
		 <th align="center"><?php echo encadenar(25); ?></th> 
		 
		</tr>
	<tr>
		
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_bs']+$_SESSION['monto_com']+
		                                $_SESSION['via_ah'], 2, '.',','); ?></th>
		<th align="left"><?php echo encadenar(25); ?></th>
		        
	</tr>
	 <?php }?>
	<?php if ($_SESSION['des_mon'] == "DOLARES") { ?>
      <tr>
	   <th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td>
		<th align="center"><?php echo encadenar(25); ?></th>
		
      </tr> 
		<?php if ($_SESSION['via_bs'] > 0) { ?> 
		<th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['monto_ven'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_VENTA'], 2, '.',',').encadenar(1); ?></td>
	 	<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',',');?></td> 
		<th align="center"><?php echo encadenar(25); ?></th> 
		 
		<?php }?>
	</tr>
	<tr>
         <th align="left"><?php echo "Fondo Grtia :".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fdo']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',','); ?></td>
		 <th align="center"><?php echo encadenar(25); ?></th> 
		
		</tr>
	
	<tr>
        <tr>
		
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_us']+$_SESSION['via_bs']+
		                                $_SESSION['via_ah'], 2, '.',','); ?></th>
		<th align="left"><?php echo encadenar(25); ?></th>
		        
	</tr>
		 <?php }?> 
</table>	

</font>
 <table border="0" width="500">
   
    <tr>
	    <th align="left"><?php echo "Detalle"; ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Capital"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_cap'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(25); ?></td>
		
     </tr>
    <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_int'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(25); ?></td>
		 
     </tr>
		<?php if ($_SESSION['pag_pen'] > 0) { ?>  
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Vencido"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_pen'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(25); ?></td>
		 
     </tr> 
	  <?php }?> 
	<tr>
	    <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Fondo Garantia"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['dep_aho'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(25); ?></td>
		
     </tr> 
	 		<?php if ($_SESSION['itf'] > 0) { ?>  
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "ITF"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['itf'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(25); ?></td>
		 
     </tr> 
	  <?php }?> 
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Total"; ?></th>
		<th align="right"><?php echo number_format( $_SESSION['pag_cap'] 
		                                          + $_SESSION['pag_int']
												  + $_SESSION['pag_pen']
												  + $_SESSION['dep_aho']
												  + $_SESSION['itf'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(25); ?></td>
												  
     </tr>
</table>
 
  <?php
     $imp_t = round($_SESSION['pag_cap'] + $_SESSION['pag_int'] + $_SESSION['dep_aho'] + $_SESSION['pag_pen']+$_SESSION['itf'],2);
	// echo $imp_t;
	 $mon_des = f_literal($imp_t,1);
 ?>
 <table border="0" width="500">

 <tr>
	    <td align="left"><?php echo  "Son:".encadenar(2); ?></td>
        <td align="left"><?php echo $mon_des.encadenar(2).$_SESSION['des_mon']; ?></td>
		<th align="left"><?php echo  encadenar(18); ?></th>
		
     </tr>

</table>
<table border="0" width="500">	 
	<tr>
	   
        <th align="left" style="font-size:12px"><?php echo "Cta. Pagada".encadenar(2)
		.$_SESSION['cuota']; ?></th>
		<th align="left" style="font-size:12px"><?php echo "Est. Actual"; ?></th>
		<td align="left"><?php echo  $_SESSION['s_est']; ?></td>
		<th align="left"  style="font-size:12px"><?php echo "Prox.Vcto."
		.encadenar(1).cambiaf_a_normal($_SESSION['prox_ven']); ?></th>
		<td align="left"><?php echo  encadenar(30); ?></td>
		
     </tr> 

    <tr>
	   <th align="left" style="font-size:10px"><?php echo "Saldo antes de Pago"; ?></th>
	   <td align="right"><?php echo  number_format($_SESSION['sal_ant'], 2, '.',','); ?></td>
	   <th align="left" style="font-size:10px"><?php echo "Saldo despues de Pago"; ?></th>
	  <?php if (($_SESSION['sal_ant']- $_SESSION['pag_cap']) > 0 ) { ?>   
	   <td align="right"><?php echo  number_format($_SESSION['sal_ant']- $_SESSION['pag_cap'] , 2, '.',','); ?></td>
	   <?php }else{?>
	   <td align="right"><?php echo  "CANCELADO"; ?></td>
	   <?php }?>
       <td align="left"><?php echo  encadenar(30); ?></td>
	 
     </tr>
</table>
<table border="0" width="500">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(20); ?></th>
		
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "__________________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "__________________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(20); ?></th>
		
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px" ><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(20); ?></th>
		
	 </tr>

  </table>
    </table>
  <table border="0" width="500">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo  "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(35); ?> </th>  
		
		
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(20).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(1); ?> </th>  
		 
   </tr>
</table>
  <br>
  <?php 
  if (($_SESSION['cond_int'] + $_SESSION['cond_intm']) > 0){
   //echo ($_SESSION['cond_int'] + $_SESSION['cond_intm'])."suma" ?> 
  
 <table border="0" width="1000">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(24); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cte Cartera"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tran_cart']; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Cartera"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tran_cart']; ?></th>     
			
    </tr>	
	
	</table>
	</center>
	<strong>
	<?php
echo encadenar(25)."CONDONACION".encadenar(90)."CONDONACION";
?>	
<table border="0" width="900">
 <tr>
	    <th align="left"><?php echo "Nro.Operacion"; ?> </th> 
		<th align="right"><?php echo $_SESSION['ncre']; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo encadenar(6); ?></th> 
		<th align="right"><?php echo encadenar(6); ?></th>
		<th align="center"><?php echo encadenar(12); ?></th>     
		<th align="left"><?php echo "Nro.Operacion"; ?> </th> 
		<th align="right"><?php echo  $_SESSION['ncre']; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo encadenar(6); ?></th> 
		<th align="right"><?php echo encadenar(6); ?></th>  
			
    </tr>	

	</table>
 <table border="0" width="1100">
<tr>
	    <th align="left"><?php echo "Cajero"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_rec']; ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th>  
	   	<td align="left"><?php echo $_SESSION['asesor']; ?></th> 
		<th align="center"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo "Cajero"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_rec']; ?></th>     
		<th align="left"><?php echo "Asesor "; ?></th>  
		<td align="left"><?php echo $_SESSION['asesor']; ?></th>     
			
    </tr>	
</table>
 <table border="0" width="900">
	 <?php
	 if ($_SESSION['nom_grp'] <> ""){
	?> 
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th>     
   </tr>
   	<?php }  ?> 
  <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Cliente"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th>     
   </tr>
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $_SESSION['ci']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "C.I"; ?></th>
		<td align="left"><?php echo $_SESSION['ci']; ?></th>     
   </tr>	
    <tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "Moneda"; ?></th>
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th>     
   </tr>	
   	</table>
	<br><br>
 <table border="0" width="1000">
<?php  if ($_SESSION['cond_intm'] > 0){    ?>

 <tr>
	    <th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Mora"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_intm'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(15); ?></td>
		<th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Mora"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_intm'], 2, '.',','); ?></td>
     </tr>
<?php  }     ?>
<?php  if ($_SESSION['cond_int'] > 0){    ?>

 <tr>
	    <th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Corriente"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_int'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(15); ?></td>
		<th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Corriente"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_int'], 2, '.',','); ?></td>
     </tr>
<?php  }     ?>
</table>
 <?php
     $imp_t = $_SESSION['cond_intm'] + $_SESSION['cond_int'];
	 $mon_des = f_literal($imp_t,1);
 ?>
 <table border="0" width="1000">

 <tr>
	    <td align="left"><?php echo  "Son:"; ?></td>
        <td align="right"><?php echo $mon_des; ?></td>
		<th align="left"><?php echo  encadenar(15); ?></th>
		<td align="left"><?php echo  "Son:"; ?></td>
        <td align="right"><?php echo $mon_des; ?></td>
     </tr>

</table>
<table border="0" width="1000">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	  <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
    </table>
  <table border="0" width="1000">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(25).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(25).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>








<?php  }   }  ?> 
 
 
  
  </center>
 
	 
</div>
  <?php
if ($_SESSION['EMPRESA_TIPO'] == 2){
//echo "aquiiii";

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
    $orden = $linea['FAC_CTRL_ORDEN'];
    $llave = trim($linea['FAC_CTRL_LLAVE']);//'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS';    //					 
    $fecha =  $fec1;
    $fecha_h =  $linea['FAC_CTRL_FEC_H'];
$_SESSION['fecha_h'] = cambiaf_a_normal($fecha_h);	
$monto =  $_SESSION['pag_int'] + $_SESSION['pag_pen'] +  $_SESSION['penal'];
$_SESSION['monto'] = $monto;
$nfactura = leer_nro_corre_fac($orden);					
$cc7m = genCodContrl($orden, $nfactura, $nitci, $fecha, $monto, $llave);	
$_SESSION['nfactura'] = $nfactura;
$_SESSION['orden'] = $orden;
$_SESSION['cc7m'] = $cc7m;
$_SESSION['fecha_h'] = cambiaf_a_normal($fecha_h);




/*


 */
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
   //$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
 // $nro_tr_ingegr = leer_nro_co_ingegr(1);  
   $tipo = 1;
  // if ($_SESSION['egre_bs_sus'] == 2){
  //  $impo_sus = $_SESSION['monto_eq'];
//	$imp_or = $_SESSION['monto_t'] * -1;
//	$mon= 2;
 //   }else{
//	$imp_or = $_SESSION['monto_t'] * -1;		 
//   	$impo_sus = $_SESSION['monto_t'] * -1;
//	$mon= 1;
	//} 
 if ($_SESSION['pag_int'] + $_SESSION['pag_pen'] + $_SESSION['penal'] > 0){	
     $monto = $_SESSION['pag_int'] + $_SESSION['pag_pen'] + $_SESSION['penal'];
     if ($_SESSION['mon'] == 2){
	    $monto = $monto * $tc_ctb;
	    $_SESSION['pag_int'] = $_SESSION['pag_int'] * $tc_ctb;
		$_SESSION['pag_pen'] = $_SESSION['pag_pen'] * $tc_ctb;
		$_SESSION['penal'] = $_SESSION['penal'] * $tc_ctb;
	 }
 
 
  $consulta = "insert into factura (FACTURA_AGEN, 
                                    FACTURA_APLI,
									FACTURA_NRO,
									FACTURA_TALON,
									FACTURA_ORDEN,
					                FACTURA_ALFA,
					                FACTURA_LLAVE,
   				                    FACTURA_NUMERICO,
					                FACTURA_ENLACE, 
									FACTURA_NOMBRE, 
									FACTURA_NIT, 
									FACTURA_MONTO,
                                    FACTURA_ESTADO,
                                    FACTURA_FECHA,
                                    FACTURA_FEC_H,
                                    FACTURA_COD_CTRL,
                                    FACTURA_USR_ALTA,
									FACTURA_FCH_HR_ALTA,
                                    FACTURA_USR_BAJA,
                                    FACTURA_FCH_HR_BAJA
                                    ) values (32,
									          13000,
											  $nro_tran_cart,
											  null,
											 '$orden',
												null,
												 '$llave',
												 $nfactura,
												  null,
												 '$nombre',
												 '$nitci',
												  $monto,
										          1,
												 '$fec1',
												 '$fecha_h',
												 '$cc7m',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
//Detalle contable de Factura

} 


 if ($_SESSION['pag_int'] > 0){
$it = $_SESSION['pag_int'] * 0.03;
$iva = $_SESSION['pag_int'] * 0.13;
$descrip = 'INTERES CORRIENTE';
 $consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '45502101',
											  '1',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  null)";
$resultado = mysql_query($consulta);

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204101',
											  '2',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
$cta_ctbg = $_SESSION['cta_int']; 
$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '$cta_ctbg',
											  '1',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204102',
											  '2',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);


$imp_int = $_SESSION['pag_int'];
$consulta = "insert into factura_tran (FAC_TRA_FACTURA, 
                                       FAC_TRA_MODULO,
									   FAC_TRA_DESCRI,
									   FAC_TRA_IMPO,
									   FAC_TRA_FECHA,
					                   FAC_TRA_ESTADO,
									   FAC_TRA_USR_ALTA,
					                   FAC_TRA_FCH_HR_ALTA,
									   FAC_TRA_USR_BAJA,
                                       FAC_TRA_FCH_HR_BAJA
                                    ) values ($nfactura,
											  6000,
											  '$descrip',
											 $imp_int,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);







 }
	
   if ($_SESSION['pag_pen'] > 0){
$it = $_SESSION['pag_pen'] * 0.03;
$iva = $_SESSION['pag_pen'] * 0.13;
$descrip = 'INTERES VENCIDO';
$cta_ctbg = $_SESSION['cta_pen']; 
 $consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '45502101',
											  '1',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  null)";
$resultado = mysql_query($consulta);

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204101',
											  '2',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '$cta_ctbg',
											  '1',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204102',
											  '2',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
$imp_pen = $_SESSION['pag_pen'];
$consulta = "insert into factura_tran (FAC_TRA_FACTURA, 
                                       FAC_TRA_MODULO,
									   FAC_TRA_DESCRI,
									   FAC_TRA_IMPO,
									   FAC_TRA_FECHA,
					                   FAC_TRA_ESTADO,
									   FAC_TRA_USR_ALTA,
					                   FAC_TRA_FCH_HR_ALTA,
									   FAC_TRA_USR_BAJA,
                                       FAC_TRA_FCH_HR_BAJA
                                    ) values ($nfactura,
											  6000,
											  '$descrip',
											 $imp_pen,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

 }
 //Interes Penal
   if ($_SESSION['penal'] > 0){
       $imp_int = $_SESSION['penal'];
            $it = $_SESSION['penal'] * 0.03;
            $iva = $_SESSION['penal'] * 0.13;
            $descrip = 'INTERES PENAL';
            $consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                                   FAC_DET_CORRELATIVO,
									               FAC_DET_CONTA,
									               FAC_DET_CONCEP,
									               FAC_DET_IMPORTE,
					                               FAC_DET_FECHA,
									               FAC_DET_ESTADO,
					                               FAC_DET_USR_ALTA,
									               FAC_DET_FCH_HR_ALTA,
                                                   FAC_DET_USR_BAJA,
                                                   FAC_DET_FCH_HR_BAJA
                                                   ) values (32,
									                         $nfactura,
											                '45502101',
											                '1',
											                $it,
											                '$fec1',
											                1,
											                '$log_usr',
												            null,
												            null,
												            null)";
         $resultado = mysql_query($consulta);

         $consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                                FAC_DET_CORRELATIVO,
									            FAC_DET_CONTA,
								            	FAC_DET_CONCEP,
									            FAC_DET_IMPORTE,
					                            FAC_DET_FECHA,
									            FAC_DET_ESTADO,
					                            FAC_DET_USR_ALTA,
									            FAC_DET_FCH_HR_ALTA,
                                                FAC_DET_USR_BAJA,
                                                FAC_DET_FCH_HR_BAJA
                                                ) values (32,
									                      $nfactura,
											              '24204101',
											              '2',
											              $it,
											              '$fec1',
											              1,
											              '$log_usr',
												          null,
												          null,
												          '0000-00-00 00:00:00')";
           $resultado = mysql_query($consulta);
           $cta_ctbg = $_SESSION['cta_pen']; 
           $consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                                  FAC_DET_CORRELATIVO,
									              FAC_DET_CONTA,
									              FAC_DET_CONCEP,
									              FAC_DET_IMPORTE,
					                              FAC_DET_FECHA,
									              FAC_DET_ESTADO,
					                              FAC_DET_USR_ALTA,
									              FAC_DET_FCH_HR_ALTA,
                                                  FAC_DET_USR_BAJA,
                                                  FAC_DET_FCH_HR_BAJA
                                                  ) values (32,
									              $nfactura,
											      '$cta_ctbg',
											      '1',
											      $iva,
											      '$fec1',
											      1,
											      '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
           $resultado = mysql_query($consulta);

           $consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                                  FAC_DET_CORRELATIVO,
							        		      FAC_DET_CONTA,
									              FAC_DET_CONCEP,
									              FAC_DET_IMPORTE,
					                              FAC_DET_FECHA,
									              FAC_DET_ESTADO,
					                              FAC_DET_USR_ALTA,
									              FAC_DET_FCH_HR_ALTA,
                                                  FAC_DET_USR_BAJA,
                                                  FAC_DET_FCH_HR_BAJA
                                                  ) values (32,
									                        $nfactura,
											                '24204102',
											                '2',
											                $iva,
											                '$fec1',
											                1,
											                '$log_usr',
												            null,
												            null,
												            '0000-00-00 00:00:00')";
           $resultado = mysql_query($consulta);


           $imp_int = $_SESSION['penal'];
           $consulta = "insert into factura_tran (FAC_TRA_FACTURA, 
                                                  FAC_TRA_MODULO,
									              FAC_TRA_DESCRI,
									              FAC_TRA_IMPO,
									              FAC_TRA_FECHA,
					                              FAC_TRA_ESTADO,
									              FAC_TRA_USR_ALTA,
					                              FAC_TRA_FCH_HR_ALTA,
									              FAC_TRA_USR_BAJA,
                                                  FAC_TRA_FCH_HR_BAJA
                                                  ) values ($nfactura,
											      6000,
											      '$descrip',
											      $imp_int,
											      '$fec1',
											      1,
											      '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
            $resultado = mysql_query($consulta);
 }
 
 
 
 
 
 	?>
</table>	  
 </center>
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