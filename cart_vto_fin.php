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

<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	   <a href='menu_s.php'>Salir</a>
  </div>

<br><br>
<?php

$f_has ="";
$f_cal ="";
$t_cuo = 0;
$saldo = 0;
$tot_des = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
$est1 = 3;
$est2 = 8;
$cas = "";
$est1 = 3;
$est2 = 7;
$_SESSION['msj_error']= "";
$lin_car['CLIENTE_AP_PATERNO'] = " ";

$fec_des = $_POST['fec_des'] ; 
$f_des = cambiaf_a_mysql($fec_des); 
$mes_1 = substr($f_des,5,2);
$anio_1 = substr($f_des,0,4);
$fec_has = $_POST['fec_has'] ; 
$f_has = cambiaf_a_mysql($fec_has);
$mes_2 = substr($f_has,5,2);
$anio_2 = substr($f_has,0,4);
//echo "mes ".$mes1. "anio  ".$anio1;
$cod_m = $_POST['cod_mon'] ; 
if ($fec_has < $fec_des) {
  $_SESSION['msj_error']= "Fecha Hasta".encadenar(2).$fec_has.encadenar(2)."no puede ser menor a la fecha Desde".encadenar(2).$fec_des;
  header('Location: cart_vto_fin.php');
   }
?> 
 <font size="+2"  style="" >

<?php
echo encadenar(35)."VENCIMIENTO FINAL  ".encadenar(3). "del" .encadenar(3).$fec_des.encadenar(3). "al" .encadenar(3).$fec_has;

?>
</font>
<br><br>
<?php
if ($cod_m == 1){
   echo "Moneda Bolivianos";
   }
 if ($cod_m == 2){
   echo "Moneda Dolares Americanos";
   }   
 ?>  
  <table border="1" width="900">
	<tr>
	    <th align="center">Nro</th> 
		<th align="center">Asesor</th>   
	   	<th align="center">Nro. Operación</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Tasa</th>
		<th align="center">Estado</th>
		<th align="center">Nro. Cuota</th>
		<th align="center">Fecha Vto.</th>
		<th align="center">Monto Desem.</th>
		<th align="center">Saldo </th>
		<th align="center">Días Atraso Acum.</th>
	 </tr>	
  <?php  
    $con_car  = "Select CART_NRO_CRED,CART_IMPORTE,CART_COD_MON,CART_FEC_DES,
	             CART_FEC_UNO,CART_COD_AGEN,CART_COD_GRUPO,CART_ESTADO,
				 CART_OFIC_RESP,CART_TIPO_CRED,CART_TASA From cart_maestro
             where (CART_ESTADO between $est1 and $est2) and
			        CART_COD_MON = $cod_m and
                    CART_MAE_USR_BAJA is null "; 
