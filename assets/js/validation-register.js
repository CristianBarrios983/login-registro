window.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("registerForm");
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Para evitar el envío del formulario

        const name = document.getElementById("name").value;
        const surname = document.getElementById("surname").value;
        const email = document.getElementById("email").value;
        const pass = document.getElementById("pass").value;

        // Limpia los mensajes de error
        clearErrorMessages();

        // Realiza las validaciones
        let validation = true;

        const regExpEmail = /^[\w.-]+@[a-zA-Z_-]+?(?:\.[a-zA-Z]{2,})+$/;
        const regExpPass = /^(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if(name === ""){
            displayErrorMessage("name", "El nombre no puede estar vacío");
            validation = false;
        }

        if(surname === ""){
            displayErrorMessage("surname", "El apellido no puede estar vacío");
            validation = false;
        }

        if (email === "") {
            displayErrorMessage("email", "El campo email no puede estar vacío");
            validation = false;
        }

        if (pass === "") {
            displayErrorMessage("pass", "El campo contraseña no puede estar vacío");
            validation = false;
        }

        if (!regExpEmail.test(email)) {
            displayErrorMessage("email", "Email no válido");
            validation = false;
        }

        if (!regExpPass.test(pass)) {
            displayErrorMessage("pass", "La contraseña debe tener 8 caracteres y al menos un carácter especial como: @$!%*?& ((?=.*[@$!%*?&]");
            validation = false;
        }

        if (validation) {
            form.submit();
        }
    });

    function clearErrorMessages() {
        // Limpia los mensajes de error
        const errorElements = document.querySelectorAll(".error-message");
        for (let errorElement of errorElements) {
            errorElement.textContent = "";
        }
    }

    function displayErrorMessage(field, message) {
        let errorElement = document.getElementById(`${field}Error`);
        errorElement.textContent = message;
    }
});
