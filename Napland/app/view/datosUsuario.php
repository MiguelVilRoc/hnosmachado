<?php
include_once Path::VIEW_CABECERA;
?>

<div class="container container-principal">

<?php
if($editaUsuario->getId() == -1) {
    echo "<h2>Nuevo Usuario</h2>";
} else {
echo "<h2>Editar usuario ".$editaUsuario->getEmail()."</h2>";
}
?>

<form action="<?=Redirect::PROCESAR_DATOS_USUARIO?>" method="POST" id="frmDatosUsuario" name="frmDatosUsuario">
<input type="hidden" name="id" value="<?=$editaUsuario->getId()?>">
  <div class="form-row">

  <!--EMAIL-->
  <div class="col-md-4 mb-3">
      <label for="email">Email</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend3">@</span>
        </div>
        <input type="text" class="form-control" id="email" name="email" placeholder="Email" aria-describedby="inputGroupPrepend3" value="<?=$editaUsuario->getEmail()?>"
        <?php 
        if($editaUsuario->getId() != -1) echo " disabled ";
        ?>
        >
        <div class="invalid-feedback">
          Introduzca un email válido.
        </div>
        <div class="valid-feedback">
        Correcto
      </div>
      </div>
    </div>

<?php 
if($editaUsuario->getId() == -1) {
?>
 <!--EMAIL 2. Sólo aparece si se está creando un usuario nuevo-->
 <div class="col-md-4 mb-3">
      <label for="email2">Confirme el email</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend3">@</span>
        </div>
        <input type="text" class="form-control" id="email2" name="email2" placeholder="Confirme el email" aria-describedby="inputGroupPrepend3">
        <div class="invalid-feedback">
            El email debe coincidir con el del campo de confirmación.
        </div>
        <div class="valid-feedback">
        Correcto
      </div>
      </div>
  </div>
<?php 
}
?>

<!--PASSWORD-->
<div class="col-md-4 mb-3">
      <label for="password">Contraseña</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" value="<?=$editaUsuario->getPassword()?>">
      <div class="invalid-feedback">
          La contraseña debe constar de al menos 8 caracteres y contener al menos un número y una letra.
      </div>
      <div class="valid-feedback">
        Correcto
      </div>
    </div>

<!--PASSWORD 2-->
<div class="col-md-4 mb-3">
      <label for="password2">Confirme contraseña</label>
      <input type="password" class="form-control" id="password2" name="password2"  placeholder="Repita la contraseña">
      <div class="invalid-feedback">
          La contraseña debe coincidir con la introducida en el campo anterior.
      </div>
      <div class="valid-feedback">
        Correcto
      </div>
    </div>

<!--NOMBRE-->
    <div class="col-md-4 mb-3">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?=$editaUsuario->getNombre()?>">
      <div class="invalid-feedback">
          El nombre es requerido.
      </div>
      <div class="valid-feedback">
        Correcto
      </div>
    </div>

<!--APELLIDOS-->    
    <div class="col-md-4 mb-3">
      <label for="apellidos">Apellidos</label>
      <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?=$editaUsuario->getApellidos()?>">
      <div class="invalid-feedback">
          Los apellidos son requeridos.
      </div>
      <div class="valid-feedback">
        Correcto
      </div>
    </div>
    
  </div> <!--Fin de la primera fila-->

  <div class="form-row">
<!--DNI-->
    <div class="col-md-4 mb-3">
      <label for="dni">DNI</label>
      <input type="text" class="form-control" id="dni" name="dni" placeholder="dni" value="<?=$editaUsuario->getDni()?>">
      <div class="invalid-feedback">
          Se requiere un DNI válido.
      </div>
      <div class="valid-feedback">
        Correcto
      </div>
    </div>

<!--DIRECCION-->
<div class="col-md-6 mb-3">
      <label for="direccion">Direccion</label>
      <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?=$editaUsuario->getDireccion()?>">
      <div class="invalid-feedback">
        El campo dirección es requerido.
      </div>
      <div class="valid-feedback">
        Correcto
      </div>
    </div>

  </div> <!--Fin de la segunda fila-->

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="true" id="condiciones" name="condiciones">
      <label class="form-check-label" for="condiciones"> <!--TODO: COPIA Y PEGA UNOS TERMS AND CONDITIONS!!!!!!!!-->
        Acepto los términos y condiciones
      </label>
      <div class="invalid-feedback">
        Debe aceptar los términos y condiciones.
      </div>
    </div>
  </div>
  <button class="btn btn-primary" id="btnDatosUsuario" type="submit">Enviar</button>
 
 <?php
  $redirectCancelar = "#";
  if(isset($_SESSION["usuario"])){
    if($_SESSION["usuario"]->getAdministrador()) {
      $redirectCancelar = Redirect::ESPACIO_ADMIN;
    } else {
      $redirectCancelar = Redirect::ESPACIO_USUARIO;
    }
  } else {
    $redirectCancelar = Redirect::PRINCIPAL;
  }
   ?>

  <a class="btn btn-primary" id="btnVolverAEspacio" href="<?=$redirectCancelar?>">Cancelar</a>
</form>

</div>

<?php
include_once Path::VIEW_PIE;
?>

<script src="<?=Path::PUBLIC_JS_VALIDATOR?>"></script>
<script src="<?=Path::PUBLIC_JS_VALIDAR_DATOS_USUARIO?>"></script>