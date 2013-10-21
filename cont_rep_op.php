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
	     $_SESSION["tipo2"] = 1;
	     $_SESSION["tipo"] = 1;
	     $_SESSION["menu"] = 30;
	     $_SESSION['gestion'];
	    require 'tipo_rep_cont.php';
	    // echo  $_SESSION['gestion'];
		// header('Location: tipo_rep_cont.php');
	   break;

	   //Duplicar reportes para gestiones pasadas
	   case "21":
	     $_SESSION["tipo2"] = 1;
	     $_SESSION["tipo"] = 1;
	     $_SESSION["menu"] = 38;
	     $_SESSION['gestion'];
	     require 'tipo_rep_cont.php';
	    // echo  $_SESSION['gestion'];
		// header('Location: tipo_rep_cont.php');
	   break;

      case "2":
	      $_SESSION["tipo2"] = 2;
	     $_SESSION["tipo"] = 2;
	     $_SESSION["menu"] = 32;
	     $_SESSION['gestion'];
	      require 'tipo_rep_cont.php';
		 //header('Location: tipo_rep_cont.php');
	   break;

	    //Duplicar reportes para gestiones pasadas
      case "23":
	      $_SESSION["tipo2"] = 2;
	     $_SESSION["tipo"] = 2;
	     $_SESSION["menu"] = 40;
	     $_SESSION['gestion'];
	      require 'tipo_rep_cont.php';
		 //header('Location: tipo_rep_cont.php');
	   break;

	   case "3":
	     // echo "Grabar"; 
	    $_SESSION['continuar'] = 1;
	    $_SESSION['gestion'];
	    $_SESSION["menu"] = 36;
	    require 'con_mayor.php';
		 //header('Location: con_mayor.php');
       break;

       //Duplicar reportes para gestiones pasadas
       case "27":
	     // echo "Grabar"; 
	    $_SESSION['continuar'] = 1;
	    $_SESSION['gestion'];
	    $_SESSION["menu"] = 44;
	    require 'con_mayor.php';
		 //header('Location: con_mayor.php');
       break;

	   case "4":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		$_SESSION['continuar'] = 1;
		$_SESSION['gestion'];
		$_SESSION["menu"] = 37;
		require 'con_diario.php';
		//header('Location: con_diario.php');
       break;

       //Duplicar reportes para gestiones pasadas
       case "28":
	     // echo "Grabar"; 
	     //  require('garl_grab_fec.php');
		$_SESSION['continuar'] = 1;
		$_SESSION['gestion'];
		$_SESSION["menu"] = 45;
		require 'con_diario.php';
		//header('Location: con_diario.php');
       break;

	   case "5":
	     $_SESSION["tipo_rep"] = 2;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param.php');
       break;
	   case "6":
	     $_SESSION["tipo_rep"] = 3;
	     //  require('garl_grab_fec.php');
		 header('Location: rep_param.php');
       break;
	   case "11":
	      //echo "Retroceder";
	     $_SESSION["tipo"] = 1;
		 $_SESSION["tipo2"] = 2;
		 $_SESSION["menu"] = 31;
		 $_SESSION['gestion'];
		 require 'tipo_rep_cont.php';
		 //header('Location: tipo_rep_cont.php');

	   //Duplicar reportes para gestiones pasadas
		 case "22":
	      //echo "Retroceder";
	     $_SESSION["tipo"] = 1;
		 $_SESSION["tipo2"] = 2;
		 $_SESSION["menu"] = 39;
		 $_SESSION['gestion'];
		 require 'tipo_rep_cont.php';
		 //header('Location: tipo_rep_cont.php');

	   break;
	   case "7":
	    $_SESSION['tipo'] = 1;
	    $_SESSION['continuar'] = 1;
	    $_SESSION["menu"] = 46;
	    //$_SESSION['gestion'];
	    require 'con_mayor_1.php';
		 //header('Location: con_mayor_1.php');
       break;

       //Duplicar reportes para gestiones pasadas
       case "29":
	    $_SESSION['tipo'] = 1;
	    $_SESSION['continuar'] = 1;
	    $_SESSION["menu"] = 49;
	    //$_SESSION['gestion'];
	    require 'con_mayor_1.php';
		 //header('Location: con_mayor_1.php');
       break;

	   case "8":
	    $_SESSION['tipo'] = 2;
	    $_SESSION['continuar'] = 1;
	    $_SESSION["menu"] = 47;
	    //$_SESSION['gestion'];
	     require 'con_mayor_2.php';
		 //header('Location: con_mayor_2.php');
       break;

       //Duplicar reportes para gestiones pasadas
       case "30":
	    $_SESSION['tipo'] = 2;
	    $_SESSION['continuar'] = 1;
	    $_SESSION["menu"] = 50;
	    //$_SESSION['gestion'];
	     require 'con_mayor_2.php';
		 //header('Location: con_mayor_2.php');
       break;

	   case "9":
	    $_SESSION['tipo'] = 3;
	    $_SESSION['continuar'] = 1;
	    $_SESSION["menu"] = 48;
	    //echo $_SESSION["anio"];
	    //$_SESSION['gestion'];
	    require 'con_mayor_3.php';
		 //header('Location: con_mayor_3.php');
       break;
       //Duplicar reportes para gestiones pasadas
       case "31":
	    $_SESSION['tipo'] = 3;
	    $_SESSION['continuar'] = 1;
	    $_SESSION["menu"] = 51;
	    //$_SESSION['gestion'];
	    require 'con_mayor_3.php';
		 //header('Location: con_mayor_3.php');
       break;


	    case "12":
	      //echo "Retroceder";
	     $_SESSION["tipo"] = 3;
		 $_SESSION["tipo2"] = 2;
		 $_SESSION["menu"] = 33;
		 $_SESSION['gestion'];
		 require 'tipo_rep_cont.php';
		 //header('Location: tipo_rep_cont.php');
	   break;

	     //Duplicar reportes para gestiones pasadas
	    case "24":
	      //echo "Retroceder";
	     $_SESSION["tipo"] = 3;
		 $_SESSION["tipo2"] = 2;
		 $_SESSION["menu"] = 41;
		 $_SESSION['gestion'];
		 require 'tipo_rep_cont.php';
		 //header('Location: tipo_rep_cont.php');
	   break;

	   case "13":
	      //echo "Retroceder";
	     $_SESSION["tipo"] = 3;
	     $_SESSION["menu"] = 34;
	     $_SESSION['gestion'];
	     require 'tipo_rep_2.php';
		 //$_SESSION["tipo2"] = 2;
		 //header('Location: tipo_rep_2.php');
	   break;

	   //Duplicar reportes para gestiones pasadas
	    case "25":
	      //echo "Retroceder";
	     $_SESSION["tipo"] = 3;
	     $_SESSION["menu"] = 42;
	     $_SESSION['gestion'];
	     require 'tipo_rep_2.php';
		 //$_SESSION["tipo2"] = 2;
		 //header('Location: tipo_rep_2.php');
	   break;

	    case "14":
	      $_SESSION["tipo2"] = 2;
	     $_SESSION["tipo"] = 4;
	     $_SESSION["menu"] = 35;
	     $_SESSION['gestion'];
		 header('Location: tipo_rep_2.php');
	   break;
	   //Duplicar reportes para gestiones pasadas
	   case "26":
	      $_SESSION["tipo2"] = 2;
	     $_SESSION["tipo"] = 4;
	     $_SESSION["menu"] = 43;
	     $_SESSION['gestion'];
		 header('Location: tipo_rep_2.php');
	   break;
}
?> 
<?php
}
ob_end_flush();
 ?>