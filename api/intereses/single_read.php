<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/intereses.php';

    $database = new Database();
    $db = $database->getConnection();

    $interes = new Interes($db);

    $interes->id = isset($_GET['id']) ? $_GET['id'] : die();

    $interes->getInteres();

    if($interes->interes != null){
        // create array
        $interes_detalles = array(
            "id" => $interes->id,
            "interes" => $interes->interes,
        );

        http_response_code(200);
        echo json_encode($interes_detalles);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>