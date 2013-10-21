<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
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
	    <a href='tipo_rep_cont3.php?menu=1'>Salir</a>
  </div>
         
<center>
<BR>
<font  size="+2">

<?php
echo "Reserva de Comprobantes Contables";
?>
<br>
</font>

<table width="80%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />NRO. DOCUMENTO </th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />FECHA</th>
	 
	</tr>
<?php
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
$consul2 = 0;
 $nro_doc = 0;
if (isset($_POST['nro_doc'])){
   $nro_doc = $_POST['nro_doc'];
   //$consul = 1;
 }
 /*if ($nro_doc == 0){
    if (isset($_SESSION['nro_doc'])){
     $nro_doc = $_SESSION['nro_doc'];
	 $consul = 1;
	} 
}*/ 
 if (isset($_POST['fec_nac'])){
   $fech = $_POST['fec_nac'];
   $fecha = cambiaf_a_mysql_2($fech);
 /*  if ($fecha == "--"){
      $consul2 = 0;
	  }else{
	  $consul2 = 1;
	  }*/
 }

$_SESSION['descrip'] = "Documento Reservado";


//echo "Glosa ".encadenar(2).$_SESSION['descrip'];
//$glosa1 = $_SESSION['descrip'];
?>
 <?php
for ($x=1; $x < $nro_doc+1; $x = $x + 1 ) {
    $nro_tr_con = leer_nro_co_con();
   // echo encadenar(60). "Nro. Tran. ".encadenar(2).$nro_tr_con;
	$_SESSION['descrip'] = "Documento Reservado"." ".$nro_tr_con;
	$glosa1 = $_SESSION['descrip'];
//	echo $_SESSION['descrip'];
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
                                        ) values (1,
										         $nro_tr_con,
									             '$fecha',
												 '11101101',
												 '$glosa1',
												 0,
												 0,
												 1,
												 1,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
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
											    '$fecha',
											    '$fecha',
											    0,
											    '$glosa1',
											    '$logi',
											     null
											    )";

$resultado = mysql_query($consulta);





   
   ?>
 			<tr>
	 	      <td align="left"><?php echo $nro_tr_con; ?></td>
		      <td align="left"><?php echo $glosa1; ?></td>
			  <td align="center"><?php echo $fech; ?> </td>
		     
			  </tr>

			
 <?php
 }?>
 </table>
  <?php
/* $consulta  = "Select * From temp_ctable3";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
		  $glosa_ind = $linea['temp_glosa'];
		   ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?>
			      <br><?php echo $linea['temp_glosa2']; ?> </td>
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
		
<br><br>
</center>
<?php
 ?>		
<br><br>
<br><br>
<br><br>
<center>
 <?php
  
  echo encadenar(5)."_____________________", encadenar(15),"_____________________";
  ?>
  <br>
  
 <?php
  
  echo encadenar(12)."GERENTE", encadenar(40),"     CONTADOR";
  ?>	
  <br><br>
  <br><br>
  </center>
 <?php
 //Graba contab_trans, contab_mae_sal
 $con_temp  = "Select * From temp_ctable3";
 $res_temp = mysql_query($con_temp);
 $i_deb = 0;
 $i_hab = 0;
 $n_deb = 0;
 $n_hab = 0; 
 while ($lin_temp = mysql_fetch_array($res_temp)) {
        $cod_cta = $lin_temp['temp_nro_cta'];   
 		$imp = $lin_temp['temp_debe_1'] + $lin_temp['temp_haber_1']; 
		$imp_e = $lin_temp['temp_debe_2'] + $lin_temp['temp_haber_2'];
		$glosa_ind = $lin_temp['temp_glosa2'];
		if ($lin_temp['temp_debe_1'] > 0){
		    $deb_hab = 1;
			$i_deb = $imp;
			$i_hab = 0;
			$n_deb = 1;
			$n_hab = 0;
		   }
		if ($lin_temp['temp_haber_1'] > 0){
		    $deb_hab = 2;
			$i_deb = 0;
			$i_hab = $imp;
			$n_deb = 0;
			$n_hab = 1;
		   } 
		 //  echo $glosa_ind;
		  if ( $glosa_ind <> '-'){
		       $glosa = $glosa_ind;
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
                                        ) values (1,
										         $nro_tr_con,
									             '$fec1',
												 '$cod_cta',
												 '$glosa_ind',
												 $imp,
												 $imp_e,
												 $deb_hab,
												 1,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar caja_transac : ' . mysql_error());


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
                $resultado = mysql_query($consulta)or die('No pudo actualizar contab_mae_sal : ' . mysql_error());	
										
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
                                        ) values (1,
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
$resultado = mysql_query($consulta)or die('No pudo insertar contab_mae_sal : ' . mysql_error());
 	       } 
         }
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
											    '$glosa1',
											    '$logi',
											     null
											    )";

$resultado = mysql_query($consulta)or die('No pudo insertar : contab_cabec ' . mysql_error());
	*/    
	?>
</div>


</div>  <?php
		 	include("footer_in.php");
  ?>
</body>
</html>
<?php
ob_end_flush();
 ?>