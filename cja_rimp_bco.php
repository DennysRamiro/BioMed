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
			//	include("header.php");
	//include("header_2.php");
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
          <br>
<center>
<font  size="+2">

<?php
 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
//Recupera la transaccion para reimprimir		  
if(isset($_POST['nro_tra'])){
   $quecom = $_POST['nro_tra'];
//   echo "...".$quecom."---";
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $nro_tra = $_POST['nro_tra'];
	      }
   }
$tipo = substr($nro_tra,0,1);
$tran = substr($nro_tra,1,3);
  }
//  echo $fec1."fff";
$con_car  = "Select * from  caja_deposito
             where CAJA_DEP_FECHA = '$fec1' and
			 CAJA_DEP_TIPO = $tipo and
			 CAJA_DEP_NRO = $tran
             and CAJA_DEP_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			       $nro_tr_bco =$tran; 
			       $_SESSION['b_dep_ret'] = $lin_car['CAJA_DEP_TIPO'];
                   $tipo = $_SESSION['b_dep_ret'];
				   $_SESSION['bco_bs_sus'] = $lin_car['CAJA_DEP_MON'];
                   $mon = $_SESSION['bco_bs_sus'];
				   if ($mon == 1){
                      $_SESSION['des_mon'] = "Bolivianos";
		            }	
                   if ($mon == 2){
          	          $_SESSION['des_mon'] = "Dolares";
                    }
				   $_SESSION['cta_bco'] = $lin_car['CAJA_DEP_CTA_BCO'];
                   $cta_bco = $_SESSION['cta_bco'];
				   $_SESSION['cod_bco'] = $lin_car['CAJA_DEP_BANCO'];
				   $cod_bco = $_SESSION['cod_bco'];
				   $_SESSION['cta_otra'] = $lin_car['CAJA_DEP_CTA_CTB'];
                   $cta_otra = $_SESSION['cta_otra'];
				   $cta_banco = $cta_bco;
				   $_SESSION['descrip'] = $lin_car['CAJA_DEP_QUIEN'];
				   $descrip = $_SESSION['descrip'];
				   if ($_SESSION['b_dep_ret'] == 1){
                      $des_tran = "Deposito ";
		            }	
                   if ($_SESSION['b_dep_ret'] == 2){
          	          $des_tran = "Retiro";
                    }
				//	echo $cta_bco;
					$consulta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_COD = $cod_bco and
	                              GRAL_CTA_BAN_USR_BAJA is null ";
                    $resultado = mysql_query($consulta);
                	while ($linea = mysql_fetch_array($resultado)) {
	                       $cta_banco = $linea['GRAL_CTA_BAN_CTBL'];
		                   $_SESSION['cod_bco'] =  $linea['GRAL_CTA_BAN_COD']; 
	                       $_SESSION['cta_bco'] =  $linea['GRAL_CTA_BAN_CTA_CTE']; 
	                       $_SESSION['nom_cta'] =  $linea['GRAL_CTA_BAN_DESC']; 
	                     }
			         $des_banco = leer_cta_des($cta_banco);
		             $des_otra = leer_cta_des($cta_otra);
	                 $_SESSION['cta_otra'] = $cta_otra;
		             $_SESSION['cta_banco'] = $cta_banco;
		             $_SESSION['des_otra'] = $des_otra;
	                 $_SESSION['des_banco'] = $des_banco;
	               	 $mon_otra = substr($cta_otra,5,1);
				     $_SESSION['des_tran'] = $des_tran;	
				   
