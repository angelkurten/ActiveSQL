<?php
	error_reporting(0);
	function showErrors ($numero, $error, $archivo, $linea) {
		echo 'Ha ocurrido un error en el archivo ' . $archivo . ', la linea ' . $linea . '<br/> ERROR: ' . $error . '<br/>';
	}

	set_error_handler('showErrors'); 
?>