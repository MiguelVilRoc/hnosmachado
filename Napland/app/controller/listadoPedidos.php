<?php
if(!isset($_SESSION["usuario"])) {
    include_once Path::VIEW_ERROR_404;
} else {
    include_once Path::MODEL_BASE;

    $filtros = array();
    $usuario = $_SESSION["usuario"];

    extract($_POST);

    if(isset($filtroDesde) && $filtroDesde != "") {
        $filtros['filtroDesde'] = $filtroDesde; 
    }

    if(isset($filtroHasta) && $filtroHasta != "") {
        $filtros['filtroHasta'] = $filtroHasta;
    }
  
    if(!$usuario->getAdministrador()) {
        $filtroId = $usuario->getId();
        $filtros["filtroId"] = $filtroId;
    } 

    $arrayDatos = Base::listadoPedidos($filtros);
    
    $date = new DateTime(); // Objeto fecha con la fecha y hora actual
    $fechaActual = $date->format('Y-m-d\TH:i:s'); 


 include_once Path::VIEW_LISTADO_PEDIDOS;
}



?>