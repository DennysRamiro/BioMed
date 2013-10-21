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
<title>Cierre de Cartera</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCartera.js"></script>
<meta charset="UTF-8">
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
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CARTERRA
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/forward_24x24.png" border="0" alt="Modulo" align="absmiddle"> TRASPASO DE CARTERA
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">

                      <h2> <img src="img/forward_64x64.png" border="0" alt="Modulo" align="absmiddle"> TRASPASO DE CARTERA</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Cobro de Creditos
        </div>

<?php

 //$fec = leer_param_gral();
 $f_pro = cambiaf_a_mysql_2($fec);
 $logi = $_SESSION['login'];
 $borr_tras  = "Delete From temp_trasp"; 
 $cob_tras = mysql_query($borr_tras);
 ?>

          
            
<font size="+1">
<div id="TableModulo2" >
<form name= "form2" method="post" action= "cobro_retro_opd.php"  onSubmit= "return">  
<?php
$_SESSION['continuar'] = 0;
 if ($_SESSION['cargo'] == 2){ 
      echo "Usuario no Habilitado para este proceso ".encadenar(2)." !!!!!";
      $_SESSION['continuar'] = 1;
	  
?>
<br>
<center>
  <input class="btn_form" type="submit" name="accion" value="Salir_Opc">
     
</form>	
<?php
  }
if ($_SESSION['continuar'] == 0){
$f_has ="";
$f_cal ="";
$t_cuo = 0;
$saldo = 0;
$tot_des = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
$est1 = 3;
$est2 = 6;
$cas = "";

?> 
 <font size="+2"  style="" >
<?php
echo encadenar(25)."Detalle de Traspaso Cierre al".encadenar(3).$fec;
?>
</font>
<?php
 ?>  
  
     
 <?php  
$con_car  = "Select CART_NRO_CRED,CART_IMPORTE,CART_IMP_COM,CART_TIPO_OPER,CART_PRODUCTO,CART_NRO_CTAS,CART_COD_MON,
             CART_FORM_PAG,CART_AHO_DUR,CART_FEC_DES,CART_FEC_UNO,CART_COD_AGEN,CART_COD_GRUPO,CART_ESTADO,
			 CART_TASA,CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES 
             From cart_maestro, cart_deudor, cliente_general
             where (CART_ESTADO between $est1 and $est2) and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null
			 and CLIENTE_USR_BAJA is null order by CART_NRO_CRED"; 
$res_car = mysql_query($con_car);
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $imp_c = $lin_car['CART_IMP_COM'];
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
		 $tasa = $lin_car['CART_TASA'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(2).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(2).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(2).
					$lin_car['CLIENTE_NOMBRES'];
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
	$cta_venf = cta_venf($cod_cre);
	$cta_vef= cambiaf_a_normal($cta_venf);
	//dias de mora
		$ano1 = substr($cta_venf, 0,4); 
        $mes1 = substr($cta_venf, 5, 2); 
        $dia1 = substr($cta_venf, 8, 2);
        $ano2 = substr($fec, 6,4); 
        $mes2 = substr($fec, 3, 2); 
        $dia2 = substr($fec, 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	 $dias = round($segundos_diferencia / (60 * 60 * 24),0); 
	// echo $ano1.encadenar(2).$mes1.encadenar(2).$dia1.encadenar(2).$ano2.encadenar(2).$mes2.encadenar(2).$dia2;
	?>
	
	<?php
//echo $cta_vef.encadenar(2).$cod_cre.encadenar(2).$dias.encadenar(2);
	 
		
   //$cta_vef= $cta_venf;
   $con_mon = "Select GRAL_PAR_INT_SIGLA From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_SIGLA'];
	   }
	$nom_grp = "";   
 if ($c_grup > 0 ) {
	$con_grp = "Select CRED_GRP_NOMBRE From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			
			}
}
	  $con_est  = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_SIGLA From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	  }  	

	//Datos del cart_det_tran	
				
	$con_tde = "Select CART_DTRA_IMPO From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	            AND CART_DTRA_FECHA <= '$f_pro' and CART_DTRA_CCON = 131 and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			
			//$tot_cta = $tot_cta + 1;
			}
			//echo $tot_tde.encadenar(2);		
	$con_tpa = "Select CART_DTRA_IMPO From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 AND
	            CART_DTRA_FECHA <= '$f_pro' and (CART_DTRA_CCON BETWEEN 131 AND 134) 
	            and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			
			}
			//echo $tot_tpa.encadenar(2);
		
	$esta_act = 0;		
	$cta_tipa = 0;
	$cta_act = 0;
	$esta_nue = 0;
	$cta_tipn = 0;
	$cta_nue = 0;
	
	 if ($cta_venf == $f_pro){
	     	//echo $cod_cre.encadenar(2).$cta_venf.encadenar(2).encadenar(2).$f_pro.encadenar(2)
	//.$tot_tde.encadenar(2).$tot_tpa.encadenar(2).$estado;	
	?>
	
	<?php 				
	}
     if ($estado == 3){
	     if ($cta_venf <= $f_pro){
		    $esta_act = $estado;
		    $cta_act = leer_cta_car(1,$t_oper,$esta_act,$mon);
            $cta_tipa =  leer_cta_tip(1,$t_oper,$esta_act,$mon);
		    
			$esta_nue = 6;
			$d_nuev = "VEN";
			$cta_nue = leer_cta_car(1,$t_oper,$esta_nue,$mon);
            $cta_tipn =  leer_cta_tip(1,$t_oper,$esta_nue,$mon);
			//echo $est_nuev.encadenar(2).$cod_cre;
		 }
	   }	 
	 if ($estado == 6){
	     if ($cta_venf > $f_pro){
		    $esta_act = $estado;
		    $cta_act = leer_cta_car(1,$t_oper,$esta_act,$mon);
            $cta_tipa =  leer_cta_tip(1,$t_oper,$esta_act,$mon);
		    $esta_nue = 3;
			$d_nuev = "VIG";
			$cta_nue = leer_cta_car(1,$t_oper,$esta_nue,$mon);
            $cta_tipn =  leer_cta_tip(1,$t_oper,$esta_nue,$mon);
		//echo $est_nuev.encadenar(2).$cod_cre;
		 }
	   }
	   			
