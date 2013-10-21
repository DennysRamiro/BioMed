<?php
	ob_start();
	session_start();
  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
  } else {

  //if (isset($_POST['ap_pater'])){ // || isset($_POST['ap_mater']) || isset($_POST['ap_espos']) || isset($_POST['nombres'])){
  //  header('Location: cliente_con_cobro.php?menu=13');
 // }else{


 
	   require('configuracion.php');
    require('funciones.php');
?>
<html>
<head>
<title>Consulta Clientes para Cobro</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/fondo_dr_cliente_consultar.js"></script> 
 <script type="text/javascript" src="js/cjas_cart_dir_nom.js"></script>  
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
                 <?php
                if($_GET["menu"]==2){ ?> 
                 <li id="menu_modulo_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret">
                    
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS RETIROS
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret_cliente">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE CLIENTE
                    
                 </li>
                    <li id="menu_modulo_fondo_dep_ret_nomgrou">
                    
                     <img src="img/find_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR  CLIENTE
                    
                 </li>
                    </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle">CONSULTAR CLIENTE </h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          
        </div-->

        <?php } elseif($_GET["menu"]==13){ ?> 
      

                <li id="menu_modulo_cjas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cjas_cartera">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_cjas_cartera_directo">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
                   <li id="menu_modulo_cjas_cartera_directo_pornombre">
                    
                     <img src="img/user_32x32.png" border="0" alt="Modulo" align="absmiddle"> POR NOMBRE CLIENTE
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret_nomgrou">
                    
                     <img src="img/find_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR  CLIENTE
                    
                 </li>
              </ul>  
  
                <div id="contenido_modulo">

                      <h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR  CLIENTE</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
                              <img src="img/alert_32x32.png" align="absmiddle">
                                    Cobro de Creditos
                        </div-->
        <?php } elseif($_GET["menu"]==1){ ?> 
        <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                 <li id="menu_modulo_cartera_cancelados">
                    
                     <img src="img/redo_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONS. CANCELADOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> POR NOMBRE CLIENTE
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret_nomgrou">
                    
                     <img src="img/find_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR  CLIENTE
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">

            <h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR  CLIENTE</h2>
            <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
                              <img src="img/alert_32x32.png" align="absmiddle">
                                    Cobro de Creditos
                                    </div-->

              <?php }
            elseif($_GET["menu"]==0){ ?> 
                 <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONS. OPERACIONES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> POR NOMBRE CLIENTE
                    
                 </li>
                    <li id="menu_modulo_fondo_dep_ret_nomgrou">
                    
                     <img src="img/find_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR  CLIENTE
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">

        <h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR  CLIENTE </h2>
         <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
                              <img src="img/alert_32x32.png" align="absmiddle">
                                    Cobro de Creditos
                                    </div-->
        <?php } ?>
 
				<!-- id="TitleModulo">
	               	<img src="images/24x24/001_35.png" border="0" alt="" /-->   
					<?php
				        if ($_SESSION['cart_fgar'] == 1){
						    echo "Consulta Clientes para Cobro";
							}
						 if ($_SESSION['cart_fgar'] == 2){	
							echo "Consulta Clientes para Transaccion Fondo de Garantia";
							 }
						 if ($_SESSION['cart_fgar'] == 3){
					 		echo "Consulta Clientes con Operaciones Canceladas";
							}	 
					?>
                                

<?php
//echo "entra a grabar";
$_SESSION['form_buffer'] = $_POST;
$consul = 0;
//$cod_cli =$_POST["cod"];
//$cod_grp = $_SESSION["cod_g"];
//echo $cod_grp;
if(isset($_POST['cod_grupo'])){
   $quecom = $_POST['cod_grupo'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_g = $quecom[$i];
    }
   }
 }
 if(isset($_SESSION["cod_g"])){
    $cod_g = $_SESSION["cod_g"];
	}
//$nom_g = $_SESSION["nombre_g"];
$consul = 0;

$nom = $_POST["nombres"]; 
if (empty($nom)) {
     $consul = $consul + 1;
	} else {
	 $nom =  "%".strtoupper($nom)."%";
	 $consulta  = "Select * From cliente_general where CLIENTE_NOMBRES like '$nom' and CLIENTE_USR_BAJA is null order by 9,10,11,8"; 
}
$a_pat = $_POST["ap_pater"];
if (empty($a_pat)) {
    $consul = $consul + 1;
    } else {
	$a_pat = "%".strtoupper($a_pat)."%";

	$consulta  = "Select * From cliente_general where CLIENTE_AP_PATERNO like '$a_pat' and CLIENTE_USR_BAJA is null order by 9,10,11,8"; 
} 
$a_mat = $_POST["ap_mater"]; 
if (empty($a_mat)) {
    $consul = $consul + 1; 
    } else {
	$a_mat = "%".strtoupper ($a_mat)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_MATERNO like '$a_mat' and CLIENTE_USR_BAJA is null order by 9,10,11,8";
} 
$a_esp = $_POST["ap_espos"]; 
if (empty($a_esp)) {
    $consul = $consul + 1; 
    } else {
	$a_esp = "%".strtoupper ($a_esp)."%"; 
	$consulta  = "Select * From cliente_general where CLIENTE_AP_ESPOSO like '$a_esp' and CLIENTE_USR_BAJA is null order by 9,10,11,8";
} 
if ($consul == 4) {
   //echo "Consultara todos";
   $consulta  = "Select * From cliente_general where CLIENTE_USR_BAJA is null order by 9,10,11,8";
 }
?> 
 <?php 
   $resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla');
 ?>



<form name="form2" method="post" action="incorp_cli_grup.php" >

<select name="cod_cliente[]" size="12" style="width: 500px; height:300px" multiple>

  <center>

  <?php   
  while ($linea = mysql_fetch_array($resultado)) {
   ?>
	 <option  value=<?php echo $linea['CLIENTE_COD']; ?>>
		<?php echo $linea['CLIENTE_AP_PATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_MATERNO']; ?>
		<?php echo $linea['CLIENTE_AP_ESPOSO']; ?>
		<?php echo $linea['CLIENTE_NOMBRES']; ?></option>
<?php
   }
 ?>
  </select>
  <br><br>
  <?php if ($_SESSION['cart_fgar'] == 1){  ?>
	  <input class="btn_form" type="submit" name="accion" value="Cobro Directo">
      <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
   <?php } ?>
   <?php if ($_SESSION['cart_fgar'] == 2){  ?>
	  <input class="btn_form" type="submit" name="accion" value="Dep-Ret">
      <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
	   <?php }	?>
    <?php if ($_SESSION['cart_fgar'] == 3){  ?>
	  <input class="btn_form" type="submit" name="accion" value="Consulta">
      <!--input class="btn_form" type="submit" name="accion" value="Salir"-->
	   <?php }	?>	   
  
  
  </form>
</div>

</div>
<?php
		 	include("footer_in.php");
		 ?>
</body>
</html>
<?php
//}
}
ob_end_flush();
 ?>