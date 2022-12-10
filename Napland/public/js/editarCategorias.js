"use strict";
$(document).ready(function() {
    $("#selectCategorias option").click(mostrarAreaInfo);
    $("#botonEditar").click(mostrarFormularioEditar);
    $("#botonAnadir").click(mostrarFormularioAnadir);
    $("#btnFrmCancelar").click(cerrarFormulario);
    $("#botonBorrar").click(borrarCategoria);
    document.getElementById("txtDescripcion").addEventListener("input",calcularCaracteresRestantes);
    document.getElementById("btnFrmGuardar").addEventListener("click",validarFormulario);
    document.getElementById("formularioCategorias").addEventListener("submit",validarFormulario2);
    
});

function ocultarAreasInfo() {
    $(".espacioDatosCategoria").fadeOut();
    disableEditButtons();
}

function mostrarAreaInfo(oEvent) {
    let oE = oEvent || window.event;
    let element = oE.target;
    let id = element.value;
    //ocultamos todas y después mostramos la seleccionada 
    $(".espacioDatosCategoria").fadeOut().promise().then(function() {$(".espacioDatosCategoria[data-id="+id+"]").fadeIn();});
    enableEditButtons(); 
}

function enableEditButtons() {
    document.getElementById("botonEditar").disabled = false;
    document.getElementById("botonBorrar").disabled = false;
}

function disableEditButtons() {
    document.getElementById("botonEditar").disabled = true;
    document.getElementById("botonBorrar").disabled = true;
}

function enableAddButton() {
    document.getElementById("botonAnadir").disabled = false;
}

function disableAddButton() {
    document.getElementById("botonAnadir").disabled = true;
}

function mostrarFormularioEditar() {
    let id = document.getElementById("selectCategorias").value;
    poblarCamposFormulario(id);
    $("#formularioCategorias").fadeIn();
    deshabilitarSelect();
    disableEditButtons();
    disableAddButton();
}

function mostrarFormularioAnadir() {
    let id = -1;
    poblarCamposFormulario(-1);
    $("#formularioCategorias").fadeIn();
    disableEditButtons();
    disableAddButton();
    deshabilitarSelect();
}

function cerrarFormulario() {
    $("#formularioCategorias").fadeOut();
    if(document.getElementById("selectCategorias").value) {
        enableEditButtons();
    }
    enableAddButton();
    habilitarSelect();
}

function deshabilitarSelect() {
    document.getElementById("selectCategorias").disabled = true;
    $("#selectCategorias option").off("click",mostrarAreaInfo);

}

function habilitarSelect() {
    document.getElementById("selectCategorias").disabled = false;
    $("#selectCategorias option").click(mostrarAreaInfo);
}
/*
function calcularCaracteresRestantesOnInput(oEvent) {
    let evt = oEvent || window.event;
    let target = evt.target;
    let caracteresEscritos = target.value.length;
    let caracteresMaximos = target.maxLength;
    let caracteresRestantes = caracteresMaximos - caracteresEscritos;
    
    document.getElementById("caracteresRestantes").textContent=caracteresRestantes;
}
*/

function calcularCaracteresRestantes() {
    let textAreaDescripcion = document.getElementById("txtDescripcion");
    let textoEscrito = textAreaDescripcion.value;
    let caracteresEscritos = textoEscrito.length;
    let caracteresMaximos = textAreaDescripcion.maxLength;
    let caracteresRestantes = caracteresMaximos - caracteresEscritos;
    document.getElementById("caracteresRestantes").textContent=caracteresRestantes;
}

function poblarCamposFormulario(id) {
    let formulario = document.getElementById("fmCategorias");
    let oEncabezado = document.getElementById("encabezadoFormulario");
    let txtEncabezado = "Nueva categoría";
    formulario.reset();
    $("#fmCategorias .form-control").removeClass("is-invalid is-valid");
    if(id > -1) {
        let elementoInfo = document.querySelector(".espacioDatosCategoria[data-id='"+id+"']");
        if(elementoInfo) {
            let nombreCategoria = elementoInfo.querySelector(".nombreCategoria").textContent.trim();
            let descripcionCategoria = elementoInfo.querySelector(".descripcionCategoria").textContent.trim();

            formulario.id.value = id;
            formulario.nombre.value = nombreCategoria;
            txtEncabezado = "Editar categoría "+nombreCategoria;
            formulario.descripcion.value = descripcionCategoria;
        }
    }

    oEncabezado.textContent = txtEncabezado;
    calcularCaracteresRestantes();
}

//Validaciones front

function validarFormulario() {
    let formulario = document.getElementById("fmCategorias");
    let validador = new Validator();

    validador.esIdValida(formulario.id);
    validador.noEstaVacio(formulario.nombre);
    validador.noEstaVacio(formulario.descripcion);

    if(validador.todoOk) {
        formulario.submit();
    }
}

function validarFormulario2(oEvent) {
let oE = oEvent || window.event;
oE.preventDefault();
console.log("hello");
}

function borrarCategoria() {
    if(confirm("¿Está seguro de que desea borrar esa categoría?")) {
        let formulario = document.getElementById("fmBorrar");
        let categoriaSeleccionada = document.getElementById("selectCategorias").value;
        formulario.idCategoria.value = categoriaSeleccionada;
        formulario.submit();
    }
}