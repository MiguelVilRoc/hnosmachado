<nav class="navbar navbar-expand-lg navbar-light fixed-top mb-md-4" id="navbar-cabecera">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=Redirect::PRINCIPAL?>">Napland</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
    
        <li class="nav-item">
          <a class="nav-link" href="<?=Redirect::LISTADO_PRODUCTOS?>">Productos</a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>

        
        <?php
        //Si no hay un usuario logueado, se muestra el enlace a la página de login 
        if(!isset($_SESSION["usuario"])) {
        ?>
        
          <li class="nav-item">
            <a class="nav-link" href="<?=Redirect::INICIO_SESION?>">Iniciar Sesión</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?=Redirect::DATOS_USUARIO?>">Regístrese</a>
          </li>

        <?php 
        //Si hay usuario logueado, se muestra el enlace a la página de logout
        } else {
        ?>

        <?php if(!$_SESSION["usuario"]->getAdministrador()) {?>
        <li class="nav-item">
          <a class="nav-link" href="<?=Redirect::ESPACIO_USUARIO?>">Mis Datos</a>
        </li>
        <?php } else {?>
          <li class="nav-item">
          <a class="nav-link" href="<?=Redirect::ESPACIO_ADMIN?>">Administración</a>
          </li>
        <?php } ?>
        
          <li class="nav-item">
            <a class="nav-link" href="<?=Redirect::CERRAR_SESION?>">Cerrar Sesion</a>
          </li>

          <?php if(!$_SESSION["usuario"]->getAdministrador()) {?>
            <li class="nav-item">
            <a class="nav-link" href="<?=Redirect::DETALLES_CARRITO?>">Carrito (<span id="tamanoCarrito"><?php echo $_SESSION["tamanoCarrito"]; ?></span>)</a>
          </li>
          <?php } ?>

        <?php }?>

      </ul>
    </div>
  </div>
</nav>