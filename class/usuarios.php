<?php
    class Usuario{

        // Connection
        private $connection;

        // Table
        private $db_table = "usuarios";

        // Columns
        public $id;
        public $nombre;
        public $email;
        public $pass;
        public $rol;
        public $estado;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL
        public function getUsuarios(){
            $consulta = "SELECT idusuario, nombre, email, rol, estado FROM " . $this->db_table . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }

         // GET ALL ACTIVE
         public function getActiveUsuarios(){
            $consulta = "SELECT idusuario, nombre, email, rol FROM " . $this->db_table . " WHERE estado = 1";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }      
        
         // GET ALL INACTIVE
         public function getInactiveUsuarios(){
            $consulta = "SELECT idusuario, nombre, email, rol FROM " . $this->db_table . " WHERE estado = 0";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }      
       
        // GET SINGLE
        public function getUsuario(){
            $consulta = "SELECT nombre, email, pass, rol, estado FROM " . $this->db_table . " WHERE idusuario = " . $this->id . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $usuario = mysqli_fetch_assoc($resultado);
                $this->nombre = $usuario['nombre'];
                $this->email = $usuario['email'];
                $this->pass = $usuario['pass'];
                $this->rol = $usuario['rol'];
                $this->estado = $usuario['estado'];
            }
        }        

        // UPDATE
        public function updateUsuario(){
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->pass = htmlspecialchars(strip_tags($this->pass));

            $consulta = "UPDATE ". $this->db_table ." SET nombre = '$this->nombre', email = '$this->email', pass = '$this->pass' WHERE idusuario = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }

        // CREATE
        public function createUsuario(){
            // sanitize
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->pass = htmlspecialchars(strip_tags($this->pass));
            $this->rol = htmlspecialchars(strip_tags($this->rol));
            $this->estado = htmlspecialchars(strip_tags($this->estado));

            $consulta = "INSERT INTO ". $this->db_table ." (nombre, email, pass, rol, estado) VALUES ('$this->nombre', '$this->email', '$this->pass', '$this->rol', '$this->estado') ";
           
            $resultado = mysqli_query($this->connection, $consulta);

            if ($resultado) {
                $this->id = mysqli_insert_id($this->connection);
            }
            return $resultado;
        }

        // DELETE - BORRADO LÓGICO
        public function deleteUsuario(){
            $this->id = htmlspecialchars(strip_tags($this->id));

            $consulta = "UPDATE ". $this->db_table ." SET estado = 0  WHERE idusuario = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }
    }
?>

