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
<title>Ingrese Numero de Operación</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCreditosInfoCred.js"></script> 
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
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CREDTOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/unknown_24x24.png" border="0" alt="Modulo" align="absmiddle"> REASIGNA ASESOR
                    
                 </li>
              </ul>
    
<div id="contenido_modulo">

                      <h2> <img src="img/unknown_64x64.png" border="0" alt="Modulo" align="absmiddle"> REASIGNA ASESOR</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                             <img src="img/alert_32x32.png" align="absmiddle">
                            Numero Operacion para reasignación de Asesor 
                        </div>
	
 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				<?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);
                ?> 

         <br> 
  
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
	
	

    <form name="form2" method="post" action="cred_reasig_ase.php" onSubmit="return ValidarCamposUsuario(this)">
	<strong>Numero Operacion</strong>
         <input class="txt_campo" type="text" name="nro_ope" maxlength="12"  size="12" >
            	
			 <BR><br>

	  <input class="btn_form" type="submit" name="accion" value="Buscar">
    </form>
   <BR><br> 
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