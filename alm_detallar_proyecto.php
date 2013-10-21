<?php
ob_start();
session_start();
  if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
    header("Location: index.php?error=1");
} else {
  require('configuracion.php');
  require('funciones.php');
?>
<html>
<head>
<!--Titulo de la pestaña de la pagina-->
<title>INTERSANITAS</title>
        <meta charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <!--link href="css/calendar.css" rel="stylesheet" type="text/css"-->
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <!--script language="JavaScript" src="script/calendar_us.js"></script-->
        <script language="javascript" src="script/validarForm.js"></script> 
         <!--script type="text/javascript" src="js/ClienteManteDetalle.js"></script-->  
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
        <script type="text/javascript" src="js/Alm_prov_alt.js"></script>
        <script type="text/javascript" src="js/Utilitarios.js"></script>
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
               <li id="menu_modulo_almacen">
                    
                     <img src="img/box_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. ALMACENES
                    
                 </li>
                  <li id="menu_modulo_almacen_prov">
                    
                     <img src="img/proyecto_24x24.png" border="0" alt="Modulo" align="absmiddle"> PROYECTOS
                    
                 </li>
                 <li id="menu_modulo_almacen_prov_cons">
                    <img src="img/proyecto_buscar_24x24.png" border="0" alt="Modulo" align="absmiddle">CONSULTA PROY.
                </li>
                 <li id="menu_alta_prod">
                    <img src="img/notepad_24x24.png" border="0" alt="Modulo" align="absmiddle">DETALLAR PROYECTO
                </li>
              </ul> 
  <div id="contenido_modulo">

    <?php
    $idproy=$_GET['id_proyecto']; 
        $consulta = "select * from alm_proyecto 
                     where alm_proY_id=".$_GET['id_proyecto'];  
                     
        $res = mysql_query($consulta);
        $Proyecto = mysql_fetch_array($res);
      ?>
     <h2>
      <div id="dialog-confirm" title="Dar de baja proyecto" style="display:none;">
          <p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja al proyecto</p>
      </div>  
      <img src="img/notepad_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                DETALLAR PROYECTO <?php echo $Proyecto['alm_proy_nom'];?>
      </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="alm_modificar_prov.php?id_proveedor=<?php echo $idproy;?> "; >
      <table align="center">
        <br>
           <tr>
              <td><font  color="#990033" >Nombre Proyecto:</font></td>
              <td> <input type="text" id="nombres" name="nombres" value="<?php echo $Proyecto['alm_proy_nom'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proyecto['alm_proy_id'];?>" id="id_proyecto_almacen"> 
                   <div id="error_nombres"></div>
              </td>
            </tr>
            <!--tr>
              <td><font  color="#990033" >C&oacute;digo Proyecto:</font></td>
              <td> <input type="text" id="cod_proy" name="cod_proy" value="<?php echo $Proyecto['alm_proy_cod'];?>" class="txt_campo" required> 
                   <div id="error_cod_proy"></div>
              </td>
            </tr-->
          <tr>
            <td><font  color="#990033" >Tipo :  </td>
            <td><select name="tipo" id="tipo" size="1" size="10" >
              <?php
                   $consulta_tipo = "Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_COD
                                     From gral_param_propios 
                                     where GRAL_PAR_PRO_GRP = 1500 and GRAL_PAR_PRO_COD <> 0"; 
                  $resultado_tipo = mysql_query($consulta_tipo);
                   while ($tipo = mysql_fetch_array($resultado_tipo)) {


                      if($tipo['GRAL_PAR_PRO_COD'] == $Proyecto['alm_proy_tipo']){
                  ?>
                      <option value=<?php echo $tipo['GRAL_PAR_PRO_COD']; ?> selected>
                           <?php echo $tipo['GRAL_PAR_PRO_DESC']; ?>
                      </option>
                  <?php
                      }else{
                  ?>
                       <option value=<?php echo $tipo['GRAL_PAR_PRO_COD'];?>>
                           <?php echo $tipo['GRAL_PAR_PRO_DESC'];?>
                       </option>
                  <?php
                      }
                 ?>

               <?php  
                   } 
               ?>

               </select>
               <tr>
              <td><font  color="#990033" >Fecha Inicio:</font></td>
              <td> <input type="text" id="datepicker" name="fec_ini" value="<?php echo $Proyecto['alm_proy_fecha_inicio'];?>" class="txt_campo" required> 
                   <div id="error_fec_ini"></div>
              </td>
            </tr>
            <tr>
              <td><font  color="#990033" >Fecha Fin:</font></td>
              <td> <input type="text" id="datepicker2" name="fec_fin" value="<?php echo $Proyecto['alm_proy_fecha_fin'];?>" class="txt_campo" required> 
                   <div id="error_fec_fin"></div>
              </td>
            </tr>



             </td>
           </tr>

           <tr>
              <td><font  color="#990033" >Descripci&oacute;n:</font></td>
              <td><textarea  name="desc" id="desc" cols="50" rows="2"><?php echo $Proyecto['alm_proy_descripcion'];?></textarea>            
                   <div id="error_desc"></div>
             </td>
          </tr>

      </table>
      <BR>
      <center>  <input class="btn_form" type="submit" name="accion" value="Modificar Proyecto">
                <input class="btn_form" type="button"  name="accion" value="Dar de Baja Proyecto" onclick="mostrarDialogo()">
                <input class="btn_form" type="button"  name="accion" value="Cancelar" onclick="regresarLista()">
      </center>
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