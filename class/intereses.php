<?php
    class Interes{

        // Connection
        private $connection;

        // Table
        private $db_table = "intereses";

        // Columns
        public $id;
        public $interes;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL
        public function getIntereses(){
            $consulta = "SELECT idinteres, interes FROM " . $this->db_table . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                // Devuelve el array con todos los datos de todos los artículos
                return $resultado;
            }
        }

       
        // GET SINGLE
        public function getInteres(){
            $consulta = "SELECT interes FROM " . $this->db_table . " WHERE idinteres = " . $this->id . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $receta = mysqli_fetch_assoc($resultado);
                $this->interes = $receta['interes'];
            }
        }        

        // UPDATE
        public function updateInteres(){
            $this->interes = htmlspecialchars(strip_tags($this->interes));

            $consulta = "UPDATE ". $this->db_table ." SET interes = '$this->interes' WHERE idinteres = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }

        // CREATE
        public function createInteres(){
            // sanitize
            $this->interes = htmlspecialchars(strip_tags($this->interes));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));

            $consulta = "INSERT INTO ". $this->db_table ." (interes) VALUES ('$this->interes') ";
           
            $resultado = mysqli_query($this->connection, $consulta);

            if ($resultado) {
                $this->id = mysqli_insert_id($this->connection);
            }
            return $resultado;
        }

        // DELETE
        public function deleteInteres(){
            $this->id = htmlspecialchars(strip_tags($this->id));

            $consulta = "DELETE FROM " . $this->db_table . " WHERE idinteres = ". $this->id . "";
            //comprobar si está en uso o usar claves foráneas
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }
    }
?>

