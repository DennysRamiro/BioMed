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
<title><?php echo $_SESSION['COD_EMPRESA']; ?></title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js"></script>
<script language="javascript" src="js/xp_progress.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
 <script src="script/jquery-ui.js"></script>
 <script type="text/javascript" src="js/calendario.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
</head>

<body>
 
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Desde no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Hasta no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Desde no puede ser mayor que la Fecha Hasta.</font></p>
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
                  <li id="menu_modulo_contabilidad_ufv">
                    

                     <img src="img/mante_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. DE UFV'S

                    
                 </li>

                  <?php
					if($_SESSION['menu']==1){?> 

                 <li id="menu_modulo_fecha">
                    
                     <img src="img/asiento1_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 1
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/asiento1_64x64.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 1</h2>
                      <hr style="border:1px dashed #767676;">

        		 <?php } elseif($_SESSION['menu']==2){?> 

        		 <li id="menu_modulo_fecha">
                    
                     <img src="img/asiento2_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 2
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/asiento2_64x64.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 2</h2>
                      <hr style="border:1px dashed #767676;">

        		 <?php } elseif($_SESSION['menu']==3){?> 
        		  <li id="menu_modulo_fecha">
                    
                     <img src="img/asiento3_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 3
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/asiento3_64x64.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 3</h2>
                      <hr style="border:1px dashed #767676;">
 
        		<?php } elseif($_SESSION['menu']==4){?> 
        		 <li id="menu_modulo_fecha">
                    
                     <img src="img/asiento4_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 4
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/asiento4_64x64.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 4</h2>
                      <hr style="border:1px dashed #767676;">
                      

         <?php }?>

<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 
  //verif_cierre($fec);
?> 

<?php
//verif_cierre($fec);
// Se realiza una consulta SQL a tabla gral_param_propios

