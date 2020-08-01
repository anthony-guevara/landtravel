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

            for (var i = 0; i > respuesta.length; i++) {
                $("#contenido-lugares").append(

                    ` <tr>
                <td>${respuesta[i].destino}</td>
                <td>${respuesta[i].nombre}</td>
                <td>${respuesta[i].descripcion}</td>
                <td>
                <button class=""  onclick="eliminarlugarturistico(${respuesta[i].id})">Eliminar<i class="fas fa-window-close"></i></button>
                <button class=""  onclick="editarlugarturistico('${respuesta[i].destino}','${respuesta[i].nombre}','${respuesta[i].descripcion}',${respuesta[i].id})">editar<i class="fas fa-edit"></i></button>
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



function eliminarlugarturistico(idlugar) {

    var parametros = {
        accion: "eliminarlugarturistico",
        id: idlugar,
    };

    $.ajax({
        url: "../ajax/crud-ciudades.php",
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



function editar(nombreciudad,nombre,descripcion,idlugar) {
    $("#modallugar").modal("show");
    $("#nombreciudad").html("");
    $("#nombreciudad").append(` <option id="ciudad">${nombreciudad}</option><br>`);

    $("#nombreciudad").val(nombreciudad);
    $("#lugar").val(nombre);
    $("#Descripcion").val(descripcion);
    $("#idlugar").val(idlugar);

   

}


$("#guardarlugar").on("click", () => {
    console.log("hago click");

    var nombreciudad = $("#nombreciudad").val();
    var nombrelugar = $("#lugar").val();
    var descripcion = $("#descripcion").val();
    var idlugar = $("#idlugar").val();

    var parametros={
        accion:"guardarlugar",
        nombreciudad:nombreciudad,
        nombrelugar:nombrelugar,
        descripcion:descripcion,
        id:idlugar
    };


$.ajax({
    url: "../ajax/crud-ciudades.php",
     method:"POST",
    dataType:"json",
    data:parametros,
    success:function (respuesta) {
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







function cerrar() {
    $("#modallugar").modal({
        show: "false",
    });
}