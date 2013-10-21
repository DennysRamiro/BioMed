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
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
 
</head>
<body>
	<div id="cuerpoModulo">
	<?php
				include("header_2.php");
			?>
            

				<?php
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
        <?php
					if($_SESSION['menu']==1){?>  
	    <a href='con_retro.php?accion=32'>Salir</a>
	    <?php } elseif($_SESSION['menu']==2){?> 
	    <a href='con_retro.php?accion=33'>Salir</a>

	    <?php }//} ?>
  </div>

<br><br>
            
<center>
<BR>
<font  size="+2">


<br><br>
<?php
echo "Comprobante Variaci&oacute;n Tipo Cambio";
?>
<br><br>
</font>
<?php
/*if (isset($_SESSION['diferencia'])){
   if ($_SESSION['diferencia'] == 1){
      echo "No se contabiliza en uno de los Modulos hay diferencia";
   }
 }
 */   
$_SESSION['descrip'] = "Variaci&oacute;n Tipo Cambio  UFV´s" .encadenar(2).$fec;

//$glosa = $_SESSION['descrip'];
?>
<br><br>

 <?php
 /*
  */
  ?>	
  <br>
   </center>
 <?php
 //Graba contab_trans, contab_mae_sal
   if ($_SESSION['asiento'] == 1) { 
 $con_temp  = "Select * From temp_ctable3 order by temp_cuenta ";
 $res_temp = mysql_query($con_temp);
 $tipo = 2;
 $i_deb = 0;
 $i_hab = 0;
 $n_deb = 0;
 $n_hab = 0;
 $apli = 0; 
 $deb_hab = 0;
  $nro_tr_con = leer_nro_co_con();
  echo $_SESSION['descrip'].encadenar(2)."Nro.".encadenar(2).$nro_tr_con;

 while ($lin_temp = mysql_fetch_array($res_temp)) {
   		
	//		$glosa = $lin_temp['temp_des_cta']." de ".$_SESSION['ufv_1']." a ".$_SESSION['ufv_2'];
	$glosa = $_SESSION['glosa'];
		//	} 
       
	if($lin_temp['temp_haber_1'] < 0){
 		$imp = $lin_temp['temp_haber_1'] * -1; 
		$imp_e = 0;
	}else{
	    $imp = $lin_temp['temp_haber_1']; 
		$imp_e = 0;
	
	}	
	if ($imp <> 0){	
	//echo "entra aqui";
		if ($lin_temp['temp_haber_1'] < 0){
		   //  $cod_cta = $lin_temp['temp_cuenta'];
		   if ($_SESSION['asiento'] == 1) {
			 $cod_cta = 34203103;
			 }
			if ($_SESSION['asiento'] == 2) {
			 $cod_cta = 34203101;
			 }
			 $tipo = substr($cod_cta,0,1);
			  if ($tipo == 3){
			     $deb_hab = 2;
			  }	 
			   if ($tipo == 2){
			     $deb_hab = 1;
			  }	
			   if ($tipo == 4){
			     $deb_hab = 1;
			  }	
			   if ($tipo == 5){
			     $deb_hab = 2;
			  }	
			$i_deb = $imp;
			$i_hab = 0;
			$n_deb = 1;
			$n_hab = 0;
		   }
	if ($lin_temp['temp_haber_1'] > 0){
	        if ($_SESSION['asiento'] == 1) {
			 $cod_cta = 34203103;
			 }
			if ($_SESSION['asiento'] == 2) {
			 $cod_cta = 34203101;
			 }
		    // $cod_cta = $lin_temp['temp_cuenta'];
			  $tipo = substr($cod_cta,0,1);
			 if ($tipo == 3){
			     $deb_hab = 2;
			  }	 
			   if ($tipo == 2){
			     $deb_hab = 1;
			  }	
			   if ($tipo == 4){
			     $deb_hab = 1;
			  }	
			   if ($tipo == 5){
			     $deb_hab = 2;
			  }	 
		//echo "aqui-1 " .$deb_hab."---";	 
			  
		  //  $deb_hab = 1;
			$i_deb = $imp;
			$i_hab = 0;
			$n_deb = 1;
			$n_hab = 0;
		   }
		$_SESSION['deb_hab'] =  $deb_hab;
		
   
		  $consulta = "insert into contab_trans (CONTA_TRS_AGEN, 
                                         CONTA_TRS_NRO,
									     CONTA_TRS_FEC_VAL,
									     CONTA_TRS_CTA,
									     CONTA_TRS_GLOSA,
					                     CONTA_TRS_IMPO,
					                     CONTA_TRS_IMPO_E,
   				                         CONTA_TRS_DEB_CRED,
										 CONTA_TRS_TIPO,
					                     CONTA_TRS_USR_ALTA, 
									     CONTA_TRS_FCH_HR_ALTA, 
									     CONTA_TRS_USR_BAJA, 
									     CONTA_TRS_FCH_HR_BAJA
                                        ) values (30,
										         $nro_tr_con,
									             '$fec1',
												 '$cod_cta',
												 '$glosa',
												 $imp,
												 $imp_e,
												 $deb_hab,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
if ($lin_temp['temp_haber_2'] < 0){
		    $cod_cta = $lin_temp['temp_nro_cta'];  
			 $tipo = substr($cod_cta,0,1);
			  if ($tipo == 3){
			     $deb_hab = 2;
			  }	 
			   if ($tipo == 2){
			     $deb_hab = 2;
			  }	
			   if ($tipo == 4){
			     $deb_hab = 1;
			  }	
			   if ($tipo == 5){
			     $deb_hab = 2;
			  }	
		   	$i_deb = $imp;
			$i_hab = 0;
			$n_deb = 1;
			$n_hab = 0;
		   }
if ($lin_temp['temp_haber_2'] > 0){
		    $cod_cta = $lin_temp['temp_nro_cta']; 
			 
		    $tipo = substr($cod_cta,0,1);
			if ($tipo == 3){
			     $deb_hab = 2;
			  }	 
			   if ($tipo == 2){
			     $deb_hab = 1;
			  }	
			   if ($tipo == 4){
			     $deb_hab = 1;
			  }	
			   if ($tipo == 5){
			     $deb_hab = 2;
			  }	
			  
		//	echo "aqui-2 " .$deb_hab."---";	   
			$i_deb = $imp;
			$i_hab = 0;
			$n_deb = 1;
			$n_hab = 0;
		   }
  $consulta = "insert into contab_trans (CONTA_TRS_AGEN, 
                                         CONTA_TRS_NRO,
									     CONTA_TRS_FEC_VAL,
									     CONTA_TRS_CTA,
									     CONTA_TRS_GLOSA,
					                     CONTA_TRS_IMPO,
					                     CONTA_TRS_IMPO_E,
   				                         CONTA_TRS_DEB_CRED,
										 CONTA_TRS_TIPO,
					                     CONTA_TRS_USR_ALTA, 
									     CONTA_TRS_FCH_HR_ALTA, 
									     CONTA_TRS_USR_BAJA, 
									     CONTA_TRS_FCH_HR_BAJA
                                        ) values (30,
										         $nro_tr_con,
									             '$fec1',
												 '$cod_cta',
												 '$glosa',
												 $imp,
												 $imp_e,
												 $deb_hab,
												 $tipo,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

$con_msal  = "Select count(*) From contab_mae_sal where CONTA_MSAL_CTA ='$cod_cta' and
              CONTA_MSAL_FEC_VAL = '$fec1' and CONTA_MSAL_USR_BAJA is null";
$res_msal = mysql_query($con_msal);
       $cta = "";  
       $fec = "";
	   $hay = 0;
	   $imp_d = 0;
	   $imp_h = 0;
	   $nro_d = 0;
	   $nro_h = 0;
	   
	 //  echo "Habia o no Reg.".$cod_cta." ".$fec1;
while ($lin_msal = mysql_fetch_array($res_msal)) {
       if (isset ($lin_msal['count(*)'])){
           $hay = $lin_msal['count(*)'];
		   }
//	   echo "hay" .$hay;
	   if (isset ($lin_msal['CONTA_MSAL_FEC_VAL'])){
           $fec = $lin_msal['CONTA_MSAL_FEC_VAL'];
		   }
	   if (isset ($lin_msal['CONTA_MSAL_IMP_D'])){
	       $imp_d = $lin_msal['CONTA_MSAL_IMP_D'];
		   $nro_d = $lin_msal['CONTA_MSAL_NRO_D'];
		   }
	   if (isset ($lin_msal['CONTA_MSAL_IMP_H'])){   
	       $imp_h = $lin_msal['CONTA_MSAL_IMP_H'];
	       $nro_h = $lin_msal['CONTA_MSAL_NRO_H'];
	       }
	   if ($hay > 0){
	      // echo "Actualiza Reg.";
		   $con_msald  = "Select * From contab_mae_sal where CONTA_MSAL_CTA ='$cod_cta' and
              CONTA_MSAL_FEC_VAL = '$fec1' and CONTA_MSAL_USR_BAJA is null";
           $res_msald = mysql_query($con_msald);
           $cta = "";  
           $fec = "";
	       $imp_d = 0;
	       $imp_h = 0;
	       $nro_d = 0;
	       $nro_h = 0;
	   
	 //  echo "Habia o no Reg.".$cod_cta." ".$fec1;
           while ($lin_msald = mysql_fetch_array($res_msald)) {
		   
	             if (isset ($lin_msald['CONTA_MSAL_FEC_VAL'])){
                    $fec = $lin_msald['CONTA_MSAL_FEC_VAL'];
		            }
	             if (isset ($lin_msald['CONTA_MSAL_IMP_D'])){
	                $imp_d = $lin_msald['CONTA_MSAL_IMP_D'];
		            $nro_d = $lin_msald['CONTA_MSAL_NRO_D'];
		            }
	             if (isset ($lin_msald['CONTA_MSAL_IMP_H'])){   
	                $imp_h = $lin_msald['CONTA_MSAL_IMP_H'];
	                $nro_h = $lin_msald['CONTA_MSAL_NRO_H'];
	                } 
				$consulta = "update contab_mae_sal set CONTA_MSAL_IMP_D = $imp_d + $i_deb,
					                                   CONTA_MSAL_IMP_H = $imp_h + $i_hab,
					                                   CONTA_MSAL_NRO_D = $nro_d + 1,
   				                                       CONTA_MSAL_NRO_H = $nro_h + 1 
													   where CONTA_MSAL_CTA ='$cod_cta' and
                                                             CONTA_MSAL_FEC_VAL = '$fec1' and 
															 CONTA_MSAL_USR_BAJA is null ";
                $resultado = mysql_query($consulta);	
										
		   }
		   
	       }else{
		  // echo "Nuevo Reg.";
		   $consulta = "insert into contab_mae_sal (CONTA_MSAL_AGEN, 
                                         CONTA_MSAL_CTA,
									     CONTA_MSAL_FEC_VAL,
									     CONTA_MSAL_FEC_TRAN,
									     CONTA_MSAL_IMP_D,
					                     CONTA_MSAL_IMP_H,
					                     CONTA_MSAL_NRO_D,
   				                         CONTA_MSAL_NRO_H,
					                     CONTA_MSAL_USR_ALTA, 
									     CONTA_MSAL_FCH_HR_ALTA, 
									     CONTA_MSAL_USR_BAJA, 
									     CONTA_MSAL_FCH_HR_BAJA
                                        ) values (30,
										         '$cod_cta',
												 '$fec1',
												 '$fec1',
												 $i_deb,
												 $i_hab,
												 $n_deb,
												 $n_hab,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
 	       } 
         }
		} 
	//echo "Contabilizo?";	 
       } 
  $consulta  = "Insert into contab_cabec (CONTA_CAB_AGEN,
	                                      CONTA_CAB_NRO,
	                                      CONTA_CAB_FEC_VAL,
										  CONTA_CAB_FEC_TRAN,
                                          CONTA_CAB_CBIO,
										  CONTA_CAB_GLOSA,
										  CONTA_CAB_USR_ALTA,
										  CONTA_CAB_FCH_HR_ALTA
										) values
											   (30,
											    $nro_tr_con,
											    '$fec1',
											    '$fec1',
											    0,
											    '$glosa',
											    '$log_usr',
											     null
											    )";

