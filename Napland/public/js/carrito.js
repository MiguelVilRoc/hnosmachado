"use strict";

//var arrCarrito = [];
//cargarCarrito();

//Código de prueba
//function mostrarCarritoConsola() {
//    for(let linea of arrCarrito) { console.log(linea)}
//}
/*
anadirProducto(332);
anadirProducto(332);
anadirProducto(332);
anadirProducto(224);
anadirProducto(224);
*/
//Fin código de prueba


//con innerHtml puedes incrustar un html que se devuelva. Ej: $.post("public/ajax/ajaxLink.php", {accion:"guardarCarrito"}).done(function(data) {document.querySelector(".container.container-principal").innerHTML = data});
//$.post("public/ajax/ajaxLink.php", {accion:"guardarCarrito", carrito:oCarrito}).done(function(data) {console.log(data)});
/*
function guardarCarrito() {
    $.post("public/ajax/ajaxLink.php", {accion:"guardarCarrito", carrito:arrCarrito}).done(function(data) {console.log(data)});
}

function cargarCarrito() {
   // $.post("public/ajax/ajaxLink.php", {accion:"cargarCarrito"}).done(function(data) {arrCarrito = data});
   $.ajax({
    url: "public/ajax/ajaxLink.php",
    type: "POST",
    data: {accion:"cargarCarrito"},
    contentType:"application/json; charset=utf-8",
    dataType: "json",
    success: function(data) {
        arrCarrito = data;
    }

   });
}

function actualizarIconoCarrito() {
    if(document.getElementById("tamanoCarrito")) {
        let tamanoCarrito = 0;
        for(let linea of arrCarrito) {
            tamanoCarrito += linea.cantidad;
        }
        document.getElementById("tamanoCarrito").textContent = tamanoCarrito;
    }
}

function getLinea($idProducto) {
    for(let linea of arrCarrito) {
        if(linea.idProducto == $idProducto) {
            return linea;
        }
    }
    return false;
}

function anadirProducto($idProducto) {
    let linea = getLinea($idProducto);
    if(!linea) {
        arrCarrito.push({idProducto: $idProducto, cantidad: 1});
    } else {
        linea.cantidad++;
    }
    guardarCarrito();
    actualizarIconoCarrito();
}

function eliminarProducto($idProducto) {
    let linea = getLinea($idProducto);
    if(!linea) {
        console.log("Aviso: Se intentó eliminar un producto que no está presente en el carrito");
    } else {
        linea.cantidad--;
        if(linea.cantidad<=0) {
            let indice = arrCarrito.indexOf(linea);
            arrCarrito.splice(indice,1);
        }
    }
}
*/

function anadirProducto(idProducto) {
    if(!isNaN(idProducto) && idProducto>0) {
        let data = {accion:"anadir", id:idProducto};
        $.post("public/ajax/ajaxLink.php", data).done(function(data) {actualizarIconoCarrito(data);});
        //$.post("public/ajax/ajaxLink.php", data).done(function(data) {console.log(data);});
    }
}

function eliminarProducto(idProducto) {
    if(!isNaN(idProducto) && idProducto>0) {
        let data = {accion:"eliminar", id:idProducto};
        $.post("public/ajax/ajaxLink.php", data).done(function(data) {actualizarIconoCarrito(data);});
        //$.post("public/ajax/ajaxLink.php", data).done(function(data) {console.log(data);});
    }
}

function actualizarIconoCarrito(cantidad) {
    if(document.getElementById("tamanoCarrito")) {
        document.getElementById("tamanoCarrito").textContent = cantidad.trim();
    }
}

function mostrarCarritoConsola() {
    let data = {accion:"mostrar"};

    $.ajax({
        type: "POST",
        url: "public/ajax/ajaxLink.php",
        data: data,
        dataType: "json",
        success: function (data) {
            let arrCarrito = [];
            arrCarrito = data;
            for(let linea of arrCarrito) {
                console.log(linea);
            }
        }
    });
}

function pintarCarrito() {
    if(document.getElementById("divCarrito").innerHTML) {
        let data = {accion:"pintar"};

        $.ajax({
            type: "POST",
            url: "public/ajax/ajaxLink.php",
            data: data,
            dataType: "text",
            success: function (data) {
                
                document.getElementById("divCarrito").innerHTML = data;
            }
        });
    }
}

function botonSumar($id) {
    anadirProducto($id);
    pintarCarrito();

}

function botonRestar($id) {
    eliminarProducto($id);
    pintarCarrito()

}