if ($esta_nue > 0) { 				
$saldo = $saldo + (	$tot_tde - $tot_tpa);
$sal = $tot_tde - $tot_tpa;
$tot_des = $tot_des + $tot_tde;	

if ($tot_tde > 0 ){	
	 $consulta = "insert into temp_trasp (fecha, 
                                         moneda,
									     credito,
									     cliente,
										 grupo,
									     esta_act,
					                     cta_act,
					                     cta_tipa,
   				                         esta_nue,
					                     cta_nue, 
									     cta_tipn, 
									     fecha_vto, 
									     saldo,
										  dias_mora
                                         ) values ('$f_pro',
										            $mon,
										            $cod_cre,
													'$nom_cli',
									                '$nom_grp',            
												    $esta_act,
					                                '$cta_act',
					                                $cta_tipa,
   				                                    $esta_nue,
					                                '$cta_nue', 
									                $cta_tipn,
													'$cta_venf',
												    $sal,
													$dias
 											        )";
$resultado = mysql_query($consulta); 
          }
       }
	}
?>
<?php 
$con_car  = "Select CART_NRO_CRED,CART_IMPORTE,CART_IMP_COM,CART_TIPO_OPER,CART_PRODUCTO,CART_NRO_CTAS,CART_COD_MON,
             CART_FORM_PAG,CART_AHO_DUR,CART_FEC_DES,CART_FEC_UNO,CART_COD_AGEN,CART_COD_GRUPO,CART_ESTADO,
			 CART_TASA,CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_AP_ESPOSO,CLIENTE_NOMBRES  
             From cart_maestro, cart_deudor, cliente_general
             where CART_ESTADO = 6 and CART_DEU_NCRED = CART_NRO_CRED
             and CLIENTE_COD_ID = CART_DEU_ID and CART_DEU_RELACION = 'C' 
			 and CART_DEU_USR_BAJA is null and  CART_MAE_USR_BAJA is null 
			 and CLIENTE_USR_BAJA is null order by CART_NRO_CRED"; 
$res_car = mysql_query($con_car);
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $impo = $lin_car['CART_IMPORTE'];
		 $imp_c = $lin_car['CART_IMP_COM'];
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
		 $tasa = $lin_car['CART_TASA'];
		 $f_des2= cambiaf_a_normal($f_des); 
		 $nom_cli = $lin_car['CLIENTE_AP_PATERNO'].encadenar(2).
					$lin_car['CLIENTE_AP_MATERNO'].encadenar(2).
					$lin_car['CLIENTE_AP_ESPOSO'].encadenar(2).
					$lin_car['CLIENTE_NOMBRES'];
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
	$cta_venf = cta_venf($cod_cre);
	$cta_vef= cambiaf_a_normal($cta_venf);
	//dias de mora
		$ano1 = substr($cta_venf, 0,4); 
        $mes1 = substr($cta_venf, 5, 2); 
        $dia1 = substr($cta_venf, 8, 2);
        $ano2 = substr($fec, 6,4); 
        $mes2 = substr($fec, 3, 2); 
        $dia2 = substr($fec, 0, 2);
       $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
        $timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 
        $segundos_diferencia = $timestamp2 - $timestamp1; 
	 $dias = round($segundos_diferencia / (60 * 60 * 24),0); 
	
	
