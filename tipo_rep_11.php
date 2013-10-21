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
<title>Tipo Reporte</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCartera.js"></script> 

<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
</head>
<body>	<?php
				include("header.php");
			?>
	<div id="pagina_sistema">
          
        <ul id="lista_menu">      
                  <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_cartera">
                    
                     <img src="img/windows folder_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CARTERA
                    
                 </li>
                  <li id="menu_modulo_cartera_resumenCartera">
                    
                     <img src="img/notepad_32x32.png" border="0" alt="Modulo" align="absmiddle"> REPORTES CARTERA
                    
                 </li>
                 <li id="menu_modulo_fecha">
                    
                     <img src="img/delete user_24x24.png" border="0" alt="Modulo" align="absmiddle"> DET. CART. POR ASESOR
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <img src="img/delete user_64x64.png" border="0" alt="Modulo" align="absmiddle"> DETALLE DE CARTERA POR ASESOR</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
           Ingrese la fecha de vencimiento
        </div>
	<br>

				<?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);
				 
				  $con_ase = "Select * From gral_usuario where GRAL_USR_CARGO = 2 and
				               GRAL_USR_CODIGO < 11 and GRAL_USR_USR_BAJA is null order by GRAL_USR_NOMBRES";
                 $res_ase = mysql_query($con_ase);
                ?> 
	
           

	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="cart_rep_det_a.php" onSubmit="return ValidarCamposUsuario(this)">
        <strong>Fecha Calculo</strong>
         <input class="txt_campo" type="text" id="datepicker" name="fec_nac" maxlength="10"  size="10" > 

			 <BR><br>
			<strong>Moneda  </strong>
		    <?php echo encadenar(8);?>
            <select name="cod_mon" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_mon)) {?>
             <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	         <?php } ?>
		     </select>
			  <BR><br>
			<strong>Asesor  </strong>
		    <?php echo encadenar(8);?>
            <select name="cod_ase" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_ase)) {?>
             <option value=<?php echo $linea['GRAL_USR_CODIGO']; ?>>
			 <?php echo $linea['GRAL_USR_NOMBRES'].encadenar(2).
			          $linea['GRAL_USR_AP_PATERNO'] ; ?></option>
	         <?php } ?>
		     </select>
			  <BR><br>
			  <table align="left">
			  <tr>
                 <th ><?php echo "Vig - Ven - Eje"; ?></th>
			     <td ><INPUT NAME="ctot" TYPE=RADIO VALUE="S"></td>
			  </tr>
			   <tr>
                 <th ><?php echo "Solo Vigentes"; ?></th>
			     <td ><INPUT NAME="cvig" TYPE=RADIO VALUE="S"></td>
			  </tr>
			  <tr>
                 <th ><?php echo "Solo Vencidos"; ?></th>
			     <td ><INPUT NAME="cven" TYPE=RADIO VALUE="S"></td>
			  </tr>
			  <tr>
                 <th ><?php echo "Solo Ejecucion"; ?></th>
			     <td ><INPUT NAME="ceje" TYPE=RADIO VALUE="S"></td>
			  </tr>
			   <tr>
                 <th ><?php echo "Solo Castigados"; ?></th>
			     <td ><INPUT NAME="ccas" TYPE=RADIO VALUE="S"></td>
			  </tr>
			</table>
			
  <BR><br>
  <BR><br> <BR><br>
  <BR><br>
	  <input class="btn_form" type="submit" name="accion" value="Procesar">
    </form>
   <BR>
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