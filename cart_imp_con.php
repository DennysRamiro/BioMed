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
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>

	<?php
		//		include("header.php");
			?>
            

				<?php
				     $_SESSION['nom_grp'] = "";
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
		  }
		  $ncre = $_SESSION['ncre'];
	$con_car  = "Select CART_COD_GRUPO From cart_maestro where CART_NRO_CRED = $ncre and CART_MAE_USR_BAJA is null"; 
    $res_car = mysql_query($con_car);
   while ($lin_car = mysql_fetch_array($res_car)) { // 5 a
    	  $c_grup = $lin_car['CART_COD_GRUPO'];
		 if ($c_grup > 0){		
		  $con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
          $res_grp = mysql_query($con_grp);
	      while ($lin_grp = mysql_fetch_array($res_grp)) {
	             $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
				 $_SESSION['nom_grp'] = $nom_grp;
		      }	
			} 
	}	  
		  
		  
		  
		  
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cred_cobros_2.php'>Salir</a>
 </div>
           
</center>
<font  size="+2">
<form name="form2" method="post" action="cobro_retro_opd_2.php" style="" onSubmit="return" >
<?php
echo encadenar(20)."CONDONACION".encadenar(60)."CONDONACION"; 
?>	
</font>
<?php //if (isset($_SESSION['monto_com'])){
      //   }else{
	//	 $_SESSION['monto_com'] = 0;
	//	 }
// echo  encadenar(10)."BOLETA DE PAGO EN".encadenar(2).$_SESSION['des_mon'] ; ?>

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
		<th align="left"><?php echo "Doc. Condonacion"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tran']; ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Doc. Condonacion"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tran']; ?></th>     
			
    </tr>	
	
	</table>
	</center>
<table border="0" width="1000">
 <tr>
	    <th align="left"><?php echo "Nro.Operacion"; ?> </th> 
		<th align="left"><?php echo $_SESSION['ncre']; ?></th> 
		<th align="left"><?php echo encadenar(10); ?></th> 
		<th align="right"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(21); ?></th>  
		<th align="left"><?php echo "Nro.Operacion"; ?> </th> 
		<th align="left"><?php echo  $_SESSION['ncre']; ?></th> 
		<th align="left"><?php echo encadenar(10); ?></th> 
		<th align="right"><?php echo encadenar(10); ?></th>
			
    </tr>	
 	</table> 	
 <table border="0" width="1000">
	 <?php
	//if (isset($_SESSION['nom_grp'])){ 
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
   	<?php //}
       	}else{  ?> 
  <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
		<th align="left"><?php echo "Cliente"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th>     
   </tr>
   <?php } 
  // } ?> 
   	</table> 
      

<table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Montos Condonados"; ?> </th> 
		
		<th align="center"><?php echo encadenar(25); ?></th>
		<th align="left"><?php echo "Montos Condonados"; ?></th>
		
   </tr>	
</table>
	

</font>
 <table border="0" width="900">
 <?php
	if (isset($_SESSION['cond_id'])){ 
	 
	?> 
    <tr>
	    <th align="left"><?php echo "Detalle"; ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Devengado"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_id'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(38); ?></td>
		<th align="left"><?php echo "Detalle"; ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Devengado"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_id'], 2, '.',','); ?></td>
     </tr>
	 <?php }else{
	       $_SESSION['cond_id'] = 0;
		   }?>
   <?php
	if (isset($_SESSION['cond_i'])){ 
	 
	?> 
    <tr>
	    <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Corriente"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_i'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(38); ?></td>
		<th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Corriente"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_i'], 2, '.',','); ?></td>
     </tr>
	 <?php }else{
	       $_SESSION['cond_i'] = 0;
		   }?>
	 <?php
	if (isset($_SESSION['cond_im'])){ 
	 
	?> 
    <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Vencido"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_im'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Vencido"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_im'], 2, '.',','); ?></td>
     </tr>
		
	<?php }else{
	       $_SESSION['cond_im'] = 0;
		   }?>
	   <?php
	if (isset($_SESSION['cond_pe'])){ 
	 
	?> 
    <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Penal"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_pe'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Penal"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_pe'], 2, '.',','); ?></td>
     </tr>
		
	<?php }else{
	       $_SESSION['cond_pe'] = 0;
		   }?>
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Total"; ?></th>
		<th align="right"><?php echo number_format( $_SESSION['cond_i'] +
		                                            $_SESSION['cond_id'] +
													$_SESSION['cond_pe'] +
		                                            $_SESSION['cond_im'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		 <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Total"; ?></th>
		<th align="right"><?php echo number_format( $_SESSION['cond_i'] +
		                                            $_SESSION['cond_id'] +
													$_SESSION['cond_pe'] +
		                                            $_SESSION['cond_im'], 2, '.',','); ?></td>										  
     </tr>
</table>
 
<table border="0" width="1100">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
		 <td align="right"><?php echo encadenar(5); ?></td>
        <th align="center"><?php echo "_______________"; ?></th>
		<th align="center"><?php echo encadenar(5); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(40); ?></th>
		 <th align="left"><?php echo encadenar(5); ?></th>
		 <td align="right"><?php echo encadenar(5); ?></td>
        <th align="center"><?php echo "_______________"; ?></th>
		<th align="center"><?php echo encadenar(5); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
		 <td align="right"><?php echo encadenar(5); ?></td>
         <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
		 <td align="right"><?php echo encadenar(5); ?></td>
         <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		 <th align="center"><?php echo encadenar(5); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
    </table>
  <table border="0" width="900">  
    
    <tr>
	    <th align="left" style="font-size:11px">
		<?php echo $_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		 <th align="left" style="font-size:11px">
		 <?php echo $_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
  <br>
  
  
  </center>
 
	 
</div>
  <?php
		//	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>