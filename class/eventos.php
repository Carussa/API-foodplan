<?php
    class Evento{

        // Connection
        private $connection;

        // Table
        private $db_table = "eventos";
        private $db_table_aux = "provincias";
        private $db_table_aux2 = "intereses";
        private $db_table_aux3 = "organizaciones";
        private $db_table_aux4 = "favoritos";

        // Columns
        public $id;
        public $idorganizacion;
        public $organizacion;
        public $titulo;
        public $descripcion;
        public $imagen;
        public $direccion;
        public $idprovincia;
        public $provincia;
        public $idinteres;
        public $interes;
        public $fecharealizacion;
        public $fechaactualizacion;

        // Db connection
        public function __construct($db){
            $this->connection = $db;
        }

        // GET ALL
        public function getEventos($user){
           //$consulta = "SELECT a.id, a.titulo, a.imagen, a.fecharealizacion, b.provincia, c.interes, d.organizacion, e.idusuario as favorito FROM " . $this->db_table. " a INNER JOIN " . $this->db_table_aux. " b INNER JOIN " . $this->db_table_aux2. " c INNER JOIN " . $this->db_table_aux3. " d LEFT JOIN " . $this->db_table_aux4 . " e ON a.idprovincia = b.id AND a.idinteres = c.id AND a.idorganizacion = d.id AND " . $user . " = e.idusuario";
            $consulta = "SELECT a.id, a.titulo, a.imagen, a.fecharealizacion, b.provincia, c.interes, d.organizacion, e.idusuario as favorito
            FROM ". $this->db_table ." a 
            INNER JOIN ". $this->db_table_aux . " b ON a.idprovincia = b.ID 
            INNER JOIN ". $this->db_table_aux2 . " c ON a.idinteres = c.id 
            INNER JOIN ". $this->db_table_aux3 . " d ON a.idorganizacion = d.id 
            LEFT JOIN ". $this->db_table_aux4 . " e ON e.idusuario = ". $user. " AND a.id = e.idevento
            ORDER BY a.id ";
            //$consulta = "SELECT a.id, a.titulo, a.imagen, a.fecharealizacion, b.provincia, c.interes, d.nombre, e.idusuario as favorito FROM " . $this->db_table. " a INNER JOIN " . $this->db_table_aux. " b INNER JOIN " . $this->db_table_aux2. " c INNER JOIN " . $this->db_table_aux3. " d ON a.idprovincia = b.id AND a.idinteres = c.id";
            //$consulta = "SELECT a.id, a.titulo, a.imagen, a.fecharealizacion, b.provincia FROM " . $this->db_table. " a INNER JOIN " . $this->db_table_aux. " b ON a.idprovincia = b.id";
           
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }

        // GET ALL USUARIO
        public function getEventosUsuario($intereses){
           
            $intereses = implode(',' , $intereses);
            
            $consulta = "SELECT a.id, a.titulo, a.imagen, a.fecharealizacion, b.provincia, c.interes, d.nombre FROM " . $this->db_table. " a INNER JOIN " . $this->db_table_aux. " b INNER JOIN " . $this->db_table_aux2. " c INNER JOIN " . $this->db_table_aux3. " d ON a.idprovincia = b.id AND a.idinteres = c.id AND a.idorganizacion = d.id WHERE a.idinteres IN (" . $intereses . ")";
           
            //$consulta = "SELECT a.id, a.titulo, a.imagen, a.fecharealizacion, b.provincia FROM " . $this->db_table. " a INNER JOIN " . $this->db_table_aux. " b ON a.idprovincia = b.id";
            
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }
       
        // GET SINGLE
        public function getEvento(){
            $consulta = "SELECT a.id, a.titulo, a.descripcion, a.imagen, a.idorganizacion, a.direccion, b.provincia, c.interes, d.nombre FROM " . $this->db_table . " a INNER JOIN " . $this->db_table_aux. " b INNER JOIN " . $this->db_table_aux2. " c INNER JOIN " . $this->db_table_aux3. " d ON a.idprovincia = b.id AND a.idinteres = c.id AND a.idorganizacion = d.id WHERE a.id = " . $this->id . "";
            //$consulta = "SELECT a.id, a.titulo, a.descripcion, a.imagen, a.direccion, b.provincia FROM " . $this->db_table . " a INNER JOIN " . $this->db_table_aux. " b ON a.idprovincia = b.id WHERE a.id = " . $this->id . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $evento = mysqli_fetch_assoc($resultado);
                $this->titulo = $evento['titulo'];
                $this->interes = $evento['interes'];
                $this->descripcion = $evento['descripcion'];
                $this->imagen = $evento['imagen'];
                $this->direccion = $evento['direccion'];
                $this->provincia = $evento['provincia'];
                $this->idorganizacion = $evento['idorganizacion'];
                $this->organizacion = $evento['nombre'];
            }
        }        


        // UPDATE
        public function updateEvento(){
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->titulo = htmlspecialchars(strip_tags($this->titulo));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->idprovincia = htmlspecialchars(strip_tags($this->idprovincia));
            $this->idinteres= htmlspecialchars(strip_tags($this->idinteres));

            //$consulta = "UPDATE ". $this->db_table ." SET titulo = '$this->titulo', descripcion = '$this->descripcion', imagen = '$this->imagen', telefono = '$this->telefono', direccion = '$this->direccion, idprovincia = '$this->idprovincia' WHERE id = $this->id";
            $consulta = "UPDATE ". $this->db_table ." SET titulo = '$this->titulo', descripcion = '$this->descripcion', imagen = '$this->imagen', direccion = '$this->direccion', idprovincia = '$this->idprovincia', idinteres = '$this->idinteres' WHERE id = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }

        // CREATE
        public function createEvento(){
            // sanitize
            $this->titulo = htmlspecialchars(strip_tags($this->titulo));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->idprovincia = htmlspecialchars(strip_tags($this->idprovincia));
            $this->idorganizacion = htmlspecialchars(strip_tags($this->idorganizacion));
            $this->idinteres= htmlspecialchars(strip_tags($this->idinteres));

            $consulta = "INSERT INTO ". $this->db_table ." (idorganizacion, titulo, descripcion, imagen, direccion, idprovincia, idinteres) VALUES ('$this->idorganizacion', '$this->titulo', '$this->descripcion', '$this->imagen', '$this->direccion', '$this->idprovincia', '$this->idinteres') ";
           
            $resultado = mysqli_query($this->connection, $consulta);

            if ($resultado) {
                $this->id = mysqli_insert_id($this->connection);
            }
            return $resultado;
        }

        // DELETE 
        public function deleteEvento(){
            $this->id = htmlspecialchars(strip_tags($this->id));

            $consulta = "DELETE FROM " . $this->db_table . " WHERE id = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }
    }
?>

