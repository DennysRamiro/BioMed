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
<title> Diario </title>

<meta charset="UTF-8">

<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
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

                 <?php if($_SESSION['menu'] == 37){?>

                  <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> DIARIO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">

                      <h2> <img src="img/notepad_64x64.png" border="0" alt="Modulo" align="absmiddle"> DIARIO</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle"> Ingrese la Fecha de C&aacute;lculo  de la gesti&oacute;n para ver Diario.
                          
                      </div>
				<?php } elseif($_SESSION['menu'] == 45){?>
            	 <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
             </li>
                    <li id="menu_modulo_cont_reportesotro">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> DIARIO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">

                      <h2> <img src="img/notepad_64x64.png" border="0" alt="Modulo" align="absmiddle"> DIARIO</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle"> Ingrese la Fecha de C&aacute;lculo  de la gesti&oacute;n para ver Diario.
                          
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
//$_SESSION['continuar'] = 1;
//$_SESSION['detalle'] = 1;
if ($_SESSION['continuar'] == 1){
    $_SESSION['cuantos'] = 0;
	$_SESSION['saldo'] = 0;
	$_SESSION['saldo_sus'] = 0;
	
	
   // $borr_cob  = "Delete From temp_ctable3 "; 
   // $cob_borr = mysql_query($borr_cob);
  //  }
		
//if ($_SESSION['detalle'] == 1){
    $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
    $res_ctas = mysql_query($con_ctas); ?>
	<center>
		<br>
	 <strong>Fecha Desde:</strong>
     <input class="txt_campo" type="text" id="datepicker" name="fec_des" maxlength="10"  size="10"  > 
			 <BR><br>
		 <strong>Fecha Hasta:</strong>
     <input class="txt_campo" type="text" id="datepicker2" name="fec_has"  maxlength="10"  size="10" > 
	 
	 <!--script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_has'
            });
      </script-->		
	  <BR><br>
 
	 <center>
	    
	 <input class="btn_form" type="submit" name="accion" value="Consultar Diario">
  </form>	
