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
    require('header_2.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login'];
 
 ?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>

          <?php if($_GET["menu"] == 32){?> 
	    <a href='cont_rep_op.php?accion=2'>Salir</a>
	     <?php } elseif($_GET["menu"] == 40){?> 
	    <a href='cont_rep_op.php?accion=23'>Salir</a>
	    <?php }?>
  </div> 

<br><br>
<?php
$fec_pro = $_POST['fec_nac'] ;
$f_pro = cambiaf_a_mysql($fec_pro);
$mes = substr($f_pro,5,2);
$anio = substr($f_pro,0,4);
$tc_ctble = leer_tipo_cam_2($f_pro);
?> 
 <font size="+2"  style="" >
 	<center>
<?php
echo encadenar(0)."Estado de Resultado al ".encadenar(3).$fec_pro.encadenar(3).
  "T.C.".encadenar(3).number_format($tc_ctble, 2, '.',',').encadenar(2).$anio;
?>
<br>
<?php
$_SESSION["tipo2"] = 2;
if ($_SESSION["tipo2"] == 1){
    echo encadenar(0)."(Expresado en Bolivianos)";
}
if ($_SESSION["tipo2"] == 2){
    echo encadenar(0)."(Expresado en Bolivianos y Eqv. Dolares)";
}
 ?>  
  
     
 <?php  if ($_SESSION["tipo2"] == 1){ ?>

</center>
<center>
	 <table border="0" width="600">
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>	
	<tr>
	    <th align="center" style="border-bottom-style:double">CUENTA</th>  
	   	<th align="center" style="border-bottom-style:double">DESCRIPCION</th> 
		<th align="center" style="border-bottom-style:double">SALDO</th>           
    </tr>
	 <?php  } ?>
 <?php  if ($_SESSION["tipo2"] == 2){ ?>


<center>
	 <table border="0" width="700">
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
		<td align="center"><?php echo encadenar(5); ?></td>
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>	
	<tr>
	    <th align="center" style="border-bottom-style:double">Cuenta</th>  
	   	<th align="center" style="border-bottom-style:double">Descripci&oacuten</th> 
		<th align="center" style="border-bottom-style:double">Saldo Bs</th> 
		 <td align="center"><?php echo encadenar(5); ?></td>
		<th align="center" style="border-bottom-style:double">Saldo $us</th>          
    </tr>
	 <?php  } ?>	 
	 
	 
<?php
// Leer temp_trasp	
$mone = 0;
$d_mone = "";
$nro = 0;
$niv ="1";
$est1 = '1';
$est2 = 'A';
if(isset($_POST['niv_2'])){  
	 $est1 = '1';
	 $est2 = '2';
      }
if(isset($_POST['niv_3'])){  
	 $est1 = '1';
	 $est2 = '3';
      }
if(isset($_POST['niv_4'])){  
	 $est1 = '1';
	 $est2 = '4';
      }
if(isset($_POST['niv_5'])){  
	 $est1 = '1';
	 $est2 = '5';
      }
if(isset($_POST['niv_A'])){  
	 $est1 = 'A';
	 $est2 = 'A';
      }






$con_cta = "Select * From contab_cuenta  where CONTA_CTA_NIVEL between
            '$est1' and '$est2' order by CONTA_CTA_NRO";