if (isset($_SESSION['msg_error'])){
    if ($_SESSION['msg_error'] <> ""){
	  //  echo $_SESSION['msg_error'];
    }
}	
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta) ;
//verif_cierre($fec);
/*$f_prox = cambiaf_a_normal_2($_SESSION['f_prox']);
$mes = saca_mes($f_prox);
$dia = saca_dia($f_prox);
$anio = saca_anio($f_prox);
$dia_prox = dia_semana($dia, $mes, $anio);
$siguientedia  = mktime(0,0,0,date("$mes"),date("$dia")+ 1,date("$anio"));
$dia_prox2 = dia_semana($dia + 1, $mes, $anio);
//echo $dia_prox2. "dia_prox2";
if ($dia_prox2 == "S�bado") {
    $siguientedia  = mktime(0,0,0,date("$mes"),date("$dia")+ 3,date("$anio"));
	$dia_prox2 = dia_semana($dia + 3, $mes, $anio);
  echo "Proxima Fecha: ".date("d-m-Y", $siguientedia).$dia_prox2."<br>";
}

*/
 ?>
 <?php if ($_SESSION['detalle'] == 1) { ?>

<!--h2> <img src="img/shield1_64x64.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 1</h2-->
 <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese las fechas para generar el reporte
        </div>
  <br>      
<!--div  muestra la barra  progreso  -->
 <div id="progressbar" align="center"><script language="javascript">
  var bar1 = createBar(340,15, '#FFFFFF', 1, '000', '#999999', 150,7,3, ""); 
  </script>
  </div>

<form name="form2" method="post" action="con_ufv_op.php" onSubmit="return ValidarRangoFechas(this)">

<table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center" >
<tr>
	<center>
	<br>
        <strong>Fecha Desde:</strong>
         <input class="txt_campo" type="text" id="datepicker" name="fec_des" maxlength="10"  size="10" > 
         
			 <BR><br>
		 <strong>Fecha Hasta:</strong>
         <input class="txt_campo" type="text" id="datepicker2" name="fec_has" maxlength="10"  size="10" > 
         		

 <br><br>
 </table> 

 <center>
 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

  <input class="btn_form" type="submit" name="accion" value="Revalorizar"> 
  <?php	}  
 // echo $_POST['fec_des'] ;
  ?>
   <?php
 if ($_SESSION['detalle'] == 2) {
?>

<?php
	if ($_SESSION['asiento'] == 1) {
			$borr_cob  = "Delete From temp_ctable3 "; 
		    $cob_borr = mysql_query($borr_cob);
			$saldo = 0;
			$f_des = $_POST['fec_des'] ;
			$mes2 = saca_mes($f_des);
			$mes = saca_mes($f_des);
			$anio = saca_anio($f_des);
		    $mes_l = mes_lit($mes); 
			$f_de2 = cambiaf_a_mysql($f_des);
			//echo $anio." ****";
			$f_has = $_POST['fec_has'] ;
			$f_ha2 = cambiaf_a_mysql($f_has);
			$ufv_1 = leer_tipo_cam_ufv($f_de2);
			$ufv_2 = leer_tipo_cam_ufv($f_ha2);
			$_SESSION['ufv_1'] = $ufv_1;
			$_SESSION['ufv_2'] = $ufv_2;
			$glosa = "AITB  de las Reservas Patrimoniales"." ".
			          "Al". " ".$f_has."  "."  Con UFV";
		    $_SESSION['glosa'] = $glosa;
	//echo $ufv_1." ".$ufv_2;
/*	
*/
			echo $glosa;
			 $con_cta = "Select  DISTINCT CONTA_TRS_CTA,CONTA_TRS_FEC_VAL From contab_trans 
				    	  where (substr(CONTA_TRS_CTA,1,3) >= '341' and 
						  substr(CONTA_TRS_CTA,1,3) <= '352') and 
						  CONTA_TRS_FEC_VAL <= '$f_ha2'";
					  
			 $res_cta = mysql_query($con_cta);
	//print_r($res_cta);
			while ($lin_cta = mysql_fetch_array($res_cta)) {
				set_time_limit(0);
			      $monto_d = 0;
				  $monto_h = 0;
				  $saldo = 0;
				  $cod_cta = $lin_cta['CONTA_TRS_CTA'];
				  
				      $cod_cta_2 = '34203103';
					  

				  $fecha = $lin_cta['CONTA_TRS_FEC_VAL'];
				 // echo $fecha." - - ".$cod_cta."***";
				  
				 $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
						               where CONTA_TRS_CTA = '$cod_cta'
									   and CONTA_TRS_FEC_VAL = '$fecha'
		                               and CONTA_TRS_DEB_CRED = 1
									   and CONTA_TRS_USR_BAJA is null";	
	//}						   					   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
					$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
							                where CONTA_TRS_CTA = '$cod_cta'
										   and CONTA_TRS_FEC_VAL = '$fecha'
			                               and CONTA_TRS_DEB_CRED = 2
										   and CONTA_TRS_USR_BAJA is null";	
							   
		//}	
					 $res_tran = mysql_query($sum_tran);				   			  
							  while ($lin_tran = mysql_fetch_array($res_tran)) {
					                 $haber = $lin_tran['sum(CONTA_TRS_IMPO)'];
									 $haber_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
				        			} 
					$mon = 1;
					if ($mon == 1){						
					    $saldo = $haber - $debe;
						}
					if ($mon == 2){						
					    $saldo = $haber_2 - $debe_2;
						}
 
		  
		  
				    $consulta = "insert into temp_ctable3 (temp_tip_tra,
			                                      temp_nro_cta, 
												  temp_cuenta,
		                                          temp_des_cta,
												  temp_debe_1,
								 	              temp_fec
											       ) values
												  (0,
												   '42804102',
												  '$cod_cta',
											       '$glosa',
												   $saldo,
												    '$fecha'
												   )";
												   
					$resultado = mysql_query($consulta);	  	  
	
			}
//Saldo cuenta 	
			 $con_fec = "Select DISTINCT temp_fec,temp_cuenta From temp_ctable3";
						  
			 $res_fec = mysql_query($con_fec);
				
				while ($lin_fec = mysql_fetch_array($res_fec)) {
					set_time_limit(0);
			          $f_tran = $lin_fec['temp_fec'];
					  $cta_t =  $lin_fec['temp_cuenta'];
					  $mes_tra = substr($f_tran,5,2);
					  if ($mes2 == $mes_tra){
					      $ufv_1 = leer_tipo_cam_ufv($f_tran);
					   //  $ufv_1 = leer_tipo_cam_ufv($f_de2);
						//   echo $f_tran .$f_de2."===".$ufv_1."==";
						   $_SESSION['ufv_1'] = $ufv_1;
						  }else{
						 //   echo $f_tran .$f_de2."<><>";
						 	     $ufv_1 = leer_tipo_cam_ufv($f_de2);
			             
			              $_SESSION['ufv_1'] = $ufv_1;
					  }
			       //   echo $f_tran."***";
			$sum_tran = "Select sum(temp_debe_1) From temp_ctable3 
				                where temp_fec = '$f_tran'
								and temp_cuenta = '$cta_t'";	
							   
		//}	
			 $res_tran = mysql_query($sum_tran);
					   			  
					  while ($lin_tran = mysql_fetch_array($res_tran)) {
			                 $saldo = $lin_tran['sum(temp_debe_1)'];
					} 
 		  $saldo = round($saldo,2);
 	      
		   if ($ufv_1>0){
			 $dol_orig = $saldo / $ufv_1;
			 } else {
			 $dol_orig = 0;
			 }
					  
		  //$dol_orig = $saldo / $ufv_1;
		  $nuev_bs =  $dol_orig * $ufv_2;
		  $ajuste_1 = $nuev_bs - $saldo;
	$consulta = "update temp_ctable3  set temp_haber_1 = $ajuste_1,
	                                      temp_debe_2 = $ufv_1,
										  temp_haber_2 = $ufv_2
	             where temp_fec = '$f_tran'
				 and temp_cuenta = '$cta_t'";
										  
										   
    $resultado = mysql_query($consulta);
						
}						
						
	//echo $ufv_1." ".$ufv_2;
	// $saldo = sal_mayor2('34203101',$f_de2,1,2011);
		 
		/*  
		  */
		  
		  
		  
		//  echo $saldo."---". $ajuste_1;
	
?>	
	    <br>
		<form name="form2" method="post" action="con_ufv_op.php" onSubmit="return">

 <table width="100%"  border="1" align="center"  class="table_usuario">
    <tr>
	 
	  <th scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="20%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />SALDO ORIGINAL Bs.</th>
	 <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />AJUSTE </th>
	  <th width="20%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />UFV INICIO</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />UFV FINAL </th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CUENTA <br>
	                                                                         AJUSTE </th>
	</tr>
	<?php	
	 $tot_ajuste = 0;
	$con_fec = "Select DISTINCT temp_fec,temp_cuenta From temp_ctable3";
			  
    $res_fec = mysql_query($con_fec);
	
	while ($lin_fec = mysql_fetch_array($res_fec)) {
		set_time_limit(0);
	        $f_tran = $lin_fec['temp_fec']; 
			$cta_t =  $lin_fec['temp_cuenta'];
	$sum_tran = "Select sum(temp_debe_1),temp_haber_1,temp_debe_2,temp_haber_2,temp_nro_cta
	             From temp_ctable3 
				                where temp_fec = '$f_tran' 
								and temp_cuenta = '$cta_t'";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);
				   			  
				  
					
	
	$tot_debe_1 = 0;
   
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = "";
	$cuenta2 = "";
	while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $saldo = $lin_tran['sum(temp_debe_1)'];
						 $ajuste = $lin_tran['temp_haber_1'];
						 $ufv_1 = $lin_tran['temp_debe_2'];
	                     $ufv_2 = $lin_tran['temp_haber_2'];
						 $cta2 = $lin_tran['temp_nro_cta'];
						 $fec_tran = cambiaf_a_normal($f_tran);
						 
						 $tot_ajuste = $tot_ajuste + $ajuste;
						// echo $tot_ajuste;
	//      $cuenta2 = $linea['temp_cuenta'];
//	if ($cuenta1 <> $cuenta2){
	   //    $des_cta = leer_cta_des($cuenta2);
//		    $saldo = sal_mayor( $cuenta2,$fec_de2,1);
//			$sal_1 = $saldo;
//			 $saldo_sus = sal_mayor($cuenta2,$fec_de2,2);
//			$sal_2 = $saldo_sus;
//	  $_SESSION['saldo'] = $saldo;
//	   $_SESSION['saldo_sus'] = $saldo_sus; ?>
	  
	
		   
		   
	
	
	<?php
	
		   ?>
		  
	      <tr>
		     
			  <td align="center" style="font-size:12px"><?php echo $fec_tran; ?></td>
	 	      <td align="right" style="font-size:12px"><?php echo number_format($saldo, 2, '.',','); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo number_format($ajuste, 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($ufv_1, 5, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($ufv_2, 5, '.',','); ?></td>
			  <td align="center" style="font-size:12px"><?php echo $cta2; ?></td>
	     </tr>
	
     <?php } } ?>
	<tr>
		     
			  <th align="center" style="font-size:12px"><?php echo "Total"; ?></td>
	 	      <td align="right" style="font-size:12px"><?php echo " "; ?></td> 
		      <th align="right" style="font-size:12px"><?php echo number_format($tot_ajuste, 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo " " ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo " "; ?></td>
			  <td align="center" style="font-size:12px"><?php echo " "; ?></td>
	     </tr> 
         
     </table>
	<?php
	
			//}
		 ?> 
    </table>
     <center>
     <br>		
	 <?php
				if($_SESSION['menu']==1){?>  
	 <input class="btn_form" type="submit" name="accion" value="Asiento 1 Contable">
	 <?php } elseif($_SESSION['menu']==2){?> 
	 <input class="btn_form" type="submit" name="accion" value="Asiento 2 Contable">
	 <?php } elseif($_SESSION['menu']==3){?>
	 <input class="btn_form" type="submit" name="accion" value="Asiento 3 Contable">
	 <?php } elseif($_SESSION['menu']==4){?> 
	 <input class="btn_form" type="submit" name="accion" value="Asiento 4 Contable">
     <?php }//} ?>
	    
	 <!--input class="btn_form" type="submit" name="accion" value="Comprobante"-->

     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

    <?php }//} ?>
    <?php
 //  if ($_SESSION['detalle'] == 2) {
	if ($_SESSION['asiento'] == 2) {
	//echo "Asiento 2";
	$borr_cob  = "Delete From temp_ctable3 "; 
    $cob_borr = mysql_query($borr_cob);
	$saldo = 0;
	$f_des = $_POST['fec_des'] ;
	$f_de2 = cambiaf_a_mysql($f_des); 
	$f_has = $_POST['fec_has'] ;
	$f_ha2 = cambiaf_a_mysql($f_has);
	$ufv_1 = leer_tipo_cam_ufv($f_de2);
	$ufv_2 = leer_tipo_cam_ufv($f_ha2);
	$mes = saca_mes($f_des);
	$mes2 = saca_mes($f_has);
	$anio = saca_anio($f_des);
    $mes_l = mes_lit($mes); 
	$_SESSION['ufv_1'] = $ufv_1;
	$_SESSION['ufv_2'] = $ufv_2;
	$glosa = "AITB  del Capital Social"."  ".
	          "Al  ".$f_has." con UFV";
			  
	$_SESSION['glosa'] = $glosa;		  
    echo $glosa;
 $con_cta = "Select  DISTINCT CONTA_TRS_CTA,CONTA_TRS_FEC_VAL From contab_trans 
		    	  where substr(CONTA_TRS_CTA,1,6) = '311011'
							   and CONTA_TRS_FEC_VAL <= '$f_ha2'";
			  
	 $res_cta = mysql_query($con_cta);
	
	while ($lin_cta = mysql_fetch_array($res_cta)) {
		set_time_limit(0);
	      $monto_d = 0;
		  $monto_h = 0;
		  $saldo = 0;
		  $cod_cta = $lin_cta['CONTA_TRS_CTA'];
		  
		     // $cod_cta_2 = '34203103';
			  

		  $fecha = $lin_cta['CONTA_TRS_FEC_VAL'];
		 // echo $fecha." - - ".$cod_cta."***";
		  
		 $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA = '$cod_cta'
							   and CONTA_TRS_FEC_VAL = '$fecha'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";	
	//}						   					   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
		$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				                where CONTA_TRS_CTA = '$cod_cta'
							   and CONTA_TRS_FEC_VAL = '$fecha'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);				   			  
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $haber = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $haber_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			} 
$mon = 1;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
 
//echo $saldo."saldo".$cod_cta,"cta";		  
		  
		    $consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta, 
										  temp_cuenta,
                                          temp_des_cta,
										  temp_debe_1,
						 	              temp_fec
									       ) values
										  (0,
										   '42801101',
										  '$cod_cta',
									       '$glosa',
										   $saldo,
										    '$fecha'
										   )";
										   
	$resultado = mysql_query($consulta);	  	  
	
	}
