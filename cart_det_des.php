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
    echo encadenar(45)."LISTADO DE DESEMBOLSOS DE CARTERA EN ".encadenar(2). "BOLIVIANOS";
  }
 if ($mone == 2){
    echo encadenar(45)."LISTADO DE DESEMBOLSOS DE CARTERA EN ".encadenar(2). "DOLARES";
  } 
?>
</font>
<br>
<font size="+1"  style="" >
<?php
echo encadenar(70)."DEL".encadenar(3).$f_des.encadenar(3)."AL".encadenar(3).$f_has;
?>
</font>
<center>
<br><br>
<font size="0"  style="" >
	 <table border="1" width="800">
	
	<tr>
	    <th align="center"><font size="-1">FECHA </th> 
	    <th align="center"><font size="-1">ASESOR</th> 
	   	<th align="center"><font size="-1">NRO. TRAN.</th>  
	   	<th align="center"><font size="-1">NRO. CREDITO</th> 
		<th align="center"><font size="-1">CLIENTE</th>
		<th align="center"><font size="-1">GRUPO</th>
		<th align="center"><font size="-1">DESEM. CAPITAL</th>
		<th align="center"><font size="-1">FOND.GARAN</th>
		<th align="center"><font size="-1">COMISION</th>
		<th align="center"><font size="-1">INTERES</th>
		<th align="center"><font size="-1">TIP.OPERA</th>
		<th align="center"><font size="-3">CAJERO</th>
	</tr>		

<?php 
  //Datos del cart_det_tran	
   // echo $f_des2.encadenar(2).$f_has2;
   	$t_cap = 0;
	$t_int = 0;
	$t_iven = 0;
	$t_aho = 0; 
	$t_otro = 0;
	$t_pen = 0;
	$t_com = 0;
	$t_tot  = 0;				
	$con_tpa = "Select DISTINCT CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE
	            From cart_det_tran, cart_maestro where
	            (CART_DTRA_FECHA between '$f_des2' and '$f_has2') and 
	             CART_DTRA_TIP_TRAN = 1 and  CART_NRO_CRED = CART_DTRA_NCRE and
				 CART_COD_MON = $mone
				 and CART_DTRA_USR_BAJA is null and CART_MAE_USR_BAJA is null
				 order by CART_DTRA_FECHA, CART_DTRA_NRO_TRAN, CART_DTRA_NCRE ";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) { // 1a
		    $fec_pag = $lin_tpa['CART_DTRA_FECHA'];
			$f_pag = cambiaf_a_normal($fec_pag);
			$nro_tran = $lin_tpa['CART_DTRA_NRO_TRAN'];
			$cod_cre = $lin_tpa['CART_DTRA_NCRE'];
			$nom_grp = "";
	//Consulta Cart_maestro
			
			$con_car  = "Select * From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $cod_cre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null"; 
             $res_car = mysql_query($con_car);
 
             while ($lin_car = mysql_fetch_array($res_car)) {
			        $mon = $lin_car['CART_COD_MON'];
			        $c_grup = $lin_car['CART_COD_GRUPO']; 
					$tcred = $lin_car['CART_TIPO_CRED'];
					$asesor = $lin_car['CART_OFIC_RESP'];
					$tip_ope = $lin_car['CART_TIPO_OPER'];
                    $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(1).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(1).
					$lin_car['CLIENTE_NOMBRES'].encadenar(1);  
			
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
			
			$con_tra = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and 
	            CART_DTRA_FECHA = '$fec_pag' and CART_DTRA_NRO_TRAN = $nro_tran and
				CART_DTRA_TIP_TRAN = 1 and CART_DTRA_USR_BAJA is null";
            $res_tra = mysql_query($con_tra)
			      $t_ccon = $lin_tra['CART_DTRA_CCON'];
				  $p_imp = $lin_tra['CART_DTRA_IMPO'];
				  $t_tran = $lin_tra['CART_DTRA_TIP_TRAN'];
				  $caje = substr($lin_tra['CART_DTRA_USR_ALTA'],0,8);
				//  echo $p_imp;
				 // if ($t_tran == 1){ // 3a
				 //     $saldo =  $p_imp;
				//	} // 3b
			 if ($t_tran == 1){ //4a
			     if ($t_ccon > 130 and $t_ccon < 135){ //5a
				    $p_cap =  $p_imp;
					$t_cap =  $t_cap + $p_cap;
					} // 5b
				 if ($t_ccon > 512 and $t_ccon < 514){ //6a
				    $p_int =  $p_imp;
					$t_int =  $t_int + $p_int;
					} //6b
				 if ($t_ccon > 518 and $t_ccon < 520){ //7a
				    $p_com =  $p_imp;
					$t_com =  $t_com + $p_com;
					} //7b
				 if ($t_ccon == 212){//8a
				    $p_aho =  $p_imp;
					$t_aho =  $t_aho + $p_aho;
					} //8b
				 if ($t_ccon == 242){ //9a
				    $p_otro =  $p_imp;
					$t_otro =  $t_otro + $p_otro;
					}	//9b
				} // 4b	
				$p_tot  = $p_cap ;	
				
			} // 2b	
			$t_tot = $t_tot + $p_tot;
		?>
	
		
	<tr>
	    <td align="left" ><?php echo $f_pag; ?></td>
	    <td align="left" style="font-size:10px"><?php echo $nom_ases; ?></td>
	   	<td align="right" ><?php echo number_format($nro_tran, 0, '.',''); ?></td>
		<td align="right" ><?php echo $cod_cre; ?></td>	
		<td align="left" style="font-size:10px" ><?php echo $nom_cli; ?></td>
		<td align="left" style="font-size:10px"><?php echo $nom_grp; ?></td>								
	    <td align="right" ><?php echo number_format($p_cap, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($p_aho, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_com, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($p_int, 2, '.',','); ?></td>
		<td align="left" style="font-size:10px" ><?php echo $d_tipope; ?></td>
		<td align="left" style="font-size:10px" ><?php echo $caje; ?></td>
		
	</tr>	
	
	<?php					 
				    	
		
	//$nro = $nro + 1;
	             
	 
				 
			//}	 
				 
	           } // 1b
		
			   			
	?>
	<tr>
	    <th align="left" ><?php echo encadenar(5); ?></th>
	    <th align="center" ><?php echo "Total"; ?></th>
	    <th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>
		<th align="left" ><?php echo encadenar(5); ?></th>						
	    <th align="right" ><?php echo number_format($t_cap, 2, '.',','); ?></th>
	 	<th align="right" ><?php echo number_format($t_aho, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_com, 2, '.',','); ?></th>
		<th align="right" ><?php echo number_format($t_int, 2, '.',','); ?></th>
	</tr>	
</table>
<br><br>
</center>		
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

