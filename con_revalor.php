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
<title><?php echo $_SESSION['COD_EMPRESA']; ?></title>
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


</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo TC Contable no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo TC Compra no puede estar vacio.</font></p>
</div>

<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo TC Venta no puede estar vacio.</font></p>
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
                    
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIN. REVALORIZACION
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">ASIENTO DE REVALORIZACION</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Atenci&oacute;n se actualizaran los Tipos de Cambio
        </div>

<?php } elseif($_GET["menu"]==1){?>

        <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_asientocontable">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> REG. ASIENTO CONT.
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIENTO  REVAL.
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
<h2> <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">ASIENTO DE REVALORIZACION </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Elija los tipos de cambos a modificar
        </div>
 <?php }?>
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
$resultado = mysql_query($consulta)  ;
//verif_cierre($fec);
$f_prox = cambiaf_a_normal_2($_SESSION['f_prox']);
$mes = saca_mes($f_prox);
$dia = saca_dia($f_prox);
$anio = saca_anio($f_prox);
$dia_prox = dia_semana($dia, $mes, $anio);
$siguientedia  = mktime(0,0,0,date("$mes"),date("$dia")+ 1,date("$anio"));
$dia_prox2 = dia_semana($dia + 1, $mes, $anio);
//echo $dia_prox2. "dia_prox2";
if ($dia_prox2 == "S�bado") {
    $siguientedia  = mktime(0,0,0,date("$mes"),date("$dia")+ 3,date("$anio"));
	$dia_prox2 = dia_semana($dia + 3, $mes, $anio);
  echo "Proxima Fecha: ".date("d-m-Y", $siguientedia).$dia_prox2."<br>";
}


 ?>
<form name="form2" method="post" action="con_rev_tc.php" onSubmit="return ValidaCamposAsientoRevalorizacion(this)">
<table width="50%"  border="0" cellspacing="1" cellpadding="1" align="center">
<tr>
 <th align="left">Tipo de Cambio Contable:</th>
 <td align="center"><?php echo number_format($_SESSION['TC_CONTAB'], 2, '.',','); ?><td>
 <td align="left"><input class="txt_campo" type="text" name="tc_contab" maxlength="12" 
                    size="12" value="" onKeyPress="return soloNum(event)" onBlur="limpia()" > 
 
</tr> 
<tr> 
  <th align="left">Tipo de Cambio Compra:</th>
  <td align="center"><?php echo number_format($_SESSION['TC_COMPRA'], 2, '.',','); ?><td>
  <td align="left"><input class="txt_campo" type="text" name="tc_compra" maxlength="12" 
                    size="12" value="" onKeyPress="return soloNum(event)" onBlur="limpia()" >  
</tr> 
<tr>
  <th align="left" >Tipo de Cambio Venta: </th>
  <td align="center" ><?php echo number_format($_SESSION['TC_VENTA'], 2, '.',','); ?><td>
   <td align="left"><input class="txt_campo" type="text" name="tc_venta" maxlength="12" 
                    size="12" value="" onKeyPress="return soloNum(event)" onBlur="limpia()" >   
</tr> 
			
 <br>

 </table> 
 <center>
  <br>
     <input class="btn_form" type="submit" name="accion" value="Revalorizar">
    <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
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