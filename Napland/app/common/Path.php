<?php

class Path {
//INICIO WEB
    const INICIO_APP = "index.php";
    const CONTROLLER_REDIRECT = "app/controller/redirect.php";

//Session
    const COMMON_SESSION = "app/common/session.php";
    const COMMON_AJAX_SESSION = "../../app/common/session.php";

//Redirect Class
    const COMMON_REDIRECT = "app/common/Redirect.php";

//Controllers
    const CONTROLLER_PRINCIPAL = "app/controller/principal.php";
    //const CONTROLLER_ALTA_USUARIO = "app/controller/registroUsuario.php";
    const CONTROLLER_INICIO_SESION = "app/controller/login.php";
    const CONTROLLER_CERRAR_SESION = "app/controller/logout.php";
    const CONTROLLER_COMPROBAR_USUARIO = "app/controller/comprobarUsuario.php";
    const CONTROLLER_LISTADO_PRODUCTOS = "app/controller/listadoProductos.php";
    const CONTROLLER_DATOS_USUARIO = "app/controller/datosUsuario.php";
    const CONTROLLER_PROCESAR_DATOS_USUARIO = "app/controller/procesarDatosUsuario.php";
    const CONTROLLER_ESPACIO_USUARIO = "app/controller/espacioUsuario.php";
    const CONTROLLER_ESPACIO_ADMIN = "app/controller/espacioAdmin.php";
    const CONTROLLER_EDITAR_PRODUCTO = "app/controller/editarProducto.php";
    const CONTROLLER_PROCESAR_EDITAR_PRODUCTO = "app/controller/procesarEditarProducto.php";
    const CONTROLLER_BORRAR_PRODUCTO = "app/controller/borrarProducto.php";
    const CONTROLLER_DETALLES_PRODUCTO = "app/controller/detallesProducto.php";
    const CONTROLLER_LISTADO_USUARIOS = "app/controller/listadoUsuarios.php";
    const CONTROLLER_EDITAR_CATEGORIAS = "app/controller/editarCategorias.php";
    const CONTROLLER_PROCESAR_EDITAR_CATEGORIA = "app/controller/procesarEditarCategoria.php";
    const CONTROLLER_BORRAR_CATEGORIA = "app/controller/borrarCategoria.php";
    const CONTROLLER_GENERAR_ARRAY_CARRITO = "app/controller/generarArrayLineasCarrito.php";
    const CONTROLLER_DETALLES_CARRITO = "app/controller/detallesCarrito.php";
    const CONTROLLER_PAGAR = "app/controller/pagar.php";
    const CONTROLLER_PROCESAR_COMPRA = "app/controller/procesarCompra.php";
    const CONTROLLER_LISTADO_PEDIDOS = "app/controller/listadoPedidos.php";
    const CONTROLLER_VACIAR_CARRITO = "app/controller/vaciarCarrito.php";
    
//CONTROLADORES AJAX
//(Llamado desde el ajaxLink público o su controlador)

