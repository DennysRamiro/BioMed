<?php
	ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
		header("Location: index.php?error=1");
} else {
?>
<?php
switch( $_GET['accion'] ) {
      case "1":
	      //echo "Retroceder";
	    // $_SESSION["recal"] = 1;
		 header('Location: cja_rev_des.php');
	   break;
      case "2":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php'); 
		 header('Location: cja_rev_cob.php');
       break;
       //aumentar parametro menu para diferenciar el tipo de reporte
	   case "3":
	   $_SESSION["menu"] = 1;
	     // echo "Grabar"; 
	      require('cja_rev_bco.php'); 
		 //header('Location: cja_rev_bco.php?menu=1');
       break;
	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		// header('Location: cart_rep_det.php');
		header('Location: cja_rev_fga.php');
       break;
       //aumentar parametro menu para diferenciar el tipo de reporte
	   case "5":
	     $_SESSION["tipo_rep"] = 2;
	     $_SESSION["menu"] = 3;
	     require('cja_rev_cove.php');
		//header('Location: cja_rev_cove.php?menu=3');
       break;
       //aumentar parametro menu para diferenciar el tipo de reporte
	   case "6":
	     $_SESSION["tipo_rep"] = 3;
	      $_SESSION["menu"] = 5;
	     require('cja_rev_val.php');
		 //header('Location: cja_rev_val.php?menu=5');
       break;
       //aumentar parametro menu para diferenciar el tipo de reporte
	   case "7":
	     $_SESSION["tipo_rep"] = 7;
	     $_SESSION["menu"] = 7;
	     require('cja_rev_ineg.php');
		// header('Location: cja_rev_ineg.php?menu=7');
       break;
       //aumentar parametro menu para diferenciar el tipo de reporte
	   case "8":
	      //echo "Retroceder";
	     $_SESSION["reimpre"] = 1;
		 $_SESSION["detalle"] = 1;
		 header('Location: cja_rimp_par.php?menu=9');
	   break;
	   //aumentar parametro menu para diferenciar el tipo de reporte
      case "9":
	      $_SESSION["reimpre"] = 2;
		 $_SESSION["detalle"] = 1;
		 header('Location: cja_rimp_par.php?menu=10');
       break;
       //aumentar el parametro de menu para diferencir reportes
	   case "10":
	   	$_SESSION["menu"] = 2;
	     // echo "Grabar"; 
	      require('cja_rev_bco.php'); 
		 //header('Location: cja_rev_bco.php?menu=2');
       break;
       //aumentar el parametro de menu para diferencir reportes
	   case "11":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		 $_SESSION["reimpre"] = 3;
		 header('Location: cja_rimp_par.php?menu=11');
       break;
        //aumentar parametro menu para diferenciar el tipo de reporte
	   case "12":
	     $_SESSION["tipo_rep"] = 2;
	     $_SESSION["menu"] = 4;
	     require('cja_rev_cove.php');
		 //header('Location: cja_rev_cove.php?menu=4');
       break;
       //aumentar parametro menu para diferenciar el tipo de reporte
	   case "13":
	     $_SESSION["tipo_rep"] = 3;
	     $_SESSION["menu"] = 6;
	     require('cja_rev_val.php');
		 //header('Location: cja_rev_val.php?menu=6');
       break;
       //aumentar parametro menu para diferenciar el tipo de reporte
	   case "14":
	     $_SESSION["tipo_rep"] = 7;
	     $_SESSION["menu"] = 8;
	      require('cja_rev_ineg.php');
		 //header('Location: cja_rev_ineg.php?menu=8');
       break;
	   case "15":
	     // $_SESSION["reimpre"] = 5;
	     //  require('garl_grab_fec.php');
		 header('Location: cja_rimp_fac.php');
       break;
}
?> 
<?php
}
ob_end_flush();
 ?>