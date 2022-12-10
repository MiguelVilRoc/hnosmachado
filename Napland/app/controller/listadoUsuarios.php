<?php 

include_once Path::CLASS_USUARIO;
include_once Path::MODEL_BASE;


if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") {
    require Path::VIEW_ERROR_404;
} else {

    $filtros = array();

    if(isset($_POST["filtroNombre"]) && strlen($_POST["filtroNombre"])>0) {
        $filtros["filtroNombre"]= $_POST["filtroNombre"];
        $filtroNombre = $_POST["filtroNombre"];
    } else {
        $filtroNombre = "";
    }

    if(isset($_POST["filtroApellidos"]) && strlen($_POST["filtroApellidos"])>0) {
        $filtros["filtroApellidos"]= $_POST["filtroApellidos"];
        $filtroApellidos = $_POST["filtroApellidos"];
    } else {
        $filtroApellidos = "";
    }

    if(isset($_POST["filtroDireccion"]) && strlen($_POST["filtroDireccion"])>0) {
        $filtros["filtroDireccion"]= $_POST["filtroDireccion"];
        $filtroDireccion = $_POST["filtroDireccion"];
    } else {
        $filtroDireccion = "";
    }

    if(isset($_POST["filtroEmail"]) && strlen($_POST["filtroEmail"])>0) {
        $filtros["filtroEmail"]= $_POST["filtroEmail"];
        $filtroEmail = $_POST["filtroEmail"];
    } else {
        $filtroEmail = "";
    }

    if(isset($_POST["filtroAdministrador"])) {
        $filtros["filtroAdministrador"]= $_POST["filtroAdministrador"];
        $filtroAdministrador = $_POST["filtroAdministrador"];
    } else {
        $filtroAdministrador = false;
        $filtros["filtroAdministrador"] = $filtroAdministrador = false;
    }


    $listaDatosUsuarios = Base::listadoUsuarios($filtros);
    $listaUsuarios = array();
    foreach($listaDatosUsuarios as $datosUsuario) {
        $listaUsuarios[] = new Usuario($datosUsuario);
    }

   // echo "<pre>";
   // print_r($listaUsuarios);
   // echo "</pre>";
   include_once Path::VIEW_LISTADO_USUARIOS;

}

?>