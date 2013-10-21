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

   // $_SESSION['egr']=0;
    //  $_SESSION['ingr']=0;
?>
<html>
<head>
<title>Deposito - Retiro Bancos</title>

<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js/calendario.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-ui.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="script/jquery.numeric.js"></script>
<script type="text/javascript" src="js/cjas_depret_depbs.js"></script>  
<script type="text/javascript" src="js/Utilitarios.js"></script>
<script type="text/javascript" src="js/ValidarListaRadio.js"></script>  
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
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar Tipo de transacci&oacute;n</font></p>
</div>
<div id="dialog-confirmDep" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe Ingresar Nro. Deposito</font></p>
</div>

<!--Div para la letra del campo Monto Dep_Sus-->
<div id="dialog-confirmSus1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Monto en Dolares no puede estar vacio.</font></p>
</div>
<div id="dialog-confirmSus2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Descripci&oacute;n no puede estar vacio.</font></p>
<div id="dialog-confirmSus3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar Tipo de transacci&oacute;n</font></p>
</div>

<!--Div para Validar formulario-->
  
</div>
<div id="dialog-confirm_Fac1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo NIT  no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nro. de Factura no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nro de Autorizaci&oacute;n no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombre o Razon Social no puede estar vacio.</font></p>
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
<div id="alertachequeutilizado" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 9px 40px 0;"></span><font size="2">Cheque utilizado !!!
  <br> REVISE NUMERO DE CHEQUE </font></p>
</div>
<div id="alertachequeramal" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 9px 40px 0;"></span><font size="2">Cheque fuera de Rango!!!
  <br> REVISE DATOS.... </font></p>
</div>
<!--Div para Validar Nose-->
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Seleccione un deposito o retiro</font></p>
</div>
<div id="dialog-cod_bco" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Seleccione Cuenta de Banco</font></p>
</div>
<div id="dialog-cod_ban_Fac2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Falta Cuenta de Banco</font></p>
</div>
<div id="dialog-cod_cta" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Seleccione Contra Cuenta</font></p>
</div>
<div id="dialog-con_cuen_Fac2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Falta Contra Cuenta</font></p>
</div>


	<?php
					include("header.php");
			?>
	<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_cjas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO TESORERIA
                    
                 </li>
                  <li id="menu_modulo_cjas_depret">
                    
                     <img src="img/bancos_24x24.png" border="0" alt="Modulo" align="absmiddle"> DEP./RET. BANCOS
                    
                 </li>
				  </li>

				   <?php
                      if($_SESSION['menu'] == 10){?> 

                  <li id="menu_modulo_fecha">
                    
                     <img src="img/shield4_24x24.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS BS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/shield4_64x64.png" border="0" alt="Modulo" align="absmiddle">DEPOSITOS BS</h2>
                      <hr style="border:1px dashed #767676;">
					    <div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                           Ingrese los datos del deposito
                     </div>  

                   <?php }elseif ($_SESSION['menu'] == 11) {?>

                    <li id="menu_modulo_fecha">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS $US
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/shield1_64x64.png" border="0" alt="Modulo" align="absmiddle">DEPOSITOS DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                           Ingrese los datos del deposito
                     </div>



                       <?php } elseif ($_SESSION['menu'] == 12) {?>

                        <li id="menu_modulo_fecha">
                    
                     <img src="img/shield2_24x24.png" border="0" alt="Modulo" align="absmiddle"> RETIRO BS
                    
                 </li>
              </ul> 
				<!--Cabecera del modulo con su alerta-->
     			<div id="contenido_modulo">
                      <h2> <img src="img/shield2_64x64.png" border="0" alt="Modulo" align="absmiddle">RETIRO BOLIVIANOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                           Ingrese los datos del retiro
                     </div>

                      <?php }elseif ($_SESSION['menu'] == 13) {?>

                      <li id="menu_modulo_fecha">
                    
                     <img src="img/shield3_24x24.png" border="0" alt="Modulo" align="absmiddle"> RETIRO $US
                    
                 </li>
              </ul> 
				<!--Cabecera del modulo con su alerta-->
     			<div id="contenido_modulo">
                      <h2> <img src="img/shield3_64x64.png" border="0" alt="Modulo" align="absmiddle">RETIRO DOLARES</h2>
                       <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                         <img src="img/checkmark_32x32.png" align="absmiddle">
                          Ingrese los datos del retiro
                         
                    </div>

                     <?php }elseif ($_SESSION['menu'] == 14) {?>
                      <li id="menu_modulo_cjas_depret_dep">
                    
                     <img src="img/shield4_24x24.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS BS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITADO BS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">DEPOSITADO BS</h2>
                      <hr style="border:1px dashed #767676;">
					    <!--div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                           Ingrese los datos del deposito
                     </div-->  

                     <?php }elseif ($_SESSION['menu'] == 15) {?>
                      <li id="menu_modulo_cjas_depret_depdol">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS $US
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITADO $US
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">DEPOSITADO $US</h2>
                      <hr style="border:1px dashed #767676;">
					    <!--div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                           Ingrese los datos del deposito
                     </div-->  

                       <?php }elseif ($_SESSION['menu'] == 16) {?>
                      <li id="menu_modulo_cjas_depret_ret">
                    
                     <img src="img/shield2_24x24.png" border="0" alt="Modulo" align="absmiddle"> RETIRO BS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> RETIRO BCO. BS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">RETIRO BOLIVIANOS</h2>
                      <hr style="border:1px dashed #767676;">
					    <!--div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                           Ingrese los datos del deposito
                     </div-->  

                     <?php }elseif ($_SESSION['menu'] == 17) {?>
                      <li id="menu_modulo_cjas_depret_retdol">
                    
                     <img src="img/shield3_24x24.png" border="0" alt="Modulo" align="absmiddle"> RETIRO $US
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> RETIRO BCO $US
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">RETIRO  DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
					    <!--div id="error_login"> 
                          <img src="img/checkmark_32x32.png" align="absmiddle">
                           Ingrese los datos del deposito
                     </div--> 
<?php } ?>

