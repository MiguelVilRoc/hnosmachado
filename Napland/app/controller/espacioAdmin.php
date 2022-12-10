<?php
//Comprobamos que el usuario sea administrador
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") {
    require Path::VIEW_ERROR_404;
} else {

    include Path::VIEW_ESPACIO_ADMIN;
}
?>