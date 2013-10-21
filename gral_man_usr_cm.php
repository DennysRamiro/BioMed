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
    
    <title>MODIFICAR USUARIO</title>
    <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
    <link href="css/estilo.css" rel="stylesheet" type="text/css">
       
    <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
    <script type="text/javascript" src="script/jquery-ui.js"></script>
    <script type="text/javascript" src="js/calendario.js"></script>
    <script type="text/javascript" src="js/Utilitarios.js"></script>
    <script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>
    <script type="text/javascript" src="js/MenuManUsuarioModificar.js"></script> 

    </head>
<body>
<div id="dialog-confirm1" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Documento de Identidad no puede estar vacio.</font></p></div>
  <div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombres no puede estar vacio.</font></p></div>
  <div id="dialog-confirm3" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Apellido Paterno  no puede estar vacio.</font></p></div>
  <!--div id="dialog-confirm4" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Apellido Materno no puede estar vacio.</font></p>
</div-->
    <div id="dialog-confirm5" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Clave no puede estar vacio.</font></p></div>


    <?php
    include("header.php");
  ?>
  <div id="pagina_sistema"> 
            <ul id="lista_menu">
               <li id="menu_modulo">
                  <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
               </li>
               <li id="menu_modulo_general">
                  <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
              </li>
              <li id="menu_mant_usuario">
                     <img src="img/tools_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. USUARIOS
              </li>
              <li id="menu_cambio_usuario">
                  <img src="img/edit user_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIF. USUARIO
              </li>
           </ul>

        <div id="contenido_modulo">
            <h2> <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR USUARIO </h2>
            <hr style="border:1px dashed #767676;">
             <div id="error_login"> 
                <img src="img/checkmark_32x32.png" align="absmiddle">
                Modifique datos del Usuarios Seleccionado
              </div>
<?php
// Se realiza una consulta SQL a tabla gral_param_propios


/*if(isset($_GET['cod_log'])){
   $log = $_GET['cod_log'];
   $_SESSION['cod_log'] = $log;
//echo $log_i;
}*/
if(isset($_GET['ci'])){
   $log = $_GET['ci'];
   $_SESSION['cod_log'] = $log;
//echo $log_i;
}

$con_usr = "SELECT * FROM gral_usuario WHERE GRAL_USR_CI = '$log' AND (GRAL_USR_USR_BAJA=' ' or GRAL_USR_USR_BAJA is null)";
$res_usr = mysql_query($con_usr);
$linea = mysql_fetch_array($res_usr);

$cod_agen = $linea['GRAL_AGENCIA_CODIGO'];
$cod_sec = $linea['GRAL_USR_SECTOR'];
$cod_car = $linea['GRAL_USR_CARGO'];
$cod_est = $linea['GRAL_USR_ESTADO'];

//echo $cod_agen;
$con_age = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $cod_agen and GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age);
$con_age1 = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$res_age1 = mysql_query($con_age1);
$con_sec = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 200 and GRAL_PAR_PRO_COD = '$cod_sec' and GRAL_PAR_PRO_COD <> 0 ";
$res_sec = mysql_query($con_sec);
$con_sec1 = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 200 and GRAL_PAR_PRO_COD <> 0 ";
$res_sec1 = mysql_query($con_sec1);

$con_car = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 300 and GRAL_PAR_PRO_COD = '$cod_car' and GRAL_PAR_PRO_COD <> 0 ";
$res_car = mysql_query($con_car);
$con_car1 = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 300 and GRAL_PAR_PRO_COD <> 0 ";
$res_car1 = mysql_query($con_car1);

$con_est = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 400 and GRAL_PAR_PRO_COD = '$cod_est' and GRAL_PAR_PRO_COD <> 0 ";
$res_est = mysql_query($con_est);
$con_est1 = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 400 and GRAL_PAR_PRO_COD <> 0 ";
$res_est1 = mysql_query($con_est1);

 ?>

  <div id="dialog-confirm" title="Dar de baja producto" style="display:none;">
          <p><img src="img/alert_48x48.png" align="absmiddle">Realmente quiere dar de baja al usuario?</p>
      </div> 

