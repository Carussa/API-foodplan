<?php
    class Receta{

        // Connection
        private $connection;

        // Table
        private $db_table_1 = "recetas";
        private $db_table_2 = "ingredientes_receta";
        private $db_table_3 = "ingredientes";

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
            $consulta = "SELECT idreceta, titulo, imagen FROM " . $this->db_table_1 . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                // Devuelve el array con todos los datos de todos los artículos
                return $resultado;
            }
        }

        public function getReceta(){
            $consulta = "SELECT titulo, descripcion, imagen FROM " . $this->db_table_1 . " WHERE idreceta = " . $this->id . "";
            $resultado = mysqli_query($this->connection, $consulta);

            if (mysqli_num_rows($resultado) == 1) {

                $receta = mysqli_fetch_assoc($resultado);
                $this->titulo = $receta['titulo'];
                $this->descripcion = $receta['descripcion'];
                $this->imagen = $receta['imagen'];
                $this->getIngredientesReceta();
            }
        }        


        public function getIngredientesReceta(){
            $consulta = "SELECT a.idingrediente, a.cantidad, b.nombre FROM " . $this->db_table_2 . " a INNER JOIN " . $this->db_table_3 . " b WHERE a.idreceta = " . $this->id ." and a.idingrediente = b.idingrediente";
           
            $resultado = mysqli_query($this->connection, $consulta); 

            if (mysqli_num_rows($resultado) > 0) {
                $this->ingredientes = [];
                while ($fila = mysqli_fetch_assoc($resultado)){
                    extract($fila);
                    // $ingrediento = new ingredientereceta(id, idreceta, nombre, cantidad)
                    array_push($this->ingredientes, array(
                        "id" => $idingrediente,
                        "nombre" => $nombre,
                        "cantidad" => $cantidad,
                    ));
                }
            }
        }

    }
?>

