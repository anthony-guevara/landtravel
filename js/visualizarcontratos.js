$(document).ready(function (){
    console.log("Carga JS!");
});


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
    });