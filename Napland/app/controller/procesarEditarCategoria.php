<?php
include_once Path::MODEL_BASE;
include_once Path::CLASS_CATEGORIA;
include_once Path::COMMON_VALIDATOR;

if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") { //Comprobamos que el usuario que accede aquí sea admin
    require Path::VIEW_ERROR_404;
} else {
    $mensajeError;
    $mensajeExito;
    extract($_POST);
    //Validamos los datos en el servidor
    $validador = new Validator();
    $validador->esIdValida($id);
    $validador->noEstaVacio($nombre);
    $validador->noEstaVacio($descripcion);
    
    if($validador->todoOk) {
        $listaCategorias = Base::listadoCategorias();

        $nombreNoRepetido = true;
        foreach($listaCategorias as $clave=> $valor) {
            if($id != $clave && $valor == $nombre) {
                $nombreNoRepetido = false;
            }
        }
        if($nombreNoRepetido) {
            $resultado = Base::editarCategoria($_POST);
            if($resultado){
                $mensajeExito = "Categoría modificada correctamente";
            } else {
                $mensajeError = "Hubo problemas al guardar la categoría en la BD";
            }
        } else {
            $mensajeError = "Ya existe una categoría con el nombre: ".$nombre;
        }
    } else {
        $mensajeError = $validador->erroresToString();
    }


    include_once Path::CONTROLLER_EDITAR_CATEGORIAS;
}
?>