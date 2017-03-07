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
        url: "/utilerias/Usuario/RegistrarUsuario.php",
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
        url: "/utilerias/Usuario/IniciaSesion.php",
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
    if (confirm("¿De verdad desea cerrar sesión?")) {
        $.ajax({
            url: "/utilerias/Usuario/CierraSesion.php",
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
        window.location.replace("/");
    }

}


//
// Clientes
//
function RegistrarCliente() {
    var nomCliente = $("#userCliente").val();
    var mailCliente = $("#mailCliente").val();


    if (nomCliente.trim() == "" || mailCliente.trim() == "") {
        alert("El usuario o el correo electronico no pueden estar vacios");
        return;
    }

    if (!EsCorreoValido(mailCliente)) {
        alert("El correo tiene un formato invalido");
        return;
    }


    var data = { cliente: nomCliente, mail: mailCliente };

    $.ajax({
        url: "Clientes/RegistrarCliente.php",
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

function EsCorreoValido(email) {
    var pattern = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    return pattern.test(email);
};

$(".iconoElimina").on('click', function () {
    var id = $(this).closest("tr").find("td:eq(0)").text();
    var usuario = $(this).closest("tr").find("td:eq(1)").text();
    

    if (confirm("¿Desea eliminar al cliente " + usuario + "?")) {
        var data = { id: id };
        $.ajax({
            url: "Clientes/EliminaCliente.php",
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
});
