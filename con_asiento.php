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
	$_SESSION['descrip'] = "";
	
?>
<html>
<head>
<!--Titulo de la pestaña de la pagina-->
<title>Registro Contable</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="js/calendario.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-ui.js"></script>

<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>
<script type="text/javascript" src="script/jquery.numeric.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script>  
<script type="text/javascript" src="js/ModulosContabilidad.js"></script>
<script type="text/javascript" src="js/contabilidad_reg_rev_reg.js"></script>
<script type="text/javascript" src="js/ValidarNumero.js"></script>  
</head>
<body>

<!-- Validcion de campos de la factura -->
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Glosa no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nit del Proveedor no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nro. Factura no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm5" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nro. Autorizci&oacute; no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm6" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombre Raz&oacute;n Social no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm7" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Periodo no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm8" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Importe Total no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm9" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Total Neto no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm10" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Cr&eacute;dito Fiscal IVA no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm11" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo C&oacute;digo de Control no puede estar vacio.</font></p>
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
<div id="dialog-confirm18" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe ingresar uno de los montos</font></p>
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

                 <?php if($_SESSION['menu'] == 15){?> 
				
        		<li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_adicionar">
                    
                     <img src="img/add_24x24.png" border="0" alt="Modulo" align="absmiddle"> ADIC. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/paste_24x24.png" border="0" alt="Modulo" align="absmiddle"> GEST. ASIENTO CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
					<h2> <img src="img/paste_64x64.png" border="0" alt="Modulo" align="absmiddle">GESTIONAR ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
         				 <img src="img/checkmark_32x32.png" align="absmiddle">
           					Elija linea que desea eliminar o modificar del Asiento
        			   </div>

 				<?php } elseif($_SESSION['menu'] == 0){?>

                 <li id="menu_modulo_general">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. BANCA SOLIDARIO
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/add user_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
					<h2> <img src="img/add user_64x64.png" border="0" alt="Modulo" align="absmiddle">REGISTRO ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          					<img src="img/checkmark_32x32.png" align="absmiddle">
          					 Registre Asiento Contable
        				</div>
				 <?php } elseif($_SESSION['menu'] == 16){?>

 				<li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/add_24x24.png" border="0" alt="Modulo" align="absmiddle"> ADIC. ASIENTO CONT.
                    
                 </li> 
              </ul> 
              <div id="contenido_modulo">
					<h2> <img src="img/add_64x64.png" border="0" alt="Modulo" align="absmiddle">ADICIONAR ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
         				 <img src="img/checkmark_32x32.png" align="absmiddle">
           					Ingrese el Asiento Contable
        			   </div>
        			    <?php } elseif($_SESSION['menu'] == 17){?>

 				<li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_adicionar">
                    
                     <img src="img/add_24x24.png" border="0" alt="Modulo" align="absmiddle"> ADIC. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_contabilidad_asientocontable_adicionar_modif">
                    
                     <img src="img/paste_24x24.png" border="0" alt="Modulo" align="absmiddle"> GEST. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> MODIF. ASIENTO CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
					<h2> <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">MODIFICAR ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
         				 <img src="img/checkmark_32x32.png" align="absmiddle">
           					 Modifique el Asiento Contable
        			   </div>
        	<?php } elseif($_SESSION['menu'] == 18){?>

        			   
        	<li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable_adicionar">
                    
                     <img src="img/add_24x24.png" border="0" alt="Modulo" align="absmiddle"> ADIC. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_contabilidad_asientocontable_adicionar_modif">
                    
                     <img src="img/paste_24x24.png" border="0" alt="Modulo" align="absmiddle"> GEST. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/save 2_24x24.png" border="0" alt="Modulo" align="absmiddle"> GRAB. ASIENTO CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
					<h2> <img src="img/save 2_64x64.png" border="0" alt="Modulo" align="absmiddle">GRABAR ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
         				 <img src="img/checkmark_32x32.png" align="absmiddle">
           			Revise Bien antes de Imprimir...
        			   </div>

        	<?php } elseif($_SESSION['menu'] == 21){?>

                  <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_contabilidad_asientocontable_util_res">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> UTILIZAR RESERVADOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/add_24x24.png" border="0" alt="Modulo" align="absmiddle"> REGISTRAR ASIENTO
                    
                 </li>

              </ul> 
              <div id="contenido_modulo">
			<h2> <img src="img/add_64x64.png" border="0" alt="Modulo" align="absmiddle">REGISTRAR ASIENTO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Registre el asiento
        </div>

        <?php } elseif($_SESSION['otromenu'] == 25){?>

        <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                 <li id="menu_modulo_contabilidad_asientocontable_utilreserva">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> UTILIZAR RESERVADOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/add_24x24.png" border="0" alt="Modulo" align="absmiddle"> REGISTRAR ASIENTO
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/paste_24x24.png" border="0" alt="Modulo" align="absmiddle"> GEST. ASIENTO CONT.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
					<h2> <img src="img/paste_64x64.png" border="0" alt="Modulo" align="absmiddle">GESTIONAR ASIENTO CONTABLE </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
         				 <img src="img/checkmark_32x32.png" align="absmiddle">
           					Elija linea que desea modificar del Asiento
        			   </div>

 <?php }?>



				<?php
					 $fec = $_SESSION['fec_proc'];  //eer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
					 // $nro_tr_con = leer_nro_co_con();

				?>

            
