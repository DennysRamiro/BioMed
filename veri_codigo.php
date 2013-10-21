<?php

   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else { 
	require_once('configuracion.php');
    require_once('funciones.php');


	//require('e:\xampp\htdocs\cc7\lib7\libreriaCC7.php');

	require('d:\xampp\htdocs\cc7\lib7\libreriaCC7.php');


?>
<html>
<head>
<!--Titulo de la pesta�a de la pagina-->
<title>Verificacion Codigo Control</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 
<script type="text/javascript" src="js/Utilitarios.js"></script> 
<!--script type="text/javascript" src="js/Verificar.js"></script--> 

<script type="text/javascript" src="script/ejecuta.js"></script> 

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>   
</head>

<body onLoad="muestra()">

<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nro. Orden no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nro. Factura no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Emision no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo CI/Nit Cliente no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Llave no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm5" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Monto no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm6" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">La fecha seleccionada no puede ser mayor a la fecha actual.</font></p>
</div>
<div id="confirma" title="Verificacion" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Los campos fueron grabados exitosamente</font></p>
</div>



	<?php
				include("header.php");
			?>

			<?php
					 $fec = $_SESSION['fec_proc'];  //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
	<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_facturacion">
                    
                     <img src="img/FAX_24x24.png" border="0" alt="Modulo" align="absmiddle"> FACTURACION
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/checkmark_24x24.png" border="0" alt="Modulo" align="absmiddle"> VERIFICA CODIGO
                    
                 </li>
              </ul> 
	           <div id="contenido_modulo">

                      <h2> <img src="img/checkmark_64x64.png" border="0" alt="Modulo" align="absmiddle"> VERIFICA CODIGO </h2>
                      <hr style="border:1px dashed #767676;">
          
	<?php if ($_SESSION['detalle']==1) { ?>
	
                       <div id="error_login"> 


          <img src="img/checkmark_32x32.png" align="absmiddle">
        <!--?php echo $_SESSION['msg_error']; ?--> Ingrese los datos para verificar C&oacute;digo
        </div>
    <?php } ?>	
       <?php  
if ($_SESSION['detalle'] == 3){

 $cod_ord = $_POST['cod_ord'];
$_SESSION['cod_ord'] =  $cod_ord;
/*
 if (ctype_digit($cod_ord)) {
       // echo "Son numeros";
    } else {
         $_SESSION['msg_error']= "Nro de Orden Solo debe tener n�meros";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: veri_codigo.php');
    } 
*/
 $nro_fac = $_POST['nro_fac'];
$_SESSION['nro_fac'] =  $nro_fac;
/*
 if (ctype_digit($nro_fac)) {
       // echo "Son numeros";
    } else {
         $_SESSION['msg_error']= "Nro de Factura Solo debe tener n�meros";
     $_SESSION['detalle'] = 1 ;
	     $_SESSION['continuar'] = 1 ;
		  $_SESSION['modificar'] = 0;
		   $_SESSION['eliminar'] = 0;
		 //    require 'solic_consulta.php';
	     header('Location: veri_codigo.php');
    } 
	*/
 $fec_des = $_POST['fec_des'];
 $fec_des1 = cambiaf_a_mysql($fec_des); 
 $nro_nit = $_POST['nro_nit'];
 //$fec_has1 = cambiaf_a_mysql($fec_has); 
 
 
 $llave =$_POST['llave'];
 $monto = $_POST['monto'];
 ?>
 
 <?php
 //echo "Ordenn".encadenar(2).$cod_ord;
 ?>

<?php
 
 //echo "Nro. Factura".encadenar(2).$nro_fac;
 ?>

<?php
// echo "Nro Nit".encadenar(2).$nro_nit;
 ?>

<?php
 //echo "Fecha".encadenar(2).$fec_des1;
 ?>

<?php
// echo "Monto".encadenar(2).$monto;
 ?>

<?php
 //echo "Llave".encadenar(2).$llave;
 ?>

<?php
 $cc7m = genCodContrl($cod_ord, $nro_fac, $nro_nit, $fec_des1, $monto, $llave);
 //echo "Codigo".encadenar(2).$cc7m;
 ?>	<center><div id="error_login"> 


          <img src="img/checkmark_32x32.png" align="absmiddle">
        <!--?php echo $_SESSION['msg_error']; ?--> El C&oacute;digo ingresado es <b><?php echo $cc7m; ?></b>  
        </div> </center>

        <?php
 ?>

 <?php
//	$descrip = $_SESSION['descrip'];
//	$niv_cta = $_SESSION['niv_cta'];
//	$cin = $_SESSION['mone'];
//	$cta_ctbr = $_SESSION['cta_ctbr'];
   
 /*     $consulta = "insert into factura_cntrl (FAC_CTRL_AGEN, 
                                              FAC_CTRL_ORDEN,
									          FAC_CTRL_ALFA,
									          FAC_CTRL_DESDE,
					                          FAC_CTRL_HASTA,
											  FAC_CTRL_FECHA,
											  FAC_CTRL_FEC_D,
											  FAC_CTRL_FEC_H,
											  FAC_CTRL_LLAVE,
											  FAC_CTRL_USR,
											  FAC_CTRL_USR_ALTA,
											  FAC_CTRL_FCH_HR_ALTA,
											  FAC_CTRL_USR_BAJA,
											  FAC_CTRL_FCH_HR_BAJA											   
					                      ) values (30,
									                $cod_ord,
												    '',
												   $nro_fac,
												   0,
												 '$fec1',
												 '$fec_des1',
												 'null',
												 '$llave',
												  '$logi',
												 '$logi',
												 null,
												 null,
												 null
												  )";
$resultado = mysql_query($consulta);	

*/
//
//$verifica = "SELECT * FROM factura_cntrl WHERE FAC_CTRL_DESDE=$nro_fac"
//$resultado = mysql_query($verifica);
//header('Location:  ejecuta.js');


//header('Location:  con_retro.php?accion=25');
//header('Location: con_mant_fac.php');
 
	 
  //echo $_SESSION['monto_i'].encadenar.$_SESSION['monto_p'].encadenar(2).$_SESSION['cta_f13'];
  
 }
 
 ?>



  <form name="form2" id= "form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposVerificaCodigo(this)">
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$_SESSION['detalle']  = 1;
if (isset($_SESSION['detalle'])){
if ($_SESSION['detalle'] == 1){
  if (isset($_SESSION['msg_error'])){ ?>
    <!--font color="#FF0000"-->
	<?php
     //echo $_SESSION['msg_error'];
	 ?>
	</font>
	<?php
	 }
	} 
//$con_ctas  = "Select * From contab_cuenta ";
 //   $res_ctas = mysql_query($con_ctas)or die('No pudo seleccionarse contab_cuenta')  ;

//$datos = $_SESSION['form_buffer'];
 ?>
  <table align="center">
	<br>
        <tr>
        <th align="left">Nro Orden:</th>
	    <td><input class="txt_campo" type="text" name="cod_ord" id="cod_ord" size="15" maxlength="15" onKeyPress="return soloNum(event)" onBlur="limpia()" > 
		<div id="error_cod_ord"></div></td>
		 </tr>
		 <tr>
        <th align="left">Nro. Factura:</th>
	    <td><input class="txt_campo" type="text" name="nro_fac" id="nro_fac" size="10" maxlength="10" onKeyPress="return soloNum(event)" onBlur="limpia()" > 
		<div id="error_nro_fac"></div></td>
		 </tr> 
		 <tr>
		  <tr>
              <th align="left" >Fecha Emisi&oacute;n:</th>
        <td><input class="txt_campo" name="fec_des" id="datepicker" maxlength="10"  size="10" > </td>
		 </tr>
		 <tr>
              <th align="left" >CI/Nit Cliente:</th>
        <td><input class="txt_campo" type="text" name="nro_nit" id="nro_nit" size="10" maxlength="10" onKeyPress="return soloNum(event)" onBlur="limpia()">
        <div id="error_nro_nit"></div></td>
		 </tr>
		 <tr>   
         <th align="left" >Llave:</th>
              <td><input class="txt_campo" cols="30" rows="10" name="llave" id="llave" ></TEXTAREA> 
			  <div id="error_llave"></div></td>
         </tr>
		 <th align="left" >Monto:</th>
              <td><input class="txt_campo"  type="text" name="monto" id="monto" size="10" maxlength="10"  > 
			  <div id="error_monto"></div></td>
         </tr>
        </table>
	 <center>
	    <br>
	 <input class="btn_form" type="submit" name="accion" id="accion" value="Verifica">
     <!--input class="btn_form" type="submit" name="accion" value="Salir_Verif"-->

</form>
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