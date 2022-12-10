<?php
include_once Path::VIEW_CABECERA;
?>

<div class="container container-principal">

<?php
if($editaProducto->getId() == -1) {
    echo "<h2 class='mb-5'>Nuevo Producto</h2>";
} else {
  echo "<h2 class='mb-5'>Editar producto: ".$editaProducto->getNombre()."</h2>";
}
 // echo "<img id='imagenEditarProducto' class='imagenListadoProducto' src='$fotoProducto' />";
$datoPrecio = $editaProducto->getPrecioUnitario();
$precioParsed = floatval($datoPrecio);
$precioFormateado = number_format($precioParsed, 2, '.', '');
?>

<?php include Path::VIEW_MENSAJES_FEEDBACK?>

<form id="frmDatosProducto" action="<?=Redirect::PROCESAR_EDITAR_PRODUCTO?>" method="post" enctype="multipart/form-data">
<input type="hidden" id="idProducto" name="idProducto" value="<?=$editaProducto->getId()?>"/>

<div class="form-row row mb-3 ms-1">
  <!--IMAGEN-->
  <div class="col-1 divImagenEditarProducto">
    <img id='imagenEditarProducto' class='imagenListadoProducto' alt='Imagen de producto' src='<?=$fotoProducto?>' onerror='this.src="public/assets/img/image-not-found-icon.png"' />
  </div>

  <div class="col-1"></div> <!--Separación-->

  <div class="mb-3 col-5">

  <!--Nombre producto-->
  <div class="row">
        <div class="col-12 mb-3">
          <label for="nombreProducto">Nombre del producto</label>
          <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" placeholder="Nombre del producto" value="<?=$editaProducto->getNombre()?>">
          <div class="invalid-feedback">
              El nombre es requerido.
          </div>
          <div class="valid-feedback">
            Correcto
          </div>
        </div>
    </div>


     <!--Input de IMAGEN-->

     <div class="row rowImagenInputEditar">
      <button type="button" class="btn btn-primary" id="btnMostrarCambiarFoto" name="btnMostrarCambiarFoto">Cambiar fotografía</button>
    </div>

    <div class="row rowImagenInputEditar">
      
      <div id="areaInputEditarFoto" class="d-none">
        <!--<label for="formFile" class="form-label">Cambiar fotografía</label>-->
        <input class="form-control" type="file" id="nuevaImagen" name="nuevaImagen" accept=".jpg,.jpeg,.png"/>
      </div>
    </div>

    

  </div>
</div>



<!--Descripción-->
<?php 
$maxCaracteresDescripcion = 500;
$numeroDeCaracteresRestantes = $maxCaracteresDescripcion - mb_strlen(trim($editaProducto->getDescripcion()));
?>

<div class="form-row">

        <div class="col-md-9 mb-3">
          <label for="descripcionProducto" id="labelDescripcionProducto" class="mb-1">Descripción (<span id="numeroDeCaracteres"><?=$numeroDeCaracteresRestantes?></span>)</label>
          <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="5" maxlength="<?=$maxCaracteresDescripcion?>"><?=$editaProducto->getDescripcion()?></textarea>
          <div class="invalid-feedback">
              Debe escribir una descripción de entre 1 y 500 caracteres.
          </div>
          <div class="valid-feedback">
            Correcto
          </div>
        </div>

</div>



<div class="form-row row mb-3">

<!--Categoría-->
<div id="divCategoria" class="col-3">
  <label for="selectCategoria" class="mb-1">Categoría</label>
    <select class="form-select" name="selectCategoria" id="selectCategoria">
        <option value="-1" id="opcionCategoriaVacia" <?php if($editaProducto->getIdCategoria()==-1) echo "selected"?>>-categoría-</option>
        <?php 
        foreach($listaCategorias as $idCategoria=>$categoria) {
          
          $selected = "";
          
          if($editaProducto->getIdCategoria()==$idCategoria) 
          $selected = "selected"; 
        
          echo '<option value="'.$idCategoria.'" '.$selected.'>'.$categoria.'</option>';
        }
        ?>
    </select>
      <div class="invalid-feedback">
         Debe elegir una categoría.
       </div>
      <div class="valid-feedback">
        Correcto
      </div>
    </div>

<!--Medidas-->
<div id="divMedidas" class="col-3">

<label for="fieldSetMedidas" class="mb-1">Medidas</label>
  <fieldset id="fieldSetMedidas" class="form-group border fieldSetForms">
    <!--Ancho-->
    <label for="anchoInput">Ancho (cm):</label>
    <input type="number" class="form-control" name="anchoInput" id="anchoInput" min="0" max="999999" value="<?=$editaProducto->getAncho()?>"/>
    <!--Largo-->
    <label for="largoInput">Largo (cm):</label>
    <input type="number" class="form-control" name="largoInput" id="largoInput" min="0" max="999999" value="<?=$editaProducto->getLargo()?>"/>
  </fieldset>          
</div>

<!--Precio unitario-->
<div id="divPrecio" class="col-3">

    <label for="precioInput" class="mb-1">Precio Unitario (euros):</label>
    <input type="number" class="form-control" name="precioInput" id="precioInput" min="0.00" max="9999999999.99" step="0.01" value="<?=$precioFormateado?>"/>
    
    <div class="invalid-feedback">
          El precio debe ser una cifra positiva con dos decimales.
       </div>
      <div class="valid-feedback">
        Correcto
      </div>

</div>

<!--Stock-->
<div id="divStock" class="col-3">

    <label for="stockInput" class="mb-1">Stock:</label>
    <input type="number" class="form-control" name="stockInput" id="stockInput" min="0" max="999999" value="<?=$editaProducto->getStock()?>"/>
    <div class="invalid-feedback">
          El stock debe ser un número positivo entero.
    </div>
    <div class="valid-feedback">
      Correcto
    </div>

</div>


</div>



  <input type="button" id="btnEditarProducto" class="btn btn-primary" value="Enviar"/>
  <a id="btnEditarProductoAtras" class="btn btn-primary" href="<?=Redirect::LISTADO_PRODUCTOS?>">Cancelar</a>

</form>

</div>

<?php
include_once Path::VIEW_PIE;
?>

<script src="<?=Path::PUBLIC_JS_VALIDATOR?>"></script>
<script src="<?=Path::PUBLIC_JS_EDITAR_PRODUCTO?>"></script>