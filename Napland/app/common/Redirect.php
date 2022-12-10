<?php

class Redirect {
//claves para la redirección de páginas. Es el valor que se pasará por GET al controlador redirect.php
    const KEY_PRINCIPAL = "principal";
    //const KEY_REGISTRO_USUARIO = "registro";
    const KEY_INICIO_SESION = "iniciarSesion";
    const KEY_ERROR_404 = "pageNotFound";
    const KEY_ERROR = "error";
    const KEY_EXITO = "exito";
    const KEY_COMPROBAR_USUARIO = "comprobarUsuario";
    const KEY_CERRAR_SESION = "cerrarSesion";
    const KEY_LISTADO_PRODUCTOS = "listadoProductos";
    const KEY_DATOS_USUARIO = "datosUsuario";
    const KEY_PROCESAR_DATOS_USUARIO = "procesarDatosUsuario";
    const KEY_ESPACIO_USUARIO = "espacioUsuario";
    const KEY_ESPACIO_ADMIN = "espacioAdmin";
    const KEY_EDITAR_PRODUCTO = "editarProducto";
    const KEY_PROCESAR_EDITAR_PRODUCTO = "procesarEditarProducto";
    const KEY_BORRAR_PRODUCTO = "borrarProducto";
    const KEY_DETALLES_PRODUCTO = "detallesProducto";
    const KEY_LISTADO_USUARIOS = "listadoUsuarios";
    const KEY_EDITAR_CATEGORIAS = "editarCategorias";
    const KEY_PROCESAR_EDITAR_CATEGORIA = "procesarEditarCategoria";
    const KEY_BORRAR_CATEGORIA = "borrarCategoria";
    const KEY_DETALLES_CARRITO = "detallesCarrito";
    const KEY_PAGAR = "pagar";
    const KEY_REALIZAR_COMPRA = "realizarCompra";
    const KEY_LISTADO_PEDIDOS = "listadoPedidos";
    const KEY_VACIAR_CARRITO = "vaciarCarrito";
    
    
//enlaces para la redirección de páginas desde las vistas
    const PRINCIPAL = ".?page=".self::KEY_PRINCIPAL;
    //const REGISTRO_USUARIO = ".?page=".self::KEY_REGISTRO_USUARIO;
    const INICIO_SESION = ".?page=".self::KEY_INICIO_SESION;
    const ERROR_404 = ".?page=".self::KEY_ERROR_404;
    const ERROR = ".?page=".self::KEY_ERROR;
    const EXITO = ".?page=".self::KEY_EXITO;
    const COMPROBAR_USUARIO = ".?page=".self::KEY_COMPROBAR_USUARIO;
    const CERRAR_SESION = ".?page=".self::KEY_CERRAR_SESION;
    const LISTADO_PRODUCTOS = ".?page=".self::KEY_LISTADO_PRODUCTOS;
    const DATOS_USUARIO = ".?page=".self::KEY_DATOS_USUARIO;
    const PROCESAR_DATOS_USUARIO = ".?page=".self::KEY_PROCESAR_DATOS_USUARIO; 
    const ESPACIO_USUARIO = ".?page=".self::KEY_ESPACIO_USUARIO;
    const ESPACIO_ADMIN = ".?page=".self::KEY_ESPACIO_ADMIN;
    const EDITAR_PRODUCTO = ".?page=".self::KEY_EDITAR_PRODUCTO;
    const PROCESAR_EDITAR_PRODUCTO = ".?page=".self::KEY_PROCESAR_EDITAR_PRODUCTO;
    const BORRAR_PRODUCTO = ".?page=".self::KEY_BORRAR_PRODUCTO;
    const DETALLES_PRODUCTO = ".?page=".self::KEY_DETALLES_PRODUCTO;
    const LISTADO_USUARIOS = ".?page=".self::KEY_LISTADO_USUARIOS;
    const EDITAR_CATEGORIAS = ".?page=".self::KEY_EDITAR_CATEGORIAS;
    const PROCESAR_EDITAR_CATEGORIA = ".?page=".self::KEY_PROCESAR_EDITAR_CATEGORIA;
    const BORRAR_CATEGORIA = ".?page=".self::KEY_BORRAR_CATEGORIA;
    const DETALLES_CARRITO = ".?page=".self::KEY_DETALLES_CARRITO;
    const PAGAR = ".?page=".self::KEY_PAGAR;
    const REALIZAR_COMPRA = ".?page=".self::KEY_REALIZAR_COMPRA;
    const LISTADO_PEDIDOS = ".?page=".self::KEY_LISTADO_PEDIDOS;
    const VACIAR_CARRITO = ".?page=".self::KEY_VACIAR_CARRITO;
}
?>