//Saldo cuenta 	
 $con_fec = "Select DISTINCT temp_fec,temp_cuenta From temp_ctable3";
			  
 $res_fec = mysql_query($con_fec);
	
	while ($lin_fec = mysql_fetch_array($res_fec)) {
		set_time_limit(0);
          $f_tran = $lin_fec['temp_fec'];
		  $cta_t =  $lin_fec['temp_cuenta'];
         // $ufv_1 = leer_tipo_cam_ufv($f_tran);
        //  $_SESSION['ufv_1'] = $ufv_1;
		  
		  $mes_tra = substr($f_tran,5,2);
		  if ($mes2 == $mes_tra){
		      $ufv_1 = leer_tipo_cam_ufv($f_tran);
		    //   echo $f_tran .$f_de2."===".$ufv_1."==";
			   $_SESSION['ufv_1'] = $ufv_1;
			   }else{
			 //   echo $f_tran .$f_de2."<><>";
			  $ufv_1 = leer_tipo_cam_ufv($f_de2);
            
              $_SESSION['ufv_1'] = $ufv_1;
		 } 
		  
		  
		  
       //   echo $f_tran."***";
$sum_tran = "Select sum(temp_debe_1) From temp_ctable3 
				                where temp_fec = '$f_tran'
								and temp_cuenta = '$cta_t'";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);
				   			  
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $saldo = $lin_tran['sum(temp_debe_1)'];
					} 
 $saldo = round($saldo,2);
 		   if ($ufv_1>0){
			 $dol_orig = $saldo / $ufv_1;
			 } else {
			 $dol_orig = 0;
			 }
				
	      //$dol_orig = $saldo /$ufv_1;
		  $nuev_bs =  $dol_orig * $ufv_2;
		  $ajuste_1 = $nuev_bs - $saldo;
	$consulta = "update temp_ctable3  set temp_haber_1 = $ajuste_1,
	                                      temp_debe_2 = $ufv_1,
										  temp_haber_2 = $ufv_2
	             where temp_fec = '$f_tran'
				 and temp_cuenta = '$cta_t'";
										  
										   
    $resultado = mysql_query($consulta);
						
}						
						
	//echo $ufv_1." ".$ufv_2;
	// $saldo = sal_mayor2('34203101',$f_de2,1,2011);
		 
		/*  
		  */
		  
		  
		  

		//  echo $saldo."---". $ajuste_1;
		






	
