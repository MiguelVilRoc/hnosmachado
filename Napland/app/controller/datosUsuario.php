<?php
$editaUsuario = null;
if(isset($_SESSION["usuario"])) {
$editaUsuario = $_SESSION["usuario"];
}
else {
    $datosVacios = array();
    $datosVacios["id"] = -1;
    $datosVacios["dni"] = "";
    $datosVacios["nombre"] = "";
    $datosVacios["apellidos"] = "";
    $datosVacios["direccion"] = "";
    $datosVacios["email"] = "";
    $datosVacios["password"] = "";
    $datosVacios["administrador"] = false;

    $editaUsuario = new Usuario($datosVacios);
}

require Path::VIEW_DATOS_USUARIO;
?>