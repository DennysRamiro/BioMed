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
	require('d:\xampp\htdocs\cc7\lib7\libreriaCC7.php');
//	$fec = leer_param_gral();
	$tc_ctb  = $_SESSION['TC_CONTAB'];	
?>
<html>
<head>
<title>Desembolso Cartera</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/cajas_desembolso_des_imp.js"></script>
</head>

<body>	
	<?php
	   include("header.php");
 	 ?>
<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS 
                    
                 </li>
                  <li id="menu_modulo_cajas_desembolsar">
                    
                     <img src="img/down_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSO
                    
                 </li>
                 <li id="menu_modulo_cajas_desembolsar_imp">
                    
                     <img src="img/redo_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSAR
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> IMP. DESEMBOLSO
                    
                 </li>
              </ul>  
 <div id="contenido_modulo">
                      <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">IMPRIMIR DESEMBOLSO</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
	                     <img src="img/alert_32x32.png" align="absmiddle">
	                     Verifique los datos del Desembolso para Imprimir
                     </div>




				<div id="div_impresora" class="div_impresora" style="width:860px" align="right">
				       <a href="javascript:print();">Imprimir</a>
					   <a href="cart_fac_des.php">Factura</a>
					    <!--a href='menu_s.php'>Salir</a-->
				  </div>



<?php	
	
	//Datos empresa		  
		 $con_emp = "Select *  From gral_empresa ";
         $res_emp = mysql_query($con_emp);
 	     while ($lin_emp = mysql_fetch_array($res_emp)) {
		        $emp_nom = $lin_emp['GRAL_EMP_NOMBRE'];
				$emp_ger = $lin_emp['GRAL_EMP_GERENTE'];
				$emp_cig = $lin_emp['GRAL_EMP_GER_CI'];
				$emp_dir = $lin_emp['GRAL_EMP_DIREC'];
				$emp_nit = $lin_emp['GRAL_EMP_NIT'];
				$emp_fon = $lin_emp['GRAL_EMP_DIRECTOR'];
				$_SESSION['emp_nom'] = $emp_nom;
				$_SESSION['emp_dir'] = $emp_dir;
				$_SESSION['emp_fon'] = $emp_fon;
				$_SESSION['emp_nit'] = $emp_nit;
		  }
		  
?>
<strong> 
<?php
if(isset($_SESSION['fec_proc'])){ 
  $fec_p = $_SESSION['fec_proc'];
  $fec1 = cambiaf_a_mysql_2($fec_p);
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
$cod_sol = $_SESSION['nro_sol'];
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $agen = $lin_sol['CRED_SOL_COD_AGE'];
		 $hr_reu = $lin_sol['CRED_SOL_HRA_REU'];
		 $dia_reu = $lin_sol['CRED_SOL_DIA_REU'];
		 $dir_reu = $lin_sol['CRED_SOL_DIR_REU'];
		 $f_des  = $lin_sol['CRED_SOL_FEC_DES'];
		 $f_uno  = $lin_sol['CRED_SOL_FEC_UNO'];
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER'];
		 $cod_grupo = $lin_sol['CRED_SOL_COD_GRUPO'];
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $imp_c = $lin_sol['CRED_SOL_IMP_COM'];
		 $comif = $lin_sol['CRED_SOL_COM_F'];
		 $imp_sc = $impo + $imp_c;
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $orgf = $lin_sol['CRED_SOL_ORG_FON'];
		 $plzm  = $lin_sol['CRED_SOL_PLZO_M'];
		 $plzd  = $lin_sol['CRED_SOL_PLZO_D'];
		 $cuotas = $lin_sol['CRED_SOL_NRO_CTA'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $f_pag  = $lin_sol['CRED_SOL_FORM_PAG']; 
		 $tint  = $lin_sol['CRED_SOL_TASA'];
		 $c_int = $lin_sol['CRED_SOL_CAL_INT']; 
		 $p_int = $lin_sol['CRED_SOL_AHO_F'];
		 $com_f  = $lin_sol['CRED_SOL_COM_F'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $prod = $lin_sol['CRED_SOL_PRODUCTO'];
		 $aho_f  = $lin_sol['CRED_SOL_AHO_F'];
		 $aho_fm  = $lin_sol['CRED_SOL_AHO_DM'];
		 $of_resp  = $lin_sol['CRED_SOL_OF_RESP'];
		 $_SESSION['asesor'] = leer_nombre_usr(1,$of_resp);
		 $f_des2= cambiaf_a_normal($f_des); 
		 $f_uno2= cambiaf_a_normal($f_uno); 
		 $dia = saca_dia($f_uno2);
		 $mes = saca_mes($f_uno2);
		 $ano = saca_anio($f_uno2);
		 $dia_p = dia_semana ($dia, $mes, $ano);
   }
  //Lectura Parametros
	   $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
       $res_cin = mysql_query($con_cin);
	   while ($linea = mysql_fetch_array($res_cin)) {
	        $d_cin = $linea['GRAL_PAR_INT_DESC'];
	   }
$con_pin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 11 and GRAL_PAR_INT_COD = $p_int";
       $res_pin = mysql_query($con_pin);
	   while ($linea = mysql_fetch_array($res_pin)) {
	        $d_pin = $linea['GRAL_PAR_INT_DESC'];
	   }	   

	   
	   
	   
       $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_op";
       $res_top = mysql_query($con_top);
	   while ($linea = mysql_fetch_array($res_top)) {
	        $d_top = $linea['GRAL_PAR_INT_DESC'];
	   }
	   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
			$s_mon = $linea['GRAL_PAR_INT_SIGLA'];
	   }
         $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
         $res_ahod = mysql_query($con_ahod);
		  while ($lin_ahod = mysql_fetch_array($res_ahod)) {
		        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  }
		   $con_prod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and                     GRAL_PAR_PRO_COD = $prod ";
         $res_prod = mysql_query($con_prod);
		  while ($lin_prod = mysql_fetch_array($res_prod)) {
		        $pro_d = $lin_prod['GRAL_PAR_PRO_DESC'];
		  }   
          $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa);
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  } 
if ($comi < 3){
    $con_comf  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 913 and GRAL_PAR_PRO_COD = $com_f ";
    $res_comf = mysql_query($con_comf);
	while ($lin_comf = mysql_fetch_array($res_comf)) {
	      $comi_f  = $lin_comf['GRAL_PAR_PRO_CTA1'];
	}
  }
 if ($ahod == 1){
    $con_ahof  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 914 and GRAL_PAR_PRO_COD = $aho_f ";
    $res_ahof = mysql_query($con_ahof);
	while ($lin_ahof = mysql_fetch_array($res_ahof)) {
	      $aho_fa  = $lin_ahof['GRAL_PAR_PRO_CTA1'];
		  $aho_fd  = $lin_ahof['GRAL_PAR_PRO_DESC'];
	}
  }
  $nom_grup = "-";
  //leer grupo
   if ($t_op < 3){
       $con_grup  = "Select * From cred_grupo where CRED_GRP_CODIGO = $cod_grupo and CRED_GRP_USR_BAJA is null";
       $res_grup = mysql_query($con_grup);
	   while ($lin_grup = mysql_fetch_array($res_grup)) {
	          $nom_grup  = $lin_grup['CRED_GRP_NOMBRE'];
	   }
    }	   
