$(document).ready(function () {
    console.log("Carga js");

    cargarLugares();
});




function cargarLugares(){

    var parametros={
        accion:"traerlugaresturisticos",
    };


    $.ajax({
      url:"../ajax/crud-lugaresturisticos.php",
      method:"POST",
      dataType:"json",
      data:parametros,
      success:function (respuesta){

        console.log(respuesta);
        $("#contenido-lugares").html("");

        for( var i=0; i>respuesta.length; i++){
            $("#contenido-lugares").append(

                ` <tr>
                <td>${respuesta[i].destino}</td>
                <td>${respuesta[i].nombre}</td>
                <td>${respuesta[i].descripcion}</td>
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