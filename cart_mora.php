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
	   <a href='cred_cobros.php'>Salir</a>
  </div>

<br><br>
<?php
$f_des ="";
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$saldo = 0;
$tot_des = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
//$est1 = 3;
//$est2 = 8;
if(isset($_POST['ctot'])){  
	 $est1 = 6;
	 $est2 = 7;
      }
if(isset($_POST['cven'])){
   $est1 = 6;
   $est2 = 6;
   }  
 if(isset($_POST['ceje'])){
   $est1 = 7;
   $est2 = 7;
   }     	  
if(isset($_POST['ccas'])){
   $est1 = 8;
   $est2 = 8;
   }
  $cod_mon = 	$_POST['cod_mon'] ;
//$fec_pro = $_POST['fec_nac'] ;

if ($_SESSION['tipo'] == 2){
    $cod_ase = $_POST['cod_ase'];
	 $con_ase = "Select * From gral_usuario where GRAL_USR_CODIGO = $cod_ase and
				               GRAL_USR_USR_BAJA is null order by GRAL_USR_NOMBRES";
  $res_ase = mysql_query($con_ase);
  while ($linea = mysql_fetch_array($res_ase)) {
     $nomb_ase = $linea['GRAL_USR_NOMBRES'].encadenar(2).
			          $linea['GRAL_USR_AP_PATERNO'].encadenar(2).
			          $linea['GRAL_USR_AP_MATERNO'];
	 $log_ase = $linea['GRAL_USR_LOGIN'];				  
  
  }
   }
   
$_SESSION['msj_error']= "";
$lin_car['CLIENTE_AP_PATERNO'] = " ";

$fec_des = $_POST['fec_des'] ; 
$f_des = cambiaf_a_mysql($fec_des); 
//$fec_has = $_POST['fec_has'] ; 
//$f_has = cambiaf_a_mysql($fec_has); 
$cod_m = $_POST['cod_mon'] ; 
if ($fec_des == "") {
  $_SESSION['msj_error']= "Fecha de Calculo no puede estar en blanco";
  header('Location: cart_mora_fec.php');
   }
?> 
 <font size="+2"  style="" >

<?php
echo encadenar(45)."CARTERA EN MORA al" .encadenar(3).$fec_des;

?>
<br>
<?php if ($_SESSION['tipo'] == 2){ 
    echo encadenar(50)."ASESOR" .encadenar(3).$nomb_ase;   
    


 } ?>
