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
<title>Contabilizacion Prevision</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
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
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONTAB PREVISION
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle">CONTABILIDAD PREVISION </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Ingrese la fecha 
        </div-->


<?php
 //$fec = leer_param_gral();
 $f_pro = cambiaf_a_mysql($fec); 
 $logi = $_SESSION['login']; 
?>

<font size="+1">
<div id="TableModulo2">
<form name= "form2" method="post" action= "cobro_retro_opd.php"  onSubmit= "return">
<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
//$cod_mon = 	$_POST['cod_mon'] ;
//$fec_pro = $_POST['fec_nac'] ; 



 ?>  
  <?php
echo encadenar(15)."Resumen Calificacion Cartera por Tipo de Operacion al ".
encadenar(2).$fec.encadenar(2);
?>
<br>
<?php
echo encadenar(2)."Bolivianos";
?>
<br>
  <table border="1" width="650">
	
	<tr>
	    <th align="center">Cuenta </th> 
		<th align="center">Descripcion</th> 
	   	<th align="center">Prevision Anterior</th>
		<th align="center">Prevision Actual</th>
		<th align="center">Diferencia</th>
				
    </tr>	
     
 <?php 
 $d_mon_1 = "";
$d_mon_2 = "";
$d_mon_3 = "";
$nro_1 = 0;
$nro_2 = 0;
$nro_3 = 0;
$mon_1 = 0;
$mon_2 = 0;
$mon_3 = 0;
$gestion = substr($fec,6,4);

//echo $gestion;
 $con_par  = "Delete from temp_ctable"; 
  $res_par = mysql_query($con_par);
  $con_par  = "Delete from temp_ctable2"; 
  $res_par = mysql_query($con_par);
 $res_par = mysql_query($con_par);
 $con_par  = "Select * From cart_via_cta where CART_VIA_CTA_GRP = 30"; 
 $res_par = mysql_query($con_par);
  while ($lin_par = mysql_fetch_array($res_par)) {
        $cta = $lin_par['CART_VIA_CTA_CTB'];
        $saldo = (sal_mayor($cta,$f_pro,1,$gestion)) * -1;
		 $des_cta = leer_cta_des($cta);
	//	echo $cta,$f_pro,$saldo;
		$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (0,
										   '$cta',
									       '$des_cta',
										   $saldo,
										   0,
										   0,
										   0)";
										   
    $resultado = mysql_query($consulta);
		
		
		
		
 }
 
  
$con_car  = "Select cart_cal_mon, cart_cal_top,sum(cart_cal_prev) From cart_califica
             where cart_cal_fec = '$f_pro' 
             and cart_cal_usr_baja is null group by cart_cal_mon, cart_cal_top"; 
$res_car = mysql_query($con_car);

 while ($lin_car = mysql_fetch_array($res_car)) {

		 $mon = $lin_car['cart_cal_mon'];
		
		 $tope = $lin_car['cart_cal_top'];
		
		 $prev = $lin_car['sum(cart_cal_prev)'];
		 $nom_grp = "";
		 $d_est = "";
		 $tot_tpa  = 0;
         $tot_tde = 0;
		 if ($mon == 2){
		     $prev = $prev * $_SESSION['TC_CONTAB'];
			} 
		  
		 $cta_prev = leer_cta_car(30,$tope,0,$mon);			
// echo $cta_prev,"*".$mon." ".$tope." ".$prev;
  $act_pre  = "update temp_ctable set temp_haber_1 =$prev,
                                      temp_debe_2 =  temp_haber_1 - temp_debe_1
									   where  temp_nro_cta = '$cta_prev'"; 
  $res_pre = mysql_query($act_pre);
 
		}
/*   	
	*/	
	//Datos del cart_califica					
	 		
/*	
*/
      $con_est  = "Select * From temp_ctable";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	?>
		<tr>
	    <td align="left" ><?php echo $linea['temp_nro_cta']; ?></td>
		<td align="right" ><?php echo $linea['temp_des_cta']; ?></td>
	 	<td align="right" ><?php echo number_format($linea['temp_debe_1'], 2, '.',','); ?></td>
	    <td align="right" ><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
       	<td align="right" ><?php echo number_format($linea['temp_debe_2'] , 2, '.',','); ?></td>
		
	</tr>	
	
	<?php
}
?>												
		
	</table> 												
	<br><br>
	<strong><font size="4">	
	<center>											
 <?php
 //}
 //Dolares
