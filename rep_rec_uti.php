<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
include('header_2.php');
 $fec =  $_SESSION['fec_proc'];  //leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='rec_reportes.php'>Salir</a>
  </div>

<br><br>
<?php
$f_des = "";
$f_has = "";
$mone = " ";
if(isset($_POST['fec_des'])){
      $f_des = $_POST['fec_des'];
      $_SESSION['f_des'] = $f_des;
	  $f_des2 = cambiaf_a_mysql($f_des);
  }
 if(isset($_POST['fec_has'])){
      $f_has = $_POST['fec_has'];
      $_SESSION['f_has'] = $f_has;
	  $f_has2 = cambiaf_a_mysql($f_has);
  } 
  if(isset($_POST['cod_mon'])){
      $mone = $_POST['cod_mon'];
      $_SESSION['mone'] = $mone;
  }
  $nro_tal = 0;
  if(isset($_SESSION['nro_tal'])){
     $nro_tal = $_SESSION['nro_tal'];
  
  }
    
?> <center>
<font size="+1"  style="" >
<?php
//if ($mone == 1){
    echo encadenar(0)."LISTADO DE RECIBOS UTILIZADOS ".encadenar(2);
//  }
// if ($mone == 2){
  //  echo encadenar(35)."LISTADO DE RECUPERACIONES DE CARTERA EN ".encadenar(2). "DOLARES";
  //} 
?>
<br>
</font>

<font size="+1"  style="" >

	 
<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$t_cap = 0;
	$t_int = 0;
	$t_ifa = 0;
	$t_iven = 0;
	$t_aho = 0; 
	$t_otro = 0;
	$t_pen = 0;
	$t_ifa = 0;
	$t_tot  = 0;	
	$nro_rec  = 0;				
    $nro_tran = 0;
	
	$con_rec = "Select * From recibo_cntrl where REC_CTRL_NRO = $nro_tal and
	 REC_CTRL_USR_BAJA is null order by REC_CTRL_DESDE ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	         $fec_ent = cambiaf_a_normal($lin_res['REC_CTRL_FECHA']);
	         $respon = $lin_res['REC_CTRL_FUNC'];
	         $rec_desde = $lin_res['REC_CTRL_DESDE'];
	         $rec_hasta = $lin_res['REC_CTRL_HASTA'];
			 
echo encadenar(0)."TALONARIO".encadenar(2).$nro_tal.encadenar(2).
"DEL".encadenar(2).$rec_desde.encadenar(2)."AL".encadenar(2).$rec_hasta;
      }	
?> 
<br>
<?php
    echo encadenar(0)."RESPONSABLE ".encadenar(2).$respon;
?>
</font>
<br><br>
<font size="0"  style="" >
	  
<table border="1" width="100">
	
	<tr>
	    <th align="center"><font size="-1">FECHA TRANSAC.</font></th>
	    <th align="center"><font size="-1">ASESOR</th> 
		<th align="center"><font size="-1">NRO. RECIBO</th>
	    <th align="center"><font size="-1">NRO. TRAN. CARTERA</th> 
		<th align="center"><font size="-1">NRO. OPERACION</th> 
		<th align="center"><font size="-1">CLIENTE</th>
		<th align="center"><font size="-1">GRUPO</th>
		<th align="center"><font size="-1">MONTO</th>
		<th align="center"><font size="-1">MONEDA</th>
    </tr>			
