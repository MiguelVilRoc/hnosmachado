<?php 
include_once Path::MODEL_BASE;
include_once Path::COMMON_VALIDATOR;
//comprobamos si el usuario que accede aquí es admin
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") {
    require Path::VIEW_ERROR_404;
} else {
$mensajeError;
$mensajeExito;
$idCategoria = $_POST["idCategoria"];
$nombreCategoria = Base::getNombreCategoria($idCategoria);

$validador = new Validator();
$validador->esIdValida($idCategoria);

if($validador->todoOk) {
    $filtros = array();
    $filtros["filtroCategoria"] = $idCategoria;
    $listaDatosProductos = Base::listadoProductos($filtros);
    //echo "<pre>";
    //print_r($listaDatosProductos);
    //echo "</pre>";
    if(count($listaDatosProductos)>0) {
        $mensajeError = "No puede haber ningún producto perteneciente a la categoría ".$nombreCategoria." antes de borrarla.";
    } else {
        if(Base::borrarCategoria($idCategoria)) {
            $mensajeExito = "Se borró la categoría ".$nombreCategoria." del sistema"; 
        } else {
            $mensajeError = "Hubo un problema al borrar la categoría ".$nombreCategoria;
        }
    }

} else {
    $mensajeError = "Esa id no es válida";
}
include_once Path::CONTROLLER_EDITAR_CATEGORIAS;

}

?>