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
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
</head>
<body>
	<div id="cuerpoModulo">
	<?php
				include("header.php");
			?>
            <div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />

				<?php
					 $fec = leer_param_gral();
					 $logi = $_SESSION['login']; 
				?>
             </div>
             <div id="Salir">
            <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
            </div> 
				<div id="TitleModulo">
                	<img src="images/24x24/001_35.png" border="0" alt="" /> 
                    Cambiar Titular / Coordinador
                 </div>
<div id="AtrasBoton">
           		<a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
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
  <br>
              
  </center>	


	<?php
	echo "Nro.".encadenar(2)."Rel".encadenar(5)."Carnet Id.".encadenar(8)."Cliente  ";
	$consulta  = "Select CRED_DEU_RELACION, CRED_DEU_ID, CLIENTE_COD_ID,CLIENTE_AP_ESPOSO,
	CLIENTE_AP_PATERNO,
	 CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor 
	 where CRED_SOL_CODIGO = $nro_sol and CRED_DEU_INTERNO = CLIENTE_COD 
	 and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null ";
    $resultado = mysql_query($consulta);
	
    ?>
	<form name="form2" method="post" action="grupo_retro.php" >
	
	<select name="cod_sol[]" size="12" multiple>
	<?php
$nro_sel = 0 ;
while ($linea = mysql_fetch_array($resultado)) {
       $nro_sel = $nro_sel + 1;
		//$r = "";
		$nom_cli = $linea['CLIENTE_AP_ESPOSO'].encadenar(1).$linea['CLIENTE_AP_PATERNO'].encadenar(1). $linea['CLIENTE_AP_MATERNO']
		.encadenar(1).$linea['CLIENTE_NOMBRES'];
		$cod_ncre = $linea['CRED_DEU_ID'];
		//$nray = 60 - $nro;
		//echo $cod_ncre;
		 ?>
		<option value=<?php echo $linea['CRED_DEU_ID']; ?>>
		               <?php echo $linea['CRED_DEU_ID']; ?>
		               <?php echo $nro_sel.encadenar(5); ?>
		              <?php echo $linea['CRED_DEU_RELACION'].encadenar(5); ?>
		               <?php echo $nom_cli; ?>
        
		
	  <?php
       }
	    
       ?>

<center>
</select>
    <input type="submit" name="accion" value="Cambiar">
	<?php
       }
	   
       ?>
</center>
</form>
  <?php
      
	if ($_SESSION['detalle'] == 2){   
	 
	    if (isset($_POST['ncre'])){
		    echo "aqui";
           $ncre = $_POST['ncre'];
	       $_SESSION['ncre'] = $ncre;
	       echo $_SESSION['ncre'];
	     }
	     echo "actualiza al nuevo coordinador";
	  } 
	   
	   
       ?>
	   </form>
</div>
<div id="FooterTable">
Marque al Nuevo Titular / Coordinador
</div>
<?php
		 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>