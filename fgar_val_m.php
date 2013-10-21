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
	$fec = leer_param_gral();
?>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
 <script language="javascript" src="script/validarForm.js"></script> 
</head>
<body>	
<div id="cuerpoModulo">
     <?php
	   include("header.php");
 	 ?>
<div id="UserData">
     <img src="images/24x24/001_20.png" border="0" align="absmiddle" alt="Home" />
	 </div>
<div id="Salir">
     <a href="cerrarsession.php"><img src="images/24x24/001_05.png" border="0" align="absmiddle">Salir</a>
</div>
<center>
<div id="TitleModulo">
   	 <img src="images/24x24/001_36.png" border="0" alt="Modulo">			
           Validar Montos
	</div>
<div id="AtrasBoton">
    <a href="solic_mante.php"><img src="images/24x24/001_23.png" border="0" alt="Regresar" align="absmiddle">Atras</a>
</div>
<center>
<div id="GeneralManSolicaa">
<?php

$cod_cta = $_SESSION['cta_fon'];
echo "aqui".$_SESSION['saldo_cta'];
if(isset($_POST['monto'])){  
   $imp = $_POST['monto'];
   $_SESSION['imp'] = $imp;
   }
 if(isset($_POST['descrip'])){  
   $desc = $_POST['descrip'];
   $desc = strtoupper($desc);
   }  
   
 	$_SESSION['saldo_cta'] = round($_SESSION['saldo_cta'],2); 
if ($_SESSION['dep_ret'] == 2){
    echo $_SESSION['saldo_cta']," * ",$imp,"1";  
    if ( $_SESSION['saldo_cta'] < $imp){
       echo $_SESSION['saldo_cta']," +  ",$imp,"2";
//$_SESSION['detalle'] = 1;
       $_SESSION['continuar'] = 2;
       $_SESSION['msg_err'] = "Monto mayor al Saldo";
       echo "Saldo menor"." ".$_SESSION['continuar'];
	   header('Location: fgar_depret.php');
	 //    require 'fgar_depret.php';
	 }
	 if ( $_SESSION['saldo_cta'] == $imp){
	      echo "--- entra---";
	      $cuantos = 0;		
		    
	      $con_cli  = "Select count(*) From cart_maestro, fond_maestro where 
		               FOND_NRO_CTA = $cod_cta 
                       and FOND_NRO_CRED = CART_NRO_CRED  and
			           CART_ESTADO < 9 and 
			           CART_MAE_USR_BAJA is null and FOND_MAE_USR_BAJA is null"; 
           $res_cli = mysql_query($con_cli);
		   while ($lin_trc = mysql_fetch_array($res_cli)) {
              $cuantos =  $lin_trc['count(*)'];
            }
			echo "--- entra---".$cuantos;
		   if ($cuantos >= 0){
		       
		        $_SESSION['continuar'] = 4;
                $_SESSION['msg_err'] = "Saldo queda en Cero ";
	            echo "Saldo queda en Cero"." ".$_SESSION['continuar'];
	           // header('Location: fgar_depret.php');
		   	   // }else{
				$act_est_mae = "update fond_maestro set FOND_ESTADO=9 where
				FOND_NRO_CTA = $cod_cta and FOND_MAE_USR_BAJA is null";
                $res_act_e = mysql_query($act_est_mae);
				$_SESSION['vuelve']	= 2;		   
	            header('Location: fga_imp_dere.php');	  
			}
		}
		 if ( $_SESSION['saldo_cta'] > $imp){
       echo $_SESSION['saldo_cta']," +  ",$imp,"2";
//$_SESSION['detalle'] = 1;
      $_SESSION['vuelve']	= 2;		   
	 header('Location: fga_imp_dere.php');
	 }	
	}
if ($_SESSION['dep_ret'] == 1){				  
	$_SESSION['vuelve']	= 2;		   
	 header('Location: fga_imp_dere.php');
	
     } 
   //}

?>
</font>
</strong>	
<center>	

   <?php
		 	include("footer_in.php");
	 ?> 
<?php
}
ob_end_flush();
 ?>