 <?php
 
 class db
 {
     private $sql;
     
     public function orderBy(array $array, $orden = 'DESC')
     {
         $strQuery = '';
         foreach($array as $field) {
             $strQuery .= $field . ', ';
         }
         $this->sql = ' ORDER BY ' . rtrim($strQuery, ', ') . str_pad($orden, strlen($orden) + 2, ' ', STR_PAD_BOTH);
     }
     
     public function groupBy(array $array)
     {
         $strQuery = '';
         foreach($array as $field) {
             $strQuery .= $field . ', ';
         }
         
         $result = ' GROUP BY ' . rtrim($strQuery, ', ');
         
         if ($this->sql) {
             $result = ' GROUP BY ' . rtrim($strQuery, ', ') . ' ' . $this->sql;
         }
         
         $this->sql = $result;
     }
     
     public function __toString()
     {
         return $this->sql;
     }
}
 
 
// Test Zone
$d = new db();
$data = array('Nombre', 'Apellido');
 
$d->orderBy($data);
$d->groupBy($data);
 
echo $d;