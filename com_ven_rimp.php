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
		//	include("header_2.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc'];
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cja_reimpre.php'>Salir</a>
  </div>
           
<center>

<?php
if(isset($_SESSION['fec_proc'])){ 
   $fec = $_SESSION['fec_proc']; 
   $fec1 = cambiaf_a_mysql_2($fec);
 }		
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp)or die('No pudo seleccionarse tabla gral_empresa');
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
$apli = 10000;
//$tipo = $_SESSION['c_com_ven'];	
//Recupera la transaccion para reimprimir		  
if(isset($_POST['nro_tra'])){
   $quecom = $_POST['nro_tra'];
 //  echo "...".$quecom."---";
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $nro_tra = $_POST['nro_tra'];
	      }
   }
   $tipo = substr($nro_tra,0,1);
   $tran = substr($nro_tra,1,3);
  }
   if ($tipo == 1){
       $des_tran = "Compra de Divisas ";
	   }	
   if ($tipo == 2){
       $des_tran = "Venta de Divisas";
       }
  $_SESSION['des_tran'] = $des_tran;
  $_SESSION['c_com_ven'] = $tipo;
   if ($_SESSION['c_com_ven'] == 1){
       $con_car  = "Select * from  caja_com_ven
             where caja_comven_fecha = '$fec1' and
			 caja_comven_tipo = $tipo and
			 caja_comven_corr = $tran and
			 caja_comven_debhab = 1 and
			 substring(caja_comven_cta,1,1)='1'
             and caja_comven_usr_baja is null"; 
	}else{
	   $con_car  = "Select * from  caja_com_ven
             where caja_comven_fecha = '$fec1' and
			 caja_comven_tipo = $tipo and
			 caja_comven_corr = $tran and
			 caja_comven_debhab = 2 and
			 substring(caja_comven_cta,1,1)='1'
             and caja_comven_usr_baja is null"; 
	
	}		 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			       $nro_tr_comven = $tran;
			       
			       $_SESSION['tc_com'] = $lin_car['caja_comven_tc'];
				   $_SESSION['cta_ctus'] = $lin_car['caja_comven_cta'];
				   $_SESSION['des_quien'] = $lin_car['caja_comven_descrip'];
				    if ($_SESSION['c_com_ven'] == 1){
                        $descrip = "Compra de Divisas";
                    	$cta_ctb = $_SESSION['cta_ctus'];
	                    $imp_or = $lin_car['caja_comven_impo_e'];
						$con_car1  = "Select caja_comven_impo from  caja_com_ven
                                      where caja_comven_fecha = '$fec1' and
			                          caja_comven_tipo = $tipo and
			                          caja_comven_corr = $tran and
			                          caja_comven_debhab = 2 and
									  substring(caja_comven_cta,1,1)='1'
                                      and caja_comven_usr_baja is null"; 
                        $res_car1 = mysql_query($con_car1);
                        while ($lin_car1 = mysql_fetch_array($res_car1)) {
						       $importe = $lin_car1['caja_comven_impo'];
	                    }   
					}                 
	                if ($_SESSION['c_com_ven'] == 2){
                        $descrip = "Venta de Divisas";
	                    $cta_ctb = $_SESSION['cta_ctus'];
	                    $imp_or = $lin_car['caja_comven_impo_e'];
						//echo $imp_or."AQUII".$tipo;
						$con_car1  = "Select caja_comven_impo from  caja_com_ven
                                      where caja_comven_fecha = '$fec1' and
			                          caja_comven_tipo = $tipo and
			                          caja_comven_corr = $tran and
			                          caja_comven_debhab = 1 and
									  substring(caja_comven_cta,1,1)='1'
                                      and caja_comven_usr_baja is null"; 
                        $res_car1 = mysql_query($con_car1);
                        while ($lin_car1 = mysql_fetch_array($res_car1)) {
						       $importe = $lin_car1['caja_comven_impo'];
	                    }   
	  } 
				   
                   
             }