$res_cta = mysql_query($con_cta);
	
	    while ($lin_cta = mysql_fetch_array($res_cta)) {
	    	set_time_limit(0);
		      $monto_d = 0;
			  $monto_h = 0;
			  $monto_d_1 = 0;
			  $monto_h_1 = 0;
			  $saldo = 0;
			  $tipo = "";
		      $cta = $lin_cta['CONTA_CTA_NRO'];
			  $mon = substr($cta,5,1); 
		      $niv = $lin_cta['CONTA_CTA_NIVEL'];
			  $des = $lin_cta['CONTA_CTA_DESC'];
			  
		      $nro = $nro + 1;
			  if ($niv == "1"){
			      $cmay = substr($cta,0,1);
				  $tipo = substr($cta,0,1);
				//  echo "cmay ".$cmay."tipo ".$tipo;
				
			   	
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,1)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
						// echo "Mon-DEB ".$monto_d;
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,1)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
	//suma mensual					
					$sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,1)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_d_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
						// echo "Mon-DEB ".$monto_d;
	        			}
				  $sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,1)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_h_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
	        			}	
				   if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 6){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_h - $monto_d;
				  }	  	
				 } 
			  if ($niv == "2"){
			      $tipo = substr($cta,0,1);
			      $des = encadenar(2).$des;
			      $cmay = substr($cta,0,2);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				//suma mensual					
					$sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_d_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
						// echo "Mon-DEB ".$monto_d;
	        			}
				  $sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_h_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
	        			}		
						
						
						
							
				 if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 6){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_h - $monto_d;
				  }	  	
				 } 
			   if ($niv == "3"){
			      $tipo = substr($cta,0,1);
			      $des = encadenar(4).$des;
			      $cmay = substr($cta,0,3);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,3)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,3)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
	//suma mensual					
					$sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,3)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_d_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
						// echo "Mon-DEB ".$monto_d;
	        			}
				  $sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,3)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_h_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
	        			}					
						
						
				 	if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 6){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_h - $monto_d;
				  }	  
				 }
			  if ($niv == "4"){
			      $tipo = substr($cta,0,1);
			      $des = encadenar(6).$des;
			      $cmay = substr($cta,0,5);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,5)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,5)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
		//suma mensual					
					$sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,5)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_d_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
						// echo "Mon-DEB ".$monto_d;
	        			}
				  $sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,5)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_h_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
	        			}				
				 if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 6){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_h - $monto_d;
				  }	  	
				 }
			  if ($niv == "5"){
			      $tipo = substr($cta,0,1);
			      $des = encadenar(8).$des;
			      $cmay = substr($cta,0,6);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,6)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,6)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				//suma mensual					
					$sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,6)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_d_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
						// echo "Mon-DEB ".$monto_d;
	        			}
				  $sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where substr(CONTA_TRS_CTA,1,6)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_h_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
	        			}		
						
				if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 6){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_h - $monto_d;
				  }	  	
				 }
			   if ($niv == "A"){
			  // echo "aqui";
			      $tipo = substr($cta,0,1);
			      $des = encadenar(12).$des;
			      $cmay = $cta;
			      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA = '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null ";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				               where CONTA_TRS_CTA = '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
			//suma mensual					
					$sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA = '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_d_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
						// echo "Mon-DEB ".$monto_d;
	        			}
				  $sum_tran_1 = "Select sum(CONTA_TRS_IMPO) From contab_trans 
				                where CONTA_TRS_CTA = '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and month(CONTA_TRS_FEC_VAL) = '$mes'
							   and year(CONTA_TRS_FEC_VAL) = '$anio'
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							    and CONTA_TRS_USR_BAJA is null";
				  $res_tran_1 = mysql_query($sum_tran_1);
				  while ($lin_tran_1 = mysql_fetch_array($res_tran_1)) {
		                 $monto_h_1 = $lin_tran_1['sum(CONTA_TRS_IMPO)'];
	        			}			
						
						
						
						
						
				if ($tipo == 1){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 6){
				      $saldo = $monto_d - $monto_h;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_h - $monto_d;
				  }	  	
				 }

    if ($saldo <> 0){
	    if ($niv <> "1"){
	?>
	<tr>
	    <td align="center"><?php echo $cta; ?></td>  
	   	<td align="left" style="font-size:12px"><?php echo $des; ?></td> 
		<td align="right"><?php echo number_format($saldo, 2, '.',','); ?></td>
		 <?php  if ($_SESSION["tipo2"] == 2){ 
		         //  if ($mon == 2){?>
		 <td align="center"><?php echo encadenar(5); ?></td>		 
		 <td align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></td> 
		<?php //} 
		        } ?>
	</tr>		 
	<?php
	}
	if ($niv == "1"){
	?>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo $cta; ?></th>  
	   	<th align="left"style="font-size:12px"><?php echo $des; ?></th> 
		<th align="right"><?php echo number_format($saldo, 2, '.',','); ?></th>
		 <?php  if ($_SESSION["tipo2"] == 2){ ?>
		 <td align="center"><?php echo encadenar(5); ?></td>		 
		 <th align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></th> 
		<?php } ?>
	
	<?php
	}			 
	}
	}
			?>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
			   
	<tr>
	    <th align="center"><?php echo encadenar(3); ?></th>  
	   	<th align="center"><?php echo "RESULTADOS" ; ?></th> 
		 <tH align="center"><?php echo "Bolivianos"; ?></tH>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
				 <th align="center"><?php echo "Dolares"; ?></th>
		<?php } ?>		
		
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Activo"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['activo'], 2, '.',','); ?></th>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
				 <th align="right"><?php echo number_format($_SESSION['activo_sus'], 2, '.',','); ?></th>
		<?php } ?>		 	
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Pasivo"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['pasivo'], 2, '.',','); ?></th>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
				 <th align="right"><?php echo number_format($_SESSION['pasivo_sus'], 2, '.',','); ?></th>
		<?php } ?>		
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Patrimonio"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['patrimonio'], 2, '.',','); ?></th>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
				 <th align="right"><?php echo number_format($_SESSION['patrimonio_sus'], 2, '.',','); ?></th>
		<?php } ?>		
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Resultado de la Gestion"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['activo'] - 
		                        ($_SESSION['pasivo'] + $_SESSION['patrimonio']), 2, '.',','); ?></th>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
				 <th align="right"><?php echo number_format($_SESSION['activo_sus'] - 
		                        ($_SESSION['pasivo_sus'] + $_SESSION['patrimonio_sus']), 2, '.',','); ?></th>
		<?php } ?>		
	</tr>
