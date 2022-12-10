"use strict";

//**************** Event Listeners***********************

document.getElementById("btnMostrarCambiarFoto").addEventListener("mouseup",function() {
    let zonaInputFoto = document.getElementById("areaInputEditarFoto");
    if(zonaInputFoto.classList.contains("d-none")) {
        zonaInputFoto.classList.remove("d-none");
       // zonaInputFoto.classList.add("d-block");
    } else {
        zonaInputFoto.classList.add("d-none");
    }
});

document.getElementById("descripcionProducto").addEventListener("input",calcularCaracteresRestantes);
document.getElementById("btnEditarProducto").addEventListener("mouseup",validarFormularioProducto);

//************* Event Handlers*****************************

function calcularCaracteresRestantes(oEvent) {
    let evt = oEvent || window.event;
    let target = evt.target;
    let caracteresEscritos = target.value.length;
    let caracteresMaximos = target.maxLength;
    let caracteresRestantes = caracteresMaximos - caracteresEscritos;
    
    document.getElementById("numeroDeCaracteres").textContent=caracteresRestantes;
}

function validarFormularioProducto(oEvent) {
    let evt = oEvent || window.event;
    evt.preventDefault();

    if(validarDatosFormularioProducto()) {
      let form = document.getElementById("frmDatosProducto");
      form.submit();
     // console.log("todo ok");
    } 
    //else {
    //    console.log("hay errores");
    //}

}

//*********Validación de datos ************/

function validarDatosFormularioProducto() {
    //Recogemos los datos del formulario
    let oIdProducto = document.getElementById("idProducto");
    let oNombre = document.getElementById("nombreProducto");
    let oDescripcion = document.getElementById("descripcionProducto");
    let oIdCategoria = document.getElementById("selectCategoria");
    let oAncho = document.getElementById("anchoInput");
    let oLargo = document.getElementById("largoInput");
    let oPrecio = document.getElementById("precioInput");
    let oStock = document.getElementById("stockInput");

    //Validamos con un objeto de la clase "common" Validator 

    let validador = new Validator();

    validador.esIdValida(oIdProducto);
    validador.noEstaVacio(oNombre);
    validador.noEstaVacio(oDescripcion);
    validador.categoriaElegida(oIdCategoria);
    validador.esNumeroEnteroPositivo(oAncho);
    validador.esNumeroEnteroPositivo(oLargo);
    validador.esNumeroDecimalPositivo(oPrecio);
    validador.esNumeroEnteroPositivo(oStock);

    return validador.todoOk;
}