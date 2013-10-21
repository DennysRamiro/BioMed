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
<title>Registro de Ingresos</title>


<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js/calendario.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-ui.js"></script>

<script type="text/javascript" src="script/jquery.numeric.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="js/cajas_reg_ing_egr.js"></script>  
<script type="text/javascript" src="js/Utilitarios.js"></script>
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
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Total Neto no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac9" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Credito Fiscal IVA no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm_Fac10" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Codigo de Control no puede estar vacio.</font></p>
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
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cajas_IngEgre">
                    
                     <img src="img/move_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. INGR./EGRE.
                    
                 </li>

<?php if($_SESSION['menu']==7){?>

                  <li id="menu_modulo_fecha">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS BOLIVIANOS
                    
                 </li>
              </ul>  

<!--Cabecera del modulo con su alerta-->
 					<div id="contenido_modulo">

                      <h2> <img src="img/shield1_64x64.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS BOLIVIANOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                      <img src="img/checkmark_32x32.png" align="absmiddle">
                       Registro Ingresos Bs.
                      </div>
 <?php } elseif($_SESSION['menu']==8){?>

 					<li id="menu_modulo_fecha">
                    
                     <img src="img/shield3_24x24.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS DOLARES
                    
                 	</li>
              </ul>  

<!--Cabecera del modulo con su alerta-->
 						<div id="contenido_modulo">

                      <h2> <img src="img/shield3_64x64.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                      <img src="img/checkmark_32x32.png" align="absmiddle">
                       Registro Ingresos $us.
                      </div>
  <?php } elseif($_SESSION['menu']==9){?>

          <li id="menu_modulo_cajas_IngBs">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS BOLIVIANOS
                    
                  </li>
              <li id="menu_modulo_fecha">
                    
                     <img src="img/save 2_24x24.png" border="0" alt="Modulo" align="absmiddle"> GRAB. INGRESOS BS
                    
                  </li>
              </ul>  

<!--Cabecera del modulo con su alerta-->
            <div id="contenido_modulo">

                      <h2> <img src="img/save 2_64x64.png" border="0" alt="Modulo" align="absmiddle"> GRABAR INGRESOS BOLIVIANOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                      <img src="img/checkmark_32x32.png" align="absmiddle">
                          
                       </div-->
  <?php } elseif($_SESSION['menu']==10){?>

          <li id="menu_modulo_cajas_IngSus">
                    
                     <img src="img/shield3_24x24.png" border="0" alt="Modulo" align="absmiddle"> INGRESOS DOLARES
                    
                  </li>
              <li id="menu_modulo_fecha">
                    
                     <img src="img/save 2_24x24.png" border="0" alt="Modulo" align="absmiddle"> GRAB. INGRESOS $US
                    
                  </li>
              </ul>  

<!--Cabecera del modulo con su alerta-->
            <div id="contenido_modulo">

                      <h2> <img src="img/save 2_64x64.png" border="0" alt="Modulo" align="absmiddle"> GRABAR INGRESOS DOLARES</h2>
                      <hr style="border:1px dashed #767676;">
                      <!--div id="error_login"> 
                      <img src="img/checkmark_32x32.png" align="absmiddle">
                          
                       </div-->
   <?php }?> 
                      
	
           
				<?php
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>

<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <!--form name="form2" method="post" action="egre_retro_2.php" onSubmit="return ValidaCamposEgresos(this)"-->
      <?php if($_SESSION['menu'] == 7){?> 
		<form name="form2" method="post" action="egre_retro_2.php" onSubmit="return ValidaCamposBanco_Dep_Bs_Radio(this)">
		<?php }else  if($_SESSION['menu'] == 8){?> 
		 <form name="form2" method="post" action="egre_retro_2.php" onSubmit="return ValidaCamposBanco_Dep_Sus_Radio(this)">
    <?php }else  if($_SESSION['menu'] == 9){?> 
     <form name="form2" method="post" action="egre_retro_2.php" onSubmit="returnValidaCamposBanco_Dep_Sus_Radio(this)">
    <?php }else  if($_SESSION['menu'] == 10){?> 
     <form name="form2" method="post" action="egre_retro_2.php" onSubmit="return">



		<?php }?>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios

