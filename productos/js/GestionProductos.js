// JavaScript Document
$(document).on("ready", function(){
	var productos = new GestionProductos();
	productos.inicio();
});

function GestionProductos(){
/**
	 * Metodo constructor
	 */
	this.inicio = function(){
		var util = new Utilitarios();
		var productos = new Productos();
		productos.init();
		
	}
	
	/**
	* Metodo que Crea nuevo Producto
	*/
	this.nuevoProducto = function(){
		//alert("lega");
		var formularioProductos = new Productos();
		formularioProductos.ingresoCabeceraProductos(); //listarCabeceraProductos(); //ingresoProductos();

	}
  
  /**
	* Metodo queModifica Producto
	*/
	this.ModificarProducto = function(codigo,nombre){
		//alert(codigo);
		var formularioModificaProductos = new Productos();
		formularioModificaProductos.modificarCabeceraProducto(codigo,nombre);
		//formularioModificaProductos.listarCabeceraProductosexistentes(codigo);
		

	}

	/**
	* Metodo queModifica Producto
	*/
	this.EliminarProducto = function(codigo,nombre){
		//alert("lega");
		var formularioEliminaProductos = new Productos();
		//formularioEliminaProductos.eliminarCabeceraProducto(codigo,nombre);
		formularioEliminaProductos.desabilitarProducto(codigo,nombre);
		

	}

	/**
	* Metodo que busca los productos mediante un boton
	*/
	this.buscarProductoBtn = function(){
		//alert($('#producto_buscar').val());
		var busqueda_productos = new Productos();
		busqueda_productos.buscarProductoBtn($('#producto_buscar').val());

	}
}