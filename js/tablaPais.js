$(document).ready(function () {
  console.log("Carga js");

  cargarPaises();
});



function cargarPaises() {
  var parametros = {
    accion: "traerpaises",
  };
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
            <button class="btn buttones"  onclick="eliminarPais(${respuesta[i].id})"> <i class="fas fa-window-close"></i></button>
            <button class="btn buttones"   data-toggle="modal" data-target="#modalpais" onclick="editarPais(${respuesta[i].id},'${respuesta[i].nombre}','${respuesta[i].gentilicio}','${respuesta[i].codigo}')"> <i class="fas fa-edit"></i></button>
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

//cargar valores a los imput
function editarPais(idPais,nombre,gentilicio,codigo) {
  $('#modalpais').modal('hide');
  console.log(idPais,nombre,gentilicio,codigo);
  


$('#nombrePais').val(nombre);
$('#gentilicio').val(gentilicio);
$('#codigo').val(codigo);
$('#idpais').val(idPais);


}

$('#guardarpais').on('click',()=>{console.log('hago click')


 var nombrepais=$('#nombrePais').val();
 var gentilicio=$('#gentilicio').val();
 var codigo=$('#codigo').val();
var idpais=$('#idpais').val();
console.log(idpais);


var parametros ={
  idpais:idpais,
  nombre:nombrepais,
  gentilicio:gentilicio,
  codigo:codigo,
  accion:'editarpais'
}


  $.ajax({
      url: "../ajax/crud-paises.php",
      method: "POST",
       dataType: "json",
       data: parametros,
       success: function (respuesta) {
         console.log(respuesta);
         if (respuesta.codigo == 1) {
           cargarPaises();
           $('#modalpais').modal('hide');

         } else {
           alert(respuesta.mensaje);
         }
   },
       error: function (error) {
       console.log(error);
   },
     });













})


  // var parametros = {
  //   accion: "editarpais",
  //   id: idPais,
   
  // };

  // $.ajax({
  //   url: "../ajax/crud-paises.php",
  //   method: "POST",
  //   dataType: "json",
  //   data: parametros,
  //   success: function (respuesta) {
  //     console.log(respuesta);
  //     if (respuesta.codigo == 1) {
  //       cargarPaises();
  //     } else {
  //       alert(respuesta.mensaje);
  //     }
  //   },
  //   error: function (error) {
  //     console.log(error);
  //   },
  // });








/*modal editar pais*/

function cerrar() {

  $('#modalpais').modal({
    show: 'false'
  });

}


 function nuevoPais(){
   console.log("hola nuevo")


    var nombrepais = $("#nombrepais").val();
    var gentilicio = $("#Gentilicio").val();
   console.log(nombrepais,gentilicio);
  
    var parametros = {
      nombrepais: nombrepais,
      gentilicio : gentilicio,
      accion: "agregarpais",
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






 