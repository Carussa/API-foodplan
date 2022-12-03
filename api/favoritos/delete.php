<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/favoritos.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $fav = new Favorito($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $fav->idevento = $data->idevento;
    $fav->idusuario = $data->idusuario;

    if($fav->deleteFavorito()){
        echo json_encode("Fav deleted.");
    } else{
        echo json_encode("Fav could not be deleted");
    }
?>