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
<title>Registro de Egresos</title>

<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js/calendario.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-ui.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="script/jquery.numeric.js"></script> 
<script type="text/javascript" src="js/Utilitarios.js"></script>
<script type="text/javascript" src="js/cajas_reg_ing_egr.js"></script> 
<script type="text/javascript" src="js/ValidarNumero.js"></script>  

</head>
<body>
<!--Div para la letra del campo Monto Dep_Bs-->
<div id="dialog-confirmBs1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Monto en Bolivianos no puede estar vacio.</font></p>
</div>

<div id="dialog-confirmBs2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Descripci&oacute;n no puede estar vacio.</font></p>
</div>
<div id="dialog-confirmBs3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar un opci&oacute;n</font></p>
</div>

<!--Div para la letra del campo Monto Dep_Sus-->
<div id="dialog-confirmSus1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Monto en Dolares no puede estar vacio.</font></p>
</div>

<div id="dialog-confirmSus2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo  Descripci&oacute;n no puede estar vacio.</font></p>
</div>
<div id="dialog-confirmSus3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar un opci&oacute;n</font></p>
</div>

<!-- Validcion de campos de la factura -->
<div id="dialog-confirm_Fac1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nit del Proveedor no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nro. Factura no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nro. Autorizci&oacute; no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombre Razon Social no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac5" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha de Factura no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac6" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha de Factura no puede ser mayor a la fecha actual.</font></p>
</div>
<div id="dialog-confirm_Fac7" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Importe Total no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac8" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Total NETO no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac9" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Cr&eacute;ito Fiscal IVA no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac10" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo C&oacute;digo de Control no puede estar vacio.</font></p>
</div>

	<?php
				include("header.php");
			?>



	
<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                    
                 </li>
                  <li id="menu_modulo_cajas_IngEgre">
                    
                     <img src="img/move_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. INGR./EGRE.
                    
                 </li>

<?php if($_SESSION['menu']==1){?>

                  <li id="menu_modulo_fecha">
                    
                     <img src="img/shield2_24x24.png" border="0" alt="Modulo" align="absmiddle"> EGRESOS BOLIVIANOS
                    
                 </li>
              </ul>  

<!--Cabecera del modulo con su alerta-->
 					<div id="contenido_modulo">

                      <h2> <img src="img/shield2_64x64.png" border="0" alt="Modulo" align="absmiddle"> EGRESOS BOLIVIANOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
         			  <img src="img/checkmark_32x32.png" align="absmiddle">
                      Registro Egresos Bs.
                      </div>

<?php } elseif($_SESSION['menu']==2){?>

 					<li id="menu_modulo_fecha">
                    
                     <img src="img/shield4_24x24.png" border="0" alt="Modulo" align="absmiddle"> EGRESOS DOLARES
                    
                 	</li>
              </ul>  

<!--Cabecera del modulo con su alerta-->
 						<div id="contenido_modulo">

                      <h2> <img src="img/shield4_64x64.png" border="0" alt="Modulo" align="absmiddle"> EGRESOS DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
          			      <img src="img/checkmark_32x32.png" align="absmiddle">
                          Registro Egresos $us.
                       </div>

    <?php } elseif($_SESSION['menu']==3){?>

    				<li id="menu_modulo_cajas_EgreBs">
                    
                     <img src="img/shield2_24x24.png" border="0" alt="Modulo" align="absmiddle"> EGRESOS BOLIVIANOS
                    
                 	</li>
                 	<li id="menu_modulo_fecha">
                    
                     <img src="img/save 2_24x24.png" border="0" alt="Modulo" align="absmiddle"> GRAB. EGRESOS BS.
                    
                 	</li>
              </ul>  

<!--Cabecera del modulo con su alerta-->
 						<div id="contenido_modulo">

                      <h2> <img src="img/save 2_64x64.png" border="0" alt="Modulo" align="absmiddle"> GRABAR EGRESOS BOLIVIANOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
          			      <img src="img/checkmark_32x32.png" align="absmiddle">
                          
                       </div-->
     <?php } elseif($_SESSION['menu']==4){?>

    				<li id="menu_modulo_cajas_EgreSus">
                    
                     <img src="img/shield4_24x24.png" border="0" alt="Modulo" align="absmiddle"> EGRESOS DOLARES
                    
                 	</li>
                 	<li id="menu_modulo_fecha">
                    
                     <img src="img/save 2_24x24.png" border="0" alt="Modulo" align="absmiddle"> GRAB. EGRESOS $US
                    
                 	</li>
              </ul>  

<!--Cabecera del modulo con su alerta-->
 						<div id="contenido_modulo">

                      <h2> <img src="img/save 2_64x64.png" border="0" alt="Modulo" align="absmiddle"> GRABAR EGRESOS DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
          			      <img src="img/checkmark_32x32.png" align="absmiddle">
                          
                       </div-->

   <?php }?> 
                       
 

           <?php
					 $fec = $_SESSION['fec_proc'];  //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>

