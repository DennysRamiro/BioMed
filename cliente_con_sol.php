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
<title>Consulta Clientes para Solicitud</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 

<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/mant_cuenta_ape_cta_incor.js"></script>  
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
                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA 
                    
                 </li>
                  <li id="menu_modulo_mant_cuenta">
                    
                     <img src="img/app folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD MANT. CUENTA
                    
                 </li>
                  <li id="menu_modulo_mant_cuenta_incor">
                    
                     <img src="img/open_32x32.png" border="0" alt="Modulo" align="absmiddle"> APERTURA DE CUENTA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/add_32x32.png" border="0" alt="Modulo" align="absmiddle"> INCORPORAR APE. CTA.
                    
                 </li>
              </ul> 
    <!--Cabecera del modulo con su alerta-->
     
     <div id="contenido_modulo">
                      <h2> <img src="img/add_64x64.png" border="0" alt="Modulo" align="absmiddle">INCOPORAR APERTURA DE CUENTA</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/alert_32x32.png" align="absmiddle">
                     
                     </div>            
	
            <div id="UserData">
                 <!--img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				<?php
					 //$fec = leer_param_gral();
					 $logi = $_SESSION['login']; 
				?>
             </div>
<?php
//echo "entra a grabar";
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
//$cod_cli =$_POST["cod"];
//$cod_grp = $_SESSION["cod_g"];
//echo $cod_grp;
if(isset($_POST['cod_grupo'])){
   $quecom = $_POST['cod_grupo'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_g = $quecom[$i];
    }
   }
 }
 if(isset($_SESSION["cod_g"])){
    $cod_g = $_SESSION["cod_g"];
	}
//$nom_g = $_SESSION["nombre_g"];
$consul = 0;
//$log_usr = strtolower($log_usr);
//if (empty($cod_cli)) {
//    $consul = $consul + 1;
//	} else {
//	 $consulta  = "Select * From cliente_general where CLIENTE_COD = $cod_cli and CLIENTE_USR_BAJA is null";
//}
$c_i = $_POST["ci"];
if (empty($c_i)) {
   $consul = $consul + 1;
  } else {
  $c_i =  "%".$c_i."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_COD_ID like '$c_i' and CLIENTE_USR_BAJA is null";
}
$nom = $_POST["nombres"]; 
if (empty($nom)) {
     $consul = $consul + 1;
	} else {
	 $nom =  "%".strtoupper($nom)."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_NOMBRES like '$nom' and CLIENTE_USR_BAJA is null"; 
}
$a_pat = $_POST["ap_pater"];
if (empty($a_pat)) {
    $consul = $consul + 1;
    } else {
	$a_pat = "%".strtoupper($a_pat)."%";
	//echo $a_pat;
	$consulta  = "Select * From cliente_general where CLIENTE_AP_PATERNO like '$a_pat' and CLIENTE_USR_BAJA is null"; 
} 
$a_mat = $_POST["ap_mater"]; 
if (empty($a_mat)) {
    $consul = $consul + 1; 
    } else {
	$a_mat = "%".strtoupper ($a_mat)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_MATERNO like '$a_mat' and CLIENTE_USR_BAJA is null";
} 
$a_esp = $_POST["ap_espos"]; 
if (empty($a_esp)) {
    $consul = $consul + 1; 
    } else {
	$a_esp = "%".strtoupper ($a_esp)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_ESPOSO like '$a_esp' and CLIENTE_USR_BAJA is null";
} 
if ($consul == 5) {
   //echo "Consultara todos";
   $consulta  = "Select * From cliente_general where CLIENTE_USR_BAJA is null order by 8";
 }
?> 
 <?php 
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
 ?>
 <!--div id="GeneralManUsuarioM"-->
<form name="form2" method="post" action="incorp_cli_sol.php" >
<center>
<select name="cod_cliente[]" size="12" multiple>
  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CLIENTE_COD']; ?>>
	    <?php echo $linea['CLIENTE_COD_ID']; ?>
		<?php echo $linea['CLIENTE_AP_PATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_MATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_ESPOSO']; ?>
		<?php echo $linea['CLIENTE_NOMBRES']; ?></option>
<?php
   }
 ?>
  </select><br><br>
  <?php if(isset($_SESSION["tip_cta"])){
           if ($_SESSION["tip_cta"] == 3 ) {?>
           <input type="submit" name="accion" value="Titular">
		    <?php }?>
		<?php }else{?>	
  <input type="submit" name="accion" value="Agregar">
      <?php }?> 
	  <input type="submit" name="accion" value="Agregar">
  <!--input type="submit" name="accion" value="Salir"-->
  <center>
   <?php //}?> 
   
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