<form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidarCampoGlosa(this)">
<strong>
<?php
	if ($_SESSION['nor_res'] == 1){
	    $nro_tr_con = leer_nro_co_con();
		$_SESSION['nro_tr_con'] = $nro_tr_con;
    //echo $nro_tr_con;
	}
	if ($_SESSION['nor_res'] == 2){
    //echo $_POST['nro_doc'];
		if (isset($_POST['nro_doc'])){
	  		$quecom = $_POST['nro_doc'];
	   		for ($i=0; $i < count($quecom); $i = $i + 1 ) {
	   		    if (isset($quecom[$i]) ) {
	         		 $nro_tr_con = $quecom[$i];
		     		 $_SESSION['nro_tr_con'] = $nro_tr_con;
	       		}
	   		}
		}
	}
	echo "Nro. Asiento Contable ".encadenar(2). $_SESSION['nro_tr_con'].encadenar(2);
?>
<br>
</strong>
<?php
	if ($_SESSION['continuar'] == 1){
	    $_SESSION['cuantos'] = 0;
	    $borr_cob  = "Delete From temp_ctable3 ";
		//echo  $borr_cob;
	    $cob_borr = mysql_query($borr_cob);
     // echo  $cob_borr;
		// $nro_tr_con = leer_nro_co_con();
		if ($_SESSION['nor_res'] == 1){
    		$nro_tr_con = leer_nro_co_con();
        //echo $nro_tr_con;
		}
		if ($_SESSION['nor_res'] == 2){
			if (isset($_POST['nro_doc'])){
   				$quecom = $_POST['nro_doc'];
   				for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       				if (isset($quecom[$i]) ) {
          				$nro_tr_con = $quecom[$i];
	     				// $_SESSION['nro_doc'] = $nro_doc;
       				}
   				}
			}
		}
	
    }
	
	if ($_SESSION['detalle'] == 1){
   
	    $con_ctas  = "Select * From contab_cuenta where CONTA_CTA_NIVEL = 'A'";
	    $res_ctas = mysql_query($con_ctas); ?>
   
    	<table align="center">
    	<?php 
    		if ($_SESSION['continuar'] == 1) {?>
      			<tr>
		    		 <th align="left">Glosa:</th>
		 		  <td><input class="txt_campo_cta" type="text" name="descrip" id="glosa" size="100" maxlength="70">
				  <div id="error_glosa"></div> </td>
	  			</tr>
  		<?php } ?>
  		<?php if ($_SESSION['continuar'] == 2) { ?>
      			<tr>
	    			<th align="left">Glosa:</th>
				<?php if (isset ($_POST['descrip'])){
						 $_SESSION['descrip'] = $_POST['descrip'];
					?>
				<td align="left"><?php echo utf8_encode($_SESSION['descrip']); ?> </td>
				<?php } ?>
	  			</tr>
		  <?php } ?>
    			 <tr>
				 <th align="left">Cuenta Contable:</th>
				 <td><input class="txt_campo_cta" type="text" name="cuenta_busca_datos" id="cuenta_busca_datos"/>
                                            <input class="txt_campo" type="hidden" name="cod_cta" id="cod_cta" /></td>
				 </tr>
    
          <!--tr> 
      				<th align="left">Cuenta Contable:</th>
	  				<td> <select name="cod_cta" id="cod_cta" size="1"-->
	  				<?php //while ($lin_cta = mysql_fetch_array($res_ctas)) { ?>
	       				 <!--option value="<?php //echo $lin_cta['CONTA_CTA_NRO']; ?>">
						               <?php //echo $lin_cta['CONTA_CTA_NRO']; ?>
									   <?php //echo utf8_encode($lin_cta['CONTA_CTA_DESC']);?></option-->
           					<?php //} 
//echo $_POST['c'];
                    ?>
		    			<!--/select>
					</td>
				 </tr-->	
	
  	 	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
      		<tr>
  			  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
  			  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
  			  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
  			  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
  			  <th width="10%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
  			</tr>
      		<tr> 
  	     <td><input  type="number" class="txt_campo"  name="debe_1" id="debe_1"  onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
  			 <td><input  class="txt_campo" type="number" name="haber_1" id="haber_1" onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
  			 <td><input  class="txt_campo" type="number" name="debe_2"  id="debe_2"  onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
  			 <td><input  class="txt_campo" type="number" name="haber_2" id="haber_2" onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
  			 <td><input  class="txt_campo" type="text" name="glosa_2" size="28" value = " " > </td>
     			</tr>
    		</table>
	 
    	 <center><br>
    	 		<input class="btn_form" type="submit" name="accion" value="Adicionar">
          <input class="btn_form" type="button" name="factura_e" id="factura_e" value="Factura egresos" style="display:none" onClick="dialog();">
           <input class="btn_form" type="button" name="factura_i" id="factura_i" value="Factura ingresos" style="display:none" onClick="dialogo();">


        </form>	
        <!--form name="form2" method="post" action="grab_fact.php" -->
        <!--/form-->



<!--inicio del formulario factura egresos-->
<div id="dialog" title="Datos de la Factura" style="display:none; ">
    <form name="form2" method="post" action="grab_fact.php" onSubmit="return ValidaCamposEgresosFac(this)">


            <table align="center" class="table_usuario">
  
             <tr>
                <th align="left">NIT del Proveedoor :</th>
                <td><input class="txt_campo" type="text" name="nit" id="nit" size="15" maxlength="15" onKeyPress="return soloNum(event)" > 
                <div id="error_nit_e"></div></td>
             </tr>
             <tr>
                <th align="left">Nro. de Factura :</th>
                 <td><input class="txt_campo" type="text" name="nro_fac" id="nro_fac" size="10" maxlength="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
                <div id="error_nro_fac_e"></div> </td>
             </tr> 
             <tr>
                <th align="left" >Nro de Autorizaci&oacute;n</th>
                <td><input class="txt_campo" type="text" name="nro_auto" id="nro_auto" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> <div id="error_nro_auto_e"></div></td>
            </tr>
            <tr>
                <th align="left" >Nombre o Raz&oacute;n Social :</th>
                <td><input class="txt_campo" type="text" name="razon_social" id="razon_social" maxlength="60"  size="10" > 
        <div id="error_razon_social_e"></div></td>
           </tr>
           <tr>   
              <th align="left" >Fecha de Factura :</th>
              <td><input class="txt_campo" type="text" name="fec_fac" id="datepicker" maxlength="10"  size="10"  onKeyPress="return soloNum(event)" onBlur="limpia()">  
        <div id="error_periodo_e"></div></td>
         </tr>
          <tr>
            <th align="left">Importe Total :</th>
              <td><input class="txt_campo" type="text" name="imp_tot" id="imp_tot" size="15" maxlength="15" readonly> 
              <div id="error_imp_tot_e"></div>
            </td>
         </tr>
         <tr>
              <th align="left">Importe ICE :</th>
              <td><input class="txt_campo" type="text" name="imp_ice" id="imp_ice" size="10" maxlength="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
              </td>
        </tr> 
         <tr>
              <th align="left" >Importe Excenta</th>
             <td><input class="txt_campo" type="text" name="imp_excento" id="imp_excento" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
         </tr>
         <tr>
              <th align="left" >Total NETO :</th>
             <td><input class="txt_campo" type="text" name="tot_neto" id="tot_neto" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()">     <div id="error_tot_neto_e"></div></td>
         </tr>
         <tr>   
             <th align="left" >Cr&eacute;dito Fiscal IVA :</th>
              <td><input class="txt_campo" type="text" name="cred_fisc_iva" id="cred_iva" maxlength="10"  size="10" readonly> <div id="error_cred_iva_e"></div> </td>
         </tr>
         <tr>   
            <th align="left" >C&oacute;digo de Control :</th>
            <td><input class="txt_campo" type="text" name="cod_control" id="cod_control" maxlength="15"  size="10" >
            <div id="error_cod_control_e"></div> </td>
         </tr>
         <input class="txt_campo" type="text" name="debe1" id="debe1" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="haber1" id="haber1" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="debe2" id="debe2" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="haber2" id="haber2" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="glosas" id="glosas" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="cuen_cont" id="cuen_cont" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="glosas2" id="glosas2" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="fac_egres" id="fac_egres" maxlength="10"  size="10" value="facturaegreso" >
<?php 

?>
    </table>
         <center>
            <br>
           <input class="btn_form" type="submit" name="accion" value="Grabar Egresos">
          

    </form>
</div>

<!--fin formulario de la factura egresos-->



<!--formulario de la factura ingresos-->

<div id="dialogo" title="Datos de la Factura" style="display:none; ">
    <form name="form2" method="post" action="grab_fact.php" onSubmit="return ValidaCamposEgresosFac(this)">

            <table align="center" class="table_usuario">
  
             <tr>
                <th align="left">NIT del Proveedorr :</th>
                <td><input class="txt_campo" type="text" name="nit" id="nit_i" size="15" maxlength="15" onKeyPress="return soloNum(event)"> 
                <div id="error_nit_i"></div></td>
             </tr>
             <tr>
                <th align="left">Nro. de Factura :</th>
                 <td><input class="txt_campo" type="text" name="nro_fac" id="nro_fac_i" size="10" maxlength="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
                <div id="error_nro_fac_i"></div> </td>
             </tr> 
             <tr>
                <th align="left" >Nro de Autorizaci&oacute;n</th>
                <td><input class="txt_campo" type="text" name="nro_auto" id="nro_auto_i" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> <div id="error_nro_auto_i"></div></td>
            </tr>
            <tr>
                <th align="left" >Nombre o Raz&oacute;n Social :</th>
                <td><input class="txt_campo" type="text" name="razon_social" id="razon_social_i" maxlength="60"  size="10" > 
        <div id="error_razon_social_i"></div></td>
           </tr>
           <tr>   
              <th align="left" >Fecha de Factura :</th>
              <td><input class="txt_campo" type="text" name="fec_fac" id="datepicker2" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
               <div id="error_periodo_i"></div> </td>
         </tr>
          <tr>
            <th align="left">Importe Total :</th>
              <td><input class="txt_campo" type="text" name="imp_tot" id="imp_tot_i" size="15" maxlength="15" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
              <div id="error_imp_tot_i"></div>
            </td>
         </tr>
         <tr>
              <th align="left">Importe ICE :</th>
              <td><input class="txt_campo" type="text" name="imp_ice" id="imp_ice_i" size="10" maxlength="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> 
              </td>
        </tr> 
         <tr>
              <th align="left" >Importe Excenta</th>
             <td><input class="txt_campo" type="text" name="imp_excento" id="imp_excento_i" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()"> </td>
         </tr>
         <tr>
              <th align="left" >Total NETO :</th>
             <td><input class="txt_campo" type="text" name="tot_neto" id="tot_neto_i" maxlength="10"  size="10" onKeyPress="return soloNum(event)" onBlur="limpia()">
       <div id="error_tot_neto_i"></div> </td>
         </tr>
         <tr>   
             <th align="left" >Cr&eacute;dito Fiscal IVA :</th>
              <td><input class="txt_campo" type="text" name="cred_fisc_iva" id="cred_iva_i" maxlength="10"  size="10"  onKeyPress="return soloNum(event)" onBlur="limpia()"> 
            <div id="error_cred_iva_i"></div> </td>
         </tr>
         <tr>   
            <th align="left" >Factura Anulada :</th>
            <td>
        <input type="checkbox" name="fac_anu" ><br>
              
            <div id="error_llave"></div> </td>
         </tr>
          <input class="txt_campo" type="text" name="debe1" id="debe1_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="haber1" id="haber1_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="debe2" id="debe2_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="haber2" id="haber2_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="glosas" id="glosas_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="cuen_cont" id="cuen_cont_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="glosas2" id="glosas2_i" maxlength="10"  size="10" >
         <input class="txt_campo" type="text" name="fac_ingr" id="fac_ingr_i" maxlength="10"  size="10" value="facturaingreso" >
   <?php 
    
?>      
    </table>
         <center>
            <br>
           <input class="btn_form" type="submit" name="accion" value="Grabar Ingresos">
          

    </form>
</div>
<!--fin del formulario de factura-->

         <form name="form2" method="post" action="con_retro_1.php" onSubmit="return">   <!--2do form-->

         <?php } ?>


        <?php
        	$apli = 10000;
        	$_SESSION['monto_t'] = 0;
        	$descrip = "";
        	$tc_ctb = round($_SESSION['TC_CONTAB'],2);
          //echo $tc_ctb;
        	//$cuantos = 0;
        	$debe_1 = 0;
        	$haber_1 = 0;
        	$debe_2 = 0;
        	$haber_2 = 0;
        	$mon_cta = 0;
