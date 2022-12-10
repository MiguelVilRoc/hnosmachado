<?php
include_once Path::CLASS_USUARIO;
include_once Path::COMMON_SESSION;
include_once Path::COMMON_REDIRECT;


if(isset($_GET["page"])) {
    $nextPage = $_GET["page"];
    //echo "NEXT PAGE: ".$nextPage;
}
else {
    //echo "Se va al principal";
    $nextPage = Redirect::KEY_PRINCIPAL;
} 

switch($nextPage) {
    case Redirect::KEY_PRINCIPAL: $redirectPath = Path::CONTROLLER_PRINCIPAL;
    break;
    //case Redirect::KEY_REGISTRO_USUARIO: $redirectPath = Path::CONTROLLER_ALTA_USUARIO;
    //break;
    case Redirect::KEY_INICIO_SESION: $redirectPath = Path::CONTROLLER_INICIO_SESION;
    break;
    case Redirect::KEY_COMPROBAR_USUARIO: $redirectPath = Path::CONTROLLER_COMPROBAR_USUARIO;
    break;
    case Redirect::KEY_CERRAR_SESION: $redirectPath = Path::CONTROLLER_CERRAR_SESION;
    break;
    case Redirect::KEY_LISTADO_PRODUCTOS: $redirectPath = Path::CONTROLLER_LISTADO_PRODUCTOS;
    break;
    case Redirect::KEY_DATOS_USUARIO: $redirectPath = Path::CONTROLLER_DATOS_USUARIO;
    break;
    case Redirect::KEY_PROCESAR_DATOS_USUARIO: $redirectPath = Path::CONTROLLER_PROCESAR_DATOS_USUARIO;
    break;
    case Redirect::KEY_ERROR: $redirectPath = Path::VIEW_ERROR;
    break;
    case Redirect::KEY_EXITO: $redirectPath = Path::VIEW_EXITO;
    break;
    case Redirect::KEY_ESPACIO_USUARIO: $redirectPath = Path::CONTROLLER_ESPACIO_USUARIO;
    break;
    case Redirect::KEY_ESPACIO_ADMIN: $redirectPath = Path::CONTROLLER_ESPACIO_ADMIN;
    break;
    case Redirect::KEY_EDITAR_PRODUCTO: $redirectPath = Path::CONTROLLER_EDITAR_PRODUCTO;
    break;
    case Redirect::KEY_PROCESAR_EDITAR_PRODUCTO: $redirectPath = Path::CONTROLLER_PROCESAR_EDITAR_PRODUCTO;
    break;
    case Redirect::KEY_BORRAR_PRODUCTO: $redirectPath = Path::CONTROLLER_BORRAR_PRODUCTO;
    break;
    case Redirect::KEY_DETALLES_PRODUCTO: $redirectPath = Path::CONTROLLER_DETALLES_PRODUCTO;
    break;
    case Redirect::KEY_LISTADO_USUARIOS: $redirectPath = Path::CONTROLLER_LISTADO_USUARIOS;
    break;
    case Redirect::KEY_EDITAR_CATEGORIAS: $redirectPath = Path::CONTROLLER_EDITAR_CATEGORIAS;
    break;
    case Redirect::KEY_PROCESAR_EDITAR_CATEGORIA: $redirectPath = Path::CONTROLLER_PROCESAR_EDITAR_CATEGORIA;
    break;
    case Redirect::KEY_BORRAR_CATEGORIA: $redirectPath = Path::CONTROLLER_BORRAR_CATEGORIA;
    break;
    case Redirect::KEY_DETALLES_CARRITO: $redirectPath = Path::CONTROLLER_DETALLES_CARRITO;
    break;
    case Redirect::KEY_PAGAR: $redirectPath = Path::CONTROLLER_PAGAR;
    break;
    case Redirect::KEY_REALIZAR_COMPRA: $redirectPath = Path::CONTROLLER_PROCESAR_COMPRA;
    break;
    case Redirect::KEY_LISTADO_PEDIDOS: $redirectPath = Path::CONTROLLER_LISTADO_PEDIDOS;
    break;
    case Redirect::KEY_VACIAR_CARRITO: $redirectPath = Path::CONTROLLER_VACIAR_CARRITO;
    break;

    
    default: $redirectPath = Path::VIEW_ERROR_404;
}



include_once $redirectPath;

?>