/*	   $con_pdte  = "Select * From cred_grupo_mesa where CRED_GRP_MES_COD = $cod_grupo and  CRED_GRP_MES_REL = 1 and CRED_GRP_MES_USR_BAJA is null";
       $res_pdte = mysql_query($con_pdte)or die('No pudo seleccionarse cred_grupo_mesa');
	   while ($lin_pdte = mysql_fetch_array($res_pdte)) {
	          $cod_pdte  = $lin_pdte['CRED_GRP_MES_CLI'];
	   }
if(isset($cod_pdte)){ 
*/ 	   
	  $consulta  = "Select CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES,CLIENTE_COD_ID
	                From cliente_general,cred_deudor  where CRED_SOL_CODIGO = $cod_sol and
					  CRED_DEU_RELACION = 'C' and
					  CLIENTE_COD = CRED_DEU_INTERNO and CLIENTE_USR_BAJA is null and CRED_DEU_USR_BAJA is null";
      $resultado = mysql_query($consulta); 
	  while ($linea = mysql_fetch_array($resultado)) {
    	    $nom_pdte = $linea['CLIENTE_NOMBRES']." ".$linea['CLIENTE_AP_PATERNO']." ".$linea['CLIENTE_AP_MATERNO'];
			$ci_cli = $linea['CLIENTE_COD_ID'];
			$_SESSION['ci_cli'] = $ci_cli;
			$_SESSION['nom_cli'] = $nom_pdte;
	     }
   	  
	//}
//Correlativos transaccion

$r = "";
$nro_cre = leer_nro_credito($agen);

$n = strlen($nro_cre);
$n2 = 4 - $n;
$nro_c = "";
$nro_cred = 0;
$nro_ctaf = 0;
$nro_ctf = 0;

if(isset($r)){ 
   for ($i = 1; $i <= $n2; $i++) {
    $r = $r."0";
    }
$nro_cred = "9".$mon.$agen."0".$t_op.$r.$nro_cre;
//echo $nro_c," ",$agen," ", $t_op," ",$r," ",$nro_cre;


//echo $nro_ctf," ",$agen," ",$r," ",$nro_cre," ",$nro_ctaf;
//echo $agen;
 $apli = 10000;
 $nro_tr_caj = leer_nro_co_cja($apli,$log_usr);
 $nro_tr_cart =  leer_nro_co_car(1,$log_usr); 
 if ($ahoi +  $ahod  > 0){
    $r = ""; 
    $nro_ctf = leer_nro_ctafon($agen);
    $n = strlen($nro_ctf);
    $n2 = 4 - $n;
    for ($i = 1; $i <= $n2; $i++) {
        $r = $r."0";
      }  
    $nro_ctaf = "7".$agen.$r.$nro_ctf;
  } 
     $nro_tr_fond = leer_nro_co_fon(1,$log_usr); 
	 }else{
	 $nro_tr_fond = 0;
	 } 
 $imp = 0;
 $eqv = 0;
 //Grabar Tablas
 //Caja
 $sum_debe_1 = 0;
 $sum_haber_1 =0;
 $sum_debe_2 = 0;
 $sum_haber_2 = 0;
 $cons_131  = "Select * From temp_ctable where SUBSTRING(temp_nro_cta,1,3) = 111 ";
 $resu_131  = mysql_query($cons_131);
 while ($lin_131 = mysql_fetch_array($resu_131)) {
       $sum_debe_1 = $lin_131['temp_debe_1'];
       $sum_haber_1 = $lin_131['temp_haber_1'];
	   $sum_debe_2 = $lin_131['temp_debe_2'];
       $sum_haber_2 = $lin_131['temp_haber_2'];
	   $tip = $lin_131['temp_tip_tra'];
	   $ope = 0;
       if ($tip == 131){
	       $desc = "Des"." ".$nom_grup." - ".$nom_pdte;
		   $ope = 6;
	      }
	   	if ($tip == 212){
	       $desc = "Fdo.Gar.Dep"." ".$nom_grup." - ".$nom_pdte;
		   $ope = 11;
	      } 
		if ($tip == 519){
	       $desc = "Com.Desem."." ".$nom_grup." - ".$nom_pdte;
		   $ope = 13;
	      } 
		 if ($tip == 513){
	       $desc = "Int.Desem."." ".$nom_grup." - ".$nom_pdte;
		   $ope = 13;
	      }        
		  
 if ($sum_haber_1 > 0){
    
     $sum_haber_1 = $sum_haber_1 * -1;
	 $sum_haber_2 = $sum_haber_2 * -1;
	 }
 // for ($i=1; $i < 3; $i = $i + 1 ) {
  //if ($i == 1){
 if ($mon == 2){
     $imp = $sum_debe_1 + $sum_haber_1;
	 $eqv = $sum_debe_2 + $sum_haber_2;
	 }else{
	 $imp = $sum_debe_1 + $sum_haber_1;
	 $eqv =  $imp;
	 }
//	 } 	 
 // if ($i == 2){
 //    $imp = $sum_haber_1;
//	 $eqv = $sum_haber_2;
//	 }
//}	 

 	
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
												 1,
												 $ope,
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
												 $mon,
												 $tc_ctb,
												 '$desc',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

}
$_SESSION['fechr_proc'] = leer_fechr_pro($nro_tr_caj);

