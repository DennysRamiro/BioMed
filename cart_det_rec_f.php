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
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cart_reportes.php'>Salir</a>
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
?> 
<font size="+1"  style="" >
<?php
if ($mone == 1){
    echo encadenar(35)."LISTADO DE INGRESOS FACTURABLES EN ".encadenar(2). "BOLIVIANOS";
  }
 if ($mone == 2){
    echo encadenar(35)."LISTADO DE INGRESOS FACTURABLES EN ".encadenar(2). "DOLARES";
  } 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(60)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="900">
	
	<tr>
	    <th align="center"><font size="-1">NRO.</th>
	    <th align="center"><font size="-1">CLIENTE</th>
		<th align="center"><font size="-1">C.I.</th>
	    <th align="center"><font size="-1">FECHA TRANSAC.</font></th>
	    <th align="center"><font size="-1">NRO. TRAN.</th>  
	   	<th align="center"><font size="-1">NRO. OPERACION</th> 
		<th align="center"><font size="-1">GRUPO</th>
		<th align="center"><font size="-1">TIPO TRANS.</th>
		<th align="center"><font size="-1">IMPORTE</th>
		<?php   if ($mone == 2){ ?>
		<th align="center"><font size="-1">IMPORTE Bs.</th>
        <?php   }?>
		</tr>		

