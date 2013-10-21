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
<title>Seleccion Caja Chica</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/ModulosCajaChica.js"></script>  
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
                 <li id="menu_modulo_cajachica">
                    
                     <img src="img/caja_chica_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CAJA CHICA
                    
                 </li>
                  <li id="menu_modulo_cajachica_parametros">
                    
                     <img src="img/move_24x24.png" border="0" alt="Modulo" align="absmiddle"> GASTOS CAJA CHICA
                    
                 </li>
                
              </ul>  

 <div id="contenido_modulo">
                      <h2> <img src="img/move_64x64.png" border="0" alt="Modulo" 
					  align="absmiddle">GASTOS CAJA CHICA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Elija la Chaja Chica para registrar Gastos
                     </div>
                 
				<?php
                // $fec = leer_param_gral();
        //$fec = $_SESSION['fec_proc'];
        //
        $ag_usr = 30; //$_SESSION['COD_AGENCIA'];
        $fec = leer_fecha_proc($ag_usr);
				// echo "$fec";
         $fec1 = cambiaf_a_mysql_2($fec);
				 $logi = $_SESSION['login']; //echo $fec1;
                ?> 
 <center>
<?php
 $_SESSION['continuar'] = 0;
/*$caj_hab = 1;
$caj_hab = verif_cajero_hab($fec1,$logi);
if ($caj_hab == 0){
     echo "Usuario no Habilitado como cajero ".encadenar(2)." !!!!!";
	 $_SESSION['continuar'] = 1; */
	 ?> 
   <br>
   <center>
 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

</form>
<?php //} 

if ($_SESSION['continuar'] == 0){
// Se realiza una consulta SQL a tabla gral_param_propios
$quecom = 0;
if(isset($_SESSION['form_buffer'])){ 
  $datos = $_SESSION['form_buffer'];
  }
if(isset($_POST['est_sol'])){ 
  $quecom = $_POST['est_sol'];
 }
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_es = $quecom[$i];
 }
}
/*$cod_es = 7;
$_SESSION['c_estado'] = $cod_es;
$_SESSION['continuar'] = 2;
$con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 801 and GRAL_PAR_PRO_COD = $cod_es ";
$res_est = mysql_query($con_est);
while ($linea = mysql_fetch_array($res_est)){ */
?>
<strong>Caja(s) Chica(s) Asignadas </strong>
<?php
  // echo $linea['GRAL_PAR_PRO_DESC'];
  // }
  ?> 
 <?php
$con_sol = "Select * From cjach_cntrl where CJCH_CTRL_ESTADO = 1 and CJCH_CTRL_FUNC = '$logi'
            and CJCH_CTRL_USR_BAJA is null ";
$res_sol = mysql_query($con_sol);
//echo $cod_es;
?>
 <center>
<form name="form2" method="post" action="con_retro_1_cjach.php" >
<select name="cod_sol[]" size="12" style="width:300px; height:200px;" multiple>
<?php
while ($linea = mysql_fetch_array($res_sol)){

?>
<option value=<?php echo $linea['CJCH_CTRL_NRO']; ?>>
	          <?php echo $linea['CJCH_CTRL_NRO']; ?> 
		      <?php echo utf8_encode($linea['CJCH_CTRL_NOMB']); ?> 
			  
			   
<?php 
}
$_SESSION['detalle'] = 1;
?>
</select><br><br>
  <input class="btn_form" type="submit" name="accion" value="Seleccionar">
  <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
  </form>


</div>
</div>
</div>
<?php
}
      include("footer_in.php");
     ?>
</body>
</html>
<?php
}
    ob_end_flush();
 ?>