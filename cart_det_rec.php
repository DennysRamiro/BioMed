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
    echo encadenar(35)."LISTADO DE RECUPERACIONES DE CARTERA EN ".encadenar(2). "BOLIVIANOS";
  }
 if ($mone == 2){
    echo encadenar(35)."LISTADO DE RECUPERACIONES DE CARTERA EN ".encadenar(2). "DOLARES";
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
	    <th align="center"><font size="-1">FECHA TRANSAC.</font></th>
	    <th align="center"><font size="-1">ASESOR</th> 
	    <th align="center"><font size="-1">NRO. TRAN.</th> 
		 <th align="center"><font size="-1">NRO. REC.</th>
	   	<th align="center"><font size="-1">NRO. OPERACION</th> 
		<th align="center"><font size="-1">CLIENTE</th>
		<th align="center"><font size="-1">GRUPO</th>
		<th align="center"><font size="-1">AMOR. CAPITAL</th>           
	    <th align="center"><font size="-1">INTERES NORMAL</th>
		<th align="center"><font size="-1">INTERES DEVENGADO</th>
		<th align="center"><font size="-1">INTERES VENCIDO</th>
		<th align="center"><font size="-1">INTERES PENAL</th>
		<th align="center"><font size="-1">FDO. GARANTIA</th>
		<th align="center"><font size="-1">TOTAL</th>
		<th align="center"><font size="-1">TIP.OPERA</th>
		<th align="center"><font size="-1">ESTADO</th>
		<th align="center"><font size="-3">CAJERO</th>
    </tr>		

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
			
			$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
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
			
		if ($c_grup > 0){			
			$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
            $res_grp = mysql_query($con_grp);
	        while ($lin_grp = mysql_fetch_array($res_grp)) {
	              $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			     // $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1)."/".encadenar(1).$nom_grp;		
				}
			  }else{	
				$nom_grp = "";	
			}	
			}
		$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and 
		           GRAL_PAR_INT_COD = $tip_ope ";
        $res_top = mysql_query($con_top);
			 while ($lin_top = mysql_fetch_array($res_top)) {
			        $d_tipope =  $lin_top['GRAL_PAR_INT_DESC'];
			 
			    }	
		$con_est = "Select CART_CAB_EST_ANT From cart_cabecera where 
		            CART_CAB_NCRE = $cod_cre and 
	            CART_CAB_FECHA = '$fec_pag' and CART_CAB_NRO_TRAN = $nro_tran and
				CART_CAB_TIP_TRAN = 2 and CART_CAB_USR_BAJA is null";
            $res_est = mysql_query($con_est);
				 while ($lin_est = mysql_fetch_array($res_est)) {
			        $estado =  $lin_est['CART_CAB_EST_ANT'];
			        if ($estado == 3){
					    $d_est = "VIG.";
					}
					if ($estado == 6){
					    $d_est = "VEN.";
					}
					if ($estado == 7){
					    $d_est = "EJE.";
					}
					if ($estado == 8){
					    $d_est = "CAS.";
					}	 
			    }	
				
				
				
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
			while ($lin_tra = mysql_fetch_array($res_tra)) { // 2 a
			      $t_ccon = $lin_tra['CART_DTRA_CCON'];
				  $p_imp = $lin_tra['CART_DTRA_IMPO'];
				  $t_tran = $lin_tra['CART_DTRA_TIP_TRAN'];
				  $deb_cre = $lin_tra['CART_DTRA_DEB_CRE'];
				  $tip_cam = $lin_tra['CART_DTRA_TIP_CAM'];
				  $cta_con = substr($lin_tra['CART_DTRA_CTA_CBT'],3,2);
				  $caje = substr($lin_tra['CART_DTRA_USR_ALTA'],0,8);
		//		  echo $t_ccon." - ";
				  if ($t_tran == 1){ // 3a
				      $saldo =  $p_imp;
					} // 3b
			 if ($t_tran == 2){ //4a
			  
			     if ($t_ccon > 130 and $t_ccon < 135){ //5a
				   
				    $p_cap =  $p_imp;
					$t_cap =  $t_cap + $p_cap;
					} // 5b
				if ($t_ccon == 138){ //5a
				    $p_ifa =  $p_imp;
					$t_ifa =  $t_ifa + $p_ifa;
					
					}	
				  if ($t_ccon == 531){ //5a
				      if ($cta_con == '04'){
				          $p_cap =  $p_imp;
					      $t_cap =  $t_cap + $p_cap;
					  }
					  if ($cta_con == '02'){
					      $p_int =  $p_imp;
					      $t_int =  $t_int + $p_int;
					  }
					} 
				 if ($t_ccon > 512 and $t_ccon < 514){ //6a
				 
				    $p_int =  $p_imp;
					$t_int =  $t_int + $p_int;
					} //6b
				 if ($t_ccon > 514 and $t_ccon < 516){ //7a
				    $p_iven =  $p_imp;
					$t_iven =  $t_iven + $p_iven;
					} //7b
				 if ($t_ccon == 212){//8a
			//	 echo "dentro ".$t_ccon." - ".$t_tran." - d ".$deb_cre;
				     if ($deb_cre == 2){
					    $p_aho =  $p_imp;
					//	echo $p_aho;
					    $t_aho =  $t_aho + $p_aho;
					}
					} //8b
				 if ($t_ccon == 242){ //9a
				    $p_otro =  round($p_imp / $tip_cam ,2);
					$t_otro =  $t_otro + $p_otro;
					}	//9b
				} // 4b	
				$p_tot  = $p_cap + $p_int + $p_iven + $p_aho + $p_otro+$p_ifa;	
				
			} // 2b	
			$t_tot = $t_tot + $p_tot;
			
		//Recupera nro de recibo
		$nro_rec = 0;
		$con_reci = "Select * From recibo_deta where  REC_DET_NRO_CART = $nro_tran
		             and REC_NRO_CRED = $cod_cre
	                 and REC_DET_USR_BAJA is null ";
            $res_reci = mysql_query($con_reci);
	                    while ($lin_reci = mysql_fetch_array($res_reci)) {
	                          $nro_rec =  $lin_reci['REC_DET_NRO'];
	                    }	
			
			
			
		?>
	
		
	<tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
	    <td align="left" style="font-size:10px"><?php echo $nom_ases; ?></td>	
	    <td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="right" ><?php echo number_format($nro_rec, 0, '.',''); ?></td>
		<td align="right" ><?php echo $cod_cre; ?></td>	
		<td align="left" style="font-size:10px" ><?php echo $nom_cli; ?></td>	
		<td align="left" style="font-size:10px"><?php echo $nom_grp; ?></td>							
	    <td align="right" ><?php echo number_format($p_cap, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($p_int, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_ifa, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_iven, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_pen, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_aho, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_tot, 2, '.',','); ?></td>
		<td align="left" style="font-size:10px" ><?php echo $d_tipope; ?></td>
		<td align="left" style="font-size:10px" ><?php echo $d_est; ?></td>
		<td align="left" style="font-size:10px" ><?php echo $caje; ?></td>
		
	</tr>	
	
	<?php					 
	 } // 1b
	
			
	?>
	<tr>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>	
		<th align="left" ><?php echo encadenar(5); ?></th>						
	    <th align="right" ><?php echo number_format($t_cap, 2, '.',','); ?></th>
	 	<th align="right" ><?php echo number_format($t_int, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_ifa, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_iven, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_pen, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_aho, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_tot, 2, '.',','); ?></th>
		
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

