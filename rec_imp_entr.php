<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
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
	<div id="cuerpoModulo">
	<?php
				include("header_2.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc'];
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					  $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
					 
					 
					 
					 
					 
					 
					 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='con_mant_rec.php'>Salir</a>
  </div>


<?php
//echo encadenar(62). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
?>
 <?php
$cod_func = $_SESSION['cod_ase'];
$con_usr  = "Select * From gral_usuario where GRAL_USR_ESTADO = 1 and GRAL_USR_LOGIN = '$cod_func'													   and GRAL_USR_USR_BAJA is null";
$res_usr = mysql_query($con_usr);
 while ($lin_usr = mysql_fetch_array($res_usr)) {
 $nom_func = $lin_usr['GRAL_USR_NOMBRES'].encadenar(1).
			 $lin_usr['GRAL_USR_AP_PATERNO'].encadenar(1).
			 $lin_usr['GRAL_USR_AP_MATERNO'];
 	$_SESSION['nom_func'] = $nom_func;	 

}

?>
<center>
<font  size="+2">
<?php
if ($_SESSION['EMPRESA_TIPO'] == 1){
echo encadenar(5)."RECIBO POR RENDIR".encadenar(1).$_SESSION['des_mon'].encadenar(45)."RECIBO POR RENDIR".encadenar(1).$_SESSION['des_mon']; 
?>
         
</center>

</font>
<br><br>
</center>
<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(42); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Vale"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_val; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Vale"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_val; ?></th>     
			
    </tr>	
	
	</table>
	<br><br>
	<table border="0" width="900">
  <tr>
	    <th align="left"><?php echo "Importe".encadenar(5); ?> </th> 
		<th align="right"><?php echo number_format($_SESSION['monto_t'] , 2, '.',','); ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(45); ?> </th>
		<th align="left"><?php echo "Importe".encadenar(5); ?> </th> 
		<th align="right"><?php echo number_format($_SESSION['monto_t'] , 2, '.',','); ?></th>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<td align="left"><?php echo encadenar(3); ?></th>    
   </tr>
   </table>
<?php
 if ($_SESSION['monto_t'] < 0){
   	$mon_des = f_literal($_SESSION['monto_t'] * -1,1);
	}else{
	$mon_des = f_literal($_SESSION['monto_t'],1);
	}
//	 echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
	 ?>	
	 <table border="0" width="900"> 
	  <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(40); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	<tr>
	    <th align="left"><?php echo $mon_des.encadenar(3).$_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(40); ?> </th>  
		<th align="left"><?php echo $mon_des.encadenar(3).$_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	</table>	
<table border="0" width="900">	 
     <tr>
	    <th align="left"><?php echo "Funcionario"; ?> </th> 
		<th align="left"><?php echo $_SESSION['nom_func']; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		<th align="left"><?php echo "Funcionario"; ?> </th> 
		<th align="left"><?php echo $_SESSION['nom_func']; ?></th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	 <tr>
	    <th align="left"><?php echo "Detalle"; ?> </th> 
		<th align="left"><?php echo $_SESSION['descrip']; ?></th>
		<th align="left"><?php echo encadenar(45); ?> </th>  
		<th align="left"><?php echo "Detalle"; ?> </th> 
		<th align="left"><?php echo $_SESSION['descrip']; ?></th> 
   </tr>
  
	</table>
	<br>	
<table border="0" width="900">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(10); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(10); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(10); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(10); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
</center>
 <?php
  }
 //Prodesarrollo 
  if ($_SESSION['EMPRESA_TIPO'] == 2){
//echo encadenar(2)."ENTREGA RECIBOS".encadenar(1); 
?>
         


</font>
<br><br>
</center>
                      ENTREGA RECIBOS 
</center>
<br><br>					  
<table border="0" width="250">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
   </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo ""; ?></th>  
	   	<th align="right"><?php echo ""; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		   
			
    </tr>	
	
	</table>
	<br><br>
	<table border="0" width="450">
  <tr>
	    <th align="left"><?php echo "Responsable".encadenar(5); ?> </th> 
		<th align="right"><?php echo $_SESSION['nom_func']; ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(25); ?> </th>
		    
   </tr>
    <tr>
	    <th align="left"><?php echo "Nro. Desde".encadenar(5); ?> </th> 
		<th align="right"><?php echo $_SESSION['nro_rec1']; ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(25); ?> </th>
		    
   </tr>
   
    <tr>
	    <th align="left"><?php echo "Nro. Hasta".encadenar(5); ?> </th> 
		<th align="right"><?php echo $_SESSION['nro_rec2']; ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(25); ?> </th>
		    
   </tr>
   
   
   
   
   </table>

 
	<br>	
<table border="0" width="450">	 
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
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(10); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(10); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		
	 </tr>

  </table>

 <?php
  }
  ?>
  <br>
 <?php
  
 // echo encadenar(12)."INTERESADO", encadenar(40),"     CAJERO";
  ?>	
  <br><br>
  <br><br>
 <?php


	?>
	
<?php
	
//header('Location: menu_s.php');	
?>

  <?php //} ?>
	 
</div>
  <?php
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>