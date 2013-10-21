<?php
    ob_start();
if (!isset ($_SESSION)){
	session_start();
	}
	require('configuracion.php');
    require('funciones.php');
?>
<html>
<head>
<title>Tipo Reporte Contabilidad</title>

<!--script type="text/javascript" src="js/contabilidad_repo.js"></script--> 
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
 


<script language="javascript" src="script/validarForm.js"></script>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/contabilidad_reportes.js"></script> 

 <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script> 
<script type="text/javascript" src="js/calendario.js"></script>
<script type="text/javascript" src="js/Utilitarios.js"></script> 
<!--script type="text/javascript" src="js/ValidarBoton.js"></script-->

</head>
<body>
<div id="dialog-confirm" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha c&aacute;lculo no puede estar vacio.</font></p>
</div>
<div id="dialog-confirm2" title="Advertencia" style="display:none; ">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><font size="2">El campo Fecha C&aacute;lculo no puede ser mayor a la Fecha Actual.</font></p>
</div>

<?php
				include("header.php");
			?>

<div id="pagina_sistema">
     <ul id="lista_menu">      
                 <li id="menu_modulo">
                    <img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS
                    
                 </li>
                 <li id="menu_modulo_contabilidad">
                    
                     <img src="img/calculator_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. CONTABILIDAD
                    
                 </li>
                  

            <?php if($_SESSION['menu'] == 30){$parm=30?> 
                  <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> EST. SITUACION BS
                    
                 </li>
              </ul>  
			<div id="contenido_modulo">

                      <h2> <img src="img/shield1_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO DE SITUACION EN BS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Ingrese la fecha de c&aacute;lculo de la gesti&oacute;n para ver el Estado de Situaci&oacute;n en Bs.

        </div>

          <?php } elseif($_SESSION['menu'] == 38){$parm=38?> 
                     <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
                 </li>
                    <li id="menu_modulo_cont_reportesotro">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
                  <li id="menu_modulo_fecha">
                    
                     <img src="img/shield1_24x24.png" border="0" alt="Modulo" align="absmiddle"> EST. SITUACION BS
                    
                 </li>
              </ul>  
      <div id="contenido_modulo">

                      <h2> <img src="img/shield1_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO DE SITUACION EN BS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Ingrese la fecha de c&aacute;lculo de la gesti&oacute;n para ver el Estado de Situaci&oacute;n en Bs. 
        </div>

        

          <?php } elseif($_SESSION['menu'] == 31){$parm=31?>
          <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
        <li id="menu_modulo_fecha">
                    
                     <img src="img/shield3_24x24.png" border="0" alt="Modulo" align="absmiddle"> EST. SIT. BS./$US
                    
                 </li>
              </ul>  
      <div id="contenido_modulo">

                      <h2> <img src="img/shield3_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO DE SITUACION EN BS./$US</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Ingrese la fecha de c&aacute;lculo de la gesti&oacute;n para ver el Estado de Situaci&oacute;n en Bs./$US
        </div>

         <?php } elseif($_SESSION['menu'] == 39){$parm=39?>
        <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
        </li>
        <li id="menu_modulo_cont_reportesotro">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
        </li>

        <li id="menu_modulo_fecha">
                    
                     <img src="img/shield3_24x24.png" border="0" alt="Modulo" align="absmiddle"> EST. SIT. BS./$US
                    
                 </li>
              </ul>  
      <div id="contenido_modulo">

                      <h2> <img src="img/shield3_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO DE SITUACION EN BS./$US</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Ingrese la fecha de c&aacute;lculo de la gesti&oacute;n para ver el Estado de Situaci&oacute;n en Bs./$US.
        </div>



        <?php } elseif($_SESSION['menu'] == 32){$parm=32?>
        <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
        <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> EST. DE RESULTADOS
                    
                 </li>
              </ul>  
      <div id="contenido_modulo">

                      <h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO DE RESULTADOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Ingrese la fecha de c&aacute;lculo de la gesti&oacute;n para ver el Estado de Resultado.
        </div>

         <?php } elseif($_SESSION['menu'] == 40){$parm=40?>
        <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
        </li>
        <li id="menu_modulo_cont_reportesotro">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
        </li>
        <li id="menu_modulo_fecha">
                    
                     <img src="img/find_24x24.png" border="0" alt="Modulo" align="absmiddle"> EST. DE RESULTADOS
                    
                 </li>
              </ul>  
      <div id="contenido_modulo">

                      <h2> <img src="img/find_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO DE RESULTADOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 
          <img src="img/checkmark_32x32.png" align="absmiddle">
          Ingrese la fecha de c&aacute;lculo de la gesti&oacute;n para ver el Estado de Resultado.
        </div>

         <?php } elseif($_SESSION['menu'] == 33){$parm=33?>
         <li id="menu_modulo_cont_reportes">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
                 </li>
        <li id="menu_modulo_fecha">
                    
                     <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> EST. SUMAS / SALDOS 
                    
                 </li>
              </ul>  
      <div id="contenido_modulo">

                      <h2> <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO DE SUMAS Y SALDOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 

          <img src="img/checkmark_32x32.png" align="absmiddle"> 
          Ingrese la fecha de c&aacute;lculo de la gesti&oacute;n para ver el Estado de Sumas y Saldos.
        </div>

        <?php } elseif($_SESSION['menu'] == 41){$parm=41?>
         <li id="menu_modulo_gest">
                    
                     <img src="img/open document_24x24.png" border="0" alt="Modulo" align="absmiddle"> REP. GEST. PASADAS
                    
        </li>
        <li id="menu_modulo_cont_reportesotro">
                    
                     <img src="img/documents_24x24.png" border="0" alt="Modulo" align="absmiddle"> CONTAB. REPORTES
                    
        </li>
        <li id="menu_modulo_fecha">
                    
                     <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> EST. SUMAS / SALDOS 
                    
                 </li>
              </ul>  
      <div id="contenido_modulo">

                      <h2> <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle"> ESTADO DE SUMAS Y SALDOS</h2>
                      <hr style="border:1px dashed #767676;">
                       <div id="error_login"> 

          <img src="img/checkmark_32x32.png" align="absmiddle"> 
          Ingrese la fecha de c&aacute;lculo de la gesti&oacute;n para ver el Estado de Sumas y Saldos.
        </div>

	 <?php }?>
         
				<?php
                 $fec = $_SESSION['fec_proc'];//leer_param_gral();
                 $logi = $_SESSION['login']; 
				 $con_mon = "Select * From gral_param_super_int where GRAL_PAR_INT_GRP = 18 and GRAL_PAR_INT_COD <> 0 ";
                 $res_mon = mysql_query($con_mon);
   
                ?> 

