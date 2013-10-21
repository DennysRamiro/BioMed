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
<title>Modificacion Asiento Contable</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js/calendario.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-ui.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="js/Utilitarios.js"></script>  
<script type="text/javascript" src="js/contabilidad_reg_cons_sel_modif.js"></script> 
<script type="text/javascript" src="js/contabilidad_reg_rev_cop.js"></script> 
</head>
<body>

<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Solo debe ingresar un haber o un debe, no ambos</font></p>
</div>
<div id="dialog-confirm12" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Solo debe ingresar un haber o un debe, no ambos</font></p>
</div>
<div id="dialog-confirm13" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Solo debe ingresar un haber o un debe, no ambos</font></p>
</div>
<div id="dialog-confirm14" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Solo debe ingresar un haber o un debe</font></p>
</div>
<div id="dialog-confirm15" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Solo debe ingresar un haber o un debe</font></p>
</div>
<div id="dialog-confirm16" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Solo debe ingresar un haber o un debe, no ambos</font></p>
</div>
<div id="dialog-confirm17" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Solo debe ingresar un haber o un debe, no ambos</font></p>
</div>
	<?php
				include("header.php");
			

				$menu=$_SESSION["menu"];

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

                 <?php if($_SESSION['menu'] == 13){?>
                   <li id="menu_modulo_contabilidad_asientocontable_consultar">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASI. CONT.
                    
                 </li>
                   <li id="menu_modulo_contabilidad_asientocontable_consultar_sel">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> SEL. ASI. CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> MOD. ASI. CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
<h2> <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle"> MODIFICA ASIENTO CONTABLE
	</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Seleccione la linea que desea modificar
        </div>
				<?php } elseif($_SESSION['menu'] == 14){?>
				  <li id="menu_modulo_contabilidad_asientocontable_consultar">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASI. CONT.
                    
                 </li>
                   <li id="menu_modulo_contabilidad_asientocontable_consultar_sel">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> SEL. ASI. CONT.
                    
                 </li>
				  <li id="menu_modulo_contabilidad_asientocontable_consultar_sel_modif">
                    
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> MOD. ASI. CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/save 2_24x24.png" border="0" alt="Modulo" align="absmiddle"> GRAB. ASI. CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
<h2> <img src="img/save 2_64x64.png" border="0" alt="Modulo" align="absmiddle"> GRABAR ASIENTO CONTABLE
	</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Revise Bien antes de Imprimir...
        </div>

        	<?php } elseif($_SESSION['menu'] == 20){?>
        	 <li id="menu_modulo_contabilidad_asientocontable_consultar">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONS. ASI. CONT.
                    
                 </li>
                   <li id="menu_modulo_contabilidad_asientocontable_consultar_sel">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> SEL. ASI. CONT.
                    
                 </li>
           <li id="menu_modulo_fecha">
                    
                     <img src="img/copy_24x24.png" border="0" alt="Modulo" align="absmiddle"> COP. ASI. CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
		<h2> <img src="img/copy_64x64.png" border="0" alt="Modulo" align="absmiddle"> COPIAR ASIENTO CONTABLE
		</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Seleccione la linea que desea copiar
        </div>
        
        <?php } elseif($_SESSION['menu'] == 26){?>

        <li id="menu_modulo_contabilidad_asientocontable_utilreserva">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> UTILIZAR RESERVADOS
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_utilreserva_copiar">
                    
                     <img src="img/copy_24x24.png" border="0" alt="Modulo" align="absmiddle"> COPIAR ASIENTO RES.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_utilreserva_copiar_sel">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> SEL. ASI. CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/copy_24x24.png" border="0" alt="Modulo" align="absmiddle"> COP. ASI. CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
		<h2> <img src="img/copy_64x64.png" border="0" alt="Modulo" align="absmiddle"> COPIAR ASIENTO CONTABLE
		</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           
        </div>









<?php }?>

        

				<?php
					 //$fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				//	  $nro_tr_con = leer_nro_co_con();
				?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">
<strong>
<?php
$nro_doc = 0;
if (isset($_POST['nro_doc'])){
$quecom = $_POST['nro_doc'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $nro_doc = $quecom[$i];
	$_SESSION['nro_doc'] = $nro_doc;
 }
}
}else{
$nro_doc = $_SESSION['nro_doc'];
}
if (isset($_POST['descrip'])){ //2a
       if ($_POST['descrip'] <> ""){  //3a
	      $descrip = $_POST['descrip'];
	      $descrip = strtoupper ($descrip);
	      $_SESSION['descrip'] = $descrip;
	      } //3b
      }	//2




 if ($_SESSION['nor_res'] == 1){
	if ($_SESSION['mod_cop'] == 1){
		
		?><br> <center><?php echo "Nro. Asiento Contable".encadenar(2). $nro_doc.encadenar(2).$_SESSION['descrip']; ?></center> <?php
	}
	if ($_SESSION['mod_cop'] == 2){
		?><br> <center><?php echo "Nro. Asiento Contable ".encadenar(2). leer_nro_co_con().encadenar(2); ?></center> <?php
	}
}

if ($_SESSION['nor_res'] == 2){
        ?><br> <center><?php echo "Nro. Asiento Reservado ".encadenar(2).  $_SESSION['nro_tr_con'].encadenar(2).$_SESSION['descrip']; ?></center> <?php
}
?>
<br>
</strong>
<?php
if ($_SESSION['continuar'] == 1){
    $_SESSION['cuantos'] = 0;
    $borr_cob  = "Delete From temp_ctable3 "; 
    $cob_borr = mysql_query($borr_cob);
	 $nro_tr_con = leer_nro_co_con();
	 
    }
	
if ($_SESSION['detalle'] == 1){
    $con_cab  = "Select CONTA_CAB_GLOSA
	              From contab_cabec where CONTA_CAB_NRO = $nro_doc  
				  and CONTA_CAB_USR_BAJA is null";
    $res_cab = mysql_query($con_cab);
	while ($lin_cab = mysql_fetch_array($res_cab)) {
	 $glosa =  $lin_cab['CONTA_CAB_GLOSA'];
	  $_SESSION['descrip'] = $glosa;
	}
    $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
    $res_ctas = mysql_query($con_ctas); ?>
		
    <table align="center">
    
	<?php if ($_SESSION['continuar'] == 1){?>
     
	<?php } ?>
	<?php if ($_SESSION['continuar'] == 2){?>

	<?php } ?>
   <tr> 
      				<th align="left">Cuenta Contable :</th>
	  				<td> <select name="cod_cta" id="cod_cta" size="1">
	  				<?php while ($lin_cta = mysql_fetch_array($res_ctas)) { ?>
	       				 <option value="<?php echo $lin_cta['CONTA_CTA_NRO']; ?>">
						               <?php echo $lin_cta['CONTA_CTA_NRO']; ?>
									   <?php echo utf8_encode($lin_cta['CONTA_CTA_DESC']);?></option>
           					<?php } 
//echo $_POST['c'];
                    ?>
		    </select>
			<br><br>	</td>
	 </tr>	
		
	 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
    <tr>
	  
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	 
	  
	</tr>
   
    <tr> 
         <td><input  type="text" name="debe_1"  id="debe_1" onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
		 <td><input  type="text" name="haber_1" id="haber_1" onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
		 <td><input  type="text" name="debe_2"  id="debe_2" onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
		 <td><input  type="text" name="haber_2" id="haber_2" onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
		 <td><input  type="text" name="glosa_2" id="glosa_2" value=" " size="28"> </td>
    </tr>
   
	
  </table>
	 <center>
	  <br>  
	 <input class="btn_form" type="submit" name="accion" value="Nueva Linea">
     <br>
</form>	
<br>

 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return">

 
<?php } ?>


