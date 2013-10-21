<?php
//ini_set('max_execution_time', 90); //240 segundos = 4 minutos
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

<?php
				include("header.php");
			?>
			
            
 <html>
<head>
<title>Resumen por Producto</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/reportes_fondo_res_prod.js"></script> 

</head>


<div id="pagina_sistema">

     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_reportes_fondo">
                    
                     <img src="img/documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> REP. FONDO GARANTIA
                    
                 </li>
                 <?php
				if($_GET["menu"]==1){?> 
                    <li id="menu_modulo_fecha">
                    
                     <img src="img/stuff_32x32.png" border="0" alt="Modulo" align="absmiddle"> RES. PRODUCTO
                    
                 </li>
              </ul>

	 <div id="contenido_modulo">
                      <h2> <img src="img/stuff_64x64.png" border="0" alt="Modulo" align="absmiddle"> RESUMEN POR PRODUCTO</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                        Reportes de Cartera
                     
                     </div>
               <?php } elseif($_GET["menu"]==2){?> 
               <li id="menu_modulo_fecha">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> RES. OFICIAL NEG.
                    
                 </li>
              </ul>

	 <div id="contenido_modulo">
                      <h2> <img src="img/user office_64x64.png" border="0" alt="Modulo" align="absmiddle"> RESUMEN POR OFICIAL DE NEGOCIOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                        Reportes de Cartera
                     
                     </div>
                     <?php }?> 
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <!--a href='cart_reportes.php'>Salir</a-->
  </div>
<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
//$cod_mon = 	$_POST['cod_mon'] ;
$fec_pro = $_POST['fec_nac'] ; 
$f_pro = cambiaf_a_mysql($fec_pro); 
//echo $fec_pro," ",$f_pro;

 ?>  
  <?php
echo encadenar(15)."Resumen de Cartera  al ".encadenar(3).$fec_pro;
?>
<br><br>
  <table border="1" width="650">
	
	<tr>
	    <th align="center">Moneda</th> 
		<th align="center">Nro. Opera.</th> 
	   	<th align="center">Imp. Aprobado</th>
		<th align="center">Vigente</th>
		<th align="center">Vencido</th>
		<th align="center">Ejecucion</th>
		<th align="center">Total</th>
		<th align="center">% Mora</th>
    </tr>	
     
 <?php  
$con_car  = "Select * From cart_maestro where CART_ESTADO < 8 
              and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
$nro_1 = 0;
$nro_2 = 0;
$mon_impo_1 = 0;
$mon_impo_2 = 0;


$mon_vig_1 = 0;
$mon_ven_1 = 0; 
$mon_eje_1 = 0;

$mon_vig_2 = 0;
$mon_ven_2 = 0; 
$mon_eje_2 = 0;

   while ($lin_car = mysql_fetch_array($res_car)) {
   	set_time_limit(0);
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $mon = $lin_car['CART_COD_MON'];
		 $est = $lin_car['CART_ESTADO'];
		 $nom_grp = "";
		 $d_est = "";
		 
		 $tot_tpa  = 0;
		 $tot_tde = 0;
		   
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	      if ($mon == 1){
	        $d_mon_1 = $linea['GRAL_PAR_INT_DESC'];
			}
		   if ($mon == 2){	
			$d_mon_2 = $linea['GRAL_PAR_INT_DESC'];
			}
	   }
  
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
		
	//Datos del cart_det_tran						
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
    $res_tpa = mysql_query($con_tpa) ;
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			//$tot_cta = $tot_cta + 1;
			}		
	if ($mon == 1){
		
		if ($est == 3){
		    $mon_vig_1 = $mon_vig_1 + ($tot_tde - $tot_tpa);
			}
		 if ($est == 6){
		    $mon_ven_1 = $mon_ven_1 + ($tot_tde - $tot_tpa);
			}
		 if ($est == 7){
		    $mon_eje_1 = $mon_eje_1 + ($tot_tde - $tot_tpa);
			}
		 if ($tot_tde > 0){
		 	$mon_impo_1 = $mon_impo_1 + $impo;
			$nro_1 = $nro_1 + 1;	
			}
	}	
	if ($mon == 2){
		
		if ($est == 3){
		    $mon_vig_2 = $mon_vig_2 + ($tot_tde - $tot_tpa);
			}
		 if ($est == 6){
		    $mon_ven_2 = $mon_ven_2 + ($tot_tde - $tot_tpa);
			}
		 if ($est == 7){
		    $mon_eje_2 = $mon_eje_2 + ($tot_tde - $tot_tpa);
			}
		  if ($tot_tde > 0){
		     $mon_impo_2 = $mon_impo_2 + $impo;	
			 $nro_2 = $nro_2 + 1;
			 }
	   }	
	}
		// if ($mon_eje_1 <> 0){
		//    $mon_eje_1 = 0;
		//	}		
			?>
	<center>
	<tr>
	    <td align="left" ><?php echo $d_mon_1; ?></td>
		<td align="right" ><?php echo number_format($nro_1, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_impo_1, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_vig_1, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_ven_1, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_eje_1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_vig_1+$mon_ven_1+$mon_eje_1, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format((($mon_ven_1 +$mon_eje_1)/
		                                           ($mon_vig_1+$mon_ven_1+$mon_eje_1))*100, 2, '.',',')
												   .encadenar(2)."%"; ?></td>
	</tr>	
	<tr>
	    <td align="left" ><?php echo $d_mon_2; ?></td>
		<td align="right" ><?php echo number_format($nro_2, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_impo_2, 2, '.',','); ?></td>
	 	<td align="right" ><?php echo number_format($mon_vig_2, 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($mon_ven_2, 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($mon_eje_2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($mon_vig_2+$mon_ven_2+$mon_eje_2, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format((($mon_ven_2 +$mon_eje_2)/
		                                           ($mon_vig_2+$mon_ven_2+$mon_eje_2))*100, 2, '.',',')
												   .encadenar(2)."%"; ?></td>
	</tr>	
	<?php
       
    ?>	  
</table>		  
<br>
<br> 
</center>
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