//Fondo Garantia
 $_SESSION['ahorro'] = 0;
 $_SESSION['comision'] = 0;
 $_SESSION['interes'] = 0;
 if ($ahoi > 0){
 
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
$resultado = mysql_query($consulta);
$con_fon  = "Select * From temp_ctable where temp_tip_tra = 212 and SUBSTRING(temp_nro_cta,1,3) = 212 ";
 $res_fon = mysql_query($con_fon);
 while ($lin_fon = mysql_fetch_array($res_fon)) {
       $imp_debe_1 = $lin_fon['temp_debe_1'];
       $imp_haber_1 = $lin_fon['temp_haber_1'];
	   $imp_debe_2 = $lin_fon['temp_debe_2'];
       $imp_haber_2 = $lin_fon['temp_haber_2'];
	   $cta = $lin_fon['temp_nro_cta'];
 //echo $cta, "cta";
if ($mon == 1){
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_1;
	 $eqv = $imp_debe_1;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_1;
	 $eqv = $imp_haber_1;
	 $d_h = 2;
	 }
}	
if ($mon == 2){
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_2;
	 $eqv = $imp_debe_1;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_2;
	 $eqv = $imp_haber_1;
	 $d_h = 1;
	 }
}	
$_SESSION['ahorro'] = $imp;
 
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
												     212,
													 $d_h,
												     '$cta',
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
 }
}
//Cartera
//
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
												 1,
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
$con_car  = "Select * From temp_ctable ";
$res_car = mysql_query($con_car);
 while ($lin_car = mysql_fetch_array($res_car)) {
       $imp_debe_1 = $lin_car['temp_debe_1'];
       $imp_haber_1 = $lin_car['temp_haber_1'];
	   $imp_debe_2 = $lin_car['temp_debe_2'];
       $imp_haber_2 = $lin_car['temp_haber_2'];
	   $cta = $lin_car['temp_nro_cta'];
	   $tip = $lin_car['temp_tip_tra'];
	   
	   
	       $ccon = substr($cta, 0, 3);  
		   
 //echo $cta, "cta";
if ($mon == 1){
 if ($imp_debe_1 > 0){
     $imp = $imp_debe_1;
	 $eqv = $imp_debe_1;
	 $d_h = 1;
	 }
 if ($imp_haber_1 > 0){
     $imp = $imp_haber_1;
	 $eqv = $imp_haber_1;
	 $d_h = 2;
	 }
} 
if ($mon == 2){
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
												     1,
												     $ccon,
													 $d_h,
												     '$cta',
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
 }
// Maestro Cartera
  $consulta = "insert into cart_maestro (CART_NRO_CRED,
                                         CART_NUMERICO,
                                         CART_NRO_CRED_ANT,
										 CART_NRO_SOL,
										 CART_COD_AGEN, 
										 CART_COD_GRUPO, 
										 CART_HR_REU,
										 CART_DIA_REU,
										 CAR_DIR_REU,
										 CART_TIPO_CRED,
										 CART_TIPO_OPER,
										 CART_FEC_DES,
										 CART_FEC_UNO,
										 CART_IMPORTE,
										 CART_IMP_COM,
										 CART_COD_MON,
										 CART_AHO_INI, 
										 CART_AHO_DUR, 
										 CART_ORG_FON, 
										 CART_NRO_CTAS, 
										 CART_PLZO_M, 
										 CART_PLZO_D, 
										 CART_FORM_PAG, 
										 CART_NRO_LINEA, 
										 CART_TASA, 
										 CART_TIP_COM, 
										 CART_PER_GRA, 
										 CART_PRODUCTO, 
										 CART_SECTOR, 
										 CART_SUB_SECTOR, 
										 CART_DEPTO, 
										 CART_PROV, 
										 CART_CAL_INT, 
										 CART_OFIC_RESP, 
										 CART_USR_AUT, 
										 CART_FCH_AUT, 
										 CART_FCH_CAN, 
										 CART_QUIEN_PAG, 
										 CART_DEST_CRED, 
										 CART_ESTADO,
										 CART_MAE_USR_ALTA, 
										 CART_MAE_FCH_HR_ALTA, 
										 CART_MAE_USR_BAJA, 
										 CART_MAE_FCH_HR_BAJA) 
										 values ($nro_cred,
										         $nro_cre,
										         null,
												 $cod_sol,
												 $agen, 
										         '$grupo', 
                                                 '$hr_reu',
                                                 '$dia_reu',
                                                 '$dir_reu',
												 1,
												 $t_op,
                                                 '$f_des',
                                                 '$f_uno',
                                                 $impo, 
                                                 $imp_c,
                                                 $mon,
												 $ahoi,
		                                         $ahod,
												 $orgf,
												 $cuotas,
												 $plzm,
                                                 $plzd,	
												 $f_pag,
												 null,
												 $tint,
												 $com_f,
												 null,
												 $prod,
												 $p_int,
												 null,
												 null,
												 null,
												 $c_int,
												 '$of_resp',
												 null,
												 null,
												 null,
												 null,
												 null,
												 3,
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
// Maestro Fondo Garantia
 if ($ahoi +  $ahod > 0){
$consulta = "insert into fond_maestro (FOND_NRO_CTA,
                                         FOND_NUMERICO,
                                         FOND_NRO_CTA_ANT,
										 FOND_NRO_SOL,
										 FOND_NRO_CRED, 
										 FOND_COD_AGEN, 
										 FOND_COD_GRUPO, 
										 FOND_TIPO_OPER,
										 FOND_COD_MON,
										 FOND_PLZO_M, 
										 FOND_PLZO_D, 
										 FOND_TASA, 
										 FOND_TIP_COM, 
										 FOND_PRODUCTO, 
										 FOND_OFIC_RESP, 
										 FOND_FCH_CAN, 
										 FOND_ESTADO,
										 FOND_MAE_USR_ALTA, 
										 FOND_MAE_FCH_HR_ALTA, 
										 FOND_MAE_USR_BAJA, 
										 FOND_MAE_FCH_HR_BAJA) 
										 values ($nro_ctaf,
										         $nro_ctf,
										         null,
												 $cod_sol,
												 $nro_cred,
												 $agen, 
										         '$grupo', 
                                                 1,
                                                 $mon,
                                                 $plzm,
                                                 $plzd,	
												 null,
												 null,
												 $prod,
												 '$log_usr',
												 null,
												 3,
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
}
 //cart_deudor, fond_deudor
$con_deu  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null ";
    $res_deu = mysql_query($con_deu);
while ($lin_deu = mysql_fetch_array($res_deu)) {
      $dsol = $lin_deu['CRED_SOL_CODIGO'];
      $drel = $lin_deu['CRED_DEU_RELACION'];
	  $dint = $lin_deu['CRED_DEU_INTERNO'];
	  $did  = $lin_deu['CRED_DEU_ID'];
	  $imp  = $lin_deu['CRED_DEU_IMPORTE'];
	  $com  = $lin_deu['CRED_DEU_COMISION'];
	  $ini  = $lin_deu['CRED_DEU_AHO_INI'];
	  $dur  = $lin_deu['CRED_DEU_AHO_DUR'];
	  $cta  = $lin_deu['CRED_DEU_INT_CTA'];
//cart_deudor	
      
	  $con_cdeu = "insert into cart_deudor (CART_DEU_NCRED, 
                                         CART_DEU_SOL,
										 CART_DEU_RELACION,
										 CART_DEU_INTERNO, 
										 CART_DEU_ID,
										 CART_DEU_IMPORTE,
										 CART_DEU_COMI,
										 CART_DEU_AHO_INI,
										 CART_DEU_AHO_DUR,
										 CART_DEU_INT_CTA,
										 CART_DEU_USR_ALTA, 
										 CART_DEU_FCH_HR_ALTA, 
										 CART_DEU_USR_BAJA, 
										 CART_DEU_FCH_HR_BAJA) 
										 values ($nro_cred,
										         $cod_sol,
												 '$drel',
												 $dint,
												 '$did',
												 $imp,
												 $com,
												 $ini,
												 $dur,
												 $cta,
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$res_cdeu = mysql_query($con_cdeu); 
//fond_cliente

 if ($ahoi > 0){
if ($drel == "C"){
	$drel = "T";
	}  	  
  $con_ccli = "insert into fond_cliente (FOND_CLI_NCTA, 
                                         FOND_CLI_SOL,
										 FOND_CLI_RELACION,
										 FOND_CLI_INTERNO, 
										 FOND_CLI_ID, 
										 FOND_CLI_USR_ALTA, 
										 FOND_CLI_FCH_HR_ALTA, 
										 FOND_CLI_USR_BAJA, 
										 FOND_CLI_FCH_HR_BAJA) 
										 values ($nro_ctaf,
										         $cod_sol,
												 '$drel',
												 $dint,
												 '$did',
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$res_ccli = mysql_query($con_ccli); 
    }
}
//cart_plandp
  $nro_cta  = 0;
  $con_pld  = "Select CRED_PLD_FECHA, sum(CRED_PLD_CAPITAL), sum(CRED_PLD_INTERES), sum(CRED_PLD_AHORRO) From
              cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null group by CRED_PLD_FECHA";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
    $res_pld = mysql_query($con_pld);
	while ($lin_pld = mysql_fetch_array($res_pld)) {
	      $nro_cta = $nro_cta + 1;
	      $fec_pld = $lin_pld['CRED_PLD_FECHA'];
		  $cap_pld = $lin_pld['sum(CRED_PLD_CAPITAL)'];
		  if ($p_int == 4){
		      $int_pld = 0;
			 }else{ 
		  	  $int_pld = $lin_pld['sum(CRED_PLD_INTERES)'];
			  }
		  $aho_pld = $lin_pld['sum(CRED_PLD_AHORRO)'];
		  
		  //echo $fec_pld, $cap_pld,$int_pld,$aho_pld;
  $ins_pldp = "insert into cart_plandp(CART_PLD_NCRE, 
                                       CART_PLD_SOL,
									   CART_PLD_CTA,
									   CART_PLD_FECHA,
									   CART_PLD_CAPITAL, 
									   CART_PLD_INTERES, 
									   CART_PLD_AHORRO,
									   CART_PLD_STAT,
									   CART_PLD_USR_ALTA, 
									   CART_PLD_FCH_HR_ALTA, 
									   CART_PLD_USR_BAJA,
									   CART_PLD_FCH_HR_BAJA) 
										 values ($nro_cred,
										         $cod_sol,
												 $nro_cta,
												 '$fec_pld',
												 $cap_pld,
												 $int_pld,
												 $aho_pld,
												 'P', 
												 '$log_usr', 
												 null, 
												 null, 
												'0000-00-00 00:00:00')";
$res_pldp = mysql_query($ins_pldp); 
	}
