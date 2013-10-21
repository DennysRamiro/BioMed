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
<script type="text/javascript" src="js/contabilidad_reportes.js"></script> 
<!--script type="text/javascript" src="js/ModulosCreditosInfoCred.js"></script--> 

        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
        <script type="text/javascript" src="js/Utilitarios.js"></script> 
</head>
<body>	
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha C&aacute;lculo no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha C&aacute;lculo no puede ser mayor a la Fecha Actual.</font></p>
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

                  <?php if($_SESSION['menu'] == 34){$parm=34?> 
                 <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>

                  <li id="menu_modulo_fecha">
                    
            
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> BALANCE GENERAL
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">BALANCE GENERAL</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha de la gesti&oacute;n para ver el Balance General.
        </div>

            <?php } elseif($_SESSION['menu'] == 42){$parm=42?>
               <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
             </li>
             <li id="menu_modulo_cont_reportesotro">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
             </li>

                  <li id="menu_modulo_fecha">
                    
            
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> BALANCE GENERAL
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">BALANCE GENERAL</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha de la gesti&oacute;n para ver el Balance General.
        </div>

        <?php } elseif($_SESSION['menu'] == 35){$parm=35?>
         <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>

                  <li id="menu_modulo_fecha">
                    
            
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> EERR (BAL. GENERAL)
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">ESTADO DE RESULTADOS (BALANCE GENERAL)</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha de la gesti&oacute;n para ver el Estado de Resultados (Balance General).
        </div>

         <?php } elseif($_SESSION['menu'] == 43){$parm=45?>
          <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
             </li>
             <li id="menu_modulo_cont_reportesotro">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
             </li>

                  <li id="menu_modulo_fecha">
                    
            
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> EERR (BAL. GENERAL)
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">ESTADO DE RESULTADOS (BALANCE GENERAL)</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha de la gesti&oacute;n para ver el Estado de Resultados (Balance General).
        </div>
        <?php }?>


               
				<?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);
                ?> 
	
            
            
         <br>  

	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
	<center>
	
<?php if ($_SESSION["tipo"] == 1) {  ?>
    <form name="form2" method="post" action="cred_infocred.php?menu=<?php echo $parm; ?>" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>
<?php if ($_SESSION["tipo"] == 2) {  ?>
    <form name="form2" method="post" action="cred_infocred_c.php?menu=<?php echo $parm; ?>" onSubmit="return ValidarCamposUsuario(this)">
<?php	}  ?>
<?php if ($_SESSION["tipo"] == 3) {  ?>
    <form name="form2" method="post" action="cont_balance.php?menu=<?php echo $parm; ?>" onSubmit="return ValidaCamposEstadoBs(this)">
<?php	}  ?>
<?php if ($_SESSION["tipo"] == 4){ ?>
   <form name="form2" method="post" action="cont_resul_b.php?menu=<?php echo $parm; ?>" onSubmit="return ValidaCamposEstadoBs(this)">
   	<?php } ?>
        <strong>Fecha C&aacute;lculo:</strong>
         <input class="txt_campo" id="datepicker" type="text" name="fec_nac" maxlength="10"  size="10" > 
         
			 <BR><BR>
	  <input class="btn_form" type="submit" name="accion" value="Consultar">
    </form>
</center>
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