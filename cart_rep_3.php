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
<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$t_nro = 0;
//$cod_mon = 	$_POST['cod_mon'] ;
$fec_pro = $_POST['fec_nac'] ; 
$f_pro = cambiaf_a_mysql($fec_pro); 


 ?>  
  <?php
echo encadenar(15)."Resumen de Cartera por Asesor al ".encadenar(2).$fec_pro.
encadenar(2);
?>
<br>
<?php
echo encadenar(2)."Bolivianos";
?>
<br>
  <table border="1" width="650">
	
	<tr>
	    <th align="center">Asesor</th> 
		<th align="center">Nro. Opera.</th> 
	   	<th align="center">Imp. Aprobado</th>
		<th align="center">Vigente</th>
		<th align="center">Vencido</th>
		<th align="center">Ejecucion</th>
		<th align="center">Total</th>
		<th align="center">% Mora</th>
    </tr>	
     
 <?php  
$con_car  = "Select * From cart_maestro where CART_ESTADO < 8 and CART_COD_MON = 1
             and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);

$d_mon_1 = "";
$d_mon_2 = "";
$d_mon_3 = "";
$nro_1 = 0;
$nro_2 = 0;
$nro_3 = 0;
$mon_impo_1 = 0;
$mon_vig_1 = 0;
$mon_ven_1 = 0; 
$mon_eje_1 = 0;

$tot_tpa  = 0;
$tot_tde = 0;
$borr_cob  = "Delete From temp_ctable "; 
$cob_borr = mysql_query($borr_cob);
  while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $mon = $lin_car['CART_COD_MON'];
		 $est = $lin_car['CART_ESTADO'];
		 $tope = $lin_car['CART_TIPO_OPER'];
		 $tcre = $lin_car['CART_TIPO_CRED'];
		 $ases = $lin_car['CART_OFIC_RESP'];
		 $nom_grp = "";
		 $d_est = "";
		 $tot_tpa  = 0;
         $tot_tde = 0;
		 $nom_of  = leer_nombre_usr($tcre,$ases);
 
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
		
	//Datos del cart_det_tran						
	$con_tde = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	            AND CART_DTRA_FECHA <= '$f_pro' and CART_DTRA_CCON = 131 
				and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			//$tot_cta = $tot_cta + 1;
			}		
	$con_tpa = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 
	  AND CART_DTRA_FECHA <= '$f_pro' and  (CART_DTRA_CCON BETWEEN 131 AND 134) 
	  and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			//$tot_cta = $tot_cta + 1;
			}
	if ($est == 3){
		    $mon_vig_1 = ($tot_tde - $tot_tpa);
			$mon_ven_1 = 0;
			$mon_eje_1 = 0;
			}
		 if ($est == 6){
		    $mon_ven_1 = ($tot_tde - $tot_tpa);
			$mon_vig_1 = 0;
			$mon_eje_1 = 0;
			}
		 if ($est == 7){
		    $mon_eje_1 = ($tot_tde - $tot_tpa);
			$mon_vig_1 = 0;
			$mon_ven_1 = 0;
			}
		 if ($tot_tde > 0){
		 	$mon_impo_1 = $impo;
			//$nro_1 = $nro_1 + 1;	
			}		
			
			
	 $consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($mon,
										   $cod_cre,
									       '$nom_of',
										   $mon_vig_1,
										   $mon_ven_1,
										   $mon_eje_1,
										   $mon_impo_1)";
										   
    $resultado = mysql_query($consulta);		
	
}
$mon_impo_1 = 0;
$mon_vig_1 = 0;
$mon_ven_1 = 0; 
$mon_eje_1 = 0;