<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <!--form name="form2" method="post" action="egre_retro_1.php" onSubmit="return ValidaCamposEgresos(this)"-->
  
    <?php if($_SESSION['menu'] == 1){?> 
		<form name="form2" method="post" action="egre_retro_1.php" onSubmit="return ValidaCamposBanco_Dep_Bs_Radio(this)">
		<?php }else  if($_SESSION['menu'] == 2){?> 
		 <form name="form2" method="post" action="egre_retro_1.php" onSubmit="return ValidaCamposBanco_Dep_Sus_Radio(this)">
    <?php }else  if($_SESSION['menu'] == 3){?> 
     <form name="form2" method="post" action="egre_retro_1.php">
    <?php }else  if($_SESSION['menu'] == 4){?> 
     <form name="form2" method="post" action="egre_retro_1.php">
		<?php }?>
  
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


if ($_SESSION['detalle'] == 1){
$_SESSION['monto_i'] = 0;
$_SESSION['myradio'] ="";
$_SESSION['des'] ="";
$_SESSION['nro_fact'] = 0;
$_SESSION['cta_ctbg'] = "";
$_SESSION['t_fac_fis'] = 0;
$_SESSION['imp_exe'] = 0;
$_SESSION['monto'] = 0;
$_SESSION['monto_t'] = 0;
$_SESSION['descrip'] = "";

   $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
   $resultado = mysql_query($consulta);
   $cod_mon = 0;
   $des_mon = "";
    $cta_sel = '211';
	$cta_sel2 = '5';
	$cta_sel3 = '6';
   if (isset($_SESSION['egre_bs_sus'])){
       if ($_SESSION['egre_bs_sus'] == 1){
          $cod_mon = 1;
	      $des_mon = "Bolivianos";
		  
		  $mon_des = "Monto en Bolivianos:";
        }	
       if ($_SESSION['egre_bs_sus'] == 2){
          $cod_mon = 2;
	      $des_mon = "Dolares";
		  $mon_des = "Monto en Dolares:";
       }
	   $_SESSION['des_mon'] = $des_mon;	
	   $_SESSION['moneda'] = $des_mon;
   }
$con_ctas  = "Select * From contab_cuenta where (substr(CONTA_CTA_NRO,1,3) = '$cta_sel'
	               or (substr(CONTA_CTA_NRO,1,1) BETWEEN '$cta_sel2' and '$cta_sel3'))
				  	and CONTA_CTA_NIVEL = 'A' and substr(CONTA_CTA_NRO,6,1) = '$cod_mon'
					order by CONTA_CTA_NRO";
$res_ctas = mysql_query($con_ctas);