$res_car = mysql_query($con_car);
$nro = 0;
$tot_cap = 0;
$tot_int = 0;
$tot_gral = 0; 
$tot_aho = 0;
  
   while ($lin_car = mysql_fetch_array($res_car)) {
         
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $mon = $lin_car['CART_COD_MON'];
		 $f_dese = $lin_car['CART_FEC_DES'];
		 $f_uno = $lin_car['CART_FEC_UNO'];
		 $c_agen = $lin_car['CART_COD_AGEN'];
		 $c_grup = $lin_car['CART_COD_GRUPO'];
		 $estado = $lin_car['CART_ESTADO'];
		 $asesor = $lin_car['CART_OFIC_RESP'];
		 $t_cred = $lin_car['CART_TIPO_CRED'];
		 $tasa = $lin_car['CART_TASA'];
		 $nom_ases = leer_nombre_usr($t_cred,$asesor);
		 $f_des2= cambiaf_a_normal($f_dese);
		 $f_vtof = vto_fin($cod_cre);
		  $f_vto= cambiaf_a_normal($f_vtof);
		  $mes_3 = substr($f_vtof,5,2);
          $anio_3 = substr($f_vtof,0,4);
		  
	if(($mes_3 >= $mes_1 && $mes_3 <= $mes_2) && ($anio_3 >= $anio_1 && $anio_3 <= $anio_2 )){  
		  
		  
	//	 
		 $nom_grp = "";
		 $cod_fon = 0;
		 $d_est = "";
		 $mon_plan = 0;
		 
		 $tot_tde = 0;
		 $tot_tpa = 0;
		 $mon_tpa  = 0;
		 $mon_tde = 0;
		 $con_plan  = "Select CART_PLD_CTA,CART_PLD_FECHA, CART_PLD_CAPITAL, 
		                      CART_PLD_INTERES,CART_PLD_AHORRO From cart_plandp
             where CART_PLD_NCRE = $cod_cre and
			       CART_PLD_FECHA = '$f_vtof' and
				   CART_PLD_USR_BAJA is null"; 
$res_plan = mysql_query($con_plan);
	 while ($lin_plan = mysql_fetch_array($res_plan)) {
	  $cuota = $lin_plan['CART_PLD_CTA'];
		 $f_pag = $lin_plan['CART_PLD_FECHA'];
		 $capit= $lin_plan['CART_PLD_CAPITAL'];
		 $inter = $lin_plan['CART_PLD_INTERES'];
		 $ahorr = $lin_plan['CART_PLD_AHORRO'];
		 $mes = substr($f_pag,5,2);
		 $anio = substr($f_pag,0,4);
	 	 $f_pag2= cambiaf_a_normal($f_pag);
		} 
		
		
		
	
		
		
		$tot_cap = $tot_cap + $capit;
		 $tot_int = $tot_int + $inter;
		 $tot_aho = $tot_aho + $ahorr;
		 $tot_gral = $tot_gral + $capit + $inter + $ahorr;
		
		
		
		
		  $con_car2  = "Select CLIENTE_AP_PATERNO,
		                       CLIENTE_AP_MATERNO,
							   CLIENTE_AP_ESPOSO,
							   CLIENTE_NOMBRES From  cart_deudor, cliente_general
                      where CART_DEU_NCRED = $cod_cre 
                      and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			          and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null "; 
          $res_car2 = mysql_query($con_car2);
		  while ($lin_car2 = mysql_fetch_array($res_car2)) {
		      if(isset($lin_car['CLIENTE_AP_PATERNO'] )){
		   $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(2);
		   }
		          $nom_cli = $lin_car2['CLIENTE_AP_PATERNO'].encadenar(2).
				      	   $lin_car2['CLIENTE_AP_MATERNO'].encadenar(2).
					       $lin_car2['CLIENTE_AP_ESPOSO'].encadenar(2).
					       $lin_car2['CLIENTE_NOMBRES'].encadenar(2);
				}		
	 /*  $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 1')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_SIGLA'];
	   }  */
   if ($c_grup > 0){
	     $con_grp = "Select CRED_GRP_NOMBRE From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			
			}
  } 
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	        $d_est = $linea['GRAL_PAR_PRO_DESC'];
	        $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	  }  	

	//Datos del cart_det_tran						
	$con_tde = "Select CART_DTRA_IMPO,CART_DTRA_FECHA From cart_det_tran where CART_DTRA_NCRE = $cod_cre 
	            and CART_DTRA_TIP_TRAN = 1 and CART_DTRA_CCON = 131
	            AND CART_DTRA_FECHA <= '$f_des' and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$fec_cta = $lin_tde['CART_DTRA_FECHA'];
			$tot_tde = $tot_tde + $mon_tde;
			
			//$tot_cta = $tot_cta + 1;
			}		
	$con_tpa = "Select CART_DTRA_IMPO From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 
	  AND CART_DTRA_FECHA <= '$f_has' and  (CART_DTRA_CCON BETWEEN 131 AND 134) 
	  and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			//$tot_cta = $tot_cta + 1;
			}		
