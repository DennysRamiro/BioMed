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
<title>Cobro detalle desde Caja</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
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
 $fec1 = cambiaf_a_mysql_2($fec);
 $logi = $_SESSION['login']; 
?> 
	</div>
            <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div>
            <div id="TitleModulo">
            	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">
                      Detalle de cobro desde Caja
			</div>
            <div id="AtrasBoton">
           	<a href="cart_cobros.php?modulo=<?php echo $_SESSION['modulo'];?>"><img src="images/24x24/001_23.png" border="0"  alt="Regresar" align="absmiddle">Atras</a>
            </div>
<font size="+1">
<div id="TableModulo2" >
 <form name="form2" method="post" action="cobro_retro_opd.php" style="border:groove" onSubmit="return">  
<?php

//$_SESSION['form_buffer'] = $_POST;
$log_usr = $_SESSION['login'];
$f_has =""; 
$_SESSION['msg']="";
?>
 <?php 
if(isset($_POST['ncre'])){
      $ncre = $_POST['ncre'];
      $_SESSION['ncre'] = $ncre;
	  $_SESSION['continuar'] = 2;
      }else{
	  $_SESSION['continuar'] = 1;
      header('Location:cobro_pag_det_gd.php');
   }
  if(isset($_SESSION['grupo'])){
      $nom_grp =$_SESSION['grupo'];
	 // echo "Grupo ".encadenar(2).$nom_grp;
	  }
	 echo "Calculo".encadenar(2).$_SESSION['calculo'];
	  if ( $_SESSION['calculo'] == 1){
	  ?>  
 
  <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
                 <td style="font-size:18px"><?php echo "Credito Nro."; ?></td>
                 <td style="font-size:18px"><?php echo $ncre; ?></td>
				 <td style="font-size:18px"><?php echo "Grupo"; ?></td>
                 <td style="font-size:18px"><?php echo $nom_grp; ?></td>
                


</table> 
<?php } ?>
 <?php
   if(isset($_SESSION['nombre'])){
      $nom_com =$_SESSION['nombre'];
	  $ncre = $_SESSION['ncre'];
	 // echo "Credito Nro. ".encadenar(2).$ncre;?>
	  <?php } ?>
 <?php
  if(isset($_SESSION['msg'])){?>
     <font color="#FF0000">
	  <?php echo $_SESSION['msg'];
          //  $_SESSION['msg'] = "";?>
	  </font color>
  <?php   }?>
  <?php
 if ( $_SESSION['calculo'] == 1){
    echo $_SESSION['msg']; 
    $ncre =  $_SESSION['ncre'];
    $con_pdp  = "Select * From cart_plandp where CART_PLD_NCRE = $ncre and CART_PLD_USR_BAJA is null order by 4 ";
    $res_pdp = mysql_query($con_pdp)or die('No pudo seleccionarse tabla')  ;
 
 ?>
 	
		<br>
		<strong>Cta.   Fecha   Cap.   Int.   Aho.   Total  Est.</strong> <br>
		
         <select name="fec_cal" size="10"  >
   	  <?php
	  
        while ($lin_pdp = mysql_fetch_array($res_pdp)) {
		        $f_pag = $lin_pdp['CART_PLD_FECHA'];
				$lin_pdp['CART_PLD_FECHA'] = cambiaf_a_normal($f_pag);
      ?>
	  
	  <?php 
	  if ($lin_pdp['CART_PLD_STAT'] == "C"){
	  ?>
          <option value=<?php echo $lin_pdp['CART_PLD_FECHA']; ?>
		          style="color:#FF0000"> <?php echo $lin_pdp['CART_PLD_CTA']
	                                    .encadenar(3). $lin_pdp['CART_PLD_FECHA']
										.encadenar(2).number_format($lin_pdp['CART_PLD_CAPITAL'], 2, '.',',') 
										.encadenar(2).number_format($lin_pdp['CART_PLD_INTERES'], 2, '.',',')
										.encadenar(2).number_format($lin_pdp['CART_PLD_AHORRO'], 2, '.',',')
										.encadenar(2).number_format(($lin_pdp['CART_PLD_CAPITAL']+
										$lin_pdp['CART_PLD_INTERES']+
										$lin_pdp['CART_PLD_AHORRO']),2, '.',',')
										.encadenar(2).$lin_pdp['CART_PLD_STAT']; ?> </option>
	      <?php }else {?>
          <option value=<?php echo $lin_pdp['CART_PLD_FECHA']; ?> >
		                           <?php echo $lin_pdp['CART_PLD_CTA']
	                                     .encadenar(3).$lin_pdp['CART_PLD_FECHA']
									 	 .encadenar(2).number_format($lin_pdp['CART_PLD_CAPITAL'], 2, '.',',') 
										 .encadenar(2).number_format($lin_pdp['CART_PLD_INTERES'], 2, '.',',')
										 .encadenar(2).number_format($lin_pdp['CART_PLD_AHORRO'], 2, '.',',')
										 .encadenar(2).number_format(($lin_pdp['CART_PLD_CAPITAL']+
										 $lin_pdp['CART_PLD_INTERES']+
										 $lin_pdp['CART_PLD_AHORRO']),2, '.',',') 
	                                     .encadenar(2).$lin_pdp['CART_PLD_STAT']; ?> </option>
  	  <?php
	  }
	} 
  
  ?>
  </select>
   <br> <br>
  <input type="submit" name="accion" value="Fecha de Calculo">
<input type="submit" name="accion" value="Salir">
 
  <?php
  }
 if ( $_SESSION['calculo'] == 2){ 
    $f_has ="";
    $borr_cob  = "Delete From temp_cobro"; 
    $cob_borr = mysql_query($borr_cob)or die('No pudo borrar cart_cobro');
	if(isset($_SESSION['fec_cal1'])){
      //echo "Calculo al ".encadenar(2).$_SESSION['fec_cal1'];	  
	 }  
	 if(isset($_SESSION['cuota'])){
      $nro_cta = $_SESSION['cuota'];	  
	 }  
   } 
   if(isset($_SESSION['cod_cli'])){
      $cod_cli = $_SESSION['cod_cli'];
	  $ncre = $_SESSION['ncre'];
     } 
 	if(isset($_SESSION['fec_cal'])){
      $f_has = $_SESSION['fec_cal'];
	  } 
	
  ?>
  <?php
   $cont = 0;
   $monto = 0;	
   $cta_pag = 0;
   $cta_ven = 0;
   $vto_fin = "";
   $f_ultp = "";
   $con_car  = "Select * From cart_maestro where CART_NRO_CRED = $ncre and CART_ESTADO < 8 and CART_MAE_USR_BAJA is null"; 
   $res_car = mysql_query($con_car)or die('No pudo seleccionarse solicitud 2');
          while ($lin_car = mysql_fetch_array($res_car)) {
                 $cod_sol = $lin_car['CART_NRO_SOL']; 
		         $impo = $lin_car['CART_IMPORTE'];
		         $mon = $lin_car['CART_COD_MON'];
		         $tint = $lin_car['CART_TASA'];
				 $tope = $lin_car['CART_TIPO_OPER'];
		         $plzm = $lin_car['CART_PLZO_M'];
		         $plzd = $lin_car['CART_PLZO_D'];
		         $cuotas = $lin_car['CART_NRO_CTAS'];
		         $c_int = $lin_car['CART_CAL_INT'];
		         $f_pag = $lin_car['CART_FORM_PAG'];
		         $ahod = $lin_car['CART_AHO_DUR'];
		         $f_des = $lin_car['CART_FEC_DES'];
		         $f_uno = $lin_car['CART_FEC_UNO'];
		         $c_agen = $lin_car['CART_COD_AGEN'];
				 $c_grup = $lin_car['CART_COD_GRUPO'];
				 $t_prod = $lin_car['CART_PRODUCTO'];
				 $est =  $lin_car['CART_ESTADO'];
				 $t_cred = $lin_car['CART_TIPO_CRED'];
				 $f_des2= cambiaf_a_normal($f_des);
	//Cuotas pagadas			 
				 $cta_pag = cta_pag($ncre);
	//Cuotas vencidas			 
				 $cta_ven = cta_ven($ncre);
	//Cuotas vencidas			 
				 $cta_venf = cta_venf($ncre);
				  $cta_vef= cambiaf_a_normal($cta_venf);
	//Vencimiento Final			 
				 $f_vtof = vto_fin($ncre);
				 $f_vto= cambiaf_a_normal($f_vtof);
	//Ultimo Pago			 
				 $f_ultp = ult_pag($ncre);
				 $f_ult= cambiaf_a_normal($f_ultp);			 
				  
			     if ($t_cred == 1) { 
				    $con_cin = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 10 and GRAL_PAR_INT_COD = $c_int";
                    $res_cin = mysql_query($con_cin)or die('No pudo seleccionarse tabla 4')  ;
	                while ($linea = mysql_fetch_array($res_cin)) {
	                      $d_cin = $linea['GRAL_PAR_INT_DESC'];
	                 }
				         $f_uno2= cambiaf_a_normal($f_uno);
					$con_ctat  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol 
		                          and CRED_PLD_NRO_CTA = 1 and CRED_PLD_USR_BAJA is null"; 
                    $res_ctat = mysql_query($con_ctat)or die('No pudo seleccionarse cred_plandp');
	                $imp_ctat = 0;
		            while ($lin_ctat = mysql_fetch_array($res_ctat)){
		                  $imp_ctat = $imp_ctat + ($lin_ctat['CRED_PLD_CAPITAL'] + $lin_ctat['CRED_PLD_INTERES'] 
				          + $lin_ctat['CRED_PLD_AHORRO']);          
				      } 			 	 
				  }
				  if ($t_cred == 2) { 
				     $con_ctat  = "Select * From cart_plandp where CART_PLD_NCRE = $ncre 
		                          and CART_PLD_CTA = 1 and CART_PLD_USR_BAJA is null"; 
                    $res_ctat = mysql_query($con_ctat)or die('No pudo seleccionarse cred_plandp');
	                $imp_ctat = 0;
		            while ($lin_ctat = mysql_fetch_array($res_ctat)){
		                  $imp_ctat = $imp_ctat + ($lin_ctat['CART_PLD_CAPITAL'] + $lin_ctat['CART_PLD_INTERES'] 
				          + $lin_ctat['CART_PLD_AHORRO']);          
				      } 			
				  }
				  
		$con_dpro  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 806 and GRAL_PAR_PRO_COD = $t_prod";
        $res_dpro = mysql_query($con_dpro)or die('No pudo seleccionarse tabla');
        while ($lin_dpro = mysql_fetch_array($res_dpro)) {
               $d_pro = $lin_dpro['GRAL_PAR_PRO_DESC']; 
	     }
		$con_dope  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $tope";
        $res_dope = mysql_query($con_dope)or die('No pudo seleccionarse tabla');
        while ($lin_dope = mysql_fetch_array($res_dope)) {
               $d_ope = $lin_dope['GRAL_PAR_INT_DESC']; 
	     }
		      
		$con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla cred_grupo')  ;
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			}		 
		}		 
       $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla 3')  ;
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_DESC'];
	   }
   
          $con_fpa = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 13 and GRAL_PAR_INT_COD = $f_pag";
          $res_fpa = mysql_query($con_fpa)or die('No pudo seleccionarse tabla 5')  ;
          while ($lin_fpa = mysql_fetch_array($res_fpa)) {
		        $nro_d = $lin_fpa['GRAL_PAR_INT_CTA1'];
				$fpag_d = $lin_fpa['GRAL_PAR_INT_DESC'];
			 }
      $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $est";
      $res_est = mysql_query($con_est)or die('No pudo seleccionarse tabla');
	  while ($linea = mysql_fetch_array($res_est)) {
	       $d_est = $linea['GRAL_PAR_PRO_DESC'];
	       $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	  }  	

	//componentes
	$con_deu  = "Select * From cart_deudor, cliente_general where CART_DEU_NCRED = $ncre and 
	            CLIENTE_COD = CART_DEU_INTERNO and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null "; 
    $res_deu = mysql_query($con_deu)or die('No pudo seleccionarse solicitud 1');
	$mon_deu = 0;
	$mon_pag = 0;
	$mon_cap = 0;
	$mon_int = 0;
	$mon_pcap = 0;
	$mon_pint = 0;
	$mon_apag = 0;
	//deuda a la fecha de calculo
	$mon_deu = 	monto_deuda_t($ncre,$f_has);
	$mon_deu_f = 	monto_deuda_tf($ncre,$f_has);
	//capital a la fecha de calculo
	$mon_cap = monto_deuda_c($ncre,$f_has);
	$mon_int = monto_deuda_i($ncre,$f_has);
	//pagos a la fecha
	$mon_pcap = montos_recuperados($ncre,$fec,1);
	$mon_pint = montos_recuperados($ncre,$fec,5);
	$mon_paho = montos_recuperados($ncre,$fec,2);
	$tmon_pag = $mon_pcap + $mon_pint ;
	//monto a pagar
	$mon_apag = $mon_deu_f - $tmon_pag;
	
 	
    if ( $_SESSION['calculo'] == 2){ ?> 
	   <?php
	$con_fon  = "Select * From fond_maestro where FOND_NRO_CRED = $ncre and FOND_MAE_USR_BAJA is null"; 
    $res_fon = mysql_query($con_fon)or die('No pudo seleccionarse fond_maestro');
      while ($lin_fon = mysql_fetch_array($res_fon)) {
         $cod_cre2 = $lin_fon['FOND_NRO_CRED']; 
		 $cta = $lin_fon['FOND_NRO_CTA'];
		 $tot_tre = 0;
		 $tot_tde = 0;
		 
  $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                FOND_DTRA_TIP_TRAN = 1 and FOND_DTRA_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $depos = $lin_dtra['sum(FOND_DTRA_IMPO)'];
		  }
  $con_dtra  = "Select sum(FOND_DTRA_IMPO) From fond_det_tran where FOND_DTRA_NCTA = $cta and 
                FOND_DTRA_TIP_TRAN = 2 and FOND_DTRA_USR_BAJA is null";
 //$con_pld  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_USR_BAJA is null ";
  $res_dtra = mysql_query($con_dtra)or die('No pudo leer : car_det_tran ' . mysql_error()) ;
	while ($lin_dtra = mysql_fetch_array($res_dtra)) {
	      $ret = $lin_dtra['sum(FOND_DTRA_IMPO)'];
		  }		  
  	   }
	 ?>
	<?php //if ($t_prod == 1){ ?>
		
	<table width="40%"  border="0" cellspacing="1" cellpadding="1" align="left">
    <tr>
      <td scope="col"><border="0" alt="" align="absmiddle" />NUMERO CREDITO</th>
	  <td bgcolor="#66CCFF" ><?php echo $ncre; ?></td>
      <td width="15%" scope="col"><border="0" alt="" align="absmiddle" />GRUPO</th>
	  <td bgcolor="#66CCFF"><?php echo $nom_grp; ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA DESEMBOLSO</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo $f_des2;  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />DESEMBOLSO</th>
	  <td bgcolor="#66CCFF" align="right"><?php echo number_format($impo, 2, '.',',');  ?></td>
	  
	</tr>
	<tr>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />MONEDA</th>
	  <td bgcolor="#66CCFF" ><?php echo $d_mon; ?></td>
	  <td width="15%" scope="col"><border="0" alt="" align="absmiddle" />T.OPERACION</th> 
      <td bgcolor="#66CCFF"><?php echo $d_ope; ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />TASA INTERES ANUAL</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($tint, 2, '.',',');  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FRECUENCIA PAGOS</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($nro_d , 0, '.',',');  ?></td> 
	</tr>	
	<tr>
      <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />PRODUCTO</th>
	  <td bgcolor="#66CCFF" ><?php echo $d_pro; ?></td>
	  <td width="15%" scope="col"><border="0" alt="" align="absmiddle" />ESTADO</th>
	  <td bgcolor="#66CCFF" ><?php echo $d_est; ?></td>
      <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />PLAZO EN MESES</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($plzm,0, '.',','); ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />PLAZO EN DIAS</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($plzd,0, '.',',');  ?></td> 
	</tr>
	<tr>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />NRO. CTAS PACTADAS</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($cuotas,0, '.',',');  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />NRO. CTAS PAGADAS</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($cta_pag,0, '.',',');  ?></td>
	   <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA VENCIMIENTO FINAL</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo $f_vto;  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA VENCIMIENTO</th>  
	  <td bgcolor="#66CCFF" align="right"><?php echo $cta_vef;  ?></td> 
	</tr>
	<tr>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />CTA. FONDO GARTIA</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo $cta;  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />SALDO FONDO GARANTIA</th>  
	  <td bgcolor="#66CCFF" align="right"><?php echo number_format($depos-$ret, 2, '.',',');  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA ULTIMO PAGO</th>
	  <td bgcolor="#66CCFF" align="center"><?php echo $f_ult;  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />SALDO ACTUAL</th>  
	  <td bgcolor="#66CCFF" align="right"><?php echo number_format($impo-$mon_pcap , 2, '.',',');  ?></td> 
	</tr>		
	<tr>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />MONTO CUOTA</th>  
	  <td bgcolor="#66CCFF" align="right"><?php echo number_format($imp_ctat, 2, '.',',');  ?></td> 
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" />CUOTAS EN MORA</th>  
	  <td bgcolor="#66CCFF" align="center"><?php echo number_format($cta_ven, 0, '.',',');  ?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" /><?php encadenar(6);?></th>
	  <td bgcolor="#66CCFF" align="center"><?php encadenar(6);?></td>
	  <td width="20%" scope="col"><border="0" alt="" align="absmiddle" /><?php encadenar(6);?></th>  
	  <td bgcolor="#66CCFF" align="right"><?php encadenar(6);?></td> 
	</tr>	
	  </table> 
	  
	  CUOTAS VENCIDAS
	  <table width="40%"  border="0" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />NRO CUOTA</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />FECHA</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />CAPITAL</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />INTERES</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />TOTAL</th>
	  
	</tr>
	  
	  <?php
	  $deuda = 0;
	  $t_f_cap_c = 0;
	  $t_f_int_c = 0;
	  $f_int_c = 0;
      $con_ptra  = "Select * From cart_plandp where CART_PLD_NCRE = $ncre and CART_PLD_STAT <> 'C'
	                and CART_PLD_FECHA <= '$fec1' 
	                and CART_PLD_USR_BAJA is null order by CART_PLD_FECHA";
      $res_ptra = mysql_query($con_ptra)or die('No pudo leer : cart_plandp ' . mysql_error());
      while ($lin_ptra = mysql_fetch_array($res_ptra)) {
	        $mon_pcap_2 = 0;
	        $mon_pint_2 = 0;
	        $mon_cap_2 = 0;
	        $mon_int_2 = 0;
	        $f_cta = $lin_ptra['CART_PLD_CTA'];
			$f_fec = $lin_ptra['CART_PLD_FECHA'];
			$f_fecn= cambiaf_a_normal($f_fec);	
			$f_cap = $lin_ptra['CART_PLD_CAPITAL'];
			$f_int = $lin_ptra['CART_PLD_INTERES'];
			
			$mon_cap_2 = monto_deuda_c($ncre,$f_fec);
			
	        $mon_int_2 = monto_deuda_i($ncre,$f_fec);
	//pagos a la fecha
	$mon_pcap_2 = montos_recuperados($ncre,$fec,1);
	$mon_pint_2 = montos_recuperados($ncre,$fec,5);
	//echo $f_fec .encadenar(2).$mon_int_2.encadenar(2).$mon_pint_2;
	?>
	
	 <?php
	if ($f_fecn == $cta_vef){ 
	 if ($mon_cap_2 > $impo) {
	       $f_cap_c = $impo - $mon_pcap_2;
		   }else{
		   $f_cap_c = $mon_cap_2 - $mon_pcap_2;
		 }
	
	    }else{
		$f_cap_c = $f_cap;
		$f_int_c = $f_int;
	 if ($mon_int_2 <= $mon_pint_2){	
		$f_int_c = 0;
		}else{
	 	$f_int_c = $mon_int_2 - $mon_pint_2;
		}	
	}
	$f_tot = $f_cap_c + $f_int_c;
	$t_f_cap_c = $t_f_cap_c + $f_cap_c;
	$t_f_int_c = $t_f_int_c + $f_int_c;
	  ?>
	  
	   <tr>
	  <td align="center"><?php echo number_format($f_cta,0, '.',',');  ?></td>
	  <td align="center"><?php echo $f_fecn;  ?></td>
	  <td align="right"><?php echo number_format($f_cap_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($f_int_c,2, '.',',');  ?></td>
	  <td align="right"><?php echo number_format($f_tot,2, '.',',');  ?></td>
	  </tr>
	   <?php
          }
		?> 
		 <tr>
	  <td bgcolor="#FFFF99" align="center"><?php echo encadenar(5);  ?></th>
	  <td bgcolor="#FFFF99" align="center"><?php echo "Total";  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_cap_c,2, '.',',');  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_int_c,2, '.',',');  ?></th>
	  <td bgcolor="#FFFF99" align="right"><?php echo number_format($t_f_cap_c + $t_f_int_c,2, '.',',');  ?></th>
	  </tr>	   
	    </table> 
		
	 <?php
	   if ($t_cred == 1) { 
	  ?>  
	  <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
        <tr>
           <th width="22%" scope="col"><border="0" alt="" align="absmiddle" />CODIGO</th>
           <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />NOMBRE COMPLETO</th>
           <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE DESEMBOLSADO</th>
	       <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE CUOTA</th>
		   <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />DEUDA</th>
	       <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />PAGOS</th>
	       <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />MONTO A PAGAR</th> 
		   <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />MONTO EFECTIVO</th> 
        </tr>
	  
	    <?php
		
	   while ($lin_deu = mysql_fetch_array($res_deu)){
	   
	   	     $nom_com = $lin_deu['CLIENTE_AP_PATERNO'].encadenar(1).$lin_deu['CLIENTE_AP_MATERNO']
			            .encadenar(1).$lin_deu['CLIENTE_NOMBRES'];
			 $c_clie = $lin_deu['CART_DEU_INTERNO'];
			 
		     $con_sol  = "Select * From cred_deudor where CRED_SOL_CODIGO = $cod_sol and CRED_DEU_INTERNO = $c_clie
		               and CRED_DEU_USR_BAJA is null"; 
             $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse cred_deudor');
		     while ($lin_csol = mysql_fetch_array($res_sol)){
		           $imp_ind = $lin_csol ['CRED_DEU_IMPORTE'];          
				   }
		    $con_cta  = "Select * From cred_plandp where CRED_PLD_COD_SOL = $cod_sol and CRED_PLD_COD_CLI = $c_clie
		                and CRED_PLD_NRO_CTA = 1 and CRED_PLD_USR_BAJA is null"; 
            $res_cta = mysql_query($con_cta)or die('No pudo seleccionarse cred_plandp');
		    while ($lin_cta = mysql_fetch_array($res_cta)){
		          $imp_cta = $lin_cta['CRED_PLD_CAPITAL'] + $lin_cta['CRED_PLD_INTERES'] + $lin_cta['CRED_PLD_AHORRO'];          
				 }
			  
		//calculo deuda por cliente
		$mon_deu_c = 0;		 
		$mon_deu_c = monto_deu_ts($cod_sol,$c_clie,$f_has);
		//calculo pagos por cliente
		$mon_pag_c = 0;
		$mon_pag_c = montos_recu_cli($cod_sol,$f_has,$c_clie,4); 
		//monto a pagar
		$mon_apag_c = 0;
	    $mon_apag_c = $mon_deu_c - $mon_pag_c;	
		
				
	?>
		     <tr>
			    <td bgcolor="" ><?php echo $lin_deu['CART_DEU_INTERNO']; ?></td>
				<td bgcolor="" ><?php echo $nom_com; ?></td>
				<td align="right" ><?php echo number_format($imp_ind, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($imp_cta, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($mon_deu_c, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($mon_pag_c, 2, '.',','); ?></td>
				<td align="right" ><?php echo number_format($mon_apag_c, 2, '.',','); ?></td>
	
	
	<?php
		 	
	  if(isset($cont)){
	    $cont = $cont + 1;
	  } 
	?> 			
	<?php	
   if ($cont == 1) {
      $_SESSION["cont_1"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_1" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
  <?php
    if ($cont == 2) {
      $_SESSION["cont_2"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_2" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 3) {
      $_SESSION["cont_3"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_3" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 4) {
	//echo $cont, "  4";
      $_SESSION["cont_4"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_4" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 5) {
      $_SESSION["cont_5"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_5" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 6) {
      $_SESSION["cont_6"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_6" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 7) {
      $_SESSION["cont_7"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_7" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 8) {
      $_SESSION["cont_8"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_8" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 9) {
      $_SESSION["cont_9"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_9" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 10) {
      $_SESSION["cont_10"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_10" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
   <?php
    if ($cont == 11) {
      $_SESSION["cont_11"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_11" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 12) {
      $_SESSION["cont_12"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_12" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 13) {
      $_SESSION["cont_13"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_13" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 14) {
      $_SESSION["cont_14"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_14" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 15) {
      $_SESSION["cont_15"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_15" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 16) {
      $_SESSION["cont_16"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_16" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 17) {
      $_SESSION["cont_17"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_17" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
	 <?php
    if ($cont == 18) {
      $_SESSION["cont_18"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_18" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>	
    <?php
    if ($cont == 19) {
      $_SESSION["cont_19"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_19" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 20) {
      $_SESSION["cont_20"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_20" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 21) {
      $_SESSION["cont_21"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_21" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 22) {
      $_SESSION["cont_22"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_22" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 23) {
      $_SESSION["cont_23"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_23" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 24) {
      $_SESSION["cont_24"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_24" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 25) {
      $_SESSION["cont_25"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_25" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 26) {
      $_SESSION["cont_26"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_26" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 27) {
      $_SESSION["cont_27"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_27" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 28) {
      $_SESSION["cont_28"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_28" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 29) {
      $_SESSION["cont_29"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_29" width="10"  size="12" value=0 ></td>
   <?php
     }
   ?>
    <?php
    if ($cont == 30) {
      $_SESSION["cont_30"] = $cont;
   ?>
	<td align="right" ><input type="text"  style align="center" name="imp_30" width="10"  size="12" value=0 ></td>
   <?php
     }
	 }
	} 
   ?>
    <?php
	
	   if ($t_cred == 5) { 
	?>  
	  <table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
        <tr>
           <th width="22%" scope="col"><border="0" alt="" align="absmiddle" />CODIGO</th>
           <th width="20%" scope="col"><border="0" alt="" align="absmiddle" />NOMBRE COMPLETO</th>
           <th width="25%" scope="col"><border="0" alt="" align="absmiddle" />IMPORTE DESEMBOLSADO</th>
	       
        </tr>
	  
	    <?php
		
	   while ($lin_deu = mysql_fetch_array($res_deu)){
	   
	   	     $nom_com = $lin_deu['CLIENTE_AP_PATERNO'].encadenar(1).$lin_deu['CLIENTE_AP_MATERNO']
			            .encadenar(1).$lin_deu['CLIENTE_NOMBRES'];
			 $c_clie = $lin_deu['CART_DEU_INTERNO'];
			 $impo_d = $lin_deu['CART_DEU_IMPORTE'];
		 ?>	
		   <tr>  
			    <td bgcolor="" ><?php echo $lin_deu['CART_DEU_INTERNO']; ?></td>
				<td bgcolor="" ><?php echo $nom_com; ?></td>
				<td align="right" ><?php echo number_format($impo_d, 2, '.',','); ?></td> 
			</tr> 
			
		<?php	 
				} 
		?> 		
		<?php
		 	
	  if(isset($cont)){
	    $cont = $cont + 1;
	  }
	   
	?> 			
	<?php	
   if ($cont == 1) {
      $_SESSION["cont_1"] = $cont;
	   }
   		
       }
   ?>
   <?php
   $impo_c = 0;
   $impo_i = 0;
   $impo_p = 0;
   $impo_f = 0;
       if ($mon_cap > $impo) {
	       $impo_c = $impo - $mon_pcap;
		   }else{
		   $impo_c = $mon_cap - $mon_pcap;
		 }
		 
		 if ($mon_int <= $mon_pint){	
		    $impo_i = 0;
		    }else{
	    	$impo_i = $mon_int - $mon_pint;
	  	   }	 
		 
		//$impo_i = $mon_int - $mon_pint;  
	   if ($est > 3){
	       $impo_p = ($impo_c * 4 * 3)/36000;
		   }	 
   ?>
   
   
   
   
   
   </div id="TableModulo2">
   <?php echo encadenar(10)."DETALLE DE COBRO".encadenar(10); ?>
    <table width="60%"  border="1" cellspacing="1" cellpadding="1" align="center">
        <tr>
		   <th width="20%" scope="col"><border="0" alt="" align="center" />Concepto</th>
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Calculado</th>
           <th width="20%" scope="col"><border="0" alt="" align="center" />Monto Condonado</th>
	       
        </tr>
        <tr>
		   <td >Capital</td>
	       <td align="right" ><?php echo number_format($impo_c, 2, '.',','); ?></td> 
		   <td align="right" ><?php echo encadenar(10); ?></td> 
		 </tr>
        <tr>  
	       <td >Interes</td>
	       <td align="right" ><?php echo number_format($impo_i, 2, '.',','); ?></td> 
		   <td align="right" ><input type="text" name="imp_i" width="10"  size="12" value=0 ></td>
		 </tr>
        <tr>  
	       <td >Interes Penal</td>
	       <td align="right" ><?php echo number_format($impo_p, 2, '.',','); ?></td> 
	       <td align="right" ><input type="text" name="imp_p" width="10"  size="12" value=0 ></td> 
		 </tr>
        <tr>  
	       <td >Formularios</td>
	       <td align="right" ><?php echo number_format($impo_f, 2, '.',','); ?></td> 
	       <td align="right" ><input type="text" name="imp_f" width="10"  size="12" value=0 ></td> 
		</tr>    
		<tr>  
	       <td style="background-color: #6699FF" align="center" >Importe Total</td>
	       <td style="background-color: #6699FF" align="right" >
		       <?php echo number_format($impo_c+$impo_i+$impo_p+$impo_f, 2, '.',','); ?></td> 
	       <td align="right" ><?php echo encadenar(10); ?></td>
		</tr>       
   <?php
    
	       
   ?>
  
   
				 <?php
	/*			  	 $consulta = "insert into temp_cobro
					                   (TEMP_COB_NCRE,
	                                    TEMP_COB_CLI,
										TEMP_COB_NRO,
										TEMP_COB_FECHA,
										TEMP_COB_IMPO_C,
										TEMP_COB_USR_ALTA,
									    TEMP_COB_FCH_HR_ALTA,
									    TEMP_COB_USR_BAJA,
									    TEMP_COB_FCH_HR_BAJA)
						         values ($ncre,
								         $c_clie,
										 $cont, 
										 '$f_has',
								 		 $monto,
										 '$log_usr',
										 null,
										 null,
										 '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta)or die('No pudo insertar : ' . mysql_error());
                
		*/			
					
		 
				  ?>
				  
	
		<br>	
				</font>			
	 </tr>
   <?php }
           ?>
	<?php	if ( $_SESSION['calculo'] == 2){ ?> 		  
                </table>
            </div id="TableModulo2">
			<center>
			<br>
	<input type="submit" name="accion" value="Confirmar">
<input type="submit" name="accion" value="Salir">
      
</form>	

	 <?php }?>	
	 
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