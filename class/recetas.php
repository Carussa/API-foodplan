<?php
    class Receta{

        // Connection
        private $connection;

        // Table
        private $db_table = "recetas";
        private $db_table_IR = "ingredientes_receta";
        private $db_table_I = "ingredientes";

        // Columns
        public $id;
        public $titulo;
        public $descripcion;
        public $imagen;
        public $ingredientes;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL
        public function getRecetas(){
            $consulta = "SELECT idreceta, titulo, imagen FROM " . $this->db_table . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                // Devuelve el array con todos los datos de todos los artículos
                return $resultado;
            }
        }
        
        public function getReceta(){
            $consulta = "SELECT titulo, descripcion, imagen FROM " . $this->db_table . " WHERE idreceta = " . $this->id . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $receta = mysqli_fetch_assoc($resultado);
                $this->titulo = $receta['titulo'];
                $this->descripcion = $receta['descripcion'];
                $this->imagen = $receta['imagen'];
            }
        }        

    }
?>

