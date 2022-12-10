"use strict";

document.getElementById("btnDetallesBorrar").addEventListener("click",confirmarBorrar);

function confirmarBorrar() {
    if(confirm("¿Está seguro de que desea borrar este producto?")) {
        document.getElementById("fmBorrarProducto").submit();
    }
}