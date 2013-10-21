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
	$tc_ctb  = $_SESSION['TC_CONTAB'];
	//Datos empresa		  
		 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
		  
?>
<br><br>
<strong> 
<?php
if(isset($_SESSION['fec_proc'])){ 
  $fec_p = $_SESSION['fec_proc']; 
  }
if(isset($_SESSION['login'])){   
   $log_usr = $_SESSION['login']; 
   }
if(isset($_SESSION["impo_sol"])){  
   $imp_sol = $_SESSION["impo_sol"];
}
if(isset($_SESSION['nro_sol'])){ 
   $cod_sol = $_SESSION['nro_sol'];
}
$total = 0;
$f_tra = cambiaf_a_mysql_2($fec_p);
//echo $fec_p, $f_tra;
$_SESSION['msg_err'] = " ";
//$log_usr = $_SESSION['login'];
if(isset($_POST['cod_cta1'])){  
   $cod_cta1 = $_POST['cod_cta1'];
   }
if(isset($_POST['cod_cta1'])){    
   $cod_cta2 = $_POST['cod_cta2'];
   }
$error_d = 0;
//$agen = 30;
$nro_cred = $_SESSION['nro_cre'];


   
$con_fon = "Select * From fond_maestro where FOND_NRO_CRED = $nro_cred and FOND_MAE_USR_BAJA is null"; 
$res_fon = mysql_query($con_fon);
   while ($lin_fon = mysql_fetch_array($res_fon)) {
         $nro_ctaf = $lin_fon['FOND_NRO_CTA'];
	   }
	   
$con_car  = "Select * From cart_maestro where CART_NRO_CRED = $nro_cred and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
   while ($lin_car = mysql_fetch_array($res_car)) {
         $mon = $lin_car['CART_COD_MON'];
		 $agen = $lin_car['CART_COD_AGEN'];
		 $t_op = $lin_car['CART_TIPO_OPER'];
		 $cod_grupo = $lin_car['CART_COD_GRUPO'];
		 }
//Descripcion Moneda
$con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
			$s_mon = $linea['GRAL_PAR_INT_SIGLA'];
	   }		 
		 
		 
		 
