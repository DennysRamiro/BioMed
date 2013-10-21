<?php
require('configuracion.php');

$consulta  = "Select GRAL_EMP_NOMBRE,GRAL_EMP_CENTRAL From gral_empresa ";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
   $_SESSION['COD_EMPRESA']=$linea['GRAL_EMP_NOMBRE'];
   $_SESSION['EMPRESA_TIPO']=$linea['GRAL_EMP_CENTRAL'];
?> 
<center>
<font size="+3">
<?php
echo "Libro".encadenar(3)."Diario";
?>
</font size>
</center>
<br>
<?php
      echo encadenar(15).$linea['GRAL_EMP_NOMBRE'];
?>	  
<br>
<?php
      $fecha =  $_SESSION['fec_ha2'];
      $tip_cam = leer_tipo_cam_2($fecha);
      echo encadenar(15)."Desde".encadenar(2).$_SESSION['fec_des']. encadenar(2)."Hasta".encadenar(2).$_SESSION['fec_has'].
	  encadenar(95)."Tipo Cambio".encadenar(2). number_format($tip_cam, 2, '.',',');
?>	  
<br>
<?php
      echo encadenar(15)."Expresado en Bolivianos";
	  $_SESSION['nro_pag'] = 5;
?>	  
 