$_SESSION['monto_eq'] = 0;
if ($_SESSION['detalle'] == 1){
   if (isset($_SESSION['msg_error'])){
      echo $_SESSION['msg_error'];
   }
   $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
   $resultado = mysql_query($consulta);
   $cod_mon = 0;
   $des_mon = "";
   if (isset($_SESSION['egre_bs_sus'])){
       if ($_SESSION['egre_bs_sus'] == 1){
          $cod_mon = 1;
	      $des_mon = "Bolivianos";
		  $mon_des = "Monto en Bolivianos:";
		   $cta_sel = '112';
		  $cta_sel2 = '4';
		  $cta_sel3 = '4';
        }	
       if ($_SESSION['egre_bs_sus'] == 2){
          $cod_mon = 2;
	      $des_mon = "Dolares";
		  $mon_des = "Monto en Dolares:";
		 
       }
	   $_SESSION['des_mon'] = $des_mon;	
   }
$con_ctas  = "Select * From contab_cuenta where (substr(CONTA_CTA_NRO,1,3) = '$cta_sel'
                     or (substr(CONTA_CTA_NRO,1,1) BETWEEN '$cta_sel2' and '$cta_sel2'))
	                and CONTA_CTA_NIVEL = 'A' and substr(CONTA_CTA_NRO,6,1) = '$cod_mon'";
$res_ctas = mysql_query($con_ctas) ;

//$datos = $_SESSION['form_buffer'];
 ?>
 
 <table align="center">
    <tr>
        <th align="left">Moneda:  </th>
		<td><input  class="txt_campo" type="text" name="monedas" id="monedas_i"  value="<?php echo $des_mon; ?>" readonly></td>
     </tr>
      <tr>
	   <th align="left">Cuenta Ingresos :</td><td><input class="txt_campo_cta" type="text" name="cod_cta" id="cod_cta" /></th></tr>
    
     <tr>
        <th align="left">Agencia :</th>
	    <td> <select name="cod_agencia" id="cod_agencia_i" size="1">
	    	<!--option>Seleccione una Agencia.....</option-->
	        <?php while ($linea = mysql_fetch_array($resultado)) { ?>
            <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
			              <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
            <?php } ?>
		    </select></td>
       </tr>
        <!--th align="left">Cuenta Ingresos :</th>
	    <td> <select name="cod_cta" id="cod_cta_i" size="1"  -->
	    
	        <?php //while ($lin_cta = mysql_fetch_array($res_ctas)) { ?>
            <!--option value=<?php //echo $lin_cta['CONTA_CTA_NRO']; ?>>
			              <?php //echo $lin_cta['CONTA_CTA_NRO']; ?>
			              <?php //echo $lin_cta['CONTA_CTA_DESC']; ?></option-->
            <?php //} ?>
		    <!--/select></td>
       </tr-->
       <tr> 
         <th align="left" ><?php echo $mon_des; ?></th>
		
		 <td><input  class="txt_campo" type="text" name="egr_monto" id="monto_i" onKeyPress="return soloNum(event)" onBlur="limpia()" > 
		 <div id="error_monto"></div></td>
       </tr>
     
         <tr>
	         <th align="left">Descripci&oacute;n :</th>
		   <td><input class="txt_campo" type="text" name="descrip" id="descrip_i" size="50" maxlength="70"  >
			 <div id="error_descrip"></div> </td>
		 </tr>
		 <?php if ($_SESSION['EMPRESA_TIPO'] == 2){ ?>
		 <tr>
	         <th align="left">Factura :</th>
		 	 <td><INPUT NAME="myradio" TYPE=RADIO VALUE="cre_fac" onClick="dialogo_ingresos()"></td>
		 </tr>	
		 <tr>
	         <th align="left">Ingreso Simple :</th>
		 	 <td><INPUT NAME="myradio" TYPE=RADIO VALUE="cre_nor"></td>
		 </tr> 
		 <?php } ?>  
      </table>
	 <center>
    <br>
	 <?php if($_SESSION['menu']==7){?>   
	 <input class="btn_form" type="submit" name="accion" value="Registrar Ingresos Bs.">
   <?php } elseif($_SESSION['menu']==8){?>
   <input class="btn_form" type="submit" name="accion" value="Registrar Ingresos Sus.">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
 <?php }?> 
