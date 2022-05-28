<?php
    class Ingrediente{

        // Connection
        private $connection;

        // Table
        private $db_table = "ingredientes";

        // Columns
        public $id;
        public $nombre;
        public $categoria;
        public $imagen;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL
        public function getIngredientes(){
            $consulta = "SELECT idingrediente, nombre, imagen FROM " . $this->db_table . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                // Devuelve el array con todos los datos de todos los artículos
                return $resultado;
            }
        }

       
        // GET SINGLE
        public function getIngrediente(){
            $consulta = "SELECT nombre, imagen FROM " . $this->db_table . " WHERE idingrediente = " . $this->id . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $receta = mysqli_fetch_assoc($resultado);
                $this->nombre = $receta['nombre'];
                $this->imagen = $receta['imagen'];
            }
        }        

        // UPDATE
        public function updateIngrediente(){
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));

            $consulta = "UPDATE ". $this->db_table ." SET nombre = '$this->nombre', imagen = '$this->imagen' WHERE idingrediente = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }

        // CREATE
        public function createIngrediente(){
            // sanitize
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));

            $consulta = "INSERT INTO ". $this->db_table ." (nombre, imagen) VALUES ('$this->nombre', '$this->imagen') ";
           
            $resultado = mysqli_query($this->connection, $consulta);

            if ($resultado) {
                $this->id = mysqli_insert_id($this->connection);
            }
            return $resultado;
        }

        // DELETE
        public function deleteIngrediente(){
            $this->id = htmlspecialchars(strip_tags($this->id));

            $consulta = "DELETE FROM " . $this->db_table . " WHERE idingrediente = ". $this->id . "";
            //comprobar si está en uso o usar claves foráneas
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }
    }
?>

