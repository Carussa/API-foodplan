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

    if($organizacion->deleteOrganizacion()){
        echo json_encode("Organizacion deleted.");
    } else{
        echo json_encode("Organizacion could not be deleted");
    }
?>