<!--EGRESOS-->

<div id="dialog" title="Deposito de la Factura" style="display:none; width: 300px;" >

    <form name="form2" method="post" action="grab_fact.php"  onSubmit="return ValidaCamposFactura(this)">


            <table align="center" class="table_usuario" style="font:10; width:400px;">
  
             <tr>
                <th align="left">NIT del Cliente:</th>
                <td><input class="txt_campo" type="text" name="nit" id="nit" size="15" maxlength="15" onKeyPress=""  > 
                <div id="error_nit"></div></td>
             </tr>
             <tr>
                <th align="left">Nro. de Factura:</th>
                 <td><input class="txt_campo" type="text" name="nro_fac" id="nro_fac" size="10" maxlength="10" onKeyPress="" > 
                <div id="error_nro_fac"></div> </td>
             </tr> 
             <tr>
                <th align="left" >Nro de Autorizaci&oacute;n:</th>
                <td><input class="txt_campo" type="text" name="nro_auto" id="nro_auto" maxlength="15"  size="15" onKeyPress="" > 
                <div id="error_nro_auto"></div></td>
            </tr>
            <tr>
                <th align="left" >Nombre o Razon Social:</th>
                <td><input class="txt_campo" type="text" name="razon_social" id="razon_social" maxlength="60"  size="10" > 
        <div id="error_razon_social"></div></td>
           </tr>
           <tr>   
              <th align="left" >Fecha de Factura:</th>
              <td><input class="txt_campo" type="text" name="fec_fac" id="datepicker" maxlength="10"  size="10"  onKeyPress="" >  
              <div id="error_fec_fac"></div> </td>
         </tr>
          <tr>

            <th align="left">Importe Total :</th>
              <td><input class="txt_campo" type="text" name="imp_tot" id="imp_tot" size="15" maxlength="15" onKeyPress=""  readonly> 

              <div id="error_imp_tot"></div>
            </td>
         </tr>
         <tr>
              <th align="left">Importe ICE:</th>
              <td><input class="txt_campo" type="text" name="imp_ice" id="imp_ice" size="10" maxlength="10" onKeyPress="" > 
              <div id="error_imp_ice"></div></td>
        </tr> 
         <tr>
              <th align="left" >Importe Excenta:</th>
             <td><input class="txt_campo" type="text" name="imp_excento" id="imp_excento" maxlength="10"  size="10" onKeyPress="" > 
             <div id="error_imp_excento"></div></td>
         </tr>
         <tr>
              <th align="left" >Total NETO:</th>
             <td><input class="txt_campo" type="text" name="tot_neto" id="tot_neto" maxlength="10"  size="10" onKeyPress="" >     
             <div id="error_tot_neto"></div></td>
         </tr>
         <tr>   
             <th align="left" >Credito Fiscal IVA :</th>
              <td><input class="txt_campo" type="text" name="cred_fisc_iva" id="cred_fisc_iva" maxlength="10"  size="10"  onKeyPress=""  readonly> 

            <div id="error_cred_fisc_iva"></div> </td>
         </tr>
         <!--tr>   
            <th align="left" >C&oacute;digo de Control:</th>
            <td><input class="txt_campo" type="text" name="cod_control" id="cod_control" maxlength="15"  size="15" >
            <div id="error_cod_control"></div> </td>
         </tr-->
         <tr>   
            <th align="left" >Factura Anulada:</th>
            <td>
        <input type="checkbox" name="fac_anu" ><br>
              
            <div id="error_llave"></div> </td>
         </tr>
          
          <!--aqui es para grabar los datos del formulario principal-->
          <input class="txt_campo" type="hidden" name="cod_ban" id="cod_ban" maxlength="10"  size="10" >
          <input class="txt_campo" type="hidden" name="con_cuen" id="con_cuen" maxlength="10"  size="10" >
          <input class="txt_campo" type="hidden" name="trans" id="trans" maxlength="10"  size="10" >
          <input class="txt_campo" type="hidden" name="egres" id="egres" value="Deposito" maxlength="10"  size="10" >
          <!--input class="txt_campo" type="text" name="con_cuen_new" id="con_cuen_new"  maxlength="10"  size="10" -->


          <!--fin los datos del formulario principal-->

<?php ////$_SESSION['egr']=2;
      //$_SESSION['ingr']=0;
      //$_SESSION['tipo']=$_SESSION['des_tran'];
      //$_SESSION['des_tran'];
 ?>
          
    </table>
         <center>
            <br>
           <input class="btn_form" type="submit" name="accion" value="Grabar Deposito" style="font:10;">
          

    </form>
</div>

