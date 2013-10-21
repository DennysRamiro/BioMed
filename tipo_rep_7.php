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
<title>Tipo Reporte</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosCreditosInfoCred.js"></script>
<meta charset="UTF-8"> 
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
                 <li id="menu_modulo_creditos">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/favorites_24x24.png" border="0" alt="Modulo" align="absmiddle"> REASIGNA CART. ASE.
                    
                 </li>
              </ul>
	
<div id="contenido_modulo">

                      <h2> <img src="img/favorites_64x64.png" border="0" alt="Modulo" align="absmiddle"> REASIGNA CARTERA DE ASESORES</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
				         	 <img src="img/alert_32x32.png" align="absmiddle">
				         	Ingrese los Asesores
				        </div>

				<?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);
				  $con_ase1= "Select * From gral_usuario where GRAL_USR_CARGO = 2 and
				               GRAL_USR_CODIGO < 11 and GRAL_USR_USR_BAJA is null order by GRAL_USR_NOMBRES";
                 $res_ase1 = mysql_query($con_ase1);
				 $con_ase2 = "Select * From gral_usuario where GRAL_USR_CARGO = 2 and
				               GRAL_USR_CODIGO < 11 and GRAL_USR_USR_BAJA is null order by GRAL_USR_NOMBRES";
                 $res_ase2 = mysql_query($con_ase2);
                ?> 
  
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
     <form name="form2" method="post" action="trasp_cartera_ase.php" onSubmit="return ValidarRangoFechas(this)">
	<br>
	<?php
	if(isset($_SESSION['msj_error'])){	
	   echo $_SESSION['msj_error']; 
	   }
	   
	?>	<br>		
	
       
		 <strong>Asesor Original  </strong>
		    <?php echo encadenar(6);?>
           <select name="cod_ase" size="1"  >
   	         <?php while ($linea1 = mysql_fetch_array($res_ase1)) {?>
             <option value=<?php echo $linea1['GRAL_USR_CODIGO']; ?>>
			 <?php echo $linea1['GRAL_USR_NOMBRES'].encadenar(2).
			          $linea1['GRAL_USR_AP_PATERNO'] ; ?></option>
	         <?php } ?>
			  </select> 
			 			 <br><br>
            
			 <strong>Asesor Nuevo </strong>
		    <?php echo encadenar(8);?>
            <select name="cod_ase2" size="1"  >
   	         <?php while ($linea2 = mysql_fetch_array($res_ase2)) {?>
             <option value=<?php echo $linea2['GRAL_USR_CODIGO']; ?>>
			 <?php echo $linea2['GRAL_USR_NOMBRES'].encadenar(2).
			          $linea2['GRAL_USR_AP_PATERNO'] ; ?></option>
	         <?php } ?>
		     </select> 
			 <br /><br>
	  <input class="btn_form" type="submit" name="accion" value="Procesar">
    </form>

	
 
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