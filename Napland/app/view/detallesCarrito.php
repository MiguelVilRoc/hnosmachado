<?php
include_once Path::VIEW_CABECERA;
?>

<div id="detallesCarrito" class="container container-principal">
    <div class="h2 cabeceraSeccion">Carrito de la compra</div>
    <?php include Path::VIEW_MENSAJES_FEEDBACK ?>
    
    <div id="divCarrito">
        <?php include_once Path::VIEW_TABLA_CARRITO;?>
    </div>

</div>


<?php
  include_once Path::VIEW_PIE;
?>

<!--Gestion del carrito-->
<?php if(!$_SESSION["usuario"]->getAdministrador()) {?>
  <script src="<?=Path::PUBLIC_JQUERY_JS?>"></script>
  <script src="<?=Path::PUBLIC_JS_CARRITO?>"></script>
  <script src="<?=Path::PUBLIC_JS_DETALLES_CARRITO?>"></script>
<?php }?>