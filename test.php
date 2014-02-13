
<?php
ini_set('memory_limit', '-1');
	require_once('core/lib.php');
	//UTILIZANDO EL METODO NORMAL 
	//iniciar el tiempo de ejecion
	$time_start = microtime_float();
		$conn=new mysqli('localhost', 'root','', 'active');
		$result=$conn->query("SELECT nombre, email FROM usuarios");
		//crear el array con los resultados
		while($user[]=$result->fetch_assoc());
	//finalizar el tiempo de ejecucion
	$time_end = microtime_float();
	//medir el tiempo de ejecucion
	$time_total = $time_end - $time_start;
	//mostrar el tiempo de ejecuion
	echo "Se han consultado ".count($user)." registros en $time_total segundos";
	echo "<br>";
?>
<hr>