/*
    $_SESSION['debe1'] ;
    $_SESSION['haber1'] ;
    $_SESSION['debe2'] ;
    $_SESSION['haber2'] ;
    $_SESSION['glosa'] ;
    $_SESSION['cuenta'] ;
    $_SESSION['glosas'] ;
*/


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
              if (isset ($_SESSION['cuenta'])){
                  if ($_SESSION['cuenta'] <> ""){ //4a  
                   $cod_cta = $_SESSION['cuenta'];
                 $mon_cta = $cod_cta[5]; 
                   $_SESSION['cod_cta'] = $cod_cta;
                } //4b
              }
        		

            if (isset ($_POST['debe_1'])){  
        	      	if ($_POST['debe_1'] > 0){ //5a  
        			     $debe_1 = $_POST['debe_1'];
        			  	 $_SESSION['debe_1'] = $debe_1;
        		  	}   
        		}//5b
            if (isset($_SESSION['debe1'])){  
                  
                if ($_SESSION['debe1'] > 0){ //5a  
                   $debe_1 = $_SESSION['debe1'];
                   $_SESSION['debe_1'] = $debe_1;
                }
            }//5b



        	   if (isset ($_POST['haber_1'])){  
        	     if ($_POST['haber_1'] > 0){ //5a  
        		     $haber_1 = $_POST['haber_1'];
        		  	 $_SESSION['haber_1'] = $haber_1;
        		  }
        		 } //6b
              if (isset ($_SESSION['haber1'])){  
               if ($_SESSION['haber1'] > 0){ //5a  
                 $haber_1 = $_SESSION['haber1'];
                 $_SESSION['haber_1'] = $haber_1;
              }
             } //6b


        		if (isset ($_POST['debe_2'])){  
        		   if ($_POST['debe_2'] > 0){ //5a  
        		     $debe_2 = $_POST['debe_2'];
        		  	 $_SESSION['debe_2'] = $debe_2;
        		  } //5b
        		} 

            if (isset ($_SESSION['debe2'])){  
               if ($_SESSION['debe2'] > 0){ //5a  
                 $debe_2 = $_SESSION['debe2'];
                 $_SESSION['debe_2'] = $debe_2;
              } //5b
            } 




        	 	if (isset ($_POST['haber_2'])){ 	 
        	     	if ($_POST['haber_2'] > 0){ //5a  
        		     $haber_2 = $_POST['haber_2'];
        		  	 $_SESSION['haber_2'] = $haber_2;
        		  } 
        		}	 

            if (isset ($_SESSION['haber2'])){    
                if ($_SESSION['haber2'] > 0){ //5a  
                 $haber_2 = $_SESSION['haber2'];
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
          	<br>
          	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
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
          		   
            	 <?php //echo $mon_cta;
             if (($debe_1 > 0) and ($haber_1 > 0) or ($debe_2 > 0) and ($haber_2 > 0)){
                //echo "Errorrrr";
            }else{     	
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
    


            	if ((($debe_1 + $haber_1 + $debe_2 +  $haber_2) > 0) and ($cod_cta <> "Seleccione una Cuenta...." )){
            	   
            	//  echo $cod_cta."----"."cta vacia";
                  $des_cta = leer_cta_des($cod_cta);
            	  $descrip = $_SESSION['descrip'];
            	  $_SESSION['cuantos'] = $_SESSION['cuantos'] + 1;
            	  $cuantos = $_SESSION['cuantos'];
            //echo $descrip.encadenar(2).$cod_cta.encadenar(2).$deb_hab.encadenar(2).$monto_t;	
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
                          										        '$descrip',
                          										        '$glosa_2')";
            										   
                $resultado = mysql_query($consulta);
            	}
            	}
	
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
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
		       <td align="right"><?php echo $linea['temp_tip_tra']; ?></td>
	 	      <td align="right"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo utf8_encode($linea['temp_des_cta']); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.','') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',''); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.','') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',''); ?></td>
			 
			   <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
			  
			  
	     </tr>
	
     <?php }?>
         <tr>
		     <th><?php echo encadenar(3); ?></th>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <?php 
			 //echo $tot_debe_1."Aquiiii".$tot_haber_1;
				if (($tot_debe_1==$tot_haber_1) ) { ?>
		     
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
		     <?php  } else{ ?>
	 			 <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
		      <?php  }  ?>
	     </tr>
     </table>

 <center><br>

	 <input class="btn_form" type="submit" name="accion" value="Eliminar Cuenta">   
	 <input class="btn_form" type="submit" name="accion" value="Modificar">
     <?php 
     if (($tot_debe_1==$tot_haber_1)) { ?>
     	<input class="btn_form" type="submit" name="accion" value="Grabar" >
    <?php  }  ?>
    	 
     <!--center>
	 <input class="btn_form" type="submit" name="accion" value="Elimina_linea">   
	 <input class="btn_form" type="submit" name="accion" value="Modificar">
	 <input class="btn_form" type="submit" name="accion" value="Grabarggggggg">
     <input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	
 <?php } //1b?>
 
 
  <?php
 if(isset($_SESSION['eliminar'])){
 if ($_SESSION['eliminar'] == 1){



   // echo $_SESSION['entra'];
    if(isset($_POST['cmone'])){ //2a
       $cmone = $_POST['cmone'];
	   $_SESSION['cmone'] = $cmone;
	 //echo $_SESSION['cmone'].'kk';?>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">
  <?php
	$consulta  = "Delete From temp_ctable3 where temp_tip_tra =".$cmone;
	//echo  $consulta;
     $resultado = mysql_query($consulta);
	$consulta  = "Select * From temp_ctable3 order by temp_tip_tra";
    $resultado = mysql_query($consulta);
	$num = mysql_num_rows($resultado); 
	if($num > 0){
		
	
	?>
	<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">

 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
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
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; ?>
	      <tr>
		       <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	 	      <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo utf8_encode($linea['temp_des_cta']); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.','') ; ?></td>
		      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',''); ?></td>
		      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.','') ; ?></td>
		      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',''); ?></td>
			  <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',''); ?></td>
			   <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
			  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
			  
			  
	     </tr>
	
     <?php }?>
         <tr>
		     <th><?php echo encadenar(3); ?></th>
	       	 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <?php if ($tot_debe_1==$tot_haber_1) { ?>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
		     <?php } else { ?>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
		      <?php }  ?>
	     </tr>
     </table>
     <center>
      <br>
	 <input class="btn_form" type="submit" name="accion" value="Eliminar Cuenta">   
	 <input class="btn_form" type="submit" name="accion" value="Modificar">
	 <?php if ($tot_debe_1==$tot_haber_1) { ?>
	 <input class="btn_form" type="submit" name="accion" value="Grabar">
	 <?php }  ?>
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>	

 <?php
 }// if  si mnor a cero
 }
 }
} 
?>
<?php
    
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
             $tot_debe_1 = round($tot_debe_1 +$lin_temp['temp_debe_1'],2);
	         $tot_haber_1 = round($tot_haber_1 +$lin_temp['temp_haber_1'],2);
	    }
			