//	echo $ano1.encadenar(2).$mes1.encadenar(2).$dia1.encadenar(2).$ano2.encadenar(2).$mes2.encadenar(2).$dia2;
	?>
	
	<?php
//	echo $cta_vef.encadenar(2).$cod_cre.encadenar(2).$dias.encadenar(2);
	 	
		
   //$cta_vef= $cta_venf;
   $con_mon = "Select GRAL_PAR_INT_SIGLA From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD = $mon";
       $res_mon = mysql_query($con_mon);
	   while ($linea = mysql_fetch_array($res_mon)) {
	        $d_mon = $linea['GRAL_PAR_INT_SIGLA'];
	   }
	$nom_grp = "";   
 if ($c_grup > 0 ) {
	$con_grp = "Select CRED_GRP_NOMBRE From cred_grupo where CRED_GRP_CODIGO = $c_grup and CRED_GRP_USR_BAJA is null";
        $res_grp = mysql_query($con_grp);
	    while ($lin_grp = mysql_fetch_array($res_grp)) {
	        $nom_grp = $lin_grp['CRED_GRP_NOMBRE'];
			$_SESSION['grupo'] = $nom_grp;
			
			}
}
	  $con_est  = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_SIGLA  From gral_param_propios where GRAL_PAR_PRO_GRP = 809 and GRAL_PAR_PRO_COD = $estado";
      $res_est = mysql_query($con_est);
	  while ($linea = mysql_fetch_array($res_est)) {
	  $d_est = $linea['GRAL_PAR_PRO_DESC'];
	  $s_est =  $linea['GRAL_PAR_PRO_SIGLA'];
	  }  	

	//Datos del cart_det_tran	
				
	$con_tde = "Select CART_DTRA_IMPO From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 1 
	            AND CART_DTRA_FECHA <= '$f_pro' and CART_DTRA_CCON = 131 and CART_DTRA_USR_BAJA is null";
    $res_tde = mysql_query($con_tde);
	    while ($lin_tde = mysql_fetch_array($res_tde)) {
	        $mon_tde = $lin_tde['CART_DTRA_IMPO'];
			$tot_tde = $tot_tde + $mon_tde;
			
			//$tot_cta = $tot_cta + 1;
			}
			//echo $tot_tde.encadenar(2);		
	$con_tpa = "Select CART_DTRA_IMPO From cart_det_tran where CART_DTRA_NCRE = $cod_cre and CART_DTRA_TIP_TRAN = 2 AND
	            CART_DTRA_FECHA <= '$f_pro' and (CART_DTRA_CCON BETWEEN 131 AND 134) 
	            and CART_DTRA_USR_BAJA is null";
    $res_tpa = mysql_query($con_tpa);
	
	    while ($lin_tpa = mysql_fetch_array($res_tpa)) {
	        $mon_tpa = $lin_tpa['CART_DTRA_IMPO'];
			$tot_tpa = $tot_tpa + $mon_tpa;
			
			}
			//echo $tot_tpa.encadenar(2);
			
		
	$esta_act = 0;		
	$cta_tipa = 0;
	$cta_act = 0;
	$esta_nue = 0;
	$cta_tipn = 0;
	$cta_nue = 0;
	
	// if (($tot_tde - $tot_tpa) > 0){
	 //   echo $tot_tde.encadenar(2).$tot_tpa.encadenar(2).$estado;
	     	//echo $cod_cre.encadenar(2).$cta_venf.encadenar(2).encadenar(2).$f_pro.encadenar(2)
	//.$tot_tde.encadenar(2).$tot_tpa.encadenar(2).$estado;	
	?>
	
	<?php 				
	//}
     if ($dias > 90){
	     //if ($cta_venf <= $f_pro){
		    $esta_act = $estado;
		    $cta_act = leer_cta_car(1,$t_oper,$esta_act,$mon);
            $cta_tipa =  leer_cta_tip(1,$t_oper,$esta_act,$mon);
		    
			$esta_nue = 7;
			$d_nuev = "EJE";
			$cta_nue = leer_cta_car(1,$t_oper,$esta_nue,$mon);
            $cta_tipn =  leer_cta_tip(1,$t_oper,$esta_nue,$mon);
			//echo $est_nuev.encadenar(2).$cod_cre;
		// }
	   }	 
	/* 
	    */
	   			
