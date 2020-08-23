console.log(" vitacora");

$(document).ready(function () {
  console.log("Carga js");

  cargarbitacora();
});

function cargarbitacora() {
  var parametros = {
    accion: "traervitacora",
  };
  $.ajax({
    url: "../ajax/verbitacora.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);

      // for (var i = 0; i < respuesta.length; i++) {
      //   respuesta[i].opciones = "";
      // }

      $("#tabla-bitacora").DataTable().destroy();

      $("#tabla-bitacora").DataTable({
        data: respuesta,
        responsive: true,

        columns: [
          {
            data: "fecha",
          },

          {
            data: "nombre",
          },

          {
            data: "descripcion",
          },
        ],

        language: {
          lengthMenu: "Mostrar _MENU_ registros por página",
          zeroRecords: "No existe la búsqueda seleccionada.",
          info: "Mostrando página _PAGE_ of _PAGES_",
          infoEmpty: "No existen registros disponibles",
          infoFiltered: "(filtrado de _MAX_  registros totales)",
          search: "Búsqueda: ",
          paginate: {
            previous: "Anterior",
            next: "Siguente",
          },
        },
      });
    },
    error: function (error) {
      console.log(error);
    },
  });
}
