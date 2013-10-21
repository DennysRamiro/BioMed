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
<!--Titulo de la pestaña de la pagina-->
<title>Calculo Prevision</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCartera.js"></script>
</head>
<body>
	<?php
				include("header.php");
			?>
<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                  <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_cartera_procesofindemes">
                    
                     <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"> PROC. FIN DE MES
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"> CALIFICACION
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle">CALIFICACION </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Ingrese la fecha 
        </div>


<?php
 //$fec = leer_param_gral();
 $f_pro = cambiaf_a_mysql_2($fec);
 $logi = $_SESSION['login'];
 $borr_tras  = "Delete From temp_trasp"; 
 $cob_tras = mysql_query($borr_tras);
 ?>

            
<font size="+1">

<div id="TableModulo2" >
<form name= "form2" method="post" action= "cobro_retro_opd.php"  onSubmit= "return">  
<?php

$f_has ="";
$f_cal ="";
$t_cuo = 0;
$saldo = 0;
$tot_des = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
$est1 = 3;
$est2 = 7;
$cas = "";

?> 
 <font size="+2"  style="" >
<?php
echo encadenar(25)."Detalle de Calculo de Prevision de Cartera al".encadenar(3).$fec;
?>
</font>
<?php
 ?>  
  
     
 <?php  
$borr_cali = "Delete from cart_califica where cart_cal_fec = '$f_pro'";
$res_car = mysql_query($borr_cali); 
 
$con_car  = "Select CART_NRO_CRED,CART_COD_MON,CART_TIPO_OPER From cart_maestro
             where (CART_ESTADO between $est1 and $est2) 
             and  CART_MAE_USR_BAJA is null 
	         order by CART_NRO_CRED"; 
$res_car = mysql_query($con_car);
$nro = 0;
$sal = 0;

   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $mon = $lin_car['CART_COD_MON'];
		 $t_oper = $lin_car['CART_TIPO_OPER'];
			 
		 $mon_prev = 0;
		 $cali = 0;
		 
		 $tot_cta = 0; 
		 $tot_pag = 0;
		 $tot_tde = 0;
		 $tot_tpa = 0;
		 $mon_tpa  = 0;
		 $mon_tde = 0;
		
	$cta_venf = cta_venf($cod_cre);
	$cta_vef= cambiaf_a_normal($cta_venf);
	//dias de mora
		$ano1 = substr($cta_venf, 0,4); 
        $mes1 = substr($cta_venf, 5, 2); 
        $dia1 = substr($cta_venf, 8, 2);
        $ano2 = substr($fec, 6,4); 
        $mes2 = substr($fec, 3, 2); 
        $dia2 = substr($fec, 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	 $dias = round($segundos_diferencia / (60 * 60 * 24),0);
	 
	?>
	
	<?php
	$con_tde = "Select CART_DTRA_IMPO From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	            AND CART_DTRA_FECHA <= '$f_pro' and CART_DTRA_CCON = 131 and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			}
					
	$con_tpa = "Select CART_DTRA_IMPO From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 AND
	            CART_DTRA_FECHA <= '$f_pro' and (CART_DTRA_CCON BETWEEN 131 AND 134) 
	            and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			
			}
			//echo $tot_tpa.encadenar(2);
		
	$esta_act = 0;		
	$cta_tipa = 0;
	$cta_act = 0;
	$esta_nue = 0;
	$cta_tipn = 0;
	$cta_nue = 0;
						
