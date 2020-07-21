$(document).ready(function (){
    console.log("Carga JS!");
    paquetesTour();
    
});



function redirigir() {
    validarVacio("comprar-usuario");
    validarVacio("comprar-password");

    if(validarVacio("comprar-usuario")||validarVacio("comprar-password"))
        console.log("No se puede continuar");
        else
        console.log("SI puede continuar");

    document.getElementById("comprar-usuario").focus();
}
/*
function validarVacio(usuario){
    if(document.getElementById(usuario).value==''){
        console.log("Vacio");
        document.getElementById("Error-"+usuario).style.display="block";
        document.getElementById(usuario).style.borderColor="rgb(180, 0, 0)";
        return true;
    }else{
        document.getElementById("Error-"+usuario).style.display="none";
        document.getElementById(usuario).style.borderColor="rgb(221, 224, 226)";
        return false;
    }
}*/



function paquetesTour(){
    $.ajax({
        type:"POST",
        datatype:'Json',
        url:"../procesos/obtenDatos-paquetesAll.php",
        success:function(resultado){
            console.log(resultado);
            let res = JSON.parse(resultado);
            if(res){
                $("#contenido-paquetes").html("");
                console.log("Holis");
    for(var i=0; i<=res.length-1; i++) {
        $("#contenido-paquetes").append(`
        <div class="paquetes col-md-auto">
    <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="../img/Espa_a.png" alt="Card image cap">
    <div class="card-body">
      <h1 class="card-title" style="font-size:20px">${res[i][1]}</h1> <div onclick="generarmodal(${res[i][0]})" class="button" style="float: right;margin-top: -52px;padding: 9px 14px;cursor:pointer"><i class="fas fa-eye"></i></div>
      <div class="card-text" style="color:black"><i class="far fa-calendar-alt"></i> <span style="margin-left:7px"> Fecha Inicio: ${res[i][2]}</span> </div>
      <div class="card-text" style="color:black"><i class="fas fa-calendar-alt"></i> <span style="margin-left:7px"> Fecha Fin: ${res[i][3]}</span> </div>
      <div class="card-text" style="color:black"><i class="fas fa-dollar-sign"></i><span style="margin-left:10px"> Costo: ${res[i][4]}</span></div>
      <div class="card-text" style="color:black"><i class="fas fa-users"></i> Tipo de Tour: ${res[i][5]}</div>
      <div class="card-text" style="color:black"><i class="fas fa-box-open"></i> Cupos: ${res[i][6]}</div><br>
      <button onclick="verificarsesioncompra(${res[i][0]})" class="btn btn-primary">Comprar</button>    <button  href="#" style="float:right" onclick="verificarsesionreserva(${res[i][0]})" class="btn btn-primary">Reservar</button>
    </div>  
  </div>
  </div>
        `);
}
            }else{
                console.log("No se creo");
            }
        }
    });
};




function generarmodal(codigo){
    
    $.ajax({
        type:"POST",
        data: {code: codigo} ,
        datatype:'Json',
        url:"../procesos/obtenDatos-paquetesModal.php",
        success:function(resultado){
            console.log(resultado);
            let res = JSON.parse(resultado);
            if(res){
                $("#contenido-modal").html(`<div id="modal-tour" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title" id="exampleModalLabel" style="font-size: 35px;margin-left: 8em;margin-bottom: -2px;">${res[0][0]}</h1>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Pais</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Lugar Turistico</th>
                  </tr>
                </thead>
                <tbody id="bodymodal">
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                </tbody>
              </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>`);
              $("#bodymodal").html("");
    for(var i=0; i<=res.length-1; i++) {
        $("#bodymodal").append(`
            <tr>
            <th>${res[i][9]}</th>
            <td>${res[i][7]}</td>
            <td>${res[i][8]}</td>
            <td>${res[i][6]}</td>
          </tr>
        `)};       
        launchmodal();
        }
    }
    });
   
};

function launchmodal(){
$("#modal-tour").modal("show");
};

var id=$("#valoc").val();
console.log(id);


function verificarsesioncompra(tou){
    if(id==0){
        $("#myModal").modal("show");
    }else{
        window.location.href = "comprarpaquete.php?tour="+tou+"&accion=comprar";
    }
};

function verificarsesionreserva(tou){
    if(id==0){
        $("#myModal").modal("show");
    }else{
        window.location.href = "reservarpaquete.php?tour="+tou+"&accion=reservar";
    }
};


/* PASAR VARIABLES A OTRA PAGINA 
<script>
window.location.href = 'pagina.php?Variable=X'
</script>

Y luego desde la página php recuperar el valor de variable con:
Request.Querystring("Variable")
 */