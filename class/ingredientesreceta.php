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
             // sanitize
             /*$this->titulo = htmlspecialchars(strip_tags($this->titulo));
             $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
             $this->imagen = htmlspecialchars(strip_tags($this->imagen));*/
            $ingredientesValues= array();

            foreach($receta->ingredientes as $ingrediente){
                $ingredientesValues[] = "(" .$receta->id. ", " . $ingrediente['id'] . ", '" . $ingrediente['cantidad'] . "')";
            }

            if(!empty($ingredientesValues)){
            $stringValues = implode(", ", $ingredientesValues);
            
            $consulta = "INSERT INTO " . $this->db_table_IR . " (idreceta, idingrediente, cantidad) VALUES $stringValues";
            $resultado = mysqli_query($this->connection, $consulta);
 
            return $resultado;
            
            }
        }
    }
?>