$saldo = $saldo + (	$tot_tde - $tot_tpa);
$tot_des = $tot_des + $tot_tde;	
//Dias de atraso
$con_cta = "Select CART_CAB_FEC_TRAN, CART_CAB_NRO_CTA,CART_PLD_FECHA  From cart_cabecera, cart_plandp where
            CART_CAB_NCRE = $cod_cre and
			CART_PLD_NCRE = CART_CAB_NCRE and
			CART_PLD_CTA = CART_CAB_NRO_CTA and
	         CART_CAB_USR_BAJA is null";
    $res_cta = mysql_query($con_cta);
	 $nro_dias = 0;
	 $tot_dias = 0;
	    while ($lin_cta = mysql_fetch_array($res_cta)) {
		       
		       $nro_cta = $lin_cta['CART_CAB_NRO_CTA'];
			   $f_pag = $lin_cta['CART_CAB_FEC_TRAN'];
			   $f_cta = $lin_cta['CART_PLD_FECHA'];
			 
			    $fec_dos = cambiaf_a_normal($f_cta);
				$fec_uno = cambiaf_a_normal($f_pag);
				$ano1 = substr($fec_uno, 6,4); 
                $mes1 = substr($fec_uno, 3, 2); 
                $dia1 = substr($fec_uno, 0, 2);
                $ano2 = substr($fec_dos, 6,4); 
                $mes2 = substr($fec_dos, 3, 2); 
                $dia2 = substr($fec_dos, 0, 2);
			//	$cap = round( $cap - $c_kap,2);
			//	}
        $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp1 - $timestamp2; 
		 $nro_dias = round( ($segundos_diferencia / (60 * 60 * 24)),0);
		 if ($nro_dias > 0 ){ 
		    $tot_dias = $tot_dias + $nro_dias;
			}
			//  echo $nro_cta, $f_pag, $f_cta,$nro_dias;	
				
				
			   
			   
			   
			   
			   
		}
		
		
		
		
/*   
*/
    $mon_deu = 0;
	$mon_pag = 0;
	$mon_cap = 0;
	$mon_int = 0;
	$mon_pcap = 0;
	$mon_pint = 0;
	$mon_apag = 0;
	//deuda a la fecha de calculo
	//$mon_deu = 	monto_deuda_t($cod_cre ,$f_pag);
	//$mon_deu_f = 	monto_deuda_tf($cod_cre ,$f_pag);
	//capital a la fecha de calculo
	//$mon_cap = monto_deuda_c($cod_cre ,$f_pag);
	//$mon_int = monto_deuda_i($cod_cre ,$f_pag);
	//pagos a la fecha
	//$mon_pcap = montos_recuperados($cod_cre ,$f_pag,1);
	//$mon_pint = montos_recuperados($cod_cre ,$f_pag,5);
	//$mon_paho = montos_recuperados($cod_cre ,$f_pag,2);
	//$tmon_pag = $mon_pcap + $mon_pint ;
	//monto a pagar
	//$mon_apag = $mon_deu_f - $tmon_pag;



if ($tot_tde > 0 ){	
	$nro = $nro + 1;			
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
		<td align="left" ><?php echo $nom_ases; ?></td>
	 	<td align="left" ><?php echo $cod_cre; ?></td>
		
	    <td align="left" ><?php echo $nom_cli; ?></td>
		<?php
		if ($nom_grp <> ""){
		?>
		<td align="left" ><?php echo $nom_grp; ?></td>
		<?php
		 }else{
		?> 
		<td align="left" ><?php echo encadenar(5); ?></td>
		<?php
		 }
		?> 
	    <td align="right" ><?php echo number_format($tasa, 2, '.',','); ?></td>	
		<td align="left" ><?php echo $s_est; ?></td>
		<td align="center" ><?php echo $cuota; ?></td>
		<td align="center" ><?php echo $f_vto; ?></td>
		<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($impo - $tot_tpa, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_dias, 2, '.',','); ?></td>
		
	</tr>	
	<?php
	}
       }
	 }  
    ?>
	<tr>
	    <td align="right" ><?php echo encadenar(2); ?></td>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
	    <td align="left" ><?php echo encadenar(2)."Total"; ?></td>
       	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
		
	</tr>  
</table>		  
<br>
 
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