//Ingresos por comision

$nro_tr_ingegr = leer_nro_co_ingegr(1,$log_usr); 
$cons_519  = "Select * From temp_ctable where temp_tip_tra = 519";
$resu_519  = mysql_query($cons_519);
  
 while ($lin_519 = mysql_fetch_array($resu_519)) {

       if ($lin_519['temp_debe_1'] > 0){
	       $deb_hab = 1;
		   }	
	  if ($lin_519['temp_haber_1'] > 0){
	       $deb_hab = 2;
		   } 
	$tipo = 1;
	$cta_ctbg = $lin_519['temp_nro_cta'];
    $imp_or = $lin_519['temp_debe_1'] + $lin_519['temp_haber_1'];
	$_SESSION['comision'] = $imp_or;
 
//Detalle contable de Factura

//} 



/*
?>
 <tr>
	 	<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['pag_int'], 2, '.',','); ?></th> 
		<th align="left"><?php echo encadenar(38); ?> </th>
		<th align="left" style="font-size:12px"><?php echo $descrip; ?> </th> 
		 <th align="right"><?php echo number_format($_SESSION['pag_int'], 2, '.',','); ?></th> 
	 </tr>
<?php  */
 //}



	if ($mon == 1){
	    $impo_c = $lin_519['temp_debe_1'] + $lin_519['temp_haber_1']; 
	    $imp_or = $impo_c;
		}
	if ($mon == 2){
	    $impo_c = $lin_519['temp_debe_2'] + $lin_519['temp_haber_2']; 
	    $imp_or = $lin_519['temp_debe_1'] + $lin_519['temp_haber_1']; 
		}	

	$descr = "Com.Des."." ".$nom_grup." - ".$nom_pdte;	   
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
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
									             $agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$f_tra',
												 '$descr',
												 1,
												 $imp_or,
												 $impo_c,
												 1,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 
   
	   
 }
 
 //Ingreso por interes anticipado
 $nro_tr_ingegr = leer_nro_co_ingegr(1,$log_usr); 
