<?php

	require_once('core/lib.php');

	$libs=array('core/active.php');
	import($libs);

	$ac=new active;

	//consultar datos de la BD--------------------------
	echo '<hr>';
	//array con los campos a seleccionar
	$array= array('nombre', 'descripcion');
	//envio a la RAM los campos a seleccionar
	$ac->select($array);
	//recupero los datos de la RAM, ejecuto la consulta y 
	//limpio la RAM
	$user=$ac->get('cursos');
	//muestro los datos en pantalla
	foreach ($user as $key => $value) {
		var_dump($value);
	}

	echo '<hr>';
	
	//actualizar datos de la BD--------------------------
	//array con el filtro
	$array=array('id'=>'1');
	//envio a la RAM los campos a filtrar
	$ac->where($array);
	//array con los datos a actualizar
	$array=array('descripcion'=>'curso uno');
	//envio a la RAM los datos a actualizar
	$ac->set($array);
	//ejecuto la consulta
	$ac->edit('cursos');

	echo '<hr>';
	//guardar datos de la BD--------------------------
	//array con los datos a guardar
	$array=array('1',"nombre'", 'descripcion', 'ie', 'it', 'p','s','pu','es');
	//envio a la RAM los datos a guardar
	$ac->values($array);
	//ejecuto la consulta
	$ac->save('cursos');

	//eliminar datos de la BD--------------------------
	/*$array=array('id'=>'1');
	$ac->where($array);
	$ac->delete('cursos');*/
?>