$resultado = mysql_query($consulta);	

}

 if ($_SESSION['asiento'] == 2) { 
  $i_deb = 0;
 $i_hab = 0;
 $n_deb = 0;
 $n_hab = 0;
 $apli = 0; 
 $deb_hab = 0;
 
 
 $con_temp = "Select sum(temp_haber_1) From temp_ctable3";
			  
    $res_temp = mysql_query($con_temp);
	
	while ($lin_temp = mysql_fetch_array($res_temp)) {
	     //  $f_tran = $lin_temp['temp_fec']; 
		   $ajuste = $lin_temp['sum(temp_haber_1)']; 
           $tipo = 2;
           $i_hab = $i_hab + $ajuste;
	   }
	   $imp = $i_hab;
	   $imp_e = 0;
  $nro_tr_con = leer_nro_co_con();
  echo $_SESSION['descrip'].encadenar(2)."Nro.".encadenar(2).$nro_tr_con;

   		
			$glosa = $_SESSION['glosa'];
			if ($_SESSION['asiento'] == 2) {
			$cod_cta = '42801101';
			}
			if ($_SESSION['asiento'] == 4) {
			$cod_cta = '52901101';
			}
             $deb_hab = 1;
		//	} 
       

   		
		  $consulta = "insert into contab_trans (CONTA_TRS_AGEN, 
                                         CONTA_TRS_NRO,
									     CONTA_TRS_FEC_VAL,
									     CONTA_TRS_CTA,
									     CONTA_TRS_GLOSA,
					                     CONTA_TRS_IMPO,
					                     CONTA_TRS_IMPO_E,
   				                         CONTA_TRS_DEB_CRED,
										 CONTA_TRS_TIPO,
					                     CONTA_TRS_USR_ALTA, 
									     CONTA_TRS_FCH_HR_ALTA, 
									     CONTA_TRS_USR_BAJA, 
									     CONTA_TRS_FCH_HR_BAJA
                                        ) values (30,
										         $nro_tr_con,
									             '$fec1',
												 '$cod_cta',
												 '$glosa',
												 $imp,
												 $imp_e,
												 $deb_hab,
												 2,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
/*
		   */
		$glosa = $_SESSION['glosa'];
		if ($_SESSION['asiento'] == 2) {
			 $cod_cta = 34203101;
			 }
			//$cod_cta = '42901101';
             $deb_hab = 2;
	   
  $consulta = "insert into contab_trans (CONTA_TRS_AGEN, 
                                         CONTA_TRS_NRO,
									     CONTA_TRS_FEC_VAL,
									     CONTA_TRS_CTA,
									     CONTA_TRS_GLOSA,
					                     CONTA_TRS_IMPO,
					                     CONTA_TRS_IMPO_E,
   				                         CONTA_TRS_DEB_CRED,
										 CONTA_TRS_TIPO,
					                     CONTA_TRS_USR_ALTA, 
									     CONTA_TRS_FCH_HR_ALTA, 
									     CONTA_TRS_USR_BAJA, 
									     CONTA_TRS_FCH_HR_BAJA
                                        ) values (30,
										         $nro_tr_con,
									             '$fec1',
												 '$cod_cta',
												 '$glosa',
												 $imp,
												 $imp_e,
												 $deb_hab,
												 $tipo,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);

