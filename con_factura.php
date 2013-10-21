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
<!--Titulo de la pestaña de la pagina-->
<title>Mayor de Cuentas</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>
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
	<?php
				include("header.php");
			?>
<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>

<?php if($_GET["menu"]==0){?>

                 <li id="menu_modulo_general">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. BANCA SOLIDARIO
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> LIB. VENTAS RANGOS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle">LIBRO VENTAS POR RANGOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           
        </div-->
	<?php } elseif($_GET["menu"]==1){?>


                <li id="menu_modulo_contabilidad">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                 <li id="menu_modulo_contabilidad_facturacion">
                    
                     <img src="img/FAX_24x24.png" border="0" alt="Modulo" align="absmiddle"> FACTURACION
                    
                 </li>
                 <li id="menu_modulo_contabilidad_facturacion_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES
                    
                 </li>
				 <li id="menu_modulo_contabilidad_facturacion_reportes_venta">
                    
                     <img src="img/venta_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES VENTAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> LIBRO VTA RANGOS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle">LIBRO VENTAS POR RANGOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese las fechas para generar el reporte
        </div>
<?php } elseif($_GET["menu"]==11){?>
          
                  <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_24x24.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                 <li id="menu_modulo_contabilidad_facturacion">
                    
                     <img src="img/FAX_24x24.png" border="0" alt="Modulo" align="absmiddle"> FACTURACION
                    
                 </li>
                 <li id="menu_modulo_contabilidad_facturacion_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES
                    
                 </li>
				 <li id="menu_modulo_contabilidad_facturacion_reportes_venta_ban">
                    
                     <img src="img/venta_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. VENTAS BANC.
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> VENTAS BANCARIZACION
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle">VENTAS BANCARIZACION </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese las fechas para generar el reporte
        </div>
		

<?php } elseif($_GET["menu"]==2){?>


                <li id="menu_modulo_contabilidad">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                 <li id="menu_modulo_contabilidad_facturacion">
                    
                     <img src="img/FAX_24x24.png" border="0" alt="Modulo" align="absmiddle"> FACTURACION
                    
                 </li>
                 <li id="menu_modulo_contabilidad_facturacion_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES
                    
                 </li>
				 <li id="menu_modulo_contabilidad_facturacion_reportes_compra">
                    
                     <img src="img/compra_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES COMPRAS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> LIBRO COMP. RANGOS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle">LIBRO COMPRAS POR RANGOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese las fechas para generar el reporte
        </div>
<?php } elseif($_GET["menu"]==12){?>


                <li id="menu_modulo_contabilidad">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                 <li id="menu_modulo_contabilidad_facturacion">
                    
                     <img src="img/FAX_24x24.png" border="0" alt="Modulo" align="absmiddle"> FACTURACION
                    
                 </li>
                 <li id="menu_modulo_contabilidad_facturacion_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES
                    
                 </li>
				 <li id="menu_modulo_contabilidad_facturacion_reportes_compra_ban">
                    
                     <img src="img/compra_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP.COMP.BANCA.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> COMP.BANCARIZACION
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle">COMPRAS POR RANGOS BANCARIZACION </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese las fechas para generar el reporte
        </div>
<?php } ?>
           
				<?php
					 //$fec = leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
            


 <!--form name="form2" method="post" action="fac_ventas.php" onSubmit="return ValidarRangoFechas(this)"-->
	
<?php if ($_SESSION["tip_rep"] == 24) {  ?>
    <form name="form2" method="post" action="fac_ventas.php?menu=2" onSubmit="return ValidarRangoFechas(this)">
<?php	}  ?>	
<?php if ($_SESSION["tip_rep"] == 32) {  ?>
    <form name="form2" method="post" action="fac_ventas_ban.php?menu=1" onSubmit="return ValidarRangoFechas(this)">
<?php	}  ?>	
<?php if ($_SESSION["tip_rep"] == 28) {  ?>
    <form name="form2" method="post" action="fac_compras.php?menu=2" onSubmit="return ValidarRangoFechas(this)">
<?php	}  ?>		
<?php if ($_SESSION["tip_rep"] == 42) {  ?>
    <form name="form2" method="post" action="fac_compras_ban.php?menu=2" onSubmit="return ValidarRangoFechas(this)">
<?php	}  ?>			
<?php ?>
	<center>
		<br>
	 <strong>Fecha Desde:</strong>
     <input class="txt_campo" type="text" name="fec_des" id="datepicker" maxlength="10"  size="10" > 
     
			 <BR><br>
		 <strong>Fecha Hasta:</strong>
     <input class="txt_campo" type="text" name="fec_has" id="datepicker2" maxlength="10"  size="10" > 
     	<BR>
	    <br>
	 <input class="btn_form" type="submit" name="accion" value="Consultar">
	 </center>
  </form>	
<?php  //}
   
/*    


	 
/*   
    
*/
/*
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