<form name="form_modificar" method="post"  onSubmit="return ValidaCamposModificarAlta(this)">
             <br/>
              <table width="45%" align="center" border="0">
                <tr>
                        <td>Login:</td>
                        <td><?php echo $linea['GRAL_USR_LOGIN'];?> <input type="hidden" name="logins" id="logins" value="<? echo $linea['GRAL_USR_LOGIN'];?>" class="txt_campo"></td>
                </tr>
                <tr>
                        <td>Documento Identidad:</td>
                        <td><input type="text" name="ci" id="ci" width="10" value="<?php echo $linea['GRAL_USR_CI'];?>" class="txt_campo" onKeyPress="return soloNum(event)" readonly> </td>
                </tr>
               	<tr>
                      <td>Agencia:</td>
                      <td>
                    <?php 
					echo "<select name='cod_agencia' id='cod_agencia'>"; 
					while ($l_age=mysql_fetch_array($res_age1)) { 
					if ($l_age['GRAL_AGENCIA_CODIGO'] == $cod_agen){ 
    					     echo "<option selected value=".($l_age['GRAL_AGENCIA_CODIGO']).">".($l_age['GRAL_AGENCIA_NOMBRE'])."</option>";
    					}else{ 
    					     echo "<option value=".($l_age['GRAL_AGENCIA_CODIGO']).">".($l_age['GRAL_AGENCIA_NOMBRE'])."</option>";
    					} 
					}
					echo "</select>"; 
					?>
                    </td>
                </tr>
                <tr>
                    <td>  Nombres:</td>
                    <td><input  type="text" name="nombres" id="nombres" value="<?php echo $linea['GRAL_USR_NOMBRES'];?>" class="txt_campo"></td> 
                </tr>
                <tr>
                    <td>  Apellido Paterno:</td>
                    <td><input type="text" name="ap_pater" id="ap_pater" value="<?php echo $linea['GRAL_USR_AP_PATERNO'];?>" class="txt_campo"></td> 
                </tr>
                <tr>
                    <td>  Apellido Materno:</td>
                    <td><input  type="text" name="ap_mater" id="ap_mater" value="<?php echo $linea['GRAL_USR_AP_MATERNO'];?>" class="txt_campo"></td>
                </tr>
                <tr>
                    <td>Fec Nacimiento:</td>
                    <td><input  type="text" name="fec_nac" id="datepicker" value="<?php echo $linea['GRAL_USR_FEC_NAC'];?>" class="txt_campo"></td> 
                </tr>
                <tr>
                    <td>Direcci&oacute;n:</td>
                    <td><input  type="text" name="direc" value="<?php echo $linea['GRAL_USR_DIRECCION'];?>" class="txt_campo"></td> 
                </tr>
                <tr>
                    <td>Tel&eacute;fono Fijo:</td>
                    <td><input  type="text" name="fono" value="<?php echo $linea['GRAL_USR_TELEFONO'];?>" class="txt_campo" onKeyPress="return soloNum(event)"></td>
                </tr>
                <tr>
                     <td>Tel&eacute;fono  Celular:</td>
                     <td><input type="text" name="celu" value="<?php echo $linea['GRAL_USR_CELULAR'];?>" class="txt_campo" onKeyPress="return soloNum(event)"></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input  type="text" name="email" value="<?php echo $linea['GRAL_USR_EMAIL'];?>" class="txt_campo"></td>
                </tr>
                <tr>
                    <td>Sector:</td>
                    <td><?php 
					echo "<select name='cod_sec' id='cod_sec' size='1' >"; 
					while ($l_sec1=mysql_fetch_array($res_sec1)) { 
					   if ($l_sec1['GRAL_PAR_PRO_COD'] == $cod_sec){ 
					       echo "<option selected value=".($l_sec1['GRAL_PAR_PRO_COD']).">".($l_sec1['GRAL_PAR_PRO_DESC'])."</option>";
					   }else{ 
					       echo "<option value=".($l_sec1['GRAL_PAR_PRO_COD']).">".($l_sec1['GRAL_PAR_PRO_DESC'])."</option>";
					   } 
					}
					echo "</select>"; 
					?> </td>
                </tr>
                <tr>
                    <td>Cargo:</td>
                    <td><?php 
					echo "<select name='cod_car' id='cod_car' size='1' >"; 
					while ($l_car=mysql_fetch_array($res_car1)) { 
    					if ($l_car['GRAL_PAR_PRO_COD'] == $cod_car){ 
    					   echo "<option selected value=".($l_car['GRAL_PAR_PRO_COD']).">".($l_car['GRAL_PAR_PRO_DESC'])."</option>";
    					}else{ 
    					   echo "<option value=".($l_car['GRAL_PAR_PRO_COD']).">".($l_car['GRAL_PAR_PRO_DESC'])."</option>";
    					} 
					}
					echo "</select>"; 
					?></td>
                </tr>
                <tr>
                    <td>Estado:</td>
                    <td> <?php 
					echo "<select name='cod_est' id='cod_est' size='1' >"; 
					while ($l_est=mysql_fetch_array($res_est1)) { 
    					if ($l_est['GRAL_PAR_PRO_COD'] == $cod_est){ 
    					   echo "<option selected value=".($l_est['GRAL_PAR_PRO_COD']).">".($l_est['GRAL_PAR_PRO_DESC'])."</option>";
    					}else{ 
    					   echo "<option value=".($l_est['GRAL_PAR_PRO_COD']).">".($l_est['GRAL_PAR_PRO_DESC'])."</option>";
    					} 
					}
					echo "</select>"; 
					?></td>
                </tr>
                <tr>
                    <td>Clave Ingreso:</td>
                    <td><input type="password" name="clav" id="clav" value="<?php echo $linea['GRAL_USR_CLAVE'];?>" class="txt_campo" ></td>
                </tr>
            </table>
            <table width="45%" align="center" border="0">           
                   <tr  align="center">
                     <td > <br><input type="submit" name="form_modificar" value="Modificar Usuario" class="btn_form"></td>
                     <td  > <br><input type="button" name="baja" value="Dar de Baja Usuario" class="btn_form" onclick="mostrarDialogo()"></td>
                     <td  > <br><input type="button" name="cancelar" value="Cancelar" class="btn_form"></td>

                      <!--td  > <br><input type="submit" name="form_modificar" value="Guardar" class="btn_form"></td-->
                   </tr>
               </table>