<!--INGRESOS-->
<div id="dialogo" title="Retiro  de la Factura" style="display:none; width: 300px;" >
<!--<div id="dialogo" title="Retiro de la Factura" style="display:none; width:40%;">-->
    <form name="form2" method="post" action="grab_fact.php" onSubmit="return ValidaCampos_Retiro_Factura(this)">

            <table align="center" class="table_usuario" style="font:10; width:400px;">
  
             <tr>
                <th align="left">NIT del Proveedor:</th>
                <td><input class="txt_campo" type="text" name="nit_ret" id="nit_ret" size="15" maxlength="15" onKeyPress="return soloNum(event)" > 
                <div id="error_nit_ret"></div></td>
             </tr>
             <tr>
                <th align="left">Nro. de Factura:</th>
                 <td><input class="txt_campo" type="text" name="nro_fac_ret" id="nro_fac_ret" size="10" maxlength="10" onKeyPress="return soloNum(event)" > 
                <div id="error_nro_fac_ret"></div> </td>
             </tr> 
             <tr>
                <th align="left" >Nro de Autorizaci&oacute;n:</th>
                <td><input class="txt_campo" type="text" name="nro_auto_ret" id="nro_auto_ret" maxlength="15"  size="15" onKeyPress="return soloNum(event)" > 
                <div id="error_nro_auto_ret"></div></td>
            </tr>
            <tr>
                <th align="left" >Nombre o Razon Social:</th>
                <td><input class="txt_campo" type="text" name="razon_social_ret" id="razon_social_ret" maxlength="60"  size="10" > 
                <div id="error_razon_social_ret"></div></td>
           </tr>
           <tr>   
              <th align="left" >Fecha de Factura:</th>
              <td><input class="txt_campo" type="text" name="fec_fac_ret" id="datepicker2" maxlength="10"  size="10" > 
               <div id="error_fec_fac_ret"></div> </td>
         </tr>
          <tr>
            <th align="left">Importe Total:</th>
              <td><input class="txt_campo" type="text" name="imp_tot_ret" id="imp_tot_ret" size="15" maxlength="15" onKeyPress="return soloNum(event)" > 
              <div id="error_imp_tot_ret"></div>
            </td>
         </tr>
         <tr>
              <th align="left">Importe ICE:</th>
              <td><input class="txt_campo" type="text" name="imp_ice_ret" id="imp_ice_ret" size="10" maxlength="10" onKeyPress="return soloNum(event)" > 
              <div id="error_imp_ice_ret"></div></td>
        </tr> 
         <tr>
              <th align="left" >Importe Excenta:</th>
             <td><input class="txt_campo" type="text" name="imp_excento_ret" id="imp_excento_ret" maxlength="10"  size="10" onKeyPress="return soloNum(event)" > 
             <div id="error_imp_excento_ret"></div></td>
         </tr>
         <tr>
              <th align="left" >Total NETO:</th>
             <td><input class="txt_campo" type="text" name="tot_neto_ret" id="tot_neto_ret" maxlength="10"  size="10" onKeyPress="return soloNum(event)" >
             <div id="error_tot_neto_ret"></div> </td>
         </tr>
         <tr>   
             <th align="left" >Cr&eacute;dito Fiscal IVA:</th>
              <td><input class="txt_campo" type="text" name="cred_fisc_iva_ret" id="cred_fisc_iva_ret" maxlength="10"  size="10"  onKeyPress="return soloNum(event)" > 
            <div id="error_cred_fisc_iva_ret"></div> </td>
         </tr>
          <tr>   
            <th align="left" >C&oacute;digo de Control:</th>
            <td><input class="txt_campo" type="text" name="cod_control_ret" id="cod_control" maxlength="15"  size="15" >
            <div id="error_cod_control"></div> </td>
         </tr>
         <!--tr>   
            <th align="left" >Factura Anulada:</th>
            <td>
        <input type="checkbox" name="fac_anu" ><br>
              
            <div id="error_llave"></div> </td>
         </tr-->
         <!--aqui es para grabar los datos del formulario principal-->
<input class="txt_campo" type="hidden" name="cod_ban1" id="cod_ban1" maxlength="10"  size="10" value="" >
<input class="txt_campo" type="hidden" name="con_cuen1" id="con_cuen1" maxlength="10"  size="10" value="" >
<input class="txt_campo" type="hidden" name="trans1" id="trans1" maxlength="10"  size="10" value="" > 
<input class="txt_campo" type="hidden" name="ingres" id="ingres" value="Retiro" maxlength="10"  size="10" >
<input class="txt_campo" type="text" name="cheqra" id="cheqra" value="" maxlength="10"  size="10" >
<input class="txt_campo" type="text" name="chq" id="chq" value="" maxlength="10"  size="10" >
 <!--input class="txt_campo" type="text" name="con_cuen_new1" id="con_cuen_new1"  maxlength="10"  size="10" -->        

          <!--fin los datos del formulario principal-->
         
    </table>
         <center>
            <br>
           <input class="btn_form" type="submit" name="accion" value="Grabar Factura" style="font:10;">

<?php //$_SESSION['egr']=0;
      //$_SESSION['ingr']=1;
     // $_SESSION['tipo']=$_SESSION['des_tran'];
     
 ?>
    </form>
</div>




				<?php
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>

<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <!--form name="form2" method="post" action="bco_retro.php" onSubmit="return ValidaCamposEgresos(this)"-->
  
  <?php if($_SESSION['menu'] == 10){?> 
		<form name="form2" method="post" action="bco_retro.php" onSubmit="return ValidaCamposBanco_Dep_Bs_Radio(this)">
		<?php }else  if($_SESSION['menu'] == 11){?> 
		 <form name="form2" method="post" action="bco_retro.php" onSubmit="return ValidaCamposBanco_Dep_Sus_Radio(this)">
		 <?php }else  if($_SESSION['menu'] == 12){?> 
		<form name="form2" method="post" action="bco_retro.php" onSubmit="return ValidaCamposBanco_Ret_Bs_Radio(this)">
		 <?php }else  if($_SESSION['menu'] == 13){?> 
		<form name="form2" method="post" action="bco_retro.php" onSubmit="return ValidaCamposBanco_Dep_Sus_Radio(this)">
     <?php }else  if($_SESSION['menu'] == 14){?> 
    <form name="form2" method="post" action="bco_retro.php" onSubmit="return validarBotonRadio2(this)">
     <?php }else  if($_SESSION['menu'] == 15){?> 
    <form name="form2" method="post" action="bco_retro.php" onSubmit="return validarBotonRadio2(this)">
     <?php }else  if($_SESSION['menu'] == 16){?> 
    <form name="form2" method="post" action="bco_retro.php" onSubmit="return validarBotonRadio2(this)">
     <?php }else  if($_SESSION['menu'] == 17){?> 
    <form name="form2" method="post" action="bco_retro.php" onSubmit="return validarBotonRadio2(this)">

		 <?php }?>
  
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


