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
<title>Reserva de Documentos Contables</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
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
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha Documentos no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Cantidad Documento no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Cantidad Documento no puede ser mayor a 10.</font></p>
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
                    
                     <img src="img/games_24x24.png" border="0" alt="Modulo" align="absmiddle"> RESERVA DE ASIENTOS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/games_64x64.png" border="0" alt="Modulo" align="absmiddle"> RESERVA DE ASIENTOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha de consulta / Impresion
        </div>
	<?php } elseif($_GET["menu"]==1){?>

        <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/games_24x24.png" border="0" alt="Modulo" align="absmiddle"> RESERVA ASIENTOS
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
<h2> <img src="img/games_64x64.png" border="0" alt="Modulo" align="absmiddle">RESERVA DE ASIENTOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Ingrese la fecha y la cantidad para realizar una reserva
        </div>
 <?php }?>
           <?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);
                ?> 
<center>
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="reser_asiento.php" onSubmit="return ValidaCamposConsultaAsientoReservas(this)">
      <table width="40%"  border="0" cellspacing="1" cellpadding="1" align="center">
       <br> <tr>
        <td><strong>Fecha de Documentos: </strong></td>
        <td><input class="txt_campo" type="text" id="datepicker" name="fec_nac" maxlength="10"  size="10" id="fec_nac" ></td>
        </tr>  
			
        <tr>
			 <td><strong>Cantidad de Documentos: </strong></td>
			 <td><input class="txt_campo" type="text" name="nro_doc" maxlength="2" size="5" id="nro_doc"  onKeyPress="return soloNum(event)" onBlur="limpia()" ></td>
      </tr>	
      </table>	 
<br>
	  <input class="btn_form" type="submit" name="accion" value="Reservar">
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