</form>

<?php
if(isset($_POST['form_modificar']))//Vallidamos que el formulario fue enviado
{    
			//echo "llega";
      date_default_timezone_set('America/La_Paz');
      $fecha_actual  = date("y-m-d H:i:s");
      $user= $_SESSION['login'];
      
      $logins= $_POST['logins'];
      $ci= $_POST['ci'];
			$cod_age= $_POST['cod_agencia'];
			$nom= strtoupper($_POST['nombres']);
			$app= strtoupper($_POST['ap_pater']);
			$apm= strtoupper($_POST['ap_mater']);
			$fec= $_POST['fec_nac'];
			$fec_nac= cambiaf_a_mysql($fec);
			$dir= strtoupper($_POST['direc']);
			$tel= $_POST['fono'];
			$cel= $_POST['celu'];
			$email= $_POST['email'];
			$cod_sec= $_POST['cod_sec'];
			$cod_car= $_POST['cod_car'];
			$cod_est= $_POST['cod_est'];
			$clave= $_POST['clav'];            
                 					
			
      $consulta ="UPDATE gral_usuario 
                  SET GRAL_USR_USR_BAJA='$user', GRAL_USR_FEC_HR_BAJA = '$fecha_actual', GRAL_USR_ESTADO='2'
                 WHERE GRAL_USR_LOGIN= '$logins'"; // or die ('fallooo');

     $res = mysql_query($consulta);

      $grabar ="insert into gral_usuario(
                                         GRAL_USR_LOGIN,
                                         GRAL_USR_CODIGO,
                                         GRAL_AGENCIA_CODIGO,
                                         GRAL_USR_CI,
                                         GRAL_USR_NOMBRES,
                                         GRAL_USR_AP_PATERNO,
                                         GRAL_USR_AP_MATERNO,
                                         GRAL_USR_CLAVE,
                                         GRAL_USR_FEC_NAC,
                                         GRAL_USR_SECTOR,
                                         GRAL_USR_CARGO,
                                         GRAL_USR_DIRECCION,
                                         GRAL_USR_TELEFONO,
                                         GRAL_USR_CELULAR,
                                         GRAL_USR_EMAIL,
                                         GRAL_USR_ESTADO,
                                         GRAL_USR_USR_ALTA,
                                         GRAL_USR_FEC_HR_ALTA,
                                         GRAL_USR_USR_BAJA,
                                         GRAL_USR_FEC_HR_BAJA
                                        )
                                  values('$logins',
                                         null,
                                         '$cod_age',
                                         '$ci',
                                         '$nom',
                                         '$app',
                                         '$apm',
                                         '$clave',
                                         '$fec_nac',
                                         '$cod_sec',
                                          '$cod_car', 
                                          '$dir','$tel', 
                                          '$cel',
                                          '$email',
                                          '$cod_est',
                                          '$user',
                                          '$fecha_actual',
                                          null,
                                          null
                                          )";        


            $res1 = mysql_query($grabar);

          /*  $grabar ="UPDATE gral_usuario 
                  SET GRAL_AGENCIA_CODIGO='$cod_age',GRAL_USR_CI='$ci', GRAL_USR_NOMBRES='$nom', GRAL_USR_AP_PATERNO='$app',GRAL_USR_AP_MATERNO='$apm',GRAL_USR_CLAVE='$clave', GRAL_USR_FEC_NAC='$fec_nac', GRAL_USR_SECTOR='$cod_sec', GRAL_USR_CARGO='$cod_car', GRAL_USR_DIRECCION='$dir', GRAL_USR_TELEFONO='$tel', GRAL_USR_CELULAR='$cel', GRAL_USR_EMAIL='$email', GRAL_USR_ESTADO='$cod_est'
                 WHERE GRAL_USR_LOGIN= '$log'"; // or die ('fallooo');
*/
      
             header('location:gral_man_usr_c.php?msg=2') ;
        
	}			  
?>
		</div>
    </div>
  </body>
</html>
<?php
}
ob_end_flush();
 ?>