/**
 * Esta es la clase cliente de 
 * @author Daniel fernandez
 */
var limit_par=10;
var num_par =10;
function Cliente(){
	/**
	 * Metodo principal de la clase cliente
	 */
	this.init = function(){
		var me = new Cliente();
		me.listarClientes(1, limit_par, num_par);
		new Cliente().enviarFormularioNuevoCliente();
		new Cliente().editarDatosCliente();
		new Cliente().buscarClienteActivarTeclado();
	}

	/**
	 * Metodo que permite activar el evento de teclado  en el campo de busqeda
	 */
	this.buscarClienteActivarTeclado = function(){
		$('#palabra_cliente_buscar').keyup(function(evt){
			new Cliente().buscarClienteXPalabra($(this).val());
		});
	}
	/**
	 * Metodo que buscar el campo
	 */
	this.buscarClienteXPalabraCampo = function(){
		$.getJSON('?action=clientes&tp=getDataClientexId', {client_id:$('#id_unico_cliente_vent').val(), start : 0,limit : 10}, function(res){
			$('#id_unico_cliente_vent').val(ui.item.id);
			$('#div_detalle_lista_cliente').empty();
			var tabla_cabecera = '<table id="tb_vent_lista_clientes" class="table_usuario">';
			tabla_cabecera = tabla_cabecera+'<tr><th>N</th><th>CODIGO</th><th>NOMBRE</th><th>APELLIDO</th><th>EMPRESA</th><th>DIRECCION</th><th>REFERENCIA</th><th>TELEFONO</th><th>CELULAR</th><th>EMAIL</th><th>EDITAR</th><th>ELIMINAR</th>';
			tabla_cabecera = tabla_cabecera+'</table>';
			$('#div_detalle_lista_cliente').append(tabla_cabecera);
			var total=res.total;
			$.each(res.datos, function(index, cliente){
				var tabla_detalle = '<tr><td>'+cliente.num+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.codigo_cliente+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.nombre+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.apellido_pat+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.empresa_trab+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.direccion+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.contacto+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.telefono+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.celular+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.correo+'</td>';
				tabla_detalle = tabla_detalle +'<td align="center"><a href="#" onclick="new Cliente().editarCliente(\''+cliente.codigo_unico+'\')"><img src="../img/edit user_32x32.png" align="absmiddle"><br> Modificar</a></td>';
				tabla_detalle = tabla_detalle +'<td align="center"><a href="#" onclick="new Cliente().eliminarCliente(\''+cliente.codigo_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
				$('#tb_vent_lista_clientes').append(tabla_detalle);
			});
			var paginas = Math.ceil(total/num);
			paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
			for (var i=1;i<=paginas;i++) {
				paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
				if(pag == i){
					paginacion_div = paginacion_div+i;
				}else{
					paginacion_div = paginacion_div+'<a href="#" onClick="new Cliente().listarClientes('+i+', '+limit+', '+num+')">'+i+'</a>';						
				}
				paginacion_div = paginacion_div+'</div>';
			}
			paginacion_div = paginacion_div+'</div></div>';
			$('#div_detalle_lista_cliente').append(paginacion_div);
		});	
	} 


	/**
	 * Este es el metod que permite buscar  la palabra en la base de datos mediante ajax
	 */
	this.buscarClienteXPalabra = function(palabra){
		$.ajax({
			url:'?action=clientes&tp=buscarCliente',
			dataType: 'json',
			type: 'GET',
			data : {
				buscar_palabra : palabra
			},
			beforeSend : function(){
			},
			success: function(resultado){
				console.dir(resultado);
				$("#palabra_cliente_buscar").autocomplete({
		        	source: resultado, /* este es el script que realiza la busqueda */
		        	minLength: 0,  /* le decimos que espere hasta que haya 2 caracteres escritos */
		        	select: new Cliente().cli_clienteSeleccion /* esta es la rutina que extrae la informacion del producto seleccionado */
		        	//focus: new Proyecto().proyectoEnfocado /* esta es la rutina que muestra del producto marcado */
		    	});
			},
			error: function(resultado){
			}
		});	

	}
	this.cli_clienteSeleccion = function(evt, ui){
		$.getJSON('?action=clientes&tp=getDataClientexId', {client_id:ui.item.id, start : 0,limit : 10}, function(res){
			$('#id_unico_cliente_vent').val(ui.item.id);
			$('#div_detalle_lista_cliente').empty();
			var tabla_cabecera = '<table id="tb_vent_lista_clientes" class="table_usuario">';
			tabla_cabecera = tabla_cabecera+'<tr><th>N</th><th>CODIGO</th><th>NOMBRE</th><th>APELLIDO</th><th>EMPRESA</th><th>DIRECCION</th><th>REFERENCIA</th><th>TELEFONO</th><th>CELULAR</th><th>EMAIL</th><th>EDITAR</th><th>ELIMINAR</th>';
			tabla_cabecera = tabla_cabecera+'</table>';
			$('#div_detalle_lista_cliente').append(tabla_cabecera);
			var total=res.total;
			$.each(res.datos, function(index, cliente){
				var tabla_detalle = '<tr><td>'+cliente.num+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.codigo_cliente+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.nombre+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.apellido_pat+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.empresa_trab+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.direccion+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.contacto+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.telefono+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.celular+'</td>';
				tabla_detalle = tabla_detalle +'<td>'+cliente.correo+'</td>';
				tabla_detalle = tabla_detalle +'<td align="center"><a href="#" onclick="new Cliente().editarCliente(\''+cliente.codigo_unico+'\')"><img src="../img/edit user_32x32.png" align="absmiddle"><br> Modificar</a></td>';
				tabla_detalle = tabla_detalle +'<td align="center"><a href="#" onclick="new Cliente().eliminarCliente(\''+cliente.codigo_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
				$('#tb_vent_lista_clientes').append(tabla_detalle);
			});
			var paginas = Math.ceil(total/num);
			paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
			for (var i=1;i<=paginas;i++) {
				paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
				if(pag == i){
					paginacion_div = paginacion_div+i;
				}else{
					paginacion_div = paginacion_div+'<a href="#" onClick="new Cliente().listarClientes('+i+', '+limit+', '+num+')">'+i+'</a>';						
				}
				paginacion_div = paginacion_div+'</div>';
			}
			paginacion_div = paginacion_div+'</div></div>';
			$('#div_detalle_lista_cliente').append(paginacion_div);
		});
	}
	/**
	 * Esta es la lista de usuarios
	 */
	this.listarClientes = function(start, limit, num){
		pag = 1;
		if(start != 0 && start != 1){
			pag = start;
			start = start*num-(num-1);
			limit = pag*num;
		}else{
			start = 1;
			limit = num;
		}
		$.ajax({
			url:'index.php',
			dataType: 'json',
			type: 'GET',
			data : { 
				action : 'clientes',
				tp : 'listarClientes',
				start : start,
				limit : limit
			},
			beforeSend : function(){
				$('#div_detalle_lista_cliente').empty();
			    $('#div_detalle_lista_cliente').append('<center><img src="../img/ajax-loader.gif"></center>').hide().fadeIn(500);
			},
			success: function(res){
				$('#div_detalle_lista_cliente').empty();
				var tabla_cabecera = '<table id="tb_vent_lista_clientes" class="table_usuario">';
				tabla_cabecera = tabla_cabecera+'<tr><th>N</th><th>CODIGO</th><th>NOMBRE</th><th>APELLIDO</th><th>EMPRESA</th><th>DIRECCION</th><th>REFERENCIA</th><th>TELEFONO</th><th>CELULAR</th><th>EMAIL</th><th>EDITAR</th><th>ELIMINAR</th>';
				tabla_cabecera = tabla_cabecera+'</table>';
				$('#div_detalle_lista_cliente').append(tabla_cabecera);
				var total=res.total;
				$.each(res.datos, function(index, cliente){
					var tabla_detalle = '<tr><td>'+cliente.num+'</td>';
					tabla_detalle = tabla_detalle +'<td>'+cliente.codigo_cliente+'</td>';
					tabla_detalle = tabla_detalle +'<td>'+cliente.nombre+'</td>';
					tabla_detalle = tabla_detalle +'<td>'+cliente.apellido_pat+'</td>';
					tabla_detalle = tabla_detalle +'<td>'+cliente.empresa_trab+'</td>';
					tabla_detalle = tabla_detalle +'<td>'+cliente.direccion+'</td>';
					tabla_detalle = tabla_detalle +'<td>'+cliente.contacto+'</td>';
					tabla_detalle = tabla_detalle +'<td>'+cliente.telefono+'</td>';
					tabla_detalle = tabla_detalle +'<td>'+cliente.celular+'</td>';
					tabla_detalle = tabla_detalle +'<td>'+cliente.correo+'</td>';
					tabla_detalle = tabla_detalle +'<td align="center"><a href="#" onclick="new Cliente().editarCliente(\''+cliente.codigo_unico+'\')"><img src="../img/edit user_32x32.png" align="absmiddle"><br> Modificar</a></td>';
					tabla_detalle = tabla_detalle +'<td align="center"><a href="#" onclick="new Cliente().eliminarCliente(\''+cliente.codigo_unico+'\')"><img src="../img/delete_32x32.png" align="absmiddle"><br>Eliminar</a></td></tr>';
					$('#tb_vent_lista_clientes').append(tabla_detalle);
				});
				var paginas = Math.ceil(total/num);
				paginacion_div = '<div id="paginacion"><div id="titulo_paginacion">Paginaci&oacute;n >>> </div><div id="paginacion_tabla">'
				for (var i=1;i<=paginas;i++) {
					paginacion_div = paginacion_div+'<div id="'+i+'" class="pagina">';
					if(pag == i){
						paginacion_div = paginacion_div+i;
					}else{
						paginacion_div = paginacion_div+'<a href="#" onClick="new Cliente().listarClientes('+i+', '+limit+', '+num+')">'+i+'</a>';						
					}
					paginacion_div = paginacion_div+'</div>';
				}
				paginacion_div = paginacion_div+'</div></div>';
				$('#div_detalle_lista_cliente').append(paginacion_div);
			}
		});
	}

	/**
	 * Este metodo que crea nuevo cliente 
	 */
	this.nuevoCliente = function (){
		new Cliente().resetForm();
		var util = new Utilitarios();
		$('#tpl_vent_form_nuevo_cliente h3').empty();
	 	$('#tpl_vent_form_nuevo_cliente h3').append('<img src="../img/user office_32x32.png" align="absmiddle"> Nuevo Cliente ');
		$('#txt_vent_celular_cliente').numeric();
		$('#txt_vent_telefono_cliente').numeric();
		$('#txt_vent_numero_interno').numeric();
		util.validarCampo('txt_vent_nombre_cliente', 'div_error_vent_error_nombre', 'Nombre no puede estar vacio');
		util.validarCampo('txt_vent_apellido_pat_cliente', 'div_error_vent_error_apellido_pat', 'Apellido no puede estar vacio');
		util.validarCampo('txt_vent_cliente_correo', 'div_error_vent_error_cliente_correo', 'Correo esta vacio');
		util.validarCampo('txt_vent_celular_cliente', 'div_error_vent_error_celular_cliente', 'Celular no puede estar vacio');
		util.validarCampo('txt_vent_cliente_persona_contacto', 'div_error_vent_error_persona_contacto', 'Contacto no puede estar vacio');
		util.validarCampo('txt_vent_razon_social_cliente', 'div_error_vent_error_razon_social_cliente', 'Razon Social no puede estar vacio');
		util.validarCampo('txt_vent_nit_cliente', 'div_error_vent_error_nit_cliente', 'NIT no puede estar vacio');
		util.validarCampo('txt_vent_telefono_cliente', 'div_error_vent_error_telefono_cliente', 'Telefono no puede estar vacio');
		util.validarCampo('txt_vent_numero_interno', 'div_error_vent_error_numero_interno', 'N&uacute;mero Int. no puede estar vacio');
		$('#tpl_vent_form_nuevo_cliente').dialog({
			width: 735,
			height : 460,
			modal: true,
			draggable : false
		});
	}

	this.resetForm = function(){
		$('#txt_vent_nombre_cliente').val("");
 		$('#txt_vent_empresa_cliente').val("");
 		$('#txt_vent_apellido_pat_cliente').val("");
 		$('#txt_vent_cargo_cliente').val("");
 		$('#txt_vent_apellido_mat_cliente').val("");
 		$('#txt_vent_departamento_cliente').val("");
 		$('#txt_vent_cliente_correo').val("");
 		$('#txt_vent_telefono_cliente').val("");
 		$('#txt_vent_celular_cliente').val("");
 		$('#txt_vent_nit_cliente').val("");
 		$('#txt_area_vent_dirrecion_cliente').val("");
 		$('#txt_vent_razon_social_cliente').val("");
 		$('#txt_vent_cliente_persona_contacto').val("");
 		$('#txt_vent_numero_interno').val("");
 		$('#id_unico_cliente').val("");
	 	$('#codigo_cliente').val("");
	}
	/**
	 * Metodo que permite crear un cliente 
	 */
	this.enviarFormularioNuevoCliente = function (){
		var util = new Utilitarios();
		$('#form_vent_nuevo_cliente').submit(function(evt){
			if($.trim($('#txt_vent_nombre_cliente').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Nombre no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_apellido_pat_cliente').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Apellido Paterno no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_cliente_correo').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Correo no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_celular_cliente').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Celular no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_area_vent_dirrecion_cliente').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Dirreci&oacute;n no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_cliente_persona_contacto').val()) == ""){
				util.mostrarMensajeAlerta(0, 'La Persona de Contacto no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_telefono_cliente').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Tel&eacute;fono de Contacto no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_nit_cliente').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El NIT no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_razon_social_cliente').val()) == ""){
				util.mostrarMensajeAlerta(0, 'La Razon Social no puede estar vacio', 'Advertencia');
			}else{
				datos = $(this).serialize();
				$.ajax({
					url:'?action=clientes&tp=saveCliente',
					data:datos,
					type:'GET',
					dataType:'json',
					success:function(res){
						if(res.complet){
							new Cliente().listarClientes(0,limit_par, num_par);
							$('#tpl_vent_form_nuevo_cliente').dialog('close');
						}	
					}
				});	
			}
			
			evt.preventDefault();
		});
	}

	/**
     * Metodo que permite enviar los datos de edicion
     */
    this.editarDatosCliente = function (){
    	$('#form_vent_edit_cliente').submit(function(evt){
    		if($.trim($('#txt_vent_nombre_cliente_edit').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Nombre no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_apellido_pat_cliente_edit').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Apellido Paterno no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_cliente_correo_edit').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Correo no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_celular_cliente_edit').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Celular no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_area_vent_dirrecion_cliente_edit').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Dirreci&oacute;n no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_cliente_persona_contacto_edit').val()) == ""){
				util.mostrarMensajeAlerta(0, 'La Persona de Contacto no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_telefono_cliente_edit').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El Tel&eacute;fono de Contacto no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_nit_cliente_edit').val()) == ""){
				util.mostrarMensajeAlerta(0, 'El NIT no puede estar vacio', 'Advertencia');
			}else if($.trim($('#txt_vent_razon_social_cliente_edit').val()) == ""){
				util.mostrarMensajeAlerta(0, 'La Razon Social no puede estar vacio', 'Advertencia');
			}else{
				datos = $(this).serialize();
				$.ajax({
					url:'?action=clientes&tp=saveEditCliente',
					data:datos,
					type:'GET',
					dataType:'json',
					success:function(res){
						if(res.complet){
							new Cliente().listarClientes(0,limit_par, num_par);
							$('#tpl_vent_form_edit_cliente').dialog('close');
						}	
					}
				});
			}
			evt.preventDefault();
		});
    }

	/**
	 * Metodo que elimina al cliente
	 */
	this.eliminarCliente = function (id_cliente){
		$("#dialog-confirm").attr("title", "Eliminar Cliente");
		$("#dialog-confirm #contexto_dialog").empty();
		contexto_dialog = '<img src="../img/alert_48x48.png" align="absmiddle">';
		contexto_dialog = contexto_dialog+"Estas seguro que quieres eliminar el cliente?";
		$("#dialog-confirm #contexto_dialog").append(contexto_dialog);
		$("#dialog-confirm").dialog({
			resizable: false,
			height:200,
			width:400,
			modal: true,
			buttons: {
				"Aceptar": function() {
					new Cliente().confirmarEliminarCliente(id_cliente);
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});
		
	}
	/**
	 * Metodo que elimina el cliente
	 */
	this.confirmarEliminarCliente = function (id_cliente){
		$.get('?action=clientes&tp=deleteCliente', { cliente_id :id_cliente }, function(resp) {
       		$("#dialog-confirm").dialog("close");
       		new Cliente().listarClientes(0,limit_par, num_par);
    	});
	}
	/**
	 MEtodo que peromite actualizar la informacion de cliente
	 */
	 this.editarCliente = function(id_cliente){
	 	$.getJSON('?action=clientes&tp=getDataCliente', {client_id:id_cliente}, function(res){
	 		$('#tpl_vent_form_edit_cliente h3').empty();
	 		$('#tpl_vent_form_edit_cliente h3').append('<img src="../img/user office_32x32.png" align="absmiddle"> Editar Datos Cliente ');
	 		$('#tpl_vent_form_edit_cliente h3').append(res.vent_cli_codigo_cliente);
	 		$('#txt_vent_nombre_cliente_edit').val(res.vent_cli_nombre);
	 		$('#txt_vent_empresa_cliente_edit').val(res.vent_cli_empresa_trab);
	 		$('#txt_vent_apellido_pat_cliente_edit').val(res.vent_cli_apellido_pat);
	 		$('#txt_vent_cargo_cliente_edit').val(res.vent_cli_cargo);
	 		$('#txt_vent_apellido_mat_cliente_edit').val(res.vent_cli_apellido_mat);
	 		$('#txt_vent_departamento_cliente_edit').val(res.vent_cli_departamento_cargo);
	 		$('#txt_vent_cliente_correo_edit').val(res.vent_cli_correo);
	 		$('#txt_vent_telefono_cliente_edit').val(res.vent_cli_telefono);
	 		$('#txt_vent_celular_cliente_edit').val(res.vent_cli_celular);
	 		$('#txt_vent_nit_cliente_edit').val(res.vent_cli_nit);
	 		$('#txt_area_vent_dirrecion_cliente_edit').val(res.vent_cli_direccion);
	 		$('#txt_vent_razon_social_cliente_edit').val(res.vent_cli_razon_fact);
	 		$('#txt_vent_cliente_persona_contacto_edit').val(res.vent_cli_persona_cont);
	 		$('#txt_vent_numero_interno_edit').val(res.vent_cli_interno);
	 		$('#id_unico_cliente').val(res.vent_cli_cod_unico);
	 		$('#codigo_cliente').val(res.vent_cli_codigo_cliente);
	 	});
		
	 	$('#tpl_vent_form_edit_cliente').dialog({
			width: 735,
			height : 460,
			modal: true,
			draggable : false
		});
		
	 }
	/**
	 * Metodo que cierra el dialog de cliente
	 */
	this.closeDialogoNuevoCliente = function(){
		$('#tpl_vent_form_nuevo_cliente').dialog('close');
	}

		/**
	 * Metodo que cierra el dialog de cliente boton priv
	 */
	this.closeDialogoNuevoClienteBot = function(){
		$('#tpl_vent_form_nuevo_cliente_bot').dialog('close');
	}

			/**
	 * Metodo que cierra el dialog de cliente boton publ
	 */
	this.closeDialogoNuevoClienteBotPubl = function(){
		$('#tpl_vent_form_nuevo_cliente_bot_publ').dialog('close');
	}
	/**
	 * Metodo que cierra el dialogo de edicion de cliente
	 */
	this.closeDialogEditCliente = function(){
		$('#tpl_vent_form_edit_cliente').dialog('close');
	}
}