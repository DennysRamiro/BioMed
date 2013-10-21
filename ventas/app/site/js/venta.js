
/**
 * Esta es la clase cliente de 
 * @author Dennys Gutierrez
 */
var limit_par=10;
var num_par =10;

function Venta(){


  /*
   * Este es el estilo de la pagina para que se pueda 
   * 
   */
   this.init = function(){

	   	/*
	   	 $("#tabs").tabs();
	   	 $(".btn_ventas").button();
	     $("#txt_vent_cliente_proforma").keyup(function(){
	        new Home().buscarClientePriv($('#txt_vent_cliente_proforma').val());
	     });
	     $("#txt_vent_cliente_proforma_publ").keyup(function(){
	        new Home().buscarClientePubl($('#txt_vent_cliente_proforma_publ').val());
	     });
	*/

	     new Venta().listarventasPriv(0, limit_par, num_par);
       new Venta().actualizarFormularioVentasPriv();
     
   }

	/**  
   * Esta es la lista de cotizaciones privadas
   */
  this.listarventasPriv = function(start, limit, num){

  	  
      pag = 1;
      if(start != 0 && start != 1){
        pag = start;
        start = start*num-(num);
        limit = pag*num;
      }else{
        start = 0;
        limit = num;
      }
      $.ajax({
        url:'index.php',
        dataType: 'json',
        type: 'GET',
        data : { 
          action : 'ventas',
          tp : 'listarVentasPriv',
          start : start,
          limit : limit
        },
        beforeSend : function(){
          $('#div_lista_venta_nuevas_priv').empty();
          $('#div_lista_venta_nuevas_priv').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
        },                      
        success: function(res){
          //console.log(res);
          $('#div_lista_venta_nuevas_priv').empty();
          var tabla_cabecera = '<div id="buscar_cot_priv"><span><strong>BUSCAR:</strong></span> <input type="text" name="palabra_cot_buscar" id="palabra_cot_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Home().buscarCotizacionesPrivBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_cot_vent" id="id_unico_cot_vent">';
          tabla_cabecera = tabla_cabecera+'<table id="tb_vent_lista_cotizaciones_priv" class="table_usuario">';
          //tabla_cabecera = tabla_cabecera+'<tr><td><br><div id="buscar_cliente"><span>Buscar Cotizacion:</span> <input type="text" name="palabra_cliente_buscar" id="palabra_cliente_buscar" class="txt_campo"><input type="button" value="Buscar" class="btn_form" onclick="new Cliente().buscarCliente();"><input type="hidden" name="id_unico_cliente_vent" id="id_unico_cliente_vent"></td></tr>';
          tabla_cabecera = tabla_cabecera+'<th>N</th><th>CODIGO</th><th>CLIENTE</th><th>CODIGO CLIENTE</th><th>OPERADOR</th><th>FECHA INICIO</th><th>FECHA ENTREGA</th><th>FORMA DE PAGO</th><th>DETALLAR</th><th>ELIMINAR</th>';
          var total=res[0].total;
          //console.log(total);
          var nro=0;
          $.each(res, function(index, value){
              nro++;                  
              tabla_cabecera = tabla_cabecera +'<tr><td>'+nro+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.vent_prof_cab_cod_prof+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.nombre_cliente+'&nbsp;'+value.ap_pat_cliente+'&nbsp;'+value.ap_mat_cliente+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.codigo_cliente+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.nom_op+'&nbsp;'+value.ap_part_op+'&nbsp;'+value.ap_mat_op+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.vent_prof_cab_fech_cot+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.vent_prof_cab_fech_entrega_cot+'</td>';
              //tabla_cabecera = tabla_cabecera +'<td>'+value.nom_compra+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.nom_pago+'</td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Venta().detallarVentaPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/consulta_contrato_32x32.png" align="absmiddle"><br> Detallar</a></td>';
              //tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().eliminarCotPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Venta().eliminarVentaPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
          });
               tabla_cabecera = tabla_cabecera+'</table>';
              $('#div_lista_venta_nuevas_priv').append(tabla_cabecera);
              $("#palabra_cot_buscar").keyup(function(){
              new Home().buscarCotizacionesPriv($('#palabra_cot_buscar').val());
              });
              var paginas = Math.ceil(total/num);
              paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
              for (var i=1;i<=paginas;i++) {
                paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
                if(pag == i){
                  paginacion_div = paginacion_div+i;
                }else{
                  paginacion_div = paginacion_div+'<a href="#" onClick="new Venta().listarCotizacionesPriv('+i+', '+limit+', '+num+')">'+i+'</a>';            
                }
                paginacion_div = paginacion_div+'</div>';
              }
              paginacion_div = paginacion_div+'</div></div>';
              $('#div_lista_venta_nuevas_priv').append(paginacion_div);
     
        
        },
        error: function(resultado){
        
        }
        });
	}

	 /**
   * Metodo para detallar Ventas Privadas
   */

  this.detallarVentaPriv = function(id_unico){
    //alert(id_unico);
      $.ajax({
        url:'index.php',
        dataType: 'json',
        type: 'GET',
        data : { 
          action : 'ventas',
          tp :'getCabeceraVentaPriv',
          id_prof: id_unico
        },
        beforeSend : function(){
        },
        success: function(resultado){
            //console.log(resultado);
            var codigo_unico=resultado[0].codigo_unico;
            $('#tpl_vent_form_nuevo_venta_det_priv').empty();
                var tabla_cabecera_venta = '<table aling="center" id="tb_vent_det_cab_venta_priv" class="table_usuario">';
                $.each(resultado, function(index, value){      
                  tabla_cabecera_venta = tabla_cabecera_venta+'<h3><img src="../img/my documents_32x32.png" align="absmiddle"> VENTA PRIVADA</h3><hr style="border:1px dashed;">';
                  tabla_cabecera_venta = tabla_cabecera_venta +'<tr><th>CODIGO PROF.:</th><td>'+value.vent_prof_cab_cod_prof+'</td><th>FORMA DE PAGO:</th><td>'+value.nom_pago+'</td></tr>';
                  tabla_cabecera_venta = tabla_cabecera_venta +'<tr><th>CODIGO CLIENTE:</th><td>'+value.cod_cliente+'</td><th>CLIENTE:</th><td>'+value.nombre_cliente+'&nbsp;'+value.ap_pat_cliente+'&nbsp;'+value.ap_mat_cliente+'</td></tr>';
                  tabla_cabecera_venta = tabla_cabecera_venta +'<tr><th>CODIGO OPE.:</th><td>'+value.cod_operador+'</td><th>OPERADOR:</th><td>'+value.nom_op+'&nbsp;'+value.ap_part_op+'&nbsp;'+value.ap_mat_op+'</td>';
                  tabla_cabecera_venta = tabla_cabecera_venta +'<tr><th>COTIZACION A NOMBRE:</th><td>'+value.vent_prof_cab_nom_cotizado+'</td><th>REGION:</th><td>'+value.id_region_op+'</td>';
                  //tabla_cabecera_venta = tabla_cabecera_venta +'<tr><th>Tipo de Compra:</th><td>'+value.nom_compra+'</td><th>Forma de Pago:</th><td>'+value.nom_pago+'</td></tr>';
                  tabla_cabecera_venta = tabla_cabecera_venta +'<tr><th>FEHCA:</th><td>'+value.vent_prof_cab_fech_cot+'</td><th>FECHA ENTREGA:</th><td>'+value.vent_prof_cab_fech_entrega_cot+'</td></tr>';
                });
                tabla_cabecera_venta = tabla_cabecera_venta+'</table>';
                tabla_cabecera_venta = tabla_cabecera_venta+'<h3><img src="../img/my documents_32x32.png" align="absmiddle"> MODIFICAR DETALLE</h3><hr style="border:1px dashed;">';
                tabla_cabecera_venta = tabla_cabecera_venta+'<br><table aling="center" id="tb_vent_det_cotizaciones_priv" class="table_usuario">';
                //tabla_cabecera_venta = tabla_cabecera_venta+'<input type="button" value="Agregar Producto" class="btn_form" onClick="new Home().formularioNuevoProductoPriv(\''+codigo_unico+'\');"><br>';
                tabla_cabecera_venta = tabla_cabecera_venta+'<tr><th>TIPO</th><th>PRODUCTO</th><th>CANTIDAD</th><th>P. VENTA</th><th>TOTAL</th><th>MARCA</th><th>PROCEDENCIA</th><th>TIEMPO ESPERA</th><th>CATALOGO</th><th>ESPECIFICACIONES TEC.</th><th>CONF. DESEADA</th><th>ACCESORIOS</th><th>SERV. NECESARIO</th><th>MODIFICAR</th><th>ELIMINAR</th></tr>';
             
                $.ajax({
                  url:'index.php',
                  dataType: 'json',
                  type: 'GET',
                  data : { 
                    action : 'ventas',
                    tp :'getDetalleVentaPriv',
                    id_prof: id_unico
                  },
                  beforeSend : function(){
                  },
                  success: function(resul){
                    var cantidad=0;
                    var precio=0;
                    //console.log(resul);
                     if(resul != null){
                        var total_totales=0;
                        $.each(resul, function(index, valueVenta){ 
                          var cant=parseFloat(valueVenta.vent_prof_det_cant_prod);
                          var prec=parseFloat(valueVenta.vent_prof_det_precio_venta);
                          cantidad=cantidad+cant;
                          precio=precio+prec;
                          tabla_cabecera_venta = tabla_cabecera_venta +'<tr><td align="center">'+valueVenta.nom_tipo+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.nom_prod+'</td>';
                          //tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.vent_prof_det_tipo_mon+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.vent_prof_det_cant_prod+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.vent_prof_det_precio_venta+'</td>';
                          total_totales = total_totales + (valueVenta.vent_prof_det_cant_prod * valueVenta.vent_prof_det_precio_venta);
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+(valueVenta.vent_prof_det_cant_prod * valueVenta.vent_prof_det_precio_venta)+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.vent_prof_det_marca_prod+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.region_prod+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.vent_prof_det_tiempo_esp_prod+' Dias</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.catalogo+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.especif+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.conf+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.acces+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center">'+valueVenta.nom_serv+'</td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center"><a href="#" onclick="new Venta().modificarItemVentaPriv(\''+valueVenta.vent_prof_det_cod_unico+'\')"><img src="../img/consulta_contrato_32x32.png" align="absmiddle"><br>Modificar</a></td>';
                          tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center"><a href="#" onclick="new Venta().eliminarItemVentaPriv(\''+valueVenta.vent_prof_det_cod_unico+'\',\''+codigo_unico+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
                        });
                        tabla_cabecera_venta = tabla_cabecera_venta +'<tr bgcolor="#ACADAD"><td align="center" colspan="2"><b>TOTAL</b></td>';
                        tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center"><strong>'+cantidad+'</strong></td>';
                        tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center"><strong>'+precio+'</strong></td>';
                        tabla_cabecera_venta = tabla_cabecera_venta +'<td align="center"><strong>'+total_totales+'</strong></td></tr>';
                     } 
                      //tabla_cabecera_venta = tabla_cabecera_venta +'';  background-color: #ACADAD             
                      tabla_cabecera_venta = tabla_cabecera_venta+'</table>'; 
                      tabla_cabecera_venta = tabla_cabecera_venta+'<br><center><input type="button" value="CANCELAR" class="btn_form" onclick="new Venta().cancelarDetallarVentaPriv();"></center>';
                    
                   
                    $('#tpl_vent_form_nuevo_venta_det_priv').append(tabla_cabecera_venta);

                    $('#tpl_vent_form_nuevo_venta_det_priv').dialog({
                      width: 1300,
                      height : 600,
                      modal: true,
                      draggable : false
                    });
                   }
                });
        }
      });


  }
   
 /**
      *Este metodo elimina una Venta
      */
  this.eliminarVentaPriv = function(id_unico){
      
    $("#dialog-confirm-vent").attr("title", "Eliminar Venta Privada");
    $("#dialog-confirm-vent #contexto_dialog_vent").empty();
    contexto_dialog = '<img src="../img/alert_48x48.png" align="absmiddle">';
    contexto_dialog = contexto_dialog+"Estas seguro que quieres eliminar la Venta Privada?";
    $("#dialog-confirm-vent #contexto_dialog_vent").append(contexto_dialog);
    $("#dialog-confirm-vent").dialog({
      resizable: false,
      height:200,
      width:400,
      modal: true,
      buttons: {
        "Aceptar": function() {
            $("#dialog-confirm-vent").dialog("close");
            $.ajax({
              url:'index.php',
              dataType: 'json',
              type: 'GET',
              data : { 
                action : 'ventas',
                tp : 'eliminarVentaPriv',
                id_unico : id_unico
              },
              beforeSend : function(){

              },                      
              success: function(res){
                //console.log(res);
                  if (res.completo==true) {
                    //alert("Grabo bien");
                    new Venta().listarventasPriv(0,limit_par, num_par);
                  }
              },
              error: function(res){
              
              }
            });
          
        },
        "Cancelar": function() {
          $( this ).dialog( "close" );
        }
      }
    });
  }

 /**
      *Este metodo elimina un detalle de la venta
      */
  this.eliminarItemVentaPriv = function(id_unico,unico_cabecera){
      
      //alert(id_unico);
    

    $("#dialog-confirm-vent").attr("title", "Eliminar Item de Venta Privada");
    $("#dialog-confirm-vent #contexto_dialog_vent").empty();
    contexto_dialog = '<img src="../img/alert_48x48.png" align="absmiddle">';
    contexto_dialog = contexto_dialog+"Estas seguro que quieres eliminar este Item de la Venta Privada?";
    $("#dialog-confirm-vent #contexto_dialog_vent").append(contexto_dialog);
    $("#dialog-confirm-vent").dialog({
      resizable: false,
      height:200,
      width:400,
      modal: true,
      buttons: {
        "Aceptar": function() {
            $("#dialog-confirm-vent").dialog("close");
            $.ajax({
              url:'index.php',
              dataType: 'json',
              type: 'GET',
              data : { 
                action : 'ventas',
                tp : 'eliminarItemVentaPriv',
                id_unico : id_unico
              },
              beforeSend : function(){

              },                      
              success: function(res){
                //console.log(res);
                  if (res.completo==true) {
                    //alert("Eliminado correcto");
                    //$( this ).dialog( "close" );
                    //new Venta().listarventasPriv(0,limit_par, num_par);
                    $('#tpl_vent_form_nuevo_venta_det_priv').dialog('close');
                    new Venta().detallarVentaPriv(unico_cabecera);
                  }
              },
              error: function(res){
              
              }
            });
          
        },
        "Cancelar": function() {
          $( this ).dialog( "close" );
        }
      }
    });
  }




   /*
   * Metodo para cancelar el detalle de cot priv
   */

  this.cancelarDetallarVentaPriv = function(){
      $('#tpl_vent_form_nuevo_venta_det_priv').dialog('close');


  }

 /**
   * Metodo Para Modificar Cotizaciones Privadas
   */
  this.modificarItemVentaPriv = function(id_unico){
  //alert(id_unico);
       $.ajax({
                  url:'index.php',
                  dataType: 'json',
                  type: 'GET',
                  data : { 
                    action : 'ventas',
                    tp :'getDetalleItemsVentaPriv',  
                    id_unico: id_unico
                  },
                  beforeSend : function(){
                  },
                  success: function(resul){
                    
                  		//console.log(resul);

                 //$('#tpl_vent_form_modif_ventas_priv').empty();
                //var tabla_datos='';
                var tabla_datos='<label><strong>Nombre del Producto:'+resul.nombre+'</strong> </label><span id="codigo_cot_detalle_div"></span>';
                //tabla_datos=tabla_datos+'<label>'+codigo_cot+'</label>';
                tabla_datos=tabla_datos+'<table>';
                tabla_datos=tabla_datos+'<tr><td ><strong>CANTIDAD:</strong></td>';
                tabla_datos=tabla_datos+'<td><input type="text" class="txt_campo" name="txt_vent_cliente_det_proforma" id="txt_vent_cliente_det_proforma" value="'+resul.cantidad+'"><input type="hidden" value="'+resul.cod_det_unico+'" name="cod_unico_cot_det" id="cod_unico_cot_det" /><input type="hidden" value="'+resul.cod_cab_unico+'" name="cod_unico_cliente_det" id="cod_unico_cliente_det" /><input type="hidden" value="'+resul.cod_prod_unico+'" name="cod_unico_op_det" id="cod_unico_op_det" /><div id="div_error_txt_vent_cliente_det_proforma"></div></td></tr>';
                tabla_datos=tabla_datos+'<tr><td><strong>PRECIO DE VENTA:</strong></td>';
                tabla_datos=tabla_datos+'<td><input name="txt_vent_cod_cliente_proforma_det" id="txt_vent_cod_cliente_proforma_det" type="text" class="txt_campo" value="'+ resul.precio_venta+'" readonly /><div id="div_error_txt_vent_cod_cliente_proforma_det"></div></td>';
                tabla_datos=tabla_datos+'<tr><td><strong>TIEMPO DE ENTREGA:</strong></td>';
                tabla_datos=tabla_datos+'<td><input name="txt_vent_cotizador_proforma_det" id="txt_vent_cotizador_proforma_det" type="text" class="txt_campo" value="'+resul.tiempo+'" /><div id="div_error_txt_vent_cotizador_proforma_det"></div></td>';
                tabla_datos=tabla_datos+'</table>';
                 //$('#tpl_vent_form_modif_ventas_priv').append(tabla_datos);
                  $('#tbl_mod_datos').append(tabla_datos);
                 
                    $('#tpl_vent_form_modif_ventas_priv').dialog({
                      width: 350,
                      height : 300,
                      modal: true,
                      draggable : false
                    });
                   }
                });

  }

 /**
   * Metodo que permite crear una cotizacion privada
   */
  this.actualizarFormularioVentasPriv = function (){
    //alert("grabar");
    var util = new Utilitarios();
    $('#form_vent_modif_ventas_priv').submit(function(evt){
      
      if($('#txt_vent_cliente_proforma').val() == ""){
        util.mostrarMensajeAlerta(0, 'El cliente de la proforma no puede estar vacio.', 'Mensaje de Validacion');
      }else if($('#txt_vent_cod_cliente_proforma').val() == ""){
        util.mostrarMensajeAlerta(0, 'El cliente de la proforma no puede estar vacio.', 'Mensaje de Validacion');
      }else if($('#txt_vent_fch_inc_proforma').val() == ""){
        util.mostrarMensajeAlerta(0, 'La fecha Inicio no puede estar vacio.', 'Mensaje de Validacion');
      }else if($('#txt_vent_cotizador_proforma').val() == ""){
        util.mostrarMensajeAlerta(0, 'A cotiza a nombre  no puede estar vacio.', 'Mensaje de Validacion');
      }else{
        datos = $(this).serialize();
        $.ajax({
          url:'?action=ventas&tp=actualizarVentaPriv',
          data:datos,
          type:'GET',
          dataType:'json',
          success:function(res){
              if (res.completo==true) {
                var id_prof=res.id_prof;
                $('#form_vent_modif_ventas_priv').dialog('close'); // hace que se cierre el dialog
                //new Home().listarCotizacionesPriv(0,limit_par, num_par);
                //new Home().nuevaCotDetPriv(id_prof); 
              }

          }
        });
      }
      evt.preventDefault();
    });
  }

  //**********************
}