?>
<strong><font  size="+2">
<?php
if ($_SESSION['EMPRESA_TIPO'] == 2){
echo encadenar(5)."Recibo de".encadenar(1).$_SESSION['des_tran'].encadenar(35)."Recibo de".encadenar(1).$_SESSION['des_tran']; 
?>
</font></strong>
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
		<th align="left"><?php echo "Cte Com/Ven Div."; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_comven; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Com/Ven Div."; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_comven; ?></th>     
			
    </tr>	
	
	</table>
	
	<br>
	
<br>
 <?php
//if ($_SESSION['detalle'] == 3){
   $s_mon = "Bs.";
   $apli = 10000;
   $tc_ctb = $_SESSION['tc_com'];
   $c_agen = $_SESSION['COD_AGENCIA'];
  
	   $desc_det = $_SESSION['des_quien'];

    $mon_des = f_literal($importe,1);
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
	 ?>		


 <?php if ($_SESSION['c_com_ven'] == 1){   ?> 
  <table border="0" width="900">
  <tr>
	    <th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="right"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(55); ?> </th>
		<th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="right"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<td align="left"><?php echo encadenar(3); ?></th>    
   </tr>
   </table>
    <table border="0" width="900">
    <tr>
	    <th align="left"><?php echo "Entregado"; ?> </th> 
		<th align="right"><?php echo number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo  encadenar(1)."Bs."; ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo "Entregado"; ?> </th> 
		<th align="right"><?php echo number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo  encadenar(1)."Bs."; ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="left"><?php echo encadenar(3); ?></th>    
   </tr>
    </table>
  <?php } ?> 	
  <?php if ($_SESSION['c_com_ven'] == 2){  ?>
   <table border="0" width="900">
  <tr>
	    <th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="right"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(53); ?> </th>
		<th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="right"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		
   </tr>
    </table>
    <table border="0" width="900">
   <tr>
	    <th align="left"><?php echo "Recibido"; ?> </th> 
		<th align="right"><?php echo  number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Bs."; ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo "Recibido"; ?> </th> 
		<th align="right"><?php echo  number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Bs."; ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
	  </tr>
    </table>
  <?php } ?> 
  <br>
  	<table border="0" width="900">
    
   <tr>
	    <th align="left"><?php echo  $desc_det ; ?> </th> 
		
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo $desc_det ; ?> </th> 
		
   </tr>
  
   </table>
   <br>
<table border="0" width="900"> 
	<tr>
	    <th align="left" style="font-size:10px"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(40); ?> </th>  
		<th align="left" style="font-size:10px"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
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
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
  </center>
 <?php
 }
 
 //Prodesarrollo
 if ($_SESSION['EMPRESA_TIPO'] == 1){
echo "Recibo de".encadenar(1).$_SESSION['des_tran'].encadenar(95); 
?>
</font></strong>
</center>
<table border="0" width="450">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(32); ?></th>
   </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cte Com/Ven Div."; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_comven; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		    
			
    </tr>	
	
	</table>
	
	<br>
	
<br>
 <?php
//if ($_SESSION['detalle'] == 3){
   $s_mon = "Bs.";
   $apli = 10000;
   $tc_ctb = $_SESSION['tc_com'];
   $c_agen = $_SESSION['COD_AGENCIA'];
   if ($_SESSION['c_com_ven'] == 1){
      $descrip = "Compra de Divisas";
      $importe = round($_SESSION['monto_com'],2);
      $imp_or = $_SESSION['imp_sus'];
	  $cta_ctb = $_SESSION['cta_ctus'];
	 
	  }
	if ($_SESSION['c_com_ven'] == 2){
      $descrip = "Venta de Divisas";
	 // $desc_det $_SESSION['descrip'];
      $importe = round($_SESSION['monto_ven'],2);
      $imp_or = $_SESSION['imp_sus'];
	  $cta_ctb = $_SESSION['cta_ctbs'];
	  } 
	   $desc_det = strtoupper($_SESSION['des_quien']);

    $mon_des = f_literal($importe,1);
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
	 ?>		


 <?php if ($_SESSION['c_com_ven'] == 1){  ?> 
  <table border="0" width="450">
  <tr>
	    <th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="right"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(35); ?> </th>
		   
   </tr>
   </table>
    <table border="0" width="450">
    <tr>
	    <th align="left"><?php echo "Entregado"; ?> </th> 
		<th align="right"><?php echo number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo  encadenar(1)."Bs."; ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>
		   
   </tr>
    </table>
  <?php } ?> 	
  <?php if ($_SESSION['c_com_ven'] == 2){  ?>
   <table border="0" width="450">
  <tr>
	    <th align="left"><?php echo $descrip.encadenar(1)."de"; ?> </th> 
		<th align="right"><?php echo number_format($imp_or, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Dol.".encadenar(1)."T.C.".encadenar(1); ?></th> 
		<th align="center"><?php echo number_format($tc_ctb, 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(33); ?> </th>
		
		
   </tr>
    </table>
    <table border="0" width="450">
   <tr>
	    <th align="left"><?php echo "Recibido"; ?> </th> 
		<th align="right"><?php echo  number_format($importe, 2, '.',','); ?></th>
		<td align="left"><?php echo encadenar(1)."Bs."; ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>
		
	  </tr>
    </table>
  <?php } ?> 
  <br>
  	<table border="0" width="450">
    
   <tr>
	    <th align="left"><?php echo  $desc_det ; ?> </th> 
		
		<th align="center"><?php echo encadenar(20); ?></th>
		
		
   </tr>
  
   </table>
   <br>
<table border="0" width="450"> 
	<tr>
	    <th align="left" style="font-size:9px"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
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
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		
	 </tr>

  </table>
 <?php
 }
 
 
 
 
 /*if ($_SESSION['c_com_ven'] == 1){
      $descrip = $desc_det;
      $importe = $_SESSION['monto_com'] * - 1;
      $imp_or = $_SESSION['imp_sus'];
	  $cta_ctb = $_SESSION['cta_ctus'];
	  }
	if ($_SESSION['c_com_ven'] == 2){
      $descrip = $desc_det;
      $importe = $_SESSION['monto_ven'];
      $imp_or = $_SESSION['imp_sus'] * -1;
	  $cta_ctb = $_SESSION['cta_ctus'];
	  }  
//  echo $nro_tr_caj.$c_agen.$c_agen.$fec1.$log_usr.$nro_tr_caj.$log_usr.$cta_ctb.
//												 $importe.$imp_or.$tc_ctb.$descrip.$log_usr;					 		 
/* $consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $c_agen,
												 $c_agen,
												 0,
												 '$fec1',
												 '$log_usr',
												 $tipo,
												 14,
												 $nro_tr_caj,
												 $nro_tr_comven,
												 0,
												 '$log_usr',
												 14000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe,
										         $imp_or,
												 1,
												 $tc_ctb,
												 '$descrip',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());
*/
//Correlativo de compra venta
/*$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);	
if ($_SESSION['EMPRESA_TIPO'] == 2){
?>
 <table border="0" width="900">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(20).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(20).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
<?php 
}
//Prodesarrollo
if ($_SESSION['EMPRESA_TIPO'] == 1){
?>
 <table border="0" width="450">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(25); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(20).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(20); ?> </th>  
		 
   </tr>
</table>
<?php 
}	
/*$nro_tr_comven = leer_nro_co_comven($tipo);
$cta_ctbs = $_SESSION['cta_ctbs'];
$cta_ctus =	$_SESSION['cta_ctus'];
if (isset($_SESSION['monto_com'])){
    $monto_com = $_SESSION['monto_com'];
}
if(isset($_SESSION['monto_ven'])){
   $monto_ven = $_SESSION['monto_ven'];
}
$monto_ctb = $_SESSION['monto_ctb'];
$dif_tc = $_SESSION['dif_tc'];
$cta_dtc = $_SESSION['cta_dtc'];
if(isset($_SESSION['imp_bs'])){
   $imp_bs = $_SESSION['imp_bs'];
   }
$imp_sus = $_SESSION['imp_sus'];
if (isset($_SESSION['descrip'])){
   $descrip = $_SESSION['descrip'];
   }else{
   $descrip = "-";
   }
if ($_SESSION['c_com_ven'] == 1){
   $deb_hsus = 1;
   $deb_hbs = 2;
   $deb_hdif = 1;
   if (substr($cta_dtc,0,1) == 5){
       $deb_hdif = 2;
   
   }
   $tipo = 1; 
   $mon = 2;
   $importe = $monto_ctb;
   $impo_eq = $imp_sus;
   }else{
   $deb_hsus = 2;
   $deb_hbs = 1;
   
   $deb_hdif = 2;
   $importe = $monto_ctb;
   $impo_eq = $imp_sus;
   if (substr($cta_dtc,0,1) == 4){
    $deb_hdif = 1;
	
	
   }
   $tipo = 2;
   $mon = 2;
   
}
 //echo $nro_tr_comven." ".$nro_tr_caj." ".$c_agen." ".$deb_hsus." ".$cta_ctus." ".$tipo." ".$fec1." ".$descrip." ".$mon." ".$importe." ".$impo_eq;
$consulta = "insert into caja_com_ven(caja_comven_corr, 
	                                   caja_comven_corr_cja,
                                       caja_comven_agen,
									   caja_comven_debhab,
									   caja_comven_cta,
									   caja_comven_tipo,
					                   caja_comven_fecha,
					                   caja_comven_descrip,
   				                       caja_comven_mon, 
									   caja_comven_impo, 
									   caja_comven_impo_e,
									   caja_comven_contab,
									   caja_comven_tc,
									   caja_comven_usr_alta,
                                       caja_comven_fch_hra_alta,
                                       caja_comven_usr_baja,
                                       caja_comven_fch_hra_baja
                                       ) values ($nro_tr_comven,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hsus,
												 '$cta_ctus',
												 $tipo,
												 '$fec1',
												 '$desc_det',
												  $mon,
												  $importe,
												  $impo_eq,
												  2,
												  $tc_ctb,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_com_ven  1: ' . mysql_error()); 
if ($_SESSION['c_com_ven'] == 1){
   $deb_hab = 2;
   $mon = 1;
   $importe = $monto_com;
   $impo_eq = $monto_com;
   }else{
   $deb_hab = 1;
   $mon = 1;
   $importe = $monto_ven;
   $impo_eq = $monto_ven;
 }
// echo $nro_tr_comven.$nro_tr_caj.$c_agen.$deb_hbs.$cta_ctbs.$tipo.$fec1.$descrip.$mon.$importe.$impo_eq;
 
$consulta = "insert into caja_com_ven(caja_comven_corr, 
	                                   caja_comven_corr_cja,
                                       caja_comven_agen,
									   caja_comven_debhab,
									   caja_comven_cta,
									   caja_comven_tipo,
					                   caja_comven_fecha,
					                   caja_comven_descrip,
   				                       caja_comven_mon, 
									   caja_comven_impo, 
									   caja_comven_impo_e,
									   caja_comven_contab,
									   caja_comven_tc,
									   caja_comven_usr_alta,
                                       caja_comven_fch_hra_alta,
                                       caja_comven_usr_baja,
                                       caja_comven_fch_hra_baja
                                       ) values ($nro_tr_comven,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hbs,
												 '$cta_ctbs',
												 $tipo,
												 '$fec1',
												 '$desc_det',
												  $mon,
												  $importe,
												  $impo_eq,
												  2,
												  $tc_ctb,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_com_ven  2: ' . mysql_error()); 
//if ($_SESSION['c_com_ven'] == 1){
    if (substr($cta_dtc,0,1) == 4){
   $dif_tc = $dif_tc * -1;
   }
 //}
$mon = 1;
$consulta = "insert into caja_com_ven(caja_comven_corr, 
	                                   caja_comven_corr_cja,
                                       caja_comven_agen,
									   caja_comven_debhab,
									   caja_comven_cta,
									   caja_comven_tipo,
					                   caja_comven_fecha,
					                   caja_comven_descrip,
   				                       caja_comven_mon, 
									   caja_comven_impo, 
									   caja_comven_impo_e,
									   caja_comven_contab,
									   caja_comven_usr_alta,
                                       caja_comven_fch_hra_alta,
                                       caja_comven_usr_baja,
                                       caja_comven_fch_hra_baja
                                       ) values ($nro_tr_comven,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hdif,
												 '$cta_dtc',
												 $tipo,
												 '$fec1',
												 '$desc_det',
												  $mon,
												  $dif_tc,
												  $dif_tc,
												  2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_com_ven  3: ' . mysql_error()); 
/*	
  	 

*/	 
	
	?>
	
<?php

?>

  <?php //} ?>
	 
</div>
  <?php
		 	//include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
ob_end_flush();
 ?>