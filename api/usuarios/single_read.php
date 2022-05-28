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

    $usuario->id = isset($_GET['id']) ? $_GET['id'] : die();

    $usuario->getUsuario();

    if($usuario->nombre != null){
        // create array
        $usuario_detalles = array(
            "id" => $usuario->id,
            "nombre" => $usuario->nombre,
            "email" => $usuario->email,
            "pass" => $usuario->pass,
            "rol" => $usuario->rol,
            "estado" => $usuario->estado,
        );

        http_response_code(200);
        echo json_encode($usuario_detalles);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>