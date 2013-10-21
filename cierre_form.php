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
//	 $fec = leer_param_gral();
	$tc_ctb  = $_SESSION['TC_CONTAB'];	
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>
  <strong> 
<?php	
	 $_SESSION['msg_err'] = "";	  
		 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
		  }
if(isset($_SESSION['fec_proc'])){ 
  $fec_p = $_SESSION['fec_proc']; 
  }	
 	  
//echo encadenar(2).$emp_nom.encadenar(41)."Cochabamba".encadenar(3).$_SESSION['fec_proc'];		  
?>
<strong> 
<?php
$nom_ases = "";
$comif = 0;
$impsc = 0;
$imp = 0;
$desc ="";
if(isset($_SESSION['login'])){   
   $log_usr = $_SESSION['login']; 
   }
//if(isset($_SESSION['cta_fon'])){ 
//   $cta_fon = $_SESSION['cta_fon'];
//}

$_SESSION['cod_mon'] = 2;
$cod_mon = $_SESSION['cod_mon'];
$_SESSION['dep_ret'] = 2;
if ($cod_mon == 1){
 $_SESSION['cod_cta1'] = "11101101";
} 
if ($cod_mon == 2){
 $_SESSION['cod_cta1'] = "11101201";
}
 $con_ctas  = "Select * From cart_via_cta, contab_cuenta  where CART_VIA_CTA_GRP = 2
                                                           and CART_VIA_MON = $cod_mon
														   and CART_VIA_TIP_OP = 1
														   and CONTA_CTA_NRO = CART_VIA_CTA_CTB";
$res_ctas = mysql_query($con_ctas);
while ($linea = mysql_fetch_array($res_ctas)) {
	   $c_cta2 = $linea['CART_VIA_CTA_CTB'];
	   $_SESSION['cod_cta2'] = $c_cta2;	
	   }
if(isset($_SESSION['cod_mon'])){ 
   $mon = $_SESSION['cod_mon'];
}

//echo $_SESSION['ncre']."ncre";
if(isset($_SESSION['ncre'])){ 
   $ncre = $_SESSION['ncre'];
   }else{
   $ncre = 0;
}

$total = 0;
$f_tra = cambiaf_a_mysql_2($fec_p);
//echo $fec_p, $f_tra;
$_SESSION['msg_err'] = " ";
//$log_usr = $_SESSION['login'];
if(isset($_POST['monto'])){  
   $imp = $_POST['monto'];
   $_SESSION['imp'] = $imp;
   }
 if(isset($_POST['descrip'])){  
   $desc = $_POST['descrip'];
   $desc = strtoupper($desc);
   
   }  
  //if ($_SESSION['continuar'] == 2){

	
//	}
if (isset($_SESSION['asesor'])){
    }else{
   $_SESSION['asesor']= "";
   }
  // if ($_SESSION['dep_ret'] == 2){
   //   $imp = $_SESSION['imp'];
   // }   
  
 
 if($_SESSION['cod_mon'] == 1){ 
   $eqv = $imp;
}  
//echo $imp,$eqv;
if($_SESSION['cod_mon'] == 2){ 
  
   $eqv = $imp;
   $imp = $imp * $tc_ctb;
}     
if(isset($_SESSION['cod_cta2'])){    
   $cod_cta2 = $_SESSION['cod_cta2'];
   }
if(isset($_SESSION['cod_cta1'])){    
   $cod_cta1 = $_SESSION['cod_cta1'];
   }
$deb_hab1 = 0;
$deb_hab2 = 0;
// $desc3 = "Cta."." ".$cta_fon." ".$_SESSION['grupo']." / ".$_SESSION['nombre']; 
/*if($_SESSION['dep_ret'] == 1){
    $des_tra = "Entrada";
    $tip_tra = 1;
	$tip_ope = 1;
	$deb_hab1 = 1;
	$deb_hab2 = 2; 
	$desc1 = "ENTRADA DE OTROS";
	
	$desc2 = "Transaccion por";
} */
//if ($_SESSION['dep_ret'] == 2){
   
  
    $eqv = $eqv * -1;
   $imp = $imp * -1;
    $des_tra = "Salida";
    $tip_tra = 2;
	$tip_ope = 2;
	$deb_hab1 = 2;
	$deb_hab2 = 1;
	$desc1 = "SALIDA DE OTROS "; 
