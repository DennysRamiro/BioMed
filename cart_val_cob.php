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
                  Aplicando cobro enviado por Creditos
            </div>
<div id="AtrasBoton">
 	<a href="modulo.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0" alt= "Regresar" align="absmiddle">Atras</a>
</div>
<?php
/***VARIABLES POR POST ***/
$numero2 = count($_POST);
$borr_temp  = "Delete From temp_ctable"; 
$temp_borr = mysql_query($borr_temp);
$total = 0;
$tot_sus = 0;
$tot_bol = 0;
$t_sus = 0;
$t_bol = 0;

$cta_cart = " ";
$des_cta = " ";
$mon=$_SESSION['moneda'];
$tc_ven = $_SESSION['TC_VENTA'];
$tc_com = $_SESSION['TC_COMPRA'];
$tc_ctb = $_SESSION['TC_CONTAB'];
 if(isset($_SESSION['total'])){
    $total = $_SESSION['total'];
	}
if ($mon == 1){	
if(isset( $_POST['tot_sus'])){
      $tot_sus = $_POST['tot_sus'];
	  $t_sus_e = $tot_sus * $tc_ven;
	   $t_bol = $total - $t_sus_e;
	   $cta_bill = 11101201;
		$cta_tip = 111;
		$con_ctad  = "Select * From contab_cuenta where CONTA_CTA_NRO = $cta_bill and CONTA_CTA_NIVEL = 'A' ";
        $res_ctad = mysql_query($con_ctad);
	    while ($lin_ctab = mysql_fetch_array($res_ctad)) {
	          $des_ctab = $lin_ctab['CONTA_CTA_DESC'];
	    }
		$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cta_tip,
										   $cta_bill,
									       '$des_ctab',
										   $t_sus_e ,
										   0,
										   $tot_sus,
										   0
										    )";
    $resultado = mysql_query($consulta);	
	  
  }
    if(isset( $_POST['tot_bol'])){
       $tot_bol = $_POST['tot_bol'];
	   if ($tot_bol <> $t_bol){
	      $tot_bol = $t_bol;
		  }
	    $t_bol_e = $tot_bol / $tc_ctb;
		$cta_bill = 11101101;
		$cta_tip = 111;
		$con_ctad  = "Select * From contab_cuenta where CONTA_CTA_NRO = $cta_bill and CONTA_CTA_NIVEL = 'A' ";
        $res_ctad = mysql_query($con_ctad);
	    while ($lin_ctab = mysql_fetch_array($res_ctad)) {
	          $des_ctab = $lin_ctab['CONTA_CTA_DESC'];
	    }
	    $consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cta_tip,
										   $cta_bill,
									       '$des_ctab',
										   $tot_bol,
										   0,
										   $t_bol_e,
										   0
										    )";
    $resultado = mysql_query($consulta);		
	  }
    
   } 
  if ($mon == 2){
    if(isset( $_POST['tot_bol'])){
       $tot_bol = $_POST['tot_bol'];
	   $t_sus_e = $tot_bol * $tc_ven;
	   $cta_bill = 11101101;
		$cta_tip = 111;
		$con_ctad  = "Select * From contab_cuenta where CONTA_CTA_NRO = $cta_bill and CONTA_CTA_NIVEL = 'A' ";
        $res_ctad = mysql_query($con_ctad);
	    while ($lin_ctab = mysql_fetch_array($res_ctad)) {
	          $des_ctab = $lin_ctab['CONTA_CTA_DESC'];
	    }
		if ($tot_bol > 0){
	    $consulta = "insert into temp_ctable (temp_tip_tra,
	                                          temp_nro_cta, 
                                              temp_des_cta,
				    		 	              temp_debe_1,
					    				      temp_haber_1,
						    				  temp_debe_2,
							    		      temp_haber_2
								    	  	  ) values
									    	  ($cta_tip,
										       $cta_bill,
									           '$des_ctab',
										       $t_sus_e,
										       0,
										       $tot_bol,
										       0
										       )";
    $resultado = mysql_query($consulta);	
	   }   
    }
    if(isset( $_POST['tot_sus'])){
      $tot_sus = $_POST['tot_sus'];
	  $t_bol_e = $tot_sus * $tc_ctb;
	  $cta_bill = 11101201;
	  $cta_tip = 111;
	  $con_ctad  = "Select * From contab_cuenta where CONTA_CTA_NRO = $cta_bill and CONTA_CTA_NIVEL = 'A' ";
        $res_ctad = mysql_query($con_ctad);
	    while ($lin_ctab = mysql_fetch_array($res_ctad)) {
	          $des_ctab = $lin_ctab['CONTA_CTA_DESC'];
	    }
	  }
   }  

  if ($mon == 2){
	if ($tot_sus > 0){
	$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cta_tip,
										   $cta_bill,
									       '$des_ctab',
										   $t_bol_e,
										   0,
										   $tot_sus,
										   0
										    )";
    $resultado = mysql_query($consulta);	
	   }
	
	 }  
 
 $cod_cre = $_SESSION['nro_cre'];
 $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $cod_cre and CART_MAE_USR_BAJA is null"; 
 $res_car = mysql_query($con_car);
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_sol = $lin_car['CART_NRO_SOL']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $mon = $lin_car['CART_COD_MON'];
		 $tint = $lin_car['CART_TASA'];
		 $plzm = $lin_car['CART_PLZO_M'];
		 $plzd = $lin_car['CART_PLZO_D'];
		 $cuotas = $lin_car['CART_NRO_CTAS'];
		 $c_int = $lin_car['CART_CAL_INT'];
		 $f_pag = $lin_car['CART_FORM_PAG'];
		 $ahod = $lin_car['CART_AHO_DUR'];
		 $f_des = $lin_car['CART_FEC_DES'];
		 $f_uno = $lin_car['CART_FEC_UNO'];
		 $c_agen = $lin_car['CART_COD_AGEN'];
		 $t_op = $lin_car['CART_TIPO_OPER'];
		 $est = $lin_car['CART_ESTADO'];
		 $t_cred = $lin_car['CART_TIPO_CRED'];
		 $f_des2= cambiaf_a_normal($f_des);
		 if ($t_cred == 1) {  
		    $f_uno2= cambiaf_a_normal($f_uno);
		 }
		// echo $cod_sol;
   }
   $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
	 if ($t_cred == 1) {    
         $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
         $res_cin = mysql_query($con_cin);
	     while ($linea = mysql_fetch_array($res_cin)) {
	           $d_cin = $linea['GRAL_PAR_INT_DESC'];
	      }
	   }
  $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa);
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
		  }
  //Cuentas contables

	?>
