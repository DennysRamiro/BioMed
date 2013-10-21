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
                    
                     <img src="img/provider_24x24.png" border="0" alt="Modulo" align="absmiddle"> PROVEEDORES
                    
                 </li>
                 <li id="menu_modulo_almacen_prov_cons">
                    <img src="img/provider_search_24x24.png" border="0" alt="Modulo" align="absmiddle">CONSULTA PROV.
                </li>
                 <li id="menu_alta_prod">
                    <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle">DETALLAR PROVEEDOR
                </li>
              </ul> 
  <div id="contenido_modulo">

    <?php
    $idprov=$_GET['id_proveedor']; 
        $consulta = "select *  from alm_proveedor 
                     where alm_prov_id=".$_GET['id_proveedor']." and alm_prov_usr_baja is null";  
                     
        $res = mysql_query($consulta);
        $Proveedor = mysql_fetch_array($res);
      ?>
     <h2>
      <div id="dialog-confirm" title="Dar de baja proveedor" style="display:none;">
          <p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja al proveedor</p>
      </div>  
      <img src="img/open document_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                DETALLAR PROVEEDOR <?php echo $Proveedor['alm_prov_nombre'];?> <br>
             <?php echo encadenar(11).$Proveedor['alm_prov_codigo_int'];?> <?php echo $Proveedor['alm_prov_nombre'];?>
      </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="alm_modificar_prov.php?id_proveedor=<?php echo $idprov;?> "; >
      <table align="center">
        <br>
           <tr>
              <td><font  color="#990033" >Nombre Proveedor:</font></td>
              <td> <input type="text" id="nombres" name="nombres" value="<?php echo $Proveedor['alm_prov_nombre'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"><input type="hidden" value="<?php echo $Proveedor['alm_prov_numerico'];?>" id="id_proveedor_num" name="id_proveedor_num"> 
                   <div id="error_nombres"></div> 
              </td>
            </tr>
          <tr>
            <td>Tipo :  </td>
            <td><select name="tipo" id="tipo" size="1" size="10" >
              <?php
                   $consulta_tipo = "Select GRAL_PAR_PRO_DESC, GRAL_PAR_PRO_ID, GRAL_PAR_PRO_COD
                                From gral_param_propios where GRAL_PAR_PRO_GRP = 1400 and GRAL_PAR_PRO_COD <> 0"; 
                  $resultado_tipo = mysql_query($consulta_tipo);
                   while ($tipo = mysql_fetch_array($resultado_tipo)) {


                      if($tipo['GRAL_PAR_PRO_COD'] == $Proveedor['alm_prov_tipo']){
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
              <td><font  color="#990033" >C&oacute;digo Externo:</font></td>
              <td> <input type="text" id="cod_ext" name="cod_ext" value="<?php echo $Proveedor['alm_prov_codigo_ext'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"> 
                   <div id="error_cod_ext"></div>
              </td>
            </tr>
            <tr>
              <td><font  color="#990033" >C&oacute;digo Interno:</font></td>
              <td> <input type="text" id="cod_int" name="cod_int" value="<?php echo $Proveedor['alm_prov_codigo_int'];?>" class="txt_campo" required readonly> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"> 
                   <div id="error_cod_int"></div>
              </td>
            </tr>



             </td>
           </tr>
           <tr>
                <td><font  color="#990033" >Moneda:</font></td>
                <td> <select name="moneda" id="moneda" size="1" size="10" >
                     <?php
                     $consulta_mon = "Select GRAL_PAR_INT_DESC, GRAL_PAR_INT_ID, GRAL_PAR_INT_COD From gral_param_super_int where GRAL_PAR_INT_GRP= 18 and GRAL_PAR_INT_COD <> 0";
                      $mon_res = mysql_query($consulta_mon);
                      
                      while ($mon = mysql_fetch_array($mon_res)) {    
                          if($mon['GRAL_PAR_INT_COD'] == $Proveedor['alm_prov_moneda']){
                     ?>
                              <option value=<?php echo $mon['GRAL_PAR_INT_COD']; ?> selected>
                              <?php echo $mon['GRAL_PAR_INT_DESC'];?></option>

                   <?php
                          }else{
                      ?>
                              <option value=<?php echo $mon['GRAL_PAR_INT_COD']; ?>>
                              <?php echo $mon['GRAL_PAR_INT_DESC']; ?></option>
                       <?php
                          }
                        } 
                     ?>
                   </select >
                </td>
           </tr>
           <tr>
                <td><font  color="#990033" >Continente:</font></td>
                <td> <select name="continente" id="continente" size="1" size="10" >
                     <?php
                     $consulta_cont = "select Cont_id, Name from continent";
                      $cont_res = mysql_query($consulta_cont);
                      while ($cont = mysql_fetch_array($cont_res)) {

                          if($cont['Cont_id'] == $Proveedor['alm_prov_continente']){
                     ?>
                              <option value=<?php echo $cont['Cont_id']; ?> selected>
                              <?php echo $cont['Name']; ?></option>
                   <?php
                          }else{
                      ?>
                              <option value=<?php echo $cont['Cont_id']; ?>>
                              <?php echo $cont['Name']; ?></option>
                       <?php
                          }
                        } 
                     ?>
                   </select >
                </td>
           </tr>
           <tr>
                <td><font  color="#990033" >Pa&iacute;s:</font></td>
                <td> <select name="pais" id="pais" size="1" size="10" >
                     <?php
                     $consulta_pais = "select Code, Name from country order by Name";
                      $pais_res = mysql_query($consulta_pais);
                      while ($pais = mysql_fetch_array($pais_res)) { 

                        if($pais['Code'] == $Proveedor['alm_prov_pais']){
                          ?>
                   <option value=<?php echo utf8_encode($pais['Code']); ?> selected>
                   <?php echo utf8_encode($pais['Name']); ?></option>
                   <?php
                      } else {
                      ?>
                   <option value=<?php echo $pais['Code']; ?>>
                  <?php echo utf8_encode ($pais['Name']); ?></option>
                       <?php
                          }
                        } 
                     ?>
                   </select >
              </td>
           </tr>
           <tr>
                <td><font  color="#990033" >Ciudad:</font></td>
                <td> <select name="ciudad" id="ciudad" size="1" size="10" >
                     <?php
                     $consulta_ciudad = "select ID, Name from city order by Name";
                      $ciudad_res = mysql_query($consulta_ciudad);
                      while ($ciu = mysql_fetch_array($ciudad_res)) {
                        if($ciu['ID'] == $Proveedor['alm_prov_ciudad']){
                      ?>
               
                      <option value=<?php echo utf8_encode($ciu['ID']); ?> selected>
                       <?php echo utf8_encode($ciu['Name']); ?></option>
                       <?php
                          } else {
                          ?>
                      <option value=<?php echo $ciu['ID']; ?>>
                              <?php echo utf8_encode($ciu['Name']); ?></option>
                       <?php
                          }
                        } 
                     ?>
                   </select >
                </td>
           </tr>
           <tr>
               <td><font  color="#990033" >Direcci&oacute;n:</font></td>
                <td> <input type="text" id="direc" name="direc" value="<?php echo $Proveedor['alm_prov_direccion'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"> 
                   <div id="error_direc"></div>
               </td>
          </tr>
           <tr>
               <td><font  color="#990033" >Tel&eacute;fono Fijo :</font></td>
                <td> <input type="text" id="fono" name="fono" value="<?php echo $Proveedor['alm_prov_telefono'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"> 
                   <div id="error_fono"></div>
               </td>
          </tr>
           <tr>
               <td><font  color="#990033" >Tel&eacute;fono Celular :</font></td>
                <td> <input type="text" id="celu" name="celu" value="<?php echo $Proveedor['alm_prov_celular'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"> 
                   <div id="error_celu"></div>
               </td>
          </tr>
          <tr>
               <td><font  color="#990033" >Email :</font></td>
                <td> <input type="text" id="email" name="email" value="<?php echo $Proveedor['alm_prov_email'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"> 
                   <div id="error_email"></div>
               </td>
          </tr>
          <tr>
               <td>Fax :</font></td>
                <td> <input type="text" id="fax" name="fax" value="<?php echo $Proveedor['alm_prov_fax'];?>" class="txt_campo" > <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"> 
                   <div id="error_fax"></div>
               </td>
          </tr>
          <tr>
               <td><font  color="#990033" >Nombre Contacto :</font></td>
                <td> <input type="text" id="contacto" name="contacto" value="<?php echo $Proveedor['alm_prov_contacto'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"> 
                   <div id="error_contacto"></div>
               </td>
          </tr>

           <tr>
               <td>Email Contacto :</font></td>
                <td> <input type="text" id="email_cont" name="email_cont" value="<?php echo $Proveedor['alm_prov_email_cont'];?>" class="txt_campo"> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen"> 
                   <div id="error_email_cont"></div>
               </td>
          </tr>
          <tr>
              <td>Nombre Banco :</td>
              <td> <input type="text" id="nom_bco" name="nom_bco" value="<?php echo $Proveedor['alm_prov_nom_banco'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen">  
           </td>
		    <tr>
              <td>Nombre Cuenta Banco :</td>
              <td> <input type="text" id="nom_cta_bco" name="nom_cta_bco" value="<?php echo $Proveedor['alm_prov_cod_banco'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen">
           </td>
		   <tr>
              <td>Numero Cuenta Banco :</td>
              <td> <input type="text" id="nro_cta_bco" name="nro_cta_bco" value="<?php echo $Proveedor['alm_prov_cod_cta'];?>" class="txt_campo" required> <input type="hidden" value="<?php echo $Proveedor['alm_prov_id'];?>" id="id_proveedor_almacen">
           </td>
           <tr>
                <td><font  color="#990033" >Estado:</font></td>
                <td> <select name="estado" id="estado" size="1" size="10" >
                     <?php
                     $consulta_est = "Select GRAL_PAR_PRO_ID, GRAL_PAR_PRO_DESC , GRAL_PAR_PRO_COD From gral_param_propios where GRAL_PAR_PRO_GRP = 1200 and GRAL_PAR_PRO_COD <> 0 and GRAL_PAR_PRO_COD <> 2";
                      $est_res = mysql_query($consulta_est);
                      while ($est = mysql_fetch_array($est_res)) {

                      if($est['GRAL_PAR_PRO_COD'] == $Proveedor['alm_prov_estado']){
                  ?>
                      <option value=<?php echo $est['GRAL_PAR_PRO_COD']; ?> selected>
                           <?php echo $est['GRAL_PAR_PRO_DESC']; ?>
                      </option>
                  <?php
                      }else{
                  ?>
                       <option value=<?php echo $est['GRAL_PAR_PRO_COD'];?>>
                           <?php echo $est['GRAL_PAR_PRO_DESC'];?>
                       </option>
                  <?php
                      }
                 ?>

               <?php  
                   } 
               ?>

               </select>
                </td>
           </tr>
      </table>
      <BR>
      <center>  <input class="btn_form" type="submit" name="accion" value="Modificar Proveedor">
                <input class="btn_form" type="button"  name="accion" value="Dar de Baja Proveedor" onClick="mostrarDialogo()">
                <input class="btn_form" type="button"  name="accion" value="Cancelar" onClick="regresarLista()">
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