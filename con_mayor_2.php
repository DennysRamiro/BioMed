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
<title>Mayor de Cuentas</title>
	
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/contabilidad_reportes.js"></script> 

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
        <script type="text/javascript" src="js/Utilitarios.js"></script> 

</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Desde no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Hasta no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Desde no puede ser mayor que la Fecha Hasta.</font></p>
</div>
<div id="dialog-confirm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Desde no puede ser mayor a la Fecha Actual.</font></p>
</div>
<div id="dialog-confirm5" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Hasta no puede ser mayor a la Fecha Actual.</font></p>
</div>
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
                 <?php if($_SESSION['menu'] == 47){?> 
                  <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>

                  <li id="menu_modulo_conta_rep_cta">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MAYOR DE CUENTAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/credit card_24x24.png" border="0" alt="Modulo" align="absmiddle"> MAYOR POR MONEDAS
                    
                 </li>

              </ul>  
              <div id="contenido_modulo">


                      <h2> <img src="img/credit card_64x64.png" border="0" alt="Modulo" align="absmiddle"> MAYOR POR MONEDAS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                         Ingrese la fecha de c&aacute;lculo para ver Mayor por Monedas.
                      </div>
          		 <?php } elseif($_SESSION['menu'] == 50){?> 
          		  <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
             		</li>
                    <li id="menu_modulo_cont_reportesotro">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                </li>

                  <li id="menu_modulo_conta_rep_ctaotro">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MAYOR DE CUENTAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/credit card_24x24.png" border="0" alt="Modulo" align="absmiddle"> MAYOR POR MONEDAS
                    
                 </li>

              </ul>  
              <div id="contenido_modulo">


                      <h2> <img src="img/credit card_64x64.png" border="0" alt="Modulo" align="absmiddle"> MAYOR POR MONEDAS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                          Ingrese la fecha de c&aacute;lculo de la gesti&oacute;n para ver Mayor por Monedas.
                      </div>

                  <?php }?>
				<?php
					 $fec = $_SESSION['fec_proc']; // leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>


	          <form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidarRangoFechas(this)">
	
<?php

if ($_SESSION['continuar'] == 1){
    $_SESSION['cuantos'] = 0;
	$_SESSION['saldo'] = 0;
	$_SESSION['saldo_sus'] = 0;
    $borr_cob  = "Delete From temp_ctable3 "; 
    $cob_borr = mysql_query($borr_cob);
  
     $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon); ?>

	<center>
	<table align="center" border="0">
		<br>
<tr>
<td><strong>Fecha Desde:</strong></td>
<td> <input class="txt_campo" type="text" name="fec_des" id="datepicker" maxlength="10"  size="10" > </td>
</tr>
<tr>
<td><strong>Fecha Hasta:</strong></td>
<td><input class="txt_campo" type="text" name="fec_has" id="datepicker2" maxlength="10"  size="10" > </td>
</tr>
<tr>
<td><strong>Moneda: </strong></td>
<td> <?php //echo encadenar(8);?>
            <select name="cod_mon" size="1"  >
            	
   	         <?php while ($linea = mysql_fetch_array($res_mon)) {?>
             <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	         <?php } ?>
		     </select></td>
</tr>
    </table>
	 
	    
	
	 	<table align="center" border="0">
	 		<br>
	 <tr>
	<?php if($_SESSION['menu'] == 47){?>
	<td> <input class="btn_form" type="submit" name="accion" value="Consultar"></td> 
	 <?php } elseif($_SESSION['menu'] == 50){?> 
	 <td><input class="btn_form" type="submit" name="accion" value="Consultar Reporte"></td>
	    <?php  } ?>
	</tr>
	 </table>
  </form>	
  </center>	