$saldo = $saldo + (	$tot_tde - $tot_tpa);
$sal = $tot_tde - $tot_tpa;
$tot_des = $tot_des + $tot_tde;	
$sal = ($tot_tde - $tot_tpa);
     if ($mon == 1){
    	if ($dias < 6){
		    $mon_prev = ($tot_tde - $tot_tpa)* 0.015;
			$cali = 1;
			}
		 if ($dias > 5){
		    if ($dias < 31){
		    $mon_prev = ($tot_tde - $tot_tpa)* 0.065;
			$cali = 2;
			  }
			}
		}	
	if ($mon == 2){
    	if ($dias < 6){
		    $mon_prev = ($tot_tde - $tot_tpa)* 0.015;
			$cali = 1;
			}
		 if ($dias > 5){
		    if ($dias < 31){
		    $mon_prev = ($tot_tde - $tot_tpa)* 0.065;
			$cali = 2;
			  }
			}
		}	
		 if ($dias > 30) {
		    if ($dias < 56){
		        $mon_prev = ($tot_tde - $tot_tpa)* 0.20;
				$cali = 3;
				}
			}
			
		 if ($dias > 55){
		     if ($dias < 76){
		 	     $mon_prev = ($tot_tde - $tot_tpa)* 0.50;
				 $cali = 4;
				 }
			 }
		 if ($dias > 75){
		     if ($dias < 91){
		 	     $mon_prev = ($tot_tde - $tot_tpa)* 0.80;
				 $cali = 5;
				 }
			 }	 
		 if ($dias > 90){
		 	$mon_prev = ($tot_tde - $tot_tpa);
			$cali = 6;
			}
   
if ($tot_tde > 0 ){	
	 $consulta = "insert into cart_califica (cart_cal_ncre, 
                                         cart_cal_saldo,
									     cart_cal_mon,
									     cart_cal_est,
										 cart_cal_cali,
									     cart_cal_fec,
										 cart_cal_fvto,
					                     cart_cal_dias,
					                     cart_cal_prev,
   				                         cart_cal_top,
					                     cart_cal_usr_alta, 
									     cart_cal_fch_hr_alta, 
									     cart_cal_usr_baja, 
									     cart_cal_fch_hr_baja
										  
                                         ) values ($cod_cre,
										           $sal,
												   $mon,
												   $esta_act,
												   $cali,
										           '$f_pro',
										           '$cta_venf', 
										            $dias,
													$mon_prev,
									                 $t_oper,
					                                '$logi', 
									                null,
													null,
													null
												     )";
$resultado = mysql_query($consulta); 
          }
       }
//	}
?>


<center>
	 <table border="1" width="900">
	
	<tr>
	    <th align="center">Moneda</th>  
	   	<th align="center">Saldo Capital</th>
		<th align="center">Prevision</th>
		
  </tr>	
<?php
// Leer temp_trasp	
$mone = 0;
$d_mone = "";
$est_act = "";
$est_nue = "";
$nro = 0;

$con_tras = "Select sum(cart_cal_saldo), sum(cart_cal_prev) From cart_califica 
             where cart_cal_fec = '$f_pro' and cart_cal_mon = 1 ";
$res_tras = mysql_query($con_tras);
	
	    while ($lin_tras = mysql_fetch_array($res_tras)) {
               $sal_1 = $lin_tras['sum(cart_cal_saldo)'];
               $prev_1 = $lin_tras['sum(cart_cal_prev)'];
        }
$con_tras = "Select sum(cart_cal_saldo), sum(cart_cal_prev) From cart_califica 
             where cart_cal_fec = '$f_pro' and cart_cal_mon = 2 ";
$res_tras = mysql_query($con_tras);
	
	    while ($lin_tras = mysql_fetch_array($res_tras)) {
               $sal_2 = $lin_tras['sum(cart_cal_saldo)'];
               $prev_2 = $lin_tras['sum(cart_cal_prev)'];
        }
