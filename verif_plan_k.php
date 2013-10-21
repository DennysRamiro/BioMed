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
<title>Cobro enviado por Creditos</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
<body>	
	<div id="cuerpoModulo">
<?php
				include("header.php");
			?>
            
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 
</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                  Verificacion de Consistencia
            </div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<?php
//$_SESSION['form_buffer'] = $_POST;
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
 ?>  
  
  <table border="1" width="1300">
	
	<tr>
	    <th align="center">Nro</th>  
	   	<th align="center">Nro. Crédito</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Moneda</th>
		<th align="center">Monto Desem.</th>
		<th align="center">Monto Plan Pago</th>
		<th align="center">Dif Montos</th>
		<th align="center">Nro.Cuotas</th>
		<th align="center">Nro. Ctas. Plan Pago</th>
	</tr>	
     
 <?php  
$con_car  = "Select * From cart_maestro where CART_ESTADO < 8 and
             CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
$nro = 0;

   while ($lin_car = mysql_fetch_array($res_car)) {
         $impo = 0;
		 $dif = 0;
		 $numerico = $lin_car['CART_NUMERICO']; 
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $imp_c = $lin_car['CART_IMP_COM'];
		 $tint = $lin_car['CART_TASA'];
		 $mon = $lin_car['CART_COD_MON'];
		 $t_oper = $lin_car['CART_TIPO_OPER'];
		 $t_prod = $lin_car['CART_PRODUCTO'];
		 $cuotas = $lin_car['CART_NRO_CTAS'];
		 $f_pag = $lin_car['CART_FORM_PAG'];
		 $ahod = $lin_car['CART_AHO_DUR'];
		 $f_des = $lin_car['CART_FEC_DES'];
		 $f_uno = $lin_car['CART_FEC_UNO'];
		 $c_agen = $lin_car['CART_COD_AGEN'];
		 $c_grup = $lin_car['CART_COD_GRUPO'];
		 $estado = $lin_car['CART_ESTADO'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $nom_grp = "";
		 $cod_fon = 0;
		 $d_est = "";
		 $mon_plan = 0;
		 $tot_plan = 0;
		 $tot_cta = 0; 
		// $f_uno2= cambiaf_a_normal($f_uno);
		// echo $cod_sol;
   
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
   $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa);
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
				  }  
if ($c_grup > 0){				  
	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			}
		}	
	$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_oper";
      $res_top = mysql_query($con_top);
	  while ($linea = mysql_fetch_array($res_top)) {
	  $d_top = $linea['GRAL_PAR_INT_DESC'];
	  }	
	
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  }  	
	$con_fon = "Select * From fond_maestro where FOND_NRO_CRED = $cod_cre and FOND_MAE_USR_BAJA is null";
        $res_fon = mysql_query($con_fon);
	    while ($lin_fon = mysql_fetch_array($res_fon)) {
	        $cod_fon = $lin_fon['FOND_NRO_CTA'];
			$_SESSION['fondo'] = $cod_fon;
			}
	$con_plan = "Select * From cart_plandp where CART_PLD_NCRE = $cod_cre and CART_PLD_USR_BAJA is null";
        $res_plan = mysql_query($con_plan);
	    while ($lin_plan = mysql_fetch_array($res_plan)) {
	        $mon_plan = $lin_plan['CART_PLD_CAPITAL'];
			$tot_plan = $tot_plan + $mon_plan;
			$tot_cta = $tot_cta + 1;
			}		
			
	$con_cli = "Select * From cart_deudor, cliente_general where CART_DEU_NCRED = $cod_cre
	            and CLIENTE_COD_ID = CART_DEU_ID  and CART_DEU_RELACION = 'C' 
	           and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null";
        $res_cli = mysql_query($con_cli);
	    while ($lin_cli = mysql_fetch_array($res_cli)) {
	        $nom_cli = $lin_cli['CLIENTE_NOMBRES'].encadenar(2).
			           $lin_cli['CLIENTE_AP_PATERNO'].encadenar(2).
					   $lin_cli['CLIENTE_AP_MATERNO'].encadenar(2).
					   $lin_cli['CLIENTE_AP_ESPOSO'].encadenar(2);
			}	
	$nro = $nro + 1;
	$dif = round($impo-$tot_plan,2);
	
	if ($dif <> 0){	
	echo "numero".$numerico.encadenar(2);
        if ($dif > 0){
		    $monto = $dif;
			echo "mas", $monto;
		/*	 $consulta = "update cart_plandp set CART_PLD_CAPITAL =CART_PLD_CAPITAL + $monto 
                                            where CART_PLD_NCRE = $cod_cre
											  and CART_PLD_CTA = $tot_cta";
										   
    $resultado = mysql_query($consulta)or die('No pudo actualizar cart_plandp 1 : ' . mysql_error());
	
			*/
			
			} 	
	    if ($dif < 0){
		    $monto = $dif * -1;
			
			echo "menos", $monto;
		/*	$consulta = "update cart_plandp set CART_PLD_CAPITAL =CART_PLD_CAPITAL - $monto
                                            where CART_PLD_NCRE = $cod_cre
											  and CART_PLD_CTA = $tot_cta";
										   
    $resultado = mysql_query($consulta)or die('No pudo actualizar cart_plandp 1 : ' . mysql_error());
	*/
			}
			
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $cod_cre; ?></td>
	    <td align="left" ><?php echo $nom_cli; ?></td>
       	<td align="left" ><?php echo $nom_grp; ?></td>
		<td align="left" ><?php echo $d_mon; ?></td>
		<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_plan, 4, '.',','); ?></td>
		<td align="right" ><?php echo number_format($impo-$tot_plan, 4, '.',','); ?></td>
		<td align="right" ><?php echo number_format($cuotas, 0, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_cta, 0, '.',','); ?></td>
	</tr>	
	<?php
	}
       }
    ?>	  
</table>		  
<br>
 

<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Verificando Consistencia</MARQUEE></FONT></B>
</div>


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