?>	
	    <br>
		<form name="form2" method="post" action="con_ufv_op.php" onSubmit="return">

 <table width="100%"  border="1" align="center"  class="table_usuario">
    <tr>
	 
	  <th scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="20%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />SALDO ORIGINAL Bs.</th>
	 <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />AJUSTE </th>
	  <th width="20%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />UFV INICIO</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />UFV FINAL </th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CUENTA <br>
	                                                                         AJUSTE </th>
	</tr>
	<?php	
	 $tot_ajuste = 0;
	$con_fec = "Select DISTINCT temp_fec,temp_cuenta From temp_ctable3";
			  
    $res_fec = mysql_query($con_fec);
	
	while ($lin_fec = mysql_fetch_array($res_fec)) {
		set_time_limit(0);
	        $f_tran = $lin_fec['temp_fec']; 
			$cta_t =  $lin_fec['temp_cuenta'];
	$sum_tran = "Select sum(temp_debe_1),temp_haber_1,temp_debe_2,temp_haber_2,temp_nro_cta
	             From temp_ctable3 
				                where temp_fec = '$f_tran' 
								and temp_cuenta = '$cta_t'";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);
				   			  
				  
					
	
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = "";
	$cuenta2 = "";
	while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $saldo = $lin_tran['sum(temp_debe_1)'];
						 $ajuste = $lin_tran['temp_haber_1'];
						 $ufv_1 = $lin_tran['temp_debe_2'];
	                     $ufv_2 = $lin_tran['temp_haber_2'];
						 $cta2 = $lin_tran['temp_nro_cta'];
						 $fec_tran = cambiaf_a_normal($f_tran);
						  $tot_ajuste = $tot_ajuste + $ajuste;
	//      $cuenta2 = $linea['temp_cuenta'];
//	if ($cuenta1 <> $cuenta2){
	   //    $des_cta = leer_cta_des($cuenta2);
//		    $saldo = sal_mayor( $cuenta2,$fec_de2,1);
//			$sal_1 = $saldo;
//			 $saldo_sus = sal_mayor($cuenta2,$fec_de2,2);
//			$sal_2 = $saldo_sus;
//	  $_SESSION['saldo'] = $saldo;
//	   $_SESSION['saldo_sus'] = $saldo_sus; ?>
	  
	
		   
		   
	
	
	<?php
	
		   ?>
		  
	      <tr>
		     
			  <td align="center" style="font-size:12px"><?php echo $fec_tran; ?></td>
	 	      <td align="right" style="font-size:12px"><?php echo number_format($saldo, 2, '.',','); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo number_format($ajuste, 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($ufv_1, 5, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($ufv_2, 5, '.',','); ?></td>
			  <td align="center" style="font-size:12px"><?php echo $cta2; ?></td>
	     </tr>
	
     <?php } } ?>
        <tr>
		     
			  <th align="center" style="font-size:12px"><?php echo "Total"; ?></td>
	 	      <td align="right" style="font-size:12px"><?php echo " "; ?></td> 
		      <th align="right" style="font-size:12px"><?php echo number_format($tot_ajuste, 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo " " ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo " "; ?></td>
			  <td align="center" style="font-size:12px"><?php echo " "; ?></td>
	     </tr>  
     </table>
	<?php
	
			//}
		 ?> 
    </table>
     <center>
	
<?php
 	

		 ?> 
  
     <center>
     <br>
	 <?php
					if($_SESSION['menu']==1){?>    
	  <input class="btn_form" type="submit" name="accion" value="Asiento 1 Contable">
	 <?php } elseif($_SESSION['menu']==2){?> 
	  <input class="btn_form" type="submit" name="accion" value="Asiento 2 Contable">
	 <?php } elseif($_SESSION['menu']==3){?> 
	  <input class="btn_form" type="submit" name="accion" value="Asiento 3 Contable">
	 <?php } elseif($_SESSION['menu']==4){?> 
	  <input class="btn_form" type="submit" name="accion" value="Asiento 4 Contable">
     <?php }//} ?>   
	 <!--input class="btn_form" type="submit" name="accion" value="Asiento Contable"-->

	    
	 <!--input class="btn_form" type="submit" name="accion" value="Comprobante"-->

     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

    <?php } 
	
	if ($_SESSION['asiento'] == 3) {
	
	$borr_cob  = "Delete From temp_ctable3 "; 
    $cob_borr = mysql_query($borr_cob);
	$saldo = 0;
	$f_des = $_POST['fec_des'] ;
	$f_de2 = cambiaf_a_mysql($f_des); 
	$f_has = $_POST['fec_has'] ;
	$f_ha2 = cambiaf_a_mysql($f_has);
	$ufv_1 = leer_tipo_cam_ufv($f_de2);
	$ufv_2 = leer_tipo_cam_ufv($f_ha2);
	$_SESSION['ufv_1'] = $ufv_1;
	$_SESSION['ufv_2'] = $ufv_2;
	$mes = saca_mes($f_des);
	$mes2 = saca_mes($f_has);
	$anio = saca_anio($f_des);
    $mes_l = mes_lit($mes); 
	$glosa = "AITB Cuentas de Ingreso"." ".
	          "Al ".$f_has." con UFV";
	$_SESSION['glosa'] = $glosa;
	//echo "Asiento 3" ." ".$glosa;
	?>	
	<br>
	<?php
	echo $glosa;
	 $con_cta = "Select  DISTINCT CONTA_TRS_CTA,CONTA_TRS_FEC_VAL From contab_trans 
		    	  where substring(CONTA_TRS_CTA,1,1) = 5 and 
				  CONTA_TRS_FEC_VAL <= '$f_ha2'";
			  
	 $res_cta = mysql_query($con_cta);
	
	while ($lin_cta = mysql_fetch_array($res_cta)) {
		set_time_limit(0);
	      $monto_d = 0;
		  $monto_h = 0;
		  $saldo = 0;
		  $cod_cta = $lin_cta['CONTA_TRS_CTA'];
		  $fecha = $lin_cta['CONTA_TRS_FEC_VAL'];
		 // echo $fecha." - - ".$cod_cta."***";
		  
		 $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA = '$cod_cta'
							   and CONTA_TRS_FEC_VAL = '$fecha'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";	
	//}						   					   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
		$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				                where CONTA_TRS_CTA = '$cod_cta'
							   and CONTA_TRS_FEC_VAL = '$fecha'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);				   			  
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $haber = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $haber_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			} 
$mon = 1;
if ($mon == 1){						
    $saldo = $haber - $debe;
	}
if ($mon == 2){						
    $saldo = $haber_2 - $debe_2;
	}
 
		  
		  
		    $consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta, 
										  temp_cuenta,
                                          temp_des_cta,
										  temp_debe_1,
						 	              temp_fec
									       ) values
										  (0,
										   '42901101',
										  '$cod_cta',
									       '$glosa',
										   $saldo,
										    '$fecha'
										   )";
										   
	$resultado = mysql_query($consulta);	  	  
	
	}
