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
<?php
/***VARIABLES POR POST ***/
$numero2 = count($_POST);
$total = 0;
$ncre =$_SESSION['ncre'] ;
if (isset( $_POST["fec_cal"])){
   $f_cal = $_POST["fec_cal"];
   $f_cal2 =cambiaf_a_mysql_2($f_cal);
   }else{
   $_SESSION['msg'] = "Debe elegir una Fecha";
   $_SESSION['calculo'] = 1;
   header('Location:cobro_detalle.php');
  } 
   
   
   echo "Fecha de Calculo   ".encadenar(2).$f_cal.encadenar(2).$f_cal2.$ncre;
   $con_pla  = "Select * From cart_plandp where CART_PLD_FECHA = '$f_cal2' and  CART_PLD_NCRE = $ncre and CART_PLD_USR_BAJA is null order by 4 ";
   $res_pla = mysql_query($con_pla)or die('No pudo seleccionarse tabla')  ;
   while ($lin_pla = mysql_fetch_array($res_pla)) {
          if ($lin_pla['CART_PLD_STAT'] == "C"){
		     $_SESSION['msg'] = "Cuota Pagada";
			 $_SESSION['calculo'] = 1;
			  header('Location:cobro_detalle.php');
		     } else {
			 $_SESSION['calculo'] = 2; 
			 $_SESSION['fec_cal'] = $f_cal2; 
			 $_SESSION['fec_cal1'] = $f_cal; 
			 $_SESSION['cuota'] = $lin_pla['CART_PLD_CTA'];
			 header('Location:cobro_detalle.php');  
			 } 
   
  } 
 
 
 

//echo $numero2;

?>


<?php
}
    ob_end_flush();
 ?>