class Validator {

    constructor() {
        this.todoOk = true;
        this.errorEncontrado = false;
      }


    noEstaVacio(campo) {
        let noEstaVacio = campo.value.trim() != "";
        this.validarCampo(campo,noEstaVacio);
    }

    checkRegEx(campo,regEx) {
        let valor = campo.value.trim();
        return regEx.test(valor);
    }

    checkRegExSinEspacios(campo,regEx) {                  //QUITAR LOS ESPACIOS
        let valor = campo.value.trim();
        valor = valor.replace(/\s/g,'');
        return regEx.test(valor);
    }

    esEmail(campo) {
        let regEx = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        this.validarCampo(campo,this.checkRegEx(campo,regEx));
    }

    esDni(campo) {
        let regEx = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
        this.validarCampo(campo,this.checkRegEx(campo,regEx));
    }

    sonIguales(campo,campo2) {
        let sonIguales = campo.value.trim() == campo2.value.trim();
        this.validarCampo(campo,sonIguales);
    }

    estaChecked(campo) {
        let estaChecked = campo.checked;
        this.validarCampo(campo,estaChecked);
    }

    passwordFormatoOk(campo) {
        let regEx = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        this.validarCampo(campo,this.checkRegEx(campo,regEx));
    }

    esIdValida(campo) {
        let esID = (!isNaN(campo.value) && campo.value >= -1);
        this.validarCampo(campo,esID);
    }

    categoriaElegida(campo) {
        let categoriaValida = (!isNaN(campo.value) && campo.value > 0);
        this.validarCampo(campo,categoriaValida);
    }

    esNumeroEnteroPositivo(campo) {
        let enteroPositivo = (campo.value % 1 == 0 && campo.value > 0);
        this.validarCampo(campo,enteroPositivo);
    }

    esNumeroDecimalPositivo(campo) {
        let regEx = /^\d+(\.\d{1,2})?$/;
        this.validarCampo(campo,this.checkRegEx(campo,regEx));
    }

    esAmericanExpress(campo) {
        let regEx = /^3[47][0-9]{13}$/;
        this.validarCampo(campo,this.checkRegExSinEspacios(campo,regEx));
    }

    esMasterCard(campo) {
        let regEx = /5[1-5][0-9]{14}$/;   
        this.validarCampo(campo,this.checkRegExSinEspacios(campo,regEx));
    }

    esVisa(campo) {
        let regEx = /^4[0-9]{12}(?:[0-9]{3})?$/;
        this.validarCampo(campo,this.checkRegExSinEspacios(campo,regEx));
    }

    validarCampo(campo, esValido) {
        if(!esValido) {
            this.todoOk = false;
            campo.classList.add("is-invalid");
            campo.classList.remove("is-valid");

            if(!this.errorEncontrado) {
                this.errorEncontrado = true;
                campo.focus();
                let rect = campo.getBoundingClientRect();
                
                window.scrollTo(0,rect.top-0.05);
                
            }       
        }
        else {
            campo.classList.remove("is-invalid");
            campo.classList.add("is-valid");
        }
    }
}