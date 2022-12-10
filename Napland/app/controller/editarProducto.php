<?php 

include_once Path::CLASS_PRODUCTO;
include_once Path::MODEL_BASE;

if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") {
    require Path::VIEW_ERROR_404;
} else {

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
                $listaFotos = Base::getFotoProductos($arrayIdProducto);
                $fotoProducto = 'public/assets/img/image-not-found-icon.png';
                if(!empty($listaFotos)) {
                    $fotoProducto = $listaFotos[$editaProducto->getId()];
                } 
            }
    } else {
        $datos = array();
        $datos["id"] = -1;
        $datos["nombre"]="";
        $datos["ancho"]= 0;
        $datos["largo"]= 0;
        $datos["descripcion"]="";
        $datos["stock"]=0;
        $datos["id_categoria"]=-1;
        $datos["nombre_categoria"]="";
        $datos["precio_unitario"]="";
        $editaProducto = new Producto($datos);
        $fotoProducto = 'public/assets/img/image-not-found-icon.png';
    }

    if($wrongId) {      
        require Path::VIEW_ERROR;
    } else {
        $listaCategorias = Base::listadoCategorias();
        require Path::VIEW_EDITAR_PRODUCTO;
    }
}

?>