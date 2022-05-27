<?php
    class IngredienteReceta{

        // Connection
        private $connection;

        // Table
        private $db_table_IR = "ingredientes_receta";
        private $db_table_I = "ingredientes";

        // Columns
        public $idreceta;
        public $id;
        public $nombre;
        public $cantidad;

        // Db connection
        public function __construct($db, $id){
            $this->connection = $db;
            $this->idreceta = $id;
        }
        
        public function getIngredientesReceta(){
            $consulta = "SELECT a.idingrediente, a.cantidad, b.nombre FROM " . $this->db_table_IR . " a INNER JOIN " . $this->db_table_I . " b WHERE a.idreceta = " . $this->idreceta ." and a.idingrediente = b.idingrediente";
           
            $resultado = mysqli_query($this->connection, $consulta); 

            if (mysqli_num_rows($resultado) > 0) {
                // Devuelve el array con todos los datos de todos los artículos
                return $resultado;
            }
        }
    }
?>