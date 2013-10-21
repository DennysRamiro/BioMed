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
	    <a href='clie_reportes.php'>Salir</a>
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
$est2 = 7;
$cas = "";
if(isset($_POST['ctot'])){  
	 $est1 = 3;
	 $est2 = 7;
      }
if(isset($_POST['cvig'])){
   $est1 = 3;
   $est2 = 3;
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
$fec_pro = $_POST['fec_nac'] ; 
$f_pro = cambiaf_a_mysql($fec_pro); 
?> 
 <font size="+2"  style="" >

<?php
echo encadenar(45)."Detalle de Clientes al ".encadenar(3).$fec_pro;
?>
</font>
<br><br>
<?php
if ($cod_mon == 1){
   echo "Moneda Bolivianos";
   }
 if ($cod_mon == 2){
   echo "Moneda Dolares Americanos";
   }   
 ?>  
 
  <table border="1" width="900">
	
	<tr>
	    <th align="center">Nro</th> 
		<th align="center">Nro. Operacion</th> 
		<th align="center">Moneda</th> 
		<th align="center">Tip. Operacion</th>
		<th align="center">Grupo</th>
		<th align="center">Saldo</th>
		<th align="center">Estado</th>
		<th align="center">Fec. Desem.</th>
		<th align="center">Relacion</th>
		<th align="center">Cliente</th>           
	    <th align="center">Fec. Nacim.</th>
		<th align="center">Monto Desem.</th>
  </tr>	
     
 <?php  
$con_car  = "Select CART_NRO_CRED,CLIENTE_FCH_NAC,CART_ESTADO,CART_DEU_IMPORTE,CART_FEC_DES,
                      CART_DEU_RELACION,CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,
					   CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES,CART_COD_GRUPO,CART_COD_MON,
					   CART_TIPO_OPER
             From cart_maestro, cart_deudor, cliente_general
             where (CART_ESTADO between $est1 and $est2) and CART_DEU_NCRED = CART_NRO_CRED
           and CLIENTE_COD_ID = CART_DEU_ID and CART_COD_MON = $cod_mon and CART_DEU_IMPORTE > 0
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null and 
			 CLIENTE_USR_BAJA is null order by CART_NRO_CRED"; 
$res_car = mysql_query($con_car)or die('No pudo seleccionarse solicitud 2');
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_DEU_IMPORTE'];
		 $rela = $lin_car['CART_DEU_RELACION'];
		 $f_nac = $lin_car['CLIENTE_FCH_NAC'];
		 $f_nac2= cambiaf_a_normal($f_nac);
		 $c_grup = $lin_car['CART_COD_GRUPO'];
		 $estado = $lin_car['CART_ESTADO'];
		 $f_des = $lin_car['CART_FEC_DES'];
		 $f_des2= cambiaf_a_normal($f_des);
		 $c_mon = $lin_car['CART_COD_MON'];
		 $t_ope = $lin_car['CART_TIPO_OPER'];
		 $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(2).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(2).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(2).
					$lin_car['CLIENTE_NOMBRES'].encadenar(2);
		 $nom_grp = "";
		 $cod_fon = 0;
		 $d_est = "";
		 $nom_of = "";
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
		//  $nom_of  = leer_nombre_usr($tcred,$of_res);
   
  $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $c_mon";
      $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
	  while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	  }
 if ($c_grup > 0){
	$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			
			}
}
	  $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
      $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla');
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	  }  	
$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_ope";
      $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla')  ;
	  while ($linea = mysql_fetch_array($res_top)) {
	  $d_top = $linea['GRAL_PAR_INT_DESC'];
	  }
	//Datos del cart_det_tran						
	$con_tde = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	            AND CART_DTRA_FECHA <= '$f_pro' and CART_DTRA_CCON = 131 
			and CART_DTRA_USR_BAJA is null";
   $res_tde = mysql_query($con_tde)or die('No pudo seleccionarse tabla cart_det_tran')  ;
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			$tot_cta = $tot_cta + 1;
			}		
	$con_tpa = "Select * From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 
	  AND CART_DTRA_FECHA <= '$f_pro' and  ((CART_DTRA_CCON BETWEEN 131 AND 134) or (CART_DTRA_CCON = 531)) 
	  and CART_DTRA_USR_BAJA is null";
   $res_tpa = mysql_query($con_tpa)or die('No pudo seleccionarse tabla cart_det_tran')  ;
	
    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
       $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
		$tot_tpa = $tot_tpa + $mon_tpa;
       $tot_cta = $tot_cta + 1;
			}
//	$con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and 
//		           GRAL_PAR_INT_COD = $tip_ope ";
 //       $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla')  ;
//			 while ($lin_top = mysql_fetch_array($res_top)) {
//			        $d_tipope =  $lin_top['GRAL_PAR_INT_DESC'];
			 
//			    }		
			
// Oficial Responsable			
/*	$con_ores = "Select * From gral_usuario where GRAL_USR_CODIGO = $of_res  
	            and GRAL_USR_USR_BAJA is null";
    $res_ores= mysql_query($con_ores)or die('No pudo seleccionarse tabla gral_usuario')  ;
	    while ($lin_ofr = mysql_fetch_array($res_ores)) {
	        $nom_of = $lin_ofr['GRAL_USR_NOMBRES'];
			}				
	*/				
$saldo = ($tot_tde - $tot_tpa);
$tot_des = $tot_des + $tot_tde;	

if ($tot_tde > 0 ){	
	$nro = $nro + 1;			
			?>
	<center>
	<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
		<td align="left" ><?php echo $cod_cre; ?></td>
		 <td align="left" ><?php echo $d_mon; ?></td>
		 <td align="left" ><?php echo $d_top; ?></td>
		 
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
		 <td align="right" ><?php echo number_format($saldo, 2, '.',','); ?></td>
		 <td align="left" ><?php echo $s_est; ?></td>
		 <td align="right" ><?php echo $f_des2; ?></td>
		 <td align="left" ><?php echo $rela; ?></td>
	    <td align="left" ><?php echo $nom_cli; ?></td>
		<td align="right" ><?php echo $f_nac2; ?></td>
		<td align="right" ><?php echo number_format($impo, 2, '.',','); ?></td>
	</tr>	
	<?php
	}
       }
	   
    ?>
	
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

