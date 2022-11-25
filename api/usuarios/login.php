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

    $usuario->email = $data->email;
    $usuario->pass = $data->pass;

    if($usuario->isValid()){
        $usuario->getUsuario();
        // create array
        $usuario_detalles = array();

        $usuario_detalles["body"] = array(
            "id" => $usuario->id,
            "nombre" => $usuario->nombre,
            "rol" => $usuario->rol,
        );

        http_response_code(200);
        echo json_encode($usuario_detalles);
    }
      
    else{
        http_response_code(204);
        echo json_encode("Usuario not found.");
    }

   /* if($usuario->id != null){
        $usuario->getUsuario();
        // create array
        $usuario_detalles = array();

        $usuario_detalles["body"] = array(
            "id" => $usuario->id,
            "nombre" => $usuario->nombre,
            "rol" => $usuario->rol,
        );

        http_response_code(200);
        echo json_encode($usuario_detalles);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }*/
?>