//Grupo		 
if ($t_op < 3){
       $con_grup  = "Select * From cred_grupo where CRED_GRP_CODIGO = $cod_grupo and CRED_GRP_USR_BAJA is null";
       $res_grup = mysql_query($con_grup);
	   while ($lin_grup = mysql_fetch_array($res_grup)) {
	          $nom_grup  = $lin_grup['CRED_GRP_NOMBRE'];
	   }
	   $con_pdte  = "Select * From cred_grupo_mesa where CRED_GRP_MES_COD = $cod_grupo and  CRED_GRP_MES_REL = 1 and CRED_GRP_MES_USR_BAJA is null";
       $res_pdte = mysql_query($con_pdte);
	   while ($lin_pdte = mysql_fetch_array($res_pdte)) {
	          $cod_pdte  = $lin_pdte['CRED_GRP_MES_CLI'];
	   }
if(isset($cod_pdte)){  	   
	  $consulta  = "Select CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general  where  CLIENTE_COD = $cod_pdte and CLIENTE_USR_BAJA is null";
      $resultado = mysql_query($consulta); 
	  while ($linea = mysql_fetch_array($resultado)) {
    	    $nom_pdte = $linea['CLIENTE_NOMBRES']." ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO'];
	     }
   	  }
	}		 
		 
 $apli = 10000;
 $nro_tr_caj = leer_nro_co_cja($apli,$agen);
 $nro_tr_cart = leer_nro_co_car(2,$agen);
 $nro_tr_fond = leer_nro_co_fon(1,$agen);  
 
 $imp = 0;
 $eqv = 0;

 for ($i=1; $i < 3; $i = $i + 1 ) {
 $sum_debe_1 = 0;
 $sum_haber_1 =0;
 $sum_debe_2 = 0;
 $sum_haber_2 = 0;
 
 $cons_111  = "Select * From temp_ctable where SUBSTRING(temp_nro_cta,6,1) = $i and temp_tip_tra = 111";
 $resu_111  = mysql_query($cons_111);
 while ($lin_111 = mysql_fetch_array($resu_111)) {
     //  echo $lin_111['temp_nro_cta'] ;
       $sum_debe_1 = $sum_debe_1 + $lin_111['temp_debe_1'];
       $sum_haber_1 = $sum_haber_1 + $lin_111['temp_haber_1'];
	   $sum_debe_2 = $sum_debe_2 + $lin_111['temp_debe_2'];
       $sum_haber_2 = $sum_haber_2 + $lin_111['temp_haber_2'];
 
 if ($sum_haber_1 > 0){
     $sum_haber_1 = $sum_haber_1 * -1;
	 $sum_haber_2 = $sum_haber_2 * -1;
	 }
 
     $imp = $sum_debe_1;
	 $eqv = $sum_debe_2;

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
									             $agen,
												 $agen,
												 $nro_cred,
												 '$f_tra',
												 '$log_usr',
												 10000,
												 1,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 $nro_tr_fond,
												 '$log_usr',
												 6000,
												 null,
												 null,
 											     null,
												 null,
												 null,
												 $imp,
												 $eqv,
												 $i,
												 $tc_ctb,
												 'COBRO DE CREDITO',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

 } 
}
//Fondo Garantia
 $con_fon  = "Select * From temp_ctable where temp_tip_tra = 212";
 $res_fon = mysql_query($con_fon);
 while ($lin_fon = mysql_fetch_array($res_fon)) {
       $imp_debe_1 = $lin_fon['temp_debe_1'];
       $imp_haber_1 = $lin_fon['temp_haber_1'];
	   $imp_debe_2 = $lin_fon['temp_debe_2'];
       $imp_haber_2 = $lin_fon['temp_haber_2'];
	   $cta = $lin_fon['temp_nro_cta'];
 //echo $cta, "cta";
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_1;
	 $eqv = $imp_debe_2;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_1;
	 $eqv = $imp_haber_2;
	 $d_h = 2;
	 }
//$nro_tr_fond = leer_nro_co_fon(1,$agen); 
$consulta = "insert into fond_cabecera (FOND_CAB_NCTA, 
                                         FOND_CAB_AGEN,
									     FOND_CAB_NRO_TRAN,
									     FOND_CAB_TRAN_CAJ,
										 FOND_CAB_TRAN_CAR,
									     FOND_CAB_FECHA,
					                     FOND_CAB_TIP_TRAN,
					                     FOND_CAB_EST_ANT,
   				                         FOND_CAB_EST_ACT,
					                     FOND_CAB_TIP_CAM, 
									     FOND_CAB_FEC_TRAN, 
									     FOND_CAB_FEC_VTO, 
									     FOND_CAB_FEC_SUS,
                                         FOND_CAB_USR_ALTA,
                                         FOND_CAB_FCH_HR_ALTA,
                                         FOND_CAB_USR_BAJA,
                                         FOND_CAB_FCH_HR_BAJA
									    ) values ($nro_ctaf,
									             $agen,
												 $nro_tr_fond,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 '$f_tra',
												 1,
												 null,
												 null,
 											     $tc_ctb,
												 '$f_tra',
												 null,
												 null,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)




	// echo $nro_tr_cart, "tra_c" ,$f_tra, "f_tra",$cta;
	$consulta = "insert into fond_det_tran(FOND_DTRA_NCTA, 
                                           FOND_DTRA_AGEN,
										   FOND_DTRA_NCRE,
									       FOND_DTRA_NRO_TRAN,
										   fOND_DTRA_NRO_CTA,
									       FOND_DTRA_FECHA,
					                       FOND_DTRA_TIP_TRAN,
   				                           FOND_DTRA_CCON,
					                       FOND_DTRA_DEB_CRE, 
									       FOND_DTRA_CTA_CBT, 
									       FOND_DTRA_IMPO, 
									       FOND_DTRA_IMPO_BS,
                                           FOND_DTRA_FEC_TRAN,
                                           FOND_DTRA_FEC_INI2,
                                           FOND_DTRA_FEC_FIN,
                                           FOND_DTRA_TASA,
										   FOND_DTRA_EST_ANT,
										   FOND_DTRA_VIA,
										   FOND_DTRA_TIP_CAM,
										   FOND_DTRA_USR_ALTA,
										   FOND_DTRA_FCH_HR_ALTA,
										   FOND_DTRA_USR_BAJA,
										   FOND_DTRA_FCH_HR_BAJA
									       ) values ($nro_ctaf,
									                 $agen,
													 $nro_cred,
												     $nro_tr_fond,
													 1,
													 '$f_tra',
												     1,
												     null,
													 $d_h,
												     '$cta',
													 $eqv,
													 $imp,
 											     	 '$f_tra',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
 }
