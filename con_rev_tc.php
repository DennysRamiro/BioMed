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
<title><?php echo $_SESSION['COD_EMPRESA']; ?></title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script>
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
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_reval">
                    
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO  REVAL.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASI. REVALORIZADO
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
<h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">ASIENTO DE REVALORIZADO </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Seleccionar Asiento Contable
        </div--> 


	<!--div id="cuerpoModulo"-->

	

				<?php
					 //$fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
	          <form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidarRangoFechas(this)">
	
<?php

//if ($_SESSION['continuar'] == 1){
    $_SESSION['cuantos'] = 0;
	$_SESSION['saldo'] = 0;
	$_SESSION['saldo_sus'] = 0;
    $borr_cob  = "Delete From temp_ctable3 "; 
    $cob_borr = mysql_query($borr_cob);
  
     //  }
   
    
//if ($_SESSION['continuar'] == 2){

?>
 
<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];
//$cuantos = 0;
$m_debe_1 = 0;
$m_haber_1 = 0;
$m_debe_2 = 0;
$m_haber_2 = 0;
$t_debe_1 = 0;
$t_haber_1 = 0;
$t_debe_2 = 0;
$t_haber_2 = 0;
$mon_cta = 0;
$saldo = 0;
$saldo_sus = 0;
$sal_1 = 0;
$sal_2 = 0;

/*if ($_SESSION['tipo'] == 1) {
      if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
		  $des_cta = leer_cta_des($cod_cta);
	  $saldo = sal_mayor($cod_cta,$fec_de2,1);
	  $_SESSION['saldo'] = $saldo;
	  if ($mon_cta == 2){
	     $saldo_sus = sal_mayor($cod_cta,$fec_de2,2);
		 $_SESSION['saldo_sus'] = $saldo_sus;
		 }
	  }	//4b
 } */
