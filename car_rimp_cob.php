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
?>
<html>
<head>
<title>Reimpresiones</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_imp_des_det.js"></script>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/cajas_imp_cob_imp.js"></script> 
</head>
 
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
                  <li id="menu_modulo_cajas_imp">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                 <li id="menu_modulo_cajas_imp_cob">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS
                    
                 </li>
                 <li id="menu_modulo_cajas_imp_cob_sel">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SEL. COBROS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> IMP. COBROS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/print_64x64.png" border="0" alt="Modulo" align="absmiddle">IMPRIMIR COBROS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese la fecha de consulta para reimpresion
                     </div--> 
            

				<?php
					 $fec = $_SESSION['fec_proc'];
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					/* if ($_SESSION['monto_ven'] > 0){
					    }else{
						$_SESSION['monto_ven'] = 0;
						}*/
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
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <!--a href='cart_cobros.php'>Salir</a-->
 </div>
           
</center>
<font  size="+2">
<form name="form2" method="post" action="cobro_retro_opd_2.php" style="" onSubmit="return" >
<?php
if (isset($_POST['nro_desem'])) {
$nro_tran = $_POST['nro_desem'];
$_SESSION['nro_tran_cart'] = $nro_tran;
   }
$_SESSION['via_bs'] = 0;
 $_SESSION['via_us'] = 0;
$_SESSION['via_ah'] = 0;
 $_SESSION['cta_fon'] = 0;
