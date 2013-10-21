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
<title>Reversion Vale</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/cajas_rev_vales_det.js"></script>
<script type="text/javascript" src="js/cajas_reim_vales_det.js"></script> 
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
                 <?php
                      if($_SESSION['menu']==5){?> 
                 <li id="menu_modulo_cajas_rev">
                    
                     <img src="img/import_24x24.png" border="0" alt="Modulo" align="absmiddle"> REV. TRANSACCIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_rev_det">
                    
                     <img src="img/label_24x24.png" border="0" alt="Modulo" align="absmiddle"> VALES
                    
                 </li>
                 <li id="menu_modulo_cajas_rev_det_rev">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DETALLE VALES
                    
                 </li>
             <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> TRANS. REV. VALES
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
                 <!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">TRANSACCION REVERTIDA DE VALES</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                    La transaccion fue revertida exitosamente
                     </div> 
                <?php }elseif ($_SESSION['menu']==6) { ?> 
                 <li id="menu_modulo_cajas_reim">
                    
                     <img src="img/print_24x24.png" border="0" alt="Modulo" align="absmiddle"> REIMPRESIONES
                    
                 </li>
                  <li id="menu_modulo_cajas_reim_det">
                    
                     <img src="img/label_24x24.png" border="0" alt="Modulo" align="absmiddle"> VALES
                    
                 </li>
                 <li id="menu_modulo_cajas_reim_det_rev">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> DETALLE VALES
                    
                 </li>
               <li id="menu_modulo_fecha">
                    
                     <img src="img/flag green_24x24.png" border="0" alt="Modulo" align="absmiddle"> TRANS. REV. VALES
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
                 <!--Cabecera del modulo con su alerta-->
                      <h2> <img src="img/flag green_64x64.png" border="0" alt="Modulo" align="absmiddle">TRANSACCION REVERTIDA DE VALES</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                    La transaccion fue revertida exitosamente
                     </div> 
                      <?php } ?> 
	
            <div id="UserData">
                 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				<?php
                // $fec = leer_param_gral();
				 $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; 
                ?> 
			</div>
 <center>

<?php
 $_SESSION['continuar'] = 0;
/* */
/*
 */
//$cod_es = 7;
/* */
  ?> 
 <?php
/*
	*/
	   
?>
 <center>
 <div id="TableModulo2" >
<form name="form2" method="post" action="grab_retro_cja.php" >
<strong><font size="-1">
<?php
 //  echo "Trans.".encadenar(1)."Operacion".encadenar(22)."Cliente / Grupo";
 ?>
 </strong></font>
<?php

if (isset($_SESSION['f_tra'])){
   $f_tran = $_SESSION['f_tra'];
}
if (isset($_SESSION['nro_tran'])){
   $nro_tran = $_SESSION['nro_tran'];
}
$hoy = date("Y-m-d H:i:s");?>
<br><strong>
<?Php
echo "Trans.".encadenar(1).$nro_tran.encadenar(1)."Revertida";
?></strong> <?php
$act_tabla  = "update caja_vale set CAJA_VAL_USR_BAJA = '$logi',
                                        CAJA_VAL_FCH_HR_BAJA = '$hoy'
               where (CAJA_VAL_FECHA between '$f_tran' and '$f_tran') and
				      CAJA_VAL_NRO = $nro_tran  and
	             CAJA_VAL_USR_BAJA is null ";
$res_tabla = mysql_query($act_tabla) or die
             ('No pudo actualizar caja_vale: ' . mysql_error());

		 
//reversion cart_maestro
//reversion cart_plandp
	
?>

</select><br><br>
<center>
   
   <!--input type="submit" name="accion" value="Salir"-->
  </form>


</div>
<?php
//}
      include("footer_in.php");
     ?>
</body>
</html>
<?php
}
    ob_end_flush();
 ?>