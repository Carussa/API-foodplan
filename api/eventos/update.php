<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/eventos.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $evento = new Evento($db);
    
    $evento->id = isset($_GET['id']) ? $_GET['id'] : die();
    $data = json_decode(file_get_contents("php://input"));
    
    $evento->titulo = $data->titulo;
    $evento->descripcion = $data->descripcion;
    $evento->direccion = $data->direccion;
    $evento->idprovincia = $data->idprovincia;
    $evento->idinteres = $data->idinteres;
    $evento->idorganizacion = $data->idorganizacion;
    $evento->fecharealizacion = $data->fecha;

    if($evento->updateEvento()){
        echo json_encode("evento updated.");
    } else{
        echo json_encode("evento could not be updated");
    }
?>