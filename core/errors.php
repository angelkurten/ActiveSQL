<?php
	function showErrors ($numero, $error, $archivo, $linea) {
		echo 'Ha ocurrido un error en el archivo ' . $archivo . ', la linea ' . $linea . '<br/> ERROR: ' . $error . '<br/>Las actuales variables son:' . print_r($GLOBALS, 1);
	}
	set_error_handler('showErrors'); 
?>