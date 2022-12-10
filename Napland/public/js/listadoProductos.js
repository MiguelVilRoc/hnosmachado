"use strict";

document.getElementById("btnResetListadoProductos").addEventListener("click",limpiarCamposBusqueda);

function limpiarCamposBusqueda(oEvento) {
    let oE = oEvento || window.event;
    oE.preventDefault();
    document.getElementById("filtroDescripcion").value = "";
    document.getElementById("filtroNombre").value = "";
    document.getElementById("filtroCategoria").value = "-1";
    document.getElementById("frmListadoProductos").submit();
}