<?php
	require_once('core/lib.php');
	
	//clase para manejo de la base de datos
	abstract class db
	{
		private static $db_host='localhost';
		private static $db_user='root';
		private static $db_pass='';
		private static $set_charset='utf8';
		protected $db_name='girucode';
		protected $query;
		protected $rows=array();
		private $conn;
		public $mensaje='';
		

		//metodos abstractos para el CRUD
		abstract protected function get($table);
		abstract protected function save($table);
		abstract protected function edit($table);
		abstract protected function delete($table);

		//metodo para conectar con la base de datos
		private function open_connection(){
			$this->conn= new mysqli(self::$db_host, self::$db_user,
									self::$db_pass, $this->db_name);

			if ($this->conn->connect_error) {
			    die('Error de Conexión (' . $this->conn->connect_errno . ') '
			            . $this->conn->connect_error);
			}
			/* cambiar el conjunto de caracteres a utf8 */
			$this->conn->set_charset(self::$set_charset);
		}

		//metodo para desconectarme de la base de datos
		private function close_connection(){
			$this->conn->close();
		}

		//ejecutar una query de tipo INSERT;DELETE;UPDATE
		protected function executeQuery()
		{
			//abrir conexion
			$this->open_connection();
			//realizar consulta
			$result=$this->conn->query($this->query);
			var_dump($this->query);
			//cerrar conexion
			$this->close_connection();
		}

		//traer los resultados de una consulta tipo SELECT
		protected function getQuery()
		{
			//abro la conexion
			$this->open_connection();
			//realizar la consulta
			$result=$this->conn->query($this->query);
			var_dump($this->query);
			//crear el array con los resultados
			while($this->rows[]=$result->fetch_assoc());
			//libero menomoeria
			$result->close();
			//cierro la conexion
			$this->close_connection();
			//elimino e ultimo valor del vector
			array_pop($this->rows);
		}
	}