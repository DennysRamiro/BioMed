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
<link href="css/estilo.css" rel="stylesheet" type="text/css">
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
                    
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"> REP CALIFICACION
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle">REP CALIFICACION </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Ingrese la fecha 
        </div>

<?php
 //$fec = leer_param_gral();
 $f_pro = cambiaf_a_mysql_2($fec);
 $logi = $_SESSION['login'];
 
 ?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='menu_s.php'>Salir</a>
  </div>

<br><br>
<?php


?> 
 <font size="+2"  style="" >
<?php
echo encadenar(45)."Detalle de Calificacion y Prevision al".encadenar(3).$fec;
?>

<?php
 ?>  
  
     
 <?php  

?>


<center>
 <table border="1" width="1000">
	
	<tr>
	    <th align="center">Nro</th>  
	   	<th align="center">Nro. Crédito</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Estado</th>
		<th align="center">Saldo Actual</th>
		<th align="center">Calificacion</th>
		<th align="center">Prevision</th>
		<th align="center">Fecha Vto. </th>
		<th align="center">Dias de Mora </th>
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


$con_tras = "Select * From cart_califica 
             where cart_cal_fec = '$f_pro'
			 order by cart_cal_mon, cart_cal_cali";
$res_tras = mysql_query($con_tras) ;
	
	    while ($lin_tras = mysql_fetch_array($res_tras)) {
		
		$ncre = $lin_tras['cart_cal_ncre'];
		$con_car2  = "Select CART_NRO_CRED,CART_COD_GRUPO,CART_ESTADO,
			         CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES 
             From cart_maestro, cart_deudor, cliente_general
             where CART_NRO_CRED = $ncre and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null 
	  order by CART_NRO_CRED"; 
      $res_car2 = mysql_query($con_car2);
		
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
        $res_grp = mysql_query($con_grp);
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
		<td align="left" style="font-size:10px" ><?php echo $nom_grp; ?></td>
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
		<td align="center" ><?php echo $lin_tras['cart_cal_fvto']; ?></td>
		<?php if ($lin_tras['cart_cal_dias'] < 0) {
		          $lin_tras['cart_cal_dias'] = 0;
		 }
		?> 
		<td align="center" ><?php echo $lin_tras['cart_cal_dias']; ?></td>
	</tr>	
	<?php
		}
    ?>
	
</table>
		  
<br>
</center>
</font>

</div>
<?php
		 	include("footer_in.php");
		 ?>
</body>
</html>


<?php
}
ob_end_flush();
 ?>

