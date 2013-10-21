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
<title>Reasignación de Asesor</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
</head>
<body>
<?php
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
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/favorites_24x24.png" border="0" alt="Modulo" align="absmiddle"> REASIGNA CART. ASE.
                    
                 </li>
              </ul>
	
<div id="contenido_modulo">

                      <h2> <img src="img/favorites_64x64.png" border="0" alt="Modulo" align="absmiddle"> REASIGNA CARTERA DE ASESORES</h2>
                      <hr style="border:1px dashed #767676;">
                       
    	

	<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
 $_SESSION['calculo'] = 1; 
?> 
	
<font size="+1">
<?php
//$_SESSION['form_buffer'] = $_POST;
$log_usr = $_SESSION['login']; 
$cod_cre = 0;
$f_cal = "";
$f_has ="";
$mon="";
$cod_ope=0;
$imp_ind = 0;
$imp_cta = 0;
$_SESSION['grupo'] = "";
if(isset($_SESSION['f_has'])){
  $f_has = $_SESSION['f_has'];
  }
 //if(isset($_SESSION["tip_cta"])){
  //  if ($_SESSION["tip_cta"] == 1) {
	    if (isset ($_POST['cod_ase'])){ 
        $cod_ase = $_POST['cod_ase'];
		 $_SESSION['cod_ase'] = $cod_ase;
		 }
		 if (isset ($_POST['cod_ase2'])){ 
        $cod_ase2 = $_POST['cod_ase2'];
		 $_SESSION['cod_ase2'] = $cod_ase2;
		 }
		
	 $con_ase1= "Select * From gral_usuario where GRAL_USR_CODIGO = '$cod_ase' and
                 GRAL_USR_USR_BAJA is null ";
     $res_ase1 = mysql_query($con_ase1);
	 while ($linea1 = mysql_fetch_array($res_ase1)) {
            $cod_a = $linea1['GRAL_USR_LOGIN'];	 
	 }
	 
	 $con_ase2 = "Select * From gral_usuario where GRAL_USR_CODIGO = '$cod_ase2' and
	              GRAL_USR_USR_BAJA is null";	 
	 $res_ase2 = mysql_query($con_ase2);
	 	 while ($linea2 = mysql_fetch_array($res_ase2)) {
            $cod_a2 = $linea2['GRAL_USR_LOGIN'];	 
	 }
		  echo  "Traspaso de cartera".encadenar(2)."de".encadenar(2).
		        $cod_a.encadenar(2)."a".encadenar(2).$cod_a2;
        $con_mae  = "Select *  From  cart_maestro where
		             (CART_OFIC_RESP = '$cod_ase' or CART_OFIC_RESP = '$cod_a') and
					 (CART_ESTADO between 3 and 7) and CART_MAE_USR_BAJA is null"; 
		$res_mae = mysql_query($con_mae);			 
        while ($lin_mae = mysql_fetch_array($res_mae)){
		      $tip_cre =  $lin_mae['CART_TIPO_CRED'];
              $cod_cre = $lin_mae['CART_NRO_CRED'];	
			  if ($tip_cre == 1) { 
			      $act_tabla  = "update cart_maestro set CART_OFIC_RESP = '$cod_a2'
                  where CART_NRO_CRED = $cod_cre and
	                    CART_MAE_USR_BAJA is null ";
                  $res_tabla = mysql_query($act_tabla) ; 
			 }
			   if ($tip_cre == 2) { 
			      $act_tabla  = "update cart_maestro set CART_OFIC_RESP = '$cod_ase2'
                  where CART_NRO_CRED = $cod_cre and
	                    CART_MAE_USR_BAJA is null ";
                  $res_tabla = mysql_query($act_tabla) ; 
			 }
			  
			//  echo "entra aqui".$_SESSION['cod_cli'];
		}
//}	
//	}
//}			  
//$imp_sol = $_SESSION["impo_sol"];
//echo $_SESSION['nro_sol'], "codigo sol";
	     // }?> 
	
	
</form>			
            
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