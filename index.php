<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php

	require_once('core/active.php');

	echo '<hr>';
	ini_set('memory_limit', '-1');
	//UTILIZANDO ACTIVEPHP
	//iniciar el tiempo de ejecion
	$time_start = microtime_float();

		//consultar datos de la BD-------------------------
		//$array=array('Cod_Dpto'=>1);
		//envio a la RAM los campos a filtrar
		//$ac->where($array);
		//$ac->groupBy(array('apellido'));
		$ac->limit(10);
		//array con los campos a seleccionar
		$array= array('*');		
		//envio a la RAM los campos a seleccionar
		$ac->select($array);
		$ac->join('departamentos','departamentos.Cod_Dpto=personas.Cod_Dpto');
		$ac->join('ciudades','ciudades.Cod_Ciudad=personas.Cod_Ciudad');
		//recupero los datos de la RAM, ejecuto la consulta y 
		//limpio la RAM
		$user=$ac->get('personas')->object();
		
	//finalizar el tiempo de ejecucion
	$time_end = microtime_float();
	//medir el tiempo de ejecucion
	$time_total = $time_end - $time_start;
	//mostrar el tiempo de ejecuion
	echo "Se han consultado ".count($user)." registros en $time_total segundos";
	echo "<br>";
	var_dump($user);
?>

</body>
</html>