</font>
<br><br>
<?php
if ($cod_m == 1){
   echo "Moneda Bolivianos";
   }
 if ($cod_m == 2){
   echo "Moneda Dolares Americanos";
   } 
   if ($_SESSION['tipo'] == 1){   
 ?>  
  <table border="1" width="1500">
	<tr>
	    <th align="center">Nro</th>  
	   	<th align="center">Nro. Operación</th> 
		<th align="center">Asesor</th>      
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Dias Mora</th>
		<th align="center">Nro. Cuota</th>
		<th align="center">Fecha Vto.</th>
		<th align="center">Monto Desem.</th>
		<th align="center">Saldo </th>
		<th align="center">Capital</th>
		<th align="center">Interes</th>
		<th align="center">Interes Vencido </th>
		<th align="center">Fond.Garan. </th>
		<th align="center">Total Cuota </th>
		<th align="center">Saldo Fdo. Gar. </th>
		<th align="center">Direccion </th>
		<th align="center">Telefonos </th>
  </tr>	
  <?php 
  }
  if ($_SESSION['tipo'] == 2){ 
   ?>  
  <table border="1" width="1500">
	<tr>
	    <th align="center">Nro</th>  
	   	<th align="center">Nro. Operación</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Dias Mora</th>
		<th align="center">Nro. Cuota</th>
		<th align="center">Fecha Vto.</th>
		<th align="center">Monto Desem.</th>
		<th align="center">Saldo </th>
		<th align="center">Capital</th>
		<th align="center">Interes</th>
		<th align="center">Interes Vencido </th>
		<th align="center">Fond.Garan. </th>
		<th align="center">Total Cuota </th>
		<th align="center">Saldo Fdo. Gar. </th>
		<th align="center">Direccion </th>
		<th align="center">Telefonos </th>
  </tr>	
  <?php 
  }
  
  
   
  if ($_SESSION['tipo'] == 1){
     $borr_tfon  = "delete from temp_mora "; 
     $borr_tfon = mysql_query($borr_tfon);
     
	 $con_car1  = "Select CART_NRO_CRED, CART_IMPORTE,CART_COD_GRUPO,CART_TASA,
	                      CART_NRO_CTAS,CART_FEC_DES,CART_OFIC_RESP,CART_TIPO_CRED                          From cart_maestro
             where (CART_ESTADO between $est1 and $est2) and
			        CART_COD_MON = $cod_m and
					CART_MAE_USR_BAJA is null"; 
$res_car1 = mysql_query($con_car1);
}
 if ($_SESSION['tipo'] == 2){
     $borr_tfon  = "delete from temp_mora "; 
     $borr_tfon = mysql_query($borr_tfon);
     
	 $con_car1  = "Select CART_NRO_CRED, CART_IMPORTE,CART_COD_GRUPO,CART_TASA,
	                      CART_NRO_CTAS,CART_FEC_DES,CART_OFIC_RESP,CART_TIPO_CRED                          From cart_maestro
             where (CART_ESTADO between $est1 and $est2) and
			        CART_COD_MON = $cod_m and
					(CART_OFIC_RESP = '$cod_ase' or CART_OFIC_RESP = '$log_ase') and
                    CART_MAE_USR_BAJA is null"; 
$res_car1 = mysql_query($con_car1);
}
   while ($lin_car1 = mysql_fetch_array($res_car1)) {
         $cod_cre = $lin_car1['CART_NRO_CRED']; 
		 $impo = $lin_car1['CART_IMPORTE'];
		// $mon = $lin_car['CART_COD_MON'];
		 $cuotas = $lin_car1['CART_NRO_CTAS'];
		 //$f_pag = $lin_car['CART_PLD_FECHA'];
		 //$capit= $lin_car['CART_PLD_CAPITAL'];
		 //$inter = $lin_car['CART_PLD_INTERES'];
		 //$ahorr = $lin_car['CART_PLD_AHORRO'];
		 //$ahod = $lin_car['CART_AHO_DUR'];
		 $f_dese = $lin_car1['CART_FEC_DES'];
		 //$f_uno = $lin_car['CART_FEC_UNO'];
		 //$c_agen = $lin_car['CART_COD_AGEN'];
		 $c_grup = $lin_car1['CART_COD_GRUPO'];
		// $estado = $lin_car['CART_ESTADO'];
		 $tasa = $lin_car1['CART_TASA'];
		 $asesor = $lin_car1['CART_OFIC_RESP'];
		 $t_cred = $lin_car1['CART_TIPO_CRED'];
		$nom_ases = leer_nombre_usr($t_cred,$asesor);                 
	$nom_grp = "-";	 
    if ($c_grup > 0){
	     $con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup 
		             and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			
			}
}
 $con_car2  = "Select CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,
                      CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES,CLIENTE_DIRECCION,CLIENTE_FONO,
					  CLIENTE_CELULAR  From cart_deudor, cliente_general
                      where CART_DEU_NCRED = $cod_cre 
                      and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			          and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null "; 
          $res_car2 = mysql_query($con_car2);
		  while ($lin_car2 = mysql_fetch_array($res_car2)) {
		         $nom_cli = $lin_car2['CLIENTE_AP_PATERNO']." ".
				      	   $lin_car2['CLIENTE_AP_MATERNO']." ".
					       $lin_car2['CLIENTE_AP_ESPOSO']." ".
					       $lin_car2['CLIENTE_NOMBRES']." ";
				 $direc =  $lin_car2['CLIENTE_DIRECCION'];
				 $fonos = $lin_car2['CLIENTE_FONO']." - ".$lin_car2['CLIENTE_CELULAR'] ;
				}
				
$saldo = 0;				
$mon_tde = 0;	
$tot_tde = 0;
$mon_tpa = 0;
$tot_tpa = 0;	
//echo $f_des." - ";		
	$con_tde = "Select CART_DTRA_IMPO From cart_det_tran where CART_DTRA_NCRE = $cod_cre 
	            and CART_DTRA_TIP_TRAN = 1 and CART_DTRA_CCON = 131
	            AND CART_DTRA_FECHA <= '$f_des' and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    
	   $mon_tde = 0;
	    $tot_tde = 0;
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			//$fec_cta = $lin_tde['CART_DTRA_FECHA'];
			$tot_tde = $tot_tde + $mon_tde;
			//$tot_cta = $tot_cta + 1;
			}		
	$con_tpa = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 
	  AND CART_DTRA_FECHA <= '$f_des' and  (CART_DTRA_CCON BETWEEN 131 AND 134) 
	  and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	     $mon_tpa = 0;
	     $tot_tpa = 0;
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			//$tot_cta = $tot_cta + 1;
			}
