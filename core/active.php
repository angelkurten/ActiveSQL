<?php
	require_once('db.php');
	class active extends db
	{
		//variable para almacenar la consulta del where
		private $where = '';
		
		//varaiable para almacenar los camos a filtrar en el GET
		private $select = '';
		
		//variables para almacenar los campos a actualizar en el SET
		private $set = '';
		
		//variable para los values del INSERT
		private $values = '';
		
		//variable para limitar una consulta
		private $limit = '';
		
		public function __construct()
		{
			$this->mensaje = '';
		}

		//function para realizar una consulta de tipo SELECT
		public function get($table)
		{
			$result = $this->mensaje;
			
			if (!$result) {
				
				//construir consulta con o sin campos a filtrar
				$this->query = 'SELECT * FROM ' . $table;
				
				if ($this->select != '') {
					$this->query = 'SELECT ' . $this->select . ' FROM ' . $table;
				}
				
				//completar consulta con o sin filtro where
				if ($this->where != '') {
					$this->query .= ' WHERE ' . $this->where;
				}

				//limitar la consulta
				if ($this->limit != '') {
					$this->query .= $this->limit;
				}

				//ejecutar consulta
				$this->getQuery();
				$result = $this->rows;
			}
			
			//liberar memoria
			$this->liberar();
			
			//retornar el resultado
			return $result;
		}

		//funcion para guardar datos en una BD
		public function save($table)
		{
			$result = $this->mensaje;
			
			if (!$result) {
				$this->query = 'INSERT INTO ' . $table . ' VALUES ' . $this->values . ';';
				
				//ejecutar consulta
				$this->executeQuery();
				$result = $this->rows;
			}
		
			//liberar la memoria
			$this->liberar();
			return $result;
		}


		//funcion apra realizar actualizaciones en la BD
		public function edit($table)
		{
			$result = $this->mensaje;
			
			if (!$result) {
				//construir consulta con o sin where
				if ($this->set != '') {
					$this->query = 'UPDATE ' . $table . ' SET ' . $this->set;
				}
				
				if ($this->where != '') {
					$this->query .= ' WHERE ' . $this->where;
				}
				$result = $this->executeQuery();
			}
			
			//liberar la memoria
			$this->liberar();
			//retornar el resultado
			return $result;
		}

		//function para borrar campos de la BD
		public function delete($table)
		{
			if (!$this->mensaje) {
				$this->query = 'DELETE FROM '.$table;
				
				if ($this->where != '') {
					$this->query .= ' WHERE ' . $this->where;
				}
				$this->executeQuery();
			}
			$this->liberar();
		}

		//funcion para actualizar
		public function set(array $array)
		{
			//extraer las keys del array
			$columnas = array_keys($array);
			
			//extraer los values del array
			$values = array_values($array);
			
			//crear el array definitivo
			for ($i = 0; $i < count($values); $i++) { 
				$sql[$i] = "" . $columnas[$i] . " = '" . addslashes($values[$i]) . "'";
			}
			//crear el sql definitivo 
			$sqldf = implode(" and ", $sql);

			//almaceno el sql en la propiedad
			$this->set = $sqldf;
		}

		//funcion para seleccionar campos de una tabla
		public function select(array $array)
		{
			$values = implode(' , ', $array);
			$this->select = $values;
		}

		//funcion para seleccionar los values
		public function values(array $array)
		{
			$values = array_values($array);
			
			//crear un array definitivo con los arrays anteriores
			for ($i = 0; $i < count($values); $i++) {
				$sql[$i] = "'" . addslashes($values[$i]) . "'";
			}

			$values = '(' . implode(' , ', $sql) . ')';
			$this->values = $values;
		}

		//funcion para realizar consultas tipo where
		public function where( array $array)
		{
			//extraer las keys del array
			$columnas = array_keys($array);
			
			//extraer todos los values del array
			$values = array_values($array);
			
			//crear un array definitivo con los arrays anteriores
			for ($i = 0; $i < count($values); $i++) { 
				$sql[$i] = "" . $columnas[$i] . " = '" . addslashes($values[$i]) . "'";
			}
			
			//creo el sql definitivo
			$sqldf = implode(' and ', $sql);
			$this->where = $sqldf;
		}


		//funcion para limitar resultados de una consulta
		public function limit($init, $end = NULL)
		{
			try {
				if ((is_int($init)) and ($init > -1)) {
					$this->limit = ' LIMIT ' . $init;
					if (($end != NULL) and (is_int($end)) and ($end > -1)) {
						$this->limit .= ', ' . $end;
					}
				}
			} catch (Exception $e) {
				
			}	
		}

		//funcion para liberar memoria
		public function liberar()
		{
			$this->where = '';
			$this->select = '';
			$this->set = '';
			$this->values = '';
			$this->mensaje = '';
			$this->limit = '';
			$this->rows = array();
		}
	}
