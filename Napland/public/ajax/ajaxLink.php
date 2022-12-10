<?php 
include_once "../../app/common/Path.php";
include_once Path::CONTROLLER_AJAX;
if(isset($_SESSION["carrito"])) {
    if(isset($_POST["accion"])) {
        $accion = $_POST["accion"];

        switch($accion) {
            case "anadir": anadirProducto($_POST["id"]); 
            break;
            case "eliminar": eliminarProducto($_POST["id"]);
            break;
            case "mostrar": mostrarCarrito();
            break;
            case "pintar": pintarCarrito();
            break;
            default: echo "Error Ajax: No hay respuesta para esa petición";
        }
    }
} else {
    echo "ERROR: no existe el carrito";
}

?>