//if ($_SESSION['tipo'] == 2) {
      if ($_POST['tc_contab'] > 0){ //4a  
	     $con_nue = $_POST['tc_contab'];
		$_SESSION['con_nue'] = $con_nue; 
	  }	//4b
 //}	  
      if ($_POST['tc_compra'] > 0){ //4a  
	     $com_nue = $_POST['tc_compra'];
		 $_SESSION['com_nue'] = $com_nue; 
	  }
      if ($_POST['tc_venta'] > 0){ //4a  
	     $ven_nue = $_POST['tc_venta'];
		 $_SESSION['ven_nue'] = $ven_nue; 
		// $mon_cta = $cod_cta[5]; 
	  }
	 
	 
	  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	  $cuantos = $_SESSION['cuantos'];
	echo encadenar(15). "Revalorizacion";
	    
		 ?>	
	    <br>
		
	<?php
	echo encadenar(15).
	   
		 encadenar(2)."al".encadenar(2).$fec;
		// $_SESSION['des_cta'] = $des_cta;
		
	?>	
	    <br>
		<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">

 <table width="100%"  border="0" align="center" class="table_usuario">
    <tr>
	 
	  <th scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />SALDO ORIGINAL $us</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />Bs. a T.C. 
	                                               <br><?php echo $_SESSION['TC_CONTAB']; ?> </th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />Bs. a T.C. 
	                                               <br><?php echo $con_nue; ?> </th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />AJUSTE </th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />CUENTA <br>
	                                                                         REVALORIZACION </th>
	</tr>
	<?php
	 $con_tran = "Select  DISTINCT CONTA_TRS_CTA From contab_trans 
		    	  where substring(CONTA_TRS_CTA,6,1) = 2 and (substring(CONTA_TRS_CTA,1,1) = 1
				  or substring(CONTA_TRS_CTA,1,1) = 2)";
			  
	 $res_tran = mysql_query($con_tran);
	
	while ($lin_tran = mysql_fetch_array($res_tran)) {
	      $monto_d = 0;
		  $monto_h = 0;
		  $saldo = 0;
		  $cod_cta = $lin_tran['CONTA_TRS_CTA'];
		  $tipo = substr($cod_cta,0,1);
		  $des_cta = leer_cta_des($cod_cta);
		  $glosa = "ASIENTO DE REVALORIZACION";
		  $con_ctad  = "Select CONTA_CTA_AITB From contab_cuenta where CONTA_CTA_NRO = $cod_cta ";
          $res_ctad = mysql_query($con_ctad);
        	while ($lin_ctad = mysql_fetch_array($res_ctad)) {
	              $cta_rev = $lin_ctad['CONTA_CTA_AITB'];
          }
		//  echo 	$tipo. "Tipo";
		  $saldo = sal_mayor2( $cod_cta,$fec1,1,2011);
		  $saldo = round($saldo,2);
	      $dol_orig = $saldo /$_SESSION['TC_CONTAB'];
		  $nuev_bs =  $dol_orig * $con_nue;
		  $ajuste = $nuev_bs - $saldo;
			//echo $monto_h." ** deb **".	$monto_d. " ** hab **".$fec1." ***cta **".$cod_cta; 
		if ($saldo <> 0){	 	 						  
		  $consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta, 
										  temp_cuenta,
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  (0,
										   '$cta_rev',
										  '$cod_cta',
									       '$glosa',
										    $saldo,
										   $dol_orig,
										   $nuev_bs,
										   $ajuste)";
										   
    $resultado = mysql_query($consulta);
	}
}	  
				  
  /*
	 $con_tran2 = "Select * From contab_trans 
		    	 where CONTA_TRS_CTA = '$cod_cta'
			      and (CONTA_TRS_FEC_VAL between '$fec_de2' and '$fec_ha2') order by CONTA_TRS_FEC_VAL";
			  
	 $res_tran2 = mysql_query($con_tran2)or die('No pudo seleccionarse tabla contab_trans 4');
		
        while ($lin_tran2 = mysql_fetch_array($res_tran2)) {
	          $mon_cta =  $_SESSION['cod_mon'];
	  //   echo "entra 2";
	        
			if ($saldo < 0){
			    $saldo = $saldo * -1;
				}
			if ($saldo_sus < 0){
			    $saldo_sus = $saldo_sus * -1;
				}
			$sal_1 = $saldo;
			$sal_2 = $saldo_sus;	
						
	        $m_debe_1 = 0;
            $m_haber_1 = 0;
            $m_debe_2 = 0;
            $m_haber_2 = 0;
			$cod_cta = $lin_tran2['CONTA_TRS_CTA'];
			
	        $nro_doc = $lin_tran2['CONTA_TRS_NRO'];
			$impo = $lin_tran2['CONTA_TRS_IMPO'];
			$impo_equiv = $lin_tran2['CONTA_TRS_IMPO_E'];
	        $deb_hab = $lin_tran2['CONTA_TRS_DEB_CRED'];	
			$glosa = $lin_tran2['CONTA_TRS_GLOSA'];
			$fec_tran = $lin_tran2['CONTA_TRS_FEC_VAL'];	
			$fec_tra = cambiaf_a_normal($fec_tran);
			 $_SESSION['cod_cta'] = $cod_cta;
		  $des_cta = leer_cta_des($cod_cta);
	//		echo $glosa, $impo,"entra";		 
			if ($mon_cta == 1){
			    if ($deb_hab == 1){
				  //  $sal_1 = $sal_1 + $impo;
			 	    $m_debe_1 = $impo;
                    $m_haber_1 = 0;
                    $m_debe_2 = 0;
                               $m_haber_2 = 0; 
						    }
				if ($deb_hab == 2){
				  //  $sal_1 = $sal_1 - $impo;
				    $m_debe_1 = 0;
                    $m_haber_1 = $impo;
                    $m_debe_2 = 0;
                    $m_haber_2 = 0; 
						    }
	        			}
						if ($mon_cta == 2){
						    
						    if ($deb_hab == 1){
							   $m_debe_1 = $impo;
                               $m_haber_1 = 0;
                               $m_debe_2 = $impo_equiv;
                               $m_haber_2 = 0; 
						    }
							if ($deb_hab == 2){
							   $m_debe_1 = 0;
                               $m_haber_1 = $impo;
                               $m_debe_2 = 0;
                               $m_haber_2 = $impo_equiv; 
						    }
	        			}
						
	$consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta, 
										  temp_cuenta,
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($nro_doc,
										   '$fec_tra',
										  '$cod_cta',
									       '$glosa',
										   $m_debe_1,
										   $m_haber_1,
										   $m_debe_2,
										   $m_haber_2)";
										   
    $resultado = mysql_query($consulta)or die('No pudo insertar temp_ctable3 1 : ' . mysql_error());
	}
	} */
	$consulta  = "Select * From temp_ctable3 order by temp_cuenta,temp_tip_tra";
    $resultado = mysql_query($consulta);
	
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	$cuenta1 = "";
	$cuenta2 = "";
	while ($linea = mysql_fetch_array($resultado)) {
	  
	      $cuenta2 = $linea['temp_cuenta'];
//	if ($cuenta1 <> $cuenta2){
	       $des_cta = leer_cta_des($cuenta2);
//		    $saldo = sal_mayor( $cuenta2,$fec_de2,1);
//			$sal_1 = $saldo;
//			 $saldo_sus = sal_mayor($cuenta2,$fec_de2,2);
//			$sal_2 = $saldo_sus;
//	  $_SESSION['saldo'] = $saldo;
//	   $_SESSION['saldo_sus'] = $saldo_sus; ?>
	  
	
		   
		   
	
	
	<?php
	//}
	
	
    
	
	      $tip_cta = $cuenta2[0];
 	  if ($tip_cta == 1){  
	      $sal_1 = $sal_1 + $linea['temp_debe_1'] - $linea['temp_haber_1'];
		  $sal_2 = $sal_2 + $linea['temp_debe_2'] - $linea['temp_haber_2'];	 
	   } 
	     
       if ($tip_cta == 4){  
	      $sal_1 = $sal_1 + $linea['temp_debe_1'] - $linea['temp_haber_1'];
		  $sal_2 = $sal_2 + $linea['temp_debe_2'] - $linea['temp_haber_2'];	 
	   }   
	   if ($tip_cta == 2){  
	      $sal_1 = $sal_1 - $linea['temp_debe_1'] + $linea['temp_haber_1'];
		  $sal_2 = $sal_2 - $linea['temp_debe_2'] + $linea['temp_haber_2'];	 
	   } 
	   if ($tip_cta == 5){  
	      $sal_1 = $sal_1 - $linea['temp_debe_1'] + $linea['temp_haber_1'];
		  $sal_2 = $sal_2 - $linea['temp_debe_2'] + $linea['temp_haber_2'];	 
	   } 
	   
	   
	   
	      $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
		  
	      <tr>
		     
			  <td align="left" style="font-size:12px"><?php echo $linea['temp_cuenta']; ?></td>
	 	      <td align="left" style="font-size:12px"><?php echo utf8_encode($des_cta); ?></td>
			  <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td> 
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_debe_2'] - $linea['temp_debe_1']
			  , 2, '.',','); ?></td>
			  <td align="center" style="font-size:12px"><?php echo $linea['temp_nro_cta']; ?></td>
	     </tr>
	
     <?php } ?>
         
     </table>
     <center>
	 <br> 
	 <input class="btn_form" type="submit" name="accion" value="Asiento Contable">
     <!--input type="submit" name="accion" value="Salir"-->