if ($_SESSION['detalle'] == 1){
//Inicia SESSIONES de factura
    $_SESSION['nro_fact'] = 0;
    $_SESSION['t_fac_fis'] = 0;
	$_SESSION['fec_fac'] = "0000-00-00";
	$_SESSION['cta_banco'] = "";
    $_SESSION['contra_cta'] = "";
    $_SESSION['hace_transac'] = "";
    $_SESSION['monto'] = 0;
    $_SESSION['descrip'] = "";
	$_SESSION['des'] = "";
    $_SESSION['cta_bco'] =""; 
	$_SESSION['cheque'] = 0;
	$_SESSION['chequera'] = 0;
	$_SESSION['deposito'] = 0;
	$_SESSION['impo_bs2'] = 0;
	$_SESSION['impo_eqv2'] = 0;
	$_SESSION['impo_bs1'] = 0;
	$_SESSION['impo_eqv1'] = 0;
	$_SESSION['monto_i'] = 0;
	$_SESSION['nit'] = 0;
	$_SESSION['nit_bco'] = 0;
	$_SESSION['nro_auto'] = 0;
	$_SESSION['razon_social'] = 0;
	$_SESSION['imp_tot'] = 0;
$_SESSION['myradio'] ="";
$_SESSION['des'] ="";
$_SESSION['nro_fact'] = 0;
$_SESSION['cta_ctbg'] = "";
$_SESSION['imp_exe'] = 0;
$_SESSION['monto_t'] = 0;

$_SESSION['bancariza'] = 0;	
	
	
   $cod_mon = 0;
   $des_mon = "";
   if (isset($_SESSION['b_dep_ret'])){
       if ($_SESSION['b_dep_ret'] == 1){
          $cod_tran = 1;
	      $des_tran = "Deposito";
		  $cta_sel = '112';
		  $cta_sel2 = '4';
		  $cta_sel3 = '4';
		  }	
       if ($_SESSION['b_dep_ret'] == 2){
           $cod_tran = 2;
	      $des_tran = "Retiro";
		  $cta_sel = '211';
		  $cta_sel2 = '5';
		  $cta_sel3 = '6';
       }
	}
	 if (isset($_SESSION['bco_bs_sus'])){
       if ($_SESSION['bco_bs_sus'] == 1){
          $cod_mon = 1;
	      $des_mon = "Bolivianos";
		  }	
       if ($_SESSION['bco_bs_sus'] == 2){
           $cod_mon = 2;
	      $des_mon = "Dolares";
       }
	}
	$_SESSION['des_tran'] = $des_tran;	
	$_SESSION['des_mon'] = $des_mon;
    $consulta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_MON = $cod_mon 
	              and GRAL_CTA_BAN_COD <> 0 and GRAL_CTA_BAN_USR_BAJA is null order by GRAL_CTA_BAN_CTA_CTE";
    $resultado = mysql_query($consulta);
    $con_ctas  = "Select * From contab_cuenta where (substr(CONTA_CTA_NRO,1,3) = '$cta_sel'
	               or (substr(CONTA_CTA_NRO,1,1) BETWEEN '$cta_sel2' and '$cta_sel3'))
				  	and CONTA_CTA_NIVEL = 'A' 
					order by CONTA_CTA_NRO";
    $res_ctas = mysql_query($con_ctas);
	
$con_ciudad  = "Select CONTA_CHRA_CTA, CONTA_CHRA_TALON 
                From contab_chequera order by CONTA_CHRA_TALON";
$res_ciudad= mysql_query($con_ciudad);
  //$datos = $_SESSION['form_buffer'];
 ?>
 <table align="center" BORDER="0">
     <tr>
        <th align="left">Transacci&oacute;n:</th>
		<th align="left"><?php echo encadenar(2).$_SESSION['des_tran']. " en".encadenar(2).$_SESSION['des_mon']; ?></th>
     </tr>
	  <?php if ($_SESSION['b_dep_ret']==1) { ?>
	  <tr> 
         <th align="left" ><?php echo "Nro. Deposito";?>:</th>
		 <td><input class="txt_campo"  type="text" name="deposito" id="deposito" value = "0" onKeyPress="return" > 
		 <div id="error_nro_dep"></div></td>
		</tr>
	  
	  <?php }?>
      <tr>
        <th align="left">Cuenta Banco:</th>
	    <td> <select name="cod_bco" id="cod_bco" size="1"  style="width:500px;">
	    	<option value=<?php echo ""; ?>>
			               <?php echo "----Seleccione Cuenta de Banco -----"; ?>
			             </option>
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_CTA_BAN_CTA_CTE']; ?>>
			              <?php echo encadenar(2); ?>
			              <?php echo $linea['GRAL_CTA_BAN_DESC']; ?></option>
            <?php }
			
			 ?>
		    </select><div id="error_ctabco"></div></td>
       </tr>
	   
 <?php if ($_SESSION['des_tran']=='Retiro') { ?>
         <tr>
            <td><strong>Chequera :</strong></td>
        <td> 
		
		<select name="chequera" size="1" size="30" id="chequera">
               <?php
                 while ($linea = mysql_fetch_array($res_ciudad)) {
               ?>
               
             <option value=<?php echo $linea['CONTA_CHRA_TALON']; ?>>
           <?php echo $linea['CONTA_CHRA_TALON']; ?>
		    </option>
             <?php
                  } 
               ?>
          </select >
                </td>
                 </tr>

	   <tr> 
         <th align="left" ><?php echo "Nro. Cheque";?>:</th>
		 <td><input class="txt_campo"  type="text" name="cheque" id="cheque" value = "0" onKeyPress="return" > 
		 <div id="error_monto"></div></td>
		</tr>
	    <tr> 
         <th align="left" ><?php  if (isset($_SESSION['nro_cheque'])) {
		 echo "----".$_SESSION['nro_cheque']."vuelve";
		 }?></th>
		 
       </tr>
	    <?php }?>
	 
	   <tr><th align="left">Contra Cuenta:</td><td><input size="50" class="txt_campo_cta" type="text" name="cod_cta" id="cod_cta" /><div id="error_ctacon"></td></tr>
       
       <tr> 
         <th align="left" ><?php echo "Monto en".encadenar(2).$_SESSION['des_mon'];?>:</th>
				 <td><input class="txt_campo"  type="text" name="egr_monto" id="monto" onKeyPress="return"  > 
		 <!--td><input class="txt_campo"  type="hidden" name="egr_monto" id="monto" onKeyPress="return soloNum(event)"  --> 
		 <div id="error_monto"></div></td>
       </tr>
          <tr>
	         <th align="left">Descripci&oacute;n :</th>
			 <td><input class="txt_campo" type="text" name="descrip" id="des" size="70" maxlength="70"  > <!--input class="btn_form" type="reset" value="limpiar" -->
			 <div id="error_des"></div></td>

		 </tr>
        <tr>

        <?php if (trim($_SESSION['des_tran'])=='Deposito') {  ?>
       
          <th align="left">Deposito con Factura :</th>
          <td><INPUT NAME="myradio" TYPE="RADIO"  VALUE="dep_fac" onClick="dialogo()"><div id="error_des"></div></td>
          <tr>
           <th align="left">Deposito Simple :</th>
       <td><INPUT NAME="myradio" TYPE="RADIO" VALUE="dep_simple"> </td>
     </tr>
      <?php  }

            elseif ($_SESSION['des_tran']=='Retiro') { ?>
      <tr>
         <th align="left">Retiro con Factura :</th>
         <td><INPUT NAME="myradio" TYPE="RADIO"  VALUE="dep_factura" onClick="dialogoi()" ></td>
          <tr>
	         <th align="left">Factura excenta :</th>
		 	  <td><INPUT NAME="myradio" TYPE="RADIO"  VALUE="cre_fex" onClick="dialogoi()"></td>
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
           <th align="left">Retiro Simple :</th>
         <td><INPUT NAME="myradio" TYPE="RADIO" VALUE="dep_simple"> </td>
		  </tr> 
          
     </tr>
      <?php  }?>
