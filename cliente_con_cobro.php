<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
	require_once('configuracion.php');
    require_once('funciones.php');
?>
<html>
<head>
  <!--Titulo de la pestaña de la pagina-->
<title>Consulta Clientes</title>
<meta charset="UTF-8">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>
 
          <link href="css/estilo.css" rel="stylesheet" type="text/css" />
          <script type="text/javascript" src="js/Modulo_fondo.js"></script>  
          <script type="text/javascript" src="js/ModulosCartera.js"></script> 
          
          <script type="text/javascript" src="js/cjas_cart_dir_nom.js"></script> 
<<<<<<< .mine

<script type="text/javascript">
    function verificar()
    {
           x=document.form2
          txt=x.ap_pater.value
          if (x.ap_pater.value.length=="") {
            alert("Debe ingresar datos para continuar");
            //header("Location: cobros_op_2.php?accion=102");
            //cation.href="cobros_op_2.php?accion=102";
            //window.location="cobros_op_2.php?accion=102";
            return false;
          }else{
            document.form2.submit();
          }

          /*
        if (txt>=1 && txt<=5){
          return true
        } else {
          if (txt < 1) alert("Es menor que 1, debe estar entre 1 y 5")
          else if (txt > 1) alert("Es mayor que 5, debe estar entre 1 y 5")
          else alert("No es válido, debe estar entre 1 y 5")
          return false
        }*/
    }
    </script>
=======
          
>>>>>>> .r6
</head>

<body><?php

				include("header.php");
			?>

<div id="pagina_sistema">
<!--Menu izquierdo de los modulos-->        
        <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>



<?php
if($_GET["menu"]==1){?> 
                 <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                 <li id="menu_modulo_cartera_cancelados">
                    
                     <img src="img/redo_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONS. CANCELADOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> POR NOMBRE CLIENTE
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">

<h2> <img src="img/user office_64x64.png" border="0" alt="Modulo" align="absmiddle"> POR NOMBRE CLIENTE</h2>

<?php } elseif($_GET["menu"]==13){?> 
                        

                <li id="menu_modulo_cjas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cjas_cartera">
                    
                     <img src="img/my documents_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_cjas_cartera_directo">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
                   <li id="menu_modulo_fecha">
                    
                     <img src="img/user_32x32.png" border="0" alt="Modulo" align="absmiddle"> POR NOMBRE CLIENTE
                    
                 </li>
              </ul>  
  
                <div id="contenido_modulo">

                      <h2> <img src="img/user_64x64.png" border="0" alt="Modulo" align="absmiddle"> POR NOMBRE CLIENTE</h2>
                      <hr style="border:1px dashed #767676;">
                       <!--div id="error_login"> 
                              <img src="img/alert_32x32.png" align="absmiddle">
                                    Cobro de Creditos
                        </div-->

<?php }
elseif($_GET["menu"]==0){?> 
                 <li id="menu_modulo_general">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONS. OPERACIONES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> POR NOMBRE CLIENTE
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">

<h2> <img src="img/user office_64x64.png" border="0" alt="Modulo" align="absmiddle"> </h2>

<?php
           //$fec = leer_param_gral();
           $logi = $_SESSION['login']; 
        ?>
       
            
    <?php
           if ($_SESSION['cart_fgar'] == 2){
              echo "Consulta Clientes para Transaccion Fondo de Garantia";
              ?>
              
    <?php
              }
              
   if ($_SESSION['cart_fgar'] == 3){
              echo "Consulta Clientes con Operaciones Canceladas";
              ?>
              
    <?php
              }
              ?>

<?php } elseif($_GET["menu"]==2){?> 
                 <li id="menu_modulo_general_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                    
                 </li>
                 <li id="menu_modulo_deposito_retiro">
                    
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS RETIROS
                    
                 </li>
                  <li id="menu_modulo_fondo_cliente">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE CLIENTE
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">

<h2> <img src="img/user office_64x64.png" border="0" alt="Modulo" align="absmiddle" > 
<?php } ?>



<?php
           //$fec = leer_param_gral();
           $logi = $_SESSION['login']; 

           if ($_SESSION['cart_fgar'] == 2){
              echo "Consulta Clientes para Transaccion Fondo de Garantia";
           }
              
            if ($_SESSION['cart_fgar'] == 3){
              echo "Consulta Clientes con Operaciones Canceladas";
            }
?>


</h2>
<!--h2> <img src="img/user office_64x64.png" border="0" alt="Modulo" align="absmiddle">POR NOMBRE DE CLIENTE</h2-->

                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Ingrese los datos generales del Cliente que desea cobrar.
        </div>
	

<br>
<?php
 if(isset($datos['imp_sol'])){
$datos = $_SESSION['form_buffer'];
}
 ?>

<!--<<form name="form2" method="post" action="cliente_retro_grup.php" target="_self" onSubmit="return ValidaCamposClientes(this)">-->
<?php
if($_GET["menu"]==1){?> 
<form name="form2" method="post" action="cliente_con_cobd.php?menu=1" onsubmit="return verificar()">
<?php } elseif($_GET["menu"]==13){?> 
<form name="form2" method="post" action="cliente_con_cobd.php?menu=13" onsubmit="return verificar()">
<?php } elseif($_GET["menu"]==0){?> 
<form name="form2" method="post" action="cliente_con_cobd.php?menu=0" onsubmit="return verificar()">
<?php } elseif($_GET["menu"]==2){?> 
<form name="form2" method="post" action="cliente_con_cobd.php?menu=2" onsubmit="return verificar()">
<?php } ?>




  <strong>  Apellido Paterno   </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ap_pater" size="10" value="<?=$datos['ap_pater'];?>" > 
  <?php }else{?>
        <input class="txt_campo" type="text" name="ap_pater" size="10" value="" > 
  <?php }?> 
  <strong>  Apellido Materno   </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ap_mater" size="10" value="<?=$datos['ap_mater'];?>"  >
  <?php }else{?>
        <input class="txt_campo" type="text" name="ap_mater" size="10" value=""  >
  <?php }?> 
   <BR><br>
  <strong>  Apellido Esposo   </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo" type="text" name="ap_espos" size="10" value="<?=$datos['ap_espos'];?>"  >
    <?php }else{?>
	    <input class="txt_campo" type= type="text" name="ap_espos" size="10" value=""  >
  <?php }?> 
  <strong>  Nombres   </strong>
  <?php if(isset($datos['imp_sol'])){?>
        <input class="txt_campo"  type="text" name="nombres" size="10" value="<?=$datos['nombres'];?>"> 
  <?php }else{?>
        <input class="txt_campo"  type="text" name="nombres" size="10" value=""> 
  <?php }?> 
  <br>
    <input class="btn_form" type="submit" name="accion" value="Consultar" >
</form>
</div>

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