//$datos = $_SESSION['form_buffer'];
 ?>
  <table align="center">
    <tr>
        <th align="left">Moneda:  </th>
		<td><input  class="txt_campo" type="text" name="monedas" id="monedas" value="<?php echo $des_mon; ?>" readonly></td>
     </tr>
	  <tr><th align="left">Cuenta Devengado :</th><td><input class="txt_campo_cta" type="text" name="cod_cta2" id="cod_cta2" /></td></tr>
      
	  <tr></tr>
	  <tr></tr>
	  <tr><th align="left">Cuenta Egresos :</th><td><input class="txt_campo_cta" type="text" name="cod_cta" id="cod_cta" /></td></tr>
	  <tr></tr>
     
      <!--th align="left">Cuenta Egresos :</th>
	    <td> <select name="cod_cta" id="cod_cta" size="1"  -->

	        <?php //while ($lin_cta = mysql_fetch_array($res_ctas)) { ?>
            <!--option value=<?php //echo $lin_cta['CONTA_CTA_NRO']; ?>>
			              <?php //echo $lin_cta['CONTA_CTA_NRO']; ?>
			              <?php //echo utf8_encode($lin_cta['CONTA_CTA_DESC']); ?></option-->
            <?php //} ?>
		    <!--/select></td>
       </tr-->
     
     <tr>
        <th align="left">Agencia :</th>
	    <td> <select name="cod_agencia" id="cod_agencia" size="1"  >
	    	<!--option>Seleccione una Agencia......</option-->
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
			              <?php echo utf8_encode($linea['GRAL_AGENCIA_NOMBRE']); ?></option>
            <?php } ?>
		    </select></td>
       </tr>
       
       <tr> 
         <th align="left" ><?php echo $mon_des; ?></th>
		 <td><input  class="txt_campo" type="text" name="egr_monto" id="monto" onKeyPress="return soloNum(event)"  > 
		 <div id="error_monto"></div></td>
       </tr>
       <tr>
	         <th align="left">Descripci&oacute;n :</th>

				 <td><input class="txt_campo" type="text" name="descrip" id="descrip" size="50" maxlength="70"  >
			 <div id="error_des"></div> </td>

		 </tr>
		 <tr>
		 
		<?php if ($_SESSION['EMPRESA_TIPO'] == 2){ ?>


	         <th align="left">Facturas :</th>
		 	 <td><INPUT NAME="myradio" TYPE="RADIO" VALUE="cre_fac" onClick="dialogo()"></td>
		 </tr>	

		  <tr>
	         <th align="left">Factura excenta :</th>
		 	 <td><INPUT TYPE="RADIO" NAME="myradio"   VALUE="cre_fex" onClick="dialogo()"></td>
		 </tr>	
		 <tr>
	         <th align="left">Retenci&oacute;n Servicios :</th>
		 	 <td><INPUT TYPE="RADIO" NAME="myradio"  VALUE="cre_ser"></td>
		 </tr>	
		  <tr>
	         <th align="left">Retenci&oacute;n Bienes :</th>
		 	 <td><INPUT TYPE="RADIO" NAME="myradio"  VALUE="cre_bie"></td>
		 </tr> 
		 <tr>
	         <th align="left">Gasto Simple :</th>
		 	 <td><INPUT TYPE="RADIO" NAME="myradio"  VALUE="cre_nor" ></td>
		 </tr> 
		<?php } ?>  
        </table>
	 <center>
    <br>
	    <?php if($_SESSION['menu']==1){?>

	 <input class="btn_form" type="submit" name="accion" value="Registrar Egresos Bs.">
	 	<?php } elseif($_SESSION['menu']==2){?>

	  <input class="btn_form" type="submit" name="accion" value="Registrar Egresos Sus.">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
     <?php } ?>
</form>

<div id="dialog" title="Datos de la Factura" style="display:none; width: 300px;" >
    <form name="form2" method="post" action="grab_fact.php"  onSubmit="return ValidaCamposFactura(this)">


            <table align="center" class="table_usuario" style="font:10; width:400px;">
  
             <tr>
                <th align="left">NIT del Proveedor:</th>
                <td><input class="txt_campo" type="text" name="nit" id="nit" size="15" maxlength="15" onKeyPress="return soloNum(event)"  > 
                <div id="error_nit"></div></td>
             </tr>
             <tr>
                <th align="left">Nro. de Factura:</th>
                 <td><input class="txt_campo" type="text" name="nro_fac" id="nro_fac" size="10" maxlength="10" onKeyPress="return soloNum(event)" > 
                <div id="error_nro_fac"></div> </td>
             </tr> 
             <tr>
                <th align="left" >Nro de Autorizaci&oacute;n:</th>
                <td><input class="txt_campo" type="text" name="nro_auto" id="nro_auto" maxlength="15"  size="15" onKeyPress="return soloNum(event)" > <div id="error_nro_auto"></div></td>
            </tr>
            <tr>
                <th align="left" >Nombre o Razon Social:</th>
                <td><input class="txt_campo" type="text" name="razon_social" id="razon_social" maxlength="60"  size="10" > 
        <div id="error_razon_social"></div></td>
           </tr>
           <tr>   
              <th align="left" >Fecha de Factura:</th>
              <td><input class="txt_campo" type="text" name="fec_fac" id="datepicker" maxlength="10"  size="10"  >  
        <div id="error_fec_fac"></div></td>
         </tr>
          <tr>
            <th align="left">Importe Total:</th>
              <td><input class="txt_campo" type="text" name="imp_tot" id="imp_tot" size="15" maxlength="15" readonly> 
              <div id="error_imp_tot"></div>
            </td>
         </tr>
         <tr>
              <th align="left">Importe ICE:</th>
              <td><input class="txt_campo" type="text" name="imp_ice" id="imp_ice" size="10" maxlength="10" onKeyPress="return soloNum(event)" > 
              </td>
        </tr> 
         <tr>
              <th align="left" >Importe Excenta:</th>
             <td><input class="txt_campo" type="text" name="imp_excento" id="imp_excento" maxlength="10"  size="10" onKeyPress="return soloNum(event)" > </td>
         </tr>
         <tr>
              <th align="left" >Total NETO:</th>
             <td><input class="txt_campo" type="text" name="tot_neto" id="tot_neto" maxlength="10"  size="10" onKeyPress="return soloNum(event)" >    <div id="error_tot_neto"></div></td>
         </tr>
         <tr>   
             <th align="left" >Cr&eacute;dito Fiscal IVA:</th>
              <td><input class="txt_campo" type="text" name="cred_fisc_iva" id="cred_iva" maxlength="10"  size="10"   readonly> 
            <div id="error_cred_iva"></div> </td>
         </tr>
         <tr>   
            <th align="left" >C&oacute;digo de Control:</th>
            <td><input class="txt_campo" type="text" name="cod_control" id="cod_control" maxlength="15"  size="15" >
            <div id="error_cod_control"></div> </td>
         </tr>
         <input class="txt_campo" type="text" name="moneda" id="moneda" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="cue_egr" id="cue_egr" maxlength="10"  size="10" >
		 <input class="txt_campo" type="text" name="cue_egr2" id="cue_egr2" maxlength="10"  size="10" >
         <input class="txt_campo" type="hidden" name="ag" id="ag" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="des" id="des" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="egreso" id="egreso" value="Egresos" maxlength="10"  size="10" >
          <!--input class="txt_campo" type="text" name="cue_egr_new" id="cue_egr_new" value="" maxlength="10"  size="10" -->
       
    </table>
         <center>
            <br>
           <input class="btn_form" type="submit" name="accion" value="Grabar Egresos" style="font:10;">
          
