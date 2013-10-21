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
<title>Reporte Recibos No Utilizados</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script src="script/jquery-ui.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>
<script type="text/javascript" src="js/ModulosContabilidad.js"></script>  
</head>
<body>

<div id="dialog-message" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">Debe seleccionar una Opci&oacute;n por favor.</font></p>
</div>


<?php
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
                  <li id="menu_modulo_contabilidad_facturacion_recibos">
                    
                     <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle"> RECIBOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad_recibos_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> REPORTES
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/close_24x24.png" border="0" alt="Modulo" align="absmiddle"> REC. NO UTILIZADOS
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/close_64x64.png" border="0" alt="Modulo" align="absmiddle"> RECIBOS NO UTILIZADOS </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
           Seleccione una Opci&oacute;n
        </div>
	
         
				<?php
					 $fec = $_SESSION['fec_proc']; //leer_param_gral();
					 $fec1 = cambiaf_a_mysql_2($fec);
					 $logi = $_SESSION['login']; 
					 $log_usr = $_SESSION['login']; 
				?>
             

  <form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">

  	
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


if ($_SESSION['detalle'] == 1){
 
	 ?>
	</font>
	
   	
  <table align="center">
       </table>
	 <center>
	    

<table border="1" width="200" align="center" class="table_usuario">
	<br>
	<tr>
	    <th align="center">Nro. Talon </th>
	    <th align="center">Responsable </th>  
	   	<th align="center">Fecha</th> 
		<th align="center">Nro. Recibo Desde</th>           
	    <th align="center">Nro. Recibo Hasta</th>
	    <th align="center"> Seleccione una opci&oacute;n</th>
   </tr>	
	
	
	
	<?php
	 }
     
	 
	  $con_rec = "Select * From recibo_cntrl where REC_CTRL_USR_BAJA is null order by REC_CTRL_DESDE ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	   $fec_ent = cambiaf_a_normal($lin_res['REC_CTRL_FECHA']);
	  ?>
	     <tr>
		  <td align="left" ><?php echo $lin_res['REC_CTRL_NRO']; ?></td> 
		  <td align="left" ><?php echo $lin_res['REC_CTRL_FUNC']; ?></td> 
		 <td align="left" ><?php echo $fec_ent; ?></td> 
	    <td align="right" ><?php echo number_format($lin_res['REC_CTRL_DESDE'], 0, '.',','); ?></td>
		 <td align="right" ><?php echo number_format($lin_res['REC_CTRL_HASTA'], 0, '.',','); ?></td>
		 <td ><INPUT NAME="nro_tal" TYPE=RADIO VALUE=<?php echo $lin_res['REC_CTRL_NRO'];?>></td>
		 </tr>
	<?php
	  }
	 

 ?>

</table>


<center>
    <?php //} ?>
    <br>
		 <input class="btn_form" type="submit" name="accion" value="Recibos No Utilizados">

    	 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->


    	 <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
</center>

</form>

<?php

 if ($_SESSION['detalle'] == 3){
 if (isset( $_POST["nro_tal"])){
   $nro_tal = $_POST["nro_tal"];
   
echo $nro_tal;
$_SESSION['nro_tal'] = $nro_tal;
 header('Location: rep_rec_nouti.php');
    } 
$cuan_1 = 0;

$cuan_2 = 0;
	  
	  $con_rec = "Select * From recibo_cntrl where REC_CTRL_NRO = $nro_tal and
	  REC_CTRL_USR_BAJA is null ";
     $res_rec = mysql_query($con_rec);
	  while ($lin_res = mysql_fetch_array($res_rec)) {
	  
	  echo "Desde ".$lin_res['REC_CTRL_DESDE']." "."Hasta". $lin_res['REC_CTRL_HASTA']; 
	  
	  
	  
}	  
//	$descrip = $_SESSION['descrip'];
//	$niv_cta = $_SESSION['niv_cta'];
//	$cin = $_SESSION['mone'];
//	$cta_ctbr = $_SESSION['cta_ctbr'];
   
 /*     $consulta = "insert into recibo_cntrl (REC_CTRL_AGEN, 
                                              REC_CTRL_FUNC,
									          REC_CTRL_ALFA,
									          REC_CTRL_DESDE,
					                          REC_CTRL_HASTA,
											  REC_CTRL_FECHA,
											  REC_CTRL_FEC_D,
											  REC_CTRL_FEC_H,
											  REC_CTRL_CAPO1,
											  REC_CTRL_USR_ALTA,
											  REC_CTRL_FCH_HR_ALTA,
											  REC_CTRL_USR_BAJA,
											  REC_CTRL_FCH_HR_BAJA											   
					                      ) values (32,
									                '$cod_ase',
												    '',
												   $nro_rec1,
												   $nro_rec2,
												 '$fec1',
												 '$fec1',
												 '$fec1',
												 null,
												 '$logi',
												 null,
												 null,
												 null
												  )";
$resultado = mysql_query($consulta	
 header('Location: con_mant_rec.php');	 
	 
  //echo $_SESSION['monto_i'].encadenar.$_SESSION['monto_p'].encadenar(2).$_SESSION['cta_f13'];
//  }
*/
 }
 
  
 ?>
	 
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