//}
//Cartera
// if ($ahoi > 0){
 $consulta = "insert into cart_cabecera (CART_CAB_NCRE, 
                                         CART_CAB_AGEN,
									     CART_CAB_NRO_TRAN,
									     CART_CAB_TRAN_CAJ,
										 CART_CAB_TRAN_FON,
									     CART_CAB_FECHA,
					                     CART_CAB_TIP_TRAN,
					                     CART_CAB_EST_ANT,
   				                         CART_CAB_EST_ACT,
					                     CART_CAB_TIP_CAM, 
									     CART_CAB_FEC_TRAN, 
									     CART_CAB_FEC_VTO, 
									     CART_CAB_FEC_SUS,
                                         CART_CAB_USR_ALTA,
                                         CART_CAB_FCH_HR_ALTA,
                                         CART_CAB_USR_BAJA,
                                         CART_CAB_FCH_HR_BAJA
									    ) values ($nro_cred,
									             $agen,
												 $nro_tr_cart,
												 $nro_tr_caj,
												 $nro_tr_fond,
												 '$f_tra',
												 2,
												 null,
												 3,
 											     $tc_ctb,
												 '$f_tra',
												 null,
												 null,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

//Cartera Capital

$con_131  = "Select * From temp_ctable where temp_tip_tra = 131";
$res_131 = mysql_query($con_131);
 while ($lin_131 = mysql_fetch_array($res_131)) {
       $imp_debe_1 = $lin_131['temp_debe_1'];
       $imp_haber_1 = $lin_131['temp_haber_1'];
	   $imp_debe_2 = $lin_131['temp_debe_2'];
       $imp_haber_2 = $lin_131['temp_haber_2'];
	   $cta = $lin_131['temp_nro_cta'];
 //echo $cta, "cta";
if ($mon == 2){ 
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_1;
	 $eqv = $imp_debe_2;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_1;
	 $eqv = $imp_haber_2;
	 $d_h = 2;
	 }
}	
if ($mon == 1){ 
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_2;
	 $eqv = $imp_debe_1;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_2;
	 $eqv = $imp_haber_1;
	 $d_h = 2;
	 }
}	  
	// echo $nro_tr_cart, "tra_c" ,$f_tra, "f_tra",$cta;
	$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($nro_cred,
									                 $agen,
												     $nro_tr_cart,
													 0,
													 '$f_tra',
												     2,
												     null,
													 $d_h,
												     '$cta',
													 $eqv,
													 $imp,
 											     	 '$f_tra',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
 }
 
 //Cartera 1nteres

