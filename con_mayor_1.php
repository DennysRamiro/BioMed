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
<script type="text/javascript" src="js/contabilidad_reg_rev_reg.js"></script>

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

                 <?php if($_SESSION['menu'] == 46){?> 

                  <li id="menu_modulo_cont_reportes">

                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
				    <li id="menu_modulo_conta_rep_cta">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MAYOR DE CUENTAS                 
				 </li>
				 
				 <li id="menu_modulo_fecha">
                    
                     <img src="img/user office_24x24.png" border="0" alt="Modulo" align="absmiddle">  MAYOR X CTA.
                    
                 </li>
                  
              </ul>  
              <div id="contenido_modulo">

                      <h2> <img src="img/user office_64x64.png" border="0" alt="Modulo" align="absmiddle"> MAYOR POR CUENTA</h2>

                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                         Ingrese la fecha de c&aacute;lculo para ver Mayor por Cuenta.
                      </div>

                <?php } elseif($_SESSION['menu'] == 49){?> 
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
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle">  MAYOR X CTA.
                    
                 </li>
                  
              </ul>  
              <div id="contenido_modulo">

                      <h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle"> MAYOR POR CUENTA</h2>

                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                          Ingrese la fecha de c&aacute;lculo para ver Mayor por Cuenta.
                      </div>

                       <!--input class="btn_form" type="submit" name="accion2" value="Consultar"-->
                      <?php }?>
           	<?php
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();
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
  
    $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
    $res_ctas = mysql_query($con_ctas); ?>

	<center> 
	<table align="center" border="0">
		<br>
	<tr>	
		 <th align="left">Fecha Desde:</th>
		<th align="left"><input class="txt_campo" type="text" name="fec_des" id="datepicker" maxlength="10"  size="10" > </th>
	</tr>
	<tr>
		<th align="left">Fecha Hasta:</th>
     <th align="left"><input class="txt_campo" type="text" name="fec_has" id="datepicker2" maxlength="10"  size="10" > </th>
	</tr>
	<tr>
  
   <!--   <th align="left">Cuenta Contable :</th>
	  <th align="left"> <select name="cod_cta1" size="1" style="width:400px;" >
	  
	       <?php while ($lin_cta = mysql_fetch_array($res_ctas)) { ?>
           <option value=<?php echo $lin_cta['CONTA_CTA_NRO']; ?>>
		                 <?php echo $lin_cta['CONTA_CTA_NRO']; ?>
			              <?php echo utf8_encode($lin_cta['CONTA_CTA_DESC']); ?></option>
           <?php } ?>
		    </select></th>-->
			 <tr>
				 <th align="left">Cuenta Contable:</th>
				 <td><input class="txt_campo_cta" type="text" name="cuenta_busca_datos" id="cuenta_busca_datos"/>
                                            <input class="txt_campo" type="hidden" name="cod_cta" id="cod_cta" /></td>
				 </tr>
    </tr>
	</table>
	<table align="center" border="0">
		<br>
	 <tr>
	 	<?php if($_SESSION['menu'] == 46){?>
	   <td><input class="btn_form" type="submit" name="accion" value="Consultar"></td>
	     <?php } elseif($_SESSION['menu'] == 49){?> 
	    <td><input class="btn_form" type="submit" name="accion" value="Consultar Reporte"></td>
	    <?php  } ?>
	 </tr>
	 </table>
  </form>
  </center>	
  <?php  }
   
    
if ($_SESSION['continuar'] == 2){

?>
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

//if ($_SESSION['tipo'] == 1) {
      if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
		
	  }	//4b
// }

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
	    $des_cta = leer_cta_des($cod_cta);
	  $saldo = sal_mayor($cod_cta,$fec_de2,1);
	  $_SESSION['saldo'] = $saldo;
	  if ($mon_cta == 2){
	     $saldo_sus = sal_mayor($cod_cta,$fec_de2,2);
		 $_SESSION['saldo_sus'] = $saldo_sus;
		 }
	echo "Detalle Movimientos Cuenta".encadenar(2).$cod_cta.encadenar(2).
	     $des_cta.encadenar(2).encadenar(2)."del".encadenar(2).$fec_des.
		 encadenar(2)."al".encadenar(2).$fec_has;
		 $_SESSION['des_cta'] = $des_cta;
		 $_SESSION['fec_des'] = $fec_des;
		 $_SESSION['fec_has'] = $fec_has;
	?>	
	    <br>
	<?php
	 ?>	
	 
	<?php
	
     $con_tran = "Select * From contab_trans 
		    	  where CONTA_TRS_CTA = '$cod_cta'
			      and (CONTA_TRS_FEC_VAL between '$fec_de2' and '$fec_ha2') order by CONTA_TRS_FEC_VAL";
		  
	 $res_tran = mysql_query($con_tran);
		
     while ($lin_tran = mysql_fetch_array($res_tran)) {
     	set_time_limit(0);
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
	        $nro_doc = $lin_tran['CONTA_TRS_NRO'];
			$impo = $lin_tran['CONTA_TRS_IMPO'];
			$impo_equiv = $lin_tran['CONTA_TRS_IMPO_E'];
	        $deb_hab = $lin_tran['CONTA_TRS_DEB_CRED'];	
			$glosa = $lin_tran['CONTA_TRS_GLOSA'];
			$fec_tran = $lin_tran['CONTA_TRS_FEC_VAL'];	
			$fec_tra = cambiaf_a_normal($fec_tran);
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
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2
									  	  ) values
										  ($nro_doc,
										   '$fec_tra',
									       '$glosa',
										   $m_debe_1,
										   $m_haber_1,
										   $m_debe_2,
										   $m_haber_2)";
										   
    $resultado = mysql_query($consulta);
	}
	$consulta  = "Select * From temp_ctable3 order by temp_tip_tra";
    $resultado = mysql_query($consulta);
	$tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
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
	
	
	
    while ($linea = mysql_fetch_array($resultado)) {
	
	      $tip_cta = $cod_cta[0];
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
	
     <?php }?>
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
     </table>
     <center>
	    
	 <input class="btn_form" type="submit" name="accion" value="Imprimir Mayor">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	
 <?php } //1b?>
 
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