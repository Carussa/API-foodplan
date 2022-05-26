<?php
    class Receta{

        // Connection
        private $connection;

        // Table
        private $db_table_1 = "recetas";
        private $db_table_2 = "ingredientes_receta";
        private $db_table_3 = "ingredientes";
        private $idreceta = 1;

        // Columns
        public $id;
        public $titulo;
        public $descripcion;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL
       public function getRecetas(){
            $consulta = "SELECT idreceta, titulo, descripcion, imagen FROM " . $this->db_table_1 . "";
            $resultado = mysqli_query($this->connection, $consulta);

            /*            
            while($row = mysqli_fetch_array($resultado))
            {
                print_r($row);
            }
    
            $ingr = $this->getIngredientesReceta($this->idreceta);

            while($row = mysqli_fetch_array($ingr))
            {
                print_r($row);
            } */

            if (mysqli_num_rows($resultado) > 0) {
                // Devuelve el array con todos los datos de todos los artículos
                return $resultado;
            }
        }
        public function getIngredientesReceta($idreceta){
            $consulta = "SELECT nombre FROM " . $this->db_table_3 . " a INNER JOIN " . $this->db_table_2 . " b WHERE b.idreceta = " . $idreceta ." and a.idingrediente = b.idingrediente";
           
            $resultado = mysqli_query($this->connection, $consulta); 

            if (mysqli_num_rows($resultado) > 0) {
                // Devuelve el array con todos los datos de todos los artículos
                return $resultado;
            }
        }

    }
?>

