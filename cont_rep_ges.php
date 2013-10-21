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
<title>Seleccionar Gesti&oacute;n Anterior</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/contabilidad_repo_gest.js"></script>  
<meta charset="UTF-8">
</head>
<body>	
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
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
                 </li>
              </ul>  
            
    
        <div id="contenido_modulo">

                      <h2> <img src="img/open document_64x64.png" border="0" alt="Modulo" align="absmiddle"> REPORTES GESTIONES PASADAS</h2>
                      <hr style="border:1px dashed #767676;">    
            
             
          
  	
  
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese Gesti&oacute;n Anterior
        </div>

        <center>
    <!--form name="form2" method="post" action="cont_reportes.php" onSubmit="return ValidarCamposUsuario(this)"-->

    <form name="form2" method="post" action="cont_reportes.php?menu=1" onSubmit="return ValidarCamposUsuario(this)">

      
			 <br>
			<strong>Gesti&oacute;n:</strong>
			<?php echo encadenar(2);?>
		    <select name="gestion">
    <option value="2012">2012</option>

    
  </select><br><br>

	  <input class="btn_form" type="submit" name="accion" value="Procesar">
    </form></center>
</div>


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