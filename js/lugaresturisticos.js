$(document).ready(function () {
  console.log("Carga js");

  cargarLugares();
});

function cargarLugares() {
  var parametros = {
    accion: "traerlugaresturisticos",
  };

  $.ajax({
    url: "../ajax/crud-lugaresturisticos.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);

      $("#contenido-lugares").html("");
      // for (var i = 0; i < respuesta.length; i++) {
      //   $("#contenido-lugares").append(
      //     ` <tr>
      //           <td>${respuesta[i].destino}</td>
      //           <td>${respuesta[i].nombre}</td>

      //           <td>
      //           <button class=""  onclick="eliminarlugarturistico(${respuesta[i].id})">Eliminar<i class="fas fa-window-close"></i></button>
      //           <button class=""  onclick="editarlugarturistico('${respuesta[i].destino}','${respuesta[i].nombre}','${respuesta[i].descripcion}',${respuesta[i].id})">editar<i class="fas fa-edit"></i></button>
      //           <td>
      //         </tr>`
      //   );
      // }

      for (var i = 0; i < respuesta.length; i++) {
        respuesta[i].opciones = "";
      }

      var table = $("#tabla-lugares").DataTable().destroy();

      $("#tabla-lugares").DataTable({
        data: respuesta,
        responsive: true,
        columnDefs: [
          {
            targets: -1,
            data: "id",
            render: function (data, type, row, meta) {
              return `<button class="buttones" onclick="eliminarlugarturistico(${row.id})"><i class="fas fa-window-close"></i></button>
              <button class="buttones" onclick="editarlugarturistico('${row.destino}','${row.nombre}','${row.descripcion}',${row.id})"><i class="fas fa-edit"></i></button>
              `;
            },
          },
        ],

        columns: [
          {
            data: "destino",
          },

          {
            data: "nombre",
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

function eliminarlugarturistico(idlugar) {
  console.log(idlugar);
  var parametros = {
    accion: "eliminarlugarturistico",
    id: idlugar,
  };

  $.ajax({
    url: "../ajax/crud-lugaresturisticos.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.codigo == 1) {
        cargarLugares();
      } else {
        alert(respuesta.mensaje);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function editarlugarturistico(nombreciudad, nombre, descripcion, idlugar) {
  $("#modallugar").modal("show");
  $("#nombreciudad").html("");
  $("#nombreciudad").append(
    ` <option id="ciudad">${nombreciudad}</option><br>`
  );

  $("#nombreciudad").val(nombreciudad);
  $("#lugar").val(nombre);
  $("#Descripcion").val(descripcion);
  $("#idlugar").val(idlugar);
}

$("#guardarLugar").on("click", () => {
  console.log("hago click");

  var nombreciudad = $("#nombreciudad").val();
  var nombrelugar = $("#lugar").val();
  var descripcion = $("#Descripcion").val();
  var idlugar = $("#idlugar").val();

  var parametros = {
    accion: "editarlugar",
    nombrelugar: nombrelugar,
    id: idlugar,
  };

  console.log(parametros);

  $.ajax({
    url: "../ajax/crud-lugaresturisticos.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.codigo == 1) {
        cargarLugares();
        $("#guardarlugar").modal("hide");
      } else {
        alert(respuesta.mensaje);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

function generarCiudades() {
  var parametros = {
    accion: "traerciudades",
  };

  $.ajax({
    url: "../ajax/crud-lugaresturisticos.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);

      for (var i = 0; i < respuesta.length; i++) {
        $("#listaciudades").append(
          `<option id="option" value="${respuesta[i].id}" >${respuesta[i].nombre}</option><br>`
        );
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

/*nuevo lugar turistico*/

function agregarLugar() {
  var ciudad = $("#listaciudades").val();
  var lugar = $("#nombrenuevolugar").val();
  var descripcion = $("#descripcionnueva").val();

  var parametros = {
    accion: "nuevolugar",
    ciudad: ciudad,
    lugar: lugar,
    descripcion: descripcion,
  };

  $.ajax({
    url: "../ajax/crud-lugaresturisticos.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.codigo == 1) {
        cargarLugares();
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
  $("#modallugar").modal({
    show: "false",
  });
}
