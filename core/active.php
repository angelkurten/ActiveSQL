<?php
	require_once('db.php');

	class active extends db
	{
		//variable para almacenar la consulta del where
		private $where="";
		//varaiable para almacenar los camos a filtrar en el GET
		private $select="";
		//variables para almacenar los campos a actualizar en el SET
		private $set="";
		//variable para los values del INSERT
		private $values="";
		
		public function __construct()
		{
			$this->mensaje="";
		}

		//function para realizar una consulta de tipo SELECT
		public function get($table)
		{		
			if($this->mensaje==""){
				//construir consulta con o sin campos a filtrar
				if($this->select!=""){
					$this->query="SELECT ".$this->select." FROM ".$table;
				}
				else
				{
					$this->query="SELECT * FROM ".$table;
				}

				//completar consulta con o sin filtro where
				if($this->where!="")
				{
					$this->query.=" WHERE ".$this->where;
				}
				else
				{
					$this->query.=";";
				}

				//ejecutar consulta
				$this->getQuery();

				$result=$this->rows;
			}
			else
			{
				$result=$this->mensaje;
			}
			//liberar memoria
			$this->liberar();
			//retornar el resultado
			return $result;
		}

		//funcion para guardar datos en una BD
		public function save($table)
		{
			if($this->mensaje=="")
			{
				$this->query="INSERT INTO ".$table." VALUES ".$this->values.";";
				
				//ejecutar consulta
				$this->executeQuery();

				$result=$this->rows;
			}
			else
			{
				$result=$this->mensaje;
			}
			//liberar la memoria
			$this->liberar();
			return $result;
		}


		//funcion apra realizar actualizaciones en la BD
		public function edit($table)
		{
			if($this->mensaje=="")
			{
				//construir consulta con o sin where
				if($this->set!="")
				{
					$this->query="UPDATE ".$table." SET ".$this->set."";
				}
				
				if($this->where!="")
				{
					$this->query.=" WHERE ".$this->where;
				}
				//colocando el ; al final de la consulta
				$this->query.=";";

				$result=$this->executeQuery();
			}
			else
			{
				$result=$this->mensaje;
			}
			//liberar la memoria
			$this->liberar();
			//retornar el resultado
			return $result;
		}

		//function para borrar campos de la BD
		public function delete($table)
		{
			if($this->mensaje=="")
			{
				$this->query='DELETE FROM '.$table;
				if ($this->where!="") {
					$this->query.=" WHERE ".$this->where.";";
				}

				$this->executeQuery();
			}
			$this->liberar();
		}

		//funcion para actualizar
		public function set($array)
		{
			if(gettype($array)!="array")
			{
				$this->mensaje="SET: Solo se aceptan parametros de tipo array";
				$this->set="";
			}
			else
			{
				//extraer las keys del array
				$columnas=array_keys($array);
				//extraer los values del array
				$values=array_values($array);
				//crear el array definitivo
				for ($i=0; $i < count($values); $i++) { 
					$sql[$i]="".$columnas[$i]." = '".addslashes($values[$i])."'";
				}
				//crear el sql definitivo 
				$sqldf=implode(" and ", $sql);

				//almaceno el sql en la propiedad
				$this->set=$sqldf;
			}
		}

		//funcion para seleccionar campos de una tabla
		public function select($array)
		{
			if(gettype($array)!="array")
			{
				$this->mensaje="SELECT: Solo se aceptan parametros tipo array";
				$this->select="";
			}
			else
			{
				$values=implode(" , ", $array);
				$this->select=$values;
			}
		}

		//funcion para seleccionar los values
		public function values($array)
		{
			if(gettype($array)!="array")
			{
				$this->mensaje="VALUES: Solo se aceptan parametros tipo array";
				$this->values="";
			}
			else
			{
				$values=array_values($array);
				//crear un array definitivo con los arrays anteriores
				for ($i=0; $i < count($values); $i++) {
					var_dump(addslashes($values[$i]));
					$sql[$i]="'".addslashes($values[$i])."'";
				}

				$values="(".implode(" , ", $sql).")";

				$this->values=$values;
			}
		}

		//funcion para realizar consultas tipo where
		public function where($array)
		{
			if(gettype($array)!="array")
			{
				$this->mensaje="WHERE: Solo se aceptan parametros tipo array";
				$this->where="";
			}
			else
			{
				//extraer las keys del array
				$columnas=array_keys($array);
				//extraer todos los values del array
				$values=array_values($array);
				//crear un array definitivo con los arrays anteriores
				for ($i=0; $i < count($values); $i++) { 
					$sql[$i]="".$columnas[$i]." = '".addslashes($values[$i])."'";
				}
				//creo el sql definitivo
				$sqldf=implode(" and ", $sql);

				$this->where=$sqldf;
			}
		}

		//funcion para liberar memoria
		public function liberar()
		{
			echo $this->where="";
			echo $this->select="";
			echo $this->set="";
			echo $this->values="";
			echo $this->mensaje="";
			$this->rows=array();
		}
	}