$_SESSION['pag_pen'] = 0;
$_SESSION['intmora'] = 0;
$_SESSION['pag_cap'] = 0;
$_SESSION['itf'] = 0;
$_SESSION['pag_int'] = 0;
$_SESSION['pag_dev'] = 0;
$_SESSION['dep_aho'] = 0;
$_SESSION['sal_ant'] = 0;
$_SESSION['cuota'] = 0;
$_SESSION['s_est'] = 0;
$_SESSION['prox_ven'] = "";
$_SESSION['q_paga'] = "";
$_SESSION['nom_grp'] = "";
$con_car  = "Select DISTINCT CART_DTRA_FECHA,CART_DTRA_NCRE, CART_DTRA_NRO_TRAN
			 from  cart_det_tran
             where  CART_DTRA_NRO_TRAN = $nro_tran
             and CART_DTRA_TIP_TRAN = 2 
			 and CART_DTRA_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
			 
		while ($lin_car = mysql_fetch_array($res_car)) {
			        $ncre = $lin_car['CART_DTRA_NCRE'];
					$nro_tra = $lin_car['CART_DTRA_NRO_TRAN'];
					$fec_tra = $lin_car['CART_DTRA_FECHA'];	
					$_SESSION['fec_proc'] = cambiaf_a_normal($fec_tra);
					 $nro_cred = $ncre;
	//consulta cliente		 
		$_SESSION['ncre']=$ncre;
			 $con_cli  = "Select * From  cart_deudor, cliente_general
             where  CART_DEU_NCRED = $ncre
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null "; 
             $res_cli = mysql_query($con_cli);
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $nom_cli = $lin_cli['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_cli['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_cli['CLIENTE_NOMBRES'].encadenar(1); 
					$ci_cli = $lin_cli['CLIENTE_COD_ID'];
					 $_SESSION['nom_cli'] = $nom_cli;
				}
//Consulta Maestro

$con_cli  = "Select * From  cart_maestro
                     where  CART_NRO_CRED = $ncre
                     and CART_MAE_USR_BAJA is null "; 
        $res_cli = mysql_query($con_cli);
 
             while ($lin_cli = mysql_fetch_array($res_cli)) {
				 $c_grup = $lin_cli['CART_COD_GRUPO'];
				 $cod_sol =  $lin_cli['CART_NRO_SOL'];
				 $t_ope = $lin_cli['CART_TIPO_OPER'];
				 $prod = $lin_cli['CART_PRODUCTO'];
				 $mon = $lin_cli['CART_COD_MON'];
				 $comif = $lin_cli['CART_TIP_COM'];
				 $impo = $lin_cli['CART_IMPORTE'];
				 $imp_c = $lin_cli['CART_IMP_COM'];
				 $ases = $lin_cli['CART_OFIC_RESP'];
				  $t_cred = $lin_cli['CART_TIPO_CRED'];
				 $_SESSION['ahorro'] = $lin_cli['CART_AHO_INI'];
				$_SESSION['fechr_proc'] = $lin_cli['CART_MAE_FCH_HR_ALTA'];
				 
				 $_SESSION['asesor'] = leer_nombre_usr($t_cred,$ases);
				 $_SESSION['comision'] = $imp_c;
				$_SESSION['cuotas'] = $lin_cli['CART_NRO_CTAS']; 
				 $nom_grup = $lin_cli['CART_COD_GRUPO'];
				 
	  $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_ope";
       $res_top = mysql_query($con_top);
	   while ($linea = mysql_fetch_array($res_top)) {
	        $d_top = $linea['GRAL_PAR_INT_DESC'];
	   }
 $con_prod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and                     GRAL_PAR_PRO_COD = $prod ";
         $res_prod = mysql_query($con_prod);
		  while ($lin_prod = mysql_fetch_array($res_prod)) {
		        $pro_d = $lin_prod['GRAL_PAR_PRO_DESC'];
		  }	   
		  
  $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
			$s_mon = $linea['GRAL_PAR_INT_SIGLA'];
			$_SESSION['des_mon'] = $d_mon;
	   }		  
		  
	if ($c_grup > 0){		
		  $con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
          $res_grp = mysql_query($con_grp);
	      while ($lin_grp = mysql_fetch_array($res_grp)) {
	             $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
				 $_SESSION['nom_grp'] = $nom_grp;
		      }	
			}  	  
	   			 
				 
		//		 $d_top
				 
				 
				 
				 
				 
			}				
   }
 $con_cab  = "Select * From  cart_cabecera
                     where  CART_CAB_NCRE = $ncre
					 and CART_CAB_NRO_TRAN = $nro_tran
                     and CART_CAB_TIP_TRAN = 2 
			         and CART_CAB_USR_BAJA is null";
                     
        $res_cab = mysql_query($con_cab);
 
             while ($lin_cab = mysql_fetch_array($res_cab)) {
			       $_SESSION['cuota'] = $lin_cab['CART_CAB_NRO_CTA'];
			       $_SESSION['sal_ant'] =  $lin_cab['CART_CAB_SAL_ANT'];
				   $_SESSION['nom_rec'] = $lin_cab['CART_CAB_USR_ALTA'];
				   $est =  $lin_cab['CART_CAB_EST_ANT'];
			 $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
          $res_est = mysql_query($con_est);
	      while ($linea = mysql_fetch_array($res_est)) {
	             $d_est = $linea['GRAL_PAR_PRO_DESC'];
	             $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
				 $_SESSION['s_est'] = $d_est;
	         }  	 
			 
			 }
			 
 $con_tran  = "Select * From  cart_det_tran
                     where  CART_DTRA_NCRE = $ncre
					 and CART_DTRA_NRO_TRAN = $nro_tran
                     and CART_DTRA_TIP_TRAN = 2 
			         and CART_DTRA_USR_BAJA is null";
                     
        $res_tran = mysql_query($con_tran);
 
             while ($lin_tran = mysql_fetch_array($res_tran)) {
			        $f_tran =  $lin_tran['CART_DTRA_FEC_TRAN'];
					$cta_con = $lin_tran['CART_DTRA_CTA_CBT'];
			 $tcam_tran = $lin_tran['CART_DTRA_TIP_CAM'];
			       $ccon = $lin_tran['CART_DTRA_CCON'];
				   $deb_hab = $lin_tran['CART_DTRA_DEB_CRE'];
			    if ($ccon == 111){
				    $mone = substr($cta_con,5,1);
					if ($mon == 2){
					  if ($mone == 1){
				     $_SESSION['via_bs'] = $lin_tran['CART_DTRA_IMPO']/$_SESSION['TC_VENTA'];
					 $_SESSION['monto_ven'] = $lin_tran['CART_DTRA_IMPO'];
					 }
					 }
				if ($mon == 1){
					  if ($mone == 1){
				     $_SESSION['via_bs'] = $lin_tran['CART_DTRA_IMPO'];
					 //$_SESSION['monto_ven'] = $lin_tran['CART_DTRA_IMPO'];
					 }
					 }	 
				}
				if ($ccon == 212){
				     if ($deb_hab == 2){
				         $_SESSION['dep_aho'] = $lin_tran['CART_DTRA_IMPO'];
					}
					if ($deb_hab == 1){
				         $_SESSION['via_ah'] = $lin_tran['CART_DTRA_IMPO'];
					}	 
				}
			     if ($ccon >= 131){
				     if ($ccon <= 134){
				     $_SESSION['pag_cap'] = $lin_tran['CART_DTRA_IMPO'];
                   }				
				}
				if ($ccon == 513){
				     $_SESSION['pag_int'] = $lin_tran['CART_DTRA_IMPO'];
				}
				if ($ccon == 138){
				     $_SESSION['pag_dev'] = $lin_tran['CART_DTRA_IMPO'];
				}
				if ($ccon == 515){
				     $_SESSION['intmora'] = $lin_tran['CART_DTRA_IMPO'];
				}
				if ($ccon == 242){
				     $_SESSION['itf'] = $lin_tran['CART_DTRA_IMPO']/ $tcam_tran;
				}
				if ($ccon == 525){
				     $_SESSION['pag_pen'] = $lin_tran['CART_DTRA_IMPO'];
				}

			 }



