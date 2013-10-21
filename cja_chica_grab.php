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
	include("header_2.php");
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
		//		include("header.php");
			?>
            

				<?php
			//		 $fec = leer_param_gral();
			//		 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>

       <?php if($_SESSION['menu']==1){?>
	    <a href='egre_retro.php?accion=1'>Salir</a>
	   <?php } elseif($_SESSION['menu']==2){?>
	    <a href='egre_retro.php?accion=2'>Salir</a>
	   <?php }?> 
  </div>


<font  size="+1">


<?php
$apli = 10000;
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
$nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
    $nro_tr_ingegr = leer_nro_co_ingegr(2); 		  

?>
	</table>
	<font size="+3">
<?php
 if ($_SESSION['EMPRESA_TIPO'] == 2){
echo encadenar(8)."Recibo de Egreso".encadenar(42)."Recibo de Egreso";
?>
<br>
<font size="+2">
<?php
 
echo encadenar(20).$_SESSION['des_mon'].encadenar(75).$_SESSION['des_mon'];
?>
</font>
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
		<th align="left"><?php echo "Cmpte. Egreso"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_ingegr; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Egreso"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_ingegr; ?></th>     
			
    </tr>	
	
	</table>
	
 <?php
//if ($_SESSION['detalle'] == 3){
 // echo $_SESSION['monto_t']."+".$_SESSION['monto_eq']."*".$_SESSION['egre_bs_sus']."//".$_SESSION['t_fac_fis'];
    $s_mon = "- ";
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['c_agen'];
   $descrip = $_SESSION['descrip'];
   $importe = $_SESSION['monto_t'];
   $imp_or = $_SESSION['monto_t'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $dec_ctag = leer_cta_des($cta_ctbg);
   $cta_ctb = $_SESSION['cta_ctb'];
   $deb_hab = 2;
   if(isset($_SESSION['t_fac_fis'])){
      $tipo2 = $_SESSION['t_fac_fis'];
	   }
   if ($_SESSION['egre_bs_sus'] == 2){
 //  echo $_SESSION['monto_eq'];
    $impo_sus = $_SESSION['monto_eq'];
	$imp_or = $_SESSION['monto_t'];
    }else{
	
	$imp_or = $_SESSION['monto_t'];		 
   	$impo_sus = $_SESSION['monto_t'];
	//echo "Aquiiiii ..... ".$impo_sus.$imp_or;
	} 
      	
   
   
   $tipo = 2;
   //echo encadenar(112). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
 //   echo "aqui".$impo_sus;
?>
<br>

 
 <table border="0" width="900">
  
	
        <?php if ($_SESSION['egre_bs_sus'] == 2){ ?>
  <tr>
       <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
	   <th align="left"><?php echo encadenar(2); ?></th>
	    <th align="left"><?php echo number_format($_SESSION['monto_eq'], 2, '.',',').
		                       encadenar(2)."Dol."; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
	   <th align="left"><?php echo encadenar(2); ?></th>
	    <th align="left"><?php echo number_format($_SESSION['monto_eq'], 2, '.',',').
		                       encadenar(2)."Dol."; ?></th>
	 </tr>
	<?php }?>
	
	<?php if ($_SESSION['egre_bs_sus'] == 1){ ?>
	    <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',',').
		                       encadenar(2)."Bs."; ?></th> 
		<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo "Monto ".encadenar(5); ?> </th>  
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',',').
		                       encadenar(2)."Bs."; ?></th> 
		 
	<?php }?>
     </tr>
	 <tr>
	 <th align="left"><?php echo $cta_ctbg; ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo $dec_ctag; ?></th> 
    	<th align="left"><?php echo encadenar(50); ?> </th>
		<th align="left"><?php echo $cta_ctbg; ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo $dec_ctag; ?></th> 
	 </tr>
	  <tr>
	 <th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		  
		</tr>
      </table>



</center>
<?php
	  if ($_SESSION['egre_bs_sus'] == 1){
	   //  echo $_SESSION['monto_t']*-1;
	    $mon_des = f_literal($_SESSION['monto_t']*-1,1);
		}else{
		$mon_des = f_literal($_SESSION['monto_eq'],1);
		}
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
			
//$mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <table border="0" width="900"> 
	 <tr>
	 	<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(38); ?> </th>
		<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
	 </tr> 
	 <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).
		                       $_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(38); ?> </th>  
		<th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).
		                       $_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
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

 <?php
  }
 //Prodesarrollo
 if ($_SESSION['EMPRESA_TIPO'] == 1){
echo encadenar(5)."Recibo de Egreso".encadenar(92);
?>
<br>
<font size="+2">
<?php
 
echo encadenar(5).$_SESSION['des_mon'].encadenar(75);
?>
</font>
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
		<th align="left"><?php echo "Cmpte. Egreso"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_ingegr; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
					
    </tr>	
	
	</table>
	
 <?php
//if ($_SESSION['detalle'] == 3){
 // echo $_SESSION['monto_t']."+".$_SESSION['monto_eq']."*".$_SESSION['egre_bs_sus']."//".$_SESSION['t_fac_fis'];
    $s_mon = "- ";
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['c_agen'];
   $descrip = $_SESSION['descrip'];
   $importe = $_SESSION['monto_t'];
   $imp_or = $_SESSION['monto_t'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $dec_ctag = leer_cta_des($cta_ctbg);
   $cta_ctb = $_SESSION['cta_ctb'];
   $deb_hab = 2;
   if(isset($_SESSION['t_fac_fis'])){
      $tipo2 = $_SESSION['t_fac_fis'];
	   }
   if ($_SESSION['egre_bs_sus'] == 2){
 //  echo $_SESSION['monto_eq'];
    $impo_sus = $_SESSION['monto_eq'];
	$imp_or = $_SESSION['monto_t'];
    }else{
	
	$imp_or = $_SESSION['monto_t'];		 
   	$impo_sus = $_SESSION['monto_t'];
	//echo "Aquiiiii ..... ".$impo_sus.$imp_or;
	} 
      	
   
   
   $tipo = 2;
   //echo encadenar(112). "Nro. Tran. ".encadenar(2).$nro_tr_caj;
 //   echo "aqui".$impo_sus;
?>
<br>

 
 <table border="0" width="450">
  
	
        <?php if ($_SESSION['egre_bs_sus'] == 2){ ?>
  <tr>
       <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
	   <th align="left"><?php echo encadenar(2); ?></th>
	    <th align="left"><?php echo number_format($_SESSION['monto_eq'], 2, '.',',').
		                       encadenar(2)."Dol."; ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>
	
	 </tr>
	<?php }?>
	
	<?php if ($_SESSION['egre_bs_sus'] == 1){ ?>
	    <th align="left"><?php echo "Monto ".encadenar(5); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo number_format($_SESSION['monto_t'] * -1, 2, '.',',').
		                       encadenar(2)."Bs."; ?></th> 
		<th align="left"><?php echo encadenar(30); ?> </th>
		
		 
	<?php }?>
     </tr>
	 <tr>
	 <th align="left"><?php echo $cta_ctbg; ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo $dec_ctag; ?></th> 
    	<th align="left"><?php echo encadenar(30); ?> </th>
		
	 </tr>
	  <tr>
	 <th align="left"><?php echo encadenar(2); ?> </th> 
		<th align="left"><?php echo encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(2); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		
		  
		</tr>
      </table>



</center>
<?php
	  if ($_SESSION['egre_bs_sus'] == 1){
	   //  echo $_SESSION['monto_t']*-1;
	    $mon_des = f_literal($_SESSION['monto_t']*-1,1);
		}else{
		$mon_des = f_literal($_SESSION['monto_eq'],1);
		}
	// echo "Son:". encadenar(8).$mon_des.encadenar(3).$_SESSION['des_mon'];
			
//$mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <table border="0" width="450"> 
	 <tr>
	 	<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(18); ?> </th>
		
	 </tr> 
	 <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		 
	 </tr>
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).
		                       $_SESSION['des_mon']; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(18); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
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
  
  ?>	
  
 <?php
// echo $_SESSION['egre_bs_sus'].$importe;
if ($_SESSION['egre_bs_sus'] == 2){
    $impo_sus = $_SESSION['monto_eq']*-1;
	$cod_mon = 2;
    }else{		 
  	$importe = $importe;
    $cod_mon = 1;
	} 
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
												 2,
												 13,
												 $nro_tr_caj,
												 $nro_tr_ingegr,
												 0,
												 '$log_usr',
												 13000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe,
										         $impo_sus,
												 $cod_mon,
												 $tc_ctb,
												 '$descrip',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
   //         } 
$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);
 //
 if ($_SESSION['EMPRESA_TIPO'] == 2){	
 ?>
 <br>
  <table border="0" width="900">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(25).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(25)."Cochabamba".encadenar(5).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
<center>

<?php
}	
 //Prodesarrollo
 if ($_SESSION['EMPRESA_TIPO'] == 1){	
 ?>
 <br>
  <table border="0" width="450">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(35); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(25).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		
   </tr>
</table>
<center>

<?php
}	