</form>	
 <?php //} //1b?>
<?php
/*    
if ($_SESSION['continuar'] == 3){
    if ($_SESSION['detalle'] == 3){
       $consulta  = "Select * From temp_ctable3";
       $resultado = mysql_query($consulta);
       $tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
       $con_temp = "Select * From temp_ctable3";
       $res_temp = mysql_query($con_temp);
	   while ($lin_temp = mysql_fetch_array($res_temp)) {
             $tot_debe_1 = $tot_debe_1 +$lin_temp['temp_debe_1'];
	         $tot_haber_1 = $tot_haber_1 +$lin_temp['temp_haber_1'];
	    }
			
	if ($tot_debe_1 <> $tot_haber_1) {	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Modificar</th>
	</tr>

    <?php
	$tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
     while ($linea = mysql_fetch_array($resultado)) {
            $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	        $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	        //$tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	        //$tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			<td><INPUT NAME="nlin" TYPE=RADIO VALUE="<?php echo $nro_lin; ?>">	</td> 
	     </tr>
	
    <?php }
	
	   echo "No iguala Debe y Haber Revise y Modifique ......... ";  ?>
	    <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
	   </table>
	<center>
	 <input type="submit" name="accion" value="Modificar">
     <input type="submit" name="accion" value="Salir">
	   
	<?php    
	   
    }else{
  
  	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
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
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	    </tr>
	
    <?php }
	
	   echo "Revise Bien antes de Imprimir ......... ";
    
  
  ?>
   <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
  
  	</table>
	<center>
	 <input type="submit" name="accion" value="Imprimir">
     <input type="submit" name="accion" value="Salir">

</form>	
 <?php
 }
  }
} 
*/
/*
if ($_SESSION['continuar'] == 4){ //1 a
   if(isset($_POST['nlin'])){ //2a
     $nlin = $_POST['nlin'];
	 $_SESSION['nlin'] = $nlin;?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
  <?php
	 $consulta  = "Select * From temp_ctable3 where temp_tip_tra = $nlin";
     $resultado = mysql_query($consulta);
	 while ($linea = mysql_fetch_array($resultado)) { //3a
	       $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
           $res_ctas = mysql_query($con_ctas)or die('No pudo seleccionarse contab_cuenta')  ; ?>
	 	 
	 <table align="center">
     <tr>
	    <th align="left">Glosa :</th>
		<?php if (isset ($_SESSION['descrip'])){?>
		<td align="left"><?php echo $_SESSION['descrip']; ?> </td>`
		<?php } //3b ?>
	 </tr>
	 <tr> 
      <th align="left">Cuenta Contable :</th>
	  <td><?php echo $linea['temp_nro_cta'].encadenar(2).$linea['temp_des_cta']; ?></td>
	 </tr>
     <tr> 
      <th align="left">Cuenta Contable :</th>
	  <td> <select name="cod_cta" size="1"  >
	       <?php while ($lin_cta = mysql_fetch_array($res_ctas)) { //4a ?>
           <option value=<?php echo $lin_cta['CONTA_CTA_NRO']; ?>>
		                 <?php echo $lin_cta['CONTA_CTA_NRO']; ?>
			              <?php echo $lin_cta['CONTA_CTA_DESC']; ?></option>
           <?php } //4b?>
		    </select></td>
    </tr>
	<tr> 
         <th align="left" >Monto :</th>
		 <td align="left"><?php echo number_format($linea['temp_debe_1']+
		                                            $linea['temp_haber_1'], 2, '.',',') ; ?></td>
    </tr>	  
    <tr> 
         <th align="left" >Monto :</th>
		 <td><input  type="text" name="egr_monto"> </td>
    </tr>
    <tr>
	<th align="left">Aplicacion :</th>
	     <?php if ($linea['temp_debe_1'] > 0) {  //5a?>
		 <td><?php echo "Debe"; ?></td>
		 <?php } //5b?>
		 <?php if ($linea['temp_haber_1'] > 0) { //6a ?>
		 <td><?php echo "Haber"; ?></td>
		 <?php } //6b?>
	</tr>	
	<th align="left">Aplicacion :</th>
		 <td><select name="deb_hab" >
	         <option>Debe</option>
	         <option>Haber</option>
	         </select></td>
	</tr>	
	
  </table>
  <center>
   <input type="submit" name="accion" value="Grab_modi">
     <input type="submit" name="accion" value="Salir">

</form>	
  
  
  
	 
	 <?php }  //2b
	 
	 
	 
	 
	 
	  //}else{
	 //$_SESSION['continuar'] = 1;
	 //$_SESSION['calculo'] == 1; 
	// header('Location:cobro_pag_det_gd.php');
	 }  //1b
    // if(isset($_SESSION['grupo'])){
    //   $nom_grp =$_SESSION['grupo'];
	//   }
  }	*/// 1 b 
