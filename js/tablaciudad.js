$(document).ready(function () {
    console.log("Carga js");

    cargarciudades();
    editarCiudad();

});

function cargarciudades() {

    var parametros = {
        accion: "traerciudades",
    };
    $.ajax({
        url: "../ajax/crud-ciudades.php",
        method: "POST",
        dataType: "json",
        data: parametros,
        success: function (respuesta) {
            console.log(respuesta);

            $("#contenido-ciudades").html("");
            for (var i = 0; i < respuesta.length; i++) {
                $("#contenido-ciudades").append(
                    `
                <tr>
                  <td>${respuesta[i].nombre}</td>
                  <td>${respuesta[i].nombre}</td>
                  <td>${respuesta[i].descripcion}</td>
                  <td>
                  <button class="btn buttones"  onclick="eliminarciudad()">Eliminar <i class="fas fa-window-close"></i></button>
                  <button class="btn buttones"  onclick="editarciudad()">editar <i class="fas fa-edit"></i></button>
                  <td>
                </tr>
                `
                );
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}





function eliminarCiudad() {
    console.log("eliminando");

}

function editarCiudad() {
    console.log("editando");
}


