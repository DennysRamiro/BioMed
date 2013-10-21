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
<title>Crea Transacciones</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
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
 $logi = $_SESSION['login']; 
?> 
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Crea Transacciones de Cartera
            </div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
 ?>  
  
  <table border="1" width="1300">
	
	<tr>
	    <th align="center">Nro</th>  
	   	<th align="center">Nro. Crédito</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Moneda</th>
		<th align="center">Monto</th>
		<th align="center">Tasa Int</th>
		<th align="center">Fec.Desem.</th>
		<th align="center">Nro.Cuotas</th>
		<th align="center">Forma Pago</th>
		<th align="center">Tipo Oper.</th>
		<th align="center">Cta. Ahorro</th>
		<th align="center">Estado</th>
	</tr>	
  
  
  
  
  
   
 <?php 
 $gru = "0"; 
$con_car  = "Select * From cart_maestro where CART_ESTADO < 9 and CART_NUMERICO = 2707
             and CART_MAE_USR_BAJA is null order by 2"; 
$res_car = mysql_query($con_car)or die('No pudo seleccionar cart_maestro');
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $imp_c = $lin_car['CART_IMP_COM'];
		 $tint = $lin_car['CART_TASA'];
		 $mon = $lin_car['CART_COD_MON'];
		 $t_oper = $lin_car['CART_TIPO_OPER'];
		 $t_prod = $lin_car['CART_PRODUCTO'];
		 $cuotas = $lin_car['CART_NRO_CTAS'];
		 $f_pag = $lin_car['CART_FORM_PAG'];
		 $ahod = $lin_car['CART_AHO_DUR'];
		 $f_des = $lin_car['CART_FEC_DES'];
		 $f_uno = $lin_car['CART_FEC_UNO'];
		 $c_agen = $lin_car['CART_COD_AGEN'];
		 $c_grup = $lin_car['CART_COD_GRUPO'];
		 $estado = $lin_car['CART_ESTADO'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $nom_grp = "";
		 $cod_fon = 0;
		 $d_est = "";
		// $f_uno2= cambiaf_a_normal($f_uno);
		 echo $lin_car['CART_NUMERICO'].encadenar(2).$cod_cre;
   
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
   $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 3')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
				  }  
	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			}
	$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_oper";
      $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla')  ;
	  while ($linea = mysql_fetch_array($res_top)) {
	  $d_top = $linea['GRAL_PAR_INT_DESC'];
	  }	
	
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
      $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla');
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
	$con_fon = "Select * From fond_maestro where FOND_NRO_CRED = $cod_cre and FOND_MAE_USR_BAJA is null";
        $res_fon = mysql_query($con_fon)or die('No pudo seleccionarse tabla fond_maestro')  ;
	    while ($lin_fon = mysql_fetch_array($res_fon)) {
	        $cod_fon = $lin_fon['FOND_NRO_CTA'];
			$_SESSION['fondo'] = $cod_fon;
			}
	$con_cli = "Select * From cart_deudor, cliente_general where CART_DEU_NCRED = $cod_cre
	            and CLIENTE_COD_ID = CART_DEU_ID  and CART_DEU_RELACION = 'C' 
	           and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
    $res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla cart_deudor, cliente_general')  ;
	    while ($lin_cli = mysql_fetch_array($res_cli)) {
	        $nom_cli = $lin_cli['CLIENTE_NOMBRES'].encadenar(2).
			           $lin_cli['CLIENTE_AP_PATERNO'].encadenar(2).
					   $lin_cli['CLIENTE_AP_MATERNO'].encadenar(2).
					   $lin_cli['CLIENTE_AP_ESPOSO'].encadenar(2);
			}	
	$nro = $nro + 1;			
		
		
	$con_tra = "Select * From cart_det_tran1 where CART_DTRA_NCRE = $cod_cre";
    $res_tra = mysql_query($con_tra)or die('No pudo seleccionarse tabla cart_det_tra1')  ;
	    
	    while ($lin_tra = mysql_fetch_array($res_tra)) {
		 //   $impo = 0;
			$imp_eqv = 0;
		    $nro = $lin_tra['CART_DTRA_NRO_TRAN'];
		    $tipo = $lin_tra['CART_DTRA_TIP_TRAN'];
			$imp_s = $lin_tra['CART_DTRA_TIP_TRAN'];;
	        $kap = $lin_tra['CART_DTRA_CAP'];
			$int = $lin_tra['CART_DTRA_INT'];
			$int_v = $lin_tra['CART_DTRA_INT_VEN'];
			$aho = $lin_tra['CART_DTRA_AHO'];
			$fec = $lin_tra['CART_DTRA_FECHA'];
			//$impo = $lin_tra['CART_DTRA_SALDO'];
			$tip_tra = 0;
			$tip_cta = 0;
			
			if ($tipo == "D"){
			    $tip_tra = 1;
				$tip_cta = 131;
				if ($mon == 1){
			       $imp_eqv = $impo;
			      }
			    if ($mon == 2){
			       $imp_eqv = $impo*7;
			     } 
				  echo $lin_car['CART_NUMERICO'].encadenar(2).$cod_cre.encadenar(2).$tipo;
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
									       ) values ($cod_cre,
									                 32,
												     $nro,
													 0,
													 '$fec',
												     $tip_tra,
												     $tip_cta,
													 1,
												     '0',
													 $impo,
													 $imp_eqv,
 											     	 '$fec',
												     null,
													 null,
													 0,
													 null,
													 null,
												     0,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran 1 : ' . mysql_error()); 
			}else{
			    $tip_tra = 2;
				if ($kap > 0){
				   $tip_cta = 131;
				   $impo = $kap;
				   if ($mon == 1){
			       $imp_eqv = $impo;
			         }
			       if ($mon == 2){
			         $imp_eqv = $impo*7;
			       }  
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
									       ) values ($cod_cre,
									                 32,
												     $nro,
													 0,
													 '$fec',
												     $tip_tra,
												     $tip_cta,
													 2,
												     '0',
													 $impo,
													 $imp_eqv,
 											     	 '$fec',
												     null,
													 null,
													 0,
													 null,
													 null,
												     0,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran 2 : ' . mysql_error()); 
				  } 
				if ($int > 0){
				   $tip_cta = 513;
				   $impo = $int;
				   if ($mon == 1){
			       $imp_eqv = $impo;
			      }
			    if ($mon == 2){
			       $imp_eqv = $impo*7;
			     }  
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
									       ) values ($cod_cre,
									                 32,
												     $nro,
													 0,
													 '$fec',
												     $tip_tra,
												     $tip_cta,
													 2,
												     '0',
													 $impo,
													 $imp_eqv,
 											     	 '$fec',
												     null,
													 null,
													 0,
													 null,
													 null,
												     0,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran 3 : ' . mysql_error()); 
				  }  
				  
              if ($int_v > 0){
				   $tip_cta = 514;
				   $impo = $int_v;
				   if ($mon == 1){
			       $imp_eqv = $impo;
			      }
			    if ($mon == 2){
			       $imp_eqv = $impo*7;
			     }  
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
									       ) values ($cod_cre,
									                 32,
												     $nro,
													 0,
													 '$fec',
												     $tip_tra,
												     $tip_cta,
													 2,
												     '0',
													 $impo,
													 $imp_eqv,
 											     	 '$fec',
												     null,
													 null,
													 0,
													 null,
													 null,
												     0,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran 4 : ' . mysql_error()); 
				  }  
	if ($aho > 0){
				   $tip_cta = 212;
				   $impo = $aho;
				   if ($mon == 1){
			       $imp_eqv = $impo;
			      }
			    if ($mon == 2){
			       $imp_eqv = $impo*7;
			     }  
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
									       ) values ($cod_cre,
									                 32,
												     $nro,
													 0,
													 '$fec',
												     $tip_tra,
												     $tip_cta,
													 2,
												     '0',
													 $impo,
													 $imp_eqv,
 											     	 '$fec',
												     null,
													 null,
													 0,
													 null,
													 null,
												     0,
												    '$log_usr',
												     null,
												     null,
												    '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar cart_det_tran 5 : ' . mysql_error()); 
				  }  			  				  
				  
				  
				  
				  
			}	
		
	 }
		
		?>	
		
		
		
		
		
	<center>
	
		
	
					 
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $cod_cre; ?></td>
	    <td align="left" ><?php echo $nom_cli; ?></td>
       	<td align="left" ><?php echo $nom_grp; ?></td>
		<td align="left" ><?php echo $d_mon; ?></td>
		<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tint, 2, '.',','); ?></td>
		<td align="left" ><?php echo $f_des2; ?></td>
		<td align="right" ><?php echo number_format($cuotas, 0, '.',','); ?></td>
		<td align="left" ><?php echo $fpag_d; ?></td>
		<td align="left" ><?php echo $d_top; ?></td>
		<td align="left" ><?php echo $cod_fon; ?></td>
		<td align="left" ><?php echo $d_est; ?></td>
		
	</tr>	
	<?php
       }
    ?>	  
</table>		  
<br>
 

<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Verificando Consistencia</MARQUEE></FONT></B>
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