echo "Asiento contable Prevision al ".
encadenar(2).$fec.encadenar(2);
?>
</strong></font>
<br>

<br>
 <table width="80%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>
	<?php
	
	
 $con_est  = "Select * From temp_ctable where temp_debe_2 <> 0";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	         $cta = $linea['temp_nro_cta'];
			 $top = substr($cta,7,1);
			 $mon = substr($cta,5,1);
			 $monto = $linea['temp_debe_2'];
			 $desc = $linea['temp_des_cta'];
			 if ($linea['temp_debe_2'] > 0) {
			     $hab1 = $monto;
				 $deb1 = 0;
			     $deb = $monto;
				 $hab = 0;
			if ($mon == 2){
				     $hab2 =  $hab1 / $_SESSION['TC_CONTAB'];
					 }else{
					  $hab2 = 0;
			    }	 
			$consulta = "insert into temp_ctable2 (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (0,
										   '$cta',
									       '$desc',
										   0,
										   $hab1,
										   0,
										   $hab2)";
										   
    $resultado = mysql_query($consulta);	 
			     $cont_cta = leer_cta_car(31,$top,0,$mon);	
				$des_cta_c = leer_cta_des($cont_cta);
				 $mon = substr($cont_cta,5,1);
				 if ($mon == 2){
				     $deb2 =  $deb / $_SESSION['TC_CONTAB'];
					 }else{
					  $deb2 = 0;
					 }
				 $consulta = "insert into temp_ctable2 (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (0,
										   '$cont_cta',
									       '$des_cta_c',
										   $deb,
										   0,
										   $deb2,
										   0)";
										   
    $resultado = mysql_query($consulta);
		 
				 
			 }
			 if ($linea['temp_debe_2'] < 0) {
			     $cont_cta = leer_cta_car(32,$top,0,$mon);
				 $des_cta_c = leer_cta_des($cont_cta);
				 $hab1 = 0;
				 $deb1 = $monto * -1;
				  $deb =  0;
				 $hab = $monto * -1;	
				 if ($mon == 2){
				     $deb2 =  $deb1 / $_SESSION['TC_CONTAB'];
					 }else{
					  $deb2 = 0;
					 }
				 	 $consulta = "insert into temp_ctable2 (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (0,
										   '$cta',
									       '$desc',
										   $deb1,
										   0,
										   $deb2,
										   0)";
										   
    $resultado = mysql_query($consulta);	
	      $mon = substr($cont_cta,5,1);
				 if ($mon == 2){
				     $hab2 =  $hab / $_SESSION['TC_CONTAB'];
					 }else{
					  $hab2 = 0;
			    }	 
			 $consulta = "insert into temp_ctable2 (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (0,
										   '$cont_cta',
									       '$des_cta_c',
										   0,
										   $hab,
										   0,
										   $hab2)";
										   
    $resultado = mysql_query($consulta);	 
	}			 
	 }
	 
	$t_deb = 0;
	$t_hab = 0; 
	$t_deb2 = 0;
	$t_hab2 = 0; 
	$con_est  = "Select * From temp_ctable2 ";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) { 
	         $t_deb = $t_deb + $linea['temp_debe_1'];
	         $t_hab = $t_hab + $linea['temp_haber_1']; 
	         $t_deb2 = $t_deb2 + $linea['temp_debe_2'] ;
	         $t_hab2 = $t_hab2 + $linea['temp_haber_2'];
	 
	 
?>	      
        <tr>
		 <td align="left" ><?php echo $linea['temp_nro_cta']; ?></td> 
		 <td align="left" ><?php echo $linea['temp_des_cta']; ?></td> 
		 <td align="right" ><?php echo number_format($linea['temp_debe_1'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($linea['temp_debe_2'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		</tr>
		
 <?php }  ?>
 
  <tr>
        <th align="left" ><?php echo encadenar(2); ?></td> 
		 <td align="center" style=" font:bold" ><?php echo "Total"; ?></td> 
		 <td align="right" style=" font:bold" ><?php echo number_format($t_deb, 2, '.',','); ?></td>
		 <td align="right" style=" font:bold" ><?php echo number_format($t_hab, 2, '.',','); ?></td>
		 <td align="right" style=" font:bold" ><?php echo number_format($t_deb2, 2, '.',','); ?></td>
		 <td align="right" style=" font:bold" ><?php echo number_format($t_hab2, 2, '.',','); ?></td>
		</tr>
 </table>		  
<br>
 </center>
<input class="btn_form" type="submit" name="accion" value="Contabiliza_Prev.">
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

