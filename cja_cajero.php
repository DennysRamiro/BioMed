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
<title>Seleccion de Cajero</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
<script type="text/javascript" src="js/cajas_reportes_det_mov.js"></script> 
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
                 <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_caja_reportes">
                    
                     <img src="img/paste_24x24.png" border="0" alt="Modulo" align="absmiddle"> CAJA REPORTES
                    
                 </li>
                  <li id="menu_modulo_caja_reportes_det_mov">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. MOVIMIENTO
                    
                 </li>
                  <li id="menu_modulo_caja_reportes_det_mov_cajero">
                    
                     <img src="img/edit file_24x24.png" border="0" alt="Modulo" align="absmiddle"> SELEC. CAJERO
                    
                 </li>
              </ul> 
              <div id="contenido_modulo">
                      <h2> <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">SELECCIONE UN CAJERO</h2>
                      <hr style="border:1px dashed #767676;">
                      <div id="error_login"> 
                     <img src="img/checkmark_32x32.png" align="absmiddle">
                     Seleccione un cajero para generar el reporte Detalle Movimiento.
				</div>   

	<!--div id="cuerpoModulo"-->

            <!--div id="UserData">
                 <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" /-->
				<?php
                 $fec =  $_SESSION['fec_proc']; //r_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_tpa = "Select DISTINCT CAJERO_LOGIN 
	            From cajero where
	            CAJERO_USR_BAJA is null
				 order by CAJERO_LOGIN  ";
                $res_tpa = mysql_query($con_tpa);
				if(isset($_POST['fec_des'])){
      				$f_des = $_POST['fec_des'];
     
	  				$f_des2 = cambiaf_a_mysql($f_des);
	   				$_SESSION['f_des'] = $f_des2;
  				}
 				if(isset($_POST['fec_has'])){
     				 $f_has = $_POST['fec_has'];
     
	  				$f_has2 = cambiaf_a_mysql($f_has);
	   				$_SESSION['f_has'] = $f_has2;
  				} 
  				//echo  $_SESSION['f_des']." ".$_SESSION['f_has'];
                ?> 
			<!--/div-->
   <BR><br>        
<center>
  <!--div id="GeneralManUsuario"-->
	 <form name="form2" method="post" action="caja_mov_det.php" onSubmit="return ValidarRangoFechas(this)">
	
	<table border="0">
		<tr>
			<td><strong>Cajero : </strong></td>
		</tr>
		<tr>
			<td align="middle"> <?php echo encadenar(6);
			$_SESSION['detalle'] = 3; ?>
          
		    <select name="log_caj" size="2" style="width:300px; height:300px;"  >
   	         <?php while ($linea = mysql_fetch_array( $res_tpa)) {?>
             <option value=<?php echo $linea['CAJERO_LOGIN']; ?>>
			 <?php echo $linea['CAJERO_LOGIN']; ?></option>
	         <?php              } ?></td>
		</tr>
		<tr>
			<td align="middle"> <input type="submit" name="accion" value="Procesar" class="btn_form"></td>
		</tr>

	</table>
	 
    </form>
</center>
   
<!--/div-->

<!--/div-->
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