<?php

	require_once('core/lib.php');

	$libs=array('core/active.php');
	import($libs);

	echo '<hr>';
	ini_set('memory_limit', '-1');
	//UTILIZANDO ACTIVEPHP
	//iniciar el tiempo de ejecion
	$time_start = microtime_float();

		//consultar datos de la BD-------------------------
		//$array=array('id'=>'3');
		//envio a la RAM los campos a filtrar
		//$ac->where($array,"<");
		//$ac->groupBy(array('apellido'));
		//$ac->limit(3);
		$array=array('id');
		$ac->orderBy($array);
		//array con los campos a seleccionar
		$array= array("nombre",'apellido', 'id');		
		//envio a la RAM los campos a seleccionar
		$ac->select($array);
		//recupero los datos de la RAM, ejecuto la consulta y 
		//limpio la RAM
		$user=$ac->get('usuarios')->object();
		
	//finalizar el tiempo de ejecucion
	$time_end = microtime_float();
	//medir el tiempo de ejecucion
	$time_total = $time_end - $time_start;
	//mostrar el tiempo de ejecuion
	echo "Se han consultado ".count($user)." registros en $time_total segundos";
	echo "<br>";
	//echo $user;
	//muestro los datos en pantalla
	for ($i=0; $i < count($user); $i++) { 
		var_dump($user[$i]);
	}
?>
