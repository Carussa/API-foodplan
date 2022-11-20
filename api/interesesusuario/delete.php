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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $interes->id = $data->id;

    if($interes->deleteInteres()){
        echo json_encode("Interes deleted.");
    } else{
        echo json_encode("Interes could not be deleted");
    }
?>