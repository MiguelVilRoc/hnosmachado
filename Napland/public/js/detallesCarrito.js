"use strict";
//Inicialmente se hizo el carrito únicamente con llamadas Ajax que lo modificaban en el servidor y devolvían el html del carrito actualizado
//Sin embargo, una vez probado desplegado en el hosting, las respuestas Ajax no eran lo bastante rápidas como para producir un funcionamiento
//del carrito satisfactorio. Por lo tanto, he diseñado este script que hará una copia y modificará el carrito en JavaScript y usaré Ajax únicamente para 
//salvarlo como variable de sesión cuando sea conveniente.

/*
var oCarrito;

if(document.getElementById("tablaCarrito")); {
    oCarrito = document.querySelectorAll("#tablaCarrito .lineaProducto");

    console.log(oCarrito);
}
*/

function disminuirCantidad($id) {
    let linea = document.querySelector("#tablaCarrito .lineaProducto[data-id='"+$id+"']");
    let cantidad =  linea.querySelector(".cantidad").innerHTML;
    if((cantidad-1) <= 0) {
        linea.remove();
        comprobarLineas();
    } else {
        linea.querySelector(".cantidad").innerHTML = parseInt(cantidad) - 1;
        recalcularPrecioLinea(linea);
        
    }
    recalcularPrecioCarrito();
    eliminarProducto($id); //Esta función hace una llamada Ajax para que se reduzca el número de este producto en la variable de sesión "carrito"
    //disminuirTamanoCarrito(); //eliminarProducto ya se encarga de disminuir el tamaño del carrito 
   
}

function incrementarCantidad($id) {
    let linea = document.querySelector("#tablaCarrito .lineaProducto[data-id='"+$id+"']");
    let cantidad =  linea.querySelector(".cantidad").innerHTML;
    
    linea.querySelector(".cantidad").innerHTML = parseInt(cantidad) + 1;
   
    recalcularPrecioLinea(linea);
    recalcularPrecioCarrito();
    anadirProducto($id); //Esta función hace una llamada Ajax para que se incremente el número de este producto en la variable de sesión "carrito"
    //incrementarTamanoCarrito();  //anadirProducto ya se encarga de aumentar el tamaño del carrito

}



//Funciones para cambiar el span del tamaño de carrito y recalcular el precio
function incrementarTamanoCarrito(){
    if(document.getElementById("tamanoCarrito")) {
        let spanTamanoCarrito = document.getElementById("tamanoCarrito");
        let tamano = spanTamanoCarrito.innerHTML; 
            spanTamanoCarrito.innerHTML =  parseInt(tamano) + 1;
           
        
    }
}

function disminuirTamanoCarrito() {
    if(document.getElementById("tamanoCarrito")) {
        let spanTamanoCarrito = document.getElementById("tamanoCarrito");
        let tamano = spanTamanoCarrito.innerHTML; 
        if(tamano - 1 <= 0){
            console.log("hola");
            spanTamanoCarrito.innerHTML = 0;
            location.reload();
        } else {
            spanTamanoCarrito.innerHTML = parseInt(tamano) - 1;
        }   
    }
}

function recalcularPrecioLinea(linea) {
    let cantidad = parseInt(linea.querySelector(".cantidad").innerHTML);
    let precioUd = parseFloat(linea.querySelector(".precioUd").innerHTML);
    let nuevoPrecio = cantidad * precioUd;
    linea.querySelector(".precioLinea").innerHTML = nuevoPrecio.toFixed(2);
}

function recalcularPrecioCarrito() {
    let todosLosPrecios = document.querySelectorAll(".precioLinea");
    let precioTotal = 0;
    for(let precio of todosLosPrecios) {
        precioTotal += parseFloat(precio.innerHTML);
    }
    console.log(precioTotal);
    document.getElementById("precioSinIVA").innerHTML = (precioTotal/1.21).toFixed(2);
    
    document.getElementById("precioTotal").innerHTML = precioTotal.toFixed(2);
}

function comprobarLineas() {
    let nLineas = document.querySelectorAll("#tablaCarrito .lineaProducto").length;
    if(nLineas == 0) {
        location.reload();
    }
}


