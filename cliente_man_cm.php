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
<title>Mantenimiento Clientes</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
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
                 <img src="img/edit_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODIFICAR
    	       </li>
           </ul>
              <div id="contenido_modulo">
   
                  <h2> 
                             </h2>
                      <hr style="border:1px dashed #767676;">

    	       


<?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
                ?> 

<?php
// Se realiza una consulta SQL a tabla gral_param_propios
//$datos = $_SESSION['form_buffer'];
$ciiu_r = 0;
$quecom = $_POST['cod_cliente'];
for( $i=0; $i < count($quecom); $i = $i + 1 ) {
 if( isset($quecom[$i]) ) {
    $cod_c = $quecom[$i];
 }
}
$_SESSION['cod_cli']= $cod_c;
$con_cli = "Select * From cliente_general where CLIENTE_COD = $cod_c and CLIENTE_USR_BAJA is null";
$res_cli = mysql_query($con_cli)or die('No pudo seleccionarse tabla 1')  ;
while ($linea = mysql_fetch_array($res_cli)){
$_SESSION['nro_cli']= $linea['CLIENTE_NUMERICO'];
$_SESSION['tip_doc']= $linea['CLIENTE_TIP_ID'];
$cod_agen = $linea['CLIENTE_AGENCIA'];
$cod_tper = $linea['CLIENTE_TIP_PER'];
$cod_tid = $linea['CLIENTE_TIP_ID'];
$cod_sex = $linea['CLIENTE_SEXO'];
$cod_civ = $linea['CLIENTE_EST_CIVIL'];
$cod_ana = $linea['CLIENTE_ALFAB'];
$cal_int = $linea['CLIENTE_CAL_INT'];
$cod_ciiu = $linea['CLIENTE_CIIU'];
$tip_viv = $linea['CLIENTE_VIVIEN'];
$datos['cod'] = $linea['CLIENTE_COD'];
$datos['ci'] = $linea['CLIENTE_COD_ID'];
$_SESSION['ci'] = $linea['CLIENTE_COD_ID'];
$datos['nombres'] = $linea['CLIENTE_NOMBRES']; 
$datos['ap_pater']  = $linea['CLIENTE_AP_PATERNO'];
$datos['ap_mater']  = $linea['CLIENTE_AP_MATERNO'];
$datos['ap_espos']  = $linea['CLIENTE_AP_ESPOSO'];
$datos['lug_nac']  = $linea['CLIENTE_LUG_NAC'];
$f_nac = $linea['CLIENTE_FCH_NAC'];
$datos['fec_nac']= cambiaf_a_normal($f_nac);
$datos['direc'] = $linea['CLIENTE_DIRECCION'];
$datos['zona'] = $linea['CLIENTE_ZONA'];
$datos['fono'] = $linea['CLIENTE_FONO'];
$datos['celu'] = $linea['CLIENTE_CELULAR'];
$datos['email'] = $linea['CLIENTE_EMAIL'];
$datos['dir_tr'] = $linea['CLIENTE_DIR_TRAB'];
$datos['fon_t'] = $linea['CLIENTE_FONO_TRAB'];
$datos['eco_uno'] = $linea['CLIENTE_SECTOR1'];
$datos['eco_dos'] = $linea['CLIENTE_SECTOR2'];
$datos['ant_tr'] = $linea['CLIENTE_ANT_ACT'];
$datos['zon_tr'] = $linea['CLIENTE_ZON_TRAB'];
$datos['nom_ref'] = $linea['CLIENTE_NOM_REF'];
$datos['dir_ref'] = $linea['CLIENTE_DIR_REF'];
$datos['fon_ref'] = $linea['CLIENTE_FON_REF'];
$datos['nom_con'] = $linea['CLIENTE_NOM_CONYUGE'];
$datos['ci_con'] = $linea['CLIENTE_CI_CONYUGE'];
$datos['ocu_con'] = $linea['CLIENTE_CARGO'];
}
$con_age = "Select * From gral_agencia where GRAL_AGENCIA_CODIGO = $cod_agen and GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age)or die('No pudo seleccionarse tabla 2')  ;
 while ($linea = mysql_fetch_array($res_age)) {
       $age_r = $linea['GRAL_AGENCIA_NOMBRE'];
    } 
