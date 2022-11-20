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
    
    $organizacion = new Organizacion($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $organizacion->id = $data->id;
    $organizacion->nombre = $data->nombre;
    $organizacion->descripcion = $data->descripcion;
    $organizacion->imagen = $data->imagen;
    $organizacion->telefono = $data->telefono;
    $organizacion->direccion = $data->direccion;
    $organizacion->idprovincia = $data->idprovincia;

    if($organizacion->updateOrganizacion()){
        echo json_encode("organizacion updated.");
    } else{
        echo json_encode("organizacion could not be updated");
    }
?>