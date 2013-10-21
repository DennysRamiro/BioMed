// JavaScript Document
$(document).on("ready", function(){
	var importacion = new GestionImportacion();
	importacion.inicio();
});

function GestionImportacion(){
	/**
	 * Metodo constructor
	 */
	this.inicio = function(){
		var util = new Utilitarios();
		var hoja = new HojaCosto();
		hoja.procesarFormDet();
		var agenciaDespachante= new AgenciaDespachante();
		agenciaDespachante.AgenciadespachanteInicio();
		agenciaDespachante.ModificarAgenDespachante();
		
		util.validarCampo('nombre_proyecto', 'error_nombre_proy', 'El campo nombre del proyecto es obligatorio');
		util.validarCampo('descripcion_proyecto', 'error_desc', 'El campo descripcion es obligatorio');
		$("#proyecto_buscar").keyup(function(){
			new GestionImportacion().buscarProyecto($('#proyecto_buscar').val());
		});
		// Texto del combobox
		//var valor = $("#cod_age option:selected").html();
	
		 $('select#cod_age').on('change',function(){
   		 var texto_agencia = $("#cod_age option:selected").text();
		 $("#nom_age_selec").val(texto_agencia);
    	 //alert(valor);
		});
	}
	/**
	 * Metodo que ejecuta el dialogo del fomulario del nuevo proyecto
	 */
	 this.formularioNuevo = function(){
		 //alert("asd");
		 var proyecto = new Proyecto();
		proyecto.formularioNuevoProyecto();
	 }	 
	 /**
	 *Metodo que graba el proyecto
	 */
	
	 this.grabarFormulario=function(){
		  var proyecto = new Proyecto();
		  proyecto.grabarNuevoProyecto();
	 }

	 
	  /**
	   * Metodo que ejecuta el dialogo del contrato /Pedido
	   */
	
	 this.formularioContrato=function(id_proyecto, codigo_proyecto){
		var contrato = new Contrato();
	    contrato.formularioNuevoContrato(id_proyecto, codigo_proyecto);
	 }
	 /**
	  * Metodo que graba el formulario contrato
	  */
	
	 this.grabarFormularioContrato=function(){
		  var contrato = new Contrato();
		  contrato.grabarNuevoContrato();
	 }
	 
	 /***
	 	* Metodo que da de baja el contrato
		*/
		this.bajaProyecto = function(valor_cod_proy){
			//alert("baja contrato "+valor_cod_proy);
			var proyecto_baja = new Proyecto();
			proyecto_baja.desabilitarProyecto(valor_cod_proy);
			//proyecto_baja.darBajaProyecto(valor_cod_proy);
		}
	 
	 
	 
	/**
	 * Metodo que ejecuta el dialogo del fomulario de agencia despachante (transaccion)
	 */
	 this.formularioAgenciaDespachante = function(id_proyecto, codigo_proyecto,nom_prov,cod_prov){
		 //alert(cod_prov);
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.NuevoAgenciaDespachante(id_proyecto, codigo_proyecto,nom_prov,cod_prov);
	 }

	 	/**
	 * Metodo que ejecuta el dialogo del fomulario de agencia despachante (transaccion)
	 */
	 this.formularioAgenciaDespachanteCons = function(id_proyecto, codigo_proyecto,nom_prov,cod_prov){
		 //alert(cod_prov);
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.NuevoAgenciaDespachanteCons(id_proyecto, codigo_proyecto,nom_prov,cod_prov);
	 }
	 /**
	 * Metodo que ejecuta el dialogo del fomulario de agencia despachante (transaccion)
	 */
	 /*this.formularioDetallarPlanillaAduanera = function(codigo_proyecto,id_aduana){
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.formularioDetallarPlanillaAduanera(codigo_proyecto,id_aduana);
	 }*/
	 /**
	 * Metodo que ejecuta el dialogo del fomulario de agencia despachante (transaccion)
	 */
	 this.formularioListarAgenciaDespachante = function(id_proyecto, codigo_proyecto){
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.formularioListarAgenciaDespachante(id_proyecto, codigo_proyecto);
	 }

	 	 /**
	 * Metodo que ejecuta el dialogo del fomulario de agencia despachante (transaccion)
	 */
	 this.listaAgeOpciones = function(id_proyecto, codigo_proyecto){
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.listaAgeOpciones(id_proyecto, codigo_proyecto);
	 }
	 /**
	 *Metodo que graba el fromulario agencia despacahnte
	 */
	 this.GrabarAgenciaDespach=function(){/* this.grabarFormulario=function(){*/
		  var agencia_despachante = new AgenciaDespachante();
		  agencia_despachante.AgenciadespachanteInicio();/*proyecto.grabarNuevoProyecto();*/
	 }
	 /**
	 * Metodo que ejecuta el dialogo del fomulario Modificacion de agencia despachante (transaccion)
	 */
	 this.formularioModificarAgenciaDespachante = function(id_proyecto, codigo_proyecto,cod_aduana){
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.ModificacionAgenciaDespachante(id_proyecto, codigo_proyecto, cod_aduana);
	 }
	  /**
	 * Metodo que ejecuta el dar de baja a la planilla desde la lista
	 */
	 this.darBajaAgenciaLista = function(id_agencia, codigo_proyecto,cod_agencia){
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.darBajaAgenciaLista(id_agencia, codigo_proyecto, cod_agencia);
	 }

	   /**
	 * Metodo que ejecuta el dar de baja a la planilla desde formulario detalle
	 */
	 this.darBajaAgencia = function(id_agencia, codigo_proyecto,cod_agencia){
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.darBajaAgencia(id_agencia, codigo_proyecto, cod_agencia);
	 }

	    /**
	 * Metodo que cancelar modificar
	 */
	 this.cancelarPlanilla = function(id_proyecto,codigo_proy){
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.cancelarPlanilla(id_proyecto,codigo_proy);
	 }

	  /**
	  * Metodo para dar procesar los certificados y cambiar de estado
	  */
	
	 this.procesarPlanilla=function(codigo_proyecto,estado_proyecto){
		 //alert(codigo_proyecto+estado_proyecto);
		var agencia_despachante = new AgenciaDespachante();
		agencia_despachante.procesarPlanilla(codigo_proyecto, estado_proyecto);
	 }
	 /**
	 * Metodo que ejecuta el dialogo del fomulario Modificacion de agencia despachante (transaccion)
	 */
	/* this.GrabarModificacionAgenciaDespachante = function(){
		 var agencia_despachante = new AgenciaDespachante();
		 agencia_despachante.ModAgenciadespachante();
	 }*/
	 /**
	 * Metodo que ejecuta el dialogo del fomulario Liquidacion Poliza
	 */
	
	 this.formularioLiquidacionPoliza = function(id_proyecto, codigo_proyecto){
		 var liquidacion_poliza = new LiquidacionPoliza();
		 liquidacion_poliza.NuevaLiquidacionPoliza(id_proyecto, codigo_proyecto);
	 }	

	     /**
	  * Metodo que busca el formulario de desaduanizacion (DUI)
	  */
	 this.listaDetOpciones=function(codigo_proyecto){
		 //alert("grabar"+codigo_proyecto);
		  //var liquidacion_poliza = new LiquidacionPoliza();
		 // liquidacion_poliza.listaDetOpciones(codigo_proyecto);
	 }
	 
	  /*
	  * Metodo que permite buscar un proyecto para el autocompletable
	  */
	this.buscarProyecto = function(palabra_buscar){
		var proyecto = new Proyecto();
		proyecto.buscarProyecto(palabra_buscar);
	}

	/**
	 * Metodo que se ejecuta cuando se presiona el buscar
	 */
	 this.buscarProyectoBtn = function(){
	 	var proyecto = new Proyecto();
	 	proyecto.buscarProyectoBtn($('#proyecto_buscar').val());
	 }
	
	 /**
	   * Metodo que ejecuta el dialogo de la Proforma
	   */
	
	 this.formularioNuevaOrdenCompra=function(codigo_proyecto){
		var orden_compra = new OrdenCompra();
	    orden_compra.formularioNuevaOrdenCompra(codigo_proyecto);
	 }
	 
	  /**
	  * Metodo que graba el formulario de la proforma
	  */
	
	 this.grabarFormularioNuevaOrden=function(){
		  var orden_compra = new OrdenCompra();
		  orden_compra.grabarNuevaOrdenCompra();
	 }
	 
	   /**
	  * Metodo que lista las orden compra
	  */
	
	 this.formularioListaOrdenCompra=function(codigo_proyecto){
		  var orden_compra = new OrdenCompra();
		  orden_compra.formularioListaOrdenCompra(codigo_proyecto);
	 }
	/**
	 * Metodo que permile detallar la orden de compra
	 */
	this.detallarOrdenCompra = function(id_orden, nro_referencia, codigo_proyecto, codigo_unico_proyecto){
		var orden_compra = new OrdenCompra();
		orden_compra.detallarOrdenCompra(id_orden, nro_referencia, codigo_proyecto, codigo_unico_proyecto);
	}
	
	
	/**
	  * Metodo que cancela la orden 
	  */
	  this.eliminarOrden = function(cod_proy){
	  	//alert(cod_proy);
		var elimina_ordenes = new OrdenCompra();
		elimina_ordenes.bajaOrdenes(cod_proy);
	  }
	 
	
	   /**
	  * Metodo formulario gua de embarque 
	  */
	
	 this.formularioGuiaEmbarque=function(id_proyecto, codigo_proyecto){
		 //alert("GUIA");
		  var guia_embarque = new GuiaEmbarque();
		  guia_embarque.formularioGuiaEmbarque(id_proyecto, codigo_proyecto);
	 }

	  /**
	  * Metodo grabar formulario guia de embarque 
	  */
	
	 this.grabarFormularioGuiaEmbarque=function(){
		// alert("GUIA GRABAR");
		 var guia_embarque = new GuiaEmbarque();
		  guia_embarque.grabarformularioGuiaEmbarque();
	 }

	 	  /**
	  * Metodo grabar formulario guia de embarque 
	  */
	
	 this.grabarFormularioGuiaEmbarqueLista=function(){
		// alert("GUIA GRABAR");
		 var guia_embarque = new GuiaEmbarque();
		  guia_embarque.grabarFormularioGuiaEmbarqueLista();
	 }

	 /**
	  * Metodo listar metodos formulario guia de embarque 
	  */
	
	 this.listaGuiaOpciones=function(id_codigo,codigo_proyecto){
		// alert("GUIA GRABAR");
		 var guia_embarque = new GuiaEmbarque();
		  guia_embarque.listaGuiaOpciones(id_codigo,codigo_proyecto);
	 }

	  /**
	  * Metodo listar metodos formulario guia de embarque 
	  */
	
	 this.formularioGuiaEmbarqueLista=function(codigo_proyecto,cod_prov){
		 //alert("GUIA GRABAR"+codigo_proyecto+cod_prov);
		 var guia_embarque = new GuiaEmbarque();
		 guia_embarque.formularioGuiaEmbarqueLista(codigo_proyecto,cod_prov);
	 }

	   /** modificarDetallarGuiaEmbarque
	  * Metodo listar metodos formulario guia de embarque 
	  */
	
	 this.formularioDetallarGuiaEmbarque=function(id_guia,codigo_proyecto,cod_prov){
		 //alert("GUIA GRABAR"+codigo_proyecto+cod_prov);
		 var guia_embarque = new GuiaEmbarque();
		 guia_embarque.formularioDetallarGuiaEmbarque(id_guia,codigo_proyecto,cod_prov);
	 }

	 	   /** modificarDetallarGuiaEmbarque
	  * Metodo listar metodos formulario guia de embarque 
	  */
	
	 this.darBajaGuiaEmbarque=function(id_guia,codigo_proyecto){
		 //alert("GUIA GRABAR"+codigo_proyecto+cod_prov);
		 var guia_embarque = new GuiaEmbarque();
		 guia_embarque.darBajaGuiaEmbarque(id_guia,codigo_proyecto);
	 }

	 	   /** modificarDetallarGuiaEmbarque
	  * Metodo listar metodos formulario guia de embarque 
	  */
	
	 this.procesarGuiaEmbarque=function(codigo_proyecto,estado_proyecto){
		 //alert("GUIA"+codigo_proyecto+estado_proyecto);
		 var guia_embarque = new GuiaEmbarque();
		 guia_embarque.procesarGuiaEmbarque(codigo_proyecto,estado_proyecto);
	 }

	   /** 
	  * Metodo listar metodos formulario guia de embarque 
	  */
	
	 this.modificarDetallarGuiaEmbarque=function(id_guia,codigo_proyecto,cod_prov){
		 //alert("GUIA GRABAR"+codigo_proyecto+cod_prov);
		 var guia_embarque = new GuiaEmbarque();
		 guia_embarque.modificarDetallarGuiaEmbarque(id_guia,codigo_proyecto,cod_prov);
	 }

	 /**
	  * Metodo listar metodos formulario guia de embarque 
	  */
	
	 this.formularioListaGuiaEmbarque=function(codigo_proyecto){
		// alert("GUIA GRABAR");
		 var guia_embarque = new GuiaEmbarque();
		  guia_embarque.formularioListaGuiaEmbarque(codigo_proyecto);
	 }

	 	 /**
	  * Metodo listar metodos formulario guia de embarque 
	  */
	
	 this.formularioListaGuiaEmbarque=function(codigo_proyecto){
		// alert("GUIA GRABAR");
		 var guia_embarque = new GuiaEmbarque();
		  guia_embarque.formularioListaGuiaEmbarque(codigo_proyecto);
	 }
	   /**
	  * Metodo que lista los certificados
	  */
	
	 this.actualizarListaGuiaEmbarque=function(codigo_proyecto){
		 //alert("LISTA");
		  var guia_embarque = new GuiaEmbarque();
		  guia_embarque.actualizarListaGuiaEmbarque(codigo_proyecto);
	 }

	   /**
	  * Metodo que formulario nuevo los certificados
	  */
	
	 this.formularioNuevoCertificado=function(codigo_proyecto){
		 //alert("LISTA");
		  var certificado = new Certificado();
		  certificado.formularioNuevoCertificado(codigo_proyecto);
	 }

	 	   /**
	  * Metodo que formulario nuevo los certificados
	  */
	
	 this.formularioNuevoCertificadoProv=function(codigo_proyecto,cod_prov){
		 //alert("LISTA");
		  var certificado = new Certificado();
		  certificado.formularioNuevoCertificadoProv(codigo_proyecto,cod_prov);
	 }
	 /*
	 * Metodo que formulario que graba los certificados
	  */
	
	 this.grabarformularioNuevoCertificado=function(){
		 //alert("LISTA");
		  var certificado = new Certificado();
		  certificado.grabarformularioNuevoCertificado();
	 }

	  /*
	 * Metodo que formulario que graba los certificados
	  */
	
	 this.grabarformularioNuevoCertificadoProv=function(){
		 //alert("LISTA");
		  var certificado = new Certificado();
		  certificado.grabarformularioNuevoCertificadoProv();
	 }

	 	    /**
	  * Metodo que lista los confirmaciones  
	  */
	
	 this.formularioListaConfirmacionTransferenciaBancaria=function(codigo_proyecto){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.formularioListaConfirmacionTransferenciaBancaria(codigo_proyecto);
	 }

	 	    /**
	  * Metodo que lista los certificados 
	  */
	
	 this.formularioDetallarConfirmacionBancaria=function(id_confirmacion,codigo_proyecto,cod_prov){
		// alert("LISTA"+id_confirmacion+codigo_proyecto+cod_prov);
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.formularioDetallarConfirmacionBancaria(id_confirmacion,codigo_proyecto,cod_prov);
	 }

	 	      /**
	  * Metodo que modificar confirmacion
	  */
	
	 this.modificarDetalleConfirmacionBancaria=function(id_confirmacion,codigo_proyecto,cod_prov){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.modificarDetalleConfirmacionBancaria(id_confirmacion,codigo_proyecto,cod_prov);
	 }

	 	     /**
	  * Metodo que lista los certificados
	  */
	
	 this.darBajaConfirmacionBancaria=function(id_confirmacion,codigo_proyecto){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.darBajaConfirmacionBancaria(id_confirmacion,codigo_proyecto);
	 }

	 	     /**
	  * Metodo que lista los certificados
	  */
	
	 this.darBajaConfirmacionBancariaLista=function(id_confirmacion,codigo_proyecto){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.darBajaConfirmacionBancariaLista(id_confirmacion,codigo_proyecto);
	 }
	  	     /**
	  * Metodo que lista los certificados
	  */
	
	 this.cancelarConfirmacionBancaria=function(){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.cancelarConfirmacionBancaria();
	 }
	 /*
	   * Metodo que lista los certificados
	  */
	
	 this.procesarConfirmacionBancaria=function(codigo_proyecto,estado_proyecto){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.procesarConfirmacionBancaria(codigo_proyecto,estado_proyecto);
	 }
	    /**
	  * Metodo que lista los certificados
	  */
	
	 this.formularioListaCertificadoBancario=function(codigo_proyecto){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.formularioListaCertificadoBancario(codigo_proyecto);
	 }

	     /**
	  * Metodo que lista los certificados
	  */
	
	 this.formularioListaCertificado=function(codigo_proyecto){
		 //alert("LISTA");
		  var certificado = new Certificado();
		  certificado.formularioListaCertificado(codigo_proyecto);
	 }

	     /**
	  * Metodo que lista los certificados
	  */
	
	 this.formularioListaCertificadoProv=function(codigo_proyecto){
		 //alert("LISTA");
		  var certificado = new Certificado();
		  certificado.formularioListaCertificadoProv(codigo_proyecto);
	 }
	 
	      /**
	  * Metodo que lista los certificados
	  */
	
	 this.listaCertOpciones=function(codigo_proyecto){
		 //alert("LISTA");
		  var certificado = new Certificado();
		  certificado.listaCertOpciones(codigo_proyecto);
	 }

	    /**
	  * Metodo que lista los certificados
	  */
	
	 this.formularioDetallarCertificadoBancario=function(id_certificado,codigo_proyecto,cod_prov){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.formularioDetallarCertificadoBancario(id_certificado,codigo_proyecto,cod_prov);
	 }

	     /**
	  * Metodo que lista los certificados
	  */
	
	 this.darBajaCertificadoBancario=function(id_certificado,codigo_proyecto){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.darBajaCertificadoBancario(id_certificado,codigo_proyecto);
	 }

	 	     /**
	  * Metodo que lista los certificados
	  */
	
	 this.darBajaCertificadoBancarioLista=function(id_certificado,codigo_proyecto){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.darBajaCertificadoBancarioLista(id_certificado,codigo_proyecto);
	 }

	  	     /**
	  * Metodo que lista los certificados
	  */
	
	 this.cancelarCertificadoBancario=function(){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.cancelarCertificadoBancario();
	 }
	 /*
	   * Metodo que lista los certificados
	  */
	
	 this.procesarCertificadoBancario=function(codigo_proyecto,estado_proyecto){
		 //alert("LISTA");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.procesarCertificadoBancario(codigo_proyecto,estado_proyecto);
	 }
	      /**
	  * Metodo que lista los certificados
	  */
	
	 this.modificarDetalleCertificadoBancario=function(id_certificado,codigo_proyecto,cod_prov){
		 //alert("LISTA"+id_certificado+codigo_proyecto);
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.modificarDetalleCertificadoBancario(id_certificado,codigo_proyecto,cod_prov);
	 }
	 /**
	  * Metodo que realiza ella lista de las ordenes para grabar la transferencia
	  */
	 this.formularioTransferenciaBancaria=function(id_proyecto, codigo_proyecto){
		 //alert("grabar");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.formularioNuevaTransferenciaBancaria(id_proyecto, codigo_proyecto,3);
	 }

	  /**
	  * Metodo que realiza ella lista de las ordenes para grabar la transferencia
	  */
	 this.actualizarTransferenciaBancaria=function(id_proyecto, codigo_proyecto){
		 //alert("grabar");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.actualizarNuevaTransferenciaBancaria(id_proyecto, codigo_proyecto,3);
	 }
	 
	  /**
	  * Metodo que muestra el formulario de grabado para la transferencia bancaria
	  */
	 this.formularioListarTransferenciaBancaria=function(uno,dos,tres,cuatro,cinco){
		// alert(uno+"--"+dos+"--"+tres+"--"+cuatro+"--"+cinco);
		  var transferencia_bancaria = new TransferenciaBancaria();
		 transferencia_bancaria.formularioGrabarNuevaTransferenciaBancaria(uno,dos,tres,cuatro,cinco);
	 }
	 
	 
	 
	 /**
	  * Metodo que realiza el grabado de la transferencia bancaria
	  */
	  
	  this.grabarFormularioTransferenciaBancaria = function(id_proyecto, codigo_proyecto){
			  var transferencia_bancaria = new TransferenciaBancaria();
			  transferencia_bancaria.grabarNuevaTransferenciaBancaria(id_proyecto, codigo_proyecto);
	  }
	  
	  
	   /**
	  * Metodo que busca el formulario de confirmacion de la transferencia bancaria
	  */
	 this.formularioConfirmacionTransferenciaBancaria=function(codigo_proyecto,cod_prov){
		 //alert("grabar");
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.formularioNuevaConfirmacionTransferenciaBancaria(codigo_proyecto,cod_prov);
	 }
	 
	  /**
	  * Metodo que realiza el grabado de la confirmacion de la transferencia bancaria
	  */
	  
	  this.grabarFormularioConfirmacionTransferenciaBancaria = function(id_proyecto, codigo_proyecto){
			  //alert("CONFIRMACION");
			  var transferencia_bancaria = new TransferenciaBancaria();
			  transferencia_bancaria.grabarNuevaConfirmacionTransferenciaBancaria(id_proyecto, codigo_proyecto);
	  }
	  
	/**
	  * Metodo que busca el formulario de certificacion de la transferencia bancaria
	  */
	 this.formularioCertificacionTransferenciaBancaria = function(codigo_proyecto,cod_prov){
		 //alert("grabar"+codigo_proyecto+cod_prov);
		  var transferencia_bancaria = new TransferenciaBancaria();
		  transferencia_bancaria.formularioNuevaCertificacionTransferenciaBancaria(codigo_proyecto,cod_prov);
	 }
	 
	 
	  /**
	  * Metodo que realiza el grabado de la certificacion de la transferencia bancaria
	  */
	  
	  this.grabarFormularioCertificacionTransferenciaBancaria = function(id_proyecto, codigo_proyecto){
			  //alert("CONFIRMACION");
			  var transferencia_bancaria = new TransferenciaBancaria();
			  transferencia_bancaria.grabarNuevaCertificacionTransferenciaBancaria(id_proyecto, codigo_proyecto);
	  }


	  /**
	  * Metodo que busca el formulario de desaduanizacion (DUI)
	  */
	 this.formularioDesaduanizacion=function(id_proyecto, codigo_proyecto){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.formularioDesaduanizacion(id_proyecto, codigo_proyecto);
	 }

	   /**
	  * Metodo que busca el formulario de desaduanizacion (DUI)
	  */
	 this.listaDesOpciones=function(id_proyecto, codigo_proyecto){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.listaDesOpciones(id_proyecto, codigo_proyecto);
	 }
	 
	 	   /**
	  * Metodo que busca el formulario de desaduanizacion (DUI)
	  */
	 this.formularioListaDesaProv=function(codigo_proyecto){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.formularioListaDesaProv(codigo_proyecto);
	 }

	  	   /**
	  * Metodo que busca el formulario de desaduanizacion (DUI)
	  */
	 this.formularioDesaduanizacionProv=function(codigo_proyecto,cod_prov){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.formularioDesaduanizacionProv(codigo_proyecto,cod_prov);
	 }
	 
	  /**
	  * Metodo guardar el  formulario de desaduanizacion (DUI)
	  */
	 this.grabarFormularioDesaduanizacion=function(){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.grabarNuevaDesaduanizacion();
	 }

	   /**
	  * Metodo guardar el  formulario de desaduanizacion (DUI)
	  */
	 this.grabarNuevaDesaduanizacionProv=function(){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.grabarNuevaDesaduanizacionProv();
	 }


	   /**
	  * Metodo guardar el  formulario de desaduanizacion (DUI)
	  */
	 this.formularioDetallarDesa=function(id_desa, codigo_proyecto,cod_prov){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.formularioDetallarDesa(id_desa, codigo_proyecto,cod_prov);
	 }

	    /**
	  * Metodo guardar el  formulario de desaduanizacion (DUI)
	  */
	 this.modificarDetalleDesaProv=function(id_desa, codigo_proyecto,cod_prov){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.modificarDetalleDesaProv(id_desa, codigo_proyecto,cod_prov);
	 }

	     /**
	  * Metodo guardar el  formulario de desaduanizacion (DUI)
	  */
	 this.procesarDesa=function(codigo_proyecto,estado_proyecto){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.procesarDesa(codigo_proyecto,estado_proyecto);
	 }

	      /**
	  * Metodo guardar el  formulario de desaduanizacion (DUI)
	  */
	 this.darBajaDesa=function(id_desa, codigo_proyecto){
		 //alert("grabar");
		  var desaduanizacion = new Desaduanizacion();
		  desaduanizacion.darBajaDesa(id_desa, codigo_proyecto);
	 }
	
	
	/**
	  * Metodo que busca el formulario de Lista de Detalle de Liquidacion de la Poliza
	  */
	 this.listaDetOpciones=function(codigo_proyecto){
		// alert(codigo_proyecto);
		  var detalle_liquidacion = new DetalleLiquidacion();
		 detalle_liquidacion.listaDetOpciones(codigo_proyecto);
	 }

	 	/**
	  * Metodo que busca el formulario de Lista de Detalle de Liquidacion de la Poliza
	  */
	 this.formularioListaDetalleLiquidacion=function(codigo_proyecto){
		// alert(codigo_proyecto);
		  var detalle_liquidacion = new DetalleLiquidacion();
		 detalle_liquidacion.formularioListaDetalleLiquidacion(codigo_proyecto);
	 }

	/**
	  * Metodo que busca el formulario de Detalle de Liquidacion de la Poloza
	  */
	 this.formularioDetalleLiquidacion=function(id_liquidacion, codigo_proyecto){
		// alert(codigo_proyecto);
		  var detalle_liquidacion = new DetalleLiquidacion();
		 detalle_liquidacion.formularioDetalleLiquidacion(id_liquidacion,codigo_proyecto);
	 }

	 	/**
	  * Metodo que busca el formulario de Detalle de Liquidacion de la Poloza
	  */
	 this.formularioDetalleLiquidacionCons=function(codigo_proyecto){
		// alert(codigo_proyecto);
		  var detalle_liquidacion = new DetalleLiquidacion();
		 detalle_liquidacion.formularioDetalleLiquidacionCons(codigo_proyecto);
	 }

	 /**
	  * Metodo para dar procesar los detalles de liquidacion y cambiar de estado
	  */
	
	 this.procesarLiquidacion=function(codigo_proyecto,estado_proyecto){
		 //alert(codigo_proyecto+estado_proyecto);
		var detalle_liquidacion = new DetalleLiquidacion();
		detalle_liquidacion.procesarLiquidacion(codigo_proyecto, estado_proyecto);
	 }

	 
	  /**
	   * Metodo que permite hacer referencia al formulario de nuevo item
	   */
	this.nuevoItemOrdenCompra = function(){
		var nuevo_item = new ItemOrdenCompra();
		nuevo_item.nuevoItemOrdenCompra();
	}

	/**
	  * Metodo que formulario detallar los certificados
	  */
	
	 this.formularioDetallarCertificado=function(id_certificado, codigo_proyecto){
		 //alert(id_certificado+codigo_proyecto);
		  var certificado = new Certificado();
		  certificado.formularioDetallarCertificado(id_certificado, codigo_proyecto);
	 }

	 /**
	  * Metodo que formulario detallar los certificados
	  */
	
	 this.formularioDetallarCertificadoProv=function(id_certificado, codigo_proyecto,cod_prov){
		 //alert(id_certificado+codigo_proyecto);
		  var certificado = new Certificado();
		  certificado.formularioDetallarCertificadoProv(id_certificado, codigo_proyecto,cod_prov);
	 }
	/*
	 * Metodo que permite grabar el nuevo item
	 */
	this.grabarNuevoItemComprado = function(){
		var nuevo_item = new ItemOrdenCompra();
		nuevo_item.grabarNuevoItemComprado();
	}

	  /**
	  * Metodo que formulario modificar los certificados
	  */
	
	 this.modificarDetalleCertificado=function(id_certificado, codigo_proyecto){
		 //alert(id_certificado+codigo_proyecto);
		 var certificado = new Certificado();
		 certificado.modificarDetalleCertificado(id_certificado, codigo_proyecto);
	 }

	   /**
	  * Metodo que formulario modificar los certificados
	  */
	
	 this.modificarDetalleCertificadoProv=function(id_certificado, codigo_proyecto,cod_prov){
		 //alert(id_certificado+codigo_proyecto);
		 var certificado = new Certificado();
		 certificado.modificarDetalleCertificadoProv(id_certificado, codigo_proyecto,cod_prov);
	 }
	 
	/**
	  * Metodo que lista el formulario de los proyectos que se pueden modificar
	  */
	
	 this.formularioListaModificaciones=function(id_certificado, codigo_proyecto){
		 //alert("Llegando a gestion");
		  var lista_modificacion = new ListaModificaciones();
		  lista_modificacion.formularioListaModificaciones(id_certificado, codigo_proyecto);
	 }
	 
	 /**
	  * Metodo que lista el formulario de los proyectos que se pueden modificar contrato
	  */
	
	 /*this.formularioModificarContrato=function(id_certificado, codigo_proyecto){
		 //alert("Llegando a contrato");
		  var lista_modificacion = new ListaModificaciones();
		  lista_modificacion.formularioModificarContrato(id_certificado, codigo_proyecto);
	 }*/

 	/**
	  * Metodo que lista el formulario de los proyectos que se pueden modificar contrato
	  */
	
	 this.modificarFormularioContrato=function(id_certificado, codigo_proyecto){
		 //alert("Llegando a contrato");
		  var modifica_contrato = new Contrato();
		  modifica_contrato.modificarFormularioContrato(id_certificado, codigo_proyecto);
	 }

	 /**
	  * Metodo para dar de baja a los certificados desde el detalle
	  */
	
	 this.darBajaCertificado=function(id_certificado, codigo_proyecto){
		 //alert(id_certificado+codigo_proyecto);
		 var certificado = new Certificado();
		 certificado.darBajaCertificado(id_certificado, codigo_proyecto);
	 }

	  /**
	  * Metodo para dar de baja a los certificados desde el detalle
	  */
	
	 this.darBajaCertificadoProv=function(id_certificado, codigo_proyecto){
		 //alert(id_certificado+codigo_proyecto);
		 var certificado = new Certificado();
		 certificado.darBajaCertificadoProv(id_certificado, codigo_proyecto);
	 }

	  /**
	  * Metodo para dar de baja a los certificados desde la lista
	  */
	
	 this.darBajaCertificadoLista=function(id_certificado, codigo_proyecto){
		 //alert(id_certificado+codigo_proyecto);
		 var certificado = new Certificado();
		 certificado.darBajaCertificadoLista(id_certificado, codigo_proyecto);
	 }


	  /**
	  * Metodo para dar procesar los certificados y cambiar de estado
	  */
	
	 this.procesarCertificado=function(codigo_proyecto,estado_proyecto){
		 //alert(codigo_proyecto+estado_proyecto);
		var certificado = new Certificado();
		certificado.procesarCertificado(codigo_proyecto, estado_proyecto);
	 }

	   /**
	  * Metodo para dar procesar los certificados y cambiar de estado
	  */
	
	 this.procesarCertificadoProv=function(codigo_proyecto,estado_proyecto){
		 //alert(codigo_proyecto+estado_proyecto);
		var certificado = new Certificado();
		certificado.procesarCertificadoProv(codigo_proyecto, estado_proyecto);
	 }





	  /**
	  * Metodo para cancelar detalle de los certificados
	  */
	
	 this.cancelarCertificado=function(){
		 //alert(codigo_proyecto+estado_proyecto);
		var certificado = new Certificado();
		certificado.cancelarCertificado();
	 }


	  /**
	  * Metodo para mostrar el detalle de la hoja de costa
	  */
	
	 this.formularioListaItems=function(codigo_proyecto,cod_prov){
		 //alert(codigo_proyecto);
		var hoja = new HojaCosto();
		hoja.formularioListaItems(codigo_proyecto,cod_prov);
	 }

	 	  /**
	  * Metodo para mostrar el detalle de la hoja de costa
	  */
	
	 this.formularioItemsAlmacen=function(id_item,codigo_proyecto,cod_prov){
		 //alert(codigo_proyecto);
		var hoja = new HojaCosto();
		hoja.formularioItemsAlmacen(id_item,codigo_proyecto,cod_prov);
	 }

	 	  /**
	  * Metodo para mostrar el detalle de la hoja de costa
	  */
	
	 this.serieDialog=function(id_item,nom_item,cant_item,codigo_proyecto){
		 //alert(codigo_proyecto);
		var hoja = new HojaCosto();
		hoja.serieDialog(id_item,nom_item,cant_item,codigo_proyecto);
	 }

	  	  /**
	  * Metodo para mostrar el detalle de la hoja de costa
	  */
	
	 this.grabarCabecera=function(id_item,codigo_proyecto,cod_prov){
		 //alert(codigo_proyecto);
		var hoja = new HojaCosto();
		hoja.grabarCabecera(id_item,codigo_proyecto,cod_prov);
	 }

	 	  	  /**
	  * Metodo grabar detalle con serie
	  */
	
	 this.grabarDetalleSerie=function(cant,cod_unico,cod_proy,cod_prod,cod_prov){
		 //alert(codigo_proyecto);
		var hoja = new HojaCosto();
		hoja.grabarDetalleSerie(cant,cod_unico,cod_proy,cod_prod,cod_prov);
	 }

	  /**
	  * Metodo para mostrar el detalle de la hoja de costa
	  */
	
	 this.generarCabeceraHoja=function(codigo_proyecto,nro_orden,cod_prov,cod_ref){
		 //alert(codigo_proyecto);
		var hoja = new HojaCosto();
		hoja.generarCabeceraHoja(codigo_proyecto,nro_orden,cod_prov,cod_ref);
	 }

	  /**
	  * Metodo para mostrar el detalle de la hoja de costa
	  */
	
	 this.actualizarDetalleHoja=function(){
		 //alert(codigo_proyecto);
		var hoja = new HojaCosto();
		hoja.actualizarDetalleHoja();
	 }

	   /**
	  * Metodo para mostrar el detalle de la hoja de costa
	  */
	
	 this.formularioHojaCosto=function(codigo_proyecto,nro_orden,cod_prov,cod_ref){
		 //alert(codigo_proyecto);
		var hoja = new HojaCosto();
		hoja.formularioHojaCosto(codigo_proyecto,nro_orden,cod_prov,cod_ref);
	 }

	   /**
	  * Metodo para cancelar detalle de los certificados
	  */
	
	 this.formularioListaHojaCosto=function(codigo_proyecto){
		 //alert(codigo_proyecto);
		var hoja = new HojaCosto();
		hoja.formularioListaHojaCosto(codigo_proyecto);
	 }
	  /**
	  * Metodo para dar procesar las hoja de costos y cambiar de estado
	  */
	
	 this.procesarHojaCosto=function(codigo_proyecto,estado_proyecto){
		// alert(codigo_proyecto+estado_proyecto);
		var hoja = new HojaCosto();
		hoja.procesarHojaCosto(codigo_proyecto, estado_proyecto);
	 }

	  /**
	  * Metodo para dar procesar las hoja de costos y cambiar de estado
	  */
	
	 this.cancelarHojaCosto=function(){
		// alert(codigo_proyecto+estado_proyecto);
		var hoja = new HojaCosto();
		hoja.cancelarHojaCosto();
	 }


}


