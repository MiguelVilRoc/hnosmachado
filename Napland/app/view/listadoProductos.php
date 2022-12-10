<?php
include_once Path::VIEW_CABECERA;
?>
<div class="container container-principal">
<?php include Path::VIEW_MENSAJES_FEEDBACK?>
<!--FILTROS-->
<form action="<?=Redirect::LISTADO_PRODUCTOS?>" method="POST" id="frmListadoProductos" name="frmListadoProductos">
<div class="row">
  <div class="col-12 col-lg-auto mb-2">
<label for="filtroCategoria">Categoria: </label>
</div>
<div class="col-12 col-lg-auto mb-2">  
<select name="filtroCategoria" id="filtroCategoria">
    <option value="-1" id="opcionCategoriaVacia" <?php if($filtroCategoria=="-1") echo "selected"?>>-categoría-</option>
    <?php 
    foreach($listaCategorias as $idCategoria=>$categoria) {
      
      $selected = "";
      
      if($filtroCategoria==$idCategoria) 
      $selected = "selected"; 
     
      echo '<option value="'.$idCategoria.'" '.$selected.'>'.$categoria.'</option>';
    }
    ?>
  </select>
  </div>
  <div class="col-12 col-lg-auto mb-2">
    <label for="filtroNombre">Nombre: </label>
  </div>
  <div class="col-12 col-lg-auto mb-2">
    <input type="text" name="filtroNombre" id="filtroNombre" value="<?=$filtroNombre?>">
  </div>

  <div class="col-12 col-lg-auto mb-2">
    <label for="filtroDescripcion">Descripcion: </label>
  </div>
  <div class="col-12 col-lg-auto mb-2">
    <input type="text" name="filtroDescripcion" id="filtroDescripcion" value="<?=$filtroDescripcion?>">
  </div>

  <div class="col-12 col-lg-auto mb-2">
    <button type="submit" id="btnSubmitListadoProductos" name="btnSubmitListadoProductos" class="btn btn-dark">Aplicar</button>
    <button id="btnResetListadoProductos" name="btnResetListadoProductos" class="btn btn-dark">Reset</button>
  </div>

</div>
</form>

<!--TABLA RESULTADO PRODUCTOS-->
<?php
  if(empty($listaProductos)) { 
    echo "<h2>No se produjo ningún resultado.</h2>"; 
  }
  else {   
?>

<table class="table" id="table-productos">
<tr>
  <th></th>
  <th>Nombre</th>
  <th>Descripción</th>
  <th>Ancho</th>
  <th>Largo</th>
  <th>Tipo</th>
  <th>Stock</th>

  <th
  <?php 
    
    if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") {
        echo 'colspan="1"';
    } else {
        echo 'colspan="1"';
    }
   
   ?>
  
  >Precio</th>
</tr>


<?php 
$defaultImage = 'public/assets/img/image-not-found-icon.png';

  foreach($listaProductos as $producto) {
    echo "<tr>"; 
    echo "<td><img class='imagenListadoProducto' src='";
  if(isset($listaFotos[$producto->getId()])) {
    echo $listaFotos[$producto->getId()];
  } else {
    echo $defaultImage;
  }
  echo "' alt='Imagen de producto' onerror='this.src=\"$defaultImage\"' /></td>";
  echo "<td>".$producto->getNombre()."</td>";
  echo "<td class='tdDescripcion'>".$producto->getDescripcion()."</td>";
  echo "<td>".$producto->getAncho()."cm</td>";
  echo "<td>".$producto->getLargo()."cm</td>";
  echo "<td>".$producto->getNombreCategoria()."</td>";
  echo "<td>".$producto->getStock()."</td>";
  echo "<td>".$producto->getPrecioUnitario()."</td>";
  if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]->getAdministrador()=="0") {
    echo "<td><a class='botonListado' href='".Redirect::DETALLES_PRODUCTO."&idProducto=".$producto->getId()."'>Detalles</a></td>";
    if(!isset($_SESSION["usuario"])) {
      echo "<td><a id='btnregistrarse' class='btn btn-primary' href='".Redirect::INICIO_SESION."' class='botonListado'>Comprar</a></td>";
    } else {
      echo "<td><button id='btnComprar' class='btn btn-primary' onClick='anadirProducto(".$producto->getId().")' class='botonListado'>Añadir</button></td>";
    }
  }
  else { 

    echo "<td><a class='botonListado' href='".Redirect::DETALLES_PRODUCTO."&idProducto=".$producto->getId()."'>Gestionar</a></td>";
    //echo "<td><a class='botonListado' href='".Redirect::EDITAR_PRODUCTO."&idProducto=".$producto->getId()."'>Editar</a></td>";
    
  }
    echo "</tr>";
  }
?>

</table>
<?php 
}   
?>
</div> <!--Cierre del container-->
<?php
  include_once Path::VIEW_PIE;
?>
<script src="<?=Path::PUBLIC_JS_LISTADO_PRODUCTOS?>"></script>
<!--Gestion del carrito-->
<?php if(!$_SESSION["usuario"]->getAdministrador()) {?>
  <script src="<?=Path::PUBLIC_JQUERY_JS?>"></script>
  <script src="<?=Path::PUBLIC_JS_CARRITO;?>"></script>
<?php }?>
