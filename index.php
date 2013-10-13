<?php
	error_reporting(0);
	require_once('core/active.php');
	require_once('core/errors.php');
	//creo el objeto active	
	$ac= new active();
	//array con los campos a seleccionar
	$array= array('nombre', 'descripcion');
	//envio a la RAM los campos a seleccionar
	$ac->select($array);
	//array con el filtro a aplicar a los datos
	$array= array('id'=>'1');
	//envio a la RAM los filtros a aplicar
	$ac->where('s');
	//recupero los datos de la RAM y ejecuto la consulta, 
	//por ultimo limpio la RAM
	$videos=$ac->get('videos');
	//muestro los datos en pantalla
	foreach ($videos as $key => $value) {
		var_dump($value);
	}

	echo '<hr>';
	//recupero los datos de la RAM, ejecuto la consulta y 
	//limpio la RAM
	$user=$ac->get('cursos');
	//muestro los datos en pantalla
	foreach ($user as $key => $value) {
		var_dump($value);
	}
?>