$con_msal  = "Select count(*) From contab_mae_sal where CONTA_MSAL_CTA ='$cod_cta' and
              CONTA_MSAL_FEC_VAL = '$fec1' and CONTA_MSAL_USR_BAJA is null";
$res_msal = mysql_query($con_msal);
       $cta = "";  
       $fec = "";
	   $hay = 0;
	   $imp_d = 0;
	   $imp_h = 0;
	   $nro_d = 0;
	   $nro_h = 0;
	   
	 //  echo "Habia o no Reg.".$cod_cta." ".$fec1;
while ($lin_msal = mysql_fetch_array($res_msal)) {
       if (isset ($lin_msal['count(*)'])){
           $hay = $lin_msal['count(*)'];
		   }
//	   echo "hay" .$hay;
	   if (isset ($lin_msal['CONTA_MSAL_FEC_VAL'])){
           $fec = $lin_msal['CONTA_MSAL_FEC_VAL'];
		   }
	   if (isset ($lin_msal['CONTA_MSAL_IMP_D'])){
	       $imp_d = $lin_msal['CONTA_MSAL_IMP_D'];
		   $nro_d = $lin_msal['CONTA_MSAL_NRO_D'];
		   }
	   if (isset ($lin_msal['CONTA_MSAL_IMP_H'])){   
	       $imp_h = $lin_msal['CONTA_MSAL_IMP_H'];
	       $nro_h = $lin_msal['CONTA_MSAL_NRO_H'];
	       }
	   if ($hay > 0){
	      // echo "Actualiza Reg.";
		   $con_msald  = "Select * From contab_mae_sal where CONTA_MSAL_CTA ='$cod_cta' and
              CONTA_MSAL_FEC_VAL = '$fec1' and CONTA_MSAL_USR_BAJA is null";
           $res_msald = mysql_query($con_msald);
           $cta = "";  
           $fec = "";
	       $imp_d = 0;
	       $imp_h = 0;
	       $nro_d = 0;
	       $nro_h = 0;
	   
	 //  echo "Habia o no Reg.".$cod_cta." ".$fec1;
           while ($lin_msald = mysql_fetch_array($res_msald)) {
		   
	             if (isset ($lin_msald['CONTA_MSAL_FEC_VAL'])){
                    $fec = $lin_msald['CONTA_MSAL_FEC_VAL'];
		            }
	             if (isset ($lin_msald['CONTA_MSAL_IMP_D'])){
	                $imp_d = $lin_msald['CONTA_MSAL_IMP_D'];
		            $nro_d = $lin_msald['CONTA_MSAL_NRO_D'];
		            }
	             if (isset ($lin_msald['CONTA_MSAL_IMP_H'])){   
	                $imp_h = $lin_msald['CONTA_MSAL_IMP_H'];
	                $nro_h = $lin_msald['CONTA_MSAL_NRO_H'];
	                } 
				$consulta = "update contab_mae_sal set CONTA_MSAL_IMP_D = $imp_d + $i_deb,
					                                   CONTA_MSAL_IMP_H = $imp_h + $i_hab,
					                                   CONTA_MSAL_NRO_D = $nro_d + 1,
   				                                       CONTA_MSAL_NRO_H = $nro_h + 1 
													   where CONTA_MSAL_CTA ='$cod_cta' and
                                                             CONTA_MSAL_FEC_VAL = '$fec1' and 
															 CONTA_MSAL_USR_BAJA is null ";
                $resultado = mysql_query($consulta);	
										
		   }
		   
	       }else{
		  // echo "Nuevo Reg.";
		   $consulta = "insert into contab_mae_sal (CONTA_MSAL_AGEN, 
                                         CONTA_MSAL_CTA,
									     CONTA_MSAL_FEC_VAL,
									     CONTA_MSAL_FEC_TRAN,
									     CONTA_MSAL_IMP_D,
					                     CONTA_MSAL_IMP_H,
					                     CONTA_MSAL_NRO_D,
   				                         CONTA_MSAL_NRO_H,
					                     CONTA_MSAL_USR_ALTA, 
									     CONTA_MSAL_FCH_HR_ALTA, 
									     CONTA_MSAL_USR_BAJA, 
									     CONTA_MSAL_FCH_HR_BAJA
                                        ) values (30,
										         '$cod_cta',
												 '$fec1',
												 '$fec1',
												 $i_deb,
												 $i_hab,
												 $n_deb,
												 $n_hab,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
 	       } 
         }
		//} 
	//echo "Contabilizo?";	 
     //  } 
  $consulta  = "Insert into contab_cabec (CONTA_CAB_AGEN,
	                                      CONTA_CAB_NRO,
	                                      CONTA_CAB_FEC_VAL,
										  CONTA_CAB_FEC_TRAN,
                                          CONTA_CAB_CBIO,
										  CONTA_CAB_GLOSA,
										  CONTA_CAB_USR_ALTA,
										  CONTA_CAB_FCH_HR_ALTA
										) values
											   (30,
											    $nro_tr_con,
											    '$fec1',
											    '$fec1',
											    0,
											    '$glosa',
											    '$log_usr',
											     null
											    )";

$resultado = mysql_query($consulta);	

}
 ?>
	
	</table>
	
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