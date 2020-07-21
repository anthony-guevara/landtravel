$(document).ready(function () {
  console.log("Carga js");

  cargarPaises();
});

var parametros = {
  accion: "traerpaises",
};

function cargarPaises() {
  $.ajax({
    url: "../ajax/crud-paises.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);

      $("#contenido-paises").html("");
      for (var i = 0; i < respuesta.length; i++) {
        $("#contenido-paises").append(
          `
          <tr>
            <td>${respuesta[i].nombre}</td>
            <td>${respuesta[i].gentilicio}</td>
            <td>
            <button class="btn btn-danger" onclick="eliminarPais(${respuesta[i].id})">Eliminar</button>
            <button class="btn btn-primary" onclick="editarPais(${respuesta[i].id})">editar</button>
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

function eliminarPais(idPais) {
  console.log(idPais);

  var parametros = {
    accion: "eliminarpais",
    id: idPais,
  };

  $.ajax({
    url: "../ajax/crud-paises.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.codigo == 1) {
        cargarPaises();
      } else {
        alert(respuesta.mensaje);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function editarPais(idPais) {
  console.log(idPais);
}
