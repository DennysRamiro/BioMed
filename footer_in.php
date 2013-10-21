<?php
require('configuracion.php');

$consulta  = "Select GRAL_EMP_NOMBRE From gral_empresa ";
$resultado = mysql_query($consulta);
$linea = mysql_fetch_array($resultado);
   $_SESSION['COD_EMPRESA']=$linea['GRAL_EMP_NOMBRE'];
?> 
<div id="footer_empresa">
<?php
      echo "&copy; ".date("Y")." ARGO <b>SI</b>";
?>	  
 
</div>