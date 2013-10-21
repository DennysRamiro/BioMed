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
      <title>Cambio de fecha del sistema</title>
      <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
      <link href="css/estilo.css" rel="stylesheet" type="text/css">
      <link href="css/calendar.css" rel="stylesheet" type="text/css">
      <script language="JavaScript" src="script/calendar_us.js"></script>
      <script language="javascript" src="script/validarForm.js"></script>
      <script language="javascript" src="js/FechaProceso.js"></script> 
      <script type="text/javascript" src="js/CambiarFecha.js"></script> 

       <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
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
                 <li id="menu_modulo_general">
                    
                     <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/calendar_32x32.png" border="0" alt="Modulo" align="absmiddle"> FECHA PROCESO
                    
                 </li>
              </ul>

    <div id="contenido_modulo">
      <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Atenci&oacute;n la fecha que ingrese afectara a todos los modulos
        </div>
<?php
//verif_cierre($fec);
// Se realiza una consulta SQL a tabla gral_param_propios

if (isset($_SESSION['msg_error'])){
    if ($_SESSION['msg_error'] <> ""){
	    echo $_SESSION['msg_error'];
    }
}	
$consulta  = "SELECT * 
              FROM gral_agencia 
              WHERE GRAL_AGENCIA_USR_BAJA IS NULL ";
$resultado = mysql_query($consulta);
//verif_cierre($fec);
$f_prox = cambiaf_a_normal_2($_SESSION['f_prox']);
$mes = saca_mes($f_prox);
$dia = saca_dia($f_prox);
$anio = saca_anio($f_prox);
$dia_prox = dia_semana($dia, $mes, $anio);
$siguientedia  = mktime(0,0,0,date("$mes"),date("$dia")+ 1,date("$anio"));
$dia_prox2 = dia_semana($dia + 1, $mes, $anio);
//echo $dia_prox2. "dia_prox2";
if ($dia_prox2 == "Sabado") {
    $siguientedia  = mktime(0,0,0,date("$mes"),date("$dia")+ 3,date("$anio"));
	$dia_prox2 = dia_semana($dia + 3, $mes, $anio);
  echo "Proxima Fecha: ".date("d-m-Y", $siguientedia).$dia_prox2."<br>";
}


 ?>
<form name="form2" method="post" action="grab_retro.php">
<table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
<tr>
 <td align="left">Tipo de Cambio Contable</td>
 <td align="center"><?php echo number_format($_SESSION['TC_CONTAB'], 2, '.',','); ?><td>
</tr> 
<tr> 
  <td align="left">Tipo de Cambio Compra</td>
  <td align="center"><?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?><td>
</tr> 
<tr>
  <td align="left" >Tipo de Cambio Venta </td>
  <td align="center" ><?php echo number_format($_SESSION['TC_VENTA'], 2, '.',','); ?><td> 
</tr> 
<tr>  
  <td align="left"> Nueva Fecha Proceso </td>
 
  <td align="left"><input type="text" id="datepicker" name="fecha" maxlength="10" 
                    size="10" value="<?php echo $f_prox;?>" class="txt_campo">
                    
					
			<td> 
	 <td align="left"><?php echo encadenar(2).$dia_prox; ?></td>		
  		
</tr>
<tr><td align="right"><br></td><td align="left"><br></td></tr>
 <tr>
    <td align="right"> 
        <input type="submit" name="accion" value="Salir" class="btn_form">
    </td>
    <td align="left">
        <input type="submit" name="accion" value="Grabar" class="btn_form">
    </td>
  </tr>
 </table> 
    
    
</form>
</div>

<center>
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