/*  
if ($_SESSION['continuar'] == 5){ //1a
     $nlin = $_SESSION['nlin'];
     if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
	  }	//4b
      if ($_POST['deb_hab'] <> ""){ //5a  
	     $deb_hab = $_POST['deb_hab'];
	  	 $_SESSION['deb_hab'] = $deb_hab;
	  } //5b
      if ($_POST['egr_monto'] > 0){ //6a  
	     $monto_t = ($_POST['egr_monto']);
	     $_SESSION['monto_t'] =  $monto_t;
      } //6b
      if ($deb_hab == "Debe"){ //7a     
         $m_debe_1 = $monto_t;
	     $m_haber_1 = 0;
	     }else{
	     $m_debe_1 = 0;
	     $m_haber_1 = $monto_t;
	     } //7b
      if ($mon_cta == 2){ //8a
	     if ($deb_hab == "Debe"){ //9a     
            $m_debe_2 = $monto_t / $tc_ctb;
	        $m_haber_2 = 0;
	        }else{
	        $m_debe_2 = 0;
	        $m_haber_2 = $monto_t / $tc_ctb;
	        } //8b
          } //9b
	
      $des_cta = leer_cta_des($cod_cta);
	//  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	 // $cuantos = $_SESSION['cuantos'];
//echo $descrip.encadenar(2).$cod_cta.encadenar(2).$deb_hab.encadenar(2).$monto_t;	
	  $consulta = "update temp_ctable3 set temp_nro_cta =$cod_cta, 
                                          temp_des_cta ='$des_cta',
						 	              temp_debe_1 = $m_debe_1,
									      temp_haber_1 = $m_haber_1,
										  temp_debe_2 = $m_debe_2,
									      temp_haber_2 = $m_haber_2 
										  where temp_tip_tra = $nlin";
										   
    $resultado = mysql_query($consulta)or die('No pudo actualizar temp_ctable3 1 : ' . mysql_error());
	
	$consulta  = "Select * From temp_ctable3";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	?>
	<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr>
	
	<?php
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
	     </tr>
	
     <?php }?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
     </table>
     <center>
	    
	 <input type="submit" name="accion" value="Grabar">
     <input type="submit" name="accion" value="Salir">

</form>	
 <?php $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   
		   require 'con_asiento.php';
 } */ //1b?>
	
	
	 
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