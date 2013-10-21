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
$ncre =$_SESSION['ncre'];
$_SESSION['cuota_d'] = 0;
if (isset( $_POST["fec_cal"])){
   $f_cal = $_POST["fec_cal"];
   $f_cal2 =cambiaf_a_mysql_2($f_cal);
   }else{
   echo "Elegir Fecha";
   $_SESSION['calculo'] = 1;
   $_SESSION['continuar'] = 1;
   header('Location:cobro_detalle_2.php');
   
   //$_SESSION['calculo'] = 2;
   }
   
   
   //echo "Fecha de Calculo   ".encadenar(2).$f_cal.encadenar(2).$f_cal2.$ncre;
   $con_pla  = "Select * From cart_plandp where CART_PLD_FECHA = '$f_cal2' and  CART_PLD_NCRE = $ncre and CART_PLD_USR_BAJA is null order by 4 ";
   $res_pla = mysql_query($con_pla)or die('No pudo seleccionarse tabla')  ;
   while ($lin_pla = mysql_fetch_array($res_pla)) {
        echo "Fecha de Calculo   ".encadenar(2).$f_cal.encadenar(2).$f_cal2.$ncre,$lin_pla['CART_PLD_STAT'];
          if ($lin_pla['CART_PLD_STAT'] == "C"){
		     $_SESSION['msg'] = "Cuota Pagada";
			 $_SESSION['calculo'] = 1;
			 $_SESSION['continuar'] = 1;
			  header('Location:cobro_detalle_2.php');
		     } else {
			 
			 //
			 $_SESSION['calculo'] = 2; 
			 $_SESSION['fec_cal'] = $f_cal2; 
			 $_SESSION['fec_cal1'] = $f_cal; 
			 $_SESSION['cuota'] = $lin_pla['CART_PLD_CTA'];
			 $nro_cta = $_SESSION['cuota'];
			 $con_pla_d  = "Select * From cart_plandp where CART_PLD_FECHA <= '$f_cal2' and  CART_PLD_NCRE = $ncre
			              and CART_PLD_STAT <> 'C' and CART_PLD_USR_BAJA is null ORDER BY 3 ASC LIMIT 0,1 ";
              $res_pla_d = mysql_query($con_pla_d)or die('No pudo seleccionarse tabla')  ;
              while ($lin_pla_d = mysql_fetch_array($res_pla_d)) {
			         $_SESSION['cuota_d'] = 0;
                     $cta_des = $lin_pla_d['CART_PLD_CTA'];
					 if ($cta_des <> $nro_cta){
					    $_SESSION['cuota_d'] = $cta_des;
						}
			 		} 
			 
			 $_SESSION['continuar'] = 1;
			 header('Location:cobro_detalle_2.php');  
			 } 
   
  } 
 
 
 

//echo $numero2;

?>


<?php
}
    ob_end_flush();
 ?>