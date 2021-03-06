<?php
	//require_once('core/lib.php');
	require_once 'config.php';
	//clase para manejo de la base de datos
	abstract class db
	{
		//variables de conexion
		private static $db_host = HOST;
		private static $db_user = USER;
		private static $db_pass = PASS;
		private static $set_charset = CHARSET;

		public $cache = CACHE;
		
		protected $db_name = DBNAME;

		protected $query;
		protected $rows = array();
		private $conn;
		public $mensaje = FALSE;

		private $debug = DEBUG;
		

		//metodos abstractos para el CRUD
		abstract protected function get($table);
		abstract protected function save($table);
		abstract protected function edit($table);
		abstract protected function delete($table);

		//metodo para conectar con la base de datos
		private function open_connection(){	
			try {
			    $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
			    $this->conn->set_charset(self::$set_charset);
			} catch (mysqli_sql_exception $e) {
			  	die('No se pudo conectar: ' . $e->getMessage());
			}
		}

		//metodo para desconectarme de la base de datos
		private function close_connection(){
			$this->conn = null;
		}

		//ejecutar una query de tipo INSERT;DELETE;UPDATE
		protected function executeQuery(){
			try{
				//abrir conexion
				$this->open_connection();
				//preparar la consulta
				$result=$this->conn->query($this->query);	
				//cerrar conexion
				$this->close_connection();
				return $result;
			} catch (Exception $e){
				die('Error al ejecutar la consulata: '.$e->getMessage());
			}
		}

		//traer los resultados de una consulta tipo SELECT
		protected function getQuery()
		{
			try {
				//abro la conexion
				$this->open_connection();
				if($this->cache)
				{
					$this->query = '/*qc=on*/'. $this->query;
				}
				if ($this->debug==TRUE) {
					var_dump($this->query);
				}
				//ejecutar la consulta
				$result = $this->conn->query(addslashes($this->query));
				//cierro la conexion
				$this->close_connection();
				return $result;	
			} catch (Exception $e) {
				die('Error al ejecutar la consulata: '.$e->getMessage());
			}
		}
	}
