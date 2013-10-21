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
<title>Tipo Reporte</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCartera.js"></script>
<script type="text/javascript" src="js/ModulosContabilidad.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script> 


 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Calculo no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">La fecha seleccionada no puede ser mayor a la fecha actual.</font></p>
</div>

    <?php
                include("header.php");
            ?>
	<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                  <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>


<?php if($_GET["menu"]==1){?>


                 <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_cartera_procesofindemes">
                    
                     <img src="img/directories_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DESVENGAMIENTO INTERES
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/documents_64x64.png" border="0" alt="Modulo" align="absmiddle">DESVENGAMIENTO INTERES </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha 
        </div>
	 <?php } elseif($_GET["menu"]==2){?>


                <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_cartera_procesofindemes">
                    
                     <img src="img/directories_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE FIN DE MES
                    
                 </li>
                 <li id="cart_fin_mes.php">
                    
                     <img src="img/close_24x24.png" border="0" alt="Modulo" align="absmiddle"> FACTURACION DESVENGADO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/close_64x64.png" border="0" alt="Modulo" align="absmiddle">FACTURACION DESVENGADO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha 
        </div>

<?php } elseif($_GET["menu"]==3){?>


                <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="cart_fin_mes.php">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> RESUMEN POR MONEDA
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle">RESUMEN POR MONEDA </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha 
        </div>

<?php } elseif($_GET["menu"]==4){?>


                <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="cart_fin_mes.php">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> RESUMEN POR PRODUCTO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle">RESUMEN POR PRODUCTO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha 
        </div>
<?php } elseif($_GET["menu"]==5){?>


                <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTE CARTERA
                    
                 </li>
                 <li id="cart_fin_mes.php">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> RESUMEN POR OF. NEGOCIOS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle">RESUMEN POR OFICIAL DE NEGOCIOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha 
        </div>

<?php } elseif($_GET["menu"]==6){?>


               <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_24x24.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
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
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle">COMP.BANCARIZACION
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">COMPRAS BANCARIZACION </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
            Ingrese la fecha c&aacute;lculo para generar el reporte
        </div>

<?php } elseif($_GET["menu"]==7){?>
          
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
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> VENTAS BANCARIZACION
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">VENTAS BANCARIZACION </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese las fechas para generar el reporte
        </div>

<?php } elseif($_GET["menu"]==8){?>


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
                    
                 </li>                 <li id="menu_modulo_contabilidadreportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> VENTAS 
                    
                 </li>
               
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle"> REPORTE VENTAS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha c&aacute;lculo para generar el reporte
        </div> 
<?php } elseif($_GET["menu"]==9){?>
             
                  <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_24x24.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
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
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> LIBRO COMPRAS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">LIBRO COMPRAS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
            Ingrese la fecha c&aacute;lculo para generar el reporte
        </div>

<?php } elseif($_GET["menu"]==10){?>


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
                    
                 </li>                 <li id="menu_modulo_contabilidadreportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> COMPRAS TEXTO
                    
                 </li>
               
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">COMPRAS TEXTO</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha 
        </div> 
<?php } ?> 
           <br>
               
				<?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);
                ?> 
			
           

	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
<?php if ($_SESSION["tip_rep"] == 1) {  ?>
    <form name="form2" method="post" action="cart_rep_1.php" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>
<?php if ($_SESSION["tip_rep"] == 2) {  ?>
    <form name="form2" method="post" action="cart_rep_2.php" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>
<?php if ($_SESSION["tip_rep"] == 3) {  ?>
    <form name="form2" method="post" action="cart_rep_3.php" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>
<?php if ($_SESSION["tip_rep"] == 4) {  ?>
    <form name="form2" method="post" action="cart_deven.php" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>
<?php if ($_SESSION["tip_rep"] == 5) {  ?>
    <form name="form2" method="post" action="fac_deven.php" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>

<?php if ($_SESSION["tip_rep"] == 9) {  ?>
    <form name="form2" method="post" action="cart_rep_8.php" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>	
<?php if ($_SESSION["tip_rep"] == 23) {  ?>
    <form name="form2" method="post" action="fac_ventas.php?menu=1" onSubmit="return ValidarCampoFecha(this)"> <!--ValidarCamposLibroVentas-->
<?php	}  ?>	
<?php if ($_SESSION["tip_rep"] == 24) {  ?>
    <form name="form2" method="post" action="fac_ventas.php?menu=1" onSubmit="return ValidarCampoFecha(this)"> <!--ValidarCamposLibroVentas-->
<?php	}  ?>	
<?php if ($_SESSION["tip_rep"] == 31) {  ?>
    <form name="form2" method="post" action="fac_ventas_ban.php?menu=1" onSubmit="return ValidarCampoFecha(this)"> <!--ValidarCamposLibroVentas-->
<?php	}  ?>	
<?php if ($_SESSION["tip_rep"] == 33) {  ?>
    <form name="form2" method="post" action="fac_ven_ban_txt.php" onSubmit="return ValidarCampoFecha(this)">
<?php	}  ?>	
<?php if ($_SESSION["tip_rep"] == 25) {  ?>
    <form name="form2" method="post" action="fac_ven_txt.php" onSubmit="return ValidarCampoFecha(this)">
<?php	}  ?>	
<?php if (($_SESSION["tip_rep"] == 26)or ($_SESSION["tip_rep"] == 28)){  ?>
    <form name="form2" method="post" action="fac_compras.php?menu=1" onSubmit="return ValidarCampoFecha(this)">
<?php	}  ?>
<?php if ($_SESSION["tip_rep"] == 27) {  ?>
    <form name="form2" method="post" action="fac_com_txt.php" onSubmit="return ValidarCampoFecha(this)"><!-- fac_com_txt.php  PENDIENTE COMPRAS-->
<?php	}  ?>
<?php if ($_SESSION["tip_rep"] == 41){  ?>
    <form name="form2" method="post" action="fac_compras_ban.php?menu=1?menu=1" onSubmit="return ValidarCampoFecha(this)">
<?php	}  ?>	
<?php if ($_SESSION["tip_rep"] == 43){  ?>
    <form name="form2" method="post" action="fac_compras_ban_txt.php?menu=1?menu=1" onSubmit="return ValidarCampoFecha(this)">
<?php	}  ?>	
<center>
        <strong>Fecha C&aacute;lculo:</strong>
         <input class="txt_campo" type="text" name="fec_nac" id="datepicker" maxlength="10"  size="10" > 
         
			 <BR><br>
        <!--input class="btn_form" type="submit" name="accion" value="Procesar" onClick="confirmar()" -->
		<!--input name="accion" type="submit" value="Procesar" onClick="if(confirm('Deseas Procesar el archivo .txt?')){ this.form.submit();} else{ alert('Operacion Cancelada'); }"  /-->
		 <input class="btn_form" type="submit" name="accion" value="Consultar"  />
   </center>
   
    </form>

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