</tr>
       
      <tr>
		
		 
        </table>
	 <center>
    <br>
	  <?php   if($_SESSION['menu'] == 10){?> 
	 <input class="btn_form" type="submit" name="accion" value="Registrar Deposito Bs.">
	  <?php }else if ($_SESSION['menu'] == 11) {?>
	 <input class="btn_form" type="submit" name="accion" value="Registrar Deposito Sus.">
	 <?php }else if ($_SESSION['menu'] == 12) {?>
	 <input class="btn_form" type="submit" name="accion" value="Registrar Retiro Bs.">
	 <?php }else if ($_SESSION['menu'] == 13) {?>
	 <input class="btn_form" type="submit" name="accion" value="Registrar Retiro Sus.">
	 <?php } ?>
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>
    <?php } ?>
<?php

 
 if ($_SESSION['detalle'] == 2){
     $_SESSION['monto_t'] = 0;
     $_SESSION['monto_p'] = 0;
     $_SESSION['monto_125'] = 0;
     $_SESSION['monto_3'] = 0;
     $tc_ctb = $_SESSION['TC_CONTAB'];
   
     if(isset($_POST['descrip'])){
	// echo "****"."Aquiii"."****";
        if ($_POST['descrip'] <> ""){  
           	$descrip = $_POST['descrip'];
           	$descrip = strtoupper ($descrip);
           	$_SESSION['descrip'] = $descrip;
           	}
        }
	    if (isset($_POST['egr_monto'])){
	        $importe = $_POST['egr_monto'];
			$monto_t = $importe;
			$_SESSION['monto_t'] = $monto_t;
	    }
		if (isset($_SESSION['monto'])){
		
            if ($_SESSION['monto'] <> 0){  
            	$monto_t = $_SESSION['monto'];
            	$_SESSION['monto_t'] =  $monto_t;
            	
            	}
         }
		  if (isset($_SESSION['des'])){
            if ($_SESSION['des'] <> ""){  
			
            	$descrip = $_SESSION['des'];
            	$descrip = strtoupper ($descrip);
            	$_SESSION['descrip'] = $descrip;
            	
            	}
         }
       if (isset($_POST['cheque'])){	 
	      $cheque = $_POST['cheque'];
	      $_SESSION['cheque'] = $cheque;
	  }
	  if (isset($_POST['chequera'])){	 
	      $chequera = $_POST['chequera'];
	      $_SESSION['chequera'] = $chequera;
	  }
//deposito	  
	  if (isset($_POST['deposito'])){	 
	      $deposito = $_POST['deposito'];
	      $_SESSION['deposito'] = $deposito;
	  } 
	 // echo $_POST['cod_bco'];
	 if (isset($_POST['cod_bco'])){	 
	    $cta_bco = $_POST['cod_bco'];
        $_SESSION['cta_bco'] =$cta_bco;
		//echo "****".$cta_bco."****";
//separando la cueta de banco para poder mandar solo el numero
        $cta_unica = explode(" ", $_POST['cod_cta']);
        $cta_otra = $cta_unica[0];
        $_SESSION['cta_ctbg'] = $cta_otra;
		 
	    $consulta  = "Select * From gral_cta_banco where GRAL_CTA_BAN_CTA_CTE = '$cta_bco' and
	                  GRAL_CTA_BAN_USR_BAJA is null ";
        $resultado = mysql_query($consulta);
	    while ($linea = mysql_fetch_array($resultado)) {
	           $cta_banco = $linea['GRAL_CTA_BAN_CTBL'];
		       $_SESSION['cod_bco'] =  $linea['GRAL_CTA_BAN_COD']; 
	           $_SESSION['cta_bco'] =  $linea['GRAL_CTA_BAN_CTA_CTE']; 
	           $_SESSION['nom_cta'] =  $linea['GRAL_CTA_BAN_DESC']; 
			   $_SESSION['nit_bco'] =  $linea['GRAL_CTA_BAN_NIT']; 
		
		}
		
		$des_banco = leer_cta_des($cta_banco);
		$des_otra = leer_cta_des($cta_otra);
		$mon_bco = leer_cta_mon($cta_banco);
		$mon_otra = leer_cta_mon($cta_otra);
	    $_SESSION['cta_otra'] = $cta_otra;
		$_SESSION['cta_banco'] = $cta_banco;
		$_SESSION['des_otra'] = $des_otra;
	    $_SESSION['des_banco'] = $des_banco;
		//$mon_otra = substr($cta_otra,5,1);
	//Transaccion en dolares
	if ($_SESSION['bco_bs_sus'] == 2){
	    $impo_bs1  = round(($importe * $_SESSION['TC_CONTAB']),2);
		$impo_eqv1 = $importe;
		$_SESSION['impo_bs1'] = $impo_bs1;
		$_SESSION['impo_eqv1'] = $impo_eqv1;
	//	echo $_SESSION['impo_bs1']."---"."740";
		if ($_SESSION['b_dep_ret'] == 1){
		    if ($mon_otra == 2){
	            $impo_bs2  = round(($importe * $_SESSION['TC_CONTAB']),2);
		        $impo_eqv2 = $importe;
		        $_SESSION['impo_bs2'] = $impo_bs2;
		        $_SESSION['impo_eqv2'] = $impo_eqv2;
	        }	
	        if ($mon_otra == 1){
		       //echo "Aquiii";
	           $impo_bs2 = round(($importe * $_SESSION['TC_CONTAB']),2);
	           $impo_eqv2 = $importe;
		       $_SESSION['impo_bs2'] = $impo_bs2;
		       $_SESSION['impo_eqv2'] = $impo_eqv2;
		   }
		 }
	  if ($_SESSION['b_dep_ret'] == 2){
		    if ($mon_otra == 2){
	            $impo_bs2  = round(($importe * $_SESSION['TC_CONTAB']),2);
				
		        $impo_eqv2 = $importe;
		        $_SESSION['impo_bs2'] = $impo_bs2;
		        $_SESSION['impo_eqv2'] = $impo_eqv2;
	        }	
	        if ($mon_otra == 1){
		       ///echo "Aquiii";
	           $impo_bs2 = round(($importe * $_SESSION['TC_CONTAB']),2);
	           $impo_eqv2 = $importe;
		       $_SESSION['impo_bs2'] = $impo_bs2;
		       $_SESSION['impo_eqv2'] = $impo_eqv2;
		   }
		 }	 
	  }
	 
	//Transaccion en bolivianos  
	if ($_SESSION['bco_bs_sus'] == 1){
	    //echo "Aqiii";
	        $impo_bs1 = $importe ;
	        $impo_eqv1 = round(($importe / $_SESSION['TC_CONTAB']),2);
		    $_SESSION['impo_bs1'] = $impo_bs1;
		    $_SESSION['impo_eqv1'] = $impo_eqv1;
	//	 echo $_SESSION['impo_bs1']."---"."780";
		 if ($_SESSION['b_dep_ret'] == 1){
		    if ($mon_otra == 2){
	            $impo_bs2  = round(($importe * $_SESSION['TC_CONTAB']),2);
		        $impo_eqv2 = $importe;
		        $_SESSION['impo_bs2'] = $impo_bs2;
		        $_SESSION['impo_eqv2'] = $impo_eqv2;
	        }	
	        if ($mon_otra == 1){
		       //echo "Aquiii";
	           $impo_bs2 = $importe ;
	           $impo_eqv2 = round(($importe / $_SESSION['TC_CONTAB']),2);
		       $_SESSION['impo_bs2'] = $impo_bs2;
		       $_SESSION['impo_eqv2'] = $impo_eqv2;
		   }
		  }
		 //   echo "Aquiii ****".$_SESSION['b_dep_ret'];
		   if ($_SESSION['b_dep_ret'] == 2){
		  		
		    if ($mon_otra == 2){
	            $impo_bs2  = round(($importe * $_SESSION['TC_CONTAB']),2);
		        $impo_eqv2 = $importe;
		        $_SESSION['impo_bs2'] = $impo_bs2;
		        $_SESSION['impo_eqv2'] = $impo_eqv2;
	        }	
	        if ($mon_otra == 1){
		       
	           $impo_bs2 = $importe ;
	           $impo_eqv2 = round(($importe / $_SESSION['TC_CONTAB']),2);
		       $_SESSION['impo_bs2'] = $impo_bs2;
		       $_SESSION['impo_eqv2'] = $impo_eqv2;
		   }
		 }	 
}
//Asigna el valor de myeadio

if ($_POST['myradio'] == "dep_simple"){ 
    $_SESSION['t_fac_fis'] = 1;
}
 //echo "AAqquuii".$_SESSION['monto'].$_SESSION['des']."+++".$_SESSION['cta_ctbg'] ;
 //Factura
          
if ($_POST['myradio'] == "cre_ser"){ 
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
	//		}			  	
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
          $_SESSION['monto_fis'] = $monto_fis;
          $_SESSION['monto_125'] = round($monto_fis * 0.05,2);
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
	
	}	 
	  if(isset($_SESSION['t_fac_fis'])){
			 if($_SESSION['t_fac_fis'] == 2){
        //      echo "****".$_SESSION['t_fac_fis']."***";
             
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

	 

	 ?>
	  <b>
<table width="90%"  border="0" cellspacing="1" cellpadding="1" align="center" >
	<tr>
	<td><?php echo $_SESSION['des_tran'].encadenar(2)."a cta.".encadenar(2).$_SESSION['cta_bco'].encadenar(2).$_SESSION['nom_cta']; ?></td>
    </tr>
	<tr> 
	<td><?php echo "Transacci&oacute;n de".encadenar(2).$_SESSION['des_tran'].encadenar(2)."por".encadenar(2). $_SESSION['descrip']; ?></td>
	 </tr>
 </table>
	 </b>
	
	 <table width="90%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
	<tr>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="35%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
      <th width="13%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="12%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="12%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="13%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	</tr> 
	
   <?php  if(isset($_POST['myradio'])){
		 if ($_POST['myradio'] == "dep_simple"){  
   
   if ($_SESSION['b_dep_ret'] == 1){ ?> 
	
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_banco']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_banco']; ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	</tr>
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_otra']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_otra']; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs2'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv2'], 2, '.',','); ?></td>
	</tr>
	<?php } ?>
	 <?php if ($_SESSION['b_dep_ret'] == 2){  ?> 
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_banco']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_banco']; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv1'], 2, '.',','); ?></td>
	</tr>
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_otra']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_otra']; ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs2'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv2'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	</tr>
	<?php }}} // } }?>
	<?php 
	//	echo "mmm".$_SESSION['myradio']."radio";
	
	 if(isset($_SESSION['myradio'])){
	    if (($_SESSION['myradio'] == "cre_fex")or ($_SESSION['myradio'] == "cre_fac")){  
		//echo "AAAAqqqquuiiii".$_SESSION['monto'].$_SESSION['des']."+++".$_SESSION['cta_ctbg']."hhhh".$_SESSION['myradio'];
	    if(isset($_SESSION['cue_egr'])){
		$cta_numero = explode(" ", $_SESSION['cue_egr']);
		$cta_ctbg = $cta_numero[0];
		$_SESSION['descrip'] = $_SESSION['des'];
		//$cta_ctbg = $_SESSION['cue_egr'];
		 $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			     }
		if($_SESSION['myradio'] == "cre_fac"){ 
		   $_SESSION['monto_i'] = $_SESSION['monto_i'] * -1;
		   ?>
		
  		<tr>
      		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
      		 <td align="left" ><?php echo $des_ctableg; ?></td> 
      		 <td align="right" ><?php echo number_format(($_SESSION['monto'] + $_SESSION['monto_i']), 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
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
      		 <td align="left" ><?php echo $_SESSION['cta_banco']; ?></td> 
      		 <td align="left" ><?php echo $_SESSION['des_banco']; ?></td> 
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
      		 <td align="left" ><?php echo $_SESSION['cta_banco']; ?></td> 
      		 <td align="left" ><?php echo $_SESSION['des_banco']; ?></td> 
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format($_SESSION['monto'], 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
      		 <td align="right" ><?php echo number_format($_SESSION['monto']/$_SESSION['TC_CONTAB'], 2, '.',','); ?></td>
  		</tr>
         <?php } } }//}
		// echo $_SESSION['descrip']."---"; ?>
	
	 <?php if(isset($_POST['myradio'])){
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
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_fis'])* -1,2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" >
					 <?php echo number_format(round(($_SESSION['monto_fis'])* -1,2)/$_SESSION['TC_CONTAB'], 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		</tr>
              		 <tr>
              		 <td align="left" ><?php echo $_SESSION['cta_banco']; ?></td> 
              		 <td align="left" ><?php echo $_SESSION['des_banco']; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format($_SESSION['impo_eqv1'], 2, '.',','); ?></td>
              		</tr>
              		<tr>
              		 <td align="left" ><?php echo $cta_iue; ?></td> 
              		 <td align="left" ><?php echo $des_ctaiue; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_125']* -1 ),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" >
					 <?php echo number_format($_SESSION['monto_125']/$_SESSION['TC_CONTAB']* -1 , 2, '.',','); ?></td>
              		</tr>	
              		<tr>
              		 <td align="left" ><?php echo $cta_it; ?></td> 
              		 <td align="left" ><?php echo $des_ctait; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_3']* -1 ),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" >
					 <?php echo number_format(round($_SESSION['monto_3']/$_SESSION['TC_CONTAB']* -1 ), 2, '.',','); ?></td>
              		</tr>
			
         <?php } }}?>
	<?php  if(isset($_POST['myradio'])){
	if ($_POST['myradio'] == "cre_bie"){ 
	//echo "Aquiii ret bienes";
	         
			     ?>
              		 <tr>
              		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
              		 <td align="left" ><?php echo $des_ctableg; ?></td> 
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_fis']),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" >
					 <?php echo number_format(round(($_SESSION['monto_fis']/$_SESSION['TC_CONTAB']),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		</tr>
              		 <tr>
              		 <td align="left" ><?php echo $_SESSION['cta_banco']; ?></td> 
              		 <td align="left" ><?php echo $_SESSION['des_banco']; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format($_SESSION['impo_eqv1'], 2, '.',','); ?></td>
              		</tr>
              		<tr>
              		 <td align="left" ><?php echo $cta_iue; ?></td> 
              		 <td align="left" ><?php echo $des_ctaiue; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_125'] ),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_125'] /$_SESSION['TC_CONTAB']),2), 2, '.',','); ?></td>
              		</tr>	
              		<tr>
              		 <td align="left" ><?php echo $cta_it; ?></td> 
              		 <td align="left" ><?php echo $des_ctait; ?></td> 
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(round(($_SESSION['monto_3'] ),2), 2, '.',','); ?></td>
              		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
              		 <td align="right" >
					 <?php echo number_format(round(($_SESSION['monto_3'] /$_SESSION['TC_CONTAB']),2), 2, '.',','); ?></td>
              		</tr>
			
         <?php } }	 
	// echo  $_SESSION['myradio']." Aquii";
       if(isset($_SESSION['myradio'])){
	   if ($_SESSION['myradio'] == "dep_fac"){ 
	   $_SESSION['t_fac_fis'] = 6;
	   $cta_it = '6121130010001';
	   $des_it = leer_cta_des($cta_it);
		$_SESSION['des_it'] = $des_it;
		$_SESSION['cta_it'] = $cta_it;
	   $cta_it2 = '2111020010001';
	    $des_it2 = leer_cta_des($cta_it2);
		$_SESSION['des_it2'] = $des_it2;
		$_SESSION['cta_it2'] = $cta_it2;
	    $cta_iva2 = '2111010010001';
		 $des_iva2 = leer_cta_des($cta_iva2);
		$_SESSION['des_iva2'] = $des_iva2;
		$_SESSION['cta_iva2'] = $cta_iva2;
	   $cta_numero = explode(" ", $_SESSION['cta_otra']);
		$cta_ctbg = $cta_numero[0];
		$_SESSION['cta_otra']=$cta_ctbg;
		$des_ctableg = leer_cta_des($cta_ctbg);
		$_SESSION['des_otra'] = $des_ctableg;
		  ?>  
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_banco']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_banco']; ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	  <td align="right" ><?php echo number_format($_SESSION['impo_eqv1'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td> 
	</tr>
	<tr>
	  <td align="center" width="10" ><?php echo $_SESSION['cta_otra']; ?></td>
	  <td align="left" ><?php echo $_SESSION['des_otra']; ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['impo_bs1']-$_SESSION['monto_i'], 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
	  <td align="right" ><?php echo number_format(round((($_SESSION['impo_bs1']-$_SESSION['monto_i'])/$_SESSION['TC_CONTAB']),2), 2, '.',','); ?></td>
	</tr>
	 <tr>
       <td align="center" ><?php echo $cta_it; ?></td> 
       <td align="left" ><?php echo $des_it; ?></td> 
       <td align="right" ><?php echo number_format(round(($_SESSION['monto_it']),2), 2, '.',','); ?></td>
       <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
       <td align="right" >
		<?php echo number_format(round(($_SESSION['monto_it']/$_SESSION['TC_CONTAB']),2), 2, '.',','); ?></td>
        <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
        </tr>
	 <tr>
       <td align="center" ><?php echo $cta_it2; ?></td> 
       <td align="left" ><?php echo $des_it2; ?></td> 
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
       <td align="right" ><?php echo number_format(round(($_SESSION['monto_it']),2), 2, '.',','); ?></td>
       <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
       <td align="right" >
		<?php echo number_format(round(($_SESSION['monto_it']/$_SESSION['TC_CONTAB']),2), 2, '.',','); ?></td>
        
        </tr>
	     <tr>
       <td align="center" ><?php echo $cta_iva2; ?></td> 
       <td align="left" ><?php echo $des_iva2; ?></td> 
	   <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
       <td align="right" ><?php echo number_format(round(($_SESSION['monto_i']),2), 2, '.',','); ?></td>
       <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
       <td align="right" >
		<?php echo number_format(round(($_SESSION['monto_i']/$_SESSION['TC_CONTAB']),2), 2, '.',','); ?></td>
        
        </tr>
	<?php   } }	?>
	
	<?php  
	//Bancarizacion
	if($_SESSION['monto'] >= 50000){ 
	   $_SESSION['bancariza'] = 1;
	   $fec_fac = cambiaf_a_normal($_SESSION['fec_fac']);
	?>
	  <b><b>
<table width="90%"  border="0" cellspacing="1" cellpadding="1" align="center" >
    <tr></tr>
	<tr>
	<th><?php echo encadenar(6)."Datos para BANCARIZACION"; ?></td>
    </tr>
	<tr> 
	<td><?php echo encadenar(6).$_SESSION['des_tran'].encadenar(2)."por".encadenar(2). $_SESSION['descrip']; ?></td>
	 </tr>
 </table>
	 </b>
	
	 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
	<tr>
	  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />FEC. TRANSAC.</th>
	  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />FEC. FACTURA</th>
	  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />NRO. FACTURA</th>
	  <th width="8%" scope="col"><border="0" alt="" align="absmiddle" />NRO. AUTORIZA</th>
      <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />MONTO</th>
	  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />NIT CLIENTE</th>
	  <th width="20%" scope="col"><border="0" alt="" align="absmiddle"/>RAZON SOCIAL</th>
	    <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />CTA. BANCO</th>
	  <th width="12%" scope="col"><border="0" alt="" align="absmiddle" />NIT BANCO</th>
	</tr> 
	<tr>
	   <td align="center" width="10" ><?php echo $_SESSION['fec_proc']; ?></td>
	  <td align="center" width="10" ><?php echo $_SESSION['fec_fac']; ?></td>
	  <td align="center" ><?php echo $_SESSION['nro_fact']; ?></td>
	  <td align="center" ><?php echo $_SESSION['nro_auto']; ?></td>
	  <td align="right" ><?php echo number_format($_SESSION['monto'], 2, '.',','); ?></td>
	  <td align="center" ><?php echo $_SESSION['nit']; ?></td>
	  <td align="left" ><?php echo $_SESSION['razon_social']; ?></td>
	  <td align="left" ><?php echo $_SESSION['cta_bco']; ?></td> 
	  <td align="right" ><?php echo $_SESSION['nit_bco']; ?></td>
	</tr>
	
   <?php 
	
	
	
	
	
	
	
	
	}
	
	?>
	
	
	
	
	
	
	
	
	
	
</table> 	
<center>	
     
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
	 <?php if ($_SESSION['menu'] == 14) {?>
	 <input class="btn_form" type="submit" name="accion" value="Recibo">
	 <?php }else if ($_SESSION['menu'] == 15) {?>
	 <input class="btn_form" type="submit" name="accion" value="Recibo Sus">
	  <?php }else if ($_SESSION['menu'] == 16) {?>
	 <input class="btn_form" type="submit" name="accion" value="Recibo Bs">
	 <?php }else if ($_SESSION['menu'] == 12) {?>
	 <input class="btn_form" type="submit" name="accion" value="Recibo Bs">
	 <?php }else if ($_SESSION['menu'] == 17) {?>
	 <input class="btn_form" type="submit" name="accion" value="Recibo Dol">
	 <?php } ?>
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
	
<?php
//}	
//header('Location: egre_mante.php');	
?>

  <?php } ?>
	 
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