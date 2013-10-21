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
 $_SESSION['anio'] = 2011;
 ?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
          <?php if($_GET["menu"] == 33){?> 
	    <a href='cont_rep_op.php?accion=12'>Salir</a>
	       <?php } elseif($_GET["menu"] == 41){?>
	    <a href='cont_rep_op.php?accion=24'>Salir</a>
	     <?php }?>
  </div>

<br><br>
<?php

$fec_pro = $_POST['fec_nac'] ;
$f_pro = cambiaf_a_mysql($fec_pro);
$anio_pro = substr($fec_pro,6,4);
$tc_ctble = leer_tipo_cam_2($f_pro);
/* if (isset( $_SESSION['anio'])){
     if ($anio_pro <> $_SESSION['anio']){
        header('Location: tipo_rep_cont.php');
	 }
 } */
 
?> 
 <font size="+1"  style="" >
 	<center>
<?php
//echo $fec_pro;

echo encadenar(0)."Balance de Comprobación de Sumas y Saldos al ".encadenar(3).
$fec_pro.encadenar(3)."T.C.".encadenar(3).number_format($tc_ctble, 2, '.',',');
?>
<br>
<?php
if ($_SESSION["tipo2"] == 1){
    echo encadenar(0)."(Expresado en Bolivianos)";
}
if ($_SESSION["tipo2"] == 2){
    echo encadenar(0)."(Expresado en Bolivianos) ";
}
 ?>  
  
     
 <?php  if ($_SESSION["tipo2"] == 1){ ?>

</center><br>
<center>
	 <table border="1" width="700">
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>	
	<tr>
	    <th align="center" style="border-bottom-style:double">CUENTA</th>  
	   	<th align="center" style="border-bottom-style:double">DESCRIPCION</th>
		<th align="center" style="border-bottom-style:double">DEBE</th> 
		<th align="center" style="border-bottom-style:double">HABER</th> 
		<th align="center" style="border-bottom-style:double">SALDO DEUDOR</th>  
		 <th align="center" style="border-bottom-style:double">SALDO ACREEDOR</th>                  
    </tr>
	 <?php  } ?>
 <?php  if ($_SESSION["tipo2"] == 2){ ?>


<center><br>
	 <table border="1" width="700">
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th COLSPAN="2" align="center"><?php echo "SUMAS"; ?></th> 
		<th COLSPAN="2" align="center"><?php echo "SALDOS"; ?></th>  
	</tr>	
	<tr>
	    <th align="center" style="border-bottom-style:double">CUENTA</th>  
	   	<th align="center" style="border-bottom-style:double">DESCRIPCION</th> 
		<th align="center" style="border-bottom-style:double">DEBE</th> 
		<th align="center" style="border-bottom-style:double">HABER</th> 
		<th align="center" style="border-bottom-style:double">DEUDOR</th>  
		<th align="center" style="border-bottom-style:double">ACREEDOR</th>            
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
	  
$tot_deb = 0;
$tot_hab = 0;
$tot_deu = 0;
$tot_acr = 0;	    
//$con_cta = "Select * From contab_cuenta order by CONTA_CTA_NRO";
//$res_cta = mysql_query($con_cta)or die('No pudo seleccionarse tabla contab_trans')  ;
//if ($_POST['niv_2'] == 'S'){
$con_cta = "Select * From contab_cuenta  where CONTA_CTA_NIVEL between
            '$est1' and '$est2' order by CONTA_CTA_NRO ";
$res_cta = mysql_query($con_cta);
//}
	
	    while ($lin_cta = mysql_fetch_array($res_cta)) {
	    	set_time_limit(0);
		      $monto_d = 0;
			  $monto_h = 0;
			  $saldo = 0;
			  $tipo = "";
		      $cta = $lin_cta['CONTA_CTA_NRO'];
			  $mon = substr($cta,5,1); 
		      $niv = $lin_cta['CONTA_CTA_NIVEL'];
			  $des = $lin_cta['CONTA_CTA_DESC'];
			  
		      $nro = $nro + 1;
		if ($_SESSION['anio'] == 2011){	  //1
			  if ($niv == "1"){ //2
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
			 } //2b
			  if ($niv == "2"){ //3
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
				 } //3b 
			   if ($niv == "3"){ //4
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
				 } //4b
			  if ($niv == "4"){ //5
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
				 } //5b
			  if ($niv == "5"){ //6
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
							   and CONTA_TRS_USR_BAJA is null ";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
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
				 } //6b
			   if ($niv == "A"){ //7
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
			      
				 } //7b
				 
			}	//1b 
if ($_SESSION['anio'] == 2010){	 //8 
			  if ($niv == "1"){ //9
			      $cmay = substr($cta,0,1);
				  $tipo = substr($cta,0,1);
				//  echo "cmay ".$cmay."tipo ".$tipo;
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where substr(CONTA_TRS_CTA,1,1)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
						// echo "Mon-DEB ".$monto_d;
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where substr(CONTA_TRS_CTA,1,1)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
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
			 } //9b
			  if ($niv == "2"){ //10
			      $tipo = substr($cta,0,1);
			      $des = encadenar(2).$des;
			      $cmay = substr($cta,0,2);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010
				               where substr(CONTA_TRS_CTA,1,2)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
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
				 } // 10b
			   if ($niv == "3"){ //11
			      $tipo = substr($cta,0,1);
			      $des = encadenar(4).$des;
			      $cmay = substr($cta,0,3);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where substr(CONTA_TRS_CTA,1,3)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							  and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010
				               where substr(CONTA_TRS_CTA,1,3)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
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
				 } //11b
			  if ($niv == "4"){ //12
			      $tipo = substr($cta,0,1);
			      $des = encadenar(6).$des;
			      $cmay = substr($cta,0,5);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where substr(CONTA_TRS_CTA,1,5)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where substr(CONTA_TRS_CTA,1,5)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
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
				 } //12b
			  if ($niv == "5"){ //13
			      $tipo = substr($cta,0,1);
			      $des = encadenar(8).$des;
			      $cmay = substr($cta,0,6);
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where substr(CONTA_TRS_CTA,1,6)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where substr(CONTA_TRS_CTA,1,6)= '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null ";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
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

				 } //13b
			   if ($niv == "A"){ //14
			  // echo "aqui";
			      $tipo = substr($cta,0,1);
			      $des = encadenar(12).$des;
			      $cmay = $cta;
			      $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where CONTA_TRS_CTA = '$cmay'
                               and CONTA_TRS_DEB_CRED = 1
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null ";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_d = $lin_tran['sum(CONTA_TRS_IMPO)'];
	        			}
				  $sum_tran = "Select sum(CONTA_TRS_IMPO) From contab_t2010 
				               where CONTA_TRS_CTA = '$cmay'
                               and CONTA_TRS_DEB_CRED = 2
							   and CONTA_TRS_FEC_VAL <= '$f_pro'
							   and CONTA_TRS_USR_BAJA is null";
				  $res_tran = mysql_query($sum_tran);
				  while ($lin_tran = mysql_fetch_array($res_tran)) {
		                 $monto_h = $lin_tran['sum(CONTA_TRS_IMPO)'];
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
			      
				 } //14b
				  
			} //8b
	//	}	
    if ($saldo <> 0){
	    $saldo_d = 0;
		$saldo_a = 0;
	    if ($niv <> "1"){
		   if ($tipo == 1){
		       if ($saldo < 0){
			       $saldo_a = ($saldo * -1);
		           $saldo_d = 0;
		          }else{
				   $saldo_d = $saldo;
		           $saldo_a = 0;
				 }     				
		  } //
		   if ($tipo == 2){
		        if ($saldo < 0){
			       $saldo_d = ($saldo * -1);
		           $saldo_a = 0;
		          }else{
				   $saldo_a = $saldo;
		           $saldo_d = 0;
				 }     
		   }
		    if ($tipo == 3){
		        $saldo_a = $saldo;
		        $saldo_d = 0;
		   }
		    if ($tipo == 4){
		       if ($saldo < 0){
			       $saldo_a = ($saldo * -1);
		           $saldo_d = 0;
		          }else{
				   $saldo_d = $saldo;
		           $saldo_a = 0;
				 }     	
			}	
		    if ($tipo == 5){
			   if ($saldo < 0){
			       $saldo_d = ($saldo * -1);
		           $saldo_a = 0;
		          }else{
				   $saldo_a = $saldo;
		           $saldo_d = 0;
				 }     
		       
		   }
		   $con_ctad  = "Select CONTA_CTA_NIVEL From contab_cuenta where CONTA_CTA_NRO = $cta ";
           $res_ctad = mysql_query($con_ctad);
	       while ($lin_ctad = mysql_fetch_array($res_ctad)) {
	              $niv_cta = $lin_ctad['CONTA_CTA_NIVEL'];
            }
          if ($niv_cta == 'A'){
		   
		      $tot_deb = $tot_deb + $monto_d;
		  $tot_hab = $tot_hab + $monto_h;
		  $tot_deu = $tot_deu + $saldo_d;  
		  $tot_acr = $tot_acr + $saldo_a;   
		}
	?>
	<tr>
	    <td align="center"><?php echo $cta; ?></td>  
	   	<td align="left" style="font-size:12px"><?php echo $des; ?></td> 
		<td align="right"><?php echo number_format($monto_d, 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($monto_h , 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($saldo_d, 2, '.',','); ?></td>
		<td align="right"><?php echo number_format($saldo_a, 2, '.',','); ?></td>
	</tr>		 
	<?php
	}
	if ($niv == "1"){
	    $saldo_d = 0;
		$saldo_a = 0;
	    if ($tipo == 1){
		    $saldo_d = $saldo;
		    $saldo_a = 0;
			
		  } //
		   if ($tipo == 2){
		       $saldo_a = $saldo;
		       $saldo_d = 0;
		  }
		  if ($tipo == 3){
		      $saldo_a = $saldo;
		      $saldo_d = 0;
		  }
		  if ($tipo == 4){
			 $saldo_a = $saldo;
		     $saldo_d = 0;
		 }
		  if ($tipo == 5){
		      $saldo_d = $saldo;
		      $saldo_a = 0;
		 }	
		 if ($tipo == 6){
		      $saldo_d = $saldo;
		      $saldo_a = 0;
		 }	
		$con_ctad  = "Select CONTA_CTA_NIVEL From contab_cuenta where CONTA_CTA_NRO = $cta ";
           $res_ctad = mysql_query($con_ctad);
	       while ($lin_ctad = mysql_fetch_array($res_ctad)) {
	              $niv_cta = $lin_ctad['CONTA_CTA_NIVEL'];
            }
          if ($niv_cta == 'A'){
		   
		      $tot_deb = $tot_deb + $monto_d;
		  $tot_hab = $tot_hab + $monto_h;
		  $tot_deu = $tot_deu + $saldo_d;  
		  $tot_acr = $tot_acr + $saldo_a;   
		}
	?>
	<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
	</tr>
	<tr>
	    <th align="center"><?php echo $cta; ?></th>  
	   	<th align="left"><?php echo $des; ?></th> 
		<th align="center"><?php echo encadenar(12); ?></th>
		<th align="center"><?php echo encadenar(12); ?></th>
		<th align="right"><?php echo number_format($saldo_d, 2, '.',','); ?></td>
		<th align="right"><?php echo number_format($saldo_a, 2, '.',','); ?></td>
		
		
		
		
	</tr>	
	
	<?php
	}			 
	}
	}
	
			?>
	<tr>
	    <th align="center"><?php echo encadenar(12); ?></th>  
	   	<th align="left"><?php echo "Sumas Iguales"; ?></th> 
		<th align="right"><?php echo number_format($tot_deb, 2, '.',','); ?></td>
		<th align="right"><?php echo number_format($tot_hab, 2, '.',','); ?></td>
		<th align="right"><?php echo number_format($tot_deu, 2, '.',','); ?></td>
		<th align="right"><?php echo number_format($tot_acr, 2, '.',','); ?></td>
		
		
		
		
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