$con_513  = "Select * From temp_ctable where temp_tip_tra = 513";
$res_513 = mysql_query($con_513);
 while ($lin_513 = mysql_fetch_array($res_513)) {
       $imp_debe_1 = $lin_513['temp_debe_1'];
       $imp_haber_1 = $lin_513['temp_haber_1'];
	   $imp_debe_2 = $lin_513['temp_debe_2'];
       $imp_haber_2 = $lin_513['temp_haber_2'];
	   $cta = $lin_513['temp_nro_cta'];
 //echo $cta, "cta";
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_1;
	 $eqv = $imp_debe_2;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_1;
	 $eqv = $imp_haber_2;
	 $d_h = 2;
	 }
	// echo $nro_tr_cart, "tra_c" ,$f_tra, "f_tra",$cta;
	$consulta = "insert into cart_det_tran(CART_DTRA_NCRE, 
                                           CART_DTRA_AGEN,
									       CART_DTRA_NRO_TRAN,
										   CART_DTRA_NRO_CTA,
									       CART_DTRA_FECHA,
					                       CART_DTRA_TIP_TRAN,
   				                           CART_DTRA_CCON,
					                       CART_DTRA_DEB_CRE, 
									       CART_DTRA_CTA_CBT, 
									       CART_DTRA_IMPO, 
									       CART_DTRA_IMPO_BS,
                                           CART_DTRA_FEC_TRAN,
                                           CART_DTRA_FEC_INI2,
                                           CART_DTRA_FEC_FIN,
                                           CART_DTRA_TASA,
										   CART_DTRA_EST_ANT,
										   CART_DTRA_VIA,
										   CART_DTRA_TIP_CAM,
										   CART_DTRA_USR_ALTA,
										   CART_DTRA_FCH_HR_ALTA,
										   CART_DTRA_USR_BAJA,
										   CART_DTRA_FCH_HR_BAJA
									       ) values ($nro_cred,
									                 $agen,
												     $nro_tr_cart,
													 0,
													 '$f_tra',
												     2,
												     null,
													 $d_h,
												     '$cta',
													 $eqv,
													 $imp,
 											     	 '$f_tra',
												     null,
													 null,
													 0,
													 null,
													 null,
												     $tc_ctb,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
 }
  $nro_cta  = 0;
  $t_itf = 0;
	 $p_cap = 0 ; 
     $p_int = 0 ;
	 $p_aho = 0 ;
	 $p_tot = 0;
	  $t_itf = $_SESSION['itf'];
	 $p_cap = $_SESSION['p_cap'] ; 
     $p_int = $_SESSION['p_int'] ;
	 $p_aho = $_SESSION['p_aho'] ;
	 $f_cta = $_SESSION['f_cta'] ;
	 $n_cta = $_SESSION['n_cta'] ;
	 if ($mon == 2) {
	    $p_tot = $p_cap + $p_int + $t_itf;
	  }
	 if ($mon == 1) {
	    $p_tot = $p_cap + $p_int ;
	  }
     
 // Impresion Comprobante Cartera
 //echo encadenar(2).$emp_nom.encadenar(41)."Cochabamba".encadenar(3).$_SESSION['fec_proc'];
     ?>
 <table border="0" width="900">
	
	<tr>
	    <th align="center"><?php echo encadenar(16); ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(15); ?></th> 
		<th align="center"><?php echo encadenar(12); ?></th>           
	    <th align="center"><?php echo encadenar(14); ?></th>     
		<th align="center"><?php echo encadenar(16); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>  
		<th align="center"><?php echo encadenar(15); ?></th>     
		<th align="center"><?php echo encadenar(12); ?></th>
		
    </tr>	
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(14); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cte Caja"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_caj; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Caja"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_caj; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo encadenar(16); ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cte Cartera"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_cart; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo encadenar(16); ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Cartera"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_cart; ?></th>     
			
    </tr>	
	</table>
	</center>	
<?php
echo encadenar(2).$emp_dir.encadenar(40)."Cbte  Caja  Nro.".encadenar(8).$nro_tr_caj;
?>
<br>
<?php
echo encadenar(76)."Cbte Cartera Nro.".encadenar(6).$nro_tr_cart;
?>
<br><br>
<?php
echo encadenar(35)."BOLETA DE PAGO"; 
?>
<br><br>
 <?php  
     echo encadenar(2)."Nro. Credito".encadenar(2).$nro_cred.encadenar(20).
	     "Moneda".encadenar(2).$d_mon.encadenar(2).number_format($p_tot, 2, '.',',').encadenar(2);
		   
 ?>
