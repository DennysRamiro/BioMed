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
      <title>MODULOS</title> 
      <script type="text/javascript" src="script/jquery-1.9.0.js"></script> 
      <link href="css/estilo.css" rel="stylesheet" type="text/css">
      <script type="text/javascript" src="js/Menu.js"></script>

  </head>
<body>


      <?php
        include("header.php");
      ?>
    <div id="pagina_sistema">
         
      <ul id="lista_menu">
         <li id="menu_modulo"><img src="img/app folder_32x32.png" border="0" alt="Modulos" align="absmiddle"> MODULOS </li>
      </ul>
	
      <?php
      $log = $_SESSION['login'];
		  if ($log == "super"){
           $consulta  = "SELECT * 
                         FROM gral_param_propios 
                         WHERE GRAL_PAR_PRO_GRP = 100 AND GRAL_PAR_PRO_COD <> 0 AND GRAL_PAR_PRO_CTA1 = '1'";
           $resultado = mysql_query($consulta) ;
		   }else{
    		   $consulta  = "SELECT GRAL_PAR_PRO_COD, GRAL_PAR_PRO_DESC 
                         FROM gral_permiso_usuario, gral_param_propios 
                         WHERE GRAL_USR_LOGIN = '$log' AND GRAL_USR_ESTADO = 1 AND GRAL_PAR_PRO_GRP = 100 AND 
                               GRAL_PAR_PRO_COD = GRAL_PER_COD_MOD AND GRAL_PAR_PRO_CTA1 = '1'
                        GROUP BY GRAL_PER_COD_MOD";
           $resultado = mysql_query($consulta) ;
      }
       ?>
      <!--   <form name="form2" method="post" action="grab_retro1.php" >
           <select name="cod_modulo[]" size="12" multiple> -->
           <div id="menu_lista">
            <h2> 
              <img src="img/app folder_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
              MODULOS
            </h2>
            <hr style="border:1px dashed #767676;">
               <?php
               while ($linea = mysql_fetch_array($resultado)) {
               ?>
                  <div class="menu_item">
                    
                  <?php
                   if($linea['GRAL_PAR_PRO_COD']=='1000'){ // ESTE ES EL MODULO GENERAL 
                  ?>
                      <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo General">
                       <img src="img/applications_64x64.png"><br>
                  <?php
                   }elseif($linea['GRAL_PAR_PRO_COD']=='2000'){ // ESTE ES EL MODULO CLIENTES
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo Clientes">
                     <img src="img/user office_64x64.png"><br>
                 
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='4000'){  // ESTE ES EL MODULO CREDITOS
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo Creditos">
                     <img src="img/edit file_64x64.png"><br>
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='6000'){ // ESTE ES EL MODULO CARTERA
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo Cartera">
                     <img src="img/windows folder_64x64.png"><br>
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='8000'){ // ESTE ES EL MODULO CONTABILIDAD
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo Contabilidad">
                     <img src="img/calculator_64x64.png"><br>
                      <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='20000'){ // ESTE ES EL MODULO ALMACENES
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo Almacenes">
                     <img src="img/box_64x64.png"><br>
                  <?php
				         }elseif($linea['GRAL_PAR_PRO_COD']=='30000'){ // ESTE ES EL MODULO IMPORTACIONES
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo Importaciones">
                     <img src="img/import_64x64.png"><br>
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='10000'){ // ESTE ES EL MODULO CAJAS
                  ?> 
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo Cajas">
                     <img src="img/fax_64x64.png"><br>
				  	 <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='10100'){ // ESTE ES EL MODULO CAJA CHICA
                  ?> 
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo Caja Chica">
                     <img src="img/caja_chica_64x64.png"><br> 
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='11000'){ // ESTE ESL MODULO  FONDO GARANTIA
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo Fondo de Garantia">
                     <img src="img/open document_64x64.png"><br>
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='13000'){ // ESTE ES EL MODULO INGRESO / EGRESOS
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo General">
                     <img src="img/edit file_64x64.png"><br>
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='14000'){ // ESTE ES EL MODULO COMPRA VENTA DE DIVISAS
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo General">
                     <img src="img/notepad_64x64.png"><br>
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='15000'){// BANCOS DEPOSITOS Y RETIROS
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo General">
                     <img src="img/my documents_64x64.png"><br>
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='6001'){ // CARTERA TRASPASOS
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo General">
                     <img src="img/directories_64x64.png"><br>
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='16000'){ // FACTURACION
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="Modulo General">
                     <img src="img/documents_64x64.png"><br>
                  <?php
                  }elseif($linea['GRAL_PAR_PRO_COD']=='40000'){ // ESTE ES  PARA EL MODULO DE VENTAS
                  ?>
                    <a href="modulo.php?modulo=<?php echo $linea['GRAL_PAR_PRO_COD'];?>" title="MODULO DE VENTAS">
                     <img src="img/order_64x64.png"><br>
                  <?php
                  }
                  ?>    
                  <hr style="border:1px dashed #767676;">
                     <?php echo $linea['GRAL_PAR_PRO_DESC']; ?>
                    </a>
                  </div>
               <?php 
               } 
               ?> 
          </div>
    <br><br>
      
    </div>
        <?php
      include("footer_in.php");
     ?>
   </body>
</html>
<?php
}

?>