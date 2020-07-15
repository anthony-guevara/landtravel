$(document).ready(function (){
    console.log("Carga JS!");
    
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
}

function ShowModal(){
    if(true)
    console.log("Entra");
    $("#modalComprar").modal("show");
}

function verificarsesion(id){
    if(false){
        ShowModal();
    }else{
        window.location.href = "comprarpaquete.php?tour="+id+"&accion=comprar";
    }
}


function imprimirfactura(id,usua){
    $( "#factura" ).submit(function( event ) {
        window.open('factura.php?id='+id+'&usua='+usua, '_blank');
        event.preventDefault();
      });
}

/* PASAR VARIABLES A OTRA PAGINA 
<script>
window.location.href = 'pagina.php?Variable=X'
</script>

Y luego desde la página php recuperar el valor de variable con:
Request.Querystring("Variable")
 */