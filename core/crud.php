<?php
	require_once('db.php');

	class crud extends db{

		protected $type='';
		protected $where = '';
		protected $select = '';
		protected $set = '';
		protected $values = '';
		protected $limit = '';
		protected $orderBy = '';
		protected $groupBy = '';
		protected $join = '';

		//function para realizar una consulta de tipo SELECT
		public function get($table)
		{
			$result = $this->mensaje;
			if ($result != TRUE) {
				$this->type='get';
				//construir consulta con o sin campos a filtrar
				$this->query = 'SELECT * FROM ' . $table;
				
				if ($this->select != '') {
					$this->query = 'SELECT ' . $this->select . ' FROM ' . $table;
				}
				
				//enlazar la consulta
				if ($this->join != '') {
					$this->query .= $this->join;
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
 				
 				$this->query=str_replace("{table}", $table, $this->query);
				return $this;
			}
			//liberar memoria
			$this->liberar();
			return $result;
		}

		//funcion para guardar datos en una BD
		public function save($table)
		{
			$this->type='save';
			$result = $this->mensaje;
			
			if (!$result) {
				$this->query = 'INSERT INTO ' . $table . ' VALUES ' . $this->values . ';';
				
				$this->query=str_replace("{table}", $table, $this->query);
				//ejecutar consulta
				$result = $this->executeQuery();
			}
			//liberar la memoria
			$this->liberar();
			return $result;
		}


		//funcion apra realizar actualizaciones en la BD
		public function edit($table)
		{
			$this->type='edit';
			$result = $this->mensaje;
			
			if (!$result) {
				//construir consulta con o sin where
				if ($this->set != '') {
					$this->query = 'UPDATE ' . $table . ' SET ' . $this->set;
				}
				
				if ($this->where != '') {
					$this->query .= ' WHERE ' . $this->where;
				}
				$this->query=str_replace("{table}", $table, $this->query);
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
			$this->type='delete';
			if (!$this->mensaje) {
				$this->query = 'DELETE FROM '.$table;
				
				if ($this->where != '') {
					$this->query .= ' WHERE ' . $this->where;
				}
				$this->query=str_replace("{table}", $table, $this->query);
				
				$result=$this->executeQuery();
			}
			$this->liberar();
			return $result;
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
			$this->type='';
			$this->join='';
		}
	}
?>