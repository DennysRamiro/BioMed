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
<title>Mantenimiento Clientes</title>
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
//$_SESSION["total_s"] = 0;
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $nro_sol = $_SESSION['nro_sol'];
 $datos = $_SESSION['form_buffer'];
?> 
<center>
</div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
  </div> 
  <div id="TitleModulo">
  <img src="images/24x24/001_35.png" border="0" alt="" />   
           Solicitud con Grupo Seleccionado
  </div>
<div id="AtrasBoton">
  	<a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<?php
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
$numero = 0;
   $quecom = $_POST['cod_sol'];
   for ($i=0; $i < count($quecom); $i = $i + 1 ) {
       if (isset($quecom[$i]) ) {
          $nro_sol = $quecom[$i];
	      $_SESSION['nro_sol'] = $nro_sol;
       }
   }
  
   $con_sol  = "Select * From cred_solicitud where CRED_SOL_CODIGO = $nro_sol and CRED_SOL_USR_BAJA is null"; 
   $res_sol = mysql_query($con_sol)or die('No pudo seleccionarse solicitud 2');
   while ($lin_sol = mysql_fetch_array($res_sol)) {
         $t_op = $lin_sol['CRED_SOL_TIPO_OPER']; 
		 $_SESSION['cod_tipo'] = $t_op;
		 $impo = $lin_sol['CRED_SOL_IMPORTE'];
		 $mon  = $lin_sol['CRED_SOL_COD_MON'];
		 $comi  = $lin_sol['CRED_SOL_TIP_COM'];
		 $ahod  = $lin_sol['CRED_SOL_AHO_DUR'];
		 $ahoi  = $lin_sol['CRED_SOL_AHO_INI'];
		 $cod_g = $lin_sol['CRED_SOL_COD_GRUPO'];
		
		 $con_mon = "Select GRAL_PAR_INT_DESC  From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and                     GRAL_PAR_INT_COD = $mon ";
         $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla mon')  ;
		  while ($lin_mon = mysql_fetch_array($res_mon)) {
		        $mon_d = $lin_mon['GRAL_PAR_INT_DESC'];
		  }
	 	 $con_com = "Select GRAL_PAR_PRO_DESC,GRAL_PAR_PRO_CTA1 From gral_param_propios where GRAL_PAR_PRO_GRP = 911                    and GRAL_PAR_PRO_COD = $comi ";
         $res_com = mysql_query($con_com)or die('No pudo seleccionarse tabla comi')  ;
		  while ($lin_com = mysql_fetch_array($res_com)) {
		        $com_d = $lin_com['GRAL_PAR_PRO_DESC'];
				$com_f = $lin_com['GRAL_PAR_PRO_CTA1'];
		  }
		  
		  $con_ahod = "Select GRAL_PAR_PRO_DESC  From gral_param_propios where GRAL_PAR_PRO_GRP = 912 and                     GRAL_PAR_PRO_COD = $ahod ";
         $res_ahod = mysql_query($con_ahod)or die('No pudo seleccionarse tabla ahod')  ;
		  while ($lin_ahod = mysql_fetch_array($res_ahod)) {
		        $aho_d = $lin_ahod['GRAL_PAR_PRO_DESC'];
		  }
		  
		 $con_top = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 21 and GRAL_PAR_INT_COD = $t_op";
         $res_top = mysql_query($con_top)or die('No pudo seleccionarse tabla')  ;
		  while ($lin_top = mysql_fetch_array($res_top)) {
		        $top_d = $lin_top['GRAL_PAR_INT_DESC'];
				
		  }
	 	  }
?>  
<form name="form1" method="post" action="solic_retro_sol.php" style="border:groove" target="_self"  >
 <font color="#0000FF" size="+1">
  <strong> Solicitud </strong>
   <?php  
     echo $nro_sol, "   ";   
 ?>
  <strong> Importe Solicitado </strong>
   <?php 
    $_SESSION["impo_sol"] = $impo;
	$impo = number_format($impo, 2, '.',','); 
     echo $impo,"   ";   
 ?>
   <strong> Moneda </strong>
   <?php
     $_SESSION["mon_d"] = $mon_d;
     echo $mon_d,"   " ;   
 ?>
  
 <br>
 <strong> Comision </strong>
 <?php  
     echo "  ", $com_d,"   " ; 
	 echo "  ";
 ?>
 <strong> Fondo Garantia Inicio </strong>
   <?php
     $_SESSION["aho_i"] = $ahoi;  
     echo $ahoi. "%   ";   
 ?>
  <strong> Fondo Garantia Ciclo </strong>
   <?php
     $_SESSION["aho_d"] =  $ahod; 
     echo $ahod. "%   ";   
 ?>
 <br>
 <strong> Tipo Operacion </strong>
   <?php
     $_SESSION["top_d"] = $top_d;
     echo $top_d,"   " ;   
 ?>
 <br>
  <?php
 
 echo "_____________________________________________________________________________";
  ?>
 <br>
  <?php
  
 $con_grp = "Select * From cred_grupo where CRED_GRP_CODIGO = '$cod_g' and CRED_GRP_USR_BAJA is null";
$res_grp = mysql_query($con_grp)or die('No pudo seleccionarse tabla 1')  ;


while ($lin_grp = mysql_fetch_array($res_grp)){
     ?>
    <strong> Codigo Grupo </strong>      
     <?php
	 echo $cod_g. "    ";
	 ?>
    <strong> Nombre del Grupo </strong> 
	<?php
	 echo $lin_grp['CRED_GRP_NOMBRE']. "    ";
	     
}
 ?>
 
 
 </FONT>
<br>
</strong>	
<center>	
<br><br>
<?php
  if ($t_op < 3) {
  ?>
 <input type="submit" name="accion" value="Elegir Otro Grupo">
 <?php
 }
 ?>
 <input type="submit" name="accion" value="Siguiente Paso">
 <input type="submit" name="accion" value="Salir">

</form>
</div>
<center>
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
