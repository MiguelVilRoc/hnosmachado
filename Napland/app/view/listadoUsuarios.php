<?php
include_once Path::VIEW_CABECERA;
?>
<div class="container container-principal" id="containerListadoUsuarios">

<!--FILTROS-->
<form action="<?=Redirect::LISTADO_USUARIOS?>" method="POST" id="frmListadoUsuarios" name="frmListadoUsuarios">
    <div class="row">

        <div class="col-12 col-lg-1 mb-2">
            <label for="filtroEmail">Email: </label>
        </div>
        <div class="col-12 col-lg-5 mb-2"> 
            <input type="text" name="filtroEmail" id="filtroEmail" value="<?=$filtroEmail?>"> 
        </div>

        <div class="col-12 col-lg-1 mb-2">
            <label for="filtroNombre">Nombre: </label>
        </div>
        <div class="col-12 col-lg-5 mb-2"> 
            <input type="text" name="filtroNombre" id="filtroNombre" value="<?=$filtroNombre?>"> 
        </div>

        <div class="col-12 col-lg-1 mb-2">
            <label for="filtroApellidos">Apellidos: </label>
        </div>
        <div class="col-12 col-lg-5 mb-2"> 
            <input type="text" name="filtroApellidos" id="filtroApellidos" value="<?=$filtroApellidos?>"> 
        </div>

        <div class="col-12 col-lg-1 mb-2">
            <label for="filtroDireccion">Direccion: </label>
        </div>
        <div class="col-12 col-lg-5 mb-2"> 
            <input type="text" name="filtroDireccion" id="filtroDireccion" value="<?=$filtroDireccion?>"> 
        </div>

        <div class="col-12 col-lg-3 mb-2">
            <label for="filtroAdministrador">Incluir administradores: </label>
            <input type="checkbox" name="filtroAdministrador" id="filtroAdministrador" <?=($filtroAdministrador) ? "checked" : ""?>/> 
        </div>
            
            
        <div class="col-12 col-lg-auto mb-2">
            <button type="submit" id="btnSubmitListadoUsuarios" name="btnSubmitListadoUsuarios" class="btn btn-dark">Aplicar</button>
            <button id="btnResetListadoUsuarios" name="btnResetListadoUsuarios" class="btn btn-dark">Reset</button>
        </div>

    </div>
</form>

<!--Tabla de usuarios-->

<table class="table" id="table-usuarios">
    <tr>
    <th>Email</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>DNI</th>
    <th>Dirección</th>
    <th>Tipo usuario</th>
    </tr>

    <?php foreach($listaUsuarios as $tempUsuario) { ?>
    <tr>
        <td><?=$tempUsuario->getEmail()?></td>    
        <td><?=$tempUsuario->getNombre()?></td>   
        <td><?=$tempUsuario->getApellidos()?></td>
        <td><?=$tempUsuario->getDni()?></td>    
        <td><?=$tempUsuario->getDireccion()?></td>   
        <td><?=($tempUsuario->getAdministrador()) ? "Administrador":"Normal"?></td>  
    </tr>
    <?php } ?>

</table>

</div> <!-- fin container -->

<?php
  include_once Path::VIEW_PIE;
?>

<script src="<?=Path::PUBLIC_JS_LISTADO_USUARIOS?>"></script>