//	$desc3 = "RETIRO FONDO GARANTIA Cta."." ".$cta_fon; 
	$desc2 = "Transaccion por";
	
//}

 $apli = 11000;
 $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
 
 $agen = 32;
 $nro_tr_fond = leer_nro_co_fon($tip_tra,$log_usr); 
//echo $tip_tra, $nro_tr_fond;
 //Grabar Tablas
 //Caja
 $con_fga  = "Select * From  cierre "; 
$res_fga = mysql_query($con_fga);
   while ($lin_fga = mysql_fetch_array($res_fga)) {
          $cta = $lin_fga['cuenta'];
		  $cta_fon = $lin_fga['cuenta'];
		  $monto = $lin_fga['monto'];
		  $imp = $monto;
		  $_SESSION['imp'] = $imp;
		 echo $cta_fon.encadenar(2).$monto;
		 ?>
		 <br>
		 <?php
		 $mon = 2;
	if($_SESSION['cod_mon'] == 2){ 
	 $eqv = $imp;
   $imp = $_SESSION['imp']  * $tc_ctb;
  
   $s_mon = "Dol.";
}  
if($_SESSION['cod_mon'] == 1){ 
   $imp = $_SESSION['imp'];
   $eqv = $imp;
   $s_mon = "Bs.";
}  	 
$imp = $imp * -1;
$eqv = $eqv * -1;		 
   $desc3 = "Cta."." ".$cta_fon." "; 
   $_SESSION['imp'] = $monto;
    echo "a grabar.....".$cta_fon.encadenar(2).$monto;
		 ?>
		 <br>
		 <?php
   
   
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
												 $cta_fon,
												 '$f_tra',
												 '$log_usr',
												 $tip_tra,
												 11,
												 $nro_tr_caj,
												 $nro_tr_fond,
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
												 '$desc3',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);

//Fondo Garantia
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
									    ) values ($cta_fon,
									             $agen,
												 $nro_tr_fond,
												 $nro_tr_caj,
												 0,
												 '$f_tra',
												 $tip_tra,
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
$resultado = mysql_query($consulta);

$imp = $imp * -1;
$eqv = $eqv * -1;	


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
									       ) values ($cta_fon,
									                 $agen,
													 $ncre,
												     $nro_tr_fond,
													 2,
													 '$f_tra',
												     $tip_tra,
												     111,
													 $deb_hab1,
												     '$cod_cta1',
													 $imp,
													 $eqv,
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
									       ) values ($cta_fon,
									                 $agen,
													 $ncre,
												     $nro_tr_fond,
													 2,
													 '$f_tra',
												     $tip_tra,
												     212,
													 $deb_hab2,
												     '$cod_cta2',
													 $imp,
													 $eqv,
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

$consulta = "update fond_maestro set FOND_ESTADO = 9 where FOND_NRO_CTA =  $cta_fon";
$resultado = mysql_query($consulta); 


}
 // Impresion Comprobante Cartera
// echo encadenar(2).$emp_nom.encadenar(41)."Cochabamba".encadenar(3).$_SESSION['fec_proc'];
     ?>
