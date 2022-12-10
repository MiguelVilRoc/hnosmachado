<?php
include_once Path::VIEW_CABECERA;
?>

<div id="detallesProducto" class="container container-principal">

<?php
$datoPrecio = $editaProducto->getPrecioUnitario();
$precioParsed = floatval($datoPrecio);
$precioFormateado = number_format($precioParsed, 2, '.', '');
?>

<div class="detallesCabecera h2"><?=$editaProducto->getNombre()?></div>
<?php include Path::VIEW_MENSAJES_FEEDBACK ?>

    <div class="row mb-3 ms-1">
        <!--IMAGEN-->
        <div class="col-1 divImagenEditarProducto">
            <img id='imagenEditarProducto' class='imagenListadoProducto' alt='Imagen de producto' src='<?=$fotoProducto?>' onerror='this.src="public/assets/img/image-not-found-icon.png"' />
        </div>

        <div class="col-1"></div> <!--Separación-->

        <div class="mb-3 col-5">

        <!--Nombre producto-->
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="nombreProducto">Nombre del producto</label>
                    <div id="detallesNombreProducto"><?=$editaProducto->getNombre()?></div>
                </div>  
            </div>


            <!--Botones gestion-->

            <div class="row rowBotonesGestion">
                <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]->getAdministrador()) {?>
                <div class="col-1 btnGestion btnDetallesIzq"><a class="btn btn-primary" id="btnDetallesEditar" href="<?=Redirect::EDITAR_PRODUCTO."&idProducto=".$editaProducto->getId()?>">Editar</a></div>
                <form id="fmBorrarProducto" class="col-1" name="fmBorrarProducto" method="post" action="<?=Redirect::BORRAR_PRODUCTO?>">
                    <input type="hidden" name="idProducto" value="<?=$editaProducto->getId()?>">
                    <div class="btnGestion btnDetallesDer"><a class="btn btn-primary" id="btnDetallesBorrar" >Borrar</a></div>
                </form>
                <?php } elseif(isset($_SESSION["usuario"]) && !$_SESSION["usuario"]->getAdministrador())  {?>                   
                    <div class="btnGestion btnDetallesIzq"><a class="btn btn-primary" id="btnDetallesComprar" >Añadir a carrito</a></div>
                <?php }else{ ?>
                    <div class="btnGestion btnDetallesIzq"><a class="btn btn-primary" id="btnDetallesRegistrarse" href="<?=Redirect::INICIO_SESION?>">Comprar</a></div>
                <?php } ?>
            </div>

        </div>
    </div>



<!--Descripción-->

    <div class="row">

            <div class="col-md-9 mb-3">
                <label for="descripcionProducto" id="labelDescripcionProducto" class="mb-1">Descripción</label>
                <div id="detallesDescripcionProducto"><?=$editaProducto->getDescripcion()?></div>
            </div>

    </div>



    <div class="row mb-3">

        <!--Categoría-->
        <div id="divDetallesCategoria" class="col-3">
        <label for="detallesCategoria" class="mb-1">Categoría</label>
        <div id="detallesCategoria"><?=$editaProducto->getNombreCategoria()?></div>
        </div>

        <!--Medidas-->
        <div id="divDetallesMedidas" class="col-3">

        <label for="fieldSetDetallesMedidas" class="mb-1">Medidas</label>
            <fieldset id="fieldSetDetallesMedidas" class="border">
                <!--Ancho-->
                <label for="detallesAncho">Ancho (cm):</label>
                <div id="detallesAncho"><?=$editaProducto->getAncho()?></div>
                <!--Largo-->
                <label for="detallesLargo">Largo (cm):</label>
                <div id="detallesLargo"><?=$editaProducto->getLargo()?></div>
            </fieldset>          
        </div>

        <!--Precio unitario-->
        <div id="divDetallesPrecio" class="col-3">

            <label for="detallesPrecio" class="mb-1">Precio Unitario (euros):</label>
            <div id="detallesPrecio"><?=$precioFormateado?></div>

        </div>

        <!--Stock-->
        <div id="divDetallesStock" class="col-3">

            <label for="detallesStock" class="mb-1">Stock:</label>
            <div id="detallesStock"><?=$editaProducto->getStock()?></div>
        </div>


    </div>

  <a id="btnEditarProductoAtras" class="btn btn-primary" href="<?=Redirect::LISTADO_PRODUCTOS?>">Volver</a>

</div>

<!-- Ventana Modal -->
<div class="modal fade" id="confirmarBorrar" tabindex="-1" role="dialog" aria-labelledby="confirmarBorrarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmarBorrarLabel">¡Atención!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       ¿Está seguro de que desea borrar este producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Borrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>    
      </div>
    </div>
  </div>
</div>

<?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]->getAdministrador()) {?>
<script src="<?=Path::PUBLIC_JS_DETALLES_PRODUCTO?>"></script>
<?php } ?>
<?php
include_once Path::VIEW_PIE;
?>
