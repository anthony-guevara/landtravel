$(document).ready(function (){
	console.log("Carga JS!");
	tabletours();
});

$('#button-create').click(function(){
	var parametros = 
	{
		fechafin :  $("#fechafin").val(),
		pais :$("#create-pais option:selected").val(),
		destino :$("#create-ciudad option:selected").val(),
		lugar: $("#create-lugarturistico option:selected").val(),
		guiaturismo : $("#create-guiaturismo option:selected").val(),
		precioruta : $("#create-precioRutas").val(),
		transporte : 1,
		hotel :	1,
		idtour : getParameterByName('tour')
	};
	
	console.log(parametros);

	$.ajax({
		type:"POST",
		data: parametros,
		datatype:'Json',
		url:"../ajax/agregar-ruta.php",
		success:function(resultado){
			console.log(resultado);
			let res = JSON.parse(resultado);
			if(res[0] == "Si"){
				console.log("Si se creo");	
				$("#create-precioTotal").val("L."+res[1]);
				$("#fechafin").val("");
				$("#create-pais").val("");
				$("#create-ciudad").val("");
				$("#create-lugarturistico").val("");
				$("#create-guiaturismo").val("");
				$("#create-precioRutas").val("");
				$("#create-transporte").val("");
				$("#create-hotel").val("");
				$("#cambiar-nruta").html("");
				$("#cambiar-nruta").append(`
				<label>Fecha a Finalizar Ruta ${res[3]}</label><br>
                <input type="date" id="fechafin"  min="${res[2]}" class="form-control" value="${res[2]}" >
				`);

				tabletours();
			}else{
				console.log("No se creo");
			}
		}
	});
});






$("select#create-pais").change(function() {
 
$.ajax({
    type: 'POST',
    url: '../procesos/getCiudad-Pais.php',
    data: {id:$("#create-pais option:selected").val()},
    success: function(resp) {

                a= JSON.parse(resp);
                $("#create-ciudad").html("");
                $("#create-ciudad").append('<option value="" disabled selected hidden>-</option>');
                for(var i=0; i<=a.length-1; i++) {
                    $("#create-ciudad").append(`
                        <option value="${a[i][0]}">${a[i][2]}</option>
                        `);
                }
  }  
});
});


$("select#create-ciudad").change(function() {
	console.log($("#create-ciudad option:selected").val());
$.ajax({
    type: 'POST',
    url: '../procesos/getLugTuris-Ciudad.php',
	data: {id:$("#create-ciudad option:selected").val()},

    success: function(resp) {
                a= JSON.parse(resp);
                $("#create-lugarturistico").html("");
                $("#create-lugarturistico").append('<option value="" disabled selected hidden>-</option>');
                for(var i=0; i<=a.length-1; i++) {
                    $("#create-lugarturistico").append(`
                        <option value="${a[i][0]}">${a[i][1]}</option>
                        `);
                }
  }  
});
});


	function getParameterByName(name, url) {
		if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, '\\$&');
		var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, ' '));
	}

	function tabletours(){

			console.log(getParameterByName('tour'));
		$.ajax({
			type:"POST",
			data: {idtour: getParameterByName('tour')} ,
			datatype:'Json',
			url:"../procesos/obtenDatos-Rutas.php",
			success:function(resultado){
				console.log(resultado);
				let res = JSON.parse(resultado);
				if(res){
					$("#contenido").html(``);
		for(var i=0; i<=res.length-1; i++) {
			$("#contenido").append(`
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
				}else{
					console.log("No se creo");
				}
			}
		});
	}
