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
<!--Titulo de la pestaña de la pagina-->
<title>Mantenimiento Grupos</title>
          <meta charset="UTF-8">
          <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
          <link href="css/estilo.css" rel="stylesheet" type="text/css">
          <script language="JavaScript" src="script/calendar_us.js"></script>
          <script language="javascript" src="script/validarForm.js"></script> 
          <script type="text/javascript" src="js/fondo_dr_nombre.js"></script>
          <script type="text/javascript" src="js/cajas_cobros_cart_dir_group.js"></script> 
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
		  
</head>
<body>	

	<?php

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
                 <li id="menu_modulo_general">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/officer_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/new_32x32.png" border="0" alt="Modulo" align="absmiddle"> HOJA DE COBROS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/users group_24x24.png" border="0" alt="Modulo" align="absmiddle"> POR NOMBRE DE GRUPO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/users group_64x64.png" border="0" alt="Modulo" align="absmiddle">POR NOMBRE DE GRUPO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Elija el Grupo para modificar
        </div>


        <?php } elseif($_GET["menu"]==2){?> 

            <li id="menu_modulo_fondo">
                    
                     <img src="img/open document_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. FONDO GARANTIA
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret">
                    
                     <img src="img/refresh_32x32.png" border="0" alt="Modulo" align="absmiddle"> DEPOSITOS RETIROS
                    
                 </li>
                  <li id="menu_modulo_fondo_dep_ret_nomgroup">
                    
                     <img src="img/users group_24x24.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/users group_64x64.png" border="0" alt="Modulo" align="absmiddle">POR NOMBRE DE GRUPO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Elija el Grupo para modificar
        </div>

      <?php } elseif($_GET["menu"]==3){?> 

            <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_cartera_cancelados">
                    
                     <img src="img/redo_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONS. CANCELADOS
                    
                 </li>
                  <li id="menu_modulo_fondogrupo">
                    
                     <img src="img/users group_24x24.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/users group_64x64.png" border="0" alt="Modulo" align="absmiddle">POR NOMBRE DE GRUPO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Elija el Grupo para modificar
        </div>

        <?php } elseif($_GET["menu"]==13){?> 

            <li id="menu_modulo_general_cajas">
                    
                     <img src="img/fax_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CAJAS
                    
                 </li>
                  <li id="menu_modulo_cajas_cob">
                    
                     <img src="img/my documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> COBROS CARTERA
                    
                 </li>
                 <li id="menu_modulo_cajas_cob_group">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> DIRECTO
                    
                 </li>
                  <li id="menu_modulo_fondogrupo">
                    
                     <img src="img/users group_24x24.png" border="0" alt="Modulo" align="absmiddle"> NOMBRE DE GRUPO
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
                      <h2> <img src="img/users group_64x64.png" border="0" alt="Modulo" align="absmiddle">POR NOMBRE DE GRUPO </h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Elija el Grupo para modificar
        </div>

        <?php } ?>

<?php
 //$fec = leer_param_gral();
 $logi = $_SESSION['login']; 
?> 
<center>



<center>
<?php
//$datos = $_SESSION['form_buffer'];
 ?>

 
<form name="form2" method="post" action="grupo_retro_um.php"  onsubmit="return verificar()">
<table align="center">
<tr>   
		<td> Nombre Grupo </td>
		 <td> <input class="txt_campo" type= "text" name="nomb_g"></td>
   </tr>
   <tr>
 <td> C&oacute;digo Grupo </td>
		 <td> <input class="txt_campo" type= "text" name="cod"></td>
  
 </tr>
     <td></td>
     <?php
if($_GET["menu"]==1){?> 
     <td><input class="btn_form" type="submit" name="accion" value="Seleccionar_cred"></td>
<?php } elseif($_GET["menu"]==2){?> 
     <td><input class="btn_form" type="submit" name="accion" value="Seleccionar_fondo"></td>

<?php } elseif($_GET["menu"]==3){?> 
      <td><input class="btn_form" type="submit" name="accion" value="Seleccionar_cart"></td>
<?php } elseif($_GET["menu"]==13){?> 
      <td><input class="btn_form" type="submit" name="accion" value="Seleccionar_cjas"></td>
<?php } ?>
	 <!--td><input class="btn_form" type="submit" name="accion" value="Salir"></td-->
  </tr>
    
</table>
</form>
</div>      
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