$cons_519  = "Select * From temp_ctable where temp_tip_tra = 513";
$resu_519  = mysql_query($cons_519);
  	
 while ($lin_519 = mysql_fetch_array($resu_519)) {
        $impo_c = 0;
       if ($lin_519['temp_debe_1'] > 0){
	       $deb_hab = 1;
		   }	
	  if ($lin_519['temp_haber_1'] > 0){
	       $deb_hab = 2;
		   } 
	$tipo = 1;
	$cta_ctbg = $lin_519['temp_nro_cta'];
    $imp_or = $lin_519['temp_debe_1'] + $lin_519['temp_haber_1'];
	$impo_c = $lin_519['temp_debe_1'] + $lin_519['temp_haber_1'];
	$_SESSION['interes'] = $imp_or;
   
	if ($mon == 2){
	    $impo_c = $lin_519['temp_debe_2'] + $lin_519['temp_haber_2']; 
	   
		}	

	if ($deb_hab == 2){
	    $imp_or = $imp_or;
		}
	$descr = "Int.Ant."." ".$nom_grup." - ".$nom_pdte;	   
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
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
									             $agen,
												 $deb_hab,
												 '$cta_ctbg',
												 $tipo,
												 '$f_tra',
												 '$descr',
												 1,
												 $imp_or,
												 $impo_c,
												 1,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 

   
 }
 	
 if ($_SESSION['nro_rec'] > 0){
    $nro_rec = $_SESSION['nro_rec'];
    $consulta = "insert into recibo_deta (REC_DET_AGEN,
	                                    REC_NRO_CRED,
                                       REC_DET_NRO,
									   REC_DET_NRO_CART,
									   REC_DET_NRO_CAJA,
									   REC_DET_IMPORTE,
					                   REC_DET_FECHA,
					                   REC_DET_ESTADO,
   				                       REC_DET_USR_ALTA,
					                   REC_DET_FCH_HR_ALTA, 
									   REC_DET_USR_BAJA, 
									   REC_DET_FCH_HR_BAJA 
									   ) values ($agen,
									             $nro_cred,
									             $nro_rec,
												 $nro_tr_cart,
												 $nro_tr_caj,
												 $imp_or,
												 '$f_tra',
												 1,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
}	
	
	
 //Actualizacion de cred_solicitud
   $act_cred_solic  = "update cred_solicitud set CRED_SOL_ESTADO=8, CRED_SOL_NRO_CRED =$nro_cred  where CRED_SOL_CODIGO = $cod_sol and CRED_SOL_USR_BAJA is null";
   $res_act_s = mysql_query($act_cred_solic) ;
 // Impresion Comprobante Cartera
 ?>
 <?php
echo encadenar(25)."DESEMBOLSO  DE  CREDITO".encadenar(80)."DESEMBOLSO  DE  CREDITO"; 
?>
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
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tr_cart; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tr_cart; ?></th>       
			
    </tr>	
	
	</table>
	</center>	


 <table border="0" width="900">
 <tr>
	    <th align="left"><?php echo "Solicitud"; ?> </th> 
		<th align="right"><?php echo $cod_sol; ?></th> 
		<th align="left"><?php echo encadenar(5);; ?></th>  
	   	<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>
		<th align="center"><?php echo encadenar(30); ?></th>     
		<th align="left"><?php echo "Solicitud"; ?> </th> 
		<th align="right"><?php echo $cod_sol; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>  
			
    </tr>	
<tr>
	    <th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="right"><?php echo  $d_top; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Producto"; ?></th> 
		<th align="right"><?php echo $pro_d; ?></th>
		<th align="center"><?php echo encadenar(30); ?></th>     
		<th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="right"><?php echo  $d_top; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Producto"; ?></th> 
		<th align="right"><?php echo $pro_d; ?></th>  
			
    </tr>	
	<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="center"><?php echo encadenar(30); ?></th>     
		<th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>  
			
    </tr>
	</table>
  <table border="0" width="900">
 <?php
	 if ($t_op < 3){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $nom_grup; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $nom_grup; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $nom_pdte; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $nom_pdte; ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
    <?php
	} else{
	?> 
	<tr>
	    <th align="left"><?php echo "Deudor"; ?> </th> 
		<td align="left"><?php echo $nom_pdte; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "Deudor"; ?></th>
		<td align="left"><?php echo $nom_pdte; ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
	
   	
	  <?php }  ?>
	  </table> 
	 <br>
      <br>
	 <?php
  if ($comif == 2){
    	$impsc = $imp_sc ;
		}
	if ($comif == 1){
    	$impsc = $impo ;
		}	
	$imposc = number_format($impsc, 2, '.',',');  
  
//     echo encadenar(2)."Desembolso a Capital".encadenar(50).$imposc.encadenar(3).$s_mon;   
 ?>
  <table border="0" width="900">
  <tr>
	    <th align="left"><?php echo "Desembolso a Capital"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $imposc; ?></th>
		<td align="right"><?php echo $s_mon; ?></th> 
		<th align="center"><?php echo encadenar(45); ?></th> 
		<th align="left"><?php echo "Desembolso a Capital"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $imposc; ?></th>
		<td align="right"><?php echo $s_mon; ?></th>  
   </tr>	 
   <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th> 
		<th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(3); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th>  
   </tr>
   </table>
   
   	
	 <?php 
	//$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    //$resultado = mysql_query($consulta);
   // while ($linea = mysql_fetch_array($resultado)) {
   //        $imp_fg = $imp_fg + $linea['CRED_DEU_AHO_INI'];
	//  }
	// $impfg = number_format($imp_fg, 2, '.',',');  
	//echo encadenar(2)."Fondo Garantia Inicio".encadenar(51)."(".$impfg.")".encadenar(3).$s_mon; 	
	
	?>
	<strong>
	
	 <table border="0" width="900">
	<?php
	 $mon_des = f_literal($impsc,1);
//	 echo encadenar(8).$mon_des.encadenar(3).$s_mon;
	 ?>
	 <tr>
	    <th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		<th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_des.encadenar(3).$s_mon; ?> </th> 
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
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_pdte; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_pdte; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
     <?php 
	 $mon_desem = $impsc - $imp_c - $_SESSION['ahorro'] - $_SESSION['interes'];
//	 echo $_SESSION['ahorro']." "."ahorro";
	 $mon_dese = number_format($mon_desem, 2, '.',','); 
	 ?>
	  <table border="0" width="900">
	  <tr>
	    <th align="left" style="font-size:10px"><?php echo encadenar(8)." MONTO ENTREGADO ".
		                                 encadenar(3).$mon_dese.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(28); ?> </th>  
		<th align="left" style="font-size:10px" ><?php echo encadenar(32); ?> </th> 
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
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal ".
		                                             encadenar(15)."Rec.".encadenar(2).$_SESSION['nro_rec'];; ?> </th> 
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal ".
		                                                encadenar(15)."Rec.".encadenar(2).$_SESSION['nro_rec'];; ?> </th> 
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(15).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(15).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
<br>

