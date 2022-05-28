<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/usuarios.php';

    $database = new Database();
    $db = $database->getConnection();

    $usuario = new Usuario($db);

    $data = json_decode(file_get_contents("php://input"));

    $usuario->nombre = $data->nombre;
    $usuario->email = $data->email;
    $usuario->pass = $data->pass;
    $usuario->rol = 0;
    $usuario->estado = 1;
    
    if(!empty($usuario->nombre)){
        if($usuario->createUsuario()){
            echo 'Usuario '. $usuario->id . ' created successfully.' ;
        } else{
            echo 'Usuario could not be created.';
        }
    }
    
?>