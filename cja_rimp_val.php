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
				//include("header_2.php");
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
	    <a href='cja_reimpre.php'>Salir</a>
  </div>


<?php
//echo encadenar(62). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
?>
 <?php
if(isset($_POST['nro_tra'])){
   $quecom = $_POST['nro_tra'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $nro_tra = $_POST['nro_tra'];
	   }
    }
 }
  $nro_val = $nro_tra;
  
  $con_car  = "Select * from  caja_vale
             where CAJA_VAL_FECHA = '$fec1' and
			   	   CAJA_VAL_NRO = $nro_val
             and CAJA_VAL_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			    $cod_func = $lin_car['CAJA_VAL_FUNC'];
			    $_SESSION['cod_func'] =  $cod_func;
				$descrip = $lin_car['CAJA_VAL_DESCRIP'];
				$_SESSION['descrip'] = $descrip;
			    $monto_t = $lin_car['CAJA_VAL_IMPO'];
                $_SESSION['monto_t'] =  $monto_t;
				$cod_mon = $lin_car['CAJA_VAL_MON'];
				$_SESSION['cod_mon'] =  $cod_mon;
             }
//$nro_val = leer_nro_val_cja($log_usr);
//$cod_func = $_POST['cod_cta'];
//c_agen = $_POST['cod_agencia'];
//$_SESSION['cod_func'] =  $cod_func;
//$cod_mon = $_SESSION['val_bs_sus'];
//$_SESSION['cod_mon'] =  $cod_mon;
//$fec1 = $_SESSION['fec1'];


/*if ($_POST['descrip'] <> ""){  
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['descrip'] = $descrip;
	}

if ($_POST['egr_monto'] <> 0){  
   $monto_t = $_POST['egr_monto'];
   $_SESSION['monto_t'] =  $monto_t;
  } */
$con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $cod_mon  ";
$res_mon = mysql_query($con_mon);
while ($linea = mysql_fetch_array($res_mon)) {
    $_SESSION['des_mon'] = $linea['GRAL_PAR_INT_DESC'];
	$s_mon = $linea['GRAL_PAR_INT_SIGLA'];
}
$con_usr  = "Select * From gral_usuario where GRAL_USR_ESTADO = 1 and GRAL_USR_LOGIN = '$cod_func'													   and GRAL_USR_USR_BAJA is null";
$res_usr = mysql_query($con_usr);
 while ($lin_usr = mysql_fetch_array($res_usr)) {
 $nom_func = $lin_usr['GRAL_USR_NOMBRES'].encadenar(1).
			 $lin_usr['GRAL_USR_AP_PATERNO'].encadenar(1).
			 $lin_usr['GRAL_USR_AP_MATERNO'];
 	$_SESSION['nom_func'] = $nom_func;	 

}
	 
  //  echo "Vale  en ".encadenar(2).$_SESSION['des_mon'];
 //   echo encadenar(112). "Nro. Tran. ".encadenar(2).$nro_val;
   // echo "aqui".$c_agen.$nro_tr_caj,$descrip,$monto_t,$cta_ctbg ;
?>
<center><br>
<font  size="+2">
<?php
if ($_SESSION['EMPRESA_TIPO'] == 2){
echo encadenar(3)."RECIBO POR RENDIR".encadenar(1).$_SESSION['des_mon'].encadenar(30)."RECIBO POR RENDIR".encadenar(1).$_SESSION['des_mon']; 
?>
         
</center>

</font>
<br><br>
</center>
<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "La Paz"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(42); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "La Paz"; ?></th>  
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
		<th align="left"><?php echo "Cochabamba"; ?></th>  
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
/*
$consulta = "insert into caja_vale (CAJA_VAL_TIPO, 
                                    CAJA_VAL_AGEN,
									CAJA_VAL_FUNC,
									CAJA_VAL_NRO,
									CAJA_VAL_MON,
					                CAJA_VAL_IMPO,
					                CAJA_VAL_FECHA,
									CAJA_VAL_DESCRIP,
   				                    CAJA_VAL_USR_ALTA,
                                    CAJA_VAL_FCH_HR_ALTA,
									CAJA_VAL_USR_BAJA,
									CAJA_VAL_FCH_HR_BAJA
									) values (1,
									          $c_agen,
											  '$cod_func',
											   $nro_val,
											   $cod_mon,
											   $monto_t,
											   '$fec1',
											   '$descrip',
											   '$log_usr',
											    null,
												null,
												'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
*/

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