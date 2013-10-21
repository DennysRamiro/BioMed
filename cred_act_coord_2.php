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
<title>Cambiar Titular / Coordinador</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">

 <script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
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
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> M
                    
                 </li>
                  <li id="menu_modulo_creditos_modificar">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> S
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> M
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
 
    <h2> <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle">CAMBIA COORDINADOR </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
         Marque al Nuevo Titular / Coordinador
        </div>
	
  
				<?php
					 //$fec = leer_param_gral();
					 $logi = $_SESSION['login']; 
				?>
  
        <div id="CueproVerMod">
<?php
//$datos = $_SESSION['form_buffer'];
//$cod_g = $_SESSION["cod_g"] ;
?>
<strong><center>

<?php
if ($_SESSION['detalle'] == 1){
 $nro_sol = $_SESSION['nro_sol'];

  echo "Nro. Solicitud".encadenar(2).$nro_sol; 
  ?>
  </center></strong>		

<form name="form1" method="post" action="incorp_cli_sol.php"  >
	<?php
	$consulta  = "Select CRED_DEU_RELACION, CRED_DEU_ID, CLIENTE_COD_ID,CLIENTE_AP_ESPOSO,
	CLIENTE_AP_PATERNO,
	 CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor 
	 where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD 
	 and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null  order by CRED_DEU_RELACION ";
    $resultado = mysql_query($consulta);
	
    ?>
<table border="1">
	<tr>
	    <th>Nro.</th>
	    <th>Relacion</th>
		<th>Carnet identidad</th>
		<th>Cliente</th>
		<th>Nuevo Coordinador</th>
	</tr>
<?php
$nro_sel = 0 ;
while ($linea = mysql_fetch_array($resultado)) {
       $nro_sel = $nro_sel + 1;
		//$r = "";
		$nom_cli = $linea['CLIENTE_AP_ESPOSO'].encadenar(1).$linea['CLIENTE_AP_PATERNO'].encadenar(1). $linea['CLIENTE_AP_MATERNO']
		.encadenar(1).$linea['CLIENTE_NOMBRES'];
		$cod_ncre = $linea['CRED_DEU_ID'];
		//$nray = 60 - $nro;
	//	echo $cod_ncre;
		 ?>
		 <tr>
		 <td><?php echo $nro_sel; ?></td>
		 <td><?php echo $linea['CRED_DEU_RELACION']; ?></td>
		 <td><?php echo $linea['CRED_DEU_ID']; ?></td>
		 <td><?php echo $nom_cli; ?></td>
        <td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>">	</td> 
		 </tr>
	  <?php
	     
       }
       ?>
</table>
<center>
    <input class="btn_form" type="submit" name="accion" value="Cambiar">
	
</center>
</form>
  <?php
       } 
	   
	if ($_SESSION['detalle'] == 2){  
	    $cod_cli = $_POST['ncre'];
		$nro_sol = $_SESSION['nro_sol']; 
	    echo "Cliente".encadenar(2).$cod_cli.encadenar(2)."Solicitud".encadenar(2).$_SESSION['nro_sol'] ;
	    $consulta  = "Select CRED_DEU_RELACION, CRED_DEU_ID, CLIENTE_COD_ID,CLIENTE_AP_ESPOSO,
	CLIENTE_AP_PATERNO,
	 CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor 
	 where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD 
	 and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
    $resultado = mysql_query($consulta);
	  while ($linea = mysql_fetch_array($resultado)) {
	      $cod_id = $linea['CRED_DEU_ID'];
		  if ($cod_id == $cod_cli){
		      $act_rel  = "update cred_deudor set  CRED_DEU_RELACION = 'C' 
	                       where CRED_DEU_ID = '$cod_id'
	                       and CRED_DEU_USR_BAJA is null";
              $res_rel = mysql_query($act_rel);
		    }else{
	           $act_rel  = "update cred_deudor set  CRED_DEU_RELACION = 'D' 
	                       where CRED_DEU_ID = '$cod_id'
	                       and CRED_DEU_USR_BAJA is null";
              $res_rel = mysql_query($act_rel);
	      }
		 } 
	  
	 header('Location:cliente_con_s.php');
	  
	  
	  
	/* for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_cli = $quecom[$i];
	      $_SESSION['cod_cli'] = $cod_cli;
		  echo $cod_cli;
		  
       }
   }*/
  } 

