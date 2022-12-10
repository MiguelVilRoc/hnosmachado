<?php
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()) {
    $error = "Para acceder al pago hay que inicar sesión con un usuario registrado";
    require Path::VIEW_ERROR;
} elseif(!isset($_SESSION["carrito"]) || count($_SESSION["carrito"])<=0) {
    $error = "El carrito está vacío. No hay productos que procesar";
} else {
    include_once Path::MODEL_BASE;
    include_once Path::CLASS_PRODUCTO;

    $carrito = $_SESSION["carrito"];
   
    $precioTotal = 0;
    $arrayLineas = array();
    foreach($carrito as $linea) {
        $datosProducto = Base::getDatosProducto($linea["idProducto"]);
        $producto = new Producto($datosProducto);
        $nombre = $producto->getNombre();
        $cantidad = $linea["cantidad"];
        $precioUd = $producto->getPrecioUnitario();
        $precioUd = number_format($precioUd, 2, '.', '');
        $totalLinea = $cantidad*$precioUd;
        $totalLinea = number_format($totalLinea, 2, '.', '');
        $precioTotal += $totalLinea;
        $arrayLineas[] = array("nombre"=>$nombre, "precioUd"=>$precioUd, "cantidad"=>$cantidad, "totalLinea"=>$totalLinea);
       // $arrayLineas[]= array("producto"=>$producto,"cantidad"=>$linea["cantidad"]);
       //echo "total linea: ".$totalLinea;
    }
    $usuario = $_SESSION["usuario"];
    $precioSinIva = $precioTotal/1.21;
    $precioSinIva = number_format($precioSinIva, 2, '.', '');
    $precioTotal = number_format($precioTotal, 2, '.', '');
    //echo "precio total: ".$precioTotal;
    $compraConfirmada = false;
    $numeroTarjeta = 0;
    if(isset($_POST["compraConfirmada"]) && $_POST["compraConfirmada"]) {
        $compraConfirmada = $_POST["compraConfirmada"];
        $numeroTarjeta = $_POST["tarjetaCredito"];
    }
    
    include_once Path::VIEW_CONFIRMAR_COMPRA;
    
}

?>