<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/eventos.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $evento = new Evento($db);
    
    $evento->id = isset($_GET['id']) ? $_GET['id'] : die();

    if($evento->deleteEvento()){
        echo json_encode("evento deleted.");
    } else{
        echo json_encode("evento could not be deleted");
    }
?>