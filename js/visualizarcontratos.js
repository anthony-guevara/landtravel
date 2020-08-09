$(document).ready(function (){
    console.log("Carga JS!");
   
   
});





function cambiar(){
  $('#direccion').attr("disabled", true);
   
   $('#telefono').attr("disabled", true);
   console.log("cambio de empleado");


   

};

// $('#inputEmpleado').change(cambiar());



$("select#inputEmpleado").change(function() {

 
    $.ajax({
        type: 'POST',
        url: '../procesos/getContrato-Empleado.php',
        data: {id:$("#inputEmpleado option:selected").val()},
        success: function(resp) {
            console.log(resp);
                    a= JSON.parse(resp);
                    $("#vc-identidad").val(a[0][0]);
                    $("#vc-ncontrato").val(a[0][1]);
                    $("#vc-pnombre").val(a[0][2]);
                    $("#vc-papellido").val(a[0][3]);
                    $("#tipo_empleado").val(a[0][4]);
                    $("#tipo_contrato").val("Trabajo");
                    $("#direccion").val(a[0][5]);
                    $("#fechanac").val(a[0][6]);
                    $("#telefono").val(a[0][7]);
                    $("#nacionalidad").val(a[0][8]);

      }  
    });
    cambiar()});


    function editarContrato(){
     


      $('#direccion').attr("disabled", false);
      
      $('#telefono').attr("disabled", false);
     console.log("hago click desde editar");
    
   
    
   };
   function guardarContrato(){
    var direccion =$('#direccion').val();
    var telefono =$('#telefono').val();
    var id=$("#inputEmpleado option:selected").val();
    console.log(id);

  //   var identidad =$("#vc-identidad").val();
  //   var contrato=$("#vc-ncontrato").val();
  //  var nombre=$("#vc-pnombre").val();
  //   var apellido=$("#vc-papellido").val();
  //  var tipoempleado=$("#tipo_empleado").val();
  //  var tipocontrato= $("#tipo_contrato").val("Trabajo");
  //   var fecha=$("#fechanac").val();
  // var  nacionalidad= $("#nacionalidad").val();


parametros({
  accion:"guardarContrato ",
  direccion:direccion,
  telefono:telefono,
  id:id,


})

$.ajax({
url:"../procesos/getContrato-Empleado.php",
method:"POST",
dataType: "json",
data:parametros,
success: function (respuesta) {
  console.log(respuesta);
  if (respuesta.codigo == 1) {
    
  } else {
    alert(respuesta.mensaje);
  }
},
error: function (error) {
  console.log(error);
},
});
}


function eliminar(){
  
  var id=$("#inputEmpleado option:selected").val();


  parametros({
    accion:"eliminarContrato ",
   
    id:id,
  
  
  })


  $.ajax({
    url: "../procesos/getContrato-Empleado.php",
    method: "POST",
    dataType: "json",
    data: parametros,
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.codigo == 1) {
        
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




      