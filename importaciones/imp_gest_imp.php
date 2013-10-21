<?php
ob_start(); // Esta es por seguridad
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['clave'])){
        header("Location: ../index.php?error=1");
} else {
	require_once 'cabecera.php';
	require_once 'clases/MenuDinamico.php';
	require_once 'clases/Proyecto.php';
	require_once 'clases/Contrato.php';
	require_once 'clases/AgenciaDespachante.php';
	require_once 'clases/OrdenCompra.php';
  require_once 'clases/ItemOrdenCompra.php';
	require_once 'clases/TransferenciaBancaria.php';
  require_once 'clases/Desaduanizacion.php';
	require_once 'clases/DetalleLiquidacion.php';
  require_once 'clases/GuiaEmbarque.php';
  require_once 'clases/Certificado.php';
  require_once 'clases/ListaModificaciones.php';
  require_once 'clases/HojaCosto.php';
?>
	<div id="pagina_sistema">
    <?php
		$menu = new MenuDinamico();
		$enlaces = array('modulo' => array('enlace' =>'../menu_s.php', 'imagen'=>'../img/app folder_32x32.png', 'titulo' => 'MODULOS'),
		                 'importacion' => array('enlace' =>'../modulo.php?modulo=30000', 'imagen'=>'../img/import_32x32.png', 'titulo' => 'IMPORTACION'),
						         'gestion' => array('enlace' =>'#', 'imagen'=>'../img/ges_imp_32x32.png', 'titulo' => 'GESTION IMP.'));			 
		$menu->getMenuDinamico($enlaces);
	?>    
        <div id="contenido_modulo">
             <h2>   
                <img src="../img/ges_imp_64x64.png" border="0" alt="Modulo" align="absmiddle"> 
                 GESTION DE IMPORTACION       
            </h2>
            <hr style="border:1px dashed #767676;">
<!-- codigo para un buscador-->
            <div id="content">
              
                <input type="button" value="Nuevo Poyecto" class="btn_form" onClick="new GestionImportacion().formularioNuevo();"> 
           
    
                  <!--form autocomplete="off"-->
                    <p>
                       <label>Buscar:</label>
                      <input class="txt_campo" type="text" name="proyecto_buscar" id="proyecto_buscar" />
                      <input type="button" value="Buscar Proyecto" class="btn_form" onClick="new GestionImportacion().buscarProyectoBtn();">
                    </p>
                  <!--/form-->
            </div>
<!-- buscador--> 
        <!--hr style="border:1px dashed #767676;"-->
           <div id="tabla_datos_proyectos">
               <table   class="table_usuario" >
                            <tr>
                                <th align="center">NOMBRE</th>
                                <th align="center">COD. PROY.</th>
                                <th align="center">TIPO</th>
                                <th align="center">FECHA INICIO</th>
                                <th align="center">FECHA FIN</th>
                                <th align="center">ESTADO</th>
                                <th align="center">CONTINUAR</th>
                                <th align="center">ACCIONES</th>  
                            </tr> 
						  <?php
                          $proyecto = new Proyecto(); // Aqui se lo instancia
                          $contrato = new Contrato(); //Aqui se esta instanciando para contrato
            			        $agencia_despachante = new AgenciaDespachante(); //Aqui se esta instanciando para agencia
						              $orden_compra = new OrdenCompra(); //Aqui se esta instanciando para proforma
						  //$transferencia_bancaria = new TransferenciaBancaria(); //aqui se esta iniciando la desaduanizacion
                          $desaduanizacion = new Desaduanizacion();
			                    $detalle_liquidacion = new DetalleLiquidacion();
						              $lista_modificacion = new ListaModificaciones(); // Aqui se realiza la lista de los proyectos que se pueden modificar
                          
						             
                          $orden_compra = new OrdenCompra(); //Aqui se esta instanciando para Orden de Compra
						              $transferencia_bancaria = new TransferenciaBancaria(); 
                          $guia_embarque = new GuiaEmbarque(); //Aqui se esta instanciando para Guia Embarque
                          $certificado = new Certificado(); //Aqui se esta instanciando para Guia Embarque

                          //$lista_proyectos = $proyecto->listaProyectos();

                          $item_compra = new ItemOrdenCompra();
                          $hoja = new HojaCosto();
						              $lista_proyectos = $proyecto->listaProyectos(); 
									  
                          //$lista_guias = $guia_embarque->listaGuias();  
                            foreach($lista_proyectos as $key => $proy){
								//print_r($lista_proyectos);
                           ?>
                           
                                <tr class="tr_usuario">
                                            <td align="center"><?php echo $proy['alm_proyecto']['alm_proy_nom']; ?> <input type="hidden" value="" id="codigos_proyectos_hidden" /></td>
                                            <td align="center"><?php echo $proy['alm_proyecto']['alm_proy_cod']; ?></td>
                                            <td align="center"><?php
                                                $param_propios = $proyecto->obtenerTipo($proy['alm_proyecto']['alm_proy_tipo']);
                                                print_r($param_propios[0]['gral_param_propios']['GRAL_PAR_PRO_DESC']);?>
                                            </td>
                                            <td align="center"><?php echo cambiaf_a_normal($proy['alm_proyecto']['alm_proy_fecha_inicio']); ?></td>
                                            <td align="center"><?php echo cambiaf_a_normal($proy['alm_proyecto']['alm_proy_fecha_fin']); ?></td>
                                           
                                            <td align="center">
                                                <?php 
                                                $proveedores_estado= $proyecto->obtenerEstado($proy['alm_proyecto']['alm_proy_estado']);
                                                
                                               if ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==1){ ?>
                                              <font color="#5C3A1C"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==2){?>
                                              <font color="#085F77"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==4){?>
                                              <font color="#73810B"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==5){?>
                                              <font color="#5E463F"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==6){?>
                                              <font color="#258E93"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==7){?>
                                              <font color="#D7600B"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==8){?>
                                              <font color="#125CBC"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==9){?>
                                              <font color="#A47A0F"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==10){?>
                                              <font color="#920406"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==11){?>
                                              <font color="#742CA4"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==12){?>
                                              <font color="#21620F"><B>
                                              <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==13){?>
                                              <font color="#3F20B2"><B>
                                              <?php }
                                                print_r($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_DESC']); ?>
                                              </B></font></td>
                                            
                                            <td align="center"><?php if ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==1){ ?>
													<div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioContrato( <?php echo $proy['alm_proyecto']['alm_proy_id'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/documents_32x32.png" align="absmiddle"><br> Contrato/Pedido</a></div>
												<?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==2){?>
                                                <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioListaOrdenCompra('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/orden_compra_32x32.png" align="absmiddle"><br> Ordenes</a></div>                                         
                                                <?php }  elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==4){ ?>
                                                 <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioTransferenciaBancaria( <?php echo $proy['alm_proyecto']['alm_proy_id'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/transferenciaBancaria_32x32.png" align="absmiddle"><br> Transferencia Bancaria</a></div>   
                                                <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==7) { ?>
                                                 <div style="cursor:pointer"><a  onClick="new GestionImportacion().listaGuiaOpciones( <?php echo $proy['alm_proyecto']['alm_proy_id'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/guia_32x32.png" align="absmiddle"><br> Guia de Embarque</a></div>   
                                                <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==8) { 
                                                          $cert=$guia_embarque->certGuia($proy['alm_proyecto']['alm_proy_cod']);
                                                          if (empty($cert)) {
                                                          ?><div style="cursor:pointer"><a  onClick="new GestionImportacion().listaCertOpciones('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/certificado_32x32.png" align="absmiddle"><br> Certificado</a></div>  
                                                          <?php
                                                           }else{
                                                                  if ($cert[0]['alm_form_importacion']['alm_form_cert_otros']==1){ ?>
                                                            <div style="cursor:pointer"><a  onClick="new GestionImportacion().listaCertOpciones('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/certificado_32x32.png" align="absmiddle"><br> Certificado</a></div> <?php
                                                                  }else if ($cert[0]['alm_form_importacion']['alm_form_cert_otros']==0){ ?>
                                                            <div style="cursor:pointer"><a  onClick="new GestionImportacion().listaDesOpciones( <?php echo $proy['alm_proyecto']['alm_proy_id'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/aduana_32x32.png" align="absmiddle"><br>Desaduanizacion</a></div> <?php
                                                                  }
                                                           }                                                          
                                                           //echo $cert[0]['alm_form_importacion']['alm_form_cert_otros'];
                                                          //if ($cert[0]['alm_form_importacion']['alm_form_cert_otros']==1){ ?>
                                                  <!--div style="cursor:pointer"><a  onClick="new GestionImportacion().listaCertOpciones('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/certificado_32x32.png" align="absmiddle"><br> Certificado</a></div-->   
                                                          <!--?php } elseif ($cert[0]['alm_form_importacion']['alm_form_cert_otros']==0) { ?-->
  
                                                  <!--div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioDesaduanizacion( <?php echo $proy['alm_proyecto']['alm_proy_id'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/aduana_32x32.png" align="absmiddle"><br>Desaduanizacion</a></div--> 
                                                          <!--?php } ?-->
                                                   
                                                <?php }  elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==4){ ?>
                                                 <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioTransferenciaBancaria( <?php echo $proy['alm_proyecto']['alm_proy_id'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/transferenciaBancaria_32x32.png" align="absmiddle"><br> Transferencia Bancaria</a></div>   
                                                <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==5){ 
												                                  // $monto=$transferencia_bancaria->montoTransferencia($proy['alm_proyecto']['alm_proy_cod']);
                                                          //echo $monto[0]['alm_form_importacion']['alm_form_monto_transf'];
                                                          //if ($monto[0]['alm_form_importacion']['alm_form_monto_transf']<=5000){ ?>
                                                             <!--div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioListaConfirmacionTransferenciaBancaria('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/confirmacion_banco_32x32.png" align="absmiddle"><br> Confirmacion Bancaria</a></div--> 
                                                          
                                                          <!--?php } else if ($monto[0]['alm_form_importacion']['alm_form_monto_transf']>5000) { ?-->
                                                             <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioListaCertificadoBancario('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/certification_bancaria_32x32.png" align="absmiddle"><br> Certificacion Bancaria</a></div> 
                                                          <!--?php } ?-->
                                                
                                                <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==6){ ?>
                                                <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioListaConfirmacionTransferenciaBancaria('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/confirmacion_banco_32x32.png" align="absmiddle"><br> Confirmacion Bancaria</a></div> 
                                                 
                                                <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==9){ ?>
                                                <div style="cursor:pointer"><a  onClick="new GestionImportacion().listaDesOpciones( <?php echo $proy['alm_proyecto']['alm_proy_id'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/aduana_32x32.png" align="absmiddle"><br>Desaduanizacion</a></div> 
                                                
                                                <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==10){ ?>
                                                <div style="cursor:pointer"><a  onClick="new GestionImportacion().listaAgeOpciones( <?php echo $proy['alm_proyecto']['alm_proy_id'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/agencia_form_32x32.png" align="absmiddle"><br>Planilla Aduanera</a></div> 
                                                <!--div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioAgenciaDespachante( <?php echo $proy['alm_proyecto']['alm_proy_id'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/agencia_form_32x32.png" align="absmiddle"><br>Planilla Aduanera</a></div-->  
                                                  <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==11){ ?>
                                                <div style="cursor:pointer"><a  onClick="new GestionImportacion().listaDetOpciones('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/costo_desaduanizacion_32x32.png" align="absmiddle"><br>Detalle Liquidacion</a></div>  
                                                <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==12) { ?>
                                                    <div style="cursor:pointer"><a  onClick="new GestionImportacion().formularioListaHojaCosto('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/hoja_costo2_32x32.png" align="absmiddle"><br>Hoja de Costo</a></div> 
                                                 <?php } elseif ($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==13) { ?>
                                                    <div style="cursor:pointer"><a onClick="" ><img src="../img/reporte_final_32x32.png" align="absmiddle"><br>Completo</a></div> 
                                                 <?php } ?>
                                            </td>
        
                                            <td>
                                           <!--acciones de cancelar-->
                                            <?php  if (($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==1) ){?>
                                             <div style="float:left;margin-right:10px; width:40px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().bajaProyecto('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>')"><img src="../img/proyecto_baja_32x32.png">Cancelar</a></div>
                                             
                                              <?php } elseif (($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==2) ){?>
                                                <div style="float:left;margin-right:10px; width:40px; text-align:center; cursor:pointer;"> <a  onclick="new GestionImportacion().eliminarOrden('<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>')"><img src="../img/proyecto_baja_32x32.png">Cancelar</a></div> 
                                             
											 <?php } elseif ((($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==3)) || (($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==10))){?>
                                                <div style="float:left; width:42px; text-align:center; margin-left:0px; margin-right:5px; cursor:pointer;"><a  onClick="new GestionImportacion().formularioModificarAgenciaDespachante( <?php echo $proy['alm_proyecto']['alm_proy_cod'];?>,'<?php echo $proy['alm_proyecto']['alm_proy_cod'];?>');" > <img src="../img/edit_32x32.png" align="absmiddle">Cancelar</a></div>
                                             <?php } elseif (($proveedores_estado[0]['gral_param_propios']['GRAL_PAR_PRO_COD']==4)){?>
                                                <!--div style="float:left;margin-right:10px; width:40px; text-align:center; cursor:pointer;"> <a  onclick="mostrarDialogo(<?php //echo $proy['alm_proyecto']['alm_proy_cod'];?>)"><img src="../img/proyecto_baja_32x32.png">Cancelar</a></div-->
                                              <?php } ?>
                                            </td>   
          
                                 </tr>
                          <?php		
                            }
                           ?>
        </table>
		</div>
	</div>
 </div>
<?php
	$proyecto->formularioNuevo(); // Este es el formulario de nuevo proyecto
	$contrato->formularioContrato(); // Este es el formulario de neuvo contrato
	$orden_compra->formularioListaOrdenCompra(); //Es el dialog de la lista de orden compra
	$orden_compra->formularioNuevaOrdenCompra(); // Este es el formulario de nueva orden compra
  $guia_embarque->formularioGuiaEmbarque(); // Este es el formulario de nueva guia de embarque
  $guia_embarque->listaGuiaOpciones(); // Este es el formulario de nueva guia de embarque
  $guia_embarque->formularioListaGuiaEmbarque(); // Este es el formulario de nueva guia de embarque
  $guia_embarque->formularioGuiaEmbarqueLista(); // Este es el formulario de nueva guia de embarque
  $guia_embarque->formularioDetallarGuiaEmbarque(); // Este es el formulario de lista guia de embarque con o sin certificado
  $certificado->formularioListaCertificado(); // Este es el formulario de lista certificados
  $certificado->formularioListaCertificadoProv(); // Este es el formulario de lista certificados
  $certificado->formularioNuevoCertificado(); // Este es el formulario de nuevo certificado
  $certificado->listaCertOpciones(); // Este es el formulario de nuevo certificado
  $certificado->formularioNuevoCertificadoProv(); // Este es el formulario de grabar nuevo certificado
	$agencia_despachante->formularioAgenciaDespach();//Formulario para la agenica aduanera
	$agencia_despachante->formularioModificacionAgenciaDespach();//Formulario para Modificar la agenica aduanera
  $agencia_despachante->formularioListarAgenciaDespachante();//Formulario para listar la planilla agencia aduanera
	$agencia_despachante->listaAgeOpciones();
  $orden_compra->formularioListaOrdenCompra(); //Es el dialog de la lista de proyectos
  $item_compra->formularioNuevoItemOrdenCompra(); // Este es el formulario de nuevo item
	$transferencia_bancaria->formularioTransferenciaBancaria(); // Este es el formulario de transferencia Bancaria
	$transferencia_bancaria->formularioConfirmacionTransferenciaBancaria(); //este es para la confirmacion bancaria
  $transferencia_bancaria->formularioDetallarConfirmacionBancaria(); //este es para la confirmacion bancaria  
	$transferencia_bancaria->formularioCertificacionTransferenciaBancaria(); //este es para la certificacion bancaria
  $transferencia_bancaria->formularioListaCertificadoBancario(); //este es para la certificacion bancaria
  $transferencia_bancaria->formularioDetallarCertificadoBancario(); //este es para la certificacion bancaria
  $transferencia_bancaria->formularioListaConfirmacionTransferenciaBancaria(); //este es para la certificacion bancaria
  $desaduanizacion->formularioDesaduanizacion(); //este es la desaduanizacion 
  $desaduanizacion->listaDesOpciones(); //este es la desaduanizacion
  $desaduanizacion->formularioListaDesaProv(); //este es la desaduanizacion
  $desaduanizacion->formularioDesaduanizacionProv(); //este es la desaduanizacion
  $desaduanizacion->formularioDetallarDesa(); //este es la desaduanizacion
	$detalle_liquidacion->formularioDetalleLiquidacion(); // Este es el detalle de liquidacion de la Poliza
  $detalle_liquidacion->formularioDetalleLiquidacionCons(); 
  $detalle_liquidacion->formularioListaDetalleLiquidacion(); // Este es la lista de detalle de liquidacion de la Poliza
  $detalle_liquidacion->listaDetOpciones();
  $proyecto->dialogoMensaje(); // Es de los mensajes
	$orden_compra->detallarOrdenCompra();

  $certificado->formularioDetallarCertificado();
  $certificado->formularioDetallarCertificadoProv();
  $lista_modificacion->formularioListaModificaciones(); //Este es la lista de las modificaciones
  $contrato->formularioModificarContrato(); //Este es que modifica el contrato
  //$certificado->formularioDetallarCertificado();
  $lista_modificacion->formularioListaModificaciones(); //Este es la lista de las modificaciones
	$contrato->formularioModificarContrato(); //Este es que modifica el contrato
  //$certificado->formularioDetallarCertificado();
  //$hoja->formularioHojaCosto(); //Este es el formulario de la hoja de costo 
  $hoja->generarCabeceraHoja(); //Este es el formulario de la hoja de costo 
 // $hoja->actualizarDetalleHoja(); //Este es el formulario de la hoja de costo 
  $hoja->formularioListaHojaCosto(); //Este es el formulario de la hoja de costo
  $hoja->procesarFormDet(); //Este es el formulario de la hoja de costo
  $hoja->formularioListaItems(); //Este es el formulario de la hoja de costo
  $hoja->formularioItemsAlmacen(); //Este es el formulario de la hoja de costo     
  $hoja->serieDialog(); //Este es el formulario de la hoja de costo
  $hoja->grabarCabecera(); //Este es el formulario de la hoja de costo  
  //$certificado->formularioDetallarCertificado();
  //$hoja->formularioHojaCosto(); //Este es el formulario de la hoja de costo 
  //$hoja->formularioListaHojaCosto(); //Este es el formulario de la hoja de costo
  
  $transferencia_bancaria->formularioNuevaTransferenciaBancaria();

	require_once 'pie_pagina.php';
}
ob_end_flush(); // Por seguridad
?>