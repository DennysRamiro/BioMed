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
      <title>EDITAR USUARIO</title>
      <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
      <link href="css/estilo.css" rel="stylesheet" type="text/css">
      <script language="javascript" src="script/validarForm.js" type="text/javascript"></script>
      <script type="text/javascript" src="js/MenuManUsuarioModificar.js"></script>
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
              <li id="menu_mant_usuario">
                     <img src="img/tools_24x24.png" border="0" alt="Modulo" align="absmiddle"> MANT. USUARIOS
              </li>
              <li id="menu_cambio_usuario">
                  <img src="img/edit user_32x32.png" border="0" alt="Modulo" align="absmiddle"> 
                      MODIF. USUARIO >>
              </li>
           </ul>
          
        <div id="contenido_modulo">
            <h2> <img src="img/edit user_64x64.png" border="0" alt="Modulo" align="absmiddle"> EDITAR USUARIO </h2>
            <hr style="border:1px dashed #767676;">
            <h4>
          <?php
          $consul = 0;
          //echo $_POST["log"]."dddd";
          if(isset($_POST["log"])){
             $cod_log =$_POST["log"];
           //  echo $cod_log;

             }
             if (empty($cod_log)) {
             $consul = $consul + 1;
             } 
          if(isset($cod_log)){ 
            $log_usr = strtolower($cod_log);
            echo $log_usr;
            $consulta  = "SELECT * 
                          FROM gral_usuario 
                          WHERE GRAL_USR_LOGIN = '$log_usr' AND GRAL_USR_USR_BAJA is null ORDER BY GRAL_USR_NOMBRES";
            } else {
            $consul = $consul + 1;
            echo "aqui";
            }

          if(isset($_POST["ci"])){ 
            $c_i = $_POST["ci"];
            }
          if (empty($c_i)) {
             $consul = $consul + 1;
             } else {
             $c_i =  "%".$c_i."%";
             $consulta  = "SELECT * 
                           FROM gral_usuario 
                           WHERE GRAL_USR_CI LIKE '$c_i' 
                           AND GRAL_USR_USR_BAJA is null ORDER BY GRAL_USR_NOMBRES";
          }
          if(isset($_POST["nombres"])){ 
             $nom = $_POST["nombres"];
           }
          if (empty($nom)) {
               $consul = $consul + 1;
            } else {
             $nom =  "%".strtoupper($nom)."%";
             echo $nom;
             $consulta  = "SELECT * 
                           FROM gral_usuario 
                           WHERE GRAL_USR_NOMBRES LIKE '$nom' 
                           AND GRAL_USR_USR_BAJA is null ORDER BY GRAL_USR_NOMBRES"; 
          }
          if(isset($_POST["ap_pater"])){ 
             $a_pat = $_POST["ap_pater"];
             }
          if (empty($a_pat)) {
              $consul = $consul + 1;
              } else {
            $a_pat = "%".strtoupper($a_pat)."%";
            
            $consulta  = "SELECT * 
                          FROM gral_usuario 
                          WHERE GRAL_USR_AP_PATERNO LIKE '$a_pat' 
                          AND GRAL_USR_USR_BAJA is null ORDER BY GRAL_USR_NOMBRES"; 
          } 
          if(isset($_POST["ap_mater"])){ 
            $a_mat = $_POST["ap_mater"]; 
            }
          if (empty($a_mat)) {
              $consul = $consul + 1; 
              } else {
            $a_mat = "%".strtoupper ($a_mat)."%"; 
            $consulta  = "SELECT * 
                          FROM gral_usuario 
                          WHERE GRAL_USR_AP_MATERNO LIKE '$a_mat' 
                          AND CLIENTE_USR_BAJA is null ORDER BY GRAL_USR_NOMBRES";
          } 

          if ($consul == 5) {
             //echo "Consultara todos";
             $consulta  = "SELECT * 
                           FROM gral_usuario 
                           WHERE GRAL_USR_USR_BAJA is null 
                           ORDER BY GRAL_USR_NOMBRES ";
          }
          echo  $consul;

           //  $consulta  = "Select * From gral_usuario where GRAL_USR_USR_BAJA is null";
           //}
          ?> 
          </h4> 
           <?php  
             $resultado = mysql_query($consulta);
          ?>

              <form name="form2" method="post" action="gral_man_usr_cm.php" target="_self" >
         
                  <table  class="table_usuario">
                  	<tr>
                  		<th>Carnet identidad</th>
                  		<th>Login</th>
                  		<th>Nombres</th>
                  		<th>Ap.Paterno</th>
                  		<th>Ap.Materno</th>
                  		<th>Modificar?</th>
                  	</tr>
                  <?php
                  while ($linea = mysql_fetch_array($resultado)) {
                         $cod_log = $linea['GRAL_USR_LOGIN'];
                  	 ?>
                  	 <tr class="tr_usuario">
                      		<td><?php echo $linea['GRAL_USR_CI']; ?></td>
                      		<td><?php echo $linea['GRAL_USR_LOGIN']; ?></td>
                      		<td><?php echo $linea['GRAL_USR_NOMBRES']; ?></td>
                      		<td><?php echo $linea['GRAL_USR_AP_PATERNO']; ?></td>
                      		<td><?php echo $linea['GRAL_USR_AP_MATERNO']; ?></td>
                      		<td><INPUT NAME="cod_log" TYPE=RADIO VALUE="<?php echo $cod_log; ?>" ></td>
                      </tr>
                  	 <?php
                  }
                  ?>
                  </table>
                  <input type="submit" name="accion" value="Modificar" class="btn_form">
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