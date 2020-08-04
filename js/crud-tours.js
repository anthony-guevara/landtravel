$(document).ready(function () {
  console.log("Carga js");

  cargarTours();
});

function cargarTours() {
  var parametros = {
    accion: "traertours",
  };

  $.ajax({
    url: "../ajax/crud-tours.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);
      $("#contenido-rutas").html("");

      for (var i = 0; i > respuesta.length; i++) {
        $("#contenido-rutas").append(
          ` <tr>
                <td>${respuesta[i].costo}</td>
                <td>${respuesta[i].cupos}</td>
                <td>${respuesta[i].fecha_inicio}</td>
                <td>${respuesta[i].fecha_salida}</td>
                <td>${respuesta[i].nombre}</td>
                <td>${respuesta[i].TipoTour}</td>
                
                <td>
                <button class=""  onclick="eliminarCiudad(${respuesta[i].id})">Eliminar<i class="fas fa-window-close"></i></button>
                <button class=""  onclick="editarCiudad('${respuesta[i].destino}','${respuesta[i].nombre}','${respuesta[i].descripcion}',${respuesta[i].id})">editar<i class="fas fa-edit"></i></button>
                <td>
              </tr>`
        );
      }
    },

    error: function (error) {
      console.log(error);
    },
  });
}

function cerrar() {
  $("#modalpais").modal({
    show: "false",
  });
}
