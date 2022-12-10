<?php
if(isset($_SESSION["tamanoCarrito"]) && $_SESSION["tamanoCarrito"]>0) {
    $_SESSION["carrito"] = array();
    $_SESSION["tamanoCarrito"] = 0;
}

header("location: ".Redirect::DETALLES_CARRITO);

?>