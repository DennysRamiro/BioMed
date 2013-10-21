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
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js"></script> 

<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script> 
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
                 <li id="menu_modulo_general">
                    
                     <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO CREDITOS
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/officer_32x32.png" border="0" alt="Modulo" align="absmiddle"> COBROS
                    
                 </li>
                   <li id="menu_modulo_fecha">

                     <?php if ($_SESSION['tipo'] == 1){ ?>
                  <img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle">PROX. VENCIMIENTOS
                 <?php } ?>
                 <?php if ($_SESSION['tipo'] == 2){ ?>
                 <img src="img/edit file_32x32.png" border="0" alt="Modulo" align="absmiddle">VENCIMIENTO FINAL
                  <?php } ?>
                    
                     <!--img src="img/directories_32x32.png" border="0" alt="Modulo" align="absmiddle"-->
                    
                 </li>
              </ul>  
              <div id="contenido_modulo">
<h2> <!--img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle"-->
<?php
                 //$fec = leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon)or die('No pudo seleccionarse tabla')  ;
                ?> 
		
         
            
            	 <!--img src="images/24x24/001_36.png" border="0" alt="Modulo"-->
				 <?php if ($_SESSION['tipo'] == 1){ ?>
                 <img src="img/directories_64x64.png" border="0" alt="Modulo" align="absmiddle">
                 PROXIMOS VENCIMIENTOS
				 <?php } ?>
				 <?php if ($_SESSION['tipo'] == 2){ ?>
                 <img src="img/edit file_64x64.png" border="0" alt="Modulo" align="absmiddle">
				  VENCIMIENTO FINAL
				  <?php } ?>

</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/alert_32x32.png" align="absmiddle">
          Ingrese la fecha de vencimiento
        
         </div>       
				
		
           
			

 <?php if ($_SESSION['tipo'] == 1){ ?>	
     <form name="form2" method="post" action="cart_prox_vto.php" onSubmit="return ValidarRangoFechas(this)">
<?php } ?>	 
	<?php if ($_SESSION['tipo'] == 2){ ?>	
     <form name="form2" method="post" action="cart_vto_fin.php" onSubmit="return ValidarRangoFechas(this)">
<?php } ?>	 
	 
	 
	<br>
	<?php
	if(isset($_SESSION['msj_error'])){	
	   echo $_SESSION['msj_error']; 
	   }
	?>	
	<br>	
	
        <strong>Fecha Desde</strong>
         <input class="txt_campo" id="datepicker" type="text" name="fec_des" maxlength="10"  size="10" > 
        
			 <BR><br>
		 <strong>Fecha Hasta</strong>
         <input class="txt_campo" id="datepicker2" type="text" name="fec_has" maxlength="10"  size="10" > 
         		
	  <BR><br>
  <strong>Moneda  </strong>
		    <?php echo encadenar(6);?>
            <select name="cod_mon" size="1"  >
   	         <?php while ($linea = mysql_fetch_array($res_mon)) {?>
             <option value=<?php echo $linea['GRAL_PAR_INT_COD']; ?>>
			 <?php echo $linea['GRAL_PAR_INT_DESC']; ?></option>
	         <?php } ?>
		     </select>
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