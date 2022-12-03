<?php
    class Favorito{

        // Connection
        private $connection;

        // Table
        private $db_table = "favoritos";
        private $db_table_aux = "eventos";
        private $db_table_aux2 = "organizaciones";

        // Columns
        public $idusuario;
        public $idevento;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL FROM USER
        public function getFavoritosUsuario($user){
            
            $consulta = "SELECT a.idevento, b.titulo, b.imagen, c.organizacion
            FROM " . $this->db_table. " a 
            INNER JOIN " . $this->db_table_aux. " b ON  b.id = a.idevento
            INNER JOIN " . $this->db_table_aux2. " c ON  b.idorganizacion = c.id
            WHERE a.idusuario = " . $user . "
            ORDER BY b.id ";
        
            //$consulta = "SELECT a.id, a.titulo, a.imagen, a.fecharealizacion, b.provincia FROM " . $this->db_table. " a INNER JOIN " . $this->db_table_aux. " b ON a.idprovincia = b.id";
            
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }

        // CREATE
        public function createFavorito(){
            // sanitize
            $this->idevento = htmlspecialchars(strip_tags($this->idevento));
            $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

            $consulta = "INSERT INTO ". $this->db_table ." (idevento, idusuario) VALUES ('$this->idevento', '$this->idusuario') ";
           
            $resultado = mysqli_query($this->connection, $consulta);

            if ($resultado) {
                $this->id = mysqli_insert_id($this->connection);
            }
            return $resultado;
        }

        // DELETE 
        public function deleteFavorito(){
            $this->id = htmlspecialchars(strip_tags($this->id));

            $consulta = "DELETE FROM " . $this->db_table . " WHERE idevento = $this->idevento AND idusuario = $this->idusuario";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }
    }
?>