<strong> 
<?php
if ($_SESSION['ahorro'] > 0){

echo encadenar(15)."DEPOSITO INICIAL FONDO GARANTIA".encadenar(55)."DEPOSITO INICIAL FONDO GARANTIA"; 
?>
 
<table border="0" width="900">
	
	<tr>
	    <th align="center"><?php echo encadenar(16); ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(15); ?></th> 
		<th align="center"><?php echo encadenar(12); ?></th>           
	    <th align="center"><?php echo encadenar(42); ?></th>     
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
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tr_fond; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>   
	   	<th align="right"><?php echo encadenar(5).$nro_tr_fond; ?></th>    
			
    </tr>	
</table>
	
	<table border="0" width="900">
 <tr>
	    <th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="right"><?php echo $nro_ctaf; ?></th> 
		<th align="left"><?php echo encadenar(20);; ?></th>  
	   	<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>
		<th align="center"><?php echo encadenar(45); ?></th>     
		<th align="left"><?php echo "Nro. Cuenta"; ?> </th> 
		<th align="right"><?php echo $nro_ctaf; ?></th> 
		<th align="left"><?php echo encadenar(20);; ?></th>  
	   	<th align="left"><?php echo "Nro. Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>  
    </tr>	
	<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="center"><?php echo encadenar(38); ?></th>     
		<th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>  
			
    </tr>	
</table>
 <table border="0" width="900">
 <?php
	 if ($t_op < 3){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $nom_grup; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $nom_grup; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $nom_pdte; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $nom_pdte; ?></th>     
   </tr>
   	 <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
   <tr>
	    <th align="left"><?php echo encadenar(10); ?> </th> 
		<td align="left"><?php echo encadenar(10); ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo encadenar(10); ?></th>
		<td align="left"><?php echo encadenar(10); ?></th>     
   </tr>
    <?php
	} else{
	?> 
	<tr>
	    <th align="left"><?php echo "Deudor"; ?> </th> 
		<td align="left"><?php echo $nom_pdte; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "Deudor"; ?></th>
		<td align="left"><?php echo $nom_pdte; ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
	
   	
	  <?php }  ?>
	  </table> 
	 <br>

		
	 <?php 
	$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	$imp_fg = 0;
    while ($linea = mysql_fetch_array($resultado)) {
           $imp_fg = $imp_fg + $linea['CRED_DEU_AHO_INI'];
	  }
	 $impfg = number_format($imp_fg, 2, '.',',');  
//	echo encadenar(2)."Fondo Garantia Inicio".encadenar(51).$impfg.encadenar(3).$s_mon; 	
	
	?>
	<table border="0" width="900">
	 <tr>
	    <th align="left"><?php echo "Deposito Fondo Garantia Inicio"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $impfg; ?></th>
		<td align="right"><?php echo $s_mon; ?></th> 
		<th align="center"><?php echo encadenar(47); ?></th> 
		<th align="left"><?php echo "Deposito Fondo Garantia Inicio"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $impfg; ?></th>
		<td align="right"><?php echo $s_mon; ?></th>  
   </tr>	 
   
  
   </table>
	<?php 
//	echo encadenar(80)."_______________ ";
	?>
	<BR><strong>
	 <?php 
	// $mon_desem = $impsc - $imp_c - $imp_fg;
	// $mon_dese = number_format($mon_desem, 2, '.',','); 
	// echo encadenar(8)." MONTO A DESEMBOLSAR EFECTIVO ".encadenar(5).$mon_dese.encadenar(3).$s_mon;
	 ?>
	
	 <table border="0" width="900">
	 <?php
	// echo encadenar(8)." MONTO DEPOSITO FONDO GARANTIA".encadenar(5);
	 ?>
	 <br><br>
	 <?php
	 $mon_fond = f_literal( $imp_fg,1);
//	 echo encadenar(8).$mon_fond.encadenar(3).$s_mon;
	 ?>
	<tr>
	    <th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_fond.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		<th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_fond.encadenar(3).$s_mon; ?> </th> 
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
		<th align="left"><?php echo encadenar(50); ?></th>
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
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_pdte; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_pdte; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
   
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
  <br>
  
 <?php 
 }
 
  //Comision
 if ($_SESSION['comision'] > 0){ 
 echo encadenar(20)."INGRESO POR COMISION".encadenar(85)."INGRESO POR COMISION"; ?>
  <table border="0" width="900">
	
	<tr>
	    <th align="center"><?php echo encadenar(16); ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(15); ?></th> 
		<th align="center"><?php echo encadenar(12); ?></th>           
	    <th align="center"><?php echo encadenar(42); ?></th>     
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
		<th align="center"><?php echo encadenar(42); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tr_ingegr; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>   
	   	<th align="right"><?php echo encadenar(5).$nro_tr_ingegr; ?></th>  
			
    </tr>	
	
	</table>
	<?php

?>
<table border="0" width="900">
 <tr>
        <th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>
	    <th align="left"><?php echo encadenar(6); ?> </th> 
		<th align="right"><?php echo encadenar(6); ?></th> 
		<th align="left"><?php echo encadenar(25);; ?></th>  
	   	<th align="center"><?php echo encadenar(50); ?></th>     
		<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>  
		<th align="left"><?php echo encadenar(6); ?> </th> 
		<th align="right"><?php echo encadenar(6); ?></th> 
		<th align="left"><?php echo encadenar(25);; ?></th>  
	   	
    </tr>	
	<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="center"><?php echo encadenar(38); ?></th>     
		<th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>  
			
    </tr>	
</table>
<table border="0" width="900">
 <?php
	 if ($t_op < 3){
	?> 
	
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $nom_grup; ?></th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $nom_grup; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $nom_pdte; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $nom_pdte; ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
    <?php
	} else{
	?> 
	<tr>
	    <th align="left"><?php echo "Deudor"; ?> </th> 
		<td align="left"><?php echo $nom_pdte; ?></th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left"><?php echo "Deudor"; ?></th>
		<td align="left"><?php echo $nom_pdte; ?></th>     
   </tr>	
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
	
   	
	  <?php }  ?>
	  </table> 
<br>	  
<?php

$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
    $resultado = mysql_query($consulta);
	$imp_co = 0;
    while ($linea = mysql_fetch_array($resultado)) {
           $imp_co = $imp_co + $linea['CRED_DEU_COMISION'];
	  }
	 $impco = number_format($imp_co, 2, '.',',');  
	//echo encadenar(2)."Comision Desembolso".encadenar(51).$impco.encadenar(3).$s_mon; 
?>

	 <?php
	// echo encadenar(8)." MONTO COMISION".encadenar(5);
	 ?>
	 <br>
	 <?php
	 $mon_comi = f_literal( $imp_co,1);
	// echo encadenar(8).$mon_comi.encadenar(3).$s_mon;
	 ?>
  <table border="0" width="900">
	 <?php
	// echo encadenar(8)." MONTO DEPOSITO FONDO GARANTIA".encadenar(5);
	 ?>
	<tr>
	    <th align="left"><?php echo " MONTO COMISION"; ?> </th> 
		<th align="left"><?php echo $impco.encadenar(1).$s_mon; ?></th>
		<th align="left"><?php echo encadenar(50); ?> </th>  
		<th align="left"><?php echo " MONTO COMISION"; ?> </th> 
		<th align="left"><?php echo $impco.encadenar(1).$s_mon; ?></th> 
   </tr>
	<tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(4); ?></th>
		<td align="right"><?php echo encadenar(3); ?></th> 
		<th align="center"><?php echo encadenar(3); ?></th> 
	 </tr>
	 <tr>
	    <th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_comi.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(4); ?> </th>  
		<th align="left" style="font-size:12px"><?php echo encadenar(3).$mon_comi.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th> 
   </tr>
	 <tr>
	    <th align="left"><?php echo encadenar(3); ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(4); ?></th>
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
		<th align="left"><?php echo encadenar(50); ?></th>
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
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"style="font-size:10px" ><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_pdte; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_pdte; ?></th>
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
 if ($_SESSION['interes'] > 0){ 
     echo encadenar(20)."INGRESO POR INTERES".encadenar(85)."INGRESO POR INTERES";  ?>
   <table border="0" width="900">
	
	<tr>
	    <th align="center"><?php echo encadenar(16); ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(15); ?></th> 
		<th align="center"><?php echo encadenar(12); ?></th>           
	    <th align="center"><?php echo encadenar(42); ?></th>     
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
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>   
	   	<th align="right"><?php echo encadenar(5).$nro_tr_ingegr; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro. Cmpbte."; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$nro_tr_ingegr; ?></th> 
			
    </tr>	
	</table>
	<table border="0" width="900">
	<tr>
	    <th align="left"><?php echo "Solicitud"; ?> </th> 
		<th align="right"><?php echo $cod_sol; ?></th> 
		<th align="left"><?php echo encadenar(5);; ?></th>  
	   	<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>
		<th align="center"><?php echo encadenar(10); ?></th>     
		<th align="left"><?php echo "Solicitud"; ?> </th> 
		<th align="right"><?php echo $cod_sol; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Nro.Operacion"; ?></th> 
		<th align="right"><?php echo $nro_cred; ?></th>  
			
    </tr>	
	
	<tr>
	    <th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="right"><?php echo  $d_top; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Producto"; ?></th> 
		<th align="right"><?php echo $pro_d; ?></th>
		<th align="center"><?php echo encadenar(10); ?></th>     
		<th align="left"><?php echo "Tipo Operacion"; ?> </th> 
		<th align="right"><?php echo  $d_top; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Producto"; ?></th> 
		<th align="right"><?php echo $pro_d; ?></th>  
	</tr>		
	
	
	
	
	<tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_mon; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="center"><?php echo encadenar(10); ?></th>     
		<th align="left"><?php echo "Moneda"; ?> </th> 
		<th align="right"><?php echo  $d_top; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>  
			
    </tr>	
</table>

<?php

$consulta  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_USR_BAJA is null";
$resultado = mysql_query($consulta);
$imp_in = 0;
while ($linea = mysql_fetch_array($resultado)) {
      $imp_in = $imp_in + $linea['CRED_DEU_INT_CTA'];
      }	
	 $impin = number_format($imp_in, 2, '.',',');  
//	echo encadenar(2)."Interes anticipado Cred. Oportunidad".encadenar(51).$impin.encadenar(3).$s_mon; 
?>

    <?php
	 if ($t_op < 3){
	?> 
	 <table border="0" width="900">
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $nom_grup; ?></th> 
		<th align="center"><?php echo encadenar(55); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $nom_grup; ?></th>     
   </tr>	
  <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $nom_pdte; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $nom_pdte; ?></th>     
   </tr>
   	 <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $ci_cli; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "C.I."; ?></th>
		<td align="left"><?php echo  $ci_cli; ?></th>     
   </tr>
   <tr>
	    <th align="left"><?php echo encadenar(10); ?> </th> 
		<td align="left"><?php echo encadenar(10); ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo encadenar(10); ?></th>
		<td align="left"><?php echo encadenar(10); ?></th>     
   </tr>
   
   	</table> 
	  <?php }  ?>
   <table border="0" width="900">
	 <tr>
	    <th align="left"><?php echo "Int. anticipado Oportunidad"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $impin; ?></th>
		<td align="right"><?php echo $s_mon; ?></th> 
		<th align="center"><?php echo encadenar(50); ?></th> 
		<th align="left"><?php echo "Int. anticipado Oportunidad"; ?> </th> 
		<th align="center"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo $impin; ?></th>
		<td align="right"><?php echo $s_mon; ?></th>  
   </tr>	 
   
  
   </table>
   
   
	 <?php
	// echo encadenar(8)." MONTO INTERES".encadenar(5);
	 ?>
	 <br><br>
	 <?php
	 $mon_comi = f_literal( $imp_in,1);
	// echo encadenar(8).$mon_comi.encadenar(3).$s_mon;
	 ?>
  <table border="0" width="900">
	 <?php
	// echo encadenar(8)." MONTO DEPOSITO FONDO GARANTIA".encadenar(5);
	 ?>
	
	
	<tr>
	    <th align="left"><?php echo encadenar(3).$mon_comi.encadenar(3).$s_mon; ?> </th> 
		<th align="right"><?php echo encadenar(3); ?></th>
		<th align="left"><?php echo encadenar(55); ?> </th>  
		<th align="left"><?php echo encadenar(3).$mon_comi.encadenar(3).$s_mon; ?> </th> 
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
		<th align="left"><?php echo encadenar(50); ?></th>
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
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_pdte; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(50); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $nom_pdte; ?></th>
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
		                                             encadenar(25).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(3); ?> </th>  
		<th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(25).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
  
  
<?php
}
//Facturacion
if ($_SESSION['EMPRESA_TIPO'] == 2){
$cta_int = "";
$imp_int = 0;
$cta_com = "";
$imp_com = 0;
$cons_51  = "Select * From temp_ctable where SUBSTRING(temp_nro_cta,1,2) = 51";
 $resu_51  = mysql_query($cons_51);
 while ($lin_51 = mysql_fetch_array($resu_51)) {
        $cta = $lin_51['temp_nro_cta'];
        $impo = $lin_51['temp_debe_1'] + $lin_51['temp_haber_1'];
		$impo2= $lin_51['temp_debe_2'] + $lin_51['temp_haber_2'];
		if (substr($cta,0,3) == '513'){
		    $cta_int = $cta;
			
		    $imp_int = $impo;
			if ($_SESSION['mon'] == 2){
			    $imp_int = $impo2;
			}
		}
		if (substr($cta,0,3) == '519'){
		    $cta_com = $cta;
		    $imp_com = $impo;
		}
 
 }

if ($imp_int + $imp_com  > 0){
$_SESSION['nro_tr_ingegr'] = $nro_tr_ingegr;
$_SESSION['imp_int'] = $imp_int;
$_SESSION['imp_com'] = $_SESSION['comif'];
$_SESSION['cta_int'] = $cta_int;
$_SESSION['cta_com'] = $cta_com;

$cod_id = rtrim($_SESSION['ci_cli']);
					$nro_char = strlen($cod_id);
					$nitci= substr($cod_id,0,$nro_char-2);
					$ext_ci = substr($cod_id,$nro_char-2,2);

   $_SESSION['nitci'] = $nitci;
    $consulta  = "SELECT * FROM factura_cntrl  
                 ORDER BY FAC_CTRL_AGEN 
		   	     DESC LIMIT 0,1";
	$nombre = $_SESSION['nom_cli'];			 
    $resultado = mysql_query($consulta);
    $linea = mysql_fetch_array($resultado);
    $orden = $linea['FAC_CTRL_ORDEN'];
    $llave = trim($linea['FAC_CTRL_LLAVE']); //'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS';    
//	
    $fecha =  $fec1;
    $fecha_h =  $linea['FAC_CTRL_FEC_H'];
$_SESSION['fecha_h'] = cambiaf_a_normal($fecha_h);	
$monto =  $_SESSION['imp_int'] + $_SESSION['imp_com'];
if ($_SESSION['mon'] == 2){
    $monto = $monto * $_SESSION['TC_CONTAB'];
	$_SESSION['imp_int'] = $_SESSION['imp_int'] * $_SESSION['TC_CONTAB'];
	$_SESSION['imp_com'] = $_SESSION['imp_com'] * $_SESSION['TC_CONTAB'];
}

$_SESSION['monto'] = $monto;
$nfactura = leer_nro_corre_fac($orden);					
$cc7m = genCodContrl($orden, $nfactura, $nitci, $fecha, $monto, $llave);	
$_SESSION['nfactura'] = $nfactura;
$_SESSION['orden'] = $orden;
$_SESSION['cc7m'] = $cc7m;
$_SESSION['fecha_h'] = cambiaf_a_normal($fecha_h);

//if (($_SESSION['comision'] + $_SESSION['interes']) > 0){	
    // $monto =$_SESSION['comision'];
 
  $consulta = "insert into factura (FACTURA_AGEN, 
                                    FACTURA_APLI,
									FACTURA_NRO,
									FACTURA_TALON,
									FACTURA_ORDEN,
					                FACTURA_ALFA,
					                FACTURA_LLAVE,
   				                    FACTURA_NUMERICO,
					                FACTURA_ENLACE, 
									FACTURA_NOMBRE, 
									FACTURA_NIT, 
									FACTURA_MONTO,
                                    FACTURA_ESTADO,
                                    FACTURA_FECHA,
                                    FACTURA_FEC_H,
                                    FACTURA_COD_CTRL,
                                    FACTURA_USR_ALTA,
									FACTURA_FCH_HR_ALTA,
                                    FACTURA_USR_BAJA,
                                    FACTURA_FCH_HR_BAJA
                                    ) values (32,
									          6000,
											  $nro_tr_cart,
											  null,
											 '$orden',
												null,
												 '$llave',
												 $nfactura,
												  null,
												 '$nombre',
												 '$nitci',
												  $monto,
										          1,
												 '$fec1',
												 '$fecha_h',
												 '$cc7m',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta));
}