<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "PASIVO + PATRIMONIO + RES.GESTION "; ?></td> 
		<th align="right"><?php echo number_format($_SESSION['pasivo'] + $_SESSION['patrimonio']
		                        + ($_SESSION['activo']-($_SESSION['pasivo'] +
								$_SESSION['patrimonio'])), 2, '.',','); ?></td>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
		<th align="right"><?php echo number_format($_SESSION['pasivo_sus'] + $_SESSION['patrimonio_sus']
		                        + ($_SESSION['activo_sus']-($_SESSION['pasivo_sus'] +
								$_SESSION['patrimonio_sus'])), 2, '.',','); ?></td>		 
		<?php } ?>		
	</tr>
	
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
		<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Ingresos"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['ingresos'], 2, '.',','); ?></th>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
				 <th align="right"><?php echo number_format($_SESSION['ingresos_sus'], 2, '.',','); ?></th>
		<?php } ?>		
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Costos"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['costos'], 2, '.',','); ?></th>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
		         <th align="right"><?php echo number_format($_SESSION['costos_sus'], 2, '.',','); ?></th>		 
		<?php } ?>		
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left"><?php echo "Total Gastos"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['gastos'], 2, '.',','); ?></th>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
				 <th align="right"><?php echo number_format($_SESSION['gastos_sus'], 2, '.',','); ?></th>
		<?php } ?>		
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="left" style="font-size:13px"><?php echo "TOTAL INGRESOS - (TOTAL COSTOS + TOTAL EGRESOS)"; ?></th> 
		<th align="right"><?php echo number_format($_SESSION['ingresos'] - 
		                        ($_SESSION['costos'] + $_SESSION['gastos']), 2, '.',','); ?></th>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
				 <th align="right"><?php echo number_format($_SESSION['ingresos_sus'] - 
		                        ($_SESSION['costos_sus'] + $_SESSION['gastos_sus']), 2, '.',','); ?></th>
		<?php } ?>		
	</tr>
	
	
</table>
		  
<br>
</center>
</font>

<?php
		 	include("footer_in.php");
		 ?>

</div>




<?php
}
ob_end_flush();
 ?>

