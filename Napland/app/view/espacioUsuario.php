<?php
require Path::VIEW_CABECERA;
?>

<div class="container container-principal">
<div class="row">

<div class="col-6 col-md-4 mt-2">
            <div>
            <a href="<?=Redirect::DATOS_USUARIO?>"><img class="w-25 icon" style="color:antiquewhite" src="public/assets/ico/arrow-right-circle.svg" alt="Menu Icon"></a>
            </div>
            <div>Mis Datos</div>
</div>

<div class="col-6 col-md-4 mt-2">
            <div>
            <a href="<?=Redirect::DATOS_USUARIO?>"><img class="w-25 icon" style="color:antiquewhite" src="public/assets/ico/arrow-right-circle.svg" alt="Menu Icon"></a>
            </div>
            <div>Mis Datos</div>
</div>
<div class="col-6 col-md-4 mt-2">
            <div>
            <a href="<?=Redirect::LISTADO_PEDIDOS?>"><img class="w-25 icon" style="color:antiquewhite" src="public/assets/ico/arrow-right-circle.svg" alt="Menu Icon"></a>
            </div>
            <div>Mis Pedidos</div>
</div>

<!--
<div class="col-6 col-md-4 mt-4">
            <div>
            <a href="<?=Redirect::DATOS_USUARIO?>"><img class="w-25 icon" style="color:antiquewhite" src="public/assets/ico/arrow-right-circle.svg" alt="Menu Icon"></a>
            </div>
            <div>Mis Datos</div>
</div>
-->

</div>
</div>







<?php
require Path::VIEW_PIE;
?>