</form>
    <?php } ?>


 <div id="dialog" title="Datos de la Factura" style="display:none; width:40%;">
    <form name="form2" method="post" action="grab_fact.php" onSubmit="return ValidaCamposFactura(this)">

            <table align="center" class="table_usuario" style="font:10; width:400px;">
  
             <tr>
                <th align="left">NIT del Proveedor :</th>
                <td><input class="txt_campo" type="text" name="nit_i" id="nit" size="15" maxlength="15" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
                <div id="error_nit"></div></td>
             </tr>
             <tr>
                <th align="left">Nro. de Factura :</th>
                 <td><input class="txt_campo" type="text" name="nro_fac_i" id="nro_fac" size="10" maxlength="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
                <div id="error_nro_fac"></div> </td>
             </tr> 
             <tr>
                <th align="left" >Nro de Autorizacion</th>
                <td><input class="txt_campo" type="text" name="nro_auto_i" id="nro_auto" maxlength="15"  size="15" onKeyPress="return soloNum(event)" onBlur="limpia()"> <div id="error_nro_auto"></div></td>
            </tr>
            <tr>
                <th align="left" >Nombre o Razon Social :</th>
                <td><input class="txt_campo" type="text" name="razon_social_i" id="razon_social" maxlength="60"  size="20" > 
        <div id="error_razon_social"></div></td>
           </tr>
           <tr>   
              <th align="left" >Fecha de Factura :</th>
              <td><input class="txt_campo" type="text" name="fec_fac_i" id="datepicker" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
               <div id="error_periodo"></div> </td>
         </tr>
          <tr>
            <th align="left">Importe Total :</th>
              <td><input class="txt_campo" type="text" name="imp_tot_i" id="imp_tot" size="15" maxlength="15" onKeyPress="return soloNum(event)" onBlur="limpia()" readonly> 
              <div id="error_imp_tot"></div>
            </td>
         </tr>
         <tr>
              <th align="left">Importe ICE :</th>
              <td><input class="txt_campo" type="text" name="imp_ice_i" id="imp_ice" size="10" maxlength="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
              </td>
        </tr> 
         <tr>
              <th align="left" >Importe Excenta</th>
             <td><input class="txt_campo" type="text" name="imp_excento_i" id="imp_excento" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
         </tr>
         <tr>
              <th align="left" >Total NETO :</th>
             <td><input class="txt_campo" type="text" name="tot_neto_i" id="tot_neto" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()">
       <div id="error_tot_neto"></div> </td>
         </tr>
         <tr>   
             <th align="left" >Credito Fiscal IVA :</th>
              <td><input class="txt_campo" type="text" name="cred_fisc_iva_i" id="cred_iva" maxlength="10"  size="10"  onKeyPress="return soloNum(event)" onBlur="limpia()" readonly> 
            <div id="error_cred_iva"></div> </td>
         </tr>
         <!--tr>   
            <th align="left" >Codigo de Control :</th>
            <td><input class="txt_campo" type="text" name="cod_control" id="cod_control" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()">
            <div id="error_cod_control"></div> </td>
         </tr-->
         <tr>   
            <th align="left" >Factura Anulada :</th>
            <td>
        <input type="checkbox" name="fac_anu_i" ><br>
              
            <div id="error_llave"></div> </td>
         </tr>
        <input class="txt_campo" type="text" name="moneda_i" id="moneda_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="cue_egr_i" id="cue_egr_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="ag_i" id="ag_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="des_i" id="des_i" maxlength="10"  size="10" > 
         <input class="txt_campo" type="text" name="ingreso" id="ingreso" value="Ingresos" maxlength="10"  size="10" >
         <!--input class="txt_campo" type="text" name="cue_egr_i_new" id="cue_egr_i_new" value="Ingresos" maxlength="10"  size="10" -->

    </table>
         <center>
            <br>
           <input class="btn_form" type="submit" name="accion" value="Grabar Ingresos" style="font:10;">
          