<br>
<?php  
     echo encadenar(60)."Dolares".encadenar(2).number_format($p_tot, 2, '.',',');
?>
<br>
<?php  
     echo encadenar(60)."Bolivianos".encadenar(2).number_format($p_tot, 2, '.',',').encadenar(2).
	 "T.C".encadenar(2).number_format($p_tot, 2, '.',',');
?>
<br>
_____________________________________________________
 </strong><br>
	 
	 <?php 
	 echo encadenar(2)."Cajero".encadenar(9).$_SESSION['nombres'].encadenar(35)."Asesor ".encadenar(3).$_SESSION['nombres'];
	 ?>
	 <br>
	 
	 <?php
	 if ($t_op < 3){
	    echo encadenar(2)."Grupo".encadenar(9).$nom_grup;
	 
	 ?>
	 <br>
	  <?php 
	 echo encadenar(2)."Presidente".encadenar(3).$nom_pdte;
	 }
	 
	 ?>
	 <br>
     __________________________________________________________
  	 <br>
	 <?php 
	 if ($mon == 2) {
	 ?>
	 
	 <table border="0" width="300">
	 
	    <tr>
	 	    <td align="left" ><?php echo encadenar(8)."Capital" ; ?></td>
		    <td align="right"><?php echo number_format($p_cap, 2, '.',',').encadenar(3).$s_mon; ?></td>
		</tr>
		<tr>
	 	    <td align="left" ><?php echo encadenar(8)."Interes" ; ?></td>
		    <td align="right"><?php echo number_format($p_int, 2, '.',',').encadenar(3).$s_mon; ?></td>
		</tr>
		<tr>
	 	    <td align="left" ><?php echo encadenar(8)."ITF" ; ?></td>
		    <td align="right"><?php echo number_format($t_itf, 2, '.',',').encadenar(3).$s_mon; ?></td>
		</tr>
		<tr>
	 	    <td align="left" ><?php echo encadenar(8)."TOTAL" ; ?></td>
		    <td align="right"><?php echo number_format($p_tot, 2, '.',',').encadenar(3).$s_mon; ?></td>
		</tr>
			
      </table>
	  <?php 
	     }
	 ?>
	 
	 <?php 
	 if ($mon == 1) {
	 ?>
	 
	 <table border="0" width="300">
	 
	    <tr>
	 	    <td align="left" ><?php echo encadenar(8)."Capital" ; ?></td>
		    <td align="right"><?php echo number_format($p_cap, 2, '.',',').encadenar(3).$s_mon; ?></td>
		</tr>
		<tr>
	 	    <td align="left" ><?php echo encadenar(8)."Interes" ; ?></td>
		    <td align="right"><?php echo number_format($p_int, 2, '.',',').encadenar(3).$s_mon; ?></td>
		</tr>
		<tr>
	 	    <td align="left" ><?php echo encadenar(20)."" ; ?></td>
		    <td align="right"><?php echo "______________________"; ?></td>
		</tr>
		<tr>
	 	    <td align="left" ><?php echo encadenar(8)."TOTAL" ; ?></td>
		    <td align="right"><?php echo number_format($p_tot, 2, '.',',').encadenar(3).$s_mon; ?></td>
		</tr>
		</strong>	
      </table>
	  <?php 
	     }
	 ?>
	 
	 
	 
	   <br>
     __________________________________________________________
  	 <br>
	 <?php
	 
	$saldo = saldo_c($nro_cred,$f_cta,$f_tra); 
 // if ($comif == 2){
 //   	$impsc = $imp_sc ;
//		}
//	if ($comif == 1){
//    	$impsc = $impo ;
//		}	
	 echo encadenar(2)."Saldo Cap. ".encadenar(15).$saldo.encadenar(3).$s_mon;   
 ?> 
	<br>
	 <?php 