<center>
	<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
	<?php if ($_SESSION["tipo"] == 1){ ?>
   <form name="form2" method="post" action="cont_situa.php?menu=<?php echo $parm; ?>" onSubmit="return ValidaCamposEstadoBs(this)">
   	<?php } ?>
	<?php if ($_SESSION["tipo"] == 2){ ?>
   <form name="form2" method="post" action="cont_resul.php?menu=<?php echo $parm; ?>" onSubmit="return ValidaCamposEstadoBs(this)">
   	<?php } ?>
	<?php if ($_SESSION["tipo"] == 3){ ?>
   <form name="form2" method="post" action="cont_sumsal.php?menu=<?php echo $parm; ?>" onSubmit="return ValidaCamposEstadoBs(this)">
   	<?php } ?>
	<?php if ($_SESSION["tipo"] == 4){ ?>
   <form name="form2" method="post" action="cont_resul_b.php?menu=<?php echo $parm; ?>" onSubmit="return ValidarCamposUsuario(this)">
   	<?php } ?>
	
	<br>
        <strong>Fecha c&aacute;lculo:</strong>
         <input class="txt_campo" type="text" name="fec_nac" id="datepicker" maxlength="10"  size="10" > 

         <!--script language="JavaScript">
            new tcal ({
                // form name
                'formname': 'form2',
                // input name
                'controlname': 'fec_nac'
            });
            </script-->

			 <BR><br>
			 <table align="center">
			  <tr>
                 <th ><?php echo "Nivel 2"; ?></th>
			     <td ><INPUT NAME="S" TYPE=RADIO VALUE="niv_2"></td>
			  </tr>
			   <tr>
                 <th ><?php echo "Nivel 3"; ?></th>
			     <td ><INPUT NAME="S" TYPE=RADIO VALUE="niv_3"></td>
			  </tr>
			  <tr>
                 <th ><?php echo "Nivel 4"; ?></th>
			     <td ><INPUT NAME="S" TYPE=RADIO VALUE="niv_4"></td>
			  </tr>
			  <tr>
                 <th ><?php echo "Nivel 5"; ?></th>
			     <td ><INPUT NAME="S" TYPE=RADIO VALUE="niv_5"></td>
			  </tr>
			  <tr>
                 <th ><?php echo "Nivel A"; ?></th>
			     <td ><INPUT NAME="S" TYPE=RADIO VALUE="niv_A"></td>
			  </tr>
			</table>
		  <BR>

          <input class="btn_form" type="submit" name="accion" value="Consultar">

     <?php /*
         if ((!isset($_POST['fec_nac'])) or (!isset($_POST['S']))){
          header('Location: tipo_rep_cont.php');
          //echo "VACIO";
          } 
         else { 
          header('Location: cont_result_b.php');
          }*/ ?>

    </form>
    </center>
  
</div>
	<div id="FooterTable">
		
	</div>

</div> 
<?php
		 	include("footer_in.php");
		 ?>
</body>
</html>
<?php
ob_end_flush();
 ?>