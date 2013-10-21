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
<!--Titulo de la pestana de la pagina-->
<title><?php echo $_SESSION['COD_EMPRESA']; ?></title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script>  

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>

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
                  <li id="menu_modulo_contabilidad_ufv">
                    
                     <img src="img/mante_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. DE UFV'S
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONSULTA UFV'S
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<!--h2> <img src="img/shield1_64x64.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO 1</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Atenci&oacute;n se actualizaran las cuentas a UFV's
        </div-->


<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 
  //verif_cierre($fec);
?> 

<?php
//verif_cierre($fec);
// Se realiza una consulta SQL a tabla gral_param_propios

if (isset($_SESSION['msg_error'])){
    if ($_SESSION['msg_error'] <> ""){
	    //echo $_SESSION['msg_error'];
    }
}	
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta) ;


 ?>
 <?php if ($_SESSION['detalle'] == 1) { ?>

<h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONSULTA UFV'S </h2>
<hr style="border:1px dashed #767676;">
<div id="error_login"> 

          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese las Fechas para la consulta Ufv's </div>

<form name="form2" method="POST" action="res_cons_ufv.php" onSubmit="return ValidarRangoFechas(this)">
<center>
	<table  border="0"  align="center" >
		<tr>
	<th align="left">Fecha Desde:</th>
    <th align="left"><input class="txt_campo" type="text" id="datepicker" name="fec_des" maxlength="10"  size="10" ></th>
  		</tr> 
      
  		<tr>        
			
		<th align="left">Fecha Hasta:</th>
        <th align="left"> <input class="txt_campo" type="text" id="datepicker2" name="fec_has" maxlength="10"  size="10" > </th>
 </tr> 
 </table> 
     <!--input class="btn_form" type="submit" name="accion" value="Revalorizar">
    <input class="btn_form" type="submit" name="accion" value="Salir"-->

	<br>
  <input class="btn_form" type="submit" name="accion" value="Consultar">

	</center>
  <?php	}  ?>
  	</form>

	    <br>
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