//*****************************************************************************************************

	if ($tot_debe_1 <> $tot_haber_1) {	 ?>

<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
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
	        //$tot_debe_2 = $tot_debe_2 +$linea['temp_debe_2'];
	        //$tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo utf8_encode($linea['temp_des_cta']); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.','') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',''); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.','') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',''); ?></td>
			 <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
			<td><INPUT NAME="nlin" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
			
	     </tr>
	
    <?php }
	
	   echo "No iguala Debe y Haber Revise y Modifique ......... ";  ?>
	    <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
 			<?php if ($tot_debe_1==$tot_haber_1) { ?>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
		     <?php } else { ?>
			      <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
		     <?php }  ?>
	     </tr>
	   </table>
	<center>
    <br>
	 <input class="btn_form" type="submit" name="accion" value="Retornar">
    
	   
	<?php   //**************************************************************************************************** 
	   
    }else{
  
  	 ?>
<?php 
	//*******************EMPIEZA FORMULARIO PARA LA IMPRESION**************************************************
 ?>
<form name="form2" method="post" action="con_retro_1.php" onSubmit="return">	
 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
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
	        $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2'];
			$nro_lin = $linea['temp_tip_tra'];
	 ?>
	    <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo utf8_encode($linea['temp_des_cta']); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.','') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',''); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.','') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',''); ?></td>
			 <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
	    </tr>
	
    <?php }
	
	  //echo "Revise Bien antes de Imprimir ......... ".encadenar(2). $_SESSION['descrip'];
     //echo $_SESSION['descrip'];
    
  
  ?>
   <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>
		     <?php if ($tot_debe_1==$tot_haber_1) { ?>
		     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
		     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
		     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
		     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
		      <?php } else { ?>
		      <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
		     <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
		     <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
		     <th align="right" style="color: #F51919;" ><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>

		      <?php }  ?>
	     </tr>
  
  	</table>
	<center>
    <br>
	 <input class="btn_form" type="submit" name="accion" value="Imprimir">
	 <input class="btn_form" type="submit" name="accion" value="Retornar">

     <!--input class="btn_form" type="submit" name="accion" value="Saliraaaaa"-->

     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->