<?php 
  //Datos del cart_det_tran	
 $borr_cob  = "Delete From temp_ctable3 "; 
    $cob_borr = mysql_query($borr_cob); 
  	$nro = 0;
	$t_int = 0;
	$t_iven = 0;
	$t_aho = 0; 
	$t_otro = 0;
	$t_pen = 0;
	$t_tot  = 0;				
	$t_tot2  = 0;
	$con_tpa = "Select DISTINCT CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE
	            From cart_det_tran, cart_maestro where
	            (CART_DTRA_FECHA between '$f_des2' and '$f_has2') and 
	             CART_DTRA_TIP_TRAN = 2 and  CART_NRO_CRED = CART_DTRA_NCRE and
				 CART_COD_MON = $mone
				 and CART_DTRA_USR_BAJA is null and CART_MAE_USR_BAJA is null
				 order by CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE ";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		   
		    $fec_pag = $lin_tpa['CART_DTRA_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CART_DTRA_NRO_TRAN'];
			$cod_cre = $lin_tpa['CART_DTRA_NCRE'];
	//Consulta Cart_maestro
			
			$con_car  = "Select CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,
			             CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES
			 From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			  and CLIENTE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
	                $c_grup = 0;
					$nom_ases = "";
	            //    $mon = $lin_car['CART_COD_MON'];
				//	$tcred = $lin_car['CART_TIPO_CRED'];
				//	$asesor = $lin_car['CART_OFIC_RESP'];
				//	$tip_ope = $lin_car['CART_TIPO_OPER'];
			     //   $c_grup = $lin_car['CART_COD_GRUPO'];  
					$nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);
				//	$ci_cli = $lin_car['CLIENTE_COD_ID']; 
		//$nom_ases = leer_nombre_usr($tcred,$asesor);
		//	echo $tcred,$asesor,$nom_ases;		 
			
	/*	if ($c_grup > 0){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
            $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			     // $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
				}
			  }else{	
				$nom_grp = "";	
			} */	
			} 
	/*	$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and 
		           GRAL_PAR_INT_COD = $tip_ope ";
        $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla')  ;
			 while ($lin_top = mysql_fetch_array($res_top)) {
			        $d_tipope =  $lin_top['GRAL_PAR_INT_DESC'];
			 
			    } */	
			//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
			$p_cap = 0;
			$p_int = 0;
		    $p_iven = 0;
		    $p_aho = 0; 
		    $p_otro = 0;
		    $p_pen = 0;
		    $p_tot  = 0;
			
			$con_tra = "Select CART_DTRA_CCON,CART_DTRA_IMPO, CART_DTRA_IMPO_BS
			    From cart_det_tran where CART_DTRA_NCRE = $cod_cre and 
	            CART_DTRA_FECHA = '$fec_pag' and CART_DTRA_NRO_TRAN = $nro_tran and
				CART_DTRA_TIP_TRAN = 2  and (CART_DTRA_CCON between 512 and 515)
				 and CART_DTRA_USR_BAJA is null";
            $res_tra = mysql_query($con_tra);
			while ($lin_tra = mysql_fetch_array($res_tra)) { // 2 a
			      $t_ccon = $lin_tra['CART_DTRA_CCON'];
				  $p_imp = $lin_tra['CART_DTRA_IMPO'];
				  $p_imp2 = $lin_tra['CART_DTRA_IMPO_BS'];
				 // $t_tran = $lin_tra['CART_DTRA_TIP_TRAN'];
				 // $deb_cre = $lin_tra['CART_DTRA_DEB_CRE'];
				 // $tip_cam = $lin_tra['CART_DTRA_TIP_CAM'];
				 // $caje = substr($lin_tra['CART_DTRA_USR_ALTA'],0,8);
				 // if ($t_tran == 1){ // 3a
				  //    $saldo =  $p_imp;
				//	} // 3b
			 //if ($t_tran == 2){ //4a
			  
			   //  if ($t_ccon > 130 and $t_ccon < 135){ //5a
				   
				//    $p_cap =  $p_imp;
				//	$t_cap =  $t_cap + $p_cap;
				//	} // 5b
				//  if ($t_ccon == 531){ //5a
				 //   $p_cap =  $p_imp;
				//	$t_cap =  $t_cap + $p_cap;
				//	} 
				 if ($t_ccon > 512 and $t_ccon < 516){ //6a
				 
				    $p_int =  $p_imp;
					$p_int2 = $p_imp2;
					$t_int =  $t_int + $p_int;
				 $consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta,
										  temp_cuenta,
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($t_ccon,
										   '$cod_cre',
									       '$fec_pag',
										   '$nom_cli',
										   $p_int,
										   $nro_tran,
										   0,
										   $p_int2)";
										   
    $resultado = mysql_query($consulta);	
					
					
					
					
					} //6b
				// if ($t_ccon > 514 and $t_ccon < 516){ //7a
				 //   $p_iven =  $p_imp;
				//	$t_iven =  $t_iven + $p_iven;
				//	} //7b
				// if ($t_ccon == 212){//8a
			//	 echo "dentro ".$t_ccon." - ".$t_tran." - d ".$deb_cre;
				  //   if ($deb_cre == 2){
				//	    $p_aho =  $p_imp;
					//	echo $p_aho;
					//    $t_aho =  $t_aho + $p_aho;
				//	}
				//	} //8b
				// if ($t_ccon == 242){ //9a
				 //   $p_otro =  round($p_imp / $tip_cam ,2);
				//	$t_otro =  $t_otro + $p_otro;
				//	}	//9b
			//	} // 4b	
			//	$p_tot  = $p_cap + $p_int + $p_iven + $p_aho + $p_otro;	
           	
			} // 2b	
		//	$t_tot = $t_tot + $p_int;
			}
//Desembolsos