//Saldo cuenta 	
 $con_fec = "Select DISTINCT temp_fec From temp_ctable3";
			  
 $res_fec = mysql_query($con_fec);
	
	while ($lin_fec = mysql_fetch_array($res_fec)) {
          $f_tran = $lin_fec['temp_fec'];
		   $mes_tra = substr($f_tran,5,2);
		//   echo $mes2 ."mes".$mes_tra."mes_tra";
		 if ($mes2 == $mes_tra){
		      $ufv_1 = leer_tipo_cam_ufv($f_tran);
		    //   echo $f_tran .$f_de2."===".$ufv_1."==";
			   $_SESSION['ufv_1'] = $ufv_1;
			   }else{
			 //   echo $f_tran .$f_de2."<><>";
			  $ufv_1 = leer_tipo_cam_ufv($f_de2);
            
              $_SESSION['ufv_1'] = $ufv_1;
		 } 
         // $ufv_1 = leer_tipo_cam_ufv($f_tran);
         // $_SESSION['ufv_1'] = $ufv_1;
       //   echo $f_tran."***";
$sum_tran = "Select sum(temp_debe_1) From temp_ctable3 
				                where temp_fec = '$f_tran'";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);
				   			  
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $saldo = $lin_tran['sum(temp_debe_1)'];
					} 
 $saldo = round($saldo,2);
	       if ($ufv_1>0){
			 $dol_orig = $saldo / $ufv_1;
			} else {
			 $dol_orig = 0;
			}
		  //$dol_orig = $saldo /$ufv_1;
		  $nuev_bs =  $dol_orig * $ufv_2;
		  $ajuste_1 = $nuev_bs - $saldo;
	$consulta = "update temp_ctable3  set temp_haber_1 = $ajuste_1,
	                                      temp_debe_2 = $ufv_1,
										  temp_haber_2 = $ufv_2
	             where temp_fec = '$f_tran'";
										  
										   
    $resultado = mysql_query($consulta);
						
}						
						
	//echo $ufv_1." ".$ufv_2;
	// $saldo = sal_mayor2('34203101',$f_de2,1,2011);
		 
		/*  
		  */
		  
		  
		  
		//  echo $saldo."---". $ajuste_1;
		
	
