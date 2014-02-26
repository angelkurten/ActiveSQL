<?php
	require_once('crud.php');
	require_once('libs/Array2XML.php');
	require_once('lib.php');
	class active extends crud
	{

		//funcion para ejecutar una query
		public function query($query, $tipo=1)
		{
			if($query!="")
			{
				$this->query=$query;
				if($tipo==1)
				{
					$this->executeQuery();
				}
				else
				{
					$this->getQuery();
					$result=$this->rows;
					return $result;
				}
			}
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
			$this->select = addslashes($values);
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
        public function where(array $array) 
        {
        	$strQuery = '';

        	//crear un array definitivo con los arrays anteriores
        	foreach($array as $key => $value) {
        		if (is_numeric($value)) {
        			$value = $key . ' = ' . "{$value}";
        		}
        		else{
        			$value = $key . ' = ' . "'{$value}'";
        		}
        		$strQuery .=  $value . ' and ';
        	}
        	
        	//creo el sql definitivo
        	$this->where = rtrim($strQuery, ' and ');
        }

        public function orderBy(array $array, $orden = 'DESC')
	    {
	        $strQuery = '';
	        foreach($array as $field) {
	            $strQuery .= $field . ', ';
	        }
	        
	        $this->orderBy = ' ORDER BY ' . rtrim($strQuery, ', ') . str_pad($orden, strlen($orden) + 2, ' ', STR_PAD_BOTH);
	    }

	    public function groupBy(array $array)
	    {
	        $strQuery = '';
	        foreach($array as $field) {
	            $strQuery .= $field . ', ';
	        }
	        
	        $result = ' GROUP BY ' . rtrim($strQuery, ', ');
	        
	        if ($this->groupBy) {
	            $result = ' GROUP BY ' . rtrim($strQuery, ', ') . ' ' . $this->groupBy;
	        }
	         
	        $this->groupBy = $result;
	    }

	    public function object()
		{
			if($this->type=='get'){
				$r = $this->getQuery();
				//liberar memoria
				$this->liberar();
				while($this->rows[] = $r->fetch_object());
				$r->free();
				//elimino e ultimo valor del vector
				array_pop($this->rows);
				return $this->rows;
			}
			else
			{
				showErrors('1AS', 'method only available for get()','undefined', 'undefined');
			}	
		}

		
		public function fecth()
		{
			$r = $this->getQuery();
			//liberar memoria
			$this->liberar();
			while($this->rows[] = $r->fetch_assoc());
			$r->free();
			//elimino e ultimo valor del vector
			array_pop($this->rows);
			return $this->rows;
		}
		
		public function json()
		{
			if($this->type=='get'){
				$r = $this->getQuery();
				//liberar memoria
				$this->liberar();
				while($this->rows[] = $r->fetch_assoc());
				$r->free();
				//elimino e ultimo valor del vector
				array_pop($this->rows);
				return json_encode($this->rows);
			}
			else
			{
				showErrors('1AS', 'method only available for get()','undefined', 'undefined');
			}				
		}

		public function xml()
		{
			if ($this->type=='get') 
			{
				$r = $this->getQuery();
				//liberar memoria
				$this->liberar();
				while($this->rows[] = $r->fetch_assoc());
				$r->free();
				//elimino e ultimo valor del vector
				array_pop($this->rows);

				$xml = Array2XML::generate($this->rows);		
						
				return $xml;
			}
			else
			{
				showErrors('1AS', 'method only available for get()','undefined', 'undefined');
			}
		}

		//function para realizar joins o enlazado de consultar
		public function join($table, $condicion, $type="")
		{
			////JOIN comentarios ON comentarios.id = blogs.id
			if(is_string($table) and is_string($condicion) and is_string($type)){
				$this->join .= addslashes($type).' JOIN '.addslashes($table).' ON '.addslashes($condicion);
			}
			else{
				showErrors('2AS', 'Type value icorrecto in the parameter');
			}
		}

		//funcion para limitar resultados de una consulta
		public function limit($init, $end = NULL)
		{
			if ((is_numeric($init)) and ($init >= 0)) {
				$this->limit = ' LIMIT ' . $init;

				if (($end != NULL) and (is_numeric($end)) and ($end >= 0)) {
					$this->limit .= ', ' . $end;
				}
			}
		}
	}
	
	$ac=new active;
