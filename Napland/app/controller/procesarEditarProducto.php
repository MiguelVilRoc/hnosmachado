<?php 
include_once Path::MODEL_BASE;
include_once Path::CLASS_PRODUCTO;

/******************************************************************************************/
//Aquí se procesarán los datos recibidos para crear nuevos productos o editar los existentes
/******************************************************************************************/

//Comprobamos que el usuario que accede aquí es un administrador
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") {
    require Path::VIEW_ERROR_404;
} else {

//Extraemos los datos de $_POST y de $_FILES

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

//echo "<pre>";
//print_r($_FILES);
//echo "</pre>";

extract($_POST);

//$idProducto = $_POST["idProducto"];
$nuevaImagen = $_FILES["nuevaImagen"];

//$noHayNuevaImagen = $nuevaImagen["error"] == 4;
$nombreCategoria = Base::getNombreCategoria($selectCategoria);

//Una vez extraídos los datos del producto, los introducimos en un array con los nombres adecuados para los métodos del modelo

$datos = array();
$datos["id"] = $idProducto;
$datos["nombre"] = $nombreProducto;
$datos["ancho"] = $anchoInput;
$datos["largo"] = $largoInput;
$datos["descripcion"] = $descripcionProducto;
$datos["stock"] = $stockInput;
$datos["id_categoria"] = $selectCategoria;
$datos["nombre_categoria"] = $nombreCategoria;
$datos["precio_unitario"] = $precioInput;


//Validamos los datos
include Path::COMMON_VALIDATOR;
$validador = new Validator();
$validador->validarDatosProducto($datos);
//validamos que la imagen, si es que hay, no de errores
$validador->validarImagen($nuevaImagen);

$mensajeExito = "";
$mensajeError = "";
$mensajeErrorImagenDB = "";

$siguientePath;
$volverAEditarProducto = false;

if($validador->todoOk) {
    $resultado = Base::actualizarProducto($datos);
    if($resultado["errorno"] == 0) {
        
        $idProductoModificado = $resultado["idProducto"];

        if($idProducto == -1) {
            $mensajeExito = "Producto creado con éxito.";  //VAMOS A OPCIONES DE ADMIN 
            $siguientePath = Path::CONTROLLER_ESPACIO_ADMIN;
        } else {
            $mensajeExito = "Producto modificado con éxito."; //DEBERÍA VOLVER A LA PÁGINA DETALLE DEL PRODUCTO
            $editaProducto = new Producto($datos);
            $fotoProducto = Base::getFotoProducto($editaProducto->getId());
            $_GET["idProducto"] = $editaProducto->getId();
            $siguientePath = Path::CONTROLLER_DETALLES_PRODUCTO;
        }

        //Comprobamos si se ha subido una nueva imagen
        $hayNuevaImagen = $nuevaImagen["error"] == UPLOAD_ERR_OK;

        if($hayNuevaImagen) {
            $arrayResultadoFoto =  Base::subirFotoProducto($idProductoModificado, $nuevaImagen);
            if($arrayResultadoFoto["error"]) {
                $mensajeErrorImagenDB = "Se produjo el siguiente problema con la imagen: ".$arrayResultadoFoto["mensajeError"]." Puede no seleccionar ninguna imagen si así lo desea."; //VOLVEMOS A EDITAR
                $datos["id"] = $idProductoModificado;
                $volverAEditarProducto = true;
            }
        }

    } else { //Si no se pudo actualizar el producto
        $mensajeError = "Se produjo un problema al grabar información del producto en la base de datos."; //VOLVEMOS A EDITAR
        $volverAEditarProducto = true;
    }
    
} else { //Si no se pasó la validación de datos
    $mensajeError = $validador->erroresToString(); //VOLVEMOS A EDITAR
    $volverAEditarProducto = true;
}

if($volverAEditarProducto) {
    $editaProducto = new Producto($datos);
    $fotoProducto = Base::getFotoProducto($editaProducto->getId());
    $listaCategorias = Base::listadoCategorias();
    $siguientePath = Path::CONTROLLER_EDITAR_PRODUCTO;
}

include_once $siguientePath;


    


}

?>