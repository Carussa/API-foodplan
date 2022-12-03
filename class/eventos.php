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
            $consulta = "SELECT a.id, a.titulo, a.fecharealizacion, b.provincia, c.interes, d.organizacion, e.idusuario as favorito
            FROM ". $this->db_table ." a 
            INNER JOIN ". $this->db_table_aux . " b ON a.idprovincia = b.id 
            INNER JOIN ". $this->db_table_aux2 . " c ON a.idinteres = c.id 
            INNER JOIN ". $this->db_table_aux3 . " d ON a.idorganizacion = d.id 
            LEFT JOIN ". $this->db_table_aux4 . " e ON e.idusuario = ". $user. " AND a.id = e.idevento
            ORDER BY a.id ";
            
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }

        // GET ALL FROM USER
        public function getEventosUsuario($user){
            
            $consulta = "SELECT a.id, a.titulo, b.id as idorganizacion, c.interes
            FROM " . $this->db_table. " a 
            INNER JOIN " . $this->db_table_aux3. " b ON  b.idusuario = " . $user . "
            INNER JOIN ". $this->db_table_aux2 . " c ON a.idinteres = c.id 
            WHERE a.idorganizacion = b.id
            ORDER BY a.id ";
                    
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }

        // GET ALL FROM USER INTEREST
        public function getEventosIntereses($intereses, $user){
           
            $intereses = implode(',' , $intereses);
            
            $consulta = "SELECT a.id, a.titulo, a.fecharealizacion, b.provincia, c.interes, d.organizacion, e.idusuario as favorito
            FROM " . $this->db_table. " a 
            INNER JOIN " . $this->db_table_aux. " b ON a.idprovincia = b.id
            INNER JOIN " . $this->db_table_aux2. " c ON a.idinteres = c.id
            INNER JOIN " . $this->db_table_aux3. " d ON a.idorganizacion = d.id 
            LEFT JOIN ". $this->db_table_aux4 . " e ON e.idusuario = ". $user . " AND a.id = e.idevento 
            WHERE a.idinteres IN (" . $intereses . ") 
            ORDER BY a.id ";
                       
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                return $resultado;
            }
        }
       
        // GET SINGLE
        public function getEvento(){
            $consulta = "SELECT a.id, a.titulo, a.descripcion, a.idprovincia, a.idinteres, a.idorganizacion, a.direccion, a.fecharealizacion, b.provincia, c.interes, d.organizacion
            FROM " . $this->db_table. " a 
            INNER JOIN " . $this->db_table_aux. " b ON a.idprovincia = b.id
            INNER JOIN " . $this->db_table_aux2. " c ON a.idinteres = c.id
            INNER JOIN " . $this->db_table_aux3. " d ON a.idorganizacion = d.id  
            WHERE a.id = " . $this->id . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $evento = mysqli_fetch_assoc($resultado);
                $this->titulo = $evento['titulo'];
                $this->idinteres = $evento['idinteres'];
                $this->idprovincia = $evento['idprovincia'];
                $this->idorganizacion = $evento['idorganizacion'];
                $this->descripcion = $evento['descripcion'];
                $this->direccion = $evento['direccion'];
                $this->interes = $evento['interes'];
                $this->provincia = $evento['provincia'];
                $this->organizacion = $evento['organizacion'];
                $this->fecharealizacion = $evento['fecharealizacion'];
            }
        }        


        // UPDATE
        public function updateEvento(){
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->titulo = htmlspecialchars(strip_tags($this->titulo));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->idprovincia = htmlspecialchars(strip_tags($this->idprovincia));
            $this->idinteres= htmlspecialchars(strip_tags($this->idinteres));
            $this->fecharealizacion = htmlspecialchars(strip_tags($this->fecharealizacion));

            $consulta = "UPDATE ". $this->db_table ." SET titulo = '$this->titulo', descripcion = '$this->descripcion', direccion = '$this->direccion', idprovincia = '$this->idprovincia', idinteres = '$this->idinteres', fecharealizacion = '$this->fecharealizacion'  WHERE id = $this->id";
            
            $resultado = mysqli_query($this->connection, $consulta);
            
            return $resultado;
        }

        // CREATE
        public function createEvento(){
            // sanitize
            $this->titulo = htmlspecialchars(strip_tags($this->titulo));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->direccion = htmlspecialchars(strip_tags($this->direccion));
            $this->idprovincia = htmlspecialchars(strip_tags($this->idprovincia));
            $this->idorganizacion = htmlspecialchars(strip_tags($this->idorganizacion));
            $this->idinteres= htmlspecialchars(strip_tags($this->idinteres));
            $this->fecharealizacion = htmlspecialchars(strip_tags($this->fecharealizacion));

            $consulta = "INSERT INTO ". $this->db_table ." (idorganizacion, titulo, descripcion, direccion, idprovincia, idinteres, fechaRealizacion) 
            VALUES ('$this->idorganizacion', '$this->titulo', '$this->descripcion', '$this->direccion', '$this->idprovincia', '$this->idinteres', '$this->fecharealizacion') ";
           
            echo $consulta;
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