?>	
	    <br>
		<form name="form2" method="post" action="con_ufv_op.php" onSubmit="return">

 <table width="100%"  border="1" align="center"  class="table_usuario">
    <tr>
	 
	  <th scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="20%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />SALDO ORIGINAL Bs.</th>
	 <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />AJUSTE </th>
	  <th width="20%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />UFV INICIO</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />UFV FINAL </th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CUENTA <br>
	                                                                         AJUSTE </th>
	</tr>
	<?php
	$tot_ajuste = 0;	
	$con_fec = "Select DISTINCT temp_fec From temp_ctable3";
			  
    $res_fec = mysql_query($con_fec);
	
	while ($lin_fec = mysql_fetch_array($res_fec)) {
	        $f_tran = $lin_fec['temp_fec']; 
	$sum_tran = "Select sum(temp_debe_1),temp_haber_1,temp_debe_2,temp_haber_2,temp_nro_cta
	             From temp_ctable3 
				                where temp_fec = '$f_tran'";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);
				   			  
				  
					
	
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = "";
	$cuenta2 = "";
	while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $saldo = $lin_tran['sum(temp_debe_1)'];
						 $ajuste = $lin_tran['temp_haber_1'];
						 $ufv_1 = $lin_tran['temp_debe_2'];
	                     $ufv_2 = $lin_tran['temp_haber_2'];
						 $cta2 = $lin_tran['temp_nro_cta'];
						 $fec_tran = cambiaf_a_normal($f_tran);
						 $tot_ajuste = $tot_ajuste + $ajuste;
						 
	//      $cuenta2 = $linea['temp_cuenta'];
//	if ($cuenta1 <> $cuenta2){
	   //    $des_cta = leer_cta_des($cuenta2);
//		    $saldo = sal_mayor( $cuenta2,$fec_de2,1);
//			$sal_1 = $saldo;
//			 $saldo_sus = sal_mayor($cuenta2,$fec_de2,2);
//			$sal_2 = $saldo_sus;
//	  $_SESSION['saldo'] = $saldo;
//	   $_SESSION['saldo_sus'] = $saldo_sus; ?>
	  
	
		   
		   
	
	
	<?php
	
		   ?>
		  
	      <tr>
		     
			  <td align="center" style="font-size:12px"><?php echo $fec_tran; ?></td>
	 	      <td align="right" style="font-size:12px"><?php echo number_format($saldo, 2, '.',','); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo number_format($ajuste, 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($ufv_1, 5, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($ufv_2, 5, '.',','); ?></td>
			  <td align="center" style="font-size:12px"><?php echo $cta2; ?></td>
	     </tr>
	
     <?php } } ?>
         
		 <tr>
		     
			  <th align="center" style="font-size:12px"><?php echo "Total"; ?></td>
	 	      <td align="right" style="font-size:12px"><?php echo " "; ?></td> 
		      <th align="right" style="font-size:12px"><?php echo number_format($tot_ajuste, 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo " " ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo " "; ?></td>
			  <td align="center" style="font-size:12px"><?php echo " "; ?></td>
	     </tr> 
		 
     </table>
	<?php
	
			//}
		 ?> 
    </table>
     <center>
     	<br>
	 <?php if($_SESSION['menu']==3){?> 
	 <input class="btn_form" type="submit" name="accion" value="Asiento 3 Contable">
	 <?php } elseif($_SESSION['menu']==4){?> 
	 <input class="btn_form" type="submit" name="accion" value="Asiento 4 Contable">	    
	 <!--input class="btn_form" type="submit" name="accion" value="Comprobante AITB"-->
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

    <?php } }
	
	if ($_SESSION['asiento'] == 4) {
	
	$borr_cob  = "Delete From temp_ctable3 "; 
    $cob_borr = mysql_query($borr_cob);
	$saldo = 0;
	$f_des = $_POST['fec_des'] ;
	$f_de2 = cambiaf_a_mysql($f_des); 
	$f_has = $_POST['fec_has'] ;
	$f_ha2 = cambiaf_a_mysql($f_has);
	$ufv_1 = leer_tipo_cam_ufv($f_de2);
	$ufv_2 = leer_tipo_cam_ufv($f_ha2);
	$_SESSION['ufv_1'] = $ufv_1;
	$_SESSION['ufv_2'] = $ufv_2;
	$mes = saca_mes($f_des);
	$mes2 = saca_mes($f_has);
	$anio = saca_anio($f_des);
	$mes_l = mes_lit($mes);
	
	$glosa = "AITB Cuentas de Egreso"." Al  ".$f_has."  "." con UFV";
	$_SESSION['glosa'] = $glosa;
	//echo "Asiento 4".$anio;
	?>	
	<br>
	<?php
	echo $glosa;
	 $con_cta = "Select  DISTINCT CONTA_TRS_CTA,CONTA_TRS_FEC_VAL From contab_trans 
		    	  where substring(CONTA_TRS_CTA,1,1) = 4 and 
				  CONTA_TRS_FEC_VAL <= '$f_ha2'";
			  
	 $res_cta = mysql_query($con_cta);
	
	while ($lin_cta = mysql_fetch_array($res_cta)) {
		set_time_limit(0);
	      $monto_d = 0;
		  $monto_h = 0;
		  $saldo = 0;
		  $cod_cta = $lin_cta['CONTA_TRS_CTA'];
		  $fecha = $lin_cta['CONTA_TRS_FEC_VAL'];
		 // echo $fecha." - - ".$cod_cta."***";
		  
		 $sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				               where CONTA_TRS_CTA = '$cod_cta'
							   and CONTA_TRS_FEC_VAL = '$fecha'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_USR_BAJA is null";	
	//}						   					   
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $debe = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $debe_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			}
		$sum_tran = "Select sum(CONTA_TRS_IMPO),sum(CONTA_TRS_IMPO_E) From contab_trans 
				                where CONTA_TRS_CTA = '$cod_cta'
							   and CONTA_TRS_FEC_VAL = '$fecha'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_USR_BAJA is null";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);				   			  
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $haber = $lin_tran['sum(CONTA_TRS_IMPO)'];
						 $haber_2 = $lin_tran['sum(CONTA_TRS_IMPO_E)'];
	        			} 
$mon = 1;
if ($mon == 1){						
    $saldo = $debe - $haber;
	}
if ($mon == 2){						
    $saldo = $debe_2 - $haber_2;
	}
 
		  
		  
		    $consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta, 
										  temp_cuenta,
                                          temp_des_cta,
										  temp_debe_1,
						 	              temp_fec
									       ) values
										  (0,
										   '52901101',
										  '$cod_cta',
									       '$glosa',
										   $saldo,
										    '$fecha'
										   )";
										   
	$resultado = mysql_query($consulta);	  	  
	
	}
