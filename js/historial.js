$(document).ready(function () {
  console.log("Carga JS Historial!");

  console.log($("#user").val());
  tablehistorial();
  tablehistorialreserva();
});

function tablehistorial() {
  $.ajax({
    type: "POST",
    data: { usuario: $("#user").val() },
    datatype: "Json",
    url: "../procesos/obtenDatos-historial.php",
    success: function (resultado) {
      console.log(resultado);
      let res = JSON.parse(resultado);
      if (res) {
        $("#contenido-historial").html(``);
        for (var i = 0; i <= res.length - 1; i++) {
          $("#contenido-historial").append(`
			<tr>
            <td>${res[i][0]}</td>
            <td>${res[i][1]}</td>
			<td>${res[i][2]}</td>
			<td>${res[i][3]}</td>
			<td>${res[i][4]}</td>
			<td>${res[i][5]}</td>
          </tr>
			`);
        }
      } else {
        console.log("No se creo");
      }
    },
  });
}

function tablehistorialreserva() {
  $.ajax({
    type: "POST",
    data: { usuario: $("#user").val() },
    datatype: "Json",
    url: "../procesos/obtenDatos-historial-reserva.php",
    success: function (resultado) {
      console.log(resultado);
      let res = JSON.parse(resultado);
      if (res) {
        $("#contenido-historial-reserva").html(``);
        for (var i = 0; i <= res.length - 1; i++) {
          $("#contenido-historial-reserva").append(`
			<tr>
            <td>${res[i][0]}</td>
            <td>${res[i][1]}</td>
			<td>${res[i][2]}</td>
			<td>${res[i][3]}</td>
			<td>${res[i][4]}</td>
			<td>L.${res[i][5]}</td>
			<td>L.${res[i][6]}</td>
			<td>L.${res[i][7]}</td>
          </tr>
			`);
        }
      } else {
        console.log("No se creo");
      }
    },
  });
}
