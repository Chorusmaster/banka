if (window.isLogin === 1) {
    document.getElementById("container").addEventListener("submit", validateLogin);
} else {
    document.getElementById("container").addEventListener("submit", validateRegister);
}

function validateLogin(event) {
    let email = document.getElementById("email").value;
    let login = document.getElementById("login").value;
    let password = document.getElementById("password").value;

    if (validateLength(event, email, "email", 5, 60)) return true;
    if (validateLength(event, login, "login", 4, 30)) return true;
    if (validateLength(event, password, "password", 5, 60)) return true;
}

function validateRegister(event) {
    let name = document.getElementById("name").value;
    let surname = document.getElementById("surname").value;
    let birth = document.getElementById("birth").value;

    if (validateLogin(event)) return;

    if (validateLength(event, name, "meno", 2, 60)) return;
    if (validateLength(event, surname, "priezvisko", 2, 60)) return;

    if (birth < 10) {
        event.preventDefault();
        alert("Pole dátum narodenia je povinné");
        return;
    }

    let current_year = new Date().getFullYear();
    if (birth.substring(0, 4) > current_year - 16) {
        event.preventDefault();
        alert("Vytvorenie učtu je povolené len pre osôb nad 16 rokov");
        return;
    }
}

function validateLength(event, variable, field_name, min_length, max_length) {
    if (variable.length < min_length) {
        event.preventDefault();
        if (variable.length === 0) {
            alert("Pole " + field_name + " je povinné");
        } else {
            alert(field_name + " musí byť dlhé minimálne " + min_length + " symbolov");
        }
        return true;
    }

    if (variable.length > max_length) {
        event.preventDefault();
        alert(field_name + " musí byť dlhé maximálne " + max_length + " symbolov");
        return true;
    }
}