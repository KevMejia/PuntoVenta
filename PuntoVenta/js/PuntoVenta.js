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
        url: root + "Usuario/RegistrarUsuario.php",
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
        url: root + "Usuario/IniciaSesion.php",
        data: data,
        type: "GET",
        success: function (data) {
            if (data.includes("ERROR"))
                alert(data);
            else
                window.location.replace(root);
        },
        error: function () {
            alert("No hay conexión con el servidor");
        }
    });
}

function CierraSesion() {
    if (confirm("¿De verdad desea cerrar sesión?")) {
        $.ajax({
            url: root + "Usuario/CierraSesion.php",
            type: "GET",
            success: function (data) {
                if (data.includes("ERROR"))
                    alert(data);
                else
                    window.location.replace(root);
            },
            error: function () {
                alert("No hay conexión con el servidor");
            }
        });

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
        url: root + "Clientes/RegistrarCliente.php",
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
            url: root + "Clientes/EliminaCliente.php",
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



//
// Proveedores
//
function RegistrarProveedor() {
    var nomProveedor = $("#userProveedor").val();

    if (nomProveedor.trim() == "") {
        alert("El usuario no puede estar vacio");
        return;
    }

    var data = { Proveedor: nomProveedor };

    $.ajax({
        url: root + "Proveedores/RegistrarProveedor.php",
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

$(".iconoEliminaProveedor").on('click', function () {
    var id = $(this).closest("tr").find("td:eq(0)").text();
    var usuario = $(this).closest("tr").find("td:eq(1)").text();


    if (confirm("¿Desea eliminar al proveedor " + usuario + "?")) {
        var data = { id: id };
        $.ajax({
            url: root + "Proveedores/EliminaProveedor.php",
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


//
// Inventario
//
function RegistrarProducto() {
    var nombreProducto = $("#nombreProducto").val();
    var costo = $("#CostoProducto").val();
    var nomProveedor = $("#ProveedorProducto").val();

    if (nomProveedor.trim() == "" || nombreProducto.trim() == "" || costo.trim() == "") {
        alert("El nombre del producto y el costo no pueden estar vacios");
        return;
    }

    if (parseFloat(costo) <= 0) {
        alert("El costo debe ser un numero positivo");
        return;
    }

    var data = { Proveedor: nomProveedor, NombreProducto: nombreProducto, Costo: parseFloat(costo) };

    $.ajax({
        url: root + "Inventario/RegistrarProducto.php",
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

$(".iconoEliminaProducto").on('click', function () {
    var id = $(this).closest("tr").find("td:eq(0)").text();
    var producto = $(this).closest("tr").find("td:eq(1)").text();


    if (confirm("¿Desea eliminar el producto " + producto + "?")) {
        var data = { id: id };
        $.ajax({
            url: root + "Inventario/EliminaProducto.php",
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

//
// Ventas
//
function RegistraVenta() {
    var idProducto = $("#idProducto").val();
    var numProductos = $("#NumProductos").val();
    var idCliente = $("#idCliente").val();

    if (numProductos.trim() == "") {
        alert("Se debe ingresar un número de productos");
        return;
    }

    if (parseFloat(numProductos) <= 0) {
        alert("El número de productos debe ser un numero positivo");
        return;
    }

    var data = { idProducto: idProducto, NumProductos: numProductos, idCliente: idCliente };
    $("#btnRegistra").click();

    $.ajax({
        url: root + "Ventas/RegistrarVenta.php",
        data: data,
        type: "GET",
        async: true,
        success: function (data) {
            alert(data);
            if (!data.includes("ERROR"))
                location.reload();
            $("#CierraVenta").click();
        },
        error: function () {
            alert("No hay conexión con el servidor");
            $("#CierraVenta").click();
        }
    });
}