<?php  }
   
    
if ($_SESSION['continuar'] == 2){

?>


 



<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];
if (isset( $_SESSION['anio'])){
    $gestion = $_SESSION['anio'];
	}else{
     $gestion = 2011;

}



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

     if (isset ($_POST['fec_des'])){
	     $fec_des = $_POST['fec_des'];
		 $fec_de2 = cambiaf_a_mysql_2($fec_des);
		 $_SESSION['fec_de2'] = $fec_de2;
	 }
     if (isset ($_POST['fec_has'])){
	     $fec_has = $_POST['fec_has'];
		 $fec_ha2 = cambiaf_a_mysql_2($fec_has);
		 $_SESSION['fec_ha2'] = $fec_ha2;
	 }
	/* 
		 */
	?>	
	    <br>
		
	 
	<?php
	if ($gestion == 2010){
	$con_cbt  = "Select DISTINCT CONTA_TRS_NRO,CONTA_TRS_FEC_VAL,CONTA_TRS_TIPO
	              From contab_t2010 where (CONTA_TRS_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_FEC_VAL',CONTA_TRS_NRO";
	}else{			  
	$con_cbt  = "Select DISTINCT CONTA_TRS_NRO,CONTA_TRS_FEC_VAL,CONTA_TRS_TIPO
	              From contab_trans where (CONTA_TRS_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_FEC_VAL',CONTA_TRS_NRO";			  
	}			  
    $res_cbt = mysql_query($con_cbt);
	while ($lin_cbt = mysql_fetch_array($res_cbt)) {
	
	
	      $nro_doc = $lin_cbt['CONTA_TRS_NRO'];
		  $fecha = $lin_cbt['CONTA_TRS_FEC_VAL'];
		  $fecha = cambiaf_a_normal($fecha);
		  $tip_doc = $lin_cbt['CONTA_TRS_TIPO'];
		 		  
		  if ($tip_doc == 1){
		      $t_doc = "Manual";
			  }
		   if ($tip_doc == 2){
		      $t_doc = "Automatico";
			  }
			  
	if ($gestion == 2010){		  
	$con_glo  = "Select CONTA_TRS_GLOSA
	              From contab_t2010 where (CONTA_TRS_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_TRS_NRO =  $nro_doc
				  and CONTA_TRS_USR_BAJA is null";
	}else{			  
	$con_glo  = "Select CONTA_TRS_GLOSA
	              From contab_trans where (CONTA_TRS_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_TRS_NRO =  $nro_doc
				  and CONTA_TRS_USR_BAJA is null";			  
	}			  
    $res_glo = mysql_query($con_glo);
	while ($lin_glo = mysql_fetch_array($res_glo)) {
	      $glosa = $lin_glo['CONTA_TRS_GLOSA'];
	
	
	}	
if (substr($glosa,0,1) == "-"){		  
	if ($gestion == 2010){		  
	$con_glo  = "Select CONTA_CAB_GLOSA
	              From contab_c2010 where (CONTA_CAB_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_CAB_NRO =  $nro_doc
				  and CONTA_CAB_USR_BAJA is null";
	}else{			  
	$con_glo  = "Select CONTA_CAB_GLOSA
	              From contab_cabec where (CONTA_CAB_FEC_VAL between '$fec_de2' and  '$fec_ha2')
				  and CONTA_CAB_NRO =  $nro_doc
				  and CONTA_CAB_USR_BAJA is null";			  
	}			  
    $res_glo = mysql_query($con_glo);
	while ($lin_glo = mysql_fetch_array($res_glo)) {
	      $glosa = $lin_glo['CONTA_CAB_GLOSA'];
	
	
	}
}	
echo encadenar(30)."Libro Diario";
?>

<table width="85%"  border="0" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th width="60%" scope="col" align="left"><border="0" alt="" align="absmiddle" />
	   <?php echo "Comprobante Nro.".encadenar(2).$nro_doc;?>  </th>
	  <th width="40%" scope="col" align="right"><border="0" alt="" align="absmiddle" /> 
	   <?php echo "Fecha".encadenar(2).$fecha;?></th>
	 </tr>
	  <tr>
      <th width="60%" scope="col" align="left"><border="0" alt="" align="absmiddle" />
	   <?php echo "Glosa ".encadenar(2).$glosa;?>  </th>
	  <th width="40%" scope="col" align="right"><border="0" alt="" align="absmiddle" /> 
	   <?php echo $t_doc;?></th>
	 </tr> 	 	
 <br>
<table width="85%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA  </th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="5%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	</tr> 
	
	<?php
	// echo "Comprobante Nro.".encadenar(2).$nro_doc.encadenar(60)."Fecha".encadenar(2).$fecha;
	 ?>
	 <br>
	 </center> 
	<?php
	// echo "Glosa ".encadenar(2).$glosa;
	 ?>
	 <br>
	 <?php 	
	$impo_t1 = 0;
	$impoe_t1 = 0;
	$impo_t2 = 0;
	$impoe_t2 = 0;
	if ($gestion == 2010){
	$con_cbt2  = "Select *
	              From contab_t2010 where CONTA_TRS_NRO = $nro_doc  
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_CTA'";
	}else{
	$con_cbt2  = "Select *
	              From contab_trans where CONTA_TRS_NRO = $nro_doc  
				  and CONTA_TRS_USR_BAJA is null 
				  order by 'CONTA_TRS_CTA'";
	}			  			  
    $res_cbt2 = mysql_query($con_cbt2);
	while ($lin_cbt2 = mysql_fetch_array($res_cbt2)) {
	      
	      $impo_1 = 0;
	      $impoe_1 = 0;
		  $impo_2 = 0;
	      $impoe_2 = 0;
		  $tip_doc = $lin_cbt2['CONTA_TRS_TIPO'];
		  if ($tip_doc == 1){
		      $t_doc = "Manual";
			  }
		   if ($tip_doc == 2){
		      $t_doc = "Automatico";
			  }
		   	  
			  
			  	  
		  $glosa_ind =  $lin_cbt2['CONTA_TRS_GLOSA']; 	  
	      $cuenta = $lin_cbt2['CONTA_TRS_CTA'];
		  $desc = leer_cta_des($cuenta);
	      $deb_hab =  $lin_cbt2['CONTA_TRS_DEB_CRED'];
	      
		  if ($deb_hab == 1){
		      $impo_1 = $lin_cbt2['CONTA_TRS_IMPO'];
	          $impoe_1 = $lin_cbt2['CONTA_TRS_IMPO_E'];
			}  
		  if ($deb_hab == 2){
		      $impo_2 = $lin_cbt2['CONTA_TRS_IMPO'];
	          $impoe_2 = $lin_cbt2['CONTA_TRS_IMPO_E'];
			}
			
		 
			
		  $impo_t1 = $impo_t1 +  $impo_1;
	      $impoe_t1 = $impoe_t1 + $impoe_1;
	      $impo_t2 = $impo_t2 + $impo_2  ;
	      $impoe_t2 = $impoe_t2 +  $impoe_2;  
	 
	?>
	
	
	
	
	
	
	 <tr>
	 	      <td align="left"><?php echo $cuenta; ?></td>
			  <td align="left"><?php echo $desc; ?>
			  <br><?php echo $glosa_ind; ?> </td>
		      <td align="right"><?php echo number_format($impo_1, 2, '.',',') ; ?></td>
		      <td align="right"><?php echo number_format($impo_2, 2, '.',','); ?></td>
		      <td align="right"><?php echo number_format($impoe_1, 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($impoe_2, 2, '.',','); ?></td>
	     </tr>
	<?php }  ?>
	 <tr>
	 	      <th align="left"><?php echo encadenar(2); ?></td>
			  <th align="left"><?php echo "Totales"; ?></td>
		      <th align="right"><?php echo number_format($impo_t1, 2, '.',',') ; ?></td>
		      <th align="right"><?php echo number_format($impo_t2, 2, '.',','); ?></td>
		      <th align="right"><?php echo number_format($impoe_t1, 2, '.',',') ; ?></td>
		      <th align="right"  ><?php echo number_format($impoe_t2, 2, '.',','); ?></td>
	     </tr>
		</table>
		<?php
}

?>

 		 <input class="btn_form" type="submit" name="accion" value="Imp_Diario">
    	 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
	<?php

}
?>
	 
	<?php 
/*    
if ($_SESSION['continuar'] == 3){
    if ($_SESSION['detalle'] == 3){
       $consulta  = "Select * From temp_ctable";
       $resultado = mysql_query($consulta);
       $tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
       $con_temp = "Select * From temp_ctable";
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
	 $consulta  = "Select * From temp_ctable where temp_tip_tra = $nlin";
     $resultado = mysql_query($consulta);
	 while ($linea = mysql_fetch_array($resultado)) { //3a
	       $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
           $res_ctas = mysql_query($con_ctas); ?>
	 	 
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
	  $consulta = "update temp_ctable set temp_nro_cta =$cod_cta, 
                                          temp_des_cta ='$des_cta',
						 	              temp_debe_1 = $m_debe_1,
									      temp_haber_1 = $m_haber_1,
										  temp_debe_2 = $m_debe_2,
									      temp_haber_2 = $m_haber_2 
										  where temp_tip_tra = $nlin";
										   
    $resultado = mysql_query($consulta);
	
	$consulta  = "Select * From temp_ctable";
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