$saldo = $tot_tde - $tot_tpa;
//Saldo fondo de garantia




			
//echo $cod_cre." * ".$saldo." - ";					
	$consulta = "insert into temp_mora(TEMP_MOR_NCRE,
	                                    TEMP_MOR_CLIE,
                                        TEMP_MOR_GRUPO,
                                        TEMP_MOR_FECHA,
									    TEMP_MOR_CTAS,
									    TEMP_MOR_IMPO,
									    TEMP_MOR_SALDO,
										TEMP_MOR_DIREC,
										TEMP_MOR_FONO,
										TEMP_MOR_USR_ALTA,
										TEMP_MOR_USR_BAJA
									 ) 
									 values ($cod_cre,
									        '$nom_cli',
											'$nom_grp',
											'$f_dese',
											$cuotas,
											 $impo,
											 $saldo,
											 '$direc',
											 '$fonos',
											 '$nom_ases',
											 '$tasa')";


$resultado = mysql_query($consulta);			
				
				
				
				
				
				
 
 }
 
 $con_car  = "Select * From temp_mora order by TEMP_MOR_CLIE "; 
 $res_car = mysql_query($con_car);
 
// }

  
   while ($lin_car = mysql_fetch_array($res_car)) {
         
         $cod_cre = $lin_car['TEMP_MOR_NCRE'];
		 $con_fec  = "Select CART_PLD_FECHA, CART_PLD_CTA From cart_plandp
         where CART_PLD_NCRE = $cod_cre and
				   (CART_PLD_FECHA <= '$f_des') and
				    CART_PLD_STAT <> 'C'
  		           and  CART_PLD_USR_BAJA is null order by  CART_PLD_FECHA ASC LIMIT 0,1 "; 
         $res_fec = mysql_query($con_fec); 
		 while ($lin_fec = mysql_fetch_array($res_fec)) {
		        $fec_mor = $lin_fec['CART_PLD_FECHA'];
				$cta_mor = $lin_fec['CART_PLD_CTA'];
		 
		 }
		 if (isset($fec_mor)){
		 $act_tfon  = "update temp_mora set TEMP_MOR_FEC_CTA = '$fec_mor',
		               TEMP_MOR_CTMOR = $cta_mor
		               where TEMP_MOR_NCRE = $cod_cre"; 
         $res_tfon = mysql_query($act_tfon);
		 }
		 
	}	 	
/*   
*/

//cALCULO FINAL DE LA MORA

$nro = 0;
    $mon_deu = 0;
	$mon_pag = 0;
	$mon_cap = 0;
	$mon_int = 0;
	$mon_pcap = 0;
	$mon_pint = 0;
	$mon_apag = 0;
	$nro_dias = 0;
    $tot_saldo = 0;
	$tot_impo = 0;
	$tot_cta = 0;
$con_temp  = "Select * From temp_mora order by TEMP_MOR_CLIE "; 
 $res_temp = mysql_query($con_temp);
 
