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
<title>Elegir Grupo</title>
</head>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/fondo_dr_nombre.js"></script> 
<script type="text/javascript" src="js/cajas_cobros_cart_dir_group_sel.js"></script>  
  
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
                 <?php
				if($_GET["menu"]==0){?> 
                  <li id="menu_modulo_banca">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. BANCA/SOLIDARIO
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/user office_24x24.png" border="0" alt="Modulo" align="absmiddle"> DIR. GRUPOS/BANCA
                    
                 </li>
              </ul>  
     <div id="contenido_modulo">

                      <h2> <img src="img/user office_64x64.png" border="0" alt="Modulo" align="absmiddle"> DIRECTIVAS GRUPOS/BANCA</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Elija el Grupo para modificar 
        </div>

        <?php } elseif($_GET["menu"]==2){?> 

         
         <li id="menu_modulo_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret">
                    
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS RETIROS
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret_nomgroup">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO
                    
                 </li>
                    <li id="menu_modulo_fondo_grupo">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SELECCIONAR GRUPO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/checkmark_64x64.png" border="0" alt="Modulo" align="absmiddle">SELECCIONAR GRUPO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Elija el Grupo para modificar
        </div>
        <?php } elseif($_GET["menu"]==13){?> 
        <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cajas_cob">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_cajas_cob_group">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
                  <li id="menu_modulo_cajas_cob_group_sel">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO
                    
                 </li>
                 <li id="menu_modulo_fondogrupo">
                    
                     <img src="img/checkmark_32x32.png" border="0" alt="Modulo" align="absmiddle"> SELECCIONAR GRUPO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/checkmark_64x64.png" border="0" alt="Modulo" align="absmiddle">SELECCIONAR GRUPO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Elija el Grupo para modificar
        </div>

<?php } ?>
            
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 
<center>
            
<center>
<?php
//echo "entra a grabar";
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
//echo $_POST["cod"];
$cod_gru =$_POST["cod"];
//$log_usr = strtolower($log_usr);
if (empty($cod_gru)) {
    $consul = $consul + 1;
	} else {
	 $consulta  = "Select * From cred_grupo where CRED_GRP_CODIGO = '$cod_gru' and CRED_GRP_USR_BAJA is null";
}
$nom_g = $_POST["nomb_g"]; 
if (empty($nom_g)) {
     $consul = $consul + 1;
	} else {
	 $nom_g = strtoupper($nom_g);
	 $nom_g=  "%".$nom_g."%";
	 $consulta  = "Select * From cred_grupo where CRED_GRP_NOMBRE like '$nom_g' and CRED_GRP_USR_BAJA is null"; 
}
if ($consul == 2) {
   //echo "Consultara todos";
   $consulta  = "Select * From cred_grupo where CRED_GRP_USR_BAJA is null order by 3";
 }
?>  
 <?php  
   $resultado = mysql_query($consulta);
 ?>
<form name="form2" method="post" action="grab_retro_grpm.php" >
<select name="cod_grupo[]" size="12" style="width:500px; height:300px; " multiple>
  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CRED_GRP_CODIGO']; ?>>
	    <?php echo $linea['CRED_GRP_CODIGO']; ?>
		<?php echo $linea['CRED_GRP_NOMBRE']; ?>
	 <?php
   }
 ?>
  </select><br><br>
  <!--?php
        if($_GET["menu"]==0){?-->
  <input class="btn_form" type="submit" name="accion" value="Elegir">
  <!--?php } elseif($_GET["menu"]==1){?-->
  <!--input class="btn_form" type="submit" name="accion" value="Elegir_fondo"-->
  <!--?php } elseif($_GET["menu"]==13){?-->
  <!--input class="btn_form" type="submit" name="accion" value="Elegir_cjas"-->
  <!--?php } ?-->

  <!--input class="btn_form" type="submit" name="accion" value="Salir"-->

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