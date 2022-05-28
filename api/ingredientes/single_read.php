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

    $ingrediente->id = isset($_GET['id']) ? $_GET['id'] : die();

    $ingrediente->getIngrediente();

    if($ingrediente->nombre != null){
        // create array
        $ingrediente_detalles = array(
            "id" => $ingrediente->id,
            "nombre" => $ingrediente->nombre,
            "imagen" => $ingrediente->imagen,
        );

        http_response_code(200);
        echo json_encode($ingrediente_detalles);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>