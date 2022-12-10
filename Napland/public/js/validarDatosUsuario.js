

document.getElementById("btnDatosUsuario").addEventListener("click",validarDatosUsuario);

function validarDatosUsuario(oEvent) {
    let oE = oEvent || window.event;
    oEvent.preventDefault();

    if(validarFormulario()) {
        let form = document.getElementById("frmDatosUsuario");
        form.submit();
    }
}

function validarFormulario() {
    //Recogemos los campos
        let oNombre = document.getElementById("nombre");
        let oApellidos = document.getElementById("apellidos");
        let oEmail = document.getElementById("email");
        let oEmail2 = document.getElementById("email2");
        let oPassword = document.getElementById("password");
        let oPassword2 = document.getElementById("password2");
        let oDni = document.getElementById("dni");
        let oDireccion = document.getElementById("direccion");
        let oCondiciones = document.getElementById("condiciones");

    //validamos
    let validador = new Validator();
    validador.esEmail(oEmail);
    if(validador.todoOk && oEmail2 != null){
        validador.sonIguales(oEmail2,oEmail);
    }
    validador.passwordFormatoOk(oPassword);
    if(validador.todoOk) {
        validador.sonIguales(oPassword2,oPassword);
    }

    validador.noEstaVacio(oNombre);
    validador.noEstaVacio(oApellidos);
    validador.esDni(oDni);
    validador.noEstaVacio(oDireccion);
    validador.estaChecked(oCondiciones);

    return validador.todoOk;
}