echo encadenar(5)."BOLETA DE PAGO  Reimpresa  ".encadenar(35)."BOLETA DE PAGO   Reimpresa  "; 
?>	
</font>
<?php if (isset($_SESSION['monto_com'])){
         }else{
		 $_SESSION['monto_com'] = 0;
		 }
// echo  encadenar(10)."BOLETA DE PAGO EN".encadenar(2).$_SESSION['des_mon'] ; ?>

 <table border="0" width="1000">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Nro.Compbte"; ?></th>  
	   	<th align="right"><?php echo encadenar(5).$_SESSION['nro_tran_cart']; ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Nro.Compbte"; ?></th>  
		<th align="right"><?php echo encadenar(5).$_SESSION['nro_tran_cart']; ?></th>     
			
    </tr>	
	
 <tr>
	    <th align="left"><?php echo "Nro.Operacion".encadenar(2).$_SESSION['ncre']; ?> </th> 
		<th align="left"><?php echo encadenar(5); ?></th> 
		<th align="left"><?php echo "Total Cuotas"; ?></th> 
		<th align="right"><?php echo $_SESSION['cuotas']; ?></th>
		<th align="left"><?php echo encadenar(21); ?></th>  
		 <th align="left"><?php echo "Nro.Operacion".encadenar(2).$_SESSION['ncre']; ?> </th> 
		<th align="left"><?php echo encadenar(5); ?></th> 
		<th align="left"><?php echo "Total Cuotas"; ?></th> 
		<th align="right"><?php echo $_SESSION['cuotas']; ?></th>
			
    </tr>	
 	</table> 	
 <table border="0" width="1000">
	 <?php
	 if ($_SESSION['nom_grp'] <> ""){
	?> 
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th> 
		<th align="center"><?php echo encadenar(15); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th>     
   </tr>
   <tr>
	    <th align="left"><?php echo "Presidente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(15); ?></th>
		<th align="left"><?php echo "Presidente"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th>     
   </tr>
   	<?php }else{  ?> 
  <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(22); ?></th>
		<th align="left"><?php echo "Cliente"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th>     
   </tr>
   <?php }  ?> 
   	</table> 
      
<table border="0" width="1000">
<tr>
        <tr>
	    <th align="left"><?php echo "Moneda".encadenar(3).$_SESSION['des_mon']; ?> </th> 
		<th align="left"><?php echo encadenar(25); ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
		<th align="left"><?php echo encadenar(30); ?></th>  
		 <th align="left"><?php echo "Moneda".encadenar(3).$_SESSION['des_mon']; ?> </th> 
		<th align="left"><?php echo encadenar(25); ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th> 
		<th align="right"><?php echo $_SESSION['asesor']; ?></th>
			
   
</table>
<table border="0" width="1000">
<tr>
	    <th align="left"><?php echo "Vias de Pago"; ?> </th> 
		<td align="left"><?php echo encadenar(6); ?></th> 
		<td align="left"><?php echo encadenar(6); ?></th> 
		<td align="left"><?php echo encadenar(12); ?></th>
		<th align="center"><?php echo encadenar(40); ?></th>
		<th align="left"><?php echo "Vias de Pago"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th> 
		<td align="left"><?php echo encadenar(6); ?></th>  
		<td align="left"><?php echo encadenar(12); ?></th>
   </tr>	

