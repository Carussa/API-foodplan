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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $receta->id = $data->id;
    $receta->titulo = $data->titulo;
    $receta->descripcion = $data->descripcion;
    $receta->imagen = $data->imagen;
    
    if($receta->updateReceta()){
        echo json_encode("Receta data updated.");
    } else{
        echo json_encode("Receta could not be updated");
    }
?>