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
<title>Mantenimiento Directiva Grupo</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
</head>
<body><?php
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
                  <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA
              </li>
              <li id="menu_modulo_fecha_cambio">
                  <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE GRUPOS
              </li>
           </ul> 
    
	  <div id="contenido_modulo">

             <h2> <img src="img/tools_64x64.png" border="0" alt="Modulo" align="absmiddle"> ALTA DE GRUPOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
                            <img src="img/alert_32x32.png" align="absmiddle">
                                 Ingrese Mesa Directiva Grupo / Banca
                        </div>


     <?php
					 //$fec = leer_param_gral();
					 $logi = $_SESSION['login']; 
				?>

           <div id="TableUsuario">
<?php
if(isset($_POST['cod_grupo'])){
   $quecom = $_POST['cod_grupo'];
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
       if( isset($quecom[$i]) ) {
          $cod_g = $quecom[$i];
       }
    }
 }
//cho $cod_g,"codigo grupo",$_SESSION["alta_grab"];
//echo $_SESSION["alta_grab"];
if( $_SESSION["alta_grab"] == 2 ) {
 $cod_g = $_SESSION["cod_g"] ;
 }else{
  $_SESSION["cod_g"] = $cod_g ;
  $_SESSION["alta_grab"] = 1;
} 
$consulta  = "Select * From cred_grupo where  CRED_GRP_CODIGO = $cod_g and CRED_GRP_USR_BAJA is null ";
$resultado = mysql_query($consulta);
$datos = $_SESSION['form_buffer'];
?>

<?php
  while ($linea = mysql_fetch_array($resultado)) {
		$_SESSION["nombre_g"] = $linea['CRED_GRP_NOMBRE'];
		 ?>
     <strong>Codigo  </strong>
	 <?php
	 echo $linea['CRED_GRP_CODIGO']; 
	  ?>
     <strong>Nombre  </strong>
	 <?php
     echo $linea['CRED_GRP_NOMBRE'];
	 ?>
     <?php
	   } 
     ?>		
<center>
<form name="form1" method="post" action="grupo_retro.php" target="_self" >
	<?php
	$consulta  = "Select CRED_GRP_MES_CLI, CLIENTE_COD_ID,CLIENTE_AP_PATERNO, CLIENTE_AP_MATERNO, CLIENTE_NOMBRES,GRAL_PAR_PRO_DESC, CRED_GRP_MES_REL From cliente_general, cred_grupo_mesa, gral_param_propios where CRED_GRP_MES_COD = $cod_g and CRED_GRP_MES_CLI = CLIENTE_COD and GRAL_PAR_PRO_GRP =910 and GRAL_PAR_PRO_COD = CRED_GRP_MES_REL and CRED_GRP_MES_USR_BAJA is null and CLIENTE_USR_BAJA is null and GRAL_PAR_PRO_USR_BAJA is null";
    $resultado = mysql_query($consulta);
   	$nro_sel = 0 ;
	?>

<table border="0" cellspacing="0" cellpadding="0" style="font-size:20px">
	<tr>
	    <th>Codigo Int</th>
		<th>Carnet identidad</th>
		<th>Cliente</th>
		<th>Cargo</th>
	</tr>
<?php
$nro_sel = 0 ;
while ($linea = mysql_fetch_array($resultado)) {
     $nro_sel = $nro_sel + 1;
	 $cliente = $linea['CLIENTE_AP_PATERNO'].encadenar(2).$linea['CLIENTE_AP_MATERNO'].encadenar(2).$linea['CLIENTE_NOMBRES'];
	 ?>
	 <tr>
		<td><?php echo $linea['CRED_GRP_MES_CLI']; ?></td>
		<td><?php echo $linea['CLIENTE_COD_ID']; ?></td>
		<td><?php echo $cliente; ?></td>
		<td><?php echo $linea['GRAL_PAR_PRO_DESC']; ?></td>
	    <?php
}
?>
</tr>
</table>
<br>
    <input class="btn_form" type="submit" name="accion" value="Agregar Clientes">
	<input class="btn_form" type="submit" name="accion" value="Actualizar Cargos">
	<input class="btn_form" type="submit" name="accion" value="Salir">
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