$con_tpa = "Select DISTINCT CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE
	            From cart_det_tran, cart_maestro where
	            (CART_DTRA_FECHA between '$f_des2' and '$f_has2') and 
	             CART_DTRA_TIP_TRAN = 1 and  CART_NRO_CRED = CART_DTRA_NCRE and
				 CART_COD_MON = $mone  and (CART_DTRA_CCON between 512 and 519)
				 and CART_DTRA_USR_BAJA is null and CART_MAE_USR_BAJA is null
				 order by CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE ";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { 
		    // 1a
			$nro_tran = 0;
		    $fec_pag = $lin_tpa['CART_DTRA_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CART_DTRA_NRO_TRAN'];
			$cod_cre = $lin_tpa['CART_DTRA_NCRE'];
			$nom_grp = "";
	//Consulta Cart_maestro
			
			$con_car  = "Select CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES
			  From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			  and CLIENTE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			       // $mon = $lin_car['CART_COD_MON'];
			       // $c_grup = $lin_car['CART_COD_GRUPO']; 
				//	$tcred = $lin_car['CART_TIPO_CRED'];
				//	$asesor = $lin_car['CART_OFIC_RESP'];
				//	$tip_ope = $lin_car['CART_TIPO_OPER'];
                    $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);  
					//$ci_cli = $lin_car['CLIENTE_COD_ID']; 
			
		//	$nom_ases = leer_nombre_usr($tcred,$asesor);
		//	$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tip_ope ";
         //   $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla')  ;
		//	 while ($lin_top = mysql_fetch_array($res_top)) {
		//	        $d_tipope =  $lin_top['GRAL_PAR_INT_DESC'];
			 
		//	    }
		//if ($c_grup <> ""){			
		//	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
         //   $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	      //  while ($lin_grp = mysql_fetch_array($res_grp)) {
	       //       $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
	//		      $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
			//	}	
			//}	
		}	
			
		//echo $f_des2.encadenar(2).$f_has2.encadenar(2).$nro_tran.encadenar(2).$cod_cre;	
			$p_cap = 0;
			$p_int = 0;
		    $p_iven = 0;
		    $p_aho = 0; 
		    $p_otro = 0;
		    $p_pen = 0;
			$p_com = 0;
		    $p_tot  = 0;
			$t_com = 0;
			$con_tra = "Select CART_DTRA_CCON,CART_DTRA_IMPO,CART_DTRA_IMPO_BS
 
			From cart_det_tran where CART_DTRA_NCRE = $cod_cre and 
	            CART_DTRA_FECHA = '$fec_pag' and CART_DTRA_NRO_TRAN = $nro_tran and
				CART_DTRA_TIP_TRAN = 1 and CART_DTRA_USR_BAJA is null";
            $res_tra = mysql_query($con_tra);
			while ($lin_tra = mysql_fetch_array($res_tra)) { // 2 a
			      $t_ccon = $lin_tra['CART_DTRA_CCON'];
				  $p_imp = $lin_tra['CART_DTRA_IMPO'];
				  $p_imp2 = $lin_tra['CART_DTRA_IMPO_BS'];
				//  $t_tran = $lin_tra['CART_DTRA_TIP_TRAN'];
				//  $caje = substr($lin_tra['CART_DTRA_USR_ALTA'],0,8);
				//  echo $p_imp;
				 // if ($t_tran == 1){ // 3a
				 //     $saldo =  $p_imp;
				//	} // 3b
		//	 if ($t_tran == 1){ //4a
	//		     if ($t_ccon > 130 and $t_ccon < 135){ //5a
	//			    $p_cap =  $p_imp;
	//				$t_cap =  $t_cap + $p_cap;
	//				} // 5b
				 if ($t_ccon > 512 and $t_ccon < 520){ //6a
				    $p_int =  $p_imp;
					$p_int2 = $p_imp2;
					$t_int =  $t_int + $p_int;
					 $consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta,
										  temp_cuenta,
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($t_ccon,
										   '$cod_cre',
									       '$fec_pag',
										   '$nom_cli',
										   $p_int,
										   $nro_tran,
										   0,
										   $p_int2)";
										   
    $resultado = mysql_query($consulta);
					} //6b
			//	 if ($t_ccon > 518 and $t_ccon < 520){ //7a
			//	    $p_com =  $p_imp;
			//		$t_com =  $t_com + $p_com;
			//		} //7b
			//	 if ($t_ccon == 212){//8a
			//	    $p_aho =  $p_imp;
			//		$t_aho =  $t_aho + $p_aho;
			//		} //8b
			//	 if ($t_ccon == 242){ //9a
			//	    $p_otro =  $p_imp;
			//		$t_otro =  $t_otro + $p_otro;
			//		}	//9b
//	} // 4b	
				$p_tot  = $p_cap ;	
				
			} // 2b				
}			

    $con_tpa = "Select DISTINCT temp_des_cta From temp_ctable3 ";
    $res_tpa = mysql_query($con_tpa);
	$nro = 0;
	 while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $nro = $nro + 1;
		    $cli = $lin_tpa['temp_des_cta'];
			$con_fult  = "SELECT temp_cuenta FROM temp_ctable3 where temp_des_cta = '$cli' 
			              ORDER BY temp_cuenta   DESC LIMIT 0,1 ";
    $res_fult = mysql_query($con_fult);
	        while ($lin_fult = mysql_fetch_array($res_fult)) {
	              $fec_ult = $lin_fult['temp_cuenta'];
				  // $f_ult =cambiaf_a_normal($fec_ult);
				   	//		      $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
				}
			$con_ree = "Update temp_ctable3 set temp_fec = '$fec_ult', temp_debe_2 = $nro
			            where temp_des_cta = '$cli' ";
    $res_ree = mysql_query($con_ree);
			
	
	}
			
	$consulta  = "Select * From temp_ctable3 order by temp_fec,temp_debe_2";
    $resultado = mysql_query($consulta); 
	$cuenta1 = "";
	$cuenta2 = "";
	 $tot_1 = 0;
	 $tot_2 = 0;
	$t_impo = 0;
	$t_impo2 = 0;
	$nro = 0;
			
	while ($linea = mysql_fetch_array($resultado)) {
	
	$cuenta2 = $linea['temp_des_cta'];
	$fec_pag = $linea['temp_cuenta'];
	$f_pag = cambiaf_a_normal($fec_pag);
	$nro_tran = $linea['temp_haber_1'];		
	$cod_cre = $linea['temp_nro_cta'];		
	$nom_cli = 	$linea['temp_des_cta'];	
	$tip_tran = $linea['temp_tip_tra'];
	$impo = $linea['temp_debe_1'];
	$impo2 = $linea['temp_haber_2'];
	// Ultima fecha 
	
				
			$con_fult  = "SELECT temp_cuenta FROM temp_ctable3 where temp_des_cta = '$nom_cli' 
			              ORDER BY temp_cuenta   DESC LIMIT 0,1 ";
    $res_fult = mysql_query($con_fult);
	        while ($lin_fult = mysql_fetch_array($res_fult)) {
	              $fec_ult = $lin_fult['temp_cuenta'];
				   $f_ult =cambiaf_a_normal($fec_ult);
				   
				   
	//		      $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
	//		}	
	
	
	
	 if ($tip_tran == 513){
	     $t_tran = "Int.";
	  }
	  if ($tip_tran == 515){
	     $t_tran = "Int. Mor.";
	  }
	 if ($tip_tran == 519){
	     $t_tran = "Com.";
	  }
	$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			 and CLIENTE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			       $nom_grp = "";
			        $mon = $lin_car['CART_COD_MON'];
			        $c_grup = $lin_car['CART_COD_GRUPO']; 
					$tcred = $lin_car['CART_TIPO_CRED'];
					$asesor = $lin_car['CART_OFIC_RESP'];
					$tip_ope = $lin_car['CART_TIPO_OPER'];
					$com = $lin_car['CART_IMP_COM'];
					if($tip_tran == 519){
					   $impo = $com;
					 }  
					$t_tot = $t_tot + $impo;
					$t_tot2 = $t_tot2 + $impo2;
															//  $t_tran = "";
	
                  //  $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					//$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
			//		$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
		//			$lin_car['CLIENTE_NOMBRES'].encadenar(1);  
			        $ci_cli = $lin_car['CLIENTE_COD_ID'];   
			$nom_ases = leer_nombre_usr($tcred,$asesor);
			$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tip_ope ";
            $res_top = mysql_query($con_top);
			 while ($lin_top = mysql_fetch_array($res_top)) {
			        $d_tipope =  $lin_top['GRAL_PAR_INT_DESC'];
			 
			    }
		if ($c_grup <> ""){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
            $res_grp = mysql_query($con_grp);
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
	//		      $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
				}	
			}	
			
	
	
	
	
	if ($cuenta1 <> $cuenta2){
	  
	    $nro = $nro + 1;
		?>
	<?php   if ($cuenta1 <> ""){ ?>
	<tr></tr>   
		 <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th align="right" style="font-size:12px"><?php echo encadenar(5); ?></td> 
			  <th align="right" style="font-size:12px" ><?php echo encadenar(5); ?></td>
			   <th align="right" style="font-size:12px" ><?php echo encadenar(5); ?></td> 
		     <th align="center"><?php echo "Sub-Total"; ?></th>
		    
			 <th align="right" style="font-size:12px" ><?php echo encadenar(5); ?></td> 
			 <th align="right" style="font-size:12px" ><?php echo encadenar(5); ?></td> 
			 <th align="right" ><?php echo number_format($t_impo, 2, '.',','); ?></td>
				<?php   if ($mone == 2){ ?> 
		     <th align="right" ><?php echo number_format($t_impo2, 2, '.',','); ?></td> 
			  <?php   }?>
			
			
		   </tr>
	 <?php  
	  $t_impo = 0;
	  $t_impo2 = 0; 
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	
	 
	 }
	
	 
	  ?>   
	
	
	
	
	
	
		
	<tr>
	   <th align="right" style="font-size:12px"><?php echo number_format($nro, 0, '.',','); ?></td>  
	    <td align="left" style="font-size:10px" ><?php echo $nom_cli; ?></td>	
		<td align="left" ><?php echo $ci_cli; ?></td>	
	    <td align="center"><?php echo $f_ult; ?></td>
	    <td align="right" style="font-size:10px" ><?php echo encadenar(2); ?></td>
		<td align="right" style="font-size:10px"  ><?php echo encadenar(2); ?></td>	
		
		<td align="left" style="font-size:10px"><?php echo encadenar(2); ?></td>							
	    <td align="right" ><?php echo encadenar(2); ?></td>
	 	<td align="right" ><?php echo encadenar(2); ?></td>
		
		
		
		
	</tr>	
	
	<?php
	}	
	 $t_impo = $t_impo + $impo;
	 $t_impo2 = $t_impo2 + $impo2;				 
	?>   
	
	
	
	
	
	
		
	<tr>
	      <td align="right" style="font-size:10px" ><?php echo encadenar(2); ?></td>
	    <td align="left" style="font-size:10px" ><?php echo encadenar(2); ?></td>	
		<td align="left" ><?php echo encadenar(2); ?></td>	
	    <td align="center"style="font-size:10px"   ><?php echo $f_pag; ?></td>
	    <td align="right" style="font-size:10px" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="right" style="font-size:10px"  ><?php echo $cod_cre; ?></td>	
		<td align="left" style="font-size:10px"><?php echo $nom_grp; ?></td>							
	    <td align="left" ><?php echo $t_tran; ?></td>
	 	<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
		<?php   if ($mone == 2){ ?>
		<td align="right" ><?php echo number_format($impo2, 2, '.',','); ?></td>
        <?php   }?>
		
		
		
	</tr>	
	<?php 
	// $t_impo = 0;
	$cuenta1 = $cuenta2;
	
	?>
	<?php
	
	
	
	
	
	 } // 1b
	}
			
	?>
	<tr></tr>   
		 <tr>
		      <td align="left" style="font-size:12px"><?php echo encadenar(4); ?></td>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th align="right" style="font-size:12px"><?php echo encadenar(5); ?></td> 
			  <th align="right" style="font-size:12px" ><?php echo encadenar(5); ?></td>
			   <th align="right" style="font-size:12px" ><?php echo encadenar(5); ?></td> 
		     <th align="center"><?php echo "Sub-Total"; ?></th>
		     <th align="right" style="font-size:12px" ><?php echo encadenar(5); ?></td> 
			 <th align="right" style="font-size:12px" ><?php echo encadenar(5); ?></td> 
		     <th align="right" ><?php echo number_format($t_impo, 2, '.',','); ?></td> 
			 <?php   if ($mone == 2){ ?>
			 <th align="right" ><?php echo number_format($t_impo2, 2, '.',','); ?></td>
			 <?php   }?>
	<tr>
	   <th align="left" ><?php echo encadenar(2); ?></th>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>							
	    <th align="right" ><?php echo number_format(0, 2, '.',','); ?></th>
	 	<th align="right" ><?php echo number_format($t_tot, 2, '.',','); ?></th>
         <?php   if ($mone == 2){ ?>		
		<th align="right" ><?php echo number_format($t_tot2, 2, '.',','); ?></th>
		<?php   }?>
	</tr>	
	
	
	
	</table>		
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