//cambia Garante

if ($_SESSION['detalle'] == 3){
 $nro_sol = $_SESSION['nro_sol'];

  echo "Nro. Solicitud".encadenar(2).$nro_sol; 
  ?>
  </center></strong>		

<form name="form1" method="post" action="incorp_cli_sol.php"  >
	<?php
	$consulta  = "Select CRED_DEU_RELACION, CRED_DEU_ID, CLIENTE_COD_ID,CLIENTE_AP_ESPOSO,
	CLIENTE_AP_PATERNO,
	 CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor 
	 where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD 
	 and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null  order by CRED_DEU_RELACION ";
    $resultado = mysql_query($consulta);
	
    ?>
<table border="1">
	<tr>
	    <th>Nro.</th>
	    <th>Relacion</th>
		<th>Carnet identidad</th>
		<th>Cliente</th>
		<th>Garante</th>
	</tr>
<?php
$nro_sel = 0 ;
while ($linea = mysql_fetch_array($resultado)) {
       $nro_sel = $nro_sel + 1;
		//$r = "";
		$nom_cli = $linea['CLIENTE_AP_ESPOSO'].encadenar(1).$linea['CLIENTE_AP_PATERNO'].encadenar(1). $linea['CLIENTE_AP_MATERNO']
		.encadenar(1).$linea['CLIENTE_NOMBRES'];
		$cod_ncre = $linea['CRED_DEU_ID'];
		//$nray = 60 - $nro;
	//	echo $cod_ncre;
		 ?>
		 <tr>
		 <td><?php echo $nro_sel; ?></td>
		 <td><?php echo $linea['CRED_DEU_RELACION']; ?></td>
		 <td><?php echo $linea['CRED_DEU_ID']; ?></td>
		 <td><?php echo $nom_cli; ?></td>
        <td><INPUT NAME="ncre" TYPE=RADIO VALUE="<?php echo $cod_ncre; ?>">	</td> 
		 </tr>
	  <?php
	     
       }
       ?>
</table>
<center>
    <input class="btn_form" type="submit" name="accion" value="Cambia-Gar">
	
</center>
</form>
  <?php
       } 
	   
	if ($_SESSION['detalle'] == 4){  
	    $cod_cli = $_POST['ncre'];
		$nro_sol = $_SESSION['nro_sol']; 
	    echo "Cliente".encadenar(2).$cod_cli.encadenar(2)."Solicitud".encadenar(2).$_SESSION['nro_sol'] ;
	    $consulta  = "Select CRED_DEU_RELACION, CRED_DEU_ID, CLIENTE_COD_ID,CLIENTE_AP_ESPOSO,
	CLIENTE_AP_PATERNO,
	 CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor 
	 where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD 
	 and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
    $resultado = mysql_query($consulta);
	  while ($linea = mysql_fetch_array($resultado)) {
	      $cod_id = $linea['CRED_DEU_ID'];
		  if ($cod_id == $cod_cli){
		      $act_rel  = "update cred_deudor set  CRED_DEU_RELACION = 'G' 
	                       where CRED_DEU_ID = '$cod_id'
	                       and CRED_DEU_USR_BAJA is null";
              $res_rel = mysql_query($act_rel);
		    }
		 } 
	  
	 header('Location:cliente_con_s.php');
	  
	  
	  
	/* for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $cod_cli = $quecom[$i];
	      $_SESSION['cod_cli'] = $cod_cli;
		  echo $cod_cli;
		  
       }
   }*/
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