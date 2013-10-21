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
<!--Titulo de la pesta�a de la pagina-->
<title>Alta de Cuenta Contable</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/contabilidad_reportes_estado_sys.js"></script> 
<script type="text/javascript" src="js/contabilidad_mant_plan_alta.js"></script>
<script type="text/javascript" src="script/ValidaCampo.js"></script>
<!--script type="text/javascript" src="js/alt_plan_cta.js"></script-->
 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
		<script type="text/javascript" src="js/Utilitarios.js"></script> 

 
</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Cuenta Contable no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nivel no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Descripcion no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Cuenta Revalorizacion no puede estar vacio.</font></p>
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
                  <?php
                      if($_SESSION['menu']==5){?> 
                  <li id="menu_modulo_cont_mant_plan">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. PLAN CTAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE CUENTAS
                    
                 </li>
              </ul>  
  


				<div id="contenido_modulo">

                      <h2> <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE CUENTAS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Ingrese los datos para validar la cuenta
        </div>

        	<?php }elseif ($_SESSION['menu']==7) { ?>
    		<li id="menu_modulo_cont_mant_plan">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. PLAN CTAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE CUENTAS
                    
                 </li>
              </ul>  
  


				<div id="contenido_modulo">

                      <h2> <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE CUENTAS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Ingrese los datos para validar la cuenta
        </div>
        <?php } ?>
        
	
        
				<?php
					// $fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
            
