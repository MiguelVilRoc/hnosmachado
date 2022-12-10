<?php 
include_once Path::MODEL_BASE;

//comprobamos si el usuario que accede aquí es admin
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") {
    require Path::VIEW_ERROR_404;
} else {

    $idProducto = $_POST["idProducto"];
    $mensajeError;
    $mensajeExito;
    $seBorroImagen = false;
    $seBorroProducto = false;
    if($idProducto > -1) {
        $seBorroImagen = Base::borrarImagenProducto($idProducto);
        $seBorroProducto = Base::borrarProducto($idProducto);
    }

    if($seBorroProducto) {
        $mensajeExito = "Producto borrado con éxito";
        if(!$seBorroImagen) {
            $mensajeError = "Hubo problemas y no se pudo borrar la imagen del producto de la base de datos";
        }
    }

    else {
        $mensajeError = "Error: No pudo borrarse el producto con id "+$idProducto;
    }

include_once Path::CONTROLLER_LISTADO_PRODUCTOS;

}

?>