<?php if ($_SESSION['des_mon'] == "BOLIVIANOS") { ?>
      <tr>
        <th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',','); ?></td>
		<th align="center"><?php echo encadenar(45); ?></th>
		<th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',',').
		encadenar(25); ?></td>
		</tr>
		<tr>
		
		<?php if ($_SESSION['via_us'] > 0) { ?>   
		<th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_COMPRA'], 2, '.',',').encadenar(1); ?></td>
		<td align="right"><?php echo number_format($_SESSION['monto_com'], 2, '.',',');?></td> 
		<th align="center"><?php echo encadenar(45); ?></th> 
		<th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_COMPRA'], 2, '.',',').encadenar(1); ?></td>
		<td align="right"><?php echo number_format($_SESSION['monto_com'], 2, '.',',').
		encadenar(25);?></td>  
		<?php }?>
		 
	</tr>
	<tr>
         <th align="left"><?php echo "Fondo Garantia :".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fon']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',','); ?></td>
		 <th align="center"><?php echo encadenar(45); ?></th> 
		 <th align="left"><?php echo "Fondo Garantia :".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fon']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',',').
		encadenar(25); ?></td>
		</tr>
	<tr>
		
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_bs']+$_SESSION['monto_com']+
		                                $_SESSION['via_ah'], 2, '.',','); ?></th>
		<th align="left"><?php echo encadenar(45); ?></th>
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_bs']+$_SESSION['monto_com']+
		                                $_SESSION['via_ah'], 2, '.',',').encadenar(25); ?></th>        
	</tr>
	 <?php }?>
	<?php if ($_SESSION['des_mon'] == "DOLARES") { ?>
      <tr>
	   <th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_us'], 2, '.',','); ?></td>
		<th align="center"><?php echo encadenar(45); ?></th>
		<th align="left"><?php echo "Dolares :"; ?></th>
		<td align="left"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_us'], 2, '.',',').
		encadenar(25); ?></td>
      </tr> 
		<?php if ($_SESSION['via_bs'] > 0) { ?> 
		<th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['monto_ven'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_VENTA'], 2, '.',',').encadenar(1); ?></td>
	 	<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',',');?></td> 
		<th align="center"><?php echo encadenar(45); ?></th> 
		<th align="left"><?php echo "Bolivianos :"; ?></th>
		<td align="left"><?php echo number_format($_SESSION['monto_ven'], 2, '.',','); ?></td> 
		<td align="left"><?php echo encadenar(1)."TC. ".encadenar(1).
		             number_format($_SESSION['TC_VENTA'], 2, '.',',').encadenar(1); ?></td>
		<td align="right"><?php echo number_format($_SESSION['via_bs'], 2, '.',',').
		encadenar(25);?></td>  
		<?php }?>
	</tr>
	<tr>
         <th align="left"><?php echo "Fondo Garantia :".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fon']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',','); ?></td>
		 <th align="center"><?php echo encadenar(45); ?></th> 
		 <th align="left"><?php echo "Fondo Garantia:".encadenar(2); ?></th>
		 <td align="left"><?php echo $_SESSION['cta_fon']; ?></th>
		 <td align="left"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo  number_format($_SESSION['via_ah'], 2, '.',',').
		encadenar(25); ?></td>
		</tr>
	
	<tr>
        <tr>
		
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_us']+$_SESSION['via_bs']+
		                                $_SESSION['via_ah'], 2, '.',','); ?></th>
		<th align="left"><?php echo encadenar(45); ?></th>
		<th align="left"><?php echo "Total :".encadenar(2); ?></th>
		<td align="left"><?php echo encadenar(5); ?></td>
		<td align="left"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['via_us']+$_SESSION['via_bs']+
		                                $_SESSION['via_ah'], 2, '.',',').encadenar(25); ?></th>        
	</tr>
		 <?php }?> 
</table>	

