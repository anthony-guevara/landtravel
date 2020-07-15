$(document).ready(function() {
	//alertify.success("¡Bienvenido!");
	console.log("Funciona JS regustro");
})

$('#button-registrar').click(function(){

	var parametros = 
	{
		pnombre : $("#primer-nombre").val(),
		papellido : $("#primer-apellido").val(),
		correo : $("#registro-correo").val(),
		identidad : $("#registro-identidad").val(),
		telefono : $("#telefono").val(),
		direccion : $("#registro-direccion").val(),
		pasaporte : $("#pasaporte").val(),
		exp : $("#registro-exp").val(),
		fechaNac : $("#registro-fechaNac").val(),
		contrasenia : $("#registro-contrasenia").val(),
		pais :	$("#registro-pais option:selected").val(),
		tipo :	$("#registro-tipo option:selected").val(),
		genero :	$("#registro-genero option:selected").val()
	};
	
	console.log(parametros)
	;

	$.ajax({
		type:"POST",
		data: parametros,
		datatype:'Json',
		url:"../ajax/agregar-persona.php",
		success:function(resultado){
			console.log(resultado);
			res=jQuery.parseJSON(resultado);
			console.log(res[0]);
			if(res[0] == 1){
				alert("Usuario Registrado Correctamente");
				location.href='login.php';					
			}else{
				alert(res[0]);
			}
		}
	});
});



