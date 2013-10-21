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
$con_car  = "Select * From cart_maestro
             where CART_ESTADO = 9 and year(CART_FCH_CAN) < 2012"; 
$res_car = mysql_query($con_car);
$nro = 0;
   while ($lin_car = mysql_fetch_array($res_car)) {
         $cod_cre = $lin_car['CART_NRO_CRED']; 
		 $cod_sol = $lin_car['CART_NRO_SOL'];
		 $tip_cre = $lin_car['CART_TIPO_CRED']; 
		 
		 echo $cod_cre;
		
   
   $borr_cabec = "delete From cart_cabecera where CART_CAB_NCRE = $cod_cre";
   $res_cabec = mysql_query($borr_cabec);
	  
   $borr_det_tran = "delete From cart_det_tran where CART_DTRA_NCRE = $cod_cre";
   $res_det_tran = mysql_query($borr_det_tran);
   
   $borr_det_cond = "delete From cart_det_cond where CART_DET_CON_NCRE = $cod_cre";
   $res_det_cond = mysql_query($borr_det_cond);
   
   $borr_deudor = "delete From cart_deudor where CART_DEU_NCRED = $cod_cre";
   $res_deudor = mysql_query($borr_deudor);
   
   $borr_plandp = "delete From cart_plandp where CART_PLD_NCRE = $cod_cre";
   $res_plandp = mysql_query($borr_plandp);
   
   
  if ($tip_cre == 1){  
   $borr_cab_plan = "delete From cred_cab_plan where cred_cpla_codigo = $cod_sol";
   $res_cab_plan = mysql_query($borr_cab_plan);	
   
   $borr_deudor = "delete From cred_deudor where CRED_SOL_CODIGO = $cod_sol";
   $res_deudor = mysql_query($borr_deudor);	
   
   $borr_plandp = "delete From cred_plandp where CRED_PLD_COD_SOL = $cod_sol";
   $res_plandp = mysql_query($borr_plandp);	
   
   $borr_solic = "delete From cred_solicitud where CRED_SOL_CODIGO = $cod_sol";
   $res_solic = mysql_query($borr_solic);
   	
  } 
   $act_maestro = "update cart_maestro set CART_ESTADO = 109 where CART_NRO_CRED = $cod_cre";
   $res_maestro = mysql_query($act_maestro);	
   
   }
   $borr_maestro = "delete From cart_maestro where CART_ESTADO =109 and year(CART_FCH_CAN) < 2012";
   $res_maestro = mysql_query($borr_maestro);	 	
		 ?>

</div>
</body>
</html>



<?php
}
ob_end_flush();
 ?>

