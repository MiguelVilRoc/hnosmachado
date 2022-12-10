<?php 
include_once Path::VIEW_CABECERA;
?>

<!--FILTROS-->


<div class="container container-principal">

<form action="<?=Redirect::LISTADO_PEDIDOS?>" method="POST" id="frmListadoPedidos" name="frmListadoPedidos">
    <div class="row">

        <div class="col-12 col-lg-1 mb-2">
            <label for="filtroDesde">Desde: </label>
        </div>
        <div class="col-12 col-lg-5 mb-2"> 
            <input type="datetime-local" name="filtroDesde" id="filtroDesde" />
        </div>

        <div class="col-12 col-lg-1 mb-2">
            <label for="filtroHasta">Hasta: </label>
        </div>
        <div class="col-12 col-lg-5 mb-2"> 
            <input type="datetime-local" name="filtroHasta" id="filtroHasta" value="<?=$fechaActual?>" max="<?=$fechaActual?>" />
        </div>
            
        <div class="col-12 col-lg-auto mb-2">
            <button type="submit" id="btnSubmitListadoPedidoss" name="btnSubmitListadoPedidos" class="btn btn-dark">Aplicar</button>
            <button id="btnResetListadoUsuarios" name="btnResetListadoUsuarios" class="btn btn-dark">Reset</button>
        </div>

    </div>
</form>

    <div class="h2">Listado de Pedidos</div>

    <div id="divTablaPedidos">

    <?php
        //echo "<pre>";
        //print_r($arrayDatos); //TEST
        //echo "</pre>";

        /*
        Array
(
    [0] => Array
        (
            [id] => 16
            [fecha] => 10-12-2022 12:31:59
            [email_cliente] => cliente1@hotmail.com
            [arrayLineas] => Array
                (
                    [0] => Array
                        (
                            [nombreProducto] => Almohada Cervical Viscoelástica 2
                            [cantidad] => 2
                            [precio_unitario] => 120.25
                        )

                    [1] => Array
                        (
                            [nombreProducto] => Almohada Visco Bamboo
                            [cantidad] => 1
                            [precio_unitario] => 25.00
                        )

                )

        )

)


        */
    ?>

    </div>

</div>

    
    
    <?php include_once Path::VIEW_PIE; ?>
    