<?php
class Validator {
    
    public $todoOk;
    public $errores;

    public function __construct() {
        $this->todoOk = true;
        $this->errores = array();
    }

    public function noEstaVacio($valor) {
        $noEstaVacio = !empty(trim($valor));
        $this->validarCampo($valor,$noEstaVacio);
    }

    public function checkRegEx($valor,$regEx) {
        return preg_match($regEx,$valor);
    }

    public function esEmail($valor) {
        $regEx = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i';
        $this->validarCampo($valor,preg_match($regEx,$valor));
    }

    public function esDni($valor) {
        $regEx = '/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i';
        $this->validarCampo($regEx,$valor);
    }

    public function sonIguales($valor,$valor2) {
        $sonIguales = trim($valor) == trim($valor2);
        $this->validarCampo($valor,$sonIguales);
    }

    public function estaChecked($valor) {
        $estaChecked = $valor == true;
        $this->validarCampo($valor,$estaChecked);
    }

    public function passwordFormatoOk($valor) {
        $regEx = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
        $this->validarCampo($valor,preg_match($regEx,$valor));
    }

    public function esIdValida($valor) {
        $esID = (is_numeric($valor) && $valor >= -1);
        $this->validarCampo($valor,$esID);
    }

    public function categoriaValida($valor) {
        $categoriaValida = (is_numeric($valor) && $valor > 0);
        $this->validarCampo($valor,$categoriaValida);
    }

    public function existeCampo($valor) {
        if(!isset($valor)) {
            $this->todoOk = false;
            $this->errores[] = "Faltan datos";
        }
    }

    public function esNumeroEnteroPositivo($valor) {
        $numeroEnteroPositivo = ($valor % 1 == 0 && $valor > 0);
        $this->validarCampo($valor, $numeroEnteroPositivo);
    }

    public function esNumeroDecimalpositivo($valor) {
        $regEx = '/^\d+(\.\d{1,2})?$/';
        $this->validarCampo($valor,preg_match($regEx,$valor));
    }

    public function validarImagen($imagen) {
        $errorImagen = $imagen["error"];
        switch($errorImagen) {
            case UPLOAD_ERR_INI_SIZE:
                $this->todoOk = false;
                $this->errores[] = "El fichero de imagen excede el tamaño máximo permitido (upload_max_filesize)."; 
            break;
            case UPLOAD_ERR_FORM_SIZE:
                $this->todoOk = false;
                $this->errores[] = "El fichero de imagen excede el tamaño máximo permitido (HTML Form).";
            break;
            case UPLOAD_ERR_PARTIAL:
                $this->todoOk = false;
                $this->errores[] = "El fichero de imagen fue procesado sólo parcialmente.";
            break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $this->todoOk = false;
                $this->errores[] = "No se ha encontrado un directorio temporal para el fichero de imagen.";
            break;
            case UPLOAD_ERR_CANT_WRITE:
                $this->todoOk = false;
                $this->errores[] = "Se produjo un fallo al escribir en disco el fichero de imagen.";
            break;
            case UPLOAD_ERR_EXTENSION:
                $this->todoOk = false;
                $this->errores[] = "Una extensión de PHP evitó que el fichero de imagen se almacenase correctamente.";
            break;
        }
        //validamos la extensión del fichero en caso de que la tenga
        $arrayPartesNombreImagen = explode(".",$imagen["name"]);
        if($this->todoOk && count($arrayPartesNombreImagen)>1) {
            $arrayExtensiones = ["jpg","jpeg","png"];
            $extensionFichero = end($arrayPartesNombreImagen);
            if(!in_array(strtolower($extensionFichero),$arrayExtensiones)) {
                $this->todoOk = false;
                $this->errores[] = "La extensión de la imagen debe ser jpg, jpeg o png.";
            }
        }

    }

    public function validarCampo($valor, $esValido) {
        if(!$esValido) {
            $this->todoOk = false;
            $this->errores[] = "ERROR: El valor ". $valor . " no tiene el formato correcto o no es válido.";
        }
       
    }

    public function validarDatosUsuario($datos) {
        extract($datos);

        $this->esEmail($email);
        $this->passwordFormatoOk($password);
        $this->sonIguales($password2,$password);
        $this->noEstaVacio($nombre);
        $this->noEstaVacio($apellidos);
        $this->esDni($dni);
        $this->noEstaVacio($direccion);
        $this->estaChecked($condiciones);


    }

    public function validarDatosProducto($datos) {
        extract($datos);
        $this->esIdValida($id);
        $this->noEstaVacio($nombre);
        $this->noEstaVacio($descripcion);
        $this->categoriaValida($id_categoria);
        $this->esNumeroEnteroPositivo($ancho);
        $this->esNumeroEnteroPositivo($largo);
        $this->esNumeroDecimalpositivo($precio_unitario);
        $this->esNumeroEnteroPositivo($stock);
    }

    public function erroresToString() {
        $resultado = "";
        foreach($this->errores as $tempError) {
            $resultado .= "<br>".$tempError;
        }
        return $resultado;
    }

}



?>