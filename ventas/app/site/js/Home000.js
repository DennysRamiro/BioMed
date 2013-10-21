 /*
 * Ejecutamos el objeto con jquery
 */
$(document).ready(function(){
       var home = new Home();
       home.init();
       var cliente = new Cliente();
       cliente.init();
       var venta = new Venta();
       venta.init();
});
/*
 * Esta es la clase home 
 * 
 **/
var limit_par=10;
var num_par =10;
function Home(){
   /*
   * Este es el estilo de la pagina para que se pueda 
   * 
   */
   this.init = function(){
   	 $("#tabs").tabs();
   	 $(".btn_ventas").button();
     $("#txt_vent_cliente_proforma").keyup(function(){
        new Home().buscarClientePriv($('#txt_vent_cliente_proforma').val());
     });
     $("#txt_vent_cliente_proforma_publ").keyup(function(){
        new Home().buscarClientePubl($('#txt_vent_cliente_proforma_publ').val());
     });

     new Home().enviarFormularioNuevaCotizacionPriv();
     new Home().enviarFormularioModificarCotizacionPriv();
     new Home().enviarFormularioNuevaCotizacionPubl();
     new Home().enviarFormularioModificarCotizacionPubl();
     new Home().listarCotizacionesPriv(0, limit_par, num_par);
     new Home().listarCotizacionesPubl(0, limit_par, num_par);
     new Home().enviarFormularioNuevoClienteBoton();
     new Home().enviarFormularioNuevoClienteBotonPubl();
     new Home().enviarFormularioNuevoItemDetalleProducto(); // Este es el formulario de nuevo item para el detalle

     
   }

   /**  
   * Esta es la lista de cotizaciones privadas
   */
  this.listarCotizacionesPriv = function(start, limit, num){
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
          action : 'cotizaciones',
          tp : 'listarCotizacionesPriv',
          start : start,
          limit : limit
        },
        beforeSend : function(){
          $('#div_lista_cotizaciones_nuevas_priv').empty();
          $('#div_lista_cotizaciones_nuevas_priv').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
        },                      
        success: function(res){
          //console.log(res);
          $('#div_lista_cotizaciones_nuevas_priv').empty();
          var tabla_cabecera = '<div id="buscar_cot_priv"><span><strong>BUSCAR:</strong></span> <input type="text" name="palabra_cot_buscar" id="palabra_cot_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Home().buscarCotizacionesPrivBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_cot_vent" id="id_unico_cot_vent">';
          tabla_cabecera = tabla_cabecera+'<table id="tb_vent_lista_cotizaciones_priv" class="table_usuario">';
          //tabla_cabecera = tabla_cabecera+'<tr><td><br><div id="buscar_cliente"><span>Buscar Cotizacion:</span> <input type="text" name="palabra_cliente_buscar" id="palabra_cliente_buscar" class="txt_campo"><input type="button" value="Buscar" class="btn_form" onclick="new Cliente().buscarCliente();"><input type="hidden" name="id_unico_cliente_vent" id="id_unico_cliente_vent"></td></tr>';
          tabla_cabecera = tabla_cabecera+'<th>N</th><th>CODIGO</th><th>CLIENTE</th><th>CODIGO CLIENTE</th><th>OPERADOR</th><th>FECHA INICIO</th><th>FECHA ENTREGA</th><th>FORMA DE PAGO</th><th>DETALLAR</th><th>EDITAR</th><th>ELIMINAR</th>';
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
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().detallarCotPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/consulta_contrato_32x32.png" align="absmiddle"><br> Detallar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().editarCotPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/edit file_32x32.png" align="absmiddle"><br> Modificar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().eliminarCotPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Cancelar</a></td></tr>';
          });
               tabla_cabecera = tabla_cabecera+'</table>';
              $('#div_lista_cotizaciones_nuevas_priv').append(tabla_cabecera);
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
                  paginacion_div = paginacion_div+'<a href="#" onClick="new Home().listarCotizacionesPriv('+i+', '+limit+', '+num+')">'+i+'</a>';            
                }
                paginacion_div = paginacion_div+'</div>';
              }
              paginacion_div = paginacion_div+'</div></div>';
              $('#div_lista_cotizaciones_nuevas_priv').append(paginacion_div);
     
        
        },
        error: function(resultado){
        
        }
        });
}

   /** 
   * Esta es la lista de cotizaciones privadas
   */
  this.listarCotizacionesPubl = function(start, limit, num){
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
          action : 'cotizaciones',
          tp : 'listarCotizacionesPubl',
          start : start,
          limit : limit
        },
        beforeSend : function(){
          $('#div_lista_cotizaciones_nuevas_publ').empty();
          $('#div_lista_cotizaciones_nuevas_publ').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
        },                      
        success: function(res){
          //console.log(res);
          $('#div_lista_cotizaciones_nuevas_publ').empty();
          var tabla_cabecera = '<div id="buscar_cot_publ"><span><strong>BUSCAR:</strong></span> <input type="text" name="palabra_cot_publ_buscar" id="palabra_cot_publ_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Home().buscarCotizacionesPublBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_cot_publ_vent" id="id_unico_cot_publ_vent">';
          tabla_cabecera = tabla_cabecera+'<table id="tb_vent_lista_cotizaciones_publ" class="table_usuario">';
          //tabla_cabecera = tabla_cabecera+'<tr><td><br><div id="buscar_cliente"><span>Buscar Cotizacion:</span> <input type="text" name="palabra_cliente_buscar" id="palabra_cliente_buscar" class="txt_campo"><input type="button" value="Buscar" class="btn_form" onclick="new Cliente().buscarCliente();"><input type="hidden" name="id_unico_cliente_vent" id="id_unico_cliente_vent"></td></tr>';
          tabla_cabecera = tabla_cabecera+'<th>N</th><th>CODIGO</th><th>CLIENTE</th><th>CODIGO CLIENTE</th><th>OPERADOR</th><th>FECHA INICIO</th><th>FECHA ENTREGA</th><th>TIPO COMPRA</th><th>FORMA DE PAGO</th><th>DETALLAR</th><th>EDITAR</th><th>ELIMINAR</th>';
          var total;
          if(res[0] != null){
            total=res[0].total;
          }else{
            total = 0;
          }
          //console.log(res);
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
              tabla_cabecera = tabla_cabecera +'<td>'+value.nom_compra+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.nom_pago+'</td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().detallarCotPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/consulta_contrato_32x32.png" align="absmiddle"><br> Detallar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().editarCotPubl(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/edit file_32x32.png" align="absmiddle"><br> Modificar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().eliminarCotPubl(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Cancelar</a></td></tr>';
          });
          tabla_cabecera = tabla_cabecera+'</table>';
          $('#div_lista_cotizaciones_nuevas_publ').append(tabla_cabecera);
          $("#palabra_cot_publ_buscar").keyup(function(){
            new Home().buscarCotizacionesPubl($('#palabra_cot_publ_buscar').val());
          });
          var paginas = Math.ceil(total/num);
          paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
          for (var i=1;i<=paginas;i++) {
            paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
            if(pag == i){
              paginacion_div = paginacion_div+i;
            }else{
              paginacion_div = paginacion_div+'<a href="#" onClick="new Home().listarCotizacionesPubl('+i+', '+limit+', '+num+')">'+i+'</a>';            
            }
            paginacion_div = paginacion_div+'</div>';
          }
          paginacion_div = paginacion_div+'</div></div>';
          $('#div_lista_cotizaciones_nuevas_publ').append(paginacion_div);
        },
        error: function(resultado){
        
        }
      });
}

  /**
   * Metodo para detallar cotizaciones Privadas
   */

  this.detallarCotPriv = function(id_unico){
    //alert(id_unico);
      $.ajax({
        url:'index.php',
        dataType: 'json',
        type: 'GET',
        data : { 
          action : 'cotizaciones',
          tp :'getCabeceraPriv',
          id_prof: id_unico
        },
        beforeSend : function(){
        },
        success: function(resultado){
            //console.log(resultado);
            var codigo_unico=resultado[0].codigo_unico;
            $('#tpl_vent_form_nuevo_cot_det_priv').empty();
                var tabla_cabecera = '<table aling="center" id="tb_vent_det_cab_cotizaciones_priv" class="table_usuario">';
                $.each(resultado, function(index, value){      
                  tabla_cabecera = tabla_cabecera+'<h3><img src="../img/my documents_32x32.png" align="absmiddle"> COTIZACION PRIVADA</h3><hr style="border:1px dashed;">';
                  tabla_cabecera = tabla_cabecera +'<tr><th>CODIGO PROF.:</th><td>'+value.vent_prof_cab_cod_prof+'</td><th>FORMA DE PAGO:</th><td>'+value.nom_pago+'</td></tr>';
                  tabla_cabecera = tabla_cabecera +'<tr><th>CODIGO CLIENTE:</th><td>'+value.cod_cliente+'</td><th>CLIENTE:</th><td>'+value.nombre_cliente+'&nbsp;'+value.ap_pat_cliente+'&nbsp;'+value.ap_mat_cliente+'</td></tr>';
                  tabla_cabecera = tabla_cabecera +'<tr><th>CODIGO OPE.:</th><td>'+value.cod_operador+'</td><th>OPERADOR:</th><td>'+value.nom_op+'&nbsp;'+value.ap_part_op+'&nbsp;'+value.ap_mat_op+'</td>';
                  tabla_cabecera = tabla_cabecera +'<tr><th>COTIZACION A NOMBRE:</th><td>'+value.vent_prof_cab_nom_cotizado+'</td><th>REGION:</th><td>'+value.id_region_op+'</td>';
                  //tabla_cabecera = tabla_cabecera +'<tr><th>Tipo de Compra:</th><td>'+value.nom_compra+'</td><th>Forma de Pago:</th><td>'+value.nom_pago+'</td></tr>';
                  tabla_cabecera = tabla_cabecera +'<tr><th>FEHCA:</th><td>'+value.vent_prof_cab_fech_cot+'</td><th>FECHA ENTREGA:</th><td>'+value.vent_prof_cab_fech_entrega_cot+'</td></tr>';
                });
                tabla_cabecera = tabla_cabecera+'</table>';
                tabla_cabecera = tabla_cabecera+'<h3><img src="../img/my documents_32x32.png" align="absmiddle"> REGISTRAR DETALLE</h3><hr style="border:1px dashed;">';
                tabla_cabecera = tabla_cabecera+'<br><table aling="center" id="tb_vent_det_cotizaciones_priv" class="table_usuario">';
                //tabla_cabecera = tabla_cabecera+'<input type="button" value="Agregar Producto" class="btn_form" onClick="new Home().formularioNuevoProductoPriv(\''+codigo_unico+'\');"><br>';
                tabla_cabecera = tabla_cabecera+'<tr><th>TIPO</th><th>PRODUCTO</th><th>CANTIDAD</th><th>P. VENTA</th><th>TOTAL</th><th>MARCA</th><th>PROCEDENCIA</th><th>TIEMPO ESPERA</th><th>CATALOGO</th><th>ESPECIFICACIONES TEC.</th><th>CONF. DESEADA</th><th>ACCESORIOS</th><th>SERV. NECESARIO</th></tr>';
             
                $.ajax({
                  url:'index.php',
                  dataType: 'json',
                  type: 'GET',
                  data : { 
                    action : 'cotizaciones',
                    tp :'getDetallePriv',
                    id_prof: id_unico
                  },
                  beforeSend : function(){
                  },
                  success: function(resultado2){
                    var cantidad=0;
                    var precio=0;
                    //console.log(resultado2);
                     if(resultado2 != null){
                        var total_totales=0;
                        $.each(resultado2, function(index, value2){ 
                          var cant=parseFloat(value2.vent_prof_det_cant_prod);
                          var prec=parseFloat(value2.vent_prof_det_precio_venta);
                          cantidad=cantidad+cant;
                          precio=precio+prec;
                          tabla_cabecera = tabla_cabecera +'<tr><td align="center">'+value2.nom_tipo+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.nom_prod+'</td>';
                          //tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.vent_prof_det_tipo_mon+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.vent_prof_det_cant_prod+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.vent_prof_det_precio_venta+'</td>';
                          total_totales = total_totales + (value2.vent_prof_det_cant_prod * value2.vent_prof_det_precio_venta);
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+(value2.vent_prof_det_cant_prod * value2.vent_prof_det_precio_venta)+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.vent_prof_det_marca_prod+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.region_prod+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.vent_prof_det_tiempo_esp_prod+' Dias</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.catalogo+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.especif+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.conf+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.acces+'</td>';
                          tabla_cabecera = tabla_cabecera +'<td align="center">'+value2.nom_serv+'</td></tr>';
                        });
                        tabla_cabecera = tabla_cabecera +'<tr bgcolor="#ACADAD"><td align="center" colspan="2"><b>TOTAL</b></td>';
                        tabla_cabecera = tabla_cabecera +'<td align="center"><strong>'+cantidad+'</strong></td>';
                        tabla_cabecera = tabla_cabecera +'<td align="center"><strong>'+precio+'</strong></td>';
                        tabla_cabecera = tabla_cabecera +'<td align="center"><strong>'+total_totales+'</strong></td></tr>';
                     } 
                      //tabla_cabecera = tabla_cabecera +'';  background-color: #ACADAD             
                      tabla_cabecera = tabla_cabecera+'</table>'; 
                      tabla_cabecera = tabla_cabecera+'<br><center><input type="button" value="CANCELAR" class="btn_form" onclick="new Home().cancelarDetallarCotPriv();"></center>';
                    
                   
                    $('#tpl_vent_form_nuevo_cot_det_priv').append(tabla_cabecera);

                    $('#tpl_vent_form_nuevo_cot_det_priv').dialog({
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
   * Metodo Para Modificar Cotizaciones Privadas
   */
  this.editarCotPriv = function(id_unico){
  //alert(id_unico);
      $.ajax({
        url:'index.php',
        dataType: 'json',
        type: 'GET',
        data : { 
          action : 'cotizaciones',
          tp : 'detallarCotizacionesPriv',
          id_unico : id_unico
        },
        beforeSend : function(){

        },                      
        success: function(res){
          codigo_cot=res[0].vent_prof_cab_cod_prof;
          codigo_cliente=res[0].codigo_cliente;
          nombre_clie=res[0].nombre_cliente;
          ap_pat_clie=res[0].ap_pat_cliente;
          ap_mat_clie=res[0].ap_mat_cliente;
          nombre_cot=res[0].vent_prof_cab_nom_cotizado;
          fecha_ini_cot=res[0].vent_prof_cab_fech_cot;
          fecha_ent_cot=res[0].vent_prof_cab_fech_entrega_cot;
          //tipo_compra=res[0].vent_prof_cab_tipo_compra;
          forma_pago=res[0].vent_prof_cab_forma_pago;
          id_cliente=res[0].vent_prof_cab_cod_cliente;
          id_op=res[0].vent_prof_cab_cod_operador;

          $('#form_vent_modif_cotizacion_priv').empty();
                var tabla_datos='<label><strong>C&oacute;digo Cotizaci&oacute;n:</strong> </label><span id="codigo_cot_detalle_div"></span>';
                tabla_datos=tabla_datos+'<label>'+codigo_cot+'</label>';
                tabla_datos=tabla_datos+'<table>';
                tabla_datos=tabla_datos+'<tr><td ><strong>CLIENTE:</strong></td>';
                tabla_datos=tabla_datos+'<td><input type="text" class="txt_campo" name="txt_vent_cliente_det_proforma" id="txt_vent_cliente_det_proforma" value="'+nombre_clie+'&nbsp;'+ap_pat_clie+'&nbsp;'+ap_mat_clie+'"><input type="hidden" value="'+id_unico+'" name="cod_unico_cot_det" id="cod_unico_cot_det" /><input type="hidden" value="'+id_cliente+'" name="cod_unico_cliente_det" id="cod_unico_cliente_det" /><input type="hidden" value="'+id_op+'" name="cod_unico_op_det" id="cod_unico_op_det" /><input type="hidden" value="'+codigo_cot+'" name="cod_cot_det" id="cod_cot_det" /><div id="div_error_txt_vent_cliente_det_proforma"></div></td></tr>';
                tabla_datos=tabla_datos+'<tr><td><strong>CODIGO CLI.:</strong></td>';
                tabla_datos=tabla_datos+'<td><input name="txt_vent_cod_cliente_proforma_det" id="txt_vent_cod_cliente_proforma_det" type="text" class="txt_campo" value="'+codigo_cliente+'" readonly /><div id="div_error_txt_vent_cod_cliente_proforma_det"></div></td>';
                tabla_datos=tabla_datos+'<tr><td><strong>COTIZADO A NOMBRE:</strong></td>';
                tabla_datos=tabla_datos+'<td><input name="txt_vent_cotizador_proforma_det" id="txt_vent_cotizador_proforma_det" type="text" class="txt_campo" value="'+nombre_cot+'" /><div id="div_error_txt_vent_cotizador_proforma_det"></div></td>';
                tabla_datos=tabla_datos+'<tr><td><strong>FECHA INICIO:</strong></td>';
                tabla_datos=tabla_datos+'<td><input name="txt_vent_fch_inc_proforma_det" id="txt_vent_fch_inc_proforma_det" type="text" class="txt_campo" value="'+fecha_ini_cot+'"/><div id="div_error_txt_vent_fch_inc_proforma_det"></div></td>';
                tabla_datos=tabla_datos+'<tr><td><strong>FECHA ENTREGA:</strong></td>';
                tabla_datos=tabla_datos+'<td><input name="txt_vent_fch_entr_proforma_det" id="txt_vent_fch_entr_proforma_det" type="text" class="txt_campo" value="'+fecha_ent_cot+'"/><div id="div_error_txt_vent_fch_entr_proforma_det"></div></td>';
              /*tabla_datos=tabla_datos+'<tr><td><strong>Tipo de Compra:</strong></td>';
              
              tabla_datos=tabla_datos+'<td><input type="hidden" name="tc" id="tc" value="'+tipo_compra+'">';
                     
                     $.ajax({
                      url:'index.php',
                      dataType: 'json',
                      type: 'GET',
                      data : { 
                        action : 'cotizaciones', 
                        tp : 'listaTipoCompra'
                      },
                      beforeSend : function(){

                      },                      
                      success: function(res_tipo){
                        console.log(res_tipo+tipo_compra);
                          var cod_tipo1=res_tipo[0].GRAL_PAR_PRO_COD;
                          var des_tipo1=res_tipo[0].GRAL_PAR_PRO_DESC;
                          var cod_tipo2=res_tipo[1].GRAL_PAR_PRO_COD;
                          var des_tipo2=res_tipo[1].GRAL_PAR_PRO_DESC;
                          var cod_tipo3=res_tipo[2].GRAL_PAR_PRO_COD;
                          var des_tipo3=res_tipo[2].GRAL_PAR_PRO_DESC;
                          if (tipo_compra==1) {
                            tipo_compra=tipo_compra-1;
                            var cod_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_COD;
                            var des_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_DESC;
                            tabla_datos=tabla_datos+'<select name="tipo_compra_det" size="1" size="10" id="tipo_compra_det" style="height:30px"><option value="'+cod_tipo+'" selected>'+des_tipo+'</option><option value="'+cod_tipo2+'">'+des_tipo2+'</option><option value="'+cod_tipo3+'">'+des_tipo3+'</option>';

                          }else if(tipo_compra==2) {
                            tipo_compra=tipo_compra-1;
                            var cod_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_COD;
                            var des_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_DESC;
                            tabla_datos=tabla_datos+'<select name="tipo_compra_det" size="1" size="10" id="tipo_compra_det" style="height:30px"><option value="'+cod_tipo1+'">'+des_tipo1+'</option><option value="'+cod_tipo+'" selected>'+des_tipo+'</option><option value="'+cod_tipo3+'">'+des_tipo3+'</option>';
                          }else if(tipo_compra==3) {
                            tipo_compra=tipo_compra-1;
                            var cod_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_COD;
                            var des_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_DESC;
                            tabla_datos=tabla_datos+'<select name="tipo_compra_det" size="1" size="10" id="tipo_compra_det" style="height:30px"><option value="'+cod_tipo1+'">'+des_tipo1+'</option><option value="'+cod_tipo2+'">'+des_tipo2+'</option><option value="'+cod_tipo+'" selected>'+des_tipo+'</option>';
                          }
                          tabla_datos=tabla_datos+'</select></td></tr>';*/
                          tabla_datos=tabla_datos+'<tr><td><strong>FORMA DE PAGO:</strong></td>';
                          tabla_datos=tabla_datos+'<td><input type="hidden" name="fp" id="fp" value="'+forma_pago+'">';


                                $.ajax({
                                    url:'index.php',
                                    dataType: 'json',
                                    type: 'GET',
                                    data : { 
                                      action : 'cotizaciones',
                                      tp : 'listaFormaPago'
                                    },
                                    beforeSend : function(){

                                    },                      
                                    success: function(res_forma){
                                        //console.log(res_forma);
                                        var cod_forma1=res_forma[0].GRAL_PAR_PRO_COD;
                                        var des_forma1=res_forma[0].GRAL_PAR_PRO_DESC;
                                        var cod_forma2=res_forma[1].GRAL_PAR_PRO_COD;
                                        var des_forma2=res_forma[1].GRAL_PAR_PRO_DESC;
                                        //alert(forma_pago+des_forma1+des_forma2)
                                        //var cod_tipo3=res_tipo[2].GRAL_PAR_PRO_COD;
                                        //var des_tipo3=res_tipo[2].GRAL_PAR_PRO_DESC;
                                        if (forma_pago==1) {
                                          forma_pago=forma_pago-1;
                                          var cod_forma=res_forma[forma_pago].GRAL_PAR_PRO_COD;
                                          var des_forma=res_forma[forma_pago].GRAL_PAR_PRO_DESC;
                                          tabla_datos=tabla_datos+'<select name="forma_pago_det" size="1" size="10" id="forma_pago_det" style="height:30px"><option value="'+cod_forma+'" selected>'+des_forma+'</option><option value="'+cod_forma2+'">'+des_forma2+'</option>';

                                        }else if(forma_pago==2) {
                                          forma_pago=forma_pago-1;
                                          var cod_forma=res_forma[forma_pago].GRAL_PAR_PRO_COD;
                                          var des_forma=res_forma[forma_pago].GRAL_PAR_PRO_DESC;
                                          tabla_datos=tabla_datos+'<select name="forma_pago_det" size="1" size="10" id="forma_pago_det" style="height:30px"><option value="'+cod_forma1+'">'+des_forma1+'</option><option value="'+cod_forma+'" selected>'+des_forma+'</option>';
                                        /*}else if(forma_pago==3) {
                                          forma_pago=forma_pago-1;
                                          var cod_forma=res_tipo[forma_pago].GRAL_PAR_PRO_COD;
                                          var des_forma=res_tipo[forma_pago].GRAL_PAR_PRO_DESC;
                                          tabla_datos=tabla_datos+'<select name="forma_pago_det" size="1" size="10" id="forma_pago_det" style="height:30px"><option value="'+cod_forma1+'">'+des_forma1+'</option><option value="'+cod_forma2+'">'+des_forma2+'</option><option value="'+cod_forma+'" selected>'+des_forma+'</option>';
                                        */
                                        }
                                        tabla_datos=tabla_datos+'</select></td></tr>';
                                        tabla_datos=tabla_datos+'</table><br>';
                                        tabla_datos=tabla_datos+'<center><input type="submit" value="MODIFICAR COTIZACION" id="bt_submit_vent_modif_cotizacion_priv" class="btn_form"><input type="button" value="Cancelar" class="btn_form" onclick="new Home().cancelarModificarCotPriv();"></center>';


                                      $('#form_vent_modif_cotizacion_priv').append(tabla_datos);
                                      $("#txt_vent_fch_inc_proforma_det").datepicker({
                                        dateFormat: "dd/mm/yy"
                                      });
                                      $("#txt_vent_fch_entr_proforma_det").datepicker({
                                        dateFormat: "dd/mm/yy"
                                      });
                                      $('#tpl_vent_form_modif_cotizacion_priv').dialog({
                                        width: 600,
                                        height : 435,
                                        modal: true,
                                        draggable : false
                                      });

                                      $("#txt_vent_cliente_det_proforma").keyup(function(){
                                          //alert("clic");
                                      new Home().buscarClienteDet($('#txt_vent_cliente_det_proforma').val());
                                      });
                                                    /*},
                                          error: function(resultado){
                                            
                                          }
                                          });*/
                      },
                      error: function(resultado){
                      
                      }
              });
        },
        error: function(resultado){
        
        }
        });

  }

  /**
   * Metodo Para Modificar Cotizaciones Publicas
   */
  this.editarCotPubl = function(id_unico){
    //alert(id_unico);
      $.ajax({
        url:'index.php',
        dataType: 'json',
        type: 'GET',
        data : { 
          action : 'cotizaciones',
          tp : 'detallarCotizacionesPubl',
          id_unico : id_unico
        },
        beforeSend : function(){

        },                      
        success: function(res){
          codigo_cot=res[0].vent_prof_cab_cod_prof;
          codigo_cliente=res[0].codigo_cliente;
          nombre_clie=res[0].nombre_cliente;
          ap_pat_clie=res[0].ap_pat_cliente;
          ap_mat_clie=res[0].ap_mat_cliente;
          nombre_cot=res[0].vent_prof_cab_nom_cotizado;
          fecha_ini_cot=res[0].vent_prof_cab_fech_cot;
          fecha_ent_cot=res[0].vent_prof_cab_fech_entrega_cot;
          tipo_compra=res[0].vent_prof_cab_tipo_compra;
          forma_pago=res[0].vent_prof_cab_forma_pago;
          id_cliente=res[0].vent_prof_cab_cod_cliente;
          id_op=res[0].vent_prof_cab_cod_operador;

          $('#form_vent_modif_cotizacion_publ').empty();
          var tabla_datos='<label><strong>CODIGO COTIZACION:</strong> </label><span id="codigo_cot_publ_detalle_div"></span>';
              tabla_datos=tabla_datos+'<label>'+codigo_cot+'</label>';
              tabla_datos=tabla_datos+'<table>';
              tabla_datos=tabla_datos+'<tr><td ><strong>CLIENTE:</strong></td>';
              tabla_datos=tabla_datos+'<td><input type="text" class="txt_campo" name="txt_vent_cliente_det_publ_proforma" id="txt_vent_cliente_det_publ_proforma" value="'+nombre_clie+'&nbsp;'+ap_pat_clie+'&nbsp;'+ap_mat_clie+'"><input type="hidden" value="'+id_unico+'" name="cod_unico_cot_publ_det" id="cod_unico_cot_publ_det" /><input type="hidden" value="'+id_cliente+'" name="cod_unico_cliente_det_publ" id="cod_unico_cliente_det_publ" /><input type="hidden" value="'+id_op+'" name="cod_unico_op_det_publ" id="cod_unico_op_det_publ" /><input type="hidden" value="'+codigo_cot+'" name="cod_cot_publ_det" id="cod_cot_publ_det" /><div id="div_error_txt_vent_cliente_det_publ_proforma"></div></td></tr>';
              tabla_datos=tabla_datos+'<tr><td><strong>CODIGO CLIENTE:</strong></td>';
              tabla_datos=tabla_datos+'<td><input name="txt_vent_cod_cliente_proforma_det_publ" id="txt_vent_cod_cliente_proforma_det_publ" type="text" class="txt_campo" value="'+codigo_cliente+'" readonly /><div id="div_error_txt_vent_cod_cliente_proforma_det_publ"></div></td>';
              tabla_datos=tabla_datos+'<tr><td><strong>COT. A NOMBRE:</strong></td>';
              tabla_datos=tabla_datos+'<td><input name="txt_vent_cotizador_proforma_det_publ" id="txt_vent_cotizador_proforma_det_publ" type="text" class="txt_campo" value="'+nombre_cot+'" /><div id="div_error_txt_vent_cotizador_proforma_det_publ"></div></td>';
              tabla_datos=tabla_datos+'<tr><td><strong>FECHA INICIO:</strong></td>';
              tabla_datos=tabla_datos+'<td><input name="txt_vent_fch_inc_proforma_det_publ" id="txt_vent_fch_inc_proforma_det_publ" type="text" class="txt_campo" value="'+fecha_ini_cot+'"/><div id="div_error_txt_vent_fch_inc_proforma_det_publ"></div></td>';
              tabla_datos=tabla_datos+'<tr><td><strong>FECHA ENTREGA:</strong></td>';
              tabla_datos=tabla_datos+'<td><input name="txt_vent_fch_entr_proforma_det_publ" id="txt_vent_fch_entr_proforma_det_publ" type="text" class="txt_campo" value="'+fecha_ent_cot+'"/><div id="div_error_txt_vent_fch_entr_proforma_det_publ"></div></td>';
              tabla_datos=tabla_datos+'<tr><td><strong>Tipo de Compra:</strong></td>';
              
              tabla_datos=tabla_datos+'<td><input type="hidden" name="tc_publ" id="tc_publ" value="'+tipo_compra+'">';
                     
                     $.ajax({
                      url:'index.php',
                      dataType: 'json',
                      type: 'GET',
                      data : { 
                        action : 'cotizaciones', 
                        tp : 'listaTipoCompra'
                      },
                      beforeSend : function(){

                      },                      
                      success: function(res_tipo){
                        console.log(res_tipo+tipo_compra);
                          var cod_tipo1=res_tipo[0].GRAL_PAR_PRO_COD;
                          var des_tipo1=res_tipo[0].GRAL_PAR_PRO_DESC;
                          var cod_tipo2=res_tipo[1].GRAL_PAR_PRO_COD;
                          var des_tipo2=res_tipo[1].GRAL_PAR_PRO_DESC;
                          var cod_tipo3=res_tipo[2].GRAL_PAR_PRO_COD;
                          var des_tipo3=res_tipo[2].GRAL_PAR_PRO_DESC;
                          if (tipo_compra==1) {
                            tipo_compra=tipo_compra-1;
                            var cod_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_COD;
                            var des_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_DESC;
                            tabla_datos=tabla_datos+'<select name="tipo_compra_det_publ" size="1" size="10" id="tipo_compra_det_publ" style="height:30px"><option value="'+cod_tipo+'" selected>'+des_tipo+'</option><option value="'+cod_tipo2+'">'+des_tipo2+'</option><option value="'+cod_tipo3+'">'+des_tipo3+'</option>';

                          }else if(tipo_compra==2) {
                            tipo_compra=tipo_compra-1;
                            var cod_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_COD;
                            var des_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_DESC;
                            tabla_datos=tabla_datos+'<select name="tipo_compra_det_publ" size="1" size="10" id="tipo_compra_det_publ" style="height:30px"><option value="'+cod_tipo1+'">'+des_tipo1+'</option><option value="'+cod_tipo+'" selected>'+des_tipo+'</option><option value="'+cod_tipo3+'">'+des_tipo3+'</option>';
                          }else if(tipo_compra==3) {
                            tipo_compra=tipo_compra-1;
                            var cod_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_COD;
                            var des_tipo=res_tipo[tipo_compra].GRAL_PAR_PRO_DESC;
                            tabla_datos=tabla_datos+'<select name="tipo_compra_det_publ" size="1" size="10" id="tipo_compra_det_publ" style="height:30px"><option value="'+cod_tipo1+'">'+des_tipo1+'</option><option value="'+cod_tipo2+'">'+des_tipo2+'</option><option value="'+cod_tipo+'" selected>'+des_tipo+'</option>';
                          }
                          tabla_datos=tabla_datos+'</select></td></tr>';
                          tabla_datos=tabla_datos+'<tr><td><strong>Forma de Pago:</strong></td>';
                          tabla_datos=tabla_datos+'<td><input type="hidden" name="fp_publ" id="fp_publ" value="'+forma_pago+'">';


                                   $.ajax({
                                    url:'index.php',
                                    dataType: 'json',
                                    type: 'GET',
                                    data : { 
                                      action : 'cotizaciones',
                                      tp : 'listaFormaPago'
                                    },
                                    beforeSend : function(){

                                    },                      
                                    success: function(res_forma){
                                        //console.log(res_forma);
                                        var cod_forma1=res_forma[0].GRAL_PAR_PRO_COD;
                                        var des_forma1=res_forma[0].GRAL_PAR_PRO_DESC;
                                        var cod_forma2=res_forma[1].GRAL_PAR_PRO_COD;
                                        var des_forma2=res_forma[1].GRAL_PAR_PRO_DESC;
                                        //alert(forma_pago+des_forma1+des_forma2)
                                        //var cod_tipo3=res_tipo[2].GRAL_PAR_PRO_COD;
                                        //var des_tipo3=res_tipo[2].GRAL_PAR_PRO_DESC;
                                        if (forma_pago==1) {
                                          forma_pago=forma_pago-1;
                                          var cod_forma=res_forma[forma_pago].GRAL_PAR_PRO_COD;
                                          var des_forma=res_forma[forma_pago].GRAL_PAR_PRO_DESC;
                                          tabla_datos=tabla_datos+'<select name="forma_pago_det_publ" size="1" size="10" id="forma_pago_det_publ" style="height:30px"><option value="'+cod_forma+'" selected>'+des_forma+'</option><option value="'+cod_forma2+'">'+des_forma2+'</option>';

                                        }else if(forma_pago==2) {
                                          forma_pago=forma_pago-1;
                                          var cod_forma=res_forma[forma_pago].GRAL_PAR_PRO_COD;
                                          var des_forma=res_forma[forma_pago].GRAL_PAR_PRO_DESC;
                                          tabla_datos=tabla_datos+'<select name="forma_pago_det_publ" size="1" size="10" id="forma_pago_det_publ" style="height:30px"><option value="'+cod_forma1+'">'+des_forma1+'</option><option value="'+cod_forma+'" selected>'+des_forma+'</option>';
                                        /*}else if(forma_pago==3) {
                                          forma_pago=forma_pago-1;
                                          var cod_forma=res_tipo[forma_pago].GRAL_PAR_PRO_COD;
                                          var des_forma=res_tipo[forma_pago].GRAL_PAR_PRO_DESC;
                                          tabla_datos=tabla_datos+'<select name="forma_pago_det" size="1" size="10" id="forma_pago_det" style="height:30px"><option value="'+cod_forma1+'">'+des_forma1+'</option><option value="'+cod_forma2+'">'+des_forma2+'</option><option value="'+cod_forma+'" selected>'+des_forma+'</option>';
                                        */
                                        }
                                        tabla_datos=tabla_datos+'</select></td></tr>';
                                        tabla_datos=tabla_datos+'</table><br>';
                                        tabla_datos=tabla_datos+'<center><input type="submit" value="Modificar Cotizacion" id="bt_submit_vent_modif_cotizacion_publ" class="btn_form"><input type="button" value="Cancelar" class="btn_form" onclick="new Home().cancelarModificarCotPubl();"></center>';


          $('#form_vent_modif_cotizacion_publ').append(tabla_datos);
          $("#txt_vent_fch_inc_proforma_det_publ").datepicker({
            dateFormat: "dd/mm/yy"
          });
          $("#txt_vent_fch_entr_proforma_det_publ").datepicker({
            dateFormat: "dd/mm/yy"
          });
          $('#tpl_vent_form_modif_cotizacion_publ').dialog({
            width: 600,
            height : 435,
            modal: true,
            draggable : false
          });

          $("#txt_vent_cliente_det_publ_proforma").keyup(function(){
              //alert("clic");
              new Home().buscarClienteDetPubl($('#txt_vent_cliente_det_publ_proforma').val());
          });
                                                    },
                                          error: function(resultado){
                                            
                                          }
                                          });
                      },
                      error: function(resultado){
                      
                      }
                      });

        },
        error: function(resultado){
        
        }
        });
  }

    /**
      *Este metodo elimina una cotizacion
      */
  this.eliminarCotPriv = function(id_unico){
      //alert(id_unico);
    $("#dialog-confirm-cot").attr("title", "Eliminar Cotizacion Privada");
    $("#dialog-confirm-cot #contexto_dialog_cot").empty();
    contexto_dialog = '<img src="../img/alert_48x48.png" align="absmiddle">';
    contexto_dialog = contexto_dialog+"Estas seguro que quieres eliminar la Cotizaci&oacute;n Privada?";
    $("#dialog-confirm-cot #contexto_dialog_cot").append(contexto_dialog);
    $("#dialog-confirm-cot").dialog({
      resizable: false,
      height:200,
      width:400,
      modal: true,
      buttons: {
        "Aceptar": function() {
            $("#dialog-confirm-cot").dialog("close");
            $.ajax({
              url:'index.php',
              dataType: 'json',
              type: 'GET',
              data : { 
                action : 'cotizaciones',
                tp : 'eliminarCotizacionesPriv',
                id_unico : id_unico
              },
              beforeSend : function(){

              },                      
              success: function(res){
                console.log(res);
                  if (res.completo==true) {
                    //alert("Grabo bien");
                    new Home().listarCotizacionesPriv(0,limit_par, num_par);
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
      *Este metodo elimina una cotizacion
      */
  this.eliminarCotPubl = function(id_unico){
      //alert(id_unico);
      $.ajax({
        url:'index.php',
        dataType: 'json',
        type: 'GET',
        data : { 
          action : 'cotizaciones',
          tp : 'eliminarCotizacionesPubl',
          id_unico : id_unico
        },
        beforeSend : function(){

        },                      
        success: function(res){
          console.log(res);
            if (res.completo==true) {
              //alert("Grabo bien");
              new Home().listarCotizacionesPubl(0,limit_par, num_par);
            }
        },
        error: function(res){
        
        }
      });


  }

   /**
   * Este metodo que crea nueva Cotizacion privada
   */
  this.nuevaCotizacionPriv = function (){
    //alert("JS");
    $("#txt_vent_cliente_proforma").val('');
    $("#txt_vent_cod_cliente_proforma").val('');
    $("#txt_vent_cotizador_proforma").val('');
    $("#txt_vent_fch_inc_proforma").val('');
    $("#txt_vent_fch_entr_proforma").val('');
    $("#txt_vent_fch_inc_proforma").datepicker({
    dateFormat: "dd/mm/yy"
    });
    $("#txt_vent_fch_entr_proforma").datepicker({
    dateFormat: "dd/mm/yy"
    });

    var util = new Utilitarios();
    //util.validarCampo('txt_vent_nombre_proforma', 'div_error_txt_vent_nombre_proforma', 'Nombre no puede estar vacio');
    util.validarCampo('txt_vent_cliente_proforma', 'div_error_txt_vent_cliente_proforma', 'Cliente no puede estar vacio');
    $('#tpl_vent_form_nuevo_cotizacion_priv').dialog({
      width: 600,
      height : 435,
      modal: true,
      draggable : false
    });
  }

     /**
   * Este metodo que crea nueva Cotizacion privada
   */
  this.nuevaCotizacionPubl = function (){
    //alert("JS");
    $("#txt_vent_cliente_proforma_publ").val('');
    $("#txt_vent_cod_cliente_proforma_publ").val('');
    $("#txt_vent_cotizador_proforma_publ").val('');
    $("#txt_vent_fch_inc_proforma_publ").val('');
    $("#txt_vent_fch_entr_proforma_publ").val('');
    $("#txt_vent_fch_inc_proforma_publ").datepicker({
    dateFormat: "dd/mm/yy"
    });
    $("#txt_vent_fch_entr_proforma_publ").datepicker({
    dateFormat: "dd/mm/yy"
    });

    var util = new Utilitarios();
    //util.validarCampo('txt_vent_nombre_proforma', 'div_error_txt_vent_nombre_proforma', 'Nombre no puede estar vacio');
    util.validarCampo('txt_vent_cliente_proforma_publ', 'div_error_txt_vent_cliente_proforma_publ', 'Cliente no puede estar vacio');
    $('#tpl_vent_form_nuevo_cotizacion_publ').dialog({
      width: 600,
      height : 435,
      modal: true,
      draggable : false
    });
  }

     /**
   * Este metodo que crea nueva Cotizacion
   */
  this.nuevaCotDetPriv = function (id_prof){
     $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp :'getCabeceraPriv',
        id_prof: id_prof
      },
      beforeSend : function(){
      },
      success: function(resultado){

          var codigo_unico=resultado[0].codigo_unico;
          //console.log(codigo_unico);
          $('#tpl_vent_form_nuevo_cot_det_priv').empty();
              var tabla_cabecera = '<table aling="center" id="tb_vent_det_cab_cotizaciones_priv" class="table_usuario">';
              $.each(resultado, function(index, value){      
                tabla_cabecera = tabla_cabecera+'<h3><img src="../img/my documents_32x32.png" align="absmiddle"> COTIZACION PRIVADA<input type="hidden" id="text_codigo_unico_prof_vent_09" name="text_codigo_unico_prof_vent_09"></h3><hr style="border:1px dashed;">';
                tabla_cabecera = tabla_cabecera +'<tr><th>CODIGO PROF.:</th><td>'+value.vent_prof_cab_cod_prof+'</td><th>FORMA PAGO:</th><td>'+value.nom_pago+'</td></tr>';
                tabla_cabecera = tabla_cabecera +'<tr><th>CODIGO CLIENTE:</th><td>'+value.cod_cliente+'</td><th>CLIENTE:</th><td>'+value.nombre_cliente+'&nbsp;'+value.ap_pat_cliente+'&nbsp;'+value.ap_mat_cliente+'</td></tr>';
                tabla_cabecera = tabla_cabecera +'<tr><th>CODIGO OP.:</th><td>'+value.cod_operador+'</td><th>NOMBRE OP.:</th><td>'+value.nom_op+'&nbsp;'+value.ap_part_op+'&nbsp;'+value.ap_mat_op+'</td>';
                tabla_cabecera = tabla_cabecera +'<tr><th>COTIZADO A NOMBRE:</th><td>'+value.vent_prof_cab_nom_cotizado+'</td><th>REGION:</th><td>'+value.id_region_op+'</td>';
                //tabla_cabecera = tabla_cabecera +'<tr><th>Tipo de Compra:</th><td>'+value.nom_compra+'</td><th>Forma de Pago:</th><td>'+value.nom_pago+'</td></tr>';
                tabla_cabecera = tabla_cabecera +'<tr><th>FECHA COT.:</th><td>'+value.vent_prof_cab_fech_cot+'</td><th>FEHCA ENTREGA:</th><td>'+value.vent_prof_cab_fech_entrega_cot+'</td></tr>';
              });
             tabla_cabecera = tabla_cabecera+'</table>';
             tabla_cabecera = tabla_cabecera+'<h3><img src="../img/my documents_32x32.png" align="absmiddle"> REGISTRAR DETALLE</h3><hr style="border:1px dashed;">';
             tabla_cabecera = tabla_cabecera+'<br><input type="button" value="Agregar Producto" class="btn_form" onClick="new Home().formularioNuevoProductoPriv(\''+codigo_unico+'\');"><br>';
             tabla_cabecera = tabla_cabecera+'<div id="id_div_detalle_cotizacion_000100"><table aling="center" id="tb_vent_det_cotizaciones_priv" class="table_usuario">';
             tabla_cabecera = tabla_cabecera+'<tr><th>TIPO</th><th>PRODUCTO</th><th>CANTIDAD</th><th>MARCA</th><th>PROCEDENCIA</th><th>TIEMPO ESPERA</th><th>CATALAGO ESP.</th><th>ESP. TECNICA</th><th>CONF. DESEADA</th><th>ACCESORIOS</th><th>SERVICIO NECESARIO</th>';
             tabla_cabecera = tabla_cabecera+'</table></div>';
             tabla_cabecera = tabla_cabecera+'<div aling="center"><input type="submit" value="GUARDAR DETALLE" id="bt_submit_vent_nuevo_prod_cot_priv" class="btn_form"></div>';
          $('#tpl_vent_form_nuevo_cot_det_priv').append(tabla_cabecera);
          $('#bt_submit_vent_nuevo_prod_cot_priv').on('click', function(event) {
            $('#tpl_vent_form_nuevo_cot_det_priv').dialog('close');
            event.preventDefault();
          });
          $('#tpl_vent_form_nuevo_cot_det_priv').dialog({
            width: 1200,
            height : 550,
            modal: true,
            draggable : false
          });

      }
      });
  } 

  /**
   * Metodo que permite crear una cotizacion privada
   */
  this.enviarFormularioNuevaCotizacionPriv = function (){
    //alert("grabar");
    var util = new Utilitarios();
    $('#form_vent_nueva_cotizacion_priv').submit(function(evt){
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
          url:'?action=cotizaciones&tp=grabarCotizacionPriv',
          data:datos,
          type:'GET',
          dataType:'json',
          success:function(res){
              if (res.completo==true) {
                var id_prof=res.id_prof;
                $('#tpl_vent_form_nuevo_cotizacion_priv').dialog('close'); // hace que se cierre el dialog
                new Home().listarCotizacionesPriv(0,limit_par, num_par);
                new Home().nuevaCotDetPriv(id_prof); 
              }

          }
        });
      }
      evt.preventDefault();
    });
  }


  /**
   * Metodo que permite modificar la cotizacion privada
   */

  this.enviarFormularioModificarCotizacionPriv = function(){
    //alert("grabar");
    var util = new Utilitarios();
    $('#form_vent_modif_cotizacion_priv').submit(function(evt){
      datos = $(this).serialize();
     // console.log(datos);
      $.ajax({
        url:'?action=cotizaciones&tp=modificarCotizacionPriv',
        data:datos,
        type:'GET',
        dataType:'json',
        success:function(res){
            if (res.completo==true) {
              var id_prof=res.id_prof;
            //new Home().listarCotizaciones(0,limit_par, num_par);
              $('#tpl_vent_form_modif_cotizacion_priv').dialog('close'); // hace que se cierre el dialog
              new Home().listarCotizacionesPriv(0,limit_par, num_par);
              
              new Home().nuevaCotDetPriv02($('#cod_unico_cot_det').val());
              
              
            }

        }
      });


    evt.preventDefault();
    });

  }

       /**
   * Este metodo que crea nueva Cotizacion
   */
  this.nuevaCotDetPriv02 = function (id_prof){
     $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp :'getCabeceraPriv',
        id_prof: id_prof
      },
      beforeSend : function(){
      },
      success: function(resultado){

          var codigo_unico=resultado[0].codigo_unico;
          //console.log(codigo_unico);
          $('#tpl_vent_form_nuevo_cot_det_priv').empty();
              var tabla_cabecera = '<table aling="center" id="tb_vent_det_cab_cotizaciones_priv" class="table_usuario">';
              $.each(resultado, function(index, value){      
                tabla_cabecera = tabla_cabecera+'<h3><img src="../img/my documents_32x32.png" align="absmiddle"> COTIZACION PRIVADA<input type="hidden" id="text_codigo_unico_prof_vent_09" name="text_codigo_unico_prof_vent_09"></h3><hr style="border:1px dashed;">';
                tabla_cabecera = tabla_cabecera +'<tr><th>CODIGO PROF.:</th><td>'+value.vent_prof_cab_cod_prof+'</td><th>FORMA PAGO:</th><td>'+value.nom_pago+'</td></tr>';
                tabla_cabecera = tabla_cabecera +'<tr><th>CODIGO CLIENTE:</th><td>'+value.cod_cliente+'</td><th>CLIENTE:</th><td>'+value.nombre_cliente+'&nbsp;'+value.ap_pat_cliente+'&nbsp;'+value.ap_mat_cliente+'</td></tr>';
                tabla_cabecera = tabla_cabecera +'<tr><th>CODIGO OP.:</th><td>'+value.cod_operador+'</td><th>NOMBRE OP.:</th><td>'+value.nom_op+'&nbsp;'+value.ap_part_op+'&nbsp;'+value.ap_mat_op+'</td>';
                tabla_cabecera = tabla_cabecera +'<tr><th>COTIZADO A NOMBRE:</th><td>'+value.vent_prof_cab_nom_cotizado+'</td><th>REGION:</th><td>'+value.id_region_op+'</td>';
                //tabla_cabecera = tabla_cabecera +'<tr><th>Tipo de Compra:</th><td>'+value.nom_compra+'</td><th>Forma de Pago:</th><td>'+value.nom_pago+'</td></tr>';
                tabla_cabecera = tabla_cabecera +'<tr><th>FECHA COT.:</th><td>'+value.vent_prof_cab_fech_cot+'</td><th>FEHCA ENTREGA:</th><td>'+value.vent_prof_cab_fech_entrega_cot+'</td></tr>';
              });
             tabla_cabecera = tabla_cabecera+'</table>';
             tabla_cabecera = tabla_cabecera+'<h3><img src="../img/my documents_32x32.png" align="absmiddle"> REGISTRAR DETALLE</h3><hr style="border:1px dashed;">';
             tabla_cabecera = tabla_cabecera+'<br><input type="button" value="Agregar Producto" class="btn_form" onClick="new Home().formularioNuevoProductoPriv(\''+codigo_unico+'\');"><br>';
             tabla_cabecera = tabla_cabecera+'<div id="id_div_detalle_cotizacion_000100"><table aling="center" id="tb_vent_det_cotizaciones_priv" class="table_usuario">';
             tabla_cabecera = tabla_cabecera+'<tr><th>TIPO</th><th>PRODUCTO</th><th>CANTIDAD</th><th>MARCA</th><th>PROCEDENCIA</th><th>TIEMPO ESPERA</th><th>CATALAGO ESP.</th><th>ESP. TECNICA</th><th>CONF. DESEADA</th><th>ACCESORIOS</th><th>SERVICIO NECESARIO</th>';
             tabla_cabecera = tabla_cabecera+'</table></div>';
             tabla_cabecera = tabla_cabecera+'<div aling="center"><input type="submit" value="GUARDAR DETALLE" id="bt_submit_vent_nuevo_prod_cot_priv" class="btn_form"></div>';
          $('#tpl_vent_form_nuevo_cot_det_priv').append(tabla_cabecera);
          $('#bt_submit_vent_nuevo_prod_cot_priv').on('click', function(event) {
          $('#tpl_vent_form_nuevo_cot_det_priv').dialog('close');
            event.preventDefault();
          });
          new Home().listarDetalleCotizacionPrivada02($('#cod_unico_cot_det').val()); 
          $('#tpl_vent_form_nuevo_cot_det_priv').dialog({
            width: 1200,
            height : 550,
            modal: true,
            draggable : false
          });

      }
      });
  }




    /** Metodo que permite listar Detalle Cotizacion Privado **/
  this.listarDetalleCotizacionPrivada02 = function(codigo_prof_venta_01){
      //alert(codigo_prof_venta_01);
      console.log(codigo_prof_venta_01);
      $('#id_div_detalle_cotizacion_000100').empty();
      $.getJSON('index.php', {action:'cotizaciones', tp:'getDetallePriv', id_prof:codigo_prof_venta_01}, function(json, textStatus) {
        var tabla_cabecera ='<br><table aling="center" id="tb_vent_det_cotizaciones_priv" class="table_usuario">';
        tabla_cabecera = tabla_cabecera+'<tr><th>TIPO</th><th>PRODUCTO</th><th>CANTIDAD</th><th>P. VENTA</th><th>TOTAL</th><th>MARCA</th><th>PROCEDENCIA</th><th>TIEMPO ESPERA</th><th>CATALOGO</th><th>ESPECIFICACIONES TEC.</th><th>CONF. DESEADA</th><th>ACCESORIOS</th><th>SERV. NECESARIO</th><th>ELIMINAR</th></tr>';
        tabla_cabecera = tabla_cabecera+'</table><br>';
        $('#id_div_detalle_cotizacion_000100').append(tabla_cabecera);
        var cantidad=0;
        var precio=0;
        var total_totales02 = 0;
        $.each(json, function(index, value) {
          var cant=parseFloat(value.vent_prof_det_cant_prod);
          var prec=parseFloat(value.vent_prof_det_precio_venta);
          cantidad=cantidad+cant;
          precio=precio+prec;
          tabla_cabecera = '<tr><td align="center">'+value.nom_tipo+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.nom_prod+'</td>';
          //tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_tipo_mon+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_cant_prod+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_precio_venta+'</td>';
          total_totales02 = total_totales02 + (value.vent_prof_det_cant_prod*value.vent_prof_det_precio_venta);
          tabla_cabecera = tabla_cabecera +'<td align="center">'+(value.vent_prof_det_cant_prod*value.vent_prof_det_precio_venta)+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_marca_prod+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.region_prod+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_tiempo_esp_prod+' Dias</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.catalogo+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.especif+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.conf+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.acces+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.nom_serv+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().eliminarProfVenta(\''+value.vent_prof_det_cod_unico+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Cancelar</a></td></tr>';
          $('#tb_vent_det_cotizaciones_priv').append(tabla_cabecera);  
        });
        tabla_cabecera = '<tr bgcolor="#ACADAD"><td align="center" colspan="2"><b>TOTAL</b></td>';
        tabla_cabecera = tabla_cabecera +'<td align="center"><strong>'+cantidad+'</strong></td>';
        tabla_cabecera = tabla_cabecera +'<td align="center"><strong>'+precio+'</strong></td>';
        tabla_cabecera = tabla_cabecera +'<td align="center"><strong>'+total_totales02+'</strong></td></tr>';
        $('#tb_vent_det_cotizaciones_priv').append(tabla_cabecera);
    });
  }




    /**
   * Metodo que permite crear una cotizacion publica
   */
  this.enviarFormularioNuevaCotizacionPubl = function (){
    //alert("grabar");
    var util = new Utilitarios();
    $('#form_vent_nueva_cotizacion_publ').submit(function(evt){
      datos = $(this).serialize();
      console.log(datos);
      $.ajax({
        url:'?action=cotizaciones&tp=grabarCotizacionPubl',
        data:datos,
        type:'GET',
        dataType:'json',
        success:function(res){
            if (res.completo==true) {
            var id_prof=res.id_prof;
            //new Home().listarCotizaciones(0,limit_par, num_par);
            $('#tpl_vent_form_nuevo_cotizacion_publ').dialog('close'); // hace que se cierre el dialog
            new Home().listarCotizacionesPubl(0,limit_par, num_par); 
            }

        }
      });
      evt.preventDefault();
    });
  }

  /**
   * Metodo que permite modificar la cotizacion
   */

  this.enviarFormularioModificarCotizacionPubl = function(){
    //alert("grabar");
    var util = new Utilitarios();
    $('#form_vent_modif_cotizacion_publ').submit(function(evt){
      datos = $(this).serialize();
      //console.log(datos);
      $.ajax({
        url:'?action=cotizaciones&tp=modificarCotizacionPubl',
        data:datos,
        type:'GET',
        dataType:'json',
        success:function(res){
            if (res.completo==true) {
            var id_prof=res.id_prof;
            //new Home().listarCotizaciones(0,limit_par, num_par);
            $('#tpl_vent_form_modif_cotizacion_publ').dialog('close'); // hace que se cierre el dialog
            new Home().listarCotizacionesPubl(0,limit_par, num_par);
            }

        }
      });


    evt.preventDefault();
    });

  }

   /**
   *  Este metodo lista todos los clientes buscados
   */
   this.buscarClientePriv = function(palabra_buscar){ 
   //alert(palabra_buscar);
    $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp :'buscarClientes',
        cliente_buscar: palabra_buscar
      },
      beforeSend : function(){
      },
      success: function(resultado){
        $("#txt_vent_cliente_proforma").autocomplete({
              source: resultado,/* este es el script que realiza la busqueda */
              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
              select: new Home().clienteSeleccionadoPriv /* esta es la rutina que extrae la informacion del producto seleccionado */
              //focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
          });
      },
      error: function(resultado){
      }
    });

   }

   /**
   * Metodo que nos muestra el cliente seleccionado
   */
   this.clienteSeleccionadoPriv = function(evt, ui){
    //console.log("llega");
    var valor = ui.item.value;
    var label = ui.item.label;
    var id = ui.item.id;
    var datos = label.split(" ");
  //  console.dir(datos);
   // console.log(id);
    $("#txt_vent_cod_cliente_proforma").val(datos[0]);
    $("#txt_vent_cotizador_proforma").val(datos[1]+' '+datos[2]+' '+datos[3]);
    $("#cod_unico_cliente").val(id);


   }

    /**
   *  Este metodo lista todos los clientes buscados publico
   */
   this.buscarClientePubl = function(palabra_buscar){ 
   //alert(palabra_buscar);
    $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp :'buscarClientes',
        cliente_buscar: palabra_buscar
      },
      beforeSend : function(){
      },
      success: function(resultado){
        $("#txt_vent_cliente_proforma_publ").autocomplete({
              source: resultado,/* este es el script que realiza la busqueda */
              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
              select: new Home().clienteSeleccionadoPubl /* esta es la rutina que extrae la informacion del producto seleccionado */
              //focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
          });
      },
      error: function(resultado){
      }
    });

   }

      /**
   * Metodo que nos muestra el cliente seleccionado publico
   */
   this.clienteSeleccionadoPubl = function(evt, ui){
    //console.log("llega");
    var valor = ui.item.value;
    var label = ui.item.label;
    var id = ui.item.id;
    var datos = label.split(" ");
  //  console.dir(datos);
   // console.log(id);
    $("#txt_vent_cod_cliente_proforma_publ").val(datos[0]);
    $("#txt_vent_cotizador_proforma_publ").val(datos[1]+' '+datos[2]+' '+datos[3]);
    $("#cod_unico_cliente_publ").val(id);
   }

  /**
   *  Este metodo lista todos los clientes buscados
   */
   this.buscarClienteDet = function(palabra_buscar){ 
   //alert(palabra_buscar);
    $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp :'buscarClientes',
        cliente_buscar: palabra_buscar
      },
      beforeSend : function(){
      },
      success: function(resultado){
        $("#txt_vent_cliente_det_proforma").autocomplete({
              source: resultado,/* este es el script que realiza la busqueda */
              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
              select: new Home().clienteSeleccionadoDet /* esta es la rutina que extrae la informacion del producto seleccionado */
              //focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
          });
      },
      error: function(resultado){
      }
    });

   }
  
  /**
   * Metodo que nos muestra el cliente seleccionado
   */
  this.clienteSeleccionadoDet = function(evt, ui){
    //console.log("llega");
    var valor = ui.item.value;
    var label = ui.item.label;
    var id = ui.item.id;
    var datos = label.split(" ");
    console.dir(datos);
    console.log(id);
    $("#txt_vent_cod_cliente_proforma_det").val(datos[0]);
    $("#txt_vent_cotizador_proforma_det").val(datos[1]+' '+datos[2]+' '+datos[3]);
    $("#cod_unico_cliente_det").val(id);
   }

  /**
   *  Este metodo lista todos los clientes buscados
   */
   this.buscarClienteDetPubl = function(palabra_buscar){ 
   //alert("buscador");
   //alert(palabra_buscar);
    $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp :'buscarClientes',
        cliente_buscar: palabra_buscar
      },
      beforeSend : function(){
      },
      success: function(resultado){
        $("#txt_vent_cliente_det_publ_proforma").autocomplete({
              source: resultado,/* este es el script que realiza la busqueda */
              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
              select: new Home().clienteSeleccionadoDetPubl /* esta es la rutina que extrae la informacion del producto seleccionado */
              //focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
          });
      },
      error: function(resultado){
      }
    });

   }
  
  /**
   * Metodo que nos muestra el cliente seleccionado
   */
  this.clienteSeleccionadoDetPubl = function(evt, ui){
    //console.log("llega");
    var valor = ui.item.value;
    var label = ui.item.label;
    var id = ui.item.id;
    var datos = label.split(" ");
    console.dir(datos);
    console.log(id);
    $("#txt_vent_cod_cliente_proforma_det_publ").val(datos[0]);
    $("#txt_vent_cotizador_proforma_det_publ").val(datos[1]+' '+datos[2]+' '+datos[3]);
    $("#cod_unico_cliente_det_publ").val(id);
   }


  /**
   * Metodo que permite cargar un nuevo producto privº
   */

  this.formularioNuevoProductoPriv = function(cod_cabecera){
    new Home().listarProductosParaStock();
    new Home().eventoTecladoConsultarStock();
    $('#imp_codigo_prof_venta_0089').val(cod_cabecera);
    $('#tpl_vent_form_nuevo_prod_cotizacion_priv').dialog({
        width: 700,
        height : 600,
        modal: true,
        draggable : true
    });
  }
  /** Metodo que se ejuta cuando se hace la buqueda por palabra **/
  this.buscarProductoXPalabraStock = function(){
    //console.log($('#txt_campo_palabra_buscar').val());
    $.getJSON('?action=cotizaciones&tp=buscarProductosStockXPalabra&producto='+$('#txt_campo_palabra_buscar').val(), function(result){
          $('#div_vent_lista_productos_detalle').empty();
          new Home().listarProductosXSource(result[0]);
    });
  } 

  /**
   * Evento de taclado para formulario de busqueda en el stock
   */
  this.eventoTecladoConsultarStock = function(){
    //console.log('Cargando...');
    $('#txt_campo_palabra_buscar').keyup(function(evt){
      $.getJSON('?action=cotizaciones&tp=buscarProductosStock&producto='+$(this).val(), function(result){
        $('#txt_campo_palabra_buscar').autocomplete({
          source:result,
          minChars:1,
          minLength: 0,
          select: new Home().productoSeleccionado, /* esta es la rutina que extrae la informacion del producto seleccionado */
          focus: new Home().productoEnfocado
        });
      });
    });
  }
  /** Metodo que permite ejecutar el ajax que devuelve el producto seleccionado **/
  this.productoSeleccionado = function(evt, ui){
    $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp : 'productoEnfocado',
        id_producto_unico: ui.item.id
      },
      beforeSend : function(){
        $('#div_vent_lista_productos_detalle').empty();
        $('#div_vent_lista_productos_detalle').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
      },
      success: function(resultado){
        $('#div_vent_lista_productos_detalle').empty();
        new Home().listarProductosXSource(resultado);
      },
      error: function(resultado){
      }
    });
  }
  /** Metodo cuando se enfoca el producto para que devuelve el producto **/
  this.productoEnfocado = function(evt, ui){
    $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp : 'productoEnfocado',
        id_producto_unico: ui.item.id
      },
      beforeSend : function(){
        $('#div_vent_lista_productos_detalle').empty();
        $('#div_vent_lista_productos_detalle').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
      },
      success: function(resultado){
        $('#div_vent_lista_productos_detalle').empty();
        new Home().listarProductosXSource(resultado);
      },
      error: function(resultado){
      }
    });
  }

  /** Este metodo que permite listar los productos x source**/
  this.listarProductosXSource = function(result){
    producto_detalle='';
    $.each(result, function(index, producto){
          producto_detalle = producto_detalle+'<div id="div_detalle_producto_consulta">';
          if(producto.alm_prod_cab_img != ""){
            producto_detalle = producto_detalle+'<div id="div_img_producto_consulta"><img src="trebol/'+producto.alm_prod_cab_img+'" width="150" height="100"></div>';
          }else{
            producto_detalle = producto_detalle+'<div id="div_img_producto_consulta"><img src="../images/producto/img/anon.jpg" width="150" height="100"></div>';
          }
          producto_detalle = producto_detalle+'<div id="div_producto_consulta_detalle_producto"><h4>'+producto.alm_prod_cab_nombre+'</h4> ';
          producto_detalle = producto_detalle+'<label><strong>CODIGO REF.:</strong></label> '+producto.alm_prod_cab_cod_ref;
          producto_detalle = producto_detalle+' <label><strong>NUEVO CODIGO:</strong></label> '+producto.alm_prod_cab_codigo;
          producto_detalle = producto_detalle+' <label><strong>MARCA:</strong></label> '+producto.alm_prod_det_marca;
          producto_detalle = producto_detalle+' <label><strong>PROVEEDOR:</strong></label> '+producto.alm_prod_cab_nom_prov;
          producto_detalle = producto_detalle+'<br><label><strong>CANTIDAD:</strong></label> '+producto.alm_prod_det_cantidad+' '+producto.alm_prod_cab_presentacion;
          producto_detalle = producto_detalle+' <label><strong>P. VENTA:</strong></label> '+producto.alm_prod_det_prec_venta+' '+producto.alm_prod_cab_sigla;
          producto_detalle = producto_detalle+' <label><strong>P. VENTA MIN:</strong></label> '+producto.alm_prod_det_prec_min_venta+' '+producto.alm_prod_cab_sigla;
          producto_detalle = producto_detalle+'<br><label><strong>P. VENTA MAX:</strong></label> '+producto.alm_prod_det_prec_max_venta+' '+producto.alm_prod_cab_sigla;
          producto_detalle = producto_detalle+' <label><strong>ORIGEN:</strong></label> '+producto.alm_prod_cab_suc_nombre;
          producto_detalle = producto_detalle+'<br><input type="button" class="btn_form" onClick="new Home().anadirProductoPropuesta(\''+producto.alm_prod_cab_id_unico_prod+'\', \''+producto.alm_prod_det_id_unico+'\',\''+$('#imp_codigo_prof_venta_0089').val()+'\');" value="AGREGAR PRODUCTO">';
          producto_detalle = producto_detalle+'</div></div>';
    });
    $('#div_vent_lista_productos_detalle').append(producto_detalle);

  }
   /**
    * Este metodo lista las cotizaciones privadas buscadas con el boton
    */
    this.buscarCotizacionesPrivBoton = function(start, limit, num){

      pag = 1;
      if(start != 0 && start != 1){
        pag = start;
        start = start*num-(num);
        limit = pag*num;
      }else{
        start = 0;
        limit = num;
      }
      var palabra_buscar=$("#palabra_cot_buscar").val();
      $.ajax({
        url:'index.php',
        dataType: 'json',
        type: 'GET',
        data : { 
          action : 'cotizaciones',
          tp :'buscarCotizacionesPrivBoton',
          cotizacion_buscar: palabra_buscar,
          start : start,
          limit : limit
        },
        beforeSend : function(){
          $('#div_lista_cotizaciones_nuevas_priv').empty();
          $('#div_lista_cotizaciones_nuevas_priv').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
        },
        success: function(resultado){
          $('#div_lista_cotizaciones_nuevas_priv').empty();
          var tabla_cabecera = '<div id="buscar_cot_priv"><span><strong>BUSCAR:</strong></span> <input type="text" name="palabra_cot_buscar" id="palabra_cot_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Home().buscarCotizacionesPrivBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_cot_vent" id="id_unico_cot_vent">';
          tabla_cabecera = tabla_cabecera+'<table id="tb_vent_lista_cotizaciones_priv" class="table_usuario">';
          //tabla_cabecera = tabla_cabecera+'<tr><td><br><div id="buscar_cliente"><span>Buscar Cotizacion:</span> <input type="text" name="palabra_cliente_buscar" id="palabra_cliente_buscar" class="txt_campo"><input type="button" value="Buscar" class="btn_form" onclick="new Cliente().buscarCliente();"><input type="hidden" name="id_unico_cliente_vent" id="id_unico_cliente_vent"></td></tr>';
          tabla_cabecera = tabla_cabecera+'<th>N</th><th>C&Oacute;DIGO</th><th>CLIENTE</th><th>C&Oacute;DIGO CLIENTE</th><th>OPERADOR</th><th>FECHA INICIO</th><th>FECHA ENTREGA</th><th>FORMA DE PAGO</th><th>DETALLAR</th><th>EDITAR</th><th>ELIMINAR</th>';
          var total=resultado[0].total;
          var buscar=resultado[0].cotizacion_buscar;
          var nro=0;
          $.each(resultado, function(index, value){
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
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().detallarCotPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/consulta_contrato_32x32.png" align="absmiddle"><br> Detallar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().editarCotPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/edit file_32x32.png" align="absmiddle"><br> Modificar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().eliminarCotPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Cancelar</a></td></tr>';
          });
          tabla_cabecera = tabla_cabecera+'</table>';
          $('#div_lista_cotizaciones_nuevas_priv').append(tabla_cabecera);
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
              paginacion_div = paginacion_div+'<a href="#" onClick="new Home().buscarCotizacionesPrivBoton('+i+', '+limit+', '+num+')">'+i+'</a>';            
            }
            paginacion_div = paginacion_div+'</div>';
          }
          paginacion_div = paginacion_div+'</div></div>';
          $('#div_lista_cotizaciones_nuevas_priv').append(paginacion_div);
          $("#palabra_cot_buscar").val(buscar);
        },
        error: function(resultado){
        }
      });

    }

  /**
   *  Este metodo lista todos las cotizaciones buscados con autocomplet
   */
   this.buscarCotizacionesPriv = function(palabra_buscar){ 
   //alert(palabra_buscar);
    $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp :'buscarCotizacionesPriv',
        cotizacion_buscar: palabra_buscar
      },
      beforeSend : function(){
      },
      success: function(resultado){
        $("#palabra_cot_buscar").autocomplete({
              source: resultado,/* este es el script que realiza la busqueda */
              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
              select: new Home().cotizacionPrivSeleccionado /* esta es la rutina que extrae la informacion del producto seleccionado */
              //focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
          });
      },
      error: function(resultado){
      }
    });

   }

    /**
   * Metodo que nos muestra el cotizacion privada seleccionado
   */
   this.cotizacionPrivSeleccionado = function(evt, ui){
      //alert("select");
      //console.log("llega");
      var valor = ui.item.value;
      var label = ui.item.label;
      var id = ui.item.id;
      //var datos = label.split(" ");
      //console.dir(datos);
         // console.log(id);
          $.ajax({
            url:'index.php',
            dataType: 'json',
            type: 'GET',
            data : { 
              action : 'cotizaciones',
              tp :'getDatosBusCotPriv',
              id_unico: id 
            },
            beforeSend : function(){
              $('#div_lista_cotizaciones_nuevas_priv').empty();
              $('#div_lista_cotizaciones_nuevas_priv').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
            },
            success: function(resultado){
              id_forma=resultado[0].vent_prof_cab_cod_unico;
              id_cliente=resultado[0].vent_prof_cab_cod_cliente;
              id_op=resultado[0].vent_prof_cab_cod_operador;
              cod_forma=resultado[0].vent_prof_cab_cod_prof;
              codigo_cliente=resultado[0].codigo_cliente;
              nombre_cliente=resultado[0].nombre_cliente;
              ap_pat_cliente=resultado[0].ap_pat_cliente;
              ap_mat_cliente=resultado[0].ap_mat_cliente;
              nom_op=resultado[0].nom_op;
              ap_part_op=resultado[0].ap_part_op;
              ap_mat_op=resultado[0].ap_mat_op;
              fecha_ini_cot=resultado[0].vent_prof_cab_fech_cot;
              fecha_ent_cot=resultado[0].vent_prof_cab_fech_entrega_cot;
              nom_compra=resultado[0].nom_compra;
              nom_pago=resultado[0].nom_pago;

              $('#div_lista_cotizaciones_nuevas_priv').empty();
              var tabla_cabecera = '<div id="buscar_cot_priv"><span><strong>BUSCAR:</strong></span> <input type="text" name="palabra_cot_buscar" id="palabra_cot_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Home().buscarCotizacionesPrivBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_cot_vent" id="id_unico_cot_vent">';
              tabla_cabecera = tabla_cabecera+'<table id="tb_vent_lista_cotizaciones_priv" class="table_usuario">';
              tabla_cabecera = tabla_cabecera+'<th>N</th><th>C&Oacute;DIGO</th><th>CLIENTE</th><th>C&Oacute;DIGO CLIENTE</th><th>OPERADOR</th><th>FECHA INICIO</th><th>FECHA ENTREGA</th><th>FORMA DE PAGO</th><th>DETALLAR</th><th>EDITAR</th><th>ELIMINAR</th>';              
              tabla_cabecera = tabla_cabecera +'<tr><td>1</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+cod_forma+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+nombre_cliente+'&nbsp;'+ap_pat_cliente+'&nbsp;'+ap_mat_cliente+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+codigo_cliente+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+nom_op+'&nbsp;'+ap_part_op+'&nbsp;'+ap_mat_op+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+fecha_ini_cot+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+fecha_ent_cot+'</td>';
              //tabla_cabecera = tabla_cabecera +'<td>'+nom_compra+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+nom_pago+'</td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().detallarCotPriv(\''+id_forma+'\')"><img src="../img/consulta_contrato_32x32.png" align="absmiddle"><br> Detallar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().editarCotPriv(\''+id_forma+'\')"><img src="../img/edit file_32x32.png" align="absmiddle"><br> Modificar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().eliminarCotPriv(\''+id_forma+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
              tabla_cabecera = tabla_cabecera+'</table>';
              $('#div_lista_cotizaciones_nuevas_priv').append(tabla_cabecera);
              $("#palabra_cot_buscar").keyup(function(){
              new Home().buscarCotizacionesPriv($('#palabra_cot_buscar').val());
              });
            },
            error: function(resultado){
            }
          });
   }

   /**
    * Este metodo lista las cotizaciones publicas buscadas con el boton
    */
    this.buscarCotizacionesPublBoton = function(start, limit, num){

      pag = 1;
      if(start != 0 && start != 1){
        pag = start;
        start = start*num-(num);
        limit = pag*num;
      }else{
        start = 0;
        limit = num;
      }
      var palabra_buscar=$("#palabra_cot_publ_buscar").val();
      $.ajax({
        url:'index.php',
        dataType: 'json',
        type: 'GET',
        data : { 
          action : 'cotizaciones',
          tp :'buscarCotizacionesPublBoton',
          cotizacion_buscar: palabra_buscar,
          start : start,
          limit : limit
        },
        beforeSend : function(){
          $('#div_lista_cotizaciones_nuevas_publ').empty();
          $('#div_lista_cotizaciones_nuevas_publ').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
        },
        success: function(resultado){
          $('#div_lista_cotizaciones_nuevas_publ').empty();
          var tabla_cabecera = '<div id="buscar_cot_publ"><span><strong>BUSCAR:</strong></span> <input type="text" name="palabra_cot_publ_buscar" id="palabra_cot_publ_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Home().buscarCotizacionesPublBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_cot_publ_vent" id="id_unico_cot_publ_vent">';
          tabla_cabecera = tabla_cabecera+'<table id="tb_vent_lista_cotizaciones_publ" class="table_usuario">';
          //tabla_cabecera = tabla_cabecera+'<tr><td><br><div id="buscar_cliente"><span>Buscar Cotizacion:</span> <input type="text" name="palabra_cliente_buscar" id="palabra_cliente_buscar" class="txt_campo"><input type="button" value="Buscar" class="btn_form" onclick="new Cliente().buscarCliente();"><input type="hidden" name="id_unico_cliente_vent" id="id_unico_cliente_vent"></td></tr>';
          tabla_cabecera = tabla_cabecera+'<th>N</th><th>CODIGO</th><th>CLIENTE</th><th>C&Oacute;DIGO CLIENTE</th><th>OPERADOR</th><th>FECHA INICIO</th><th>FECHA ENTREGA</th><th>TIPO COMPRA</th><th>FORMA DE PAGO</th><th>DETALLAR</th><th>EDITAR</th><th>ELIMINAR</th>';
          //console.log(total);
          var total=resultado[0].total;
          var buscar=resultado[0].cotizacion_buscar;
          var nro=0;
          $.each(resultado, function(index, value){
              nro++;                  
              tabla_cabecera = tabla_cabecera +'<tr><td>'+nro+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.vent_prof_cab_cod_prof+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.nombre_cliente+'&nbsp;'+value.ap_pat_cliente+'&nbsp;'+value.ap_mat_cliente+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.codigo_cliente+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.nom_op+'&nbsp;'+value.ap_part_op+'&nbsp;'+value.ap_mat_op+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.vent_prof_cab_fech_cot+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.vent_prof_cab_fech_entrega_cot+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.nom_compra+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+value.nom_pago+'</td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().detallarCotPriv(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/consulta_contrato_32x32.png" align="absmiddle"><br> Detallar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().editarCotPubl(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/edit file_32x32.png" align="absmiddle"><br> Modificar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().eliminarCotPubl(\''+value.vent_prof_cab_cod_unico+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
          });
          tabla_cabecera = tabla_cabecera+'</table>';
          $('#div_lista_cotizaciones_nuevas_publ').append(tabla_cabecera);
          $("#palabra_cot_publ_buscar").keyup(function(){
          new Home().buscarCotizacionesPubl($('#palabra_cot_publ_buscar').val());
          });
          var paginas = Math.ceil(total/num);

          paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
          for (var i=1;i<=paginas;i++) {
            paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
            if(pag == i){
              paginacion_div = paginacion_div+i;
            }else{
              paginacion_div = paginacion_div+'<a href="#" onClick="new Home().buscarCotizacionesPublBoton('+i+', '+limit+', '+num+')">'+i+'</a>';            
            }
            paginacion_div = paginacion_div+'</div>';
          }
          paginacion_div = paginacion_div+'</div></div>';
          $('#div_lista_cotizaciones_nuevas_publ').append(paginacion_div);
          $("#palabra_cot_publ_buscar").val(buscar);

        },
        error: function(resultado){
        }
      });

    }

    /**
   *  Este metodo lista todos las cotizaciones buscados con autocomplet
   */
   this.buscarCotizacionesPubl = function(palabra_buscar){ 
   //alert(palabra_buscar);
    $.ajax({
      url:'index.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        action : 'cotizaciones',
        tp :'buscarCotizacionesPubl',
        cotizacion_buscar: palabra_buscar
      },
      beforeSend : function(){
      },
      success: function(resultado){
        $("#palabra_cot_publ_buscar").autocomplete({
              source: resultado,/* este es el script que realiza la busqueda */
              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
              select: new Home().cotizacionPublSeleccionado /* esta es la rutina que extrae la informacion del producto seleccionado */
              //focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
          });
      },
      error: function(resultado){
      }
    });

   }

       /**
   * Metodo que nos muestra el cotizacion privada seleccionado  
   */
   this.cotizacionPublSeleccionado = function(evt, ui){
      //alert("select");
      //console.log("llega");
      var valor = ui.item.value;
      var label = ui.item.label;
      var id = ui.item.id;
      //var datos = label.split(" ");
      //console.dir(datos);
          console.log(id);
          $.ajax({
            url:'index.php',
            dataType: 'json',
            type: 'GET',
            data : { 
              action : 'cotizaciones',
              tp :'getDatosBusCotPubl',
              id_unico: id 
            },
            beforeSend : function(){
              $('#div_lista_cotizaciones_nuevas_publ').empty();
              $('#div_lista_cotizaciones_nuevas_publ').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
            },
            success: function(resultado){
              id_forma=resultado[0].vent_prof_cab_cod_unico;
              id_cliente=resultado[0].vent_prof_cab_cod_cliente;
              id_op=resultado[0].vent_prof_cab_cod_operador;
              cod_forma=resultado[0].vent_prof_cab_cod_prof;
              codigo_cliente=resultado[0].codigo_cliente;
              nombre_cliente=resultado[0].nombre_cliente;
              ap_pat_cliente=resultado[0].ap_pat_cliente;
              ap_mat_cliente=resultado[0].ap_mat_cliente;
              nom_op=resultado[0].nom_op;
              ap_part_op=resultado[0].ap_part_op;
              ap_mat_op=resultado[0].ap_mat_op;
              fecha_ini_cot=resultado[0].vent_prof_cab_fech_cot;
              fecha_ent_cot=resultado[0].vent_prof_cab_fech_entrega_cot;
              nom_compra=resultado[0].nom_compra;
              nom_pago=resultado[0].nom_pago;

              $('#div_lista_cotizaciones_nuevas_publ').empty();
              var tabla_cabecera = '<div id="buscar_cot_publ"><span><strong>Buscar Cotizacion:</strong></span> <input type="text" name="palabra_cot_publ_buscar" id="palabra_cot_publ_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Home().buscarCotizacionesPublBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_cot_publ_vent" id="id_unico_cot_publ_vent">';
              tabla_cabecera = tabla_cabecera+'<table id="tb_vent_lista_cotizaciones_publ" class="table_usuario">';
              tabla_cabecera = tabla_cabecera+'<th>N</th><th>CODIGO</th><th>CLIENTE</th><th>C&Oacute;DIGO CLIENTE</th><th>OPERADOR</th><th>FECHA INICIO</th><th>FECHA ENTREGA</th><th>TIPO DE COMPRA</th><th>FORMA DE PAGO</th><th>DETALLAR</th><th>EDITAR</th><th>ELIMINAR</th>';              
              tabla_cabecera = tabla_cabecera +'<tr><td>1</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+cod_forma+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+nombre_cliente+'&nbsp;'+ap_pat_cliente+'&nbsp;'+ap_mat_cliente+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+codigo_cliente+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+nom_op+'&nbsp;'+ap_part_op+'&nbsp;'+ap_mat_op+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+fecha_ini_cot+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+fecha_ent_cot+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+nom_compra+'</td>';
              tabla_cabecera = tabla_cabecera +'<td>'+nom_pago+'</td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().detallarCotPriv(\''+id_forma+'\')"><img src="../img/consulta_contrato_32x32.png" align="absmiddle"><br> Detallar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().editarCotPubl(\''+id_forma+'\')"><img src="../img/edit file_32x32.png" align="absmiddle"><br> Modificar</a></td>';
              tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().eliminarCotPubl(\''+id_forma+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
              tabla_cabecera = tabla_cabecera+'</table>';
              $('#div_lista_cotizaciones_nuevas_publ').append(tabla_cabecera);
              $("#palabra_cot_publ_buscar").keyup(function(){
              new Home().buscarCotizacionesPubl($('#palabra_cot_publ_buscar').val());
              });

            },
            error: function(resultado){
            }
          });
   }

   /**
   * Metodo que nos muestra el cliente seleccionado
   */
  this.listarProductosParaStock = function(){
    $.getJSON('?action=cotizaciones&tp=listarProductosStock', function(result){
      producto_detalle='';
       $.each(result, function(index, producto){
          producto_detalle = producto_detalle+'<div id="div_detalle_producto_consulta">';
          if(producto.alm_prod_cab_img != ""){
            producto_detalle = producto_detalle+'<div id="div_img_producto_consulta"><img src="trebol/'+producto.alm_prod_cab_img+'" width="150" height="100"></div>';
          }else{
            producto_detalle = producto_detalle+'<div id="div_img_producto_consulta"><img src="../images/producto/img/anon.jpg" width="150" height="100"></div>';
          }
          producto_detalle = producto_detalle+'<div id="div_producto_consulta_detalle_producto"><h4>'+producto.alm_prod_cab_nombre+'</h4> ';
          producto_detalle = producto_detalle+'<label><strong>CODIGO REF:</strong></label> '+producto.alm_prod_cab_cod_ref;
          producto_detalle = producto_detalle+' <label><strong>NUEVO CODIGO:</strong></label> '+producto.alm_prod_cab_codigo;
          producto_detalle = producto_detalle+' <label><strong>MARCA:</strong></label> '+producto.alm_prod_det_marca;
          producto_detalle = producto_detalle+' <label><strong>PROVEEDOR:</strong></label> '+producto.alm_prod_cab_nom_prov;
          producto_detalle = producto_detalle+'<br><label><strong>CANTIDAD:</strong></label> '+producto.alm_prod_det_cantidad+' '+producto.alm_prod_cab_presentacion;
          producto_detalle = producto_detalle+' <label><strong>P. VENTA:</strong></label> '+producto.alm_prod_det_prec_venta+' '+producto.alm_prod_cab_sigla;
          producto_detalle = producto_detalle+' <label><strong>P. VENTA MIN:</strong></label> '+producto.alm_prod_det_prec_min_venta+' '+producto.alm_prod_cab_sigla;
          producto_detalle = producto_detalle+'<br><label><strong>P. VENTA MAX:</strong></label> '+producto.alm_prod_det_prec_max_venta+' '+producto.alm_prod_cab_sigla;
          producto_detalle = producto_detalle+' <label><strong>ORIGEN:</strong></label> '+producto.alm_prod_cab_suc_nombre;
          producto_detalle = producto_detalle+'<br><input type="button" class="btn_form" onClick="new Home().anadirProductoPropuesta(\''+producto.alm_prod_cab_id_unico_prod+'\', \''+producto.alm_prod_det_id_unico+'\',\''+$('#imp_codigo_prof_venta_0089').val()+'\');" value="AGREGAR PRODUCTO">';
          producto_detalle = producto_detalle+'</div></div>';
       });
       $('#div_vent_lista_productos_detalle').append(producto_detalle);
    });
  }
  /**
   * Metodo que permite añadir el producto en la lista de la solicitud
   */
  this.anadirProductoPropuesta = function(codigo_producto_cab, codigo_producto_det, codido_prof_unico){
       $('#form_vent_nuevo_item_cabecera_formulario')[0].reset();
      $.getJSON('?action=cotizaciones&tp=getProductoInformation&codigo_cab='+codigo_producto_cab+'&codigo_det='+codigo_producto_det, function(result){
          $('#txt_vent_tiempo_espera').numeric();
          $('#div_vent_proveedor_vent').empty().append(result.apc.alm_prod_cab_nombre);
          $('#id_codigo_proveedor').val(result.apc.alm_prod_cab_prov);
          $('#div_vent_codigo_unico_producto_item').empty().append(result.apc.alm_prod_cab_codigo);
          $('#txt_vent_codigo_unico').val(result.apc.alm_prod_cab_id_unico_prod);
          $('#id_cab_prof_venta_codigo_unico').val(codido_prof_unico);
          if(result.apd.alm_prod_det_cantidad > 0){
            $('#div_vent_estado_producto_dispo').empty().append("Disponible");  
          }else{
            $('#div_vent_estado_producto_dispo').empty().append("Agotado");  
          }
          arreglo_codigo = result.apc.alm_prod_cab_codigo.split("-");
          $.getJSON('?action=cotizaciones&tp=getTipoProductoXIni&inicial='+arreglo_codigo[0], function(resu){
            $('#div_vent_estado_tipo_producto').empty().append(resu[0].GRAL_PAR_PRO_DESC);
            $('#id_codigo_tipo_prod').val(resu[0].GRAL_PAR_PRO_COD);
          });
          $('#txt_vent_item_cant_prod').val(result.apd.alm_prod_det_cantidad);
          $('#div_vent_precio_vent_min').val(result.apd.alm_prod_det_prec_min_venta);
          $('#div_vent_precio_vent_max').val(result.apd.alm_prod_det_prec_max_venta);
          $('#id_codigo_tipo_moneda').val(result.apc.alm_prod_cab_moneda);
          $('#id_marca_prod_item').val(result.apd.alm_prod_det_marca);
          $('#div_marca_prod_form_item').empty().append(result.apd.alm_prod_det_marca);
          $('#div_sucursal_origen_form_item').empty().append(result[0].alm_prod_cab_suc_nombre);
          $('#id_sucursal_origen_item').val(result.apc.alm_prod_cab_suc_origen);
          $.getJSON('?action=cotizaciones&tp=getServicesOnProducto', function(res){
            $('#select_vent_servicio_producto_item').empty();
            $.each(res, function(indice, serv){
              $('#select_vent_servicio_producto_item').append('<option value="'+serv.GRAL_PAR_PRO_COD+'">'+serv.GRAL_PAR_PRO_DESC+'</option>');
            });
            $('#input_vent_porcentaje_por_servicio').val(res[0].GRAL_PAR_PRO_CTA1);
          });
          $('#select_vent_servicio_producto_item').change(function(evt){
              //alert($('#select_vent_servicio_producto_item').val());
              $.getJSON('?action=cotizaciones&tp=getServicesXID&id_service='+$('#select_vent_servicio_producto_item').val(), function(rest){
                $('#input_vent_porcentaje_por_servicio').val(rest[0].GRAL_PAR_PRO_CTA1);
              });
          });

        //});
      });
      $('#tpl_vent_form_nuevo_item_cabecera').dialog({
          width: 750,
          height : 600,
          modal: true,
          draggable : false
      });      
  }
  /** Este es el metodo que maneja el formularo de nuevo item cabecera formulario ==========================================================================**/
  this.enviarFormularioNuevoItemDetalleProducto = function(){
    var util = new Utilitarios();
    util.validarCampo('txt_vent_item_cant_prod', 'div_error_item_cant_prod', 'La cantidad no puede estar vacia.');
    util.validarCampo('txt_vent_precio_venta_form_item', 'div_error_vent_precio_venta', 'El precio de venta no puede estar vacio.');
    util.validarCampo('txt_vent_tiempo_espera', 'div_error_vent_tiempo_espera', 'El tiempo de espera no puede estar vacio.');
    $('#form_vent_nuevo_item_cabecera_formulario').submit(function(evt){
      //alert('prueba');
      if($.trim($('#txt_vent_item_cant_prod').val()) == ""){
        util.mostrarMensajeAlerta(0, 'La cantidad no puede ser menor', 'Precio de venta');
      }else if($.trim($('#txt_vent_precio_venta_form_item').val()) == ""){
        util.mostrarMensajeAlerta(0, 'Precio de venta no puede ser vacio', 'Precio de venta');
      }else if($.trim($('#txt_vent_tiempo_espera').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El tiempo de espera no puede ser vacio', 'Precio de venta');
      }else{
       if(($.trim($('#txt_vent_precio_venta_form_item').val()) <= $('#div_vent_precio_vent_max').val()) && ($.trim($('#txt_vent_precio_venta_form_item').val()) > $('#div_vent_precio_vent_min').val())){
         dataString = $(this).serialize();
         $.ajax({
           url:'index.php?action=cotizaciones&tp=registrarNuevaProducto',
           type:'POST',
           dataType : 'json',
           data:dataString,
           success:function(res){
             //console.log(res);
             if(res.completo){
               $('#id_div_detalle_cotizacion_000100').empty();
               new Home().listarDetalleCotizacionPrivada($('#id_cab_prof_venta_codigo_unico').val());   
             }
           }
         });
       }else{
         util.mostrarMensajeAlerta(0, 'El precio no esta permitido', 'Precio de Venta');
       }
      }
      evt.preventDefault();
    });
  }

  /** Metodo que permite listar Detalle Cotizacion Privado **/
  this.listarDetalleCotizacionPrivada = function(codigo_prof_venta_01){
    //alert(codigo_prof_venta_01);
    $('#tpl_vent_form_nuevo_item_cabecera').dialog('close');
    $('#tpl_vent_form_nuevo_prod_cotizacion_priv').dialog('close');
    $.getJSON('index.php', {action:'cotizaciones', tp:'getDetallePriv', id_prof:codigo_prof_venta_01}, function(json, textStatus) {
        var tabla_cabecera ='<br><table aling="center" id="tb_vent_det_cotizaciones_priv" class="table_usuario">';
        tabla_cabecera = tabla_cabecera+'<tr><th>TIPO</th><th>PRODUCTO</th><th>CANTIDAD</th><th>P. VENTA</th><th>TOTAL</th><th>MARCA</th><th>PROCEDENCIA</th><th>TIEMPO ESPERA</th><th>CATALOGO</th><th>ESPECIFICACIONES TEC.</th><th>CONF. DESEADA</th><th>ACCESORIOS</th><th>SERV. NECESARIO</th><th>ELIMINAR</th></tr>';
        tabla_cabecera = tabla_cabecera+'</table><br>';
        $('#id_div_detalle_cotizacion_000100').append(tabla_cabecera);
        var cantidad=0;
        var precio=0;
        var total_totales02 = 0;
        $.each(json, function(index, value) {
          var cant=parseFloat(value.vent_prof_det_cant_prod);
          var prec=parseFloat(value.vent_prof_det_precio_venta);
          cantidad=cantidad+cant;
          precio=precio+prec;
          tabla_cabecera = '<tr><td align="center">'+value.nom_tipo+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.nom_prod+'</td>';
          //tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_tipo_mon+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_cant_prod+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_precio_venta+'</td>';
          total_totales02 = total_totales02 + (value.vent_prof_det_cant_prod*value.vent_prof_det_precio_venta);
          tabla_cabecera = tabla_cabecera +'<td align="center">'+(value.vent_prof_det_cant_prod*value.vent_prof_det_precio_venta)+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_marca_prod+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.region_prod+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.vent_prof_det_tiempo_esp_prod+' Dias</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.catalogo+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.especif+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.conf+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.acces+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center">'+value.nom_serv+'</td>';
          tabla_cabecera = tabla_cabecera +'<td align="center"><a href="#" onclick="new Home().eliminarProfVenta(\''+value.vent_prof_det_cod_unico+'\')"><img src="../img/close_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
          $('#tb_vent_det_cotizaciones_priv').append(tabla_cabecera);  
        });
        tabla_cabecera = '<tr bgcolor="#ACADAD"><td align="center" colspan="2"><b>TOTAL</b></td>';
        tabla_cabecera = tabla_cabecera +'<td align="center"><strong>'+cantidad+'</strong></td>';
        tabla_cabecera = tabla_cabecera +'<td align="center"><strong>'+precio+'</strong></td>';
        tabla_cabecera = tabla_cabecera +'<td align="center"><strong>'+total_totales02+'</strong></td></tr>';
        $('#tb_vent_det_cotizaciones_priv').append(tabla_cabecera);
    });
  }
  /** este es el metodo que elimina las proformas **/
  this.eliminarProfVenta = function(codigo_det_prof_ventas){
    $("#dialog-confirm-cot").attr("title", "Eliminar Item Cotizacion");
    $("#dialog-confirm-cot #contexto_dialog_cot").empty();
    contexto_dialog = '<img src="../img/alert_48x48.png" align="absmiddle">';
    contexto_dialog = contexto_dialog+"Esta seguro que quieres eliminar Item de Proforma?";
    $("#dialog-confirm-cot #contexto_dialog_cot").append(contexto_dialog);
    $("#dialog-confirm-cot").dialog({
      resizable: false,
      height:200,
      width:400,
      modal: true,
      buttons: {
        "Aceptar": function() {
          $(this).dialog("close");
          //new Home().listarDetalleCotizacionPrivada(codigo_det_prof_ventas);
          new Home().confirmarDeleteProfCotizacion(codigo_det_prof_ventas);
        },
        "Cancelar": function() {
          $(this).dialog( "close" );
        }
      }
    });
  }
  /** Este es el metod que elimina la cotizacion privada **/
  this.confirmarDeleteProfCotizacion = function(codigo_det_prof_vent){
    $.getJSON('index.php', {action:'cotizaciones', tp:'eliminarDetProfVenta',codigo_del_prof_det: codigo_det_prof_vent}, function(json, textStatus) {
        if(json.complet){
          $('#id_div_detalle_cotizacion_000100').empty();
          new Home().listarDetalleCotizacionPrivada(codigo_det_prof_vent);
        }
    });
  }
  /** MEtodo que permite cerrar los el dialog**/
  this.closeDialogoNuevoItemProducto = function(){
      $('#tpl_vent_form_nuevo_item_cabecera').dialog('close'); 
  }
   /*
    * Metodo  nueno cliente
    */
  this.nuevoClienteBoton = function(){

    new Home().resetForm();
    var util = new Utilitarios();
    $('#tpl_vent_form_nuevo_cliente_bot h3').empty();
    $('#tpl_vent_form_nuevo_cliente_bot h3').append('<img src="../img/user office_32x32.png" align="absmiddle"> NUEVO CLIENTE');
    $('#txt_vent_celular_cliente_bot').numeric();
    $('#txt_vent_telefono_cliente_bot').numeric();
    $('#txt_vent_numero_interno_bot').numeric();
    util.validarCampo('txt_vent_nombre_cliente_bot', 'div_error_vent_error_nombre_bot', 'Nombre no puede estar vacio');
    util.validarCampo('txt_vent_apellido_pat_cliente_bot', 'div_error_vent_error_apellido_pat_bot', 'Apellido no puede estar vacio');
    util.validarCampo('txt_vent_cliente_correo_bot', 'div_error_vent_error_cliente_correo_bot', 'Correo esta vacio');
    util.validarCampo('txt_vent_celular_cliente_bot', 'div_error_vent_error_celular_cliente_bot', 'Celular no puede estar vacio');
    util.validarCampo('txt_vent_cliente_persona_contacto_bot', 'div_error_vent_error_persona_contacto_bot', 'Contacto no puede estar vacio');
    util.validarCampo('txt_vent_razon_social_cliente_bot', 'div_error_vent_error_razon_social_cliente_bot', 'Razon Social no puede estar vacio');
    util.validarCampo('txt_vent_nit_cliente_bot', 'div_error_vent_error_nit_cliente_bot', 'NIT no puede estar vacio');
    util.validarCampo('txt_vent_telefono_cliente_bot', 'div_error_vent_error_telefono_cliente_bot', 'Telefono no puede estar vacio');
    util.validarCampo('txt_vent_numero_interno_bot', 'div_error_vent_error_numero_interno_bot', 'N&uacute;mero Int. no puede estar vacio');
    $('#tpl_vent_form_nuevo_cliente_bot').dialog({
      width: 735,
      height : 460,
      modal: true,
      draggable : false
    });

  }

  this.resetForm = function(){
      $('#txt_vent_nombre_cliente_bot').val("");
      $('#txt_vent_empresa_cliente_bot').val("");
      $('#txt_vent_apellido_pat_cliente_bot').val("");
      $('#txt_vent_cargo_cliente_bot').val("");
      $('#txt_vent_apellido_mat_cliente_bot').val("");
      $('#txt_vent_departamento_cliente_bot').val("");
      $('#txt_vent_cliente_correo_bot').val("");
      $('#txt_vent_telefono_cliente_bot').val("");
      $('#txt_vent_celular_cliente_bot').val("");
      $('#txt_vent_nit_cliente_bot').val("");
      $('#txt_area_vent_dirrecion_cliente_bot').val("");
      $('#txt_vent_razon_social_cliente_bot').val("");
      $('#txt_vent_cliente_persona_contacto_bot').val("");
      $('#txt_vent_numero_interno_bot').val("");
      $('#id_unico_cliente_bot').val("");
      $('#codigo_cliente_bot').val("");
  }


    /**
   * Metodo que permite crear un cliente desde el boton
   */
  this.enviarFormularioNuevoClienteBoton = function (){
    var util = new Utilitarios();
    $('#form_vent_nuevo_cliente_bot').submit(function(evt){
      if($.trim($('#txt_vent_nombre_cliente_bot').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Nombre no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_apellido_pat_cliente_bot').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Apellido Paterno no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_cliente_correo_bot').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Correo no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_celular_cliente_bot').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Celular no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_area_vent_dirrecion_cliente_bot').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Dirreci&oacute;n no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_cliente_persona_contacto_bot').val()) == ""){
        util.mostrarMensajeAlerta(0, 'La Persona de Contacto no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_telefono_cliente_bot').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Tel&eacute;fono de Contacto no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_nit_cliente_bot').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El NIT no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_razon_social_cliente_bot').val()) == ""){
        util.mostrarMensajeAlerta(0, 'La Razon Social no puede estar vacio', 'Advertencia');
      }else{
        datos = $(this).serialize();
        $.ajax({
          url:'?action=clientes&tp=saveClienteBot',
          data:datos,
          type:'GET',
          dataType:'json',
          success:function(res){
            //console.log(res);
            codigo_cliente=res.codigo_cliente;
            nom_cliente=res.nom_cliente;
            app_cliente=res.app_cliente;
            appm_cliente=res.appm_cliente;
            id_cliente=res.id_cliente;

            if(res.complet){
              //new Cliente().listarClientes(0,limit_par, num_par);
              //$('#tpl_vent_form_modif_cotizacion_priv').dialog('close');  
              $('#tpl_vent_form_nuevo_cliente_bot').dialog('close');              
              $('#txt_vent_cliente_proforma').val(nom_cliente+' '+app_cliente+' '+appm_cliente);
              $('#txt_vent_cod_cliente_proforma').val(nom_cliente+' '+app_cliente+' '+appm_cliente);
              $('#txt_vent_cotizador_proforma').val(codigo_cliente);
              $('#cod_unico_cliente').val(id_cliente);
             //new Home().nuevaCotizacionPriv();
              
              

            } 
          }
        }); 
      }
      
      evt.preventDefault();
    });
  }

   /*
    * Metodo  nueno cliente
    */
  this.nuevoClienteBotonPubl = function(){

    new Home().resetFormPubl();
    var util = new Utilitarios();
    $('#tpl_vent_form_nuevo_cliente_bot_publ h3').empty();
    $('#tpl_vent_form_nuevo_cliente_bot_publ h3').append('<img src="../img/user office_32x32.png" align="absmiddle"> Nuevo Cliente ');
    $('#txt_vent_celular_cliente_bot_publ').numeric();
    $('#txt_vent_telefono_cliente_bot_publ').numeric();
    $('#txt_vent_numero_interno_bot_publ').numeric();
    util.validarCampo('txt_vent_nombre_cliente_bot_publ', 'div_error_vent_error_nombre_bot_publ', 'Nombre no puede estar vacio');
    util.validarCampo('txt_vent_apellido_pat_cliente_bot_publ', 'div_error_vent_error_apellido_pat_bot_publ', 'Apellido no puede estar vacio');
    util.validarCampo('txt_vent_cliente_correo_bot_publ', 'div_error_vent_error_cliente_correo_bot_publ', 'Correo esta vacio');
    util.validarCampo('txt_vent_celular_cliente_bot_publ', 'div_error_vent_error_celular_cliente_bot_publ', 'Celular no puede estar vacio');
    util.validarCampo('txt_vent_cliente_persona_contacto_bot_publ', 'div_error_vent_error_persona_contacto_bot_publ', 'Contacto no puede estar vacio');
    util.validarCampo('txt_vent_razon_social_cliente_bot_publ', 'div_error_vent_error_razon_social_cliente_bot_publ', 'Razon Social no puede estar vacio');
    util.validarCampo('txt_vent_nit_cliente_bot_publ', 'div_error_vent_error_nit_cliente_bot_publ', 'NIT no puede estar vacio');
    util.validarCampo('txt_vent_telefono_cliente_bot_publ', 'div_error_vent_error_telefono_cliente_bot_publ', 'Telefono no puede estar vacio');
    util.validarCampo('txt_vent_numero_interno_bot_publ', 'div_error_vent_error_numero_interno_bot_publ', 'N&uacute;mero Int. no puede estar vacio');
    $('#tpl_vent_form_nuevo_cliente_bot_publ').dialog({
      width: 735,
      height : 460,
      modal: true,
      draggable : false
    });

  }

    this.resetFormPubl = function(){
      $('#txt_vent_nombre_cliente_bot').val("");
      $('#txt_vent_empresa_cliente_bot').val("");
      $('#txt_vent_apellido_pat_cliente_bot').val("");
      $('#txt_vent_cargo_cliente_bot').val("");
      $('#txt_vent_apellido_mat_cliente_bot').val("");
      $('#txt_vent_departamento_cliente_bot').val("");
      $('#txt_vent_cliente_correo_bot').val("");
      $('#txt_vent_telefono_cliente_bot').val("");
      $('#txt_vent_celular_cliente_bot').val("");
      $('#txt_vent_nit_cliente_bot').val("");
      $('#txt_area_vent_dirrecion_cliente_bot').val("");
      $('#txt_vent_razon_social_cliente_bot').val("");
      $('#txt_vent_cliente_persona_contacto_bot').val("");
      $('#txt_vent_numero_interno_bot').val("");
      $('#id_unico_cliente_bot').val("");
      $('#codigo_cliente_bot').val("");
  }

    /**
   * Metodo que permite crear un cliente desde el boton
   */
  this.enviarFormularioNuevoClienteBotonPubl = function (){
    var util = new Utilitarios();
    $('#form_vent_nuevo_cliente_bot_publ').submit(function(evt){
      if($.trim($('#txt_vent_nombre_cliente_bot_publ').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Nombre no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_apellido_pat_cliente_bot_publ').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Apellido Paterno no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_cliente_correo_bot_publ').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Correo no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_celular_cliente_bot_publ').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Celular no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_area_vent_dirrecion_cliente_bot_publ').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Dirreci&oacute;n no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_cliente_persona_contacto_bot_publ').val()) == ""){
        util.mostrarMensajeAlerta(0, 'La Persona de Contacto no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_telefono_cliente_bot_publ').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El Tel&eacute;fono de Contacto no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_nit_cliente_bot_publ').val()) == ""){
        util.mostrarMensajeAlerta(0, 'El NIT no puede estar vacio', 'Advertencia');
      }else if($.trim($('#txt_vent_razon_social_cliente_bot_publ').val()) == ""){
        util.mostrarMensajeAlerta(0, 'La Razon Social no puede estar vacio', 'Advertencia');
      }else{
        datos = $(this).serialize();
        $.ajax({
          url:'?action=clientes&tp=saveClienteBotPubl',
          data:datos,
          type:'GET',
          dataType:'json',
          success:function(res){
            console.log(res);
            codigo_cliente=res.codigo_cliente;
            nom_cliente=res.nom_cliente;
            app_cliente=res.app_cliente;
            appm_cliente=res.appm_cliente;
            id_cliente=res.id_cliente;

            if(res.complet){
              //new Cliente().listarClientes(0,limit_par, num_par);
              //$('#tpl_vent_form_modif_cotizacion_priv').dialog('close');  
              $('#tpl_vent_form_nuevo_cliente_bot_publ').dialog('close');              
              $('#txt_vent_cliente_proforma_publ').val(nom_cliente+' '+app_cliente+' '+appm_cliente);
              $('#txt_vent_cod_cliente_proforma_publ').val(nom_cliente+' '+app_cliente+' '+appm_cliente);
              $('#txt_vent_cotizador_proforma_publ').val(codigo_cliente);
              $('#cod_unico_cliente_publ').val(id_cliente);
             //new Home().nuevaCotizacionPriv();
              
              

            } 
          }
        }); 
      }
      
      evt.preventDefault();
    });
  }

  /*
   * Metodo para cancelar el detalle de cot priv
   */

  this.cancelarDetallarCotPriv = function(){
      $('#tpl_vent_form_nuevo_cot_det_priv').dialog('close');


  }

  /*
   * Metodo para cancelar la modificacion de la cabecera de cot priv
   */

  this.cancelarModificarCotPriv = function(){
      $('#tpl_vent_form_modif_cotizacion_priv').dialog('close');
      // Estos son -------------------------------------------------------------------------->

  }

  /*
   * Metodo para cancelar la modificacion de la cabecera de cot publ
   */

  this.cancelarModificarCotPubl = function(){
      $('#tpl_vent_form_modif_cotizacion_publ').dialog('close');


  }

  
}



