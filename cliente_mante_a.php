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
<title>FINANCIERA</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<!--link href="css/calendar.css" rel="stylesheet" type="text/css"-->
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<!--script language="JavaScript" src="script/calendar_us.js"></script-->
<script language="javascript" src="script/validarForm.js"></script> 
 <script type="text/javascript" src="js/ClienteManteDetalle.js"></script>  

        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
        <script type="text/javascript" src="js/ValidarFormulario.js"></script>

        <script type="text/javascript" src="script/ValidaCampo.js"></script>

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
               <li id="menu_modulo_clientes">
                    
                     <img src="img/user office_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CLIENTES
                    
                 </li>
                  <li id="menu_modulo_registro_clientes">
                    
                     <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"> REGISTRO CLIENTES
                    
                 </li>
              <li id="menu_modulo_fecha_cambio">
                  <img src="img/add user_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA
              </li>
           </ul> 
    
<?php
// Se realiza una consulta SQL a tabla gral_param_propios
$consulta  = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$resultado = mysql_query($consulta)or die('No pudo seleccionarse tabla 1')  ;
$con_tper  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 22 and GRAL_PAR_INT_COD <> 0 ";
$res_tper = mysql_query($con_tper)or die('No pudo seleccionarse tabla 2')  ;
$con_tid  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 25 and GRAL_PAR_INT_COD <> 0";
$res_tid = mysql_query($con_tid)or die('No pudo seleccionarse tabla 3')  ;
$con_ext  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 69 and GRAL_PAR_INT_COD <> 0 order by GRAL_PAR_INT_COD";
$res_ext = mysql_query($con_ext)or die('No pudo seleccionarse tabla 4')  ;
$con_sex  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 10 and GRAL_PAR_PRO_COD <> 0 ";
$res_sex = mysql_query($con_sex)or die('No pudo seleccionarse tabla 5')  ;
$con_civ  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 11 and GRAL_PAR_PRO_COD <> 0 ";
$res_civ = mysql_query($con_civ)or die('No pudo seleccionarse tabla 6')  ;
$con_ana  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 12 and GRAL_PAR_PRO_COD <> 0 ";
$res_ana = mysql_query($con_ana)or die('No pudo seleccionarse tabla 7')  ;
$con_cint  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 410 and GRAL_PAR_PRO_COD <> 0 ";
$res_cint = mysql_query($con_cint)or die('No pudo seleccionarse tabla 8')  ;
$con_tviv  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 915 and GRAL_PAR_PRO_COD <> 0 ";
$res_tviv = mysql_query($con_tviv)or die('No pudo seleccionarse tabla 9')  ;
$con_ciiu  = "Select * From gral_ciiu where GRAL_CIIU_COD <> 0 ";
$res_ciiu = mysql_query($con_ciiu)or die('No pudo seleccionarse tabla 10')  ;
if(isset($_SESSION['form_buffer'])){
	$datos = $_SESSION['form_buffer'];
}
//echo leer_nro_cliente();
 ?>
 <font color="#FF0000">
 <?php
