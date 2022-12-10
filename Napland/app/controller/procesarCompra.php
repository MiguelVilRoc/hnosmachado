<?php
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador() || $_SESSION["tamanoCarrito"] <= 0) {
    $error = "No es posible procesar esta acción";
    include_once Path::VIEW_ERROR;
} else {
    include_once Path::CLASS_PRODUCTO;
    include_once Path::MODEL_BASE;

    $id_cliente = $_SESSION["usuario"]->getId();
    $carrito = $_SESSION["carrito"];
    $datos = array();
    $datos["id_cliente"] = $id_cliente;
    $datos["lineas"] = array();
    $num_linea = 0;

    //para el ticket
    $arrayLineas = array();
    $precioTotal = 0;

    foreach($carrito as $linea) {
        $num_linea++;
        $datosProducto = Base::getDatosProducto($linea["idProducto"]);
        $producto = new Producto($datosProducto);
        
        $id_producto = $producto->getId();
        $cantidad = $linea["cantidad"];
        $precio_unitario = $producto->getPrecioUnitario();

        $datos["lineas"][] = array("num_linea"=>$num_linea, "id_producto"=>$id_producto, "cantidad"=>$cantidad, "precio_unitario"=>$precio_unitario);

        //para el ticket
        $totalLinea = $producto->getPrecioUnitario()*$cantidad;
        $precioTotal += $totalLinea;
        $totalLinea =  number_format($totalLinea, 2, '.', '');
        $arrayLineas[] = array("nombre"=>$producto->getNombre(),"precioUd"=>$producto->getPrecioUnitario(),"cantidad"=>$cantidad,"totalLinea"=> $totalLinea);
    }

    $resultado = Base::guardarPedido($datos);

    if (!$resultado["todoOk"]) {
        $mensajeError = "Se produjo un error al registrar la compra.";
        include_once Path::CONTROLLER_DETALLES_CARRITO;
    } else {
        $id_pedido = $resultado["id_pedido"];
        $fecha = date_create($resultado["fecha"]);
        $fecha = date_format($fecha, "d-m-Y H:i:s");
        $precioSinIva = $precioTotal / 1.21;
        $precioSinIva = number_format($precioSinIva, 2, '.', '');
        $precioTotal =  number_format($precioTotal, 2, '.', '');
        $_SESSION["carrito"] = array();
        $_SESSION["tamanoCarrito"] = 0;
        include_once Path::VIEW_TICKET;
    }



}



?>