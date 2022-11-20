<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/organizaciones.php';

    $database = new Database();
    $db = $database->getConnection();

    $organizacion = new organizacion($db);

    $organizacion->id = isset($_GET['id']) ? $_GET['id'] : die();

    $organizacion->getOrganizacion();

    if($organizacion->nombre != null){
        // create array
        $organizacion_detalles = array(
            "id" => $organizacion->id,
            "nombre" => $organizacion->nombre,
            "descripcion" => $organizacion->descripcion,
            "imagen" => $organizacion->imagen,
            "telefono" => $organizacion->telefono,
            "direccion" => $organizacion->direccion,
            "provincia" => $organizacion->provincia,
        );

        http_response_code(200);
        echo json_encode($organizacion_detalles);
    }
      
    else{
        http_response_code(404);
        echo json_encode("organizacion not found.");
    }
?>