//	 $impc = $imp_c ;
//	$impoc = number_format($impc, 2, '.',','); 
//	 echo encadenar(2)."Comision".encadenar(71)."(".$impoc.")".encadenar(3).$s_mon; 
	
	?>
	<br>
	 <?php 
	//$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    //$resultado = mysql_query($consulta);
   // while ($linea = mysql_fetch_array($resultado)) {
   //        $imp_fg = $imp_fg + $linea['CRED_DEU_AHO_INI'];
	//  }
	// $impfg = number_format($imp_fg, 2, '.',',');  
	//echo encadenar(2)."Fondo Garantia Inicio".encadenar(51)."(".$impfg.")".encadenar(3).$s_mon; 	
	
	?>
	<br>
	<?php 
	//echo encadenar(80)."_______________ ";
	?>
	<BR><strong>
	 <?php 
	
	// $mon_desem = $impsc - $imp_c;
	// $mon_dese = number_format($mon_desem, 2, '.',',');
	 
	 ?>
	 <br><br>
	 <?php
	 $p_total =  number_format($p_tot, 2, '.', '');
	 $mon_tot = f_literal($p_total,1);
	 echo encadenar(5)."Son: ".encadenar(2).$mon_tot.encadenar(3).$s_mon;
	 ?>
	<BR>
    </strong>
  
  <br><br><br><br>
  <?php
  
  echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
 <?php
  
  echo encadenar(12)."INTERESADO", encadenar(40),"     CAJERO";
  ?>


<br><br><br><br><br>
<strong>Nota:</strong> No valido como Credito Fiscal
<br>
 <?php
  
  echo encadenar(10)."Antes de firmar verifique los datos";
  ?>
