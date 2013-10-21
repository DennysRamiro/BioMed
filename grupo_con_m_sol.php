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
<link href="css/estilo.css" rel="stylesheet" type="text/css">          
<script language="javascript" src="script/validarForm.js"></script>
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
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_creditos_modificar">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
 
		<h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle">MODIFICAR </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
         Elegir el Grupo
        </div>
<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>


<center>
<?php
//echo "entra a grabar";
$_SESSION['form_buffer'] = $_POST;
if( $_SESSION["continuar"] == 2 ) {
$quecom = $_POST['cod_sol'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_s = $quecom[$i];
 }
}
$con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $cod_s and CRED_SOL_USR_BAJA is null"; 
$res_sol = mysql_query($con_sol);
while ($lin_sol = mysql_fetch_array($res_sol)) {
      $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
	  $_SESSION['nro_sol'] = $cod_s;
	  }
}else{
$consul = 0;
if(isset($_POST['cod'])){
  $cod_gru =$_POST['cod'];
  }else{
  $cod_gru ="";
  }
if(isset($_POST['cod'])){ 
   $t_op = $_POST['tip_ope'];
  }else{
   $t_op ="";
  }
if(isset($_SESSION['cod_tipo'])){    
$t_op = $_SESSION['cod_tipo'];
}else{
  $cod_gru ="";
  }
} 
if ($t_op == 2 or $t_op == 1) {
   } else {
   header('Location: cliente_con_s.php');
 //  echo "Este Tipo de operacion NO necesita Grupo <a href='cliente_con_s.php'>Elegir Clientes</a><br>";
   return;
 }
if (empty($cod_gru)) {
    $consul = $consul + 1;
	} else {
	 $consulta  = "Select * From cred_grupo where CRED_GRP_COD = '$cod_gru' and CRED_GRP_USR_BAJA is null order by 3";
}
if(isset($_POST['nomb_g'])){ 
   $nom_g = $_POST['nomb_g']; 
   } else {
  $nom_g ="";
  }
if (empty($nom_g)) {
     $consul = $consul + 1;
	} else {
	 $nom_g = strtoupper($nom_g);
	 $consulta  = "Select * From cred_grupo where CRED_GRP_NOMBRE = '$nom_g' and CRED_GRP_USR_BAJA is null order by 3  "; 
}
if ($consul == 2) {
   //echo "Consultara todos";
   $consulta  = "Select * From cred_grupo where CRED_GRP_USR_BAJA is null order by 3";
 }
?>  
 <?php  
   $resultado = mysql_query($consulta);
 ?>
<form name="form2" method="post" action="grab_retro_grpm_sol.php" >
<select name="cod_grupo[]" size="12" multiple>
  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option value=<?php echo $linea['CRED_GRP_CODIGO']; ?>>
	    <?php echo $linea['CRED_GRP_CODIGO'].encadenar(2); ?>
		<?php echo $linea['CRED_GRP_NOMBRE']; ?>
	 <?php
   }
 ?>
  </select><br><br>
  <input class="btn_form" type="submit" name="accion" value="Elegir-Grupo">
  <input class="btn_form" type="submit" name="accion" value="Alta-Grupo">
  <input class="btn_form" type="submit" name="accion" value="Salir">
  </form>

</div>
   <?php
		 	include("footer_in.php");
		 ?> 
<?php
}
ob_end_flush();
 ?>		 