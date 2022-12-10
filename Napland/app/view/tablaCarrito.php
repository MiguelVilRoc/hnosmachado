<?php
//Muestra la tabla con los productos contenidos en el carrito.
$total = 0;

if(isset($arrayLineasCarrito) && count($arrayLineasCarrito)>0) {
?>

<table id="tablaCarrito" class="table">

    <thead>
        <tr>
            <th>Producto</th>
            <th class="centrado">Precio ud.</th>
            <th class="centrado">Cantidad</th>
            <th class="centrado">Precio</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach($arrayLineasCarrito as $linea) { 
        $producto = $linea["producto"];
        $cantidad = $linea["cantidad"];    
    ?>
        <tr class="lineaProducto" data-id="<?=$producto->getId()?>">
            <td><?=$producto->getNombre()?></td>
            
            <td class="centrado precioUd"><?php 
                    $datoPrecio = $producto->getPrecioUnitario();
                    $precioParsed = floatval($datoPrecio);
                    $precioFormateado = number_format($precioParsed, 2, '.', '');
                    echo $precioFormateado;
            ?></td>
            
            <td class="centrado cantidad"><?=$cantidad?></td>
            
            <td class="centrado precioLinea"><?php 
                    $datoPrecio = $producto->getPrecioUnitario() * $cantidad;;
                    $precioParsed = floatval($datoPrecio);
                    $precioFormateado = number_format($precioParsed, 2, '.', '');
                    $total += $precioFormateado;
                    echo $precioFormateado;
            ?></td>

            <td class="centrado">
              <button class="btn btn-primary" type="button" onclick="disminuirCantidad(<?=$producto->getId()?>)">-</button>
              <button class="btn btn-primary" type="button" onclick="incrementarCantidad(<?=$producto->getId()?>)">+</button>  
            </td>
            


        </tr>
    <?php } ?>
    </tbody>

    <tfoot>
        <?php 
            //calcula el precio sin IVA
            $precioSinIva = $total/1.21;
            $precioSinIvaParsed = floatval($precioSinIva);
            $precioSinIvaFormateado = number_format($precioSinIvaParsed, 2, '.', '');
            $total = number_format($total, 2, '.', '');
        ?>

        <tr>

            <td colspan="3">Precio sin IVA</td>
            <td class="centrado"><span id="precioSinIVA"><?=$precioSinIvaFormateado?></span>€</td>
            <td> </td>
        </tr>

        <tr>
            <th colspan="3">Precio Total (IVA incluido)</th>
            <td class="centrado"><span id="precioTotal"><?=$total?></span>€</td>
            <td> </td>
        </tr>
    </tfoot>
</table>

<div>
    <a href="<?=Redirect::PAGAR?>" class="btn btn-primary">Ir a Pagar</a>
    <a href="<?=Redirect::VACIAR_CARRITO?>" class="btn btn-primary">Vaciar Carrito</a>
</div>

<?php 
} else {
    echo "<div class='mensajeVacio h2'>Carrito vacío</div>";
    echo "<div><a href='".Redirect::LISTADO_PRODUCTOS."'>Ver lista de productos</a></div>";
}
?>