</form>	

<?php 
	//*******************TERMINA FORMULARIO PARA LA IMPRESION**************************************************
 ?>

<?php 
	//*******************EMPIEZA FORMULARIO PARA LA MODIFICACION**************************************************
 ?>

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
	 <br>
	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="">

  <?php
  
	 $con_modi  = "Select * From temp_ctable3 where temp_tip_tra = $cmone";
     $res_modi = mysql_query($con_modi);
	   while ($lin_modi = mysql_fetch_array($res_modi)) { ?>
	   
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
	  <th scope="col"><border="0" alt="" align="absmiddle" />Nro.</th>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>

	 
	</tr>
		 
  <!--  <tr> 
	 
	  <td> <select name="nue_cta" size="1"  >
	  	<!--option>Seleccione una Cuenta.....</option-->
	       <?php //while ($lin_cta1 = mysql_fetch_array($res_ctas1)) { ?>
           <option value=<?php // echo $lin_cta1['CONTA_CTA_NRO']; ?>>
		                 <?php //echo $lin_cta1['CONTA_CTA_NRO']; ?>
			              <?php // echo $lin_cta1['CONTA_CTA_DESC']; ?></option>
           <?php  //} ?>
		    </select>
			<!--</td>
	 <td align="left"><?php //echo encadenar(50); ?></td> 		
	 </tr>	-->
 	  <tr>
	          <td align="left"><?php echo $lin_modi['temp_tip_tra']; ?></td> 
	 	      <td align="left"><?php echo $lin_modi['temp_nro_cta']; ?></td>
		      <td align="left"><?php echo utf8_encode($lin_modi['temp_des_cta']); ?></td>
	 </tr>
</table>
	
	
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
 <tr>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER Bs.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />DEBE $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />HABER $us.</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />GLOSA</th>
 </tr>

	 
	 <tr>		  
	   		  <td align="right"><input class="txt_campo" type="text" name="nue_deb1" id="nue_deb1" align="right" size="10" 
			   value="<?php echo number_format($lin_modi['temp_debe_1'], 2, '.',''); ?>">
			  <td align="right"><input class="txt_campo" type="text" name="nue_hab1" id="nue_hab1" align="right" size="10"
			   value="<?php echo number_format($lin_modi['temp_haber_1'], 2, '.',''); ?>">	
			   <td align="right"><input class="txt_campo" type="text" name="nue_deb2" id="nue_deb2" align="right" size="10"
			   value="<?php echo number_format($lin_modi['temp_debe_2'], 2, '.',''); ?>">
			  <td align="right"><input class="txt_campo" type="text" name="nue_hab2" id="nue_hab2" align="right" size="10"
			   value="<?php echo number_format($lin_modi['temp_haber_2'], 2, '.',''); ?>">
			   <td align="right"><input class="txt_campo" type="text" name="nue_glo" align="right" 
			   value="<?php echo $lin_modi['temp_glosa2']; ?>">		 
        </tr>
	</table><br>
	<input class="btn_form" type="submit" name="accion" value="Guardar Modificacion">

   
	 </form>		 
   <?php 
		 
	   }
	$consulta  = "Select * From temp_ctable3 order by temp_debe_2";
    $resultado = mysql_query($consulta);?>
	<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
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
	      $tot_haber_2 = $tot_haber_2 +$linea['temp_haber_2']; 
		  $_SESSION['cta_org'] = $linea['temp_nro_cta'];?>
		  
	       <tr>
		    <td align="left"><?php echo $linea['temp_tip_tra']; ?></td>
	        <td align="left"><?php echo $linea['temp_nro_cta']; ?></td>
	  	    <td align="left"><?php echo utf8_encode($linea['temp_des_cta']); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.','') ; ?></td>
		    <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',''); ?></td>
		    <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.','') ; ?></td>
		    <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',''); ?></td>
	    </tr>
	 <?php }



	 ?>
         <tr>
	       	 <th><?php echo encadenar(3); ?></th>
			 <th><?php echo encadenar(3); ?></th>
		     <th align="center"><?php echo "Totales"; ?></th>

		      <?php //echo $tot_debe_1."--". $tot_haber_1;
			   if ($tot_debe_1==$tot_haber_1) { ?>
				     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
				     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
				     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
				     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
		      <?php } else{ ?>
			         <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
			         <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
			         <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
			         <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
			 <?php 	}   ?>
	     </tr>
  
  	</table>
	 <center>
 	

       <!--input class="btn_form" type="submit" name="accion" value="Grabar"-->

       <!--input class="btn_form" type="submit" name="accion" value="GrabarFFFFFFF"-->

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
	 $nue_cta =  $_SESSION['cta_org'];
	 if (isset($_POST['nue_cta'])){
       if ($_POST['nue_cta'] <> ""){ //4a  
  	     $nue_cta = $_POST['nue_cta'];
  		   $mon_cta = $nue_cta[5]; 
  	     $_SESSION['nue_cta'] = $nue_cta;
  	  }	
	  }//4b
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
										                     temp_glosa2 = '$nue_glo'
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
 		<table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
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
			      <td align="left"><?php echo utf8_encode($linea['temp_des_cta']); ?></td>
			      <td align="right"><?php echo number_format($linea['temp_debe_1'], 2, '.','') ; ?></td>
			      <td align="right"><?php echo number_format($linea['temp_haber_1'], 2, '.',''); ?></td>
			      <td align="right"><?php echo number_format($linea['temp_debe_2'], 2, '.','') ; ?></td>
			      <td align="right"  ><?php echo number_format($linea['temp_haber_2'], 2, '.',''); ?></td>
				  <td align="left"><?php echo $linea['temp_glosa2']; ?></td>
				  <td align="center"><INPUT NAME="cmone" TYPE=RADIO VALUE="<?php echo $linea['temp_tip_tra']; ?>">	</td> 
		     </tr>
	
     			<?php }?>
         	<tr>
	       	 	<th><?php echo encadenar(3); ?></th>
		     	<th align="center"><?php echo "Totales"; ?></th>
		     	<?php 
		     	if ($tot_debe_1==$tot_haber_1) { ?>
	     		<th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_1, 2, '.','') ; ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th> 
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
			     <th align="right" style="color: #3B8408;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
		     	<?php 	} else{ ?>
			     <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_1, 2, '.',' ') ; ?></th>
			         <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_1, 2, '.',''); ?></th>
			         <th align="right" style="color: #F51919;"><?php echo number_format($tot_debe_2, 2, '.','') ; ?></th>
			         <th align="right" style="color: #F51919;"><?php echo number_format($tot_haber_2, 2, '.',''); ?></th>
	 			<?php 	}   ?>

	    	 </tr>
     	</table>

		     <center><br>
			 <input class="btn_form" type="submit" name="accion" value="Eliminar Cuenta">   
			 <input class="btn_form" type="submit" name="accion" value="Modificar">
	  
	  		<?php 
		     	if ($tot_debe_1==$tot_haber_1) { ?>
           <br>
	 		<input class="btn_form" type="submit" name="accion" value="Grabar">
	 		 <?php } ?>

     		<!--input class="btn_form" type="submit" name="accion" value="Saliraaaaa"-->
	 <!--input class="btn_form" type="submit" name="accion" value="Grabar">

     		<input class="btn_form" type="submit" name="accion" value="Salir"-->

	

	  <?php 
		    // 	} ?>
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->


	</form>	

 <?php $_SESSION['continuar'] = 3;
	       $_SESSION['detalle'] = 3;
		   
		   require 'con_asiento.php';
 } //1b?>
	
	
	 
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