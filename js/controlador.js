$(document).ready(function() {
	//alertify.success("¡Bienvenido!");
	console.log("Funciona JS");
	alertify.success('Bienvenido');
})

$('#iniciar-sesion').click(function(){
	var parametros = {
		'usuario': $("#login-usuario").val(),
		'contrasenia': $("#login-contraseña").val(),
	};
	console.log(parametros);
	
	if($("#login-usuario").val()=="" || $("#login-contraseña").val()==""){
		alert("Datos vacios");
}else{
	$.ajax({
		type:"POST",
		data: parametros,
		datatype:'json',
		url:"../ajax/procesador-login.php",
		success:function(r){
			console.log(r);
			datos=jQuery.parseJSON(r);
			console.log(datos["codigo"]);
			if(datos["codigo"]==1){
				location.href='index.php';					
			}else{
				console.log("no se pudo registrar");
				alertify.error('No concuerdan los datos');
			}
		}
	
	});
}
});




/*

$("#btn-publicar").click(function(){
    console.log($("#txtPub-modal").val());
    console.log($("#nombre").text());

    var parametros= 
    "nombre="+$("#nombre-lg").text()+
    "&"+"apellido="+$("#apellido").text()+
    "&"+"mensaje="+$("#txtPub-modal").val();

    console.log(parametros);
    
	$.ajax({
		url: "ajax/guardar-post-perfil.php",
		method: "POST",
		data: parametros,
		success:function(){
            console.log();
            console.log("Si guardo");
            $("#all-public").html("");
            cargarPostNoticias();
           
        },
		error: function(error){
           console.log(error);
		}
    });	
    
}); */