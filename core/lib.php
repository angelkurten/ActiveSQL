<?php
	/**
	* Archivo para almacenar las librerias y funcion utilitarias en la aplicacion
	* Autor: AngelKurten
	*/

	//Funcion para personalizar los errores de PHP
	function showErrors ($numero, $error, $archivo, $linea) {
		echo '<br/>Ha ocurrido un error en el archivo ' . $archivo . ', la linea ' . $linea . '<br/> ERROR: ' . $error . '';
	}
	set_error_handler('showErrors');

	//funcion para llamar importar librerias
	function import($lib)
	{
		//capturador de error
		try 
		{
			//detectando si es un string
			if (gettype($lib)=='string') {
				//importando y verificando si se importo la libreria
				if (!include_once($lib)) {
					//enviando una exepcion con un mensaje de error
					throw new Exception("Ha ocurrido un error a la hora de imprtar la libreria ".$lib);
				}
			}
			//detectando si es un array
			elseif (gettype($lib)=='array') {
				//recorriendo el array
				foreach ($lib as $key => $value) {
					//detectando si es un string
					if (gettype($value)!=='string') {
						//enviando una exepcion con un mensaje de error
						throw new Exception("Estas tratando	 de importar un archivo incorrecto ".$value);
					}
					//importando y verificando si se importo la libreria
					elseif(!include_once($value)) {
						//enviando una exepcion con un mensaje de error
						throw new Exception("Ha ocurrido un error a la hora de importar la libreria ".$value);
					}
				}
			}
			else
			{
				//si el tipo de dato no es array y tampoco string envia un error
				throw new Exception("Estas tratando	 de importar un archivo incorrecto ".$value);
			}			
		} 
		catch (Exception $e)
		{
			//mostrando el error capturado en pantallas
			echo '<br><b>Error de Import: ',  $e->getMessage(), "\n</b>";
		}
	}

    class myLogger  {
 
        protected $_path;
        protected $_fileName = 'logger.log';
        /**
         * @param string $path can be a directory o a file path
         */
        public function __construct() {
        	$path="C:\wamp\www\ActiveSQL/logs";
        	var_dump($path);
            if (empty($path)){
                Throw new Exception("Path must be filled");
            }
            if (!file_exists($path)) {
                Throw new Exception("The Path doesn't exists.");
            }
            if (!is_writeable($path)) {
                Throw new Exception("You can write on the give path");
            }
            $this->_path = $this->_parsePath($path);
        }   
 
        /**
         * Validate the path the add the filename to the path
         * @param String $path
         * @return String
         */
        protected function _parsePath($path) {
            $strLenght = strlen($path);
            $lastChar = substr($path, $strLenght - 1, $strLenght);
            $path = $lastChar != "/" ? $path . "/" : $path;
 
            if ( is_dir($path) ) {
                return $path . $this->_fileName;
            } else {
                return $path;
            }
        }
 
        /**
         * Will save the path on the give path
         * @param String $line
         */
        protected function _save($line) {
            $fhandle = fopen($this->_path, "a+");
            fwrite($fhandle, $line);
            fclose($fhandle);
        }
 
        /**
         * main function to add lines to the logging file
         * @param String $line
         */
        public function addLine($line){
            $line = is_array($line) ? print_r($line, true) : $line;
            $line = date("d-m-Y h:i:s") . ": $line\n";
            $this->_save($line);
        }
    }
?>