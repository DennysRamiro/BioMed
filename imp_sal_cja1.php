<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
	require('funciones2.php');
	include('header_3.php');
?>
<html>
<head>
<link href="../financiera/css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="../financiera/css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<?php
		//		include("header.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
				<br><br>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>
<br><br>
<center>
<font  size="+1">
<?php
if(isset($_SESSION['fec_proc'])){ 
   $fec = $_SESSION['fec_proc']; 
   $fec1 = cambiaf_a_mysql_2($fec);
 }
 		
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
?>
<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo $_SESSION['MON_AGENCIA']; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(90); ?></th> 
   </tr>	
	<tr>
	    <td align="left" style="font-size:12px"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cbte.Caja"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tra']; ?></th> 
	</tr>	
	
	</table>
	<br>
	<font size="+2">
<table border="0" width="900">
	<tr>
	    <th align="left" style="font-size:26px"><?php echo encadenar(19)."Saldo Inicial Caja"; ?> </th> 	
   </tr>	
</table>
<?php
//echo "Saldo Inicial Caja";
?>
</font>
<font size="+1">

</font>
 <?php
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   if (isset($_SESSION['c_agen'])){
   $c_agen = $_SESSION['c_agen'];
    }
	if (isset($_SESSION['descrip'])){
   $descrip = $_SESSION['descrip'];
   }
   $deb_hab = 2;
   $tipo = 2;
?>
<br>
<table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Cajero"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombres']; ?></th> 
		<th align="left"><?php echo encadenar(10); ?></th>  
	   	<td align="left"><?php echo encadenar(10); ?></th> 
		 
			
    </tr>	
</table>
 <br>
 <table border="0" width="900">
  <tr>
	
	 <tr>
       	<tr>
	    <th align="left"><?php echo "Bolivianos"; ?> </th> 
		<th align="right"><?php echo number_format($_SESSION['saldo'], 2, '.',','); ?></th>
		
   </tr>
	 <tr>
       	<tr>
	    <th align="left"><?php echo "Dolares"; ?> </th> 
		<th align="right"><?php echo number_format($_SESSION['saldo2'], 2, '.',','); ?></th>
		
   </tr>
	
	
     </tr>
	  <tr>
	 <th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="left"><?php echo encadenar(1); ?></th> 
		 <th align="left"><?php echo encadenar(8); ?> </th>
		<th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="left"><?php echo encadenar(1); ?></th>   
		</tr>
	 
	
		
      </table>

</center>
<?php
	    $mon_des = f_literal($_SESSION['saldo'],1);
		$mon_des2 = f_literal($_SESSION['saldo2'],1);
	 ?>
	 <table border="0" width="900"> 
	<tr>
	    <th align="left"><?php echo encadenar(5).$mon_des.encadenar(3)."Bs."; ?> </th> 
		<th align="right"><?php echo encadenar(5); ?></th>
	 </tr>
    <tr>	
		
		<th align="left"><?php echo encadenar(5).$mon_des2.encadenar(3)."Dol."; ?> </th> 
		<th align="right"><?php echo encadenar(5); ?></th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		
	 </tr>
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		
	 </tr>
	
   <tr>
	    <th align="left"><?php  echo encadenar(45)."_____________________"; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
	</tr>	
    <tr>
	    <th align="left"><?php  echo encadenar(60),"CAJERO"; ?> </th> 
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

	</center> 
   </div>
    <font size="-1">
  <?php
		 	include("footer_in.php");
		 ?>
		</font> 
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>