<center> 
<font size="+0">
 <br>
<form name="form1" method="post" action="cobro_retro_op.php" > 
    <br><br>
	<strong> Solicitud </strong>
   <?php  
     echo encadenar(2).$cod_sol.encadenar(5);
	 ?>
 <strong> Credito Nro.  </strong>
 <?php  
     echo encadenar(5).$cod_cre;
	?> 
 <strong> Importe Desembolsado </strong>
   <?php 
    $impo2 = number_format($impo, 2, '.',','); 
    echo $impo2;   
   ?>
  <br>
  <strong> Tasa Interes  </strong>
   <?php 
     $tint2 = number_format($tint, 2, '.',','); 
     echo $tint2.encadenar(3)." % Anual".encadenar(3); 
  ?>
  <strong> Plazo </strong>
   <?php  
     echo $plzm.encadenar(2). "Meses".encadenar(2). $plzd .encadenar(2). "Días";   
 ?>
  <strong> Numero de Cuotas </strong>
   <?php  
 	 echo encadenar(2).$cuotas.encadenar(2);   
   ?>
  <strong> Calculo Interes  </strong>
   <?php  
     echo $d_cin; 
	 echo "  ";
  ?>
  <br>
 <strong> Forma de Pago </strong>
   <?php  
	 echo $fpag_d . " cada ". $nro_d . " días";   
 ?>
<strong> Fondo Garantia Ciclo </strong>
   <?php
      $_SESSION["aho_d"] =  $ahod; 
     echo $ahod. " %";   
   ?>
  <br> 
 <strong> Fecha Desembolso </strong>
   <?php 
     echo  $f_des2;   
 ?>  
   <strong> Fecha 1er. Pago </strong>
   <?php 
      echo  $f_uno2;
 ?>  
 <br>
<strong> Moneda </strong>
   <?php
    echo encadenar(3).$d_mon;
?>  
<br>
 <?php
    $con_cob  = "Select * from cart_cobro where CART_COB_NCRE = $cod_cre and CART_COB_USR_BAJA is null";
    $res_cob = mysql_query($con_cob);
	?>
	<table border="1" width="800">
	
	<tr>
	   	<th>Cuota</th>
		<th>Fecha Cuota</th>
		<th>Capital</th>
		<th>Interes</th>
		<th>Fondo Garantia Ciclo</th>
		<th>TOTAL A COBRAR</th>
		
		</tr>