$cta_banco = $_SESSION['cta_banco'];
$des_otra = $_SESSION['des_otra'];
$des_banco = $_SESSION['des_banco'];
if ($mon == 1){
    if ($lin_car['CAJA_DEP_IMPO'] < 0){
       $_SESSION['impo_bs1'] = $lin_car['CAJA_DEP_IMPO'] * -1;
       $impo_bs1 = $_SESSION['impo_bs1'];
	   }else{
	   $_SESSION['impo_bs1'] = $lin_car['CAJA_DEP_IMPO'];
       $impo_bs1 = $_SESSION['impo_bs1'];
	   }
	  if ($lin_car['CAJA_DEP_IMPO2'] < 0){  
	     $_SESSION['impo_eqv1'] = $lin_car['CAJA_DEP_IMPO2'] * -1; 
         $impo_eqv1 = $_SESSION['impo_eqv1'];
	   }else{
	       $_SESSION['impo_eqv1'] = $lin_car['CAJA_DEP_IMPO2']; 
         $impo_eqv1 = $_SESSION['impo_eqv1'];
	   }
}	
if ($mon == 2){
    if ($lin_car['CAJA_DEP_IMPO'] < 0){
        $_SESSION['impo_bs2'] = $lin_car['CAJA_DEP_IMPO'] * -1;
        $impo_bs2 = $_SESSION['impo_bs2'];
	}else{
	     $_SESSION['impo_bs2'] = $lin_car['CAJA_DEP_IMPO'];
        $impo_bs2 = $_SESSION['impo_bs2'];
	}
	if ($lin_car['CAJA_DEP_IMPO2'] < 0){ 
	    $_SESSION['impo_eqv2'] = $lin_car['CAJA_DEP_IMPO2'] * -1; 
        $impo_eqv2 = $_SESSION['impo_eqv2'];
		}else{
		$_SESSION['impo_eqv2'] = $lin_car['CAJA_DEP_IMPO2']; 
        $impo_eqv2 = $_SESSION['impo_eqv2'];
	}	
}	
$tc_ctb = $_SESSION['TC_CONTAB'];

$tip_cta = substr($cta_otra,0,3);
$mon_otra = substr($cta_otra,5,1);

