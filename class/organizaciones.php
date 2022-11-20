<?php
    class Organizacion{

        // Connection
        private $connection;

        // Table
        private $db_table = "organizaciones";
        private $db_table_aux = "provincias";

        // Columns
        public $id;
        public $idusuario;
        public $nombre;
        public $descripcion;
        public $imagen;
        public $telefono;
        public $direccion;
        public $idprovincia;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL
        public function getOrganizaciones(){
            /*$consulta = "SELECT id, idusuario, nombre, descripcion, imagen, telefono, direccion, idprovincia FROM " . $this->db_table . "";
            */
            $consulta = "SELECT a.id, a.nombre, a.imagen, b.provincia FROM " . $this->db_table. " a INNER JOIN " . $this->db_table_aux. " b ON a.idprovincia = b.id";
            
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }
       
        // GET SINGLE
        public function getOrganizacion(){
            $consulta = "SELECT a.id, a.nombre, a.descripcion, a.imagen, a.telefono, a.direccion, b.provincia FROM " . $this->db_table . " a INNER JOIN " . $this->db_table_aux. " b ON a.idprovincia = b.id  WHERE a.id = " . $this->id . ""; 
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $organizacion = mysqli_fetch_assoc($resultado);
                $this->nombre = $organizacion['nombre'];
                $this->descripcion = $organizacion['descripcion'];
                $this->imagen = $organizacion['imagen'];
                $this->telefono = $organizacion['telefono'];
                $this->direccion = $organizacion['direccion'];
                $this->provincia = $organizacion  ['provincia'];
            }
        }        

        // GET SINGLE
        public function getOrganizacionUsuario(){
            $consulta = "SELECT a.id, a.nombre, a.descripcion, a.imagen, a.telefono, a.direccion, b.provincia FROM " . $this->db_table . " a INNER JOIN " . $this->db_table_aux. " b ON a.idprovincia = b.id  WHERE a.idusuario = " . $this->idusuario . ""; 
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $organizacion = mysqli_fetch_assoc($resultado);
                $this->id = $organizacion['id'];
                $this->nombre = $organizacion['nombre'];
                $this->descripcion = $organizacion['descripcion'];
                $this->imagen = $organizacion['imagen'];
                $this->telefono = $organizacion['telefono'];
                $this->direccion = $organizacion['direccion'];
                $this->provincia = $organizacion['provincia'];
            }
        }        

        // UPDATE
        public function updateOrganizacion(){
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->idprovincia = htmlspecialchars(strip_tags($this->idprovincia));

            //$consulta = "UPDATE ". $this->db_table ." SET nombre = '$this->nombre', descripcion = '$this->descripcion', imagen = '$this->imagen', telefono = '$this->telefono', direccion = '$this->direccion, idprovincia = '$this->idprovincia' WHERE id = $this->id";
            $consulta = "UPDATE ". $this->db_table ." SET nombre = '$this->nombre', descripcion = '$this->descripcion', imagen = '$this->imagen', telefono = '$this->telefono', direccion = '$this->direccion', idprovincia = '$this->idprovincia' WHERE id = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }

        // CREATE
        public function createOrganizacion(){
            // sanitize
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->idprovincia = htmlspecialchars(strip_tags($this->idprovincia));
            $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

            $consulta = "INSERT INTO ". $this->db_table ." (idusuario, nombre, descripcion, imagen, telefono, direccion, idprovincia) VALUES ('$this->idusuario', '$this->nombre', '$this->descripcion', '$this->imagen', '$this->telefono', '$this->direccion', '$this->idprovincia') ";
           
            $resultado = mysqli_query($this->connection, $consulta);

            if ($resultado) {
                $this->id = mysqli_insert_id($this->connection);
            }
            return $resultado;
        }

        // DELETE 
        public function deleteOrganizacion(){
            $this->id = htmlspecialchars(strip_tags($this->id));

            $consulta = "DELETE FROM " . $this->db_table . " WHERE id = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }
    }
?>

