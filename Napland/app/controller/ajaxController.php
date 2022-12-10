<?php 
include_once Path::COMMON_AJAX_SESSION;


function anadirProducto($id) {

    if(isset($_SESSION["carrito"]) && (is_numeric($id) && $id > 0)) {
        $lineaEncontrada = false;
        foreach($_SESSION["carrito"] as &$linea) { //Paso la línea por referencia para que cambien los valores de sus elementos
            if($linea["idProducto"] == $id) {
                $linea["cantidad"]++;
                $lineaEncontrada = true;
                //echo "cantidad: " .$linea["cantidad"] . "<br>";
            }
        }
        if(!$lineaEncontrada) {
            $_SESSION["carrito"][] = array("idProducto"=>$id, "cantidad"=>1);
        }
        $_SESSION["tamanoCarrito"]++;
    }

    echo $_SESSION["tamanoCarrito"];
} 

function eliminarProducto($id) {
    if(isset($_SESSION["carrito"]) && (is_numeric($id) && $id > 0)) {
        //$lineaEncontrada = false;
        foreach($_SESSION["carrito"] as $clave=>&$linea) { //Paso la línea por referencia para que cambien los valores de sus elementos
            if($linea["idProducto"] == $id) {
                if($linea["cantidad"]>1) {
                    $linea["cantidad"]--;
                } else {
                    unset($_SESSION["carrito"][$clave]);
                }
                $_SESSION["tamanoCarrito"]--;
                //$lineaEncontrada = true;
                //echo "cantidad: " .$linea["cantidad"] . "<br>";
            }
        }
    }
    //print_r($_SESSION["carrito"]);
    //echo "cantidad: ". $_SESSION["tamanoCarrito"];
    echo $_SESSION["tamanoCarrito"];
}

function mostrarCarrito() {
    echo json_encode($_SESSION["carrito"]);
}

function pintarCarrito() {
    $ajaxCall = true;
    include_once Path::MODEL_BASE_AJAX;
    include_once Path::CLASS_PRODUCTO_AJAX;
    include_once Path::CONTROLLER_GENERAR_ARRAY_CARRITO_AJAX;
    include_once Path::VIEW_TABLA_CARRITO_AJAX;
}

?>