//$nro_tr_bco = leer_nro_tr_banco($tipo);	
$cta_ctble = $des_cta = leer_cta_des($cta_banco);	  
//echo "Recibo de ".encadenar(1).;
}
?>
</center>
<strong>
<font size="+2"> 
<?php
if ($_SESSION['EMPRESA_TIPO'] == 2){
echo encadenar(5)."Recibo de". encadenar(1).$_SESSION['des_tran'].encadenar(1)."Bancos".encadenar(55).
"Recibo de". encadenar(1).$_SESSION['des_tran'].encadenar(1)."Bancos";
?>
<br>
</strong>

<?php
//echo encadenar(10).$_SESSION['des_mon'].encadenar(60).$_SESSION['des_mon'];
?>
</font>
<table border="0" width="1000">
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
		<th align="left"><?php echo "Cmpte. Banco"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_bco; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cmpte Banco"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_bco; ?></th>     
			
    </tr>	
	
	</table>



 <?php
//if ($_SESSION['detalle'] == 3){
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['COD_AGENCIA'];
   $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
  ?>
    <strong>
 <?php // echo $_SESSION['des_tran'].encadenar(2)."a cta.".encadenar(2).
 // $_SESSION['cta_bco'].encadenar(2).$_SESSION['nom_cta']; ?>
  
	
<table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th> 
		<th align="left"><?php echo encadenar(3); ?></th>  
	   	
		<th align="center"><?php echo encadenar(35); ?></th>
		 <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th>        
		<th align="left"><?php echo encadenar(3); ?></th>  
		 
			
    </tr>	
</table>

 <br>
<table border="0" width="900">
 <tr>
	 <th align="left"><?php echo $_SESSION['des_tran']; ?> </th> 
		<th align="left"><?php echo "a cta."; ?></th>
		<td align="left"><?php echo $_SESSION['cta_bco']; ?></th> 
		<th align="left"><?php echo encadenar(40); ?> </th>
		<th align="left"><?php echo $_SESSION['des_tran']; ?> </th> 
		<th align="left"><?php echo "a cta."; ?></th>
		<td align="left"><?php echo $_SESSION['cta_bco']; ?></th> 
	</tr>
</table>

<table border="0" width="900">		
<tr>
	 <th align="left" style="font-size:11px"><?php echo $_SESSION['nom_cta']; ?> </th> 
	
	 <th align="left"><?php echo encadenar(60); ?> </th>
	 <th align="left" style="font-size:11px"><?php echo $_SESSION['nom_cta']; ?> </th> 
	
</tr>
<tr>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(40); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		
</tr>
</table>
<table border="0" width="900">
 <tr>
	 <th align="left"><?php echo "Cta. Ctble".encadenar(1); ?> </th> 
		<th align="left"><?php echo $_SESSION['cta_banco'].encadenar(1); ?></th>
		<td align="left"><?php echo $cta_ctble; ?></th> 
		<th align="left"><?php echo encadenar(65); ?> </th>
		<th align="left"><?php echo "Cta. Ctable".encadenar(1); ?> </th> 
		<th align="left"><?php echo $_SESSION['cta_banco'].encadenar(1); ?></th>
		<td align="left"><?php echo $cta_ctble; ?></th> 
	</tr>
</table>
<table border="0" width="900">			 
		 <?php if ($_SESSION['bco_bs_sus'] == 2){  
		         $mon_des = f_literal(1,$_SESSION['impo_eqv1']).encadenar(2)."Dol";
				 
				 
				 ?> 
		
		 <tr>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo  number_format($_SESSION['impo_eqv1'], 2, '.',',').encadenar(2); ?></th>
		<th align="left"><?php echo encadenar(43); ?> </th>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo  number_format($_SESSION['impo_eqv1'], 2, '.',',').encadenar(2); ?></th>
		</tr>	 
		<?php } ?> 
		 <?php if ($_SESSION['bco_bs_sus'] ==1){ 
		 $mon_des = f_literal(1,$_SESSION['impo_bs1']).encadenar(2)."Bs."; ?> 
		 <tr>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo number_format($_SESSION['impo_bs1'], 2, '.',',').encadenar(2); ?></th>
		<th align="left"><?php echo encadenar(43); ?> </th>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo number_format($_SESSION['impo_bs1'], 2, '.',',').encadenar(2); ?></th>
		</tr>	 
		<?php } ?> 
		</tr>
		
	</table>
<table border="0" width="900">	
	<tr>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		</tr>	 
		<tr>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		</tr>
		<tr>
		<th align="left"><?php echo $_SESSION['des_tran']
		                       .encadenar(2)."por".encadenar(2).strtoupper($_SESSION['descrip']); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(40); ?> </th>
		<th align="left"><?php echo $_SESSION['des_tran']
		                      .encadenar(2)."por".encadenar(2).strtoupper($_SESSION['descrip']); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
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
if ($_SESSION['EMPRESA_TIPO'] == 1){
echo encadenar(5)."Recibo de". encadenar(1).$_SESSION['des_tran'].encadenar(1)."Bancos";
?>
<br>
</strong>

<?php
//echo encadenar(10).$_SESSION['des_mon'].encadenar(60).$_SESSION['des_mon'];
?>
</font>
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
		<th align="left"><?php echo "Cmpte. Banco"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_bco; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		
			
    </tr>	
	
	</table>



 <?php
//if ($_SESSION['detalle'] == 3){
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['COD_AGENCIA'];
   $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
  ?>
    <strong>
 <?php // echo $_SESSION['des_tran'].encadenar(2)."a cta.".encadenar(2).
 // $_SESSION['cta_bco'].encadenar(2).$_SESSION['nom_cta']; ?>
  
	
<table border="0" width="500">
<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th> 
		<th align="left"><?php echo encadenar(3); ?></th>  
	   	
		<th align="center"><?php echo encadenar(25); ?></th>
		
		 
			
    </tr>	
</table>

 <br>
<table border="0" width="500">
 <tr>
	 <th align="left"><?php echo $_SESSION['des_tran']; ?> </th> 
		<th align="left"><?php echo "a cta."; ?></th>
		<td align="left"><?php echo $_SESSION['cta_bco']; ?></th> 
		<th align="left"><?php echo encadenar(30); ?> </th>
		
	</tr>
</table>

<table border="0" width="500">		
<tr>
	 <th align="left" style="font-size:11px"><?php echo $_SESSION['nom_cta']; ?> </th> 
	
	 <th align="left"><?php echo encadenar(20); ?> </th>
	 
	
</tr>
<tr>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(20); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		
</tr>
</table>
<table border="0" width="500">
 <tr>
	 <th align="left"><?php echo "Cta. Ctble".encadenar(1); ?> </th> 
		<th align="left"><?php echo $_SESSION['cta_banco'].encadenar(1); ?></th>
		<td align="left"><?php echo $cta_ctble; ?></th> 
		<th align="left"><?php echo encadenar(45); ?> </th>
	</tr>
</table>
<table border="0" width="500">			 
		 <?php if ($_SESSION['bco_bs_sus'] == 2){  
		         $mon_des = f_literal(1,$_SESSION['impo_eqv1']).encadenar(2)."Dol";
				 
				 
				 ?> 
		
		 <tr>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo  number_format($_SESSION['impo_eqv1'], 2, '.',',').encadenar(2); ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>
		
		</tr>	 
		<?php } ?> 
		 <?php if ($_SESSION['bco_bs_sus'] ==1){ 
		 $mon_des = f_literal(1,$_SESSION['impo_bs1']).encadenar(2)."Bs."; ?> 
		 <tr>
		<th align="left"><?php echo $_SESSION['des_tran'].encadenar(2)."de"; ?> </th> 
		<th align="left"><?php echo number_format($_SESSION['impo_bs1'], 2, '.',',').encadenar(2); ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>
			 
		<?php } ?> 
		</tr>
		
	</table>
<table border="0" width="500">	
	<tr>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(20); ?> </th>
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		</tr>	 
		<tr>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(20); ?> </th>
		<th align="left"><?php echo  encadenar(3); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		</tr>
		<tr>
		<th align="left"><?php echo $_SESSION['des_tran']
		                       .encadenar(2)."por".encadenar(2).strtoupper($_SESSION['descrip']); ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(20); ?> </th>
		
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
		<th align="left"><?php echo encadenar(20); ?></th>
		
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "INTERESADO"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(20); ?></th>
		
	 </tr>

  </table>
</center>
 
 <?php
}

 
//echo $tipo. " "."tipo".$mon. " "."mon".$impo_bs1." * ".$impo_eqv1." * ". 
//$impo_bs2." * ".$impo_eqv2." * "; 
/*if ($tipo == 1){
$desc = "Deposito";
   $deb_hab1 = 1;
   $deb_hab2 = 2;
    if ($mon == 1){
        $impo_eqv1 = $impo_bs1;
		$impo_bs2 = $impo_bs2 * -1;
		$impo_eqv2 = $impo_bs2;	
	}else{
	    $impo_bs2 = $impo_bs2 * -1;
		$impo_eqv2 = $impo_eqv2 * -1;	
	}
}
if ($tipo == 2){
   $desc = "Retiro";
   $deb_hab1 = 2;
   $deb_hab2 = 1;
    if ($mon == 1){
	    $impo_bs1 = $impo_bs1 * - 1;
        $impo_eqv1 = $impo_bs1;
		//$impo_bs2 = $impo_bs1 * -1;
		$impo_eqv2 = $impo_bs2;	
	}else{
	    $impo_bs1 = $impo_bs1 * -1;
		$impo_eqv1 = $impo_eqv1 * -1;	
	}
}
if ($tip_cta == '111'){
$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
											 					 		 
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
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
												 15,
												 $nro_tr_caj,
												 $nro_tr_bco,
												 0,
												 '$log_usr',
												 15000,
												 null,
												 null,
 											     null,
												 null,
												 '$cta_otra',
												 $impo_bs2,
										         $impo_eqv2,
												 $mon,
												 $tc_ctb,
												 '$descrip',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
//Correlativo de compra venta
}
$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);	
 ?>
 <br><br>
  <table border="0" width="500">  
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
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN, 
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_banco',
												 '$cta_bco',
												 $deb_hab1,
												 $nro_tr_bco,
												 $mon,
												 $impo_bs1,
												 $impo_eqv1,
												 '$fec1',
												 '$descrip',
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
$consulta = "insert into caja_deposito(CAJA_DEP_TIPO, 
	                                   CAJA_DEP_AGEN,
                                       CAJA_DEP_BANCO,
									   CAJA_DEP_CTA_CTB,
									   CAJA_DEP_CTA_BCO,
									   CAJA_DEP_DEB_HAB,
									   CAJA_DEP_NRO,
									   CAJA_DEP_MON,
					                   CAJA_DEP_IMPO,
									   CAJA_DEP_IMPO2,
					                   CAJA_DEP_FECHA,
   				                       CAJA_DEP_QUIEN, 
									   CAJA_DEP_USR_ALTA, 
									   CAJA_DEP_FCH_HR_ALTA,
									   CAJA_DEP_USR_BAJA,
									   CAJA_DEP_FCH_HR_BAJA
                                       ) values ($tipo,
									             $c_agen,
												 $cod_bco,
												 '$cta_otra',
												 '$cta_bco',
												 $deb_hab2,
												 $nro_tr_bco,
												 $mon,
												 $impo_bs2,
												 $impo_eqv2,
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
ob_end_flush();
 ?>