<?php	  
	 for ($i=$rec_desde; $i < $rec_hasta + 1; $i = $i + 1 ) { //1
	      $hay = 0;
	      $con_reci = "Select count(*) From recibo_deta where  REC_DET_NRO = $i and
		             REC_DET_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci);
	                while ($lin_reci = mysql_fetch_array($res_reci)) { //2a
					      $hay =  $lin_reci['count(*)'];
						  //echo $hay;
	                         } //2b
		if ($hay > 0){  //3
			$con_reci = "Select * From recibo_deta where  REC_DET_NRO = $i
		             and REC_DET_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci);
	                    while ($lin_reci = mysql_fetch_array($res_reci)) { //4
						      $nro_tran = $lin_reci['REC_DET_NRO_CART'];
	                          $nro_rec =  $lin_reci['REC_DET_NRO'];
	                    	  $nro_caja = $lin_reci['REC_DET_NRO_CAJA'];
                              $fec_rec = $lin_reci['REC_DET_FECHA'];
							  $cod_cre1  = $lin_reci['REC_NRO_CRED'];
//  echo  $nro_tran. "  ". $nro_rec;
								$con_tpa = "Select DISTINCT CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE
								            From cart_det_tran, cart_maestro where
											CART_DTRA_NCRE = $cod_cre1 and
								            CART_DTRA_FECHA  = '$fec_rec' and 
											CART_DTRA_NRO_TRAN = $nro_tran and
								             CART_DTRA_TIP_TRAN < 3 and  CART_NRO_CRED = CART_DTRA_NCRE 
											 and CART_DTRA_USR_BAJA is null and CART_MAE_USR_BAJA is null
											 order by CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE ";
							    $res_tpa = mysql_query($con_tpa);
	
							    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // //5
								    $fec_pag = $lin_tpa['CART_DTRA_FECHA'];
									$f_pag = cambiaf_a_normal($fec_pag);
									$nro_tran = $lin_tpa['CART_DTRA_NRO_TRAN'];
									$cod_cre = $lin_tpa['CART_DTRA_NCRE'];
							//Consulta Cart_maestro
									
											$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
								             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
								             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
											 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null"; 
								             $res_car = mysql_query($con_car);
		 
								             while ($lin_car = mysql_fetch_array($res_car)) { //6
									                $c_grup = 0;
													$nom_ases = "";
									                $mon = $lin_car['CART_COD_MON'];
													$tcred = $lin_car['CART_TIPO_CRED'];
													$asesor = $lin_car['CART_OFIC_RESP'];
													$tip_ope = $lin_car['CART_TIPO_OPER'];
											        $c_grup = $lin_car['CART_COD_GRUPO'];  
													$nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
													$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
													$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
													$lin_car['CLIENTE_NOMBRES'].encadenar(1); 
													$nom_ases = leer_nombre_usr($tcred,$asesor);
													//	echo $tcred,$asesor,$nom_ases;		 
			
													if ($c_grup > 0){			//7
														$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
											            $res_grp = mysql_query($con_grp);
												        while ($lin_grp = mysql_fetch_array($res_grp)) { //8
												              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
														     // $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
															} //8b
													}else{	//9
														$nom_grp = "";	
													}	//9b
											} //7b
											$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and 
											           GRAL_PAR_INT_COD = $tip_ope ";
									        $res_top = mysql_query($con_top);
												 while ($lin_top = mysql_fetch_array($res_top)) { //10
												        $d_tipope =  $lin_top['GRAL_PAR_INT_DESC'];
												 
												    }	//10b
											$con_est = "Select CART_CAB_EST_ANT From cart_cabecera where 
											            CART_CAB_NCRE = $cod_cre and 
										            CART_CAB_FECHA = '$fec_pag' and CART_CAB_NRO_TRAN = $nro_tran and
													CART_CAB_TIP_TRAN = 2 and CART_CAB_USR_BAJA is null";
									            $res_est = mysql_query($con_est);
													 while ($lin_est = mysql_fetch_array($res_est)) { //11
												        $estado =  $lin_est['CART_CAB_EST_ANT'];
												        if ($estado == 3){ //12
														    $d_est = "VIG.";
														} //12b
														if ($estado == 6){  //13
														    $d_est = "VEN.";
														}  //13b
														if ($estado == 7){  //14
														    $d_est = "EJE.";
														}  //14b
														if ($estado == 8){  //15
														    $d_est = "CAS.";
														}	 //15b
												    }	//11b
				
				
				
			//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
													$p_cap = 0;
													$p_int = 0;
													$p_ifa = 0;
												    $p_iven = 0;
												    $p_aho = 0; 
												    $p_otro = 0;
												    $p_pen = 0;
												    $p_tot  = 0;
													
													$con_tra = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and 
											            CART_DTRA_FECHA = '$fec_pag' and CART_DTRA_NRO_TRAN = $nro_tran and
														CART_DTRA_TIP_TRAN = 2 and CART_DTRA_USR_BAJA is null";
										            $res_tra = mysql_query($con_tra);
													while ($lin_tra = mysql_fetch_array($res_tra)) { // 16
													      $t_ccon = $lin_tra['CART_DTRA_CCON'];
														  $p_imp = $lin_tra['CART_DTRA_IMPO'];
														  $t_tran = $lin_tra['CART_DTRA_TIP_TRAN'];
														  $deb_cre = $lin_tra['CART_DTRA_DEB_CRE'];
														  $tip_cam = $lin_tra['CART_DTRA_TIP_CAM'];
														  $cta_con = substr($lin_tra['CART_DTRA_CTA_CBT'],3,2);
														  $caje = substr($lin_tra['CART_DTRA_USR_ALTA'],0,8);
												//		  echo $t_ccon." - ";
														  if ($t_tran == 1){ // 17
														      $saldo =  $p_imp;
															} // 17b
													 	  if ($t_tran == 2){ //18
													  
														      	if ($t_ccon > 130 and $t_ccon < 135){ //19
															   
																    $p_cap =  $p_imp;
																	$t_cap =  $t_cap + $p_cap;
																} // 19b
															    if ($t_ccon == 138){ //20
																    $p_ifa =  $p_imp;
																	$t_ifa =  $t_ifa + $p_ifa;
																}	//20b
															    if ($t_ccon == 531){ //21
																      if ($cta_con == '04'){
																          $p_cap =  $p_imp;
																	      $t_cap =  $t_cap + $p_cap;
																	  } //21b
																	  if ($cta_con == '02'){ //22
																	      $p_int =  $p_imp;
																	      $t_int =  $t_int + $p_int;
																	  } //22b
																} //18b
																 if ($t_ccon > 512 and $t_ccon < 514){ //23
																 
																    $p_int =  $p_imp;
																	$t_int =  $t_int + $p_int;
																	} //23b
																 if ($t_ccon > 514 and $t_ccon < 516){ //24
																    $p_iven =  $p_imp;
																	$t_iven =  $t_iven + $p_iven;
																	} //24b
																 if ($t_ccon == 212){//25
															//	 echo "dentro ".$t_ccon." - ".$t_tran." - d ".$deb_cre;
																     if ($deb_cre == 2){ //26
																	    $p_aho =  $p_imp;
																	//	echo $p_aho;
																	    $t_aho =  $t_aho + $p_aho;
																	} //26b
																} //25b
																 if ($t_ccon == 242){ //27
																    $p_otro =  round($p_imp / $tip_cam ,2);
																	$t_otro =  $t_otro + $p_otro;
																	}	//27b
															} // 4b	
																$p_tot  = $p_cap + $p_int + $p_iven + $p_aho + $p_otro+$p_ifa;	
																
														} // 18b
															$t_tot = $t_tot + $p_tot;
									}		}

		//Recupera nro de recibo
	/*	$nro_rec = 0;
		$con_reci = "Select * From recibo_deta where  REC_DET_NRO_CART = $nro_tran
		             and REC_NRO_CRED = $cod_cre
	                 and REC_DET_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci)or die('No pudo seleccionarse tabla');
	                    while ($lin_reci = mysql_fetch_array($res_reci)) {
	                          $nro_rec =  $lin_reci['REC_DET_NRO'];
	                    }	
		*/	
			
			
		?>
	
		
	<tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
	    <td align="left" style="font-size:10px"><?php echo $nom_ases; ?></td>	
		<td align="right" ><?php echo number_format($nro_rec, 0, '.',''); ?></td>
	    <td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="right" ><?php echo $cod_cre; ?></td>	
		<td align="left" style="font-size:10px" ><?php echo $nom_cli; ?></td>	
		<td align="left" style="font-size:10px"><?php echo $nom_grp; ?></td>							
	   	<td align="right" ><?php echo number_format($p_tot, 2, '.',','); ?></td>
		<td align="center" style="font-size:10px" ><?php echo $mon; ?></td>
		
		
	</tr>	
	
	<?php					 
	 } // 2b
	 //}
	 } //1b
	  ?>
	  </table></center>
	<?php
 	include("footer_in.php");
 ?>

</div>
</body>
</html>



<?php
ob_end_flush();
 ?>