//Saldo cuenta 	
 $con_fec = "Select DISTINCT temp_fec From temp_ctable3";
			  
 $res_fec = mysql_query($con_fec);
	
	while ($lin_fec = mysql_fetch_array($res_fec)) {
          $f_tran = $lin_fec['temp_fec']; 
		   $mes_tra = substr($f_tran,5,2);
		 if ($mes2 == $mes_tra){
		      
		      $ufv_1 = leer_tipo_cam_ufv($f_tran);
		    //   echo $f_tran .$f_de2."===".$ufv_1."==";
			   $_SESSION['ufv_1'] = $ufv_1;
			   }else{
			 //   echo $f_tran .$f_de2."<><>";
			  $ufv_1 = leer_tipo_cam_ufv($f_de2);
            
              $_SESSION['ufv_1'] = $ufv_1;
		 } 
		  
        //  $ufv_1 = leer_tipo_cam_ufv($f_tran);
        //  $_SESSION['ufv_1'] = $ufv_1;
       //   echo $f_tran."***";
$sum_tran = "Select sum(temp_debe_1) From temp_ctable3 
				                where temp_fec = '$f_tran'";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);
				   			  
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $saldo = $lin_tran['sum(temp_debe_1)'];
					} 
 $saldo = round($saldo,2);
 
  		   if ($ufv_1>0){
			 $dol_orig = $saldo / $ufv_1;
			 } else {
			 $dol_orig = 0;
			 }
 
	      //$dol_orig = $saldo /$ufv_1;
		  $nuev_bs =  $dol_orig * $ufv_2;
		  $ajuste_1 = $nuev_bs - $saldo;
	$consulta = "update temp_ctable3  set temp_haber_1 = $ajuste_1,
	                                      temp_debe_2 = $ufv_1,
										  temp_haber_2 = $ufv_2
	             where temp_fec = '$f_tran'";
										  
										   
    $resultado = mysql_query($consulta);
						
}						
						
	//echo $ufv_1." ".$ufv_2;
	// $saldo = sal_mayor2('34203101',$f_de2,1,2011);
		 
		/*  
		  */
		  
		  
		  
		//  echo $saldo."---". $ajuste_1;
		
	
