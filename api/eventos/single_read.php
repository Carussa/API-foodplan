<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/eventos.php';

    $database = new Database();
    $db = $database->getConnection();

    $evento = new Evento($db);

    $evento->id = isset($_GET['id']) ? $_GET['id'] : die();

    $evento->getEvento();

    if($evento->id != null){
        // create array
        $evento_detalles = array(
            "id" => $evento->id,
            "title" => $evento->titulo,
            "description" => $evento->descripcion,
            "address" => $evento->direccion,
            "idprovince" => $evento->idprovincia,
            "province" => $evento->provincia,
            "idorganizacion" => $evento->idorganizacion,
            "organizacion" => $evento->organizacion,
            "idinterest" => $evento->idinteres,
            "interest" => $evento->interes,
            "date" => $evento->fecharealizacion
        );

        http_response_code(200);
        echo json_encode($evento_detalles);
    }
      
    else{
        http_response_code(404);
        echo json_encode("evento not found.");
    }
?>