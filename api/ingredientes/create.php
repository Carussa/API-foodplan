<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/ingredientes.php';

    $database = new Database();
    $db = $database->getConnection();

    $ingrediente = new Ingrediente($db);

    $data = json_decode(file_get_contents("php://input"));

    $ingrediente->nombre = $data->nombre;
    $ingrediente->imagen = $data->imagen;
    
    if(!empty($ingrediente->nombre)){
        if($ingrediente->createIngrediente()){
            echo 'Ingrediente '. $ingrediente->id . ' created successfully.' ;
        } else{
            echo 'Ingrediente could not be created.';
        }
    }
    
?>