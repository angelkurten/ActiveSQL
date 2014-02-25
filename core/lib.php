<?php
    	
	/**
	 * Archivo para almacenar las librerias y funcion utilitarias en la aplicacion
	 * Autor: AngelKurten
	 * 
	 */

	//Funcion para personalizar los errores de PHP
	function showErrors ($numero, $error, $archivo, $linea)
	{
		echo '<style>
				#errorActiveSQlhas23432{
					border:1px solid rgba(250,20,20,0.2);
					background-color: rgba(50,20,20,0.2);
					width: 100%;
					margin-top: 20px;
				}
				#errorActiveSQlhas23432 td{
					text-align: center;
				}
				#errorActiveSQlhas234324sf{
					border-bottom: 1px solid rgba(250,20,20,0.2);
				}
			</style>';
		echo '<table style="border-width=10px ;" id="errorActiveSQlhas23432">
				<tr>
					<td id="errorActiveSQlhas234324sf">TIPO ERROR</td>
					<td id="errorActiveSQlhas234324sf">ERROR #</td>
					<td id="errorActiveSQlhas234324sf">ARCHIVO</td>
					<td id="errorActiveSQlhas234324sf">LINEA</td>
					<td id="errorActiveSQlhas234324sf">DESCRIPCION</td>
				</tr>
				<tr>
					<td>FATAL ERROR</td>
					<td>'.$numero.'</td>
					<td>'.$archivo.'</td>
					<td>'.$linea.'</td>
					<td>'.$error.'</td>
				</tr>
			</table>';
	}
	set_error_handler('showErrors');

	//funcion para llamar importar librerias
	function import($lib)
	{
		//capturador de error
		try 
		{
			//detectando si es un string
			if (gettype($lib) == 'string') {
				//importando y verificando si se importo la libreria
				if (!include_once($lib)) {
					//enviando una exepcion con un mensaje de error
					throw new Exception('Ha ocurrido un error a la hora de imprtar la libreria ' . $lib);
				}
			}
			//detectando si es un array
			elseif (gettype($lib) == 'array') {
				//recorriendo el array
				foreach ($lib as $key => $value) {
					//detectando si es un string
					if (gettype($value) !== 'string') {
						//enviando una exepcion con un mensaje de error
						throw new Exception('Estas tratando de importar un archivo incorrecto ' . $value);
					}
					//importando y verificando si se importo la libreria
					elseif (!include_once($value)) {
						//enviando una exepcion con un mensaje de error
						throw new Exception('Ha ocurrido un error a la hora de importar la libreria ' . $value);
					}
				}
			}
			else {
				//si el tipo de dato no es array y tampoco string envia un error
				throw new Exception('Estas tratando de importar un archivo incorrecto ' . $value);
			}			
		} 
		catch (Exception $e)
		{
			//mostrando el error capturado en pantallas
			echo '<br><b>Error de Import: ',  $e->getMessage(), "\n</b>";
		}
	}

	//funcion para medir el tiempo de ejecucion de una consulta
	function microtime_float()
	{
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	}
