Swal.fire({
	title: 'Estimado Usario',
	text: 'Su tarjeta es inválida',
	icon: 'warning',
	confirmButtonText: 'Aceptar',
	footer:'¡Importante!',
	backdrop:true,
	position:'center',
	allowOutsideClick:false,
	allowEscapeKey:false,
	allowEnterKey:false,
	stopKeydownPropagation: false,
	showConfirmButton:true,
	confirmButtonColor: '#2980B9',
	confirmButtonAriaLabel: 'Aceptar',
	buttonsStyling:true,
	showCloseButton: true,
	closeButtonAriaLabel:'cerrarAlerta',
});