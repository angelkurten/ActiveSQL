<?php
	require_once('db.php');

	class crud extends db{

		//variable para almacenar la consulta del where
		protected $where = '';
		
		//varaiable para almacenar los camos a filtrar en el GET
		protected $select = '';
		
		//variables para almacenar los campos a actualizar en el SET
		protected $set = '';
		
		//variable para los values del INSERT
		protected $values = '';
		
		//variable para limitar una consulta
		protected $limit = '';

		protected $orderBy = '';

		protected $groupBy = '';

		//function para realizar una consulta de tipo SELECT
		public function get($table)
		{
			$result = $this->mensaje;
			var_dump($this->mensaje);
			if ($result != TRUE) {
				echo "string";
				//construir consulta con o sin campos a filtrar
				$this->query = 'SELECT * FROM ' . $table;
				
				if ($this->select != '') {
					$this->query = 'SELECT ' . $this->select . ' FROM ' . $table;
				}
				
				//completar consulta con o sin filtro where
				if ($this->where != '') {
					$this->query .= ' WHERE ' . $this->where;
				}

				//agrupando la consulta
				if($this->groupBy != ''){
					$this->query .= $this->groupBy;
				}
 
				//ordenando la consulta
				if($this->orderBy != ''){
					$this->query .= $this->orderBy;
				}

				//limitar la consulta
				if ($this->limit != '') {
					$this->query .= $this->limit;
				}
 				
				return $this;
			}
			//liberar memoria
			$this->liberar();
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

		//funcion para liberar memoria
		public function liberar()
		{
			$this->where = '';
			$this->select = '';
			$this->set = '';
			$this->values = '';
			$this->mensaje = FALSE;
			$this->limit = '';
			$this->orderBy='';
			$this->rows = array();
		}
	}
?>