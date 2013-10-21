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
<link href="css/imprimir.css" rel="stylesheet" type="text/css" media="print" />
<link href="css/no_imprimir.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<?php
 $fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?>
  <div id="div_impresora" class="div_impresora" style="width:860px" align="right">
       <a href="javascript:print();">Imprimir</a>
	    <a href='cart_reportes.php'>Salir</a>
  </div>

<br><br>
<?php

$f_has ="";
$f_cal ="";
$t_cuo = 0;
$saldo = 0;
$tot_des = 0;
$log_usr = $_SESSION['login']; 
$total = 0;
$est1 = 3;
$est2 = 8;
$cas = "";
if(isset($_POST['ctot'])){  
	 $est1 = 3;
	 $est2 = 7;
      }
if(isset($_POST['cvig'])){
   $est1 = 3;
   $est2 = 3;
   }
if(isset($_POST['cven'])){
   $est1 = 6;
   $est2 = 6;
   }  
 if(isset($_POST['ceje'])){
   $est1 = 7;
   $est2 = 7;
   }     	  
if(isset($_POST['ccas'])){
   $est1 = 8;
   $est2 = 8;
   }

 
$cod_mon = 	$_POST['cod_mon'] ;
$fec_pro = $_POST['fec_nac'] ; 
$f_pro = cambiaf_a_mysql($fec_pro); 
?> 
 <font size="+2"  style="" >

<?php
echo encadenar(45)."Detalle de Cartera  al ".encadenar(3).$fec_pro;
?>
</font>
<br><br>
<?php
if ($cod_mon == 1){
   echo "Moneda Bolivianos";
   }
 if ($cod_mon == 2){
   echo "Moneda Dolares Americanos";
   }   
 ?>  
 
  <table border="1" width="900">
	
	<tr>
	    <th align="center">Nro</th> 
		<th align="center">Asesor </th>  
	   	<th align="center">Nro. Operacion</th> 
		<th align="center">Cliente</th>           
	    <th align="center">Grupo</th>
		<th align="center">Tasa</th>
		<th align="center">Estado</th>
		<th align="center">Monto Desem.</th>
		<th align="center">Monto Pagado</th>
		<th align="center">Saldo </th>
		<th align="center">Tip.Opera</th>
  </tr>	
     
 <?php  
 $con_fca  = "Select * From fond_can"; 
 $res_fca = mysql_query($con_fca);
   while ($lin_fca = mysql_fetch_array($res_fca)) {
          $cta_fdo = $lin_fca['cuenta'];
$con_fon  = "Select * From fond_maestro
             where FOND_NRO_CTA= $cta_fdo"; 
$res_fon = mysql_query($con_fon);
$nro = 0;
   while ($lin_fon = mysql_fetch_array($res_fon)) {
         $cod_cre = $lin_fon['FOND_NRO_CRED']; 
		 echo $cod_cre;
	     $act_maestro = "update cart_maestro set CART_ESTADO = 109 
		                 where CART_NRO_CRED = $cod_cre and CART_ESTADO > 8";
   $res_maestro = mysql_query($act_maestro);	
   
   }
   }
   	 	
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

