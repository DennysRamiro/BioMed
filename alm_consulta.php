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
require_once "lib/Mysql.php";
?>
<html>
<head>
<!--Titulo de la pestaña de la pagina-->
<title>.:INTERSANITAS:.</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
<script type="text/javascript" src="js/Alm_cons.js"></script>
</head>
<body><?php
        include("header.php");
      ?>
	<div id="pagina_sistema">
         
            <ul id="lista_menu">
               <li id="menu_modulo">
                  <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
               </li>
              <li id="menu_modulo_almacen">
                    
                     <img src="img/box_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. ALAMCENES
                    
                 </li>
                  <li id="menu_modulo_registro_clientes">
                    
                     <img src="img/search_32x32.png" border="0" alt="Modulo" align="absmiddle"> CONS. INVENTARIOS
                    
                 </li>
        
           </ul> 
            <div id="contenido_modulo">       
                <h2>  
                      <img src="img/search_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                      CONSULTAR INVENTARIOS 
                </h2>
                <hr style="border:1px dashed #767676;">
                <?php 
                  $mysql = new Mysql();
                  $query = "SELECT alm_prov_id, 
                                   alm_prov_nombre, 
                                   c.Name, 
                                   prov.alm_prov_codigo_ext, 
                                   prov.alm_prov_codigo_int
                            FROM alm_proveedor AS prov, country AS c
                            WHERE prov.alm_prov_pais = c.Code";
                  $resultado_proveedor = $mysql->query($query);                  
                ?>
                <!--form name="form2" method="post" action="cliente_con_m.php"-->
                  <table align="center" class="table_usuario">
                     <tr>
                  	     <th>PROVEEDOR:</th>
                         <td> <select name="id_proveedor" id="id_proveedor" >
                              <?php
                               foreach ($resultado_proveedor as $key => $value) {
                               ?>
                                   <option value="<?php echo $value['prov']['alm_prov_id']; ?>">
                                       <?php echo utf8_encode($value['prov']['alm_prov_nombre']); ?>
                                   </option>
                           <?php  
                               } 
                           ?>
                           </select>
                        </td>
                        <th>PRODUCTO:</th>
                        <?php
                            $query2 = "SELECT alm_prod_id, alm_prod_nombre, alm_prod_serie 
                                       FROM alm_producto 
                                       WHERE alm_prod_estado = 166 OR alm_prod_estado= 167";
                            $resultado_producto = $mysql->query($query2);
                        ?>
                         <td> <select name="id_producto" id="id_producto">
                              <?php
                               foreach ($resultado_producto as $key => $value) {
                               ?>
                                   <option value="<?php echo $value['alm_producto']['alm_prod_id']; ?>">
                                       <?php echo utf8_encode($value['alm_producto']['alm_prod_nombre'])." ".utf8_encode($value['alm_producto']['alm_prod_nombre']); ?>
                                   </option>
                           <?php  
                               } 
                           ?>
                           </select>
                        </td>
                        <th>MARCA:</th>
                        <?php
                            $query3 = "SELECT DISTINCT alm_prod_marca
                                       FROM alm_producto
                                       WHERE alm_prod_estado = 166 OR alm_prod_estado= 167";
                            $resultado_marca = $mysql->query($query3);
                        ?>
                         <td> <select name="nombre_marca" id="nombre_marca">
                              <?php
                               foreach ($resultado_marca as $key => $value) {
                               ?>
                                   <option value="<?php echo $value['alm_producto']['alm_prod_marca']; ?>">
                                       <?php echo utf8_encode($value['alm_producto']['alm_prod_marca']); ?>
                                   </option>
                           <?php  
                               } 
                           ?>
                           </select>
                        </td>
                   </tr>
                    <tr>
                         <th>FECHA ENTRADA:</th>
                         <td> <select name="id_proveedor" id="id_proveedor" >
                              <?php
                               foreach ($resultado_proveedor as $key => $value) {
                               ?>
                                   <option value="<?php echo $value['prov']['alm_prov_id']; ?>">
                                       <?php echo utf8_encode($value['prov']['alm_prov_nombre']); ?>
                                   </option>
                           <?php  
                               } 
                           ?>
                           </select>
                        </td>
                        <th>TIPO:</th>
                        <?php
                            $query2 = "SELECT GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC
                                        FROM gral_param_propios 
                                        WHERE gral_par_pro_grp=1000 AND GRAL_PAR_PRO_COD >= 1";
                            $resultado_producto = $mysql->query($query2);
                        ?>
                         <td> <select name="id_producto" id="id_producto">
                              <?php
                               foreach ($resultado_producto as $key => $value) {
                               ?>
                                   <option value="<?php echo $value['gral_param_propios']['GRAL_PAR_PRO_ID']; ?>">
                                       <?php echo utf8_encode($value['gral_param_propios']['GRAL_PAR_PRO_DESC']); ?>
                                   </option>
                           <?php  
                               } 
                           ?>
                           </select>
                        </td>
                        <td></td>
                        
                         <td> 
                        </td>
                   </tr>
                </table>
                <br>
                <div align="center"><input type="button" value="Consultar en stock" onclick="" class="btn_form"></div>
              <!--/form-->
            </div>
            <div id="tabla_datos_productos">
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