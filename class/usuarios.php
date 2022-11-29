<?php
    class Usuario{

        // Connection
        private $connection;

        // Table
        private $db_table = "usuarios";
        private $db_table_aux = "roles";
        private $db_table_aux_2 = "intereses_usuario";
        private $db_table_aux_3 = "organizaciones";

        // Columns
        public $id;
        public $nombre;
        public $email;
        public $pass;
        public $rol;
        public $estado;
        public $fecha;
        public $intereses;
        public $organizacion;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL
        public function getUsuarios(){
            $consulta = "SELECT id, nombre, email, rol, estado, fechaAcceso FROM " . $this->db_table . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }

        // GET SINGLE - Hacer left join para traerme la organización
        public function getUsuario(){
            $consulta = "SELECT a.nombre, a.email, a.pass, a.rol, b.id as organizacion FROM " . $this->db_table . " a LEFT JOIN " . $this->db_table_aux_3 . " b ON b.idusuario = " . $this->id . " WHERE a.id = " . $this->id . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $usuario = mysqli_fetch_assoc($resultado);
                $this->nombre = $usuario['nombre'];
                $this->email = $usuario['email'];
                $this->pass = $usuario['pass'];
                $this->rol = $usuario['rol'];
                $this->organizacion = $usuario['organizacion'];
            }
        }       
        
        // GET login
        public function isValid(){
          $consulta = "SELECT COUNT(*) as total, id FROM " . $this->db_table . " WHERE email = '" . $this->email . "' AND pass =  '" . $this->pass ."'";
             // $consulta = "SELECT COUNT(*) as total, id FROM " . $this->db_table . " WHERE email = 'mail@mail.com' AND pass = 'dsfcom'";
            $resultado = mysqli_query($this->connection, $consulta);
            $num_rows = mysqli_fetch_assoc($resultado);
            
            if ($num_rows['total'] == 1) {
                $this->id = $num_rows['id'];
                return true;
              //  $this->getUsuario();
            } else {
               return false;
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

            $consulta = "UPDATE ". $this->db_table ." SET estado = 0  WHERE id = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }

         // GET ROLES
         public function getRoles(){
            $consulta = "SELECT id, rol FROM  " . $this->db_table_aux . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }

        // CREATE INTERESES USUARIO
        public function createInteresesUsuario () {
            $consulta = "INSERT INTO " . $this->db_table_aux_2 . "(IDusuario, IDinteres) VALUES";
            foreach ($this->intereses as $key => $interes) {
                    $consulta .= "( " . $this->id . ", " . $interes . " )";
                    if ($key + 1 < count($this->intereses)) {
                        $consulta .=  ",";
                    }
                }

            echo $consulta;
            $resultado = mysqli_query($this->connection, $consulta);

            return $resultado;
        }
    }
?>