<?php
$importe = 0;
$kap = 0;
$int = 0;
$aho = 0;
$imp_itf = 0;
$impo_sus = 0;
$impo_bol = 0;
	while ($linea = mysql_fetch_array($res_cob)) {
	      $f_cta =   $linea['CART_COB_FEC_CTA'];    
		  $f_cta1 = cambiaf_a_normal($f_cta);
		  $kap = $linea['CART_COB_IMPO_C'];
		  $int = $linea['CART_COB_IMPO_I'];
		  $aho = $linea['CART_COB_IMPO_F'];
		  $t_cuota = ($linea['CART_COB_IMPO_C']+
		              $linea['CART_COB_IMPO_I']+
					 $linea['CART_COB_IMPO_F']);
		$imp_itf = (($linea['CART_COB_IMPO_C']+$linea['CART_COB_IMPO_I'])*1.5)/1000 ; 
for ($i=1; $i < 4; $i = $i + 1 ) {					 
    if ($i == 1){
       $importe = $linea['CART_COB_IMPO_C'];
	   $o = 1;
      }
	 if ($i == 2){
       $importe = $linea['CART_COB_IMPO_I'];
	    $o = 7;
      } 
	 if ($i == 3){
       $importe = $linea['CART_COB_IMPO_F'];
	    $o = 2;
      }
	  
	 $cta_cart = leer_cta_car($o,$t_op,$est,$mon);
     $cta_tip =  leer_cta_tip($o,$t_op,$est,$mon);
     $des_cta = leer_cta_des($cta_cart); 

if ($mon == 2){	  
	$impo_bol = $importe * $tc_ctb; 
    }else{
   $impo_bol = $importe;
   $importe =  $impo_bol/$tc_ctb;  
   }	 
//echo "cuenta ".$cta_cart;
$consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cta_tip,
										   $cta_cart,
									       '$des_cta',
										   0,
										   $impo_bol,
										   0,
										   $importe)";
										   
    $resultado = mysql_query($consulta);	
		
	 }
  	}
//ITF
if ($mon == 2){	 
   $importe = $imp_itf;
   $impo_bol = $importe * $tc_ctb; 
   $cta_cart = leer_cta_car(8,0,0,$mon);
   $cta_tip =  leer_cta_tip(8,0,0,$mon);
   $des_cta = leer_cta_des($cta_cart); 
  $consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cta_tip,
										   $cta_cart,
									       '$des_cta',
										   0,
										   $impo_bol,
										   0,
										   $importe)";
										   
    $resultado = mysql_query($consulta);	 
    }   	
	
	$debe = 0;
	$haber = 0;
	$igual = 0;
	 $con_igual = "Select sum(temp_debe_1),sum(temp_haber_1) From temp_ctable";
	 $res_igual = mysql_query($con_igual);	 
	 while ($lin_igual = mysql_fetch_array($res_igual)) {
	        $debe = $lin_igual['sum(temp_debe_1)'];
			$haber = $lin_igual['sum(temp_haber_1)'];
		  }
		 
	if ($debe <> $haber){
	    $cta_cart = leer_cta_car(9,0,0,0);
        $cta_tip =  leer_cta_tip(9,0,0,0);
        $des_cta = leer_cta_des($cta_cart); 
	    $igual = $debe - $haber;
		if ($igual > 0){
		    $importe = 0;
			$impo_bol = $igual;
			 $consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cta_tip,
										   $cta_cart,
									       '$des_cta',
										   0,
										   $impo_bol,
										   0,
										   $importe)";
			}else { 
			$importe = 0;
			$impo_bol = $igual;
			  $consulta = "insert into temp_ctable (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($cta_tip,
										   $cta_cart,
									       '$des_cta',
										   $impo_bol,
										   0,
										   $importe,
										   0)";
			
		 }
	$resultado = mysql_query($consulta);	 
	}
 ?>
	<?php
	$_SESSION['continuar'] = 1;
	$_SESSION["recal"] = 2;
	$_SESSION['nro_cre'] = $cod_cre;
	 header('Location:cart_cobro_det.php');	
$consulta  = "Select * From temp_ctable where (temp_debe_1+temp_haber_1+temp_debe_2+temp_haber_2) > 0";
    $resultado = mysql_query($consulta);
 ?>		
		<table border="1">
	<tr>
	   	<th>Cuenta</th>
		<th>Descripcion</th>
		<th>Importe Debe Bs</th>
		<th>Importe Haber Bs</th>
		<th>Importe Debe $us</th>
		<th>Importe Haber $us</th>
	</tr>
<?php
$tot_debe_1 = 0;
$tot_haber_1 = 0;
$tot_debe_2 = 0;
$tot_haber_2 = 0;
while ($linea = mysql_fetch_array($resultado)) {
      $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	  $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	   $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	  $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
	 ?>
	 <tr>
	 	<td><?php echo $linea['temp_nro_cta']; ?></td>
		<td><?php echo $linea['temp_des_cta']; ?></td>
		<td><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		<td><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		<td><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		<td><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
 <?php
}
?>
</table>
</center>
<strong>
<?php
	//}
 echo encadenar(75),"Totales",encadenar(13) ;
 echo number_format($tot_debe_1, 2, '.',',');
 echo encadenar(14);
 echo number_format($tot_haber_1, 2, '.',',');
 echo encadenar(16);
 echo number_format($tot_debe_2, 2, '.',',');
 echo encadenar(18);
 echo number_format($tot_haber_2, 2, '.',',');
 echo encadenar(5);
?>
</strong>
<br><br>
	</tr>	
</table>
</center>
 </FONT> 
  <?php
  
    	
?>  
<div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Aplicando Cobro</MARQUEE></FONT></B>
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