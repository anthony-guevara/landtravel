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
            for (var i = 0; i < respuesta.length; i++) {
                $("#contenido-ciudades").append(
                    `
                <tr>
                  <td>${respuesta[i].nombre}</td>
                  <td>${respuesta[i].nombre}</td>
                  <td>${respuesta[i].descripcion}</td>
                  <td>
                  <button class=""  onclick="eliminarCiudad()">Eliminar<i class="fas fa-window-close"></i></button>
                  <button class=""  onclick="editarCiudad('${respuesta[i].nombre}','${respuesta[i].nombre}','${respuesta[i].descripcion}',${respuesta[i].id})">editar<i class="fas fa-edit"></i></button>
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

function editarCiudad(nombrepais,nombreciudad,descripcion,idciudad) {
    console.log("editando");
    $('#modalciudad').modal('show');
    console.log(nombrepais,nombreciudad,descripcion,idciudad);


    /*valor de el pais a editar*/
   
        $("#nombrePais").append(
            ` <option id="pais">${nombrepais}</option><br>`
        );
 

        $("#nombreciudad").val(nombreciudad);
        $("#descripcion").val(descripcion);
        $("#idciudad").val(idciudad);

        

}

        
 $('#guardarciudad').on('click',()=>{console.log('hago click')


 var nombrepais=$('#nombrepais').val();
 var nombreciudad=$('#nombreciudad').val();
 var descripcion=$('#descripcion').val();
var idciudad=$('#idciudad').val();
console.log(idciudad);


var parametros ={
    nombrepais:nombrepais,
    nombreciudad:nombreciudad,
    descripcion:descripcion,
    idciudad:idciudad,
    accion:'editarciudad'
  }

  $.ajax({
    url: "../ajax/crud-ciudades.php",
    method: "POST",
     dataType: "json",
     data: parametros,
     success: function (respuesta) {
       console.log(respuesta);
       if (respuesta.codigo == 1) {
        cargarciudades();
         $('#modalciudad').modal('hide');

       } else {
         alert(respuesta.mensaje);
       }
 },
     error: function (error) {
     console.log(error);
 },

});

  })

    



function cerrar() {

    $('#modalpais').modal({
      show: 'false'
    });
  
  }