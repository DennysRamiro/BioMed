/**
* esta es la clase principal de almacenes
* @ Ruth Palomino
*/

var limit_par=10;
var num_par =10;
function Devolucion(){

	//alert("traspaso js");
	/*
	* Metodo principal de la clase Traspasos
	*
	**/
	this.init = function(){
		new Devolucion().listarDevoluciones(0, limit_par, num_par);
		//new Egreso().grabarNuevoEgreso();
	}

	/**
     * Metodo Listar Devoluciones
     */
    this.listarDevoluciones = function (start, limit, num) {
    	//alert(start+'-'+limit+'-'+num);
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
				accion: 'devolucion',
				tp:'listarDevoluciones',
				start : start,
	            limit : limit
			},
			beforeSend : function(){
				$('#div_lista_devoluciones_almacenes').empty();
                $('#div_lista_devoluciones_almacenes').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(res){
				$('#div_lista_devoluciones_almacenes').empty();
				var tabla_devoluciones = '<div id="buscar_not_dev"><span><strong>Buscar :</strong></span> <input type="text" name="palabra_dev_buscar" id="palabra_dev_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Devolucion().buscarNotaDevBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_dev" id="id_unico_not_dev">';
          	        tabla_devoluciones = tabla_devoluciones+'<table id="tabla_devolucion_almacenes" class="table_usuario">';
          	        tabla_devoluciones = tabla_devoluciones+'<tr><th>NRO</th><th>CODIGO</th><th>NOMBRE</th><th>ORIGEN</th><th>DESTINO</th><th>FECHA</th><th>EDITAR</th><th>ELIMINAR</th></tr>';
          	    var num=0;
          	    var total=res[0].total;
          	    $.each(res, function(index, value){ 
          	    	num++;
          	        tabla_devoluciones = tabla_devoluciones+'<tr><td>'+num+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.alm_cab_ing_egr_nro_nota+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.alm_cab_ing_egr_nombre+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.origen+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.destino+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.alm_cab_ing_egr_fecha_ingreso+'</td>';
          	        tabla_devoluciones = tabla_devoluciones +'<td align="center"><a href="#" onclick="new Devolucion().IngresaNuevoItemCabDet(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/nota_editar_alm_32x32.png" align="absmiddle"><br> Modificar</a></td>';
                    tabla_devoluciones = tabla_devoluciones +'<td align="center"><a href="#" onclick="new Devolucion().eliminarNotaDevolucion(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
          	    });
          	        tabla_devoluciones = tabla_devoluciones+'</table>';
          	    $('#div_lista_devoluciones_almacenes').append(tabla_devoluciones);
          	    $("#palabra_dev_buscar").keyup(function(){
	              new Devolucion().buscarNotaDev($('#palabra_dev_buscar').val());
	            });
                var paginas = Math.ceil(total/num);
			    paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
			    for (var i=1;i<=paginas;i++) {
					paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
					if(pag == i){
						paginacion_div = paginacion_div+i;
					}else{
						paginacion_div = paginacion_div+'<a href="#" onClick="new Devolucion().listarDevoluciones('+i+', '+limit+', '+num+')">'+i+'</a>';						
					}
					paginacion_div = paginacion_div+'</div>';
			  	}
			  	paginacion_div = paginacion_div+'</div></div>';
			  	$('#div_lista_devoluciones_almacenes').append(paginacion_div);
			}, 
			errors :function(resul){
				console.log(resul);
			}
	    });
    }

    /**
	 * Metodo para buscar devoluciones con autocomplet
	 */

	this.buscarNotaDev = function(palabra_buscar){ 
    	//alert(palabra_buscar);
    	$.ajax({
		      url:'?accion=devolucion&tp=buscarDevoluciones',
		      dataType: 'json',
		      type: 'GET',
		      data : { 
		        //action : 'ingreso',
		        //tp :'buscarIngresos',
		        devoluciones_buscar: palabra_buscar
		      },
		      beforeSend : function(){
		      },
		      success: function(resultado){
		       $("#palabra_dev_buscar").autocomplete({
		              source: resultado,/* este es el script que realiza la busqueda */
		              minLength: 1, /* le decimos que espere hasta que haya 2 caracteres escritos */
		              select: new Devolucion().notaDevSeleccionado /* esta es la rutina que extrae la informacion del producto seleccionado */
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
   this.notaDevSeleccionado = function(evt, ui){
      //alert("select");
      //console.log("llega");
      var valor = ui.item.value;
      var label = ui.item.label;
      var id = ui.item.id;
      //var datos = label.split(" ");
      //console.dir(datos);
          console.log(id);
          $.ajax({
            url:'?accion=devolucion&tp=getDatosBusNotDev',
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

				$('#div_lista_devoluciones_almacenes').empty();
				var tabla_devoluciones = '<div id="buscar_not_dev"><span><strong>Buscar :</strong></span> <input type="text" name="palabra_dev_buscar" id="palabra_dev_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Devolucion().buscarNotaDevBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_dev" id="id_unico_not_dev">';
          	        tabla_devoluciones = tabla_devoluciones+'<table id="tabla_devolucion_almacenes" class="table_usuario">';
          	        tabla_devoluciones = tabla_devoluciones+'<tr><th>NRO</th><th>CODIGO</th><th>NOMBRE</th><th>ORIGEN</th><th>DESTINO</th><th>FECHA</th><th>EDITAR</th><th>ELIMINAR</th></tr>';
                    tabla_devoluciones = tabla_devoluciones +'<tr><td>1</td>';
	                tabla_devoluciones = tabla_devoluciones +'<td>'+nro_nota+'</td>';
	                tabla_devoluciones = tabla_devoluciones +'<td>'+nom_nota+'</td>';
	                tabla_devoluciones = tabla_devoluciones +'<td>'+origen+'</td>';
	                tabla_devoluciones = tabla_devoluciones +'<td>'+destino+'</td>';
	                tabla_devoluciones = tabla_devoluciones +'<td>'+fecha_nota+'</td>';
	 			    tabla_devoluciones = tabla_devoluciones +'<td align="center"><a href="#" onclick="new Devolucion().IngresaNuevoItemCabDet(\''+id_nota+'\')"><img src="../img/nota_editar_alm_32x32.png" align="absmiddle"><br> Modificar</a></td>';
                    tabla_devoluciones = tabla_devoluciones +'<td align="center"><a href="#" onclick="new Devolucion().eliminarNotaDevolucion(\''+id_nota+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
	                tabla_devoluciones = tabla_devoluciones +'</table>';
	            $('#div_lista_devoluciones_almacenes').append(tabla_devoluciones);  
	            $("#palabra_dev_buscar").keyup(function(){
	              new Devolucion().buscarNotaDev($('#palabra_dev_buscar').val());
	            });
				var paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div>1<div id="paginacion_tabla">';
				$('#div_lista_devoluciones_almacenes').append(paginacion_div);
	        },
            error: function(resultado){
            }
          });
   }

    /*
    * Metodo de busqueda desde el boton
    */
    this.buscarNotaDevBoton = function(start, limit, num){
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
    	var palabra_buscar=$("#palabra_dev_buscar").val();
    	//alert(palabra_buscar);
        $.ajax({
	        url:'?accion=devolucion&tp=buscarNotasDev',
	        dataType: 'json',
	        type: 'GET',
	        data : { 
	          devoluciones_buscar: palabra_buscar,
	          start : start,
	          limit : limit
	        },
	        beforeSend : function(){
	        },
            success: function(resultado){
            	
				$('#div_lista_devoluciones_almacenes').empty();
				var tabla_devoluciones = '<div id="buscar_not_dev"><span><strong>Buscar :</strong></span> <input type="text" name="palabra_dev_buscar" id="palabra_dev_buscar" class="txt_campo2"><input type="button" value="Buscar" class="btn_form" onclick="new Devolucion().buscarNotaDevBoton(0,'+limit_par+','+num_par+');"><input type="hidden" name="id_unico_not_dev" id="id_unico_not_dev">';
          	        tabla_devoluciones = tabla_devoluciones+'<table id="tabla_devolucion_almacenes" class="table_usuario">';
          	        tabla_devoluciones = tabla_devoluciones+'<tr><th>NRO</th><th>CODIGO</th><th>NOMBRE</th><th>ORIGEN</th><th>DESTINO</th><th>FECHA</th><th>EDITAR</th><th>ELIMINAR</th></tr>';
	          	var num=0;
	          	var total = resultado[0].total;
	            var buscar = resultado[0].devoluciones_buscar;
	          	$.each(resultado, function(index, value){ 
          	    	num++;
          	        tabla_devoluciones = tabla_devoluciones+'<tr><td>'+num+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.alm_cab_ing_egr_nro_nota+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.alm_cab_ing_egr_nombre+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.origen+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.destino+'</td>';
          	        tabla_devoluciones = tabla_devoluciones+'<td>'+value.alm_cab_ing_egr_fecha_ingreso+'</td>';
          	        tabla_devoluciones = tabla_devoluciones +'<td align="center"><a href="#" onclick="new Devolucion().IngresaNuevoItemCabDet(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/nota_editar_alm_32x32.png" align="absmiddle"><br> Modificar</a></td>';
                    tabla_devoluciones = tabla_devoluciones +'<td align="center"><a href="#" onclick="new Devolucion().eliminarNotaDevolucion(\''+value.alm_cab_ing_nro_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
          	    });
          	        tabla_devoluciones = tabla_devoluciones+'</table>';
          	    $('#div_lista_devoluciones_almacenes').append(tabla_devoluciones);
          	    $("#palabra_dev_buscar").keyup(function(){
	              new Devolucion().buscarNotaDev($('#palabra_dev_buscar').val());
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
		                  paginacion_div = paginacion_div+'<a href="#" onClick="new Devolucion().buscarNotaDevBoton('+i+', '+limit+', '+numero+')">'+i+'</a>';          
		                }
                		paginacion_div = paginacion_div+'</div>';
                    }
                paginacion_div = paginacion_div+'</div></div>';
                $('#div_lista_devoluciones_almacenes').append(paginacion_div);
                $("#palabra_dev_buscar").val(buscar);


            },
            error: function(resultado){
            }
        });

    }



	/**
     * Este metodo que crea nueva Cotizacion privada
     */
    this.nuevoDevolucionAlmacenes = function (){
    	//alert("JS");
	    /*$("#txt_vent_cliente_proforma").val('');
	    $("#txt_vent_cod_cliente_proforma").val('');
	    $("#txt_vent_cotizador_proforma").val('');
	    $("#txt_vent_fch_inc_proforma").val('');
	    $("#txt_vent_fch_entr_proforma").val('');
	    $("#txt_vent_fch_inc_proforma").datepicker({
	    dateFormat: "dd/mm/yy"
	    });*/
	    var util = new Utilitarios();
	    //util.validarCampo('txt_vent_nombre_proforma', 'div_error_txt_vent_nombre_proforma', 'Nombre no puede estar vacio');
	    //util.validarCampo('txt_vent_cliente_proforma', 'div_error_txt_vent_cliente_proforma', 'Cliente no puede estar vacio');
	    $('#tpl_alm_form_nueva_devolucion').dialog({
	      width: 600,
	      height : 380,
	      modal: true,
	      draggable : false
	    });
	}

}