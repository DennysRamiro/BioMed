<?php
   ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
		header("Location: index.php?error=1");
} else { 
	require_once('configuracion.php');
    require_once('funciones.php');
?>
<html>
<head>
<!--Titulo de la pesta&ntilde;a de la pagina-->
<title>Alta Dosificaci&oacute;n Facturas Computarizado</title>
<meta charset="UTF-8">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="script/calendar_us.js"></script>
<script language="javascript" src="script/validarForm.js" type="text/javascript"> </script>  
<script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
<script type="text/javascript" src="js/ModulosContabilidad.js"></script> 
<script type="text/javascript" src="js/Utilitarios.js"></script>

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>

</head>
<body>
  <?php
				include("header.php");

					 //$fec = leer_param_gral();
					 //$fec1 = cambiaf_a_mysql_2($fec);
					 //$logi = $_SESSION['login']; 
					 //$log_usr = $_SESSION['login']; 
				?>
          
  <div id="pagina_sistema">        
    <div id="contenido_modulo">
        
        <form name="form2" method="post" action="con_retro_1.php" onSubmit="return ValidaCamposEgresos(this)">

            <table align="center">
	
             <tr>
                <th align="left">NIT del Proveedor :</th>
	              <td><input class="txt_campo" type="text" name="cod_ord" id="cod_ord" size="15" maxlength="15" > 
		            <div id="error_cod_ord"></div></td>
		         </tr>
		         <tr>
                <th align="left">Nro. de Factura :</th>
	               <td><input class="txt_campo" type="text" name="nro_fac" id="nro_fac" size="10" maxlength="10" > 
		            <div id="error_nro_fac"></div> </td>
		         </tr> 
		         <tr>
                <th align="left" >Nro de Autorizacion</th>
                <td><input class="txt_campo" type="text" name="fec_des" id="datepicker" maxlength="10"  size="10" > </td>
		        </tr>
		        <tr>
                <th align="left" >Nombre o Razon Social :</th>
                <td><input class="txt_campo" type="text" name="fec_has" id="datepicker2" maxlength="10"  size="10" > </td>
		       </tr>
		       <tr>   
              <th align="left" >Periodo :</th>
              <td><input class="txt_campo" type="text" name="fec_has" id="datepicker2" maxlength="10"  size="10" > 
    			     <div id="error_llave"></div> </td>
         </tr>
          <tr>
            <th align="left">Importe Total :</th>
              <td><input class="txt_campo" type="text" name="cod_ord" id="cod_ord" size="15" maxlength="15" > 
              <div id="error_cod_ord"></div></td>
         </tr>
         <tr>
              <th align="left">Importe ICE :</th>
              <td><input class="txt_campo" type="text" name="nro_fac" id="nro_fac" size="10" maxlength="10" > 
              <div id="error_nro_fac"></div> </td>
        </tr> 
         <tr>
              <th align="left" >Importe Excento</th>
             <td><input class="txt_campo" type="text" name="fec_des" id="datepicker" maxlength="10"  size="10" > </td>
         </tr>
         <tr>
              <th align="left" >Total NETO :</th>
             <td><input class="txt_campo" type="text" name="fec_has" id="datepicker2" maxlength="10"  size="10" > </td>
         </tr>
         <tr>   
             <th align="left" >Credito Fiscal IVA :</th>
              <td><input class="txt_campo" type="text" name="fec_has" id="datepicker2" maxlength="10"  size="10" > 
            <div id="error_llave"></div> </td>
         </tr>
         <tr>   
            <th align="left" >Codigo de Control :</th>
            <td><input class="txt_campo" type="text" name="fec_has" id="datepicker2" maxlength="10"  size="10" >
            <div id="error_llave"></div> </td>
         </tr>
    </table>
      	 <center>
      	    <br>
	         <input class="btn_form" type="submit" name="accion" value="Graba">
           <input class="btn_form" type="submit" name="accion" value="Salir">

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