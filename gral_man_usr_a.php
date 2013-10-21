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
        <title>MANT. ALTA DE USUARIOS</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <!--link href="css/calendar.css" rel="stylesheet" type="text/css"-->
        <!--script language="JavaScript" src="script/calendar_us.js"></script-->
        <script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
        
        <script type="text/javascript" src="js/MantUsuarioAlta.js"></script>  
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <!--script type="text/javascript" src="js/form_gral_mant_alta.js"></script-->  
        <script type="text/javascript" src="js/gral_usuarios.js"></script>
        <script type="text/javascript" src="js/Utilitarios.js"></script>  
        
        

        <script type="text/javascript" src="js/calendario.js"></script>
        <!--script type="text/javascript" src="js/ValidarFormulario.js"></script-->

       
       <!--script type="text/javascript" src="script/ValidaCampo.js"></script-->
       <!--script type="text/javascript" src="script/ValidaNumeros.js"></script-->


     

          </head>
    <body>
      <div id="dialog-confirm1" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Login no puede estar vacio.</font></p>
      </div>
      <div id="dialog-confirm2" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Documento de Identidad no puede estar vacio.</font></p>
      </div>
      <div id="dialog-confirm3" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Clave Ingreso no puede estar vacio.</font></p>
      </div>
      <div id="dialog-confirm4" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Nombres no puede estar vacio.</font></p>
      </div>
      <div id="dialog-confirm5" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Apellido Paterno no puede estar vacio.</font></p>
      </div>
      <div id="dialog-confirm6" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Apellido Materno no puede estar vacio.</font></p>
      </div>
      <div id="dialog-confirm7" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Dirección no puede estar vacio.</font></p>
      </div>
      <div id="dialog-confirm8" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Tel. Fijo no puede estar vacio.</font></p>
      </div>
      <div id="dialog-confirm9" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Tel. Celular no puede estar vacio.</font></p>
      </div>
      <div id="dialog-confirm10" title="Advertencia" style="display:none; ">
      <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo E-mail no puede estar vacio.</font></p>
      </div>
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

              </li>

              <li id="menu_modulo_mantUsuarios_alta">
                  <img src="img/tools_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. USUARIOS
              </li>

              <li id="menu_modulo_fecha">
                    
                     <img src="img/add user_24x24.png" border="0" alt="Modulo" align="absmiddle"> ALTA
                    
                 </li>

           </ul> 
          <?php
          // Se realiza una consulta SQL a tabla gral_param_propios
          $consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
          $resultado = mysql_query($consulta);
          $con_sec  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 200 and GRAL_PAR_PRO_COD <> 0 ";
          $res_sec = mysql_query($con_sec);
          $con_car  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 300 and GRAL_PAR_PRO_COD <> 0
		               order by GRAL_PAR_PRO_CTA1";
          $res_car = mysql_query($con_car);
          $con_est  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 400 and GRAL_PAR_PRO_COD <> 0 ";
          $res_est = mysql_query($con_est);
          //$datos = $_SESSION['form_buffer'];
           ?>
          <div id="contenido_modulo">
            <h2> 
              <img src="img/add user_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                 ALTA DE USUARIO
            </h2>
            <hr style="border:1px dashed #767676;">
             <div id="error_login"> 
                <img src="img/checkmark_32x32.png" align="absmiddle">
                Registrar datos del Usuario
              </div>
