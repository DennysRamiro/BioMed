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
<title>Mantenimiento Clientes</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
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
              <li id="menu_modulo_clientes">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CLIENTES
                    
                 </li>
                  <li id="menu_modulo_registro_clientes">
                    
                     <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO CLIENTES
                    
                 </li>
              <li id="menu_modulo_fecha_cambio">
                 <img src="img/edit_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR
    	       </li>
           </ul>
              <div id="contenido_modulo">
   
                  <h2> 
                             </h2>
                      <hr style="border:1px dashed #767676;">


<?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
                ?> 

<?php
$consul = 0;


if(isset($_POST["cod"])){
   $cod_cli =$_POST["cod"];
   }
if(isset($log_usr)){ 
  $log_usr = strtolower($log_usr);
  }
if (empty($cod_cli)) {
    $consul = $consul + 1;
	} else {
	 $consulta  = "Select * From cliente_general where CLIENTE_COD = $cod_cli and CLIENTE_USR_BAJA is null";
}
if(isset($_POST["ci"])){ 
  $c_i = $_POST["ci"];
  }
if (empty($c_i)) {
   $consul = $consul + 1;
   } else {
   $c_i =  "%".$c_i."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_COD_ID like '$c_i' and CLIENTE_USR_BAJA is null";
}
if(isset($_POST["nombres"])){ 
   $nom = $_POST["nombres"];
 }
if (empty($nom)) {
     $consul = $consul + 1;
	} else {
	 $nom =  "%".strtoupper($nom)."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_NOMBRES like '$nom' and CLIENTE_USR_BAJA is null"; 
}
if(isset($_POST["ap_pater"])){ 
   $a_pat = $_POST["ap_pater"];
   }
if (empty($a_pat)) {
    $consul = $consul + 1;
    } else {
	$a_pat = "%".strtoupper($a_pat)."%";
	
	$consulta  = "Select * From cliente_general where CLIENTE_AP_PATERNO like '$a_pat' and CLIENTE_USR_BAJA is null"; 
} 
if(isset($_POST["ap_mater"])){ 
  $a_mat = $_POST["ap_mater"]; 
  }
if (empty($a_mat)) {
    $consul = $consul + 1; 
    } else {
	$a_mat = "%".strtoupper ($a_mat)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_MATERNO like '$a_mat' and CLIENTE_USR_BAJA is null";
} 
if(isset($_POST["ap_espos"])){ 
   $a_esp = $_POST["ap_espos"]; 
   }
if (empty($a_esp)) {
    $consul = $consul + 1; 
    } else {
	$a_esp = "%".strtoupper ($a_esp)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_ESPOSO like '$a_esp' and CLIENTE_USR_BAJA is null";
} 
if ($consul == 6) {
   //echo "Consultara todos";
   $consulta  = "Select * From cliente_general where CLIENTE_USR_BAJA is null order by 9";
}
?>  
 <?php  
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
 ?>

<form name="form2" method="post" action="grab_retro_clim.php" >
<select name="cod_cliente[]" size="12" multiple>
  <?php 
  
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CLIENTE_COD']; ?>>
		<?php echo $linea['CLIENTE_AP_PATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_MATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_ESPOSO']; ?>
		<?php echo $linea['CLIENTE_NOMBRES']; ?></option>
 <?php
   }
  
 ?>
  </select><br><br>
 <?php
   
   if (isset($_SESSION['con_mod'])){
      if ($_SESSION['con_mod'] == 2){
 ?> 
  <input class="btn_form" type="submit" name="accion" value="Modificar">
  <?php
   }
   if ($_SESSION['con_mod'] == 1){
   ?>
   
   <input class="btn_form" type="submit" name="accion" value="Detalles">
   <?php
   }
   if ($_SESSION['con_mod'] == 3){
   ?>
   
   <input class="btn_form" type="submit" name="accion" value="Inhabilita/Habilita">
   <?php
   }
   }
 ?>
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