<?php
if ($_SESSION['continuar'] == 1){
$cuantos = 0;
$con_asie  = "Select * From contab_trans where CONTA_TRS_NRO = $nro_doc and
              CONTA_TRS_USR_BAJA is null ";
  $res_asie = mysql_query($con_asie);
 while ($linea = mysql_fetch_array($res_asie)) {
        $cuantos = $cuantos + 1;
        $debe_1 = 0;
		$haber_1 = 0;
		$debe_2 = 0;
		$haber_2 = 0;
		$impo = 0;
		$impo_e = 0;
        $glosa_2 = "-";
   $tipo = $linea['CONTA_TRS_TIPO'];
    if ($tipo > 3){
		      $_SESSION["tot_err"] = 2;
	          header('Location: cons_asiento.php');
		 
		 }
   
   
   		
   $cod_cta = $linea['CONTA_TRS_CTA'];
   $mon_cta = substr($cod_cta,5,1);
   
   $des_cta = leer_cta_des($cod_cta);
    $deb_hab = $linea['CONTA_TRS_DEB_CRED'];
	$impo = $linea['CONTA_TRS_IMPO'];
	$impo_e = $linea['CONTA_TRS_IMPO_E'];
	if ($mon_cta == 2){
	    $impo_e = $linea['CONTA_TRS_IMPO'] /  $_SESSION['TC_CONTAB'];
	}
	
	$glosa_2 =$linea['CONTA_TRS_GLOSA'];
	$fec_cbte = $linea['CONTA_TRS_FEC_VAL'];
	$_SESSION['fec_cbte']=$fec_cbte;
	$fec_c = cambiaf_a_normal($fec_cbte);
	
   if ( $deb_hab == 1){
       $debe_1 = $impo;
	   $haber_1 = 0;
	   $debe_2 = $impo_e;
	   $haber_2 = 0;
   }
   if ( $deb_hab == 2){
       $debe_1 = 0;
	   $haber_1 = $impo;
	   $debe_2 = 0;
	   $haber_2 = $impo_e;
   }
  $consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2,
										  temp_glosa,
										  temp_glosa2 
									  	  ) values
										  ($cuantos,
										   $cod_cta,
									       '$des_cta',
										   $debe_1,
										   $haber_1,
										   $debe_2,
										   $haber_2,
										   '$glosa',
										   '$glosa_2')";
										   
    $resultado = mysql_query($consulta);
}
?>	
      <tr>
	    <th align="left">Glosa:</th>

		<td><input class="txt_campo" type="text" name="descrip" size="70" maxlength="70" value="<?=$glosa;?>" > </td>
	  </tr>
	  <br><br>
	  
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro...</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Mod/Eli.</th>
	 
	  
	</tr>	
		   
	 <?php  
	
