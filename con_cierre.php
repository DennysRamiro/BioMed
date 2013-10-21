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
?>
<html>
<head>
<!--Titulo de la pesta�a de la pagina-->
<title>Registro Contable de Cierre D&iacute;a</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-ui.js"></script>

<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 
<script type="text/javascript" src="js/ModulosCartera.js"></script>
</head>
<body>

<div id="dialog-confirmCierre" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Esta seguro de hacer el Cierre Diario?</font></p>
</div>

	<?php
				include("header.php");
			?>
<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/padlock closed_24x24.png" border="0" alt="Modulo" align="absmiddle"> CIERRE DIARIO
                    
                 </li>
              </ul>  


 <div id="contenido_modulo">

                      <h2> <img src="img/padlock closed_64x64.png" border="0" alt="Modulo" align="absmiddle"> CIERRE DIARIO</h2>
                      <hr style="border:1px dashed #767676;">
                       
<?php
					// $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
<form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
  
<?php
 $_SESSION['continuar'] = 0;
 if ($_SESSION['cargo'] == 2){ 
      echo "Usuario no Habilitado para este proceso ".encadenar(2)." !!!!!";
      $_SESSION['continuar'] = 1;
	  
?>
<br>
<center>
  <!--input class="btn_form" type="submit" name="accion" value="Salir_Opc"-->
     
</form>	
<?php
 
 }
$_SESSION['continuar'] = 0;
 $cierre_dia = verif_cierre_dia($fec1);
 if ($cierre_dia > 0){ 
      echo "El cierre fue realizado ".encadenar(2)." !!!!!";
      $_SESSION['continuar'] = 1;
	  
?>
<br>
<center>
  <!--input class="btn_form" type="submit" name="accion" value="Salir_Opc"-->
     
</form>	
<?php
 
 }