<br><br>
<strong> 
 <?php
 // Impresion Comprobante Fondo Garantia
 $apli = 10000;
 $nro_tr_caj = leer_nro_co_cja($apli,$agen);
 $sum_debe_1 = 0;
 $sum_haber_1 = 0;
 $sum_debe_2 = 0;
 $sum_haber_2 = 0;
 
 $cons_212  = "Select * From temp_ctable where SUBSTRING(temp_nro_cta,1,3) = 111 and temp_tip_tra = 212";
 $resu_212  = mysql_query($cons_212);
 while ($lin_212 = mysql_fetch_array($resu_212)) {
       $sum_debe_1 = $sum_debe_1 + $lin_212['temp_debe_1'];
       $sum_haber_1 = $sum_haber_1 + $lin_212['temp_haber_1'];
	   $sum_debe_2 = $sum_debe_2 + $lin_212['temp_debe_2'];
       $sum_haber_2 = $sum_haber_2 + $lin_212['temp_haber_2'];
 }
 if ($sum_haber_1 > 0){
     $sum_haber_1 = $sum_haber_1 * -1;
	 $sum_haber_2 = $sum_haber_2 * -1;
	 }
  for ($i=1; $i < 3; $i = $i + 1 ) {
  if ($i == 1){
     $imp = $sum_debe_1;
	 $eqv = $sum_debe_2;
	 } 	 
  if ($i == 2){
     $imp = $sum_haber_1;
	 $eqv = $sum_haber_2;
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
									             $agen,
												 $agen,
												 $nro_ctaf,
												 '$f_tra',
												 '$log_usr',
												 10000,
												 1,
												 $nro_tr_caj,
												 $nro_tr_cart,
												 $nro_tr_fond,
												 '$log_usr',
												 11000,
												 null,
												 null,
 											     null,
												 null,
												 null,
												 $imp,
												 $eqv,
												 $mon,
												 $tc_ctb,
												 'DEPOSITO FONDO GARANTIA INICIO',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

}

 
 
 
 
 	 
 echo encadenar(2).$emp_nom.encadenar(41)."Cochabamba".encadenar(3).$_SESSION['fec_proc'];
	 
     ?>
<br>
<?php

echo encadenar(2).$emp_dir.encadenar(40)."Cbte  Caja  Nro.".encadenar(8).$nro_tr_caj;
?>
<br>
<?php

echo encadenar(76)."Cbte Fondo Gar. Nro.".encadenar(5).$nro_tr_fond;
?>
<br><br>
<?php



echo encadenar(18)."DEPOSITO DE GARANTIA CICLO"; 
?>
<br><br>
 <?php  
     echo encadenar(2)."Credito".encadenar(2).$nro_cred.encadenar(50)."Nro. Cuenta".encadenar(2).$nro_ctaf;  
 ?>
<br>
__________________________________________________________
 </strong><br>
	 
	 <?php 
	 echo encadenar(2)."Cajero".encadenar(9).$_SESSION['nombres'].encadenar(35)."Asesor ".encadenar(3).$_SESSION['nombres'];
	 ?>
	 <br>
	 
	 <?php
	 if ($t_op < 3){
	    echo encadenar(2)."Grupo".encadenar(9).$nom_grup;
	 
	 ?>
	 <br>
	  <?php 
	 echo encadenar(2)."Presidente".encadenar(3).$nom_pdte;
	 }
	 ?>
	 <br>
     __________________________________________________________
  	 <br>
	 <?php
 // if ($comif == 2){
 //   	$impsc = $imp_sc ;
//		}
//	if ($comif == 1){
 //   	$impsc = $impo ;
//		}	
//	$imposc = number_format($impsc, 2, '.',',');  
  
    // echo encadenar(2)."Deposito Inicio ".encadenar(50).$imposc.encadenar(3).$s_mon;   
 ?> 
	<br>
	 <?php 
	 $imp_aho = $_SESSION['p_aho'];
     ?>
	 <table border="0" width="300">
	 
	    <tr>
	 	    <td align="left" ><?php echo encadenar(8)."Importe Aplicado" ; ?></td>
		    <td align="right"><?php echo number_format($imp_aho, 2, '.',',').encadenar(3).$s_mon; ?></td>
		</tr>
		
			
      </table>
	
	
	<br>
	 <?php 
	//$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
   // $resultado = mysql_query($consulta);
//	$imp_fg = 0;
 //   while ($linea = mysql_fetch_array($resultado)) {
 //          $imp_fg = $imp_fg + $linea['CRED_DEU_AHO_INI'];
//	  }
//	 $impfg = number_format($imp_fg, 2, '.',',');  
//	echo encadenar(2)."Fondo Garantia Inicio".encadenar(51).$impfg.encadenar(3).$s_mon; 	
	
	?>
	<br>
	<?php 
	//echo encadenar(80)."_______________ ";
	?>
	<BR><strong>
	 <?php 
	// $mon_desem = $impsc - $imp_c - $imp_fg;
	// $mon_dese = number_format($mon_desem, 2, '.',','); 
	// echo encadenar(8)." MONTO A DESEMBOLSAR EFECTIVO ".encadenar(5).$mon_dese.encadenar(3).$s_mon;
	 ?>
	 <br><br>
	 <?php
	 echo encadenar(8)." MONTO DEPOSITO FONDO GARANTIA".encadenar(5);
	 ?>
	 <br><br>
	 <?php
	 $mon_fond = f_literal($imp_aho,1);
	 echo encadenar(5)."Son: ".encadenar(2).$mon_fond.encadenar(3).$s_mon;
	 ?>
	<BR>
    </strong>
  
  <br><br><br><br>
  <?php
  
  echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
 <?php
  
  echo encadenar(12)."INTERESADO", encadenar(40),"     CAJERO";
  ?>


<br><br><br><br><br>
<strong>Nota:</strong> No valido como Credito Fiscal
<br>
 <?php
  
  echo encadenar(10)."Antes de firmar verifique los datos";
  ?>
<?php
}
ob_end_flush();
 ?>
 
                      