<!-- <form name="form2" method="post" action="egre_retro_1.php" style="border:groove" onSubmit="return"> >-->
  <!--form name="form2" method="post" action="con_retro_1.php" onSubmit="return Valida(this);" onSubmit="return ValidaCamposEgresos(this)"-->
  	 <form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposAltaCuentas(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


if ($_SESSION['detalle'] == 1){
  if (isset($_SESSION['msg_error'])){ ?>
    <font color="#FF0000">
    <!--table bgcolor= "#E2DD3B" border=1>
    	<tr>
         <td> </td></tr-->
    			
	<!--div style="display:none;" id="error_login"> 
	<img src="img/checkmark_32x32.png" align="absmiddle"-->
   <!--/table-->

   <?php  echo $_SESSION['msg_error']; ?>
    <!--/div-->
	</font>
	<?php
	 }
$con_ctas  = "Select * From contab_cuenta ";
    $res_ctas = mysql_query($con_ctas);

//$datos = $_SESSION['form_buffer'];
 ?>
  <table align="center" >
        <tr> 
      <th align="left">Plan de Cuentas:</th>
	  <td> <select name="cod_ct_a" size="1"  >
	       <?php while ($lin_cta = mysql_fetch_array($res_ctas)) { ?>
           <option value=<?php echo $lin_cta['CONTA_CTA_NRO']; ?>>
		                 <?php echo $lin_cta['CONTA_CTA_NIVEL'].
						       encadenar(2); ?>
		                 <?php echo $lin_cta['CONTA_CTA_NRO']; ?>
			              <?php echo utf8_encode($lin_cta['CONTA_CTA_DESC']); ?></option>
           <?php } ?>
		    </select>
			<br><br>	</td>
	 </tr>	
        <tr>
        <th align="left">Cuenta Contable :</th>
	    <td><input class="txt_campo" type="number" name="cod_cta" id="cod_cta" size="8" maxlength="10" onKeyPress="return soloNum(event)" onBlur="limpia()" > <div id="error_cod_cta"></div> </td>
		 </tr>
		 <tr>
        <th align="left">Nivel :</th>
	    <td><input class="txt_campo" type="text" name="niv_cta" id="niv_cta" size="1" maxlength="1"> <div id="error_niv_cta"></div> </td>
		 </tr> 
		 <tr>
        <th align="left">Descripci&oacute;n :</th>
	    <td><input class="txt_campo" type="text" name="descrip" id="descrip" size="50" maxlength="65"> <div id="error_descrip"></div> </td>
		 </tr>
		  <tr>
        <th align="left">Cuenta Revalorizaci&oacute;n :</th>
	    <td><input class="txt_campo" type="text" name="cod_cta_r" id="cod_cta_r" size="8" maxlength="8" value= "" onKeyPress="return soloNum(event)" onBlur="limpia()" > <div id="error_cod_cta_r"></div> </td>
		 </tr>
		
        </table>
	 <center>
	    <br>
	 <input class="btn_form" type="submit" name="accion" value="Registrar Cuenta">
     <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>
    <?php } ?>
<?php
if ($_SESSION['detalle'] == 2){  //1a
     $_SESSION['msg_error'] = "";?>
    
<?php
$apli = 10000;
$_SESSION['monto_t'] = 0;
$_SESSION['monto_p'] = 0;
$_SESSION['monto_i'] = 0;
$_SESSION['monto_125'] = 0;
$_SESSION['monto_3'] = 0;
$_SESSION['t_fac_fis'] = 0;
$tc_ctb = $_SESSION['TC_CONTAB'];
//$c_agen = $_POST['cod_agencia'];
//$_SESSION['c_agen'] = $c_agen;
// $nro_tr_caj = leer_nro_co_cja($apli,$c_agen);
$_SESSION['descrip'] = ""; 
if ($_POST['descrip'] <> ""){  
	$descrip = $_POST['descrip'];
	$descrip = strtoupper ($descrip);
	$_SESSION['descrip'] = $descrip;
	}
$cta_ctbg = $_POST['cod_cta'];
$_SESSION['cta_ctbg'] =  $cta_ctbg;
$cta_ctbr = $_POST['cod_cta_r'];
$_SESSION['cta_ctbr'] =  $cta_ctbr;
 if (ctype_digit($cta_ctbg)) {
       // echo "Son numeros"; 
    } else {

         $_SESSION['msg_error']= " <center><table style='border:1px solid #AFA23E;' bgcolor= '#F0DB7B'><tr  rowspan='2'><td><img src='img/alert_32x32.png' align='absmiddle'></td>"."<td>La Cuenta contable solo deben tener n�meros</td></tr></table></center>";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_plan_cta.php');
    }
$nro_digitos = strlen($cta_ctbg);
if (strlen($cta_ctbg)<>8){
      $_SESSION['msg_error']=" <center><table style='border:1px solid #AFA23E;' bgcolor= '#F0DB7B'><tr  rowspan='2'><td><img src='img/alert_32x32.png' align='absmiddle'></td>"."<td>La Cantidad de digitos de la cuenta contable deben ser 13, rellene con Ceros a la derecha</td></tr></table></center>";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_plan_cta.php');


}
$hay_cta =0; 
//echo $hay_cta."hay";
 $con_trc = "SELECT count(*) FROM contab_cuenta where CONTA_CTA_NRO = '$cta_ctbg'";
   $res_trc = mysql_query($con_trc);
   while ($lin_trc = mysql_fetch_array($res_trc)) {
         $hay_cta =  $lin_trc['count(*)'];
		 //echo $hay_cta."hay";
      }
if ($hay_cta > 0){
    $_SESSION['msg_error']=" <center><table style='border:1px solid #AFA23E;' bgcolor= '#F0DB7B'><tr  rowspan='2'><td><img src='img/alert_32x32.png' align='absmiddle'></td>". "<td>Cuenta ya existe</td></tr></table></center>";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_plan_cta.php');
}
$_SESSION['mone'] = 0;
$uno = substr($cta_ctbg,0,1);
$dos = substr($cta_ctbg,1,1);
$tre = substr($cta_ctbg,2,1);
$cua = substr($cta_ctbg,3,2);
$cin = substr($cta_ctbg,5,1);
$sei = substr($cta_ctbg,6,2);
$_SESSION['mone'] = $cin;
if (($uno <> 1)and($uno <> 2)and($uno <> 3)and($uno <> 4)and($uno <> 5) ){
      $_SESSION['msg_error']= " <center><table style='border:1px solid #AFA23E;' bgcolor= '#F0DB7B'><tr  rowspan='2'><td><img src='img/alert_32x32.png' align='absmiddle'></td>"."<td>Nivel uno con d�gito no valido debe ser 1,2,3,4 o 5</td></tr></table></center>";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_plan_cta.php');


}
if ($_SESSION['descrip'] == "" ){
      $_SESSION['msg_error']=" <center><table style='border:1px solid #AFA23E;' bgcolor= '#F0DB7B'><tr  rowspan='2'><td><img src='img/alert_32x32.png' align='absmiddle'></td>". "<td>Debe Ingresar Descripcion</td></tr></table></center>";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_plan_cta.php');


}

//echo strlen($cta_ctbg)."-".$uno."-".$dos."-".$tre."-".$cua."-".$cin."-".$sei; 

$cta_ctbr = $_POST['cod_cta_r'];
$_SESSION['cta_ctbr'] =  $cta_ctbr;
if ($_POST['niv_cta'] <> ""){  
	$niv_cta = $_POST['niv_cta'];
	$niv_cta = strtoupper ($niv_cta);
	$_SESSION['niv_cta'] = $niv_cta;
	}
if (ctype_digit($niv_cta)) {
    if (($niv_cta < 0) or ($niv_cta > 5)){
        $_SESSION['msg_error']= " <center><table style='border:1px solid #AFA23E;' bgcolor= '#F0DB7B'><tr  rowspan='2'><td><img src='img/alert_32x32.png' align='absmiddle'></td>"."<td>Nivel no Valido</td></tr></table></center>";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_plan_cta.php');
		 }
    } else {
	  if (($niv_cta <> 'A')){
         $_SESSION['msg_error']= " <center><table style='border:1px solid #AFA23E;' bgcolor= '#F0DB7B'><tr  rowspan='2'><td><img src='img/alert_32x32.png' align='absmiddle'></td>"."<td>Nivel no Valido</td></tr></table></center>";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_plan_cta.php');
		 }
    }
//Valida Moneda
	 if ((($cin < 1) or ($cin > 2))and ($niv_cta == "A" or $niv_cta == "5")){
        $_SESSION['msg_error']= " <center><table style='border:1px solid #AFA23E;' bgcolor= '#F0DB7B'><tr  rowspan='2'><td><img src='img/alert_32x32.png' align='absmiddle'></td>"."<td>Moneda no Valida</td></tr></table></center>";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_plan_cta.php');
		 }
if (($cta_ctbr == 0) and ($niv_cta == "A") and ($cin == 2)){
    $_SESSION['msg_error']= " <center><table style='border:1px solid #AFA23E;' bgcolor= '#F0DB7B'><tr  rowspan='2'><td><img src='img/alert_32x32.png' align='absmiddle'></td>"."<td>Cuenta en Dolares Necesita Cuenta de Revalorizacion</td></tr></table></center>";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: alt_plan_cta.php');  
		 }
     // }	
	
//Factura
 //Factura excenta

 //Pago Servicios

 
 
if ($_SESSION['t_fac_fis'] <> 3){ 
 
echo "Detalle Contable";

?>

 <table width="100%"  border="1" cellspacing="1" cellpadding="1" align="center" class="table_usuario">
    <tr>
      <th scope="col"><border="0" alt="" align="absmiddle" />CUENTA</th>
	  <th width="40%" scope="col"><border="0" alt="" align="absmiddle" />DESCRIPCION</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />NIVEL</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />MONEDA</th>
	  <th width="15%" scope="col"><border="0" alt="" align="absmiddle" />CTA.REV.</th>
	  	  
	</tr>
<?php	
 
	?>
	 
		<?php  ?>
			      
        <tr>
		 <td align="left" ><?php echo $cta_ctbg; ?></td> 
		 <td align="left" ><?php echo $descrip; ?></td> 
		 <td align="right" ><?php echo $niv_cta; ?></td>
		 <td align="right" ><?php echo $cin; ?></td>
		 <td align="right" ><?php echo $cta_ctbr; ?></td>
	 	</tr>
	
		
		<?php  ?>	 
 </table> 
 	
<center>
     <input class="btn_form" type="submit" name="accion" value="Grabar Cta.">
     <!--input type="submit" name="accion" value="Salir"-->



 <?php } ?>
 <?php } ?>
 
 <?php 
 if ($_SESSION['detalle'] == 3){
    $cta_ctbg = $_SESSION['cta_ctbg'];
	$descrip = $_SESSION['descrip'];
	$niv_cta = $_SESSION['niv_cta'];
	$cin = $_SESSION['mone'];
	$cta_ctbr = $_SESSION['cta_ctbr'];
   
      $consulta = "insert into contab_cuenta (CONTA_CTA_NRO, 
                                             CONTA_CTA_DESC,
									         CONTA_CTA_NIVEL,
									         CONTA_CTA_MONE,
					                         CONTA_CTA_AITB
					                      ) values ('$cta_ctbg',
									             '$descrip',
												 '$niv_cta',
												  $cin,
												 '$cta_ctbr'
												  )";
$resultado = mysql_query($consulta);	
 header('Location: con_mant_plan.php');	 
	 
  //echo $_SESSION['monto_i'].encadenar.$_SESSION['monto_p'].encadenar(2).$_SESSION['cta_f13'];
  
 }

 
 ?>
	 
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