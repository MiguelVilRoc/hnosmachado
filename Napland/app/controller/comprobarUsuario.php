<?php
include_once Path::MODEL_BASE;
$email = $_POST["loginMail"];
$password = $_POST["loginPassword"];


$datosUsuario = Base::comprobarUsuario($email,$password);

if(!empty($datosUsuario)) {

    $nuevoUsuario = new Usuario($datosUsuario);
    $_SESSION["usuario"] = $nuevoUsuario;
    if(!$_SESSION["usuario"]->getAdministrador()) {
        $_SESSION["carrito"] = array();
        $_SESSION["tamanoCarrito"] = 0; //Agrego esta variable de sesión para no hacer al servidor contar todos los elementos cada vez que haya un cambio en el carrito
    }                                   //Ya que habría que recorrerlo entero e ir sumando todas las cantidades. Así creo que es más sencillo y eficiente.
    header("Location: ".Redirect::PRINCIPAL);
} else {
    include Path::VIEW_USUARIO_NO_EXISTENTE;
}

?>