<?php  }
   
    
if ($_SESSION['continuar'] == 2){

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
      if ($_POST['cod_mon'] <> ""){ //4a  
	     $cod_mon = $_POST['cod_mon'];
		// $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_mon'] = $cod_mon;
		 if ($cod_mon == 1){
		     $des_mon = "Bolivianos";
		 }	 
		  if ($cod_mon == 2){
		     $des_mon = "Dolares";
		 }	
		  
	  }	//4b
 //}	  
     if (isset ($_POST['fec_des'])){
	     $fec_des = $_POST['fec_des'];
		 $fec_de2 = cambiaf_a_mysql_2($fec_des);
	 }
     if (isset ($_POST['fec_has'])){
	     $fec_has = $_POST['fec_has'];
		 $fec_ha2 = cambiaf_a_mysql_2($fec_has);
	 }
	 
	 
	  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	  $cuantos = $_SESSION['cuantos'];
	echo encadenar(15). "Detalle Movimientos Cuentas en".encadenar(2).$des_mon.encadenar(2);
	    
		 ?>	
	    <br>
		
	<?php
	echo encadenar(15).
	    encadenar(2)."del".encadenar(2).$fec_des.
		 encadenar(2)."al".encadenar(2).$fec_has;
		// $_SESSION['des_cta'] = $des_cta;
		 $_SESSION['fec_des'] = $fec_des;
		 $_SESSION['fec_has'] = $fec_has;
	?>	
	    <br>
		<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">

 <table width="100%"  border="0" align="center">
    <tr>
	  <th scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />Nro Doc</th>
	  <th scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />Fecha</th>
	  <th width="40%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />SALDO Bs.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col" style="font-size:11px"><border="0" alt="" align="absmiddle" />SALDO $us.</th>
	  
	</tr>
	<?php
	 $con_tran = "Select  DISTINCT CONTA_TRS_CTA From contab_trans 
		    	  where substring(CONTA_TRS_CTA,6,1) = '$cod_mon'
			      and (CONTA_TRS_FEC_VAL between '$fec_de2' and '$fec_ha2') 
				  ";
			  
	 $res_tran = mysql_query($con_tran);
	
	while ($lin_tran = mysql_fetch_array($res_tran)) {
		  $cod_cta = $lin_tran['CONTA_TRS_CTA'];
  
	 $con_tran2 = "Select * From contab_trans 
		    	 where CONTA_TRS_CTA = '$cod_cta'
			      and (CONTA_TRS_FEC_VAL between '$fec_de2' and '$fec_ha2')
				  and CONTA_TRS_USR_BAJA is null order by CONTA_TRS_FEC_VAL";
			  
	 $res_tran2 = mysql_query($con_tran2);
		
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
										   
    $resultado = mysql_query($consulta);
	}
	}
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
	if ($cuenta1 <> $cuenta2){
	       $des_cta = leer_cta_des($cuenta2);
		    $saldo = sal_mayor( $cuenta2,$fec_de2,1);
			$sal_1 = $saldo;
			 $saldo_sus = sal_mayor($cuenta2,$fec_de2,2);
			$sal_2 = $saldo_sus;
	  $_SESSION['saldo'] = $saldo;
	   $_SESSION['saldo_sus'] = $saldo_sus; ?>
	  
	<?php   if ($cuenta1 <> ""){ ?>
	  
	   
		<tr></tr>   
		 <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th align="left" style="font-size:12px"><?php echo encadenar(5); ?></td> 
		     <th align="center"><?php echo "Saldo Final"; ?></th>
		     <th align="right" style="font-size:12px" ><?php echo number_format( $tot_debe_1, 2, '.',','); ?></td> 
		     <th align="right" style="font-size:12px"><?php echo number_format($tot_haber_1, 2, '.',','); ?></td> 
			 <th align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',','); ?></td>
			 <th align="right" style="font-size:12px"><?php echo number_format( $tot_debe_2, 2, '.',','); ?></td>
		     <th align="right" style="font-size:12px"><?php echo number_format($tot_haber_2, 2, '.',','); ?></td> 
			 <th align="right" style="font-size:12px"><?php echo number_format(0, 2, '.',','); ?></td>
		   </tr>
	 <?php  
	 $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	 
	 
	 } ?>   
		   
		   
	<tr></tr>
	<tr>
	   <th align="left" style="font-size:14px"><?php echo $cuenta2; ?></td> 
	 	<td align="left" style="font-size:12px"><?php echo encadenar(10); ?></td>
		<th align="left" style="font-size:14px"><?php echo $des_cta; ?></td>
	</tr>
	<tr></tr>	
		<?php 
	$cuenta1 = $cuenta2;
	
	?>
	
	<tr>
	   <td align="left" style="font-size:12px"><?php echo encadenar(5); ?></td> 
	 	<td align="left" style="font-size:12px"><?php echo encadenar(10); ?></td>
		<td align="left" style="font-size:12px"><?php echo "Saldo al ".$fec_has; ?></td>
		<td align="right" style="font-size:12px">
		<?php echo encadenar(5); ?></td>
		<td align="right" style="font-size:12px">
		<?php echo encadenar(5); ?></td>
		<td align="right" style="font-size:12px">
		<?php echo number_format($saldo, 2, '.',','); ?></td>
		<td align="right" style="font-size:12px">
		<?php echo encadenar(5) ; ?></td>
		<td align="right" style="font-size:12px">
		<?php echo encadenar(5); ?></td>
		<td align="right" style="font-size:12px">
		<?php echo number_format($saldo_sus, 2, '.',','); ?></td>
	 </tr>
	
	<?php
	}
	
	
    
	
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
		      <td align="left" style="font-size:12px"><?php echo $linea['temp_tip_tra']; ?></td>
			  <td align="left" style="font-size:12px"><?php echo $linea['temp_nro_cta']; ?></td>
	 	      <td align="left" style="font-size:12px"><?php echo $linea['temp_des_cta']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
			  <td align="right" style="font-size:12px"><?php echo number_format($sal_1, 2, '.',','); ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right" style="font-size:12px"><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			  <td align="right" style="font-size:12px"><?php echo number_format($sal_2, 2, '.',','); ?></td>
	     </tr>
	
     <?php } ?>
         
     </table>
     <center>
	    
	 <input class="btn_form" type="submit" name="accion" value="Imprimir Mayor">
     <input class="btn_form" type="submit" name="accion" value="Salir">

</form>	
 <?php } //1b?>
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
           $res_ctas = mysql_query($con_ctas) ; ?>
	 	 
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
										   
    $resultado = mysql_query($consulta);
	
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
 
</div> 
<?php
	include("footer_in.php");
		 ?>
</body>
</html>
<?php
}
ob_end_flush();
 ?>