// }

  
   while ($lin_temp = mysql_fetch_array($res_temp)) {
          $fec_mor = $lin_temp['TEMP_MOR_FEC_CTA']; 
          $cod_cre = $lin_temp['TEMP_MOR_NCRE'];
		  $grupo = $lin_temp['TEMP_MOR_GRUPO'];
		  $nom_cli = $lin_temp['TEMP_MOR_CLIE'];
		  $cuota =  $lin_temp['TEMP_MOR_CTAS'];
		  $direc = $lin_temp['TEMP_MOR_DIREC'];
		  $fonos = $lin_temp['TEMP_MOR_FONO'];
		  $ases = $lin_temp['TEMP_MOR_USR_ALTA'];
		  $tasa = $lin_temp['TEMP_MOR_USR_BAJA'];
		  $tot_saldo = $tot_saldo  + $lin_temp['TEMP_MOR_SALDO'];
		  $tot_impo = $tot_impo  + $lin_temp['TEMP_MOR_IMPO'];
	      $f_pag = $fec_des;
		$f_pag2 = cambiaf_a_mysql_2($f_pag);
	//deuda a la fecha de calculo
	 $mon_cint_2 = 0;
	$mon_deu = 	monto_deuda_t($cod_cre ,$f_pag);
	$mon_deu_f = 	monto_deuda_tf($cod_cre ,$f_pag);
	//capital a la fecha de calculo
	$mon_cap = monto_deuda_c($cod_cre ,$f_pag);
	$mon_int = monto_deuda_i($cod_cre ,$f_pag);
	//pagos a la fecha
	$mon_pcap = montos_recuperados($cod_cre ,$f_pag,1);
	$mon_pint = montos_recuperados($cod_cre ,$f_pag,5);
	$mon_paho = montos_recuperados($cod_cre ,$f_pag,2);
	$tmon_pag = $mon_pcap + $mon_pint ;
	//monto a pagar
	$mon_apag = $mon_deu_f - $tmon_pag;
	
	$mon_cap_2 = monto_deuda_c($cod_cre,$f_des);
	$mon_pcap_2 = montos_recuperados($cod_cre,$fec_des,1);
	
	$mon_int_2 = monto_deuda_i($cod_cre,$f_des);
	$mon_pint_2 = montos_recuperados($cod_cre,$fec_des,5);
	 $mon_cint_2 = montos_condonados($cod_cre,$fec_des,5);	
	
	//echo $mon_cap_2,$mon_pcap_2;
	
	
	$cap = $mon_cap_2 - $mon_pcap;
	$int = $mon_int_2 - $mon_pint_2 - $mon_cint_2;
	
	$mon_aho_c = monto_aho_cuotas($cod_cre,$fec_mor,$f_des);
	if (($cap + $int) > 0){
	            $fec_dos = cambiaf_a_normal($fec_mor);
				$fec_uno  = $f_pag;
				//echo $fec_dos ."-".$fec_uno;
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
		 
  $int_mor = ($cap * $tasa * $nro_dias)/36000;		 
$tot_cta = $cap + $int + $int_mor + $mon_aho_c;	
//Fondo de Garantia
$sal_fon = 0;
$depos = 0;
$ret = 0;
$cta = 0;
$con_fon  = "Select * From fond_maestro where FOND_NRO_CRED = $cod_cre and FOND_MAE_USR_BAJA is null"; 
       $res_fon = mysql_query($con_fon);
       while ($lin_fon = mysql_fetch_array($res_fon)) {
             $cod_cre2 = $lin_fon['FOND_NRO_CRED']; 
		     $cta = $lin_fon['FOND_NRO_CTA'];
			 $_SESSION['cta_fon'] = $cta;
		     $tot_tre = 0;
		     $tot_tde = 0;
		 
       $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                    FOND_DTRA_TIP_TRAN = 1 and FOND_DTRA_CCON = 212 and FOND_DTRA_USR_BAJA is null";
       $res_dtra = mysql_query($con_dtra);
	   while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	         $depos = $lin_dtra['sum(FOND_DTRA_IMPO)'];
		     }
       $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                     FOND_DTRA_TIP_TRAN = 2 and FOND_DTRA_CCON = 212 and FOND_DTRA_USR_BAJA is null";
       $res_dtra = mysql_query($con_dtra);
	   while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	         $ret = $lin_dtra['sum(FOND_DTRA_IMPO)'];
		     }		  
  	   
      $sal_fon = $depos - $ret;
}









if ($cap + $int > 0){ 
 $act_tfon  = "update temp_mora set TEMP_MOR_DIAS = $nro_dias
		               
		               where TEMP_MOR_NCRE = $cod_cre"; 
         $res_tfon = mysql_query($act_tfon);
}else{
 $act_tfon  = "delete temp_mora  where TEMP_MOR_NCRE = $cod_cre"; 
         $res_tfon = mysql_query($act_tfon);
}
if ($tot_cta > 0 ){	
	$nro = $nro + 1;			
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left"  style="font-size:12px" ><?php echo $cod_cre; ?></td>
		 <?php if ($_SESSION['tipo'] == 1){  ?>  
		 		<td align="left" style="font-size:12px" ><?php echo $ases; ?></td>
         <?php } ?>
		<td align="left" style="font-size:10px" ><?php echo $nom_cli; ?></td>
		<td align="left" style="font-size:10px" ><?php echo $grupo; ?></td>
		<td align="center" style="font-size:10px"><?php echo number_format($nro_dias, 0, '.',','); ?></td>
		<td align="center" ><?php echo $cuota; ?></td>
		<td align="center" ><?php echo $fec_dos; ?></td>
		<td align="right" ><?php echo number_format($lin_temp['TEMP_MOR_IMPO'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($lin_temp['TEMP_MOR_SALDO'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($cap, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($int , 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format( $int_mor , 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_aho_c, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_cta, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($sal_fon, 2, '.',','); ?></td>
		<td align="left" style="font-size:12px" ><?php echo $direc; ?></td>
		<td align="left" style="font-size:12px"  ><?php echo $fonos; ?></td>
	</tr>	
	<?php
	}
	}
       }
	   
    ?>
	<tr>
	    <td align="right" ><?php echo encadenar(2); ?></td>
		 <?php if ($_SESSION['tipo'] == 1){  ?> 
		  <td align="right" ><?php echo encadenar(2); ?></td>
		   <?php } ?>
	 	<td align="left" ><?php echo encadenar(2); ?></td>
	    <td align="left" ><?php echo encadenar(2)."Total"; ?></td>
       	<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="left" ><?php echo encadenar(2); ?></td>
		<td align="right" ><?php echo number_format($tot_impo, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_saldo, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',',');; ?></td>
		<td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
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

