<?php
//echo "<pre>";
//print_r($_REQUEST);
//echo "</pre>";

extract($_POST);

/******************************************************************************************/
//Aquí se procesarán los datos recibidos para crear nuevos usuarios o editar los existentes
/******************************************************************************************/
//Primero comprobamos que la id del usuario a modificar no se haya manipulado maliciosamente 
$hayUsuarioLog = isset($_SESSION["usuario"]);
$idUsuarioLog = "null";
$esAdmin = "null";

if($hayUsuarioLog) {
$idUsuarioLog = $_SESSION["usuario"]->getId();
$esAdmin = $_SESSION["usuario"]->getAdministrador();
}
//echo "DEBUG: la id recibida es ".$id.", la id del usuario log es ".$idUsuarioLog." y el usuario es admin:".$esAdmin;

if(
    (!$hayUsuarioLog && $id != "-1") ||
    ($hayUsuarioLog && $id != $idUsuarioLog && !$esAdmin)
    ) {
        $error = "Se ha producido un fallo de seguridad. Se han manipulado o corrompido los datos a modificar";
        include Path::VIEW_ERROR;    
    } else {
//Si la ip está en orden, se procede a la validación de datos en el lado del servidor
    include Path::COMMON_VALIDATOR;
    $validador = new Validator();
    $validador->validarDatosUsuario($_POST);
        if(!$validador->todoOk) {
            $error = $validador->erroresToString();
            include Path::VIEW_ERROR;
        } else {
//Una vez está todo validado, se procede a la inserción en la base de datos de los cambios (creación o edición)
        include Path::MODEL_BASE;
        //antes de crear un usuario debemos comprobar si ya existe alguno con el mismo email o dni      
        if($id == "-1" && Base::existeUsuario($email,$dni)) {
            $error = "Ya existe un usuario con ese correo y/o DNI";
            include Path::VIEW_ERROR;
        } else {
        $resultado = Base::actualizarUsuario($_POST);
        if($resultado == 0) {
            if($id=="-1") {
            $exitomsg = "Usuario creado con éxito";
        }
            else {
            $exitomsg = "Usuario modificado con éxito";
            $_SESSION['usuario'] = new Usuario($_POST);
        }
        include Path::VIEW_EXITO;
        } else {
            $error = "Se ha producido un fallo durante la modificación de información en la base de datos";
            include Path::VIEW_ERROR;
        }
    }

    
        
        }

    }


//  header("Location:".Redirect::ERROR);  

?>