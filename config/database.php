<?php 
    class Database {
        private $host = "127.0.0.1";
        private $dbname = "foodplan";
        private $user = "root";
        private $password = "";

        public $connection;

        public function getConnection() {
            $this->connection = null;
            try {
                $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
                $this->connection->set_charset("utf8");                ;
            } catch(mysqli_sql_exception $e) {
                error_log($e->getMessage()); 
                die('Error en la conexión con la BBDD');
            }
            return $this->connection;
        }
    }  
?>
