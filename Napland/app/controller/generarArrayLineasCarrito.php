<?php
 $arrayLineas = array();
if(isset($_SESSION["carrito"]) && count($_SESSION["carrito"])>0){
    $carrito = $_SESSION["carrito"];
   
    foreach($carrito as $linea) {
        $datosProducto = Base::getDatosProducto($linea["idProducto"]);
        $producto = new Producto($datosProducto);
        $arrayLineasCarrito[]= array("producto"=>$producto,"cantidad"=>$linea["cantidad"]);
    }
}
?>