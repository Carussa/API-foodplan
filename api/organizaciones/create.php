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

    $organizacion->nombre = $data->nombre;
    $organizacion->descripcion = $data->descripcion;
    $organizacion->imagen = $data->imagen;
    $organizacion->telefono = $data->telefono;
    $organizacion->direccion = $data->direccion;
    $organizacion->idprovincia = $data->idprovincia;
    $organizacion->idusuario = $data->idusuario;
    
    if(!empty($organizacion->nombre)){
        if($organizacion->createOrganizacion()){
            echo 'organizacion '. $organizacion->id . ' created successfully.' ;
        } else{
            echo 'organizacion could not be created.';
        }
    }
    
?>