<?php //$_SESSION['egr']=2;
      //$_SESSION['ingr']=0;
      $_SESSION['tipo']=$des_mon;
      $_SESSION['tipo']='Egresos';
 ?>
    </form>
</div>



    <?php } ?>
<?php
if ($_SESSION['detalle'] == 2){  //1a?>

        <?php
            $apli = 10000;
            $_SESSION['monto_t'] = 0;
            $_SESSION['monto_p'] = 0;
           // $_SESSION['monto_i'] = 0;
            $_SESSION['monto_125'] = 0;
            $_SESSION['monto_3'] = 0;
            //$_SESSION['t_fac_fis'] = 0;
			$_SESSION['monto_3'] = 0;
			//$_SESSION['monto'] = 0;
            $tc_ctb = $_SESSION['TC_CONTAB'];
			if(isset($_POST['cod_agencia'])){
               $c_agen = $_POST['cod_agencia'];
               $_SESSION['c_agen'] = $c_agen;
			}else{
			    $c_agen = $_SESSION['COD_AGENCIA'];
			}
            $nro_tr_caj = leer_nro_co_cja($apli,$c_agen);
          if(isset($_POST['descrip'])){
            if ($_POST['descrip'] <> ""){  
            	$descrip = $_POST['descrip'];
            	$descrip = strtoupper ($descrip);
            	$_SESSION['descrip'] = $descrip;
            	}
            }
			 if (isset($_POST['egr_monto'])){
             if ($_POST['egr_monto'] > 0){  
                if ($_SESSION['egre_bs_sus'] == 2){
            	   $_SESSION['monto_eq'] = $_POST['egr_monto'];
                     $monto_t = (($_POST['egr_monto'] * $_SESSION['TC_CONTAB'])* -1);
                  }else{
            	            $monto_t = ($_POST['egr_monto']* -1);
            	  }			
            				$_SESSION['monto_t'] =  $monto_t;
							
            	}
			}
        
           //aqui se esta separando las cuentas para poder mandar solo el numero de cuenta
		   if (isset($_POST['cod_cta'])){
              $cta_numero = explode(" ", $_POST['cod_cta']);
              $cta_ctbg =  $cta_numero[0];
              $_SESSION['cta_ctbg'] =  $cta_ctbg;
			  }
            //Separa la cuenta devengado
			 if (isset($_POST['cod_cta2'])){		
			   $cta_numero2 = explode(" ", $_POST['cod_cta2']);
			$cta_ctb =  $cta_numero2[0];
              $_SESSION['cta_ctb'] =  $cta_ctb;
			}
            //Procesos con myradio
			  if(isset($_POST['myradio'])){
		 //Normal
	   if ($_POST['myradio'] == "cre_nor"){ 
		     $_SESSION['t_fac_fis'] = 1;
		  }
		 //Pago Servicios
		 
	 if(isset($_POST['myradio'])){ 
	 
		if ($_POST['myradio'] == "cre_ser"){ 
		// echo "Aquiii";
            $_SESSION['t_fac_fis'] = 4;
			$monto_t = $monto_t * -1;
            $monto_imp = round($monto_t * .1550,2);
            $monto_neto = $monto_t - $monto_imp;
        	  $monto_fis = round(($monto_t * $monto_t) / $monto_neto,2);
        	  $cta_iue = 2111050010001; //
        	  $cta_it = 2111070010001;  // 
            $_SESSION['cta_iue'] = $cta_iue;
            $_SESSION['cta_it'] = $cta_it;
            $_SESSION['monto_fis'] = $monto_fis;
            $_SESSION['monto_125'] = round($monto_fis * 0.125,2);
            $_SESSION['monto_3'] = round($monto_fis * 0.03,2);
         // $cta_f13 = 14306101;
           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
           $res_ctable = mysql_query($con_ctable);
           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
        		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
        			     }	 
           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
           $res_ctable = mysql_query($con_ctable);
           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
        		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
        			     }	
			}			  				 
         
          if ($_POST['myradio'] == "cre_bie"){ 
		      $_SESSION['t_fac_fis'] = 5;
		  
		      $cta_ctbg = $_SESSION['cta_ctbg'];
		      $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		             $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			   }	
            $_SESSION['t_fac_fis'] = 5;
            $monto_imp = round($monto_t * .08,2);
            $monto_neto = $monto_t - $monto_imp;
        	$monto_fis = round(($monto_t * $monto_t) / $monto_neto,2);
        	$cta_iue = 2111060010001; //
        	$cta_it = 2111070010001;  // 
          $_SESSION['cta_iue'] = $cta_iue;
           $_SESSION['cta_it'] = $cta_it;
          $_SESSION['monto_fis'] = $monto_fis * -1;
          $_SESSION['monto_125'] = round($monto_fis * 0.05,2)* -1;
          $_SESSION['monto_3'] = round($monto_fis * 0.03,2)*-1;
         // $cta_f13 = 14306101;
           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
           $res_ctable = mysql_query($con_ctable);
           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
        		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
        			     }	 
           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
           $res_ctable = mysql_query($con_ctable);
           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
        		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
        		}	 				 
            }
           }
        }
			
		//	
			
			
			
			
			
       /*     if(isset($_POST['cre_fac'])){
              $_SESSION['t_fac_fis'] = 2;
              
              $_SESSION['monto_i'] = $monto_t * .13 ;
              
              $_SESSION['monto_p'] = $monto_t - $_SESSION['monto_i'];
              $cta_f13 = 14306101;
              $_SESSION['cta_f13'] = $cta_f13;
               $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_f13'";
               $res_ctable = mysql_query($con_ctable);
               while ($lin_ctable = mysql_fetch_array($res_ctable)) {
            		            $des_ctaf13 = $lin_ctable['CONTA_CTA_DESC'];
            		 }	 
             } */
             //Factura excenta
             if(isset($_POST['cre_fex'])){
              $_SESSION['t_fac_fis'] = 3;
              ?>
         <center>
           <tr> 
                 <th align="left" >Importe Sujeto a Crédito Fiscal :</th>
        		 <td><input  type="text" name="imp_exe"> </td>
               </tr>
        <br><br>	   
         <input class="btn_form" type="submit" name="accion" value="Recalcular">
         <!--input class="btn_form" type="submit" name="accion" value="Salir"-->	
        <br><br>	    
         <?php 
         
         }
 //Pago Servicios
 /*
         if(isset($_POST['cre_ser'])){
            $_SESSION['t_fac_fis'] = 4;
            $monto_imp = $monto_t * .1550;
            $monto_neto = $monto_t - $monto_imp;
        	  $monto_fis = ($monto_t * $monto_t) / $monto_neto;
        	  $cta_iue = 24203105; //
        	  $cta_it = 24203104;  // 
            $_SESSION['cta_iue'] = $cta_iue;
            $_SESSION['cta_it'] = $cta_it;
            $_SESSION['monto_fis'] = $monto_fis;
            $_SESSION['monto_125'] = $monto_fis * 0.125;
            $_SESSION['monto_3'] = $monto_fis * 0.03;
         // $cta_f13 = 14306101;
           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
           $res_ctable = mysql_query($con_ctable);
           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
        		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
        			     }	 
           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
           $res_ctable = mysql_query($con_ctable);
           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
        		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
        			     }	 				 
         } */
		 /*
          if(isset($_POST['cre_bie'])){
            $_SESSION['t_fac_fis'] = 5;
            $monto_imp = $monto_t * .08;
            $monto_neto = $monto_t - $monto_imp;
        	$monto_fis = ($monto_t * $monto_t) / $monto_neto;
        	$cta_iue = 24203105; //
        	$cta_it = 24203104;  // 
          $_SESSION['cta_iue'] = $cta_iue;
           $_SESSION['cta_it'] = $cta_it;
          $_SESSION['monto_fis'] = $monto_fis;
          $_SESSION['monto_125'] = $monto_fis * 0.05;
          $_SESSION['monto_3'] = $monto_fis * 0.03;
         // $cta_f13 = 14306101;
           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_iue'";
           $res_ctable = mysql_query($con_ctable);
           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
        		            $des_ctaiue = $lin_ctable['CONTA_CTA_DESC'];
        			     }	 
           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_it'";
           $res_ctable = mysql_query($con_ctable);
           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
        		            $des_ctait = $lin_ctable['CONTA_CTA_DESC'];
        			     }	 				 
         }
*/
 
 
if ($_SESSION['t_fac_fis'] <> 3){ 
 
echo "Detalle Contable";

?>

 <table width="80%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
      <tr>
          <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
      	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
      	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
      	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
      	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
      	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	    </tr>
	           

<?php	
if ($_SESSION['egre_bs_sus'] == 1){
 if (isset($_POST['egr_monto'])){
		      $imp_or = $_POST['egr_monto'];
			  $_SESSION['imp_or'] = $imp_or;
		      $importe = $_SESSION['monto_t'];
			//  $cta_ctb = 1111010010001;
			  $cta_ctb = $_SESSION['cta_ctb'];
			  $importe_e =0;
			  $deb_hab = 2;
	}		  
			 // echo $_POST['egr_monto']."****".$_SESSION['monto_t'].$importe;
	 } else {
	       if (isset($_POST['egr_monto'])){
	         $imp_or = $_POST['egr_monto'] * $_SESSION['TC_CONTAB'];
			  $_SESSION['imp_or'] = $imp_or;
		      $importe = $_SESSION['monto_t'];
			//  $cta_ctb = 1111010020002;
			 // $_SESSION['cta_ctb'] = $cta_ctb;
			  $cta_ctb = $_SESSION['cta_ctb'];
			  $importe_e =$_SESSION['monto_eq'];
			  $deb_hab = 2;
			  }
	 }	
	if (isset($cta_ctb)){  	  
			  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctb'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctable = $lin_ctable['CONTA_CTA_DESC'];
			     }
		 }	
	if (isset($cta_ctbg)){  		 	 
			  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			     }	 
			     echo $des_ctableg;
		}		 
	?>
	 
		<?php 
		 if(isset($_SESSION['t_fac_fis'])){
			 if($_SESSION['t_fac_fis'] == 2){
              echo encadenar(2).$_SESSION['des'];
             
              $monto_i = $_SESSION['monto_i'];
              
              $_SESSION['monto_p'] = $_SESSION['monto'] - $_SESSION['monto_i'];
              $cta_f13 = 1141010010001;
              $_SESSION['cta_f13'] = $cta_f13;
               $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_f13'";
               $res_ctable = mysql_query($con_ctable);
               while ($lin_ctable = mysql_fetch_array($res_ctable)) {
            		            $des_ctaf13 = $lin_ctable['CONTA_CTA_DESC'];
            		 }
					 
					  
             }
			 }
		
		
		
