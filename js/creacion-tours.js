$(document).ready(function () {
  console.log("Carga JS!");
});

// $('#button-create').click(function(){

// 	var parametros =
// 	{
// 		c_dias : $("#create-dias").val(),
// 		c_noches :  $("#create-noches").val(),
// 		pais :$("#create-pais option:selected").val(),
// 		ciudad :$("#create-ciudad option:selected").val(),
// 		lugarTuristico : $("#create-lugarturistico option:selected").val(),
// 		guiaturismo : $("#create-guiaturismo option:selected").val(),
// 		precioruta : $("#create-precioRutas").val(),
// 		transporte : $("#create-transporte option:selected").val(),
// 		hotel :	$("#create-hotel option:selected").val()
// 	};

// 	console.log(parametros);

// 	$.ajax({
// 		type:"POST",
// 		data: parametros,
// 		datatype:'Json',
// 		url:"------------",
// 		success:function(resultado){
// 			console.log(resultado);
// 			let res = JSON.parse(resultado);

// 			if(res.signed === true){
// 				console.log("Si se creo");
// 				//$('#baba').prop('selectedIndex',0);
// 				//$('input[name=checkListItem').val('');
// 			}else{
// 				alerty.error("No se creo");
// 			}
// 		}
// 	});
// });

$("select#create-pais").change(function () {
  $.ajax({
    type: "POST",
    url: "../procesos/getCiudad-Pais.php",
    data: { id: $("#create-pais option:selected").val() },
    success: function (resp) {
      a = JSON.parse(resp);
      $("#create-ciudad").html("");
      $("#create-ciudad").append(
        '<option value="" disabled selected hidden>-</option>'
      );
      for (var i = 0; i <= a.length - 1; i++) {
        $("#create-ciudad").append(`
                        <option value="${a[i][0]}">${a[i][2]}</option>
                        `);
      }
    },
  });
});

$("select#create-ciudad").change(function () {
  $.ajax({
    type: "POST",
    url: "../procesos/getLugTuris-Ciudad.php",
    data: { id: $("#create-ciudad option:selected").val() },
    success: function (resp) {
      a = JSON.parse(resp);
      $("#create-lugarturistico").html("");
      $("#create-lugarturistico").append(
        '<option value="" disabled selected hidden>-</option>'
      );
      for (var i = 0; i <= a.length - 1; i++) {
        $("#create-lugarturistico").append(`
                        <option value="${a[i][0]}">${a[i][1]}</option>
                        `);
      }
    },
  });
});

$("select#create-ciudad").change(function () {
  $.ajax({
    type: "POST",
    url: "../procesos/getHoteles-Ciudad.php",
    data: { id: $("#create-pais option:selected").val() },
    success: function (resp) {
      a = JSON.parse(resp);
      $("#create-hotel").html("");
      $("#create-hotel").append(
        '<option value="" disabled selected hidden>-</option>'
      );
      for (var i = 0; i <= a.length - 1; i++) {
        $("#create-hotel").append(`
							<option value="${a[i][0]}">${a[i][1]}</option>
							`);
      }
    },
  });
});

$("#btncrear").on("click", () => {
  var nombreTour = $("#nombreTour").val();
  var fechaInicio = $("#fechaInicio").val();
  var cupos = $("#cupos").val();
  var tipoTour = $("#create-tipotour option:selected").val();

  var esNombreValido = validarNombreTour(nombreTour);
  var esFechaValida = validarFecha(fechaInicio);
  var esCupoValido = validarCupos(cupos);
  var esTipoValido = validarTipoTour(tipoTour);

  if (esNombreValido & esFechaValida & esCupoValido & esTipoValido) {
    //hace llamado ajax
    console.log("Cumplio todas las validaciones");

    var parametros = {
      Nombre: nombreTour,
      fecha: fechaInicio,
      cupos: cupos,
      tipos: tipoTour,
    };

    $.ajax({
      url: "../ajax/agregar-tour.php",
      method: "POST",
      data: parametros,
      dataType: "json",
      success: (respuesta) => {
        console.log(respuesta);

        if (respuesta.codigo == 1) {
          window.location.href = `creacion-rutas.php?tour=${respuesta.id}`;
        } else {
          alert(respuesta.mensaje);

          window.location.href = "creacion-tours.php?error=1";
        }
      },
      error: (error) => console.log(error),
    });
  } else {
    return;
  }
});

function validarNombreTour(nombreTour) {
  if (nombreTour != "") {
    $("#mensajeTour").fadeOut();
    return true;
  } else {
    $("#mensajeTour").fadeIn();
    return false;
  }
}

function validarFecha(fecha) {
  var fechaInicio = new Date(fecha);
  var fechaActual = new Date();

  if (fechaInicio.getTime() > fechaActual.getTime()) {
    $("#mensajeFecha").fadeOut();
    return true;
  } else {
    $("#mensajeFecha").fadeIn();
    return false;
  }
}

function validarCupos(cupos) {
  if (cupos > 0) {
    return true;
  } else {
    return false;
  }
}

function validarTipoTour(tipoTour) {
  if (tipoTour != "null") {
    return true;
  } else {
    return false;
  }
}
