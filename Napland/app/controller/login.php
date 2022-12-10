<?php
if(!isset($_SESSION["usuario"])) {
    $tituloPagina = "Inicio Sesión";
    require_once Path::VIEW_INICIO_SESION;
} else {
    echo "<h2>Ya has iniciado sesión</h2>";
    echo '<h4><a href="'.Redirect::PRINCIPAL.'">Ir a página principal</a></h4>';
    echo '<h4><a href="'.Redirect::PRINCIPAL.'">Cerrar sesión</a></h4>'; //cambia la redireccion de esto
}
?>