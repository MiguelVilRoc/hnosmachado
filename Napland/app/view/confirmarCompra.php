<?php
include_once Path::VIEW_CABECERA;
?>

<div class="container container-principal">

<?php if(!$compraConfirmada) { ?>
    <div class="h2 mb-5">Definir método de pago</div>
<?php } else { ?>
<div class="h2 mb-5">Confirmar compra</div>
<?php } ?>

<div id="listaProductos">
    <table id="tablaCarrito" class="table">
    <thead>
        <tr>
            <th>Producto</th>
            <th class="centrado">Precio ud (IVA inc)</th>
            <th class="centrado">Cantidad</th>
            <th class="centrado">Total</th>
        </tr>
    </thead>

    <tbody>

    </tbody>
    <?php foreach($arrayLineas as $linea){ ?>
        <tr>
            <td><?=$linea["nombre"]?></td>
            <td class="centrado"><?=$linea["precioUd"]?></td>
            <td class="centrado"><?=$linea["cantidad"]?></td>
            <td class="centrado"><?=$linea["totalLinea"]?></td>
        </tr>
    <?php } ?>
    <tfoot>
        <tr id ="precioSinIva">
        <th colspan="3">Precio sin IVA</th>
        <td class="centrado"><?=$precioSinIva?>€</td>
        </tr>
        
        <tr id="precioTotal">
        <th colspan="3">Precio Total</th>
        <td class="centrado"><?=$precioTotal?>€</td>    
        </tr>
    </tfoot>

    </table>
</div>



<div class="mt-2">

    <div id="direccionEnvio" class="mt-5">
            <div class="h5">Dirección de envío:</div>
            <div><?=$usuario->getDireccion()?></div>
            <?php if(!$compraConfirmada) { ?> 
                <div>(<a href="<?=Redirect::DATOS_USUARIO?>">Editar</a>)</div>
            <?php } ?>
    </div>

<?php if(!$compraConfirmada) { ?>

    <form action="<?=Redirect::PAGAR?>" name="fmConfirmarCompra" id="fmConfirmarCompra" method="post" enctype="multipart/form-data">
        <input type="hidden" name="compraConfirmada" value="false"/>


        <div id="espacioTarjetaCredito" class="mt-4">

           
            <div class="h5">Seleccionar tipo de tarjeta</div>
            <div">
                <div class="form-check">
                    <input type="radio" name="tipoTarjeta" id="tipoAExpress" value="tipoAExpress" class="form-check-input" checked/>
                    <label for="tipoAExpress" class="form-check-label">American Express</label>
                </div> 
                
                <div class="form-check">
                    <input type="radio" name="tipoTarjeta" id="tipoMCard" value="tipoMCard" class="form-check-input"/>
                    <label for="tipoMCard" class="form-check-label">Mastercard</label>  
                </div>
                
                <div class="form-check">
                    <input type="radio" name="tipoTarjeta" id="tipoVisa" value="tipoVisa" class="form-check-input"/>
                    <label for="tipoVisa" class="form-check-label">Visa</label>     
                </div>
            </div>
            <div class="h5 mt-3">Número de tarjeta de crédito</div>
            
            <div>
                <input id="tarjetaCredito" name="tarjetaCredito" type="text" class="form-control w-25" value="" placeholder="Nº tarjeta"/>
                <div class="invalid-feedback">
                    Debe introducirse un número de tarjeta de crédito válido que coincida con el tipo de tarjeta seleccionado.
                </div>
                <div class="valid-feedback">
                    Correcto
                </div>
            </div>
           
           
        </div>
    
        <div id="botonesConfirmar" class="mt-4">
            <button type="button" name="btnConfirmar" id="btnConfirmar" class="btn btn-primary">Confirmar</button>
            <a href="<?=Redirect::DETALLES_CARRITO?>" class="btn btn-primary">Atrás</a>
        </div>   
    </form>

<?php } else { 
    
    $numeroTarjeta = trim($numeroTarjeta);
    $tarjetaEnmascarada = str_pad(substr($numeroTarjeta,-4), strlen($numeroTarjeta),'*', STR_PAD_LEFT);
?>
    <div id="tarjetaOculta" class="mt-5">
        <div class="h5">Tarjeta de crédito:</div>
        <div><?=$tarjetaEnmascarada?></div>
    </div>

    <div id="botonesConfirmar" class="mt-4">
    <a href="<?=Redirect::REALIZAR_COMPRA?>" class="btn btn-primary">Comprar</a>
    <a href="<?=Redirect::DETALLES_CARRITO?>" class="btn btn-primary">Atrás</a>
    </div>   
            
<?php } ?>

</div>


</div>

<?php
include_once Path::VIEW_PIE;
?>

<script src="<?=Path::PUBLIC_JS_VALIDATOR?>"></script>
<script src="<?=Path::PUBLIC_JS_CONFIRMAR_COMPRA?>"></script>