<form name="form2" method="post" action="grab_retro_u.php" onSubmit="return ValidaCamposAltaUsuario(this)">
         <br>
           <table width="45%" align="center" border="0">
              <tr align="left">

                  <th>Login:  </th>
                  <td><input type="text" name="log" size="20" class="txt_campo" id="log">
                  <div id="mensaje_log"></div></td>
                  

                   <!--td>  <input type="text" name="log" size="20" class="txt_campo"></td-->
               </tr>
               <tr align="left">

                  <th>Documento Identidad:</th>
                  <td><input type="text" name="ci" width="10" class="txt_campo" id="ci">
                  <div id="mensaje_ci"></div></td>
                </tr>
                 <tr align="left">

                      <th>Clave Ingreso:</th>
                      <td><input type="password"   name="clav" class="txt_campo" id="clav">
                      <div id="mensaje_clav"></div></td>
                   </tr>
                <tr align="left">

              	    <th>Agencia:</th>
          	        <td>   <select name="cod_agencia" size="1"  >
          	              <?php
              	            while ($linea = mysql_fetch_array($resultado)) {
                  	      ?>
                  			    <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>><?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
                       	   <?php
          			          } 
                    			?>
          		          </select>
                  	 </td>
                 </tr>
                 <tr align="left">

          	        <th>Nombres: </th>
                    <td><input type="text" name="nombres" class="txt_campo" id="nombres"> 
                    <div id="mensaje_nombres"></div></td>
                 </tr>
                 <tr align="left"> 

                      <th>Apellido Paterno:</th>
                      <td><input  type="text" name="ap_pater" class="txt_campo" id="ap_pater"> 
                      <div id="mensaje_ap_pater"></div></td>
                 </tr>
                 <tr align="left">

                      <th>Apellido Materno:</th>
                      <td><input type="text" name="ap_mater" class="txt_campo" id="ap_mater">
                      <div id="mensaje_ap_mater"></div></td>
                  </tr>
              		<tr align="left">

              	        <th>Fec. Nacimiento:</th>
                          <td>
                        <input  type="text"  name="fec_nac" class="txt_campo" id="datepicker">

                         </td>
                  </tr>
                  <tr align="left">
              	         <th>Direcci&oacute;n:</th>
                         <td><input type="text" name="direc" size="50" maxlength="50"  class="txt_campo" id="direc">
                         <div id="mensaje_direc"></div></td>
              		 </tr>
                   <tr align="left">

            	        <th>Tel&eacute;fono Fijo:</th>
                      <td><input type="text" name="fono" class="txt_campo" id="fono" onKeyPress="return soloNum(event)" onBlur="limpia()" value="0">
                      <div id="mensaje_fono"></div></td>
                   </tr>
                   <tr align="left">

          		        <th>Tel&eacute;fono Celular:</th>
                      <td><input type="text" name="celu" class="txt_campo" id="celu" onKeyPress="return soloNum(event)" onBlur="limpia()" value="0">
                      <div id="mensaje_celu"></div></td>
                   </tr>
                   <tr align="left">

          		        <th>E-mail:</th>
                      <td><input type="email" name="email" class="txt_campo" id="email">
                      <div id="mensaje_email"></div></td>
                   </tr>
                   <tr align="left">

          	          <th>Sector:</th>
                      <td><select name="cod_sec" size="1"  >
                  		    	  <?php
                          			while ($l_sec = mysql_fetch_array($res_sec)) {
          		        	      ?>
          				            <option value=<?php echo $l_sec['GRAL_PAR_PRO_COD']; ?>><?php echo $l_sec['GRAL_PAR_PRO_DESC']; ?> </option>
                       
          			              <?php
          					          }
          				          ?> 
          					          </select>
                         </td>
                         
                   </tr>
                   <tr  align="left">
          		       <th>Cargo:</th><td><select name="cod_car" size="1"  >
                        <?php
                          while ($l_car = mysql_fetch_array($res_car)) {
                        ?>
                      <option value=<?php echo $l_car['GRAL_PAR_PRO_COD']; ?>><?php echo $l_car['GRAL_PAR_PRO_DESC']; ?></option>
                        <?php
                    }
                    ?> 
                    </select>
                    </td>
                   </tr>
                   <tr align="left">

                     <th> Estado:</th><td> <select name="cod_est" size="1"  >
                        <?php
                          while ($l_est = mysql_fetch_array($res_est)) {
                        ?>
                    		  <option value=<?php echo $l_est['GRAL_PAR_PRO_COD']; ?>><?php echo $l_est['GRAL_PAR_PRO_DESC']; ?></option>
                       <?php
          		          }
                  	  ?> 
          		          </select>
                       </td>
                   </tr>
               </table>
               <table width="45%" align="center" border="0">           
                   <tr  align="center">
                     <td><br><input class="btn_form" type="submit" name="accion" value="Grabar" ></td>
                   </tr>
               </table>
          </form>
              <?php
          	echo  $_SESSION["error"];  
              ?>
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