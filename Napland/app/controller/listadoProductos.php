<?php
include_once Path::CLASS_PRODUCTO;
include_once Path::MODEL_BASE;

$filtros = array();

//FILTROS. Se añaden los que se hayan elegido al array filtros para filtrar la consulta a BD
//y se le da el valor adecuado a la variable $filtro* para darle ese valor posteriormente a los inputs

if(isset($_POST["filtroCategoria"]) && $_POST["filtroCategoria"]>-1) {
    $filtros["filtroCategoria"]= $_POST["filtroCategoria"];
    $filtroCategoria = $_POST["filtroCategoria"];
} else {
    $filtroCategoria = "-1";
}

if(isset($_POST["filtroNombre"]) && strlen($_POST["filtroNombre"])>0) {
    $filtros["filtroNombre"]= $_POST["filtroNombre"];
    $filtroNombre = $_POST["filtroNombre"];
} else {
    $filtroNombre = "";
}

if(isset($_POST["filtroDescripcion"]) && strlen($_POST["filtroDescripcion"])>0) {
    $filtros["filtroDescripcion"]= $_POST["filtroDescripcion"];
    $filtroDescripcion = $_POST["filtroDescripcion"];
} else {
    $filtroDescripcion = "";
}


$listaCategorias = Base::listadoCategorias();
$listaDatosProductos = Base::listadoProductos($filtros);
$listaProductos = array();
$listaIds = array();
$listaFotos = array();


foreach($listaDatosProductos as $datosProducto) {
    $listaProductos[] = new Producto($datosProducto);
    $listaIds[] = $datosProducto["id"]; 
}

if(count($listaIds)>0) {
    $listaFotos = Base::getFotoProductos($listaIds);
}


require Path::VIEW_LISTADO_PRODUCTOS;
?>