<?php
require Path::VIEW_CABECERA;
?>

<div class="container container-principal">

<?php include Path::VIEW_MENSAJES_FEEDBACK ?>

    <div class="row">

        <div class="col-6 col-md-4 mt-4">
                    <div>
                    <a href="<?=Redirect::DATOS_USUARIO?>"><img class="w-25 icon" style="color:antiquewhite" src="public/assets/ico/arrow-right-circle.svg" alt="Menu Icon"></a>
                    </div>
                    <div>Mis Datos</div>
        </div>

        <div class="col-6 col-md-4 mt-4">
                    <div>
                    <a href="<?=Redirect::EDITAR_PRODUCTO?>"><img class="w-25 icon" style="color:antiquewhite" src="public/assets/ico/arrow-right-circle.svg" alt="Menu Icon"></a>
                    </div>
                    <div>Añadir nuevo producto</div>
        </div>


        <div class="col-6 col-md-4 mt-4">
                    <div>
                    <a href="<?=Redirect::LISTADO_USUARIOS?>"><img class="w-25 icon" style="color:antiquewhite" src="public/assets/ico/arrow-right-circle.svg" alt="Menu Icon"></a>
                    </div>
                    <div>Listado de usuarios</div>
        </div>

        <div class="col-6 col-md-4 mt-4">
                    <div>
                    <a href="<?=Redirect::EDITAR_CATEGORIAS?>"><img class="w-25 icon" style="color:antiquewhite" src="public/assets/ico/arrow-right-circle.svg" alt="Menu Icon"></a>
                    </div>
                    <div>Administrar categorías</div>
        </div>

        <div class="col-6 col-md-4 mt-4">
            <div>
            <a href="<?=Redirect::LISTADO_PEDIDOS?>"><img class="w-25 icon" style="color:antiquewhite" src="public/assets/ico/arrow-right-circle.svg" alt="Menu Icon"></a>
            </div>
            <div>Listado Pedidos</div>
        </div>

    </div>
</div>







<?php
require Path::VIEW_PIE;
?>