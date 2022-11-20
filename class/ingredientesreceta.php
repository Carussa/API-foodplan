<?php
    class IngredienteReceta{

        // Connection
        private $connection;

        // Table
        private $db_table_IR = "ingredientes_receta";
        private $db_table_I = "ingredientes";

        // Columns
        //public $idreceta;
        public $id;
        public $nombre;
        public $cantidad;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
            //$this->idreceta = $id;
        }
        
        public function getIngredientesReceta($idreceta){
            $consulta = "SELECT a.idingrediente, a.cantidad, b.nombre FROM " . $this->db_table_IR . " a INNER JOIN " . $this->db_table_I . " b WHERE a.idreceta = " . $idreceta ." and a.idingrediente = b.idingrediente";
           
            $resultado = mysqli_query($this->connection, $consulta); 

            if (mysqli_num_rows($resultado) > 0) {
                // Devuelve el array con todos los datos de todos los artículos
                return $resultado;
            }
        }

        public function addIngredientesReceta($receta){
            
            $ingredientesValues= array();
            
            foreach($receta->ingredientes as $ingrediente){
                $ingredientesValues[] = "(" .$receta->id. ", " . $ingrediente->id . ", '" . $ingrediente->cantidad . "')";
            }

            if(!empty($ingredientesValues)){
                $stringValues = implode(", ", $ingredientesValues);
                
                $consulta = "INSERT INTO " . $this->db_table_IR . " (idreceta, idingrediente, cantidad) VALUES $stringValues";
                $resultado = mysqli_query($this->connection, $consulta);
    
                return $resultado;
            }
        }

        // idea: pasar todos los ingredientes, si existe registro update, si no add.
        // Además hay que comprobar si hay registros que no estén en el json y remove
        public function addIngredienteReceta($receta){}
        public function updateIngredienteReceta($receta){}

        //sin probar
        public function removeIngrediente($idreceta){
            $consulta = "DELETE FROM " . $this->db_table_IR . " WHERE idreceta = ". $idreceta. " AND idingrediente = " . $this->id . "";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }
    }
?>