<?php

	require_once('core/lib.php');

	$libs=array('core/active.php');
	import($libs);

	$ac=new active;
	echo '<hr>';
	ini_set('memory_limit', '-1');
	//UTILIZANDO ACTIVEPHP
	//iniciar el tiempo de ejecion
	$time_start = microtime_float();
		//consultar datos de la BD-------------------------
		$array=array('id'=>'3');
		//envio a la RAM los campos a filtrar
		$ac->where($array,"<");
		//array con los campos a seleccionar
		$array= array("nombre", 'id');
		//envio a la RAM los campos a seleccionar
		$ac->select($array);
		//recupero los datos de la RAM, ejecuto la consulta y 
		//limpio la RAM
		$user=$ac->get('usuarios');
	//finalizar el tiempo de ejecucion
	$time_end = microtime_float();
	//medir el tiempo de ejecucion
	$time_total = $time_end - $time_start;
	//mostrar el tiempo de ejecuion
	echo "Se han consultado ".count($user)." registros en $time_total segundos";
	echo "<br>";
	//muestro los datos en pantalla
	//for ($i=0; $i < count($user); $i++) { 
	//	var_dump($user[$i]);
	//}

	echo '<hr>';
	
	//actualizar datos de la BD--------------------------
	//array con el filtro
	//$array=array('id'=>'1');
	//envio a la RAM los campos a filtrar
	//$ac->where($array);
	//array con los datos a actualizar
	//$array=array('apellido'=>'Kurten');
	//envio a la RAM los datos a actualizar
	//$ac->set($array);
	//ejecuto la consulta
	//$ac->edit('usuarios');

	//echo '<hr>';
	//guardar datos de la BD--------------------------
	//array con los datos a guardar
	$array=array('0',"Prueba", 'Kurten', 'angelkurten@hotmail.com');
	//envio a la RAM los datos a guardar
	$ac->values($array);
	//ejecuto la consulta
	$ac->save('usuarios');

	//eliminar datos de la BD--------------------------
	/*$array=array('id'=>'1');
	$ac->where($array);
	$ac->delete('cursos');*/
?>
