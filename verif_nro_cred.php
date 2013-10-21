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
		<th align="center">Monto</th>
		<th align="center">CRED. Solic.</th>
		<th align="center">Monto Pagado</th>
		<th align="center">Monto Pag. Tran.</th>
		<th align="center">Saldo </th>
  </tr>	
     
 <?php  
$con_car = "Select * From cart_maestro where (CART_FEC_DES between '2012-01-01'
            and '2012-01-31') and CART_MAE_USR_BAJA is null"; 
$res_car = mysql_query($con_car);
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		// echo $cod_cre;
		 $impo = $lin_car['CART_IMPORTE'];
		 $imp_c = $lin_car['CART_IMP_COM'];
		 $tint = $lin_car['CART_TASA'];
		 $mon = $lin_car['CART_COD_MON'];
		 $t_oper = $lin_car['CART_TIPO_OPER'];
		 $solic = $lin_car['CART_NRO_SOL'];
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
		 $tot_pag = 0;
		 $tot_tde = 0;
		 $tot_tpa = 0;
		 $mon_tpa  = 0;
		 $mon_tde = 0;
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
	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
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
        $res_fon = mysql_query($con_fon) ;
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
			
	//$con_pag = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_USR_BAJA is null";
  //  $res_pag = mysql_query($con_pag)or die('No pudo seleccionarse tabla cart_det_tran1')  ;
	//    while ($lin_pag = mysql_fetch_array($res_pag)) {
	//        $mon_pag = $lin_pag['CART_DTRA_CAP'];
	//		$tot_pag = $tot_pag + $mon_pag;
			//$tot_cta = $tot_cta + 1;
	//		}
	//Datos del cart_det_tran						
	$con_tde = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	            and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			//$tot_cta = $tot_cta + 1;
			}		
	$con_tpa = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 
	            and CART_DTRA_CCON = 131  and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa) ;
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			//$tot_cta = $tot_cta + 1;
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
	$con_sol = "Select * From cred_solicitud where CRED_SOL_CODIGO = $solic
	            and CRED_SOL_USR_BAJA is null";
        $res_sol = mysql_query($con_sol);
	    while ($lin_sol = mysql_fetch_array($res_sol)) {
		    $cre_sol = $lin_sol['CRED_SOL_NRO_CRED'];
	        $sol_sol= $lin_sol['CRED_SOL_CODIGO'];
			           
			}
if ($cre_sol <> $cod_cre){							
	$nro = $nro + 1;			
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $cod_cre; ?></td>
	    <td align="left" ><?php echo $nom_cli; ?></td>
       	<td align="left" ><?php echo $nom_grp; ?></td>
		<td align="left" ><?php echo $solic; ?></td>
		<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
		<td align="right" ><?php echo $cre_sol; ?></td>
		<td align="right" ><?php echo number_format($tot_pag, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($tot_tpa, 2, '.',','); ?></td>
		<td align="right" ><?php echo number_format($impo - $tot_pag, 2, '.',','); ?></td>
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