    const CONTROLLER_AJAX = "../../app/controller/ajaxController.php"; 
    const CONTROLLER_GENERAR_ARRAY_CARRITO_AJAX = "../../app/controller/generarArrayLineasCarrito.php";


//Vistas
   // const VIEW_PRINCIPAL = "../view/principal.php";
    const VIEW_CABECERA = "app/view/cabecera.php";
    const VIEW_PIE = "app/view/pie.php";
    const VIEW_PRINCIPAL = "app/view/principal.php";
    const VIEW_INICIO_SESION = "app/view/login.php";
    const VIEW_ERROR_404 = "app/view/error404.php";
    const VIEW_ERROR = "app/view/error.php";
    const VIEW_EXITO = "app/view/exito.php";
    const VIEW_USUARIO_NO_EXISTENTE = "app/view/usuarioNoExistente.php";
    const VIEW_LISTADO_PRODUCTOS = "app/view/listadoProductos.php";
    const VIEW_DATOS_USUARIO = "app/view/datosUsuario.php";
    const VIEW_ESPACIO_USUARIO = "app/view/espacioUsuario.php";
    const VIEW_ESPACIO_ADMIN = "app/view/espacioAdmin.php";
    const VIEW_EDITAR_PRODUCTO = "app/view/editarProducto.php";
    const VIEW_DETALLES_PRODUCTO = "app/view/detallesProducto.php";
    const VIEW_LISTADO_USUARIOS = "app/view/listadoUsuarios.php";
    const VIEW_EDITAR_CATEGORIAS = "app/view/editarCategorias.php";
    const VIEW_TABLA_CARRITO = "app/view/tablaCarrito.php";
    const VIEW_DETALLES_CARRITO = "app/view/detallesCarrito.php";
    const VIEW_CONFIRMAR_COMPRA = "app/view/confirmarCompra.php";
    const VIEW_LISTADO_PEDIDOS = "app/view/listadoPedidos.php";
    const VIEW_TICKET = "app/view/ticket.php";

//***********VISTAS AJAX*********/
//(Llamado desde el ajaxLink público o su controlador)
const VIEW_TABLA_CARRITO_AJAX = "../../app/view/tablaCarrito.php";
    
//mensajes feedback
    const VIEW_MENSAJES_FEEDBACK = "app/view/mensajesFeedback.php";

//Model
    const MODEL_BASE = "app/model/Base.php";
    const MODEL_CONFIG = "app/model/Config.php";
    //**ajax**/
    const MODEL_BASE_AJAX = "../../app/model/Base.php";
    const MODEL_CONFIG_AJAX = "../../app/model/Config.php";




//Clases

    const CLASS_USUARIO = "app/common/classes/Usuario.php";
    const CLASS_PRODUCTO = "app/common/classes/Producto.php";
    const CLASS_CATEGORIA = "app/common/classes/Categoria.php";
    //**ajax**/
    const CLASS_PRODUCTO_AJAX = "../../app/common/classes/Producto.php";



//Validator

    const COMMON_VALIDATOR = "app/common/Validator.php";

//Bootstrap
    
    //const VIEW_BOOTSTRAP_CSS = "../view/bootstrap/css/bootstrap.min.css";
    //const VIEW_BOOTSTRAP_JS = "../view/bootstrap/js/bootstrap.bundle.min.js";
    const PUBLIC_BOOTSTRAP_CSS = "public/bootstrap/css/bootstrap.min.css";
    const PUBLIC_BOOTSTRAP_JS = "public/bootstrap/js/bootstrap.bundle.min.js";

//Jquery

    const PUBLIC_JQUERY_JS = "public/jquery/jquery-3.6.0.min.js";

//CSS
    //const VIEW_CSS_MAIN = "../view/css/napland.css";
    const PUBLIC_CSS_MAIN = "public/css/napland.css";

//JS
    const PUBLIC_JS_VALIDAR_DATOS_USUARIO = "public/js/validarDatosUsuario.js";
    const PUBLIC_JS_LISTADO_PRODUCTOS = "public/js/listadoProductos.js";
    const PUBLIC_JS_VALIDATOR = "public/js/Validator.js";
    const PUBLIC_JS_EDITAR_PRODUCTO = "public/js/editarProducto.js";
    const PUBLIC_JS_DETALLES_PRODUCTO = "public/js/detallesProducto.js";
    const PUBLIC_JS_LISTADO_USUARIOS = "public/js/listadoUsuarios.js";
    const PUBLIC_JS_EDITAR_CATEGORIAS = "public/js/editarCategorias.js";
    const PUBLIC_JS_DETALLES_CARRITO = "public/js/detallesCarrito.js";
    const PUBLIC_JS_CONFIRMAR_COMPRA = "public/js/confirmarCompra.js";

    //Cookies and XML library
    const PUBLIC_JS_COOKIES = "public/js/cookiesandxml.js";

    //Carrito
    const PUBLIC_JS_CARRITO = "public/js/carrito.js";
    

}

?>