?>	
	    <br>
		<form name="form2" method="post" action="con_ufv_op.php" onSubmit="return">

 <table width="100%"  border="1" align="center"  class="table_usuario">
    <tr>
	 
	  <th scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="20%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />SALDO ORIGINAL Bs.</th>
	 <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />AJUSTE </th>
	  <th width="20%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />UFV INICIO</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />UFV FINAL </th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CUENTA <br>
	                                                                         AJUSTE </th>
	</tr>
	<?php	
	$tot_ajuste = 0;
	$con_fec = "Select DISTINCT temp_fec From temp_ctable3";
			  
    $res_fec = mysql_query($con_fec);
	
	while ($lin_fec = mysql_fetch_array($res_fec)) {
	        $f_tran = $lin_fec['temp_fec']; 
	$sum_tran = "Select sum(temp_debe_1),temp_haber_1,temp_debe_2,temp_haber_2,temp_nro_cta
	             From temp_ctable3 
				                where temp_fec = '$f_tran'";	
							   
		//}	
		 $res_tran = mysql_query($sum_tran);
				   			  
				  
					
	
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = "";
	$cuenta2 = "";
	while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $saldo = $lin_tran['sum(temp_debe_1)'];
						 $ajuste = $lin_tran['temp_haber_1'];
						 $ufv_1 = $lin_tran['temp_debe_2'];
	                     $ufv_2 = $lin_tran['temp_haber_2'];
						 $cta2 = $lin_tran['temp_nro_cta'];
						 $fec_tran = cambiaf_a_normal($f_tran);
						 $tot_ajuste = $tot_ajuste + $ajuste;
	//      $cuenta2 = $linea['temp_cuenta'];
//	if ($cuenta1 <> $cuenta2){
	   //    $des_cta = leer_cta_des($cuenta2);
//		    $saldo = sal_mayor( $cuenta2,$fec_de2,1);
//			$sal_1 = $saldo;
//			 $saldo_sus = sal_mayor($cuenta2,$fec_de2,2);
//			$sal_2 = $saldo_sus;
//	  $_SESSION['saldo'] = $saldo;
//	   $_SESSION['saldo_sus'] = $saldo_sus; ?>
	  
	
		   
		   
	
	
	<?php
	
		   ?>
		  
	      <tr>
		     
			  <td align="center" style="font-size:12px"><?php echo $fec_tran; ?></td>
	 	      <td align="right" style="font-size:12px"><?php echo number_format($saldo, 2, '.',','); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo number_format($ajuste, 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($ufv_1, 5, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($ufv_2, 5, '.',','); ?></td>
			  <td align="center" style="font-size:12px"><?php echo $cta2; ?></td>
	     </tr>
	
     <?php } } ?>
          <tr>
		     
			  <th align="center" style="font-size:12px"><?php echo "Total"; ?></td>
	 	      <td align="right" style="font-size:12px"><?php echo " "; ?></td> 
		      <th align="right" style="font-size:12px"><?php echo number_format($tot_ajuste, 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo " " ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo " "; ?></td>
			  <td align="center" style="font-size:12px"><?php echo " "; ?></td>
	     </tr> 
     </table>
	<?php
	
			//}
		 ?> 
    </table>
     <center>
	  <br>
	 <?php if($_SESSION['menu']==3){?> 
	 <input class="btn_form" type="submit" name="accion" value="Asiento 3 Contable">
	 <?php } elseif($_SESSION['menu']==4){?> 
	 <input class="btn_form" type="submit" name="accion" value="Asiento 4 Contable">
	 <!--input class="btn_form" type="submit" name="accion" value="Comprobante AITB"-->
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

    <?php } } }?>
	
	
</form>
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