<?php //$_SESSION['ingr']=1;
      //$_SESSION['egr']=0;
      $_SESSION['moneda']=$des_mon;
     // $_SESSION['tipo']='Ingresos';
?>
    </form>
</div>





<?php
if ($_SESSION['detalle'] == 2){  //1a?>

<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$_SESSION['monto_p'] = 0;
$_SESSION['monto_i'] = 0;
$_SESSION['monto_125'] = 0;
$_SESSION['monto_3'] = 0;
$_SESSION['t_fac_fis'] = 0;
$tc_ctb = $_SESSION['TC_CONTAB'];
$c_agen = $_POST['cod_agencia'];
$_SESSION['c_agen'] = $c_agen;
 $nro_tr_caj = leer_nro_co_cja($apli,$c_agen);
 
if ($_POST['descrip'] <> ""){  
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['descrip'] = $descrip;
	}

 if ($_POST['egr_monto'] > 0){  
    if ($_SESSION['egre_bs_sus'] == 2){
	   
	   $_SESSION['monto_eq'] = $_POST['egr_monto'];
         $monto_t = (($_POST['egr_monto'] * $_SESSION['TC_CONTAB'])* -1);
      }else{
	            $monto_t = ($_POST['egr_monto']* -1);
	  }			
				$_SESSION['monto_t'] =  $monto_t;
	}


 //aqui se esta separando las cuentas para poder mandar solo el numero de cuenta

              $cta_numero = explode(" ", $_POST['cod_cta']);
              // $cta_ctbg = $_POST['cod_cta'];

               // print_r($cta_numero[0]);
            $cta_ctbg =  $cta_numero[0];

            //$cta_ctbg = $_POST['cod_cta'];
$_SESSION['cta_ctbg'] =  $cta_ctbg;
//Factura
if(isset($_POST['cre_fac'])){
  $_SESSION['t_fac_fis'] = 2; 
  $con_deu  = "Select DISTINCT CLIENTE_COD,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO,
               CLIENTE_NOMBRES,CLIENTE_COD_ID
               From cart_deudor, cliente_general where 
		       CLIENTE_COD = CART_DEU_INTERNO and  CART_DEU_RELACION = 'C'
			   and CART_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ORDER by
			    CLIENTE_AP_PATERNO,CLIENTE_AP_MATERNO,CLIENTE_NOMBRES"; 
         $res_deu = mysql_query($con_deu);
		
  
  
   ?>
   <center>
   <strong>Consulta Clientes</strong>
   <br>
  <select name="cod_cli" size="5">
			 <?php  while ($lin_deu = mysql_fetch_array($res_deu)) {?>
			 <option value=<?php echo $lin_deu['CLIENTE_COD']; ?>>
			     <?php echo $lin_deu['CLIENTE_AP_PATERNO'].encadenar(1).
				            $lin_deu['CLIENTE_AP_MATERNO'].encadenar(1).
							$lin_deu['CLIENTE_NOMBRES'].encadenar(3).
				             $lin_deu['CLIENTE_COD_ID']; ?></option>  
		
	<?php } ?>	
	 </select> 
  
  
  
  
   <table align="center">
    <tr>
        <th align="left">Moneda:  </th>
		<td><?php echo $_SESSION['des_mon']; ?></td>
     </tr>
    <tr>
        <th align="left">Monto:  </th>
		<td ><?php echo  number_format($_SESSION['monto_t'] * -1, 2, '.',',') ; ?></td>
     </tr>
	
	       
	
	
	 
	
	   <tr>
	         <th align="left">Nombre Cliente:</th>
			 <td><input type= type="text" name="nombre" size="50" maxlength="70" value = "" > </td>
	
	
	  </tr>
       <tr>
	         <th align="left">Nit / CI:</th>
			 <td><input type= type="text" name="nitci" size="12" maxlength="15" value = "0" > </td>
	  </tr>
     
		
        </table>
	 <center>
	
<br>
</center>
   <?php
  
 }
 //Factura excenta
 if(isset($_POST['cre_fex'])){
  $_SESSION['t_fac_fis'] = 3;
  ?>
 <center>
   <tr> 
         <th align="left" >Importe Sujeto a Crédito Fiscal:</th>
		 <td><input  type="text" name="imp_exe"> </td>
       </tr>
<br><br>	   
 <input type="submit" name="accion" value="Recalcular">
 <!--input type="submit" name="accion" value="Salir"-->	
<br><br>	    
 <?php 
 
 }
 //Pago Servicios
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
 }
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
		      $imp_or = $_POST['egr_monto'];
			  $_SESSION['imp_or'] = $imp_or;
		      $importe = $monto_t;
			  $cta_ctb = 1111010010001;
			  $_SESSION['cta_ctb'] = $cta_ctb;
			  $importe_e =0;
			  $deb_hab = 1;
	 } else {
	         $imp_or = $_POST['egr_monto'] * $_SESSION['TC_CONTAB'];
			  $_SESSION['imp_or'] = $imp_or;
		      $importe = $monto_t;
			  $cta_ctb = 1111010020002;
			  $_SESSION['cta_ctb'] = $cta_ctb;
			  $importe_e =$_SESSION['monto_eq'];
			  $deb_hab = 1;
	 }		  
			  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctb'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctable = $lin_ctable['CONTA_CTA_DESC'];
			     }
			  $con_ctable = "Select * From contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
              $res_ctable = mysql_query($con_ctable);
		      while ($lin_ctable = mysql_fetch_array($res_ctable)) {
		            $des_ctableg = $lin_ctable['CONTA_CTA_DESC'];
			     }	 
	?>
	 
		<?php 
		       if(empty($_POST['cre_ser'])){ 
			     if(empty($_POST['cre_bie'])){  ?>
		<?php	
if ($_SESSION['egre_bs_sus'] == 1){	 ?> 
    
        <tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(($imp_or + $_SESSION['monto_i']), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
 <?php }else{ ?>
 		<tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $des_ctableg; ?></td> 
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(($imp_or + $_SESSION['monto_i']), 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		</tr>
	 <?php } ?>	
		 <tr>
		 <td align="left" ><?php echo $cta_ctb; ?></td> 
		 <td align="left" ><?php echo $des_ctable; ?></td> 
		 <td align="right" ><?php echo number_format($imp_or, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($importe_e, 2, '.',','); ?></td>
		 <td align="right" ><?php echo number_format(0, 2, '.',','); ?></td>
		</tr>
		 <?php } ?>
		 <?php } ?>
		 <?php // } ?>
		
		 
	
 </table> 
 	
<center><br> 
  <?php if($_SESSION['menu'] == 9){?> 
   <form name="form2" method="post" action="egre_retro_2.php" onSubmit="return">
     ESte es?
     <input class="btn_form" type="submit" name="accion" value="Imprimir Bs">
    <?php }else  if($_SESSION['menu'] == 10){?> 
     <input class="btn_form" type="submit" name="accion" value="Imprimir Sus">
    <?php }?> 
 <!--input class="btn_form" type="submit" name="accion" value="Imprimir"-->
     <!--input type="submit" name="accion" value="Salir"-->



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
<center>
     <?php if($_SESSION['menu'] == 9){?> 
	 o ese??
     <input class="btn_form" type="submit" name="accion" value="Imprimir Bs">
    <?php }else  if($_SESSION['menu'] == 10){?> 
     <input class="btn_form" type="submit" name="accion" value="Imprimir Sus">
    <?php }?>	
    
     <!--input type="submit" name="accion" value="Imprimir"-->
     <!--input type="submit" name="accion" value="Salir"-->
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
 /*  if ($_POST['descrip'] <> ""){  
	   $descrip = $_POST['descrip'];
       $descrip = strtoupper ($descrip);
	}

    if ($_POST['egr_monto'] > 0){  
	            $monto_t = ($_POST['egr_monto']* -1);
	  }
    $cta_ctbg = $_POST['cod_cta'];  ?>

	           
   <?php	
	
if ($_SESSION['egre_bs_sus'] == 1){
		      $imp_or = $_POST['egr_monto'];
		      $importe = $monto_t;
			  $cta_ctb = 11101101;
			  $importe_e =$monto_t;
			  $deb_hab = 2;
			//  echo "aqui". $importe.$fec1 ;
			 
$consulta = "insert into caja_transac (CAJA_TRAN_NRO_COR, 
                                       CAJA_TRAN_AGE_CJRO,
									   CAJA_TRAN_AGE_ORG,
									   CAJA_TRAN_COD_SC,
									   CAJA_TRAN_FECHA,
					                   CAJA_TRAN_CAJERO1,
					                   CAJA_TRAN_APL_ORG,
   				                       CAJA_TRAN_TIPO_OPE,
					                   CAJA_TRAN_NRO_DOC, 
									   CAJA_TRAN_NRO_CAR, 
									   CAJA_TRAN_NRO_FON, 
									   CAJA_TRAN_CAJERO2,
                                       CAJA_TRAN_APL_DES,
                                       CAJA_TRAN_DOC_EQUIV,
                                       CAJA_TRAN_VIA_PAG,
                                       CAJA_TRAN_REL_FAC,
                                       CAJA_TRAN_DEB_CRED,
									   CAJA_TRAN_CTA_CONT,
                                       CAJA_TRAN_IMPORTE,
                                       CAJA_TRAN_IMP_EQUIV,
                                       CAJA_TRAN_MON,
                                       CAJA_TRAN_TIP_CAMB,
                                       CAJA_TRAN_DESCRIP,
                                       CAJA_TRAN_USR_ALTA,
                                       CAJA_TRAN_FCH_HR_ALTA,
									   CAJA_TRAN_USR_BAJA,
									   CAJA_TRAN_FCH_HR_BAJA
									   ) values ($nro_tr_caj,
									             $c_agen,
												 $c_agen,
												 0,
												 '$fec1',
												 '$log_usr',
												 10000,
												 1,
												 $nro_tr_caj,
												 0,
												 0,
												 '$log_usr',
												 13000,
												 null,
												 null,
 											     null,
												 null,
												 $cta_ctb,
												 $importe,
										         0,
												 1,
												 $tc_ctb,
												 '$descrip',				 
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta);
   //         } 
	
	 $nro_tr_ingegr = leer_nro_co_ingegr($c_agen); 
	 echo $nro_tr_ingegr.encadenar(2).$nro_tr_caj.encadenar(2).$c_agen.encadenar(2).$deb_hab.encadenar(2).$cta_ctb.encadenar(2).
		 $fec1.encadenar(2).$descrip.encadenar(2).$imp_or.encadenar(2).$imp_or.encadenar(2).$log_usr;
	 
	$consulta = "insert into caja_ing_egre(caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctb',
												 1,
												 '$fec1',
												 '$descrip',
												 1,
												  $imp_or,
												  $imp_or,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 

 $deb_hab = 1;	 
$consulta = "insert into caja_ing_egre (caja_ingegr_corr, 
	                                   caja_ingegr_corr_cja,
                                       caja_ingegr_agen,
									   caja_ingegr_debhab,
									   caja_ingegr_cta,
									   caja_ingegr_tipo,
					                   caja_ingegr_fecha,
					                   caja_ingegr_descrip,
   				                       caja_ingegr_mon, 
									   caja_ingegr_impo, 
									   caja_ingegr_impo_e, 
									   caja_ingegr_usr_alta,
                                       caja_ingegr_fch_hra_alta,
                                       caja_ingegr_usr_baja,
                                       caja_ingegr_fch_hra_baja
                                       ) values ($nro_tr_ingegr,
									             $nro_tr_caj,
									             $c_agen,
												 $deb_hab,
												 '$cta_ctbg',
												 1,
												 '$fec1',
												 '$descrip',
												 1,
												 $imp_or,
												 $imp_or,
												 '$log_usr',
												  null,
												  null,
												  '0000-00-00 00:00:00')";
$resultado = mysql_query($consulta); 		 
	} */ 
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