//
// Usuarios
//
function RegistrarUsuario() {
    var nomUsuario = $("#userRegistra").val();
    var passUsuario = $("#passRegistra").val();

    if (nomUsuario.trim() == "" || passUsuario.trim() == "") {
        alert("El usuario y la contraseña no pueden estar vacios");
        return;
    }

    var data = { usuario: nomUsuario, pass: passUsuario };

    $.ajax({
        url: "utilerias/Usuario/RegistrarUsuario.php",
        data: data,
        type: "GET",
        success: function (data) {
            alert(data);
            if (!data.includes("ERROR"))
                location.reload();

        },
        error: function () {
            alert("No hay conexión con el servidor");
        }
    });
}

function IniciaSesion() {
    var nomUsuario = $("#userSesion").val();
    var passUsuario = $("#passSesion").val();

    var data = { usuario: nomUsuario, pass: passUsuario };

    $.ajax({
        url: "utilerias/Usuario/IniciaSesion.php",
        data: data,
        type: "GET",
        success: function (data) {
            if (data.includes("ERROR"))
                alert(data);
            else
                location.reload();
        },
        error: function () {
            alert("No hay conexión con el servidor");
        }
    });
}

function CierraSesion() {
    $.ajax({
        url: "utilerias/Usuario/CierraSesion.php",
        type: "GET",
        success: function (data) {
            if (data.includes("ERROR"))
                alert(data);
            else
                location.reload();
        },
        error: function () {
            alert("No hay conexión con el servidor");
        }
    });
}


//
// Clientes
//
function RegistrarCliente() {
    var nomCliente = $("#userCliente").val();
    var passCliente = $("#passCliente").val();
    var mailCliente = $("#mailCliente").val();


    if (nomUsuario.trim() == "" || passUsuario.trim() == "" || mailClientes.trim() == "") {
        alert("El usuario, la contraseña o el correo electronico no pueden estar vacios");
        return;
    }

    if (!EsCorreoValido(mailCliente)) {
        alert("El correo tiene un formato invalido");
        return;
    }


    var data = { cliente: nomUsuario, pass: passUsuario, mail: mailCliente };

    $.ajax({
        url: "utilerias/Usuario/RegistrarCliente.php",
        data: data,
        type: "GET",
        success: function (data) {
            alert(data);
        },
        error: function () {
            alert("No hay conexión con el servidor");
        }
    });
}

function EsCorreoValido(email) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(email);
};