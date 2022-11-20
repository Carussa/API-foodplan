<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/usuarios.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Usuario($db);

    $usuarios = $items->getUsuarios();
    $itemCount = mysqli_num_rows($usuarios);


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $listaUsuarios = array();
        $listaUsuarios["body"] = array();
        $listaUsuarios["itemCount"] = $itemCount;

        while ($fila = mysqli_fetch_assoc($usuarios)){
            extract($fila);
            
            $receta = array(
                "id" => $id,
                "nombre" => $nombre,
                "email" => $email,
                "rol" => $rol,
                "estado" => $estado,
                "fecha" => $fechaAcceso,
            );

            array_push($listaUsuarios["body"], $receta);
        }
        echo json_encode($listaUsuarios);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>