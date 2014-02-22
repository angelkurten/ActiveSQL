<?php
	require_once('core/lib.php');
	
	//clase para manejo de la base de datos
	abstract class db
	{
		//variables de conexion
		private static $db_host = 'localhost';
		private static $db_user = 'root';
		private static $db_pass = '';
		private static $set_charset = 'utf8';
		private static $driver = 'mysql';
		protected $db_name = 'active';

		protected $query;
		protected $rows = array();
		private $conn;
		public $mensaje = '';
		

		//metodos abstractos para el CRUD
		abstract protected function get($table);
		abstract protected function save($table);
		abstract protected function edit($table);
		abstract protected function delete($table);

		//metodo para conectar con la base de datos
		private function open_connection(){
			/* cambiar el conjunto de caracteres a utf8 */
			//$this->conn->set_charset(self::$set_charset);
			try {
			    $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
			} catch (Exception $e) {
			  die('No se pudo conectar: ' . $e->getMessage());
			}
		}

		//metodo para desconectarme de la base de datos
		private function close_connection()
		{
			$this->conn = null;
		}

		//ejecutar una query de tipo INSERT;DELETE;UPDATE
		protected function executeQuery()
		{
			//abrir conexion
			$this->open_connection();
			//preparar la consulta
			$result=$this->conn->query($this->query);	
			//cerrar conexion
			$this->close_connection();
		}

		//traer los resultados de una consulta tipo SELECT
		protected function getQuery()
		{
			//abro la conexion
			$this->open_connection();
			//ejecutar la consulta
			var_dump($this->query);
			$result = $this->conn->query($this->query);
			//crear el array con los resultados
			while($this->rows[] = $result->fetch_object());
			//cierro la conexion
			$this->close_connection();
			//elimino e ultimo valor del vector
			array_pop($this->rows);
			return $result;
		}
	}
