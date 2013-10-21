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
<title>Mantenimiento Solicitudes</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
          <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <script type="text/javascript" src="js/DirectivaGrupoBanca.js"></script> 
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
                  <li id="menu_modulo_banca">
                    
                     <img src="img/users group_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. BANCA/SOLIDARIO
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/user office_24x24.png" border="0" alt="Modulo" align="absmiddle"> DIR. GRUPOS/BANCA
                    
                 </li>
              </ul>  


  <?php
//echo "entra a grabar";
if(isset($_POST)){
  $_SESSION['form_buffer'] = $_POST;
  $consul = 0;
}
if(isset($_POST['cod'])){
   $cod_gru =$_POST['cod'];
   }
if(isset($cod_gru)){   
   $_SESSION['cod_g'] = $cod_gru;
  }
//$log_usr = strtolower($log_usr);
if (empty($cod_gru)) {
    $consul = $consul + 1;
  } else {
   $consulta  = "Select * From cred_grupo where CRED_GRP_CODIGO = '$cod_gru' and CRED_GRP_USR_BAJA is null";
}
if(isset($_POST['nomb_g'])){
   $nom_g = $_POST['nomb_g'];
   } 
if (empty($nom_g)) {
     $consul = $consul + 1;
  } else {
   $nom_g = strtoupper($nom_g);
   $consulta  = "Select * From cred_grupo where CRED_GRP_NOMBRE = '$nom_g' and CRED_GRP_USR_BAJA is null"; 
}
if ($consul == 2) {
   //echo "Consultara todos";
   $consulta  = "Select * From cred_grupo where CRED_GRP_USR_BAJA is null order by 3";
 }
?>  
 <?php  
   $resultado = mysql_query($consulta);
 ?>
 <div id="contenido_modulo">

                      <h2> <img src="img/user office_64x64.png" border="0" alt="Modulo" align="absmiddle"> DIRECTIVAS GRUPOS/BANCA</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Elija el Grupo
        </div>




        
           <form name="form2" method="post" action="grab_retro_grpm.php" >
            <select name="cod_grupo[]" size="12" style="width: 500px; height:500px" multiple>
              <?php   
              while ($linea = mysql_fetch_array($resultado)) {
               ?>
              <option value=<?php echo $linea['CRED_GRP_CODIGO']; ?>>
              <?php echo $linea['CRED_GRP_NOMBRE']; ?>
                 <?php
               }
             ?>
             </select>
             <br><br>
              <input class="btn_form" type="submit" name="accion" value="Directiva">
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