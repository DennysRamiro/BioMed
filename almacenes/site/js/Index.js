/**
* esta es la clase principal de almacenes
* @ Dennys Gutierrez
*/
$(document).ready(function(){
	//alert("Jquery esta funcando..");
	var index = new Index();
	index.init();
	var egreso = new Egreso();
	egreso.init();
	var traspaso = new Traspaso();
	traspaso.init();
	var devolucion = new Devolucion();
	devolucion.init();
	var util = new Utilitarios();
	util.iniPreloaderStart();
});
var limit_par=10;
var num_par =10;
/*
 * esta es la clase Index
 **/
function Index(){
	/*
	* esta es la clase Index
	*
	**/
	this.init = function(){
		$("#tabs").tabs();
		$(".btn_Almacenes").button();
		$(".btn_ventas").button();
		$("#alm_det_desc").keyup(function(){
        		new Index().buscarProducto($('#alm_det_desc').val());
    	});
		$("#alm_det_desc_edit").keyup(function(){
        		new Index().buscarProducto($('#alm_det_desc').val());
        });
		new Index().listarIngresos(0, limit_par, num_par);
		new Index().listarIngresosXConfirmar(0, limit_par, num_par);
		new Index().grabarNuevoIngreso();
		new Index().grabarDetalle();
		new Index().modificarDatosIngresosCab();
		new Index().modificarDatosItemsCab();
	}
	/***
	* Metodo que se encarga de los ingresos por confirmar
	*
	*/
	this.listarIngresosXConfirmar = function(start, limit, num){
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
			url:'alm_gest.php',
			dataType:'json',
			type:'GET',
			data:{
				accion: 'ingreso',
				tp:'listarIngresosXConfirmar',
				start : start,
	            limit : limit
			},
			beforeSend : function(){
			  $('#div_lista_ingresos_por_confirmar').empty();
	          $('#div_lista_ingresos_por_confirmar').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
	      
			},
			success: function(resul){
				//console.log(resul);
				$('#div_lista_ingresos_por_confirmar').empty();
				 //tabla_cabecera_ingresos = '<div id="buscar_not_ing"><span><strong>BUSCAR :</strong></span> <input type="text" name="palabra_ing_buscar" id="palabra_ing_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Index().buscarNotaIngBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_ing" id="id_unico_not_ing">';
	          	var tabla_cabecera_ingresos = '<table id="ingresos_por_confirmar" class="table_usuario">';
	          		tabla_cabecera_ingresos = tabla_cabecera_ingresos+'<tr><th>NRO</th><th>NOTA</th><th>NOMBRE</th><th>DESTINO</th><th>FECHA</th><th>CANTIDAD</th><th>ESTADO</th><th>CANCELAR</th></tr>';
	            $('#div_lista_ingresos_por_confirmar').append(tabla_cabecera_ingresos);
	            if(resul.completo){
	            	var total=resul.total;
		          	var tabla_cabecera_ingresos_datos='';
		          	$.each(resul.datos, function(index, ingresos){
		          	  //console.log(ingresos);
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<tr><td>'+ingresos.num+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.numero_nota+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.detalle_ingreso+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.alm_cab_ing_egr_destino+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.alm_cab_ing_egr_fecha_ingreso+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.cantidad_ingreso+' '+ingresos.unidad+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.estado_ingreso+'</td>';
		              if(ingresos.estado_ingreso == "ORDEN INGRESO"){
		              	tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td align="center"><a href="#" onclick="new Index().confirmarOrdenIngreso(\''+ingresos.alm_det_ing_nro_unico+'\', \''+ingresos.id_unico_producto+'\','+ingresos.cantidad_ingreso+')"><img src="../img/forward_32x32.png" align="absmiddle"><br>Confirmar</a></td>';
		              }else if(ingresos.estado_ingreso == "CONFIRMACION INGRESO"){
		              	tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td align="center">INGRESO REALIZADO</td>';
		              }
		          	 tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos+'</tr>';
		         	});
		            tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos+'</table>';
				    $('#ingresos_por_confirmar').append(tabla_cabecera_ingresos_datos);   //eliminarNotaEntrega   modifcarNotaEntrega
	            }else{
	            	var tabla_cabecera_ingresos_datos='No tienes ningun ingreso';
	            	$('#ingresos_por_confirmar').append(tabla_cabecera_ingresos_datos);
	            }
	      	    $("#palabra_ing_buscar").keyup(function(){
	              new Index().buscarNotaIng($('#palabra_ing_buscar').val());
	            });
	            var paginas = Math.ceil(total/num);
				paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;nssss >>> </div><div id="paginacion_tabla">'
				for (var i=1;i<=paginas;i++) {
					paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
					if(pag == i){
						paginacion_div = paginacion_div+i;
					}else{
						paginacion_div = paginacion_div+'<a href="#" onClick="new Index().listarIngresosXConfirmar('+i+', '+limit+', '+num+')">'+i+'</a>';						
					}
					paginacion_div = paginacion_div+'</div>';
				}
				paginacion_div = paginacion_div+'</div></div>';
				$('#div_lista_ingresos_por_confirmar').append(paginacion_div);
					
			}, errors :function(resul){
				console.log("error");
			}
		});
	}

    /** Esta es la confirmacion del Ingreso confirmarOrdenIngreso() **/
    this.confirmarOrdenIngreso = function(numero_unico, codigo_producto, cantidad_producto){
    	$.getJSON('alm_gest.php', {accion:'ingreso', tp:'confirmarOrdenIngreso', num_unico_det:numero_unico, codigo_prod:codigo_producto, cantidad_prod:cantidad_producto}, function(response){
    		if(response.completo){
    			$(location).attr('href', 'alm_gest.php?accion=index');
    		}
    	});
    }
	/***
	*
	*
	*/
	this.listarIngresos = function(start, limit, num){
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
			url:'alm_gest.php',
			dataType:'json',
			type:'GET',
			data:{
				accion: 'ingreso',
				tp:'listarIngresos',
				start : start,
	            limit : limit
			},
			beforeSend : function(){
			  $('#div_lista_ingreso_almacenes').empty();
	          $('#div_lista_ingreso_almacenes').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
	      
			},
			success: function(resul){
				//console.log(resul);
				$('#div_lista_ingreso_almacenes').empty();
				var tabla_cabecera_ingresos = '<div id="buscar_not_ing"><span><strong>BUSCAR :</strong></span> <input type="text" name="palabra_ing_buscar" id="palabra_ing_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Index().buscarNotaIngBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_ing" id="id_unico_not_ing">';
	          	    tabla_cabecera_ingresos = tabla_cabecera_ingresos+'<table id="tabla_ingreso_almacenes" class="table_usuario">';
	          		tabla_cabecera_ingresos = tabla_cabecera_ingresos+'<tr><th>NRO</th><th>CODIGO</th><th>NOMBRE</th><!--th>MOTIVO</th--><th>ORIGEN</th><th>DESTINO</th><th>FECHA</th><th>ESTADO</th><th>EDITAR</th><th>CANCELAR</th></tr>';
	            $('#div_lista_ingreso_almacenes').append(tabla_cabecera_ingresos);
	            if(resul.completo){
	            	var total=resul.total;
		          	var tabla_cabecera_ingresos_datos='';
		          //console.log(resul[1]);
		          	$.each(resul.datos, function(index, ingresos){
						//console.log(ingresos);
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<tr><td>'+ingresos.num+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.alm_cab_ing_egr_nro_nota+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.alm_cab_ing_egr_nombre+'</td>';
		              //tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.alm_cab_ing_egr_motivo+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.alm_cab_ing_egr_origen+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.alm_cab_ing_egr_destino+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.alm_cab_ing_egr_fecha_ingreso+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+ingresos.estado_ingreso+'</td>';
		              tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td align="center"><a href="#" onclick="new Index().IngresaNuevoItemCabDet(\''+ingresos.alm_cab_ing_nro_unico+'\')"><img src="../img/nota_editar_alm_32x32.png" align="absmiddle"><br> Modificar</a></td>';
		              if(ingresos.alm_cab_ing_egr_motivo_registro == 1){
		              	tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td align="center"><a href="#" onclick="new Index().eliminarNotaEntrega(\''+ingresos.alm_cab_ing_nro_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Cancelar</a></td></tr>';
		              }else if(ingresos.alm_cab_ing_egr_motivo_registro == 2){
		              	tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td align="center">INGRESADO</td></tr>';
		              }
		          	 
		         	});
		            tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos+'</table>';
				    $('#tabla_ingreso_almacenes').append(tabla_cabecera_ingresos_datos);   //eliminarNotaEntrega   modifcarNotaEntrega
	            }else{
	            	var tabla_cabecera_ingresos_datos='No tienes ningun ingreso';
	            	$('#tabla_ingreso_almacenes').append(tabla_cabecera_ingresos_datos);
	            }
	      	    $("#palabra_ing_buscar").keyup(function(){
	              new Index().buscarNotaIng($('#palabra_ing_buscar').val());
	            });
	            var paginas = Math.ceil(total/num);
				paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
				for (var i=1;i<=paginas;i++) {
					paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
					if(pag == i){
						paginacion_div = paginacion_div+i;
					}else{
						paginacion_div = paginacion_div+'<a href="#" onClick="new Index().listarIngresos('+i+', '+limit+', '+num+')">'+i+'</a>';						
					}
					paginacion_div = paginacion_div+'</div>';
				}
				paginacion_div = paginacion_div+'</div></div>';
				$('#div_lista_ingreso_almacenes').append(paginacion_div);
					
			}, errors :function(resul){
				console.log("error");
			}
		});
	}

	/**
	 * Metodo para buscar ingresos con autocomplet
	 */

	this.buscarNotaIng = function(palabra_buscar){ 
    	//alert(palabra_buscar);
    	$.ajax({
		      url:'?accion=ingreso&tp=buscarIngresos',
		      dataType: 'json',
		      type: 'GET',
		      data : { 
		        //action : 'ingreso',
		        //tp :'buscarIngresos',
		        ingresos_buscar: palabra_buscar
		      },
		      beforeSend : function(){
		      },
		      success: function(resultado){
		       $("#palabra_ing_buscar").autocomplete({
		              source: resultado,/* este es el script que realiza la busqueda */
		              minLength: 0, /* le decimos que espere hasta que haya 2 caracteres escritos */
		              select: new Index().notaIngSeleccionado /* esta es la rutina que extrae la informacion del producto seleccionado */
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
   this.notaIngSeleccionado = function(evt, ui){
      //alert("select");
      //console.log("llega");
      var valor = ui.item.value;
      var label = ui.item.label;
      var id = ui.item.id;
      //var datos = label.split(" ");
      //console.dir(datos);
         // console.log(id);
          $.ajax({
            url:'?accion=ingreso&tp=getDatosBusNotIng',
            dataType: 'json',
            type: 'GET',
            data : { 
              id_unico: id 
            },
            beforeSend : function(){
             
             //$('#div_lista_ingreso_almacenes').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
            },
            success: function(resultado){
                id_nota_ing=resultado[0].alm_cab_ing_nro_unico;
                nro_nota_ing=resultado[0].alm_cab_ing_egr_nro_nota;
                nom_nota_ing=resultado[0].alm_cab_ing_egr_nombre;
                fecha_nota_ing=resultado[0].alm_cab_ing_egr_fecha_ingreso;
                origen_ing=resultado[0].origen_ing;
                destino_ing=resultado[0].destino_ing;

                $('#div_lista_ingreso_almacenes').empty();

                var tabla_cabecera_ingresos = '<div id="buscar_not_ing"><span><strong>BUSCAR:</strong></span> <input type="text" name="palabra_ing_buscar" id="palabra_ing_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Index().buscarNotaIngBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_ing" id="id_unico_not_ing">';
          	        tabla_cabecera_ingresos = tabla_cabecera_ingresos+'<table id="tabla_ingreso_almacenes" class="table_usuario">';
          		    tabla_cabecera_ingresos = tabla_cabecera_ingresos+'<tr><th>NRO</th><th>CODIGO</th><th>NOMBRE</th><th>ORIGEN</th><th>DESTINO</th><th>FECHA</th><th>EDITAR</th><th>CANCELAR</th></tr>';
 				//tabla_cabecera_ingresos = tabla_cabecera_ingresos+'</table>';
 		        $('#div_lista_ingreso_almacenes').append(tabla_cabecera_ingresos);
                var tabla_cabecera_ingresos_datos = '<tr><td>1</td>';
	                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+nro_nota_ing+'</td>';
	                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+nom_nota_ing+'</td>';
	                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+origen_ing+'</td>';
	                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+destino_ing+'</td>';
	                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+fecha_nota_ing+'</td>';
	 			    tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td align="center"><a href="#" onclick="new Index().IngresaNuevoItemCabDet(\''+id_nota_ing+'\')"><img src="../img/nota_editar_alm_32x32.png" align="absmiddle"><br> Modificar</a></td>';
	                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td align="center"><a href="#" onclick="new Index().eliminarNotaEntrega(\''+id_nota_ing+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Cancelar</a></td></tr>';
	                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'</table>';
	            $('#tabla_ingreso_almacenes').append(tabla_cabecera_ingresos_datos);  
	            $("#palabra_ing_buscar").keyup(function(){
	              new Index().buscarNotaIng($('#palabra_ing_buscar').val());
	            });
				var paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div>1<div id="paginacion_tabla">';
				$('#div_lista_ingreso_almacenes').append(paginacion_div);
	        },
            error: function(resultado){
            }
          });
   }
   /*
    * Metodo de busqueda desde el boton
    */
    this.buscarNotaIngBoton = function(start, limit, num){
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
    	var palabra_buscar=$("#palabra_ing_buscar").val();
        $.ajax({
	        url:'?accion=ingreso&tp=buscarNotasIng',
	        dataType: 'json',
	        type: 'GET',
	        data : { 
	          ingresos_buscar: palabra_buscar,
	          start : start,
	          limit : limit
	        },
	        beforeSend : function(){
	        },
            success: function(resultado){
            	$('#div_lista_ingreso_almacenes').empty();

                var tabla_cabecera_ingresos = '<div id="buscar_not_ing"><span><strong>BUSCAR :</strong></span> <input type="text" name="palabra_ing_buscar" id="palabra_ing_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Index().buscarNotaIngBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_ing" id="id_unico_not_ing">';
          	        tabla_cabecera_ingresos = tabla_cabecera_ingresos+'<table id="tabla_ingreso_almacenes" class="table_usuario">';
          		    tabla_cabecera_ingresos = tabla_cabecera_ingresos+'<tr><th>NRO</th><th>CODIGO</th><th>NOMBRE</th><th>ORIGEN</th><th>DESTINO</th><th>FECHA</th><th>EDITAR</th><th>CANCELAR</th></tr>';
          		    $('#div_lista_ingreso_almacenes').append(tabla_cabecera_ingresos);
          		var tabla_cabecera_ingresos_datos='';
          		var num=0;
          		var total = resultado[0].total;
          		var buscar = resultado[0].ingresos_buscar;
          		$.each(resultado, function(index, value){
          			num++;
	          		    tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<tr><td>'+num+'</td>';
		                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+value.alm_cab_ing_egr_nro_nota+'</td>';
		                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+value.alm_cab_ing_egr_nombre+'</td>';
		                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+value.origen+'</td>';
		                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+value.destino+'</td>';
		                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td>'+value.alm_cab_ing_egr_fecha_ingreso+'</td>';
		 			    tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td align="center"><a href="#" onclick="new Index().IngresaNuevoItemCabDet(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/nota_editar_alm_32x32.png" align="absmiddle"><br> Modificar</a></td>';
		                tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'<td align="center"><a href="#" onclick="new Index().eliminarNotaEntrega(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Cancelar</a></td></tr>';
		            
	            });    
	                    tabla_cabecera_ingresos_datos = tabla_cabecera_ingresos_datos +'</table>';
	                    $('#tabla_ingreso_almacenes').append(tabla_cabecera_ingresos_datos); 
	                    $("#palabra_ing_buscar").keyup(function(){
	             			new Index().buscarNotaIng($('#palabra_ing_buscar').val());
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
				                  paginacion_div = paginacion_div+'<a href="#" onClick="new Index().buscarNotaIngBoton('+i+', '+limit+', '+numero+')">'+i+'</a>';          
				                }
		                		paginacion_div = paginacion_div+'</div>';
		                    }
		                paginacion_div = paginacion_div+'</div></div>';
		                $('#div_lista_ingreso_almacenes').append(paginacion_div);
		                $("#palabra_ing_buscar").val(buscar); 


            },
            error: function(resultado){
            }
        });

    }
   /**
	 * Este metodo que crea un nuevo ingreso 
	 */
	this.nuevoIngresoAlmacenes = function (){
		var util = new Utilitarios();
		$('#form_alm_nuevo_ingreso')[0].reset();
		util.validarCampo('alm_nom_ing', 'div_error_nombre', 'Nombre no puede estar vacio');

		$("#alm_motivo_ing").val('1');
		$("#alm_fec_ing").datepicker({
				dateFormat: "dd/mm/yy"
		});
		$('#tpl_alm_form_nuevo_ingreso').dialog({
			width: 750,
			height : 300,
			modal: true,
			draggable : false
		});
	}
	/**
   * Metodo que permite crear un nuevo ingreso
   */
	this.grabarNuevoIngreso = function(){   //************************************************
		//console.log("lol");
		var util = new Utilitarios();
		$('#form_alm_nuevo_ingreso').submit(function(evt){
			if($.trim($('#alm_fec_ing').val())  == ""){
				util.mostrarMensajeAlerta(0,'La Fecha no puede estar vacio.', 'Advertencia');
			}else{
				util.startPreloader();
				datos = $(this).serialize();
				$.ajax({
					url:'?accion=ingreso&tp=grabarIngreso',
			        data:datos,
			        dataType:'GET',
			        dataType:'json',
			        success:function(res){
			           if (res.completo== true) {
				            
				            $('#tpl_alm_form_nuevo_ingreso').dialog("close");
				            new Index().IngresaNuevoItemCabDet(res.cod_unico);
				          
			            }/**/
	         
	        		}
				});
			}
			
		    evt.preventDefault();
		});
	}


	 /**
	 * Este metodo que crea la modificacion de nota de entrega
	 */
	this.IngresaNuevoItemCabDet = function (codigo_unico){

		var util = new Utilitarios();
		$.getJSON('?accion=ingreso&tp=getDatosIngresoCab', {unico:codigo_unico}, function(res){
			$('#tpl_alm_form_modificar_ingreso_detalle h3').empty();
	 		$('#tpl_alm_form_modificar_ingreso_detalle h3').append('<img src="../img/alm_ing_32x32.png" align="absmiddle"> NUEVO INGRESO');
	 		//$('#tpl_alm_form_modificar_ingreso_detalle h3').append(res.alm_cab_ing_egr_nro_nota);
	 		$('#nro_nota_edit').val(res.alm_cab_ing_egr_nro_nota);
	 		$('#alm_nom_ing_edit').val(res.alm_cab_ing_egr_nombre);
	 		$('#alm_fec_ing_edit').val(res.alm_cab_ing_egr_fecha_ingreso);
	 		$('#ing_origen_edit').val(res.alm_cab_ing_egr_motivo);
	 		$('#ing_destino_edit').val(res.alm_cab_ing_egr_destino);
	 		$('#alm_unico_ing_edit').val(codigo_unico);
	 		$('#alm_motivo_ing_edit_01').val(res.alm_cab_ing_egr_motivo);

	 		$("#alm_fec_ing_edit").datepicker({
				dateFormat: "dd/mm/yy"
		     });

		});
		$.getJSON('?accion=ingreso&tp=getDatosIngresoDet',{unico:codigo_unico},function(res){
			console.log(res);
			var re = false;
			$.each(res, function(index, ingreso){
				if(ingreso.alm_ing_egr_det_estado == 2){
					re = true;
				}
			});
			if(!re){
				$('#tb_item_det').empty();
				var inf_btn_item = '<tr><td><input type="button" value="NUEVO ITEM" id="ing_items_det_acciones" class="btn_form"onclick="new Index().IngresoDetalle(\''+codigo_unico+'\')"></td></tr>';
				$('#tb_item_det').append(inf_btn_item);
			}
			$('#tb_mod_det').empty();
			var ing_nota = ing_nota + '<tr>';
				ing_nota = ing_nota +'<th>NRO</th><th>CODIGO INT.</th><th>DESCRIPCION</th><th>REFERENCIA</th>';
				ing_nota = ing_nota +'<th>UNIDAD</th><th>CANTIDAD</th> <th>EDITAR</th><th>CANCELAR</th></tr>';
			$('#tb_mod_det').append(ing_nota);
			if (res.det!=0) {
					$.each(res, function(index, ingresos){
						    var mod_det_datos = '<tr>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.fila+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_cod_int+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_descripcion+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_referencia+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_unidad+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_cantidad+'</td>';
						    if(ingresos.alm_ing_egr_det_estado == 1){
						    	mod_det_datos = mod_det_datos +'<td><a href="#" onclick="new Index().modificarIngresoDet(\''+codigo_unico+'\',\''+ingresos.alm_ing_egr_det_nro_unico+'\')"><img src="../img/edit user_32x32.png" align="absmiddle"><br> Modificar</a></td>';
						    	mod_det_datos = mod_det_datos +'<td><a href="#" onclick="new Index().eliminarIngresoDet(\''+ingresos.alm_ing_egr_det_nro_unico+'\',\''+codigo_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br> Cancelar</a></td>';	
						    }else if(ingresos.alm_ing_egr_det_estado == 2){
						    	mod_det_datos = mod_det_datos +'<td>CONFIRMADO</td>';
						        mod_det_datos = mod_det_datos +'<td>CONFIRMADO</td>';
						    }
						    
						     mod_det_datos = mod_det_datos +'</tr>';
						    $('#tb_mod_det').append(mod_det_datos);
					});
			}
		});

		
		$('#tpl_alm_form_modificar_ingreso_detalle').dialog({
			width: 850,
			height : 650,
			modal: true,
			draggable : false
		});
		util.stopPreloader();
	}
	/** Este es el metodo que lista los detalles del ingreso **/
	this.listarDetalleListaIngreso = function(codigo_unico){
		var util = new Utilitarios();
		$.getJSON('?accion=ingreso&tp=getDatosIngresoDet',{unico:codigo_unico},function(res){
			$('#tb_mod_det').empty();
			var ing_nota = ing_nota + '<tr>';
				ing_nota = ing_nota +'<th>NRO</th><th>CODIGO INT.</th><th>DESCRIPCION</th><th>REFERENCIA</th>';
				ing_nota = ing_nota +'<th>UNIDAD</th><th>CANTIDAD</th> <th>EDITAR</th><th>CANCELAR</th></tr>';
			$('#tb_mod_det').append(ing_nota);
			if (res.det!=0) {

					$.each(res, function(index, ingresos){
						    var mod_det_datos = '<tr>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.fila+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_cod_int+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_descripcion+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_referencia+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_unidad+'</td>';
						    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_cantidad+'</td>';
						    if(ingresos.alm_ing_egr_det_estado == 1){
						    	mod_det_datos = mod_det_datos +'<td><a href="#" onclick="new Index().modificarIngresoDet(\''+codigo_unico+'\',\''+ingresos.alm_ing_egr_det_nro_unico+'\')"><img src="../img/edit user_32x32.png" align="absmiddle"><br> Modificar</a></td>';
						    	mod_det_datos = mod_det_datos +'<td><a href="#" onclick="new Index().eliminarIngresoDet(\''+ingresos.alm_ing_egr_det_nro_unico+'\',\''+codigo_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br> Cancelar</a></td>';	
						    }else if(ingresos.alm_ing_egr_det_estado == 2){
						    	mod_det_datos = mod_det_datos +'<td>CONFIRMADO</td>';
						        mod_det_datos = mod_det_datos +'<td>CONFIRMADO</td>';
						    }
						    mod_det_datos = mod_det_datos +'</tr>';
						    $('#tb_mod_det').append(mod_det_datos);
					});
				//new Index().listarIngresosXConfirmar(0, limit,num);
				//$(location).attr('href', 'alm_gest.php?accion=index');
					
			}else{
				util.mostrarMensajeAlerta(0,'No puede ser procesado sin items agregados.', 'Advertencia');
			}
		});
		$('#tpl_alm_form_nuevo_ingreso_det').dialog('close');
		util.stopPreloader();
	} 

	 /**
	 * Este metodo que crea un nuevo Item de ingreso del detalle
	 */
	this.IngresoDetalle = function (codigo_unico){
		$('#form_alm_nuevo_ingreso_det')[0].reset();
		$('#alm_det_cod_int').val('');
		$('#alm_det_desc').val('');
		$('#alm_det_ref').val('');
		$('#alm_det_cantidad').val('1.00');
		$('#codigo_cab_unico_ing_egr').val($('#alm_unico_ing_edit').val());
		var util = new Utilitarios();
		$('#alm_det_cantidad').numeric('.');
		$('#alm_det_ref').numeric();
		$('#alm_det_piezas').val('');
		util.validarCampo('alm_det_cod_int', 'div_error_cod_int', 'Codigo no puede estar vacio');
		util.validarCampo('alm_det_desc', 'div_error_descp', 'descripcion no puede estar vacio');
		util.validarCampo('alm_det_ref', 'div_error_ref', 'Referencia esta vacio');
		util.validarCampo('alm_det_unidad', 'div_error_unidad', 'Unidad no puede estar vacio');
		util.validarCampo('alm_det_cantidad', 'div_error_cantidad', 'Cantidad no puede estar vacio')
		$('#alm_det_unico_cab').val(codigo_unico);
		//$('#tpl_alm_form_nuevo_ingreso_det').dialog({
		$('#tpl_alm_form_nuevo_ingreso_det').dialog({
			width: 670,
			height : 350,
			modal: true,
			draggable : false
		});
	}

	


	/**
   *  Este metodo lista todos los clientes buscados
   */
   this.buscarProducto = function(palabra_buscar){    
   //alert(palabra_buscar);
    $.ajax({
      url:'alm_gest.php',
      dataType: 'json',
      type: 'GET',
      data : { 
        accion : 'ingreso',
        tp :'buscarProductos',
        producto_buscar: palabra_buscar
      },
      beforeSend : function(){
      },
      success: function(resultado){
      	//console.log(resultado);
        $("#alm_det_desc").autocomplete({
              source: resultado,/* este es el script que realiza la busqueda */
              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
              select: new Index().productoSeleccionado /* esta es la rutina que extrae la informacion del producto seleccionado */
              //focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
          });
      },
      error: function(resultado){
      }
    });

   }

    /**
   * Metodo que nos muestra los productos seleccionados 
   */
   this.productoSeleccionado = function(evt, ui){
	    var valor = ui.item.value;
	    var label = ui.item.label;
	    var id = ui.item.id;
	    var datos = label.split(" ");
	    $("#alm_det_desc").val(datos[0]);
	    //$("#resto_ref").val(datos[0]+' '+datos[1]+' '+datos[2]);
	    $("#alm_det_cod_int").val(datos[0]);
	    $("#cod_unico_producto").val(id);
	    //new Index().buscaCantidad();
	    /**new Index().buscaPartNumber();
	    new Index().buscaUnidad();**/
	    $.getJSON('alm_gest.php', {accion:'ingreso', tp:'optenerDatosCompletoProducto', id_producto:id}, function(response){
	    	console.log(response);
	    	$('#div_cab_producto_ingreso_almacen').empty();
	    	var cabecera = '<table class="table_usuario">'+
	    				    	'<tr><th>CODIGO:</th><td>'+response.codigo_prod+'<input type="hidden" id="id_unico_cab_prod" name="id_unico_cab_prod" value="'+response.id_unico+'"></td><th>NOMBRE:</th><td>'+response.nombre_prod+'</td></tr>'+
	    				    	'<tr><th>DESCRIPCION:</th><td>'+response.descripcion_prod+'</td><th>FECHA:</th><td>'+response.fecha_prod+'</td></tr>'+
	    				    	'<tr><th>PROVEEDOR:</th><td>'+response.proveedor_prod+'</td><th>SUCURSAL:</th><td>'+response.sucursal_prod+'</td></tr>'+
	    	               '</table>';
	    	$('#div_cab_producto_ingreso_almacen').append(cabecera);
	    	$('#div_det_producto_ingreso_almacen').empty();
	    	var detalle = '<table class="table_usuario">'+
	    	                '<tr><th>SERIE</th><th>NUM. PARTE</th><th>FECHA</th><th>CANTIDAD</th><th>PRECIO COMPRA</th><th>PRECIO VENTA</th><th>P. VENTA MAX</th><th>P. VENTA MIN</th><th>SELECCIONAR</th></tr>';
	    	$.each(response.items, function(index, producto){
	    			detalle = detalle+'<tr><td><input type="hidden" id="id_unico_det_prod" value="'+producto.id_unico_det+'">'+producto.serie_det+'</td>'+
	    			                       '<td>'+producto.prec_part_num_det+'</td>'+
	    			                       '<td>'+producto.prec_fecha_venc_det+'</td>'+
	    			                       '<td>'+producto.cantidad_det+'</td>'+
	    			                       '<td>'+producto.prec_compra_det+'</td>'+
	    			                       '<td>'+producto.prec_venta_det+'</td>'+
	    			                       '<td>'+producto.prec_venta_max_det+'</td>'+
	    			                       '<td>'+producto.prec_venta_min_det+'</td>'+
	    			                       '<td><a href="#" onclick="new Index().seleccionarProducto(\''+producto.id_unico_det+'\')"><img src="../img/add_prod_32x32.png"></a></td>'+
	    			                  '</tr>';
	    	});
	    	detalle = detalle+'</table>';
	    	$('#div_det_producto_ingreso_almacen').append(detalle);
	    });
		$('#tp_seleccion_producto_detalle_ingreso_almacen').dialog({
			width: 750,
			height : 500,
			modal: true,
			draggable : true
		});
	    

   }
   /** Metodo encargado de seleccionar el producto para agregarlo a la orden de ingreso**/
   this.seleccionarProducto = function(id_det_unico_prod){
   		$.getJSON('alm_gest.php', {accion:'ingreso', tp:'optenerProductoSeleccionado', id_producto:id_det_unico_prod}, function(response){
   			$('#alm_det_desc').val(response.descripcion);
   			$('#alm_det_cod_int').val(response.codigo_int);
   			$('#alm_det_unico_cab').val(response.cod_unico_producto);
   			$('#cod_unico_producto').val(id_det_unico_prod);
   			$('#alm_det_ref').val(response.referencia);
   			$('#alm_det_piezas').val(response.unidad);
   			$('#alm_det_piezas_cod').val(response.id_unidad);
   			$('#tp_seleccion_producto_detalle_ingreso_almacen').dialog('close');
   		});
   		
   } 
   /***
   ** Metodo que busca la cantidad total del priducto
   *
   */
   this.buscaCantidad = function(){
   		//alert("cantidad");
   		//var cant = $('#cod_unico_producto').val();
   		//alert(cant);
   		var util = new Utilitarios();
   		$.ajax({
		      url:'alm_gest.php',
		      dataType: 'json',
		      type: 'GET',
		      data : { 
		        accion : 'ingreso',
		        tp :'buscarCantidad',
		        cantidad_buscar: $('#cod_unico_producto').val()
		      },
		      beforeSend : function(){
		      },
		      success: function(resultado){
		      	//console.log(resultado);
				
				$('#alm_det_cantidad').val(resultado.cantidad);

		      /*	var cantidad_ingresada = $('#alm_det_cantidad').val();
		      	if (cantidad_ingresada<=resultado.cantidad) {
		      		//alert("menor o igual");
		      	}else{
		      		//alert("lacantidad es mayor");

		      		util.validarCampo('alm_det_cantidad', 'div_error_cantidad', 'La Cantidad es mayor a la ingresada');


					 $("#dialog-confirm-cantidad").attr("title", "Cantidad es Mayor a la Existente");
					  $("#dialog-confirm-cantidad").empty();
					  contexto_dialog = '<img src="../img/alert_48x48.png" align="absmiddle">';
					  contexto_dialog = contexto_dialog+"LA CANTIDAD ES MAYOR A LA EXISTENTE?";
					  $("#dialog-confirm-cantidad").append(contexto_dialog);
					  $("#dialog-confirm-cantidad").dialog({
							   resizable: false,
							   height:200,
							   width:400,
							   modal: true,
							   buttons: {
							    //"Aceptar": function() {
							     //new Cliente().confirmarEliminarCliente(id_cliente);
							    //},
							    "Cancelar": function() {
							    	$('#alm_det_cantidad').val('');
							     	$( this ).dialog( "close" );
							    }
							   }
					  	});
		      	}*/
		        
		      },
		      error: function(resultado){
		      }
		   });

   }

   /***
   ** Metodo que busca la cantidad total del priducto
   *
   */
   this.buscaPartNumber = function(){
   		//alert("cantidad");
   		//var cant = $('#cod_unico_producto').val();
   		//alert(cant);
   		var util = new Utilitarios();
   		$.ajax({
		      url:'alm_gest.php',
		      dataType: 'json',
		      type: 'GET',
		      data : { 
		        accion : 'ingreso',
		        tp :'buscarPartNumber',
		        part_number: $('#cod_unico_producto').val()
		      },
		      beforeSend : function(){
		      },
		      success: function(resultado){
		      	console.log(resultado);
				$('#alm_det_ref').val(resultado.partNumber);
		      },
		      error: function(resultado){
		      }
		   });

   }

    /***
   ** Metodo que busca la cantidad total del priducto
   *
   */
   this.buscaUnidad = function(){
   		//alert("cantidad");
   		//var cant = $('#cod_unico_producto').val();
   		//alert(cant);
   		var util = new Utilitarios();
   		$.ajax({
		      url:'alm_gest.php',
		      dataType: 'json',
		      type: 'GET',
		      data : { 
		        accion : 'ingreso',
		        tp :'buscarUnidad',
		        unidad: $('#cod_unico_producto').val()
		      },
		      beforeSend : function(){
		      },
		      success: function(resultado){
		      	console.log(resultado);
				$('#alm_det_piezas').val(resultado.unidad);
				$('#alm_det_piezas_cod').val(resultado.cod_unidad);
		      },
		      error: function(resultado){
		      }
		   });

   }




	/**
   * Metodo que permite crear el detalle de ingresos
   */
	this.grabarDetalle = function(){
		var util = new Utilitarios();
		//alert("alert datos");
		$('#form_alm_nuevo_ingreso_det').submit(function(evt){
			if($.trim($('#alm_det_desc').val()) == ""){
				util.mostrarMensajeAlerta(0,'El Nombre del producto no puede estar vacio.', 'Advertencia');
			}else if($.trim($('#alm_det_cantidad').val()) == ""){
				util.mostrarMensajeAlerta(0,'La Cantidad no puede estar vacio.', 'Advertencia');
			}else if($.trim($('#alm_det_cod_int').val()) == ""){
				util.mostrarMensajeAlerta(0,'La Codigo no puede estar vacio.', 'Advertencia');
			}else if($.trim($('#alm_det_ref').val()) == ""){
				util.mostrarMensajeAlerta(0,'La referenci no puede estar vacio.', 'Advertencia');
			}else if($.trim($('#alm_det_piezas').val()) == ""){
				util.mostrarMensajeAlerta(0,'La Pieza no puede estar vacio.', 'Advertencia');
			}else if($.trim($('#alm_det_cantidad').val()) == "0.00"){
				util.mostrarMensajeAlerta(0,'La cantidad no es suficiente en Invetario para efectuarse el ingreso tiene que ser mayor a 0.00', 'Advertencia');
			}else{
				util.startPreloader();
				datos = $(this).serialize();
				$.ajax({
					url:'?accion=ingreso&tp=grabarDetalle',
			        data:datos,
			        dataType:'GET',
			        dataType:'json',
			        success:function(res){
			           if (res.completo) {
			           //	console.log(res);
			           	 new Index().listarDetalleListaIngreso($('#codigo_cab_unico_ing_egr').val());
				       }
	        		}
				});	
			}
			
			evt.preventDefault();
		});
	}


	 /**
	 * Este metodo que crea la modificacion de nota de entrega
	 */
	this.cancelarIngresoCab = function (){
		//$(location).attr('href', 'alm_gest.php?accion=index');
		$('#tpl_alm_form_nuevo_ingreso').dialog('close');

	}

	 /**
	 * Este metodo que crea la modificacion de nota de entrega
	 */
	/*this.modifcarNotaEntrega = function (codigo_unico){
				//var util = new Utilitarios();
		$.getJSON('?accion=ingreso&tp=getDatosIngresoCab', {unico:codigo_unico}, function(res){

			//console.log(res);
				//alert("json");
			$('#tpl_alm_form_modificar_ingreso_detalle h3').empty();
	 		$('#tpl_alm_form_modificar_ingreso_detalle h3').append('<img src="../img/alm_ing_32x32.png" align="absmiddle"> Editar Datos Ingreso');
	 		$('#tpl_alm_form_modificar_ingreso_detalle h3').append(res.alm_cab_ing_egr_nro_nota);
	 		$('#nro_nota_edit').val(res.alm_cab_ing_egr_nro_nota);
	 		$('#alm_nom_ing_edit').val(res.alm_cab_ing_egr_nombre);
	 		$('#alm_fec_ing_edit').val(res.alm_cab_ing_egr_fecha_ingreso);
	 		$('#ing_motivo_edit').val(res.alm_cab_ing_egr_motivo);
	 		$('#ing_destino_edit').val(res.alm_cab_ing_egr_destino);
	 		$('#alm_unico_ing_edit').val(codigo_unico);

		});
		$.getJSON('?accion=ingreso&tp=getDatosIngresoDet',{unico:codigo_unico},function(res){
			
			$('#tb_mod_det').empty();
			var mod_det = '<tr>';
				mod_det = mod_det +'<th>CODIGO INT.</th><th>DESCRIPCION</th><th>REFERENCIA</th>';
				mod_det = mod_det +'<th>UNIDAD</th><th>CANTIDAD</th> <th>EDITAR</th><th>ELIMINAR</th></tr>';
			$('#tb_mod_det').append(mod_det);

			$.each(res, function(index, ingresos){
				//console.log(ingresos);
				    var mod_det_datos = '<tr>';
				    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_cod_int+'</td>';
				    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_descripcion+'</td>';
				    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_referencia+'</td>';
				    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_unidad+'</td>';
				    mod_det_datos = mod_det_datos +'<td>'+ingresos.alm_ing_egr_det_cantidad+'</td>';
				    mod_det_datos = mod_det_datos +'<td><a href="#" onclick="new Index().modifcarDatosingresoDetalle(\''+ingresos.alm_ing_egr_det_nro_unico+'\')"><img src="../img/edit user_32x32.png" align="absmiddle"><br> Modificar</a></td>';
				    mod_det_datos = mod_det_datos +'<td><a href="#" onclick="new Index().eliminarNotaEntrega(\''+ingresos.alm_ing_egr_det_nro_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br> Eliminar</a></td>';
				     mod_det_datos = mod_det_datos +'</tr>';
				    $('#tb_mod_det').append(mod_det_datos);
			});
		});

		
		$('#tpl_alm_form_modificar_ingreso_detalle').dialog({
			width: 850,
			height : 550,
			modal: true,
			draggable : false
		});
	}*/


	/**
	 * Metodo que modifica los ingresos  //listarIngresosXConfirmar
	 */
	 this.modificarDatosIngresosCab = function(){
	 	var util = new Utilitarios();
	 	$('#form_alm_mdificar_ingreso_cab').submit(function(evt){
			if ($.trim($('#alm_fec_ing_edit').val())=="") {
	 			util.mostrarMensajeAlerta(0,'La fecha no puede estar vacio','Advertencia');
	 		}else{
	 			util.startPreloader();
	 			datos = $(this).serialize();
	 			$.ajax({
	 				url:'?accion=ingreso&tp=saveEditIngresoCab',
					data:datos,
					type:'GET',
					dataType:'json',
					success:function(res){
						//console.dir(res);
						if(res.completo){
							$('#tpl_alm_form_modificar_ingreso_detalle').dialog('close');
							//new Index().listarIngresosXConfirmar(0, 10, 10);
							util.stopPreloader();
							$(location).attr('href', 'alm_gest.php?accion=index');

						}
					}
	 			});
	 		}
	 		evt.preventDefault();
	 	});
	 }
	
	/**
	 * Metodo que cierra el dialogo de la modificacion de los ingresos
	 */
	this.closeDialogModificarIngreso = function(){
		$('#tpl_alm_form_modificar_ingreso_detalle').dialog('close');
	}

	/**
	* Metdo qu elimina los ingresos
	*/
	this.eliminarNotaEntrega = function(codigo_unico){

		///alert(codigo_unico);
	
		$("#dialog-confirm-ingreso").attr("title", "Eliminar Items de la Nota de Salida");
	    //$("#dialog-confirm-cot #contexto_dialog_cot").empty();
	    $("#dialog-confirm-ingreso").empty();
	    contexto_dialog_ingreso = '<img src="../img/alert_48x48.png" align="absmiddle">';
	    contexto_dialog_ingreso = contexto_dialog_ingreso+"Estas seguro que quieres eliminar el Items de la nota de Salida?";
	    $("#dialog-confirm-ingreso").append(contexto_dialog_ingreso);
	    $("#dialog-confirm-ingreso").dialog({
			      resizable: false,
			      height:200,
			      width:400,
			      modal: true,
			      buttons: {
			        "Aceptar": function() {
			            $("#dialog-confirm-ingreso").dialog("close");
			            $.ajax({
				              url:'alm_gest.php',
				              dataType: 'json',
				              type: 'GET',
				              data : { 
				                accion : 'ingreso',
				                tp : 'deleteIngreso',
				                codigo :codigo_unico 
				              },
				              beforeSend : function(){

				              },                      
				              success: function(res){
				              //  console.log(res);
				                  if (res.complet==true) {
				                    //alert("Grabo bien");
				                    //new Home().listarCotizacionesPriv(0,limit_par, num_par);
				                    //new ingreso().IngresaNuevoItemCabDetingreso(codigo_unico_cab);
				                    $(location).attr('href', 'alm_gest.php?accion=index');
				                    //new Index().listarIngresos(0,limit_par, num_par);
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



	//new Index().confirmarEliminarIngreso(codigo_unico);
			
	}

/**
	 * Metodo que elimina el cliente
	 */
	this.confirmarEliminarIngreso = function (codigo_unico){
		$.get('?accion=ingreso&tp=deleteIngreso', { codigo :codigo_unico }, function(resp) {
       		$("#dialog-confirm").dialog("close");
       		new Index().listarIngresos(0,limit_par, num_par);
    	});
	}
	


/**
*	Metodo que modifica los items del ingreso
*/
	this.modificarIngresoDet = function(cod_cab,cod_unico_det){

		//alert("llega");
		//alert(cod_unico_det);
		$.getJSON('?accion=ingreso&tp=getDatosDet', {unico:cod_unico_det}, function(resp){

/*			console.log(resp.alm_ing_egr_det_cod_int);
			console.log(resp.alm_ing_egr_det_descripcion);
			console.log(resp.alm_ing_egr_det_referencia);
			console.log(resp.alm_ing_egr_det_cantidad);
*/				//alert("json");
			$('#tpl_alm_form_modificar_ingreso_det h3').empty();
	 		$('#tpl_alm_form_modificar_ingreso_det h3').append('<img src="../img/alm_ing_32x32.png" align="absmiddle">EDITAR ITEM');
	 		//$('#tpl_alm_form_modificar_ingreso_det h3').append(res.alm_cab_ing_egr_nro_nota);
	 		
	 		$('#alm_det_cod_int_edit').val(resp.alm_ing_egr_det_cod_int);
	 		$('#alm_det_desc_edit').val(resp.alm_ing_egr_det_descripcion);
	 		$('#alm_det_ref_edit').val(resp.alm_ing_egr_det_referencia);
	 		$('#alm_det_cantidad_edit').val(resp.alm_ing_egr_det_cantidad);
	 		$('#alm_det_unico_cab_edit').val(cod_unico_det);
	 		$('#alm_cab_unico_edit').val(cod_cab);
	 		
		});

		$('#tpl_alm_form_modificar_ingreso_det').dialog({
			width: 650,
			height : 350,
			modal: true,
			draggable : false
		});
	}

	/**
	 * Metodo que cierra el dialogo de la modificacion de los items
	 */
	this.cancelaItemsDetalle = function(){
		$('#tpl_alm_form_nuevo_ingreso_det').dialog('close');
	}

/**
	 * Metodo que cierra el dialogo de la modificacion de los items
	 */
	this.cancelaItemsModDetalle = function(){
		$('#tpl_alm_form_modificar_ingreso_det').dialog('close');
	}


	/**
	 * Metodo que modifica los Items de la cabecera
	 */
	 this.modificarDatosItemsCab = function(){

	 	//alert("modificar");

	 	$('#form_alm_modificar_ingreso_det').submit(function(evt){
	 		if ($.trim($('#alm_det_cod_int_edit').val())=="") {
	 			util.mostrarMensajeAlerta(0,'El Codigo interno no puede estar vacio','Advertencia');
	 		}else if ($.trim($('#alm_det_ref_edit').val())=="") {
	 			util.mostrarMensajeAlerta(0,'La Referencia no puede estar vacio','Advertencia');
	 		}else{
	 			datos = $(this).serialize();
	 			console.log(datos);
	 			$.ajax({
	 				url:'?accion=ingreso&tp=saveEditItemDet',
					data:datos,
					type:'GET',
					dataType:'json',
					success:function(res){
						//console.log(res.unico);
						if(res.completo){
							//alert("completado");
							$('#tpl_alm_form_modificar_ingreso_det').dialog('close');
							new Index().IngresaNuevoItemCabDet(res.unico);
							

						}	
					}
	 			});
	 		}
	 		evt.preventDefault();
	 	});
	 }


	/**
	 *	Metodo que eliminar los items del ingreso
	 */
	this.eliminarIngresoDet = function(codigo_unico_det,codigo_unico_cab){
		$("#dialog-confirm-ingreso-detalle").attr("title", "Eliminar Item de Nota de Salida");
	    $("#dialog-confirm-ingreso-detalle").empty();
	    contexto_dialog_ingreso_detalle = '<img src="../img/alert_48x48.png" align="absmiddle">';
	    contexto_dialog_ingreso_detalle = contexto_dialog_ingreso_detalle +"Estas seguro que quieres eliminar el Item?";
	    $("#dialog-confirm-ingreso-detalle").append(contexto_dialog_ingreso_detalle);
	    var util = new Utilitarios();
	    $("#dialog-confirm-ingreso-detalle").dialog({
	          resizable: false,
		      height:200,
		      width:400,
		      modal: true,
		      buttons: {
		        "Aceptar": function() {
		            $("#dialog-confirm-ingreso-detalle").dialog("close");
		            util.startPreloader();
		            $.ajax({
		              url:'alm_gest.php',
		              dataType: 'json',
		              type: 'GET',
		              data : { 
		                accion : 'ingreso',
		                tp : 'deleteIngresoDet',
		                codigo :codigo_unico_det
		              },
		              beforeSend : function(){
		              },                      
		              success: function(res){
		                  if (res.complet==true) {
		                    new Index().IngresaNuevoItemCabDet(codigo_unico_cab);
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
	 * Este metodo que crea un nuevo Item de ingreso del detalle
	 */
	this.procesarNotaEntrega = function (codigo_unico){

		console.log(codigo_unico);

	}


}