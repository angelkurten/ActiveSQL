<?php
	error_reporting(0);
	require_once('db.php');

	class active extends db
	{
		//variable para almacenar la consulta del where
		private $where="";
		//variable para almacenr los campos a filtar en el GET
		private $select="";
		//variable para mostrar mensajes
		public $mensaje="";

		public function __construct()
		{
			$this->mensaje="";
			$this->liberar();
		}

		//funcion para relizar una consulta de tipo SELECT
		public function get($table='')
		{
			$result="";
			try {
				if($this->mensaje=="")
				{
					if ($this->select!="") {
						$this->query="SELECT ". $this->select." FROM ".$table."";
					}
					else
					{
						$this->query="SELECT * FROM ".$table;
					}

					if ($this->where!="") {
						$this->query.=" WHERE ". $this->where."; ";
					}
					else
					{
						$this->query.="; ";
					}
					echo "SQL Generado: ".$this->query;
					$this->getQuery();
					$result=$this->rows;
					
				}
				else
				{
					$result=$this->mensaje;
					throw new Exception($this->mensaje);
				}
				} catch (Exception $e) {
					echo 'Error de ActiveSQL: ',  $e->getMessage(), "\n";
				}

			return $result;
		}

		//function para seleccionar campos de una tabla
		public function select($array)
		{
			if(gettype($array)!="array")
			{
				$this->mensaje="Lo sentimos el select solo acepta parametros tipo array";
			}
			else
			{
				$values=implode(" , ", $array);
				$this->select=$values;
			}
		}

		//funcion para realizar un filtrado a una consulta
		public function where($array)
		{
			if(gettype($array)!="array")
			{
				$this->mensaje= "Lo sentimos el where solo acepta parametros tipo array";
			}
			else
			{
				//extraigo todos las keys
				$columnas=array_keys($array);
				//extraigo todos los values
				$values=array_values($array);
				//creo un array definitivo con los dos arrays anteriores
				for ($i=0; $i < count($values); $i++) { 
					$sql[$i]="".$columnas[$i]. " = '". $values[$i]."'";
				}

				//creo el sql definitivo
				$sqldf= implode(" and ", $sql);
				
				$this->where=$sqldf;
			}
		}

		private function liberar()
		{
			$this->where=array();
			$this->select=array();
			$this->mensaje="";
			$this->rows=array();
		}
	}
?>