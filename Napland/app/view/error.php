<?php
include Path::VIEW_CABECERA;
?>
<div class="container container-principal">
<h2>Error: ¡Ups! Se ha producido un error</h2> <br> <br>
<?php
echo "<p>".$error."</p>";
?>
<a href="<?=Redirect::PRINCIPAL?>">Volver a página principal</a>
</div>