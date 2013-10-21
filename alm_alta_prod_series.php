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
<title>INTERSANITAS</title>
        <meta charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
        <script language="javascript" src="script/validarForm.js"></script> 
		<script type="text/javascript" src="script/jquery.numeric.js"></script>
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.0.custom.css" />
        <script src="script/jquery-ui.js"></script>
        <script type="text/javascript" src="js/calendario.js"></script>
        <script type="text/javascript" src="js/Alm_prod_alt.js"></script>
        <script type="text/javascript" src="js/Utilitarios.js"></script>
		<script type="text/javascript" src="js/ValidarNumero.js"></script>  
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
                 <li id="menu_modulo_general_alamacen">
                    <img src="img/box_32x32.png" border="0" alt="Modulo" align="absmiddle"> MOD. ALMACENES
                          
                 </li>
                  <li id="menu_modulo_mante_productos">
                    <img src="img/stuff_32x32.png" border="0" alt="Modulo" align="absmiddle"> MANT. PRODUCTOS
                 </li>
                 <li id="menu_alta_prod">
                    <img src="img/add_prod_32x32.png" border="0" alt="Modulo" align="absmiddle"> ALTA PRODUCTO
                </li>
              </ul> 
  <div id="contenido_modulo">
     <h2> 
      <img src="img/add_prod_64x64.png" border="0" alt="Modulo" align="absmiddle">  
                 ALTA PRODUCTO SERIES
      </h2>
            <hr style="border:1px dashed #767676;">
<!--<form name="form2" method="post" action="grab_retro_cli.php" onSubmit="return ValidaCampos(this)">-->
    <form name="form2" method="post" action="alm_registrar_prod.php?tp=regisserie" enctype="multipart/form-data">
      <?php
	  if (isset ($_GET['msg'])){
        if($_GET['msg'] == 1){
        ?>
          <div id="error_fatal_mysql"> No se pudo registrar los datos del producto por que ocurrio un problema </div>
        <?php
        }
		}
      ?>
      <font  color="#990033" >Ingrese los codigos de Serie individual</font> <br>
	   <?php $cantidad_stock = $_SESSION['cantidad_stock'];
	         $_SESSION['codigo_produc'] =$_SESSION['codigo_producto']; ?>
			
      <table>
          <tr>
              <td> <table align="center">
			  
			   <th>Codigo Producto:</th><td> <?php echo  $_SESSION['codigo_producto']; ?></td>
			    <th>Cantidad:</th><td> <?php echo  $_SESSION['cantidad_stock']; ?></td>
			  </tr> 
          <tr>
            <th>Nombre Producto:</th>
            <td> <?php echo  $_SESSION['nombre_producto']; ?></td>
           </tr>
          
           <?php for ($i=1; $i < $cantidad_stock+1; $i = $i + 1 ) { ?>
       
         <tr>
		    
            <td><font id="serie_color" color="#990033" >Serie:</font></td>
			 <td> <?php echo  $i; ?></td>
			  <?php if ($i == 1){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_1" width="10"  size="16" id="serie_1"
			value = "<?php echo $_SESSION['serie_cliente']; ?>" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 2){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_2" width="10"  size="16" id="id_serie_td" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 3){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_3" width="10"  size="16" id="serie_3" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 4){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_4" width="10"  size="16" id="serie_4" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 5){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_5" width="10"  size="16" id="serie_5" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			  <?php if ($i == 6){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_6" width="10"  size="16" id="serie_6" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			    <?php if ($i == 7){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_7" width="10"  size="16" id="serie_7" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 8){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_8" width="10"  size="16" id="serie_8" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 9){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_9" width="10"  size="16" id="serie_9" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 10){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_10" width="10"  size="16" id="serie_10" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 11){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_11" width="10"  size="16" id="serie_11" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 12){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_12" width="10"  size="16" id="serie_12" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 13){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_13" width="10"  size="16" id="serie_13" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 14){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_14" width="10"  size="16" id="serie_14" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 15){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_15" width="10"  size="16" id="serie_15" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 16){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_16" width="10"  size="16" id="serie_16" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 17){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_17" width="10"  size="16" id="serie_17" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 18){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_18" width="10"  size="16" id="serie_18" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			  <?php if ($i == 19){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_19" width="10"  size="16" id="serie_19" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
			   <?php if ($i == 20){ ?>
            <td id="id_serie_td"><input class="txt_campo" type="text" name="serie_20" width="10"  size="16" id="serie_20" required>
                <div id="error_serie_cliente"></div>
            </td>
			  <?php }?> 
         </tr>
		  <?php }?> 
     
      
       
      
       
       
           <tr>
          <td></td>
		  <td></td>
           <td align="center"><input class="btn_form" type="submit" name="accion" value="Registrar Series"></td>
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