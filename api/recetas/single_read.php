<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/recetas.php';

    $database = new Database();
    $db = $database->getConnection();

    $receta = new Receta($db);

    $receta->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $receta->getReceta();

    if($receta->titulo != null){
        // create array
        $receta_detalles = array(
            "id" => $receta->id,
            "titulo" => $receta->titulo,
            "descripcion" => $receta->descripcion,
            "imagen" => $receta->imagen,
        );
      
        if ($receta->ingredientes != null) $receta_detalles["ingredientes"] = $receta->ingredientes;

        http_response_code(200);
        echo json_encode($receta_detalles);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>