?> 
<tr>
	    <th align="center"><?php echo 'BOLIVIANOS'; ?></th>           
	    <th align="right" ><?php echo number_format($sal_1, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($prev_1, 2, '.',','); ?></td>
</tr>	
<tr>
	    <th align="center"><?php echo 'DOLARES'; ?></th> 		
		<th align="right" ><?php echo number_format($sal_2, 2, '.',','); ?></td>
		<th align="right" ><?php echo number_format($prev_2, 2, '.',','); ?></td>
		
  </tr>	
</table>
		  
<br>
</select>
   <br> <br>
  <input class="btn_form" type="submit" name="accion" value="Rep_Calificacion">
  <input class="btn_form" type="submit" name="accion" value="Contab_Prevision">





<?php 
/*
$con_tras = "Select * From cart_califica 
             where cart_cal_fec = '$f_pro'
			 order by cart_cal_mon, cart_cal_cali";
$res_tras = mysql_query($con_tras)or die('No pudo seleccionarse tabla temp_trasp')  ;
	
	    while ($lin_tras = mysql_fetch_array($res_tras)) {
		
		$ncre = $lin_tras['cart_cal_ncre'];
		$con_car2  = "Select CART_NRO_CRED,CART_COD_GRUPO,CART_ESTADO,
			         CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES 
             From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $ncre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null 
	  order by CART_NRO_CRED"; 
      $res_car2 = mysql_query($con_car2)or die('No pudo seleccionarse datos credito');
		
		while ($lin_car2 = mysql_fetch_array($res_car2)) {
		      $c_grup = $lin_car2['CART_COD_GRUPO'];
		      $nom_cli = $lin_car2['CLIENTE_AP_PATERNO'].encadenar(2).
					$lin_car2['CLIENTE_AP_MATERNO'].encadenar(2).
					$lin_car2['CLIENTE_AP_ESPOSO'].encadenar(2).
					$lin_car2['CLIENTE_NOMBRES'];
			  $estado = $lin_car2['CART_ESTADO'];		
		      $nom_grp = "";
              if ($c_grup > 0 ) {
	$con_grp = "Select CRED_GRP_NOMBRE From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			
			}
}		
		
		
		
		
		}
	        $nro = $nro + 1;
			$f_vto = cambiaf_a_normal($lin_tras['cart_cal_fvto']); 
			if ($estado == 3) {
	           $est_act = "Vigente";
			   }
			if ($estado == 6) {
	           $est_act = "Vencido";
			   } 
			if ($estado == 7) {
	           $est_act = "Ejecucion";
			   }    
			  
			if ($lin_tras['cart_cal_mon'] == 1) { 
			    $d_mone = "BOLIVIANOS";
				}else{
				$d_mone = "DOLARES";
				}     
			if ($lin_tras['cart_cal_mon'] <> $mone) {
	           $mone = $lin_tras['cart_cal_mon'];
			   $nro = 1;
			   $tot = 0;	?>
			   
	<tr>
	    <th align="center"><?php echo encadenar(3); ?></th>  
	   	<th align="center"><?php echo encadenar(5); ?></th> 
		<th align="center"><?php echo 'MONEDA'; ?></th>           
	    <th align="center"><?php echo $d_mone; ?></th>
		<th align="center"><?php echo encadenar(5); ?></th>
		<?php if ($d_mone == "BOLIVIANOS") { ?> 
		<th align="right" ><?php echo number_format($sal_1, 2, '.',','); ?></td>
		<?php } else { ?> 
		<th align="right" ><?php echo number_format($sal_2, 2, '.',','); ?></td>
		<?php }  ?> 
		<th align="center"><?php echo encadenar(5); ?></th>
		<?php if ($d_mone == "BOLIVIANOS") { ?>
		<th align="right" ><?php echo number_format($prev_1, 2, '.',','); ?></td>
		<?php } else { ?>
		<th align="right" ><?php echo number_format($prev_2, 2, '.',','); ?></td>
		<?php }  ?>
		<th align="center"><?php echo encadenar(5); ?> </th>
  </tr>	
  <?php } ?> 
<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $lin_tras['cart_cal_ncre']; ?></td>
	    <td align="left" style="font-size:10px" ><?php echo $nom_cli; ?></td>
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
		<td align="center" ><?php echo $est_act; ?></td>
		<td align="right" ><?php echo number_format($lin_tras['cart_cal_saldo'], 2, '.',','); ?></td>
		<td align="center" ><?php echo $lin_tras['cart_cal_cali']; ?></td>
		<td align="right" ><?php echo number_format($lin_tras['cart_cal_prev'], 2, '.',','); ?></td>
		<?php if ($lin_tras['cart_cal_dias'] < 0) {
		          $lin_tras['cart_cal_dias'] = 0;
		 }
		?> 
		<td align="center" ><?php echo $lin_tras['cart_cal_fvto']; ?></td>
		
		<td align="center" ><?php echo $lin_tras['cart_cal_dias']; ?></td>
	</tr>	
	<?php
		} 
    ?>
	
</table>
		  
<br>
</select>
   <br> <br>
  <input type="submit" name="accion" value="Rep_Calificacion">
  <input type="submit" name="accion" value="Contab_Prevision">


<?php
		 	include("footer_in.php");
			*/
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

