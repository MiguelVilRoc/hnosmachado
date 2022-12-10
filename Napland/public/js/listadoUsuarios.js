"use strict";

document.getElementById("btnResetListadoUsuarios").addEventListener("click",limpiarCamposBusqueda);

function limpiarCamposBusqueda(oEvento) {
    let oE = oEvento || window.event;
    oE.preventDefault();
    document.getElementById("filtroEmail").value = "";
    document.getElementById("filtroNombre").value = "";
    document.getElementById("filtroApellidos").value = "";
    document.getElementById("filtroDireccion").value = "";
    document.getElementById("filtroAdministrador").checked = false;
    document.getElementById("frmListadoUsuarios").submit();
}

