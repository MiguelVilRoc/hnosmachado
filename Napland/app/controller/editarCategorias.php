<?php
include_once Path::MODEL_BASE;
include_once Path::CLASS_CATEGORIA;

if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") { //Comprobamos que el usuario que accede aquí sea admin
    require Path::VIEW_ERROR_404;
} else {
    $listaDatosCategorias = Base::listadoCategoriasDetalle();

    $listaCategorias = array();

    foreach($listaDatosCategorias as $datosCategoria) {
        $listaCategorias[] = new Categoria($datosCategoria);
    }


   include_once Path::VIEW_EDITAR_CATEGORIAS;
}
?>