$con_age = "Select * From gral_agencia where GRAL_AGENCIA_USR_BAJA is null ";
$res_age = mysql_query($con_age)or die('No pudo seleccionarse tabla 2')  ;
$con_tper  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 22 and GRAL_PAR_INT_COD = $cod_tper ";
$res_tper = mysql_query($con_tper)or die('No pudo seleccionarse tabla 3')  ;
while ($linea = mysql_fetch_array($res_tper)) {
    $tper_r =  $linea['GRAL_PAR_INT_DESC']; 
 } 
$con_tper  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 22 and GRAL_PAR_INT_COD <> 0";
$res_tper = mysql_query($con_tper)or die('No pudo seleccionarse tabla 3')  ;
$con_tid  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 25 and GRAL_PAR_INT_COD = $cod_tid";
$res_tid = mysql_query($con_tid)or die('No pudo seleccionarse tabla 4')  ;
$con_ext  = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 69 and GRAL_PAR_INT_COD <> 0";
$res_ext = mysql_query($con_ext)or die('No pudo seleccionarse tabla 5')  ;
$con_sex  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 10 and GRAL_PAR_PRO_COD = $cod_sex ";
$res_sex = mysql_query($con_sex)or die('No pudo seleccionarse tabla 6')  ;
while ($linea = mysql_fetch_array($res_sex)) {
      $sex_r = $linea['GRAL_PAR_PRO_DESC'];
}	 
$con_sex  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 10 and GRAL_PAR_PRO_COD <> 0 ";
$res_sex = mysql_query($con_sex)or die('No pudo seleccionarse tabla 6')  ;
$con_civ  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 11 and GRAL_PAR_PRO_COD = $cod_civ";
$res_civ = mysql_query($con_civ)or die('No pudo seleccionarse tabla 7')  ;
while ($linea = mysql_fetch_array($res_civ)) {
      $civ_r = $linea['GRAL_PAR_PRO_DESC'];
}	
$con_civ  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 11 and GRAL_PAR_PRO_COD <> 0";
$res_civ = mysql_query($con_civ)or die('No pudo seleccionarse tabla 71')  ;

$con_tviv  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 915 and GRAL_PAR_PRO_COD = $tip_viv";
$res_tviv = mysql_query($con_tviv)or die('No pudo seleccionarse tabla 8')  ;
while ($linea = mysql_fetch_array($res_tviv)) {
      $tviv_r = $linea['GRAL_PAR_PRO_DESC'];
}	
$con_tviv  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 915 and GRAL_PAR_PRO_COD <> 0 ";
$res_tviv = mysql_query($con_tviv)or die('No pudo seleccionarse tabla 81')  ;

if($cal_int == ""){
    $cal_int = 1;} 
$con_cint  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 410 and GRAL_PAR_PRO_COD = $cal_int ";
$res_cint = mysql_query($con_cint)or die('No pudo seleccionarse tabla 9')  ;
while ($linea = mysql_fetch_array($res_cint)) {
      $cint_r = $linea['GRAL_PAR_PRO_DESC'];
}	
$con_cint  = "Select * From gral_param_propios where GRAL_PAR_PRO_GRP = 410 and GRAL_PAR_PRO_COD <> 0 ";
$res_cint = mysql_query($con_cint)or die('No pudo seleccionarse tabla 9')  ;

if($cod_ciiu == ""){
   $cod_ciiu = 1;} 
$con_ciiu  = "Select * From gral_ciiu where GRAL_CIIU_COD = $cod_ciiu ";
$res_ciiu = mysql_query($con_ciiu)or die('No pudo seleccionarse tabla 10')  ;
while ($linea = mysql_fetch_array($res_ciiu)) {
      $ciiu_r = $linea['GRAL_CIIU_DESC'];
}
$con_ciiu  = "Select * From gral_ciiu where GRAL_CIIU_COD  <> 0 and GRAL_CIIU_USR_BAJA is null ";
$res_ciiu = mysql_query($con_ciiu)or die('No pudo seleccionarse tabla 10')  ;
 ?>

 
 
 </strong>
