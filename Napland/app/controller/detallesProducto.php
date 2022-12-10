<?php 

include_once Path::CLASS_PRODUCTO;
include_once Path::MODEL_BASE;

 $wrongId = false;

    if(isset($_GET["idProducto"]) && $_GET["idProducto"] > -1) {
        $idProducto = $_GET["idProducto"];
        $datosProducto = Base::getDatosProducto($idProducto);
    
            if(empty($datosProducto)) {
                $error = "Esa Id de producto no existe.";
                $wrongId = true;
            } else {
                $editaProducto = new Producto($datosProducto);                
                $arrayIdProducto = array();
                $arrayIdProducto[] = $editaProducto->getId();
                //$listaFotos = Base::getFotoProductos($arrayIdProducto);
                //$fotoProducto = 'public/assets/img/image-not-found-icon.png';
                //if(!empty($listaFotos)) {
                //    $fotoProducto = $listaFotos[$editaProducto->getId()];
                //}
                $fotoProducto = Base::getFotoProducto($idProducto); 
            }
    
    if($wrongId) {      
        include_once Path::VIEW_ERROR;
    } else {
        //$listaCategorias = Base::listadoCategorias();
        include_once Path::VIEW_DETALLES_PRODUCTO;
    }
}

?>