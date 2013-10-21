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
<!--Titulo de la pestana de la pagina-->
<title><?php echo $_SESSION['COD_EMPRESA']; ?></title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>

</head>
<body>	<?php
				include("header.php");
			?>
	<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  <li id="menu_modulo_contabilidad_facturacion">
                    
                     <img src="img/FAX_24x24.png" border="0" alt="Modulo" align="absmiddle"> FACTURACION
                    
                 </li>
				  </li>
                  <li id="menu_modulo_fecha_fac">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONSULTA FACTURA
                    
                 </li>				  <li id="menu_modulo_fecha">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> LISTADO DE FACTURA
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">

<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 
  //verif_cierre($fec);
?> 

<?php
//verif_cierre($fec);
// Se realiza una consulta SQL a tabla gral_param_propios

if (isset($_SESSION['msg_error'])){
    if ($_SESSION['msg_error'] <> ""){
	    //echo $_SESSION['msg_error'];
    }
}	
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta);


 ?>
<h2> <img src="img/shield1_64x64.png" border="0" alt="Modulo" align="absmiddle"> LISTADO DE FACTURA </h2>
 <hr style="border:1px dashed #767676;">
 <?php 
    
	
	if(isset($_POST['fec_des'])){
      $f_des = $_POST['fec_des'];
	  $mes = substr($f_des,3,2);
	  $anio = substr($f_des,6,4);
      $_SESSION['f_des'] = $f_des;
	  $f_des = cambiaf_a_mysql($f_des);
	  
  }
	
	if(isset($_POST['fec_has'])){
      $f_has = $_POST['fec_has'];
	  $mes = substr($f_has,3,2);
	  $anio = substr($f_has,6,4);
      $_SESSION['f_has'] = $f_has;
	  $f_has = cambiaf_a_mysql($f_has);

}?>

 <!--
  <font style="font-size:13px"><b><border="0" alt="" align="absmiddle" />Fecha Desde:</b><?php //echo $f_des;?> </font><n><n>
  <font style="font-size:13px"><b><border="0" alt="" align="absmiddle" />Fecha Hasta:</b><?php // echo $f_has;?></font>
	-->
	<?php
 	$con_fac = "SELECT FACTURA_NRO, FACTURA_FECHA, FACTURA_NOMBRE, FACTURA_NIT, FACTURA_MONTO, FACTURA_COD_CTRL, IF(FACTURA_ESTADO='1','ACTIVO','ANULADO' ) AS FACTURA_ESTADO
				FROM factura
				WHERE FACTURA_FECHA>='$f_des' AND FACTURA_FECHA <='$f_has'
						";
    $res_fac = mysql_query($con_fac)
	
	?>
	<form name="form2" method="post" action="con_ufv_op.php" onSubmit="return">
	   <br>
	 <table width="80%"  border="1" align="center" class="table_usuario">
     <tr>
	 
	  <th width="10%" scope="col" style="font-size:12px"><border="0" alt="" align="center" />NRO FACTURA </th>
	  <th width="10%" scope="col" style="font-size:12px"><border="0" alt="" align="center" />FECHA</th>
	  <th width="30%" scope="col" style="font-size:12px"><border="0" alt="" align="center" />NOMBRE</th>
	  <th width="10%" scope="col" style="font-size:12px"><border="0" alt="" align="center" />NIT</th>
	  <th width="10%" scope="col" style="font-size:12px"><border="0" alt="" align="center" />MONTO</th>
	  <th width="15%" scope="col" style="font-size:12px"><border="0" alt="" align="center" />CODIGO CTRL</th>
	  <th width="10%" scope="col" style="font-size:12px"><border="0" alt="" align="center" />ESTADO</th>
	  
	</tr>
	<?php
 	while ($lin_tran = mysql_fetch_array($res_fac)) {
	
	
	?>
	<tr>
		      <td align="right" style="font-size:12px"><?php echo $lin_tran['FACTURA_NRO']; ?></td>
		      <td align="left" style="font-size:12px"><?php echo cambiaf_a_normal($lin_tran['FACTURA_FECHA']); ?></td>
			  <td align="left" style="font-size:12px"><?php echo utf8_encode($lin_tran['FACTURA_NOMBRE']); ?></td>
		      <td align="right" style="font-size:12px"><?php echo $lin_tran['FACTURA_NIT']; ?></td>
			  <td align="right" style="font-size:12px"><?php echo $lin_tran['FACTURA_MONTO']; ?></td>
			  <td align="left" style="font-size:12px"><?php echo $lin_tran['FACTURA_COD_CTRL']; ?></td>
		      <td align="right" style="font-size:12px"><?php echo $lin_tran['FACTURA_ESTADO']; ?></td>
	 </tr>
	<?php
	
		}
		
		 ?> 
</table>

	    <br>
        <center>
		
		<!--input class="btn_form" type="submit" name="accion" value="Salir_Menu"-->
        </center>		
		</form>
<?php
		 	include("footer_in.php");
		 ?>
</body>
</html>
<?php

}
    ob_end_flush();
 ?>