//echo $_SESSION['error'];
$_SESSION['error'] = "";
//ValidaCamposClientes(this)
?>
 </font>
  <div id="contenido_modulo">

     <h2> 
              <img src="img/add user_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                 ALTA
            </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCamposClientes(this)">
         <table align="center">
            <tr>
              <td scope="col"></td>
              <td scope="col"></td>
              <td scope="col" width="200"></td>
            </tr> 
            <tr>
		        <td>Agencia  </td>
			    <td> <select name="cod_agencia" size="1"  >
		   			 <?php
				       while ($linea = mysql_fetch_array($resultado)) {
				     ?>
					 <option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
					 <?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
				 	 <?php	
				       } 
					 ?>
					 </select>
		         </td>
             </tr>
           <tr>
           	    <td>Tipo Persona</td>
				<td> <select name="tip_per" size="1" size="10" >
   	    			 <?php
			           while ($linea = mysql_fetch_array($res_tper)) {
    			     ?>
				     <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
					 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
				     <?php
			            } 
			         ?>
					</select >
                </td>
           </tr>
           <tr>
		        <td>Genero</td><td> <select name="cod_sex" size="1" style="width:auto"  >
  	        		<?php
			          while ($linea = mysql_fetch_array($res_sex)) {
        		    ?>
			        <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
					<?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
					<?php
					   }
				    ?> 
					</select>                
                </td>
            </tr>
           <tr>
               <td>Estado Civil :</td>
               <td><select name="cod_civ" size="1"  >
  	              <?php
                    while ($linea = mysql_fetch_array($res_civ)) {
                  ?>
                  <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
			      <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	   	          <?php
                    }
                  ?> 
               </select>	
            </td>
          </tr>
	      <tr>
             <td>Tipo Doc.Identidad </td><td><select name="tip_doc" size="1"  >
   	             <?php
                   while ($linea = mysql_fetch_array($res_tid)) {
                 ?>
                 <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
				 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	             <?php
                  } 
                 ?>
		       </select>
            </td>
         </tr>
         <tr height="50">
            <td><font  color="#990033" >Doc Identidad</font></td>
			<td><input class="txt_campo" type="text" name="ci" width="10"  size="16" id="ci"></td>
      <td><div id="mensaje_ci"></div></td>
         </tr>
         <tr>
			<td>Extension   </td><td> <select name="ext_id" size="1"  >
   	            <?php
                  while ($linea = mysql_fetch_array($res_ext)) {
                ?>
                <option value=<?php echo $linea['GRAL_PAR_INT_SIGLA']; ?>>
				<?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	            <?php
                  } 
                ?>
		       </select>
            </td>
          </tr>

	       <tr>
  			  <td><font color="#990033">Nombres</td>
              <td><input class="txt_campo" type="text" name="nombres" maxlength="40" size="40" id="nombres"></td>
              <td><div id="mensaje_nombres"></div></td>
              
           </tr>
           <tr>
              <td><font color="#990033">Apellido Paterno </td>
              <td><input class="txt_campo" type="text" name="ap_pater" maxlength="35" size="35" id="ap_pater"></td>
              <td><div id="mensaje_ap_pater"></div></td>
           </tr>
           <tr>
 		      <td>Apellido Materno </td>
              <td><input class="txt_campo" type="text" name="ap_mater" maxlength="35" size="35" id="ap_mater"></td>
              <td><div id="mensaje_ap_mater"></div></td>
           </tr>
           <tr>
 			  <td>Apellido Esposo </td>
              <td><input class="txt_campo" type="text" name="ap_espos" maxlength="35" size="35" id="ap_espos"></td>
              <td><div id="mensaje_ap_espos"></div></td>
           </tr>
           <tr>
              <td ><font color="#990033">Fecha Nacimiento</td>
              <td><input class="txt_campo" id="datepicker" type="text" name="fec_nac" maxlength="10"  size="10" > 
                
	          </td>
            </tr>
            <tr>
  			   <td ><font color="#990033">Lugar Nacimiento</td>
               <td> <input class="txt_campo" type="text" name="lu_nac" maxlength="30" size="20" id="lu_nac"></td>
               <td><div id="mensaje_lu_nac"></div></td>
            </tr>
            <tr>
		       <td>Tipo Vivienda </td>
               <td><select name="tip_viv" size="1"  >
   	               <?php while ($linea = mysql_fetch_array($res_tviv)) { ?>
                   <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
		           <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	               <?php } ?>
		           </select>
       	       </td>
            </tr>
            <tr>   
			   <td ><font color="#990033">Direccion</td>
               <td><input class="txt_campo" type="text" name="direc" maxlength="250"size="80"  id="direc"></td>
               <td><div id="mensaje_direc"></div></td>
            </tr>
            <tr>
	           <td ><font color="#990033">Zona </td>
               <td><input class="txt_campo" type="text" name="zona" maxlength="60"id="zona"></td> 
               <td><div id="mensaje_zona"></div></td>
            </tr>
            <tr>
               <td>Telefono Fijo </td>
               <td><input class="txt_campo" type="text" name="fono"id="fono"></td>
               <td><div id="mensaje_fono"></div></td>
            </tr>
            <tr>
               <td>Telefono Celular :</td>
               <td><input class="txt_campo" type="text" name="celu"id="celu"></td>
               <td><div id="mensaje_celu"></div></td>
            </tr>
            <tr>
			   <td>E-mail </td>
               <td><input class="txt_campo" type="text" name="email"id="email"></td>
               <td><div id="mensaje_email"></div></td>
            </tr>
            <tr>
  			   <td ><font color="#990033">Actividad Economica Principal</td>
               <td><input class="txt_campo" type="text" name="a_eco_uno" maxlength="50" size="33"id="a_eco_uno"></td>
               <td><div id="mensaje_a_eco_uno"></div></td>
            </tr>
            <tr>
		      <td>Actividad Economica Secundaria</td>
			  <td><input class="txt_campo" type="text" name="a_eco_dos" maxlength="50" size="33"id="a_eco_dos">  </td>
        <td><div id="mensaje_a_eco_dos"></div></td>
            </tr>
            <tr>
              <td>CIIU </td>
              <td><select name="cod_ciiu" size="1"  >
  	           <?php while ($linea = mysql_fetch_array($res_ciiu)) {?>
               <option value=<?php echo $linea['GRAL_CIIU_COD']; ?>>
		       <?php echo $linea['GRAL_CIIU_DESC']; ?> </option>
	 	       <?php }  ?> 
               </select>
              </td>
            </tr>
            <tr>
              <td ><font color="#990033">Antiguedad Actividad (Años)</td>
              <td><input class="txt_campo" type="text" name="ant_tr"  size="5"id="ant_tr"> </td>
              <td><div id="mensaje_ant_tr"></div></td>
            </tr>
            <tr>
			  <td ><font color="#990033">Direccion Trab/Neg</td>
              <td><input class="txt_campo" type="text" name="dir_tr" maxlength="60" size="30"id="dir_tr"> </td>
              <td><div id="mensaje_dir_tr"></div></td>
            </tr>
            <tr>
			  <td ><font color="#990033">Zona Trab/Neg</td>
              <td> <input class="txt_campo" type="text" name="zon_tr" maxlength="35" size="20"id="zon_tr"> </td>
              <td><div id="mensaje_zon_tr"></div></td>
            </tr>
            <tr>
  		      <td>Telefono Trab/Neg</td>
              <td><input class="txt_campo" type="text" name="fon_t" size="20" id="fon_t"></td>
              <td><div id="mensaje_fon_t"></div></td>
            </tr>
            <tr>
		      <td><strong>Referencia Personal :</strong></td> <td></td>
            </tr>
            <tr>
              <td ><font color="#990033">Nombre(s) y Apellido(s)</td>
              <td><input class="txt_campo" type="text" name="nom_ref" maxlength="60" size="40" id="nom_ref"></td>
              <td><div id="mensaje_nom_ref"></div></td>
            </tr>
            <tr>
			  <td ><font color="#990033">Direccion </td>
		      <td><input class="txt_campo" type="text" name="dir_ref" maxlength="100" size="35" id="dir_ref"></td>
          <td><div id="mensaje_dir_ref"></div></td>
            </tr>
            <tr>
			  <td>Telefono </td>
			  <td><input class="txt_campo" type="text" name="fon_ref" maxlength="20" size="10" id="fon_ref"></td>
        <td><div id="mensaje_fon_ref"></div></td>
            </tr>
            <tr>
		  	  <td><strong> Datos Cónyuge</strong></td>
			  <td></td>
		    </tr>
            <tr>
		      <td> Nombre(s) y Apellido(s) </td>
              <td><input class="txt_campo" type="text" name="nom_con" maxlength="60" size="53" id="nom_con"></td>
              <td><div id="mensaje_nom_con"></div></td>
            </tr>
            <tr>
		      <td>Carnet Identidad</td>
              <td><input class="txt_campo" type="text" name="ci_con" maxlength="12" size="12" id="ci_con"></td>
              <td><div id="mensaje_ci_con"></div></td>
            </tr>
			 <tr>
		      <td>Ocupación</td>
              <td><input class="txt_campo" type="text" name="ocu_con" maxlength="20" size="20" id="ocu_con"></td>
              <td><div id="mensaje_ocu_con"></div></td>
            </tr>
            <tr>
			 <td>Calificacion Interna</td>
             <td><select name="cal_int" size="1"  >
              <?php while ($l_car = mysql_fetch_array($res_cint)) { ?>
              <option value=<?php echo $l_car['GRAL_PAR_PRO_COD'];?>>
		      <?php echo $l_car['GRAL_PAR_PRO_DESC']; ?></option>
              <?php } ?> 
              </select>
			 </td>
            </tr>
           <tr>
             <td></td>
			 <td><input class="btn_form" type="submit" name="accion" value="Grabar"></td>
           </tr>
       </table>
    </form>
</div>
<?php	
echo $_SESSION['error'];
$_SESSION['error'] = "";
?>
	<div id="FooterTable">
		Ingrese los datos generales del Cliente
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