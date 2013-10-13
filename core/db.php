<?php
	error_reporting(0);
	//clase para el manejo de la conexion con la base de datos
	abstract class db{
		private static $db_host='localhost';
		private static $db_user='root';
		private static $db_pass='';
		protected $db_name='girucode';
		protected $query;
		protected $rows=array();
		private $conn;
		public $mensaje='';

		//metodos abtractos para el CRUD de las clases que hereden
		//mrtdo para consultar
		abstract protected function get();
		//metodo para guardar
		//abstract protected function set();
		//metodo para editar
		//abstract protected function edit();
		//metodo para borrar
		//abstract protected function delete();

		//metodo para conectar con la base de datos
		private function open_connection(){
			$this->conn= new mysqli(self::$db_host, self::$db_user,
									self::$db_pass, $this->db_name);
		}

		//metodo para desconectarme de la base de datos
		private function close_connection(){
			$this->conn->close();
		}

		//ejecutar una query de tipo INSERT; DELETE; UPDATE
		protected function excuteQuery(){
			if ($_POST){
				//abro la conexion
				$this->open_connection();
				//realizo la consulta
				$result=$this->conn->query($this->query);				
				//cierro la conexion
				$this->close_connection();
			}
			else
			{
				$this->mensaje='Metodo no permitido';
			}
		}

		//traer los resultador de una consulta tipo SELECT, en una array
		protected function getQuery(){
			try {
				//abro la conexion
				$this->open_connection();
				//realizo la consulta
				$result=$this->conn->query($this->query);
				if (!$result) {
					throw new Exception($this->conn->error);
				}
				else
				{
					//creo el array con los resultados
					while($this->rows[]=$result->fetch_assoc());
				}
				//libero la memoria
				$result->close();
				//cierro la conexion
				$this->close_connection();
				//elimino el ultimo valor del vector
				array_pop($this->rows);
			} catch (Exception $e) {
				echo '<br><b>Error de SQL: ',  $e->getMessage(), "\n</b>";
			}
		}
		
	}
?>
