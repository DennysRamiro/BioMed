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
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script>  
</head>
<body>	<?php
     include("header.php");
   ?>
<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_creditos_reversionsolicitud">
                    
                     <img src="img/clock_32x32.png" border="0" alt="Modulo" align="absmiddle"> SOLICITUD
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle">REVERSION SOLICITUD
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle">REVERTIR SOLICITUD
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/refresh_64x64.png" border="0" alt="Modulo" align="absmiddle"><strong>REVERTIR SOLICITUD </strong> </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Reversion de  Solicitud
        </div>

	
<?php
 //O$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 

<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//if (isset($_SESSION['continuar'])){  
//   if ( $_SESSION['continuar'] == 2) {
//    $cod_s = $_SESSION["cod_sol"];
//    }
//}

if (isset($_POST['cod_sol'])){  
    $quecom = $_POST['cod_sol'];
	}
if (isset($quecom)){  	
   for( $i=0; $i < count($quecom); $i = $i + 1 ) {
      if( isset($quecom[$i]) ) {
         $cod_s = $quecom[$i];
        }
      }
}
?>
<strong>
<?php
echo  "Solicitud  Revertida ". $cod_s. encadenar(2);
$_SESSION["cod_sol"] = $cod_s;
//$_SESSION['msg_err'] = " ";
?>
</strong>
<?php
$con_sol  = "Delete From cred_solicitud where CRED_SOL_CODIGO = $cod_s and CRED_SOL_ESTADO < 8"; 
$res_sol = mysql_query($con_sol);

$con_sol  = "Delete From cred_deudor where CRED_SOL_CODIGO = $cod_s "; 
$res_sol = mysql_query($con_sol);

$con_sol  = "Delete From cred_plandp where CRED_PLD_COD_SOL = $cod_s "; 
$res_sol = mysql_query($con_sol);

 ?>
 </strong>

   </div>
   <?php
		 	include("footer_in.php");
		 ?> 
</body>
</html>
 <?php
}
    ob_end_flush();
 ?>
