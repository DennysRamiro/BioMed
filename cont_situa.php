<?php
	  ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
    //require('header_2.php');
?>
<html>
<head>
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login'];
 include("header_2.php");
 ?>
 <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
       <?php if($_GET["menu"] == 30){?> 
	    <a href='cont_rep_op.php?accion=1'>Salir</a>
	   <?php } elseif($_GET["menu"] == 31){?> 
	    <a href='cont_rep_op.php?accion=11'>Salir</a>
	    <?php } elseif($_GET["menu"] == 38){?> 
	    <a href='cont_rep_op.php?accion=21'>Salir</a>
	    <?php } elseif($_GET["menu"] == 39){?>
	    <a href='cont_rep_op.php?accion=22'>Salir</a> 
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
 $_SESSION['anio'] = 2011;
?> 
 <font size="+2"  style="" >
<?php
echo encadenar(40)."Estado de Situacion al ".encadenar(3).$fec_pro.encadenar(3).
"T.C.".encadenar(3).number_format($tc_ctble, 2, '.',',');
?>
<br>
<?php
if ($_SESSION["tipo2"] == 1){
    echo encadenar(50)."(Expresado en Bolivianos)";
}
if ($_SESSION["tipo2"] == 2){
    echo encadenar(50)."(Expresado en Bolivianos y Eqv. Dolares)";
}
 ?>  
  
     
 <?php  if ($_SESSION["tipo2"] == 1){ ?>


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
//$con_cta = "Select * From contab_cuenta order by CONTA_CTA_NRO";
//$res_cta = mysql_query($con_cta)or die('No pudo seleccionarse tabla contab_trans')  ;
//if ($_POST['niv_2'] == 'S'){
$con_cta = "Select * From contab_cuenta  where CONTA_CTA_NIVEL between
            '$est1' and '$est2' order by CONTA_CTA_NRO ";
$res_cta = mysql_query($con_cta) ;
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
					  $_SESSION['activo'] = $saldo;
					  $_SESSION['activo_sus'] = $saldo/$tc_ctble;
				  }	
				   if ($tipo == 2){
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['pasivo'] = $saldo;
					  $_SESSION['pasivo_sus'] = $saldo/$tc_ctble;
				  }	
				  if ($tipo == 3){
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['patrimonio'] = $saldo;
					  $_SESSION['patrimonio_sus'] = $saldo/$tc_ctble;
				  }	
				   if ($tipo == 6){
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['gastos'] = $saldo;
					  $_SESSION['gastos_sus'] = $saldo/$tc_ctble;
				  }	
				   if ($tipo == 5){
				      $saldo = $monto_d - $monto_h;
					  $_SESSION['costos'] = $saldo;
					  $_SESSION['costos_sus'] = $saldo/$tc_ctble;
				  }	
				   if ($tipo == 4){
				      $saldo = $monto_h - $monto_d;
					  $_SESSION['ingresos'] = $saldo;
					  $_SESSION['ingresos_sus'] = $saldo/$tc_ctble;
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
				  	set_time_limit(0);
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
	   	<th align="left" ><?php echo $des; ?></th> 
		<th align="right"><?php echo number_format($saldo, 2, '.',','); ?></th>
		 <?php  if ($_SESSION["tipo2"] == 2){ ?>
		 <td align="center"><?php echo encadenar(5); ?></td>		 
		 <th align="right"><?php echo number_format($saldo/
		                       $tc_ctble, 2, '.',',');?></th> 
		<?php } ?>
		
		
		
	</tr>	
	
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
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
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
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
				 
		<?php } ?>		
		
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
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
		<?php } ?>		
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
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
		<?php } ?>		
	</tr>
		<tr>
	    <th align="center"><?php echo encadenar(20); ?></th>  
	   	<th align="center"><?php echo encadenar(70); ?></th> 
		<th align="center"><?php echo encadenar(20); ?></th>
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
		<?php } ?>		
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
		<?php if ($_SESSION["tipo2"] == 2){ ?>
		         <td align="center"><?php echo encadenar(5); ?></td>
		<?php } ?>		
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
ob_end_flush();
 ?>

