<?php
if(!isset($_SESSION["usuario"])) {
    include_once Path::VIEW_ERROR_404;
} else {
    $filtros = array();
    $usuario = $_SESSION["usuario"];

    extract($_POST);

    if(isset($filtroDesde) && $filtroDesde != "") {
        $filtros['filtroDesde'] = $filtroDesde; 
    }

    if(isset($fitroHasta) && $filtroHasta != "") {
        $filtros['filtroHasta'] = $filtroHasta;
    }
  
    if(!$usuario->getAdministrador) {
        $filtroId = $usuario->getId();
        $filtros["filtroId"] = $filtroId;
    } 

    $arrayDatos = Base::listadoPedidos($filtros); 



}



?>