//echo $_POST['myradio'];

    if(isset($_POST['myradio'])){ 
    if ($_POST['myradio'] == "cre_nor"){  ?>
			      
      <tr>
      		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
      		 <td align="left" ><?php echo $des_ctableg; ?></td> 
      		 <td align="right" ><?php echo number_format(($imp_or), 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(($imp_or/ $_SESSION['TC_CONTAB']), 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      </tr>
      <tr>
      		 <td align="left" ><?php echo $cta_ctb; ?></td> 
      		 <td align="left" ><?php echo $des_ctable; ?></td> 
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(($imp_or), 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(($imp_or/ $_SESSION['TC_CONTAB']), 2, '.',','); ?></td>
      </tr>
		 <?php } ?>
		 <?php } ?>
		 <?php 

     
	if(isset($_SESSION['myradio'])){
	   if (($_SESSION['myradio'] == "cre_fex")or ($_SESSION['myradio'] == "cre_fac")){  
	    	$monto_i = $_SESSION['monto_i'];
            $_SESSION['monto_p'] = $_SESSION['monto'] - $_SESSION['monto_i'];
            $cta_f13 = 1141010010001;
            $_SESSION['cta_f13'] = $cta_f13;
            $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_f13'";
            $res_ctable = mysql_query($con_ctable);
            while ($lin_ctable = mysql_fetch_array($res_ctable)) {
                   $des_ctaf13 = $lin_ctable['CONTA_CTA_DESC'];
            }
		//Cuenta Gasto
	        if(isset($_SESSION['cue_egr'])){
		       $cta_numero = explode(" ", $_SESSION['cue_egr']);
		       $cta_ctbg = $cta_numero[0];
		       $_SESSION['descrip'] = $_SESSION['des'];
		    }
		//Cuenta devengado
		    if(isset($_SESSION['cta_ctb'])){
		       $cta_numero = explode(" ", $_SESSION['cta_ctb']);
		       $cta_ctb = $cta_numero[0];
		       $_SESSION['cta_ctb'] = $cta_ctb;
		    }
		//$cta_ctbg = $_SESSION['cue_egr'];
		 $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
         $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			     }
		 $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctb'";
         $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctable= $lin_ctable['CONTA_CTA_DESC'];
			     }		 
		if($_SESSION['myradio'] == "cre_fac"){ 
		   $_SESSION['monto_i'] = $_SESSION['monto_i'] * -1;
		   ?>
		
  		<tr>
      		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
      		 <td align="left" ><?php echo $des_ctableg; ?></td> 
      		 <td align="right" ><?php echo number_format(($_SESSION['monto'] + $_SESSION['monto_i']), 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(($_SESSION['monto'] + $_SESSION['monto_i'])/$_SESSION['TC_CONTAB'], 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
  		</tr>
  		<tr>
      		 <td align="left" ><?php echo $cta_f13; ?></td> 
      		 <td align="left" ><?php echo $des_ctaf13; ?></td> 
      		 <td align="right" ><?php echo number_format( ($_SESSION['monto_i']*-1), 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(($_SESSION['monto_i']/$_SESSION['TC_CONTAB'])*-1, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
  		</tr>
  		<tr>
      		 <td align="left" ><?php echo  $_SESSION['cta_ctb']; ?></td> 
      		 <td align="left" ><?php echo $des_ctable; ?></td> 
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format($_SESSION['monto'], 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format($_SESSION['monto']/$_SESSION['TC_CONTAB'], 2, '.',','); ?></td>
  		</tr>
         <?php 
		    }
			 
			if($_SESSION['myradio'] == "cre_fex"){ 
			$_SESSION['monto_i'] = round($_SESSION['imp_exe'] * 0.13,2);
			$_SESSION['monto_e'] = $_SESSION['monto'] - $_SESSION['monto_i'];
			
			
		?>
		
  		<tr>
      		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
      		 <td align="left" ><?php echo $des_ctableg; ?></td> 
      		 <td align="right" ><?php echo number_format(($_SESSION['monto_e']), 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(($_SESSION['monto_e']/$_SESSION['TC_CONTAB']), 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
  		</tr>
  		<tr>
      		 <td align="left" ><?php echo $cta_f13; ?></td> 
      		 <td align="left" ><?php echo $des_ctaf13; ?></td> 
      		 <td align="right" ><?php echo number_format($_SESSION['monto_i'], 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(($_SESSION['monto_i']/$_SESSION['TC_CONTAB']), 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
  		</tr>
  		<tr>
      		 <td align="left" ><?php echo $_SESSION['cta_ctb']; ?></td> 
      		 <td align="left" ><?php echo $des_ctable; ?></td> 
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format($_SESSION['monto'], 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format($_SESSION['monto']/$_SESSION['TC_CONTAB'], 2, '.',','); ?></td>
  		</tr>
         <?php } } } //}
		if(isset($_POST['myradio'])){
		 if ($_POST['myradio'] == "cre_ser"){ 
		           $cta_ctbg = $_SESSION['cta_ctbg'];
		           $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
                   $res_ctable = mysql_query($con_ctable);
		           while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		                  $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			             }	  
				 ?>
              		 <tr>
              		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
              		 <td align="left" ><?php echo $des_ctableg; ?></td> 
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_fis']),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" >
					 <?php echo number_format(round(($_SESSION['monto_fis']),2)/$_SESSION['TC_CONTAB'], 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		</tr>
              		 <tr>
              		 <td align="left" ><?php echo $cta_ctb; ?></td> 
              		 <td align="left" ><?php echo $des_ctable; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format($imp_or/$_SESSION['TC_CONTAB'], 2, '.',','); ?></td>
              		</tr>
              		<tr>
              		 <td align="left" ><?php echo $cta_iue; ?></td> 
              		 <td align="left" ><?php echo $des_ctaiue; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_125']),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" >
					 <?php echo number_format($_SESSION['monto_125']/$_SESSION['TC_CONTAB'], 2, '.',','); ?></td>
              		</tr>	
              		<tr>
              		 <td align="left" ><?php echo $cta_it; ?></td> 
              		 <td align="left" ><?php echo $des_ctait; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_3']),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" >
					 <?php echo number_format(round($_SESSION['monto_3']/$_SESSION['TC_CONTAB']), 2, '.',','); ?></td>
              		</tr>
			
         <?php } } //}?>
	<?php  if(isset($_POST['myradio'])){
	if ($_POST['myradio'] == "cre_bie"){ 
	//echo "Aquiii ret bienes";
	         
			     ?>
              		 <tr>
              		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
              		 <td align="left" ><?php echo $des_ctableg; ?></td> 
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_fis']),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		</tr>
              		 <tr>
              		 <td align="left" ><?php echo $cta_ctb; ?></td> 
              		 <td align="left" ><?php echo $des_ctable; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
              		</tr>
              		<tr>
              		 <td align="left" ><?php echo $cta_iue; ?></td> 
              		 <td align="left" ><?php echo $des_ctaiue; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_125'] ),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		</tr>	
              		<tr>
              		 <td align="left" ><?php echo $cta_it; ?></td> 
              		 <td align="left" ><?php echo $des_ctait; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_3'] ),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		</tr>
			
         <?php } }?>	 
 </table> 
 	
<center>
  <br>
   <?php if($_SESSION['menu'] == 3){?> 
     <input class="btn_form" type="submit" name="accion" value="Imprimir Bs">
    <?php }else  if($_SESSION['menu'] == 4){?> 
     <input class="btn_form" type="submit" name="accion" value="Imprimir Sus">
    <?php }?>

 <!--input class="btn_form" type="submit" name="accion" value="Imprimir"-->
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->



 <?php } ?>
 <?php } ?>
 
 <?php 
 if ($_SESSION['detalle'] == 4){
    $imp_or = $_SESSION['monto_t'] * -1;
	//	      $importe = $monto_t;
	 $cta_ctb = 11101101;
	 $_SESSION['cta_ctb'] = $cta_ctb;
	// $importe_e =$monto_t;
	 $deb_hab = 2;
			  
	 $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctb'";
     $res_ctable = mysql_query($con_ctable);
	  while ($lin_ctable = mysql_fetch_array($res_ctable)) {
	        $des_ctable = $lin_ctable['CONTA_CTA_DESC'];
	     }
$cta_ctbg = $_SESSION['cta_ctbg'];
$con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			     }	 		 
$_SESSION['t_fac_fis'] = 3;
 if(isset($_POST['imp_exe'])){
		    //echo "entra aqui?";
            $_SESSION['imp_exe'] = $_POST['imp_exe'];
			}
 if(isset($_SESSION['imp_exe'])){ 
  
  $monto_t = $_SESSION['imp_exe'];
  $_SESSION['monto_i'] = $monto_t * .13 ;
  
  $_SESSION['monto_p'] = $imp_or - $_SESSION['monto_i'];
  $cta_f13 = 14306101;
  $_SESSION['cta_f13'] = $cta_f13;
   $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_f13'";
   $res_ctable = mysql_query($con_ctable);
   while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctaf13 = $lin_ctable['CONTA_CTA_DESC'];
		 }	 
     }
	 ?>
 	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  
	</tr> 
	<tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format($_SESSION['monto_p'], 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <tr>
		 <td align="left" ><?php echo $cta_f13; ?></td> 
		 <td align="left" ><?php echo $des_ctaf13; ?></td> 
		 <td align="right" ><?php echo number_format( ($_SESSION['monto_i'] ), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		<tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
	</table>
  <br> 	
<center>	
  <br>
   <?php if($_SESSION['menu'] == 3){?> 
     <input class="btn_form" type="submit" name="accion" value="Imprimir Bs">
    <?php }else  if($_SESSION['menu'] == 4){?> 
     <input class="btn_form" type="submit" name="accion" value="Imprimir Sus">
    <?php }?>

     <!--input class="btn_form" type="submit" name="accion" value="Imprimir"-->
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
 </form>
	<?php  
	 
	 
  //echo $_SESSION['monto_i'].encadenar.$_SESSION['monto_p'].encadenar(2).$_SESSION['cta_f13'];
  
 }
 
 
 
 
 
 
 
if ($_SESSION['detalle'] == 3){
   $apli = 10000;
   $tc_ctb = $_SESSION['TC_CONTAB'];
   $c_agen = $_SESSION['c_agen'];
   $descrip = $_SESSION['descrip'];
   $monto_t = $_SESSION['monto_t'] * -1;
   $cta_ctbg = $_SESSION['cta_ctbg'];
   $cta_ctb = 
   $nro_tr_caj = leer_nro_co_cja($apli,$c_agen);
   
    echo "aqui".$c_agen.$nro_tr_caj,$descrip,$monto_t,$cta_ctbg ;
  
	header('Location: egre_mante.php');
	?>
  <?php } ?>
	 
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