$consulta  = "Select count(*),temp_des_cta,sum(temp_debe_1),sum(temp_haber_1),
       sum(temp_debe_2), sum(temp_haber_2) From temp_ctable where temp_tip_tra = 1
              group by temp_des_cta";
    $resultado = mysql_query($consulta);

 while ($linea = mysql_fetch_array($resultado)) {
 $nro = $linea['count(*)'];
 $mon_impo_1 = $mon_impo_1+ $linea['sum(temp_haber_2)'];
$mon_vig_1 = $mon_vig_1+$linea['sum(temp_debe_1)'];
$mon_ven_1 = $mon_ven_1+$linea['sum(temp_haber_1)']; 
$mon_eje_1 = $mon_eje_1+$linea['sum(temp_debe_2)'];
$t_nro = $t_nro + $nro;
 	?>
		<tr>
	    <td align="left" ><?php echo $linea['temp_des_cta']; ?></td>
		<td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($linea['sum(temp_haber_2)'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($linea['sum(temp_debe_1)'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($linea['sum(temp_haber_1)'], 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($linea['sum(temp_debe_2)'], 2, '.',','); ?></td>
	    
       
		<td align="right" ><?php echo number_format($linea['sum(temp_debe_1)']+
		                                            $linea['sum(temp_haber_1)']+
													$linea['sum(temp_debe_2)'], 2, '.',','); ?></td>
													
		<td align="right" ><?php echo number_format((($linea['sum(temp_haber_1)'] +$linea['sum(temp_debe_2)'])/
		                                           ($linea['sum(temp_debe_1)']+
												    $linea['sum(temp_haber_1)']+
													$linea['sum(temp_debe_2)']))*100, 2, '.',',')
												   .encadenar(2)."%"; ?></td>											
	</tr>	
	<?php
 }	
 ?>
		<tr>
	    <th align="center" ><?php echo "Total"; ?></td>
		<th align="right" ><?php echo number_format($t_nro, 0, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_impo_1, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($mon_vig_1, 2, '.',','); ?></td>
	    <th align="right" ><?php echo number_format($mon_ven_1, 2, '.',','); ?></td>
       	<th align="right" ><?php echo number_format($mon_eje_1, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_vig_1+$mon_ven_1+$mon_eje_1,
										            2, '.',','); ?></td>
		<th align="right" ><?php echo number_format((($mon_ven_1 +$mon_eje_1)/
		                                           ($mon_vig_1+$mon_ven_1+$mon_eje_1))*100, 2, '.',',')
												   .encadenar(2)."%"; ?></td>	
 </table>	 												
<br><br>
 <?php
   
echo encadenar(15)."Resumen de Cartera por Asesor al ".encadenar(2).$fec_pro.
encadenar(2);
?>
<br>
<?php
echo encadenar(2)."Dolares";
?>
<br>
  <table border="1" width="650">
	
	<tr>
	    <th align="center">Asesor</th> 
		<th align="center">Nro. Opera.</th> 
	   	<th align="center">Imp. Aprobado</th>
		<th align="center">Vigente</th>
		<th align="center">Vencido</th>
		<th align="center">Ejecucion</th>
		<th align="center">Total</th>
		<th align="center">% Mora</th>
    </tr>	
     
 <?php  
$con_car  = "Select * From cart_maestro where CART_ESTADO < 8 and CART_COD_MON = 2
             and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);

$d_mon_1 = "";
$d_mon_2 = "";
$d_mon_3 = "";
$nro_1 = 0;
$nro_2 = 0;
$nro_3 = 0;
$mon_impo_1 = 0;
$mon_vig_1 = 0;
$mon_ven_1 = 0; 
$mon_eje_1 = 0;
$t_nro = 0;
$tot_tpa  = 0;
$tot_tde = 0;
 $borr_cob  = "Delete From temp_ctable "; 
$cob_borr = mysql_query($borr_cob);
  while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $mon = $lin_car['CART_COD_MON'];
		 $est = $lin_car['CART_ESTADO'];
		 $tope = $lin_car['CART_TIPO_OPER'];
		 $tcre = $lin_car['CART_TIPO_CRED'];
		 $ases = $lin_car['CART_OFIC_RESP'];
		 $nom_grp = "";
		 $d_est = "";
		 $tot_tpa  = 0;
         $tot_tde = 0;
		 $nom_of  = leer_nombre_usr($tcre,$ases);
 
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
		
	//Datos del cart_det_tran						
	$con_tde = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	            AND CART_DTRA_FECHA <= '$f_pro' and CART_DTRA_CCON = 131 
				and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			//$tot_cta = $tot_cta + 1;
			}		
	$con_tpa = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 
	  AND CART_DTRA_FECHA <= '$f_pro' and  (CART_DTRA_CCON BETWEEN 131 AND 134) 
	  and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			//$tot_cta = $tot_cta + 1;
			}
	if ($est == 3){
		    $mon_vig_1 = ($tot_tde - $tot_tpa);
			$mon_ven_1 = 0;
			$mon_eje_1 = 0;
			}
		 if ($est == 6){
		    $mon_ven_1 = ($tot_tde - $tot_tpa);
			$mon_vig_1 = 0;
			$mon_eje_1 = 0;
			}
		 if ($est == 7){
		    $mon_eje_1 = ($tot_tde - $tot_tpa);
			$mon_vig_1 = 0;
			$mon_ven_1 = 0;
			}
		 if ($tot_tde > 0){
		 	$mon_impo_1 = $impo;
			//$nro_1 = $nro_1 + 1;	
			}		
			
			
	 $consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($mon,
										   $cod_cre,
									       '$nom_of',
										   $mon_vig_1,
										   $mon_ven_1,
										   $mon_eje_1,
										   $mon_impo_1)";
										   
    $resultado = mysql_query($consulta);		
	
}
$mon_impo_1 = 0;
$mon_vig_1 = 0;
$mon_ven_1 = 0; 
$mon_eje_1 = 0;

$consulta  = "Select count(*),temp_des_cta,sum(temp_debe_1),sum(temp_haber_1),
       sum(temp_debe_2), sum(temp_haber_2) From temp_ctable where temp_tip_tra = 2
              group by temp_des_cta";
    $resultado = mysql_query($consulta);

 while ($linea = mysql_fetch_array($resultado)) {
 $nro = $linea['count(*)'];
 $mon_impo_1 = $mon_impo_1+ $linea['sum(temp_haber_2)'];
$mon_vig_1 = $mon_vig_1+$linea['sum(temp_debe_1)'];
$mon_ven_1 = $mon_ven_1+$linea['sum(temp_haber_1)']; 
$mon_eje_1 = $mon_eje_1+$linea['sum(temp_debe_2)'];
$t_nro = $t_nro + $nro;
 	?>
		<tr>
	    <td align="left" ><?php echo $linea['temp_des_cta']; ?></td>
		<td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($linea['sum(temp_haber_2)'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($linea['sum(temp_debe_1)'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($linea['sum(temp_haber_1)'], 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($linea['sum(temp_debe_2)'], 2, '.',','); ?></td>
	    
       
		<td align="right" ><?php echo number_format($linea['sum(temp_debe_1)']+
		                                            $linea['sum(temp_haber_1)']+
													$linea['sum(temp_debe_2)'], 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format((($linea['sum(temp_haber_1)'] +$linea['sum(temp_debe_2)'])/
		                                           ($linea['sum(temp_debe_1)']+
												    $linea['sum(temp_haber_1)']+
													$linea['sum(temp_debe_2)']))*100, 2, '.',',')
												   .encadenar(2)."%"; ?></td>											
	</tr>	
	<?php
 }	
 ?>
		<tr>
	    <th align="center" ><?php echo "Total"; ?></td>
		<th align="right" ><?php echo number_format($t_nro, 0, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_impo_1, 2, '.',','); ?></td>
	 	<th align="right" ><?php echo number_format($mon_vig_1, 2, '.',','); ?></td>
	    <th align="right" ><?php echo number_format($mon_ven_1, 2, '.',','); ?></td>
       	<th align="right" ><?php echo number_format($mon_eje_1, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($mon_vig_1+$mon_ven_1+$mon_eje_1,
										            2, '.',','); ?></td>	
		<th align="right" ><?php echo number_format((($mon_ven_1 +$mon_eje_1)/
		                                           ($mon_vig_1+$mon_ven_1+$mon_eje_1))*100, 2, '.',',')
												   .encadenar(2)."%"; ?></td>											
	 												
													
 <?php
 
     
    ?>	  
</table>		  
<br>
 
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

