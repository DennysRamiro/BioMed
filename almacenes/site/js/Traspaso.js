/**
* esta es la clase principal de almacenes
* @ Ruth Palomino
*/

var limit_par=10;
var num_par =10;
function Traspaso(){

	//alert("traspaso js");
	/*
	* Metodo principal de la clase Traspasos
	*
	**/
	this.init = function(){
		new Traspaso().listarTraspasos(0, limit_par, num_par);
		new Traspaso().enviarFormularioNuevoTraspaso();
	}

	/**
     * Metodo Listar Traspaso
     */
    this.listarTraspasos = function (start, limit, num) {
    	//alert(start+'-'+limit+'-'+num);
    	var numero=num;
		pag = 1;
		if(start != 0 && start != 1){
		    pag = start;
		    start = start*num-(num);
		    limit = num;
		}else{
		    start = 0;
		    limit = num;
		}

        $.ajax({
			url:'alm_gest.php',
			dataType:'json',
			type:'GET',
			data:{
				accion: 'traspaso',
				tp:'listarTraspasos',
				start : start,
	            limit : limit
			},
			beforeSend : function(){
				$('#div_lista_traspasos_almacenes').empty();
                $('#div_lista_traspasos_almacenes').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(res){
				$('#div_lista_traspasos_almacenes').empty();
				var tabla_traspasos = '<div id="buscar_not_trasp"><span><strong>Buscar :</strong></span> <input type="text" name="palabra_trasp_buscar" id="palabra_trasp_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Traspaso().buscarNotaTraspBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_trasp" id="id_unico_not_trasp">';
          	        tabla_traspasos = tabla_traspasos+'<table id="tabla_traspaso_almacenes" class="table_usuario">';
          	        tabla_traspasos = tabla_traspasos+'<tr><th>NRO</th><th>CODIGO</th><th>NOMBRE</th><th>ORIGEN</th><th>DESTINO</th><th>FECHA</th><th>EDITAR</th><th>ELIMINAR</th></tr>';
          	    var num=0;
          	    var total=res[0].total;
          	    $.each(res, function(index, value){ 
          	    	num++;
          	        tabla_traspasos = tabla_traspasos+'<tr><td>'+num+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.alm_cab_ing_egr_nro_nota+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.alm_cab_ing_egr_nombre+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.origen+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.destino+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.alm_cab_ing_egr_fecha_ingreso+'</td>';
          	        tabla_traspasos = tabla_traspasos +'<td align="center"><a href="#" onclick="new Traspaso().IngresaNuevoItemCabDet(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/nota_editar_alm_32x32.png" align="absmiddle"><br> Modificar</a></td>';
                    tabla_traspasos = tabla_traspasos +'<td align="center"><a href="#" onclick="new Traspaso().eliminarNotaTraspaso(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
          	    });
          	        tabla_traspasos = tabla_traspasos+'</table>';
          	    $('#div_lista_traspasos_almacenes').append(tabla_traspasos);
          	    $("#palabra_trasp_buscar").keyup(function(){
	              new Traspaso().buscarNotaTrasp($('#palabra_trasp_buscar').val());
	            });
                var paginas = Math.ceil(total/numero);
                /*console.log(total);
                console.log(num);
                console.log(paginas);*/
			    paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
			    for (var i=1;i<=paginas;i++) {
					paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
					if(pag == i){
						paginacion_div = paginacion_div+i;
					}else{
						paginacion_div = paginacion_div+'<a href="#" onClick="new Traspaso().listarTraspasos('+i+', '+limit+', '+numero+')">'+i+'</a>';						
					}
					paginacion_div = paginacion_div+'</div>';
			  	}
			  	paginacion_div = paginacion_div+'</div></div>';
			  	$('#div_lista_traspasos_almacenes').append(paginacion_div);
			}, 
			errors :function(resul){
				console.log(resul);
			}
	    });
    }

    /**
	 * Metodo para buscar traspasos con autocomplet
	 */

	this.buscarNotaTrasp = function(palabra_buscar){ 
    	//alert(palabra_buscar);
    	$.ajax({
		      url:'?accion=traspaso&tp=buscarTraspasos',
		      dataType: 'json',
		      type: 'GET',
		      data : { 
		        //action : 'ingreso',
		        //tp :'buscarIngresos',
		        traspasos_buscar: palabra_buscar
		      },
		      beforeSend : function(){
		      },
		      success: function(resultado){
		       $("#palabra_trasp_buscar").autocomplete({
		              source: resultado,/* este es el script que realiza la busqueda */
		              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
		              select: new Traspaso().notaTraspSeleccionado /* esta es la rutina que extrae la informacion del producto seleccionado */
		              //focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
		          });
		      },
		      error: function(resultado){
		      }
		});
    }

   /**
    * Metodo que nos muestra el traspaso seleccionado de la busqueda
    */
   this.notaTraspSeleccionado = function(evt, ui){
      //alert("select");
      //console.log("llega");
      var valor = ui.item.value;
      var label = ui.item.label;
      var id = ui.item.id;
      //var datos = label.split(" ");
      //console.dir(datos);
          console.log(id);
          $.ajax({
            url:'?accion=traspaso&tp=getDatosBusNotTrasp',
            dataType: 'json',
            type: 'GET',
            data : { 
              id_unico: id 
            },
            beforeSend : function(){
             
             //$('#div_lista_ingreso_almacenes').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
            },
            success: function(resultado){
            	//console.log(resultado);
                id_nota=resultado[0].alm_cab_ing_nro_unico;
                nro_nota=resultado[0].alm_cab_ing_egr_nro_nota;
                nom_nota=resultado[0].alm_cab_ing_egr_nombre;
                fecha_nota=resultado[0].alm_cab_ing_egr_fecha_ingreso;
                origen=resultado[0].origen;
                destino=resultado[0].destino;

                $('#div_lista_traspasos_almacenes').empty();
				var tabla_traspasos = '<div id="buscar_not_trasp"><span><strong>Buscar :</strong></span> <input type="text" name="palabra_trasp_buscar" id="palabra_trasp_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Traspaso().buscarNotaTraspBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_trasp" id="id_unico_not_trasp">';
          	        tabla_traspasos = tabla_traspasos +'<table id="tabla_traspaso_almacenes" class="table_usuario">';
          	        tabla_traspasos = tabla_traspasos +'<tr><th>NRO</th><th>CODIGO</th><th>NOMBRE</th><th>ORIGEN</th><th>DESTINO</th><th>FECHA</th><th>EDITAR</th><th>ELIMINAR</th></tr>';  
                    tabla_traspasos = tabla_traspasos +'<tr><td>1</td>';
	                tabla_traspasos = tabla_traspasos +'<td>'+nro_nota+'</td>';
	                tabla_traspasos = tabla_traspasos +'<td>'+nom_nota+'</td>';
	                tabla_traspasos = tabla_traspasos +'<td>'+origen+'</td>';
	                tabla_traspasos = tabla_traspasos +'<td>'+destino+'</td>';
	                tabla_traspasos = tabla_traspasos +'<td>'+fecha_nota+'</td>';
	 			    tabla_traspasos = tabla_traspasos +'<td align="center"><a href="#" onclick="new Traspaso().IngresaNuevoItemCabDet(\''+id_nota+'\')"><img src="../img/nota_editar_alm_32x32.png" align="absmiddle"><br> Modificar</a></td>';
                    tabla_traspasos = tabla_traspasos +'<td align="center"><a href="#" onclick="new Traspaso().eliminarNotaTraspaso(\''+id_nota+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
	                tabla_traspasos = tabla_traspasos +'</table>';
	            $('#div_lista_traspasos_almacenes').append(tabla_traspasos);  
	            $("#palabra_trasp_buscar").keyup(function(){
	              new Traspaso().buscarNotaTrasp($('#palabra_trasp_buscar').val());
	            });
				var paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div>1<div id="paginacion_tabla">';
				$('#div_lista_traspasos_almacenes').append(paginacion_div);
	        },
            error: function(resultado){
            }
          });
   }

    /*
    * Metodo de busqueda desde el boton
    */
    this.buscarNotaTraspBoton = function(start, limit, num){
    	//alert(start+'-'+limit+'-'+num);
    	var numero=num;
	    pag = 1;
	    if(start != 0 && start != 1){
	        pag = start;
	        start = start*num-(num);
	        limit = pag*num;
	    }else{
	        start = 0;
	        limit = num;
	    }
    	var palabra_buscar=$("#palabra_trasp_buscar").val();
    	//alert(palabra_buscar);
        $.ajax({
	        url:'?accion=traspaso&tp=buscarNotasTrasp',
	        dataType: 'json',
	        type: 'GET',
	        data : { 
	          traspasos_buscar: palabra_buscar,
	          start : start,
	          limit : limit
	        },
	        beforeSend : function(){
	        },
            success: function(resultado){
            	$('#div_lista_traspasos_almacenes').empty();
				var tabla_traspasos = '<div id="buscar_not_trasp"><span><strong>Buscar :</strong></span> <input type="text" name="palabra_trasp_buscar" id="palabra_trasp_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Traspaso().buscarNotaTraspBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_trasp" id="id_unico_not_trasp">';
          	        tabla_traspasos = tabla_traspasos+'<table id="tabla_traspaso_almacenes" class="table_usuario">';
          	        tabla_traspasos = tabla_traspasos+'<tr><th>NRO</th><th>CODIGO</th><th>NOMBRE</th><th>ORIGEN</th><th>DESTINO</th><th>FECHA</th><th>EDITAR</th><th>ELIMINAR</th></tr>';
	          	var num=0;
	          	var total = resultado[0].total;
	            var buscar = resultado[0].traspasos_buscar;
	          	$.each(resultado, function(index, value){ 
          	    	num++;
          	        tabla_traspasos = tabla_traspasos+'<tr><td>'+num+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.alm_cab_ing_egr_nro_nota+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.alm_cab_ing_egr_nombre+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.origen+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.destino+'</td>';
          	        tabla_traspasos = tabla_traspasos+'<td>'+value.alm_cab_ing_egr_fecha_ingreso+'</td>';
          	        tabla_traspasos = tabla_traspasos +'<td align="center"><a href="#" onclick="new Traspaso().IngresaNuevoItemCabDet(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/nota_editar_alm_32x32.png" align="absmiddle"><br> Modificar</a></td>';
                    tabla_traspasos = tabla_traspasos +'<td align="center"><a href="#" onclick="new Traspaso().eliminarNotaTraspaso(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
          	    });
          	        tabla_traspasos = tabla_traspasos+'</table>';
          	    $('#div_lista_traspasos_almacenes').append(tabla_traspasos);
          	    $("#palabra_trasp_buscar").keyup(function(){
	              new Traspaso().buscarNotaTrasp($('#palabra_trasp_buscar').val());
	            });
		                
                var paginas = Math.ceil(total/numero);
                //console.log(total);
                //console.log(numero);
                //console.log(paginas);
                paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
                	for (var i=1;i<=paginas;i++) {
                		paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
		                if(pag == i){
		                  paginacion_div = paginacion_div+i;
		                }else{
		                  paginacion_div = paginacion_div+'<a href="#" onClick="new Traspaso().buscarNotaTraspBoton('+i+', '+limit+', '+numero+')">'+i+'</a>';          
		                }
                		paginacion_div = paginacion_div+'</div>';
                    }
                paginacion_div = paginacion_div+'</div></div>';
                $('#div_lista_traspasos_almacenes').append(paginacion_div);
                $("#palabra_trasp_buscar").val(buscar);


            },
            error: function(resultado){
            }
        });

    }
	/**
     * Este metodo que crea nueva Cotizacion privada
     */
    this.nuevoTraspasoAlmacenes = function (){
    	//alert("JS");
	    $("#alm_fec_trasp").val('');
		$("#alm_fec_trasp").datepicker({
	    dateFormat: "dd/mm/yy"
	    });

	    $('#tpl_alm_form_nuevo_traspaso').dialog({
	      width: 724,
	      height : 330,
	      modal: true,
	      draggable : false
	    });

    }

     /**
   * Metodo que permite crear una cotizacion privada
   */
  this.enviarFormularioNuevoTraspaso = function (){
    //alert("grabar");
    var util = new Utilitarios();
    $('#form_alm_nuevo_traspaso').submit(function(evt){
      datos = $(this).serialize();
      console.log(datos);
      /*if ($('#alm_fec_trasp').val() == ""){
        util.mostrarMensajeAlerta(0, 'La Fecha Traspaso no puede estar vacio', 'Advertencia');
      }else{*/
		$.ajax({
	        url:'?accion=traspaso&tp=grabarNuevoTraspaso',
	        data:datos,
	        type:'GET',
	        dataType:'json',
	        success:function(res){
	            if (res.completo==true) {
	            var cod_unico=res.cod_unico;
	            //new Home().listarCotizaciones(0,limit_par, num_par);
	            $('#tpl_alm_form_nuevo_traspaso').dialog('close'); // hace que se cierre el dialog
	            new Traspaso().listarTraspasos(0,limit_par, num_par);
	            new Traspaso().nuevoDetalleTraspasoAlmacenes(cod_unico); 
	            }

	        }
	    });  
      evt.preventDefault();
    });
  }

  	/**
     * Este metodo que crea nueva Cotizacion privada
     */
    this.nuevoDetalleTraspasoAlmacenes = function (cod_unico){
    	//alert("JS");
	    /*$("#alm_fec_trasp").val('');
		$("#alm_fec_trasp").datepicker({
	    dateFormat: "dd/mm/yy"
	    });*/

		 $.ajax({
	        url:'?accion=traspaso&tp=getCabTrasp',
	        dataType: 'json',
	        type: 'GET',
	        data : { 
	          cod_unico: cod_unico
	        },
	        beforeSend : function(){
	        	//$('#form_alm_traspaso_detalle').empty();
	        },
            success: function(resultado){
            	id_nota=resultado[0].cod_unico;
            	nro_nota=resultado[0].alm_cab_ing_egr_nro_nota;
            	nom_nota=resultado[0].alm_cab_ing_egr_nombre;
            	fecha_nota=resultado[0].alm_cab_ing_egr_fecha_ingreso;
            	cod_origen=resultado[0].alm_cab_ing_egr_origen;
            	cod_destino=resultado[0].alm_cab_ing_egr_destino;
            	origen=resultado[0].origen;
            	destino=resultado[0].destino;
            	$('#tb_cab_trasp').empty();
				var table_cab_det = '<tr><td colspan="2" rowspan="2" align="center" valign="middle"><img src="../img/logo.png" align="absmiddle" width="235" height="45"></td> ';
				table_cab_det = table_cab_det + '<td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td></tr> ';
				table_cab_det = table_cab_det + '<tr><td colspan="3"></td> ';
				table_cab_det = table_cab_det + '<td><h2><label for="numero_unico" id="nro_nota">NRO:</label><input type="text" name="nro_nota_egr_edit" id="nro_nota_egr_edit" class="txt_campo" value="'+nro_nota+'"readonly="readonly"></h2></td> </tr>  ';
				table_cab_det = table_cab_det + '<tr><td colspan="6"><h2><center>NOTA DE TRASPASO</center></center></h2></td></tr>';
				table_cab_det = table_cab_det + '<tr><td ><label for="textfield"><strong>NOMBRE :</strong></label></td>';
				table_cab_det = table_cab_det + '<td ><input type="text" name="alm_nom_egre_edit" id="alm_nom_egre_edit" class="txt_campo" value="'+nom_nota+'">';
				table_cab_det = table_cab_det + '<input type="hidden" name="alm_unico_egre_edit" id="alm_unico_egre_edit" class="txt_campo">';
				table_cab_det = table_cab_det + '<input type="hidden" name="alm_motivo_egre_edit_01" id="alm_motivo_egre_edit_01" class="txt_campo"><div id="div_error_nombre"></td>';
				table_cab_det = table_cab_det + '<td>&nbsp;</td><td></td> ';
				table_cab_det = table_cab_det + '<td><label for="textfield"><strong>FECHA :</strong></label></td>';
				table_cab_det = table_cab_det + '<td><input type="text" name="alm_fec_egre_edit" id="alm_fec_egre_edit" class="txt_campo" value="'+fecha_nota+'"><div id="div_error_fecha"></td></tr>';
				table_cab_det = table_cab_det + '<tr><td><label for="textfield"><strong>ORIGEN :</strong></label></td> ';
				table_cab_det = table_cab_det + '<td><select name="org_trasp_det" size="1" size="10" id="org_trasp_det" style="height:30px">';
				table_cab_det = table_cab_det + '<option value="'+cod_origen+'" >'+origen+'</option>';
				table_cab_det = table_cab_det + '<div id="div_error_motivo"></select></td>';
				table_cab_det = table_cab_det + '<td>&nbsp;</td><td></td>';
				table_cab_det = table_cab_det + '<td><label for="textfield"><strong>DESTINO :</strong></label></td>';
				table_cab_det = table_cab_det + '<td><select name="dest_trasp_det" size="1" size="10" id="dest_trasp_det" style="height:30px">';
				//table_cab_det = table_cab_det + '<option value="'+destino+'" >'+destino+'</option>';
				table_cab_det = table_cab_det + '<div id="div_error_destino"></select></td> </tr></table>';
				//table_cab_det = table_cab_det + '';
				$('#tb_cab_trasp').append(table_cab_det);

				$.ajax({
					url:'?accion=traspaso&tp=agenciaDestino',
					dataType: 'json',
					type: 'GET',
					data : {
						nro_origen:cod_origen
					},
					beforeSend : function(){
					},
					success: function(resul){
						//console.log(resul);
						var dest;
						$.each(resul, function(index,des){
							dest = dest +'<option select value="'+des.cod_destino+'">'+des.nom_destino+'</option>';
						});
						$('#dest_trasp_det').append(dest);
						$("#dest_trasp_det option[value=" +resultado[0].alm_cab_ing_egr_destino+"]").attr("selected","selected") ;
					}
				});
				new Traspaso().mostrarDetalleTrasp(id_nota);
            },
            error: function(resultado){
            }
        });

    }

    /*
     * Metodo para cargar el detalle de traspaso y nuevos items
     */
    this.mostrarDetalleTrasp = function(id_nota){

	   	$('#tb_det_trasp').empty();
	   	var table_det = '<left><h3><img src="../img/traspaso_alm_32x32.png" align="absmiddle"> Registrar Detalle Traspaso</h3></left>';
	   		table_det = table_det + '<tr><td><input type="button" value="Ingresar Items" id="ing_items_det_trasp" class="btn_form"onclick="new Traspaso().IngresarItemsDetalleTrasp(\''+id_nota+'\')"></td></tr>';
	   		table_det = table_det + '<table id="tabla_items_trasp" class="table_usuario">';
	   		table_det = table_det + '<tr><th>NRO</th><th>CODIGO INT.</th><th>DESCRIPCION</th><th>REFERENCIA</th>';
	   		table_det = table_det + '<th>UNIDAD</th><th>CANTIDAD</th> <th>EDITAR</th><th>ELIMINAR</th></tr>';
	   		table_det = table_det + '</table>';
	   	$('#tb_det_trasp').append(table_det);
	   	$('#tpl_alm_form_traspaso_detalle').dialog({ 
			      width: 724,
			      height : 650,
			      modal: true,
			      draggable : false
			    });
   }

   /*
    * Metodo nuevo item detalle traspaso
    */
    this.IngresarItemsDetalleTrasp = function(id_unico){
    	//alert(id_unico);
    	$('#tpl_alm_form_trasp_nuevo_item_det').dialog({ 
			      width: 724,
			      height : 320,
			      modal: true,
			      draggable : false
			    });
    	$("#alm_det_prod_trasp").keyup(function(){
	              new Traspaso().buscarProdTrasp($('#alm_det_prod_trasp').val());
	            });
    }

    /*
     * Metodo  buscar productos para el ingreso de items traspaso
     */

    this.buscarProdTrasp = function(palabra_buscar){
    	//alert(palabra_buscar);
    	$.ajax({
			url:'?accion=traspaso&tp=buscarProducto',
			dataType: 'json',
			type: 'GET',
			data : {
				palabra_buscar:palabra_buscar
			},
			beforeSend : function(){
			},
			success: function(resultado){
		       $("#alm_det_prod_trasp").autocomplete({
		              source: resultado,/* este es el script que realiza la busqueda */
		              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
		              select: new Traspaso().prodTraspSeleccionado /* esta es la rutina que extrae la informacion del producto seleccionado */
		              //focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
		        });
		      },
		      error: function(resultado){
		      }
		});

    }

    /**
    * Metodo que nos muestra el producto seleccionado de la busqueda
    */
    this.prodTraspSeleccionado = function(evt, ui){
      alert("select");
      //console.log("llega");
      var valor = ui.item.value;
      var label = ui.item.label;
      var id = ui.item.id;
      var datos = label.split(" ");
      var codigo = datos[0];
          //console.log(codigo);
        /*$.ajax({
            url:'?accion=traspaso&tp=getDatosProductos',
            dataType: 'json',
            type: 'GET',
            data : { 
              id_unico: id 
            },
            beforeSend : function(){
         
            },
            success: function(resultado){

            },
		    error: function(resultado){
		    }
		});*/

    }


	/*
	 * Metodo para cancelar el detalle de cot priv
	 */
    this.cancelarCabTraspaso = function(){
      $('#tpl_alm_form_nuevo_traspaso').dialog('close');
  }

  	/*
	 * Metodo para cancelar el detalle de cot priv
	 */
    this.closeDialogModificarTraspCab = function(){
      $('#tpl_alm_form_traspaso_detalle').dialog('close');
  }
}