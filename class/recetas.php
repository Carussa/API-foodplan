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

       
        // GET SINGLE
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

        // CREATE
        public function createReceta(){
            // sanitize
            $this->titulo = htmlspecialchars(strip_tags($this->titulo));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));

            $consulta = "INSERT INTO ". $this->db_table ." (titulo, descripcion, imagen) VALUES ('$this->titulo', '$this->descripcion', '$this->imagen') ";
           
            $resultado = mysqli_query($this->connection, $consulta);

            if ($resultado) {
                $this->id = mysqli_insert_id($this->connection);
            }
            return $resultado;
        }

        // DELETE
        public function deleteReceta(){
            $this->id = htmlspecialchars(strip_tags($this->id));

            $consulta = "DELETE FROM " . $this->db_table . " WHERE idreceta = ". $this->id . "";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }
    }
?>

