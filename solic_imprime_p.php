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
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
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
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">	 
<strong>                      Impresion Plan de Pagos</strong><br>
</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<div id="GeneralManSolicaa">
<form name="form1" method="post" action="incorp_cli_sol.php"  >
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//if (isset($_SESSION['continuar'])){  
//   if ( $_SESSION['continuar'] == 2) {
//    $cod_s = $_SESSION["cod_sol"];
//    }
//}
if ($_SESSION['cont_imp'] == 0){ 
if (isset($_POST['cod_sol'])){  
    $quecom = $_POST['cod_sol'];
	}
if (isset($quecom)){  	
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
      if( isset($quecom[$i]) ) {
         $cod_s = $quecom[$i];
		 $_SESSION[" $cod_s"] = $cod_s;
		 $_SESSION["cod_sol"] = $cod_s;
        }
      }
    }
}
?>
<strong>
<?php
if ($_SESSION['cont_imp'] == 1){ 
    $cod_s = $_SESSION["cod_sol"];
}
echo  "Solicitud ". $cod_s. encadenar(2);

//$_SESSION['msg_err'] = " ";
?>
</strong>
<?php
$consulta  = "Select CRED_DEU_RELACION, CRED_DEU_ID, CLIENTE_COD_ID,CLIENTE_AP_ESPOSO,
	CLIENTE_AP_PATERNO,
	 CLIENTE_AP_MATERNO, CLIENTE_NOMBRES From cliente_general, cred_deudor 
	 where CRED_SOL_CODIGO = $cod_s and CRED_DEU_INTERNO = CLIENTE_COD 
	 and CRED_DEU_USR_BAJA is null and CLIENTE_USR_BAJA is null  order by CRED_DEU_RELACION ";
    $resultado = mysql_query($consulta);
	
    ?>
<table border="1">
	<tr>
	    <th>Nro.</th>
	    <th>Relacion</th>
		<th>Carnet identidad</th>
		<th>Cliente</th>
		<th>Seleccione</th>
	</tr>
<?php
$nro_sel = 0 ;?>
         </tr>
		 <tr>
		 <td> <?php echo encadenar(2); ?></td>
		 <td><?php echo encadenar(2); ?></td>
		 <td><?php echo "GLOBAL"; ?></td>
		 <td><?php echo encadenar(2); ?></td>
		
        <td><INPUT NAME="ncre" TYPE=RADIO VALUE="TODO">	</td> 
		 </tr> 
       		
<?php
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
    <input type="submit" name="accion" value="Imprimir">
	
</center>
</form>
  <?php
     //  } 
 ?>
 </strong>
  <div id="FooterTable">
<BR><B><FONT SIZE=+2><MARQUEE>Impresion Plan de Pagos </MARQUEE></FONT></B>
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
