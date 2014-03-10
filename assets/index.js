	tiempo_fade = 2000;

	function agregar(){
		$('#moduloListar').fadeOut(tiempo_fade);
		$('#moduloAgregar').fadeIn(tiempo_fade);
		$('#moduloEliminar').fadeOut(tiempo_fade);
		$('#moduloActualizar').fadeOut(tiempo_fade);
	}

	function listar(){
		$('#moduloListar').fadeIn(tiempo_fade);
		$('#moduloAgregar').fadeOut(tiempo_fade);
		$('#moduloEliminar').fadeOut(tiempo_fade);
		$('#moduloActualizar').fadeOut(tiempo_fade);
	}

	function eliminar(){
		$('#moduloEliminar').fadeIn(tiempo_fade);
		$('#moduloAgregar').fadeOut(tiempo_fade);
		$('#moduloListar').fadeOut(tiempo_fade);
		$('#moduloActualizar').fadeOut(tiempo_fade);
	}

	function actualizar(){
		$('#moduloActualizar').fadeIn(tiempo_fade);
		$('#moduloAgregar').fadeOut(tiempo_fade);
		$('#moduloListar').fadeOut(tiempo_fade);
		$('#moduloEliminar').fadeOut(tiempo_fade);
	}


