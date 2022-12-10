<?php
//echo "<pre>";
//print_r($listaCategorias);
//echo "</pre>";
include_once Path::VIEW_CABECERA;
?>
<div class="container container-principal" id="container-editar-categorias">

    <h2 class='mb-5'>Administrar categorías</h2>
    <?php include Path::VIEW_MENSAJES_FEEDBACK;?>
<!--
    <div class="row">
        <div class="col-6">
            
         </div>
    </div>
-->
    <div class="row" id="primeraFila"> <!--primera fila-->
        
        <div class="col-3 izquierda"> <!--izquierda-->
        <label for="selectCategorias" class="encabezadoEditCategorias">Categorías existentes</label>
        <?php if(count($listaCategorias)>0) {?>
            <div class="row">
                <select name="selectCategorias" id="selectCategorias"  size=<?=count($listaCategorias)?>>
                    <?php
                        foreach($listaCategorias as $categoria) {
                    ?>
                        <option value="<?=$categoria->getId()?>"><?=$categoria->getNombre()?></option>
                    <?php
                        }
                    ?>

                </select>
            </div>
        <?php } else {?>
        <div class="mensajeVacio">No hay ninguna categoría definida</div>
        
        <?php } ?>
        
        </div> <!--fin izquierda-->

        <div class="col-1 separador"></div>

        <div class="col-3 centro"> <!--centro-->
        <div>
            <button id="botonEditar" type="button" class="btn btn-primary" disabled>Editar</button>
            <form action="<?=Redirect::BORRAR_CATEGORIA?>" method="post" name="fmBorrar" id="fmBorrar" enctype="multipart/form-data">
                <input type="hidden" name="idCategoria" value=""/>
                <button id="botonBorrar" type="button" class="btn btn-primary" disabled>Borrar</button>
            </form>
        </div>

        <div><button id="botonAnadir" type="button" class="btn btn-primary">Añadir</button></div>

        </div> <!--fin centro-->

        <div id="formularioCategorias" class="derecha col-4">
        <div ><label id="encabezadoFormulario" for="formularioCategorias" class="encabezadoEditCategorias">Nueva categoría</label></div>
        <form action="<?=Redirect::PROCESAR_EDITAR_CATEGORIA?>" method="post" name="fmCategorias" id="fmCategorias"  enctype="multipart/form-data">
            <input type="hidden" name="id" value="-1"/>

            <?php 
                $maxCaracteresDescripcion = 200;
               // $numeroDeCaracteresRestantes = $maxCaracteresDescripcion - mb_strlen(trim($editaProducto->getDescripcion()));
            ?>

            <div class="row">

                <div class="col">
                        <div><label for="nombre">Nombre:</label></div>
                </div>


                <div class="col">
                    <div class="inputCategoria">
                        <input class="form-control" type="text" name="nombre" value=""/>
                        <div class="invalid-feedback">
                            El nombre es requerido.
                        </div>
                        <div class="valid-feedback">
                            Correcto
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                         
                <div class="col">
                    <div><label for="descripcion">Descripcion (<span id="caracteresRestantes"><?=$maxCaracteresDescripcion?></span>):</label></div>
                </div>


                <div class="col">
                    <div class="inputCategoria">
                        <textarea id="txtDescripcion" class="form-control" maxlength="<?=$maxCaracteresDescripcion?>" name="descripcion"></textarea>
                        <div class="invalid-feedback">
                            Descripcion requerida.
                        </div>
                        <div class="valid-feedback">
                            Correcto
                        </div>
                    </div>
                </div>

            </div>



            <div>
            <button  type="submit" id="btnFrmGuardar" class="btn btn-primary" type="button"> Guardar</button>
            <button id="btnFrmCancelar" class="btn btn-primary" type="button">Cancelar</button>
            </div>
        </form>
        </div>

    </div> <!-- fin primera fila-->

   
   
    <div class="row" id="segundaFila"> <!--segunda fila-->
       
             <?php
                foreach($listaCategorias as $categoria) {
            ?>
                <div class="espacioDatosCategoria" data-id="<?=$categoria->getId()?>">
                    <label id="labelNombre">Nombre de categoría:</label>
                    <div class="nombreCategoria" ><?=$categoria->getNombre()?></div>

                    <label id="labelDescripcion">Descripción:</label>
                    <div class="descripcionCategoria" ><?=$categoria->getDescripcion()?></div>
                </div>

            <?php
                }
            ?>
       

    </div> <!--fin segunda fila-->
    <div>
        <a class="btn btn-primary" href="<?=Redirect::ESPACIO_ADMIN?>">Atrás</a>
    </div>


</div> <!--Fin container-->


<?php
    include_once Path::VIEW_PIE;
?>
<script src="<?=Path::PUBLIC_JQUERY_JS?>"></script>
<script src="<?=Path::PUBLIC_JS_VALIDATOR?>"></script>
<script src="<?=Path::PUBLIC_JS_EDITAR_CATEGORIAS?>"></script>