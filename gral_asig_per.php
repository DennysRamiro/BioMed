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
        <title>ASIGNACION DE PERMISOS</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <script language="JavaScript" src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/MantListaUsuario.js"></script>
		
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
                <img src="img/applications_32x32.png" border="0" alt="Modulo" align="absmiddle"> MODULO GENERAL
            </li>
            <li id="menu_modulo_fecha_cambio">
                <img src="img/tools_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. USUARIO
            </li>
            <li id="menu_modulo_mant_listausuarios">
                <img src="img/edit user_24x24.png" border="0" alt="Modulo" align="absmiddle"> ASIGNAR PERMISO
            </li>
           </ul>
		   
		   	<?php
            // Se realiza una consulta SQL
            /*$consulta  = "SELECT * 
                          FROM gral_usuario 
                          WHERE GRAL_USR_USR_BAJA is null";*/
            $consulta ="SELECT *
                        FROM gral_usuario, gral_param_propios 
                        WHERE GRAL_USR_USR_BAJA is null AND gral_param_propios.GRAL_PAR_PRO_GRP=300  
                             AND gral_param_propios.GRAL_PAR_PRO_COD = gral_usuario.GRAL_USR_CARGO 
						ORDER BY GRAL_USR_NOMBRES";
            $resultado = mysql_query($consulta);
            ?>
		    
            <div id="contenido_modulo">
           <h2>
             <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle"> ASIGNAR PERMISO
          </h2>
          <hr style="border:1px dashed #767676;">
		  
		   <form name="form2" method="post"  action="" target="_self" >
           <table class="table_usuario" width="70%" align="left">
                    <tr>
                        <th>Login</th><th>Nombres</th><th>Ap.Paterno</th>
                        <th>Ap.Materno</th><th>Cargo</th>
                        <th>Asignar Permiso</th>
                    </tr>
               <?php
               while ($linea = mysql_fetch_array($resultado)) {
                     ?>
                     <tr class="tr_usuario">
                        <td><?php echo $linea['GRAL_USR_LOGIN']; ?>&nbsp;</td>
                        <td><?php echo $linea['GRAL_USR_NOMBRES']; ?>&nbsp;</td>
                        <td><?php echo $linea['GRAL_USR_AP_PATERNO']; ?>&nbsp;</td>
                        <td><?php echo $linea['GRAL_USR_AP_MATERNO']; ?>&nbsp;</td>
                        <td><?php echo $linea['GRAL_PAR_PRO_DESC']; ?>&nbsp;</td>
                         <td align="justify"><a href='gral_asig_per_usu.php?log=<?php echo $linea['GRAL_USR_LOGIN']; ?>'> Asignar</a></td>
                    </tr> 
                     <?php
                }
                ?>
                </table>
				 <br>
				<table width="70%" align="center">
         			<tr>
                     <td>&nbsp;</td>
					 <br>
              		</tr>
                </table>
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