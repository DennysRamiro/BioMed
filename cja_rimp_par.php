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
<title>Reimpresion de Comprobantes</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/cajas_imp_des.js"></script>

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>  
</head>
<body>	
    <?php
                include("header.php");
            ?>
    <div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cajas_imp">
                    
                     <img src="img/print_32x32.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <?php
                      if($_GET["menu"]==9){$parm=9?> 
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/down_32x32.png" border="0" alt="Modulo" align="absmiddle"> DESEMBOLSOS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/down_64x64.png" border="0" alt="Modulo" align="absmiddle">DESEMBOLSOS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese la fecha de consulta para reimpresion
                     </div>
                     <?php }elseif ($_GET["menu"]==10) {$parm=10 ?> 
                <li id="menu_modulo_fecha">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/calculator_64x64.png" border="0" alt="Modulo" align="absmiddle">COBROS</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese la fecha de consulta para reimpresion
                     </div> 
                      <?php }elseif ($_GET["menu"]==11) {$parm=11 ?> 
                <li id="menu_modulo_fecha">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> FOND. GARANTIA
                    
                 </li>
              </ul> 
<!--Cabecera del modulo con su alerta-->
     <div id="contenido_modulo">
                      <h2> <img src="img/clock_64x64.png" border="0" alt="Modulo" align="absmiddle">FONDO GARANTIA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     Ingrese la fecha de consulta para reimpresion
                     </div> 
                     <?php } ?>         
<?php if ($_SESSION["reimpre"] == 1){ ?>			
<?php } ?>	
<?php if ($_SESSION["reimpre"] == 2){ ?>			
<?php } ?>	
<?php if ($_SESSION["reimpre"] == 3){ ?>			
<?php } ?>		
  
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
	<?php if ($_SESSION["reimpre"] <> 3){ ?>
    <form name="form2" method="post" action="cja_des_rimp.php?menu=<?php echo $parm; ?>" onSubmit="return ValidarCamposUsuario(this)">
	<?php } ?>
	<?php if ($_SESSION["reimpre"] == 3){ ?>
	 <form name="form2" method="post" action="cja_rrev_fga.php" onSubmit="return 
	 ValidarCamposUsuario(this)">
	<?php } ?>	
        <strong>Fecha Consulta </strong>
         <input class="txt_campo" type="text" id="datepicker" name="fec_nac" maxlength="10"  size="10" > 
        
			<BR><br>
			 <strong>Nro. Documento </strong>
			<input class="txt_campo" type="text" name="nro_doc" maxlength="8" size="5" >
		 
  <BR><br>
	  <input class="btn_form" type="submit" name="accion" value="Seleccionar">
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