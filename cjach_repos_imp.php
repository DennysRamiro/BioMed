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
					 $c_agen = $_SESSION['COD_AGENCIA']; 
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
	    <a href='cjach_selec_2.php'>Salir</a>
  </div>


<?php
//echo encadenar(62). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
?>
 <?php


$nro_rep = leer_nro_rep_cjach();
$cod_cja =  $_SESSION['cod_cja'];

//$cod_mon = $_SESSION['val_bs_sus'];




	$descrip = "SOLICITUD ASIGNACION FONDOS CAJA CHICA";
	
	$_SESSION['descrip'] = $descrip;

$monto = $_SESSION['monto'];

$con_usr  = "Select * From gral_usuario where GRAL_USR_ESTADO = 1 and GRAL_USR_LOGIN = '$log_usr'													   and GRAL_USR_USR_BAJA is null";
$res_usr = mysql_query($con_usr);
 while ($lin_usr = mysql_fetch_array($res_usr)) {
 $nom_func = $lin_usr['GRAL_USR_NOMBRES'].encadenar(1).
			 $lin_usr['GRAL_USR_AP_PATERNO'].encadenar(1).
			 $lin_usr['GRAL_USR_AP_MATERNO'];
 	$_SESSION['nom_func'] = $nom_func;	 

}
	 
 
?>
<center><br>
<font  size="+2">
<?php
if ($_SESSION['EMPRESA_TIPO'] == 2){
echo encadenar(3)."SOLICITUD FONDO CAJA CHICA".encadenar(30)."SOLICITUD FONDOS CAJA CHICA"; 
?>
         
</center>

</font>
<br><br>
</center>
<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(42); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Repos."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_rep; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Repos."; ?></th>  
		<th align="right"><?php echo encadenar(5).$nro_rep; ?></th>     
			
    </tr>	
	
	</table>
	<br><br>
	<table border="0" width="900">
  <tr>
	    <th align="left"><?php echo "Importe".encadenar(5); ?> </th> 
		<th align="right"><?php echo number_format($_SESSION['monto'] , 2, '.',','); ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(45); ?> </th>
		<th align="left"><?php echo "Importe".encadenar(5); ?> </th> 
		<th align="right"><?php echo number_format($_SESSION['monto'] , 2, '.',','); ?></th>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<td align="left"><?php echo encadenar(3); ?></th>    
   </tr>
   </table>
<?php
 if ($_SESSION['monto'] < 0){
   	$mon_des = f_literal($_SESSION['monto'] * -1,1);
	}else{
	$mon_des = f_literal($_SESSION['monto'],1);
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
	    <th align="left"><?php echo $mon_des.encadenar(3)."Bs."; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(40); ?> </th>  
		<th align="left"><?php echo $mon_des.encadenar(3)."Bs."; ?> </th> 
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

 <?php
  }
 //Prodesarrollo 
  if ($_SESSION['EMPRESA_TIPO'] == 1){
echo encadenar(5)."RECIBO POR RENDIR".encadenar(1).$_SESSION['des_mon'].encadenar(95); 
?>
         
</center>

</font>
<br><br>
</center>
<table border="0" width="450">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
   </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Vale"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_val; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		   
			
    </tr>	
	
	</table>
	<br><br>
	<table border="0" width="450">
  <tr>
	    <th align="left"><?php echo "Importe".encadenar(5); ?> </th> 
		<th align="right"><?php echo number_format($_SESSION['monto_t'] , 2, '.',','); ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(25); ?> </th>
		    
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
	 <table border="0" width="450"> 
	  <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(20); ?></th>
		
	 </tr>
	<tr>
	    <th align="left"><?php echo $mon_des.encadenar(3).$_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(20); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	</table>	
<table border="0" width="450">	 
     <tr>
	    <th align="left"><?php echo "Funcionario"; ?> </th> 
		<th align="left"><?php echo $_SESSION['nom_func']; ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
	 </tr>
	 <tr>
	    <th align="left"><?php echo "Detalle"; ?> </th> 
		<th align="left"><?php echo $_SESSION['descrip']; ?></th>
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

$consulta = "insert into cjach_asignacion (CJCH_ASIN_NRO, 
                                    CJCH_ASIN_CAJA,
									CJCH_ASIN_AGEN,
									CJCH_ASIN_FUNC,
									CJCH_ASIN_SOLIC,
									CJCH_ASIN_ASIG,
									CJCH_ASIN_FECHA,
									CJCH_ASIN_FEC_S,
									CJCH_ASIN_FEC_A,
									CJCH_ASIN_NRO_ASIG,
									CJCH_ASIN_ESTADO,
   				                    CJCH_ASIN_USR_ALTA,
                                    CJCH_ASIN_FCH_HR_ALTA,
									CJCH_ASIN_USR_BAJA,
									CJCH_ASIN_FCH_HR_BAJA
									) values ($nro_rep,
									          $cod_cja,
											  $c_agen,
											  '$log_usr',
											   $monto,
											   0,
											   '$fec1',
											    '$fec1',
												null,
												0,
												1,
											   '$log_usr',
											    null,
												null,
												'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar : cjach_reposicion ' . mysql_error());

//Actualiza estado de caja chica
echo $cod_cja ;
$consulta  = "update cjach_cntrl set CJCH_CTRL_ESTADO = 2  where CJCH_CTRL_NRO = $cod_cja 
              and CJCH_CTRL_ESTADO = 1 and CJCH_CTRL_USR_BAJA is null";

$resultado = mysql_query($consulta)or die('No pudo actualizar : cjach_reposicion ' . mysql_error());



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