//Detalle contable de Factura




 if ($_SESSION['imp_int'] > 0){
$it =$_SESSION['imp_int'] * 0.03;
$iva = $_SESSION['imp_int'] * 0.13;
//$descrip = 'INTERES CORRIENTE';
 $consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '45502101',
											  '1',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  null)";
$resultado = mysql_query($consulta);

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204101',
											  '2',
											 $it,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
//$cta_ctbg = $_SESSION['cta_int']; 
$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '$cta_int',
											  '1',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

$consulta = "insert into factura_deta (FAC_DET_AGEN, 
                                   FAC_DET_CORRELATIVO,
									FAC_DET_CONTA,
									FAC_DET_CONCEP,
									FAC_DET_IMPORTE,
					                FAC_DET_FECHA,
									FAC_DET_ESTADO,
					                FAC_DET_USR_ALTA,
									FAC_DET_FCH_HR_ALTA,
                                    FAC_DET_USR_BAJA,
                                    FAC_DET_FCH_HR_BAJA
                                    ) values (32,
									          $nfactura,
											  '24204102',
											  '2',
											 $iva,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

$imp_int = $_SESSION['imp_int'];
$consulta = "insert into factura_tran (FAC_TRA_FACTURA, 
                                       FAC_TRA_MODULO,
									   FAC_TRA_DESCRI,
									   FAC_TRA_IMPO,
									   FAC_TRA_FECHA,
					                   FAC_TRA_ESTADO,
									   FAC_TRA_USR_ALTA,
					                   FAC_TRA_FCH_HR_ALTA,
									   FAC_TRA_USR_BAJA,
                                       FAC_TRA_FCH_HR_BAJA
                                    ) values ($nfactura,
											  6000,
											  'INTERES',
											 $imp_int,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
} 
 //}
if ($_SESSION['imp_com'] > 0){
$comi =$_SESSION['imp_com'];
$iva = $imp_com * 0.13;
$consulta = "insert into factura_tran (FAC_TRA_FACTURA, 
                                       FAC_TRA_MODULO,
									   FAC_TRA_DESCRI,
									   FAC_TRA_IMPO,
									   FAC_TRA_FECHA,
					                   FAC_TRA_ESTADO,
									   FAC_TRA_USR_ALTA,
					                   FAC_TRA_FCH_HR_ALTA,
									   FAC_TRA_USR_BAJA,
                                       FAC_TRA_FCH_HR_BAJA
                                    ) values ($nfactura,
											  6000,
											  'COMISION',
											 $comi,
											 '$fec1',
											 1,
											'$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
//$descrip = 'INTERES CORRIENTE';
 

}

}
?>

</div>

 </div> 
 <?php
		 	include("footer_in.php");
		 ?>
</body>
</html>	
<?php
}
ob_end_flush();
 ?>
 
                      