if ($esta_nue > 0) { 				
$saldo = $saldo + (	$tot_tde - $tot_tpa);
$sal = $tot_tde - $tot_tpa;
$tot_des = $tot_des + $tot_tde;	

if ($tot_tde > 0 ){	
	 $consulta = "insert into temp_trasp (fecha, 
                                         moneda,
									     credito,
									     cliente,
										 grupo,
									     esta_act,
					                     cta_act,
					                     cta_tipa,
   				                         esta_nue,
					                     cta_nue, 
									     cta_tipn, 
									     fecha_vto, 
									     saldo,
										 dias_mora
                                         ) values ('$f_pro',
										            $mon,
										            $cod_cre,
													'$nom_cli',
									                '$nom_grp',            
												    $esta_act,
					                                '$cta_act',
					                                $cta_tipa,
   				                                    $esta_nue,
					                                '$cta_nue', 
									                $cta_tipn,
													'$cta_venf',
												    $sal,
													$dias
 											        )";
$resultado = mysql_query($consulta); 
          }
       }
	}
?>

<center>
	 <table border="1" width="900">
	
	<tr>
	    <th align="center">Nro</th>  
	   	<th align="center">Nro. Crédito</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Estado Actual</th>
		<th align="center">Estado Nuevo</th>
		<th align="center">Fecha Vto. Actual</th>
		<th align="center">Saldo </th>
		<th align="center">Dias de Mora </th>
  </tr>	
<?php
// Leer temp_trasp	
$mone = 0;
$d_mone = "";
$nro = 0;
$con_tras = "Select * From temp_trasp order by moneda, esta_act";
$res_tras = mysql_query($con_tras);
	
	    while ($lin_tras = mysql_fetch_array($res_tras)) {
	        $nro = $nro + 1;
			$f_vto = cambiaf_a_normal($lin_tras['fecha_vto']); 
			if ($lin_tras['esta_act'] == 3) {
	           $est_act = "Vigente";
			   }
			if ($lin_tras['esta_act'] == 6) {
	           $est_act = "Vencido";
			   } 
			if ($lin_tras['esta_act'] == 7) {
	           $est_act = "Ejecucion";
			   }    
			if ($lin_tras['esta_nue'] == 3) {
	           $est_nue = "Vigente";
			   }
			if ($lin_tras['esta_nue'] == 6) {
	           $est_nue = "Vencido";
			   } 
			if ($lin_tras['esta_nue'] == 7) {
	           $est_nue = "Ejecucion";
			   }   
			if ($lin_tras['moneda'] == 1) { 
			    $d_mone = "BOLIVIANOS";
				}else{
				$d_mone = "DOLARES";
				}     
			if ($lin_tras['moneda'] <> $mone) {
	           $mone = $lin_tras['moneda'];	?>
			   
	<tr>
	    <th align="center"><?php echo encadenar(3); ?></th>  
	   	<th align="center"><?php echo encadenar(5); ?></th> 
		<th align="center"><?php echo 'MONEDA'; ?></th>           
	    <th align="center"><?php echo $d_mone; ?></th>
		<th align="center"><?php echo encadenar(5); ?></th>
		<th align="center"><?php echo encadenar(5); ?></th>
		<th align="center"><?php echo encadenar(5); ?></th>
		<th align="center"><?php echo encadenar(5); ?> </th>
  </tr>	
  <?php } ?> 
<tr>
	    <td align="right" ><?php echo number_format($nro, 0, '.',','); ?></td>
	 	<td align="left" ><?php echo $lin_tras['credito']; ?></td>
	    <td align="left" ><?php echo $lin_tras['cliente']; ?></td>
		<?php
		if ($lin_tras['grupo'] <> ""){
		?>
		<td align="left" ><?php echo $lin_tras['grupo']; ?></td>
		<?php
		 }else{
		?> 
		<td align="left" ><?php echo encadenar(5); ?></td>
		<?php
		 }
		?> 
		<td align="center" ><?php echo $est_act; ?></td>
		<td align="center" ><?php echo $est_nue; ?></td>
		<td align="center" ><?php echo $f_vto; ?></td>
		<td align="right" ><?php echo number_format($lin_tras['saldo'], 2, '.',','); ?></td>
		<td align="center" ><?php echo $lin_tras['dias_mora']; ?></td>
	</tr>	
	<?php
		}
    ?>
	
</table>
		  
<br>
</select>
   <br> <br>
  <input class="btn_form" type="submit" name="accion" value="Reporte">
  <input class="btn_form" type="submit" name="accion" value="Continuar">




</div>
</div>
<?php
		}
		 	include("footer_in.php");
		 ?>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

