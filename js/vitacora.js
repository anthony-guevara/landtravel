console.log(" vitacora");

$(document).ready(function () {
    console.log("Carga js");
  
    cargarvitacora();
  });
  
  function cargarvitacora(){
    var parametros = {
        accion: "traervitacora",
      };
      $.ajax({
        url: "../ajax/vitacora.php",
        method: "POST",
        dataType: "json",
        data: parametros,
        success: function (respuesta) {
          console.log(respuesta);


          
for( var i=0; i<respuesta.length; i++){
    respuesta[i].opciones = "";
  
  }
  
  $("#tabla-vitacora").DataTable().destroy();
  
  $("#tabla-vitacora").DataTable({
    data: respuesta,
    responsive: true,
    columnDefs: [
      {
        targets: -1,
        data: "id",
        render: function (data, type, row, meta) {
          return ;
        },
      },
    ],
  
    columns: [
      {
        data: "Fecha",
      },
  
      {
        data: "usuario",
      },
     
      {
        data: "Descripcion",
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
  
  
  
  
  
  
  
  
  
    
  