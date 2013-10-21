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
<title>Registro Contable de Cierre Día</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
</head>
<body>
	<div id="cuerpoModulo">
	<?php
				include("header.php");
			?>
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />

				<?php
					 $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
             </div>
             <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div> 
				<div id="TitleModulo">
                	<img src="images/24x24/001_35.png" border="0" alt="" />Registro Contable de Cierre Día
          </div> 
              <div id="AtrasBoton">
           		<a href="menu_s.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<div id="GeneralManCliente">
<form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
  
<?php

//if ($_SESSION['continuar'] == 1){
    $_SESSION['detalle'] = 1;
    $_SESSION['cuantos'] = 0;
    $borr_cob  = "Delete From temp_ctable "; 
    $cob_borr = mysql_query($borr_cob)or die('No pudo borrar temp_ctable');
 //   }
if ($_SESSION['detalle'] == 1){
    $con_cart  = "select  CART_DTRA_CTA_CBT, sum(CART_DTRA_IMPO),sum(CART_DTRA_IMPO_BS) from cart_det_tran 
	              where CART_DTRA_FEC_TRAN = '$fec1' and CART_DTRA_DEB_CRE = 2
	              group by CART_DTRA_CTA_CBT";
    $res_cart = mysql_query($con_cart)or die('No pudo seleccionarse contab_cuenta')  ; 
	while ($lin_cart = mysql_fetch_array($res_cart)) {
	    //    $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
			$cuenta = $lin_cart['CART_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
				$mon_eqv = 0;
				}else{
			    $monto2  = $lin_cart['sum(CART_DTRA_IMPO_BS)'];
				$mon_eqv = $lin_cart['sum(CART_DTRA_IMPO)'];
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
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 1 : ' . mysql_error());
					
			?>
   
	<?php } ?>
	<?php 
	 $con_cart  = "select  CART_DTRA_CTA_CBT, sum(CART_DTRA_IMPO), sum(CART_DTRA_IMPO_BS) from cart_det_tran 
	              where CART_DTRA_FEC_TRAN = '$fec1' and CART_DTRA_DEB_CRE = 1
	              group by CART_DTRA_CTA_CBT";
    $res_cart = mysql_query($con_cart)or die('No pudo seleccionarse cart_det_tran ')  ; 
	while ($lin_cart = mysql_fetch_array($res_cart)) {
	      //  $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
			$cuenta = $lin_cart['CART_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $lin_cart['sum(CART_DTRA_IMPO)'];
				$mon_eqv = 0;
				}else{
			    $monto2  = $lin_cart['sum(CART_DTRA_IMPO_BS)'];
				$mon_eqv = $lin_cart['sum(CART_DTRA_IMPO)'];
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
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 1 : ' . mysql_error());
			
				?>
        
	<?php } 
	//echo "entra a fondo";
	$con_fond  = "select  FOND_DTRA_CTA_CBT, sum(FOND_DTRA_IMPO), sum(FOND_DTRA_IMPO_BS) from fond_det_tran 
	              where FOND_DTRA_FEC_TRAN = '$fec1' and FOND_DTRA_DEB_CRE = 1
	              and FOND_DTRA_NRO_CTA = 2 group by FOND_DTRA_CTA_CBT";
    $res_fond = mysql_query($con_fond)or die('No pudo seleccionarse fond_det_tran ')  ; 
	while ($lin_fond = mysql_fetch_array($res_fond)) {
	     //   $monto2 = $lin_fond['sum(FOND_DTRA_IMPO)'];
			$cuenta = $lin_fond['FOND_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $lin_fond['sum(FOND_DTRA_IMPO)'];
				$mon_eqv = 0;
				}else{
			    $monto2  = $lin_fond['sum(FOND_DTRA_IMPO_BS)'];
				$mon_eqv = $lin_fond['sum(FOND_DTRA_IMPO)'];
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
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 3 : ' . mysql_error());
			
			?>
	
	<?php } 
	$con_fond  = "select  FOND_DTRA_CTA_CBT, sum(FOND_DTRA_IMPO), sum(FOND_DTRA_IMPO_BS) from fond_det_tran 
	              where FOND_DTRA_FEC_TRAN = '$fec1' and FOND_DTRA_DEB_CRE = 2
	              and FOND_DTRA_NRO_CTA = 2 group by FOND_DTRA_CTA_CBT";
    $res_fond = mysql_query($con_fond)or die('No pudo seleccionarse fond_det_tran ')  ; 
	while ($lin_fond = mysql_fetch_array($res_fond)) {
	      //  $monto2 = $lin_fond['sum(FOND_DTRA_IMPO)'];
			$cuenta = $lin_fond['FOND_DTRA_CTA_CBT'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $lin_fond['sum(FOND_DTRA_IMPO)'];
				$mon_eqv = 0;
				}else{
			    $monto2  = $lin_fond['sum(FOND_DTRA_IMPO_BS)'];
				$mon_eqv = $lin_fond['sum(FOND_DTRA_IMPO)'];
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
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 1 : ' . mysql_error());
					?>
	
	<?php } 	
	//echo "entra a ingresos egresos";
	$con_ingegr  = "select caja_ingegr_cta, sum(caja_ingegr_impo),sum(caja_ingegr_impo_e)  from caja_ing_egre
	              where caja_ingegr_fecha = '$fec1' and caja_ingegr_debhab = 1
	              and caja_ingegr_contab = 2 group by caja_ingegr_cta";
    $res_ingegr = mysql_query($con_ingegr)or die('No pudo seleccionarse fond_det_tran ')  ; 
	while ($lin_ingegr = mysql_fetch_array($res_ingegr)) {
	    //    $monto2 = $lin_ingegr['sum(caja_ingegr_impo)'];
		//	$mon_eqv = $lin_ingegr['sum(caja_ingegr_impo_e)'];
			$cuenta = $lin_ingegr['caja_ingegr_cta'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $lin_ingegr['sum(caja_ingegr_impo)'];
				$mon_eqv = 0;
				}else{
			    $monto2  =$lin_ingegr['sum(caja_ingegr_impo)'];
				$mon_eqv = $lin_ingegr['sum(caja_ingegr_impo_e)'];
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
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 3 : ' . mysql_error());
			
			
			
			
			?>
	
	<?php } 
	$con_ingegr  = "select caja_ingegr_cta, sum(caja_ingegr_impo),sum(caja_ingegr_impo_e)  from caja_ing_egre
	              where caja_ingegr_fecha = '$fec1' and caja_ingegr_debhab = 2
	              and caja_ingegr_contab = 2 group by caja_ingegr_cta";
    $res_ingegr = mysql_query($con_ingegr)or die('No pudo seleccionarse fond_det_tran ')  ; 
	while ($lin_ingegr = mysql_fetch_array($res_ingegr)) {
	        $monto2 = $lin_ingegr['sum(caja_ingegr_impo)'];
			if ($monto2 < 0){
			    $monto2 = $monto2 * -1;
			}
			
			$mon_eqv = $lin_ingegr['sum(caja_ingegr_impo_e)'];
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
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 1 : ' . mysql_error());	
				
				
				
			?>
	
	<?php }
	 //echo "compra_venta";
	$con_comven  = "select  caja_comven_cta, sum(caja_comven_impo), sum(caja_comven_impo_e) from caja_com_ven
	              where caja_comven_fecha = '$fec1' and caja_comven_debhab = 1
	              and caja_comven_contab = 2 group by caja_comven_cta";
    $res_comven = mysql_query($con_comven)or die('No pudo seleccionarse fond_det_tran ')  ; 
	while ($lin_comven = mysql_fetch_array($res_comven)) {
	        
			$cuenta = $lin_comven['caja_comven_cta'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $lin_comven['sum(caja_comven_impo)'];
				$mon_eqv = 0;
				}else{
				$monto2 = $lin_comven['sum(caja_comven_impo)'];
			    $mon_eqv = $lin_comven['sum(caja_comven_impo_e)'];
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
										  (14000,
										   '$cuenta',
									       '$des_cta',
										    $monto2,
										    0,
										   $mon_eqv,
										   0)";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 3 : ' . mysql_error());
			
			?>
	
	<?php } 
	$con_comven  = "select  caja_comven_cta, sum(caja_comven_impo), sum(caja_comven_impo_e) from caja_com_ven
	              where caja_comven_fecha = '$fec1' and caja_comven_debhab = 2
	              and caja_comven_contab = 2 group by caja_comven_cta";
    $res_comven = mysql_query($con_comven)or die('No pudo seleccionarse fond_det_tran ')  ; 
	while ($lin_comven = mysql_fetch_array($res_comven)) {
	       // $monto2 = $lin_comven['sum(caja_comven_impo)'];
			$cuenta = $lin_comven['caja_comven_cta'];
			$cod_mon = substr($cuenta,5,1);
			if ($cod_mon == 1){
			    $monto2 = $lin_comven['sum(caja_comven_impo)'];
				$mon_eqv = 0;
				}else{
				$monto2 = $lin_comven['sum(caja_comven_impo)'];
			    $mon_eqv = $lin_comven['sum(caja_comven_impo_e)'];
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
										  (14000,
										   '$cuenta',
									       '$des_cta',
										   0,
										   $monto2,
										   0,
										   $mon_eqv)";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 1 : ' . mysql_error());	
				?>
	
	<?php } ?>	
  </table>
  <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>
  <?php
  $consulta  = "Select * From temp_ctable";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	     </tr>
	
     <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
     </table>
  
  
  
  
  
  
  
  
  
  
	 <center>
	    
	 <input type="submit" name="accion" value="Contabilizar">
     
</form>	

 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return">


<?php } ?>


<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];
//$cuantos = 0;
$m_debe_1 = 0;
$m_haber_1 = 0;
$m_debe_2 = 0;
$m_haber_2 = 0;
$mon_cta = 0;
if (isset($_SESSION['continuar'])){
if ($_SESSION['continuar'] == 2){ //1a
    if (isset($_POST['descrip'])){ //2a
       if ($_POST['descrip'] <> ""){  //3a
	      $descrip = $_POST['descrip'];
	      $descrip = strtoupper ($descrip);
	      $_SESSION['descrip'] = $descrip;
	      } //3b
      }	//2b
      if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
	  }	//4b
      if ($_POST['deb_hab'] <> ""){ //5a  
	     $deb_hab = $_POST['deb_hab'];
	  	 $_SESSION['deb_hab'] = $deb_hab;
	  } //5b
      if ($_POST['egr_monto'] > 0){ //6a  
	     $monto_t = ($_POST['egr_monto']);
	     $_SESSION['monto_t'] =  $monto_t;
      } //6b
      if ($deb_hab == "Debe"){ //7a     
         $m_debe_1 = $monto_t;
	     $m_haber_1 = 0;
	     }else{
	     $m_debe_1 = 0;
	     $m_haber_1 = $monto_t;
	     } //7b
      if ($mon_cta == 2){ //8a
	     if ($deb_hab == "Debe"){ //9a     
            $m_debe_2 = $monto_t / $tc_ctb;
	        $m_haber_2 = 0;
	        }else{
	        $m_debe_2 = 0;
	        $m_haber_2 = $monto_t / $tc_ctb;
	        } //8b
          } //9b
	
      $des_cta = leer_cta_des($cod_cta);
	  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	  $cuantos = $_SESSION['cuantos'];
//echo $descrip.encadenar(2).$cod_cta.encadenar(2).$deb_hab.encadenar(2).$monto_t;	
	  $consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cuantos,
										   $cod_cta,
									       '$des_cta',
										   $m_debe_1,
										   $m_haber_1,
										   $m_debe_2,
										   $m_haber_2)";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable 1 : ' . mysql_error());
	
	$consulta  = "Select * From temp_ctable";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	     </tr>
	
     <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
     </table>
     <center>
	    
	 <input type="submit" name="accion" value="Grabar">
     <input type="submit" name="accion" value="Salir">

</form>	
 <?php } 
 }//1b?>
<?php
if (isset($_SESSION['continuar'])){    
if ($_SESSION['continuar'] == 3){
    if ($_SESSION['detalle'] == 3){
       $consulta  = "Select * From temp_ctable";
       $resultado = mysql_query($consulta);
       $tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
       $con_temp = "Select * From temp_ctable";
       $res_temp = mysql_query($con_temp);
	   while ($lin_temp = mysql_fetch_array($res_temp)) {
             $tot_debe_1 = $tot_debe_1 +$lin_temp['temp_debe_1'];
	         $tot_haber_1 = $tot_haber_1 +$lin_temp['temp_haber_1'];
	    }
			
	if ($tot_debe_1 <> $tot_haber_1) {	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Modificar</th>
	</tr>

    <?php
	$tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
     while ($linea = mysql_fetch_array($resultado)) {
            $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	        $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	        //$tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	        //$tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			<td><INPUT NAME="nlin" TYPE=RADIO VALUE="<?php echo $nro_lin; ?>">	</td> 
	     </tr>
	
    <?php }
	
	   echo "No iguala Debe y Haber Revise y Modifique ......... ";  ?>
	    <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
	   </table>
	<center>
	 <input type="submit" name="accion" value="Modificar">
     <input type="submit" name="accion" value="Salir">
	   
	<?php    
	   
    }else{
  
  	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>

    <?php
	$tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
     while ($linea = mysql_fetch_array($resultado)) {
            $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	        $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	        $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	        $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	    </tr>
	
    <?php }
	
	   echo "Revise Bien antes de Imprimir ......... ";
    
  
  ?>
   <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
  
  	</table>
	<center>
	 <input type="submit" name="accion" value="Imprimir">
     <input type="submit" name="accion" value="Salir">

</form>	
 <?php
 }
  }
	} 
}
if (isset($_SESSION['continuar'])){
if ($_SESSION['continuar'] == 4){ //1 a
   if(isset($_POST['nlin'])){ //2a
     $nlin = $_POST['nlin'];
	 $_SESSION['nlin'] = $nlin;?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
  <?php
	 $consulta  = "Select * From temp_ctable where temp_tip_tra = $nlin";
     $resultado = mysql_query($consulta);
	 while ($linea = mysql_fetch_array($resultado)) { //3a
	       $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
           $res_ctas = mysql_query($con_ctas)or die('No pudo seleccionarse contab_cuenta')  ; ?>
	 	 
	 <table align="center">
     <tr>
	    <th align="left">Glosa :</th>
		<?php if (isset ($_SESSION['descrip'])){?>
		<td align="left"><?php echo $_SESSION['descrip']; ?> </td>`
		<?php } //3b ?>
	 </tr>
	 <tr> 
      <th align="left">Cuenta Contable :</th>
	  <td><?php echo $linea['temp_nro_cta'].encadenar(2).$linea['temp_des_cta']; ?></td>
	 </tr>
     <tr> 
      <th align="left">Cuenta Contable :</th>
	  <td> <select name="cod_cta" size="1"  >
	       <?php while ($lin_cta = mysql_fetch_array($res_ctas)) { //4a ?>
           <option value=<?php echo $lin_cta['CONTA_CTA_NRO']; ?>>
		                 <?php echo $lin_cta['CONTA_CTA_NRO']; ?>
			              <?php echo $lin_cta['CONTA_CTA_DESC']; ?></option>
           <?php } //4b?>
		    </select></td>
    </tr>
	<tr> 
         <th align="left" >Monto :</th>
		 <td align="left"><?php echo number_format($linea['temp_debe_1']+
		                                            $linea['temp_haber_1'], 2, '.',',') ; ?></td>
    </tr>	  
    <tr> 
         <th align="left" >Monto :</th>
		 <td><input  type="text" name="egr_monto"> </td>
    </tr>
    <tr>
	<th align="left">Aplicacion :</th>
	     <?php if ($linea['temp_debe_1'] > 0) {  //5a?>
		 <td><?php echo "Debe"; ?></td>
		 <?php } //5b?>
		 <?php if ($linea['temp_haber_1'] > 0) { //6a ?>
		 <td><?php echo "Haber"; ?></td>
		 <?php } //6b?>
	</tr>	
	<th align="left">Aplicacion :</th>
		 <td><select name="deb_hab" >
	         <option>Debe</option>
	         <option>Haber</option>
	         </select></td>
	</tr>	
	
  </table>
  <center>
   <input type="submit" name="accion" value="Grab_modi">
     <input type="submit" name="accion" value="Salir">

</form>	
  
  
  
	 
	 <?php } //2b
	 
	 
	 
	 
	 
	  //}else{
	 //$_SESSION['continuar'] = 1;
	 //$_SESSION['calculo'] == 1; 
	// header('Location:cobro_pag_det_gd.php');
	 }  //1b
    // if(isset($_SESSION['grupo'])){
    //   $nom_grp =$_SESSION['grupo'];
	//   }
  }	// 1 b 
  }
 if (isset($_SESSION['continuar'])){
if ($_SESSION['continuar'] == 5){ //1a
     $nlin = $_SESSION['nlin'];
     if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
	  }	//4b
      if ($_POST['deb_hab'] <> ""){ //5a  
	     $deb_hab = $_POST['deb_hab'];
	  	 $_SESSION['deb_hab'] = $deb_hab;
	  } //5b
      if ($_POST['egr_monto'] > 0){ //6a  
	     $monto_t = ($_POST['egr_monto']);
	     $_SESSION['monto_t'] =  $monto_t;
      } //6b
      if ($deb_hab == "Debe"){ //7a     
         $m_debe_1 = $monto_t;
	     $m_haber_1 = 0;
	     }else{
	     $m_debe_1 = 0;
	     $m_haber_1 = $monto_t;
	     } //7b
      if ($mon_cta == 2){ //8a
	     if ($deb_hab == "Debe"){ //9a     
            $m_debe_2 = $monto_t / $tc_ctb;
	        $m_haber_2 = 0;
	        }else{
	        $m_debe_2 = 0;
	        $m_haber_2 = $monto_t / $tc_ctb;
	        } //8b
          } //9b
	
      $des_cta = leer_cta_des($cod_cta);
	//  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	 // $cuantos = $_SESSION['cuantos'];
//echo $descrip.encadenar(2).$cod_cta.encadenar(2).$deb_hab.encadenar(2).$monto_t;	
	  $consulta = "update temp_ctable set temp_nro_cta =$cod_cta, 
                                          temp_des_cta ='$des_cta',
						 	              temp_debe_1 = $m_debe_1,
									      temp_haber_1 = $m_haber_1,
										  temp_debe_2 = $m_debe_2,
									      temp_haber_2 = $m_haber_2 
										  where temp_tip_tra = $nlin";
										   
    $resultado = mysql_query($consulta)or die('No pudo actualizar temp_ctable 1 : ' . mysql_error());
	
	$consulta  = "Select * From temp_ctable";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	?>
	<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>
	
	<?php
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	     </tr>
	
     <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
     </table>
     <center>
	    
	 <input type="submit" name="accion" value="Grabar">
     <input type="submit" name="accion" value="Salir">

</form>	
 <?php $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   
		   require 'con_asiento.php';
 } 
 }//1b?>
	
	
	 
</div>
  <?php
		// 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>