"use strict";

if(document.getElementById("btnConfirmar")) {
    document.getElementById("btnConfirmar").addEventListener("click",validarTarjeta);
    window.addEventListener("keydown", function(event) {
        let evt = event || window.event;
        console.log(evt.key);
        if(evt.key == "Enter") {
            evt.preventDefault();
            validarTarjeta();
        }
    });
}

function validarTarjeta() {
    let campoTarjeta = document.getElementById("tarjetaCredito");
    let validador = new Validator();
    let tipoTarjeta = document.getElementById("fmConfirmarCompra").tipoTarjeta.value;
    console.log(tipoTarjeta);

    validador.noEstaVacio(campoTarjeta);
    
   
    if(tipoTarjeta == "tipoAExpress") {         //American Express
        validador.esAmericanExpress(campoTarjeta);
    } else if(tipoTarjeta == "tipoMCard") {   //Master Card
        validador.esMasterCard(campoTarjeta);
    } else {                                   //Visa
        validador.esVisa(campoTarjeta);
    }

    if(validador.todoOk) {
        document.getElementsByName("compraConfirmada").value = true;
        document.getElementById("fmConfirmarCompra").submit();

    }


   
}