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
<title>Consultar Proveedores</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="js/Alm_prov_cons.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
<script src="script/jquery-ui.js"></script>

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
                    
                     <img src="img/box_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. ALMACENES
                    
                 </li>
                  <li id="menu_modulo_almacen_prov">
                    
                     <img src="img/provider_24x24.png" border="0" alt="Modulo" align="absmiddle"> PROVEEDORES
                    
                 </li>
              <li id="menu_modulo_fecha_cambio">
                  <?php if (isset($_SESSION['alm_mod'])){
            if ($_SESSION['alm_mod'] == 1){
     ?>    
                   <img src="img/provider_search_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR PROV.
                   
     <?php  }
            if ($_SESSION['alm_mod'] == 2){
      ?> 
                   <img src="img/edit_24x24.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR
                    
     <?php
            }
       if ($_SESSION['alm_mod'] == 3){
      ?> 
                    <img src="img/go_24x24.png" border="0" alt="Modulo" align="absmiddle"> INHABILITAR/HABILITAR
     <?php
            }
  } 
 ?> 
                  
              </li>
           </ul> 
    	
           
            
          

  

<?php
//if(isset($_SESSION['form_buffer']))	{
//	$datos = $_SESSION['form_buffer'];
//}
 ?>
 <div id="contenido_modulo">
   
<h2> 

  <?php if (isset($_SESSION['alm_mod'])){
            if ($_SESSION['alm_mod'] == 1){
     ?>    
                   <img src="img/provider_search_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                   CONSULTAR PROVEEDOR
                    <div id="dialog-confirm" title="Dar de baja producto" style="display:none;">
              <p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja el proveedor?</p>
            </div>  
     <?php  }
            if ($_SESSION['alm_mod'] == 2){
      ?> 
                   <img src="img/edit_64x64.png" border="0" alt="Modulo" align="absmiddle">
                    MODIFICAR
     <?php
            }
       if ($_SESSION['alm_mod'] == 3){
      ?> 
                    <img src="img/go_64x64.png" border="0" alt="Modulo" align="absmiddle">
                    INHABILITAR/HABILITAR
     <?php
            }
  } 
 ?> 

 <?php
     
 ?>


   
            </h2>
            <hr style="border:1px dashed #767676;">

<!-- codigo para un buscador-->
         
            <div id="content">
              <!--form autocomplete="off"-->
                <p>
                   <label>Consultar Proveedor:</label>
                  <input class="txt_campo" type="text" name="proveedor_buscar" id="proveedor_buscar" />
                  <input type="button" value="Buscar Proveedor" class="btn_form" onclick="buscarProveedor();">
                </p>
              <!--/form-->
            </div>
<!-- buscador-->

<!--<form name="form2" method="post" action="cliente_con_m.php"   onSubmit="return ValidaCamposClientes(this)">
 Esta parte es igual que la anterior ya que no se quiere quu se quiere colsultar apesar de que no se ponga dato entonces se tiene que desabilitar el script para mas convenencia-->  




        <!--hr style="border:1px dashed #767676;"-->
        

        <div id="tabla_datos_proveedores">
        <table   class="table_usuario">

                <tr>
                    <th align="center">Nombre</th>
                    <th align="center">Tipo</th>
                    <th align="center">Codigo Externo</th>
                    <th align="center">Codigo Interno</th>
                    <th align="center">Pais</th>
                    <th align="center">Ciudad</th>
                    <th align="center">Direccion</th>
                    <th align="center">Telefono</th>
                    <th align="center">Celular</th>
                    <th align="center">Estado</th>
                    <th align="center">Acciones</th>  
                </tr>
     <!--?php if($_GET["menu"]==1){?--> 
                    <?php
                    $consulta  = "SELECT * 
                                  FROM alm_proveedor  
                                  WHERE  ISNULL(alm_prov_usr_baja)
                                  ORDER BY  alm_prov_nombre";
                    $resultado = mysql_query($consulta);
                     while ($linea = mysql_fetch_array($resultado)) {
                                         ?>
                             
                  <tr class="tr_usuario">
                    <td align="center"><?php echo $linea['alm_prov_nombre']; ?></td>
                    <td align="center"><?php
                    $consulta_tipo  = "Select * 
                                       From gral_param_propios 
                                       where GRAL_PAR_PRO_GRP = 1400 and GRAL_PAR_PRO_COD <> 0  AND GRAL_PAR_PRO_COD='".$linea['alm_prov_tipo']."'";
                    $resultado_tipo = mysql_query($consulta_tipo);
                    $tipo = mysql_fetch_array($resultado_tipo);
                     echo $tipo['GRAL_PAR_PRO_DESC']; ?><input type="hidden" value="<?php echo $tipo['GRAL_PAR_PRO_COD'];?>" id="id_tipo_proveedor"></td></td>
                    <td align="center"><?php echo $linea['alm_prov_codigo_ext']; ?></td>
                    <td align="center"><?php echo $linea['alm_prov_codigo_int']; ?></td>
                    <td align="center"><?php 
                    $consulta_pais  = "Select Code, Name 
                                       From country  
                                       where Code='".$linea['alm_prov_pais']."' order by Name";
                    $resultado_pais = mysql_query($consulta_pais);
                    $pais = mysql_fetch_array($resultado_pais);
                    echo utf8_encode($pais['Name']); ?></td>
                    <td align="center"><?php 
                    $consulta_ciudad  = "Select ID, Name 
                                         From city  
                                         where ID='".$linea['alm_prov_ciudad']."' order by Name";
                    $resultado_ciudad= mysql_query($consulta_ciudad);
                    $ciudad = mysql_fetch_array($resultado_ciudad);
                    echo utf8_encode($ciudad['Name']); ?></td>
                    <td align="center"><?php echo $linea['alm_prov_direccion']; ?></td>
                    <td align="center"><?php echo $linea['alm_prov_telefono']; ?></td>
                    <td align="center"><?php echo $linea['alm_prov_celular']; ?></td>
                    <td align="center"><?php 
                    $consulta_eprov  = "Select * 
                                        From gral_param_propios 
                                        where GRAL_PAR_PRO_GRP = 1200 and GRAL_PAR_PRO_COD <> 0 and GRAL_PAR_PRO_COD <> 2 AND GRAL_PAR_PRO_COD='".$linea['alm_prov_estado']."'";
                    $resultado_eprov = mysql_query($consulta_eprov);
                    $estado = mysql_fetch_array($resultado_eprov);
                    echo $estado['GRAL_PAR_PRO_DESC']; ?></td>
                    <!--td><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px;"><a href="alm_detallar_prod.php?id_producto=<?php echo $linea['alm_prod_id'];?>" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:40px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo(<?php echo $linea['alm_prod_id'];?>)"><img src="img/delete box_32x32.png"><br> Dar de Baja</a></div> </td-->
                    <td><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px;"><a href="alm_detallar_proveedor.php?id_proveedor=<?php echo $linea['alm_prov_id'];?>" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:40px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo(<?php echo $linea['alm_prov_id'];?>)"><img src="img/provider_baja_32x32.png"><br> Dar de Baja</a></div> </td>
                   </td>
                    
                   
                 </tr>
       

       <?php }?>
</table>
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