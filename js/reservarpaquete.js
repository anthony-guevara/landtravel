$(document).ready(function () {
  console.log("Carga JS!");
  var id = getParameterByName("tour");
  var accion = getParameterByName("accion");
  console.log(id, accion);
  CargarDatos();
});
function redireccionar() {
  window.locationf = "historial.php";
}
setTimeout("redireccionar()", 3000);

$("#botonreservar").click(function () {
  var parametros = {
    usuario: $("#user").val(),
    tarjeta: $("#nTarjeta").val(),
    cvv: $("#cvv").val(),
    fechaexp: $("#fecha-exp").val(),
    nidtour: getParameterByName("tour"),
    prima: $("#prima").val(),
  };

  $.ajax({
    method: "POST",
    data: parametros,
    datatype: "json",
    url: "../ajax/agregar-reserva.php",
    success: function (resultado) {
      console.log(resultado);
      let res = JSON.parse(resultado);
      if (res[1] == 1) {
        alert("Paquete Reservado");
        window.location = "historial.php";
      } else {
        alert("No se compro");
      }
    },
    error: (error) => {
      console.error(error);
    },
  });
});

function CargarDatos() {
  var now = new Date();

  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear() + "-" + month + "-" + day;
  $("#fecha").val(today);

  $.ajax({
    type: "POST",
    url: "../procesos/getDatos.php",
    data: { valor: getParameterByName("tour") },

    success: function (resp) {
      console.log(resp);
      a = JSON.parse(resp);
      console.log(a);
      $("#nombretour").val(a[0][1]);
      $("#tipotour").val(a[0][6]);
    },
  });
}

document.getElementById("botonComprar").addEventListener("click", function () {
  var numeroTarjeta = document.getElementById("numeroTarjeta").value;
  var esNumeroTarjetaValido = validarNumeroTarjeta(numeroTarjeta);
  var fecha = document.getElementById("fecha").value;
  var tourSeleccionado = $("#tour :selected").val();
  var esTourValido = validarTourValido(tourSeleccionado);
  console.log(esTourValido);
  var tipotour = $("#tipotour :selected").val();
  var estipotourvalido = validarTipoTour(tipotour);
  if (
    esNumeroTarjetaValido &&
    esFechaValida &&
    esTourValido &&
    estipotourvalido
  ) {
    // $.ajax({
    //     url: "http://api.com",
    //     data: `tour=${tourSeleccionado}&fecha=${fecha}&numeroTarjeta=${numeroTarjeta}&tipoTour=${tipotour}`,
    //     method:"POST",
    //     success: function(respuesta){
    //         console.log(respuesta);
    //     },
    //     error: function(error){
    //     }
    // });
  } else {
  }
});

/*
function validarTipoTour(tipotour) {

    if (tipotour == "null") {

        document.getElementById("tipotour").classList.remove("is-valid")

        document.getElementById("tipotour").classList.add("is-invalid")

        // $("#mensajetipotour").fadeIn();

        document.getElementById("mensajetipotour").style.display = "block";

        return false;

    } else {


        document.getElementById("tipotour").classList.remove("is-invalid")

        document.getElementById("tipotour").classList.add("is-valid")

        //$("#mensajetipotour").fadeOut();
        document.getElementById("mensajetipotour").style.display = "none";

        return true;
    }

}
*/

function validarNumeroTarjeta() {
  regexp = /^(?:(4[0-9]{12}(?:[0-9]{3})?)|(5[1-5][0-9]{14})|(6(?:011|5[0-9]{2})[0-9]{12})|(3[47][0-9]{13})|(3(?:0[0-5]|[68][0-9])[0-9]{11})|((?:2131|1800|35[0-9]{3})[0-9]{11}))$/;

  if (regexp.test()) {
    document.getElementById("numeroTarjeta").classList.remove("is-invalid");

    document.getElementById("numeroTarjeta").classList.add("is-valid");

    return true;
  } else {
    document.getElementById("numeroTarjeta").classList.add("is-valid");

    document.getElementById("numeroTarjeta").classList.add("is-invalid");

    return false;
  }
}

function validarTourValido(tourSeleccionado) {
  if (tourSeleccionado == "null") {
    document.getElementById("tour").classList.remove("is-valid");

    document.getElementById("tour").classList.add("is-invalid");

    // $("#mensajetour").fadeIn();

    document.getElementById("mensajetour").style.display = "block";

    return false;
  } else {
    document.getElementById("tour").classList.remove("is-invalid");

    document.getElementById("tour").classList.add("is-valid");

    //$("#mensajetour").fadeOut();
    document.getElementById("mensajetour").style.display = "none";

    return true;
  }
}

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function validaNumericos(event) {
  if (event.charCode >= 48 && event.charCode <= 57) {
    return true;
  }
  return false;
}

/*
You can use URLSearchParams which is simple and has decent (but not complete) browser support.

const urlParams = new URLSearchParams(window.location.search);
const myParam = urlParams.get('myParam');

Original

You don't need jQuery for that purpose. You can use just some pure JavaScript:

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
*/