//	 echo $nro_tr_ingegr.encadenar(2).$nro_tr_caj.encadenar(2).$c_agen.encadenar(2).$deb_hab.encadenar(2).$cta_ctb.encadenar(2).
		// $fec1.encadenar(2).$descrip.encadenar(2).$imp_or.encadenar(2).$imp_or.encadenar(2).$log_usr;
 
	$consulta = "insert into caja_ing_egre(caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctb',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												  $imp_or,
												  $impo_sus,
												  2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
if(isset($_SESSION['t_fac_fis'])){
   $tipo2 = $_SESSION['t_fac_fis'];
  if ($_SESSION['t_fac_fis'] == 0){
  if ($_SESSION['egre_bs_sus'] == 2){
    $impo_sus = $_SESSION['monto_eq'];
	$imp_or = $_SESSION['monto_t'] * -1;
    }else{		 
  	$imp_or = $imp_or * -1;
    $impo_sus = $imp_or;
	} 
$deb_hab = 1;	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $impo_sus,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
 }
}

if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 2){
  // $tipo = $_SESSION['t_fac_fis'];
   $deb_hab = 1;
   $cta_ctbg = $_SESSION['cta_f13'];
   $imp_or = $_SESSION['monto_i'] * -1;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  

  $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_p'] * -1;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  
  }
}
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 3){
  // $tipo = $_SESSION['t_fac_fis'];
   $deb_hab = 1;
   $cta_ctbg = $_SESSION['cta_f13'];
   $imp_or = $_SESSION['monto_i'] ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  

  $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_p'] ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  
  }
}
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 4){;
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_fis'] * -1;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  

  $cta_ctbg = $_SESSION['cta_iue'];
   $imp_or = $_SESSION['monto_125'] * -1 ;
  	 $deb_hab = 2; 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
  
 $cta_ctbg = $_SESSION['cta_it'];
   $imp_or = $_SESSION['monto_3'] * -1 ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  



  }
}	
if(isset($_SESSION['t_fac_fis'])){
  if ($_SESSION['t_fac_fis'] == 5){;
   $deb_hab = 1;
  // $tipo = $_SESSION['t_fac_fis'];
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $imp_or = $_SESSION['monto_fis'] * -1;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e,
									   caja_ingegr_contab, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  

  $cta_ctbg = $_SESSION['cta_iue'];
   $imp_or = $_SESSION['monto_125'] * -1 ;
  	 $deb_hab = 2; 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo,
									   caja_ingegr_tipo2, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
  
 $cta_ctbg = $_SESSION['cta_it'];
   $imp_or = $_SESSION['monto_3'] * -1 ;
  	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
									   caja_ingegr_tipo2,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_contab,
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 $tipo2,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);  
  }
}		 	 
	 
	//header('Location: egre_mante.php');
	?>
	
<?php
//}	
//header('Location: egre_mante.php');	
?>

  <?php //} ?>
	 
</div>
  <?php
			include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>