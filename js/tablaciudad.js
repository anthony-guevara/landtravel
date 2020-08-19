$(document).ready(function () {
  console.log("Carga js");

  cargarciudades();
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
      // for (var i = 0; i < respuesta.length; i++) {
      //   $("#contenido-ciudades").append(
      //     `
      //           <tr>
      //             <td>${respuesta[i].nombrepais}</td>
      //             <td>${respuesta[i].nombre}</td>
      //             <td>${respuesta[i].descripcion}</td>
      //             <td>
      //             <button class=""  onclick="eliminarCiudad(${respuesta[i].id})">Eliminar<i class="fas fa-window-close"></i></button>
      //             <button class=""  onclick="editarCiudad('${respuesta[i].nombrepais}','${respuesta[i].nombre}','${respuesta[i].descripcion}',${respuesta[i].id})">editar<i class="fas fa-edit"></i></button>
      //             <td>
      //           </tr>
      //           `
      //   );
      // }

      for (var i = 0; i < respuesta.length; i++) {
        respuesta[i].opciones = "";
      }

      $("#tabla-ciudades").DataTable().destroy();

      $("#tabla-ciudades").DataTable({
        data: respuesta,
        responsive: true,
        columnDefs: [
          {
            targets: -1,
            data: "id",
            render: function (data, type, row, meta) {
              return `<button class=" btn org-btn" onclick="editarCiudad('${row.nombrepais}','${row.nombre}','${row.descripcion}',${row.id})">Editar &nbsp<i class="fas fa-pen"></i></button>
              <button class=" btn org-btn-drk" onclick="eliminarCiudad(${row.id})">Eliminar &nbsp<i class="fas fa-trash"></i></button>          `;
            },
          },
        ],

        columns: [
          {
            data: "nombre",
          },

          {
            data: "nombrepais",
          },
          {
            data: "descripcion",
          },
          {
            data: "opciones",
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

function eliminarCiudad(idciudad) {
  console.log(idciudad);

  var parametros = {
    accion: "eliminarciudad",
    idciudad: idciudad,
  };

  $.ajax({
    url: "../ajax/crud-ciudades.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.codigo == 1) {
        cargarciudades();
      } else {
        alert(respuesta.mensaje);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function editarCiudad(nombrepais, nombreciudad, descripcion, idciudad) {
  $("#modalciudad").modal("show");
  console.log(nombrepais, nombreciudad, descripcion, idciudad);

  /*valor de el pais a editar*/

  $("#nombrePais").html("");
  $("#nombrePais").append(` <option id="pais">${nombrepais}</option><br>`);

  $("#nombreciudad").val(nombreciudad);
  $("#descripcion").val(descripcion);
  $("#idciudad").val(idciudad);
}

$("#guardarciudad").on("click", () => {
  console.log("hago click");

  var nombrepais = $("#nombrepais").val();
  var nombreciudad = $("#nombreciudad").val();
  var descripcion = $("#descripcion").val();
  var idciudad = $("#idciudad").val();
  console.log(idciudad);

  var parametros = {
    //nombrepais: nombrepais,
    nombreciudad: nombreciudad,
    descripcion: descripcion,
    idciudad: idciudad,
    accion: "editarciudad",
  };

  $.ajax({
    url: "../ajax/crud-ciudades.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.codigo == 1) {
        cargarciudades();
        $("#modalciudad").modal("hide");
      } else {
        alert(respuesta.mensaje);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

function GenerarPaises() {
  var parametros = {
    accion: "traerpaises",
  };

  $.ajax({
    url: "../ajax/crud-ciudades.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);

      for (var i = 0; i < respuesta.length; i++) {
        $("#listapaises").append(
          `<option id="option" value="${respuesta[i].id}" >${respuesta[i].nombre}</option><br>`
        );
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function agregar() {
  var nombreciudad = $("#nombrenuevaciudad").val();
  var descripcion = $("#descripcionnueva").val();
  var pais = $("#listapaises").val();

  var parametros = {
    nombreciudad: nombreciudad,
    descripcion: descripcion,
    idpais: pais,
    accion: "agregarciudad",
  };

  console.log(parametros);

  $.ajax({
    url: "../ajax/crud-ciudades.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.codigo == 1) {
        cargarciudades();
      } else {
        alert(respuesta.mensaje);
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