</font>
 <table border="0" width="1000">
   
    <tr>
	    <th align="left"><?php echo "Detalle"; ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Capital"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_cap'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(38); ?></td>
		<th align="left"><?php echo "Detalle"; ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Capital"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_cap'], 2, '.',','); ?></td>
     </tr>
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes F"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_dev'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes F"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_dev'], 2, '.',','); ?></td>
     </tr>
    <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_int'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_int'], 2, '.',','); ?></td>
     </tr>
		<?php if ($_SESSION['intmora'] > 0) { ?>  
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Vencido"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['intmora'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Vencido"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['intmora'], 2, '.',','); ?></td>
     </tr> 
	  <?php }?> 
	  <?php if ($_SESSION['pag_pen'] > 0) { ?>  
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Penal"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_pen'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Interes Penal"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['pag_pen'], 2, '.',','); ?></td>
     </tr> 
	  <?php }?> 
	  	  <?php if ($_SESSION['pag_pen'] > 0) { ?>  

	<tr>
	    <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Fondo Garantia"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['dep_aho'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Fondo Garantia"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['dep_aho'], 2, '.',','); ?></td>
     </tr> 
	 <?php }?> 
	 		<?php if ($_SESSION['itf'] > 0) { ?>  
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "ITF"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['itf'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		<th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "ITF"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['itf'], 2, '.',','); ?></td>
     </tr> 
	  <?php }?> 
	 <tr>
	     <th align="left"><?php echo encadenar(7); ?></th>
	    <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Total"; ?></th>
		<th align="right"><?php echo number_format( $_SESSION['pag_cap'] 
		                                          + $_SESSION['pag_int']
												  + $_SESSION['pag_pen']
												  + $_SESSION['pag_dev']
												  + $_SESSION['dep_aho']
												  + $_SESSION['intmora']
												  + $_SESSION['itf'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(35); ?></td>
		 <th align="left"><?php echo encadenar(7); ?></th>
		 <th align="left"><?php echo encadenar(2); ?></th>
        <th align="left"><?php echo "Total"; ?></th>
		<th align="right"><?php echo number_format( $_SESSION['pag_cap'] 
		                                          + $_SESSION['pag_int']
												  + $_SESSION['pag_dev']
												   + $_SESSION['pag_pen']
												  + $_SESSION['dep_aho']
												  + $_SESSION['intmora']
												  + $_SESSION['itf'], 2, '.',','); ?></td>										  
     </tr>
</table>
 
  <?php
     $imp_t = round($_SESSION['pag_cap'] + $_SESSION['pag_int'] + $_SESSION['dep_aho'] + $_SESSION['pag_pen']+$_SESSION['itf']+$_SESSION['pag_dev'],2);
	// echo $imp_t;
	 $mon_des = f_literal($imp_t,1);
 ?>
 <table border="0" width="1000">

 <tr>
	    <td align="left"><?php echo  "Son:".encadenar(2); ?></td>
        <td align="left"><?php echo $mon_des.encadenar(2).$_SESSION['des_mon']; ?></td>
		<th align="left"><?php echo  encadenar(28); ?></th>
		<td align="left"><?php echo  "Son:".encadenar(2); ?></td>
        <td align="left"><?php echo $mon_des.encadenar(2).$_SESSION['des_mon']; ?></td>
     </tr>

</table>
<table border="0" width="1000">	 
	<tr>
	   
        <th align="left" style="font-size:12px"><?php echo "Cta. Pagada".encadenar(2)
		.$_SESSION['cuota']; ?></th>
		<th align="left" style="font-size:12px"><?php echo "Est. Actual"; ?></th>
		<td align="left"><?php echo  $_SESSION['s_est']; ?></td>
		<th align="left"  style="font-size:12px"><?php echo "Prox.Vcto."
		.encadenar(1).cambiaf_a_normal($_SESSION['prox_ven']); ?></th>
		<td align="left"><?php echo  encadenar(50); ?></td>
		  <th align="left" style="font-size:12px"><?php echo "Cta. Pagada".encadenar(2)
		.$_SESSION['cuota']; ?></th>
		<th align="left" style="font-size:12px"><?php echo "Est. Actual"; ?></th>
		<td align="left"><?php echo  $_SESSION['s_est']; ?></td>
		<th align="left"  style="font-size:12px"><?php echo "Prox.Vcto."
		.encadenar(1).cambiaf_a_normal($_SESSION['prox_ven']); ?></th>
     </tr> 

    <tr>
	   <th align="left" style="font-size:10px"><?php echo "Saldo antes de Pago"; ?></th>
	   <td align="right"><?php echo  number_format($_SESSION['sal_ant'], 2, '.',','); ?></td>
	   <th align="left" style="font-size:10px"><?php echo "Saldo despues de Pago"; ?></th>
	  <?php if (($_SESSION['sal_ant']- $_SESSION['pag_cap']) > 0 ) { ?>   
	   <td align="right"><?php echo  number_format($_SESSION['sal_ant']- $_SESSION['pag_cap'] , 2, '.',','); ?></td>
	   <?php }else{?>
	   <td align="right"><?php echo  "CANCELADO"; ?></td>
	   <?php }?>
       <td align="left"><?php echo  encadenar(50); ?></td>
	  <th align="left" style="font-size:10px"><?php echo "Saldo antes de Pago"; ?></th>
	  <td align="right"><?php echo number_format($_SESSION['sal_ant'] , 2, '.',','); ?></td>
	  <th align="left" style="font-size:10px"><?php echo "Saldo despues de Pago"; ?></th>
	  <?php if (($_SESSION['sal_ant']- $_SESSION['pag_cap']) > 0 ) { ?>   
	   <td align="right"><?php echo  number_format($_SESSION['sal_ant']- $_SESSION['pag_cap'] , 2, '.',','); ?></td>
	   <?php }else{?>
	   <td align="right"><?php echo  "CANCELADO"; ?></td>
	   <?php }?>
     </tr>
</table>
<table border="0" width="1000">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	 
	 <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "__________________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "__________________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px" ><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(30); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center" style="font-size:10px"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center" style="font-size:10px"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
    </table>
  <table border="0" width="1000">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo  "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(45); ?> </th>  
		<th align="left" style="font-size:11px" ><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		
   </tr>
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                              encadenar(30).$_SESSION['fechr_proc']; ?></th>
		<th align="left"><?php echo encadenar(10); ?> </th>  
		 <th align="left" style="font-size:11px"><?php echo "Antes de firmar verifique los datos".
		                                             encadenar(30).$_SESSION['fechr_proc']; ?></th>
   </tr>
</table>
  <br>
  <?php 
 /* if (($_SESSION['cond_int'] + $_SESSION['cond_intm']) > 0){
   //echo ($_SESSION['cond_int'] + $_SESSION['cond_intm'])."suma" ?> 
  
 <table border="0" width="1000">
	<tr>
	    <th align="left"><?php echo $emp_nom; ?> </th> 
		<th align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cochabamba"; ?></th>  
	   	<td align="right"><?php echo $_SESSION['fec_proc']; ?></th> 
		<th align="center"><?php echo encadenar(24); ?></th>
		<th align="left"><?php echo $emp_nom; ?></th>
		<th align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cochabamba"; ?></th>  
		<td align="right"><?php echo $_SESSION['fec_proc']; ?></th>     
			
    </tr>	
	<tr>
	    <td align="left"><?php echo $emp_dir; ?> </th> 
		<td align="center"><?php echo encadenar(20); ?></th> 
		<th align="left"><?php echo "Cte Cartera"; ?></th>  
	   	<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tran_cart']; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<td align="left"><?php echo $emp_dir; ?></th>
		<td align="center"><?php echo encadenar(20); ?></th>     
		<th align="left"><?php echo "Cte Cartera"; ?></th>  
		<th align="right"><?php echo "Nro.".encadenar(5).$_SESSION['nro_tran_cart']; ?></th>     
			
    </tr>	
	
	</table>
	</center>
	<strong>
	<?php
echo encadenar(25)."CONDONACION".encadenar(90)."CONDONACION";
?>	
<table border="0" width="900">
 <tr>
	    <th align="left"><?php echo "Nro.Operacion"; ?> </th> 
		<th align="right"><?php echo $_SESSION['ncre']; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo encadenar(6); ?></th> 
		<th align="right"><?php echo encadenar(6); ?></th>
		<th align="center"><?php echo encadenar(12); ?></th>     
		<th align="left"><?php echo "Nro.Operacion"; ?> </th> 
		<th align="right"><?php echo  $_SESSION['ncre']; ?></th> 
		<th align="left"><?php echo encadenar(15);; ?></th>  
	   	<th align="left"><?php echo encadenar(6); ?></th> 
		<th align="right"><?php echo encadenar(6); ?></th>  
			
    </tr>	

	</table>
 <table border="0" width="1100">
<tr>
	    <th align="left"><?php echo "Cajero"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_rec']; ?></th> 
		<th align="left"><?php echo "Asesor "; ?></th>  
	   	<td align="left"><?php echo $_SESSION['asesor']; ?></th> 
		<th align="center"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo "Cajero"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_rec']; ?></th>     
		<th align="left"><?php echo "Asesor "; ?></th>  
		<td align="left"><?php echo $_SESSION['asesor']; ?></th>     
			
    </tr>	
</table>
 <table border="0" width="900">
	 <?php
	 if ($_SESSION['nom_grp'] <> ""){
	?> 
<tr>
	    <th align="left"><?php echo "Grupo"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Grupo"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_grp']; ?></th>     
   </tr>
   	<?php }  ?> 
  <tr>
	    <th align="left"><?php echo "Cliente"; ?> </th> 
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "Cliente"; ?></th>
		<td align="left"><?php echo $_SESSION['nom_cli']; ?></th>     
   </tr>
   <tr>
	    <th align="left"><?php echo "C.I."; ?> </th> 
		<td align="left"><?php echo $_SESSION['ci']; ?></th> 
		<th align="center"><?php echo encadenar(9); ?></th>
		<th align="left"><?php echo "C.I"; ?></th>
		<td align="left"><?php echo $_SESSION['ci']; ?></th>     
   </tr>	
    <tr>
	    <th align="left"><?php echo "Moneda"; ?> </th> 
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th> 
		<th align="center"><?php echo encadenar(6); ?></th>
		<th align="left"><?php echo "Moneda"; ?></th>
		<td align="left"><?php echo $_SESSION['des_mon']; ?></th>     
   </tr>	
   	</table>
	<br><br>
 <table border="0" width="1000">
<?php  if ($_SESSION['cond_intm'] > 0){    ?>

 <tr>
	    <th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Mora"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_intm'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(15); ?></td>
		<th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Mora"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_intm'], 2, '.',','); ?></td>
     </tr>
<?php  }     ?>
<?php  if ($_SESSION['cond_int'] > 0){    ?>

 <tr>
	    <th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Corriente"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_int'], 2, '.',','); ?></td>
		<td align="right"><?php echo encadenar(15); ?></td>
		<th align="left"><?php echo encadenar(8); ?></th>
        <th align="left"><?php echo "Interes Corriente"; ?></th>
		<td align="right"><?php echo number_format( $_SESSION['cond_int'], 2, '.',','); ?></td>
     </tr>
<?php  }    ?>
</table>
 <?php
     $imp_t = $_SESSION['cond_intm'] + $_SESSION['cond_int'];
	 $mon_des = f_literal($imp_t,1);
 ?>
 <table border="0" width="1000">

 <tr>
	    <td align="left"><?php echo  "Son:"; ?></td>
        <td align="right"><?php echo $mon_des; ?></td>
		<th align="left"><?php echo  encadenar(15); ?></th>
		<td align="left"><?php echo  "Son:"; ?></td>
        <td align="right"><?php echo $mon_des; ?></td>
     </tr>

</table>
<table border="0" width="1000">	 
	  <tr>
	    <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
     </tr>
	  <tr>
	     <th align="left"><?php echo encadenar(5); ?></th>
        <th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(15); ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
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
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo "_______________"; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		
	 </tr>
    	 <th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="left"><?php echo encadenar(10); ?></th>
		<th align="left"><?php echo encadenar(5); ?></th>
        <th align="center"><?php echo $_SESSION['nom_rec']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo $_SESSION['q_paga']; ?></th>
		<td align="right"><?php echo encadenar(5); ?></td>
	 </tr>

  </table>
    </table>
  <table border="0" width="1000">  
    <tr>
	    <th align="left" style="font-size:11px"><?php echo "Nota: No valido como Credito Fiscal "; ?> </th> 
		<th align="left"><?php echo encadenar(3); ?> </th>  
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








<?php  }   */  ?>
  
  </center>
 
	 
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