if ($_SESSION['continuar'] == 0){
    $_SESSION['diferencia'] = 0;
    $_SESSION['detalle'] = 1;
    $_SESSION['cuantos'] = 0;
    $borr_cob  = "Delete From temp_ctable"; 
    $cob_borr = mysql_query($borr_cob);
 //   }
if ($_SESSION['detalle'] == 1){
    // cobros y desembolsos
    $con_cart  = "select  CART_DTRA_CTA_CBT, sum(CART_DTRA_IMPO),sum(CART_DTRA_IMPO_BS) from                  cart_det_tran where CART_DTRA_FEC_TRAN = '$fec1' and CART_DTRA_DEB_CRE = 2
	             and (CART_DTRA_TIP_TRAN = 1 or CART_DTRA_TIP_TRAN = 2 or CART_DTRA_TIP_TRAN = 5)
				   and CART_DTRA_USR_BAJA is null
	              group by CART_DTRA_CTA_CBT";
    $res_cart = mysql_query($con_cart); 
	while ($lin_cart = mysql_fetch_array($res_cart)) {
	    //    $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
			$cuenta = $lin_cart['CART_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				$mon_eqv = 0;
				}else{
			    $monto2  = round($lin_cart['sum(CART_DTRA_IMPO_BS)'],2);
				$mon_eqv = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				}
			$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (6000,
										   '$cuenta',
									       '$des_cta',
										   0,
										   $monto2,
										   0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta);
					
			?>
   
	<?php } ?>
	<?php 
	
	 $con_cart  = "select  CART_DTRA_CTA_CBT, sum(CART_DTRA_IMPO), sum(CART_DTRA_IMPO_BS) from                   cart_det_tran  where CART_DTRA_FEC_TRAN = '$fec1' and CART_DTRA_DEB_CRE = 1 
	             and (CART_DTRA_TIP_TRAN = 1 or CART_DTRA_TIP_TRAN = 2 or CART_DTRA_TIP_TRAN = 5)
				  and CART_DTRA_USR_BAJA is null 
				   group by CART_DTRA_CTA_CBT";
    $res_cart = mysql_query($con_cart); 
	while ($lin_cart = mysql_fetch_array($res_cart)) {
	      //  $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
			$cuenta = $lin_cart['CART_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				$mon_eqv = 0;
				}else{
			    $monto2  = round($lin_cart['sum(CART_DTRA_IMPO_BS)'],2);
				$mon_eqv = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				}
				$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (6000,
										   '$cuenta',
									       '$des_cta',
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta);
			
				?>
        
	<?php } 
	// traspasos
    $con_cart  = "select  CART_DTRA_CTA_CBT, sum(CART_DTRA_IMPO),sum(CART_DTRA_IMPO_BS) from                  cart_det_tran where CART_DTRA_FEC_TRAN = '$fec1' and CART_DTRA_DEB_CRE = 2
	              and CART_DTRA_TIP_TRAN = 3 and CART_DTRA_USR_BAJA is null
	              group by CART_DTRA_CTA_CBT";
    $res_cart = mysql_query($con_cart); 
	while ($lin_cart = mysql_fetch_array($res_cart)) {
	    //    $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
			$cuenta = $lin_cart['CART_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				$mon_eqv = 0;
				}else{
			    $monto2  = round($lin_cart['sum(CART_DTRA_IMPO_BS)'],2);
				$mon_eqv = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				}
			$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (6001,
										   '$cuenta',
									       '$des_cta',
										   0,
										   $monto2,
										   0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta);
					
			?>
   
	<?php } ?>
	<?php 
	
	 $con_cart  = "select  CART_DTRA_CTA_CBT, sum(CART_DTRA_IMPO), sum(CART_DTRA_IMPO_BS) from                   cart_det_tran  where CART_DTRA_FEC_TRAN = '$fec1' and CART_DTRA_DEB_CRE = 1 
	               and CART_DTRA_TIP_TRAN = 3 and CART_DTRA_USR_BAJA is null group by CART_DTRA_CTA_CBT";
    $res_cart = mysql_query($con_cart); 
	while ($lin_cart = mysql_fetch_array($res_cart)) {
	      //  $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
			$cuenta = $lin_cart['CART_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				$mon_eqv = 0;
				}else{
			    $monto2  = round($lin_cart['sum(CART_DTRA_IMPO_BS)'],2);
				$mon_eqv = round($lin_cart['sum(CART_DTRA_IMPO)'],2);
				}
				$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (6001,
										   '$cuenta',
									       '$des_cta',
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta);
			
				?>
        
	<?php }
	
	
	
	
	
	
	
	
	
	
	
	//echo "entra a fondo";
/*	$con_fond  = "select  FOND_DTRA_CTA_CBT, sum(FOND_DTRA_IMPO), sum(FOND_DTRA_IMPO_BS) from fond_det_tran 
	              where FOND_DTRA_FEC_TRAN = '$fec1' and FOND_DTRA_DEB_CRE = 1
	              and FOND_DTRA_NRO_CTA = 2 and FOND_DTRA_USR_BAJA is null
				   group by FOND_DTRA_CTA_CBT";
    $res_fond = mysql_query($con_fond); 
	while ($lin_fond = mysql_fetch_array($res_fond)) {
	     //   $monto2 = $lin_fond['sum(FOND_DTRA_IMPO)'];
			$cuenta = $lin_fond['FOND_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = round($lin_fond['sum(FOND_DTRA_IMPO)'],2);
				$mon_eqv = 0;
				}else{
			    $monto2  = round($lin_fond['sum(FOND_DTRA_IMPO_BS)'],2);
				$mon_eqv = round($lin_fond['sum(FOND_DTRA_IMPO)'],2);
				}
			//echo "aqui";	
			$des_cta = 	leer_cta_des($cuenta);
		//	echo "aqui 2";
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (11000,
										   '$cuenta',
									       '$des_cta',
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta);
			
			?>
	
	<?php } 
	$con_fond  = "select  FOND_DTRA_CTA_CBT, sum(FOND_DTRA_IMPO), sum(FOND_DTRA_IMPO_BS) from fond_det_tran 
	              where FOND_DTRA_FEC_TRAN = '$fec1' and FOND_DTRA_DEB_CRE = 2
	              and FOND_DTRA_NRO_CTA = 2 and FOND_DTRA_USR_BAJA is null
				  group by FOND_DTRA_CTA_CBT";
    $res_fond = mysql_query($con_fond); 
	while ($lin_fond = mysql_fetch_array($res_fond)) {
	      //  $monto2 = $lin_fond['sum(FOND_DTRA_IMPO)'];
			$cuenta = $lin_fond['FOND_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = round($lin_fond['sum(FOND_DTRA_IMPO)'],2);
				$mon_eqv = 0;
				}else{
			    $monto2  = round($lin_fond['sum(FOND_DTRA_IMPO_BS)'],2);
				$mon_eqv = round($lin_fond['sum(FOND_DTRA_IMPO)'],2);
				}
				$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (11000,
										   '$cuenta',
									       '$des_cta',
										   0,
										   $monto2,
										   0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta);
					?>
	
	<?php } */ 	
	//echo "entra a ingresos egresos";
	$con_ingegr  = "select caja_ingegr_cta, sum(caja_ingegr_impo),sum(caja_ingegr_impo_e)  from caja_ing_egre
	              where caja_ingegr_fecha = '$fec1' and caja_ingegr_debhab = 1
	              and caja_ingegr_contab = 2 and caja_ingegr_usr_baja is null
				  group by caja_ingegr_cta";
    $res_ingegr = mysql_query($con_ingegr); 
	while ($lin_ingegr = mysql_fetch_array($res_ingegr)) {
	    //    $monto2 = $lin_ingegr['sum(caja_ingegr_impo)'];
		//	$mon_eqv = $lin_ingegr['sum(caja_ingegr_impo_e)'];
			$cuenta = $lin_ingegr['caja_ingegr_cta'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = round($lin_ingegr['sum(caja_ingegr_impo)'],2);
				$mon_eqv = 0;
				}else{
			    $monto2  =round($lin_ingegr['sum(caja_ingegr_impo)'],2);
				$mon_eqv = round($lin_ingegr['sum(caja_ingegr_impo_e)'],2);
				}
			//echo "aqui 2".$cuenta."nada";
			$des_cta = 	leer_cta_des($cuenta);
		//	echo "aqui 2";
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (13000,
										   '$cuenta',
									       '$des_cta',
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta);
			
			
			
			
			?>
	
	<?php } 
	$con_ingegr  = "select caja_ingegr_cta, sum(caja_ingegr_impo),sum(caja_ingegr_impo_e)  from caja_ing_egre
	              where caja_ingegr_fecha = '$fec1' and caja_ingegr_debhab = 2
	              and caja_ingegr_contab = 2 and caja_ingegr_usr_baja is null
				  group by caja_ingegr_cta";
    $res_ingegr = mysql_query($con_ingegr); 
	while ($lin_ingegr = mysql_fetch_array($res_ingegr)) {
	        $monto2 = round($lin_ingegr['sum(caja_ingegr_impo)'],2);
			if ($monto2 < 0){
			    $monto2 = $monto2 * -1;
			}
			
			$mon_eqv = round($lin_ingegr['sum(caja_ingegr_impo_e)'],2);
			if ($mon_eqv < 0){
			    $mon_eqv = $mon_eqv * -1;
				}
			$cuenta = $lin_ingegr['caja_ingegr_cta'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $monto2;
				$mon_eqv = 0;
				}else{
			    $monto2  =$monto2;
				$mon_eqv =  $mon_eqv;
				}
			$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (13000,
										   '$cuenta',
									       '$des_cta',
										   0,
										   $monto2,
										   0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta);	
				
				
				
			?>
	
	<?php }
	 //echo "compra_venta";
	$con_comven  = "select  caja_comven_cta,caja_comven_mon, sum(caja_comven_impo), sum(caja_comven_impo_e) from caja_com_ven
	              where caja_comven_fecha = '$fec1' and caja_comven_debhab = 1
	              and caja_comven_contab = 2 and caja_comven_usr_baja is null
				  group by caja_comven_cta";
    $res_comven = mysql_query($con_comven); 
	while ($lin_comven = mysql_fetch_array($res_comven)) {
	        
			$cuenta = $lin_comven['caja_comven_cta'];
			$cod_mon = $lin_comven['caja_comven_mon'];
			if ($cod_mon == 1){
			    $monto2 = round($lin_comven['sum(caja_comven_impo)'],2);
				$mon_eqv = 0;
				}else{
				$monto2 = round($lin_comven['sum(caja_comven_impo)'],2);
			    $mon_eqv = round($lin_comven['sum(caja_comven_impo_e)'],2);
				}
	    if ($monto2 > 0){
			$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (14000,
										   '$cuenta',
									       '$des_cta',
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta);
		}	
			?>
	
	<?php } 
	$con_comven  = "select  caja_comven_cta,caja_comven_mon, sum(caja_comven_impo), sum(caja_comven_impo_e) from caja_com_ven
	              where caja_comven_fecha = '$fec1' and caja_comven_debhab = 2
	              and caja_comven_contab = 2 and caja_comven_usr_baja is null
				   group by caja_comven_cta";
    $res_comven = mysql_query($con_comven); 
	while ($lin_comven = mysql_fetch_array($res_comven)) {
	       // $monto2 = $lin_comven['sum(caja_comven_impo)'];
			$cuenta = $lin_comven['caja_comven_cta'];
			$cod_mon = $lin_comven['caja_comven_mon'];
			if ($cod_mon == 1){
			    $monto2 = $lin_comven['sum(caja_comven_impo)'];
				$mon_eqv = 0;
				}else{
				$monto2 = $lin_comven['sum(caja_comven_impo)'];
			    $mon_eqv = $lin_comven['sum(caja_comven_impo_e)'];
				}
		if ($monto2 > 0){	
			$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (14000,
										   '$cuenta',
									       '$des_cta',
										   0,
										   $monto2,
										   0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta);	
	  }
				?>
	
	<?php } 
	$con_banco  = "select  CAJA_DEP_CTA_CTB, sum(CAJA_DEP_IMPO), sum(CAJA_DEP_IMPO2) from caja_deposito
	              where CAJA_DEP_FECHA = '$fec1' and CAJA_DEP_DEB_HAB = 1 and CAJA_DEP_USR_BAJA is null
	              group by CAJA_DEP_CTA_CTB";
    $res_banco = mysql_query($con_banco); 
	while ($lin_banco = mysql_fetch_array($res_banco)) {
	        
			$cuenta = $lin_banco['CAJA_DEP_CTA_CTB'];
			$cod_mon = leer_cta_mon($cuenta);
		//	echo $cod_mon."cod_mon"; 
			if ($cod_mon == 1){
			    $monto2 = $lin_banco['sum(CAJA_DEP_IMPO)'];
				$mon_eqv = $lin_banco['sum(CAJA_DEP_IMPO2)'];
				}else{
				$monto2 = $lin_banco['sum(CAJA_DEP_IMPO)'];
			    $mon_eqv = $lin_banco['sum(CAJA_DEP_IMPO2)'];
				}
				$des_cta = 	leer_cta_des($cuenta);
			//	echo $monto2,$mon_eqv,$cuenta,$des_cta,$cod_mon;
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (15000,
										   '$cuenta',
									       '$des_cta',
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta);
			
			
	
	 }
	$con_banco  = "select  CAJA_DEP_CTA_CTB, sum(CAJA_DEP_IMPO), sum(CAJA_DEP_IMPO2) from caja_deposito
	              where CAJA_DEP_FECHA = '$fec1' and CAJA_DEP_DEB_HAB = 2 and CAJA_DEP_USR_BAJA is null
	              group by CAJA_DEP_CTA_CTB";
    $res_banco = mysql_query($con_banco); 
	while ($lin_banco = mysql_fetch_array($res_banco)) {
	        
			$cuenta = $lin_banco['CAJA_DEP_CTA_CTB'];
			$cod_mon = leer_cta_mon($cuenta);
			if ($cod_mon == 1){
			    $monto2 = $lin_banco['sum(CAJA_DEP_IMPO)'];
				$mon_eqv = $lin_banco['sum(CAJA_DEP_IMPO2)'];
				}else{
				$monto2 = $lin_banco['sum(CAJA_DEP_IMPO)'];
			    $mon_eqv = $lin_banco['sum(CAJA_DEP_IMPO2)'];
				}
				$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (15000,
										   '$cuenta',
									       '$des_cta',
										    0,
										   $monto2,
										   0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta);
			
			
	
	 } 
	 
	 //Facturacion
	 if ($_SESSION['EMPRESA_TIPO'] == 2){
	 $con_factura  = "select  FAC_DET_CONTA, sum(FAC_DET_IMPORTE) from factura_deta
	              where FAC_DET_FECHA = '$fec1' and FAC_DET_CONCEP = '1' 
				  and FAC_DET_ESTADO = 1
				  and FAC_DET_USR_BAJA is null
	              group by FAC_DET_CONTA";
    $res_factura = mysql_query($con_factura); 
	while ($lin_factura = mysql_fetch_array($res_factura)) {
	        
			$cuenta = $lin_factura['FAC_DET_CONTA'];
			$cod_mon = substr($cuenta,5,1);
		//	echo $cod_mon."cod_mon"; 
			if ($cod_mon == 1){
			    $monto2 = $lin_factura['sum(FAC_DET_IMPORTE)'];
				$mon_eqv = 0;
				}else{
				$monto2 = $lin_factura['sum(FAC_DET_IMPORTE)'];
			    $mon_eqv = $lin_factura['sum(FAC_DET_IMPORTE)'];
				}
				$des_cta = 	leer_cta_des($cuenta);
			//	echo $monto2,$mon_eqv,$cuenta,$des_cta,$cod_mon;
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (16000,
										   '$cuenta',
									       '$des_cta',
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta);
			
			
	
	 }
	 $con_factura  = "select  FAC_DET_CONTA, sum(FAC_DET_IMPORTE) from factura_deta
	              where FAC_DET_FECHA = '$fec1' and FAC_DET_CONCEP = '2' 
				  and FAC_DET_ESTADO = 1
				  and FAC_DET_USR_BAJA is null
	              group by FAC_DET_CONTA";
    $res_factura = mysql_query($con_factura); 
	while ($lin_factura = mysql_fetch_array($res_factura)) {
	        
			$cuenta = $lin_factura['FAC_DET_CONTA'];
			$cod_mon = substr($cuenta,5,1);
		//	echo $cod_mon."cod_mon"; 
			if ($cod_mon == 1){
			    $monto2 = $lin_factura['sum(FAC_DET_IMPORTE)'];
				$mon_eqv = 0;
				}else{
				$monto2 = $lin_factura['sum(FAC_DET_IMPORTE)'];
			    $mon_eqv = $lin_factura['sum(FAC_DET_IMPORTE)'];
				}
				$des_cta = 	leer_cta_des($cuenta);
			//	echo $monto2,$mon_eqv,$cuenta,$des_cta,$cod_mon;
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (16000,
										   '$cuenta',
									       '$des_cta',
										    0,
										    $monto2,
										     0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta);
			
			
	
	 }
	} 
	//Caja chica
	$con_ingegr  = "select CJCH_TRAN_CTA_CONT, sum(CJCH_TRAN_IMPORTE),sum(CJCH_TRAN_IMP_EQUIV)  from cjach_transac
	              where CJCH_TRAN_FECHA = '$fec1' and CJCH_TRAN_DEB_CRED = 1 and CJCH_TRAN_TIPO_OPE = 2
	              and CJCH_TRAN_USR_BAJA is null
				  group by CJCH_TRAN_CTA_CONT";
    $res_ingegr = mysql_query($con_ingegr); 
	while ($lin_ingegr = mysql_fetch_array($res_ingegr)) {
	        $monto2 = round($lin_ingegr['sum(CJCH_TRAN_IMPORTE)'],2);
			if ($monto2 < 0){
			    $monto2 = $monto2 * -1;
			}
			
			$mon_eqv = round($lin_ingegr['sum(CJCH_TRAN_IMP_EQUIV)'],2);
			if ($mon_eqv < 0){
			    $mon_eqv = $mon_eqv * -1;
				}
			$cuenta = $lin_ingegr['CJCH_TRAN_CTA_CONT'];
			/*$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $monto2;
				$mon_eqv = 0;
				}else{
			    $monto2  =$monto2;
				$mon_eqv =  $mon_eqv;
				}
				*/
			$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (10100,
										   '$cuenta',
									       '$des_cta',
										   0,
										   $monto2,
										   0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta);	
				
				
				
			?>
	
	<?php } 
	$con_ingegr  = "select CJCH_TRAN_CTA_CONT, sum(CJCH_TRAN_IMPORTE),sum(CJCH_TRAN_IMP_EQUIV)  from cjach_transac
	              where CJCH_TRAN_FECHA = '$fec1' and CJCH_TRAN_DEB_CRED = 2 and CJCH_TRAN_TIPO_OPE = 2
	              and CJCH_TRAN_USR_BAJA is null
				  group by CJCH_TRAN_CTA_CONT";
    $res_ingegr = mysql_query($con_ingegr); 
	while ($lin_ingegr = mysql_fetch_array($res_ingegr)) {
	        $monto2 = round($lin_ingegr['sum(CJCH_TRAN_IMPORTE)'],2);
			if ($monto2 < 0){
			    $monto2 = $monto2 * -1;
			}
			
			$mon_eqv = round($lin_ingegr['sum(CJCH_TRAN_IMP_EQUIV)'],2);
			if ($mon_eqv < 0){
			    $mon_eqv = $mon_eqv * -1;
				}
			$cuenta = $lin_ingegr['CJCH_TRAN_CTA_CONT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $monto2;
				$mon_eqv = 0;
				}else{
			    $monto2  =$monto2;
				$mon_eqv =  $mon_eqv;
				}
			$des_cta = 	leer_cta_des($cuenta);
			$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (10100,
										   '$cuenta',
									       '$des_cta',
										   $monto2,
										   0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta);	
				
				
				
			?>
	
	<?php } 
	 
	 
	 
	 // Iguala centavos
	$consulta  = "Select * From temp_ctable order by temp_tip_tra,temp_nro_cta";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
   $tot_haber_2 = 0;
	$apli = 0;
    while ($linea = mysql_fetch_array($resultado)) {
	      $apli_2 =$apli; 
	     if ($linea['temp_tip_tra'] <> $apli) {
		    // echo "iguala centavos";
		     $apli =$linea['temp_tip_tra'];
		/*	
			  
			*/ 
		if ($tot_debe_1 <> $tot_haber_1){ 
		    $dif = round($tot_debe_1 - $tot_haber_1,2);
			
			if ($dif <> 0){
			   if ($dif < 0){
			      $dif = $dif * -1;
				}
				if ($dif < 0.51){
		            echo $dif."diferencia centavos".$apli_2;
                   	$con_cta  = "Select * From temp_ctable where temp_tip_tra = $apli_2
					             and temp_nro_cta = '54201101' 
								 and temp_haber_1 > 0 ";
                    $res_cta = mysql_query($con_cta);	
					while ($lin_cta = mysql_fetch_array($res_cta)) {
					       if ($tot_haber_1 > $tot_debe_1){
						        $act_dif  = "update temp_ctable set temp_haber_1 = temp_haber_1 - $dif
								 where temp_tip_tra = $apli_2
					             and temp_nro_cta = '54201101'";
                                 $res_dif = mysql_query($act_dif);	
						         }else{
								  $act_dif  = "update temp_ctable set temp_haber_1 = temp_haber_1 + $dif
								 where temp_tip_tra = $apli_2
					             and temp_nro_cta = '54201101'";
                                 $res_dif = mysql_query($act_dif);	
						 }
					}
			
			     }
		    }
		
		
		     $tot_debe_1 = 0;
              $tot_haber_1 = 0;
              $tot_debe_2 = 0;
              $tot_haber_2 = 0;
		}
		}
		 $tot_debe_1 = round($tot_debe_1 +$linea['temp_debe_1'],2);
	      $tot_haber_1 = round($tot_haber_1 +$linea['temp_haber_1'],2);
		}?>
	 
	
	
	
	
	
		
  </table>
  <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>
  <?php
  $consulta  = "Select * From temp_ctable order by temp_tip_tra,temp_nro_cta";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$apli = 0;
    while ($linea = mysql_fetch_array($resultado)) {
	     if ($linea['temp_tip_tra'] <> $apli) {
		     $apli =$linea['temp_tip_tra'];
			 $con_apl = "Select GRAL_PAR_PRO_DESC From gral_param_propios where GRAL_PAR_PRO_GRP = 100 and 
	              GRAL_PAR_PRO_COD = $apli";
		     $res_apl = mysql_query($con_apl);
		while ($lin_apl = mysql_fetch_array($res_apl)) {
		      $aplicacion = utf8_encode($lin_apl['GRAL_PAR_PRO_DESC'])  ;
			  }
			  
			 
		if (($tot_debe_1 + $tot_haber_1 + $tot_debe_2 + $tot_haber_2) > 0){ ?>
		   <tr>
		      <td align="right"><?php echo encadenar(2); ?></td>
		      <th align="left" style="font-size:10px"><?php echo utf8_encode("SUBTOTAL MODULO"); ?></th>
	 	      <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
		
		<?php   $tot_debe_1 = 0;
              $tot_haber_1 = 0;
              $tot_debe_2 = 0;
              $tot_haber_2 = 0;
		}?>
		
          <tr>
		      <th align="left"><?php echo $linea['temp_tip_tra']; ?></th>
	 	      <th align="left"><?php echo $aplicacion; ?></th>
		      <td align="right"><?php echo encadenar(2); ?></td>
		      <td align="right"><?php echo encadenar(2); ?></td>
		      <td align="right"><?php echo encadenar(2); ?></td>
		      <td align="right"  ><?php echo encadenar(2); ?></td>
	     </tr>
<?php }?>
		  
		  
		<?php  
          $tot_debe_1 = round($tot_debe_1 +$linea['temp_debe_1'],2);
	      $tot_haber_1 = round($tot_haber_1 +$linea['temp_haber_1'],2);
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
		      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo utf8_encode($linea['temp_des_cta']); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	     </tr>
	
     <?php }?>
         <tr>
		    <?php if ($tot_debe_1 <> $tot_haber_1) {
			          $_SESSION['diferencia'] = 1;?>
		     <th align="center" style="color:#FF0000"><?php echo "ojo"; ?></td>
			 <th align="left" style="font-size:10px"><?php echo utf8_encode("SUBTOTAL MODULO"); ?></th>
			 <th align="right" style="color:#FF0000"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right" style="color:#FF0000"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right" style="color:#FF0000"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" style="color:#FF0000"><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
			 <?php }?>
			 <?php if ($tot_debe_1 == $tot_haber_1){?>
		     <td align="right"><?php echo encadenar(2); ?></td>
			 <th align="left" style="font-size:10px"><?php echo utf8_encode("SUBTOTAL MODULO"); ?></th>
			 <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
			 <?php }?>
	     </tr>
     </table>
   
	 <center>
	    <br>
	 <input class="btn_form" type="submit" name="accion" value="Contabilizar"  onClick="return confirmar_cierre()">
     
</form>	
 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return">


<?php } ?>


<?php
/*

 
 
 */
 
 ?>
	
	
	 

  <?php
  }
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>