$consulta  = "Select * From temp_ctable3";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
	
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
		   $nro = $linea['temp_tip_tra'];
		   ?>
	      <tr>
		       <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
			<?php if ($nro == 1){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_1" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_1" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_1" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>
			 <?php } ?>  
			 
			  <?php if ($nro == 2){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_2" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_2" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_2" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>  
			  <?php if ($nro == 3){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_3" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_3" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_3" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
			 	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>		  
			 <?php } ?>  
			  <?php if ($nro == 4){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_4" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_4" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_4" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>
			 <?php } ?>
			  <?php if ($nro == 5){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_5" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_5" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_5" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	  
			 <?php } ?>
			  <?php if ($nro == 6){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_6" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_6" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_6" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			 <?php if ($nro == 7){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_7" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_7" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_7" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 			  
			 <?php } ?>
			  <?php if ($nro == 8){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_8" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_8" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_8" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	  
			 <?php } ?>
			 <?php if ($nro == 9){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_9" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_9" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_9" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			  <?php if ($nro == 10){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_10" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_10" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_10" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	  
				  
			 <?php } ?>
			  <?php if ($nro == 11){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_11" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_11" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_11" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	  
			 <?php } ?>
			  <?php if ($nro == 12){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_12" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_12" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_12" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
			 <?php } ?>
			  <?php if ($nro == 13){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_13" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_13" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_13" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			 <?php if ($nro == 14){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_14" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_14" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_14" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			 <?php if ($nro == 15){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_15" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_15" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_15" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 			  
			 <?php } ?>
			  <?php if ($nro == 16){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_16" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_16" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_16" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			  <?php if ($nro == 17){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_17" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_17" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_17" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			   <?php if ($nro == 18){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_18" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_18" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_18" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			   <?php if ($nro == 19){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_19" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_19" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_19" width="10" 
			      size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>

	
     <?php }?>
	 <?php if ($nro == 20){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_20" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_20" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_20" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 21){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_21" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_21" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_21" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	 
	 <?php } ?>	 
	 <?php if ($nro == 22){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_22" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_22" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_22" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 23){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_23" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_23" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_23" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 24){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_24" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_24" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_24" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	<?php if ($nro == 25){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_25" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_25" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_25" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?> 
	 <?php if ($nro == 26){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_26" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_26" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_26" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 27){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_27" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_27" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_27" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 28){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_28" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_28" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_28" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	 
	 <?php } ?>
	 <?php if ($nro == 29){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_29" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_29" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_29" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
	 <?php } ?>
	 <?php if ($nro == 30){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_30" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_30" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_30" width="10" 
		     size="25" value="<?=$linea['temp_glosa2'];?>" ></td>
	
	 	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
		 
	     </tr>
		 <?php } ?> 
         <tr>
		     <th><?php echo encadenar(3); ?></th>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		      <?php 
			  
				if (($tot_debe_1==$tot_haber_1) ) { ?>
		     
				     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
				     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
				     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
				     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
		     <?php  } else{ ?>
				      <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
				     <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
				     <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
				     <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>

		      <?php  }  ?>
	     </tr>
     </table>
  <center>
  	
	 <input class="btn_form" type="submit" name="accion" value="Elimina fila">   
	 <input class="btn_form" type="submit" name="accion" value="Graba Modificado">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	


 <?php
}



$apli = 10000;
$_SESSION['monto_t'] = 0;
$descrip = "";
$tc_ctb = $_SESSION['TC_CONTAB'];
//$cuantos = 0;
$debe_1 = 0;
$haber_1 = 0;
$debe_2 = 0;
$haber_2 = 0;
$mon_cta = 0;
if ($_SESSION['continuar'] == 2){ //1a
    if (isset($_POST['descrip'])){ //2a
       if ($_POST['descrip'] <> ""){  //3a
	      $descrip = $_POST['descrip'];
	      $descrip = strtoupper ($descrip);
	      $_SESSION['descrip'] = $descrip;
	      } //3b
      }	//2b
	if (isset ($_POST['cod_cta'])){
      if ($_POST['cod_cta'] <> ""){ //4a  
	     $cod_cta = $_POST['cod_cta'];
		 $mon_cta = $cod_cta[5]; 
	     $_SESSION['cod_cta'] = $cod_cta;
	  }	//4b
	  }
	if (isset ($_POST['debe_1'])){  
      if ($_POST['debe_1'] > 0){ //5a  
	     $debe_1 = $_POST['debe_1'];
	  	 $_SESSION['debe_1'] = $debe_1;
	  }
	  }//5b
  if (isset ($_POST['haber_1'])){  
     if ($_POST['haber_1'] > 0){ //5a  
	     $haber_1 = $_POST['haber_1'];
	  	 $_SESSION['haber_1'] = $haber_1;
	  }
	 } //6b
	if (isset ($_POST['debe_2'])){  
	   if ($_POST['debe_2'] > 0){ //5a  
	     $debe_2 = $_POST['debe_2'];
	  	 $_SESSION['debe_2'] = $debe_2;
	  } //5b
	} 
 if (isset ($_POST['haber_2'])){ 	 
     if ($_POST['haber_2'] > 0){ //5a  
	     $haber_2 = $_POST['haber_2'];
	  	 $_SESSION['haber_2'] = $haber_2;
	  } 
}	  
	 if (isset($_POST['glosa_2'])){ //2a
       if ($_POST['glosa_2'] <> ""){  //3a
	      $glosa_2 = $_POST['glosa_2'];
	      $glosa_2 = strtoupper ($glosa_2);
	      $_SESSION['glosa_2'] = $glosa_2;
	      }
      }else{
	      $glosa_2 = "-";
		   $_SESSION['glosa_2'] = $glosa_2;
		   }
		   
	
		 
		
	
	?>	
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Eli.</th>
	 
	  
	</tr>	
		   
	 <?php    	//2
    /*  if ($deb_hab == "Debe"){ //7a
	     if ($mon_cta == 1){ 
             $m_debe_1 = $monto_t;
	         $m_haber_1 = 0;
			 $m_debe_2 = 0;
	         $m_haber_2 = 0;
			 }else{
			 $m_debe_1 = $monto_t * $tc_ctb;
	         $m_haber_1 = 0;
			 $m_debe_2 = $monto_t;
	         $m_haber_2 = 0;
		}	 
	     }else{
		     if ($mon_cta == 1){
	             $m_debe_1 = 0;
	             $m_haber_1 = $monto_t;
				 $m_debe_2 = 0;
	             $m_haber_2 = 0;
				 }else{
				 $m_debe_1 = 0;
	             $m_haber_1 = $monto_t * $tc_ctb;
				 $m_debe_2 = 0;
	             $m_haber_2 = $monto_t;
			}	 
	     } */
     if ($mon_cta == 2){ //8a
	     if ( $debe_2 > 0){ //9a     
            $debe_1 = round($debe_2 * $tc_ctb,2);
	        $haber_1 = 0;
	        }
		 if ($haber_2 > 0){ 
	        $debe_1 = 0;
	        $haber_1 = round($haber_2 * $tc_ctb,2);
	        } //8b
		 if ( $debe_1 > 0){ //9a     
            $debe_2 = round($debe_1 / $tc_ctb,2);
	        $haber_2 = 0;
	        }	
		 if ($haber_1 > 0){ 
	        $debe_2 = 0;
	        $haber_2 = round($haber_1 / $tc_ctb,2);
	        } 
			
			
			
			
       } //9b
//if (isset ($_POST['debe_1'] + $_POST['haber_1'] +  $_POST['debe_2'] +  $_POST['haber_2'])){
	if (($debe_1 + 	$haber_1 + 
	    $debe_2 +  $haber_2) > 0 ){
      $des_cta = leer_cta_des($cod_cta);
	  $consulta  = "SELECT temp_tip_tra FROM temp_ctable3  ORDER BY temp_tip_tra DESC LIMIT 0,1";
$resultado = mysql_query($consulta);
//$linea = mysql_fetch_array($resultado);
    while ($linea = mysql_fetch_array($resultado)) {
	      $cuantos =  $linea['temp_tip_tra'];
	}
	   $cuantos =  $cuantos + 1;
	  $_SESSION['cuantos'] =  $cuantos;
	 // $cuantos = $_SESSION['cuantos'];
//echo $descrip.encadenar(2).$cod_cta.encadenar(2).$deb_hab.encadenar(2).$monto_t;	
	  $consulta = "insert into temp_ctable3 (temp_tip_tra,
	                                      temp_nro_cta, 
                                          temp_des_cta,
						 	              temp_debe_1,
									      temp_haber_1,
										  temp_debe_2,
									      temp_haber_2,
										  temp_glosa 
									  	  ) values
										  ($cuantos,
										   $cod_cta,
									       '$des_cta',
										   $debe_1,
										   $haber_1,
										   $debe_2,
										   $haber_2,
										   '$glosa_2')";
										   
    $resultado = mysql_query($consulta);
	}
	//}
	
	$consulta  = "Select * From temp_ctable3";
    $resultado = mysql_query($consulta);
	
    $tot_debe_1 = 0;
    $tot_haber_1 = 0;
    $tot_debe_2 = 0;
    $tot_haber_2 = 0;
    while ($linea = mysql_fetch_array($resultado)) {
          $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	      $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	      $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
		   $nro = $linea['temp_tip_tra']; ?>
	      <tr>
		       <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
			<?php if ($nro == 1){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_1" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_1" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_1" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>
			 <?php } ?>  
			 
			  <?php if ($nro == 2){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_2" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_2" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_2" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>  
			  <?php if ($nro == 3){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_3" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_3" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_3" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>		  
			 <?php } ?>  
			  <?php if ($nro == 4){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_4" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_4" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_4" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>
			 <?php } ?>
			  <?php if ($nro == 5){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_5" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_5" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_5" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	  
			 <?php } ?>
			  <?php if ($nro == 6){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_6" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_6" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_6" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			 <?php if ($nro == 7){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_7" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_7" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_7" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 			  
			 <?php } ?>
			  <?php if ($nro == 8){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_8" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_8" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_8" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	  
			 <?php } ?>
			 <?php if ($nro == 9){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_9" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_9" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_9" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			  <?php if ($nro == 10){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_10" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_10" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_10" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	  
				  
			 <?php } ?>
			  <?php if ($nro == 11){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_11" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_11" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_11" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	  
			 <?php } ?>
			  <?php if ($nro == 12){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_12" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_12" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_12" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
			 <?php } ?>
			  <?php if ($nro == 13){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_13" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_13" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_13" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			 <?php if ($nro == 14){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_14" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_14" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_14" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			 <?php if ($nro == 15){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_15" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_15" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  

		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_15" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 			  
			 <?php } ?>
			  <?php if ($nro == 16){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_16" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_16" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_16" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			  <?php if ($nro == 17){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_17" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" ype="text"  style align="center" name="hab_17" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_17" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			   <?php if ($nro == 18){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_18" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_18" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_18" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>
			   <?php if ($nro == 19){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_19" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_19" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_19" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		  
			 <?php } ?>

	
     <?php }?>
	 <?php if ($nro == 20){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_20" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_20" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_20" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 21){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_21" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_21" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_21" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	 
	 <?php } ?>	 
	 <?php if ($nro == 22){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_22" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_22" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_22" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 23){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_23" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_23" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_23" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 24){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_24" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_24" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_24" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	<?php if ($nro == 25){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_25" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_25" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_25" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?> 
	 <?php if ($nro == 26){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_26" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_26" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_26" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 27){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_27" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_27" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_27" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 		 
	 <?php } ?>
	 <?php if ($nro == 28){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_28" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_28" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_28" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	 
	 <?php } ?>
	 <?php if ($nro == 29){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_29" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_29" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_29" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
	 <?php } ?>
	 <?php if ($nro == 30){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_30" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_30" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_30" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	
	 	 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
		 
	     </tr>
		 <?php } ?> 
	
     <?php // }?>
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
	 <input class="btn_form" type="submit" name="accion" value="Elimina linea">   
	 <input class="btn_form" type="submit" name="accion" value="Graba Modificado">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	
 <?php } //1b?>
  <?php
 if(isset($_SESSION['eliminar'])){
 if ($_SESSION['eliminar'] == 1){
   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
	 $consulta  = "Delete From temp_ctable3 where temp_tip_tra = $cmone";
     $resultado = mysql_query($consulta);
	$consulta  = "Select * From temp_ctable3 order by temp_tip_tra";
    $resultado = mysql_query($consulta);?>
	 <tr>
	    <th align="left">Glosa:</th>
		<td><input class="txt_campo" type="text" name="descrip" size="70" maxlength="70" value="<?=$glosa;?>" > </td>
	  </tr>
	<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">

 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Mod/Eli.</th>
	 
	  
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
		   $nro = $linea['temp_tip_tra'];
		   $cod_cta = $linea['temp_cuenta'];
		   $mon_cta = substr($cod_cta,5,1);
		   ?>
	      <tr>
		       <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
			<?php if ($nro == 1){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_1" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_1" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_1" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>  
			 
			  <?php if ($nro == 2){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_2" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_2" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_2" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
				<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>
			 <?php } ?>  
			  <?php if ($nro == 3){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_3" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_3" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_3" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			   <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>  
			  <?php if ($nro == 4){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_4" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_4" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_4" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			   <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			  <?php if ($nro == 5){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_5" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_5" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_5" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			  <?php if ($nro == 6){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_6" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_6" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_6" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			    <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>"></td>	  
			 <?php } ?>
			 <?php if ($nro == 7){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_7" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_7" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_7" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			  <?php if ($nro == 8){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_8" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_8" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_8" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			 <?php if ($nro == 9){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_9" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_9" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_9" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			  <?php if ($nro == 10){ ?>  
		      <td align="right"> <input class="txt_campo"type="text"  style align="center" name="deb_10" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_10" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_10" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			  <?php if ($nro == 11){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_11" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_11" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_11" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			  <?php if ($nro == 12){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_12" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_12" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_12" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			  <?php if ($nro == 13){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_13" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_13" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_13" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			 <?php if ($nro == 14){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_14" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_14" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_14" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
				<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>  
			 <?php } ?>
			 <?php if ($nro == 15){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_15" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_15" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_15" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			 <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 	  
			 <?php } ?>
			  <?php if ($nro == 16){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_16" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_16" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_16" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			  	<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>  
			 <?php } ?>
			  <?php if ($nro == 17){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_17" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_17" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_17" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			   <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			   <?php if ($nro == 18){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_18" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_18" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_18" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	  
			 <?php } ?>
			   <?php if ($nro == 19){ ?>  
		      <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_19" width="10" 
			      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
		       <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_19" width="10" 
			      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
				  
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			   <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_19" width="10" 
			      size="25" value="<?=$linea['temp_glosa'];?>" ></td>
			   	<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>  
			 <?php } ?>

	
     <?php }?>
	 <?php if ($nro == 20){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_20" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_20" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_20" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?>
	 <?php if ($nro == 21){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_21" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_21" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_21" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
	     <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>		 
	 <?php } ?>	 
	 <?php if ($nro == 22){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_22" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_22" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_22" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?>
	 <?php if ($nro == 23){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_23" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_23" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_23" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?>
	 <?php if ($nro == 24){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_24" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_24" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_24" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?>
	<?php if ($nro == 25){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_25" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_25" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_25" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?> 
	 <?php if ($nro == 26){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_26" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_26" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_26" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?>
	 <?php if ($nro == 27){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_27" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_27" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_27" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?>
	 <?php if ($nro == 28){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_28" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_28" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_28" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?>
	 <?php if ($nro == 29){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_29" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_29" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_29" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?>
	 <?php if ($nro == 30){ ?>  
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="deb_30" width="10" 
		      size="15" value="<?=$linea['temp_debe_1'];?>" ></td>
	     <td align="right"> <input class="txt_campo" type="text"  style align="center" name="hab_30" width="10" 
		      size="15" value="<?=$linea['temp_haber_1'];?>" ></td>
	     <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
	     <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
		 <td align="right"> <input class="txt_campo" type="text"  style align="center" name="glo_30" width="10" 
		     size="25" value="<?=$linea['temp_glosa'];?>" ></td>
		<td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td>	 
	 <?php } ?>
	 	  
	     </tr>
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
	 <input class="btn_form" type="submit" name="accion2" value="Elimina fila">
	 <input class="btn_form" type="submit" name="accion" value="Graba Modificado">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	
 <?php
 //}
 }
 }
} 
?>
<?php
    
if ($_SESSION['continuar'] == 3){
    if ($_SESSION['detalle'] == 3){
       $tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
	   $deb_1 = 0;
	   $hab_1 = 0;
	   $glo_1 = "";
	   $deb_2 = 0;
	   $hab_2 = 0;
	   $glo_2 = "";
	   $deb_3 = 0;
	   $hab_3 = 0;
	   $glo_3 = "";
	   $deb_4 = 0;
	   $hab_4 = 0;
	   $glo_4 = "";
	   $deb_5 = 0;
	   $hab_5 = 0;
	   $glo_5 = "";
	   $deb_6 = 0;
	   $hab_6 = 0;
	   $glo_6 = "";
	   $deb_7 = 0;
	   $hab_7 = 0;
	   $glo_7 = "";
	   $deb_8 = 0;
	   $hab_8 = 0;
	   $glo_8 = "";
	   $deb_9 = 0;
	   $hab_9 = 0;
	   $glo_9 = "";
	   $deb_10 = 0;
	   $hab_10 = 0;
	   $glo_10 = "";
	   $deb_11 = 0;
	   $hab_11 = 0;
	   $glo_11 = "";
	   $deb_12 = 0;
	   $hab_12 = 0;
	   $glo_12 = "";
	   $deb_13 = 0;
	   $hab_13 = 0;
	   $glo_13 = "";
	   $deb_14 = 0;
	   $hab_14 = 0;
	   $glo_14 = "";
	   $deb_15 = 0;
	   $hab_15 = 0;
	   $glo_15 = "";
	   $deb_16 = 0;
	   $hab_16 = 0;
	   $glo_16 = "";
	   $deb_17 = 0;
	   $hab_17 = 0;
	   $glo_17 = "";
	   $deb_18 = 0;
	   $hab_18 = 0;
	   $glo_18 = "";
	   $deb_19 = 0;
	   $hab_19 = 0;
	   $glo_19 = "";
	   $deb_20 = 0;
	   $hab_20 = 0;
	   $glo_20 = "";
	   $deb_21 = 0;
	   $hab_21 = 0;
	   $glo_21 = "";
	   $deb_22 = 0;
	   $hab_22 = 0;
	   $glo_22 = "";
	   $deb_23 = 0;
	   $hab_23 = 0;
	   $glo_23 = "";
	   $deb_24 = 0;
	   $hab_24 = 0;
	   $glo_24 = "";
	   $deb_25 = 0;
	   $hab_25 = 0;
	   $glo_25 = "";
	   $deb_26 = 0;
	   $hab_26 = 0;
	   $glo_26 = "";
	   $deb_27= 0;
	   $hab_27 = 0;
	   $glo_27 = ""; 
	   $deb_28 = 0;
	   $hab_28 = 0;
	   $glo_28 = "";
	   $deb_29 = 0;
	   $hab_29 = 0;
	   $glo_29 = "";
	   $deb_30 = 0;
	   $hab_30 = 0;
	   $glo_30 = "";
	    if (isset($_POST['descrip'])){
		   $_SESSION['descrip'] = $_POST['descrip'];
		   $glo_2 = $_SESSION['descrip'];
		   $act_temp  = "update temp_ctable3 set temp_glosa2 = '$glo_2'";
           $res_temp = mysql_query($act_temp);
		
		}
	   if (isset($_POST['deb_1'])){
          if (isset($_POST['hab_1'])){
		      $deb_2 = 0; 
		      $hab_2 = 0;
			     
	       $deb_1 = $_POST['deb_1'];
		   $hab_1 = $_POST['hab_1'];
		   $glo_1 = $_POST['glo_1'];
		   $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 1";
           $res_cta = mysql_query($lee_cta);
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_1 > 0){
		           $deb_2 = $deb_1 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_1 > 0){
		            $hab_2 = $hab_1 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_1,
			                                      temp_haber_1 = $hab_1,
												  temp_debe_2 = $deb_2,
			                                      temp_haber_2 = $hab_2,
												  temp_glosa = '$glo_1'
						  where temp_tip_tra = 1";
           $res_temp = mysql_query($act_temp);
	}		
   }
	    if (isset($_POST['deb_2'])){
		   if (isset($_POST['hab_2'])){
		    $deb_22 = 0; 
		    $hab_22 = 0;
	       $deb_2 = $_POST['deb_2'];
		   $hab_2 = $_POST['hab_2'];
		   $glo_2 = $_POST['glo_2']; 
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 2";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		//   echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_2 > 0){
		           $deb_22 = $deb_2 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_2 > 0){
		            $hab_22 = $hab_2 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_2,
			                                      temp_haber_1 = $hab_2,
												  temp_debe_2 = $deb_22,
			                                      temp_haber_2 = $hab_22,
												  temp_glosa = '$glo_2'
						  where temp_tip_tra = 2";
           $res_temp = mysql_query($act_temp);
		}
	   }
	   if (isset($_POST['deb_3'])){
	       if (isset($_POST['hab_3'])){
		   $deb_2 = 0; 
		   $hab_2 = 0;
	       $deb_3 = $_POST['deb_3'];
		   $hab_3 = $_POST['hab_3'];
		   $glo_3 = $_POST['glo_3']; 
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 3";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_3 > 0){
		           $deb_2 = $deb_3 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_3 > 0){
		            $hab_2 = $hab_3 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_3,
			                                      temp_haber_1 = $hab_3,
												  temp_debe_2 = $deb_2,
			                                      temp_haber_2 = $hab_2,
												  temp_glosa = '$glo_3'
						  where temp_tip_tra = 3";
           $res_temp = mysql_query($act_temp) ;
		}
	   }
	   if (isset($_POST['deb_4'])){
	        if (isset($_POST['hab_4'])){
			$deb_2 = 0; 
		    $hab_2 = 0;
	       $deb_4 = $_POST['deb_4'];
		   $hab_4 = $_POST['hab_4'];
		   $glo_4 = $_POST['glo_4'];
		   $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 4";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_4 > 0){
		           $deb_2 = $deb_4 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_4 > 0){
		            $hab_2 = $hab_4 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }  
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_4,
			                                      temp_haber_1 = $hab_4,
												  temp_debe_2 = $deb_2,
			                                      temp_haber_2 = $hab_2,
												  temp_glosa = '$glo_4'
						  where temp_tip_tra = 4";
           $res_temp = mysql_query($act_temp) ;
		}
	   }
	   if (isset($_POST['deb_5'])){
	       if (isset($_POST['hab_5'])){
		   $deb_2 = 0; 
		   $hab_2 = 0;
	       $deb_5 = $_POST['deb_5'];
		   $hab_5 = $_POST['hab_5'];
		   $glo_5 = $_POST['glo_5'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 5";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_5 > 0){
		           $deb_2 = $deb_5 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_5 > 0){
		            $hab_2 = $hab_5 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_5,
			                                      temp_haber_1 = $hab_5,
												  temp_debe_2 = $deb_2,
			                                      temp_haber_2 = $hab_2,
												  temp_glosa = '$glo_5'
						  where temp_tip_tra = 5";
           $res_temp = mysql_query($act_temp);
		}
	   }
	     if (isset($_POST['deb_6'])){
		    if (isset($_POST['hab_6'])){
			$deb_2 = 0; 
		    $hab_2 = 0;
	       $deb_6 = $_POST['deb_6'];
		   $hab_6 = $_POST['hab_6'];
		   $glo_6 = $_POST['glo_6']; 
		   $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 6";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_6 > 0){
		           $deb_2 = $deb_6 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_6 > 0){
		            $hab_2 = $hab_6 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_6,
			                                     temp_haber_1 = $hab_6,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_6'
						  where temp_tip_tra = 6";
           $res_temp = mysql_query($act_temp) ;
			}
	   }   
	     if (isset($_POST['deb_7'])){
		    if (isset($_POST['hab_7'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_7 = $_POST['deb_7'];
		   $hab_7 = $_POST['hab_7'];
		   $glo_7 = $_POST['glo_7'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 7";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_7 > 0){
		           $deb_2 = $deb_7 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_7 > 0){
		            $hab_2 = $hab_7 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_7,
			                                     temp_haber_1 = $hab_7,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2, 
												 temp_glosa = '$glo_7'
						  where temp_tip_tra = 7";
           $res_temp = mysql_query($act_temp);
		}
	   }
	      if (isset($_POST['deb_8'])){
		    if (isset($_POST['hab_8'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_8 = $_POST['deb_8'];
		   $hab_8 = $_POST['hab_8'];
		   $glo_8 = $_POST['glo_8'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 8";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_8 > 0){
		           $deb_2 = $deb_8 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_8 > 0){
		            $hab_2 = $hab_8 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_8,
			                                      temp_haber_1 = $hab_8,
												  temp_debe_2 = $deb_2,
			                                      temp_haber_2 = $hab_2,
												  temp_glosa = '$glo_8'
						  where temp_tip_tra = 8";
           $res_temp = mysql_query($act_temp) ;
		}
	   }    
	     if (isset($_POST['deb_9'])){
		    if (isset($_POST['hab_9'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_9 = $_POST['deb_9'];
		   $hab_9 = $_POST['hab_9'];
		   $glo_9 = $_POST['glo_9'];
		     $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 9";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_9 > 0){
		           $deb_2 = $deb_9 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_9 > 0){
		            $hab_2 = $hab_9 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_9,
			                                     temp_haber_1 = $hab_9,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_9'
						  where temp_tip_tra = 9";
           $res_temp = mysql_query($act_temp) ;
		}
	   }  
	      if (isset($_POST['deb_10'])){
		    if (isset($_POST['hab_10'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_10 = $_POST['deb_10'];
		   $hab_10 = $_POST['hab_10'];
		   $glo_10 = $_POST['glo_10'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 10";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_10 > 0){
		           $deb_2 = $deb_10 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_10 > 0){
		            $hab_2 = $hab_10 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_10,
			                                     temp_haber_1 = $hab_10,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_10'
						  where temp_tip_tra = 10";
           $res_temp = mysql_query($act_temp) ;
		}
	   }  
	     if (isset($_POST['deb_11'])){
		    if (isset($_POST['hab_11'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_11 = $_POST['deb_11'];
		   $hab_11 = $_POST['hab_11'];
		   $glo_11 = $_POST['glo_11'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 11";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_11 > 0){
		           $deb_2 = $deb_11 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_11 > 0){
		            $hab_2 = $hab_11 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_11,
			                                      temp_haber_1 = $hab_11,
												  temp_debe_2 = $deb_2,
			                                      temp_haber_2 = $hab_2,
												  temp_glosa = '$glo_11'
						  where temp_tip_tra = 11";
           $res_temp = mysql_query($act_temp) ;
		}
	   }   
	    if (isset($_POST['deb_12'])){
		    if (isset($_POST['hab_12'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_12 = $_POST['deb_12'];
		   $hab_12 = $_POST['hab_12'];
		   $glo_12 = $_POST['glo_12'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 12";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_12 > 0){
		           $deb_2 = $deb_12 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_12 > 0){
		            $hab_2 = $hab_12 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_12,
			                                     temp_haber_1 = $hab_12,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_12'
						  where temp_tip_tra = 12";
           $res_temp = mysql_query($act_temp);
		}
	   } 
	    if (isset($_POST['deb_13'])){
		    if (isset($_POST['hab_13'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_13 = $_POST['deb_13'];
		   $hab_13 = $_POST['hab_13'];
		   $glo_13 = $_POST['glo_13'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 13";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_13 > 0){
		           $deb_2 = $deb_13 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_13 > 0){
		            $hab_2 = $hab_13 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_13,
			                                     temp_haber_1 = $hab_13,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_13'
						  where temp_tip_tra = 13";
           $res_temp = mysql_query($act_temp) ;
		}
	   }   
	    if (isset($_POST['deb_14'])){
		    if (isset($_POST['hab_14'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_14 = $_POST['deb_14'];
		   $hab_14 = $_POST['hab_14'];
		   $glo_14 = $_POST['glo_14'];
		     $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 14";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_14 > 0){
		           $deb_2 = $deb_14 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_14 > 0){
		            $hab_2 = $hab_14 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_14,
			                                     temp_haber_1 = $hab_14,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_14'
						  where temp_tip_tra = 14";
           $res_temp = mysql_query($act_temp) ;
		}
	   }   
	    if (isset($_POST['deb_15'])){
		    if (isset($_POST['hab_15'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_15 = $_POST['deb_15'];
		   $hab_15 = $_POST['hab_15'];
		   $glo_15 = $_POST['glo_15'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 15";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_15 > 0){
		           $deb_2 = $deb_15 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_15 > 0){
		            $hab_2 = $hab_15 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_15,
			                                     temp_haber_1 = $hab_15,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_15'
						  where temp_tip_tra = 15";
           $res_temp = mysql_query($act_temp) ;
		}
	   } 
	    if (isset($_POST['deb_16'])){
		    if (isset($_POST['hab_16'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_16 = $_POST['deb_16'];
		   $hab_16 = $_POST['hab_16'];
		   $glo_16 = $_POST['glo_16'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 16";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_16 > 0){
		           $deb_2 = $deb_16 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_16 > 0){
		            $hab_2 = $hab_16 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_16,
			                                     temp_haber_1 = $hab_16,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_16'
						  where temp_tip_tra = 16";
           $res_temp = mysql_query($act_temp) ;
		}
	   }         
	   if (isset($_POST['deb_17'])){
		    if (isset($_POST['hab_17'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_17 = $_POST['deb_17'];
		   $hab_17 = $_POST['hab_17'];
		   $glo_17 = $_POST['glo_17'];
		     $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 17";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_17 > 0){
		           $deb_2 = $deb_17 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_17 > 0){
		            $hab_2 = $hab_17 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_17,
			                                     temp_haber_1 = $hab_17,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_17'
						  where temp_tip_tra = 17";
           $res_temp = mysql_query($act_temp) ;
		}
	   }      
	    if (isset($_POST['deb_18'])){
		    if (isset($_POST['hab_18'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_18 = $_POST['deb_18'];
		   $hab_18 = $_POST['hab_18'];
		   $glo_18 = $_POST['glo_18'];
		     $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 18";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_18 > 0){
		           $deb_2 = $deb_18 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_18 > 0){
		            $hab_2 = $hab_18 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_18,
			                                     temp_haber_1 = $hab_18,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_18'
						                         where temp_tip_tra = 18";
           $res_temp = mysql_query($act_temp);
		}
	   } 
	   if (isset($_POST['deb_19'])){
		    if (isset($_POST['hab_19'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_19 = $_POST['deb_19'];
		   $hab_19 = $_POST['hab_19'];
		   $glo_19 = $_POST['glo_19']; 
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 19";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_19 > 0){
		           $deb_2 = $deb_19 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_19 > 0){
		            $hab_2 = $hab_19 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_19,
			                                     temp_haber_1 = $hab_19,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_19'
						  where temp_tip_tra = 19";
           $res_temp = mysql_query($act_temp) ;
		}
	   }        
	   if (isset($_POST['deb_20'])){
		    if (isset($_POST['hab_20'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_20 = $_POST['deb_20'];
		   $hab_20 =  $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 20";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_20 > 0){
		           $deb_2 = $deb_20 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_20 > 0){
		            $hab_2 = $hab_20 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }$_POST['hab_20'];
		   $glo_20 = $_POST['glo_20'];
		    
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_20,
			                                     temp_haber_1 = $hab_20,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_20'
						  where temp_tip_tra = 20";
           $res_temp = mysql_query($act_temp) ;
		}
	   } 
	   if (isset($_POST['deb_21'])){
		    if (isset($_POST['hab_21'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_21 = $_POST['deb_21'];
		   $hab_21 = $_POST['hab_21'];
		   $glo_21 = $_POST['glo_21'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 21";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_21 > 0){
		           $deb_2 = $deb_21 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_21 > 0){
		            $hab_2 = $hab_21 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_21,
			                                     temp_haber_1 = $hab_21,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_21'
						  where temp_tip_tra = 21";
           $res_temp = mysql_query($act_temp);
		}
	   }           
	   if (isset($_POST['deb_22'])){
		    if (isset($_POST['hab_22'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_22 = $_POST['deb_22'];
		   $hab_22 = $_POST['hab_22'];
		   $glo_22 = $_POST['glo_22'];
		     $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 22";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_22 > 0){
		           $deb_2 = $deb_22 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_22 > 0){
		            $hab_2 = $hab_22 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_22,
			                                     temp_haber_1 = $hab_22,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_22'
						  where temp_tip_tra = 22";
           $res_temp = mysql_query($act_temp);
		}
	   }
	   if (isset($_POST['deb_23'])){
		    if (isset($_POST['hab_23'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_23 = $_POST['deb_23'];
		   $hab_23 = $_POST['hab_23'];
		   $glo_23 = $_POST['glo_23'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 23";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_23 > 0){
		           $deb_2 = $deb_23 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_23 > 0){
		            $hab_2 = $hab_23 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_23,
			                                     temp_haber_1 = $hab_23,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_23'
						  where temp_tip_tra = 23";
           $res_temp = mysql_query($act_temp) ;
		}
	   }            
	    if (isset($_POST['deb_24'])){
		    if (isset($_POST['hab_24'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_24 = $_POST['deb_24'];
		   $hab_24 = $_POST['hab_24'];
		   $glo_24 = $_POST['glo_24']; 
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 24";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_24 > 0){
		           $deb_2 = $deb_24 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_24 > 0){
		            $hab_2 = $hab_24 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_24,
			                                     temp_haber_1 = $hab_24,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_24'
						  where temp_tip_tra = 24";
           $res_temp = mysql_query($act_temp);
		}
	   }         
	    if (isset($_POST['deb_25'])){
		    if (isset($_POST['hab_25'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_25 = $_POST['deb_25'];
		   $hab_25 = $_POST['hab_25'];
		   $glo_25 = $_POST['glo_25'];
		   $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 25";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_25 > 0){
		           $deb_2 = $deb_25 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_25 > 0){
		            $hab_2 = $hab_25 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }  
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_25,
			                                     temp_haber_1 = $hab_25,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_25'
						  where temp_tip_tra = 25";
           $res_temp = mysql_query($act_temp) ;
		}
	   }  
	    if (isset($_POST['deb_26'])){
		    if (isset($_POST['hab_26'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_26 = $_POST['deb_26'];
		   $hab_26 = $_POST['hab_26'];
		   $glo_26 = $_POST['glo_26'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 26";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_26 > 0){
		           $deb_2 = $deb_26 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_26 > 0){
		            $hab_2 = $hab_26 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_26,
			                                     temp_haber_1 = $hab_26,
												 temp_debe_2 = $deb_2,
			                                     temp_haber_2 = $hab_2,
												 temp_glosa = '$glo_26'
						  where temp_tip_tra = 26";
           $res_temp = mysql_query($act_temp);
		}
	   }         
	    if (isset($_POST['deb_27'])){
		    if (isset($_POST['hab_27'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_27 = $_POST['deb_27'];
		   $hab_27 = $_POST['hab_27'];
		   $glo_27 = $_POST['glo_27'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 27";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_27 > 0){
		           $deb_2 = $deb_27 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_27 > 0){
		            $hab_2 = $hab_27 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_27,
			                                      temp_haber_1 = $hab_27,
												  temp_glosa = '$glo_27'
						  where temp_tip_tra = 27";
           $res_temp = mysql_query($act_temp) ;
		}
	   }          
	    if (isset($_POST['deb_28'])){
		    if (isset($_POST['hab_28'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_28 = $_POST['deb_28'];
		   $hab_28 = $_POST['hab_28'];
		   $glo_28 = $_POST['glo_28'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 28";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_28 > 0){
		           $deb_2 = $deb_28 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_28 > 0){
		            $hab_2 = $hab_28 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_28,
			                                      temp_haber_1 = $hab_28,
												  temp_glosa = '$glo_28'
						  where temp_tip_tra = 28";
           $res_temp = mysql_query($act_temp);
		}
	   }         
	    if (isset($_POST['deb_29'])){
		    if (isset($_POST['hab_29'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_29 = $_POST['deb_29'];
		   $hab_29 = $_POST['hab_29'];
		   $glo_29 = $_POST['glo_29'];
		    $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 29";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_29 > 0){
		           $deb_2 = $deb_29 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_29 > 0){
		            $hab_2 = $hab_29 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   } 
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_29,
			                                      temp_haber_1 = $hab_29,
												  temp_glosa = '$glo_29'
						  where temp_tip_tra = 29";
           $res_temp = mysql_query($act_temp) ;
		}
	   }         
	   if (isset($_POST['deb_30'])){
		    if (isset($_POST['hab_30'])){
			$deb_2 = 0; 
		      $hab_2 = 0;
	       $deb_30 = $_POST['deb_30'];
		   $hab_30 = $_POST['hab_30'];
		   $glo_30 = $_POST['glo_30'];
		   $lee_cta = "select * from temp_ctable3  where temp_tip_tra = 30";
           $res_cta = mysql_query($lee_cta) ;
		   while ($lin_cta = mysql_fetch_array($res_cta)) {
		          $mon_cta = substr($lin_cta ['temp_nro_cta'],5,1);
		   		 //  echo  $mon_cta, 'mon_cta';
			}	   
		   if ($mon_cta == 2){
		       if ($deb_30 > 0){
		           $deb_2 = $deb_30 / $_SESSION['TC_CONTAB']; 
			    }
				if ($hab_30 > 0){
		            $hab_2 = $hab_30 / $_SESSION['TC_CONTAB']; 
			    }
		      
		   }  
	       $act_temp  = "update temp_ctable3 set temp_debe_1 = $deb_30,
			                                      temp_haber_1 = $hab_30,
												  temp_glosa = '$glo_30'
						  where temp_tip_tra = 30";
           $res_temp = mysql_query($act_temp) ;
		}
	   }       
       $con_temp = "Select * From temp_ctable3";
       $res_temp = mysql_query($con_temp);
	   while ($lin_temp = mysql_fetch_array($res_temp)) {
             $tot_debe_1 = round($tot_debe_1 +$lin_temp['temp_debe_1'],2);
	         $tot_haber_1 = round($tot_haber_1 +$lin_temp['temp_haber_1'],2);
	    }
			
	if ($tot_debe_1 <> $tot_haber_1) {	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
    <tr>
	  <th scope="col" style="font-size:12px"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col" style="font-size:12px"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col" style="font-size:12px" ><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col" style="font-size:12px"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col" style="font-size:12px"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col" style="font-size:12px"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col" style="font-size:12px"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	 <th width="15%" scope="col" style="font-size:12px"><border="0" alt="" align="absmiddle" />GLOSA</th> 
	 
	 
	</tr>

    <?php
	$tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
	  $consulta = "Select * From temp_ctable3";
       $resultado = mysql_query($consulta);   
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
			 <td align="left"  style="font-size:12px"><?php echo $linea['temp_glosa']; ?></td>
			
			
	     </tr>
	
    <?php }  ?>
	<font color="#FF0000">
	 <?php   echo "No iguala Debe y Haber Revise y Modifique ......... ";  ?>
	 </font>
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
	 <input class="btn_form" type="submit" name="accion" value="Volver">
    
	   
	<?php    
	   
    }else{
  	  $consulta = "Select * From temp_ctable3";
       $resultado = mysql_query($consulta);   
  	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  
	</tr>

    <?php
	$tot_debe_1 = 0;
       $tot_haber_1 = 0;
	   $tot_debe_2 = 0;
       $tot_haber_2 = 0;
	   	  $consulta = "Select * From temp_ctable3";
       $resultado = mysql_query($consulta);   
     while ($linea = mysql_fetch_array($resultado)) {
            $tot_debe_1 = $tot_debe_1 +$linea['temp_debe_1'];
	        $tot_haber_1 = $tot_haber_1 +$linea['temp_haber_1'];
	        $tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	        $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
			$_SESSION['descrip'] = $linea['temp_glosa2'];

	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo $linea['temp_des_cta']; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.',',') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',','); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.',',') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',','); ?></td>
			 <td align="left"><?php echo $linea['temp_glosa']; ?></td>
	    </tr>
	
    <?php }
	
	  // echo "Revise Bien antes de Imprimir ......... ";
    
  
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
	 <input class="btn_form" type="submit" name="accion" value="Imprime Modificado">
	 <input class="btn_form" type="submit" name="accion" value="Volver">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	
 <?php
 }
  }
	} 

if(isset($_SESSION['modificar'])){ 
 if ($_SESSION['modificar'] == 1){
 
    $con_ctas1  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
    $res_ctas1 = mysql_query($con_ctas1); 
 
   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 // echo $_SESSION['cmone'];?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
	 $con_modi  = "Select * From temp_ctable3 where temp_tip_tra = $cmone";
     $res_modi = mysql_query($con_modi);
	   while ($lin_modi = mysql_fetch_array($res_modi)) { ?>
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>

	 
	</tr>
		 
    <tr> 
	  <td align="left"><?php echo encadenar(2); ?></td> 
      <th align="left">Nueva Cuenta :</th>
	  <td> <select name="nue_cta" size="1"  >
	       <?php while ($lin_cta1 = mysql_fetch_array($res_ctas1)) { ?>
           <option value=<?php echo $lin_cta1['CONTA_CTA_NRO']; ?>>
		                 <?php echo $lin_cta1['CONTA_CTA_NRO']; ?>
			              <?php echo $lin_cta1['CONTA_CTA_DESC']; ?></option>
           <?php } ?>
		    </select>
			</td>
	 <td align="left"><?php echo encadenar(50); ?></td> 		
	 </tr>	
 	  <tr>
	          <td align="left"><?php echo $lin_modi['temp_tip_tra']; ?></td> 
	 	      <td align="left"><?php echo $lin_modi['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo $lin_modi['temp_des_cta']; ?></td>
	 </tr>
</table>
<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
 <tr>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
 </tr>

	 
	 <tr>		  
		      <td align="right"><input type="text" name="nue_deb1" align="right" size="10" 
			   value="<?php echo number_format($lin_modi['temp_debe_1'], 2, '.',','); ?>">
			  <td align="right"><input type="text" name="nue_hab1" align="right" size="10"
			   value="<?php echo number_format($lin_modi['temp_haber_1'], 2, '.',','); ?>">	
			   <td align="right"><input type="text" name="nue_deb2" align="right" size="10"
			   value="<?php echo number_format($lin_modi['temp_debe_2'], 2, '.',','); ?>">
			  <td align="right"><input type="text" name="nue_hab2" align="right" size="10"
			   value="<?php echo number_format($lin_modi['temp_haber_2'], 2, '.',','); ?>">
			   <td align="right"><input type="text" name="nue_glo" align="right" 
			   value="<?php echo $lin_modi['temp_glosa']; ?>">	 	 
	     </tr>
	</table>
	<input class="btn_form" type="submit" name="accion" value="Guardar Modificacion">

</form>		 
   <?php 
		 
	   }
	  
	 
	 
	 
	$consulta  = "Select * From temp_ctable3 order by temp_debe_2";
    $resultado = mysql_query($consulta);?>
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	 
	 
	  
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
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	       <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
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
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <th align="right"><?php echo number_format($tot_debe_1, 2, '.',',') ; ?></th>
		     <th align="right"><?php echo number_format($tot_haber_1, 2, '.',','); ?></th>
		     <th align="right"><?php echo number_format($tot_debe_2, 2, '.',',') ; ?></th>
		     <th align="right" ><?php echo number_format($tot_haber_2, 2, '.',','); ?></th>
	     </tr>
  
  	</table>
	 <center>
 	
       <input class="btn_form" type="submit" name="accion" value="Graba Modificado">
       <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

  </form>
  
  
	 
	 <?php } //2b
	 
	 
	 
	 
	 
	  //}else{
	 //$_SESSION['continuar'] = 1;
	 //$_SESSION['calculo'] == 1; 
	// header('Location:cobro_pag_det_gd.php');
	 }  //1b
    // if(isset($_SESSION['grupo'])){
    //   $nom_grp =$_SESSION['grupo'];
	//   }
  }	// 1 b 
if ($_SESSION['continuar'] == 5){
    $nue_deb1 = 0;
    $nue_deb2 = 0;
	$nue_hab1 = 0;
    $nue_hab2 = 0;
	$nue_glo = "-";
     $nlin =  $_SESSION['cmone'];
     if ($_POST['nue_cta'] <> ""){ //4a  
	     $nue_cta = $_POST['nue_cta'];
		 $mon_cta = $nue_cta[5]; 
	     $_SESSION['nue_cta'] = $nue_cta;
	  }	//4b
      if ($_POST['nue_deb1'] > 0){ //5a  
	     $nue_deb1 = $_POST['nue_deb1'];
	  	 $_SESSION['nue_deb1'] = $nue_deb1;
	  } //5b
	  
	    if ($_POST['nue_hab1'] > 0){ //5a  
	     $nue_hab1 = $_POST['nue_hab1'];
	  	 $_SESSION['nue_hab1'] = $nue_hab1;
	  }
	  
      if ($_POST['nue_deb2'] > 0){ //5a  
	     $nue_hab2 = $_POST['nue_deb2'];
	  	 $_SESSION['nue_deb2'] = $nue_deb2;
	  } //5bb
	  
	    if ($_POST['nue_hab2'] > 0){ //5a  
	     $nue_hab2 = $_POST['nue_hab2'];
	  	 $_SESSION['nue_hab2'] = $nue_hab2;
	  }
	  
	  if ($_POST['nue_glo'] <> "-"){ //5a  
	     $nue_glo = $_POST['nue_glo'];
		  $nue_glo = strtoupper ($nue_glo);
	  	 $_SESSION['nue_glo'] = $nue_glo;
	  }
      if ($mon_cta == 2){ //8a
	     if ( $nue_deb2 > 0){ //9a     
            $nue_deb1 = round($nue_deb2 * $tc_ctb,2);
	        $nue_hab1 = 0;
	        }
		 if ($nue_hab2 > 0){ 
	        $nue_deb1 = 0;
	        $nue_hab1 = round($nue_hab2 * $tc_ctb,2);
	        } //8b
		 if ($nue_deb1 > 0){ //9a     
            $nue_deb2 = round($nue_deb1 / $tc_ctb,2);
	        $nue_hab2 = 0;
	        }	
		 if ($nue_hab1 > 0){ 
	        $nue_deb2 = 0;
	        $nue_hab2 = round($nue_hab1 / $tc_ctb,2);
	        } 
       } 
      $des_cta = leer_cta_des($nue_cta);
	//  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
	 // $cuantos = $_SESSION['cuantos'];
//echo $descrip.encadenar(2).$cod_cta.encadenar(2).$deb_hab.encadenar(2).$monto_t;	
	  $consulta = "update temp_ctable3 set temp_nro_cta ='$nue_cta', 
                                          temp_des_cta ='$des_cta',
						 	              temp_debe_1 = $nue_deb1,
									      temp_haber_1 = $nue_hab1,
										  temp_debe_2 = $nue_deb2,
									      temp_haber_2 = $nue_hab2,
										  temp_glosa = '$nue_glo'
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
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_Usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />Mod/Eli.</th>
	  
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
			  <td align="left"><?php echo $linea['temp_glosa']; ?></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
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
      	
	 <input class="btn_form" type="submit" name="accion" value="Elimina linea">   
	 <input class="btn_form" type="submit" name="accion" value="Graba Modificado">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>		
 <?php $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   
		   require 'con_asi_mod.php';
 } //1b?>
	
	
	 
</div>

</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>
