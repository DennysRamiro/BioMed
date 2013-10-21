<html>
<head>
<title>.:INTERSANITAS:.</title>
<script type="text/javascript" src="script/jquery-1.9.0.js"></script>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/Login.js"></script>
</head>
<body>
  <div id="titulo_empresa" align="center">
     <hr>
      <img src="img/logos.jpg" width="350">
    <hr>
  </div>
  <div id="franja_color">
    <div id="Login" >
            <!--form name="form1" method="post" action="valida_psw_tb.php"-->
            <h2>Ingresar al Sistema</h2>
            <center>
              <img src="img/user office_128x128.png">
            </center>
            <form id="formulario_login">
              <div  id="error_formulario_login">
              </div>
              <table>
                <tr><td><label>Nombre:</label></td>
                <td><div id="error_nombre_usuario"></div><input type="text" name="login" id="txt_login" class="txt_campo" ></td></tr>
                <tr><td></td><td></td></tr>
                <tr><td><label>Contrase&ntilde;a:</label></td>
                <td><div id="error_password"></div><input type="password" name="clave" id="txt_password" class="txt_campo"></td></tr>
              </table>
              <br>
                <center>
                  <input name="enviar" type="submit" value="Ingresar" class="btn_form">
                </center>
            </form>   
            <br> 
    </div>
  </div>
</body>
</html>

<?php
//}
ob_end_flush();
 ?>
