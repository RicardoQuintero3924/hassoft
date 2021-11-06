function validacionCorreo(element) {  
    const emailRegex = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(element.value) && !element.nextSibling.innerHTML) {
        var newDiv = document.createElement("p");
        var newContent = document.createTextNode("El correo debe ser válido");
        newDiv.className = "errorValidation";
        newDiv.id = "errorValidation";
        newDiv.appendChild(newContent);
        var currentDiv = element;
        element.parentNode.insertBefore(newDiv, currentDiv.nextSibling);
    } 

    if (emailRegex.test(element.value) && element.nextSibling.innerHTML) {
        element.parentNode.removeChild(element.nextSibling);
    }
    validarForm(element.parentNode);
    
}

function validacionRequire(element) { 
    const emailRegex = /^$/;
    if (emailRegex.test(element.value) && !element.nextSibling.innerHTML) {
        var newDiv = document.createElement("p");
        var newContent = document.createTextNode("El campo no puede estar vacío");
        newDiv.className = "errorValidation";
        newDiv.id = "errorValidation";
        newDiv.appendChild(newContent);
        var currentDiv = element;
        element.parentNode.insertBefore(newDiv, currentDiv.nextSibling);
    } 

    if (!emailRegex.test(element.value) && element.nextSibling.innerHTML) {
        element.parentNode.removeChild(element.nextSibling);
    }
    validarForm(element.parentNode);
}

function validacionNumeroCelular(element) {  
    if (element.value.length !== 10 && !element.nextSibling.innerHTML) {
        var newDiv = document.createElement("p");
        var newContent = document.createTextNode("El número de celular no cumple con los caracteres necesarios");
        newDiv.className = "errorValidation";
        newDiv.id = "errorValidation";
        newDiv.appendChild(newContent);
        var currentDiv = element;
        element.parentNode.insertBefore(newDiv, currentDiv.nextSibling);
    } 

    if (element.value.length == 10 && element.nextSibling.innerHTML) {
        element.parentNode.removeChild(element.nextSibling);
    }
    validarForm(element.parentNode);
}

function validacionNumeroTelefono(element) {  
    if (element.value.length !== 7 && !element.nextSibling.innerHTML) {
        var newDiv = document.createElement("p");
        var newContent = document.createTextNode("El número de teléfono no cumple con los caracteres necesarios");
        newDiv.className = "errorValidation";
        newDiv.id = "errorValidation";
        newDiv.appendChild(newContent);
        var currentDiv = element;
        element.parentNode.insertBefore(newDiv, currentDiv.nextSibling);
    } 

    if (element.value.length == 7 && element.nextSibling.innerHTML) {
        element.parentNode.removeChild(element.nextSibling);
    }
    validarForm(element.parentNode);
}

function validarForm(form) {
    for (const item of form) {
        if (item.value.length <= 0 && item.required) {
            bloquearBoton();

            return;
        }
    }

    if (document.getElementById("errorValidation")) {
        bloquearBoton();

        return;
    }

    habilitarBoton();
    
}

function habilitarBoton() {
    document.getElementById("submit").style.opacity = "1";
    document.getElementById("submit").style.pointerEvents = "auto";
}

function bloquearBoton() {
    document.getElementById("submit").style.opacity = "0.4";
    document.getElementById("submit").style.pointerEvents = "none";
}