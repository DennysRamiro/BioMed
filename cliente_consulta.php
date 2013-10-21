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
<title>PRODESARROLLO</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
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
					Consulta de Clientes
        </div>
        <div id="AtrasBoton">
           		<a href="cliente_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
           </div>
<?php
// Se realiza una consulta SQL
$consulta  = "Select * From cliente_general where CLIENTE_USR_BAJA is null order by 9";
$resultado = mysql_query($consulta);
?>
<div id="TableUsuario">
<table border="1">
	<tr>
	    <th>Codigo</th>
		<th>Carnet identidad</th>
		<th>Ap.Paterno</th>
		<th>Ap.Materno</th>
		<th>Nombres</th>
		<th>Direccion</th>
		<th>Telefono</th>
		<th>Celular</th>
		<th>E-Mail</th>
	</tr>
<?php
while ($linea = mysql_fetch_array($resultado)) {
	 ?>
	 <tr>
		<td><?php echo $linea['CLIENTE_COD']; ?></td>
		<td><?php echo $linea['CLIENTE_COD_ID']; ?></td>
		<td><?php echo $linea['CLIENTE_AP_PATERNO']; ?></td>
		<td><?php echo $linea['CLIENTE_AP_MATERNO']; ?></td>
		<td><?php echo $linea['CLIENTE_NOMBRES']; ?></td>
		<td><?php echo $linea['CLIENTE_DIRECCION']; ?></td>
		<td><?php echo $linea['CLIENTE_FONO']; ?></td>
		<td><?php echo $linea['CLIENTE_CELULAR']; ?></td>
		<td><?php echo $linea['CLIENTE_EMAIL']; ?></td>
		<!--<td><?php //echo $linea['GRAL_USR_CARGO']; ?></td>-->
	</tr>	
	 <?php
}
?>
</table>
</div>
<div id="FooterTable">
"Ingresar mas clientes <a href='cliente_mante_a.php'><img src="images/24x24/001_21.png" border="0" alt="" align="absmiddle"/>continuar</a>"||
"Terminar consulta <a href='cliente_mante.php'><img src="images/24x24/001_02.png" border="0" alt="" align="absmiddle"/>terminar</a>";
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