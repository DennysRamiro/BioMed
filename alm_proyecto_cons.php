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
<script type="text/javascript" src="js/Alm_proy_cons.js"></script>
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
                  <li id="menu_modulo_almacen_proy">
                    
                     <img src="img/proyecto_24x24.png" border="0" alt="Modulo" align="absmiddle"> PROYECTOS
                    
                 </li>
              <li id="menu_modulo_fecha_cambio">
            
                   <img src="img/proyecto_buscar_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONSULTAR PROY
                  
              </li>
           </ul> 

                <div id="contenido_modulo">
   
                <h2>   
                <img src="img/proyecto_buscar_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                   CONSULTAR PROYECTO
                    <div id="dialog-confirm" title="Dar de baja producto" style="display:none;">
              <p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja el proyecto?</p>
            </div>  
            </h2>
            <hr style="border:1px dashed #767676;">

<!-- codigo para un buscador-->
         
            <div id="content">
              <!--form autocomplete="off"-->
                <p>
                   <label>Consultar Proyecto:</label>
                  <input class="txt_campo" type="text" name="proyecto_buscar" id="proyecto_buscar" />
                  <input type="button" value="Buscar Proyecto" class="btn_form" onclick="buscarProyecto();">
                </p>
              <!--/form-->
            </div>
<!-- buscador-->

<!--<form name="form2" method="post" action="cliente_con_m.php"   onSubmit="return ValidaCamposClientes(this)">
 Esta parte es igual que la anterior ya que no se quiere quu se quiere colsultar apesar de que no se ponga dato entonces se tiene que desabilitar el script para mas convenencia-->  




        <!--hr style="border:1px dashed #767676;"-->
        

        <div id="tabla_datos_proyectos">
        <table   class="table_usuario">

                <tr>
                    <th align="center">Nombre Proyecto</th>
                    <th align="center">Codigo Proyecto</th>
                    <th align="center">Tipo</th>
                    <th align="center">Fecha Inicio</th>
                    <th align="center">Fecha Fin</th>
                    <th align="center">Estado</th>
                    <th align="center">Acciones</th>  
                </tr>
     <!--?php if($_GET["menu"]==1){?--> 
                    <?php
                    $consulta  = "select * from  alm_proyecto where  ISNULL(alm_proy_usr_baja)";
                    $resultado = mysql_query($consulta);
                     while ($linea = mysql_fetch_array($resultado)) {
                                         ?>
                             
                  <tr class="tr_usuario">
                    <td align="center"><?php echo $linea['alm_proy_nom']; ?></td>
                    <td align="center"><?php echo $linea['alm_proy_cod']; ?></td>
                    <td align="center"><?php
                    $consulta_tipo  = "Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_COD
                                       From gral_param_propios 
                                       where GRAL_PAR_PRO_GRP = 1500 and GRAL_PAR_PRO_COD <> 0  AND GRAL_PAR_PRO_COD='".$linea['alm_proy_tipo']."'";
                    $resultado_tipo = mysql_query($consulta_tipo);
                    $tipo = mysql_fetch_array($resultado_tipo);
                     echo $tipo['GRAL_PAR_PRO_DESC']; ?><input type="hidden" value="<?php echo $tipo['GRAL_PAR_PRO_COD'];?>" id="id_tipo_proyecto"></td></td>
                    <td align="center"><?php echo $linea['alm_proy_fecha_inicio']; ?></td>
                    <td align="center"><?php echo $linea['alm_proy_fecha_fin']; ?></td>
                    <td align="center"><?php 
                    $consulta_eprov  = "Select * 
                                        From gral_param_propios 
                                        where GRAL_PAR_PRO_GRP = 1700 and GRAL_PAR_PRO_COD=1 AND GRAL_PAR_PRO_COD='".$linea['alm_proy_estado']."'";
                    $resultado_eprov = mysql_query($consulta_eprov);
                    $estado = mysql_fetch_array($resultado_eprov);
                    echo $estado['GRAL_PAR_PRO_DESC']; ?></td>
                    <td><div style="float:left;border:1px solid #999; width:42px; text-align:center; margin-left:0px; margin-right:2px;"><a href="alm_detallar_proyecto.php?id_proyecto=<?php echo $linea['alm_proy_id'];?>" ><img src="img/notepad_32x32.png" align="absmiddle"><br> Detallar</a></div><div style="float:left;border:1px solid #999; width:40px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo(<?php echo $linea['alm_prov_id'];?>)"><img src="img/proyecto_baja_32x32.png"><br> Dar de Baja</a></div> </td>
                   
                    
                   
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