<strong>	 <font size="+1">
	 <?php
	 /*
if ($_SESSION['EMPRESA_TIPO'] == 2){	 
echo encadenar(5).$desc1.encadenar(70).$desc1; 
?>
</font></strong>
<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cmpte. Fond.Gar."; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_fond; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cmpte. Fond.Gar."; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_fond; ?></th>     
			
    </tr>	
	
	</table>
	</center>
		
<table border="0" width="900">
 <tr>
	    <th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="left"><?php echo $cta_fon; ?></th> 
		
		<th align="center"><?php echo encadenar(50); ?></th>     
		<th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="left"><?php echo $cta_fon; ?></th> 
		
    </tr>	
	

<tr>
	    <th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="left"><?php echo  $top_des; ?></th> 
		
		<th align="center"><?php echo encadenar(23); ?></th>     
		<th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="left"><?php echo $top_des; ?></th> 
		
			
    </tr>	
	 <?php
	 if ($_SESSION['grupo'] <> ""){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['grupo']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $_SESSION['grupo']; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		
	<?php }else{  ?> 		
	 <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
		<th align="left"><?php echo "Cliente"; ?></th>
		<td align="left"><?php echo $_SESSION['nombre']; ?></th>     
   </tr>
   <?php }  ?> 	
		    
   	
  </table> 
<table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['d_mon']; ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th>  
	   	<td align="left"><?php echo $_SESSION['asesor']; ?></th> 
		<th align="center"><?php echo encadenar(45); ?></th>
		 <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['d_mon']; ?></th>        
		<th align="left"><?php echo "Asesor "; ?></th>  
		<td align="left"><?php echo $_SESSION['asesor']; ?></th>     
			
    </tr>	
</table>
 
 </strong><br>
<br>

	 <table border="0" width="900">
  <tr>
	    <th align="left"><?php echo $des_tra; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo number_format($_SESSION['imp'], 2, '.',',').encadenar(1).$s_mon; ?></th>
		<td align="left"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th> 
		<th align="left"><?php echo $des_tra; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo number_format($_SESSION['imp'], 2, '.',',').encadenar(1).$s_mon; ?></th>
		<td align="left"><?php echo encadenar(3); ?></th>  
   </tr>	
     <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th>  
   </tr>
   <tr>
	    <th align="left"><?php echo $desc2; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $desc; ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo $desc2; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $desc; ?></th>
		<td align="right"><?php echo encadenar(3); ?></th>  
   </tr>
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th>  
   </tr>
   </table>
   
	<?php
	 $mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(2).$desc2.encadenar(3).$desc;
	 ?>
	 
	 <?php
	 $mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <table border="0" width="900"> 
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(38); ?> </th>  
		<th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
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

if ($_SESSION['EMPRESA_TIPO'] == 1){	 
echo encadenar(5).$desc1.encadenar(10); 
?>
</font></strong>
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
		<th align="left"><?php echo "Cmpte. Fond.Gar."; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$nro_tr_fond; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		    
			
    </tr>	
	
	</table>
	</center>
		
<table border="0" width="500">
 <tr>
	    <th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="left"><?php echo $cta_fon; ?></th> 
		
		<th align="center"><?php echo encadenar(20); ?></th>     
		
		
    </tr>	
	

<tr>
	    <th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="left"><?php echo  $top_des; ?></th> 
		
		<th align="center"><?php echo encadenar(13); ?></th>     
	
		
			
    </tr>	
	 <?php
	 if ($_SESSION['grupo'] <> ""){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['grupo']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
	    
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
	
		
	<?php }else{  ?> 		
	 <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nombre']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
	   
   </tr>
   <?php }  ?> 	
		    
   	
  </table> 
<table border="0" width="500">
<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['d_mon']; ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th>  
	   	<td align="left"><?php echo $_SESSION['asesor']; ?></th> 
		<th align="center"><?php echo encadenar(25); ?></th>
		     
			
    </tr>	
</table>
 
 </strong><br>
<br>

	 <table border="0" width="500">
  <tr>
	    <th align="left"><?php echo $des_tra; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo number_format($_SESSION['imp'], 2, '.',',').encadenar(1).$s_mon; ?></th>
		<td align="left"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		
		 
   </tr>	
     <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
		 
   </tr>
   <tr>
	    <th align="left"><?php echo $desc2; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $desc; ?></th>
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
   
	<?php
	 $mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(2).$desc2.encadenar(3).$desc;
	 ?>
	 
	 <?php
	 $mon_des = f_literal($_SESSION['imp'],1);
	// echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <table border="0" width="500"> 
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(28); ?> </th>  
		
   </tr>
    <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		
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
		<th align="left"><?php echo encadenar(20); ?></th>
		
	 </tr>

  </table>
   <table border="0" width="500">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(25); ?> </th>  
		 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(20).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(30); ?> </th>  

   </tr>
</table>
 
  <?php
}

  
 // echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
 <?php
  
 // echo encadenar(12)."INTERESADO", encadenar(40),"     CAJERO";
  ?>



 <?php
  
 // echo encadenar(10)."Antes de firmar verifique los datos";
  ?>
 
 <?php
 // Impresion Comprobante Fondo Garantia
 /*
 
  */
  ?>
  
<?php
}
ob_end_flush();
 ?>
 
                   