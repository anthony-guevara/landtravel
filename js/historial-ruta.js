$(document).ready(function (){
	console.log("Carga JS Historial!");
	console.log($("#user").val());
});

$('#filtro').click(function(){

	var parametros = 
	{
		usuario: $("#user").val(),
		fechainicio: $("#fechainicio").val(),
		fechafin: $("#fechafin").val()
	};
	console.log(parametros);
	
	$.ajax({
		type:"POST",
		data: parametros,
		datatype:'Json',
		url:"../procesos/obtenDatos-hruta.php",
		success:function(resultado){
			console.log(resultado);

			let res = JSON.parse(resultado);
			if(res){			
				console.log(res[0][0]);	
				$("#contenido-hruta").html("");
				for(var i=0; i<=res.length-1; i++) {
			$("#contenido-hruta").append(`
			<tr>
            <td>${res[i][0]}</td>
            <td>${res[i][1]}</td>
			<td>${res[i][2]}</td>
			<td>${res[i][3]}</td>
			<td>8</td>
          </tr>
			`);
			}
			}else{
				alert("No existe dato para esas fechas");
			}
		
		}
	})
});