<!--<form name="form2" method="post" action="grab_retro_cli.php" target="_self" >-->
<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCamposClientesMod(this)">
                                                                             
<strong style="font-size:18px">
<?php echo "Codigo".encadenar(3).$cod_c.encadenar(3)."Doc. Identificacion".encadenar(3).$datos['ci'];

 if (isset($_SESSION['con_mod'])){
      if ($_SESSION['con_mod'] == 1){
?>
</strong>
<br>
 <table align="center">
   <tr>
    <td><strong>Agencia</strong></td>
	<td align="right"><font color="#FF0000"><?php echo $age_r;?></font></td>	 
    <td><select name=<?php echo $age_r; ?> size="1">
   	  		<?php while ($linea = mysql_fetch_array($res_age)) { ?>
      				<option value=<?php echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
	  						<?php echo $linea['GRAL_AGENCIA_NOMBRE']; ?>
	  			    </option>
	  		<?php } ?>  
	  	</select></td>
   </tr>

<!--tr>
    <td><strong>Agencia</strong></td>
	<td align="right"><font color="#FF0000"><?php //echo $age_r;?></font></td>	 
    <td><select name="cod_agencia" size="1">
   	  <?php //////while ($linea = mysql_fetch_array($res_age)) {?>
      <option value=<?php ////echo $linea['GRAL_AGENCIA_CODIGO']; ?>>
	  <?php //echo $linea['GRAL_AGENCIA_NOMBRE']; ?></option>
	  <?php } ?>   </select></td>
   </tr-->

   <tr>
    <td><strong>Tipo Persona </strong></td>
    <td align="right" ><font color="#FF0000"><?php echo $tper_r;?></font></td>	 
    <td><select name="tip_per" size="1">
   	    <?php while ($linea = mysql_fetch_array($res_tper)) { ?>
        <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
		<?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	     <?php }?> </select></td>
	</tr>	 
	<tr>
      <td><strong>Genero </strong></td>
	  <td align="right" ><font color="#FF0000"><?php echo $sex_r;?></font></td>	 
      <td><select name="cod_sex" size="1">
  	      <?php while ($linea = mysql_fetch_array($res_sex)) {  ?>
          <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
	      <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	      <?php }  ?>  </select> </td>
	</tr>	 
    <tr>
      <td><strong>Estado Civil</strong></td>
	  <td align="right" ><font color="#FF0000"><?php echo $civ_r;?></font></td>	 
      <td><select name="cod_civ" size="1"  >
  	      <?php while ($linea = mysql_fetch_array($res_civ)) { ?>
          <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
	      <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	      <?php  } ?> </select> </td>
	</tr>
	<tr>
      <td><strong>Tipo Vivienda </strong></td>
      <td align="right" > <font color="#FF0000"><?php echo $tviv_r;?></font></td>		 
      <td><select name="tip_viv" size="1" size="10">
   	      <?php while ($linea = mysql_fetch_array($res_tviv)) { ?>
          <option value=<?php echo $linea['GRAL_PAR_PRO_COD']; ?>>
		  <?php echo $linea['GRAL_PAR_PRO_DESC']; ?> </option>
	      <?php } ?> </select></td>
	</tr>
  <tr>
      <td><font color="#990033"><strong>  Nombres   </strong></td>
	  <td><?php echo encadenar(20); ?></td>
      <td><input class="txt_campo" type="text" name="nombres" size="30"
	      value="<?=$datos['nombres'];?>"></td>
	</tr>
	 <tr>
      <td><font color="#990033"><strong>  Apellido Paterno</strong></td>
	  <td><?php echo encadenar(20); ?></td>
      <td><input class="txt_campo" type="text" name="ap_pater" 
	      value="<?=$datos['ap_pater'];?>"></td>
	</tr>
	<tr>
      <td><font color="#990033"><strong>Apellido Materno</strong></td>
	  <td><?php echo encadenar(20); ?></td>
      <td><input class="txt_campo" type="text" name="ap_mater"
	      value="<?=$datos['ap_mater'];?>"></td>
     <tr>
      <td><font color="#990033"><strong>Apellido Esposo</strong></td>
	   <td><?php echo encadenar(20); ?></td>
       <td><input class="txt_campo" type="text" name="ap_espos" maxlength="35" 
	       value="<?=$datos['ap_espos'];?>"></td>
	 </tr>
	 <tr>
      <td><font color="#990033"><strong>Fec Nacimiento</strong></td>
	  <td><?php echo encadenar(20); ?></td>
      <td><input class="txt_campo" type="text" name="fec_nac"
	      value="<?=$datos['fec_nac'];?>"></td>
	  </tr>
	  <tr>	    
        <td><font color="#990033"><strong>Lugar Nacimiento </strong></td>
		<td><?php echo encadenar(20); ?></td>
		<?php if(isset($datos['lug_nac'])){ ?>
        <td><input class="txt_campo" type="text" name="lu_nac" maxlength="30"
		    size="30" value="<?=$datos['lug_nac'];?>" >	</td>
		<?php }else{ ?>
		<td><input class="txt_campo" type="text" name="lu_nac" maxlength="30"
		    size="30" value="" >	</td>
		<?php }?>
		</tr>
	  <tr>
	    <td><font color="#990033"><strong>Direccion</strong></td>
		<td><?php echo encadenar(20); ?></td>
		<?php if(isset($datos['direc'])){ ?>
        <td><input class="txt_campo" type="text" name="direc"
		    value="<?=$datos['direc'];?>" maxlength="250"size="50"  ></td>
		<?php }else{ ?>
		 <td><input class="txt_campo" type="text" name="direc"
		    value="" ></td>
		<?php }?>		
		 </tr>
	  <tr>
		<td><font color="#990033"><strong>Zona</strong></td>
		<td><?php echo encadenar(20); ?></td>
		<?php if(isset($datos['zona'])){ ?>
        <td><input class="txt_campo" type="text" name="zona" 
		    maxlength="60"  value="<?=$datos['zona'];?>" > </td>
		<?php }else{ ?>
		 <td><input class="txt_campo" type="text" name="zona" 
		    maxlength="60"  value="" > </td>
		<?php }?>			
	  </tr>
	  <tr>
         <td><strong>Tel. Fijo</strong></td>
		 <td><?php echo encadenar(20); ?></td>
         <td><input class="txt_campo" type="text" name="fono" 
		     value="<?=$datos['fono'];?>" ></td>
	  </tr>
	  <tr>	 
        <td><strong>Tel. Celular</strong></td>
		<td><?php echo encadenar(20); ?></td>
        <td><input class="txt_campo" type="text" name="celu"
		    value="<?=$datos['celu'];?>"></td>
      </tr>
	  <tr>
        <td><strong>E-mail</strong></td>
		<td><?php echo encadenar(20); ?></td>
        <td><input class="txt_campo" type="text" name="email" 
		    value="<?=$datos['email'];?>" ></td>
	  </tr>
	  <tr>	
	    <td><font color="#990033"><strong>Act Eco Principal</strong></td>
		<td><?php echo encadenar(20); ?></td>
		<?php if(isset($datos['eco_uno'])){ ?>
        <td><input class="txt_campo" type="text" name="a_eco_uno" maxlength="50"
		    size="30" value="<?=$datos['eco_uno'];?>"></td>
		<?php }else{ ?>
		<td><input class="txt_campo" type="text" name="a_eco_uno" maxlength="50"
		    size="30" value=""></td>
		<?php }?>			
	  </tr>
	  <tr>	
        <td><strong>Act Eco Secundaria</strong></td>
		<td><?php echo encadenar(20); ?></td>
        <td><input class="txt_campo" type="text" name="a_eco_dos" maxlength="50"
		     size="30" value="<?=$datos['eco_dos'];?>"></td> 
	  </tr>
	  <tr>	
	    <td><strong>CIIU </strong></td>
		<td><font color="#FF0000"><?php echo $ciiu_r;?></font></td>
		<td><select name="cod_ciiu" size="1" >
  	        <?php while ($linea = mysql_fetch_array($res_ciiu)) { ?> 
            <option value= <?php echo $linea['GRAL_CIIU_COD']; ?> >
			<?php echo $linea['GRAL_CIIU_DESC']; ?> </option>
			<?php }  ?> </select></td>
      </tr>
	  <tr>	
	    <td><font color="#990033"><strong>Antiguedad Actividad (Años)</strong></td>
		<td><?php echo encadenar(20); ?></td>
		<?php if(isset($datos['ant_tr'])){ ?>
        <td><input class="txt_campo" type="text" name="ant_tr"  size="5" 
		     value="<?=$datos['ant_tr'];?>"> </td>
		<?php }else{ ?>
		<td><input class="txt_campo" type="text" name="ant_tr"  size="5" 
		     value=""> </td>
		<?php }?>	 	 
	  </tr>
	  <tr>
         <td><font color="#990033"><strong>Dir Tra/Neg</strong></td>
		 <td><?php echo encadenar(20); ?></td>
		 <?php if(isset($datos['dir_tr'])){ ?>
         <td><input class="txt_campo" type="text" name="dir_tr" maxlength="60"
		      value="<?=$datos['dir_tr'];?>" ></td>
		 <?php }else{ ?>
		 <td><input class="txt_campo" type="text" name="dir_tr" maxlength="60"
		      value="" ></td>
		<?php }?>	  
	  </tr>
	  <tr>
	     <td><font color="#990033"><strong>Zona Trab/Neg</strong></td>
		 <td><?php echo encadenar(20); ?></td>
         <td><input class="txt_campo" type="text" name="zon_tr" maxlength="35"
		     value="<?=$datos['zon_tr'];?>"></td>
	  </tr>
	  <tr>
        <td><strong>Tel. Trab/Neg</strong></td>
		<td><?php echo encadenar(20); ?></td>
        <td><input class="txt_campo"  type="text" name="fon_t" 
		    value="<?=$datos['fon_t'];?>" ></td>
	  </tr>
	  <tr>
        <td><font  color="#0000CC">
            <strong>Referencia </strong></font></td>
		<td align="left"><font  color="#0000CC">
            <strong>Personal</strong></font></td>
      </tr>
	  <tr>
	     <td><font color="#990033"><strong>Nombre(s) y Apellid</strong></td>
		 <td><strong>o (s)</strong></td>
		 <?php if(isset($datos['nom_ref'])){ ?>
         <td> <input class="txt_campo" type="text" name="nom_ref" maxlength="60" 
		      size="60" value="<?=$datos['nom_ref'];?>"></td>
		 <?php }else{ ?>	  
		 <td> <input class="txt_campo" type="text" name="nom_ref" maxlength="60" 
		      size="60" value=""></td>
		 <?php }?>		  
	  </tr>
	  <tr>
	     <td><font color="#990033"><strong>Direccion</strong></td>
		 <td><?php echo encadenar(20); ?></td>
		  <?php if(isset($datos['dir_ref'])){ ?>
         <td><input class="txt_campo" type="text" name="dir_ref" maxlength="100"
		     size="40" value="<?=$datos['dir_ref'];?>" ></td>
		 <?php }else{ ?>
		 <td><input class="txt_campo" type="text" name="dir_ref" maxlength="100"
		     size="40" value="" ></td>
		 <?php }?>	 
	  </tr>
	  <tr>
	     <td><strong>Telefono</strong></td>
		 <td><?php echo encadenar(20); ?></td> 
         <td><input class="txt_campo" type="text" name="fon_ref" maxlength="20"
		     value="<?=$datos['fon_ref'];?>" ></td>
	  </tr>
	  <tr>
        <td><font  color="#0000CC">
            <strong>Datos Cónyuge</strong></font></td>
	  </tr>     
      <tr>
       <tr>
	     <td><strong>Nombre(s) y Apellido(s)</strong></td>
		 <td><strong>o (s)</strong></td>
         <td><input class="txt_campo" type="text" name="nom_con" maxlength="60" 
		     value="<?=$datos['nom_con'];?>" ></td>
		</tr>     
      <tr>	 
         <td><strong>Carnet Identidad</strong></td>
		 <td><?php echo encadenar(20); ?></td> 
         <td> <input class="txt_campo" type="text" name="ci_con" maxlength="12" 
		      value="<?=$datos['ci_con'];?>" ></td>
	  </tr> 
	  <tr>
		 <td><strong>Ocupación</strong></td>
		 <td><?php echo encadenar(20); ?></td>
         <td><input class="txt_campo" type="text" name="ocu_con" maxlength="20" size="20"value="<?=$datos['ocu_con'];?>" ></td>
      </tr>   
      <tr>
         <td><strong>Calificacion Interna</strong></td>
		 <td><font color="#FF0000"><?php echo $cint_r;?></font>	</td> 
         <td><select name="cal_int" size="1"  >
  	         <?php while ($l_car = mysql_fetch_array($res_cint)) {?>
             <option value=<?php echo $l_car['GRAL_PAR_PRO_COD'];?>>
	         <?php echo $l_car['GRAL_PAR_PRO_DESC']; ?></option>
	         <?php } ?> </select></td>
     </tr> 
	  <tr></tr> 
	 <tr>
        <td></td>
		<td></td>
		<td> <input class="btn_form" type="submit" name="accion" value="Modificar"></td>
     </tr> 
 
    
	 </table>
	 <?php
   }else{
   ?>
	</strong>
<br>
 <table align="center">
   <tr>
    <td><strong>Agencia</strong></td>
	<td align="left"><?php echo $age_r;?></font></td>	 
 </tr>
   <tr>
    <td><strong>Tipo Persona </strong></td>
    <td align="left" ><?php echo $tper_r;?></font></td>	 
   </tr>	 
	<tr>
      <td><strong>Genero </strong></td>
	  <td align="left" ><?php echo $sex_r;?></font></td>	 
      
	</tr>	 
    <tr>
      <td><strong>Estado Civil</strong></td>
	  <td align="left" ><?php echo $civ_r;?></font></td>	 
    </tr>
	<tr>
      <td><strong>Tipo Vivienda </strong></td>
      <td align="left" ><?php echo $tviv_r;?></font></td>		 
    </tr>
  <tr>
      <td><strong>  Nombres Completo  </strong></td>
	  <td><?php echo $datos['nombres'].encadenar(2).
	           $datos['ap_pater'].encadenar(2).$datos['ap_mater']
			   .encadenar(2).$datos['ap_espos']; ?></td>
   </tr>

	 <tr>
      <td><strong>Fec Nacimiento</strong></td>
	  <td><?php echo $datos['fec_nac']; ?></td>
     </tr>
	  <tr>	    
        <td><strong>Lugar Nacimiento </strong></td>
		<td><?php if(isset($datos['lug_nac'])){
		         echo $datos['lug_nac'];  ?>
       		<?php }else{ 
			     echo encadenar(10);?>
		
		<?php }?></td>
		</tr>
	  <tr>
	    <td><strong>Direccion</strong></td>
		<?php if(isset($datos['direc'])){ ?>
        <td>
		   <?php echo $datos['direc'];?>
		<?php }else{ 
		  echo encadenar(20); ?>
		 
		<?php }?>
		</td>		
		 </tr>
	  <tr>
		<td><strong>Zona</strong></td>
		<?php if(isset($datos['zona'])){ ?>
        <td><?php echo $datos['zona'];?> </td>
		<?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
		<?php }?> </td>			
	  </tr>
	  <tr>
         <td><strong>Tel. Fijo</strong></td>
		<?php if(isset($datos['fono'])){ ?>
         <td><?php echo $datos['fono'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>	
	  </tr>
	  <tr>	 
        <td><strong>Tel. Celular</strong></td>
		<?php if(isset($datos['celu'])){ ?>
         <td><?php echo $datos['celu'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
      </tr>
	  <tr>
        <td><strong>E-mail</strong></td>
		<?php if(isset($datos['email'])){ ?>
         <td><?php echo $datos['email'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
	  </tr>
	  <tr>	
	    <td><strong>Act Eco Principal</strong></td>
		<?php if(isset($datos['eco_uno'])){ ?>
         <td><?php echo $datos['eco_uno'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
	  </tr>
	  <tr>	
        <td><strong>Act Eco Secundaria</strong></td>
		<?php if(isset($datos['eco_dos'])){ ?>
         <td><?php echo $datos['eco_dos'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
	  </tr>
	  <tr>	
	    <td><strong>CIIU </strong></td>
		<td><?php echo $ciiu_r;?></td>
      </tr>
	  <tr>	
	    <td><strong>Antiguedad Actividad (Años)</strong></td>
		
		<?php if(isset($datos['ant_tr'])){ ?>
        <td><?php echo encadenar(4).$datos['ant_tr'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>	 	 
	  </tr>
	  <tr>
         <td><strong>Dir Tra/Neg</strong></td>
		 
		 <?php if(isset($datos['dir_tr'])){ ?>
          <td><?php echo $datos['dir_tr'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>	  
	  </tr>
	  <tr>
	     <td><strong>Zona Trab/Neg</strong></td>
        <?php if(isset($datos['zon_tr'])){ ?>
          <td><?php echo $datos['zon_tr'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
	  </tr>
	  <tr>
        <td><strong>Tel. Trab/Neg</strong></td>
		
        <?php if(isset($datos['fon_t'])){ ?>
          <td><?php echo $datos['fon_t'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
	  </tr>
	  <tr>
        <td><font  color="#0000CC">
            <strong>Referencia </strong></font></td>
		<td align="left"><font  color="#0000CC">
            <strong>Personal</strong></font></td>
      </tr>
	  <tr>
	     <td><strong>Nombre(s) y Apellidos</strong></td>
		 
		 <?php if(isset($datos['nom_ref'])){ ?>
          <td><?php echo $datos['nom_ref'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>		  
	  </tr>
	  <tr>
	     <td><strong>Direccion</strong></td>
		
		  <?php if(isset($datos['dir_ref'])){ ?>
         <td><?php echo $datos['dir_ref'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td> 
	  </tr>
	  <tr>
	     <td><strong>Telefono</strong></td>
		 
          <?php if(isset($datos['fon_ref'])){ ?>
         <td><?php echo $datos['fon_ref'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
	  </tr>
	  <tr>
        <td><font  color="#0000CC">
            <strong>Datos Cónyuge</strong></font></td>
	  </tr>     
      <tr>
       <tr>
	     <td><strong>Nombre(s) y Apellidos</strong></td>
		    <?php if(isset($datos['nom_con'])){ ?>
         <td><?php echo $datos['nom_con'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
		</tr>     
      <tr>	 
         <td><strong>Carnet Identidad</strong></td>
		 
         <?php if(isset($datos['ci_con'])){ ?>
         <td><?php echo $datos['ci_con'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
	  </tr> 
	  <tr>
		 <td><strong>Ocupación</strong></td>
		 <?php if(isset($datos['ocu_con'])){ ?>
         <td><?php echo $datos['ocu_con'];?> </td>
		 <?php }else{ ?>
		 <td><?php echo encadenar(20); ?>
			 <?php }?> </td>
      </tr>   
     
	 
 
    
	 </table>
	<center>
	<input class="btn_form" type="submit" name="accion" value="Salir">
	
	 <?php
   }
   }
 ?> 
	
 
</form>
</div>
<div id="FooterTable"> 
Modifique los datos generales del Cliente
</div>
        <?php
		 	include("footer_in.php");
		 ?>
</div>
</body>
</html>
<?php
}
ob_end_flush();
 ?>